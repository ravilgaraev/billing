<?php defined('SYSPATH') or die('No direct script access.');

class Model_Rerender extends Model{
    
    function get_data_id($id)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM statistics WHERE id=:id;');
        $query->parameters(array(':id' => $id,));
        return $query->execute()->as_array();
    }
    function get_data_user($username,$month,$year)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM statistics '
                . 'WHERE username=:username AND date=:date ;');
        $query->parameters(array(
            ':username' => $username,
            ':date' => $month.$year,
            ));
        return $query->execute()->as_array();
    }
    function get_from_accounts($username,$month,$year)
    {
        $query = DB::select()->from('accounts')
                ->where('user', '=', $username)
                ->where('date', 'LIKE', '%'.$year.$month.'%')
                ->execute();
        return $query;
    }
    function get_from_accounts_id($id)
    {
        $query = DB::select()->from('accounts')->where('id', '=', $id)->execute();
        return $query;
    }
    function deldata($id,$username,$date)
    {
        $query = DB::delete('users_table')
                ->where('username', '=', $username)
                ->where('date', '=', $date)
                ->execute();
        $query = DB::delete('statistics')
                ->where('id', '=', $id)
                ->execute();
        return $query;
    }
    function newdata($value)
    {
        $query = DB::update('statistics')
                ->set(array(
                    'service' => $value['coment'],
                    'amount' => $value['amount'],
                    'unit' => $value['unit'],
                    'skidka' => $value['skidka'],
                    'price' => $value['price'],
                    'total' => $value['total']))
                ->where('id', '=', $value['id'])
                ->execute();
        
        /*$date = Date::days(date($month,$year));
        $day = $date[1];
        if(10 > $day) {$day = '0'.$day;}
        $start2  = $year.$month.$day;
        $finish2 = $year.$month.count($date);
        
        $sql = 'SELECT * FROM accounts WHERE user=:user AND '
                    . '(date BETWEEN :start AND :finish);';
            $query = DB::query(Database::SELECT, $sql);
            $query->parameters(array(
                ':user' => $username,
                ':start' => (int)$start2,
                ':finish' => (int)$finish2." 23:59:59",
                ));
            $many = $query->execute();
            $id =0;
            foreach ($many as $key => $value)
            {
                if(0 > $value['sum']) { $id = $value['id'];}
            }
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM statistics WHERE username=:username;');
        $query->parameters(array(
                ':username' => $username,
                ));
        $result = $query->execute();
        $total =0;
        foreach ($result as $key => $value) 
        {
            $total += $value['total'];
        }
        
        $query = DB::query(Database::UPDATE, 'UPDATE accounts SET sum=:total WHERE id = :id;');
        $query->parameters(array(
            ':id' => $id,
            ':total' => $total*-1,
        ));
        $query->execute();
        
        Model::factory('savesf')->sfupdate($username,$month,$year);
         * 
         */
    }
    function newacdata($value)
    {
        $query = DB::update('accounts')
                ->set(array(
                    'sum' => $value['sum'],
                    'cmt' => $value['cmt'],
                    'flag' => $value['flag']))
                ->where('id', '=', $value['id'])
                ->execute();
        return $query;
    }
    
    function resaveusertable($user,$date)
    {
        
        $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                . "WHERE username = :username AND date = :date;");
        $query->parameters(array(
            ':username' => $user,
            ':date' => $date,
        ));
        $services = $query->execute();
        $oneuser = Model::factory('users')->get_one_users($user);
        foreach ($oneuser as $value) 
        {
            $one_user = $value;
        }
        $content = View::factory('user_info/v_user_table',array(
            'services' => $services,
            'user' => $one_user,
            ));
        //echo $content;die;
        $query = DB::update('users_table')
                ->set(array('table'=>$content))
                ->where('username', '=', $user)
                ->and_where('date', '=', $date)
                ->execute();
        return $query;
    }
    
    
    
    function rerenderdata($user_name)
    {
        $user_info = Model::factory('users')->get_one_users($user_name);
        foreach ($user_info as $user){}
        
        $month = date("m")-1;
        $year = date("Y");
        if(0 == $month){$month = 12; $year -= 1;}
        if(10 > $month){$month = '0'.$month;}
        $date = Date::days(date($month,$year));
        $day = $date[1];
        $start = $year."-".$month."-".$day;
        $finish = $year."-".$month."-". count($date);
        
        $sum = 0;
        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username=:user_name;');
        $query->parameters(array(':user_name' => $user['username'],));
        $ser = $query->execute()->as_array();

        $query = DB::query(Database::SELECT, 'SELECT id, username, service, price FROM one_time '
                . 'WHERE username=:user_name AND date = :month;');
        $query->parameters(array(
            ':user_name' => $user['username'],
            ':month' => $month,
            ));
        $ser2 = $query->execute()->as_array();
        $services = array_merge($ser,$ser2);

        foreach ($services as $key) {$sum += (int) $key['price'];}//сумма за услуги
        if((0 == $sum)&&(0 == $user['prise'])) {return 0;}
        if ("P" == $user['unlim']) 
            {
                $traffic = Model::factory('users')->totime($user['username'], $start, $finish);
            }
            else 
            {
                $traffic = Model::factory('users')->user_traff($user['username'], $start, $finish);
            }
        $result = ['u' => $user, 't' => $traffic, 's' => $services];
        if(('ru' == $user['language'])||('Ru' == $user['language'])) 
        {
            //$content = View::factory('printsf/v_printsf',array('user'=>$result,));
            $content = View::factory('printsf/v_printsf_nds',array('user'=>$result,));
        }
        else
        {
            //$content = View::factory('printsf/v_printsf_en',array('user'=>$result,));
            $content = View::factory('printsf/v_printsf_en_nds',array('user'=>$result,));
        }
        $query = DB::query(Database::UPDATE, 'UPDATE sf SET textsf = :content '
                . 'WHERE username = :username AND month = :month;');
        $query->parameters(array(
            ':content' => $content,
            ':username' => $user['username'],
            ':month' => $month,
        ));
        $query->execute();
        
        $uslugi = Model::factory('userinfo')->get_user_info($user_name, $month, $year);
        $itogo = $uslugi['itogo'];
        
        $data = $year.$month.$date[count($date)];
                
        $sql = "UPDATE accounts SET sum = :sum WHERE user = :username "
                . "AND date = :data AND sum < 0;";
        
        $query = DB::query(Database::UPDATE, $sql);
        $query->parameters(array(
                ':sum' => number_format(-$itogo,2,'.',''),
                ':username' => $user['username'],
                ':data' => $data,
            ));
        $query->execute();
        
        //$sql = "UPDATE users_table SET table = :table WHERE username = :username AND date = :date;";
        $query = DB::query(Database::UPDATE, "UPDATE  `users_table` SET  `table` =  :table "
                . "WHERE username =  :username AND DATE =  :date");
        $query->parameters(array(
                ':username' => $user['username'],
                ':date' => $year.'-'.$month.'-'.$date[count($date)],
                ':table' => $uslugi['table'],
            ));
        $query->execute();
        
        $sql = "UPDATE users SET skidka = '1' WHERE username = :username;";
        $query = DB::query(Database::UPDATE, $sql);
        $query->parameters(array(
            ':username' => $user['username'],
        ));
        $query->execute();
        return;
    }
    
    function savenewserv($value)
    {
        $data = explode('-', $value['date']);
        $value['date'] = $data[2].$data[1].$data[0];
        $value['flag'] = 0;
        $query = DB::insert('accounts', array('user','date','sum','cmt','flag'))
                ->values(array($value['user'],$value['date'],$value['sum'],$value['cmt'],$value['flag'],))
                ->execute();
        return;
        
    }
}