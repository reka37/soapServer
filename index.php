<?php
class Info
{
	public $city;
	public $name;
	public $data;
}
$info      	= 	new Info();
$info->city	=	'Moscow';
$info->name	=	'Ivan';
$info->data	=	'2019-03-29';

$client	=	new SoapClient('http://soap2/server.php?wsdl',[
	'trace'			=>	1,
	'cache_wsdl'	=>	WSDL_CACHE_NONE, 
	'login' 		=> 	"reka",
	'password' 		=> 	"777"
]);
$resp  	=	$client->getInfoCal($info);

if ($resp->anyType[2] == 'true') {
	echo 'Ошибка!!! Параметр date в запросе меньше текущего дня!';	
} else {
	//var_dump($resp);
	echo '<p>Стоимость = ' 	. $resp->anyType[1] . '</p>';
	echo '<p>Инфо = ' 		. $resp->anyType[0] . '</p>';
}