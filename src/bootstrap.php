<?php
namespace My;

// this is bootstrap progress
require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

//定义config文件目录
$app_dir = dirname(__FILE__);
define( 'CONFIG', $app_dir );
define( 'DBCONFIG', $app_dir . '/Config/config_db.php' );

$enviroment = 'development';

$whoops = new \Whoops\Run;

//错误处理类
// if( $enviroment !== 'production' ) {
// 	$whoops -> pushHandler( new \Whoops\Handler\PrettyPageHandler );
// } else {
// 	$whoops -> pushHandler(function($e){
// 		echo 'friendly show error page send email to developer';
// 	});
// }
// $whoops -> register();
// throw new \Exception;

//http处理类
$request = new \Http\HttpRequest($_GET, $_POST, $_COOKIE, $_FILES, $_SERVER);
$response = new \Http\HttpResponse;

//依赖注入
$injector = include('Dependencies.php');

$request = $injector->make('Http\HttpRequest');
$response = $injector->make('Http\HttpResponse');

//访问路由类
$routeDefinitionCallback = function (\FastRoute\RouteCollector $r) {
    $routes = include('Routes.php');
    foreach ($routes as $route) {
        $r->addRoute($route[0], $route[1], $route[2]);
    }
};

$dispatcher = \FastRoute\simpleDispatcher($routeDefinitionCallback);

$routeInfo = $dispatcher->dispatch($request->getMethod(), $request->getPath());

switch ($routeInfo[0]) {
    case \FastRoute\Dispatcher::NOT_FOUND:
        $response->setContent('404 - Page not found');
        $response->setStatusCode(404);
        break;
    case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $response->setContent('405 - Method not allowed');
        $response->setStatusCode(405);
        break;
    case \FastRoute\Dispatcher::FOUND:
	    $className = $routeInfo[1][0];
	    $method = $routeInfo[1][1];
	    $vars = $routeInfo[2];
        
        $class = $injector->make($className);
        $class->$method($vars);
    	break;

}
exit;