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
        $comment = $this->request->query('comment');
        $com = $this->request->query('com');
        $col = $this->request->query('col');
        
        $user = Model::factory('users')->get_one_users($user_name);
        $nomschet = Model::factory('schet')->get_nomschet();
        //$nomschet = 10000;
        if(('ru' == $user[0]['language'])||('Ru' == $user[0]['language']))
        {
            if(""==$comment)
            {
                $comment = $com;
            }
            else
            {
                $comment="Оплата за использование услуг сети Интернет ".$comment;
            }
            $content = View::factory('schetforpay/v_print_schet',array(
            'many' => $many,
            'user' => $user,
            'nomschet' => $nomschet,
            'comment' => $comment,
            'col' => $col,
            ));
        }
        else 
        {
            if(""==$comment)
            {
                $comment = $com;
            }
            else
            {
                $comment="Payment for Internet Services ".$comment;
            }
            $content = View::factory('schetforpay/v_print_schet_en',array(
            'many' => $many,
            'user' => $user,
            'nomschet' => $nomschet,
            'comment' => $comment,
            'col' => $col,
            ));
        }
        
        
        //$user1 = $user['username'];
        Model::factory('schet')->save_schet($user[0]['username'],$content,$many*$col,$nomschet);
        $this->response->body($content);
    }
    
    function action_showbynomschet()
    {
        $nn = $this->request->query('nn');
        $result = Model::factory('schet')->showbynomschet($nn);
        $content = $result[0]['schet'];
        $this->response->body($content);
        
    }
    function action_shownewschet()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            //$this->savelog(" generated new invoice for ",$user_name);
            $schet = Model::factory('schet')->chet_sf($user_name);
            Model::factory('schet')->save_schet($schet['username'],$schet['textschet'],$schet['summa'],$schet['nomschet']);
            $content = $schet['nomschet'];
            $result = Model::factory('schet')->showbynomschet('IP-'.$schet['nomschet']);
            $content = $result[0]['schet'];
            $this->response->body($content);
        }
        


//        $nn = $this->request->query('nn');
//        $result = Model::factory('schet')->showbynomschet($nn);
//        $content = $result[0]['schet'];
//        $this->response->body($content);
        
    }
    function action_showschetcash()
    {
        $user_name = $this->request->query('user_name_text');
        $many = $this->request->query('many');
        $day = $this->request->query('day');
        $month = $this->request->query('month');
        $year = $this->request->query('year');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $user = Model::factory('users')->get_one_users($user_name);
            $content = View::factory('schetforpay/v_print_cash',array(
                'user'=>$user,
                'many'=>$many,
                'day'=>$day,
                'month'=>$month,
                'year'=>$year,
                ));
            $this->response->body($content);
        }
    }
    //генерация счетов на оплату
    function action_renderschet()
    {
        $go = $this->request->post('go');
        $show = $this->request->post('show');
        $month = $this->request->post('month');
        $year = $this->request->post('year');
        $type = $this->request->post('type');
        if('Распечатать' == $go)
        {
            $content = Model::factory('schet')->render_chet($type);
            $this->response->body($content);
        }
        if('Показать' == $show)
        {
            $content = Model::factory('schet')->shwo_render_chet($type,$month,$year);
            $this->response->body($content);
        }
        
        
    }
}