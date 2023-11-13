<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->helper('string');

if (!function_exists('alt_text'))
{
	function alt_text($text, $alt_text = '-')
	{
		if (empty($text) || $text == '0000-00-00, 0000-00-00 00:00:00'){
			return $alt_text;
		}
		return $text;
	}
}
