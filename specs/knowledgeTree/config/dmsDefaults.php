<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 foldmethod=marker: */

/**
 * $Id: dmsDefaults.php 6152 2007-01-03 14:20:40Z conradverm $
 *
 * Defines KnowledgeTree application defaults.
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

if (function_exists('apd_set_pprof_trace')) {
    apd_set_pprof_trace();
}

// Default settings differ, we need some of these, so force the matter.
// Can be overridden here if actually necessary.
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('magic_quotes_runtime', '0');
ini_set('arg_separator.output', '&');

$microtime_simple = explode(' ', microtime());

$_KT_starttime = (float) $microtime_simple[1] + (float) $microtime_simple[0];
unset($microtime_simple);

// If not defined, set KT_DIR based on my usual location in the tree
if (!defined('KT_DIR')) {
    $rootLoc = realpath(dirname(__FILE__) . '/..');
    if (OS_WINDOWS) {
            $rootLoc = str_replace('\\','/',$rootLoc);    
    }
    define('KT_DIR', $rootLoc);
}

if (!defined('KT_LIB_DIR')) {
    define('KT_LIB_DIR', KT_DIR . '/lib');
}

// PATH_SEPARATOR added in PHP 4.3.0
if (!defined('PATH_SEPARATOR')) {
    if (substr(PHP_OS, 0, 3) == 'WIN') {
        define('PATH_SEPARATOR', ';');
    } else {
        define('PATH_SEPARATOR', ':');
    }
}

require_once(KT_LIB_DIR . '/Log.inc');

// {{{ KTInit
class KTInit {
    // {{{ prependPath()
    function prependPath ($path) {
        $include_path = ini_get('include_path');
        ini_set('include_path', $path . PATH_SEPARATOR . $include_path);
    }
    // }}}

    // {{{ setupLogging()
    function setupLogging () {
        global $default;
        require_once(KT_LIB_DIR . '/Log.inc');
        $oKTConfig =& KTConfig::getSingleton();
        $logLevel = $default->logLevel;
        if (!is_numeric($logLevel)) {
            $logLevel = @constant($logLevel);
            if (is_null($logLevel)) {
                $logLevel = @constant("ERROR");
            }
        }
        $default->log = new KTLegacyLog($oKTConfig->get('urls/logDirectory'), $logLevel);
        $res = $default->log->initialiseLogFile();
        if (PEAR::isError($res)) {
            $this->handleInitError($res);
            // returns only in checkup
            return $res;
        }
        $default->queryLog = new KTLegacyLog($oKTConfig->get('urls/logDirectory'), $logLevel, "query");
        $res = $default->queryLog->initialiseLogFile();
        if (PEAR::isError($res)) {
            $this->handleInitError($res);
            // returns only in checkup
            return $res;
        }
        $default->timerLog = new KTLegacyLog($oKTConfig->get('urls/logDirectory'), $logLevel, "timer");
        $res = $default->timerLog->initialiseLogFile();
        if (PEAR::isError($res)) {
            $this->handleInitError($res);
            // returns only in checkup
            return $res;
        }

        require_once("Log.php");
        $default->phpErrorLog =& Log::factory('composite');

        if ($default->phpErrorLogFile) {
            $fileLog =& Log::factory('file', $oKTConfig->get('urls/logDirectory') . '/php_error_log', 'KT');
            $default->phpErrorLog->addChild($fileLog);
        }

        if ($default->developmentWindowLog) {
            $windowLog =& Log::factory('win', 'LogWindow', 'BLAH');
            $default->phpErrorLog->addChild($windowLog);
        }
    }
    // }}}

    // {{{ setupI18n()
    /**
     * setupI18n
     *
     */
    function setupI18n () {
        require_once(KT_LIB_DIR . '/i18n/i18nutil.inc.php');
        require_once("HTTP.php");
        global $default;
        $language = KTUtil::arrayGet($_COOKIE, 'kt_language');
        if ($language) {
            $default->defaultLanguage = $language;
        }
    }
    // }}}

    // {{{ setupDB()
    function setupDB () {
        global $default;

        require_once("DB.php");

        // DBCompat allows phplib API compatibility
        require_once(KT_LIB_DIR . '/database/dbcompat.inc');
        $default->db = new DBCompat;

        // DBUtil is the preferred database abstraction
        require_once(KT_LIB_DIR . '/database/dbutil.inc');

        // KTEntity is the database-backed base class
        require_once(KT_LIB_DIR . '/ktentity.inc');

        $oKTConfig =& KTConfig::getSingleton();

        $dsn = array(
            'phptype'  => $oKTConfig->get('db/dbType'),
            'username' => $oKTConfig->get('db/dbUser'),
            'password' => $oKTConfig->get('db/dbPass'),
            'hostspec' => $oKTConfig->get('db/dbHost'),
            'database' => $oKTConfig->get('db/dbName'),
            'port' => $oKTConfig->get('db/dbPort'),
        );

        $options = array(
            'debug'       => 2,
            'portability' => DB_PORTABILITY_ERRORS,
            'seqname_format' => 'zseq_%s',
        );

        $default->_db = &DB::connect($dsn, $options);
        if (PEAR::isError($default->_db)) {
            $this->handleInitError($default->_db);
            // returns only in checkup
            return $default->_db;
        }
        $default->_db->setFetchMode(DB_FETCHMODE_ASSOC);

    }
    /// }}}

    // {{{ cleanGlobals()
    function cleanGlobals () {
        /* 
         * Borrowed from TikiWiki
         * 
         * Copyright (c) 2002-2004, Luis Argerich, Garland Foster,
         * Eduardo Polidor, et. al.
         */
        if (ini_get('register_globals')) {
            foreach (array($_ENV, $_GET, $_POST, $_COOKIE, $_SERVER) as $superglob) {
                foreach ($superglob as $key => $val) {
                    if (isset($GLOBALS[$key]) && $GLOBALS[$key] == $val) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }
    // }}}

    // {{{ cleanMagicQuotesItem()
    function cleanMagicQuotesItem (&$var) {
        if (is_array($var)) {
            foreach ($var as $key => $val) {
                $this->cleanMagicQuotesItem($var[$key]);
            }
        } else {
            // XXX: Make it look pretty
            $var = stripslashes($var);
        }
    }
    // }}}

    // {{{ cleanMagicQuotes()
    function cleanMagicQuotes () {
        if (get_magic_quotes_gpc()) {
            $this->cleanMagicQuotesItem($_GET);
            $this->cleanMagicQuotesItem($_POST);
            $this->cleanMagicQuotesItem($_REQUEST);
            $this->cleanMagicQuotesItem($_COOKIE);
        }
    }
    // }}}

    // {{{ setupServerVariables
    function setupServerVariables() {
        $oKTConfig =& KTConfig::getSingleton();
        $bPathInfoSupport = $oKTConfig->get("KnowledgeTree/pathInfoSupport");
        if ($bPathInfoSupport) {
            // KTS-21: Some environments (FastCGI only?) don't set PATH_INFO
            // correctly, but do set ORIG_PATH_INFO.
            $path_info = KTUtil::arrayGet($_SERVER, 'PATH_INFO');
            $orig_path_info = KTUtil::arrayGet($_SERVER, 'ORIG_PATH_INFO');
            if (empty($path_info) && !empty($orig_path_info)) {
                $_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
                $_SERVER["PHP_SELF"] .= $_SERVER['PATH_INFO'];
            }
            $env_path_info = KTUtil::arrayGet($_SERVER, 'REDIRECT_kt_path_info');
            if (empty($path_info) && !empty($env_path_info)) {
                $_SERVER['PATH_INFO'] = $env_path_info;
                $_SERVER["PHP_SELF"] .= $_SERVER['PATH_INFO'];
            }

            // KTS-50: IIS (and probably most non-Apache web servers) don't
            // set REQUEST_URI.  Fake it.
            $request_uri = KTUtil::arrayGet($_SERVER, 'REQUEST_URI');
            if (empty($request_uri)) {
                $_SERVER['REQUEST_URI'] = KTUtil::addQueryString($_SERVER['PHP_SELF'], $_SERVER['QUERY_STRING']);
            }
        } else {
            unset($_SERVER['PATH_INFO']);
        }

        $script_name = KTUtil::arrayGet($_SERVER, 'SCRIPT_NAME');
        $php_self = KTUtil::arrayGet($_SERVER, 'PHP_SELF');

        $kt_path_info = KTUtil::arrayGet($_REQUEST, 'kt_path_info');
        if (!empty($kt_path_info)) {
            $_SERVER["PHP_SELF"] .= "?kt_path_info=" . $kt_path_info;
            $_SERVER["PATH_INFO"] = $kt_path_info;
        }

        $oConfig =& KTConfig::getSingleton();
        $sServerName = $oConfig->get('KnowledgeTree/serverName');
        $_SERVER['HTTP_HOST'] = $sServerName;
    }
    // }}}

    // {{{ setupRandomSeed()
    function setupRandomSeed () {
        mt_srand(hexdec(substr(md5(microtime()), -8)) & 0x7fffffff);
    }
    // }}}

    // {{{ handleInitError()
    function handleInitError($oError) {
        global $checkup;
        if ($checkup === true) {
            return;
        }
        if (KTUtil::arrayGet($_SERVER, 'REQUEST_METHOD')) {
            require_once(KT_LIB_DIR . '/dispatcher.inc.php');
            $oDispatcher =& new KTErrorDispatcher($oError);
            $oDispatcher->dispatch();
        } else {
            print $oError->toString() . "\n";
        }
        exit(0);
    }
    // }}}

    // {{{ handlePHPError()
    function handlePHPError($code, $message, $file, $line) {
        global $default;

        /* Map the PHP error to a Log priority. */
        switch ($code) {
        case E_WARNING:
        case E_USER_WARNING:
            $priority = PEAR_LOG_WARNING;
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            $priority = PEAR_LOG_NOTICE;
            break;
        case E_ERROR:
        case E_USER_ERROR:
            $priority = PEAR_LOG_ERR;
            break;
        default:
            $priotity = PEAR_LOG_INFO;
        }

        if (!empty($default->phpErrorLog)) {
            $default->phpErrorLog->log($message . ' in ' . $file . ' at line ' . $line, $priority);
        }
        return false;
    }
    // }}}


    // {{{ guessRootUrl()
    function guessRootUrl() {
        $urlpath = $_SERVER['SCRIPT_NAME'];
        $bFound = false;
        $rootUrl = "";
        while ($urlpath) {
            if (file_exists(KT_DIR . '/' . $urlpath)) {
                $bFound = true;
                break;
            }
            $i = strpos($urlpath, '/');
            if ($i === false) {
                break;
            }
            $rootUrl .= substr($urlpath, 0, $i);
            $urlpath = substr($urlpath, $i + 1);
        }
        if ($bFound) {
            if ($rootUrl) {
                $rootUrl = '/' . $rootUrl;
            }
            return $rootUrl;
        }
        return "";
    }
    // }}}
    
    // {{{ initConfig
    function initConfig() {   
        global $default;
        $use_cache = false;
        $store_cache = false;
        if (file_exists(KT_DIR .  "/config/cache-path")) {
            $store_cache = true;
            $user = KTLegacyLog::running_user();
            // handle vhosts.
            $truehost = KTUtil::arrayGet($_SERVER, 'HTTP_HOST', 'default');
            $trueport = KTUtil::arrayGet($_SERVER, 'SERVER_PORT', '80'); 
            $cache_file = trim(file_get_contents(KT_DIR .  "/config/cache-path")) . '/configcache' . $user . $truehost . $trueport;
            if (!KTUtil::isAbsolutePath($cache_file)) { $cache_file = sprintf("%s/%s", KT_DIR, $cache_file); }            
            $config_file = trim(file_get_contents(KT_DIR .  "/config/config-path"));                
            if (!KTUtil::isAbsolutePath($config_file)) { $config_file = sprintf("%s/%s", KT_DIR, $config_file); }
            
            $exists = file_exists($cache_file);
            if ($exists) {
                $cachestat = stat($cache_file);
                $configstat = stat($config_file);
                $tval = 9;
                // print sprintf("is %d > %d\n", $cachestat[$tval], $configstat[$tval]);        
                if ($cachestat[$tval] > $configstat[$tval]) {
                    $use_cache = true;
                }
            } 
            
            
        }
        
        if ($use_cache) {
            $oKTConfig =& KTConfig::getSingleton();
            $oKTConfig->loadCache($cache_file);
            
            foreach ($oKTConfig->flat as $k => $v) {
                $default->$k = $oKTConfig->get($k);
            }
        } else {
            $oKTConfig =& KTConfig::getSingleton();

            $oKTConfig->setdefaultns("KnowledgeTree", "fileSystemRoot", KT_DIR);
            $oKTConfig->setdefaultns("KnowledgeTree", "serverName", KTUtil::arrayGet($_SERVER, 'HTTP_HOST', 'localhost'));
            $oKTConfig->setdefaultns("KnowledgeTree", "sslEnabled", false);
            if (array_key_exists('HTTPS', $_SERVER)) {
                if (strtolower($_SERVER['HTTPS']) === 'on') {
                    $oKTConfig->setdefaultns("KnowledgeTree", "sslEnabled", true);
                }
            }
            $oKTConfig->setdefaultns("KnowledgeTree", "useNewDashboard", true);
            $oKTConfig->setdefaultns("KnowledgeTree", "rootUrl", $this->guessRootUrl());
            $oKTConfig->setdefaultns("KnowledgeTree", "execSearchPath", $_SERVER['PATH']);
            $oKTConfig->setdefaultns("KnowledgeTree", "pathInfoSupport", false);
            $oKTConfig->setdefaultns("storage", "manager", 'KTOnDiskHashedStorageManager');
            $oKTConfig->setdefaultns("config", "useDatabaseConfiguration", false);

            $oKTConfig->setdefaultns("urls", "tmpDirectory", '${varDirectory}/tmp');       
            $oKTConfig->setdefaultns("urls", 'stopwordsFile', '${fileSystemRoot}/config/stopwords.txt');
            
            $oKTConfig->setdefaultns("tweaks", "browseToUnitFolder", false);
            $oKTConfig->setdefaultns("tweaks", "genericMetaDataRequired", true);
            $oKTConfig->setdefaultns("tweaks", "phpErrorLogFile", false);
            $oKTConfig->setdefaultns("tweaks", "developmentWindowLog", false);
            $oKTConfig->setdefaultns("tweaks", "noisyBulkOperations", false);            
            
            $oKTConfig->setdefaultns("user_prefs", "passwordLength", 6);
            $oKTConfig->setdefaultns("user_prefs", "restrictAdminPasswords", false);
            
            $oKTConfig->setdefaultns("session", "allowAnonymousLogin", false);
            
            $oKTConfig->setdefaultns("ui", "ieGIF", true);
            $oKTConfig->setdefaultns("ui", "alwaysShowAll", false);
            $oKTConfig->setdefaultns("ui", "condensedAdminUI", false);
            
            $oKTConfig->setdefaultns(null, "logLevel", 'INFO');
            $oKTConfig->setdefaultns("import", "unzip", 'unzip');
            $oKTConfig->setdefaultns("cache", "cacheDirectory", '${varDirectory}/cache');
            $oKTConfig->setdefaultns("cache", "cacheEnabled", 'false');
            $oKTConfig->setdefaultns("cache", "proxyCacheDirectory", '${varDirectory}/proxies');
            $oKTConfig->setdefaultns("cache", "proxyCacheEnabled", 'true');
            
            $res = $this->readConfig();
            if (PEAR::isError($res)) { return $res; }
            
            $oKTConfig =& KTConfig::getSingleton();
            @touch($cache_file);
            if ($store_cache && is_writable($cache_file)) {
                $oKTConfig->createCache($cache_file);
            }
            
            
        }
    }
    // }}}

    // {{{ readConfig
    function readConfig () {
        global $default;
        $oKTConfig =& KTConfig::getSingleton();
        $sConfigFile = trim(file_get_contents(KT_DIR .  "/config/config-path"));
        if (KTUtil::isAbsolutePath($sConfigFile)) {
            $res = $oKTConfig->loadFile($sConfigFile);
        } else {
            $res = $oKTConfig->loadFile(sprintf("%s/%s", KT_DIR, $sConfigFile));
        }
        
        if (PEAR::isError($res)) { 
            $this->handleInitError($res);
            // returns only in checkup
            return $res;
        }        
        
        foreach (array_keys($oKTConfig->flat) as $k) {
            $v = $oKTConfig->get($k);
            if ($v === "default") {
                continue;
            }
            if ($v === "false") {
                $v = false;
                
            }
            if ($v === "true") {
                $v = true;
            }
            $default->$k = $v;
        }
    }
    // }}}

    // {{{ initTesting
    function initTesting() {
        $oKTConfig =& KTConfig::getSingleton();
        $sConfigFile = trim(@file_get_contents(KT_DIR .  "/config/test-config-path"));
        if (empty($sConfigFile)) {
            $sConfigFile = 'config/test.ini';
        }
        if (!KTUtil::isAbsolutePath($sConfigFile)) {
            $sConfigFile = sprintf("%s/%s", KT_DIR, $sConfigFile);
        }
        if (!file_exists($sConfigFile)) {
            $this->handleInitError(PEAR::raiseError('Test infrastructure not configured'));
            exit(0);
        }
        $res = $oKTConfig->loadFile($sConfigFile);
        if (PEAR::isError($res)) { 
            return $res;
        }            
        $_SESSION['userID'] = 1;
    }
    // }}}
}
// }}}

$KTInit = new KTInit();

$KTInit->prependPath(KT_DIR . '/thirdparty/pear');
$KTInit->prependPath(KT_DIR . '/thirdparty/Smarty');
$KTInit->prependPath(KT_DIR . '/thirdparty/simpletest');
require_once('PEAR.php');

// Give everyone access to legacy PHP functions
require_once(KT_LIB_DIR . '/util/legacy.inc');

// Give everyone access to KTUtil utility functions
require_once(KT_LIB_DIR . '/util/ktutil.inc');

require_once(KT_LIB_DIR . '/ktentity.inc');

require_once(KT_LIB_DIR . "/config/config.inc.php");

$KTInit->initConfig(); 
$KTInit->setupI18n();

if ($GLOBALS['kt_test']) {
    $KTInit->initTesting(); 
}

$oKTConfig =& KTConfig::getSingleton();
$KTInit->setupServerVariables();

// instantiate log
$loggingSupport = $KTInit->setupLogging();

// Send all PHP errors to a file (and maybe a window)
set_error_handler(array('KTInit', 'handlePHPError'));

$dbSupport = $KTInit->setupDB();
$KTInit->setupRandomSeed();

$GLOBALS['KTRootUrl'] = $oKTConfig->get('KnowledgeTree/rootUrl');

require_once(KT_LIB_DIR . '/database/lookup.inc');

// table mapping entries
include("tableMappings.inc");

$default->systemVersion = trim(file_get_contents(KT_DIR . '/docs/VERSION.txt'));
$default->versionName = trim(file_get_contents(KT_DIR . '/docs/VERSION-NAME.txt'));

$KTInit->cleanGlobals();
$KTInit->cleanMagicQuotes();

// site map definition
require_once(KT_DIR . "/config/siteMap.inc");

require_once(KT_LIB_DIR . '/session/Session.inc');
require_once(KT_LIB_DIR . '/session/control.inc');

require_once(KT_LIB_DIR . '/plugins/pluginutil.inc.php');

if ($checkup !== true) {
    KTPluginUtil::loadPlugins();
}

if ($checkup !== true) {
    if (KTPluginUtil::pluginIsActive('ktdms.wintools')) {
        require_once(KT_DIR .  '/plugins/wintools/baobabkeyutil.inc.php');
        $name = BaobabKeyUtil::getName();
        if ($name) {
            $default->versionName = sprintf("%s %s", $default->versionName, $name);
        }
    }
}

require_once(KT_LIB_DIR . '/templating/kt3template.inc.php');
$GLOBALS['main'] =& new KTPage();

?>
