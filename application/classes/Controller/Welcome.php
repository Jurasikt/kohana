<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Welcome extends Controller {

	public function action_index()
	{
		if (Cookie::get('user') == 'admin') $log = true;
		else $log = false;
		$this->response->body(View::factory('main',array(
			'login' => $log,
			)));
	}

	public function action_test()
	{
		$dat = Model::factory('Photo')->get_all();
		$this->response->body(View::factory('main',$dat));
	}

} 
