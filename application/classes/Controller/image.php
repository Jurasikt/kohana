<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Image extends Controller {

	public function action_index()
	{
		if (Cookie::get('user') == 'admin') {
			$img = Model::factory('Photo')->rand(3);
			$all = Model::factory('Photo')->get_all();

			$this->response->body(View::factory('img',array(
				'img'=>$img,
				'all'=>$all,
			)));			
		} else {
			$this->response->body('401 Access allowed only for registered user');
		}

	}

}