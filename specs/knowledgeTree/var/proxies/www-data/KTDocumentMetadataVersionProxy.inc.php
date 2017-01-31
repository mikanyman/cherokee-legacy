<?php
class KTDocumentMetadataVersionProxy extends KTDocumentMetadataVersion {
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

    function getdocumentid() { $aArgs = func_get_args(); return $this->_callOnObject("getdocumentid", $aArgs); }

    function setdocumentid() { $aArgs = func_get_args(); return $this->_callOnObject("setdocumentid", $aArgs); }

    function getmetadataversion() { $aArgs = func_get_args(); return $this->_callOnObject("getmetadataversion", $aArgs); }

    function setmetadataversion() { $aArgs = func_get_args(); return $this->_callOnObject("setmetadataversion", $aArgs); }

    function getcontentversionid() { $aArgs = func_get_args(); return $this->_callOnObject("getcontentversionid", $aArgs); }

    function setcontentversionid() { $aArgs = func_get_args(); return $this->_callOnObject("setcontentversionid", $aArgs); }

    function setcontentversion() { $aArgs = func_get_args(); return $this->_callOnObject("setcontentversion", $aArgs); }

    function getdocumenttypeid() { $aArgs = func_get_args(); return $this->_callOnObject("getdocumenttypeid", $aArgs); }

    function setdocumenttypeid() { $aArgs = func_get_args(); return $this->_callOnObject("setdocumenttypeid", $aArgs); }

    function getname() { $aArgs = func_get_args(); return $this->_callOnObject("getname", $aArgs); }

    function setname() { $aArgs = func_get_args(); return $this->_callOnObject("setname", $aArgs); }

    function getdescription() { $aArgs = func_get_args(); return $this->_callOnObject("getdescription", $aArgs); }

    function setdescription() { $aArgs = func_get_args(); return $this->_callOnObject("setdescription", $aArgs); }

    function getstatusid() { $aArgs = func_get_args(); return $this->_callOnObject("getstatusid", $aArgs); }

    function setstatusid() { $aArgs = func_get_args(); return $this->_callOnObject("setstatusid", $aArgs); }

    function getversioncreated() { $aArgs = func_get_args(); return $this->_callOnObject("getversioncreated", $aArgs); }

    function setversioncreated() { $aArgs = func_get_args(); return $this->_callOnObject("setversioncreated", $aArgs); }

    function getversioncreatorid() { $aArgs = func_get_args(); return $this->_callOnObject("getversioncreatorid", $aArgs); }

    function setversioncreatorid() { $aArgs = func_get_args(); return $this->_callOnObject("setversioncreatorid", $aArgs); }

    function getworkflowid() { $aArgs = func_get_args(); return $this->_callOnObject("getworkflowid", $aArgs); }

    function setworkflowid() { $aArgs = func_get_args(); return $this->_callOnObject("setworkflowid", $aArgs); }

    function getworkflowstateid() { $aArgs = func_get_args(); return $this->_callOnObject("getworkflowstateid", $aArgs); }

    function setworkflowstateid() { $aArgs = func_get_args(); return $this->_callOnObject("setworkflowstateid", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function getbydocument() { $aArgs = func_get_args(); return $this->_callOnObject("getbydocument", $aArgs); }

    function bumpmetadataversion() { $aArgs = func_get_args(); return $this->_callOnObject("bumpmetadataversion", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTDocumentMetadataVersion"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTDocumentMetadataVersion"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTDocumentMetadataVersion;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTDocumentMetadataVersion"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTDocumentMetadataVersion"][$this->iId] =& $oObject;
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
        
    function KTDocumentMetadataVersionProxy ($iId) { $this->iId = $iId; }

}