<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Upload extends Controller {


    public function action_index()
    {
        if (Cookie::get('user') == 'admin') $log = true;
        else $log = false;
        $this->response->body(View::factory('upl'));
    }

    public function action_next() 
    {
        //if (isset($_FILES['file']['tmp_name'])) var_dump($_FILES['file']['tmp_name']);
        if (isset($_FILES['file']['tmp_name']) && Cookie::get('user') == 'admin') {
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
        if (isset($_POST) && Cookie::get('user') == 'admin') {
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
            $this->response->body('401 Access allowed only for registered users');
        }
        
    }


} 