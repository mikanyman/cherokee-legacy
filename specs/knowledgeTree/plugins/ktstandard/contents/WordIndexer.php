<?php

/**
 * $Id: WordIndexer.php 5758 2006-07-27 10:17:43Z bshuttle $
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

require_once(KT_DIR . '/plugins/ktstandard/contents/BaseIndexer.php');

class KTWordIndexerTrigger extends KTBaseIndexerTrigger {
    var $mimetypes = array(
       'application/msword' => true,
    );
    var $command = 'catdoc';          // could be any application.
    var $commandconfig = 'indexer/catdoc';          // could be any application.
    var $args = array("-w", "-d", "UTF-8");
    var $use_pipes = true;
    
    function extract_contents($sFilename, $sTempFilename) {
        if (OS_WINDOWS) {	    
            $this->command = 'c:\antiword\antiword.exe';
            $this->commandconfig = 'indexer/antiword';
            $this->args = array();

	    $sCommand = KTUtil::findCommand($this->commandconfig, $this->command);
	    $sDir = dirname(dirname($sCommand));
	    putenv('HOME=' . $sDir);
        }
	putenv('LANG=en_US.UTF-8');
        return parent::extract_contents($sFilename, $sTempFilename);
    }
    
    function findLocalCommand() {
        if (OS_WINDOWS) {
            $this->command = 'c:\antiword\antiword.exe';
            $this->commandconfig = 'indexer/antiword';
            $this->args = array();
        }        
        $sCommand = KTUtil::findCommand($this->commandconfig, $this->command);
        return $sCommand;
    }
    
    function getDiagnostic() {
        $sCommand = $this->findLocalCommand();
        
        // can't find the local command.
        if (empty($sCommand)) {
            return sprintf(_kt('Unable to find required command for indexing.  Please ensure that <strong>%s</strong> is installed and in the KnowledgeTree Path.  For more information on indexers and helper applications, please <a href="%s">visit the KTDMS site</a>.'), $this->command, $this->support_url);
        }
        
        return null;
    }
}

?>
