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
// $Id: ob_get_flush.php 3486 2005-07-29 12:10:48Z nbm $


/**
 * Replace ob_get_flush()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/function.ob_get_flush
 * @author      Aidan Lister <aidan@php.net>
 * @author      Thiemo M�ttig (http://maettig.com/)
 * @version     $Revision: 3486 $
 * @since       PHP 4.3.0
 * @require     PHP 4.0.0 (user_error)
 */
if (!function_exists('ob_get_flush')) {
    function ob_get_flush()
    {
        $contents = ob_get_contents();

        if ($contents !== false) {
            ob_end_flush();
        }

        return $contents;
    }
}

?>