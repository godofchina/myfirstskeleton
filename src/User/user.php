<?php
namespace My\user;

interface user{
	private $nick_name;
	private $id;

	//初始化用户（注册）
	public function init_user(){}

	//获取用户信息
	public function get_user_info(){} 
	
}