<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Upload extends Controller {


    public function action_index()
    {
        if (Model::factory('Users')->oath()) {
            $this->response->body(View::factory('upl'));
        } else {
            throw new HTTP_Exception_401();
        }
        
    }

    public function action_next() 
    {
        
        if (isset($_FILES['file']['tmp_name']) && Model::factory('Users')->oath()) {
            $name = array();
            for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
                $tmp = Model::factory('Photo')->load($_FILES['file']['tmp_name'][$i]);
                if ($tmp !== false) $name[] = $tmp;
            }
            $this->response->body(View::factory('upl2',array(
                'name' =>$name,
                )));
        }
    }

    public function action_finish()
    {
        if (isset($_POST) && Model::factory('Users')->oath()) {
            $name = array();
            foreach ($_POST as $key => $value) {
                $key = preg_replace('/[_]/', '.',$key);
                if (preg_match('/\.jpg/', $key)) {
                    if (!file_exists($_SERVER['DOCUMENT_ROOT'].URL::base().'public/img/m_'.$key)) continue;
                    $name[] = array(
                        'title' => $value,
                        'file'  => $key,
                        );
                }
            }
            Model::factory('Photo')->finish_load($name);
            $this->redirect('http://localhost/kohana');
        } else {
            throw new HTTP_Exception_401();
        }
        
    }


} 