<?php

/**
 * $Id: Rename.php 5963 2006-09-13 11:08:36Z bshuttle $
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

require_once(KT_LIB_DIR . '/actions/folderaction.inc.php');

require_once(KT_LIB_DIR . "/widgets/fieldsetDisplay.inc.php");
require_once(KT_LIB_DIR . "/widgets/FieldsetDisplayRegistry.inc.php");
require_once(KT_LIB_DIR . "/foldermanagement/folderutil.inc.php");
require_once(KT_LIB_DIR . "/documentmanagement/observers.inc.php");

require_once(KT_LIB_DIR . "/documentmanagement/documentutil.inc.php");

class KTFolderRenameAction extends KTFolderAction {
    var $sName = 'ktcore.actions.folder.rename';
    var $_sShowPermission = "ktcore.permissions.write";

    function getDisplayName() {
        return _kt('Rename');
    }
    
    function getInfo() {
        if ($this->oFolder->getId() == 1) { return null; }
        return parent::getInfo();
    }

    function do_main() {
        $this->oPage->setBreadcrumbDetails(_kt("rename"));
        $this->oPage->setTitle(_kt('Rename folder'));
        $oTemplate =& $this->oValidator->validateTemplate('ktcore/folder/rename');

        $fields = array();
        $fields[] = new KTStringWidget(_kt('New folder name'), _kt('The name to which the current folder should be renamed.'), 'foldername', "", $this->oPage, true);
        
        $oTemplate->setData(array(
            'context' => &$this,
            'fields' => $fields,
            'sFolderName' => $this->oFolder->getName(),
        ));
        return $oTemplate->render();
    }

    function do_rename() {
        $aErrorOptions = array(
            'redirect_to' => array('', sprintf('fFolderId=%d', $this->oFolder->getId())),
        );
        $sFolderName = KTUtil::arrayGet($_REQUEST, 'foldername');
        $aErrorOptions['defaultmessage'] = _kt("No folder name given");
        $sFolderName = $this->oValidator->validateString($sFolderName, $aErrorOptions);
        $sOldFolderName = $this->oFolder->getName();

        $oParentFolder =& Folder::get($this->oFolder->getParentID());
        if(PEAR::isError($oParentFolder)) {
            $this->errorRedirectToMain(_kt('Unable to retrieve parent folder.'), $aErrorOptions['redirect_to'][1]);
            exit(0);
        }

        if(KTFolderUtil::exists($oParentFolder, $sFolderName)) {
            $this->errorRedirectToMain(_kt('A folder with that name already exists.'), $aErrorOptions['redirect_to'][1]);
            exit(0);
        }

        $res = KTFolderUtil::rename($this->oFolder, $sFolderName, $this->oUser);

        if (PEAR::isError($res)) {
            $_SESSION['KTErrorMessage'][] = $res->getMessage();
            redirect(KTBrowseUtil::getUrlForFolder($this->oFolder));
            exit(0);
        } else {
            $_SESSION['KTInfoMessage'][] = sprintf(_kt('Folder "%s" renamed to "%s".'), $sOldFolderName, $sFolderName);
        }

        $this->commitTransaction();
        redirect(KTBrowseUtil::getUrlForFolder($this->oFolder));
        exit(0);
    }

}

?>
