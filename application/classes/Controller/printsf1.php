<?php defined('SYSPATH') or die('No direct script access.');

//class Controller_Printsf extends Controller_Template{
class Controller_Printsf extends Controller{    
//    public $template = 'printsf/v_printsfmain';
    
    function action_renderchetfakturi()
    {
        Model::factory('savesf')->savetobase();
        $this->request->redirect('/gotovo');
//        $content = Model::factory('savesf')->get_all_sf();
//        foreach ($content as $textsf)
//        {
//            echo $textsf['textsf'];
//            //$printsf += $textsf['textsf'];
//        }
//        die();
        //$this->response->body($printsf);
    }
    
    //Распечатать счет фактуру
    function action_printsf()
    {
        $save = $this->request->query('go');
        if(isset($save))
        {
            $filter = $this->request->query('filter');
            $content = Model::factory('savesf')->get_sf($filter);
            $this->response->body($content);
        }
    }
}