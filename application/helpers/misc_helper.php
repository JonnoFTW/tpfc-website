<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('price'))
{
    function price($price)
    {
        return '$'.number_format($price/100.0,2,'.','');
    }   
}
if ( ! function_exists('title'))
{
    function title($text)
    {
        return ucwords(preg_replace('/[\\-_]/',' ', $text));
    }   
}

