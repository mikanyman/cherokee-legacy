<?php

/**
 * $Id: errorviewer.inc.php 5758 2006-07-27 10:17:43Z bshuttle $
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

class KTErrorViewerRegistry {
    var $aViewers = array();

    function &getSingleton() {
        $oRegistry =& KTUtil::arrayGet($GLOBALS, 'KTErrorViewerRegistry');
        if ($oRegistry) {
            return $oRegistry;
        }
        $GLOBALS['KTErrorViewerRegistry'] =& new KTErrorViewerRegistry();
        return $GLOBALS['KTErrorViewerRegistry'];
    }

    function register($sViewerClassName, $sHandledClass) {
        $this->aViewers[strtolower($sHandledClass)] = $sViewerClassName;
    }

    function getViewer($oError) {
        $sErrorClass = strtolower(get_class($oError));

        // Try for direct hit first
        $sClass = $sErrorClass;
        $sHandlerClass = KTUtil::arrayGet($this->aViewers, $sClass);
        if ($sHandlerClass) {
            return new $sHandlerClass($oError);
        }

        // PHP 4.0.5 added get_parent_class - this offers us the
        // best/first match
        if (function_exists('get_parent_class')) {
            while ($sClass = get_parent_class($sClass)) {
                $sHandlerClass = KTUtil::arrayGet($this->aViewers, $sClass);
                if ($sHandlerClass) {
                    return new $sHandlerClass($oError);
                }
            }
        }

        // Now try things the hard way - no best/first match (ick!)
        // Reverse, since hopefully the best/first match will be added
        // after the other matches.
        foreach (array_reverse($this->aViewers) as $sHandlerClass => $sClass) {
            if (is_a($oError, $sClass)) {
                return new $sHandlerClass($oError);
            }
        }

        // Just in case we have an unhandled i18n-friendly error
        if (method_exists($oError, 'geti18nMessage')) {
            return new KTStringErrorViewer($oError->getMessage());
        }

        // PEAR_Error should have caught things above, but just in case,
        // check if getMessage is there, and use that:
        if (method_exists($oError, 'getMessage')) {
            return new KTStringErrorViewer($oError->getMessage());
        }

        // Check if we are a string
        if (is_string($oError)) {
            return new KTStringErrorViewer($oError);
        }

        // Give up.
        return new KTStringErrorViewer(_kt("Unknown error"));
    }
}

$oEVRegistry =& KTErrorViewerRegistry::getSingleton();
class KTErrorViewer {
    function KTErrorViewer($oError) {
        $this->oError = $oError;
    }
    function view() {
        return $this->oError->getMessage();
    }

    function viewFull() {
        return $this->oError->toString();
    }

    function page() {
        $ret  = "<h2>Error</h2>\n\n";
        $ret .= "<dl>\n";
        $ret .= "\t<dt>Error type</dt>\n";
        $ret .= "\t<dd>" . $this->oError->getMessage() . "</dd>\n";
        $sInfo = $this->parseUserInfo();
        if ($sInfo) {
            $ret .= "\t<dt>Additional information</dt>\n";
            $ret .= "\t<dd>" . $sInfo . "</dd>\n";
        }
        $ret .= "</dl>\n";
        return $ret;
    }

    function parseUserInfo() {
        $sUserInfo = $this->oError->getUserInfo();
        return $sUserInfo;
    }
}
$oEVRegistry->register("KTErrorViewer", "PEAR_Error");

class KTDBErrorViewer extends KTErrorViewer {
    function view() {
        return _kt("Database error:") . " " . $this->oError->getMessage();
    }

    function page() {
        $ret  = "<h2>Database Error</h2>\n\n";
        $ret .= "<dl>\n";
        $ret .= "\t<dt>Error type</dt>\n";
        $ret .= "\t<dd>" . $this->oError->getMessage() . "</dd>\n";
        $sInfo = $this->parseUserInfo();

        if ($sInfo) {
            $ret .= "\t<dt>Additional information</dt>\n";
            $ret .= "\t<dd>" . $sInfo . "</dd>\n";
        }
        $ret .= "</dl>\n";
        return $ret;
    }

    function parseUserInfo() {
        $sUserInfo = $this->oError->getUserInfo();
        $aMatches = array();

        if (preg_match("#^ ?\[nativecode=(Can't connect to local.*) \(13\)#", $sUserInfo, $aMatches)) {
            return $aMatches[1];
        }
        return $sUserInfo;
    }
}
$oEVRegistry->register("KTDBErrorViewer", "DB_Error");

class KTStringErrorViewer extends KTErrorViewer {
    function view() {
        return $this->oError;
    }
    
    function viewFull() {
        return $this->oError;
    }
}
