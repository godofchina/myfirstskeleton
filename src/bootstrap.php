<?php
namespace My;

// this is bootstrap progress
require __DIR__ . '/../vendor/autoload.php';

error_reporting(E_ALL);

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

        $class = new $className($response);
        $class->$method($vars);
    	break;
}


exit;