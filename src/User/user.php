<?php
namespace My\User;

interface user{
	//初始化用户（注册）
	public function init_user(array $data);

	//获取用户信息
	public function get_user_info( $uid );
}