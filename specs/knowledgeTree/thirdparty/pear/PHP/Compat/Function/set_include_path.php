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
// | Authors: Stephan Schmidt <schst@php.net>                             |
// +----------------------------------------------------------------------+
//
// $Id: set_include_path.php 3486 2005-07-29 12:10:48Z nbm $


/**
 * Replace set_include_path()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/function.set_include_path
 * @author      Stephan Schmidt <schst@php.net>
 * @version     $Revision: 3486 $
 * @since       PHP 4.3.0
 */
if (!function_exists('set_include_path')) {
    function set_include_path($new_include_path)
    {
        return ini_set('include_path', $new_include_path);
    }
}
?>