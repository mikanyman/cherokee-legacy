<?php
class KTDocumentCoreProxy extends KTDocumentCore {
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

    function ktdocument() { $aArgs = func_get_args(); return $this->_callOnObject("ktdocument", $aArgs); }

    function getcreatorid() { $aArgs = func_get_args(); return $this->_callOnObject("getcreatorid", $aArgs); }

    function setcreatorid() { $aArgs = func_get_args(); return $this->_callOnObject("setcreatorid", $aArgs); }

    function getownerid() { $aArgs = func_get_args(); return $this->_callOnObject("getownerid", $aArgs); }

    function setownerid() { $aArgs = func_get_args(); return $this->_callOnObject("setownerid", $aArgs); }

    function getcreateddatetime() { $aArgs = func_get_args(); return $this->_callOnObject("getcreateddatetime", $aArgs); }

    function getmodifieduserid() { $aArgs = func_get_args(); return $this->_callOnObject("getmodifieduserid", $aArgs); }

    function setmodifieduserid() { $aArgs = func_get_args(); return $this->_callOnObject("setmodifieduserid", $aArgs); }

    function getlastmodifieddate() { $aArgs = func_get_args(); return $this->_callOnObject("getlastmodifieddate", $aArgs); }

    function setlastmodifieddate() { $aArgs = func_get_args(); return $this->_callOnObject("setlastmodifieddate", $aArgs); }

    function getfolderid() { $aArgs = func_get_args(); return $this->_callOnObject("getfolderid", $aArgs); }

    function setfolderid() { $aArgs = func_get_args(); return $this->_callOnObject("setfolderid", $aArgs); }

    function getstatusid() { $aArgs = func_get_args(); return $this->_callOnObject("getstatusid", $aArgs); }

    function setstatusid() { $aArgs = func_get_args(); return $this->_callOnObject("setstatusid", $aArgs); }

    function getischeckedout() { $aArgs = func_get_args(); return $this->_callOnObject("getischeckedout", $aArgs); }

    function setischeckedout() { $aArgs = func_get_args(); return $this->_callOnObject("setischeckedout", $aArgs); }

    function getcheckedoutuserid() { $aArgs = func_get_args(); return $this->_callOnObject("getcheckedoutuserid", $aArgs); }

    function setcheckedoutuserid() { $aArgs = func_get_args(); return $this->_callOnObject("setcheckedoutuserid", $aArgs); }

    function getpermissionobjectid() { $aArgs = func_get_args(); return $this->_callOnObject("getpermissionobjectid", $aArgs); }

    function setpermissionobjectid() { $aArgs = func_get_args(); return $this->_callOnObject("setpermissionobjectid", $aArgs); }

    function getpermissionlookupid() { $aArgs = func_get_args(); return $this->_callOnObject("getpermissionlookupid", $aArgs); }

    function setpermissionlookupid() { $aArgs = func_get_args(); return $this->_callOnObject("setpermissionlookupid", $aArgs); }

    function getmetadataversionid() { $aArgs = func_get_args(); return $this->_callOnObject("getmetadataversionid", $aArgs); }

    function setmetadataversionid() { $aArgs = func_get_args(); return $this->_callOnObject("setmetadataversionid", $aArgs); }

    function getmetadataversion() { $aArgs = func_get_args(); return $this->_callOnObject("getmetadataversion", $aArgs); }

    function setmetadataversion() { $aArgs = func_get_args(); return $this->_callOnObject("setmetadataversion", $aArgs); }

    function getfullpath() { $aArgs = func_get_args(); return $this->_callOnObject("getfullpath", $aArgs); }

    function getimmutable() { $aArgs = func_get_args(); return $this->_callOnObject("getimmutable", $aArgs); }

    function setimmutable() { $aArgs = func_get_args(); return $this->_callOnObject("setimmutable", $aArgs); }

    function getrestorefolderid() { $aArgs = func_get_args(); return $this->_callOnObject("getrestorefolderid", $aArgs); }

    function setrestorefolderid() { $aArgs = func_get_args(); return $this->_callOnObject("setrestorefolderid", $aArgs); }

    function getrestorefolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("getrestorefolderpath", $aArgs); }

    function setrestorefolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("setrestorefolderpath", $aArgs); }

    function getparentid() { $aArgs = func_get_args(); return $this->_callOnObject("getparentid", $aArgs); }

    function _generatefolderids() { $aArgs = func_get_args(); return $this->_callOnObject("_generatefolderids", $aArgs); }

    function _generatefullfolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("_generatefullfolderpath", $aArgs); }

    function _generatefolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("_generatefolderpath", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function getpath() { $aArgs = func_get_args(); return $this->_callOnObject("getpath", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["KTDocumentCore"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["KTDocumentCore"][$this->iId];
            return $oObject;
        }
        $oObject =& new KTDocumentCore;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["KTDocumentCore"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["KTDocumentCore"][$this->iId] =& $oObject;
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
        
    function KTDocumentCoreProxy ($iId) { $this->iId = $iId; }

}