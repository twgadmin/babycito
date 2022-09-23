<?php

/**
 * AssetHelper
 *
 */

/**
 * Return's admin assets directory
 *
 * CALLING PROCEDURE
 *
 * In controller call it like this:
 * $adminAssetsDirectory = adminAssetsDir() . $site_settings->site_logo;
 *
 * In View call it like this:
 * {{ asset(adminAssetsDir() . $site_settings->site_logo) }}
 *
 * @param string $role
 *
 * @return bool
 */
function uploadsDir($path = '')
{
    return $path != '' ? 'uploads/' . $path . '/' : 'uploads/';
}

function uploadsUrl($file = '')
{
    return $file != '' && file_exists(uploadsDir('users') . $file) ? uploadsDir('users') . $file : 'avatar.jpg';
}

function adminHasAssets($image)
{
    if (!empty($image) && file_exists(uploadsDir() . $image)) {
        return true;
    } else {
        return false;
    }
}

function matchChecked($param1, $param2)
{
    return $param1 == $param2 ? ' checked="checked" ' : '';
}

function matchSelected($param1, $param2)
{
    return $param1 == $param2 ? ' selected="selected" ' : '';
}

function generateRandomString($length = 10)
{
    $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString     = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function getGender($id = null)
{
    $values = [
        '1' => 'Male',
        '2' => 'Female',
    ];

    return isset($id) && $id <= 2 && $id >= 1 ? $values[$id] : $values;
}

function getStatus($id = null)
{
    $values = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    return isset($id) && $id <= 2 && $id >= 1 ? $values[$id] : $values;
}

function filterUrl($key = '', $value = '')
{
    $data = $_SERVER['QUERY_STRING'];

    $data = str_replace(urlencode($key) . '=' . $value, '', $data);
    $data = str_replace('&&', '&', $data);

    return $data;
}

function limit_text($text, $limit) {
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function limit_char($text, $limit) {
    if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit);
        $text = $text . '...';
    }
    return $text;
}


function cal_percentage($num_amount, $num_total) {
  $count1 = $num_amount / $num_total;
  $count2 = $count1 * 100;
  $count = number_format($count2, 0);
  return $count;
}