<?php
namespace My\db;

class DB
{
	static public $db;
	static public $db_config;

	static public function instance( $db_config = NULL )
	{	
		if( !self::$db ) {
			if( !$db_config )
				$db_config = include(DBCONFIG);

			self::$db = new \medoo( $db_config );
			self::$db_config = $db_config;
		}

		return self::$db;
	}
}