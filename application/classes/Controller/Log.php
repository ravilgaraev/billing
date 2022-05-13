<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Log extends Controller_Base{
    
    public $template = 'main';
    
    //чтение лог файлов
    public function action_scan()
    {
        $dir = Model::factory('log')->scan_dir();
        $content = View::factory('log/v_scan_dir')->bind('dir', $dir);
        $this->template->content = $content;
    }
    //чтение лог файла сотрудника
    public function action_logi()
    {
        $pr = $this->request->query('pr');
        $data = Model::factory('log')->log_pr($pr);
        $content = View::factory('log/v_show')->bind('data', $data);
        $this->template->content = $content;
    }
    //чтение лог файла абонента
    public function action_scanuser()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $data = Model::factory('log')->log_user($user_name);
            $content = View::factory('log/v_show_pr')->bind('data', $data);
            $this->template->content = $content;
        }
        else
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('log/v_show_user',array('users'=>$users,));
            $this->template->content = $content;
        }
        
    }
}
