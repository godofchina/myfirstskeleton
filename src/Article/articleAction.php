<?php
namespace My\Article;

use My\db\DB;

class articleAction implements article
{	
	private $database;

	public function __construct( )
	{
		$this -> database = DB::instance();
	}

	public function write_article( $uid, $graphy_info )
	{
		$graphy_info['uid'] = $uid;
		return $this -> database -> insert( 'blog_article', $graphy_info );
	}

	public function read_article( $uid )
	{

	}

	public function edit_article( $uid, $graphy_info )
	{

	}
}