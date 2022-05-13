<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Printsf extends Controller{    
//    public $template = 'printsf/v_printsfmain';
    
    function action_renderchetfakturi()
    {
        Model::factory('savesf')->savetobase();
        $this->redirect('/gotovo');
    }
    //Распечатать счет фактуру
    function action_printsf()
    {
        $save = $this->request->query('go');
        if(isset($save))
        {
            $filter = $this->request->query('filter');
            $filter2 = $this->request->query('filter2');
            $month = $this->request->query('month');
            $year = $this->request->query('year');
            $content = Model::factory('savesf')->get_sf($filter,$filter2,$month,$year);
            $this->response->body($content);
        }
    }
    //Распечатать счет на оплату все
    function action_printallschet()
    {
        $save = $this->request->query('go');
        if(isset($save))
        {
            $filter = $this->request->query('filter');
            $filter2 = $this->request->query('filter2');
            $month = $this->request->query('month');
            $year = $this->request->query('year');
            $content = Model::factory('savesf')->get_schet_all($filter,$filter2,$month,$year);
            $this->response->body($content);
        }
    }
    //Распечатать счет фактуру абонента
    function action_printusersf()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $month = $this->request->query('month');
            $year = $this->request->query('year');
            $content = Model::factory('savesf')->get_sf_byuser($user_name,$month,$year);
            if(0==count($content)){$content[0]['textsf'] ="Нет такой счет фактуры";}
            $this->response->body($content[0]['textsf']);
        }
    }
    
}