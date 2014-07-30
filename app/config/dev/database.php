<?php 
return [
'default' => 'mysql',
'connections' => array(
	'mysql' => array(
			'driver'    => 'mysql',
			'host'      => '127.0.0.1',		
			'database'  => 'project_ilaw',
			'username'  => 'root',
			'password'  => '1234',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
			'port' => '3306'
		)
)
];