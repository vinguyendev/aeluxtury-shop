<?php

require_once "inc_security.php";

$json = array(
   'code'      => 0,
   'districts' => array()
);

$cit_id				= getValue('city_id', 'int', 'GET', 0, 1);
$temp_districts	= getChildCity($cit_id);
$districts			= array();

foreach($temp_districts as $key => $value) {
	if($key != $cit_id) {
		$districts[$key]['id']	= $value['cit_id'];
		$districts[$key]['name']	= $value['cit_name'];
	}
}

if($districts) {
   $json['code']      = 1;
   $json['districts'] = $districts;
}

exit(json_encode($json));