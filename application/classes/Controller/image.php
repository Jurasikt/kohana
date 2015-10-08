<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Image extends Controller {

	/**
	* максимальное число изображений на одной стр.
	*/
	const MAX_IMG = 6;

	public function action_index()
	{
		if (Auth::instance()->logged_in()) {
			$page   = $this->request->param('page');
			$img    = Model::factory('Photo')->rand(3);
			$count  = Model::factory('Photo')->count();
			if ($page != '' && $count <= self::MAX_IMG*($page-1)) {
				throw new HTTP_Exception_404();
			}
			$all    = Model::factory('Photo')
				->get_limit(($page != ('' || 0))? self::MAX_IMG*($page-1):0);
			$pgn    = Pagination::factory(array(
				'total_items'    => $count,
				'items_per_page' => self::MAX_IMG,
			));
			$this->response->body(View::factory('img',array(
				'img'=>$img,
				'all'=>$all,
				'pgn'=>$pgn,
			)));
		} else {
			throw new HTTP_Exception_401();
		}

	}

}