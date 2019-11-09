<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
/**
 * SoapServer - передача данных от клиента к серверу
 * 
 * 
 */
class Info
{
    /**
     * @access public
     * @var string
     */
    public $city;

    /**
     * @access public
     * @var string
     */
    public $name;

    /**
     * @access public
     * @var string 
     */
    public $data;
}

$info      	= 	new Info();
$info->city	=	'Moscow';
$info->name	=	'Ivan';
$info->data	=	'2019-12-29';

    $client	=	new SoapClient('http://soapServer/server.php?wsdl',[
	'trace'			=>	1,
	'cache_wsdl'            =>	WSDL_CACHE_NONE, 
	'login' 		=> 	"reka",
	'password' 		=> 	"777"
    ]);
    
    $resp 	=	$client->getInfoCal( $info );

    if ( $resp->anyType[2] == 'true' ) {
            echo 'Ошибка!!! Параметр date в запросе меньше текущего дня!';	
    } else {
            echo '<p>Стоимость = ' 	. $resp->anyType[1] . '</p>';
            echo '<p>Инфо = ' 		. $resp->anyType[0] . '</p>';
    }
