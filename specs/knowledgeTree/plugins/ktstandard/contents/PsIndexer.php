<?php

/**
 * $Id: PsIndexer.php 6025 2006-10-18 07:33:48Z nbm $
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

class KTPostscriptIndexerTrigger extends KTBaseIndexerTrigger {
    var $mimetypes = array(
       'application/postscript' => true,
    );
    var $command = 'pstotext';          // could be any application.
    var $commandconfig = 'indexer/pstotext';          // could be any application.
    var $args = array();
    var $use_pipes = true;
    
    function findLocalCommand() {   
        $sCommand = KTUtil::findCommand($this->commandconfig, $this->command);
        return $sCommand;
    }    
    
    function getDiagnostic() {
        return null; // KTS-1335: don't show diagnostic message for PostScript
        $sCommand = $this->findLocalCommand();
        
        if (OS_WINDOWS) {
            return null; // _kt("The PS indexer does not currently index PS documents on Windows.");
        }
        
        // can't find the local command.
        if (empty($sCommand)) {
            return sprintf(_kt('Unable to find required command for indexing.  Please ensure that <strong>%s</strong> is installed and in the KnowledgeTree Path.  For more information on indexers and helper applications, please <a href="%s">visit the KTDMS site</a>.'), $this->command, $this->support_url);
        }
        
        return null;
    }
}

?>
