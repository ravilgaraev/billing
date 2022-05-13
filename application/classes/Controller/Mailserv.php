<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Mailserv extends Controller_Base {
    
    public $template = 'main';
    //Пользователи почты
    public function action_showmail()
    {
        $users = Model::factory('mail')->get_all_users();
        $content = View::factory('mail/v_show_mail',array('users'=>$users));
        $this->template->content = $content;
    }
    //Вывод полной информации 
    public function action_usermail()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        $this->savelog(" вывод данных по почте абонента ",$user_name);
        $user = Model::factory('mail')->get_all_info($user_name);
        $content = View::factory('mail/v_show_all',array(
            'user'=>$user,
            'user_name' => $user_name,
            ));
        $this->template->content = $content;
    }
    //Сохранить изменения почты
    public function action_editmail()
    {
        if("Сохранить" == $this->request->query('save'))
        {
            $value['AccountID'] = $this->request->query('accountid');
            $value['Username'] = $this->request->query('Username');
            $value['Mailbox'] = $this->request->query('Mailbox');
            $value['Password'] = $this->request->query('Password');
            $value['EmailAddress'] = $this->request->query('EmailAddress');
            $value['ischarged'] = $this->request->query('ischarged');
            $value['Quota'] = $this->request->query('Quota');
            $value['ForwardAddress'] = $this->request->query('ForwardAddress');
            $value['MailDirLocation'] = $this->request->query('MailDirLocation');
            $value['Active'] = $this->request->query('Active');
            
            $result = Model::factory('mail')->save_edit_data($value);
            $this->savelog(" редактировал/а почтовый ящик ".$value['Mailbox']." абонента ",$value['Username']);
            $this->redirect('/usermail?user_name='.$value['Username']);
        }
        else
        {
            $accountid = $this->request->query('AccountID');
            $user = Model::factory('mail')->get_edit_info($accountid);
            $content = View::factory('mail/v_edit_mail',array('user'=>$user));
            $this->template->content = $content;
        }
    }
    //Удалить почтовый ящик
    public function action_delmail()
    {
        if("Удалить" == $this->request->query('save'))
        {
            $value['AccountID'] = $this->request->query('AccountID');
            $result = Model::factory('mail')->del_mailbox($value['AccountID']);
            $this->savelog(" удалил/а почтовый ящик ".$result[0]['EmailAddress']
                    ." абонента ",$result[0]['Username']);
            $this->redirect('/usermail?user_name='.$result[0]['Username']);
        }
        else
        {
            $accountid = $this->request->query('AccountID');
            $user = Model::factory('mail')->get_edit_info($accountid);
            $content = View::factory('mail/v_del_mail',array('user'=>$user));
            $this->template->content = $content;
        }
    }
    //изменения выртуальных адресов
    function action_editvirtualmail()
    {
        if("Сохранить" == $this->request->query('save'))
        {
            $value['VirtualID'] = $this->request->query('VirtualID');
            $value['Username'] = $this->request->query('Username');
            $value['VirtualAddress'] = $this->request->query('VirtualAddress');
            $value['EmailAddress'] = $this->request->query('EmailAddress');
            $value['Active'] = $this->request->query('Active');
            
            $result = Model::factory('mail')->save_edit_virtual_data($value);
            
            if(1 == $result) 
            {
                $this->savelog(" редактировал/а виртыальный почтовый ящик ".
                        $value['VirtualAddress']." абонента ",$value['Username']);
                $this->redirect('/usermail?user_name='.$value['Username']);
            }
            else
            {
                $this->template->content = '<div class="alert alert-danger" role="alert">Ошибка</div>';
            }
        }
        else
        {
            $virtualid = $this->request->query('VirtualID');
            $vmail = Model::factory('mail')->editvirtualmail($virtualid);
            $content = View::factory('mail/v_edit_vir_mail',array('vmail'=>$vmail));
            $this->template->content = $content;
        }
    }
    //Удаление выртуальных адресов
    function action_delvirtualmail()
    {
        if("Удалить" == $this->request->query('save'))
        {
            $value['VirtualID'] = $this->request->query('VirtualID');
            $value['Username'] = $this->request->query('Username');
            $value['VirtualAddress'] = $this->request->query('VirtualAddress');
            $result = Model::factory('mail')->del_virtual_mailbox($value['VirtualID']);
            $this->savelog(" удалил/а виртыальный почтовый ящик ".
                        $value['VirtualAddress']." абонента ",$value['Username']);
            $this->redirect('/usermail?user_name='.$value['Username']);
        }
        else
        {
            $virtualid = $this->request->query('VirtualID');
            $vmail = Model::factory('mail')->editvirtualmail($virtualid);
            $content = View::factory('mail/v_del_vir_mail',array('vmail'=>$vmail));
            $this->template->content = $content;
        }
    }
    //Создать новый ящик
    public function action_addmail()
    {
        if("Сохранить" == $this->request->query('save'))
        {
            $value['Username'] = $this->request->query('Username');
            $value['Mailbox'] = $this->request->query('mailbox');
            $value['Password'] = $this->request->query('passwd');
            $value['Quota'] = $this->request->query('quota');
            
            $result = Model::factory('mail')->addmailbox($value);
            $this->savelog(" добавил/а почтовый ящик ".
                        $value['Mailbox']." абонента ",$value['Username']);
            $this->redirect('/usermail?user_name='.$value['Username']);
        }
        else
        {
            $user_name = $this->request->query('user_name_text');
            if ('' == $user_name) $user_name = $this->request->query('user_name');
            $content = View::factory('mail/v_addmail',array('user'=>$user_name));
            $this->template->content = $content;
        }
    }
    public function action_addvirtmail()
    {
        if("Сохранить" == $this->request->query('save'))
        {
            $value['Username'] = $this->request->query('user_name');
            $value['EmailAddress'] = $this->request->query('EmailAddress');
            $value['VirtualAddress'] = $this->request->query('virtmailbox');
            $value['AccountID'] = $this->request->query('AccountID');
            
            $result = Model::factory('mail')->addvirtmailbox($value);
            $this->savelog(" добавил/а виртуальный почтовый ящик ".
                        $value['VirtualAddress']." абонента ",$value['Username']);
            $this->redirect('/editmail?AccountID='.$value['AccountID']);
        }
        else
        {
            $user_name = $this->request->query('user_name_text');
            if ('' == $user_name) {$user_name = $this->request->query('user_name');}
            $EmailAddress = $this->request->query('EmailAddress');
            $AccountID = $this->request->query('AccountID');
            $content = View::factory('mail/v_addvirtmail',array(
                'user_name'=>$user_name,
                'EmailAddress' => $EmailAddress,
                'AccountID' => $AccountID,
                    ));
            $this->template->content = $content;
        }
    }
    
}