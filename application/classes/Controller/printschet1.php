<?php defined('SYSPATH') or die('No direct script access.');

//class Controller_Printsf extends Controller_Template{
class Controller_Printschet extends Controller{    
//    public $template = 'printsf/v_printsfmain';
    
    //Распечатать счет на оплату
    function action_showschet()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        $many = $this->request->query('many');
        $user = Model::factory('users')->get_user_info($user_name);
        $nomschet = Model::factory('schet')->get_nomschet();
        $content = View::factory('schetforpay/v_print_schet',array(
            'many' => $many,
            'user' => $user,
            'nomschet' => $nomschet,
            ));
        
        $user1 = $user['u'];
        Model::factory('schet')->save_schet($user1[0]['username'],$content,$many,$nomschet);
        $this->response->body($content);
    }
}