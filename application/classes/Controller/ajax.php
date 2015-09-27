<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {


	public function action_login()
	{
		$log   = false;
		$error = array();
		if (isset($_POST['login']) && isset($_POST['password'])) {
			if ($_POST['login'] == '' || $_POST['password'] == '') $error[] = 'Missing login or passsword';
			$log = Model::factory('Users')->login($_POST['login'],$_POST['password']);
			if (!$log) $error[] = "There isn't an account for this login or pass";

		} else {
			$error[] = 'Incorect passsword';	
		}
		if ($log) {
			Cookie::set('user', 'admin',314159);
		}
		$this->response->headers('Content-Type','application/json');
		$a = (object)(array("success"=>$log,"err"=>$error));
		$this->response->body(json_encode($a));
	}

}