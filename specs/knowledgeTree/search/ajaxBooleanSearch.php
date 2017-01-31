<?php
/**
 * $Id: ajaxBooleanSearch.php 5797 2006-08-11 10:47:14Z bryndivey $
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

require_once("../config/dmsDefaults.php");

require_once(KT_LIB_DIR . "/templating/templating.inc.php");

require_once(KT_LIB_DIR . "/database/dbutil.inc");
require_once(KT_LIB_DIR . "/util/ktutil.inc");
require_once(KT_LIB_DIR . "/dispatcher.inc.php");
require_once(KT_LIB_DIR . "/browse/Criteria.inc");
require_once(KT_LIB_DIR . "/browse/criteriaregistry.php");

/*
 * example code - tests the frontend behaviour.  remember to check ajaxConditional.php 
 * 
 */

class AjaxBooleanSearchDispatcher extends KTDispatcher {

    function handle_output($data) {
		header('Content-type: text/html; charset=UTF-8');
        return $data;
    }
    
    function do_getNewCriteria() {
        $criteriaType = KTUtil::arrayGet($_REQUEST, 'type');
        if (empty($criteriaType)) {
            return 'AJAX Error:  no criteria type specified.';
        } 

	$oCriteriaRegistry =& KTCriteriaRegistry::getSingleton();
        $critObj = $oCriteriaRegistry->getCriterion($criteriaType);
        if (PEAR::isError($critObj)) {
           return 'AJAX Error:  failed to initialise critiria of type "'.$type.'".';
        }
        // NBM:  there appears to be no reason to take $aRequest into searchWidget...
        $noRequest = array();
        return $critObj->searchWidget($noRequest);
    }

    function do_main() {
        return "Ajax Error.  ajaxBooleanSearch::do_main should not be reachable."; 
    }
    
    
}

$oDispatcher = new AjaxBooleanSearchDispatcher();
$oDispatcher->dispatch();

?>
