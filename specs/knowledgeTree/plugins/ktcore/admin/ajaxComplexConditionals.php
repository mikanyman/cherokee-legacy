<?php
/**
 * $Id: ajaxComplexConditionals.php 5900 2006-08-31 14:27:03Z bshuttle $
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

require_once("../../../config/dmsDefaults.php");
require_once(KT_LIB_DIR . "/templating/templating.inc.php");
require_once(KT_LIB_DIR . "/documentmanagement/DocumentField.inc");
require_once(KT_LIB_DIR . "/database/dbutil.inc");
require_once(KT_LIB_DIR . "/util/ktutil.inc");
require_once(KT_LIB_DIR . "/dispatcher.inc.php");
$sectionName = "Administration";


require_once(KT_LIB_DIR . "/metadata/fieldset.inc.php");
require_once(KT_LIB_DIR . "/metadata/fieldbehaviour.inc.php");
require_once(KT_LIB_DIR . "/metadata/valueinstance.inc.php");

class AjaxConditionalAdminDispatcher extends KTAdminDispatcher {
    function do_main() {
        return "Ajax Error: no action specified.";
    }

    // a lot simpler than the standard dispatcher, this DOESN'T include a large amount of "other" stuff ... we are _just_ called to handle 
    // input/output of simple HTML components.
    function handleOutput($data) {
        print $data;
    }

    /** lookup methods. */

    // get the list of free items for a given column, under a certain parent behaviour.
    function do_getItemList() {
        $parent_behaviour = KTUtil::arrayGet($_REQUEST, 'parent_behaviour'); 
        //$fieldset_id = KTUtil::arrayGet($_REQUEST, 'fieldset_id'); // 
        $oFieldset =& $this->oValidator->validateFieldset(KTUtil::arrayGet($_REQUEST, 'fieldset_id'));
        $field_id = KTUtil::arrayGet($_REQUEST, 'field_id'); 
        $oField =& $this->oValidator->validateField(KTUtil::arrayGet($_REQUEST, 'field_id'));
        
        header('Content-type: application/xml');
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate =& $oTemplating->loadTemplate('ktcore/metadata/conditional/ajax_complex_get_item_list');

        $aValues = array();
        foreach ($oField->getEnabledValues() as $oValue) {
            if (empty($parent_behaviour)) {
                $oInstance = KTValueInstance::getByLookupSingle($oValue);
                if (empty($oInstance)) {
                    $aValues[$oValue->getId()] = $oValue->getName();
                }
                // No parent behaviour (thus master column), so any
                // instance will do to prevent showing this value
                continue;
            }

            $iInstanceId = KTValueInstance::getByLookupAndParentBehaviour($oValue, $parent_behaviour, array('ids' => true));
            if (empty($iInstanceId)) {
                $aValues[$oValue->getId()] = $oValue->getName();
            }
        }
        $aData = array(
            'values' => $aValues,
        );
        $oTemplate->setData($aData);
        
        return $oTemplate->render();
    } 
    
    function do_removeFromBehaviour() {
        $oFieldset =& $this->oValidator->validateFieldset(KTUtil::arrayGet($_REQUEST, 'fieldset_id'));
        $field_id = KTUtil::arrayGet($_REQUEST, 'field_id'); 
        $oField =& $this->oValidator->validateField(KTUtil::arrayGet($_REQUEST, 'field_id'));
        
        header('Content-type: application/xml');
        
        $instances = (array) KTUtil::arrayGet($_REQUEST, 'fieldsToRemove');
        
        $this->startTransaction();
        
        foreach ($instances as $iInstanceId) {
            $oInstance = KTValueInstance::get($iInstanceId);
            if (PEAR::isError($oInstance) || ($oInstance === false)) {
                $this->rollbackTransaction();
                return 'Not OK.';
            }
            
            $res = $oInstance->delete();
            if (PEAR::isError($res) || ($res === false)) {
                $this->rollbackTransaction();
                return 'Not OK.';
            }
        }
        
        $this->commitTransaction();
        
        return '<empty>OK.</empty>';
    }
    
    // get the list of ASSIGNED items for a given column, under a certain parent behaviour.
    function do_getAssignedList() {
        $parent_behaviour = KTUtil::arrayGet($_REQUEST, 'parent_behaviour'); 
        //$fieldset_id = KTUtil::arrayGet($_REQUEST, 'fieldset_id'); // 
        $oFieldset =& $this->oValidator->validateFieldset(KTUtil::arrayGet($_REQUEST, 'fieldset_id'));
        $field_id = KTUtil::arrayGet($_REQUEST, 'field_id'); 
        $oField =& $this->oValidator->validateField(KTUtil::arrayGet($_REQUEST, 'field_id'));
        
        header('Content-type: application/xml');
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate =& $oTemplating->loadTemplate('ktcore/metadata/conditional/ajax_complex_get_item_list');

        $aValues = array();
        $aBehaviours = array();
        foreach ($oField->getEnabledValues() as $oValue) {
            if (empty($parent_behaviour)) {
                $oInstance = KTValueInstance::getByLookupSingle($oValue);
                if (!empty($oInstance)) {
                    if (is_null($aBehaviours[$oInstance->getBehaviourId()])) {
                        $aBehaviours[$oInstance->getBehaviourId()] = KTFieldBehaviour::get($oInstance->getBehaviourId());
                    }
                    $aValues[$oInstance->getId()] = $oValue->getName() . ' - ' . $aBehaviours[$oInstance->getBehaviourId()]->getName();
                }
                // No parent behaviour (thus master column), so any
                // instance will do to prevent showing this value
                continue;
            }

            $iInstanceId = KTValueInstance::getByLookupAndParentBehaviour($oValue, $parent_behaviour, array('ids' => true));
            
            if (!empty($iInstanceId)) {
                
                $oInstance = KTValueInstance::get($iInstanceId);
                
                //print $oInstance->getBehaviourId() . ' - ';
                //continue;
                $behaviour_id = $oInstance->getBehaviourId();
                if (is_null($behaviour_id)) {                
                    $aValues[$oInstance->getId()] = $oValue->getName();
                } else {
                    if (is_null($aBehaviours[$behaviour_id])) {
                        $aBehaviours[$behaviour_id] = KTFieldBehaviour::get($behaviour_id);
                    }
    
                    $aValues[$oInstance->getId()] = $oValue->getName() . ' - ' . $aBehaviours[$behaviour_id]->getName();
                }
            }
        }
        $aData = array(
            'values' => $aValues,
        );
        $oTemplate->setData($aData);
        
        return $oTemplate->render();
    } 
    
    function do_getBehaviourList() {
        $parent_behaviour = KTUtil::arrayGet($_REQUEST, 'parent_behaviour'); 
        $fieldset_id = KTUtil::arrayGet($_REQUEST, 'fieldset_id'); 
        $field_id = KTUtil::arrayGet($_REQUEST, 'field_id'); 

        $aBehaviours =& KTFieldBehaviour::getByField($field_id);
        
        header('Content-type: application/xml');
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate =& $oTemplating->loadTemplate('ktcore/metadata/conditional/ajax_complex_get_behaviour_list');
        $oTemplate->setData(array(
            'aBehaviours' => $aBehaviours,
        ));
        return $oTemplate->render();
    } 
    
    function do_getActiveFields() {
        $GLOBALS['default']->log->error(print_r($_REQUEST, true));
        $parent_behaviour = KTUtil::arrayGet($_REQUEST, 'parent_behaviour'); 
        // $fieldset_id = KTUtil::arrayGet($_REQUEST, 'fieldset_id'); // 
        $oFieldset =& $this->oValidator->validateFieldset(KTUtil::arrayGet($_REQUEST, 'fieldset_id'));

        if (empty($parent_behaviour)) {
            $aFieldIds = array($oFieldset->getMasterFieldId());
        } else {
            $oBehaviour =& $this->oValidator->validateBehaviour($parent_behaviour);
            $iActiveFieldId = $oBehaviour->getFieldId();
            $aFieldIds = KTMetadataUtil::getChildFieldIds($iActiveFieldId);
        }

        $oTemplate =& $this->oValidator->validateTemplate('ktcore/metadata/conditional/ajax_complex_get_active_fields');
        $oTemplate->setData(array(
            'aFieldIds' => $aFieldIds,
        ));
        $GLOBALS['default']->log->error(print_r(KTMetadataUtil::getChildFieldIds($iActiveFieldId), true));
        
        header('Content-type: application/xml');
        /// header('Content-type: text/plain');
        return $oTemplate->render();
    }

    /** storage methods */
    function do_createBehaviourAndAssign() {
        $GLOBALS['default']->log->error(print_r($_REQUEST, true));
        $GLOBALS['default']->log->error(print_r($_SESSION, true));
        $parent_behaviour = KTUtil::arrayGet($_REQUEST, 'parent_behaviour'); 
        $fieldset_id = KTUtil::arrayGet($_REQUEST, 'fieldset_id'); 
        $field_id = KTUtil::arrayGet($_REQUEST, 'field_id');  
        $behaviour_name = KTUtil::arrayGet($_REQUEST, 'behaviour_name');  
        $lookups_to_assign = KTUtil::arrayGet($_REQUEST, 'lookups_to_assign'); // array

        $oBehaviour =& KTFieldBehaviour::createFromArray(array(
            'name' => $behaviour_name,
            'humanname' => $behaviour_name,
            'fieldid' => $field_id,
        ));

        $aValueInstanceIds = array();
        foreach ($lookups_to_assign as $iLookupId) {
            $res = $oValueInstance =& KTValueInstance::createFromArray(array(
                'fieldid' => $field_id,
                'behaviourid' => $oBehaviour->getId(),
                'fieldvalueid' => abs($iLookupId),
            ));
            $aValueInstanceIds[] = $res->getId();
        }

        if ($parent_behaviour) {
            $oParentBehaviour =& $this->oValidator->validateBehaviour($parent_behaviour);
            $sTable = KTUtil::getTableName('field_behaviour_options');
            $aOptions = array('noid' => true);
            foreach ($aValueInstanceIds as $iId) {
                $res = DBUtil::autoInsert($sTable, array(
                    'behaviour_id' => $oParentBehaviour->getId(),
                    'field_id' => $field_id,
                    'instance_id' => $iId,
                ), $aOptions);
            }
        }

        header('Content-type: application/xml');
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate =& $oTemplating->loadTemplate('ktcore/metadata/conditional/ajax_complex_create_behaviour_and_assign');
        return $oTemplate->render();
    }

    function do_useBehaviourAndAssign() {
        $parent_behaviour = KTUtil::arrayGet($_REQUEST, 'parent_behaviour'); 
        $fieldset_id = KTUtil::arrayGet($_REQUEST, 'fieldset_id'); 
        $field_id = KTUtil::arrayGet($_REQUEST, 'field_id');  
        $behaviour_id = KTUtil::arrayGet($_REQUEST, 'behaviour_id');  
        $lookups_to_assign = KTUtil::arrayGet($_REQUEST, 'lookups_to_assign'); // array

        $oBehaviour =& $this->oValidator->validateBehaviour($behaviour_id);

        $aValueInstanceIds = array();
        foreach ($lookups_to_assign as $iLookupId) {
            $res = $oValueInstance =& KTValueInstance::createFromArray(array(
                'fieldid' => $field_id,
                'behaviourid' => $oBehaviour->getId(),
                'fieldvalueid' => abs($iLookupId),
            ));
            $aValueInstanceIds[] = $res->getId();
        }

        if ($parent_behaviour) {
            $oParentBehaviour =& $this->oValidator->validateBehaviour($parent_behaviour);
            $sTable = KTUtil::getTableName('field_behaviour_options');
            $aOptions = array('noid' => true);
            foreach ($aValueInstanceIds as $iId) {
                $res = DBUtil::autoInsert($sTable, array(
                    'behaviour_id' => $oParentBehaviour->getId(),
                    'field_id' => $field_id,
                    'instance_id' => $iId,
                ), $aOptions);
            }
        }
        
        header('Content-type: application/xml');
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate =& $oTemplating->loadTemplate('ktcore/metadata/conditional/ajax_complex_use_behaviour_and_assign');
        return $oTemplate->render();
    }


}

$oDispatcher = new AjaxConditionalAdminDispatcher();
$oDispatcher->dispatch();

?>
