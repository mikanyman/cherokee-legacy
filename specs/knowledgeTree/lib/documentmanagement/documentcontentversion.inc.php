<?php

/**
 * $Id: documentcontentversion.inc.php 5898 2006-08-31 10:45:31Z bshuttle $
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

require_once(KT_LIB_DIR . '/ktentity.inc');

class KTDocumentContentVersion extends KTEntity {
    var $_bUsePearError = true;

    /** Which document is this content a version of? */
    var $iDocumentId;

    /** What was the filename of the stored content */
    var $sFileName;

    /** How big was the stored content */
    var $iSize;

    /** Which MIME type was this content */
    var $iMimeTypeId;

    /** User-specified major version for this content */
    var $iMajorVersion;

    /** User-specified minor version for this content */
    var $iMinorVersion;

    /** Where in the storage this file can be found */
    var $sStoragePath;

    var $_aFieldToSelect = array(
        "iId" => "id",

        // transaction-related
        "iDocumentId" => 'document_id',
        "sFileName" => 'filename',
        "iSize" => 'size',
        "iMimeTypeId" => 'mime_id',
        "iMajorVersion" => 'major_version',
        "iMinorVersion" => 'minor_version',
        "sStoragePath" => 'storage_path',
    );

    function KTDocumentContentVersion() {
    }

    function getFileName() { return $this->sFileName; }
    function setFileName($sNewValue) { $this->sFileName = $sNewValue; }
    function getFileSize() { return $this->iSize; }
    function setFileSize($iNewValue) { $this->iSize = $iNewValue; }
    function getSize() { return $this->iSize; }
    function setSize($iNewValue) { $this->iSize = $iNewValue; }
    function getMimeTypeId() { return $this->iMimeTypeId; }
    function setMimeTypeId($iNewValue) { $this->iMimeTypeId = $iNewValue; }
    function getMajorVersionNumber() { return $this->iMajorVersion; }
    function setMajorVersionNumber($iNewValue) { $this->iMajorVersion = $iNewValue; }
    function getMinorVersionNumber() { return $this->iMinorVersion; }
    function setMinorVersionNumber($iNewValue) { $this->iMinorVersion = $iNewValue; }
    function getStoragePath() { return $this->sStoragePath; }
    function setStoragePath($sNewValue) { $this->sStoragePath = $sNewValue; }

    function getVersion() {
        return sprintf("%s.%s", $this->getMajorVersionNumber(), $this->getMinorVersionNumber());
    }

    function _table() {
        return KTUtil::getTableName('document_content_version');
    }

    function &createFromArray($aOptions) {
        return KTEntityUtil::createFromArray('KTDocumentContentVersion', $aOptions);
    }

    function create() {
        if (empty($this->iSize)) {
            $this->iSize = 0;
        }
        if (empty($this->iMimeTypeId)) {
            $this->iMimeTypeId = 0;
        }
        if (is_null($this->iMajorVersion)) {
            $this->iMajorVersion = 0;
        }
        if (is_null($this->iMinorVersion)) {
            $this->iMinorVersion = 1;
        }
        return parent::create();
    }

    function &get($iId) {
        return KTEntityUtil::get('KTDocumentContentVersion', $iId);
    }

    function &getByDocument($oDocument, $aOptions = null) {
        $aOptions = KTUtil::meldOptions(array(
            'multi' => true,
        ), $aOptions);
        $iDocumentId = KTUtil::getId($oDocument);
        return KTEntityUtil::getByDict('KTDocumentContentVersion', array(
            'document_id' => $iDocumentId,
        ), $aOptions);
    }
}

?>
