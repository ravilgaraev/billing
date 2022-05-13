<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Statserv extends Controller_Template {
    
    public $template = 'main';
    public function action_show()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            //$this->savelog(" printed password information for ",$user_name);
            $user_info = Model::factory('statserv')->get_password($user_name);
            
            $content = View::factory('statserv/v_stat_show_ps',array(
                'user'=>$user_name,
                'passwd'=> $user_info[0]['password_text'],
                ));
            Model::factory('log')->savelog(" посмотрел/а пароль для статистики абонента ",$user_name);
                $this->template->content = $content;
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('statserv/v_stat_show',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    public function action_edit()
    {
        $username = $this->request->query('username');
        $newpasswd = $this->request->query('password');
        Model::factory('statserv')->new_password($username,$newpasswd);
        Model::factory('log')->savelog(" изменил/а пароль для статистики абонента ",$username);
        $this->template->content = "Пароль изменен";
    }
}