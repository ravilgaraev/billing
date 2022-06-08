<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_Base {
    
    public $template = 'main';
    
    public function before() {
        parent::before();
        if ("" == Cookie::get("user"))
        {
            $this->redirect('/',302);
        }
    }

        //снатие денег тест
    public function action_many()
    {
        Model::factory('savesf')->snyatie_uslug();
    }
    public function action_table()
    {
        Model::factory('savesf')->saveusertable();
    }
    //Форма логина
    public function action_index()
    {
        $content = View::factory('v_index');
        $this->template->content = $content;
    }
    
    public function action_manydate()
    {
        $manydate = Model::factory('users')->manydate();
        $content = View::factory('otchet/v_manydate')->bind('manydate', $manydate);
        $this->template->content = $content;
    }

    //вывод абонентов на оплату
    public function action_prepade()
    {
//        $users = Model::factory('users')->prepade();
//        $content = View::factory('schetforpay/v_prepade')->bind('users', $users);
//        $this->template->content = $content;
            
            
            
            
        $show = $this->request->post('show');
        if(isset($show))
        {
            $type = $this->request->post('type');
            $users = Model::factory('users')->prepade($type);
            $content = View::factory('schetforpay/v_prepade')->bind('users', $users);
            $this->template->content = $content;
        }
        else
        {
            $content = View::factory('schetforpay/v_prepade_user');
            $this->template->content = $content;
        }
        
    }

    // Все пользователи
    public function action_allusers()
    {
        $show = $this->request->post('show');
        if(isset($show))
        {
            $this->savelog(" all accounts list printed","");
            $type = Arr::extract($_POST,array('nooffice','office','usd','s','nos',
                'unlim','nounlim','spd','nospd','dopu','ur','fiz'),'');
            $fields = Arr::extract($_POST,array('coment','plan','prise','paymentmethod',
                'ip_addr','ats','port','oborudovanie'),'');
            $all_users = Model::factory('users')->get_all_users_by($type,$fields);
            if(!isset($all_users)){$this->redirect('/allusers');}
            $content = View::factory('show_users/v_show_users',array(
                'type'=>$type,
                'all_users'=>$all_users,
                'fields'=>$fields,
                ));
            $this->template->content = $content;
        }
        else
        {
            $content = View::factory('show_users/v_param_users');
            $this->template->content = $content;
        }
    }
    // Вывод информации абонента
    public function action_userinfo()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            if ($this->request->method() == Request::POST)
            {
                //print_r($_FILES['doc']);die;
                $this->savelog(" записал файл для абонента ",$user_name);
                $username = $this->request->post('username');
                Model::factory('userinfo')->upload($_FILES['doc'],$username);
            }
            
            //$this->savelog(" printed account information for ",$user_name);
            $this->savelog(" вывод карточки абонента ",$user_name);
            $doc_file = Model::factory('userinfo')->show_upload($user_name);
            $user_info = Model::factory('userinfo')->get_user_info($user_name);
            $user_info['befo'] = Model::factory('userinfo')->month_befo($user_name)[0]['table'];
            if(isset($user_info['user'][0]['username']))
            {
                if('En' == $user_info['user'][0]['language'])
                {
                    $content = View::factory('user_info/v_user_info_show_en',
                        array('user'=>$user_info,
                              'doc_file'=>$doc_file,
                            ));
                }
                else 
                {
                    $content = View::factory('user_info/v_user_info_show',
                        array('user'=>$user_info,
                              'doc_file'=>$doc_file,
                            ));
                }
                
                $this->template->content = $content;
            }
            else 
            {
                $this->template->content = 
                        '<div class="alert alert-danger" role="alert">Нет такого абонента</div>';
            }
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('user_info/v_get_users',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    // Вывод информации удаленного абонента
    public function action_deluserinfo()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $this->savelog(" вывод карточки удаленного абонента ",$user_name);
            $user_info = Model::factory('users')->get_deluser_info($user_name);
            if(isset($user_info['u'][0]['username']))
            {
                $content = View::factory('user_info/v_deluser_info_show',array('user'=>$user_info,));
                $this->template->content = $content;
            }
            else 
            {
                $this->template->content = 
                        '<div class="alert alert-danger" role="alert">Нет такого абонента</div>';
            }
        }
        else 
        {
            $users = Model::factory('users')->get_del_users();
            $content = View::factory('user_info/v_get_delusers',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    // Поиск пользователя
    public function action_finduser()
    {
        $field = $this->request->query('field');
        $value = $this->request->query('value');
        if (('' != $field)&&('' != $value))
        {
            $this->savelog(" search initiated by ",$value);
            $user = Model::factory('users')->find_user($field, $value);
            if (0 == count($user)) 
                { $this->template->content = 
                        '<div class="alert alert-danger" role="alert">Нет такого абонента</div>';}
            else 
                {
                    foreach ($user as $str)
                        {echo $s = $str['username'];}
                    $this->redirect('/userinfo?user_name='.$s);
                }
        }
        else 
        {
            $content = View::factory('find_user/v_find_user');
            $this->template->content = $content;
        }
        
    }
    //Показать трафик
    public function action_showtraff()
    {
        $user_name = $this->request->query('user_name');
        $start = $this->request->query('start');
        $finish = $this->request->query('finish');
        if ('' == $user_name) {$user_name = $this->request->query('user_name_text');}
        if ('' != $user_name)
        {
            $this->savelog(" printed traffic information for ",$user_name);
            $user = Model::factory('users')->user_traff($user_name, $start, $finish);
            $content = View::factory('user_traff/v_user_traff',array('user'=>$user,));
            $this->template->content = $content;
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('user_traff/v_get_users_tr',array('users'=>$users,));
            $this->template->content = $content;
        }
    }

    // Редактирование данных абонента
    public function action_edituser()
    {
        $save = $this->request->post('save');
        if(isset($save))
        {
            $value = Arr::extract($_POST,array('contract','cdate','username',
                'language','postmaster','address_n','address_e','orgr','urfiz','phones',
                'fax','contactperson','passport','account_num','bankdetails','inn','okonx',
                'mfo','oked','rkpnds','swift','orderid','delivmethod','delivaddress','status','regdate','registredby',
                'paymentmethod','prepayment','lockingmode','lastmodified','modifiedby',
                'webdomains','unlim','coment','plan','prise','nds','stavkands','skidka','speed','price_out',
                'addr_podkl','ip_addr','spd','ats','port','oborudovanie','s','feecheck'),'');
            //if(''==$value['s']) {$value['s'] = 'n';}
            $id = $this->request->post('service');
            $delserv = $this->request->post('delserv');
            $one_id = $this->request->post('deloneserv');
            $user = 1;
            $user = Model::factory('users')->update_user($value);
            //внесение дополнительных услуг
            Model::factory('users')->enter_services($id, $value['username']);
            //удаление дополнительных услуг
            Model::factory('users')->del_user_service($delserv);
            //удаление разовых услуг
            Model::factory('users')->delete_one_services($one_id);
            
            //внесениеs разовыйq услуги
            $one_services = $this->request->post('one_service');
            $one_price = $this->request->post('one_price');
            $one_count = $this->request->post('one_count');
            $one_unit = $this->request->post('one_unit');
            //$one_datauser = explode("-",$this->request->post('one_data'));
            $one_datauser = $this->request->post('one_data');
            if(isset($one_services))
            {
                //$one_data = $one_datauser[2] . "-" . $one_datauser[1] . "-" . $one_datauser[0];
                Model::factory('users')->insert_one_services
                        ($value['username'], $one_services, $one_price, $one_count, $one_unit, $one_datauser);
            }
            $this->savelog(" edited customer`s profile for ",$value['username']);
            if(1 == $user) 
            {
                $this->redirect('/userinfo?user_name='.$value['username']);
                $this->template->content = 
                        '<div class="alert alert-success" role="alert">Запись сохранена...</div>';
            }
            else 
            {
                $this->template->content = '<div class="alert alert-danger" role="alert">Ошибка...</div>';
            }
        }
        else 
        {
            $user_name = $this->request->query('user_name');
            if ('' == $user_name) { $user_name = $this->request->query('user_name_text');}
            if ('' == $user_name)
            {
                $users= Model::factory('users')->get_all_users();
                $content = View::factory('edit_user/v_get_all_users',array('users'=>$users,));
                $this->template->content = $content;
            }
            else 
            {
                $user = Model::factory('users')->get_user($user_name);
                if(!isset($user[0]['username']))
                    {
                        $user_info = Model::factory('users')->get_deluser_info($user_name);
                        if(isset($user_info['u'][0]['username']))
                        {
                            $content = '<div class="alert alert-danger text-center" role="alert">Абонент удалён</div>';
                        }
                        else 
                        {
                            $content = '<div class="alert alert-danger text-center" role="alert">Нет такого абонента</div>';
                        }
                    }
                else {
                $services = Model::factory('users')->get_services();
                $servis = Model::factory('users')->get_user_services($user_name);
                $one_servis = Model::factory('users')->select_one_services($user_name);
                $content = View::factory('edit_user/v_get_user',array(
                    'user'=>$user,
                    'services'=>$services,
                    'servis'=>$servis,
                    'one_servis'=>$one_servis,
                    ));
                }
                $this->template->content = $content;
            }
        }
    }
    //Проверка имени абонента
    public function action_checkusername()
    {
        $go = $this->request->query('go');
        if(isset($go))
        {
            $check_user_name = $this->request->query('username');
            $result = Model::factory('users')->checkusername($check_user_name);
            if(1 == $result)
            {
                $content = '<span class="text-danger">Имя занято</span>';
                $this->template->content = $content;
            }
            else
            {
                var_dump($check_user_name);die;
                $user_info = Model::factory('users')->get_deluser_info($check_user_name);
                if(isset($user_info['u'][0]['username']))
                {
                    $content = '<div class="alert alert-danger text-center" role="alert">Абонент удалён</div>';
                }
                else 
                {
                    $this->redirect('/newuser?username='.$check_user_name);
                }
            }
        }
        else 
        {
            $content = View::factory('user_info/v_check_user_name');
            $this->template->content = $content;
        }
    }
    //Разовая услуга
    public function action_onetime()
    {
        $save = $this->request->query('save');
        if(isset($save))
        {
            $user_name = $this->request->query('user_name');
            if ('' == $user_name) { $user_name = $this->request->query('user_name_text');}
            $services = $this->request->query('service');
            $price = $this->request->query('price');
            $datauser = explode("-",$this->request->query('data'));
            $data = $datauser[2]."-".$datauser[1]."-".$datauser[0];
            $this->savelog(" created one service for ",$user_name);
            $result = Model::factory('users')->insert_one_services($user_name,$services, $price,$data);
            if(isset($result))
            {
                $this->redirect('/userinfo?user_name='.$user_name);
                $this->template->content = '<div class="alert alert-success" role="alert">Запись сохранена</div>';
            }
            else 
            {
                $this->template->content = '<div class="alert alert-danger" role="alert">Ошибка</div>';
            }
        }
        else
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('services/v_get_servis',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //Удаление разовой услуги
    public function action_delonetime()
    {
        $delet = $this->request->query('delet');
        if(isset($delet))
        {
            $id = $this->request->query('id');
            $user_one_time = Model::factory('users')->select_user_one_services($id);
            $this->savelog(" delete one service for ",$user_one_time[0]['username']);
            $result = Model::factory('users')->delete_one_services($id);
            if(isset($result))
            {
                $this->redirect('/userinfo?user_name='.$user_one_time[0]['username']);
                $this->template->content = 
                        '<div class="alert alert-success" role="alert">Запись сохранена</div>';
            }
            else 
            {
                $this->template->content = 
                        '<div class="alert alert-danger" role="alert">Ошибка</div>';
            }
        }
        else
        {
            $servis = Model::factory('users')->select_one_services();
            $content = View::factory('services/v_del_one_servis',array('servis'=>$servis,));
            $this->template->content = $content;
        }
    }
    //Создание услуг
    public function action_services()
    {
        $id = $this->request->query('id');
        if(isset($id))
        {
            $this->savelog(" deleted service ","");
            $result = Model::factory('users')->del_service($id);
            $this->template->content = $result;
        }
        
        $save = $this->request->query('save');
        if(isset($save))
        {
            $services = $this->request->query('service');
            $price = $this->request->query('price');
            $this->savelog(" created service  ",$services);
            $result = Model::factory('users')->insert_services($services, $price);
            if(isset($result))
            {
                $this->template->content = 
                    '<div class="alert alert-success" role="alert">Запись сохранена</div>';
            }
            else 
            {
                $this->template->content = 
                    '<div class="alert alert-danger" role="alert">Ошибка</div>';
            }
        }
        else
        {
            $services = Model::factory('users')->get_services();
            $content = View::factory('services/v_new_services',array('services'=>$services,));
            $this->template->content = $content;
        }
    }
    //Внесение услуги абоненту
    public function action_enterservices()
    {
        $save = $this->request->query('save');
        if(isset($save))
        {
            $id = $this->request->query('service');
            $user_name = $this->request->query('user_name');
            if ('' == $user_name) { $user_name = $this->request->query('user_name_text');}
            if ('' != $user_name) 
            {
                $this->savelog(" new service added for customer  ",$user_name);
                $result = Model::factory('users')->enter_services($id, $user_name);
            }
            if(isset($result)) 
            {
                $this->redirect('/userinfo?user_name='.$user_name);
            }
            else 
            {
                $this->template->content = 
                    '<div class="alert alert-danger" role="alert">Ошибка</div>';
            }
        }
        else
        {
            $all_users = Model::factory('users')->get_all_users();
            $services = Model::factory('users')->get_services();
            $content = View::factory('services/v_enter_service',array(
                'users' => $all_users,
                'services' => $services,
                ));
            $this->template->content = $content;
        }
    }

    //Удаление услуги у абонента
    public function action_delservices()
    {
        $user_name = $this->request->query('username');
        if ('' == $user_name) { $user_name = $this->request->query('user_name_text');}
        if(isset($user_name))
        {
            $del = $this->request->query('delet');
            if('Удалить' == $del)
            {
                $id = $this->request->query('id');
                $this->savelog(" service deleted for customer  ",$user_name);
                Model::factory('users')->del_user_service($id);
                $this->redirect('/userinfo?user_name='.$user_name);
            }
            else
            {
                $servis = Model::factory('users')->get_user_services($user_name);
                $content = View::factory('services/v_del_servis',array(
                'servis' => $servis,
                'username' => $user_name,
                ));
            }
            $this->template->content = $content;
        }
        else 
        {
            $all_users = Model::factory('users')->get_all_users();
            $content = View::factory('services/v_del_services_next',array('users'=>$all_users,));
            $this->template->content = $content;
        }
    }
    //Закончена генерация счет фактур
    public function action_gotovo()
    {
        $this->template->content = '<div class="alert alert-success" role="alert">ХГатово</div>';
    }
    //Распечатать счет на оплату - касса
    public function action_cashschet()
    {
        $users = Model::factory('users')->get_all_users();
        $content = View::factory('schetforpay/v_get_users_schet_cash',array('users'=>$users,));
        $this->template->content = $content;
    }
    //Вывод счет фактур на экран
    function action_printsavesf()
    {
        $save = $this->request->query('go');
        if(isset($save))
        {
            $this->savelog(" printed invoice ","");
            $filter = $this->request->query('filter');
            $filter2 = $this->request->query('filter2');
            $content = Model::factory('savesf')->get_sf($filter,$filter2);
            $this->template->content = $content;
        }
        else
        {
            $content = View::factory('printsf/v_print_all');
            $this->template->content = $content;
        }
    }
    //Вывод счетов на экран
    function action_printschetall()
    {
        $save = $this->request->query('go');
        if(isset($save))
        {
            $this->savelog(" вывел все счета на оплату ","");
            $filter = $this->request->query('filter');
            $filter2 = $this->request->query('filter2');
            $content = Model::factory('savesf')->get_schetall($filter,$filter2);
            $this->template->content = $content;
        }
        else
        {
            $content = View::factory('printsf/v_print_schet_all');
            $this->template->content = $content;
        }
    }    

    //Генерация счетов на оплату
    public function action_renderall()
    {
        $content = View::factory('schetforpay/v_render_schet');
        $this->template->content = $content;
    }

    //Печать счета на оплату
    public function action_printschet()
    {
        $user_name = $this->request->query('user_name_text');
        //$many = $this->request->query('many');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $this->savelog(" generated invoice for ",$user_name);
            $user = Model::factory('users')->user_traff($user_name, $start, $finish);
            $content = View::factory('user_traff/v_user_traff',array('user'=>$user,));
            $this->template->content = $content;
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('schetforpay/v_get_users_schet',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //Выписанные счета
    public function action_usersschet()
    {
        $user_name = $this->request->query('user_name_text');
        $many = $this->request->query('many');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $this->savelog(" printed invoice for ",$user_name);
            $scheta = Model::factory('schet')->usersschet($user_name);
            $content = View::factory('schetforpay/v_usersschet',array('scheta'=>$scheta,));
            $this->template->content = $content;
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('schetforpay/v_all_users_schet',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //Поиск счета по номеру
    public function action_findschet()
    {
        $nn = $this->request->query('nn');
        if ('' != $nn)
        {
            $this->savelog(" printed find invoice for ",$nn);
            $schet = Model::factory('schet')->showbynomschet($nn);
            $content = View::factory('schetforpay/v_showfindrschet',array('schet'=>$schet,));
            $this->template->content = $content;
        }
        else 
        {
            $content = View::factory('schetforpay/v_find_schet');
            $this->template->content = $content;
        }
    }
    //Внести оплату
    public function action_enterpay()
    {
        $user_name = $this->request->query('user_name_text');
        $many = $this->request->query('many');
        $nomschet = $this->request->query('nomschet');
        $date = $this->request->query('date');
        $v = $this->request->query('v');
        if(!isset($v)){$v = 0;}
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            if(0 > $many) {
                $this->template->content = '<div class="alert alert-danger" role="alert">Не правильная сумма!</div>';
            }
            else {
                $this->savelog(" enter payment for ",$user_name);
                $user = Model::factory('schet')->enterpay($user_name, $many,$nomschet,$date,$v);
                $this->redirect('/userinfo?user_name='.$user_name);
                //$this->template->content = '<div class="alert alert-success" role="alert">Запись сохранена...</div>';
            }
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('schetforpay/v_enterpay',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    
    //Изменить дату оплаты
    public function action_changedatepay()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $id = $this->request->query('id');
            $date = $this->request->query('newdate');
            if ('' != $id)
            {
                $this->savelog(" изменил дату оплаты для ",$user_name);
                $user = Model::factory('schet')->chanchpay($id,$date);
                $this->redirect('/userinfo?user_name='.$user_name);
            }
            else 
            {
                $pay = Model::factory('schet')->get_all_pay($user_name);
                $content = View::factory('schetforpay/v_change_date_pay',array(
                    'pay' => $pay,
                    'username' => $user_name,
                    ));
                $this->template->content = $content;
            }
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('schetforpay/v_chanch_pay',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //Удалть оплату
    public function action_delpay()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $id = $this->request->query('id');
            if ('' != $id)
            {
                $text = Model::factory('schet')->delpayinfo($id);
                $text_more = $text[0]['id']." ".$text[0]['user']." ".$text[0]['date']." ".$text[0]['sum']." ".$text[0]['cmt']." ".$text[0]['flag'];
                $this->savelog(" deleted payment record for invoce ".$text_more." ",$user_name);
                $user = Model::factory('schet')->delpay($id);
                $this->redirect('/userinfo?user_name='.$user_name);
            }
            else 
            {
                $pay = Model::factory('schet')->get_all_pay($user_name);
                $content = View::factory('schetforpay/v_date_for_del',array(
                    'pay' => $pay,
                    'username' => $user_name,
                    ));
                $this->template->content = $content;
            }
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('schetforpay/v_del_pay',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //Новый абонент
    public function action_newuser()
    {
        $save = $this->request->post('save');
        if(isset($save))
        {
            $value = Arr::extract($_POST,array('contract','cdate','username',
                'language','postmaster','address_n','address_e','orgr','urfiz','phones',
                'fax','contactperson','passport','account_num','bankdetails','inn','okonx',
                'mfo','oked','rkpnds','swift','orderid','delivmethod','delivaddress','status','regdate','registredby',
                'paymentmethod','prepayment','lockingmode','lastmodified','modifiedby',
                'webdomains','unlim','coment','plan','prise','nds','stavkands','skidka','speed','price_out',
                'addr_podkl','ip_addr','spd','ats','port','oborudovanie','s','feecheck'),'');
            if(''==$value['s']) {$value['s'] = 'n';}
            
            $user = Model::factory('users')->new_user($value);
            $this->savelog(" account registered by ",$value['username']);
            $this->redirect('/userinfo?user_name='.$value['username']);
        }
        else 
        {
            $go = $this->request->post('go');
            $username = $this->request->post('value');
            if(isset($go))
            {
                $user = Model::factory('users')->check_user($username);
                if('' == $user[0]['username'])
                {
                    $user_info = Model::factory('users')->get_deluser_info($username);
                    if(isset($user_info['u'][0]['username']))
                    {
                        $content = '<div class="alert alert-danger text-center" role="alert">Абонент с таким именем удален</div>';
                    }
                    else
                    {
                        $content = View::factory('new_user/v_new_user',array('username' => $username));
                    }
                    $this->template->content = $content;
                }
                else
                {
                    $this->template->content = 
                            '<div class="alert alert-danger text-center" role="alert">Такое имя уже существует</div>';
                }
            }
            else 
            {
                $content = View::factory('find_user/v_check_user');
                $this->template->content = $content;
            }
        }
    }
    //Удаление абонента
    public function action_deluser()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            $this->savelog(" account deleted by ",$user_name);
            $user = Model::factory('users')->deluser($user_name);
            $this->template->content = 
                    '<div class="alert alert-success" role="alert">Запись сохранена...</div>';
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('new_user/v_del_user',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //Счет фактуры удаленных абонентов
    public function action_showdelsf()
    {
        $user_name = $this->request->query('username');
        $textsf = Model::factory('savesf')->printdelusersf($user_name);
        foreach ($textsf as $key => $value)
        {
            echo $value['textsf'];
        }
        die;
        $this->response->body($content);
    }
    //возврат удаленного абонента
    public function action_getbackdeluser()
    {
        $user_name = $this->request->query('username');
        Model::factory('users')->getbackdeluser($user_name);
        $this->template->content = "$user_name востановлен";
        $this->savelog(" восстановил абонента ",$user_name);
    }
    //удалить на хрен абонента
    public function action_delusernahren()
    {
        $user_name = $this->request->query('username');
        Model::factory('users')->delusernahren($user_name);
        $this->template->content = "$user_name Удален совсем";
        $this->savelog("совсем удалил абонента ",$user_name);
    }
    public function action_getback()
    {
        $user_name = $this->request->query('username');
    }

    //форма сообщение генерации счет фактур
    public function action_createschetfakturi()
    {
        $this->savelog(" сгенерировал счет фактуры ","");
        $content = View::factory('printsf/v_view_botton');
        $this->template->content = $content;
    }
    //генерация одной счет фактуры
    public function action_createoneschetfakturi()
    {
        $user = $this->request->query('user');
        Model::factory('savesf')->saveonesf($user);
        $content = "Готово";
        $this->template->content = $content;
    }
    //перерасчет абонента
    public function action_userpre()
    {
        $go = $this->request->query('go');
        if(isset($go))
        {
            $month = $this->request->query('month');
            $year = $this->request->query('year');
            $user_name = $this->request->query('user_name_text');
            if ('' == $user_name) {$user_name = $this->request->query('user_name');}
            $user = Model::factory('rerender')->get_data_user($user_name,$month,$year);
            $this->savelog(" произвел перерасчет абонента ",$user_name);
            if(0== count($user))
            {
                $content = '<div class="alert alert-danger text-center" role="alert">Нет расчета</div>';
            }
            else
            {
                $account = Model::factory('rerender')->get_from_accounts($user_name,$month,$year);
                $content = View::factory('printsf/v_userresave',array(
                'user'      => $user,
                'account'   => $account,
                'month'     => $month,
                'year'      => $year,
                ));
            }
            
            $this->template->content = $content;
        }
        else
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('printsf/v_userpre')->bind('users',$users);
            $this->template->content = $content;
        }
    }
    //Бухгалтерский отчет
    public function action_createotchet()
    {
        $content = View::factory('otchet/v_view_otchet');
        $this->template->content = $content;
    }
    //Бухгалтерский отчет
    public function action_nalotchet()
    {
        $content = View::factory('otchet/v_view_nalotchet');
        $this->template->content = $content;
    }
    //Счет фактура абонента
    public function action_usersf()
    {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
            
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('printsf/v_allusers',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    
    //Распечатать счет фактуру для didox
    function action_didox()
    {
        $go = $this->request->post('go');
        if(isset($go))
        {
            $month = $this->request->post('month');
            $year = $this->request->post('year');
            $type = $this->request->post('type');
            $face = $this->request->post('face');
            $user_name = $this->request->post('user_name_text');
            if ('' == $user_name) {$user_name = $this->request->post('user_name');}
            
            $didox = Model::factory('savesf')->didox($month, $year, $type, $user_name, $face);
            $content = View::factory('printsf/v_printsf_didox',array('didox' => $didox,));
            $this->response->body($content);
        }
        else
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('printsf/v_esf_users',array('users'=>$users,));
            $this->template->content = $content;
        }
        
    }
    
    //Выписанные - внесенные деньги
    public function action_schetmany()
    {
        $go = $this->request->post('go');
        if(isset($go)) {
            $type = $this->request->post('type');
            $pay = $this->request->post('pay');
            $day = $this->request->post('day');
            $month = $this->request->post('month');
            $year = $this->request->post('year');
            
            $many = Model::factory('otchet')->get_all_many($type,$pay,$day,$month,$year);
            $content = View::factory('otchet/v_schetmany',array(
                'many' => $many,
                ));
            $this->template->content = $content;
        } else {
            $content = View::factory('otchet/v_show_schetmany');
            $this->template->content = $content;
        }
        
    }
    //Должники
    public function action_dolshniki()
    {
        $go = $this->request->post('go');
        if(isset($go))
        {
            $type = $this->request->post('type');
            $pay = $this->request->post('pay');
            $users = Model::factory('otchet')->dolshniki($type,$pay);
            if(0 < count($users))
            {
                $content = View::factory('otchet/v_dolshniki',array('users' => $users));
            }
            else
            {
                $content = '<div class="alert alert-danger" role="alert">Нет должников</div>';
            }
            $this->template->content = $content;
        }
        else
        {
            $content = $content = View::factory('otchet/v_dolg_user');
            $this->template->content = $content;
        }
        
    }
    //списание услуг (денег)
    public function action_spisanie()
    {
        Model::factory('savesf')->snyatie_uslug();
        $this->template->content = 'Готово';
    }
    public function action_cleardatebase() 
    {
//        Model::factory('users')->clear_database();
//        $this->template->content = 'Готово';
    }
    //Генерация нового счета для аьонента
    public function action_newschet() {
        $user_name = $this->request->query('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->query('user_name');}
        if ('' != $user_name)
        {
//            $this->savelog(" generated new invoice for ",$user_name);
//            $schet = Model::factory('schet')->chet_sf($user_name);
//            Model::factory('schet')->save_schet($schet['username'],$schet['textschet'],$schet['summa'],$schet['nomschet']);
//            $content = Model::factory('schet')->showbynomschet($schet['nomschet']);
//            //$this->template->content = $content;
        }
        else 
        {
            $users = Model::factory('users')->get_all_users();
            $content = View::factory('schetforpay/v_get_new_users_schet',array('users'=>$users,));
            $this->template->content = $content;
        }
    }
    //удаление загруженного файла
    public function action_delupload()
    {
        $username = $this->request->query('username');
        $file = $this->request->query('file');
        Model::factory('userinfo')->del_upload($file);
        $this->redirect('/userinfo?user_name='.$username);
        
    }
    
    //Акт серки
    public function action_sverka()
    {
        $users = Model::factory('users')->get_all_users();
        $content = $content = View::factory('otchet/v_akt_sv_users',array('users'=>$users,));
        $this->template->content = $content;
    }

    public function action_regip()
    {
        $save = $this->request->post('save');
        if(isset($save))
        {
            $ip = $this->request->post('ip');
            $date = $this->request->post('cdate');
            $username = $this->request->post('username');
            
            $user = Model::factory('users')->get_one_users($username);
            Model::factory('story')->save_story($user,$ip,$date);
            $this->redirect('/regip?user_name='.$username);
        }
        
        $close = $this->request->post('close');
        if(isset($close))
        {
            $id = $this->request->post('id');
            $ddate = $this->request->post('ddate');
            $username = $this->request->post('username');
            
            Model::factory('story')->close_story($id,$ddate);
            $this->redirect('/regip?user_name='.$username);
        }

        $goip = $this->request->post('goip');
        if(isset($goip))
        {
            $ip = $this->request->post('ip');
            $field = 'ip_addr';
            $user = Model::factory('users')->find_user('ip', $ip);
            if (0 == count($user))
            { $this->template->content =
                '<div class="alert alert-danger" role="alert">Нет такого абонента</div>';}
            else
            {
                foreach ($user as $str)
                {echo $s = $str['username'];}
                $this->redirect('/userinfo?user_name='.$s);
            }
//            $this->redirect('/userinfo?user_name='.$username[0]['username']);
        }



        $go = $this->request->post('go');
        if(isset($go))
        {
            $user_name = $this->request->post('user_name_text');
            if ('' == $user_name) {$user_name = $this->request->post('user_name');}
            $user = Model::factory('users')->get_one_users($user_name);
            $story = Model::factory('story')->get_story($user_name);
            $content = View::factory('story/v_story_edit',array('user'=>$user,'story'=>$story));
            $this->template->content = $content;
        }
        else
        {
            $users = Model::factory('users')->get_all_users();
            $content = $content = View::factory('story/v_story_users',array('users'=>$users,));
            $this->template->content = $content;
        }
        
    }

    //Техническая информация
    public function action_techinfo()
    {
        
        $content = $content = View::factory('user_info/v_tech_info');
        $this->template->content = $content;
    }

    public function action_test()
    {
//        $month = $this->request->query('month');
//        $year = $this->request->query('year');
//        $one_user = $this->request->query('$one_user');
//
//        Model::factory('savesf')->saveoneusertable($month,$year,$one_user);
//        $this->template->content = 'asdasdasdasdasd';

//        Model::factory('savesf')->snyatie_uslug();
            //Model::factory('savesf')->saveusertable();
        
//        Model::factory('readfile')->convert2();
//        echo date("d.m.Y");
//            $month = date("m")-1;
//            $year = date("Y");
//            $date = Date::days(date($month,$year));
//            $day = $date[count($date)];
//            if(0 == $month) {$month = 12; $year -= 1;}
//            if(10 > $month) {$month = '0'.$month;}
//            
//            $this->template->content = $year.$month.$day;
//        
        
//        $users = Model::factory('users')->get_all_users();
//        foreach ($users as $key => $value)
//        {
//            echo $value['ip_addr'];
//            
//            Model::factory('story')->save_story2($value,$value['ip_addr'],'');
//        }    
//            
            
//            $username = $value['username'];
//            $query = DB::query(Database::SELECT, 
//            'SELECT * FROM accounts_history WHERE user=:user_name ORDER BY date;');
//            $query->parameters(array(':user_name'=>$username));
//            $many = $query->execute();
//            
//            foreach ($many as $one => $data) 
//            {
//                $query = DB::query(Database::INSERT, 'INSERT INTO accounts VALUE ('
//                    . ':id, :user, :date, :sum, :cmt, :flag);');
//                $query->parameters(array(
//                    ':id' => '',
//                    ':user' => $data['user'], 
//                    ':date' => $data['date'], 
//                    ':sum' => $data['sum'], 
//                    ':cmt' => $data['cmt'], 
//                    ':flag' => $data['flag'],
//                    ));
//                $query->execute();
//            }
//        }
//        
//        
//        $query = DB::query(Database::SELECT, 
//            'SELECT * FROM del_sf WHERE username=:user_name;');
//            $query->parameters(array(':user_name'=>'nokia3'));
//            $many = $query->execute();
//            
//            foreach ($many as $key => $value)
//            {
//                $query = DB::insert('sf', array('id', 'username','date','month','year','nomsf','total','textsf'))
//                        ->values(array($value['id'], $value['username'],$value['date'],$value['month'],
//                            $value['year'],$value['nomsf'],$value['total'],$value['textsf']));
//                $query->execute();
//                
//            }
        
//        $this->template->content = 'asdasdasdasdasd'; //'Готово';
    }
    

} 