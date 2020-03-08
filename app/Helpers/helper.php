<?php
use App\User;
use App\models\employee\IdGenerator;

if (!function_exists('_lang')) {
	function _lang($string = '') {

		//Get Target language
		$target_lang = get_option('language');

		if ($target_lang == "") {
			$target_lang = "language";
		}

		if (file_exists(resource_path() . "/language/$target_lang.php")) {
			include resource_path() . "/language/$target_lang.php";
		} else {
			include resource_path() . "/language/language.php";
		}

		if (array_key_exists($string, $language)) {
			return $language[$string];
		} else {
			return $string;
		}
	}
}

if (!function_exists('load_language')) {
	function load_language($active = '') {
		$path = resource_path() . "/language";
		$files = scandir($path);
		$options = "";

		foreach ($files as $file) {
			$name = pathinfo($file, PATHINFO_FILENAME);
			if ($name == "." || $name == "" || $name == "language") {
				continue;
			}

			$selected = "";
			if ($active == $name) {
				$selected = "selected";
			} else {
				$selected = "";
			}

			$options .= "<option value='$name' $selected>" . ucwords($name) . "</option>";

		}
		echo $options;
	}
}

if (!function_exists('get_language_list')) {
	function get_language_list() {
		$path = resource_path() . "/language";
		$files = scandir($path);
		$array = array();

		foreach ($files as $file) {
			$name = pathinfo($file, PATHINFO_FILENAME);
			if ($name == "." || $name == "" || $name == "language") {
				continue;
			}

			$array[] = $name;

		}
		return $array;
	}
}

function gv($params, $keys, $default = Null) {
	return (isset($params[$keys]) AND $params[$keys]) ? $params[$keys] : $default;
}

function gbv($params, $keys) {
	return (isset($params[$keys]) AND $params[$keys]) ? 1 : 0;
}

if (!function_exists('get_option')) {
	function get_option($name) {
		$setting = DB::table('settings')->where('name', $name)->get();
		if (!$setting->isEmpty()) {
			return $setting[0]->value;
		}
		return "";

	}
}

function toWord($word) {
	$word = str_replace('_', ' ', $word);
	$word = str_replace('-', ' ', $word);
	$word = ucwords($word);
	return $word;
}

function tospane($data) {
	$per = explode('.', $data);
	return toWord($per[1]);
}
//permission
function split_name($name) {
	$data = [];
	foreach ($name as $value) {
		$per = explode('.', $value->name);
		$data[toWord($per[0])][] = $value->name;
	}
	return $data;

}

function getUserRoleName($user_id) {
	$user = User::findOrFail($user_id);

	$roles = $user->getRoleNames();

	$role_name = '';

	if (!empty($roles[0])) {
		$array = explode('#', $roles[0], 2);
		$role_name = !empty($array[0]) ? $array[0] : '';
	}
	return $role_name;
}


function tz_list() {
	$zones_array = array();
	$timestamp = time();
	foreach (timezone_identifiers_list() as $key => $zone) {
		date_default_timezone_set($zone);
		$zones_array[$key]['zone'] = $zone;
		$zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
	}
	return $zones_array;
}

// currency list 
function curency() {
	return $currency = [
		'AED' => '&#1583;.&#1573;', // ?
		'AFN' => '&#65;&#102;',
		'ALL' => '&#76;&#101;&#107;',
		'AMD' => '',
		'ANG' => '&#402;',
		'AOA' => '&#75;&#122;', // ?
		'ARS' => '&#36;',
		'AUD' => '&#36;',
		'AWG' => '&#402;',
		'AZN' => '&#1084;&#1072;&#1085;',
		'BAM' => '&#75;&#77;',
		'BBD' => '&#36;',
		'BDT' => '&#2547;', // ?
		'BGN' => '&#1083;&#1074;',
		'BHD' => '.&#1583;.&#1576;', // ?
		'BIF' => '&#70;&#66;&#117;', // ?
		'BMD' => '&#36;',
		'BND' => '&#36;',
		'BOB' => '&#36;&#98;',
		'BRL' => '&#82;&#36;',
		'BSD' => '&#36;',
		'BTN' => '&#78;&#117;&#46;', // ?
		'BWP' => '&#80;',
		'BYR' => '&#112;&#46;',
		'BZD' => '&#66;&#90;&#36;',
		'CAD' => '&#36;',
		'CDF' => '&#70;&#67;',
		'CHF' => '&#67;&#72;&#70;',
		'CLF' => '', // ?
		'CLP' => '&#36;',
		'CNY' => '&#165;',
		'COP' => '&#36;',
		'CRC' => '&#8353;',
		'CUP' => '&#8396;',
		'CVE' => '&#36;', // ?
		'CZK' => '&#75;&#269;',
		'DJF' => '&#70;&#100;&#106;', // ?
		'DKK' => '&#107;&#114;',
		'DOP' => '&#82;&#68;&#36;',
		'DZD' => '&#1583;&#1580;', // ?
		'EGP' => '&#163;',
		'ETB' => '&#66;&#114;',
		'EUR' => '&#8364;',
		'FJD' => '&#36;',
		'FKP' => '&#163;',
		'GBP' => '&#163;',
		'GEL' => '&#4314;', // ?
		'GHS' => '&#162;',
		'GIP' => '&#163;',
		'GMD' => '&#68;', // ?
		'GNF' => '&#70;&#71;', // ?
		'GTQ' => '&#81;',
		'GYD' => '&#36;',
		'HKD' => '&#36;',
		'HNL' => '&#76;',
		'HRK' => '&#107;&#110;',
		'HTG' => '&#71;', // ?
		'HUF' => '&#70;&#116;',
		'IDR' => '&#82;&#112;',
		'ILS' => '&#8362;',
		'INR' => '&#8377;',
		'IQD' => '&#1593;.&#1583;', // ?
		'IRR' => '&#65020;',
		'ISK' => '&#107;&#114;',
		'JEP' => '&#163;',
		'JMD' => '&#74;&#36;',
		'JOD' => '&#74;&#68;', // ?
		'JPY' => '&#165;',
		'KES' => '&#75;&#83;&#104;', // ?
		'KGS' => '&#1083;&#1074;',
		'KHR' => '&#6107;',
		'KMF' => '&#67;&#70;', // ?
		'KPW' => '&#8361;',
		'KRW' => '&#8361;',
		'KWD' => '&#1583;.&#1603;', // ?
		'KYD' => '&#36;',
		'KZT' => '&#1083;&#1074;',
		'LAK' => '&#8365;',
		'LBP' => '&#163;',
		'LKR' => '&#8360;',
		'LRD' => '&#36;',
		'LSL' => '&#76;', // ?
		'LTL' => '&#76;&#116;',
		'LVL' => '&#76;&#115;',
		'LYD' => '&#1604;.&#1583;', // ?
		'MAD' => '&#1583;.&#1605;.', //?
		'MDL' => '&#76;',
		'MGA' => '&#65;&#114;', // ?
		'MKD' => '&#1076;&#1077;&#1085;',
		'MMK' => '&#75;',
		'MNT' => '&#8366;',
		'MOP' => '&#77;&#79;&#80;&#36;', // ?
		'MRO' => '&#85;&#77;', // ?
		'MUR' => '&#8360;', // ?
		'MVR' => '.&#1923;', // ?
		'MWK' => '&#77;&#75;',
		'MXN' => '&#36;',
		'MYR' => '&#82;&#77;',
		'MZN' => '&#77;&#84;',
		'NAD' => '&#36;',
		'NGN' => '&#8358;',
		'NIO' => '&#67;&#36;',
		'NOK' => '&#107;&#114;',
		'NPR' => '&#8360;',
		'NZD' => '&#36;',
		'OMR' => '&#65020;',
		'PAB' => '&#66;&#47;&#46;',
		'PEN' => '&#83;&#47;&#46;',
		'PGK' => '&#75;', // ?
		'PHP' => '&#8369;',
		'PKR' => '&#8360;',
		'PLN' => '&#122;&#322;',
		'PYG' => '&#71;&#115;',
		'QAR' => '&#65020;',
		'RON' => '&#108;&#101;&#105;',
		'RSD' => '&#1044;&#1080;&#1085;&#46;',
		'RUB' => '&#1088;&#1091;&#1073;',
		'RWF' => '&#1585;.&#1587;',
		'SAR' => '&#65020;',
		'SBD' => '&#36;',
		'SCR' => '&#8360;',
		'SDG' => '&#163;', // ?
		'SEK' => '&#107;&#114;',
		'SGD' => '&#36;',
		'SHP' => '&#163;',
		'SLL' => '&#76;&#101;', // ?
		'SOS' => '&#83;',
		'SRD' => '&#36;',
		'STD' => '&#68;&#98;', // ?
		'SVC' => '&#36;',
		'SYP' => '&#163;',
		'SZL' => '&#76;', // ?
		'THB' => '&#3647;',
		'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
		'TMT' => '&#109;',
		'TND' => '&#1583;.&#1578;',
		'TOP' => '&#84;&#36;',
		'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
		'TTD' => '&#36;',
		'TWD' => '&#78;&#84;&#36;',
		'TZS' => '',
		'UAH' => '&#8372;',
		'UGX' => '&#85;&#83;&#104;',
		'USD' => '&#36;',
		'UYU' => '&#36;&#85;',
		'UZS' => '&#1083;&#1074;',
		'VEF' => '&#66;&#115;',
		'VND' => '&#8363;',
		'VUV' => '&#86;&#84;',
		'WST' => '&#87;&#83;&#36;',
		'XAF' => '&#70;&#67;&#70;&#65;',
		'XCD' => '&#36;',
		'XDR' => '',
		'XOF' => '',
		'XPF' => '&#70;',
		'YER' => '&#65020;',
		'ZAR' => '&#82;',
		'ZMK' => '&#90;&#75;', // ?
		'ZWL' => '&#90;&#36;',
	];
}

// format date 
function carbonDate($date){
	$dtobj = Carbon\Carbon::parse($date);
		return $dtformat = $dtobj->format(get_option('date_format'));
}

// format time 
function carbonTime($date){
	$dtobj = Carbon\Carbon::parse($date);
	return $dtformat = $dtobj->format(get_option('time_format'));
}

function generate_id($id_type, $update = false){
	$last_id = IdGenerator::firstOrCreate(['id_type' => $id_type], ['id_no' => 0]);
	$id = $last_id->id_no;
	$id += 1;
	if ($update) {
	  $last_id = IdGenerator::updateOrCreate(['id_type' => $id_type], ['id_no' => $id]);
	  $id = $last_id->id_no;
	} 
      return $id;
	
}

function numer_padding($id, $code_digits=3){
	// $id = $id + 1 ;
	return str_pad($id, $code_digits,0, STR_PAD_LEFT);
}

	function current_designation($id){
    	$emp_d =App\models\employee\EmployeeDesignation::where('employee_id',$id)->latest()->first();
    	$designation = ($emp_d AND $emp_d->designation->name)?$emp_d->designation->name:"";
    	$dept_id = ($emp_d AND $emp_d->designation->department_id)?$emp_d->designation->department_id:"";

    	return $designation;
    }

    function current_dept($id){
    	$emp_d =App\models\employee\EmployeeDesignation::where('employee_id',$id)->latest()->first();
    	// $designation = ($emp_d AND $emp_d->designation->name)?$emp_d->designation->name:"";
    	$dept_id = ($emp_d AND $emp_d->department_id)?$emp_d->department_id:"";
    	$dept = App\models\employee\Department::where('id',$dept_id)->first();
    	return  $dept ? $dept->name: "";
	}
	

    function to_date($start_date , $end_date){
		$datetime1 = new DateTime($start_date);
		$datetime2 = new DateTime($end_date);
		$interval = $datetime1->diff($datetime2);
		$day = $interval->format('%a');
		$days = $day + 1;
			return  $days;
    }

function formatDate($date){
		$dtobj = Carbon\Carbon::parse($date);
		if(get_option('date_format') == 'y-m-d'){
			return $dtformat = $dtobj->format('F jS, Y');
		}
		if(get_option('date_format') == 'Y-m-d'){
			return $dtformat = $dtobj->format('M jS, Y');
		}
		if(get_option('date_format') == 'h-i-s'){
			return $dtformat = $dtobj->format('g:i A');
		}
		if(get_option('date_format') == 'time'){
			return $dtformat = $dtobj->format('h:i A');
		}
		else{
			return $dtformat = $dtobj->format('F jS Y, g:i A');
		}
	}

	function validEmail($garbaseEmail){
    function myfunction($email)
    {
        $a = trim($email);
        if (!filter_var($a, FILTER_VALIDATE_EMAIL)) {
            // invalid emailaddress
        } else {
            return $a;
        }
    }

    $validEmail=array_map("myfunction",$garbaseEmail);
    $validEmail =  array_unique($validEmail);

    if (array_search("",$validEmail)) {
        $position = array_search("",$validEmail);
        unset($validEmail[$position]);
    }
    return $validEmail;
}
?>