<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Upload extends Controller {


    public function action_index()
    {
        if (Auth::instance()->logged_in()) {
            $this->response->body(View::factory('upl'));
        } else {
            throw new HTTP_Exception_401();
        }
        
    }

    public function action_next() 
    {
        if (!Auth::instance()->logged_in()) {
            throw new HTTP_Exception_401();
        }
        if (!isset($_FILES['file'])) {
            throw new HTTP_Exception_500();
        }
        $images = array();
        foreach ($_FILES['file'] as $key => $value) {
            $i = 0;
            foreach ($value as $item) {
                if (!isset($images[$i])) {
                    $images[$i] = array();
                }
                $images[$i][$key] = $item;
                $i++;
            }
        }
        $name = array();
        foreach ($images as $item) {
            $tmp = Model::factory('Photo')->load($item);
            if ($tmp != false) {
                $name[] = $tmp;
            }
        }
        if (count($name) == 0) {
            throw new HTTP_Exception_500();
        }
        $this->response->body(View::factory('upl2',array(
            'name' =>$name,
            )));
    }


    public function action_finish()
    {
        if (isset($_POST) && Auth::instance()->logged_in()) {
            $name = array();
            foreach ($_POST as $key => $value) {
                $key = preg_replace('/[_]/', '.',$key); 
                if (!file_exists(DOCROOT.'public/img/m_'.$key)) continue;
                $name[] = array(
                    'title' => $value,
                    'file'  => $key,
                    );
            }
            Model::factory('Photo')->finish_load($name);
            $this->redirect(URL::site());
        } else {
            throw new HTTP_Exception_401();
        }
        
    }


} 