<?php
class UserProxy extends User {
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

    function getusername() { $aArgs = func_get_args(); return $this->_callOnObject("getusername", $aArgs); }

    function setusername() { $aArgs = func_get_args(); return $this->_callOnObject("setusername", $aArgs); }

    function getpassword() { $aArgs = func_get_args(); return $this->_callOnObject("getpassword", $aArgs); }

    function setpassword() { $aArgs = func_get_args(); return $this->_callOnObject("setpassword", $aArgs); }

    function getquotamax() { $aArgs = func_get_args(); return $this->_callOnObject("getquotamax", $aArgs); }

    function setquotamax() { $aArgs = func_get_args(); return $this->_callOnObject("setquotamax", $aArgs); }

    function setname() { $aArgs = func_get_args(); return $this->_callOnObject("setname", $aArgs); }

    function getname() { $aArgs = func_get_args(); return $this->_callOnObject("getname", $aArgs); }

    function getquotacurrent() { $aArgs = func_get_args(); return $this->_callOnObject("getquotacurrent", $aArgs); }

    function getemail() { $aArgs = func_get_args(); return $this->_callOnObject("getemail", $aArgs); }

    function setemail() { $aArgs = func_get_args(); return $this->_callOnObject("setemail", $aArgs); }

    function getmobile() { $aArgs = func_get_args(); return $this->_callOnObject("getmobile", $aArgs); }

    function setmobile() { $aArgs = func_get_args(); return $this->_callOnObject("setmobile", $aArgs); }

    function getemailnotification() { $aArgs = func_get_args(); return $this->_callOnObject("getemailnotification", $aArgs); }

    function setemailnotification() { $aArgs = func_get_args(); return $this->_callOnObject("setemailnotification", $aArgs); }

    function getsmsnotification() { $aArgs = func_get_args(); return $this->_callOnObject("getsmsnotification", $aArgs); }

    function setsmsnotification() { $aArgs = func_get_args(); return $this->_callOnObject("setsmsnotification", $aArgs); }

    function getmaxsessions() { $aArgs = func_get_args(); return $this->_callOnObject("getmaxsessions", $aArgs); }

    function setmaxsessions() { $aArgs = func_get_args(); return $this->_callOnObject("setmaxsessions", $aArgs); }

    function getlanguageid() { $aArgs = func_get_args(); return $this->_callOnObject("getlanguageid", $aArgs); }

    function setlanguageid() { $aArgs = func_get_args(); return $this->_callOnObject("setlanguageid", $aArgs); }

    function getauthenticationsourceid() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationsourceid", $aArgs); }

    function setauthenticationsourceid() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationsourceid", $aArgs); }

    function getauthenticationdetails() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetails", $aArgs); }

    function setauthenticationdetails() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetails", $aArgs); }

    function getauthenticationdetails2() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetails2", $aArgs); }

    function setauthenticationdetails2() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetails2", $aArgs); }

    function getauthenticationdetailsint1() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetailsint1", $aArgs); }

    function setauthenticationdetailsint1() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetailsint1", $aArgs); }

    function getauthenticationdetailsint2() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetailsint2", $aArgs); }

    function setauthenticationdetailsint2() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetailsint2", $aArgs); }

    function getauthenticationdetailsdate1() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetailsdate1", $aArgs); }

    function setauthenticationdetailsdate1() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetailsdate1", $aArgs); }

    function getauthenticationdetailsdate2() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetailsdate2", $aArgs); }

    function setauthenticationdetailsdate2() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetailsdate2", $aArgs); }

    function getauthenticationdetailsbool1() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetailsbool1", $aArgs); }

    function setauthenticationdetailsbool1() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetailsbool1", $aArgs); }

    function getauthenticationdetailsbool2() { $aArgs = func_get_args(); return $this->_callOnObject("getauthenticationdetailsbool2", $aArgs); }

    function setauthenticationdetailsbool2() { $aArgs = func_get_args(); return $this->_callOnObject("setauthenticationdetailsbool2", $aArgs); }

    function getlastlogin() { $aArgs = func_get_args(); return $this->_callOnObject("getlastlogin", $aArgs); }

    function setlastlogin() { $aArgs = func_get_args(); return $this->_callOnObject("setlastlogin", $aArgs); }

    function getdisabled() { $aArgs = func_get_args(); return $this->_callOnObject("getdisabled", $aArgs); }

    function setdisabled() { $aArgs = func_get_args(); return $this->_callOnObject("setdisabled", $aArgs); }

    function _getdashboardstatekey() { $aArgs = func_get_args(); return $this->_callOnObject("_getdashboardstatekey", $aArgs); }

    function getdashboardstate() { $aArgs = func_get_args(); return $this->_callOnObject("getdashboardstate", $aArgs); }

    function setdashboardstate() { $aArgs = func_get_args(); return $this->_callOnObject("setdashboardstate", $aArgs); }

    function refreshdashboadstate() { $aArgs = func_get_args(); return $this->_callOnObject("refreshdashboadstate", $aArgs); }

    function get() { $aArgs = func_get_args(); return $this->_callOnObject("get", $aArgs); }

    function dolimitedupdate() { $aArgs = func_get_args(); return $this->_callOnObject("dolimitedupdate", $aArgs); }

    function getlist() { $aArgs = func_get_args(); return $this->_callOnObject("getlist", $aArgs); }

    function getemailusers() { $aArgs = func_get_args(); return $this->_callOnObject("getemailusers", $aArgs); }

    function getunitid() { $aArgs = func_get_args(); return $this->_callOnObject("getunitid", $aArgs); }

    function getuserid() { $aArgs = func_get_args(); return $this->_callOnObject("getuserid", $aArgs); }

    function gethomefolderid() { $aArgs = func_get_args(); return $this->_callOnObject("gethomefolderid", $aArgs); }

    function createfromarray() { $aArgs = func_get_args(); return $this->_callOnObject("createfromarray", $aArgs); }

    function getbyusername() { $aArgs = func_get_args(); return $this->_callOnObject("getbyusername", $aArgs); }

    function getbyauthenticationsource() { $aArgs = func_get_args(); return $this->_callOnObject("getbyauthenticationsource", $aArgs); }

    function getbyauthenticationsourceanddetails() { $aArgs = func_get_args(); return $this->_callOnObject("getbyauthenticationsourceanddetails", $aArgs); }

    function getbylastloginbefore() { $aArgs = func_get_args(); return $this->_callOnObject("getbylastloginbefore", $aArgs); }

    function getbylastloginafter() { $aArgs = func_get_args(); return $this->_callOnObject("getbylastloginafter", $aArgs); }

    function getnumberenabledusers() { $aArgs = func_get_args(); return $this->_callOnObject("getnumberenabledusers", $aArgs); }

    function isanonymous() { $aArgs = func_get_args(); return $this->_callOnObject("isanonymous", $aArgs); }

    function disable() { $aArgs = func_get_args(); return $this->_callOnObject("disable", $aArgs); }

    function enable() { $aArgs = func_get_args(); return $this->_callOnObject("enable", $aArgs); }

    function &_fetch() {
        if (!empty($GLOBALS["_OBJECTCACHE"]["User"][$this->iId])) {
            $oObject =& $GLOBALS["_OBJECTCACHE"]["User"][$this->iId];
            return $oObject;
        }
        $oObject =& new User;
        $res = $oObject->load($this->iId);
        if (PEAR::isError($res)) {
            return $res;
        }
        $GLOBALS["_OBJECTCACHE"]["User"][$this->iId] =& $oObject;
        return $oObject;
    }
        
    function _save(&$oObject) {
        $GLOBALS["_OBJECTCACHE"]["User"][$this->iId] =& $oObject;
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
        
    function UserProxy ($iId) { $this->iId = $iId; }

}