<?php

namespace My\Controllers;

use Http\Response;
use My\Template\FrontendRenderer;
use My\Page\PageReader;
use My\Page\InvalidPageException;

class Page
{
	private $response;
    private $renderer;
    private $pagereader;

    public function __construct(Response $response, FrontendRenderer $renderer, PageReader $pageReader)
    {
        $this->response   = $response;
        $this->renderer   = $renderer;
        $this->pageReader = $pageReader;
    }

    public function show($params)
    {
        $slug = $params['slug'];

        try{
	       $data['content'] = $this->pageReader->readBySlug($slug);
	    } catch( InvalidPageException $e ) {
            $this->response->setStatusCode(404);
            return $this->response->setContent('404 - page not found');    
        }
        
        $html = $this->renderer->render('Page', $data);
        $this->response->setContent($html);
        echo $this->response->getContent();
        exit;        
    }
}