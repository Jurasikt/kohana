<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller {




    public function action_index()
    {   
        if (Auth::instance()->logged_in()) {
            $id = $this->request->param('id');
            if ($id != '') {
                $id = preg_replace('/id/','', $id);
                $arr = Model::factory('Article')->get_text($id);
                ($arr == false)?$this->response->body('Такой статьи не существует :D'):
                    $this->response->body(View::factory('rart',$arr));

            } else {
                $all = Model::factory('Article')->get_all();
                $this->response->body(View::factory('art',array(
                        'all'=> $all,
                    )));                
            }
            
        } else {
            throw new HTTP_Exception_401();
        }

    }


    public function action_write()
    {
        if (Auth::instance()->logged_in()) {
            $this->response->body(View::factory('wart'));
        } else {
            throw new HTTP_Exception_401();
        }
    }


    public function action_save()
    {   
        if (!Auth::instance()->logged_in()) {
            throw new HTTP_Exception_401();
            exit;
        }
        if (isset($_POST['title']) && isset($_POST['text'])) {
            if (trim($_POST['title']) == '' || trim($_POST['text']) == '') {
                $this->response->body('Размер статьи должен быть больше 1 символа');
                return false;
            }
            if (isset($_POST['id']) && $_POST['id'] != '') {
                Model::factory('Article')->update($_POST['id'],$_POST['title'],$_POST['text']);

            } else {
                Model::factory('Article')->save_all($_POST['title'],$_POST['text']);
            }
            $this->redirect(URL::site('articles'));
        } else {
            throw new HTTP_Exception_500();
        }
    }

    public function action_edit()
    {
        if(isset($_POST) && Auth::instance()->logged_in()) {
            if(isset($_POST['edit']) && isset($_POST['id'])) {
                $art = Model::factory('Article')->get_text($_POST['id']);
                $this->response->body(View::factory('wart',array(
                        'id'   => $_POST['id'],
                        'text' => $art['text'],
                        'title'=> $art['title']
                    )));

            } elseif (isset($_POST['delete']) && isset($_POST['id'])) {
                Model::factory('Article')->delete($_POST['id']);
                $this->redirect(URL::site('articles'));
            }
        } else {
            throw new HTTP_Exception_401();
        }
    }

    public function action_test()
    {
        
    }


} 
