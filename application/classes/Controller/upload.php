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
        if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['error'][0] == 0) {
            $name = array();
            for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
                if ($_FILES['file']['type'][$i] != File::mime_by_ext('jpg')) continue;
                $tmp = Model::factory('Photo')->load($_FILES['file']['tmp_name'][$i]);
                if ($tmp !== false) $name[] = $tmp;
            }
            $this->response->body(View::factory('upl2',array(
                'name' =>$name,
                )));
        } else {
            throw new HTTP_Exception_500();
        }
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