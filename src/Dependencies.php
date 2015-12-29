<?php
$injector = new \Auryn\Injector;

//注入http处理类
$injector->alias('Http\Request', 'Http\HttpRequest');
$injector->share('Http\HttpRequest');
$injector->define('Http\HttpRequest', [
    ':get' => $_GET,
    ':post' => $_POST,
    ':cookies' => $_COOKIE,
    ':files' => $_FILES,
    ':server' => $_SERVER,
]);

$injector->alias('Http\Response', 'Http\HttpResponse');
$injector->share('Http\HttpResponse');

//注入模板引擎类(MustacheRenderer)
$injector->alias('My\Template\Renderer', 'My\Template\MustacheRenderer');
$injector->define('Mustache_Engine', [
    ':options' => [
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/templates', [
            'extension' => '.html',
        ]),
    ],
]);

//注入filepagereader类
$injector->define('My\Page\FilePageReader', [
    ':pageFolder' => __DIR__ . '/../pages',
]);

$injector->alias('My\Page\PageReader', 'My\Page\FilePageReader');
$injector->share('My\Page\FilePageReader');

//注入模板引擎类(Twig)
$injector->alias('My\Template\Renderer', 'My\Template\TwigRenderer');
$injector->delegate('Twig_Environment', function() use ($injector) {
    $loader = new Twig_Loader_Filesystem(dirname(__DIR__) . '/templates');
    $twig = new Twig_Environment($loader);
    return $twig;
});

//依赖于renderer
$injector->alias('My\Template\FrontendRenderer', 'My\Template\FrontendTwigRenderer');

//menu interface
$injector->alias('My\Menu\MenuReader', 'My\Menu\ArrayMenuReader');
$injector->share('My\Menu\ArrayMenuReader');

//注入database类
// echo '<pre>';var_dump($injector);exit;
return $injector;