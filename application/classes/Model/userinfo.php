<?php defined('SYSPATH') or die('No direct script access.');
class Model_Userinfo extends Model {
    //Информация об абоненте
    function get_user_info($user_name,$month = NULL, $year = NULL)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM users WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $user = $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM accounts WHERE user=:user_name ORDER BY date;');
        $query->parameters(array(':user_name'=>$user_name));
        $many = $query->execute();
        //текущий месяц
        if(NULL == $month) 
        {
            $date = Date::days(date("m,Y"));
            $day = $date[1];
            $month = date("m");
            $year = date("Y");
            $start = $year."-".$month."-".$day;
            $finish = $year."-".$month."-". count($date);
        }
        else 
        {
            $date = Date::days($month,$year);
            $day = $date[1];
            $start = $year."-".$month."-".$day;
            $finish = $year."-".$month."-". count($date);
        }
        if ("P" == $user[0]['unlim']) {$traffic = Model::factory('users')->totime($user_name, $start, $finish);}
        else {$traffic = Model::factory('users')->user_traff($user_name, $start, $finish);}
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username=:user_name;');
        $query->parameters(array(':user_name' => $user_name,));
        $services = $query->execute();
        
        $query = DB::query(Database::SELECT, 
                'SELECT * FROM one_time WHERE username=:user_name AND flag=:flag;');
        $query->parameters(array(
                ':user_name' => $user_name,
                ':flag' => '0',
                ));
        $one_time = $query->execute();
        
        $sum = 0;
        foreach ($many as $key => $value)  { $sum += $value['sum']; }//остаток на счете

        //foreach ($services as $key) {$sum -= (int) $key['price'];}//сумма за услуги

        $itogo = 0;
        $traffic_in = 0; 
        $traffic_out =0;
        $traffic_in_priv = 0;
        $traffic_out_priv = 0;
        $traffic_in_pr = 0;
        $traffic_out_pr = 0;
        $price_in_pr = 0;
        $price_out_pr = 0;
        // Считает трафик время
        
        if("P" != $user[0]['unlim'])
        {
            foreach ($traffic as $key)//подсчет трафика
            {
                $traffic_in += $key['Bytes_out'];
                $traffic_in_priv += $key['Bytes_out_priv'];
                $traffic_out += $key['Bytes_in'];
                $traffic_out_priv += $key['Bytes_in_priv'];
            }
            //превышение трафика
            if (("N" == $user[0]['unlim'])&&
                    (($traffic_in-$traffic_in_priv) > $user[0]['plan']))
                {
                    $traffic_in_pr = $traffic_in-$traffic_in_priv - $user[0]['plan'];
                    $price_in_pr = $traffic_in_pr/1048576 * (int)$user[0]['price_out'];
                }

            if (("N" == $user[0]['unlim'])&&
                    (($traffic_out-$traffic_out_priv) > $user[0]['plan']))
                {
                    $traffic_out_pr = ($traffic_out-$traffic_out_priv)-$user[0]['plan'];
                    $price_out_pr = $traffic_out_pr/1048576 * $user[0]['price_out'];
                }
            if ($price_in_pr > $price_out_pr) {$itogo += $price_in_pr;}
                    else {$itogo += $price_out_pr;}    
        }
        else
        {
            foreach ($traffic as $key)
            {
                if('' != $key['hours'])
                {
                    $itogo += number_format($key['price']*number_format($key['hours'],2,'.',','),2,'.',',');
                }
            }
        }
        if('yes' == $user[0]['feecheck']) {
            $itogo += $user[0]['prise']*$user[0]['skidka'];
        }


        foreach ($services as $key) //итоговая сумма услуг
        {
            $itogo += $key['price'];
        }
        foreach ($one_time as $key) //итоговая сумма услуг
        {
            $itogo += $key['price']*$key['count'];
        }
        if('P' != $user[0]['unlim']){$traffic = 0;}
//        if('y' == $user[0]['nds'])
//        {

            $result['table'] = View::factory(
                    ('En' == $user[0]['language'])?'user_info/v_get_user_table_nds_en':
                    'user_info/v_get_user_table_nds',array(
                'user'  => $user,
                'services' => $services,
                'one_time' => $one_time,
                'sum'   => $sum,
                'itogo' => $itogo,
                'traffic'           => $traffic,
                'traffic_in'        => $traffic_in, 
                'traffic_out'       => $traffic_out,
                'traffic_in_priv'   => $traffic_in_priv,
                'traffic_out_priv'  => $traffic_out_priv,
                'traffic_in_pr'     => $traffic_in_pr,
                'traffic_out_pr'    => $traffic_out_pr,
                'price_in_pr'       => $price_in_pr,
                'price_out_pr'      => $price_out_pr,
            ));
//        }
//        else
//        {
//
//            $result['table'] = View::factory('user_info/v_get_user_table',array(
//                'user'  => $user,
//                'services' => $services,
//                'one_time' => $one_time,
//                'sum'   => $sum,
//                'itogo' => $itogo,
//                'traffic'           => $traffic,
//                'traffic_in'        => $traffic_in,
//                'traffic_out'       => $traffic_out,
//                'traffic_in_priv'   => $traffic_in_priv,
//                'traffic_out_priv'  => $traffic_out_priv,
//                'price_in_pr'       => $price_in_pr,
//                'price_out_pr'      => $price_out_pr,
//            ));
//        }
        
        
        $result['itogo'] = $itogo;
        $result['user'] = $user;
        $result['many'] = $many;
        $result['sum'] = $sum;
        return $result;
    }
    //информайия о предедущем месяце
    function month_befo($user_name)
    {
        $month = date("m")-1;
        $year = date("Y");
        if(0 == $month) {$month = 12; $year -= 1;}
        if(10 > $month) {$month = '0'.$month;}
        
        $sql = 'SELECT * FROM users_table WHERE username=:user_name AND date = :start;';
        $query = DB::query(Database::SELECT, $sql);
        $query->parameters(array(':user_name'=>$user_name,
                                 ':start' => $month.$year,
                                ));
        return $query->execute();
    }
    //загрузить файд на сервер
    function upload($file,$username)
    {
        //print_r($file);die;
        if('' == $file['name']) {return;}
        $result = Upload::save($file, NULL, 'upload');
        DB::insert('upload',array('file','file_name','username'))
                ->values(array($result,$file['name'],$username))
                ->execute();
        //print_r($result);die;
    }
    //показать загруженные файды
    function show_upload($username)
    {
        $result = DB::select()->from('upload')->where('username', '=', $username)->execute();
        return $result;
    }
    function del_upload($filename)
    {
        //echo $filename;die;
        DB::delete('upload')->where('file', '=', $filename)->execute();
        unlink($filename);
    }
}