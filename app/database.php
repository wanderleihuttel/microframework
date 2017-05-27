<?php
return [

	/**
	 *  Options (mysql, sqlite)
	 */
	'driver' => 'sqlite',

	'sqlite' => [
		'host' => 'database.db',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci'
	],

	'mysql' => [
		'host' => 'localhost',
		'db_name' => 'mvc',
		'username' => 'mvc',
		'password' => '123456',
		'charset' => 'utf8',
		'collation' => 'utf8_unicode_ci'
	]

];