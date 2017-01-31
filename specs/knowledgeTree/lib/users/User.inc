<?php
/**
 * $Id: User.inc 6132 2006-12-14 10:50:04Z conradverm $
 *
 * Represents a user as per the users table in the database.
 *
 * The contents of this file are subject to the KnowledgeTree Public
 * License Version 1.1 ("License"); You may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.ktdms.com/KPL
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 * 
 * The Original Code is: KnowledgeTree Open Source
 * 
 * The Initial Developer of the Original Code is The Jam Warehouse Software
 * (Pty) Ltd, trading as KnowledgeTree.
 * Portions created by The Jam Warehouse Software (Pty) Ltd are Copyright
 * (C) 2006 The Jam Warehouse Software (Pty) Ltd;
 * All Rights Reserved.
 *
 *
 * @version $Revision: 6132 $
 * @author Rob Cherry, Jam Warehouse (Pty) Ltd, South Africa
 * @package lib.unitmanagement
 */
 
require_once(KT_LIB_DIR . '/database/dbutil.inc'); 
require_once(KT_LIB_DIR . '/ktentity.inc'); 

define('ADMIN_USER_ID', 1);
 
class User extends KTEntity {
    /** user's login name */
    var $sUserName;
    /** user's name (first and last) */
    var $sName;
    /** user's password */
    var $sPassword;
    /** user's maximum allowed file storage quota in bytes */
    var $iQuotaMax = 1234567890;
    /** user's current file storage quota in bytes */
    var $iQuotaCurrent = 0;
    /** user's email address */
    var $sEmail = "";
    /** user's mobile phone number */
    var $sMobile = "";
    /** notify user by mail status */
    var $bEmailNotification = false;
    /** notify user via sms (mobile phone) status */
    var $bSmsNotification = false;
    /** maxiumum concurrent sessions user may have */
    var $iMaxSessions = 5;
    /** primary key of language preferred by user */
    var $iLanguageID;
    /** internal variable used to determine if the password has changed or not */
    var $bPasswordChanged = false;
    /** authentication source for this user (built-in if null) */
    var $iAuthenticationSourceId = null;
    /** authentication details so that the source knows who this user is */
    var $sAuthenticationDetails = null;
    var $sAuthenticationDetails2 = null;
    var $iAuthenticationDetailsInt1 = null;
    var $iAuthenticationDetailsInt2 = null;
    var $dAuthenticationDetailsDate1 = null;
    var $dAuthenticationDetailsDate2 = null;
    var $bAuthenticationDetailsBool1 = null;
    var $bAuthenticationDetailsBool2 = null;
    var $dLastLogin = null;
    var $bDisabled = false;

    var $_aFieldToSelect = array(
        'iId' => 'id',
        'sUserName' => 'username',
        'sName' => 'name',
        'sPassword' => 'password',
        'iQuotaMax' => 'quota_max',
        'iQuotaCurrent' => 'quota_current',
        'sEmail' => 'email',
        'sMobile' => 'mobile',
        'bEmailNotification' => 'email_notification',
        'bSmsNotification' => 'sms_notification',
        'iMaxSessions' => 'max_sessions',
        'iLanguageID' => 'language_id',
        'iAuthenticationSourceId' => 'authentication_source_id',
        'sAuthenticationDetails' => 'authentication_details_s1',
        'sAuthenticationDetails2' => 'authentication_details_s2',
        'iAuthenticationDetailsInt1' => 'authentication_details_i1',
        'iAuthenticationDetailsInt2' => 'authentication_details_i2',
        'dAuthenticationDetailsDate1' => 'authentication_details_d1',
        'dAuthenticationDetailsDate2' => 'authentication_details_d2',
        'bAuthenticationDetailsBool1' => 'authentication_details_b1',
        'bAuthenticationDetailsBool2' => 'authentication_details_b2',
        'dLastLogin' => 'last_login',
        'bDisabled' => 'disabled',
    );

    var $_bUsePearError = true;

    function _table() {
        return KTUtil::getTableName("users");
    }
    
    // STATIC
    function _ktentityOptions() {
        return array(
            'orderby' => 'name',
        );
    }
    

    function getUserName() { return $this->sUserName; }
    function setUserName($sNewValue) { $this->sUserName = $sNewValue; }
    function getPassword() { return $this->sPassword; }
    function setPassword($sNewValue) { $this->sPassword = $sNewValue; $this->bPasswordChanged = true; }
    function getQuotaMax() { return $this->iQuotaMax; }
    function setQuotaMax($iNewValue) { $this->iQuotaMax = $iNewValue; }
    function setName($sNewValue) { $this->sName = $sNewValue; }
    function getName() { return $this->sName; }
    function getQuotaCurrent() { return $this->iQuotaCurrent; }
    function getEmail() { return $this->sEmail; }
    function setEmail($sNewValue) { $this->sEmail = $sNewValue; }
    function getMobile() { return $this->sMobile; }
    function setMobile($sNewValue) { $this->sMobile = $sNewValue; }
    function getEmailNotification() { return $this->bEmailNotification; }
    function setEmailNotification($bNewValue) { $this->bEmailNotification = KTUtil::anyToBool($bNewValue); }
    function getSmsNotification() { return $this->bSmsNotification; }
    function setSmsNotification($bNewValue) { $this->bSmsNotification = $bNewValue; }
    function getMaxSessions() { return $this->iMaxSessions; }
    function setMaxSessions($iNewValue) { $this->iMaxSessions = $iNewValue; }
    function getLanguageID() { return $this->iLanguageIDID; }
    function setLanguageID($iNewValue) { $this->iLanguageIDID = $iNewValue; }
    function getAuthenticationSourceId() { return $this->iAuthenticationSourceId; }
    function setAuthenticationSourceId($iNewValue) { $this->iAuthenticationSourceId = $iNewValue; }
    function getAuthenticationDetails() { return $this->sAuthenticationDetails; }
    function setAuthenticationDetails($sNewValue) { $this->sAuthenticationDetails = $sNewValue; }
    function getAuthenticationDetails2() { return $this->sAuthenticationDetails2; }
    function setAuthenticationDetails2($sNewValue) { $this->sAuthenticationDetails2 = $sNewValue; }

    function getAuthenticationDetailsInt1() { return $this->iAuthenticationDetailsInt1; }
    function setAuthenticationDetailsInt1($mValue) { $this->iAuthenticationDetailsInt1 = $mValue; }
    function getAuthenticationDetailsInt2() { return $this->iAuthenticationDetailsInt2; }
    function setAuthenticationDetailsInt2($mValue) { $this->iAuthenticationDetailsInt2 = $mValue; }

    function getAuthenticationDetailsDate1() { return $this->dAuthenticationDetailsDate1; }
    function setAuthenticationDetailsDate1($mValue) { $this->dAuthenticationDetailsDate1 = $mValue; }
    function getAuthenticationDetailsDate2() { return $this->dAuthenticationDetailsDate2; }
    function setAuthenticationDetailsDate2($mValue) { $this->dAuthenticationDetailsDate2 = $mValue; }

    function getAuthenticationDetailsBool1() { return $this->bAuthenticationDetailsBool1; }
    function setAuthenticationDetailsBool1($mValue) { $this->bAuthenticationDetailsBool1 = $mValue; }
    function getAuthenticationDetailsBool2() { return $this->bAuthenticationDetailsBool2; }
    function setAuthenticationDetailsBool2($mValue) { $this->bAuthenticationDetailsBool2 = $mValue; }

    function getLastLogin() { return $this->dLastLogin; }
    function setLastLogin($mValue) { $this->dLastLogin = $mValue; }

    function getDisabled() { return $this->bDisabled; }
    function setDisabled($mValue) { $this->bDisabled = $mValue; }

    /* return the key for storing dashboard in system settings */
    function _getDashboardStateKey() {
        return 'dashboard-state-' . $this->getId();
    }

    function getDashboardState() {         
        return KTUtil::getSystemSetting($this->_getDashboardStateKey());
    }

    function setDashboardState($mValue) { 
        KTUtil::setSystemSetting($this->_getDashboardStateKey(), $mValue);
    }

    function refreshDashboadState()
    {
    	require_once(KT_DIR . "/thirdparty/pear/JSON.php");

    	$dashletRegistry = & KTDashletRegistry::getSingleton();
    	
    	$aDashlets = $dashletRegistry->getDashlets($this);
    	
    	$oJSON = new Services_JSON();

    	$state = $this->getDashboardState();
    	$dashlets = $oJSON->decode($state);
    	$mergedlist = array_merge($dashlets->left,$dashlets->right);
    	
    	
    	$knownlist = array();
    	foreach($mergedlist as $dashlet)
    	{
    		array_push($knownlist,$dashlet->id);
    	}
    	$update=false;
    	
    	if (!isset($dashlets->left)) $dashlets->left=array();
    	if (!isset($dashlets->right)) $dashlets->right=array();
    	
    	$column=1;
    	foreach($aDashlets as $dashlet)
    	{
    		$class = get_class($dashlet);
    		$column=($column + 1) %2;
    		if (!in_array($class,$knownlist))
    		{
    			$obj = new stdClass();
    			$obj->id=$class;
    			$obj->state=0;
    			
    			if ($column == 0)
    				array_push($dashlets->left,$obj);
				else
    				array_push($dashlets->right,$obj);
    			$update=true;
    		}
    	}
    	
    	if ($update)
    	{
    		$state = $oJSON->encode($dashlets);
	    	$this->setDashboardState($state);
    	}
    }
    
    
    function &get($iId) {
        return KTEntityUtil::get('User', $iId);
    }
	
	/**
	* update the datastore, without overwriting the password.
	*
	* only works for a subset of the db values.
	*/
	function doLimitedUpdate() {
		$sQuery = 'UPDATE ' . $this->_table() . ' SET ';
		$aParams = array();
		
		$blacklist = array(
			"sPassword" => 1,
		);
		
		$aParts = array(); // quick workaround to make the join less hurtful.
		
		foreach ($this->_aFieldToSelect as $attr => $column) {
			if (!array_key_exists($attr, $blacklist)) {
				$val = $this->$attr;
				$aParts[] = $column . ' = ?';
				$aParams[] = $val;  
			} 
		}
		$sQuery .= join(', ', $aParts);
		
		$sQuery .= ' WHERE id = ? ';
		$aParams[] = $this->getId();
		
		$res = DBUtil::runQuery(array($sQuery, $aParams));

        $group = sprintf("%s/%s", get_class($this), 'id');
        $oCache =& KTCache::getSingleton();
        $oCache->remove($group, $this->iId);
        $this->clearCachedGroups();

		return $res;
	}
	
	
    /**
    * Static function
    * Get a list of users
    *
    * @param  String  Where clause (not required)
    *
    * @return Array array of User objects, false otherwise and set $_SESSION["errorMessage"]
    */
    function getList($sWhereClause = null, $aOptions = null) {
	    if(!is_array($aOptions)) $aOptions = array($aOptions);
		$aOptions['orderby'] = KTUtil::arrayGet($aOptions, 'orderby', 'name');
		
        return KTEntityUtil::getList2('User', $sWhereClause, $aOptions);
    }

    function getEmailUsers($sWhereClause = null) {
        $aUsers = array();
        foreach (User::getList($sWhereClause) as $oUser) {
            if ($oUser->getEmail()) {
                $aUsers[] = $oUser;
            }
        }
        return $aUsers;
    }

    /**
     * Return the useID for the user
     *
     * @return int the unitID, false otherwise and $_SESSION["errorMessage"] set
     */
    function getUnitId() {
        $ugl = KTUtil::getTableName("users_groups");
        $g = KTUtil::getTableName("groups");
        $aQuery = array(
            "SELECT DISTINCT g.unit_id AS unit_id FROM $ugl AS ugl INNER JOIN $g AS g ON ugl.group_id = g.id WHERE ugl.user_id = ?",
            array($this->iId),
        );
        return DBUtil::getOneResultKey($aQuery, 'unit_id');
    }

    /**
     * static function
     *
     * gets the id of a user using their username
     *
     * @param   string  The username for which we want its ID
     */
    function getUserID($sUsername) {
        global $default;

        $id = lookupID($default->users_table, "username",  $sUsername);

        $this->iId = $id;
    }
    
    /** Static function
    * Gets the user's default top level folder for the current user
    */
    function getHomeFolderID() {
    	$iUnitId = $this->getUnitId();

        if (empty($iUnitId)) {
            return false;
        }

        $oUnit =& Unit::get($iUnitId);
        return $oUnit->getFolderId();
    }
	
	function &createFromArray($aOptions) { return KTEntityUtil::createFromArray('User', $aOptions); }
	function &getByUserName($sUserName, $aOptions = null) {
        return KTEntityUtil::getBy('User', 'username', $sUserName, $aOptions);
    }

    function getByAuthenticationSource($oSource, $aOptions = null) {
        $iSourceId = KTUtil::getId($oSource);
        $aOptions = KTUtil::meldOptions($aOptions, array(
            'multi' => true,
        ));
        return KTEntityUtil::getByDict('User', array(
            'authentication_source_id' => $iSourceId,
        ), $aOptions);
    }

    function &getByAuthenticationSourceAndDetails($oSource, $sDetails, $aOptions = null) {
        $iSourceId = KTUtil::getId($oSource);

        return KTEntityUtil::getByDict('User', array(
            'authentication_source_id' => $iSourceId,
            'authentication_details_s1' => $sDetails,
        ), $aOptions);
    }

    function getByLastLoginBefore($dDateTime) {
        return KTEntityUtil::getByDict('User', array(
            'last_login' => array('type' => 'before', 'value' => $dDateTime),
        ), array('multi' => true));
    }

    function getByLastLoginAfter($dDateTime) {
        return KTEntityUtil::getByDict('User', array(
            'last_login' => array('type' => 'after', 'value' => $dDateTime),
        ), array('multi' => true));
    }

    function getNumberEnabledUsers() {
        $sQuery = sprintf('SELECT COUNT(id) AS number FROM %s WHERE disabled = ? AND id > 1', KTUtil::getTableName('users'));
        $aParams = array(false);
        return DBUtil::getOneResultKey(array($sQuery, $aParams), 'number');
    }
	
    function isAnonymous() { return $this->iId == -2; }

    function disable() {
        $this->setDisabled(true);
        $this->update();
        if (KTPluginUtil::pluginIsActive('ktdms.wintools')) {
            require_once(KT_DIR .  '/plugins/wintools/baobabkeyutil.inc.php');
            BaobabKeyUtil::deallocateUser($this);
        }
        return;
    }
    
    function enable() {
        $this->setDisabled(false);
        $this->update();
        if (KTPluginUtil::pluginIsActive('ktdms.wintools')) {
            require_once(KT_DIR .  '/plugins/wintools/baobabkeyutil.inc.php');
            BaobabKeyUtil::allocateUser($this);
        }
        return;
    }    

    function create() {
        if (KTPluginUtil::pluginIsActive('ktdms.wintools')) {
            require_once(KT_DIR .  '/plugins/wintools/baobabkeyutil.inc.php');
            $res = BaobabKeyUtil::canAddUser();
            if (PEAR::isError($res)) {
                return $res;
            }
        }
        return parent::create();
    }
}