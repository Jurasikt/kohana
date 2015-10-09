<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Articles extends Controller {



    public function action_index()
    {   
        if (Auth::instance()->logged_in()) {
            $id = $this->request->param('id');
            if ($id != '') {
                $item = Model::factory('Article')->get_item_by_id($id);
                if ($item == false) {
                    throw new HTTP_Exception_404();
                }
                $this->response->body(View::factory('rart',$item));

            } else {
                $items = Model::factory('Article')->get_items();
                $this->response->body(View::factory('art',array(
                        'all'=> $items,
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
        $post =  Validation::factory($_POST);
        $post-> rule('title','not_empty')
             -> rule('text','not_empty');
        if ($post->check()) {
            $post-> rule('id','not_empty');
            if ($post->check()) 
                Model::factory('Article')->update_item($_POST['id'],$_POST['title'],$_POST['text']);
            else 
                Model::factory('Article')->save_item($_POST['title'],$_POST['text']);
        } else {
            throw new HTTP_Exception_500();
        }
        $this->redirect(URL::site().'articles');
    }

    public function action_edit()
    {
        if (!Auth::instance()->logged_in()) {
            throw new HTTP_Exception_401();
        }
        $post = Validation::factory($_POST);
        $post ->rule('id','digit')
              ->rule('id','not_empty');
        if ($post->check()) {
            $post->rule('edit','not_empty');
            if ($post->check()) {
                $article =  Model::factory('Article')->get_item_by_id($_POST['id']);
                $this->response->body(View::factory('wart',array(
                        'id'   => $_POST['id'],
                        'text' => $article['text'],
                        'title'=> $article['title']
                    )));
            } else {
                Model::factory('Article')->delete_item($_POST['id']);
                $this->redirect(URL::site('articles'));
            }
        } else {
            throw new HTTP_Exception_500();
        }
    }


} 
