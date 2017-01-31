<?php

/**
 * $Id: authenticationprovider.inc.php 5875 2006-08-22 13:08:07Z nbm $
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
 */

require_once(KT_LIB_DIR . "/dispatcher.inc.php");

class KTAuthenticationProvider extends KTStandardDispatcher {
    var $sName;
    var $sNamespace;
    var $bHasSource = false;
    var $bUserSource = true;
    var $bGroupSource = false;

    function KTAuthenticationProvider() {
        return parent::KTStandardDispatcher();
    }

    function configure($aInfo) {
        $this->aInfo = $aInfo;
    }

    function &getAuthenticator($oSource) {
        // Not implemented
        return null;
    }

    function &getSource() {
        if (empty($bHasSource)) {
            return null;
        }
        return $this;
    }

    /**
     * Gives the provider a chance to show something about how the
     * authentication source is set up.  For example, describing the
     * server settings for an LDAP authentication source.
     */
    function showSource($oSource) {
        return null;
    }

    /**
     * Gives the provider a chance to show something about how the
     * user's authentication works.  For example, providing a link to a
     * page to allow the admin to change a user's password.
     */
    function showUserSource($oUser, $oSource) {
        return null;
    }

    function getName() {
        return $this->sName;
    }
    function getNamespace() {
        return $this->sNamespace;
    }

    function do_editSourceProvider() {
        return $this->errorRedirectTo('viewsource', _kt("Provider does not support editing"), 'source_id=' .  $_REQUEST['source_id']);
    }

    function do_performEditSourceProvider() {
        return $this->errorRedirectTo('viewsource', _kt("Provider does not support editing"), 'source_id=' .  $_REQUEST['source_id']);
    }

    /**
     * Perform provider-specific on-logout activities
     *
     * @param   User    The user who has just logged in
     */
    function login($oUser) {
    }

    /**
     * Perform provider-specific on-logout activities
     *
     * @param   User    The user who is about to be logged out
     */
    function logout($oUser) {
    }

    /**
     * Perform any provider-specific per-request activities
     *
     * @param   User    The user who is about to be logged out
     */
    function verify($oUser) {
    }

    function autoSignup($sUsername, $sPassword, $aExtra, $oSource) {
        return false;
    }
}
