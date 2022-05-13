<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Rerender extends Controller_Base{    
    
    public $template = 'main';
    
    public function action_newrender()
    {
        $save = $this->request->post('save');
        echo "<br>",$save,"<br>";
        
        if(isset($save))
        {
            $value = Arr::extract($_POST,array('id','username','date','service',
                'amount','unit','skidka','price','total','language',));
            Model::factory('rerender')->newdata($value);
            $this->redirect('/gotovo');
        }
        else
        {
            $user_name = $this->request->query('user_name_text');
            if ('' == $user_name) {$user_name = $this->request->query('user_name');}
            $user = Model::factory('rerender')->get_data_user($user_name);
            //$content = print_r($user);
            $content = View::factory('printsf/v_userresave',array('user'=>$user));
            $this->template->content = $content;
        }
    }
    //Редактировать таблицу statistic
    public function action_userrerender()
    {
        $id = $this->request->query('id');
        $user = Model::factory('rerender')->get_data_id($id);
        $content = View::factory('printsf/v_useridresave',array(
            'user'=>$user,
            ));
        $this->template->content = $content;
    }
    //Редактировать таблицу accounts
    public function action_useracrender()
    {
        $id = $this->request->query('id');
        $user = Model::factory('rerender')->get_from_accounts_id($id);
        $content = View::factory('printsf/v_useracresave',array(
            'user'=>$user,
            ));
        $this->template->content = $content;
    }
    //Сохранить таблицу statistics
    public function action_savererender()
    {
        $save = $this->request->post('save');
        if(isset($save))
        {
            $value = Arr::extract($_POST,array('id','username','date','coment','amount','unit','skidka',
                'price','total','language',));
            Model::factory('rerender')->newdata($value);
            $this->redirect('/userpre?user_name='.$value['username']
                    . '&month='.substr($value['date'],0,2)
                    . '&year='.substr($value['date'],2,4)
                    . '&go=Выбрать');
        }
        $del = $this->request->post('del');
        if(isset($del))
        {
            $value = Arr::extract($_POST,array('id','username','date','amount','unit','skidka',
                'price','total','language',));
            Model::factory('rerender')->deldata($value['id'],$value['username'],$value['date']);
            $this->redirect('/userpre?user_name='.$value['username']
                    . '&month='.substr($value['date'],0,2)
                    . '&year='.substr($value['date'],2,4)
                    . '&go=Выбрать');
        }
    }
    //Сохранить таблицу accounts
    public function action_saveacrender()
    {
        $save = $this->request->post('save');
        if(isset($save))
        {
            $value = Arr::extract($_POST,array('id','user','date','sum','cmt',
                'flag',));
            Model::factory('rerender')->newacdata($value);
            $this->redirect('/userpre?user_name='.$value['user']
                    . '&month='.substr($value['date'],4,2)
                    . '&year='.substr($value['date'],0,4)
                    . '&go=Выбрать');
        }
    }
    //Переписать данные в таблице user_table
    public function action_redata()
    {
        $value = Arr::extract($_GET,array('user','date',));
        Model::factory('rerender')->resaveusertable($value['user'],$value['date']);
        $this->redirect('/userpre?user_name='.$value['user']
                    . '&month='.substr($value['date'],0,2)
                    . '&year='.substr($value['date'],2,4)
                    . '&go=Выбрать');
    }
    //Переписать счет фактуру
    public function action_resf()
    {
        $value = Arr::extract($_GET,array('user','date'));
        Model::factory('savesf')->sfupdate($value['user'],
                substr($value['date'],0,2),
                substr($value['date'],2,4));
        $this->redirect('/userpre?user_name='.$value['user']
                    . '&month='.substr($value['date'],0,2)
                    . '&year='.substr($value['date'],2,4)
                    . '&go=Выбрать');
    }
    //Создать новую услугу
    public function action_newserv()
    {
        $user = Arr::extract($_GET,array('user'));
        $content = View::factory('printsf/v_new_serv',array(
            'user'=>$user['user'],
            ));
        $this->template->content = $content;
    }
    //Сохранить новую услугу(списание денег в ручную)
    public function action_savenewserv()
    {
        $save = $this->request->post('save');
        if(isset($save))
        {
            $value = Arr::extract($_POST,array('user','date','sum','cmt',));
            Model::factory('rerender')->savenewserv($value);
            $this->redirect('/userpre?user_name='.$value['user']
                    . '&month='.substr($value['date'],3,2)
                    . '&year='.substr($value['date'],6,4)
                    . '&go=Выбрать');
        }
    }
}