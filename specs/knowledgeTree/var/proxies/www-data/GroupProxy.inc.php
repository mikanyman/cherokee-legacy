<?php
class GroupProxy extends Group {
    function getid() { $aArgs = func_get_args(); return $this->_callOnObject("getid", $aArgs); }

    function setid() { $aArgs = func_get_args(); return $this->_callOnObject("setid", $aArgs); }

    function _cachedgroups() { $aArgs = func_get_args(); return $this->_callOnObject("_cachedgroups", $aArgs); }

    function _innerclearcachedgroups() { $aArgs = func_get_args(); return $this->_callOnObject("_innerclearcachedgroups", $aArgs); }

    function clearcachedgroups() { $aArgs = func_get_args(); return $this->_callOnObject("clearcachedgroups", $aArgs); }

    function create() { $aArgs = func_get_args(); return $this->_callOnObject("create", $aArgs); }

    function newcopy() { $aArgs = func_get_args(); return $this->_callOnObject("newcopy", $aArgs); }

    function update() { $aArgs = func_get_args(); return $this->_callOnObject("update", $aArgs); }

    function delete() { $aArgs = func_get_args(); return $this->_callOnObject("delete", $aArgs); }

    function _getsqlselection() { $aArgs = func_get_args(); return $this->_callOnObject("_getsqlselection", $aArgs); }

    function load() { $aArgs = func_get_args(); return $this->_callOnObject("load", $aArgs); }

    function loadfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("loadfromarray", $aArgs); }

    function _set() { $aArgs = func_get_args(); return $this->_callOnObject("_set", $aArgs); }

    function _getelementfrommethod() { $aArgs = func_get_args(); return $this->_callOnObject("_getelementfrommethod", $aArgs); }

    function _fieldvalues() { $aArgs = func_get_args(); return $this->_callOnObject("_fieldvalues", $aArgs); }

    function updatefromarray() { $aArgs = func_get_args(); return $this->_callOnObject("updatefromarray", $aArgs); }

    function _ktentityoptions() { $aArgs = func_get_args(); return $this->_callOnObject("_ktentityoptions", $aArgs); }

    function group() { $aArgs = func_get_args(); return $this->_callOnObject("group", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function getunitadmin() { $aArgs = func_get_args(); return $this->_callOnObject("getunitadmin", $aArgs); }

    function setunitadmin() { $aArgs = func_get_args(); return $this->_callOnObject("setunitadmin", $aArgs); }

    function getsysadmin() { $aArgs = func_get_args(); return $this->_callOnObject("getsysadmin", $aArgs); }

    function setsysadmin() { $aArgs = func_get_args(); return $this->_callOnObject("setsysadmin", $aArgs); }

    function getname() { $aArgs = func_get_args(); return $this->_callOnObject("getname", $aArgs); }

    function setname() { $aArgs = func_get_args(); return $this->_callOnObject("setname", $aArgs); }

    function getunitid() { $aArgs = func_get_args(); return $this->_callOnObject("getunitid", $aArgs); }

    function setunitid() { $aArgs = func_get_args(); return $this->_callOnObject("setunitid", $aArgs); }

    function getauthenticationdetails() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetails", $aArgs); }

    function setauthenticationdetails() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetails", $aArgs); }

    function getauthenticationdetails2() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetails2", $aArgs); }

    function setauthenticationdetails2() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetails2", $aArgs); }

    function getauthenticationsourceid() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationsourceid", $aArgs); }

    function setauthenticationsourceid() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationsourceid", $aArgs); }

    function hasusers() { $aArgs = func_get_args(); return $this->_callOnObject("hasusers", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function getbyname() { $aArgs = func_get_args(); return $this->_callOnObject("getbyname", $aArgs); }

    function getusers() { $aArgs = func_get_args(); return $this->_callOnObject("getusers", $aArgs); }

    function getmembers() { $aArgs = func_get_args(); return $this->_callOnObject("getmembers", $aArgs); }

    function getmembergroups() { $aArgs = func_get_args(); return $this->_callOnObject("getmembergroups", $aArgs); }

    function getparentgroups() { $aArgs = func_get_args(); return $this->_callOnObject("getparentgroups", $aArgs); }

    function hasmember() { $aArgs = func_get_args(); return $this->_callOnObject("hasmember", $aArgs); }

    function setmembers() { $aArgs = func_get_args(); return $this->_callOnObject("setmembers", $aArgs); }

    function addmember() { $aArgs = func_get_args(); return $this->_callOnObject("addmember", $aArgs); }

    function removemember() { $aArgs = func_get_args(); return $this->_callOnObject("removemember", $aArgs); }

    function addmembergroup() { $aArgs = func_get_args(); return $this->_callOnObject("addmembergroup", $aArgs); }

    function removemembergroup() { $aArgs = func_get_args(); return $this->_callOnObject("removemembergroup", $aArgs); }

    function hasmembergroup() { $aArgs = func_get_args(); return $this->_callOnObject("hasmembergroup", $aArgs); }

    function getunitadministratorgroupsbyunit() { $aArgs = func_get_args(); return $this->_callOnObject("getunitadministratorgroupsbyunit", $aArgs); }

    function getadministratorgroups() { $aArgs = func_get_args(); return $this->_callOnObject("getadministratorgroups", $aArgs); }

    function getbyauthenticationsource() { $aArgs = func_get_args(); return $this->_callOnObject("getbyauthenticationsource", $aArgs); }

    function getbyauthenticationsourceanddetails() { $aArgs = func_get_args(); return $this->_callOnObject("getbyauthenticationsourceanddetails", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["Group"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["Group"][$this->iId];
            return $oObject;
        }
        $oObject =& new Group;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["Group"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["Group"][$this->iId] =& $oObject;
    }
        
    function &_callOnObject($sName, $aArgs) {
        $oObject =& $this->_fetch();
        if (PEAR::isError($oObject)) {
            return $oObject;
        }
        /* */
        $res = call_user_func_array(array(&$oObject, $sName), $aArgs);
        $this->_save($oObject);
        return $res;
        /* */

        /* */
        $aExecArgs = array();
        $exec = '$res =& $oObject->$sName(';
        foreach (array_keys($aArgs) as $iKey) {
            $aExecArgs[] = '$aArgs[' . $iKey . ']';
        }
        $exec .= join(", ", $aExecArgs);
        $exec .= ');';
        eval($exec);
        $this->_save($oObject);
        return $res;
        /* */
    }
        
    function GroupProxy ($iId) { $this->iId = $iId; }

}