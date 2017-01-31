<?php

/**
 * $Id: actionregistry.inc.php 6027 2006-10-20 10:31:15Z bryndivey $
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

class KTActionRegistry {
    var $actions = array();
    // {{{ getSingleton
    function &getSingleton () {
        if (!KTUtil::arrayGet($GLOBALS['_KT_PLUGIN'], 'oKTActionRegistry')) {
            $GLOBALS['_KT_PLUGIN']['oKTActionRegistry'] = new KTActionRegistry;
        }
        return $GLOBALS['_KT_PLUGIN']['oKTActionRegistry'];
    }
    // }}}

    function registerAction($slot, $name, $nsname, $path = "", $sPlugin = null) {
        $this->actions[$slot] = KTUtil::arrayGet($this->actions, $slot, array());
        $this->actions[$slot][$nsname] = array($name, $path, $nsname, $sPlugin);
        $this->nsnames[$nsname] = array($name, $path, $nsname, $sPlugin);
    }

    function getActions($slot) {
        return KTUtil::arrayGet($this->actions, $slot, array());
    }

    function getActionByNsname($nsname) {
        return $this->nsnames[$nsname];
    }

    function initializeAction($nsname, $oUser) {
        list($sClassName, $sPath, $sName, $sPlugin) = $this->getActionByNsname($nsname);
        if (!empty($sPath)) {
            require_once($sPath);
        }

        $oPluginRegistry =& KTPluginRegistry::getSingleton();
        $oPlugin =& $oPluginRegistry->getPlugin($sPlugin);
        $oAction =& new $sClassName($oUser, $oPlugin);            

        return $oAction;
    }
            

}

?>
