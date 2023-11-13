<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->helper('form');

if (!function_exists('form_dropdown_num_records'))
{
	function form_dropdown_num_records($name, $value = '', $id_form = '')
	{
		$options = array(5, 10, 25, 50, 100);

		if (!in_array($value, $options)) {
			$value = 5;
		}

		$dropdown_options = array();
		foreach ($options as $option) {
			$dropdown_options[$option] = $option;
		}

		$javascript = '';
		if (!empty($id_form)) {
			$javascript = 'onchange="document.getElementById(\''.$id_form.'\').submit()"';
		}

		$dropdown = form_dropdown($name, $dropdown_options, $value,$javascript);

		return $dropdown;
	}
}
