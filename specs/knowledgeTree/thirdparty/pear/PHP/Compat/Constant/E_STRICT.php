<?php
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2004 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 3.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/3_0.txt.                                  |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Aidan Lister <aidan@php.net>                                |
// +----------------------------------------------------------------------+
//
// $Id: E_STRICT.php 3486 2005-07-29 12:10:48Z nbm $


/**
 * Replace constant E_STRICT
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/ref.errorfunc
 * @author      Aidan Lister <aidan@php.net>
 * @version     $Revision: 3486 $
 * @since       PHP 5
 */
if (!defined('E_STRICT')) {
    define('E_STRICT', 2048);
}

?>