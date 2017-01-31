<?php

/**
 * $Id: NotificationRegistry.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

class KTNotificationRegistry {
    var $notification_types = array();
    var $notification_types_path = array();
    var $notification_instances = array();
    // {{{ getSingleton
    function &getSingleton () {
        if (!KTUtil::arrayGet($GLOBALS['_KT_PLUGIN'], 'oKTNotificationRegistry')) {
            $GLOBALS['_KT_PLUGIN']['oKTNotificationRegistry'] = new KTNotificationRegistry;
        }
        return $GLOBALS['_KT_PLUGIN']['oKTNotificationRegistry'];
        
    }
    // }}}

    // pass in:
    //   nsname (e.g. ktcore/subscription)
    //   classname (e.g. KTSubscriptionNotification)
    function registerNotificationHandler($nsname, $className, $path = "") {
        $this->notification_types[$nsname] = $className;
        $this->notification_types_path[$nsname] = $path;
    }

    // FIXME insert into notification instances {PERF}
    
    function getHandler($nsname) {
        if (!array_key_exists($nsname, $this->notification_types)) {
            return null;
        } else {
            if (array_key_exists($nsname, $this->notification_types_path)) {
                $path = $this->notification_types_path[$nsname];
                if ($path) {
                    if (file_exists($path)) {
                        require_once($path);
                    }
                }
            }
            return new $this->notification_types[$nsname];
        }
    }
}

?>
