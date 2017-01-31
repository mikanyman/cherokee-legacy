<?php
class KTColumnEntryProxy extends KTColumnEntry {
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

    function getcolumnnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("getcolumnnamespace", $aArgs); }

    function setcolumnnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("setcolumnnamespace", $aArgs); }

    function getviewnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("getviewnamespace", $aArgs); }

    function setviewnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("setviewnamespace", $aArgs); }

    function getposition() { $aArgs = func_get_args(); return $this->_callOnObject("getposition", $aArgs); }

    function setposition() { $aArgs = func_get_args(); return $this->_callOnObject("setposition", $aArgs); }

    function getconfigarray() { $aArgs = func_get_args(); return $this->_callOnObject("getconfigarray", $aArgs); }

    function setconfigarray() { $aArgs = func_get_args(); return $this->_callOnObject("setconfigarray", $aArgs); }

    function getrequired() { $aArgs = func_get_args(); return $this->_callOnObject("getrequired", $aArgs); }

    function setrequired() { $aArgs = func_get_args(); return $this->_callOnObject("setrequired", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function getbyview() { $aArgs = func_get_args(); return $this->_callOnObject("getbyview", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTColumnEntry"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTColumnEntry"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTColumnEntry;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTColumnEntry"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTColumnEntry"][$this->iId] =& $oObject;
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
        
    function KTColumnEntryProxy ($iId) { $this->iId = $iId; }

}