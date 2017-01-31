<?php
class FolderProxy extends Folder {
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

    function getname() { $aArgs = func_get_args(); return $this->_callOnObject("getname", $aArgs); }

    function setname() { $aArgs = func_get_args(); return $this->_callOnObject("setname", $aArgs); }

    function getdescription() { $aArgs = func_get_args(); return $this->_callOnObject("getdescription", $aArgs); }

    function setdescription() { $aArgs = func_get_args(); return $this->_callOnObject("setdescription", $aArgs); }

    function getparentid() { $aArgs = func_get_args(); return $this->_callOnObject("getparentid", $aArgs); }

    function setparentid() { $aArgs = func_get_args(); return $this->_callOnObject("setparentid", $aArgs); }

    function getcreatorid() { $aArgs = func_get_args(); return $this->_callOnObject("getcreatorid", $aArgs); }

    function setcreatorid() { $aArgs = func_get_args(); return $this->_callOnObject("setcreatorid", $aArgs); }

    function getispublic() { $aArgs = func_get_args(); return $this->_callOnObject("getispublic", $aArgs); }

    function setispublic() { $aArgs = func_get_args(); return $this->_callOnObject("setispublic", $aArgs); }

    function getfullpath() { $aArgs = func_get_args(); return $this->_callOnObject("getfullpath", $aArgs); }

    function getparentfolderids() { $aArgs = func_get_args(); return $this->_callOnObject("getparentfolderids", $aArgs); }

    function getpermissionobjectid() { $aArgs = func_get_args(); return $this->_callOnObject("getpermissionobjectid", $aArgs); }

    function setpermissionobjectid() { $aArgs = func_get_args(); return $this->_callOnObject("setpermissionobjectid", $aArgs); }

    function getpermissionlookupid() { $aArgs = func_get_args(); return $this->_callOnObject("getpermissionlookupid", $aArgs); }

    function setpermissionlookupid() { $aArgs = func_get_args(); return $this->_callOnObject("setpermissionlookupid", $aArgs); }

    function getrestrictdocumenttypes() { $aArgs = func_get_args(); return $this->_callOnObject("getrestrictdocumenttypes", $aArgs); }

    function setrestrictdocumenttypes() { $aArgs = func_get_args(); return $this->_callOnObject("setrestrictdocumenttypes", $aArgs); }

    function generatefolderids() { $aArgs = func_get_args(); return $this->_callOnObject("generatefolderids", $aArgs); }

    function generatefullfolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("generatefullfolderpath", $aArgs); }

    function generatefolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("generatefolderpath", $aArgs); }

    function _table() { $aArgs = func_get_args(); return $this->_callOnObject("_table", $aArgs); }

    function renamefolder() { $aArgs = func_get_args(); return $this->_callOnObject("renamefolder", $aArgs); }

    function updatechildpaths() { $aArgs = func_get_args(); return $this->_callOnObject("updatechildpaths", $aArgs); }

    function updatedocumentpaths() { $aArgs = func_get_args(); return $this->_callOnObject("updatedocumentpaths", $aArgs); }

    function getdocumentids() { $aArgs = func_get_args(); return $this->_callOnObject("getdocumentids", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function exists() { $aArgs = func_get_args(); return $this->_callOnObject("exists", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function getfolderpath() { $aArgs = func_get_args(); return $this->_callOnObject("getfolderpath", $aArgs); }

    function getfolderpathnamesasarray() { $aArgs = func_get_args(); return $this->_callOnObject("getfolderpathnamesasarray", $aArgs); }

    function getpatharray() { $aArgs = func_get_args(); return $this->_callOnObject("getpatharray", $aArgs); }

    function getfolderpathasarray() { $aArgs = func_get_args(); return $this->_callOnObject("getfolderpathasarray", $aArgs); }

    function getfolderdisplaypath() { $aArgs = func_get_args(); return $this->_callOnObject("getfolderdisplaypath", $aArgs); }

    function getparentfolderid() { $aArgs = func_get_args(); return $this->_callOnObject("getparentfolderid", $aArgs); }

    function folderexistsname() { $aArgs = func_get_args(); return $this->_callOnObject("folderexistsname", $aArgs); }

    function folderexistsid() { $aArgs = func_get_args(); return $this->_callOnObject("folderexistsid", $aArgs); }

    function getfoldername() { $aArgs = func_get_args(); return $this->_callOnObject("getfoldername", $aArgs); }

    function getbyparentidandlookupid() { $aArgs = func_get_args(); return $this->_callOnObject("getbyparentidandlookupid", $aArgs); }

    function getbyparentid() { $aArgs = func_get_args(); return $this->_callOnObject("getbyparentid", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function clearallcaches() { $aArgs = func_get_args(); return $this->_callOnObject("clearallcaches", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["Folder"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["Folder"][$this->iId];
            return $oObject;
        }
        $oObject =& new Folder;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["Folder"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["Folder"][$this->iId] =& $oObject;
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
        
    function FolderProxy ($iId) { $this->iId = $iId; }

}