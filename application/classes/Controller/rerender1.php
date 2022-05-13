<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Rernder extends Controller{    
    
    public function action_newrender()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        Model::factory('rerender')->newrender();
        $this->redirect('/gotovo');
    }
}