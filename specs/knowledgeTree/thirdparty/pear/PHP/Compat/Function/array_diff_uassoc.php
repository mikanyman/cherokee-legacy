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
// $Id: array_diff_uassoc.php 3486 2005-07-29 12:10:48Z nbm $


/**
 * Replace array_diff_uassoc()
 *
 * @category    PHP
 * @package     PHP_Compat
 * @link        http://php.net/function.array_diff_uassoc
 * @version     $Revision: 3486 $
 * @since       PHP 5.0.0
 * @require     PHP 4.0.6 (is_callable)
 */
if (!function_exists('array_diff_uassoc')) {
    function array_diff_uassoc()
    {
        // Sanity check
        $args = func_get_args();
        if (count($args) < 3) {
            user_error('Wrong parameter count for array_diff_uassoc()', E_USER_WARNING);
            return;
        }

        // Get compare function
        $compare_func = array_pop($args);
        if (!is_callable($compare_func)) {
            if (is_array($compare_func)) {
                $compare_func = $compare_func[0] . '::' . $compare_func[1];
            }
            user_error('array_diff_uassoc() Not a valid callback ' .
                $compare_func, E_USER_WARNING);
            return;
        }

        // Check arrays
        $array_count = count($args);
        for ($i = 0; $i !== $array_count; $i++) {
            if (!is_array($args[$i])) {
                user_error('array_diff_uassoc() Argument #' .
                    ($i + 1) . ' is not an array', E_USER_WARNING);
                return;
            }
        }

        // Compare entries
        $result = array();
        foreach ($args[0] as $k => $v) {
            for ($i = 1; $i < $array_count; $i++) {
                foreach ($args[$i] as $kk => $vv) {
                    if ($v == $vv) {
                        $compare = call_user_func_array($compare_func, array($k, $kk));
                        if ($compare == 0) {
                            continue 3;
                        }
                    }
                }
            }

            $result[$k] = $v;
        }

        return $result;
    }
}

?>