<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Test extends Controller {

	public function action_index()
	{
		if (Auth::instance()->logged_in()) {

			$pgn = Pagination::factory(array('total_items' => 1000));	
			$this->response->body(View::factory('test',array(
				'pgn'=>$pgn,
			)));
		} else {
			throw new HTTP_Exception_401();
		}

	}

}