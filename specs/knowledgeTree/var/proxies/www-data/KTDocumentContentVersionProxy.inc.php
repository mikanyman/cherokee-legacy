<?php
class KTDocumentContentVersionProxy extends KTDocumentContentVersion {
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

    function ktdocumentcontentversion() { $aArgs = func_get_args(); return $this->_callOnObject("ktdocumentcontentversion", $aArgs); }

    function getfilename() { $aArgs = func_get_args(); return $this->_callOnObject("getfilename", $aArgs); }

    function setfilename() { $aArgs = func_get_args(); return $this->_callOnObject("setfilename", $aArgs); }

    function getfilesize() { $aArgs = func_get_args(); return $this->_callOnObject("getfilesize", $aArgs); }

    function setfilesize() { $aArgs = func_get_args(); return $this->_callOnObject("setfilesize", $aArgs); }

    function getsize() { $aArgs = func_get_args(); return $this->_callOnObject("getsize", $aArgs); }

    function setsize() { $aArgs = func_get_args(); return $this->_callOnObject("setsize", $aArgs); }

    function getmimetypeid() { $aArgs = func_get_args(); return $this->_callOnObject("getmimetypeid", $aArgs); }

    function setmimetypeid() { $aArgs = func_get_args(); return $this->_callOnObject("setmimetypeid", $aArgs); }

    function getmajorversionnumber() { $aArgs = func_get_args(); return $this->_callOnObject("getmajorversionnumber", $aArgs); }

    function setmajorversionnumber() { $aArgs = func_get_args(); return $this->_callOnObject("setmajorversionnumber", $aArgs); }

    function getminorversionnumber() { $aArgs = func_get_args(); return $this->_callOnObject("getminorversionnumber", $aArgs); }

    function setminorversionnumber() { $aArgs = func_get_args(); return $this->_callOnObject("setminorversionnumber", $aArgs); }

    function getstoragepath() { $aArgs = func_get_args(); return $this->_callOnObject("getstoragepath", $aArgs); }

    function setstoragepath() { $aArgs = func_get_args(); return $this->_callOnObject("setstoragepath", $aArgs); }

    function getversion() { $aArgs = func_get_args(); return $this->_callOnObject("getversion", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function getbydocument() { $aArgs = func_get_args(); return $this->_callOnObject("getbydocument", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTDocumentContentVersion"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTDocumentContentVersion"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTDocumentContentVersion;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTDocumentContentVersion"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTDocumentContentVersion"][$this->iId] =& $oObject;
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
        
    function KTDocumentContentVersionProxy ($iId) { $this->iId = $iId; }

}