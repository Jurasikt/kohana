<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {


    public function action_login()
    {
        $json = (object)(array("success"=>false,"err"=>array()));
        $post = Validation::factory($_POST);
        $post->rule('login','not_empty')
             ->rule('password','not_empty');
        if ($post->check()) {
            $json->success = Auth::instance()->login($_POST['login'],$_POST['password']);
            if (!$json->success) $json->err[] = "There isn't an account for this login or pass";
        } else $json->err[] = " The password or login is empty";
        $this->response->headers('Content-Type','application/json');
        $this->response->body(json_encode($json));
    }

}