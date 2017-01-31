<?php

/**
 * $Id: DashletDisables.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

/** a _disable_ flag for a particular dashlet, and a particular user.

 shouldn't use an enable flag, since the target user is transient and
 may need to know about the item on creation, not on dashlet registration.
 
*/


class KTDashletDisable extends KTEntity {
        
    /** primary key value */
    var $iId = -1;
    var $iUserId;
    var $sNamespace;

    var $_bUsePearError = true;
        
    function getId() { return $this->iId; }
    function getUserId() { return $this->iUserId; }
    function setUserId($iNewValue) { $this->iUserId = $iNewValue; }
    function getNamespace() { return $this->sNamespace; }
    function setNamespace($sNewValue) {	$this->sNamespace = $sNewValue; }

    var $_aFieldToSelect = array(
        "iId" => "id",
        "iUserId" => "user_id",
        "sNamespace" => "dashlet_namespace",
    );
        
    function _table () {
        return KTUtil::getTableName('dashlet_disable');
    }

    // Static function
    function &get($iId) { return KTEntityUtil::get('KTDashletDisable', $iId); }
    function &getList($sWhereClause = null) { return KTEntityUtil::getList2('KTDashletDisable', $sWhereClause);	}	
    function &createFromArray($aOptions) { return KTEntityUtil::createFromArray('KTDashletDisable', $aOptions); }

    function &getForUserAndDashlet($iUserId, $sNamespace) {
        $sWhereClause = 'WHERE user_id = ? AND dashlet_namespace = ?';
        $aParams = array($iUserId, $sNamespace);
        
        return KTDashletDisable::getList(array($sWhereClause, $aParams));
    }
}

?>