<?php

/**
 * $Id: booleanSearch.php 6101 2006-12-07 09:32:38Z kevin_fourie $
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

// boilerplate includes
require_once("../config/dmsDefaults.php");
require_once(KT_LIB_DIR . "/templating/templating.inc.php");
require_once(KT_LIB_DIR . "/database/dbutil.inc");
require_once(KT_LIB_DIR . "/util/ktutil.inc");
require_once(KT_LIB_DIR . "/dispatcher.inc.php");
require_once(KT_LIB_DIR . "/browse/Criteria.inc");
require_once(KT_LIB_DIR . "/search/savedsearch.inc.php");
require_once(KT_LIB_DIR . "/search/searchutil.inc.php");

require_once(KT_LIB_DIR . "/browse/DocumentCollection.inc.php");
require_once(KT_LIB_DIR . "/browse/BrowseColumns.inc.php");
require_once(KT_LIB_DIR . "/browse/PartialQuery.inc.php");

require_once(KT_LIB_DIR . '/widgets/fieldWidgets.php');
require_once(KT_LIB_DIR . '/actions/bulkaction.php');

class BooleanSearchDispatcher extends KTStandardDispatcher {
    var $sSection = "browse";

    function BooleanSearchDispatcher() {
        $this->aBreadcrumbs = array(
            array('action' => 'browse', 'name' => _kt('Browse')),
        );
        return parent::KTStandardDispatcher();
    }

   function do_main() {
        $this->aBreadcrumbs[] = array('url' => $_SERVER['PHP_SELF'], 'name' => _kt("Advanced Search"));
        $this->oPage->setBreadcrumbDetails(_kt('defining search'));
        $oTemplating =& KTTemplating::getSingleton();
        $oTemplate = $oTemplating->loadTemplate("ktcore/boolean_search");
        
	$oCriteriaRegistry =& KTCriteriaRegistry::getSingleton();
        $aCriteria = $oCriteriaRegistry->getCriteria();
        
        $aTemplateData = array(
            "context" => &$this,
            "aCriteria" => $aCriteria,
        );
        return $oTemplate->render($aTemplateData);
    }

    function do_performSearch() {
        $title = null;
        $datavars = KTUtil::arrayGet($_REQUEST, 'boolean_search');

        if (!is_array($datavars)) {
            $datavars = unserialize($datavars);
        }
	
        $boolean_search_id = KTUtil::arrayGet($_REQUEST, 'boolean_search_id');
        if ($boolean_search_id) {
            $datavars = $_SESSION['boolean_search'][$boolean_search_id];
        }
        $iSavedSearchId = KTUtil::arrayGet($_REQUEST, 'fSavedSearchId');
        if (!empty($iSavedSearchId)) {
            $oSearch = KTSavedSearch::get($iSavedSearchId);
            $datavars = $oSearch->getSearch();
            $title = $oSearch->getName();
            $bIsCondition = $oSearch->getIsCondition();
        } else {
            $bIsCondition = false;
        }

        if (is_null(KTUtil::arrayGet($datavars["subgroup"][0], "values"))) {
            $this->errorRedirectToMain(_kt("No search parameters given"));
        }
        
        if (empty($datavars)) {
            $this->errorRedirectToMain(_kt('You need to have at least 1 condition.'));
        }
        
        return $this->handleCriteriaSet($datavars, KTUtil::arrayGet($_REQUEST, 'fStartIndex', 1), $title, $bIsCondition);
    }
    
    function do_saveSearch() {
        $this->startTransaction();
        
        $iSearchId = KTUtil::arrayGet($_REQUEST, 'fSearchId', false);
        $sName = KTUtil::arrayGet($_REQUEST, 'name', false);
            $sSearch = KTUtil::arrayGet($_REQUEST, 'boolean_search');
        
        if($iSearchId === false && $sName === false) {
            $this->errorRedirectTo('performSearch', _kt('Please either enter a name, or select a search to save over'), sprintf('boolean_search_id=%s', $sSearch));
            exit(0);
        }
        
        $datavars = $_SESSION['boolean_search'][$sSearch];
            if (!is_array($datavars)) {
                $datavars = unserialize($datavars);
            }
           
            if (empty($datavars)) {
                $this->errorRedirectToMain(_kt('You need to have at least 1 condition.'));
            }
        
        if($iSearchId) {
            $oSearch = KTSavedSearch::get($iSearchId);
            if(PEAR::isError($oSearch) || $oSearch == false) {
        	$this->errorRedirectToMain(_kt('No such search'));
        	exit(0);
            }
            $oSearch->setSearch($datavars);
            $oSearch = $oSearch->update();
        
        } else {
            $sName = $this->oValidator->validateEntityName('KTSavedSearch', 
        						   KTUtil::arrayGet($_REQUEST, 'name'), 
        						   array('extra_condition' => 'not is_condition', 'redirect_to' => array('new')));
                
            $sNamespace = KTUtil::nameToLocalNamespace('Saved searches', $sName);
        
            $oSearch = KTSavedSearch::createFromArray(array('name' => $sName,
        						    'namespace' => $sNamespace,
        						    'iscondition' => false,
        						    'iscomplete' => true,
        						    'userid' => $this->oUser->getId(),
        						    'search' => $datavars,));
        }
        
            $this->oValidator->notError($oSearch, array(
                'redirect_to' => 'main',
                'message' => _kt('Search not saved'),
            ));
        
        $this->commitTransaction();
        $this->successRedirectTo('performSearch', _kt('Search saved'), sprintf('boolean_search_id=%s', $sSearch));
    }


    function do_deleteSearch() {
        $this->startTransaction();
        
        $iSearchId = KTUtil::arrayGet($_REQUEST, 'fSavedSearchId', false);
        $oSearch = KTSavedSearch::get($iSearchId);
        if(PEAR::isError($oSearch) || $oSearch == false) {
            $this->errorRedirectToMain(_kt('No such search'));
            exit(0);
        }
        
        $res = $oSearch->delete();
            $this->oValidator->notError($res, array(
                'redirect_to' => 'main',
                'message' => _kt('Error deleting search'),
            ));
        
        $this->commitTransaction();
        
        $iFolderId = KTUtil::arrayGet($_REQUEST, 'fFolderId', false);
        $iDocumentId = KTUtil::arrayGet($_REQUEST, 'fFolderId', false);
        
        if($iFolderId) {
            controllerRedirect('browse', 'fFolderId=' . $iFolderId);
        } else {
            controllerRedirect('viewDocument', 'fDocumentId=' . $iDocumentId);
        }
    }
	
    function do_editSearch() {
        $sSearch = KTUtil::arrayGet($_REQUEST, 'boolean_search');
	    $aSearch = $_SESSION['boolean_search'][$sSearch];
        if (!is_array($aSearch)) {
            $aSearch = unserialize($aSearch);
        }
       
        if (empty($aSearch)) {
            $this->errorRedirectToMain(_kt('You need to have at least 1 condition.'));
        }

        $oTemplating =& KTTemplating::getSingleton();
        $oTemplate = $oTemplating->loadTemplate("ktcore/boolean_search_change");
        	
	$oCriteriaRegistry =& KTCriteriaRegistry::getSingleton();
        $aCriteria = $oCriteriaRegistry->getCriteria();
        
        // we need to help out here, since it gets unpleasant inside the template.
        
        foreach ($aSearch['subgroup'] as $isg => $as) {
            $aSubgroup =& $aSearch['subgroup'][$isg];
            if (is_array($aSubgroup['values'])) {
                foreach ($aSubgroup['values'] as $iv => $t) {
                    $datavars =& $aSubgroup['values'][$iv];

		    $oCriterion = $oCriteriaRegistry->getCriterion($datavars['type']);
                    $datavars['typename'] = $oCriterion->sDisplay;
                    $datavars['widgetval'] = $oCriterion->searchWidget(null, $datavars['data']);
                }
            }
        }
        
        $aTemplateData = array(
            "title" => _kt("Edit an existing condition"),
            "aCriteria" => $aCriteria,
            "searchButton" => _kt("Search"),
            'aSearch' => $aSearch,
            'context' => $this,
	    //            'iSearchId' => $oSearch->getId(),
	    //            'old_name' => $oSearch->getName(),
            'sNameTitle' => _kt('Edit Search'),
        );
        return $oTemplate->render($aTemplateData);        
    }


    function handleCriteriaSet($aCriteriaSet, $iStartIndex, $sTitle=null, $bIsCondition = false) {
        if ($sTitle == null) {
            $this->aBreadcrumbs[] = array('url' => $_SERVER['PHP_SELF'], 'name' => _kt('Advanced Search'));
            $sTitle =  _kt('Search Results');
        } else {
            if ($bIsCondition) {
                $this->aBreadcrumbs[] = array('name' => _kt('Test Condition'));
                $this->oPage->setTitle(sprintf(_kt('Test Condition: %s'), $sTitle));            
            } else {
                $this->aBreadcrumbs[] = array('name' => _kt('Saved Search'));
                $this->oPage->setTitle(sprintf(_kt('Saved Search: %s'), $sTitle));
            }
            $this->oPage->setBreadcrumbDetails($sTitle);                            
        }

        

        $this->browseType = "Folder";
        $searchable_text = KTUtil::arrayGet($_REQUEST, "fSearchableText");
        $sSearch = md5(serialize($aCriteriaSet));
        $_SESSION['boolean_search'][$sSearch] = $aCriteriaSet;

        $collection = new AdvancedCollection;       
        $oColumnRegistry = KTColumnRegistry::getSingleton();
        $aColumns = $oColumnRegistry->getColumnsForView('ktcore.views.search');
        $collection->addColumns($aColumns);	

	// get search parameters
	$oCriteriaRegistry =& KTCriteriaRegistry::getSingleton();
	$aParams = array();
	$aJoins = array();

	$aJoins['main'] = ($aCriteriaSet['join'] == 'AND') ? _kt('all') : _kt('any');
	
	foreach($aCriteriaSet['subgroup'] as $k => $subgroup) {

	    $aGroup = array();
	    $aJoins[$k] = ($subgroup['join'] == 'AND') ? _kt('all') : _kt('any');

        if(!empty($subgroup['values'])) {
            foreach($subgroup['values'] as $value) {
                $oCriterion =& $oCriteriaRegistry->getCriterion($value['type']);
                $aGroup[] = $oCriterion->parameterDisplay($value['data']);
            }
        }
        $aParams[] = $aGroup;
	}
        
        // set a view option
        $aTitleOptions = array(
            'documenturl' => $GLOBALS['KTRootUrl'] . '/view.php',
        );
        $collection->setColumnOptions('ktcore.columns.title', $aTitleOptions);
        $collection->setColumnOptions('ktcore.columns.selection', array(
            'rangename' => 'selection',
            'show_folders' => true,
            'show_documents' => true,
        ));
        
        $aOptions = $collection->getEnvironOptions(); // extract data from the environment
        
        $aOptions['return_url'] = KTUtil::addQueryStringSelf("action=performSearch&boolean_search_id=" . urlencode($sSearch));
        $aOptions['empty_message'] = _kt("No documents or folders match this query.");
        $aOptions['is_browse'] = true;
                
        $collection->setOptions($aOptions);
        $collection->setQueryObject(new BooleanSearchQuery($aCriteriaSet));    

        //$a = new BooleanSearchQuery($aCriteriaSet); 
        //var_dump($a->getDocumentCount()); exit(0);

        // form fields for saving the search
        $save_fields = array();
        $save_fields[] = new KTStringWidget(_kt('New search'), _kt('The name to save this search as'), 'name', null, $this->oPage, true);

        $aUserSearches = KTSavedSearch::getUserSearches($this->oUser->getId(), true);
        if(count($aUserSearches)) {
            $aVocab = array('' => ' ---- ');
            foreach($aUserSearches as $oSearch) {
            $aVocab[$oSearch->getId()] = $oSearch->getName();
            }
            
            $aSelectOptions = array('vocab' => $aVocab);
            $save_fields[] = new KTLookupWidget(_kt('Existing search'), _kt('To save over one of your existing searches, select it here.'), 'fSearchId', null, $this->oPage, true, null, null, $aSelectOptions);
        }
    
        $oTemplating =& KTTemplating::getSingleton();
        $oTemplate = $oTemplating->loadTemplate("kt3/browse");
        $aTemplateData = array(
            "context" => $this,
            "collection" => $collection,
            "custom_title" => $sTitle,
            "save_fields" => $save_fields,
	    "params" => $aParams,
	    "joins" => $aJoins,
            'isEditable' => true,
            "boolean_search" => $sSearch,
            'bulkactions' => KTBulkActionUtil::getAllBulkActions(),
            'browseutil' => new KTBrowseUtil(),
            'returnaction' => 'booleanSearch',
            'returndata' => $sSearch,

        );
        return $oTemplate->render($aTemplateData);
    }
}

$oDispatcher = new BooleanSearchDispatcher();
$oDispatcher->dispatch();

?>
