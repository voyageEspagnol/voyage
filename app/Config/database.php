<?php


	define('DEFAULT_DB', APP.DS.'sqlite'.DS.'default.sqlite');

class DATABASE_CONFIG {

/*public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => 'mysql',
		'database' => 'voyage',
		'prefix' => '',
		'encoding' => 'utf8'
	);
	*/
        public $default = array(
        'datasource' => 'Database/Sqlite',
        'persistent' => false,
        'database' => DEFAULT_DB,
        'prefix' => ''
        //'encoding' =&gt; 'utf8',
    );
}
	
?>
