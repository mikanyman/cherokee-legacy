<?php
class KTPluginEntityProxy extends KTPluginEntity {
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

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function getnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("getnamespace", $aArgs); }

    function getpath() { $aArgs = func_get_args(); return $this->_callOnObject("getpath", $aArgs); }

    function getversion() { $aArgs = func_get_args(); return $this->_callOnObject("getversion", $aArgs); }

    function getdisabled() { $aArgs = func_get_args(); return $this->_callOnObject("getdisabled", $aArgs); }

    function getdata() { $aArgs = func_get_args(); return $this->_callOnObject("getdata", $aArgs); }

    function getunavailable() { $aArgs = func_get_args(); return $this->_callOnObject("getunavailable", $aArgs); }

    function getfriendlyname() { $aArgs = func_get_args(); return $this->_callOnObject("getfriendlyname", $aArgs); }

    function setnamespace() { $aArgs = func_get_args(); return $this->_callOnObject("setnamespace", $aArgs); }

    function setpath() { $aArgs = func_get_args(); return $this->_callOnObject("setpath", $aArgs); }

    function setversion() { $aArgs = func_get_args(); return $this->_callOnObject("setversion", $aArgs); }

    function setdisabled() { $aArgs = func_get_args(); return $this->_callOnObject("setdisabled", $aArgs); }

    function setdata() { $aArgs = func_get_args(); return $this->_callOnObject("setdata", $aArgs); }

    function setunavailable() { $aArgs = func_get_args(); return $this->_callOnObject("setunavailable", $aArgs); }

    function setfriendlyname() { $aArgs = func_get_args(); return $this->_callOnObject("setfriendlyname", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function getbynamespace() { $aArgs = func_get_args(); return $this->_callOnObject("getbynamespace", $aArgs); }

    function getavailable() { $aArgs = func_get_args(); return $this->_callOnObject("getavailable", $aArgs); }

    function getenabledplugins() { $aArgs = func_get_args(); return $this->_callOnObject("getenabledplugins", $aArgs); }

    function setenabled() { $aArgs = func_get_args(); return $this->_callOnObject("setenabled", $aArgs); }

    function clearallcaches() { $aArgs = func_get_args(); return $this->_callOnObject("clearallcaches", $aArgs); }

    function getuserfriendlyname() { $aArgs = func_get_args(); return $this->_callOnObject("getuserfriendlyname", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTPluginEntity"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTPluginEntity"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTPluginEntity;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTPluginEntity"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTPluginEntity"][$this->iId] =& $oObject;
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
        
    function KTPluginEntityProxy ($iId) { $this->iId = $iId; }

}