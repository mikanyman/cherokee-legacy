<?php /* vim: set expandtab softtabstop=4 shiftwidth=4 foldmethod=marker: */
/**
 * $Id: importstorage.inc.php 6005 2006-09-28 14:21:40Z bshuttle $
 *
 * Interface for representing a method of listing and importing
 * documents from storage.
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
 * @version $Revision: 6005 $
 * @author Neil Blakey-Milner, Jam Warehouse (Pty) Ltd, South Africa
 */

class KTImportStorage {
    function listDocuments($sFolderPath) {
        return PEAR::raiseError(_kt('Not implemented'));
    }

    function listFolders($sFolderPath) {
        return PEAR::raiseError(_kt('Not implemented'));
    }

    function getDocumentInfo($sDocumentPath) {
        return PEAR::raiseError(_kt('Not implemented'));
    }

    function init() {
        return true;
    }

    function cleanup() {
        return true;
    }
}

class KTImportStorageInfo {
    /**
     * File name to store in the repository.
     */
    var $sFilename;

    /**
     * Ordered array (oldest to newest) of KTFileLike objects that can
     * get the contents for versions of the given file.
     */
    var $aVersions;

    function KTImportStorageInfo ($sFilename, $aVersions) {
        $this->sFilename = $sFilename;
        $this->aVersions = $aVersions;
    }

    function getFilename() {
        return $this->sFilename;
    }
}

?>
