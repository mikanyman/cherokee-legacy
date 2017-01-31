<?php
/**
 * $Id: LinkType.inc 5758 2006-07-27 10:17:43Z bshuttle $
 *
 * Represents the type of link between documents
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
 *
 * @version $Revision: 5758 $
 * @author Neil Blakey-Milner, Jam Warehouse (Pty) Ltd, South Africa
 */

require_once(KT_DIR . '/lib/ktentity.inc');

class LinkType extends KTEntity {
    var $sName;
    var $sDescription;
	
    var $_aFieldToSelect = array(
        'iId' => 'id',
        'sName' => 'name',
        'sDescription' => 'description',
    );

	function LinkType($sName = null, $sDescription = null) {
		$this->iId = -1;
		$this->sName = $sName;
		$this->sDescription = $sDescription;
	}
	
	function getDescription() {
		return $this->sDescription;
	}
	
	function setDescription($sNewValue) {
		$this->sDescription = $sNewValue;
	}
	
	function getName() {
		return $this->sName;
	}
	
	function setName($sNewValue) {
		$this->sName = $sNewValue;
	}
	
    function _fieldValues () {
        return array(
            'name' => $this->sName,
            'description' => $this->sDescription,
        );
    }
    
    function _table () {
        global $default;
        return $default->document_link_types_table;
    }
	
    function getList($sWhereClause = null) {
            return KTEntityUtil::getList(LinkType::_table(), 'LinkType', $sWhereClause);
    }

    /*
    function &get($id) {
        $sQuery = "SELECT id, name, description FROM " . LinkType::_table() . " WHERE id = ?";
        $aParams = array($id);
        $res = DBUtil::getOneResult(array($sQuery, $aParams));
        if (PEAR::isError($res)) {
            return $res;
        }
        if (is_null($res)) {
            // XXX: No such key exception type
            return $res;
        }
        $oLinkType =& new LinkType($res['name'], $res['description']);
        $oLinkType->iId = $res['id'];
        return $oLinkType;
    }
    */

    function &get($iId) {
        $oObject =& KTEntityUtil::get('LinkType', $iId);
        return $oObject;
    }

}

function &linktypecreateFromArray($aParameters) {
    $oLinkType = & new LinkType($aParameters[0], $aParameters[1], $aParameters[2], $aParameters[3], $aParameters[4], $aParameters[5], $aParameters[6], $aParameters[7], $aParameters[8], $aParameters[9], $aParameters[10]);
    return $oLinkType;
}


?>