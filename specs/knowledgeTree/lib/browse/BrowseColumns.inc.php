<?php

/**
 * $Id: BrowseColumns.inc.php 6121 2006-12-12 10:42:26Z bryndivey $
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

/** BrowserColumns
 * 
 *  Presentation and render logic for the different columns.  Each has two
 *  major methods:
 *
 *     function renderHeader($sReturnURL)
 *     function renderData($aDataRow)
 *  
 *  renderHeader returns the _content_ of the header row.
 *  renderData returns the _content_ of the body row.
 */
 
require_once(KT_LIB_DIR . "/database/dbutil.inc");
require_once(KT_LIB_DIR . '/users/User.inc');

require_once(KT_LIB_DIR . '/workflow/workflowutil.inc.php');
require_once(KT_LIB_DIR . '/browse/browseutil.inc.php');


class BrowseColumn {
    var $label = null;
    var $sort_on = false;
    var $sort_direction = "asc";
    var $name = "-";
    
    function BrowseColumn($sLabel, $sName) { 
       $this->label = $sLabel; 
       $this->name = $sName; 
    }
    // FIXME is it _really_ worth using a template here?
    function renderHeader($sReturnURL) { 
        $text = _kt("Abstract") . ": " . $this->label; 
        $href = $sReturnURL . "&sort_on=" . $this->name . "&sort_order=";
        if ($this->sort_on) {
            $href .= $this->sort_direction == "asc" ? "desc" : "asc" ;
        } else {
            $href .= $this->sort_direction = "asc";
        }
        
        return '<a href="' . $href . '">'.$text.'</a>';        
    }
    
    function renderData($aDataRow) { 
       if ($aDataRow["type"] == "folder") {
           return $this->name . ": ". print_r($aDataRow["folder"]->getName(), true);            
        } else {
           return $this->name . ": ". print_r($aDataRow["document"]->getName(), true); 
        }
    }
    function setSortedOn($bIsSortedOn) { $this->sort_on = $bIsSortedOn; }
    function getSortedOn() { return $this->sort_on; }
    function setSortDirection($sSortDirection) { $this->sort_direction = $sSortDirection; }
    function getSortDirection() { return $this->sort_direction; }
    
    function addToFolderQuery() { return array(null, null, null); }
    function addToDocumentQuery() { return array(null, null, null); }
}

class TitleColumn extends BrowseColumn {
    var $aOptions = array();
    var $aIconPaths = array();

    function setOptions($aOptions) {
        $this->aOptions = $aOptions;
    }
    // unlike others, this DOESN'T give its name.
    function renderHeader($sReturnURL) { 
        $text = _kt("Title");
        $href = $sReturnURL . "&sort_on=" . $this->name . "&sort_order=";
        if ($this->sort_on) {
            $href .= $this->sort_direction == "asc" ? "desc" : "asc" ;
        } else {
            $href .= $this->sort_direction = "asc";
        }
        
        return '<a href="' . $href . '">'.$text.'</a>';
        
    }

    function renderFolderLink($aDataRow) {
        $outStr = '<a href="' . $this->buildFolderLink($aDataRow) . '">';
        $outStr .= htmlentities($aDataRow["folder"]->getName(), ENT_NOQUOTES, 'UTF-8');
        $outStr .= '</a> ';
        return $outStr;
    }

    function renderDocumentLink($aDataRow) {
        $outStr = '<a href="' . $this->buildDocumentLink($aDataRow) . '" title="' . $aDataRow["document"]->getFilename().'">';
        $outStr .= htmlentities($aDataRow["document"]->getName(), ENT_NOQUOTES, 'UTF-8');
        $outStr .= '</a>';
        return $outStr;
    }

    function buildDocumentLink($aDataRow) {
        return KTBrowseUtil::getUrlForDocument($aDataRow["document"]->getId());
    }

    function buildFolderLink($aDataRow) {
        if (is_null(KTUtil::arrayGet($this->aOptions, 'direct_folder'))) {
            return KTUtil::addQueryStringSelf('fFolderId='.$aDataRow["folder"]->getId());
        } else {
            return KTBrowseUtil::getUrlForFolder($aDataRow['folder']);
        }
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
       $outStr = '';
       if ($aDataRow["type"] == "folder") {
           $outStr .= '<span class="contenttype folder">';
           $outStr .= $this->renderFolderLink($aDataRow);
           $outStr .= '</span>';           
        } else {
           $outStr .= '<span class="contenttype '.$this->_mimeHelper($aDataRow["document"]->getMimeTypeId()).'">';
           $outStr .= $this->renderDocumentLink($aDataRow);
           $outStr .= ' (' . $this->prettySize($aDataRow["document"]->getSize()) . ')';
           $outStr .= '</span>';
        }
        //return $outStr;
    }
    
    function prettySize($size) {
        $finalSize = $size;
        $label = 'b';
        
        if ($finalSize > 1000) { $label='Kb'; $finalSize = floor($finalSize/1000); }
        if ($finalSize > 1000) { $label='Mb'; $finalSize = floor($finalSize/1000); }
        return $finalSize . $label;
    }

    function _mimeHelper($iMimeTypeId) {
        require_once(KT_LIB_DIR . '/mime.inc.php');
        return KTMime::getIconPath($iMimeTypeId);
    }
}



class DateColumn extends BrowseColumn {
    var $field_function;
    
    // $sDocumentFieldFunction is _called_ on the document.
    function DateColumn($sLabel, $sName, $sDocumentFieldFunction) {
        $this->field_function = $sDocumentFieldFunction;
        parent::BrowseColumn($sLabel, $sName);
        
    }
    
    function renderHeader($sReturnURL) { 
        $text = $this->label;
        $href = $sReturnURL . "&sort_on=" . $this->name . "&sort_order=";
        if ($this->sort_on) {
            $href .= $this->sort_direction == "asc" ? "desc" : "asc" ;
        } else {
            $href .= $this->sort_direction = "asc";
        }
        
        return '<a href="' . $href . '">'.$text.'</a>';
        
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
       $outStr = '';
       if ($aDataRow["type"] == "folder") {
           $outStr = '&nbsp;';       // no-op on folders.
        } else {
           $fn = $this->field_function;
           $dColumnDate = strtotime($aDataRow["document"]->$fn());
           
           // now reformat this into something "pretty"
           $outStr = date("Y-m-d H:i", $dColumnDate);
        }
        return $outStr;
    }
    
    function _mimeHelper($iMimeTypeId) {
        // FIXME lazy cache this.
        $sQuery = 'SELECT icon_path FROM mime_types WHERE id = ?';
        $res = DBUtil::getOneResult(array($sQuery, array($iMimeTypeId)));
        
        if ($res[0] !== null) {
           return $res[0];
        } else {
           return 'unspecified_type';
        }
    }

    function addToFolderQuery() {
        return array(null, null, null);
    }
    function addToDocumentQuery() {
        return array(null, null, $this->name);
    }
}


class UserColumn extends BrowseColumn {
    var $field_function;
    
    // $sDocumentFieldFunction is _called_ on the document.
    function UserColumn($sLabel, $sName, $sDocumentFieldFunction) {
        $this->field_function = $sDocumentFieldFunction;
        parent::BrowseColumn($sLabel, $sName);
        
    }
    
    function renderHeader($sReturnURL) { 
        $text = $this->label;
        $href = $sReturnURL . "&sort_on=" . $this->name . "&sort_order=";
        if ($this->sort_on) {
            $href .= $this->sort_direction == "asc" ? "desc" : "asc" ;
        } else {
            $href .= $this->sort_direction = "asc";
        }
        
        return '<a href="' . $href . '">'.$text.'</a>';
        
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
        $outStr = '';
        $fn = $this->field_function;
        $iUserId = null;
        if ($aDataRow["type"] == "folder") {
            if (method_exists($aDataRow['folder'], $fn)) {
                $iUserId = $aDataRow['folder']->$fn(); // FIXME this should check if the function exists first.
            }
        } else {
            if (true) {//(method_exists($aDataRow['document'], $fn)) {
                $iUserId = $aDataRow['document']->$fn(); // FIXME this should check if the function exists first.
            }
        }
        $oUser = User::get($iUserId);
        if (PEAR::isError($oUser) || $oUser == false) {
            $outStr = '&nbsp;';
        } else {
            $outStr = $oUser->getName();
        }
        return $outStr;
    }

    function addToFolderQuery() {
        return array(null, null, null);
    }
    function addToDocumentQuery() {
        $sUsersTable = KTUtil::getTableName('users');
        $sJoinSQL = "LEFT JOIN $sUsersTable AS users_order_join ON D.{$this->name} = users_order_join.id";
        return array($sJoinSQL, null, "users_order_join.name");
    }
}

// use the _name_ parameter + _f_ + id to create a non-clashing checkbox.

class SelectionColumn extends BrowseColumn {
    var $show_documents;
    var $show_folders;

    function SelectionColumn ($sLabel, $sName, $bShowFolders = true, $bShowDocs = true) {
        $this->show_documents = $bShowDocs;
        $this->show_folders = $bShowFolders;
        parent::BrowseColumn($sLabel, $sName);
    }

    function renderHeader($sReturnURL) { 
        // FIXME clean up access to oPage.
        global $main;
        $main->requireJSResource("resources/js/toggleselect.js");
        
        return '<input type="checkbox" title="toggle all" onclick="toggleSelectFor(this, \''.$this->name.'\')">';
        
    }
    
    // only include the _f or _d IF WE HAVE THE OTHER TYPE.
    function renderData($aDataRow) { 
        $localname = $this->name;
        
        if (($aDataRow["type"] === "folder") && ($this->show_folders)) { 
            if ($this->show_documents) {
                $localname .= "_f[]"; 
            }
            $v = $aDataRow["folderid"]; 
        } else if (($aDataRow["type"] === "document") && $this->show_documents) { 
            if ($this->show_folders) {
                $localname .= "_d[]"; 
            }
            $v = $aDataRow["docid"]; 
        } else { 
            return '&nbsp;'; 
        }
        
        return '<input type="checkbox" name="' . $localname . '" onclick="activateRow(this)" value="' . $v . '"/>';
    }
    
}


class SingleSelectionColumn extends SelectionColumn {
    var $show_documents;
    var $show_folders;

    function SelectionColumn ($sLabel, $sName, $bShowFolders = true, $bShowDocs = true) {
        $this->show_documents = $bShowDocs;
        $this->show_folders = $bShowFolders;
        parent::BrowseColumn($sLabel, $sName);
    }

    function renderHeader($sReturnURL) { 
        global $main;
    }
    
    // only include the _f or _d IF WE HAVE THE OTHER TYPE.
    function renderData($aDataRow) { 
        $localname = $this->name;
        
        if (($aDataRow["type"] === "folder") && ($this->show_folders)) { 
            if ($this->show_documents) {
                $localname .= "_f"; 
            }
            $v = $aDataRow["folderid"]; 
        } else if (($aDataRow["type"] === "document") && $this->show_documents) { 
            if ($this->show_folders) {
                $localname .= "_d"; 
            }
            $v = $aDataRow["docid"]; 
        } else { 
            return '&nbsp;'; 
        }
        
        return '<input type="radio" name="' . $localname . '" value="' . $v . '"/>';
    }
    
}


class WorkflowColumn extends BrowseColumn {

    function renderHeader($sReturnURL) {         
        $text = $this->label; 
        $href = $sReturnURL . "&sort_on=" . $this->name . "&sort_order=";
        if ($this->sort_on) {
            $href .= $this->sort_direction == "asc" ? "desc" : "asc" ;
        } else {
            $href .= $this->sort_direction = "asc";
        }
        
        return '<a href="' . $href . '">'.$text.'</a>';
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
        $localname = $this->name;

        
        // only _ever_ show this folder documents.
        if ($aDataRow["type"] === "folder") { 
            return '&nbsp;';
        }
        
        $oWorkflow = KTWorkflowUtil::getWorkflowForDocument($aDataRow['document']);
        $oState = KTWorkflowUtil::getWorkflowStateForDocument($aDataRow['document']);
        if (($oState == null) || ($oWorkflow == null)) {
            return '&mdash;';
        } else {
            return $oState->getName() . ' <span class="descriptiveText">(' . $oWorkflow->getName() . ')</span>';
        }
    }
}

class DownloadColumn extends BrowseColumn {
    
    function renderHeader($sReturnURL) {         
        $text = '&nbsp;'; 
        
        return $text;
    }
    

    function renderData($aDataRow) { 
        $localname = $this->name;

        
        // only _ever_ show this folder documents.
        if ($aDataRow["type"] === "folder") { 
            return '&nbsp;';
        }
    
        // FIXME at some point we may want to hide this if the user doens't have the download action, but its OK for now.
        $link = KTUtil::ktLink('action.php','ktcore.actions.document.view', 'fDocumentId=' . $aDataRow['document']->getId());
        $outStr = sprintf('<a href="%s" class="ktAction ktDownload" title="%s">%s</a>', $link, _kt('Download Document'), _kt('Download Document'));
        return $outStr;
    }
}

?>
