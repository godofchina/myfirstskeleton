<?php
namespace My\User;

use My\db\DB;

class adminUser implements user{
	public function init_user( array $data )
	{
		$medoo = DB::instance();

		$res = $medoo -> insert( 'blog_user', $data );
		
		return $res;
	}

	public function get_user_info( $uid )
	{	
		$medoo = DB::instance();

		$info = $medoo -> select( 'blog_user', '*' , array('id[=]'=>$uid) );
		return $info;
	}
}