<?php

/**
 * $Id: ldapauthenticationprovider.inc.php 6149 2007-01-03 13:05:40Z conradverm $
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

require_once(KT_LIB_DIR . '/authentication/authenticationprovider.inc.php');
require_once(KT_LIB_DIR . '/authentication/Authenticator.inc');
require_once('Net/LDAP.php');
require_once(KT_DIR . '/plugins/ktstandard/ldap/ldapbaseauthenticationprovider.inc.php');

class KTLDAPAuthenticationProvider extends KTLDAPBaseAuthenticationProvider {
    var $sNamespace = "ktstandard.authentication.ldapprovider";

    var $aAttributes = array ("cn", "uid", "givenname", "sn", "mail", "mobile");
    var $sAuthenticatorClass = "KTLDAPAuthenticator";

    function KTLDAPAuthenticationProvider() {
        $this->sName = _kt("LDAP authentication provider");
        parent::KTLDAPBaseAuthenticationProvider();
    }

}

class KTLDAPAuthenticator extends KTLDAPBaseAuthenticator {
    var $aAttributes = array ("cn", "uid", "givenname", "sn", "mail", "mobile");
}

