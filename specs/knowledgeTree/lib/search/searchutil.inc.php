<?php

/**
 * $Id: searchutil.inc.php 6005 2006-09-28 14:21:40Z bshuttle $
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

require_once(KT_LIB_DIR . '/search/savedsearch.inc.php');
require_once(KT_LIB_DIR . '/browse/Criteria.inc');

class KTSearchUtil {
    // {{{ _oneCriteriaSetToSQL
    /**
     * Handles leaf criteria set (ie, no subgroups), generating SQL for
     * the values in the criteria.
     *
     * (This would be the place to extend criteria to support contains,
     * starts with, ends with, greater than, and so forth.)
     */
    function _oneCriteriaSetToSQL($aOneCriteriaSet) {
        $aSQL = array();
        $aJoinSQL = array();
        $criteria_set = array();
        
        /*
         * First phase: get criterion object for search or the direct
         * SQL to use.
         *
         * XXX: Why is there $order there? 
         */
        foreach ($aOneCriteriaSet as $order => $dataset) {
            $type = KTUtil::arrayGet($dataset, "type");
            $sql = KTUtil::arrayGet($dataset, "sql");
            if (!empty($type)) {
		$oCriteriaRegistry =& KTCriteriaRegistry::getSingleton();		
                $oCriterion = $oCriteriaRegistry->getCriterion($dataset['type']);
                if (PEAR::isError($oCriterion)) {
                    return PEAR::raiseError(_kt('Invalid criteria specified.'));
                }
                $criteria_set[] = array($oCriterion, $dataset["data"]);
            } else if (!empty($sql)) {
                $criteria_set[] = $sql;
            } else {
                return PEAR::raiseError(_kt('Invalid criteria specified.'));
            }
        }

        /*
         * Second phase: Create an individual SQL query per criteria.
         */
        foreach ($criteria_set as $oCriterionPair) {
            $oCriterion = $oCriterionPair[0];
            $aReq = $oCriterionPair[1];
            if (is_object($oCriterion)) {
                $res = $oCriterion->searchSQL($aReq);
                if (!is_null($res)) {
                    $aSQL[] = $res;
                }
                $res = $oCriterion->searchJoinSQL();
                if (!is_null($res)) {
                    $aJoinSQL[] = $res;
                }
            } else {
                $aSQL[] = array($oCriterion, $aReq);
            }
        }

        /*
         * Third phase: build up $aCritQueries and $aCritParams, and put
         * parentheses around them.
         */
        $aCritParams = array();
        $aCritQueries = array();
        foreach ($aSQL as $sSQL) {
            if (is_array($sSQL)) {
                $aCritQueries[] = '('.$sSQL[0].')';
                $aCritParams = kt_array_merge($aCritParams , $sSQL[1]);
            } else {
                $aCritQueries[] = '('.$sSQL.')';
            }
        }

        if (count($aCritQueries) == 0) {
            return PEAR::raiseError(_kt("No search criteria were specified"));
        }

        return array($aCritQueries, $aCritParams, $aJoinSQL);
    }
    // }}}

    // {{{ criteriaSetToSQL
    /**
     * Converts a criteria set to the SQL joins, where clause, and
     * parameters necessary to ensure that the criteria listed restrict
     * the documents returned to those that match the criteria.
     *
     * Perhaps poorly called recursively to handle criteria that involve
     * subgroups to allow infinitely nested criteria.
     *
     * Returns a list of the following elements:
     *      - String representing the where clause
     *      - Array of parameters that go with the where clause
     *      - String with the SQL necessary to join with the tables in the
     *        where clause
     */
    function criteriaSetToSQL($aCriteriaSet, $iRecurseLevel = 0) {
        $aJoinSQL = array();
        $aSearchStrings = array();
        $aParams = array();
        /*
         * XXX: We unnecessarily force the base criteria to have
         * subgroups at the top level, even though we most often only
         * have a single "subgroup".
         */
        foreach ($aCriteriaSet["subgroup"] as $k => $aOneCriteriaSet) {
            /*
             * Each subgroup will either have values or it will have
             * subgroups.  They can't be mixed.
             */
            $aValues = KTUtil::arrayGet($aOneCriteriaSet, "values");
            $aSubgroup = KTUtil::arrayGet($aOneCriteriaSet, "subgroup");
            if (!empty($aValues)) {
		$res = KTSearchUtil::_oneCriteriaSetToSQL($aOneCriteriaSet["values"]);
		if(PEAR::isError($res)) {
		    return $res;
		}
                list($aThisCritQueries, $aThisParams, $aThisJoinSQL) = $res;
                $aJoinSQL = kt_array_merge($aJoinSQL, $aThisJoinSQL);
                $aParams = kt_array_merge($aParams, $aThisParams);
                $tabs = str_repeat("\t", ($iRecurseLevel + 2));
                $aSearchStrings[] = "\n$tabs(\n$tabs\t" . join("\n " . KTUtil::arrayGet($aOneCriteriaSet, 'join', "AND") . " ", $aThisCritQueries) . "\n$tabs)";
            } else if (!empty($aSubgroup)) {
                /*
                 * Recurse if we have a criteria set with subgroups.
                 * Recurselevel makes the tabs increase as we recurse so
                 * that the SQL statement is somewhat understandable.
                 */
                list($sThisSearchString, $aThisParams, $sThisJoinSQL) =
                    KTSearchUtil::criteriaSetToSQL($aOneCriteriaSet, $iRecurseLevel + 1);
                $aJoinSQL[] = $sThisJoinSQL;
                $aParams = kt_array_merge($aParams, $aThisParams);
                $aSearchStrings[] = $sThisSearchString;
            }
        }
        $aJoinSQL = array_unique($aJoinSQL);
        $sJoinSQL = join(" ", $aJoinSQL);
        $tabs = str_repeat("\t", $iRecurseLevel + 1);
        $sSearchString = "\n$tabs(" . join("\n$tabs\t" . $aCriteriaSet['join'] . " ", $aSearchStrings) .  "\n$tabs)";
        return array($sSearchString, $aParams, $sJoinSQL);
    }
    // }}}

    // {{{ permissionToSQL
    /**
     * Generates the necessary joins and where clause and parameters to
     * ensure that all the documents returns are accessible to the user
     * given for the permission listed.
     *
     * Returns a list of the following elements:
     *      - String representing the where clause
     *      - Array of parameters that go with the where clause
     *      - String with the SQL necessary to join with the tables in the
     *        where clause
     */
    function permissionToSQL($oUser, $sPermissionName, $sItemTableName = "D") {
        if (is_null($oUser)) {
            return array("", array(), "");
        }
        if (is_null($sPermissionName)) {
            $sPermissionName = 'ktcore.permissions.read';
        }
        $oPermission =& KTPermission::getByName($sPermissionName);
        $sPermissionLookupsTable = KTUtil::getTableName('permission_lookups');
        $sPermissionLookupAssignmentsTable = KTUtil::getTableName('permission_lookup_assignments');
        $sPermissionDescriptorsTable = KTUtil::getTableName('permission_descriptors');
        $sJoinSQL = "
            INNER JOIN $sPermissionLookupsTable AS PL ON $sItemTableName.permission_lookup_id = PL.id
            INNER JOIN $sPermissionLookupAssignmentsTable AS PLA ON PL.id = PLA.permission_lookup_id AND PLA.permission_id = ?
            ";
        $aPermissionDescriptors = KTPermissionUtil::getPermissionDescriptorsForUser($oUser);
        if (count($aPermissionDescriptors) === 0) {
            return PEAR::raiseError(_kt('You have no permissions'));
        }
        $sPermissionDescriptors = DBUtil::paramArray($aPermissionDescriptors);
        $sSQLString = "PLA.permission_descriptor_id IN ($sPermissionDescriptors)";
        $aParams = array($oPermission->getId());
        $aParams = kt_array_merge($aParams, $aPermissionDescriptors);
        return array($sSQLString, $aParams, $sJoinSQL);
    }
    // }}}

    // {{{ criteriaToLegacyQuery
    /**
     * Converts a criteria set into a SQL query that returns all the
     * information that the legacy search results page
     * (PatternBrowsableSearchResults) requires for documents that
     * fulfil the criteria.
     *
     * Like criteriaToQuery, a list with the following elements is
     * returned:
     *      - String containing the parameterised SQL query
     *      - Array containing the parameters for the SQL query
     */
    function criteriaToLegacyQuery($aCriteriaSet, $oUser, $sPermissionName) {
        global $default;
        $aOptions = array(
            'select' => "F.name AS folder_name, F.id AS folder_id, D.id AS document_id, D.name AS document_name, D.filename AS file_name, 'View' AS view",
            'join' => "INNER JOIN $default->folders_table AS F ON D.folder_id = F.id",
        );
        return KTSearchUtil::criteriaToQuery($aCriteriaSet, $oUser, $sPermissionName, $aOptions);
    }
    // }}}

    // {{{ criteriaToQuery
    /**
     * Converts a criteria set into a SQL query that (by default)
     * returns the ids of documents that fulfil the criteria.
     *
     * $aOptions is a dictionary that can contain:
     *      - select - a string that contains the list of columns
     *        selected in the query
     *      - join - a string that contains join conditions to satisfy
     *        the select string passed or limit the documents included
     *
     * A list with the following elements is returned:
     *      - String containing the parameterised SQL query
     *      - Array containing the parameters for the SQL query
     */
    function criteriaToQuery($aCriteriaSet, $oUser, $sPermissionName, $aOptions = null) {
        global $default;
        $sSelect = KTUtil::arrayGet($aOptions, 'select', 'D.id AS document_id');
        $sInitialJoin = KTUtil::arrayGet($aOptions, 'join', '');
        if (is_array($sInitialJoin)) {
            $aInitialJoinParams = $sInitialJoin[1];
            $sInitialJoin = $sInitialJoin[0];
        }

	$res = KTSearchUtil::criteriaSetToSQL($aCriteriaSet);
	if(PEAR::isError($res)) return $res;
        list($sSQLSearchString, $aCritParams, $sCritJoinSQL) = $res;

        $sToSearch = KTUtil::arrayGet($aOrigReq, 'fToSearch', 'Live'); // actually never present in this version.

        $res = KTSearchUtil::permissionToSQL($oUser, $sPermissionName);
        if (PEAR::isError($res)) {        // only occurs if the group has no permissions.
            return $res;
        } else {
            list ($sPermissionString, $aPermissionParams, $sPermissionJoin) = $res;
        }
        
        /*
         * This is to overcome the problem where $sPermissionString (or
         * even $sSQLSearchString) is empty, leading to leading or
         * trailing ANDs.
         */
        $aPotentialWhere = array($sPermissionString, 'SL.name = ?', "($sSQLSearchString)");
        $aWhere = array();
        foreach ($aPotentialWhere as $sWhere) {
            if (empty($sWhere)) {
                continue;
            }
            if ($sWhere == "()") {
                continue;
            }
            $aWhere[] = $sWhere;
        }
        $sWhere = "";
        if ($aWhere) {
            $sWhere = "\tWHERE " . join(" AND ", $aWhere);
        }       

        //$sQuery = DBUtil::compactQuery("
        $sQuery = sprintf("
    SELECT
        %s
    FROM
        %s AS D
        LEFT JOIN %s AS DM ON D.metadata_version_id = DM.id
        LEFT JOIN %s AS DC ON DM.content_version_id = DC.id
        INNER JOIN $default->status_table AS SL on D.status_id=SL.id
        %s
        %s
        %s
        %s", $sSelect, KTUtil::getTableName('documents'),
        KTUtil::getTableName('document_metadata_version'),
        KTUtil::getTableName('document_content_version'),
        $sInitialJoin,
        $sCritJoinSQL,
        $sPermissionJoin,
        $sWhere
        );
    // GROUP BY D.id

        $aParams = array();
        $aParams = kt_array_merge($aParams, $aInitialJoinParams);
        $aParams = kt_array_merge($aParams, $aPermissionParams);
        $aParams[] = $sToSearch;
        $aParams = kt_array_merge($aParams, $aCritParams);

        return array($sQuery, $aParams);
    }
    // }}}

    // {{{ testConditionOnDocument
    /**
     * Checks whether a condition (saved search) is fulfilled by the
     * given document.
     *
     * For example, a condition may require a specific value in a
     * metadata field.
     *
     * Returns either true or false (or a PEAR Error object)
     */
    function testConditionOnDocument($oSearch, $oDocument) {
        $oSearch =& KTUtil::getObject('KTSavedSearch', $oSearch);
        $iDocumentId = KTUtil::getId($oDocument);

        /*
         * Make a new criteria set, an AND of the existing criteria set
         * and the sql statement requiring that D.id be the document id
         * given to us.
         */
        $aCriteriaSet = array(
            "join" => "AND",
            "subgroup" => array(
                $oSearch->getSearch(),
                array(
                    "join" => "AND",
                    "values" => array(
                        array(
                            "sql" => array("D.id = ?", array($iDocumentId)),
                        ),
                    ),
                ),
            ),
        );
        $aOptions = array('select' => 'COUNT(DISTINCT(D.id)) AS cnt');
        $aQuery = KTSearchUtil::criteriaToQuery($aCriteriaSet, null, null, $aOptions);
        if (PEAR::isError($aQuery)) {          // caused by no permissions being set.
            return false; 
        }
        $cnt = DBUtil::getOneResultKey($aQuery, 'cnt');
        if (PEAR::isError($cnt)) {
            return $cnt;
        }
        if (is_null($cnt)) {
            return false;
        }
        if (!is_numeric($cnt)) {
            return PEAR::raiseError(_kt("Non-integer returned when looking for count"));
        }
        return $cnt > 0;
    }
    // }}}
}

