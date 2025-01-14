<?php

/**
 * $Id: documentFields.php 5801 2006-08-15 10:06:22Z bryndivey $
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

require_once(KT_LIB_DIR . '/dispatcher.inc.php');
require_once(KT_LIB_DIR . '/metadata/fieldset.inc.php');
require_once(KT_LIB_DIR . '/widgets/forms.inc.php');
require_once(KT_LIB_DIR . '/plugins/pluginutil.inc.php');
require_once(KT_LIB_DIR . "/documentmanagement/MDTree.inc");

class BasicFieldsetManagementDispatcher extends KTAdminDispatcher {
    var $bAutomaticTransaction = true;
    var $bHaveConditional = null;
    var $sHelpPage = 'ktcore/admin/document fieldsets.html';

    function predispatch() {
        $this->persistParams(array('fFieldId'));    
        $this->oFieldset = KTFieldset::get(KTUtil::arrayGet($_REQUEST, 'fFieldsetId'));
        if (PEAR::isError($this->oFieldset)) {
            $this->oFieldset = null;
            unset($_REQUEST['fFieldsetId']); // prevent further attacks.
        }
        $this->oField = DocumentField::get(KTUtil::arrayGet($_REQUEST, 'fFieldId'));
        if (PEAR::isError($this->oField)) {
            $this->oField = null;
            unset($_REQUEST['fFieldId']); // prevent further attacks.
        } else {
            $this->aBreadcrumbs[] = array('url' => KTUtil::addQueryStringSelf($this->meldPersistQuery("","managefield")), 'name' => $this->oField->getName());
        }
    }

    // API:  this provides information about the fieldset, including which actions are available.
    function describe_fieldset($oFieldset) {
        $this->persistParams(array('fFieldsetId','action'));    
        $oTemplate =& $this->oValidator->validateTemplate('ktcore/metadata/admin/basic_overview');
        $oTemplate->setData(array(
            'context' => $this,
            'fields' => $oFieldset->getFields(),
        ));
        return $oTemplate->render();
    }

    function do_main () {
        return _kt("Something very unexpected happened.");
    }
    
    function getFieldTypeVocab() {
        $types = array(
            'normal' => _kt("Normal (String)"),
            'lookup' => _kt("Lookup"),            
            'tree' => _kt("Tree"),                        
        );        
        return $types;
    }
    
    function getDefaultType() {
        return 'normal';
    }

    function form_newfield() {
        $this->oPage->setBreadcrumbDetails(_kt('add field'));

        $oForm = new KTForm;
        $oForm->setOptions(array(
            'identifier' => 'ktcore.fieldsets.basic.field.create',
            'label' => _kt("Add New Field"),
            'submit_label' => _kt('Add Field'),
            'cancel_url' => $this->sParentUrl,
            'fail_action' => 'newfield',
            'action' => 'createfield',
            'context' => $this,            
        ));
        
        $type_vocab = $this->getFieldTypeVocab();
        
        $oForm->setWidgets(array(
            array('ktcore.widgets.string',array(
                'label' => _kt("Field Name"),
                'name' => 'name',
                'required' => true,
                'description' => _kt("Within a given fieldset, each field needs a unique name."),
            )),
            array('ktcore.widgets.text',array(
                'label' => _kt("Description"),
                'name' => 'description',
                'required' => true,
                'description' => _kt("A good description can be the difference between useful metadata and poor metadata.  At the same time, overly long descriptions are far less valuable than concise ones."),
            )),            
            array('ktcore.widgets.selection', array(
                'label' => _kt('Field Type'),
                'name' => 'field_type',
                'vocab' => $this->getFieldTypeVocab(),
                'description' => _kt("Different types of fields may be available, depending on the system."),
                'required' => true,
                'value' => $this->getDefaultType(),
            )),  
            array('ktcore.widgets.boolean',array(
                'label' => _kt("Required"),
                'name' => 'required',
                'description' => _kt("Required fields must be filled in, or the adding process will be rejected."),
            )),     
                 
        ));
        
        $oForm->setValidators(array(
            array('ktcore.validators.string', array(
                'test' => 'name',
                'output' => 'name', 
            )),
            array('ktcore.validators.string', array(
                'test' => 'description',
                'output' => 'description',
            )),
            array('ktcore.validators.boolean', array(
                'test' => 'required',
                'output' => 'required',
            )),
            array('ktcore.validators.string', array(
                'test' => 'field_type',
                'output' => 'field_type',
            )),            
        ));
        
        return $oForm;
    }

    function do_newfield() {
        $oForm = $this->form_newfield();
        
        return $oForm->render();
    }

    function do_createfield() {   
        $oForm = $this->form_newfield();
        $res = $oForm->validate();
        
        $data = $res['results'];
        $errors = $res['errors'];
        $extra_errors = array();
        
        $oField = DocumentField::getByFieldsetAndName($this->oFieldset, $data['name']);
        if (!PEAR::isError($oField)) {
            $extra_errors['name'] = _kt("A field with that name already exists in this fieldset.");
        }
        
        if (!empty($errors) || !empty($extra_errors)) {
            return $oForm->handleError(null, $extra_errors);
        }
        
        $lookup = false;
        $tree = false;
        
        if ($data['field_type'] == 'lookup') {
            $lookup = true;
        } else if ($data['field_type'] == 'tree') {
            $lookup = true;
            $tree = true;
        }
        
        $oField = DocumentField::createFromArray(array(
            'Name' => $data['name'],
            'Description' => $data['description'],
            'DataType' => 'STRING',
            'IsGeneric' => false,
            'HasLookup' => $lookup,
            'HasLookupTree' => $tree,
            'ParentFieldset' => $this->oFieldset->getId(),
            'IsMandatory' => $data['required'],        
        ));
    
        if (PEAR::isError($oField)) {
            return $oForm->handleError(sprintf(_kt("Unable to create field: %s"), $oField->getMessage()));
        }

        $this->successRedirectTo('managefield', _kt("Field created."), sprintf('fFieldId=%d', $oField->getId()));
    }
    
    function form_editfield($oField) {
        $oForm = new KTForm;
        $oForm->setOptions(array(
            'identifier' => 'ktcore.fieldsets.basic.field.edit',
            'label' => _kt("Edit Field"),
            'submit_label' => _kt('Update Field'),
            'cancel_action' => 'managefield',
            'fail_action' => 'managefield',
            'action' => 'updatefield',
            'context' => $this,            
        ));
        
        $oForm->setWidgets(array(
            array('ktcore.widgets.string',array(
                'label' => _kt("Field Name"),
                'name' => 'name',
                'value' => $oField->getName(),
                'required' => true,
                'description' => _kt("Within a given fieldset, each field needs a unique name."),
            )),
            array('ktcore.widgets.text',array(
                'label' => _kt("Description"),
                'name' => 'description',
                'value' => $oField->getDescription(),                
                'required' => true,
                'description' => _kt("A good description can be the difference between useful metadata and poor metadata.  At the same time, overly long descriptions are far less valuable than concise ones."),
            )),            
            array('ktcore.widgets.boolean',array(
                'label' => _kt("Required"),
                'value' => $oField->getIsMandatory(),
                'name' => 'required',
                'description' => _kt("Required fields must be filled in, or the adding process will be rejected."),
            )),     
                 
        ));
        
        $oForm->setValidators(array(
            array('ktcore.validators.string', array(
                'test' => 'name',
                'output' => 'name', 
            )),
            array('ktcore.validators.string', array(
                'test' => 'description',
                'output' => 'description',
            )),
            array('ktcore.validators.boolean', array(
                'test' => 'required',
                'output' => 'required',
            )),
        ));
        
        return $oForm;
    }

    function do_managefield() {
        $oTemplate = $this->oValidator->validateTemplate('ktcore/metadata/admin/manage_field');
        
        $oTemplate->setData(array(
            'context' => $this,
            'field_name' => $this->oField->getName(),
            'field_id' => $this->oField->getId(),
            'form' => $this->form_editfield($this->oField),
            'field' => $this->oField,
        ));
        return $oTemplate->render();
    }
    
    function do_updatefield() {
        $oForm = $this->form_editfield($this->oField);
        $res = $oForm->validate();
        $data = $res['results'];
        $errors = $res['errors'];
        $extra_errors = array();
        
        // check that the field name either hasn't changed, or doesn't exist.
        if ($data['name'] != $this->oField->getName()) {
            $oOldField = DocumentField::getByFieldsetAndName($this->oFieldset, $data['name']);
            if (!PEAR::isError($oOldField)) {
                $extra_errors['name'] = _kt("That name is already in use in this fieldset.  Please specify a unique name.");
            }
        }
        
        if (!empty($errors) || !empty($extra_errors)) {
            return $oForm->handleError(null, $extra_errors);
        }
        
        $this->oField->setName($data['name']);
        $this->oField->setDescription($data['description']);
        $this->oField->setIsMandatory($data['required']);
        
        $res = $this->oField->update();
        if (PEAR::isError($res)) {
            return $oForm->handleError(sprintf(_kt("Failed to update field: %s"), $res->getMessage()));
        }
        
        $this->successRedirectTo('managefield',_kt("Field updated."));
    }
    
    function form_addlookups() {
       $oForm = new KTForm;
        $oForm->setOptions(array(
            'identifier' => 'ktcore.fieldsets.basic.field.addlookup',
            'label' => _kt("Add Lookup Values"),
            'submit_label' => _kt('Add Lookups'),
            'cancel_action' => 'managefield',
            'fail_action' => 'addlookupvalues',
            'action' => 'createlookupvalues',
            'context' => $this,            
        ));
        
        $oForm->setWidgets(array(
            array('ktcore.widgets.text',array(
                'label' => _kt("Lookup Values"),
                'name' => 'lookups',
                'required' => true,
                'description' => _kt("Lookup values are what a user can select from a dropdown.  These pre-created lookup values are useful, since they help you keep the metadata in the system organised."),
                'important_description' => _kt("Please enter the lookup values you wish to add, one per line."),
            )),            
        ));
        
        $oForm->setValidators(array(
            array('ktcore.validators.string', array(
                'test' => 'lookups',
                'output' => 'lookups',
                'max_length' => 9999,
            )),
        ));
        
        return $oForm;
    }
    
    function do_addlookupvalues() {
        $this->oPage->setBreadcrumbDetails(_kt('add lookup values'));

        $oForm = $this->form_addlookups();        
        return $oForm->render();
    }
    
    function do_createlookupvalues() {
        $oForm = $this->form_addlookups();
        $res = $oForm->validate();
        $data = $res['results'];
        $errors = $res['errors'];
        $extra_errors = array();
        

        $failed = array();
        $lookups = array();

        $raw_lookups = $data['lookups'];        
        $lookup_candidates = explode("\n", $raw_lookups);        
        foreach ($lookup_candidates as $candidate) {
            $name = trim($candidate);

            if (empty($name)) {
                continue;
            }
            
            // check for existing or to-be-created lookups.
            if ($lookups[$name]) {
                $failed[$name] = $name;
                continue;
            }
            
            if ($failed[$name]) {
                continue; // already blown up, fix it.
            }
            
            $oOldLookup = MetaData::getByValueAndDocumentField($name, $this->oField);
            if (!PEAR::isError($oOldLookup)) {
                $failed[$name] = $name;
                continue;
            }
            
            $lookups[$name] = $name;
        }
        if (!empty($failed)) {
            $extra_errors['lookups'][] = sprintf(_kt("The following lookups you specified already exist, or are specified twice: %s"), implode(', ', $failed));
        } else if (empty($lookups)) {
            $extra_errors['lookups'][] = _kt("You must have at least 1 new lookup value.");
        }        

        if (!empty($errors) || !empty($extra_errors)) {
            return $oForm->handleError(null, $extra_errors);
        }
        
        $data['lookups'] = $lookups;
        
        foreach ($lookups as $value) {
            $oLookup = MetaData::createFromArray(array(
                'DocFieldId' => $this->oField->getId(),
                'sName' => $value,
                'iTreeParent' => null,
                'bDisabled' => false,
                'bIsStuck' => false,               
            ));
            if (PEAR::isError($oLookup)) {
                return $oForm->handleError(sprintf(_kt("Failed to create lookup: %s"), $oLookup->getMessage()));
            }
        }
        
        $this->successRedirectTo('managefield', sprintf(_kt("%d lookups added."), count($lookups)));
    }    
    
    function do_managelookups() {
        $this->oPage->setBreadcrumbDetails(_kt('manage lookup values'));

        $oTemplate =& $this->oValidator->validateTemplate("ktcore/metadata/admin/manage_lookups");
        
        $lookups =& MetaData::getByDocumentField($this->oField);
        
        $args = $this->meldPersistQuery("","metadataMultiAction", true);
        
        $oTemplate->setData(array(
            'context' => $this,
            'field_name' => $this->oField->getName(),
            'lookups' => $lookups,
            'args' => $args,
        ));
        return $oTemplate->render();
    }

    // {{{ do_metadataMultiAction
    function do_metadataMultiAction() {
        $subaction = array_keys(KTUtil::arrayGet($_REQUEST, 'submit', array()));
        $this->oValidator->notEmpty($subaction, array("message" => _kt("No action specified")));
        $subaction = $subaction[0];
        $method = null;
        if (method_exists($this, 'lookup_' . $subaction)) {
            $method = 'lookup_' . $subaction;
        }
        $this->oValidator->notEmpty($method, array("message" => _kt("Unknown action specified")));
        return $this->$method();
    }
    // }}}
    
    // {{{ lookup_remove
    function lookup_remove() {
        $oFieldset =& $this->oValidator->validateFieldset($_REQUEST['fFieldsetId']);
        $oField =& DocumentField::get($_REQUEST['fFieldId']);
        $aMetadata = KTUtil::arrayGet($_REQUEST, 'metadata');
        if (empty($aMetadata)) {
            $this->errorRedirectTo('managelookups', _kt('No lookups selected'));
        }
        foreach ($_REQUEST['metadata'] as $iMetaDataId) {
            $oMetaData =& MetaData::get($iMetaDataId);
            if (PEAR::isError($oMetaData)) {
                $this->errorRedirectTo('managelookups', _kt('Invalid lookup selected'));
            }
            $oMetaData->delete();
        }
        $this->successRedirectTo('managelookups', _kt('Lookups removed'));
        exit(0);
    }
    // }}}

    // {{{ lookup_disable
    function lookup_disable() {
        $oFieldset =& $this->oValidator->validateFieldset($_REQUEST['fFieldsetId']);
        $oField =& DocumentField::get($_REQUEST['fFieldId']);
        $aMetadata = KTUtil::arrayGet($_REQUEST, 'metadata');
        if (empty($aMetadata)) {
            $this->errorRedirectTo('managelookups', _kt('No lookups selected'));
        }
        foreach ($_REQUEST['metadata'] as $iMetaDataId) {
            $oMetaData =& MetaData::get($iMetaDataId);
            if (PEAR::isError($oMetaData)) {
                $this->errorRedirectTo('managelookups', _kt('Invalid lookup selected'));
            }
            $oMetaData->setDisabled(true);
            $oMetaData->update();
        }
        $this->successRedirectTo('managelookups', _kt('Lookups disabled'));
        exit(0);
    }
    // }}}

    // {{{ lookup_enable
    function lookup_toggleenabled() {
        $oFieldset =& $this->oValidator->validateFieldset($_REQUEST['fFieldsetId']);
        $oField =& DocumentField::get($_REQUEST['fFieldId']);
        $aMetadata = KTUtil::arrayGet($_REQUEST, 'metadata');
        if (empty($aMetadata)) {
            $this->errorRedirectTo('managelookups', _kt('No lookups selected'));
        }
        foreach ($_REQUEST['metadata'] as $iMetaDataId) {
            $oMetaData =& MetaData::get($iMetaDataId);
            if (PEAR::isError($oMetadata)) {
                $this->errorRedirectTo('managelookups', _kt('Invalid lookup selected'));
            }
            $oMetaData->setDisabled(!$oMetaData->getDisabled());
            $oMetaData->update();
        }
        $this->successRedirectTo('managelookups', _kt('Status Toggled'));
        exit(0);
    }
    // }}}

    // {{{ lookup_togglestickiness
    function lookup_togglestickiness() {
        $oFieldset =& $this->oValidator->validateFieldset($_REQUEST['fFieldsetId']);
        $oField =& DocumentField::get($_REQUEST['fFieldId']);
        $aMetadata = KTUtil::arrayGet($_REQUEST, 'metadata');
        if (empty($aMetadata)) {
            $this->errorRedirectTo('managelookups', _kt('No lookups selected'));
        }
        foreach ($_REQUEST['metadata'] as $iMetaDataId) {
            $oMetaData =& MetaData::get($iMetaDataId);
            if (PEAR::isError($oMetaData)) {
                $this->errorRedirectTo('managelookups', _kt('Invalid lookups selected'));
            }
            $bStuck = (boolean)$oMetaData->getIsStuck();
            $oMetaData->setIsStuck(!$bStuck);
            $oMetaData->update();
        }
        $this->successRedirectTo('managelookups', _kt('Lookup stickiness toggled'));
        exit(0);
    }
    // }}}

// {{{ TREE
    // create and display the tree editing form.
    function do_managetree() {
        global $default;
        // extract.
        $iFieldsetId = KTUtil::getId($this->oFieldset);
        $iFieldId = KTUtil::getId($this->oField);

        $oFieldset =& $this->oFieldset;
        $oField =& $this->oField;

        $this->oPage->setBreadcrumbDetails(_kt('edit lookup tree'));

        $field_id = $iFieldId;
        $current_node = KTUtil::arrayGet($_REQUEST, 'current_node', 0);
        $subaction = KTUtil::arrayGet($_REQUEST, 'subaction');

        // validate
        if (empty($field_id)) { return $this->errorRedirectToMain(_kt("Must select a field to edit.")); }
        $oField =& DocumentField::get($field_id);
        if (PEAR::isError($oField)) { return $this->errorRedirectToMain(_kt("Invalid field.")); }

        $aErrorOptions = array(
            'redirect_to' => array('editTree', sprintf('field_id=%d', $field_id)),
        );

        // under here we do the subaction rendering.
        // we do this so we don't have to do _very_ strange things with multiple actions.
        //$default->log->debug("Subaction: " . $subaction);
        $fieldTree =& new MDTree();
        $fieldTree->buildForField($oField->getId());

        if ($subaction !== null) {
            $target = 'managetree';
            $msg = _kt('Changes saved.');
            if ($subaction === "addCategory") {
                $new_category = KTUtil::arrayGet($_REQUEST, 'category_name');
                if (empty($new_category)) { 
                    return $this->errorRedirectTo("managetree", _kt("Must enter a name for the new category."), array("field_id" => $field_id, "fFieldsetId" => $iFieldsetId)); 
                } else { 
                    $this->subact_addCategory($field_id, $current_node, $new_category, $fieldTree);
                }
                $msg = _kt('Category added'). ': ' . $new_category;
            }
            if ($subaction === "deleteCategory") {
                $this->subact_deleteCategory($fieldTree, $current_node);
                $current_node = 0;      // clear out, and don't try and render the newly deleted category.
                $msg = _kt('Category removed.');
            }
            if ($subaction === "linkKeywords") {
                $keywords = KTUtil::arrayGet($_REQUEST, 'keywordsToAdd');
                $aErrorOptions['message'] = _kt("No keywords selected");
                $this->oValidator->notEmpty($keywords, $aErrorOptions);
                $this->subact_linkKeywords($fieldTree, $current_node, $keywords);
                $current_node = 0;      // clear out, and don't try and render the newly deleted category.
                $msg = _kt('Keywords added to category.');
            }
            if ($subaction === "unlinkKeyword") {
                $keyword = KTUtil::arrayGet($_REQUEST, 'keyword_id');
                $this->subact_unlinkKeyword($fieldTree, $keyword);
                $msg = _kt('Keyword moved to base of tree.');
            }
            // now redirect
            $query = sprintf('field_id=%d&fFieldsetId=%d', $field_id, $iFieldsetId);
            return $this->successRedirectTo($target, $msg, $query);
        }
        if ($fieldTree->root === null) {
            return $this->errorRedirectToMain(_kt("Error building tree. Is this a valid tree-lookup field?"));
        }

        // FIXME extract this from MDTree (helper method?)
        $free_metadata = MetaData::getList('document_field_id = '.$oField->getId().' AND (treeorg_parent = 0 OR treeorg_parent IS NULL) AND (disabled = 0)');

        // render edit template.

        $oTemplate = $this->oValidator->validateTemplate("ktcore/metadata/admin/edit_lookuptree");
        $renderedTree = $this->_evilTreeRenderer($fieldTree);

        $this->oPage->setTitle(_kt('Edit Lookup Tree'));

        //$this->oPage->requireJSResource('thirdparty/js/MochiKit/Base.js');
        
        if ($current_node == 0) { $category_name = 'Root'; }
        else {
            $oNode = MDTreeNode::get($current_node);
            $category_name = $oNode->getName();
        }
        
        $aTemplateData = array(
            "context" => $this,
            "args" => $this->meldPersistQuery("","managetree", true),        
            "field" => $oField,
            "oFieldset" => $oFieldset,
            "tree" => $fieldTree,
            "renderedTree" => $renderedTree,
            "currentNode" => $current_node,
            'category_name' => $category_name,
            "freechildren" => $free_metadata,

        );
        return $oTemplate->render($aTemplateData);
    }

    function subact_addCategory($field_id, $current_node, $new_category, &$constructedTree) {
        $newCategory = MDTreeNode::createFromArray(array (
             "iFieldId" => $field_id,
             "sName" => $new_category,
             "iParentNode" => $current_node,
        ));
        if (PEAR::isError($newCategory))
        {
            return false;
        }
        $constructedTree->addNode($newCategory);
        return true;
    }

    function subact_deleteCategory(&$constructedTree, $current_node) {
        $constructedTree->deleteNode($current_node);
        return true;
    }

    function subact_unlinkKeyword(&$constructedTree, $keyword) {
        $oKW = MetaData::get($keyword);
        if (PEAR::isError($oKW)) {
            return true;
        }
        $constructedTree->reparentKeyword($oKW->getId(), 0);
        return true;
    }


    function subact_linkKeywords(&$constructedTree, $current_node, $keywords) {
        foreach ($keywords as $md_id)
        {
            $constructedTree->reparentKeyword($md_id, $current_node);
        }
        return true;
    }

    /* ----------------------- EVIL HACK --------------------------
     *
     *  This whole thing needs to replaced, as soon as I work out how
     *  to non-sucking Smarty recursion.
     */

    function _evilTreeRecursion($subnode, $treeToRender)
    {
        // deliver us from evil....
        $iFieldId = $treeToRender->field_id;
        $oField = DocumentField::get($iFieldId);
        $iFieldsetId = $oField->getParentFieldsetId();

        $treeStr = "<ul>";
        foreach ($treeToRender->contents[$subnode] as $subnode_id => $subnode_val)
        {
            if ($subnode_id !== "leaves") {
                $treeStr .= '<li class="treenode active"><a class="pathnode inactive"  onclick="toggleElementClass(\'active\', this.parentNode); toggleElementClass(\'inactive\', this.parentNode);">' . $treeToRender->mapnodes[$subnode_val]->getName() . '</a>';
                $treeStr .= $this->_evilActionHelper($iFieldsetId, $iFieldId, false, $subnode_val);
                $treeStr .= $this->_evilTreeRecursion($subnode_val, $treeToRender);
                $treeStr .= '</li>';
            }
            else
            {
                foreach ($subnode_val as $leaf)
                {
                    $treeStr .= '<li class="leafnode">' . $treeToRender->lookups[$leaf]->getName();
                    $treeStr .= $this->_evilActionHelper($iFieldsetId, $iFieldId, true, $leaf);
                    $treeStr .=  '</li>';            }
                }
        }
        $treeStr .= '</ul>';
        return $treeStr;

    }

    // I can't seem to do recursion in smarty, and recursive templates seems a bad solution.
    // Come up with a better way to do this (? NBM)
    function _evilTreeRenderer($treeToRender) {
        //global $default;

        $treeStr = "<!-- this is rendered with an unholy hack. sorry. -->";
        $stack = array();
        $exitstack = array();

        // since the root is virtual, we need to fake it here.
        // the inner section is generised.
        $treeStr .= '<ul class="kt_treenodes"><li class="treenode active"><a class="pathnode"  onclick="toggleElementClass(\'active\', this.parentNode);toggleElementClass(\'inactive\', this.parentNode);">' . _kt('Root') . '</a>';
        $treeStr .= ' (<a href="' . KTUtil::addQueryStringSelf($this->meldPersistQuery('current_node=0', 'managetree')) . '">' . _kt('attach keywords') . '</a>)';
        $treeStr .= '<ul>';

        //$default->log->debug("EVILRENDER: " . print_r($treeToRender, true));
        foreach ($treeToRender->getRoot() as $node_id => $subtree_nodes)
        {
            //$default->log->debug("EVILRENDER: ".$node_id." => ".$subtree_nodes." (".($node_id === "leaves").")");
            // leaves are handled differently.
            if ($node_id !== "leaves") {
                // $default->log->debug("EVILRENDER: " . print_r($subtree_nodes, true));
                $treeStr .= '<li class="treenode active"><a class="pathnode" onclick="toggleElementClass(\'active\', this.parentNode);toggleElementClass(\'inactive\', this.parentNode);">' . $treeToRender->mapnodes[$subtree_nodes]->getName() . '</a>';
                $treeStr .= $this->_evilActionHelper($iFieldsetId, $iFieldId, false, $subtree_nodes);
                $treeStr .= $this->_evilTreeRecursion($subtree_nodes, $treeToRender);
                $treeStr .= '</li>';
            }
            else
            {
                foreach ($subtree_nodes as $leaf)
                {
                    $treeStr .= '<li class="leafnode">' . $treeToRender->lookups[$leaf]->getName();
                    $treeStr .= $this->_evilActionHelper($iFieldsetId, $iFieldId, true, $leaf);
                    $treeStr .=  '</li>';
                }
            }
        }
        $treeStr .= '</ul></li>';
        $treeStr .= '</ul>';

        return $treeStr;
    }

    // BS: don't hate me.
    // BD: sorry. I hate you.
    
    function _evilActionHelper($iFieldsetId, $iFieldId, $bIsKeyword, $current_node) {
        $actionStr = " (";
        if ($bIsKeyword === true) {
           $actionStr .= '<a href="' . KTUtil::addQueryStringSelf(KTUtil::addQueryStringSelf($this->meldPersistQuery('keyword_id='.$current_node.'&subaction=unlinkKeyword', 'managetree'))) . '">' . _kt('unlink') . '</a>';
        } else {
           $actionStr .= '<a href="' . KTUtil::addQueryStringSelf($this->meldPersistQuery('current_node=' . $current_node, 'managetree')) .'">' . _kt('attach keywords') . '</a> ';
           $actionStr .= '| <a href="' . KTUtil::addQueryStringSelf($this->meldPersistQuery('current_node='.$current_node.'&subaction=deleteCategory', 'managetree')) . '">' . _kt('delete') . '</a>';
        }
        $actionStr .= ")";
        return $actionStr;
    }

    function do_deletefield() {
        $res = $this->oField->delete();
        if (PEAR::isError($res)) {
            $this->errorRedirectToParent(sprintf(_kt("Unable to delete field: %s"), $res->getMessage()));
        } 
        
        $this->successRedirectToParent(_kt("Field deleted."));
    }

}

?>
