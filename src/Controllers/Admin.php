<?php
namespace My\Controllers;

use Http\Response;
use Http\Request;
use My\Template\FrontendRenderer;

class Admin
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

    public function scratch()
    {	
    	if( $urls = $this->request->getParameter('url') ) {
    		
    		$fet_res = $this -> _multi_curl( $urls );
    		var_dump($fet_res);
  			exit();  		
   	 	}
  
    	$html = $this->renderer->render('Scrach');
    	$this->response->setContent($html);
    	$this->_display();
    }

    private function _multi_curl( $urls )
    {
    	$num = count( $urls );
    	
		for ($i=0; $i < $num; $i++) { 
			$ch[] = curl_init();
			// 设置URL和相应的选项
			curl_setopt ( $ch[$i] ,  CURLOPT_URL ,  $urls[$i] );
			curl_setopt ( $ch[$i] ,  CURLOPT_HEADER ,  0 );
		}

		 // 创建批处理cURL句柄
		 $mh  =  curl_multi_init ();

		// 增加2个句柄
		for ($i=0; $i < $num; $i++) { 
		 	curl_multi_add_handle ( $mh , $ch[$i] );		 	
		}

		 $running = null ;
		 // 执行批处理句柄
		 do {
		    //usleep ( 10000 );
		    $fetch[] = curl_multi_exec ( $mh , $running );
		} while ( $running  >  0 );

		 // 关闭全部句柄
		for ($i=0; $i < $num; $i++) { 
			curl_multi_remove_handle ( $mh ,  $ch[$i] );			
		}

		curl_multi_close ( $mh );

		return $fetch;
    }

    private function _display()
    {

    	echo $this->response->getContent();
    	exit;
    }
}