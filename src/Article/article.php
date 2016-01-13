<?php
namespace My\Article;

interface article
{	
	public function write_article( $uid, $graphy_info );
	public function read_article( $uid );
	public function edit_article( $uid, $graphy_info );
}