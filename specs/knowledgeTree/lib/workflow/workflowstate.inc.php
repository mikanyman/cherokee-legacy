<?php
/**
 * $Id: workflowstate.inc.php 5992 2006-09-22 11:05:10Z bshuttle $
 *
 * Describes a state for a document, representing how far along in its
 * workflow it is, and providing a set of transitions to other states.
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
 * @version $Revision: 5992 $
 * @author Neil Blakey-Milner, Jam Warehouse (Pty) Ltd, South Africa
 */

require_once(KT_LIB_DIR . "/ktentity.inc");

class KTWorkflowState extends KTEntity {
    var $iId = -1;
    var $iWorkflowId;
    var $sName;
    var $sHumanName;

    var $_aFieldToSelect = array(
        "iId" => "id",
        "iWorkflowId" => "workflow_id",
        "sName" => "name",
        "sHumanName" => "human_name",
        'iInformDescriptorId' => 'inform_descriptor_id',
    );

    var $_bUsePearError = true;

    function getId() { return $this->iId; }
    function getName() { return $this->sName; }
    function getHumanName() { return $this->sHumanName; }
    function getWorkflowId() { return $this->iWorkflowId; }
    function getInformDescriptorId() { return $this->iInformDescriptorId; }
    function setId($iId) { $this->iId = $iId; }
    function setName($sName) { $this->sName = $sName; }
    function setHumanName($sHumanName) { $this->sHumanName = $sHumanName; }
    function setWorkflowId($iWorkflowId) { $this->iWorkflowId = $iWorkflowId; }
    function setInformDescriptorId($iInformDescriptorId) { $this->iInformDescriptorId = $iInformDescriptorId; }

    function _table () {
        return KTUtil::getTableName('workflow_states');
    }
    
    function _ktentityOptions() {
        return array(
            'orderby' => 'human_name',
        );
    }

    // STATIC
    function &get($iId) {
        return KTEntityUtil::get('KTWorkflowState', $iId);
    }

    // STATIC
    function &createFromArray($aOptions) {
        return KTEntityUtil::createFromArray('KTWorkflowState', $aOptions);
    }

    // STATIC
    function &getList($sWhereClause = null) {
        return KTEntityUtil::getList2('KTWorkflowState', $sWhereClause);
    }

    // STATIC
    function &getByName($sName) {
        return KTEntityUtil::getBy('KTWorkflowState', 'name', $sName);
    }

    // STATIC
    function &getByWorkflow($oWorkflow) {
        $iWorkflowId = KTUtil::getId($oWorkflow);

        $aOptions = array('multi' => true);
        return KTEntityUtil::getBy('KTWorkflowState', 'workflow_id', $iWorkflowId, $aOptions);
    }

    // STATIC
    function &getByDocument($oDocument) {
        $oDocument =& KTUtil::getObject('Document', $oDocument);
        $iStateId = $oDocument->getWorkflowStateId();

        if (PEAR::isError($iStateId)) {
            return $iStateId;
        }

        if (is_null($iStateId)) {
            return $iStateId;
        }

        return KTWorkflowState::get($iStateId);
    }

    // STATIC
    function nameExists($sName, $oWorkflow) {
        $iWorkflowId = KTUtil::getId($oWorkflow);
        $res = KTEntityUtil::getByDict(
            'KTWorkflowState', array(
                'name' => $sName,
                'workflow_id' => $iWorkflowId
            )        
        );
        // expect KTEntityNoObjects
        if (PEAR::isError($res)) {
            return false;
        }
        
        return true;
    }

}

?>
