<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Loginin extends Controller_Base{
    public $template = 'local_user/v_login_main';
    
    public function action_login()
    {
        $user = $this->request->post('user');
        $passwd = $this->request->post('passwd');
        $login = $this->request->post('login');
        
        if(isset($login))
        {
            $auth = Model::factory('authuser')->auth($user,$passwd);
            if (isset($auth[0]['user']))
            {
//                $session = Session::instance();
//                $session->set('user', $auth[0]['user']);
//                $session->set('role', $auth[0]['role']);
                Cookie::set('user', $auth[0]['user']);
                Cookie::set('role', $auth[0]['role']);
                
                $this->redirect('/userinfo',302);
            }
            $this->redirect('/', 302);
        }
        else
        {
            Cookie::delete('user');
            Cookie::delete('role');
            $content = View::factory('local_user/v_login');
            $this->template->content = $content;
        }
    }
    
    public function action_registration()
    {
        $rol = Cookie::get('role');
        if ('admin' == $rol)
        {
            $user = $this->request->post('user');
            $passwd = $this->request->post('passwd');
            $passwd2 = $this->request->post('passwd2');
            $role = $this->request->post('role');
            $login = $this->request->post('login');
            if((isset($login))&&($passwd == $passwd2))
            {
                $result = Model::factory('authuser')->new_user($user,$passwd,$role);
                if (1 == $result) 
                {
                    $this->template->content = '<div class="alert alert-danger" role="alert">Такой обезъян уже есть</div>';
                }
                else 
                {
                    $file_name = "/var/www/billing/billing/log/".$user.".log";
                    file_put_contents($file_name, "новый",FILE_APPEND);
                    $this->redirect('userinfo', 302);
                }
            }
            else
            {
                $content = View::factory('local_user/v_reg');
                $this->template->content = $content;
            }
        }
        else
        {
            $this->template->content = '<div class="alert alert-danger" role="alert">Нет прав</div>';
        }
    }
}