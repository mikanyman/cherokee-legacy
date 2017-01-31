<?php

/**
 * $Id: BrowseableDashletPlugin.php 5758 2006-07-27 10:17:43Z bshuttle $
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

require_once(KT_LIB_DIR . '/plugins/plugin.inc.php');
require_once(KT_LIB_DIR . '/plugins/pluginregistry.inc.php');

class BrowseableDashletPlugin extends KTPlugin {
    var $sNamespace = "nbm.browseable.plugin";

    function BrowseableDashletPlugin($sFilename = null) {
        $res = parent::KTPlugin($sFilename);
        $this->sFriendlyName = _kt('Orphaned Folders Plugin');
        return $res;
    }        

    function setup() {
        $this->registerDashlet('BrowseableFolderDashlet', 'nbm.browseable.dashlet', 'BrowseableDashlet.php');

        require_once(KT_LIB_DIR . "/templating/templating.inc.php");
        $oTemplating =& KTTemplating::getSingleton();
        $oTemplating->addLocation('browseabledashlet', '/plugins/browseabledashlet/templates');
    }
}

$oPluginRegistry =& KTPluginRegistry::getSingleton();
$oPluginRegistry->registerPlugin('BrowseableDashletPlugin', 'nbm.browseable.plugin', __FILE__);
?>
