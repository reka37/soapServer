<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	exit;
} else { 

ini_set("soap.wsdl_cache_enabled","0");
$server=new SoapServer("test.wsdl",[
	'classmap'	=>[
		'infocal'	=>'Info', 
	]
]);
	
	if ('reka' == $_SERVER['PHP_AUTH_USER'] && '777' == $_SERVER['PHP_AUTH_PW']) {	
		$server->addFunction('getInfoCal');
		$server->handle();
	} else {
		$server->fault(403,'Access denied');
	} 
}

function getInfoCal($info)
{
	if (strtotime($info->data) > strtotime(date('Y-m-d'))) {		
		$rand 			= rand(1, 100);
		$randLengthText = rand(1, 20);
		$text 			= generateText($randLengthText);
		return array($text, $rand, false);
	} else {
		return array($text = '', $rand = '', true);
	}	
}

function generateText($length){
  $chars 		= 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
  $numChars 	= strlen($chars);
  $string	 	= '';
  for ($i = 0; $i < $length; $i++) {
    $string .= substr($chars, rand(1, $numChars) - 1, 1);
  }
  return $string;
}