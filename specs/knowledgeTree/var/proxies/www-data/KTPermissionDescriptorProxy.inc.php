<?php
class KTPermissionDescriptorProxy extends KTPermissionDescriptor {
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

    function getdescriptor() { $aArgs = func_get_args(); return $this->_callOnObject("getdescriptor", $aArgs); }

    function setdescriptor() { $aArgs = func_get_args(); return $this->_callOnObject("setdescriptor", $aArgs); }

    function getdescriptortext() { $aArgs = func_get_args(); return $this->_callOnObject("getdescriptortext", $aArgs); }

    function setdescriptortext() { $aArgs = func_get_args(); return $this->_callOnObject("setdescriptortext", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function getbydescriptor() { $aArgs = func_get_args(); return $this->_callOnObject("getbydescriptor", $aArgs); }

    function saveallowed() { $aArgs = func_get_args(); return $this->_callOnObject("saveallowed", $aArgs); }

    function getallowed() { $aArgs = func_get_args(); return $this->_callOnObject("getallowed", $aArgs); }

    function _cleargroups() { $aArgs = func_get_args(); return $this->_callOnObject("_cleargroups", $aArgs); }

    function _addgroup() { $aArgs = func_get_args(); return $this->_callOnObject("_addgroup", $aArgs); }

    function hasgroups() { $aArgs = func_get_args(); return $this->_callOnObject("hasgroups", $aArgs); }

    function getgroups() { $aArgs = func_get_args(); return $this->_callOnObject("getgroups", $aArgs); }

    function getbygroup() { $aArgs = func_get_args(); return $this->_callOnObject("getbygroup", $aArgs); }

    function getbygroups() { $aArgs = func_get_args(); return $this->_callOnObject("getbygroups", $aArgs); }

    function _clearroles() { $aArgs = func_get_args(); return $this->_callOnObject("_clearroles", $aArgs); }

    function _addrole() { $aArgs = func_get_args(); return $this->_callOnObject("_addrole", $aArgs); }

    function hasroles() { $aArgs = func_get_args(); return $this->_callOnObject("hasroles", $aArgs); }

    function getroles() { $aArgs = func_get_args(); return $this->_callOnObject("getroles", $aArgs); }

    function getbyrole() { $aArgs = func_get_args(); return $this->_callOnObject("getbyrole", $aArgs); }

    function getbyroles() { $aArgs = func_get_args(); return $this->_callOnObject("getbyroles", $aArgs); }

    function _clearusers() { $aArgs = func_get_args(); return $this->_callOnObject("_clearusers", $aArgs); }

    function _adduser() { $aArgs = func_get_args(); return $this->_callOnObject("_adduser", $aArgs); }

    function hasusers() { $aArgs = func_get_args(); return $this->_callOnObject("hasusers", $aArgs); }

    function getusers() { $aArgs = func_get_args(); return $this->_callOnObject("getusers", $aArgs); }

    function getbyuser() { $aArgs = func_get_args(); return $this->_callOnObject("getbyuser", $aArgs); }

    function getbyusers() { $aArgs = func_get_args(); return $this->_callOnObject("getbyusers", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTPermissionDescriptor"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTPermissionDescriptor"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTPermissionDescriptor;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTPermissionDescriptor"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTPermissionDescriptor"][$this->iId] =& $oObject;
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
        
    function KTPermissionDescriptorProxy ($iId) { $this->iId = $iId; }

}