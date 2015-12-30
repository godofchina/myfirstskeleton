<?php

namespace My\Controllers;

use Http\Response;
use Http\Request;
use My\Template\FrontendRenderer;
use My\User\adminUser;

class Homepage
{
    private $response;
    private $request;
    private $renderer;

    public function __construct(Request $request, Response $response, FrontendRenderer $renderer)
    {
        $this->response = $response;
        $this->request = $request;
        $this->renderer = $renderer;
    }

    public function show()
    {   
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
        ];  
        $html = $this->renderer->render('Homepage', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
        exit;
    }

    public function register()
    {
        $user = new adminUser;
        
        $data = array(
            'name' => 'superman',
            'ip'   => ip2long($_SERVER['REMOTE_ADDR']),
            'passwd' => password_hash ( "rasmuslerdorf" ,  PASSWORD_DEFAULT ),
            'login_time' => date( 'Y-m-d H:i:s', time() )
        );
        //初始化超级管理员
        $init_user = $user->init_user( $data );
        var_dump($init_user);exit;
    }
}