<?php

/**
 * $Id: UpgradeItems.inc.php 5949 2006-09-11 10:17:04Z bshuttle $
 *
 * The contents of this file are subject to the KnowledgeTree Public
 * License Version 1.1 ("License"); You may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.ktdms.com/KPL
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 * 
 * The Original Code is: KnowledgeTree Open Source
 * 
 * The Initial Developer of the Original Code is The Jam Warehouse Software
 * (Pty) Ltd, trading as KnowledgeTree.
 * Portions created by The Jam Warehouse Software (Pty) Ltd are Copyright
 * (C) 2006 The Jam Warehouse Software (Pty) Ltd;
 * All Rights Reserved.
 *
 */

// {{{ Format of the descriptor
/**
 * Format of the descriptor
 *
 * type*version*phase*simple description for uniqueness
 *
 * type is: sql, function, subupgrade, upgrade
 * version is: 1.2.4, 2.0.0rc5
 * phase is: 0, 1, 0pre.  Phase is _only_ evaluated by describeUpgrades.
 * description is: anything, unique in terms of version and type.
 */
// }}}

require_once(KT_LIB_DIR . '/upgrades/UpgradeFunctions.inc.php');
require_once(KT_LIB_DIR . '/database/sqlfile.inc.php');
require_once(KT_LIB_DIR . '/database/datetime.inc');

// {{{ Upgrade_Already_Applied
class Upgrade_Already_Applied extends PEAR_Error {
    function Upgrade_Already_Applied($oUpgradeItem) {
        $this->oUpgradeItem = $oUpgradeItem;
    }
}
// }}}

class UpgradeItem {
    var $type = "";
    var $name;
    var $version;
    var $description;
    var $phase;
    var $parent;
    var $date;
    var $result;

    function UpgradeItem($name, $version, $description = null, $phase = 0) {
        $this->name = $name;
        $this->version = $version;
        if (is_null($description)) {
            $description = $this->type . " upgrade to version " .  $version . " phase " . $phase;
        }
        $this->description = $description;
        $this->phase = $phase;
    }

    function setParent($parent) {
        $this->parent = $parent;
    }
    function setDate($date) {
        $this->date = $date;
    }

    function getDescriptor() {
        return join("*", array($this->type, $this->version, $this->phase, $this->name));
    }

    function getDescription() {
        return $this->description;
    }

    function getVersion() {
        return $this->version;
    }

    function getPhase() {
        return $this->phase;
    }

    function getType() {
        return $this->type;
    }

    function _upgradeTableInstalled() {
        $query = "SELECT COUNT(id) FROM upgrades";
        $res = DBUtil::getOneResult($query);
        if (PEAR::isError($res)) {
            return false;
        }
        return true;
    }

    function isAlreadyApplied() {
        if (!$this->_upgradeTableInstalled()) {
            return false;
        }
        $query = "SELECT id FROM upgrades WHERE descriptor = ? AND result = ?";
        $params = array($this->getDescriptor(), true);
        $res = DBUtil::getOneResultKey(array($query, $params), 'id');
        if (PEAR::isError($res)) {
            return $res;
        }
        if (is_null($res)) {
            return false;
        }
        return true;
    }

    function performUpgrade($force = false) {
        $res = $this->isAlreadyApplied();
        if ($res === true) {
            if ($force !== true) {
                // PHP5: Exception
                return new Upgrade_Already_Applied($this);
            }
        }
        if (PEAR::isError($res)) {
            return $res;
        }
        $oCache =& KTCache::getSingleton();
        $save = $oCache->bEnabled;
        $oCache->bEnabled = false;
        $res = $this->_performUpgrade();
        $oCache->bEnabled = $save;
        if (PEAR::isError($res)) {
            $this->_recordUpgrade(false);
            return $res;
        }
        $res = $this->_recordUpgrade(true);
        if (PEAR::isError($res)) {
            return $res;
        }
        return true;
    }

    function _performUpgrade() {
        return PEAR::raiseError("Unimplemented");
    }

    function _recordUpgrade($result) {
        if (is_null($this->date)) {
            $this->date = getCurrentDateTime();
        }
        if ($this->parent) {
            $parentid = $this->parent->getDescriptor();
        } else {
            $parentid = null;
        }
        return DBUtil::autoInsert("upgrades", array( 
            "descriptor" => $this->getDescriptor(),
            "description" => $this->description,
            "date_performed" => $this->date,
            "result" => $result,
            "parent" => $parentid,
        ));
    }

    // STATIC
    function getAllUpgrades() {
        return array();
    }
}

class SQLUpgradeItem extends UpgradeItem {
    function SQLUpgradeItem($path, $version = null, $description = null, $phase = null) {
        $this->type = "sql";
        $details = $this->_getDetailsFromFileName($path);
        if (is_null($version)) {
            $version = $details[1];
        }
        if (is_null($description)) {
            $description = $details[2];
        }
        if (is_null($phase)) {
            $phase = $details[3];
        }
        $this->UpgradeItem($path, $version, $description, $phase);
    }

    /**
     * Describe the SQL scripts that will be used to upgrade KnowledgeTree
     *
     * Return an array of arrays with two components: a string identifier
     * that uniquely describes the step to be taken and a string which is an
     * HTML-formatted description of the step to be taken.  These will be
     * returned in any order - describeUpgrade performs the ordering.
     *
     * @param string Original version (e.g., "1.2.4")
     * @param string Current version (e.g., "2.0.2")
     *
     * @return array Array of SQLUpgradeItem describing steps to be taken
     *
     * STATIC
     */
    function getUpgrades($origVersion, $currVersion) {
        global $default;
        $sqlupgradedir = KT_DIR . '/sql/' . $default->dbType . '/upgrade/';

        $ret = array();

        if (!is_dir($sqlupgradedir)) {
            return PEAR::raiseError("SQL Upgrade directory ($sqlupgradedir) not accessible");
        }
        if (!($dh = opendir($sqlupgradedir))) {
            return PEAR::raiseError("SQL Upgrade directory ($sqlupgradedir) not accessible");
        }

        while (($file = readdir($dh)) !== false) {
            // Each entry can be a file or a directory
            //
            // A file is legacy before the upgrade system was created, but
            // will be supported anyway.
            //
            // A directory is the end-result version: so, 2.0.5 contains
            // every script that differentiates it from a previous version,
            // say, 2.0.5rc1 or 2.0.4.
            //
            if (in_array($file, array('.', '..', 'CVS'))) {
                continue;
            }
            $fullpath = $sqlupgradedir . $file;
            if (is_file($fullpath)) {
                // Legacy file support, will be in form of
                // 1.2.4-to-2.0.0.sql.
                $details = SQLUpgradeItem::_getDetailsFromFileName($file);
                if ($details) {
                    if (!gte_version($details[0], $origVersion)) {
                        continue;
                    }
                    if (!lte_version($details[1], $currVersion)) {
                        continue;
                    }
                    //print "Will run $file\n";
                    $ret[] = new SQLUpgradeItem($file);
                }
            }
            if (is_dir($fullpath)) {
                $subdir = $file;
                if (!($subdh = opendir($fullpath))) {
                    continue;
                }
                while (($file = readdir($subdh)) !== false) {
                    $relpath = $subdir . '/' . $file;
                    $details = SQLUpgradeItem::_getDetailsFromFileName($relpath);
                    if ($details) {
                        if (!gte_version($details[0], $origVersion)) {
                            continue;
                        }
                        if (!lte_version($details[1], $currVersion)) {
                            continue;
                        }
                        //print "Will run $file\n";
                        $ret[] = new SQLUpgradeItem($relpath);
                    }
                }
            }
       }
       closedir($dh);
       return $ret;
    }

    function _getDetailsFromFileName($path) {
        // Old format (pre 2.0.6)
        $matched = preg_match('#^([\d.]*)-to-([\d.]*).sql$#', $path, $matches);
        if ($matched != 0) {
            $fromVersion = $matches[1];
            $toVersion = $matches[2];
            $description = "Database upgrade from version $fromVersion to $toVersion";
            $phase = 0;
            return array($fromVersion, $toVersion, $description, $phase);
        }
        $matched = preg_match('#^([\d.]*)/(?:(\d*)-)?(.*)\.sql$#', $path, $matches);
        if ($matched != 0) {
            $fromVersion = $matches[1];
            $toVersion = $matches[1];
            $in = array('_');
            $out = array(' ');
            $phase = (int)$matches[2];
            $description = "Database upgrade to version $toVersion: " . ucfirst(str_replace($in, $out, $matches[3]));
            return array($fromVersion, $toVersion, $description, $phase);
        }
        // XXX: handle new format
        return null;
    }

    function _performUpgrade() {
        global $default;
        $sqlupgradedir = KT_DIR . '/sql/' . $default->dbType . '/upgrade/';
        $queries = SQLFile::sqlFromFile($sqlupgradedir . $this->name);
        return DBUtil::runQueries($queries, $default->_admindb);
    }
}

class FunctionUpgradeItem extends UpgradeItem {
    function FunctionUpgradeItem ($func, $version, $description = null, $phase = null) {
        $this->type = "func";
        if (is_null($description)) {
            $aUpgradeFunctions = new UpgradeFunctions;
            $description = $UpgradeFunctions->descriptions[$func];
        }
        if (is_null($phase)) {
            $phase = 0;
        }
        $this->UpgradeItem($func, $version, $description, $phase);
    }

    function getUpgrades($origVersion, $currVersion) {
        $aUpgradeFunctions = new UpgradeFunctions;

        $ret = array();

        foreach ($aUpgradeFunctions->upgrades as $version => $funcs) {
            if (!gte_version($version, $origVersion)) {
                continue;
            }
            if (!lte_version($version, $currVersion)) {
                continue;
            }
            foreach ($funcs as $func) {
                $iPhase = KTUtil::arrayGet($aUpgradeFunctions->phases, $func, 0);
                $ret[] = new FunctionUpgradeItem($func, $version, $aUpgradeFunctions->descriptions[$func], $iPhase);
            }
        }
        return $ret;
    }

    function _performUpgrade() {
        $function = array('UpgradeFunctions', $this->name);
        return call_user_func($function);
    }
}

class KTRebuildPermissionObserver {
    function start() {
        $this->lastBeat = time();
    }
    function receiveMessage() {
        $now = time();
        if ($this->lastBeat + 15 < $now) {
            print "<!--          -->";
            ob_flush();
            flush();
        }
    }
    function end() {
    }
}

class RecordUpgradeItem extends UpgradeItem {
    function RecordUpgradeItem ($version, $oldversion = null) {
        $this->type = "upgrade";
        if (is_null($oldversion)) {
            $this->description = "Upgrade to version $version";
        } else {
            $this->description = "Upgrade from version $oldversion to $version";
        }
        $this->phase = 99;
        $this->version = $version;
        $this->name = 'upgrade' . $version;
    }

    function _performUpgrade() {
        $this->_deleteSmartyFiles();
        $this->_deleteProxyFiles();        
        require_once(KT_LIB_DIR . '/cache/cache.inc.php');
        $oCache =& KTCache::getSingleton();
        $oCache->deleteAllCaches();

        require_once(KT_LIB_DIR .  '/permissions/permissionutil.inc.php');

        $po =& new KTRebuildPermissionObserver($this);
        $po->start();
        $oChannel =& KTPermissionChannel::getSingleton();
        $oChannel->addObserver($po);

        set_time_limit(0);
        ignore_user_abort(true);

        KTPermissionUtil::rebuildPermissionLookups(true);
        $po->end();

        $query = "UPDATE system_settings SET value = ? WHERE name = ?";
        $aParams = array($this->version, "knowledgeTreeVersion");
        return DBUtil::runQuery(array($query, $aParams));
    }

    function _deleteSmartyFiles() {
        $oConfig =& KTConfig::getSingleton();
        $dir = sprintf('%s/%s', $oConfig->get('urls/varDirectory'), 'tmp');

        $dh = @opendir($dir);
        if (empty($dh)) {
            return;
        }
        $aFiles = array();
        while (false !== ($sFilename = readdir($dh))) {
            if (substr($sFilename, -10) == "smarty.inc") {
               $aFiles[] = sprintf('%s/%s', $dir, $sFilename);
            }
            if (substr($sFilename, -10) == "smarty.php") {
               $aFiles[] = sprintf('%s/%s', $dir, $sFilename);
            }
        }
        foreach ($aFiles as $sFile) {
            @unlink($sFile);
        }
    }
    

    function _deleteProxyFiles() {
        $oKTConfig =& KTConfig::getSingleton();
        
        
        // from ktentityutil::_proxyCreate
        $sDirectory = $oKTConfig->get('cache/proxyCacheDirectory');

        if (!file_exists($sDirectory)) {
            return;
        }
        $sRunningUser = KTUtil::running_user();
        if ($sRunningUser) {
            $sDirectory = sprintf("%s/%s", $sDirectory, $sRunningUser);
        }
        if (!file_exists($sDirectory)) {
            return ;
        }
        
        $dh = @opendir($sDirectory);
        if (empty($dh)) {
            return;
        }
        $aFiles = array();
        while (false !== ($sFilename = readdir($dh))) {
  
            if (substr($sFilename, -8) == ".inc.php") {
               $aFiles[] = sprintf('%s/%s', $sDirectory, $sFilename);
            }
        }

        foreach ($aFiles as $sFile) {
            @unlink($sFile);
        }
    }    
}

?>
