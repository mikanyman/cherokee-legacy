<?php

/**
 * $Id: permissiondescriptor.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

$_PDGC = array();
$_PDRC = array();
$_PDUC = array();

class KTPermissionDescriptor extends KTEntity {
    /** primary key */
    var $iId = -1;

    var $_aFieldToSelect = array(
        "iId" => "id",
        "sDescriptor" => "descriptor",
        "sDescriptorText" => "descriptor_text",
    );

    var $_bUsePearError = true;

    // {{{ getters/setters
    function getID() { return $this->iId; }
    function setID($iId) { $this->iId = $iId; }
    function getDescriptor() { return $this->sDescriptor; }
    function setDescriptor($sDescriptor) { $this->sDescriptor = $sDescriptor; }
    function getDescriptorText() { return $this->sDescriptorText; }
    function setDescriptorText($sDescriptorText) { $this->sDescriptorText = $sDescriptorText; }
    // }}}

    function _table () {
        return KTUtil::getTableName('permission_descriptors');
    }

    // {{{ create
    function create() {
        if (empty($this->sDescriptor)) {
            $this->sDescriptor = md5($this->sDescriptorText);
        }
        return parent::create();
    }
    // }}}

    // {{{ update
    function update() {
        if (empty($this->sDescriptor)) {
            $this->sDescriptor = md5($this->sDescriptorText);
        }
        return parent::update();
    }
    // }}}

    // {{{ STATIC: get
    function &get($iId) {
        return KTEntityUtil::get('KTPermissionDescriptor', $iId);
    }
    // }}}

    // {{{ STATIC: createFromArray
    function &createFromArray($aOptions) {
        return KTEntityUtil::createFromArray('KTPermissionDescriptor', $aOptions);
    }
    // }}}

    // {{{ STATIC: getList
    function &getList($sWhereClause = null) {
        return KTEntityUtil::getList2('KTPermissionDescriptor', $sWhereClause);
    }
    // }}}

    // {{{ STATIC: getByDescriptor
    function &getByDescriptor($sDescriptor) {
        return KTEntityUtil::getBy('KTPermissionDescriptor', 'descriptor', $sDescriptor);
    }
    // }}}

    // {{{ saveAllowed
    function saveAllowed($aAllowed) {
        foreach ($aAllowed as $k => $aIDs) {
            if ($k === "group") {
                $this->_clearGroups();
                foreach ($aIDs as $iID) {
                    $this->_addGroup($iID);
                }
            }
            if ($k === "role") {
                $this->_clearRoles();
                foreach ($aIDs as $iID) {
                    $this->_addRole($iID);
                }
            }
            if ($k === "user") {
                $this->_clearUsers();
                foreach ($aIDs as $iID) {
                    $this->_addUser($iID);
                }
            }
        }
    }
    // }}}

    // {{{ getAllowed
    function getAllowed() {
        $aAllowed = array();
        $aAllowedGroups = $this->getGroups();
        if (!empty($aAllowedGroups)) {
            $aAllowed['group'] = $aAllowedGroups;
        }
        $aAllowedRoles = $this->getRoles();
        if (!empty($aAllowedRoles)) {
            $aAllowed['role'] = $aAllowedRoles;
        }
        $aAllowedUsers = $this->getUsers();
        if (!empty($aAllowedUsers)) {
            $aAllowed['user'] = $aAllowedUsers;
        }
        return $aAllowed;
    }
    // }}}

    // {{{ GROUPS
    // {{{ _clearGroups
    function _clearGroups() {
        unset($GLOBALS['_PDGC'][$this->getId()]);
        $sTable = KTUtil::getTableName('permission_descriptor_groups');
        $sQuery = "DELETE FROM $sTable WHERE descriptor_id = ?";
        $aParams = array($this->getID());
        $res = DBUtil::runQuery(array($sQuery, $aParams));
        return $res;
    }
    // }}}

    // {{{ _addGroup
    function _addGroup($iID) {
        $sTable = KTUtil::getTableName('permission_descriptor_groups');
        $sQuery = "INSERT INTO $sTable (descriptor_id, group_id) VALUES (?, ?)";
        $aParams = array($this->getID(), $iID);
        $res = DBUtil::runQuery(array($sQuery, $aParams));
        return $res;
    }
    // }}}

    // {{{ hasGroups
    function hasGroups($aGroups) {
        $sTable = KTUtil::getTableName('permission_descriptor_groups');
        if (count($aGroups) === 0) {
            return false;
        }
        $aGroupIDs = array();
        foreach ($aGroups as $oGroup) {
            $aGroupIDs[] = $oGroup->getID();
        }
        $sGroupIDs = DBUtil::paramArray($aGroupIDs);
        $sQuery = "SELECT COUNT(group_id) AS num FROM $sTable
            WHERE descriptor_id = ? AND group_id IN ($sGroupIDs)";
        $aParams = array($this->getID());
        $aParams = kt_array_merge($aParams, $aGroupIDs);
        $res = DBUtil::getOneResultKey(array($sQuery, $aParams), 'num');
        if (PEAR::isError($res)) {
            return $res;
        }
        if ((int)$res === 0) {
            return false;
        }
        return true;
    }
    // }}}

    // {{{ getGroups
    function getGroups() {
        if (isset($GLOBALS['_PDGC'][$this->getId()])) {
            return $GLOBALS['_PDGC'][$this->getId()];
        }
        $sTable = KTUtil::getTableName('permission_descriptor_groups');
        $sQuery = "SELECT group_id FROM $sTable WHERE descriptor_id = ?";
        $aParams = array($this->getID());
        $res = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'group_id');
        $GLOBALS['_PDGC'][$this->getId()] = $res;
        return $res;
    }
    // }}}

    // {{{ STATIC: getByGroup
    function &getByGroup($oGroup) {
        $sTable = KTUtil::getTableName('permission_descriptor_groups');
        $sQuery = "SELECT descriptor_id FROM $sTable WHERE group_id = ?";
        $aParams = array($oGroup->getID());
        $aIDs = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'descriptor_id');
        $aRet = array();
        foreach ($aIDs as $iID) {
            $aRet[] =& KTPermissionDescriptor::get($iID);
        }
        return $aRet;
    }
    // }}}

    // {{{ STATIC: getByGroups
    function &getByGroups($aGroups, $aOptions = null) {
        $sTable = KTUtil::getTableName('permission_descriptor_groups');
        if (is_null($aOptions)) {
            $aOptions = array();
        }
        if (count($aGroups) === 0) { return array(); }
        $ids = KTUtil::arrayGet($aOptions, 'ids');
        $aGroupIDs = array();
        foreach ($aGroups as $oGroup) {
            if (is_numeric($oGroup)) {
                $aGroupIDs[] = $oGroup;
            } else {
                $aGroupIDs[] = $oGroup->getID();
            }
        }
        $sGroupIDs = DBUtil::paramArray($aGroupIDs);
        $sQuery = "SELECT DISTINCT descriptor_id FROM $sTable WHERE group_id IN ( $sGroupIDs )";
        $aParams = $aGroupIDs;
        $aIDs = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'descriptor_id');
        $aRet = array();
        foreach ($aIDs as $iID) {
            if ($ids === true) {
                $aRet[] = $iID;
            } else {
                $aRet[] =& KTPermissionDescriptor::get($iID);
            }
        }
        return $aRet;
    }
    // }}}
    // }}}

    // {{{ ROLES
    // {{{ _clearRoles
    function _clearRoles() {
        unset($GLOBALS['_PDRC'][$this->getId()]);
        $sTable = KTUtil::getTableName('permission_descriptor_roles');
        $sQuery = "DELETE FROM $sTable WHERE descriptor_id = ?";
        $aParams = array($this->getID());
        $res = DBUtil::runQuery(array($sQuery, $aParams));
        return $res;
    }
    // }}}

    // {{{ _addRole
    function _addRole($iID) {
        $sTable = KTUtil::getTableName('permission_descriptor_roles');
        $sQuery = "INSERT INTO $sTable (descriptor_id, role_id) VALUES (?, ?)";
        $aParams = array($this->getID(), $iID);
        $res = DBUtil::runQuery(array($sQuery, $aParams));
        return $res;
    }
    // }}}

    // {{{ hasRoles
    function hasRoles($aRoles) {
        if (!is_array($aRoles)) { return false; }
        $sTable = KTUtil::getTableName('permission_descriptor_roles');
        if (count($aRoles) === 0) {
            return false;
        }
        $aRoleIDs = array();
        foreach ($aRoles as $oRole) {
            $aRoleIDs[] = KTUtil::getId($oRole);
        }
        $sRoleIDs = DBUtil::paramArray($aRoleIDs);
        $sQuery = "SELECT COUNT(role_id) AS num FROM $sTable
            WHERE descriptor_id = ? AND role_id IN ($sRoleIDs)";
        $aParams = array($this->getID());
        $aParams = kt_array_merge($aParams, $aRoleIDs);
        $res = DBUtil::getOneResultKey(array($sQuery, $aParams), 'num');
        if (PEAR::isError($res)) {
            return $res;
        }
        if ((int)$res === 0) {
            return false;
        }
        return true;
    }
    // }}}

    // {{{ getRoles
    function getRoles() {
        if (isset($GLOBALS['_PDRC'][$this->getId()])) {
            return $GLOBALS['_PDRC'][$this->getId()];
        }
        $sTable = KTUtil::getTableName('permission_descriptor_roles');
        $sQuery = "SELECT role_id FROM $sTable WHERE descriptor_id = ?";
        $aParams = array($this->getID());
        $res = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'role_id');
        $GLOBALS['_PDRC'][$this->getId()] = $res;
        return $res;
    }
    // }}}

    // {{{ STATIC: getByRole
    function &getByRole($oRole) {
        $sTable = KTUtil::getTableName('permission_descriptor_roles');
        $sQuery = "SELECT descriptor_id FROM $sTable WHERE role_id = ?";
        $aParams = array($oRole->getID());
        $aIDs = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'descriptor_id');
        $aRet = array();
        foreach ($aIDs as $iID) {
            $aRet[] =& KTPermissionDescriptor::get($iID);
        }
        return $aRet;
    }
    // }}}

    // {{{ STATIC: getByRoles
    function &getByRoles($aRoles, $aOptions = null) {
        $sTable = KTUtil::getTableName('permission_descriptor_roles');
        if (is_null($aOptions)) {
            $aOptions = array();
        }
        if (count($aRoles) === 0) { return array(); }
        $ids = KTUtil::arrayGet($aOptions, 'ids');
        $aRoleIDs = array();
        foreach ($aRoles as $oRole) {
            if (is_numeric($oRole)) {
                $aRoleIDs[] = $oRole;
            } else {
                $aRoleIDs[] = $oRole->getID();
            }
        }
        $sRoleIDs = DBUtil::paramArray($aRoleIDs);
        $sQuery = "SELECT DISTINCT descriptor_id FROM $sTable WHERE role_id IN ( $sRoleIDs )";
        $aParams = $aRoleIDs;
        $aIDs = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'descriptor_id');
        $aRet = array();
        foreach ($aIDs as $iID) {
            if ($ids === true) {
                $aRet[] = $iID;
            } else {
                $aRet[] =& KTPermissionDescriptor::get($iID);
            }
        }
        return $aRet;
    }
    // }}}
    // }}}

    // {{{ USERS
    // {{{ _clearUsers
    function _clearUsers() {
        unset($GLOBALS['_PDUC'][$this->getId()]);
        $sTable = KTUtil::getTableName('permission_descriptor_users');
        $sQuery = "DELETE FROM $sTable WHERE descriptor_id = ?";
        $aParams = array($this->getID());
        $res = DBUtil::runQuery(array($sQuery, $aParams));
        return $res;
    }
    // }}}

    // {{{ _addUser
    function _addUser($iID) {
        $sTable = KTUtil::getTableName('permission_descriptor_users');
        $sQuery = "INSERT INTO $sTable (descriptor_id, user_id) VALUES (?, ?)";
        $aParams = array($this->getID(), $iID);
        $res = DBUtil::runQuery(array($sQuery, $aParams));
        return $res;
    }
    // }}}

    // {{{ hasUsers
    function hasUsers($aUsers) {
        $sTable = KTUtil::getTableName('permission_descriptor_users');
        if (count($aUsers) === 0) {
            return false;
        }
        $aUserIDs = array();
        foreach ($aUsers as $oUser) {
            $aUserIDs[] = $oUser->getID();
        }
        $sUserIDs = DBUtil::paramArray($aUserIDs);
        $sQuery = "SELECT COUNT(user_id) AS num FROM $sTable
            WHERE descriptor_id = ? AND user_id IN ($sUserIDs)";
        $aParams = array($this->getID());
        $aParams = kt_array_merge($aParams, $aUserIDs);
        $res = DBUtil::getOneResultKey(array($sQuery, $aParams), 'num');
        if (PEAR::isError($res)) {
            return $res;
        }
        if ((int)$res === 0) {
            return false;
        }
        return true;
    }
    // }}}

    // {{{ getUsers
    function getUsers() {
        if (isset($GLOBALS['_PDUC'][$this->getId()])) {
            return $GLOBALS['_PDUC'][$this->getId()];
        }
        $sTable = KTUtil::getTableName('permission_descriptor_users');
        $sQuery = "SELECT user_id FROM $sTable WHERE descriptor_id = ?";
        $aParams = array($this->getID());
        $res = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'user_id');
        $GLOBALS['_PDUC'][$this->getId()] = $res;
        return $res;
    }
    // }}}

    // {{{ STATIC: getByUser
    function &getByUser($oUser, $aOptions = null) {
        $sTable = KTUtil::getTableName('permission_descriptor_users');
        $sQuery = "SELECT descriptor_id FROM $sTable WHERE user_id = ?";
        $aParams = array($oUser->getID());
        $aIDs = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'descriptor_id');
        if (is_null($aOptions)) {
            $aOptions = array();
        }
        $ids = KTUtil::arrayGet($aOptions, 'ids');
        $aRet = array();
        foreach ($aIDs as $iID) {
            if ($ids === true) {
                $aRet[] = $iID;
            } else {
                $aRet[] =& KTPermissionDescriptor::get($iID);
            }
        }
        return $aRet;
    }
    // }}}

    // {{{ STATIC: getByUsers
    function &getByUsers($aUsers, $aOptions = null) {
        $sTable = KTUtil::getTableName('permission_descriptor_users');
        if (is_null($aOptions)) {
            $aOptions = array();
        }
        if (count($aUsers) === 0) { return array(); }
        $ids = KTUtil::arrayGet($aOptions, 'ids');
        $aUserIDs = array();
        foreach ($aUsers as $oUser) {
            if (is_numeric($oUser)) {
                $aUserIDs[] = $oUser;
            } else {
                $aUserIDs[] = $oUser->getID();
            }
        }
        $sUserIDs = DBUtil::paramArray($aUserIDs);
        $sQuery = "SELECT DISTINCT descriptor_id FROM $sTable WHERE user_id IN ( $sUserIDs )";
        $aParams = $aUserIDs;
        $aIDs = DBUtil::getResultArrayKey(array($sQuery, $aParams), 'descriptor_id');
        $aRet = array();
        foreach ($aIDs as $iID) {
            if ($ids === true) {
                $aRet[] = $iID;
            } else {
                $aRet[] =& KTPermissionDescriptor::get($iID);
            }
        }
        return $aRet;
    }
    // }}}
    // }}}
}

?>
