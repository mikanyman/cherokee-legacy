<?php

/**
 * $Id: KTPermissions.php 5984 2006-09-20 11:56:57Z bshuttle $
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

require_once(KT_LIB_DIR . '/actions/folderaction.inc.php');
require_once(KT_LIB_DIR . '/actions/documentaction.inc.php');
require_once(KT_LIB_DIR . '/widgets/fieldWidgets.php');

require_once(KT_LIB_DIR . "/foldermanagement/Folder.inc");
require_once(KT_LIB_DIR . "/foldermanagement/foldertransaction.inc.php");

require_once(KT_LIB_DIR . "/groups/Group.inc");
require_once(KT_LIB_DIR . "/users/User.inc");
require_once(KT_LIB_DIR . "/roles/Role.inc");
require_once(KT_LIB_DIR . "/roles/roleallocation.inc.php");
require_once(KT_LIB_DIR . "/roles/documentroleallocation.inc.php");

require_once(KT_LIB_DIR . "/permissions/permission.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionobject.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionlookup.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionassignment.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissiondescriptor.inc.php");
require_once(KT_LIB_DIR . "/permissions/permissionutil.inc.php");

require_once(KT_LIB_DIR . '/workflow/workflowutil.inc.php');

class KTDocumentPermissionsAction extends KTDocumentAction {
    var $sName = 'ktcore.actions.document.permissions';
    var $_sEditShowPermission = "ktcore.permissions.security";
    var $_sShowPermission = "ktcore.permissions.security";
    var $_bAdminAlwaysAvailable = true;

    function getDisplayName() {
        return _kt('Permissions');
    }

    function do_main() {
        $this->oPage->setBreadcrumbDetails(_kt("Document Permissions"));
        $oTemplate = $this->oValidator->validateTemplate("ktcore/document/document_permissions");
		
        $oPL = KTPermissionLookup::get($this->oDocument->getPermissionLookupID());
        $aPermissions = KTPermission::getList();
        $aMapPermissionGroup = array();
        $aMapPermissionRole = array();	
		$aMapPermissionUser = array();	
		
		$aAllGroups = Group::getList();   // probably small enough
		$aAllRoles = Role::getList();     // probably small enough.
		// users are _not_ fetched this way.
		
		$aActiveGroups = array();
		$aActiveUsers = array();
		$aActiveRoles = array();
		
        foreach ($aPermissions as $oPermission) {
            $oPLA = KTPermissionLookupAssignment::getByPermissionAndLookup($oPermission, $oPL);
            if (PEAR::isError($oPLA)) {
                continue;
            }
            $oDescriptor = KTPermissionDescriptor::get($oPLA->getPermissionDescriptorID());
            $iPermissionID = $oPermission->getID();
            $aIDs = $oDescriptor->getGroups();
            $aMapPermissionGroup[$iPermissionID] = array();
            foreach ($aIDs as $iID) {
                $aMapPermissionGroup[$iPermissionID][$iID] = true;
				$aActiveGroups[$iID] = true;
            }
            $aIds = $oDescriptor->getRoles();
            $aMapPermissionRole[$iPermissionID] = array();
            foreach ($aIds as $iId) {
                $aMapPermissionRole[$iPermissionID][$iId] = true;
				$aActiveRoles[$iId] = true;
            }		
			$aIds = $oDescriptor->getUsers();
            $aMapPermissionUser[$iPermissionID] = array();
            foreach ($aIds as $iId) {
                $aMapPermissionUser[$iPermissionID][$iId] = true;
				$aActiveUsers[$iId] = true;
            }		
        }
		
		// now we constitute the actual sets.
		$users = array();
		$groups = array();
		$roles = array(); // should _always_ be empty, barring a bug in permissions::updatePermissionLookup

		// this should be quite limited - direct role -> user assignment is typically rare.
		foreach ($aActiveUsers as $id => $marker) {
		    $oUser = User::get($id);
			$users[$oUser->getName()] = $oUser;
		}
		asort($users); // ascending, per convention.
		
		foreach ($aActiveGroups as $id => $marker) {
		    $oGroup = Group::get($id);
			$groups[$oGroup->getName()] = $oGroup;
		}
		asort($groups);
		
		foreach ($aActiveRoles as $id => $marker) {
		    $oRole = Role::get($id);
			$roles[$oRole->getName()] = $oRole;
		}
		asort($roles);
		
        $bEdit = KTPermissionUtil::userHasPermissionOnItem($this->oUser, $this->_sEditShowPermission, $this->oDocument);
		$sInherited = '';

        $aDynamicControls = array();
        $aWorkflowControls = array();

        // handle conditions
        $iPermissionObjectId = $this->oDocument->getPermissionObjectID();
        if (!empty($iPermissionObjectId)) {
            $oPO = KTPermissionObject::get($iPermissionObjectId);
            $aDynamicConditions = KTPermissionDynamicCondition::getByPermissionObject($oPO);
            if (!PEAR::isError($aDynamicConditions)) {
                foreach ($aDynamicConditions as $oDynamicCondition) {
                    $iConditionId = $oDynamicCondition->getConditionId();
                    if (KTSearchUtil::testConditionOnDocument($iConditionId, $this->oDocument)) {
                        $aPermissionIds = $oDynamicCondition->getAssignment();
                        foreach ($aPermissionIds as $iPermissionId) {
                            $aDynamicControls[$iPermissionId] = true;
                        }
                    }
                }
            }        
        }


        // indicate that workflow controls a given permission
        $oState = KTWorkflowUtil::getWorkflowStateForDocument($this->oDocument);
        if (!(PEAR::isError($oState) || is_null($oState) || ($oState == false))) {
            $aWorkflowStatePermissionAssignments = KTWorkflowStatePermissionAssignment::getByState($oState);
            foreach ($aWorkflowStatePermissionAssignments as $oAssignment) {
                $aWorkflowControls[$oAssignment->getPermissionId()] = true;
                unset($aDynamicControls[$oAssignment->getPermissionId()]);
            }
        }       


        $aTemplateData = array(
            "context" => $this,
            "permissions" => $aPermissions,
            "groups" => $groups,
			"users" => $users,
            "roles" => $roles,			
            "iDocumentID" => $_REQUEST['fDocumentID'],
            "aMapPermissionGroup" => $aMapPermissionGroup,
            "aMapPermissionRole" => $aMapPermissionRole,			
			"aMapPermissionUser" => $aMapPermissionUser,
            "edit" => $bEdit,
            "inherited" => $sInherited,
            'workflow_controls' => $aWorkflowControls,
            'conditions_control' => $aDynamicControls, 
        );
        return $oTemplate->render($aTemplateData);
    }

    function do_resolved_users() {
        $this->oPage->setBreadcrumbDetails(_kt("Permissions"));
        $oTemplate = $this->oValidator->validateTemplate("ktcore/document/resolved_permissions_user");

        $oPL = KTPermissionLookup::get($this->oDocument->getPermissionLookupID());
        $aPermissions = KTPermission::getList();
        $aMapPermissionGroup = array();
        $aMapPermissionRole = array();
        $aMapPermissionUser = array();

        $aUsers = User::getList();

        foreach ($aPermissions as $oPermission) {
            $oPLA = KTPermissionLookupAssignment::getByPermissionAndLookup($oPermission, $oPL);
            if (PEAR::isError($oPLA)) {
                continue;
            }
            $oDescriptor = KTPermissionDescriptor::get($oPLA->getPermissionDescriptorID());
            $iPermissionID = $oPermission->getID();
            $aMapPermissionGroup[$iPermissionID] = array();
            foreach ($aUsers as $oUser) {
                if (KTPermissionUtil::userHasPermissionOnItem($oUser, $oPermission, $this->oDocument)) {
                    $aMapPermissionUser[$iPermissionID][$oUser->getId()] = true;
                    $aActiveUsers[$oUser->getId()] = true;
                }
            }
        }

        // now we constitute the actual sets.
        $users = array();
        $groups = array();
        $roles = array(); // should _always_ be empty, barring a bug in permissions::updatePermissionLookup
        // this should be quite limited - direct role -> user assignment is typically rare.
        foreach ($aActiveUsers as $id => $marker) {
            $oUser = User::get($id);
            $users[$oUser->getName()] = $oUser;
        }
        asort($users); // ascending, per convention.

        $bEdit = false;
        $sInherited = '';


        $aDynamicControls = array();
        $aWorkflowControls = array();

        // handle conditions
        $iPermissionObjectId = $this->oDocument->getPermissionObjectID();
        if (!empty($iPermissionObjectId)) {
            $oPO = KTPermissionObject::get($iPermissionObjectId);
            $aDynamicConditions = KTPermissionDynamicCondition::getByPermissionObject($oPO);
            if (!PEAR::isError($aDynamicConditions)) {
                foreach ($aDynamicConditions as $oDynamicCondition) {
                    $iConditionId = $oDynamicCondition->getConditionId();
                    if (KTSearchUtil::testConditionOnDocument($iConditionId, $this->oDocument)) {
                        $aPermissionIds = $oDynamicCondition->getAssignment();
                        foreach ($aPermissionIds as $iPermissionId) {
                            $aDynamicControls[$iPermissionId] = true;
                        }
                    }
                }
            }        
        }


        // indicate that workflow controls a given permission
        $oState = KTWorkflowUtil::getWorkflowStateForDocument($this->oDocument);
        if (!(PEAR::isError($oState) || is_null($oState) || ($oState == false))) {
            $aWorkflowStatePermissionAssignments = KTWorkflowStatePermissionAssignment::getByState($oState);
            foreach ($aWorkflowStatePermissionAssignments as $oAssignment) {
                $aWorkflowControls[$oAssignment->getPermissionId()] = true;
                unset($aDynamicControls[$oAssignment->getPermissionId()]);
            }
        }       


        $aTemplateData = array(
            "context" => $this,
            "permissions" => $aPermissions,
            "groups" => $groups,
            "users" => $users,
            "roles" => $roles,
            "oDocument" => $this->oDocument,
            "aMapPermissionGroup" => $aMapPermissionGroup,
            "aMapPermissionRole" => $aMapPermissionRole,
            "aMapPermissionUser" => $aMapPermissionUser,
            "edit" => $bEdit,
            "inherited" => $sInherited,
            'workflow_controls' => $aWorkflowControls,
            'conditions_control' => $aDynamicControls,             
        );
        return $oTemplate->render($aTemplateData);
    }
}

class KTRoleAllocationPlugin extends KTFolderAction {
    var $sName = 'ktcore.actions.folder.roles';

    var $_sShowPermission = "ktcore.permissions.security";
    var $bAutomaticTransaction = true;
    var $_bAdminAlwaysAvailable = true;

    function getDisplayName() {
        return _kt('Allocate Roles');
    }

    function do_main() {
        $this->oPage->setTitle(_kt("Allocate Roles"));
        $this->oPage->setBreadcrumbDetails(_kt("Allocate Roles"));
        $oTemplating =& KTTemplating::getSingleton();
        $oTemplate = $oTemplating->loadTemplate("ktcore/folder/roles");
        
        // we need to have:
        //   - a list of roles
        //   - with their users / groups
        //   - and that allocation id
        $aRoles = array(); // stores data for display.
        
        $aRoleList = Role::getList('id > 0');
        foreach ($aRoleList as $oRole) {
            $iRoleId = $oRole->getId();
            $aRoles[$iRoleId] = array("name" => $oRole->getName());
            $oRoleAllocation = RoleAllocation::getAllocationsForFolderAndRole($this->oFolder->getId(), $iRoleId);
            
            $u = array();
            $g = array();
            $aid = null;
            $raid = null;
            if ($oRoleAllocation == null) {
                ; // nothing.
            } else {
                $raid = $oRoleAllocation->getId(); // real_alloc_id
                if ($oRoleAllocation->getFolderId() == $this->oFolder->getId()) {
                    $aid = $oRoleAllocation->getid(); // alloc_id
                }
                $oPermDesc = KTPermissionDescriptor::get($oRoleAllocation->getPermissionDescriptorId());
                if (!PEAR::isError($oPermDesc)) {
                    $aAllowed = $oPermDesc->getAllowed();
                    if (!empty($aAllowed['user'])) {
                        $u = $aAllowed['user'];
                    }
                    if (!empty($aAllowed['group'])) {
                        $g = $aAllowed['group'];
                    }
                }
            }
            $aRoles[$iRoleId]['users'] = $u;
            $aRoles[$iRoleId]['groups'] = $g;
            $aRoles[$iRoleId]['allocation_id'] = $aid;
            $aRoles[$iRoleId]['real_allocation_id'] = $raid;
        }
        
        /*
        print '<pre>';
        var_dump($aRoles);
        print '</pre>';
        */
        

        
        // FIXME this is test data.
        /*
        $aRoles = array(
            1 => array('name' => 'Manager', 'users' => array(1), 'groups' => array(1), 'allocation_id' => 1),
            2 => array('name' => 'Peasant', 'users' => array(1), 'groups' => array(), 'allocation_id' => 2),
            3 => array('name' => 'Inherited', 'users' => array(), 'groups' => array(1), 'allocation_id' => null),
        );
        */
        
        
        // final step.
        
        // map to users, groups.
        foreach ($aRoles as $key => $role) {
            $_users = array();
            foreach ($aRoles[$key]['users'] as $iUserId) {
                $oUser = User::get($iUserId);
                if (!(PEAR::isError($oUser) || ($oUser == false))) {
                    $_users[] = $oUser->getName();
                }
            }
			if (empty($_users)) {
			    $aRoles[$key]['users'] = '<span class="descriptiveText"> ' . _kt('no users') . '</span>'; 	
			} else {
                $aRoles[$key]['users'] = join(', ',$_users);
			}
            
            $_groups = array();
            foreach ($aRoles[$key]['groups'] as $iGroupId) {
                $oGroup = Group::get($iGroupId);
                if (!(PEAR::isError($oGroup) || ($oGroup == false))) {
                    $_groups[] = $oGroup->getName();
                }
            }
			if (empty($_groups)) {
			    $aRoles[$key]['groups'] = '<span class="descriptiveText"> ' . _kt('no groups') . '</span>'; 	
			} else {
			    $aRoles[$key]['groups'] = join(', ',$_groups);
			}
        }
        
        $aTemplateData = array(
            'context' => &$this,
            'roles' => $aRoles,
            'foldername' => $this->oFolder->getName(),
            'is_root' => ($this->oFolder->getId() == 1),
        );
        return $oTemplate->render($aTemplateData);
    }
    
    
    
    function do_overrideParent() {
        $role_id = KTUtil::arrayGet($_REQUEST, 'role_id', null);
        $oRole = Role::get($role_id);
        if (PEAR::isError($oRole)) {
            $this->errorRedirectToMain(_kt('Invalid Role.'));
        }
        // FIXME do we need to check that this role _isn't_ allocated?
        $oRoleAllocation = new RoleAllocation();
        $oRoleAllocation->setFolderId($this->oFolder->getId());
        $oRoleAllocation->setRoleId($role_id);
        
        // create a new permission descriptor. 
        // FIXME we really want to duplicate the original (if it exists)
        
        $aAllowed = array(); // no-op, for now.
		$this->startTransaction();
		
        $oRoleAllocation->setAllowed($aAllowed);
        $res = $oRoleAllocation->create();
		
		if (PEAR::isError($res) || ($res == false)) {
			$this->errorRedirectToMain(_kt('Failed to create the role allocation.') . print_r($res, true), sprintf('fFolderId=%d', $this->oFolder->getId()));
		}
        
        $oTransaction = KTFolderTransaction::createFromArray(array(
            'folderid' => $this->oFolder->getId(),
            'comment' => "Override parent allocation",
            'transactionNS' => 'ktcore.transactions.role_allocations_change',
            'userid' => $_SESSION['userID'],
            'ip' => Session::getClientIP(),
        ));
        $aOptions = array(
            'defaultmessage' => _kt('Error creating allocation'),
            'redirect_to' => array('main', sprintf('fFolderId=%d', $this->oFolder->getId())),
        );
        $this->oValidator->notErrorFalse($oTransaction, $aOptions);
        
		$this->renegeratePermissionsForRole($oRoleAllocation->getRoleId());

        $this->successRedirectToMain(_kt('Role allocation created.'), sprintf('fFolderId=%d', $this->oFolder->getId()));
    }
    
    function do_useParent() { 
        $role_id = KTUtil::arrayGet($_REQUEST, 'role_id', null);
        $oRole = Role::get($role_id);
        if (PEAR::isError($oRole)) {
            $this->errorRedirectToMain(_kt('Invalid Role.'), sprintf('fFolderId=%d',$this->oFolder->getId())); 
        }
        $role_id = $oRole->getId(); // numeric, for various testing purposes.
        
        $oRoleAllocation = RoleAllocation::getAllocationsForFolderAndRole($this->oFolder->getId(), $role_id);
        
        if ($oRoleAllocation->getFolderId() != $this->oFolder->getId()) {
            $this->errorRedirectToMain(_kt('Already using a different descriptor.'), sprintf('fFolderId=%d',$this->oFolder->getId())); 
        } 
        $this->startTransaction();
		
        $res = $oRoleAllocation->delete();
		
        if (PEAR::isError($res) || ($res == false)) {
            $this->errorRedirectToMain(_kt('Unable to change role allocation.') . print_r($res, true), sprintf('fFolderId=%d',$this->oFolder->getId())); 
            exit(0);
        }
		
        $oTransaction = KTFolderTransaction::createFromArray(array(
            'folderid' => $this->oFolder->getId(),
            'comment' => "Use parent allocation",
            'transactionNS' => 'ktcore.transactions.role_allocations_change',
            'userid' => $_SESSION['userID'],
            'ip' => Session::getClientIP(),
        ));
        $aOptions = array(
            'defaultmessage' => _kt('Problem assigning role to parent allocation'),
            'redirect_to' => array('main', sprintf('fFolderId=%d', $this->oFolder->getId())),
        );
        $this->oValidator->notErrorFalse($oTransaction, $aOptions);

		$this->renegeratePermissionsForRole($oRoleAllocation->getRoleId());

        $this->successRedirectToMain(_kt('Role now uses parent.'), sprintf('fFolderId=%d',$this->oFolder->getId())); 
    }
    
    function rootoverride($role_id) {
        if ($this->oFolder->getId() != 1) {
            $this->errorRedirectToMain(_kt("Cannot create allocation for non-root locations."));
        }
        
        $oRoleAllocation = new RoleAllocation();
        $oRoleAllocation->setFolderId($this->oFolder->getId());
        $oRoleAllocation->setRoleId($role_id);
        
        // create a new permission descriptor. 
        // FIXME we really want to duplicate the original (if it exists)
        
        $aAllowed = array(); // no-op, for now.
		$this->startTransaction();
		
        $oRoleAllocation->setAllowed($aAllowed);
        $res = $oRoleAllocation->create();
		
		if (PEAR::isError($res) || ($res == false)) {
			$this->errorRedirectToMain(_kt('Failed to create the role allocation.') . print_r($res, true), sprintf('fFolderId=%d', $this->oFolder->getId()));
		}
		
		return $oRoleAllocation;
    }
    
    function do_editRoleUsers() {

        $role_allocation_id = KTUtil::arrayGet($_REQUEST, 'alloc_id');
        if (($this->oFolder->getId() == 1) && is_null($role_allocation_id)) {
            $oRoleAllocation = $this->rootoverride($_REQUEST['role_id']);
        } else {
            $oRoleAllocation = RoleAllocation::get($role_allocation_id);
        }
        if ((PEAR::isError($oRoleAllocation)) || ($oRoleAllocation=== false)) {
            $this->errorRedirectToMain(_kt('No such role allocation.'), sprintf('fFolderId=%d',$this->oFolder->getId()));
        }
        
        
        $this->oPage->setBreadcrumbDetails(_kt('Manage Users for Role'));
        $this->oPage->setTitle(sprintf(_kt('Manage Users for Role')));
        
        $initJS = 'var optGroup = new OptionTransfer("userSelect","chosenUsers"); ' .
        'function startTrans() { var f = getElement("userroleform"); ' .
        ' optGroup.saveNewRightOptions("userFinal"); ' .
        ' optGroup.init(f); }; ' .
        ' addLoadEvent(startTrans); '; 
        $this->oPage->requireJSStandalone($initJS);
        
        $aInitialUsers = $oRoleAllocation->getUsers();
        $aAllUsers = User::getList();
        
        
        // FIXME this is massively non-performant for large userbases..
        $aRoleUsers = array();
        $aFreeUsers = array();
        foreach ($aInitialUsers as $oUser) {
            $aRoleUsers[$oUser->getId()] = $oUser;
        }
        foreach ($aAllUsers as $oUser) {
            if (!array_key_exists($oUser->getId(), $aRoleUsers)) {
                $aFreeUsers[$oUser->getId()] = $oUser;
            }
        }
        
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate = $oTemplating->loadTemplate("ktcore/folder/roles_manageusers");
        $aTemplateData = array(
            "context" => $this,
            "edit_rolealloc" => $oRoleAllocation,
			'unused_users' => $aFreeUsers,
			'role_users' => $aRoleUsers,
        );
        return $oTemplate->render($aTemplateData);
    }
	
    function do_editRoleGroups() { 

        $role_allocation_id = KTUtil::arrayGet($_REQUEST, 'alloc_id');
        if (($this->oFolder->getId() == 1) && is_null($role_allocation_id)) {
            $oRoleAllocation = $this->rootoverride($_REQUEST['role_id']);
        } else {
            $oRoleAllocation = RoleAllocation::get($role_allocation_id);
        }
        if ((PEAR::isError($oRoleAllocation)) || ($oRoleAllocation=== false)) {
            $this->errorRedirectToMain(_kt('No such role allocation.'), sprintf('fFolderId=%d',$this->oFolder->getId()));
        }
        
        $oRole = Role::get($oRoleAllocation->getRoleId());             
        $this->oPage->setBreadcrumbDetails(_kt('Manage Groups for Role'));
        $this->oPage->setTitle(sprintf(_kt('Manage Groups for Role "%s"'), $oRole->getName()));
        
        $initJS = 'var optGroup = new OptionTransfer("groupSelect","chosenGroups"); ' .
        'function startTrans() { var f = getElement("grouproleform"); ' .
        ' optGroup.saveNewRightOptions("groupFinal"); ' .
        ' optGroup.init(f); }; ' .
        ' addLoadEvent(startTrans); '; 
        $this->oPage->requireJSStandalone($initJS);
        
        $aInitialUsers = $oRoleAllocation->getGroups();
        $aAllUsers = Group::getList();
        
        
        // FIXME this is massively non-performant for large userbases..
        $aRoleUsers = array();
        $aFreeUsers = array();
        foreach ($aInitialUsers as $oGroup) {
            $aRoleUsers[$oGroup->getId()] = $oGroup;
        }
        foreach ($aAllUsers as $oGroup) {
            if (!array_key_exists($oGroup->getId(), $aRoleUsers)) {
                $aFreeUsers[$oGroup->getId()] = $oGroup;
            }
        }
        
   
        
        $oTemplating =& KTTemplating::getSingleton();        
        $oTemplate = $oTemplating->loadTemplate("ktcore/folder/roles_managegroups");
        $aTemplateData = array(
            "context" => $this,
            "edit_rolealloc" => $oRoleAllocation,
			'unused_groups' => $aFreeUsers,
			'role_groups' => $aRoleUsers,
			'rolename' => $oRole->getName(),
        );
        return $oTemplate->render($aTemplateData);
	}
    
    function do_setRoleUsers() {

        $role_allocation_id = KTUtil::arrayGet($_REQUEST, 'allocation_id');
        $oRoleAllocation = RoleAllocation::get($role_allocation_id);
        if ((PEAR::isError($oRoleAllocation)) || ($oRoleAllocation=== false)) {
            $this->errorRedirectToMain(_kt('No such role allocation.'), sprintf('fFolderId=%d',$this->oFolder->getId()));
        }
        $users = KTUtil::arrayGet($_REQUEST, 'userFinal', '');
		$aUserIds = explode(',', $users);

		// check that its not corrupt..
		$aFinalUserIds = array();
		foreach ($aUserIds as $iUserId) {
			$oUser =& User::get($iUserId);
			if (!(PEAR::isError($oUser) || ($oUser == false))) {
				$aFinalUserIds[] = $iUserId;
			}
		}
		if (empty($aFinalUserIds)) { $aFinalUserIds = null; }
		
		// hack straight in.
		$oPD = $oRoleAllocation->getPermissionDescriptor();
		$aAllowed = $oPD->getAllowed();		
		
		
		
		// now, grab the existing allowed and modify.

		$aAllowed['user'] = $aFinalUserIds;
		
		$oRoleAllocation->setAllowed($aAllowed);
		$res = $oRoleAllocation->update();
		
		if (PEAR::isError($res) || ($res == false)) {
			$this->errorRedirectToMain(_kt('Failed to change the role allocation.') . print_r($res, true), sprintf('fFolderId=%d', $this->oFolder->getId()));
		}
		
        $oTransaction = KTFolderTransaction::createFromArray(array(
            'folderid' => $this->oFolder->getId(),
            'comment' => "Set role users",
            'transactionNS' => 'ktcore.transactions.role_allocations_change',
            'userid' => $_SESSION['userID'],
            'ip' => Session::getClientIP(),
        ));
        $aOptions = array(
            'defaultmessage' => _kt('Problem assigning role users'),
            'redirect_to' => array('main', sprintf('fFolderId=%d', $this->oFolder->getId())),
        );
        $this->oValidator->notErrorFalse($oTransaction, $aOptions);

		$this->renegeratePermissionsForRole($oRoleAllocation->getRoleId());
		
        $this->successRedirectToMain(_kt('Allocation changed.'), sprintf('fFolderId=%d',$this->oFolder->getId())); 
    }
    
    function do_setRoleGroups() {
	    
        $role_allocation_id = KTUtil::arrayGet($_REQUEST, 'allocation_id');
        $oRoleAllocation = RoleAllocation::get($role_allocation_id);
        if ((PEAR::isError($oRoleAllocation)) || ($oRoleAllocation=== false)) {
            $this->errorRedirectToMain(_kt('No such role allocation.'), sprintf('fFolderId=%d',$this->oFolder->getId()));
        }
        $groups = KTUtil::arrayGet($_REQUEST, 'groupFinal', '');
		$aGroupIds = explode(',', $groups);

		// check that its not corrupt..
		$aFinalGroupIds = array();
		foreach ($aGroupIds as $iGroupId) {
			$oGroup =& Group::get($iGroupId);
			if (!(PEAR::isError($oGroup) || ($oGroup == false))) {
				$aFinalGroupIds[] = $iGroupId;
			}
		}
		if (empty($aFinalGroupIds)) { $aFinalGroupIds = null; }
		
		// hack straight in.
		$oPD = $oRoleAllocation->getPermissionDescriptor();
		$aAllowed = $oPD->getAllowed();		
		
		
		
		// now, grab the existing allowed and modify.

		$aAllowed['group'] = $aFinalGroupIds;
		
		$oRoleAllocation->setAllowed($aAllowed);
		$res = $oRoleAllocation->update();
		
		if (PEAR::isError($res) || ($res == false)) {
			$this->errorRedirectToMain(_kt('Failed to change the role allocation.') . print_r($res, true), sprintf('fFolderId=%d', $this->oFolder->getId()));
		}
		
        $oTransaction = KTFolderTransaction::createFromArray(array(
            'folderid' => $this->oFolder->getId(),
            'comment' => "Set role groups",
            'transactionNS' => 'ktcore.transactions.role_allocations_change',
            'userid' => $_SESSION['userID'],
            'ip' => Session::getClientIP(),
        ));
        $aOptions = array(
            'defaultmessage' => _kt('Problem assigning role groups'),
            'redirect_to' => array('main', sprintf('fFolderId=%d', $this->oFolder->getId())),
        );
        $this->oValidator->notErrorFalse($oTransaction, $aOptions);

		$this->renegeratePermissionsForRole($oRoleAllocation->getRoleId());
		
        $this->successRedirectToMain(_kt('Allocation changed.'), sprintf('fFolderId=%d',$this->oFolder->getId()));     
    }
   	
	function renegeratePermissionsForRole($iRoleId) {
	    $iStartFolderId = $this->oFolder->getId();
		/* 
		 * 1. find all folders & documents "below" this one which use the role 
		 *    definition _active_ (not necessarily present) at this point.
		 * 2. tell permissionutil to regen their permissions.
		 *
		 * The find algorithm is:
		 *
		 *  folder_queue <- (iStartFolderId)
		 *  while folder_queue is not empty:
		 *     active_folder = 
		 *     for each folder in the active_folder:
		 *         find folders in _this_ folder without a role-allocation on the iRoleId
		 *            add them to the folder_queue
		 *         update the folder's permissions.
		 *         find documents in this folder:
		 *            update their permissions.
		 */
		
		$sRoleAllocTable = KTUtil::getTableName('role_allocations');
		$sFolderTable = KTUtil::getTableName('folders');
		$sQuery = sprintf('SELECT f.id as id FROM %s AS f LEFT JOIN %s AS ra ON (f.id = ra.folder_id) WHERE ra.id IS NULL AND f.parent_id = ?', $sFolderTable, $sRoleAllocTable);
		
		
		$folder_queue = array($iStartFolderId);
		while (!empty($folder_queue)) {
			$active_folder = array_pop($folder_queue);
			
			$aParams = array($active_folder);			
			
			$aNewFolders = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'id');
			if (PEAR::isError($aNewFolders)) {
				$this->errorRedirectToMain(_kt('Failure to generate folderlisting.'));
			}
			$folder_queue = kt_array_merge ($folder_queue, (array) $aNewFolders); // push.

			
			// update the folder.
			$oFolder =& Folder::get($active_folder);
			if (PEAR::isError($oFolder) || ($oFolder == false)) {
			    $this->errorRedirectToMain(_kt('Unable to locate folder: ') . $active_folder);
			}
			
			KTPermissionUtil::updatePermissionLookup($oFolder);
			$aDocList =& Document::getList(array('folder_id = ?', $active_folder));
			if (PEAR::isError($aDocList) || ($aDocList === false)) {
			    $this->errorRedirectToMain(sprintf(_kt('Unable to get documents in folder %s: %s'), $active_folder, $aDocList->getMessage()));
			}
			
			foreach ($aDocList as $oDoc) { 
			    if (!PEAR::isError($oDoc)) {
			        KTPermissionUtil::updatePermissionLookup($oDoc);
				}
			}
		}
	}
}

class KTDocumentRolesAction extends KTDocumentAction {
    var $sName = 'ktcore.actions.document.roles';

    var $_sShowPermission = "ktcore.permissions.write";
    var $bAutomaticTransaction = true;

    function getDisplayName() {
        return _kt('View Roles');
    }

    function do_main() {
        $this->oPage->setTitle(_kt("View Roles"));
        $this->oPage->setBreadcrumbDetails(_kt("View Roles"));
        $oTemplating = new KTTemplating;
        $oTemplate = $oTemplating->loadTemplate("ktcore/action/view_roles");
        
        // we need to have:
        //   - a list of roles
        //   - with their users / groups
        //   - and that allocation id
        $aRoles = array(); // stores data for display.
        
        $aRoleList = Role::getList();
        foreach ($aRoleList as $oRole) {
            $iRoleId = $oRole->getId();
            $aRoles[$iRoleId] = array("name" => $oRole->getName());
            $oRoleAllocation = DocumentRoleAllocation::getAllocationsForDocumentAndRole($this->oDocument->getId(), $iRoleId);
			if (is_null($oRoleAllocation)) {
				$oRoleAllocation = RoleAllocation::getAllocationsForFolderAndRole($this->oDocument->getFolderID(), $iRoleId);
			}
            
            $u = array();
            $g = array();
            $aid = null;
            $raid = null;
            if (is_null($oRoleAllocation)) {
                ; // nothing.
            } else {
			    //var_dump($oRoleAllocation);
                $raid = $oRoleAllocation->getId(); // real_alloc_id
                $aAllowed = $oRoleAllocation->getAllowed();

                if (!empty($aAllowed['user'])) {
                    $u = $aAllowed['user'];
                }
                if (!empty($aAllowed['group'])) {
                    $g = $aAllowed['group'];
				}
			}
            $aRoles[$iRoleId]['users'] = $u;
            $aRoles[$iRoleId]['groups'] = $g;
            $aRoles[$iRoleId]['real_allocation_id'] = $raid;
        }     
        
        // final step.
        
        // map to users, groups.
        foreach ($aRoles as $key => $role) {          
            $_users = array();
            foreach ($aRoles[$key]['users'] as $iUserId) {
                $oUser = User::get($iUserId);
                if (!(PEAR::isError($oUser) || ($oUser == false))) {
                    $_users[] = $oUser->getName();
                }
            }
			if (empty($_users)) {
			    $aRoles[$key]['users'] = '<span class="descriptiveText"> ' . _kt('no users') . '</span>'; 	
			} else {
			    $aRoles[$key]['users'] = implode(', ',$_users);
			}		
		
            $_groups = array();
            foreach ($aRoles[$key]['groups'] as $iGroupId) {
                $oGroup = Group::get($iGroupId);
                if (!(PEAR::isError($oGroup) || ($oGroup == false))) {
                    $_groups[] = $oGroup->getName();
                }
            }
			if (empty($_groups)) {
			    $aRoles[$key]['groups'] = '<span class="descriptiveText"> ' . _kt('no groups') . '</span>'; 	
			} else {
			    $aRoles[$key]['groups'] = implode(', ',$_groups);
			}
        }
        
        $aTemplateData = array(
            'context' => &$this,
            'roles' => $aRoles,
        );
        return $oTemplate->render($aTemplateData);
    }
}
