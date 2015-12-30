<?php
namespace My\User;

class adminUser implements user{
	private $name;
	private $id;

	public function init_user( array $data )
	{
		$db_config = include(DBCONFIG);
		$medoo = new \medoo($db_config);
		$res = $medoo -> insert('blog_user', $data);
		
		return $res;
	}

	public function get_user_info()
	{

		return $info;
	}
}