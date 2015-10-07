<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	'driver'       => 'File',
	'hash_method'  => 'md5',
	'hash_key'     => '4AjdhQwSjfhA',
	'lifetime'     => 314159,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',

	// Username/password combinations for the Auth File driver
	'users' => array(
		 'admin' => 'cc1fc9a0f05eb977040f2c07eca11089',
	),

);
