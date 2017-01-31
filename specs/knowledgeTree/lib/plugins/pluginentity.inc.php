<?php

/**
 * $Id: pluginentity.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

require_once(KT_LIB_DIR . '/ktentity.inc');

class KTPluginEntity extends KTEntity {
    var $_bUsePearError = true;
    
    var $sNamespace;
    var $sPath;
    var $iVersion;
    var $bDisabled;
    var $sData;
    var $bUnavailable;

    // {{{ KTEntity-related
    var $_aFieldToSelect = array(
        'iId' => 'id',
        'sNamespace' => 'namespace',
        'sPath' => 'path',
        'iVersion' => 'version',
        'bDisabled' => 'disabled',
        'sData' => 'data',
        'bUnavailable' => 'unavailable',
        'sFriendlyName' => 'friendly_name',
    );

    function _table() {
        return KTUtil::getTableName('plugins');
    }

    function _cachedGroups() {
        return array('getlist', 'getList', 'getByNamespace');
    }
    // }}}

    // {{{ getters/setters
    function getNamespace() { return $this->sNamespace; }
    function getPath() { return $this->sPath; }
    function getVersion() { return $this->iVersion; }
    function getDisabled() { return $this->bDisabled; }
    function getData() { return $this->sData; }
    function getUnavailable() { return $this->bUnavailable; }
    function getFriendlyName($sValue) { return $this->sFriendlyName; }
    function setNamespace($sValue) { $this->sNamespace = $sValue; }
    function setPath($sValue) { $this->sPath = $sValue; }
    function setVersion($iValue) { $this->iVersion = $iValue; }
    function setDisabled($bValue) { $this->bDisabled = $bValue; }
    function setData($sValue) { $this->sData = $sValue; }
    function setUnavailable($mValue) { $this->bUnavailable = $mValue; }
    function setFriendlyName($sValue) { $this->sFriendlyName = $sValue; }
    // }}}

    function get($iId) {
        return KTEntityUtil::get('KTPluginEntity', $iId);
    }
    // STATIC
    function &createFromArray($aOptions) {
        return KTEntityUtil::createFromArray('KTPluginEntity', $aOptions);
    }

    // STATIC
    function &getList($sWhereClause = null) {
        return KTEntityUtil::getList2('KTPluginEntity', $sWhereClause, $aOptions);
    }

    // STATIC
    function &getByNamespace($sName) {
        $aOptions = array('fullselect' => false, 'cache' => 'getByNamespace');
        return KTEntityUtil::getBy('KTPluginEntity', 'namespace', $sName, $aOptions);
    }

    // STATIC
    function &getAvailable() {
        $aOptions = array('multi' => true);
        return KTEntityUtil::getBy('KTPluginEntity', 'unavailable', false, $aOptions);
    }

    function &getEnabledPlugins() {
        $aOptions = array(
            'ids' => true,
            'multi' => true,
        );
        return KTEntityUtil::getBy('KTPluginEntity', 'disabled', false,
                $aOptions);
    }
    
    function setEnabled($aIds) {
        $sTable = KTPluginEntity::_table();
        $sIds = DBUtil::paramArray($aIds);
        $sQuery = sprintf('UPDATE %s SET disabled = 1 WHERE id NOT IN (%s)', $sTable, $sIds);
        DBUtil::runQuery(array($sQuery, $aIds));
        $sQuery = sprintf('UPDATE %s SET disabled = 0 WHERE id IN (%s)', $sTable, $sIds);
        DBUtil::runQuery(array($sQuery, $aIds));
        KTPluginEntity::clearAllCaches();
    }

    function clearAllCaches() {
        return KTEntityUtil::clearAllCaches('KTPluginEntity');
    }
    
        // either return the friendly name, or the namespace (for failback).
    function getUserFriendlyName() {
        $n = trim($this->sFriendlyName);
        if (!empty($n)) { return $this->sFriendlyName; }
        return $this->sNamespace;
    }
}
