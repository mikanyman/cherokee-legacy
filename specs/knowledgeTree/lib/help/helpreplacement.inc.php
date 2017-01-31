<?php

/**
 * $Id: helpreplacement.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

require_once(KT_LIB_DIR . "/ktentity.inc");

class KTHelpReplacement extends KTEntity {
    /** primary key */
    var $iId = -1;
    /** help file name */
    var $sName;
    /** replacement string */
    var $sDescription;
    var $sTitle;

    var $_aFieldToSelect = array(
        "iId" => "id",
        "sName" => "name",
        "sDescription" => "description",
        "sTitle" => 'title',
    );

    var $_bUsePearError = true;

    function getID() { return $this->iId; }
    function getName() { return $this->sName; }
    function getDescription() { return $this->sDescription; }
    function getTitle() { return $this->sTitle; }
    function setID($iId) { $this->iId = $iId; }
    function setName($sName) { $this->sName = $sName; }
    function setDescription($sDescription) { $this->sDescription = $sDescription; }
    function setTitle($sTitle) { $this->sTitle= $sTitle; }

    function _table () {
        global $default;
        return $default->help_replacement_table;
    }

    // STATIC
    function &get($iId) {
        return KTEntityUtil::get('KTHelpReplacement', $iId);
    }

    // STATIC
    function &createFromArray($aOptions) {
        return KTEntityUtil::createFromArray('KTHelpReplacement', $aOptions);
    }

    function &getList($sWhereClause = null) {
        global $default;
        return KTEntityUtil::getList($default->help_replacement_table, 'KTHelpReplacement', $sWhereClause);
    }

    function &getByName($sName) {
        return KTEntityUtil::getBy('KTHelpReplacement', 'name', $sName);
    }
}

?>
