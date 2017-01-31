<?php

/**
 * $Id: permissionlookup.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

class KTPermissionLookup extends KTEntity {
    /** primary key */
    var $iId = -1;

    var $_aFieldToSelect = array(
        "iId" => "id",
    );

    var $_bUsePearError = true;

    function getID() { return $this->iId; }
    function setID($iId) { $this->iId = $iId; }

    function _table () {
        global $default;
        return $default->permission_lookups_table;
    }

    // STATIC
    function &get($iId) {
        return KTEntityUtil::get('KTPermissionLookup', $iId);
    }

    // STATIC
    function &createFromArray($aOptions) {
        return KTEntityUtil::createFromArray('KTPermissionLookup', $aOptions);
    }

    // STATIC
    function &getList($sWhereClause = null) {
        global $default;
        return KTEntityUtil::getList($default->permission_lookups_table, 'KTPermissionLookup', $sWhereClause);
    }
}

?>
