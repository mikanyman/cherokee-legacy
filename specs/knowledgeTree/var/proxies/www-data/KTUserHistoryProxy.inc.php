<?php
class KTUserHistoryProxy extends KTUserHistory {
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

    function getuserid() { $aArgs = func_get_args(); return $this->_callOnObject("getuserid", $aArgs); }

    function setuserid() { $aArgs = func_get_args(); return $this->_callOnObject("setuserid", $aArgs); }

    function getdatetime() { $aArgs = func_get_args(); return $this->_callOnObject("getdatetime", $aArgs); }

    function setdatetime() { $aArgs = func_get_args(); return $this->_callOnObject("setdatetime", $aArgs); }

    function getcomments() { $aArgs = func_get_args(); return $this->_callOnObject("getcomments", $aArgs); }

    function setcomments() { $aArgs = func_get_args(); return $this->_callOnObject("setcomments", $aArgs); }

    function getactionnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("getactionnamespace", $aArgs); }

    function setactionnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("setactionnamespace", $aArgs); }

    function getsessionid() { $aArgs = func_get_args(); return $this->_callOnObject("getsessionid", $aArgs); }

    function setsessionid() { $aArgs = func_get_args(); return $this->_callOnObject("setsessionid", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function getbyuser() { $aArgs = func_get_args(); return $this->_callOnObject("getbyuser", $aArgs); }

    function getlastlogins() { $aArgs = func_get_args(); return $this->_callOnObject("getlastlogins", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTUserHistory"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTUserHistory"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTUserHistory;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTUserHistory"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTUserHistory"][$this->iId] =& $oObject;
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
        
    function KTUserHistoryProxy ($iId) { $this->iId = $iId; }

}