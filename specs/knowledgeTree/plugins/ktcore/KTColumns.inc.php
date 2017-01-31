<?php

// more advanced, intelligent columns.

require_once(KT_LIB_DIR . '/browse/advancedcolumns.inc.php');

class AdvancedTitleColumn extends AdvancedColumn {
    var $name = 'title';
    var $namespace = 'ktcore.columns.title';
    var $sortable = true;
    var $aOptions = array();
    var $aIconPaths = array();
    var $link_folders = true;
    var $link_documents = true;

    function setOptions($aOptions) {        
        $this->link_folders = KTUtil::arrayGet($aOptions, 'link_folders', $this->link_folders, false);
        $this->link_documents = KTUtil::arrayGet($aOptions, 'link_documents', $this->link_documents, false);        
        parent::setOptions($aOptions);
    }
    
    function AdvancedTitleColumn() {
        $this->label = _kt("Title");
    }    
       
    // what is used for sorting 
    // query addition is:
    //    [0] => join claus
    //    [1] => join params
    //    [2] => ORDER 
    
    function addToFolderQuery() { 
        return array(null, 
            null, 
            "F.name",
        ); 
    }
    function addToDocumentQuery() { 
            return array(null, 
            null, 
            "DM.name"
        ); 
    }

    
    function renderFolderLink($aDataRow) {
        $outStr = htmlentities($aDataRow["folder"]->getName(), ENT_NOQUOTES, 'UTF-8');
        if($this->link_folders) {
            $outStr = '<a href="' . $this->buildFolderLink($aDataRow) . '">' . $outStr . '</a>';
        }
        return $outStr;
    }

    function renderDocumentLink($aDataRow) {
        /* this chack has to be done so that any titles longer than 40 characters is not displayed incorrectly.
         as mozilla cannot wrap text without white spaces */
        if(strlen($aDataRow["document"]->getName()) > 40){
            $outStr = htmlentities(substr($aDataRow["document"]->getName(), 0, 40)."...", ENT_NOQUOTES, 'UTF-8');
        }else{
            $outStr = htmlentities($aDataRow["document"]->getName(), ENT_NOQUOTES, 'UTF-8');
        }
        
        if($this->link_documents) {
            $outStr = '<a href="' . $this->buildDocumentLink($aDataRow) . '" title="' . $aDataRow["document"]->getFilename().'">' . 
                $outStr . '</a>';
        }
        return $outStr;
    }

    function buildDocumentLink($aDataRow) {
        return KTBrowseUtil::getUrlForDocument($aDataRow["document"]->getId());
    }


    // 'folder_link' allows you to link to a different URL when you're connecting, instead of addQueryStringSelf
    // 'direct_folder' means that you want to go to 'browse folder'
    // 'qs_params' is an array (or string!) of params to add to the link

    function buildFolderLink($aDataRow) {
        if (is_null(KTUtil::arrayGet($this->aOptions, 'direct_folder'))) {
            $dest = KTUtil::arrayGet($this->aOptions, 'folder_link');
	    $params = kt_array_merge(KTUtil::arrayGet($this->aOptions, 'qs_params', array()), 
				     array('fFolderId' => $aDataRow['folder']->getId()));

            if (empty($dest)) {
                return KTUtil::addQueryStringSelf($params);
            } else {
                return KTUtil::addQueryString($dest, $params);
            }

        } else {
            return KTBrowseUtil::getUrlForFolder($aDataRow['folder']);
        }
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) {     
       if ($aDataRow["type"] == "folder") {
           $contenttype = 'folder';
           $link = $this->renderFolderLink($aDataRow);
           return sprintf('<span class="contenttype %s">%s</span>', $contenttype, $link);
        } else {
           $contenttype = $this->_mimeHelper($aDataRow["document"]->getMimeTypeId());
           $link = $this->renderDocumentLink($aDataRow);
           $size = $this->prettySize($aDataRow["document"]->getSize());
           return sprintf('<span class="contenttype %s">%s (%s)</span>', $contenttype, $link, $size);
        }
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

/* 
 * Column to handle dates
 */

class AdvancedDateColumn extends AdvancedColumn {
    var $name = 'datecolumn';

    var $document_field_function;
    var $folder_field_function;
    var $sortable = true;    
    var $document_sort_column;
    var $folder_sort_column;
    var $namespace = 'ktcore.columns.genericdate';
    
    function AdvancedDateColumn() {
        $this->label = _kt('Generic Date Function');
    }

    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
        $outStr = '';
        if (($aDataRow["type"] == "folder") && (!is_null($this->folder_field_function))) {
            $res = call_user_func(array($aDataRow["folder"],  $this->folder_field_function));
            $dColumnDate = strtotime($res);

            // now reformat this into something "pretty"
            return date("Y-m-d H:i", $dColumnDate);
 
        } else if (($aDataRow["type"] == "document") && (!is_null($this->document_field_function))) {
            $res = call_user_func(array($aDataRow["document"],  $this->document_field_function));
            $dColumnDate = strtotime($res);

            // now reformat this into something "pretty"
            return date("Y-m-d H:i", $dColumnDate);
        } else {
            return '&mdash;';
        }
        return $outStr;
    }

    function addToFolderQuery() {
        return array(null, null, null);
    }
    function addToDocumentQuery() {
        return array(null, null, $this->document_sort_column);
    }
}

class CreationDateColumn extends AdvancedDateColumn {
    var $document_field_function = 'getCreatedDateTime';
    var $folder_field_function = null;
    
    var $document_sort_column = "D.created";
    var $folder_sort_column = null;
    var $namespace = 'ktcore.columns.creationdate';
    
    function CreationDateColumn() {
        $this->label = _kt('Created');
    }
}

class ModificationDateColumn extends AdvancedDateColumn {
    var $document_field_function = 'getLastModifiedDate';
    var $folder_field_function = null;
    
    var $document_sort_column = "D.modified";
    var $folder_sort_column = null;
    var $namespace = 'ktcore.columns.modificationdate';
    
    function ModificationDateColumn() {
        $this->label = _kt('Modified');
    }
}

class AdvancedUserColumn extends AdvancedColumn {
    var $document_field_function;
    var $folder_field_function;
    var $sortable = false; // by default    
    var $document_sort_column;
    var $folder_sort_column;
    var $namespace = 'ktcore.columns.genericuser';
    
    function AdvancedUserColumn() {
        $this->label = null; // abstract.        
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
        $iUserId = null;
        if (($aDataRow["type"] == "folder") && (!is_null($this->folder_field_function))) {
            if (method_exists($aDataRow['folder'], $this->folder_field_function)) {
                $iUserId = call_user_func(array($aDataRow['folder'], $this->folder_field_function)); 
            }
        } else if (($aDataRow["type"] == "document") && (!is_null($this->document_field_function))) {
            if (method_exists($aDataRow['document'], $this->document_field_function)) {
                $iUserId = call_user_func(array($aDataRow['document'], $this->document_field_function)); 
            }
        }
        if (is_null($iUserId)) {
            return '&mdash;';
        }
        $oUser = User::get($iUserId);
        if (PEAR::isError($oUser) || $oUser == false) {
            return '&mdash;';
        } else {
            return htmlentities($oUser->getName(), ENT_NOQUOTES, 'UTF-8');
        }
    }

    function addToFolderQuery() {
        return array(null, null, null);
    }
    
    function addToDocumentQuery() {
        return array(null, null, null);
    }
}

class CreatorColumn extends AdvancedUserColumn {
    var $document_field_function = "getCreatorID";
    var $folder_field_function = null;
    var $sortable = true; // by default    
    var $namespace = 'ktcore.columns.creator';
    
    function CreatorColumn() {
        $this->label = _kt("Creator"); // abstract.        
    }

    function addToFolderQuery() {
        return array(null, null, null);
    }
    function addToDocumentQuery() {
        $sUsersTable = KTUtil::getTableName('users');
        $sJoinSQL = "LEFT JOIN $sUsersTable AS users_order_join ON (D.creator_id = users_order_join.id)";
        return array($sJoinSQL, null, "users_order_join.name"); 
    }
}

class AdvancedSelectionColumn extends AdvancedColumn {
    var $rangename = null;
    var $show_folders = true;
    var $show_documents = true;   
    
    var $namespace = "ktcore.columns.selection"; 

    function AdvancedSelectionColumn() {
        $this->label = '';
    }

    function setOptions($aOptions) {
        AdvancedColumn::setOptions($aOptions);
        $this->rangename = KTUtil::arrayGet($this->aOptions, 'rangename', $this->rangename);
        $this->show_folders = KTUtil::arrayGet($this->aOptions, 'show_folders', $this->show_folders, false);        
        $this->show_documents = KTUtil::arrayGet($this->aOptions, 'show_documents', $this->show_documents, false);                
    }

    function renderHeader($sReturnURL) { 
        global $main;
        $main->requireJSResource("resources/js/toggleselect.js");
        
        return sprintf('<input type="checkbox" title="toggle all" onclick="toggleSelectFor(this, \'%s\')" />', $this->rangename);
        
    }
    
    // only include the _f or _d IF WE HAVE THE OTHER TYPE.
    function renderData($aDataRow) { 
        $localname = $this->rangename;
        
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
        
        return sprintf('<input type="checkbox" name="%s" onclick="activateRow(this)" value="%s"/>', $localname, $v);
    }
    
    
    // no label, but we do have a title
    function getName() {
        return _kt("Multiple Selection");
    }
}


class AdvancedSingleSelectionColumn extends AdvancedSelectionColumn {
    var $namespace = 'ktcore.columns.singleselection';

    function AdvancedSingleSelectionColumn() {
        parent::AdvancedSelectionColumn();
        $this->label = null;
    }
    
    function renderHeader() {
        return '&nbsp;';    
    }
    
    // only include the _f or _d IF WE HAVE THE OTHER TYPE.
    function renderData($aDataRow) { 
        $localname = $this->rangename;
        
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

    // no label, but we do have a title
    function getName() {
        return _kt("Single Selection");
    }    
}


class AdvancedWorkflowColumn extends AdvancedColumn {
    var $namespace = 'ktcore.columns.workflow_state';
    var $sortable = false;

    function AdvancedWorkflowColumn() {
        $this->label = _kt("Workflow State");
        $this->sortable = false;        
    }
    
    // use inline, since its just too heavy to even _think_ about using smarty.
    function renderData($aDataRow) { 
        // only _ever_ show this for documents.
        if ($aDataRow["type"] === "folder") { 
            return '&nbsp;';
        }
        
        $oWorkflow = KTWorkflowUtil::getWorkflowForDocument($aDataRow['document']);
        $oState = KTWorkflowUtil::getWorkflowStateForDocument($aDataRow['document']);
        if (($oState == null) || ($oWorkflow == null)) {
            return '&mdash;';
        } else {
            return sprintf('%s <span class="descriptive">%s</span>',
                htmlentities($oState->getName(), ENT_NOQUOTES, 'UTF-8'),
                htmlentities($oWorkflow->getName(), ENT_NOQUOTES, 'UTF-8')
            );
        }
    }
}

class AdvancedDownloadColumn extends AdvancedColumn {

    var $namespace = 'ktcore.columns.download';
    
    function AdvancedDownloadColumn() {
        $this->label = null;
    }

    function renderData($aDataRow) { 
        // only _ever_ show this for documents.
        if ($aDataRow["type"] === "folder") { 
            return '&nbsp;';
        }
    
        $link = KTUtil::ktLink('action.php','ktcore.actions.document.view', 'fDocumentId=' . $aDataRow['document']->getId());
        return sprintf('<a href="%s" class="ktAction ktDownload" title="%s">%s</a>', $link, _kt('Download Document'), _kt('Download Document'));
    }
    
    function getName() { return _kt('Download'); }
}


class DocumentIDColumn extends AdvancedColumn {
    var $bSortable = false;
    var $namespace = 'ktcore.columns.docid';
    
    function DocumentIDColumn() {
        $this->label = _kt("Document ID");
    }

    function renderData($aDataRow) { 
        // only _ever_ show this for documents.
        if ($aDataRow["type"] === "folder") { 
            return '&nbsp;';
        }
    
        return htmlentities($aDataRow['document']->getId(), ENT_NOQUOTES, 'UTF-8');
    }
}

class ContainingFolderColumn extends AdvancedColumn {

    var $namespace = 'ktcore.columns.containing_folder';
    
    function ContainingFolderColumn() {
        $this->label = _kt("View Folder");
    }

    function renderData($aDataRow) { 
        // only _ever_ show this for documents.
        if ($aDataRow["type"] === "folder") { 
            return '&nbsp;';
        }
    
        $link = KTBrowseUtil::getUrlForFolder($aDataRow['document']->getFolderId());
        return sprintf('<a href="%s" class="ktAction ktMoveUp" title="%s">%s</a>', $link, _kt('View Folder'), _kt('View Folder'));
    }
    
    function getName() { return _kt('Opening Containing Folder'); }
}

?>
