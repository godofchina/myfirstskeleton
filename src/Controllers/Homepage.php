<?php

namespace My\Controllers;

use Http\Response;
use Http\Request;
use My\Template\Renderer;

class Homepage
{
    private $response;
    private $request;
    private $renderer;

    public function __construct(Request $request, Response $response, Renderer $renderer)
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
}