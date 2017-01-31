<?php

/**
 * $Id: plugin.php 5758 2006-07-27 10:17:43Z bshuttle $
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

require_once('config/dmsDefaults.php');
require_once(KT_LIB_DIR . '/plugins/pageregistry.inc.php');

$oRegistry =& KTPageRegistry::getSingleton();

$sPath = KTUtil::arrayGet($_SERVER, 'PATH_INFO');
if (empty($sPath)) {
    print "Nothing there...";
    exit(1);
}

$sPath = trim($sPath, '/ ');
$oPage = $oRegistry->getPage($sPath);
if (empty($oPage)) {
    print "Accessing unregistered resource";
    exit(1);
}

$oPage->dispatch();
