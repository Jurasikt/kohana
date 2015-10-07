<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Image extends Controller {

	public function action_index()
	{
		if (Auth::instance()->logged_in()) {
			$img = Model::factory('Photo')->rand(3);
			$all = Model::factory('Photo')->get_all();

			$this->response->body(View::factory('img',array(
				'img'=>$img,
				'all'=>$all,
			)));			
		} else {
			throw new HTTP_Exception_401();
		}

	}

}