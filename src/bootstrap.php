<?php
namespace My;

// this is bootstrap progress
require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

//加载错误处理类
$enviroment = 'development';

$whoops = new \Whoops\Run;

if( $enviroment !== 'production' ) {
	$whoops -> pushHandler( new \Whoops\Handler\PrettyPageHandler );
} else {
	$whoops -> pushHandler(function($e){
		echo 'send email to developer';
	});
}

$whoops -> register();
throw new \Exception;
exit;