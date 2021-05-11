<?php

function encode($string = "")
{
    $Q = &get_instance();
    $string = is_array($string) ? json_encode($string) : $string;
    $param = str_replace("/", "0_0", $Q->encryption->encrypt($string));
    return countChar2String($param, "=") . "A3." . str_replace("=", "", $param);
}

function decode($string = "")
{
    $Q = &get_instance();
    $temp  = explode("A3.", $string);
    $param = isset($temp[1]) ? $temp[1] . str_repeat("=", (int)$temp[0]) : $temp[0];
    $param = str_replace("0_0", "/", $param);
    $param = (string)$Q->encryption->decrypt($param);
    $temp  = is_json($param);
    $temp  = is_null($temp) ? ((string)$param) : $temp;
    return $temp;
}

function countChar2String($string = "", $char = FALSE)
{
    $D = array_count_values(str_split($string));
    if (!$char) return $D;
    return isset($D[$char]) ? $D[$char] : 0;
}

function is_json($text = "")
{
    // preg_match_all('/\[\[.*?]]/s', $text, $matches);
    $pattern = '/\{(?:[^{}]|(?R))*\}/x';
    preg_match_all($pattern, $text, $matches);
    if (isset($matches[0])) {
        if (!empty($matches[0]))
            return (is_null(json_decode($text)) ? NULL : json_decode($text, TRUE));
    }
    return NULL;
}
