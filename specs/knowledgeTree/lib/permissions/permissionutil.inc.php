<?php

/**
 * $Id: permissionutil.inc.php 6005 2006-09-28 14:21:40Z bshuttle $
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

require_once(KT_LIB_DIR . "/documentmanagement/Document.inc");
require_once(KT_LIB_DIR . "/foldermanagement/Folder.inc");
require_once(KT_LIB_DIR . "/permissions/permission.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionassignment.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissiondescriptor.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionlookup.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionlookupassignment.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionobject.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissiondynamiccondition.inc.php");
require_once(KT_LIB_DIR . "/groups/GroupUtil.php");
require_once(KT_LIB_DIR . "/roles/roleallocation.inc.php");
require_once(KT_LIB_DIR . "/roles/documentroleallocation.inc.php");

require_once(KT_LIB_DIR . "/workflow/workflowutil.inc.php");
require_once(KT_LIB_DIR . "/workflow/workflowstatepermissionsassignment.inc.php");

class KTPermissionUtil {
    // {{{ generateDescriptor
    /**
     * Generate a unique textual representation of a specific collection
     * of users/groups/roles described by a dictionary.
     *
     * This function _must_ always generate the same descriptor for a
     * given collection of users/groups/roles, no matter the order of
     * the keys or the order of the ids in the values of the collection.
     */
    function generateDescriptor ($aAllowed) {
        $aAllowedSort = array();
        // PHP5: clone
        $aTmp = $aAllowed;
        ksort($aTmp);
        $sOutput = "";
        foreach ($aTmp as $k => $v) {
            if (empty($v)) {
                continue;
            }
            $v = array_unique($v);
            $sOutput .= "$k(";
            sort($v);
            $sOutput .= join(",", $v);
            $sOutput .= ")";
        }

        return $sOutput;
    }
    // }}}

    // {{{ getOrCreateDescriptor
    /**
     * For a given collection of users/groups/roles, get the permission
     * descriptor object that describes that exact collection, creating
     * such an object if it does not already exist.
     */
    function getOrCreateDescriptor ($aAllowed) {
        $sDescriptor = KTPermissionUtil::generateDescriptor($aAllowed);
        $oDescriptor =& KTPermissionDescriptor::getByDescriptor(md5($sDescriptor));
        if (PEAR::isError($oDescriptor)) {
            $oOriginalDescriptor = $oDescriptor;
            
            $oDescriptor =& KTPermissionDescriptor::createFromArray(array(
                "descriptortext" => $sDescriptor,
            ));
            if (PEAR::isError($oDescriptor)) {
                print '<pre>';
                print_r($aAllowed);
                print "-----------\n";
                print "getOrCreateDescriptor get error (should be 'not found'):";
                print "-----------\n";
                print_r($oOriginalDescriptor);
                print "-----------\n";
                print "getOrCreateDescriptor create error (should not happen):";
                print "-----------\n";
                print_r($oDescriptor);
                print '</pre>';
                exit(0);
            }
            $oDescriptor->saveAllowed($aAllowed);
            
        }
        return $oDescriptor;
    }
    // }}}

    // {{{ getAllowedForDescriptor
    function getAllowedForDescriptor($oDescriptor) {
        $oDescriptor =& KTUtil::getObject('KTPermissionDescriptor', $oDescriptor);
        return $oDescriptor->getAllowed();
    }
    // }}}

    // {{{ getOrCreateAssignment
    /**
     * For a given permission object, get the assignment object for the
     * given permission, or create one if there isn't one already.
     *
     * This assignment object describes the group of users/groups/roles
     * that have the given permission.  If one is created, it is created
     * empty.
     */
    function getOrCreateAssignment ($sPermission, $iObjectID) {
        if (is_string($sPermission)) {
            $oPermission =& KTPermission::getByName($sPermission);
        } else {
            $oPermission =& $sPermission;
        }
        if (is_numeric($iObjectID)) {
            $oObject =& KTPermissionObject::get($iObjectID);
        } else {
            $oObject =& $iObjectID;
        }
        $oPA = KTPermissionAssignment::getByPermissionAndObject($oPermission, $oObject);
        if (PEAR::isError($oPA)) {
            $oPA = KTPermissionAssignment::createFromArray(array(
                'permissionid' => $oPermission->getID(),
                'permissionobjectid' => $oObject->getID(),
            ));
        }
        return $oPA;
    }
    // }}}

    // {{{ setPermissionForID
    /**
     * For a given permission object, set the given group of
     * users/groups/roles that have a given permission, removing any
     * previous assignment.
     */
    function setPermissionForID($sPermission, $iObjectID, $aAllowed) {
        $oPermissionAssignment =& KTPermissionUtil::getOrCreateAssignment($sPermission, $iObjectID);
        $oDescriptor =& KTPermissionUtil::getOrCreateDescriptor($aAllowed);
        $oPermissionAssignment->setPermissionDescriptorID($oDescriptor->getID());
        $res = $oPermissionAssignment->update();
        return $res;
    }
    // }}}

    // {{{ updatePermissionLookupForState
    function updatePermissionLookupForState($oState) {
        $aDocuments = Document::getByState($oState);
        foreach ($aDocuments as $oDocument) {
            KTPermissionUtil::updatePermissionLookup($oDocument);
        }
    }
    // }}}

    // {{{ updatePermissionLookupForPO
    /**
     * Updates permission lookups for all objects of a certain
     * permission object.
     *
     * It may be that you don't have or want to have the root item for a
     * permission object that you do have and have updates - then use
     * this.
     */
    function updatePermissionLookupForPO($oPO) {
        $sWhere = 'permission_object_id = ?';
        $aParams = array($oPO->getID());
        $aFolders =& Folder::getList(array($sWhere, $aParams));
        if (!PEAR::isError($aFolders)) { 
            foreach ($aFolders as $oFolder) {
                KTPermissionUtil::updatePermissionLookup($oFolder);
            }
        }
        $aDocuments =& Document::getList(array($sWhere, $aParams));
        if (!PEAR::isError($aDocuments)) {
            foreach ($aDocuments as $oDocument) {
                KTPermissionUtil::updatePermissionLookup($oDocument);
            }
        }
    }
    // }}}

    // {{{ updatePermissionLookupRecursive
    /**
     * Updates permission lookups for this folder and any ancestors, but
     * only if they use the same permission object.
     *
     * To be used any time a folder permission object is changed.
     */
    function updatePermissionLookupRecursive(&$oDocumentOrFolder) {
        if (is_a($oDocumentOrFolder, 'Document')) {
            // XXX: metadata versions may need attention here
            KTPermissionUtil::updatePermissionLookup($oDocumentOrFolder);
            return;
        }

        $iFolderID = $oDocumentOrFolder->getID();
        $sFolderIDs = Folder::generateFolderIDs($iFolderID);
        $sFolderIDs .= '%';

        $sWhere = 'permission_object_id = ? AND parent_folder_ids LIKE ?';
        $aParams = array($oDocumentOrFolder->getPermissionObjectID(), $sFolderIDs);

        $aFolders =& Folder::getList(array($sWhere, $aParams));
        foreach ($aFolders as $oFolder) {
            KTPermissionUtil::updatePermissionLookup($oFolder);
        }

        $aDocuments =& Document::getList(array($sWhere, $aParams));
        foreach ($aDocuments as $oDocument) {
            KTPermissionUtil::updatePermissionLookup($oDocument);
        }
    }
    // }}}

    // {{{ updatePermissionLookup
    /**
     * Update's the permission lookup on one folder or document,
     * non-recursively.
     */
    function updatePermissionLookup(&$oFolderOrDocument) {
        if (!is_a($oFolderOrDocument, 'Folder')) {
            if (!is_a($oFolderOrDocument, 'Document')) {
                if (!is_a($oFolderOrDocument, 'KTDocumentCore')) {
                    return ; // we occasionally get handed a PEAR::raiseError.  Just ignore it.
                }
            }
        }
        
        $oChannel =& KTPermissionChannel::getSingleton();
        if (is_a($oFolderOrDocument, 'Folder')) {
            $msg = sprintf("Updating folder %s", join("/", $oFolderOrDocument->getPathArray()));
        } else {
            if (is_a($oFolderOrDocument, 'Document')) {
                $msg = sprintf("Updating document %s", $oFolderOrDocument->getName());
            } else {
                $msg = sprintf("Updating document %d", $oFolderOrDocument->getId());
            }
        }
        $oChannel->sendMessage(new KTPermissionGenericMessage($msg));
        //var_dump($msg);            
        $iPermissionObjectId = $oFolderOrDocument->getPermissionObjectID();
        if (empty($iPermissionObjectId)) {
            return;
        }
        $oPO = KTPermissionObject::get($iPermissionObjectId);
        $aPAs = KTPermissionAssignment::getByObjectMulti($oPO);
        $aMapPermAllowed = array();
        foreach ($aPAs as $oPA) {
            $oPD = KTPermissionDescriptor::get($oPA->getPermissionDescriptorID());
            $aGroupIDs = $oPD->getGroups();
            $aUserIDs = array();
            $aRoleIDs = $oPD->getRoles();
            $aAllowed = array(
                "group" => $aGroupIDs,
                "user" => $aUserIDs,
                "role" => $aRoleIDs,
            );
            $aMapPermAllowed[$oPA->getPermissionID()] = $aAllowed;
        }

        if (!is_a($oFolderOrDocument, 'Folder')) {
            $aDynamicConditions = KTPermissionDynamicCondition::getByPermissionObject($oPO);
            if (!PEAR::isError($aDynamicConditions)) {
                foreach ($aDynamicConditions as $oDynamicCondition) {
                    $iConditionId = $oDynamicCondition->getConditionId();
                    if (KTSearchUtil::testConditionOnDocument($iConditionId, $oFolderOrDocument)) {
                        $iGroupId = $oDynamicCondition->getGroupId();
                        $aPermissionIds = $oDynamicCondition->getAssignment();
                        foreach ($aPermissionIds as $iPermissionId) {
                            $aCurrentAllowed = KTUtil::arrayGet($aMapPermAllowed, $iPermissionId, array());
                            $aCurrentAllowed["group"][] = $iGroupId;
                            $aMapPermAllowed[$iPermissionId] = $aCurrentAllowed;
                        }
                    }
                }
            }
        }

        if (!is_a($oFolderOrDocument, 'Folder')) {
            $oState = KTWorkflowUtil::getWorkflowStateForDocument($oFolderOrDocument);
            if (!(PEAR::isError($oState) || is_null($oState) || ($oState == false))) {
                $aWorkflowStatePermissionAssignments = KTWorkflowStatePermissionAssignment::getByState($oState);
                foreach ($aWorkflowStatePermissionAssignments as $oAssignment) {
                    $iPermissionId = $oAssignment->getPermissionId();
                    $iPermissionDescriptorId = $oAssignment->getDescriptorId();
                    
                    $oPD = KTPermissionDescriptor::get($iPermissionDescriptorId);
                    $aGroupIDs = $oPD->getGroups();
                    $aUserIDs = array();
                    $aRoleIDs = $oPD->getRoles();
                    $aAllowed = array(
                        "group" => $aGroupIDs,
                        "user" => $aUserIDs,
                        "role" => $aRoleIDs,
                    );
                    $aMapPermAllowed[$iPermissionId] = $aAllowed;
                }
            }
        }

        // if we have roles:  nearest folder.
        $iRoleSourceFolder = null;
        if (is_a($oFolderOrDocument, 'KTDocumentCore') || is_a($oFolderOrDocument, 'Document')) { $iRoleSourceFolder = $oFolderOrDocument->getFolderID(); }
        else { $iRoleSourceFolder = $oFolderOrDocument->getId(); }
            
        // very minor perf win:  map role_id (in context) to PD.
        $_roleCache = array(); 
            
        foreach ($aMapPermAllowed as $iPermissionId => $aAllowed) {
            $aAfterRoles = array();
            if (array_key_exists('role', $aAllowed)) {
                foreach ($aAllowed['role'] as $k => $iRoleId) {
                    // store the PD <-> RoleId map
                    
                    // special-case "all" or "authenticated".
                    if (($iRoleId == -3) || ($iRoleId == -4)) {
                        $aAfterRoles[] = $iRoleId;
                        continue;
                    }
                    if (!array_key_exists($iRoleId, $_roleCache)) {
                        $oRoleAllocation = null;
                        if (is_a($oFolderOrDocument, 'KTDocumentCore') || is_a($oFolderOrDocument, 'Document')) {
                            $oRoleAllocation =& DocumentRoleAllocation::getAllocationsForDocumentAndRole($oFolderOrDocument->getId(), $iRoleId);
                            if (PEAR::isError($oRoleAllocation)) { $oRoleAllocation = null; }
                        }
                        // if that's null - not set _on_ the document, then
                        if (is_null($oRoleAllocation)) {
                            $oRoleAllocation =& RoleAllocation::getAllocationsForFolderAndRole($iRoleSourceFolder, $iRoleId);
                        }
                        $_roleCache[$iRoleId] = $oRoleAllocation;
                    }
                    // roles are _not_ always assigned (can be null at root)
                    if (!is_null($_roleCache[$iRoleId])) {
                        $aMapPermAllowed[$iPermissionId]['user'] = kt_array_merge($aMapPermAllowed[$iPermissionId]['user'], $_roleCache[$iRoleId]->getUserIds());
                        $aMapPermAllowed[$iPermissionId]['group'] = kt_array_merge($aMapPermAllowed[$iPermissionId]['group'], $_roleCache[$iRoleId]->getGroupIds());
                        // naturally, roles cannot be assigned roles, or madness follows.
                    }

                    unset($aAllowed['role'][$k]);
                }
                
            }

            unset($aMapPermAllowed[$iPermissionId]['role']);            
            if (!empty($aAfterRoles)) { 
                $aMapPermAllowed[$iPermissionId]['role'] = $aAfterRoles;
            }
        }
        
        /*
        print '<pre>';
        print '=======' . $oFolderOrDocument->getName();
        print '<br />';
        var_dump($aMapPermAllowed);
        print '</pre>';
        */
        

        $aMapPermDesc = array();
        foreach ($aMapPermAllowed as $iPermissionId => $aAllowed) {
            $oLookupPD = KTPermissionUtil::getOrCreateDescriptor($aAllowed);
            $aMapPermDesc[$iPermissionId] = $oLookupPD->getID();
        }

        $oPL = KTPermissionLookupAssignment::findOrCreateLookupByPermissionDescriptorMap($aMapPermDesc);
        $oFolderOrDocument->setPermissionLookupID($oPL->getID());
        $oFolderOrDocument->update();
    }
    // }}}

    // {{{ userHasPermissionOnItem
    /**
     * Check whether a given user has the given permission on the given
     * object, by virtue of a direct or indirect assignment due to the
     * user, its groups, its roles, or the roles assigned to its groups,
     * and so forth.
     */
    function userHasPermissionOnItem($oUser, $oPermission, $oFolderOrDocument) {
        if (is_string($oPermission)) {
             $oPermission =& KTPermission::getByName($oPermission);
        }
        if (PEAR::isError($oPermission)) {
            return false;
        }
        $oPL = KTPermissionLookup::get($oFolderOrDocument->getPermissionLookupID());
        $oPLA = KTPermissionLookupAssignment::getByPermissionAndLookup($oPermission, $oPL);
        if (PEAR::isError($oPLA)) {
            //print $oPL->getID();
            return false;
        }
        $oPD = KTPermissionDescriptor::get($oPLA->getPermissionDescriptorID());
        
        $aGroups = GroupUtil::listGroupsForUserExpand($oUser);
        if ($oPD->hasRoles(array(-3))) { return true; } // everyone has access.
        else if ($oPD->hasUsers(array($oUser))) { return true; }
        else if ($oPD->hasGroups($aGroups)) { return true; }
        else if ($oPD->hasRoles(array(-4)) && !$oUser->isAnonymous()) { return true; }
            
        return false;
    }
    // }}}

    // {{{ findRootObjectForPermissionObject
    /**
     * Given a specific permission object, find the object (Folder or
     * Document) that is the root of that permission object - the one
     * object that has this permission object, but its parent has a
     * different one.
     */
    function findRootObjectForPermissionObject($oPO) {
        global $default;
        /*
         * If there are any folders with the permission object, then it
         * is set by _a_ folder.  All folders found will have a common
         * ancestor folder, which will be the one with:
         *
         * Potential hack: The shortest parent_folder_ids
         *
         * Potential non-hack: Choose random folder, check parent for
         * permission object recurringly until it changes.  Last success
         * is the ancestor parent...
         */
        $sQuery = "SELECT id FROM $default->folders_table WHERE permission_object_id = ? ORDER BY LENGTH(parent_folder_ids) LIMIT 1";
        $aParams = array($oPO->getID());
        $res = DBUtil::getOneResultKey(array($sQuery, $aParams), 'id');
        if (!is_null($res)) {
            return Folder::get($res);
        }
        $sQuery = "SELECT id FROM $default->documents_table WHERE permission_object_id = ? LIMIT 1";
        $aParams = array($oPO->getID());
        $res = DBUtil::getOneResultKey(array($sQuery, $aParams), 'id');
        if (!is_null($res)) {
            return Document::get($res);
        }
        return false;
    }
    // }}}

    // {{{ copyPermissionObject
    /**
     * Copy the object's parents permission object details, in
     * preparation for the object to have different permissions from its
     * parent.
     */
    function copyPermissionObject(&$oDocumentOrFolder) {
        global $default;
        $oOrigPO = KTPermissionObject::get($oDocumentOrFolder->getPermissionObjectID());
        $aOrigPAs =& KTPermissionAssignment::getByObjectMulti($oOrigPO);
        $oNewPO = KTPermissionObject::createFromArray(array());
        foreach ($aOrigPAs as $oOrigPA) {
            $oNewPA = KTPermissionAssignment::createFromArray(array(
                'permissionid' => $oOrigPA->getPermissionID(),
                'permissionobjectid' => $oNewPO->getID(),
                'permissiondescriptorid' => $oOrigPA->getPermissionDescriptorID(),
            ));
        }
        $oDocumentOrFolder->setPermissionObjectID($oNewPO->getID());
        $oDocumentOrFolder->update();

        // copy any dynamic conditions
        $aDPO = KTPermissionDynamicCondition::getByPermissionObject($oOrigPO);
        foreach ($aDPO as $oOrigDC) {
            $oNewDC = KTPermissionDynamicCondition::createFromArray(array(
                'permissionobjectid' => $oNewPO->getId(),
                'groupid' => $oOrigDC->getGroupId(),
                'conditionid' => $oOrigDC->getConditionId(),
            ));
            
            $oNewDC->saveAssignment($oOrigDC->getAssignment());
        }

        if (!is_a($oDocumentOrFolder, 'Folder')) {
            KTPermissionUtil::updatePermissionLookup($oDocumentOrFolder);
            return;
        }

        // For a folder - update permission object for all folders and
        // documents under this current folder if they're using the old
        // permission object id.  If they are, then they're getting the
        // permission object via this folder.  If they are not, then
        // they have their own permission object management, and thus
        // this folder has no effect on their permissions.

        $iFolderID = $oDocumentOrFolder->getID();
        $sFolderIDs = Folder::generateFolderIDs($iFolderID);
        $sFolderIDs .= '%';
        $sQuery = "UPDATE $default->folders_table SET
            permission_object_id = ? WHERE permission_object_id = ? AND
            parent_folder_ids LIKE ?";
        $aParams = array($oNewPO->getID(), $oOrigPO->getID(), $sFolderIDs);
        DBUtil::runQuery(array($sQuery, $aParams));

        Folder::clearAllCaches();

        $sQuery = "UPDATE $default->documents_table SET
            permission_object_id = ? WHERE permission_object_id = ? AND
            parent_folder_ids LIKE ?";
        DBUtil::runQuery(array($sQuery, $aParams));

        Document::clearAllCaches();

        // All objects using this PO must be new and must need their
        // lookups updated...
        KTPermissionUtil::updatePermissionLookupForPO($oNewPO);
    }
    // }}}

    // {{{ isPermissionOwner
    /**
     * Verify if the given object is the root of the permission object
     * it has assigned to it - in other words, if its parent has a
     * different permission object than it.
     */
    function isPermissionOwner(&$oDocumentOrFolder) {
        $oPermissionObject = KTPermissionObject::get($oDocumentOrFolder->getPermissionObjectID());
        $oParentObject = KTPermissionUtil::findRootObjectForPermissionObject($oPermissionObject);

        // Documents might be permission owner, but then they'd be the
        // only users of that permission object.
        if (is_a($oParentObject, 'Document')) {
            return true;
        }

        // If you're a document and your permission owner isn't a
        // document, that means it's some ancestor, and thus not you.
        if (is_a($oDocumentOrFolder, 'Document')) {
            return false;
        }

        // We're dealing with folders, so just compare IDs...
        if ($oDocumentOrFolder->getID() == $oParentObject->getID()) {
            return true;
        }
        return false;
    }
    // }}}

    // {{{ inheritPermissionObject
    /**
     * Inherits permission object from parent, throwing away our own
     * permission object.
     */
    function inheritPermissionObject(&$oDocumentOrFolder, $aOptions = null) {
        global $default;
        $bEvenIfNotOwner = KTUtil::arrayGet($aOptions, 'evenifnotowner');
        if (empty($bEvenIfNotOwner) && !KTPermissionUtil::isPermissionOwner($oDocumentOrFolder)) {
            return PEAR::raiseError(_kt("Document or Folder doesn't own its permission object"));
        }
        $oOrigPO =& KTPermissionObject::get($oDocumentOrFolder->getPermissionObjectID());
        $oFolder =& Folder::get($oDocumentOrFolder->getParentID());
        $iNewPOID = $oFolder->getPermissionObjectID();
        $oNewPO =& KTPermissionObject::get($iNewPOID);

        
        $oDocumentOrFolder->setPermissionObjectID($iNewPOID);
        $oDocumentOrFolder->update();

        if (is_a($oDocumentOrFolder, 'Document')) {
            // If we're a document, no niggly children to worry about.
            KTPermissionUtil::updatePermissionLookup($oDocumentOrFolder);
            return;
        }
        
        $iFolderID = $oDocumentOrFolder->getID();
        $sFolderIDs = Folder::generateFolderIDs($iFolderID);
        $sFolderIDs .= '%';
        $sQuery = "UPDATE $default->folders_table SET
            permission_object_id = ? WHERE permission_object_id = ? AND
            parent_folder_ids LIKE ?";
        $aParams = array($oNewPO->getID(), $oOrigPO->getID(), $sFolderIDs);
        DBUtil::runQuery(array($sQuery, $aParams));

        Folder::clearAllCaches();

        $sQuery = "UPDATE $default->documents_table SET
            permission_object_id = ? WHERE permission_object_id = ? AND
            parent_folder_ids LIKE ?";
        DBUtil::runQuery(array($sQuery, $aParams));

        Document::clearAllCaches();

        KTPermissionUtil::updatePermissionLookupForPO($oNewPO);
    }
    // }}}

    // {{{ rebuildPermissionLookups
    function rebuildPermissionLookups($bEmptyOnly = true) {
        if ($bEmptyOnly) {
            $sTable = KTUtil::getTableName('folders');
            $sQuery = sprintf("SELECT id FROM %s WHERE permission_lookup_id IS NULL AND permission_object_id IS NOT NULL", $sTable);
        } else {
            $sTable = KTUtil::getTableName('folders');
            $sQuery = sprintf("SELECT id FROM %s WHERE permission_object_id IS NOT NULL", $sTable);
        }
        $aIds = DBUtil::getResultArrayKey($sQuery, 'id');
        foreach ($aIds as $iId) {
            $oFolder =& Folder::get($iId);
            KTPermissionUtil::updatePermissionLookup($oFolder);
        }

        if ($bEmptyOnly) {
            $sTable = KTUtil::getTableName('documents');
            $sQuery = sprintf("SELECT id FROM %s WHERE permission_lookup_id IS NULL", $sTable);
        } else {
            $sTable = KTUtil::getTableName('documents');
            $sQuery = sprintf("SELECT id FROM %s", $sTable);
        }
        $aIds = DBUtil::getResultArrayKey($sQuery, 'id');
        foreach ($aIds as $iId) {
            $oDocument =& Document::get($iId);
            KTPermissionUtil::updatePermissionLookup($oDocument);
        }

    }
    // }}}

    // {{{ getPermissionDescriptorsForUser
    function getPermissionDescriptorsForUser($oUser) {
        $aGroups = GroupUtil::listGroupsForUserExpand($oUser);
        $roles = array(-3); // everyone
        $aEveryoneDescriptors = array();
        $aAuthenticatedDescriptors = array();
        if (!$oUser->isAnonymous()) {
            // authenticated
            $roles[] = -4;
        }
        $aRoleDescriptors = KTPermissionDescriptor::getByRoles($roles, array('ids' => true));
        $aPermissionDescriptors = KTPermissionDescriptor::getByGroups($aGroups, array('ids' => true));
        $aUserDescriptors = KTPermissionDescriptor::getByUser($oUser, array('ids' => true));
        return kt_array_merge($aPermissionDescriptors, $aUserDescriptors, $aRoleDescriptors);
    }
    // }}}
}

class KTPermissionChannel {
    var $observers = array();

    function &getSingleton() {
        if (!KTUtil::arrayGet($GLOBALS, 'KT_PermissionChannel')) {
            $GLOBALS['KT_PermissionChannel'] = new KTPermissionChannel;
        }
        return $GLOBALS['KT_PermissionChannel'];
    }

    function sendMessage(&$msg) {
        foreach ($this->observers as $oObserver) {
            $oObserver->receiveMessage($msg);
        }
    }

    function addObserver(&$obs) {
        array_push($this->observers, $obs);
    }
}

class KTPermissionGenericMessage {
    function KTPermissionGenericMessage($sMessage) {
        $this->sMessage = $sMessage;
    }

    function getString() {
        return $this->sMessage;
    }
}



?>
