<?php

/**
 * Name : Custom Helper
 * Author : Ertha Dwi Setiyawan
 */

if (!function_exists('sidebar')) {
	function sidebar() {
		$menu = [
			'home'	=> [
				'label'	=> 'Dashboard',
				'icon'	=> 'fa fa-pie-chart',
				'allow'	=> true
			],
			'logbook'	=> [
				'label'	=> 'Log Book',
				'icon'	=> 'fa fa-book'
			],
			'users'	=> [
				'label'	=> 'User Management',
				'icon'	=> 'fa fa-users',
				'access' => 99
			],
		];

		return $menu;
	}
}


if (!function_exists('eform_open')) {
	function eform_open($id, $attr = '') {
		return "<form id='".$id."' ".$attr.">";
	}
}

if (!function_exists('eform_close')) {
	function eform_close() {
		return "</form>";
	}
}

if (!function_exists('eform_input')) {
	function eform_input($type = 'text',$label = '',$name = '',$value = '',$attribute = 'required',$msg = '') {

		$required = '';

		if(!empty($msg)) $msg = '' . $msg . '';

		if(!empty($attribute) and strpos($attribute, 'required') == false) $required = '<small style="color:red">(*)</small>';

		$html = "";

		if ($type == 'hidden') {
			
			$html = '<input type="'.$type.'" class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>';

		}else{
			
			$html = '<div>
						<label for="'.$name.'">'.$label.' ' . $required . '</label>
				        <div>
				        	<input type="'.$type.'" placeholder="'.$label.'" class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>
				        	'.$msg.'
				        </div>
				    </div>';

		}
		return $html;
	}
}

if (!function_exists('eform_hidden')) {
	function eform_hidden($name = '',$value = '',$attribute = 'required') {
		$html = '<input type="hidden" class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>';
		return $html;
	}
}

if (!function_exists('eform_file')) {
	function eform_file($label = '',$name = '', $value = '',$attribute = 'required', $msg = "") {

		$required = '';

		if(!empty($msg)) $msg = '' . $msg . '';

		if(!empty($attribute)) $required = '<small style="color:red">(*)</small>';

		$html = '<div>
					<label for="'.$name.'">'.$label.' ' . $required . '</label>
			        <div>
			        	<input type="file" placeholder="'.$label.'" class="form-control" id="'.$name.'" name="'.$name.'" value="'.$value.'" '.$attribute.'>
				        '.$msg.'
			        </div>
			    </div>';

		return $html;

	}
}

if (!function_exists('eform_area')) {
	function eform_area($label = '',$name = '', $value = '',$rows = '3', $attribute = 'required', $msg = '') {

		$required = '';

		if(!empty($msg)) $msg = '' . $msg . '';

		if(!empty($attribute)) $required = '<small style="color:red">(*)</small>';

		$html = '<div>
					<label for="'.$name.'">'.$label.' ' . $required . '</label>
			        <div>
			        	<textarea rows="'.$rows.'" placeholder="'.$label.'" class="form-control" id="'.$name.'" name="'.$name.'" '.$attribute.'>'.$value.'</textarea>
			        	'.$msg.'
			        </div>
			    </div>';

		return $html;

	}
}

if (!function_exists('eform_button')) {
	function eform_button($label, $name = 'btn-simpan', $type='Close') {
		$html = '
				<div style="margin-bottom:0;">
				        <button type="reset" class="btn btn-danger closed" data-dismiss="modal">
				            '.$type.'
				        </button>
				        <button class="btn btn-primary '.$name.' xcx" data-name="'.ucfirst($label).'" name="'.$name.'">
				            '.$label.' 
				        </button>
				</div>';

		return $html;
	}
}


if (!function_exists('eform_select')) {
	function eform_select($label, $name, array $values = null, $selected = null, $attribute = 'required', $msg = '') {

		$select = "";

		if(!empty($msg)) $msg = '' . $msg . '';

		$required = '';

		if(!empty($attribute)) $required = '<small style="color:red">(*)</small>';

		if (!empty($values)) {
			
			$select .= "<option value=''>".$label."</option>";

			foreach ($values as $key => $value) {
				
				$var = ($key == $selected) ? 'selected' : false;

				$select .= "<option value='".$key."' ".$var.">".$value."</option>";

			}

		}else{

			$select .= "<option value=''>Data ".$label." Empty</option>";

		}

		$html = '<div>
				    <label for="'.$name.'">'.$label.' ' . $required . '</label>
				    <div>
				        <select name="'.$name.'" class="form-control" id="'.$name.'" '.$attribute.'>
				            '.$select.'
				        </select>
				        '.$msg.'
				    </div>
				</div>';
		return $html;
	}
}
