<?php

/**
 * $Id: dispatchervalidation.inc.php 5825 2006-08-16 10:31:11Z bshuttle $
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

require_once(KT_LIB_DIR . '/validation/errorviewer.inc.php');

class KTDispatcherValidation {
    function KTDispatcherValidation(&$oDispatcher) {
        $this->oDispatcher =& $oDispatcher;
    }

    function &validateFolder ($iId, $aOptions = null) {
        return $this->validateEntity('Folder', $iId, $aOptions);
    }

    function &validateDocument ($iId, $aOptions = null) {
        return $this->validateEntity('Document', $iId, $aOptions);
    }

    function &validateDocumentType ($iId, $aOptions = null) {
        return $this->validateEntity('DocumentType', $iId, $aOptions);
    }

    function &validatePermissionByName ($iId, $aOptions = null) {
        $aOptions = KTUtil::meldOptions($aOptions, array(
            'method' => 'getByName',
        ));
        return $this->validateEntity('KTPermission', $iId, $aOptions);
    }

    function userHasPermissionOnItem($oUser, $oPermission, $oItem, $aOptions = null) {
        require_once(KT_LIB_DIR . '/permissions/permissionutil.inc.php');
        if (KTPermissionUtil::userHasPermissionOnItem($oUser, $oPermission, $oItem)) {
            return;
        }
        $this->oDispatcher->errorPage(_kt("Insufficient permissions to perform action"));
    }

    function &validateEntity($entity_name, $iId, $aOptions = null) {
        $aOptions = (array)$aOptions;

        $aFunc = array($entity_name, KTUtil::arrayGet($aOptions, 'method', 'get'));
        $oEntity =& call_user_func($aFunc, $iId);
        if (PEAR::isError($oEntity) || ($oEntity === false)) {
            $aOptions['message'] = KTUtil::arrayGet($aOptions, 'message', sprintf(_kt("Invalid identifier provided for: %s"), $entity_name));
            $this->handleError($aOptions);
        }
        return $oEntity;
    }

    function notError(&$res, $aOptions = null) {
        $aOptions = (array)$aOptions;
        if (PEAR::isError($res)) {
            if (!KTUtil::arrayGet($aOptions, 'no_exception')) {
                $aOptions = KTUTil::meldOptions($aOptions, array(
                    'exception' => $res,
                ));
            }
            $this->handleError($aOptions);
        }
    }

    function notErrorFalse(&$res, $aOptions = null) {
        $aOptions = (array)$aOptions;
        if (PEAR::isError($res) || ($res === false)) {
            $aOptions = KTUTil::meldOptions($aOptions, array(
                'exception' => $res,
            ));
            $this->handleError($aOptions);
        }
    }

    function &notEmpty(&$res, $aOptions = null) {
        $aOptions = (array)$aOptions;
        if (empty($res) || PEAR::isError($res)) {
            $this->handleError($aOptions);
        }
        return $res;
    }

    function handleError($aOptions = null) {
        $aOptions = (array)$aOptions;
        $aRedirectTo = KTUtil::arrayGet($aOptions, 'redirect_to');
        $oException = KTUtil::arrayGet($aOptions, 'exception');
        $sMessage = KTUtil::arrayGet($aOptions, 'message');
        $sDefaultMessage = KTUtil::arrayGet($aOptions, 'defaultmessage');
        if (empty($sMessage)) {
            if ($oException) {
                $oEVRegistry = KTErrorViewerRegistry::getSingleton();
                $oViewer = $oEVRegistry->getViewer($oException);
                $sMessage = $oViewer->view();
            } elseif ($sDefaultMessage) {
                $sMessage = $sDefaultMessage;
            } else {
                $sMessage = _kt("An error occurred, and no error message was given");
            }
        } else {
            if ($oException) {
                $sMessage .= ': ' . $oException->getMessage();
            }
        }
        if ($aRedirectTo) {
            $aRedirectParams = KTUtil::arrayGet($aRedirectTo, 1);
            $aRealRedirectTo = array($aRedirectTo[0], $sMessage, $aRedirectParams);
            $aRealRedirectTo[] = $oException;
            call_user_func_array(array($this->oDispatcher, 'errorRedirectTo'), $aRealRedirectTo);
        }
        $this->oDispatcher->errorPage($sMessage, $oException);
    }

    function &validateTemplate($sTemplateName, $aOptions = null) {
        $oTemplating =& KTTemplating::getSingleton();
        $oTemplate =& $oTemplating->loadTemplate($sTemplateName);
        $aOptions['message'] = KTUtil::arrayGet($aOptions, 'message', _kt('Failed to locate template'));
        $this->notError($oTemplate, $aOptions);
        return $oTemplate;
    }

    function &validateWorkflow($iId, $aOptions = null) {
        return $this->validateEntity('KTWorkflow', $iId, $aOptions);
    }

    function &validateWorkflowState($iId, $aOptions = null) {
        return $this->validateEntity('KTWorkflowState', $iId, $aOptions);
    }

    function &validateWorkflowTransition($iId, $aOptions = null) {
        return $this->validateEntity('KTWorkflowTransition', $iId, $aOptions);
    }

    function &validatePermission($iId, $aOptions = null) {
        return $this->validateEntity('KTPermission', $iId, $aOptions);
    }

    function &validateLookup($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/documentmanagement/MetaData.inc');
        return $this->validateEntity('MetaData', $iId, $aOptions);
    }

    function &validateFieldset($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/metadata/fieldset.inc.php');
        return $this->validateEntity('KTFieldset', $iId, $aOptions);
    }

    function &validateField($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/documentmanagement/DocumentField.inc');
        return $this->validateEntity('DocumentField', $iId, $aOptions);
    }

    function &validateBehaviour($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/metadata/fieldbehaviour.inc.php');
        return $this->validateEntity('KTFieldBehaviour', $iId, $aOptions);
    }

    function &validateRole($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/roles/Role.inc');
        return $this->validateEntity('Role', $iId, $aOptions);
    }

    function &validateGroup($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/groups/Group.inc');
        return $this->validateEntity('Group', $iId, $aOptions);
    }

    function &validateUser($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/users/User.inc');
        return $this->validateEntity('User', $iId, $aOptions);
    }

    function &validateCondition($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/search/savedsearch.inc.php');
        $oSearch = $this->validateEntity('KTSavedSearch', $iId, $aOptions);
        if ($oSearch->getIsCondition()) {
            return $oSearch;
        }
        $aOptions = KTUTil::meldOptions($aOptions, array(
            'message' => _kt("Condition is a saved search, but not a condition"),
        ));
        $this->handleError($aOptions);
    }

    function validateString($sString, $aOptions = null) {
        $sString = trim($sString);
        if (empty($sString)) {
            $aOptions['message'] = KTUtil::arrayGet($aOptions,
                    'message', _kt("An empty string was given"));
            $this->handleError($aOptions);
        }

	$iMaxlen = (int)KTUtil::arrayGet($aOptions, 'max_str_len', false);
	if($iMaxlen !== false && $iMaxlen !== 0 && strlen($sString) > $iMaxlen) {
	    $aOptions['message'] = KTUtil::arrayGet($aOptions, 
						    'max_str_len_message', 
						    _kt("The string is too long: the maximum length in characters is ") . $iMaxlen);
	    $this->handleError($aOptions);						    
	}

        return $sString;
    }

    // validate a STRING to an integer
    function validateInteger($sInteger, $aOptions = null) {
        $sInteger = trim($sInteger);
        if (empty($sInteger)) {
            $aOptions['message'] = KTUtil::arrayGet($aOptions, 'message', _kt("An empty value was given"));
            $this->handleError($aOptions);
        }

	if(!is_numeric($sInteger)) {
            $aOptions['message'] = KTUtil::arrayGet($aOptions, 'message', _kt("A non-numeric value was given"));
            $this->handleError($aOptions);
        }	    

        return intval($sInteger);
    }

    function validateFile($aFile, $aOptions = null) {
        $bError = false;
        
        if (strlen(trim($aFile['name'])) == 0) {
            $bError = true;
        } else {
            $bError = KTUtil::arrayGet($aFile, 'error');
        }
        
        if ($bError) {
            $message = _kt("You did not select a valid document to upload");

            $errors = array(
               1 => _kt("The uploaded file is larger than the PHP upload_max_filesize setting"),
               2 => _kt("The uploaded file is larger than the MAX_FILE_SIZE directive that was specified in the HTML form"),
               3 => _kt("The uploaded file was not fully uploaded to the document management system"),
               4 => _kt("No file was selected to be uploaded to the document management system"),
               6 => _kt("An internal error occurred receiving the uploaded document"),
            );
            $message = KTUtil::arrayGet($errors, $aFile['error'], $message);

            if (@ini_get("file_uploads") == false) {
                $message = _kt("File uploads are disabled in your PHP configuration");
            }
            $aOptions['message'] = $message;
            $this->handleError($aOptions);
        }
        return $aFile;
    }

    function &validateDynamicCondition($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/permissions/permissiondynamiccondition.inc.php');
        return $this->validateEntity('KTPermissionDynamicCondition', $iId, $aOptions);
    }

    function &validateUnit($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/unitmanagement/Unit.inc');
        return $this->validateEntity('Unit', $iId, $aOptions);
    }

    function &validateAuthenticationSource($iId, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/authentication/authenticationsource.inc.php');
        return $this->validateEntity('KTAuthenticationSource', $iId, $aOptions);
    }

    function validateAuthenticationProvider($sNamespace, $aOptions = null) {
        require_once(KT_LIB_DIR .  '/authentication/authenticationprovider.inc.php');
        $oRegistry =& KTAuthenticationProviderRegistry::getSingleton();
        $aProviders = $oRegistry->getAuthenticationProvidersInfo();
        foreach ($aProviders as $aProvider) {
            if ($sNamespace == $aProvider[2]) {
                return $sNamespace;
            }
        }
        $aOptions = $aOptions;
        $aOptions['message'] = KTUtil::arrayGet($aOptions, 'message', _kt("Invalid authentication source"));
        $this->handleError($aOptions);
        return $sNamespace;
    }

    function validateDict($aDict, $aValidation, $aOptions = null) {
        foreach ($aValidation as $k => $aValidatorInfo) {
            $sDictValue = KTUtil::arrayGet($aDict, $k, null);
            if (empty($sDictValue)) {
                /*
                if (strstr($v, '_or_null')) {
                    $aValidatedDict[$k] = null;
                }
                if (strstr($v, '_or_empty')) {
                    $aValidatedDict[$k] = '';
                }
                */
                $aErrors[$k] = PEAR::raiseError(sprintf(_kt("Required value %s not set"), $k));
                continue;
            }
            $sValidationFunction = $this->_generateValidationFunction($aValidatorInfo['type']);
            if (!method_exists($this, $sValidationFunction)) {
                $aErrors[$k] = PEAR::raiseError(sprintf(_kt("Unknown validation function for required value %s"), $k));
                continue;
            }
            $aKeyInfo = array('var' => $k);
            $this->$sValidationFunction($aKeyInfo, $sDictValue);
            $aValidatedDict[$k] = $sDictValue;
        }
        if ($aErrors) {
            $aErrorsString = '';
            foreach ($aErrors as $k => $v) {
                $aErrorsString .= $v->getMessage();
            }
            $this->oDispatcher->errorPage($aErrorsString);
        }
        return $aValidatedDict;
    }

    function _generateValidationFunction($v) {
        $iEnd = strstr($v, '_or_');
        if ($iEnd) {
            $v = substr($v, 0, $iEnd);
        }
        return '_validate' . $v;
    }

    function _validateworkflow($aKeyInfo, $id) {
        return $this->_validateentity($aKeyInfo, 'KTWorkflow', $id);
    }

    function _validateworkflowtransition($aKeyInfo, $id) {
        return $this->_validateentity($aKeyInfo, 'KTWorkflowTransition', $id);
    }
    function _validateworkflowstate($aKeyInfo, $id) {
        return $this->_validateentity($aKeyInfo, 'KTWorkflowState', $id);
    }

    function _validateentity($aKeyInfo, $entity_name, $iId, $aOptions = null) {
        $aFunc = array($entity_name, KTUtil::arrayGet($aOptions, 'method', 'get'));
        $oEntity =& call_user_func($aFunc, $iId);
        if (PEAR::isError($oEntity) || ($oEntity === false)) {
            return PEAR::raiseError(sprintf(_kt("Provided variable %s is not a valid %s"), $aKeyInfo['var'], $entity_name));
        }
        return $oEntity;
    }
    
    
    
    
    
    /* unlike the KTEmail version, this only handles ONE email address */
    function validateEmailAddress($sEmailAddress, $aOptions = null) {
        $sEmailAddress = trim($sEmailAddress);
        
        if (!ereg ("^[^@ ]+@[^@ ]+\.[^@ \.]+$", $sEmailAddress )) {
            $aOptions['message'] = KTUtil::arrayGet($aOptions,
                                                    'message', 
                                                    _kt("This is not a valid email address."));
            $this->handleError($aOptions);
        }
        return $sEmailAddress;
    }
    
    
    /* just does an empty string validation with an appropriate message, and then a duplicate name validation */
    function validateEntityName($sEntityTypeName, $sName, $aOptions = null) {
        $aOptions['message'] = KTUtil::arrayGet($aOptions, 'empty_message', _kt("No name was given for this item"));
        
        $sName = $this->validateString($sName, $aOptions);
        $aOptions['message'] = KTUtil::arrayGet($aOptions, 'duplicate_message', _kt("An item with this name already exists"));
        return $this->validateDuplicateName($sEntityTypeName, $sName, $aOptions);
    }

    function validateDuplicateName($sClass, $sName, $aOptions = null) {
        $aMethod = array('KTEntityUtil', 'getByDict');
        $aConditions = KTUtil::arrayGet($aOptions, 'condition', array());
        $aConditions['name'] = $sName;
        $iRename = KTUtil::arrayGet($aOptions, 'rename');
        if ($iRename) {
            $aConditions['id'] = array('type' => 'nequals', 'value' => $iRename);
        }
        $aOptions['ids'] = true;
        $aOptions['multi'] = true;
        $aList = call_user_func($aMethod, $sClass, $aConditions, $aOptions);
        if(count($aList)) {
            $aOptions['defaultmessage'] = sprintf(_kt("An entity with that name already exists: class %s, name %s"), $sClass, $sName);
            $this->handleError($aOptions);
        }
        return $sName;
    }

    function validatePasswordMatch($sPassword, $sConfirmPassword, $aOptions = null) {
        $aOptions = (array)$aOptions;
        $aOptions['message'] = _kt('No password was provided');
        $sPassword = $this->validateString($sPassword, $aOptions);
        $aOptions['message'] = _kt('No password confirmation was provided');
        $sConfirmPassword = $this->validateString($sConfirmPassword, $aOptions);
        if ($sPassword === $sConfirmPassword) {
            return $sPassword;
        }
        $aOptions['message'] = _kt('Password and confirmation password do not match');
        $this->handleError($aOptions);
    }
            

}

?>
