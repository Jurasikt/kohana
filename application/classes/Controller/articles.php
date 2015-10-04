<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller {

	public $_site = 'http://localhost/kohana';


	public function action_index()
	{	
		if (Model::factory('Users')->oath()) {
			$all = Model::factory('Article')->get_all();
			$this->response->body(View::factory('art',array(
					'all'=> $all,
				)));			
		} else {
			$this->response->body('401 Access allowed only for registered user');
		}

	}


	public function action_write()
	{
		if (Model::factory('Users')->oath()) {

			$this->response->body(View::factory('wart'));
		} else {
			$this->response->body('401 Access allowed only for registered user');
		}
	}

	public function action_read()
	{
		if (isset($_GET['id']) && Model::factory('Users')->oath()) {
			$arr = Model::factory('Article')->get_text($_GET['id']);
			if ($arr == false) {
				$this->response->body('Такой статьи не существует :D');
			} else {
				$this->response->body(View::factory('rart',$arr));
			}
		} else {
			$this->response->body('401 Access allowed only for registered user');
		}
	}


	public function action_save()
	{	
		if (isset($_POST['title']) && isset($_POST['text']) && Model::factory('Users')->oath()) {
			if (trim($_POST['title']) == '' || trim($_POST['text']) == '') {
				$this->response->body('Размер статьи должен быть больше 1 символа');
				return false;
			}
			if (isset($_POST['id']) && $_POST['id'] != '') {
				Model::factory('Article')->update($_POST['id'],$_POST['title'],$_POST['text']);

			} else {
				Model::factory('Article')->save_all($_POST['title'],$_POST['text']);
			}
			$this->redirect($this->_site.'/articles');
		} else {
			$this->response->body('401 Access allowed only for registered user');
		}
		
	}

	public function action_edit()
	{
		if(isset($_POST) && Model::factory('Users')->oath()){
			if(isset($_POST['edit']) && isset($_POST['id'])) {
				$art = Model::factory('Article')->get_text($_POST['id']);
				$this->response->body(View::factory('wart',array(
						'id'   => $_POST['id'],
						'text' => $art['text'],
						'title'=> $art['title']
					)));

			} elseif (isset($_POST['delete']) && isset($_POST['id'])) {
				Model::factory('Article')->delete($_POST['id']);
				$this->redirect($this->_site.'/articles');
			}
		} else {
			$this->response->body('401 Access allowed only for registered user');
		}
	}

} 
