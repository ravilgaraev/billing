<?php defined('SYSPATH') or die('No direct script access.');

class Model_Schet extends Model{
    
    //генерация номера счета
    function get_nomschet()
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM nomschet;' );
        $result = $query->execute();
        $res = (int)$result[0]['nom'];
        $res ++;
        $query = DB::query(Database::UPDATE, 'UPDATE nomschet SET nom = :nom;' );
        $query->parameters(array(
            ':nom' => $res,
        ));
        $query->execute();
        return $res;
    }
    //генерация счета для распечатки в счет-фактуре
    function chet_sf($username)
    {
        $nomschet = $this->get_nomschet();
        $user = Model::factory('users')->get_one_users($username);
        $query = DB::select()
                ->from('accounts')
                ->where('user', '=', $username)
                ->order_by('date','ASC')
                ->execute();
        $many = 0;$price=0;$serv =0;$topay=0;$nds=0;
        foreach ($query as $key => $value) 
        {
            $many += $value['sum'];            
        }
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username=:user_name;');
        $query->parameters(array(':user_name' => $username,));
        $services = $query->execute();
        foreach ($services as $key) {$serv += (int) $key['price'];}//сумма за услуги
        if(('ru'==$user[0]['language'])||('Ru'==$user[0]['language']))
        {
            switch (date("m")) {
            case 1:$month = 'январь';break;
            case 2:$month = 'февраль';break;
            case 3:$month = 'март';break;
            case 4:$month = 'апрель';break;
            case 5:$month = 'май';break;
            case 6:$month = 'июнь';break;
            case 7:$month = 'июль';break;
            case 8:$month = 'август';break;
            case 9:$month = 'сентябрь';break;
            case 10:$month = 'октябрь';break;
            case 11:$month = 'ноябрь';break;
            case 12:$month = 'декабрь';break;
        }
        }
        else
        {
            switch (date("m")) {
                case 1:$month = 'january';break;
                case 2:$month = 'february';break;
                case 3:$month = 'march';break;
                case 4:$month = 'april';break;
                case 5:$month = 'may';break;
                case 6:$month = 'june';break;
                case 7:$month = 'july';break;
                case 8:$month = 'august';break;
                case 9:$month = 'september';break;
                case 10:$month = 'october';break;
                case 11:$month = 'november';break;
                case 12:$month = 'december';break;
            }
        }
        $m = date("m")-1;
        $y = date("Y");
        if(0 > $m){$m = 12; $y -=1;}
        if(10 > $m){$m ="0".$m;}
        $date = Date::days(date($m,$y));
        $datebefo = count($date).".".$m.".".$y;
        
        
        $price = $user[0]['prise']+$serv;
        //$price = $price*100/($user[0]['stavkands']+100);
        
        $topay = $price - $many;
        
        if(0 > $topay) {$topay = 0;}
        $nds = $price - $price*100/($user[0]['stavkands']+100);
        
        
        if(('ru'==$user[0]['language'])||('Ru'==$user[0]['language']))
        {
            $content = View::factory('schetforpay/v_print_schet_sf')
                    ->bind('nomschet', $nomschet)
                    ->bind('user', $user)
                    ->bind('many', $many)
                    ->bind('datebefo', $datebefo)
                    ->bind('month', $month)
                    ->bind('price', $price)
                    ->bind('topay', $topay)
                    ->bind('nds', $nds);
        }
        else
        {
            $content = View::factory('schetforpay/v_print_schet_sf_en')
                ->bind('nomschet', $nomschet)
                ->bind('user', $user)
                ->bind('many', $many)
                ->bind('datebefo', $datebefo)
                ->bind('month', $month)
                ->bind('price', $price)
                ->bind('topay', $topay)
                ->bind('nds', $nds);
        }
        $all['username'] = $username;
        $all['textschet'] = $content;
        $all['summa'] = $topay;
        $all['nomschet'] = $nomschet;
        return $all;
    }
    // Выбор оплат
    function get_all_pay($username)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM accounts WHERE user = :username ORDER BY date DESC;' );
        $query->parameters(array(
           ':username' => $username,
        ));
        return $query->execute();
    }
    //сохранить счет в базе
    function save_schet($username,$textschet,$summa,$nomschet,$id_sf=null,$render=0)
    {
        $query = DB::query(Database::INSERT, 'INSERT INTO schet VALUE ('
                    . ':id, :username, :date, :schet, :summa, :nomschet, :id_sf, :render);');
            $query->parameters(array(
                ':id' => '',
                ':username' => $username,
                ':date' => date("Y-m-d"),
                ':schet' => $textschet,
                ':summa' => (int)$summa,
                ':nomschet' => "IP-".$nomschet,
                ':id_sf' => $id_sf,
                ':render' => $render,
            ));
            $query->execute();
    }
    
    //внести деньги на счет
    function enterpay($username,$summa,$nomschet,$date,$v)
    {
        if(1 == $v){
            $cmt = 'Возврат средств';
            $summa *= -1;
        }
        else 
        {$cmt = 'Оплата услуг (счет '.$nomschet.')';}
        $query = DB::query(Database::INSERT, 'INSERT INTO accounts VALUE ('
                    . ':id, :user, :date, :sum, :cmt, :flag);');
            $query->parameters(array(
                ':id' => '',
                ':user' => $username,
                ':date' => $date,
                ':sum' =>  $summa,
                ':cmt' => $cmt,
                ':flag' => $v,
            ));
            return $query->execute();
    }
    //Изменить дату оплаты
    function chanchpay($id,$date)
    {
        $query = DB::query(Database::UPDATE, 'UPDATE accounts SET date = :date '
                . 'WHERE id=:id;');
            $query->parameters(array(
                ':id' => $id,
                ':date' => $date,
            ));
            return $query->execute();
    }
    
    //Информация о записи счета
    function delpayinfo($id)
    {
        return DB::select()
                ->from('accounts')
                ->where('id', '=', $id)
                ->order_by('date')
                ->execute();
    }
    //Удалить оплату
    function delpay($id)
    {
        $query = DB::query(Database::DELETE, 'DELETE FROM accounts '
            . 'WHERE id = :id;');
        $query->parameters(array(
            ':id' => $id,
        ));
        return $query->execute();

        
        
//        $date = str_replace("-", "", $date);
//        $query = DB::query(Database::SELECT, 'SELECT * FROM accounts '
//                . 'WHERE user=:username AND date = :date;');
//            $query->parameters(array(
//                ':date' => $date,
//                ':username' => $user_name,
//            ));
//        $result = $query->execute();
//        //print_r($result);die;
//        
//        foreach ($result as $key => $value) {
//            if(0 < $value["sum"])
//            {
//                echo $value["sum"],"<br>";
//                $query = DB::query(Database::DELETE, 'DELETE FROM accounts '
//                    . 'WHERE id = :id;');
//                $query->parameters(array(
//                    ':id' => $value["id"],
//                ));
//                $query->execute();
//            }
//        }
//        return;
    }
    //Все счета абоннета
    function usersschet($username)
    {
        $query = DB::query(Database::SELECT, 'SELECT username, date, summa, nomschet'
                . ' FROM schet WHERE username = :username ORDER BY date DESC;' );
        $query->parameters(array(
           ':username' => $username,
        ));
        return $query->execute();
    }
    //Найти счет по номеру
    function showbynomschet($nn)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM schet WHERE nomschet LIKE "%":nn;');
        $query->parameters(array(
           ':nn' => $nn,
        ));
        return $query->execute();
    }
    
    //месяц прописью
    function month_string($m)
    {
        switch ($m) {
            case 1:$month = 'январь';break;
            case 2:$month = 'февраль';break;
            case 3:$month = 'март';break;
            case 4:$month = 'апрель';break;
            case 5:$month = 'май';break;
            case 6:$month = 'июнь';break;
            case 7:$month = 'июль';break;
            case 8:$month = 'август';break;
            case 9:$month = 'сентябрь';break;
            case 10:$month = 'октябрь';break;
            case 11:$month = 'ноябрь';break;
            case 12:$month = 'декабрь';break;
        }
        return $month;
    }


    //Генерация счетов на оплату
    function render_chet($type)
    {
        $users = DB::select()
                ->from('users')
                ->where('prepayment', '=', $type)
                ->where('prise', '!=', 0)
                ->where('paymentmethod', '=', 'Bank')
                ->where('urfiz', '=', 'Юридическое')
                ->where('s', '=', 'n')
                ->where('feecheck', '=', 'yes')
                ->order_by('username','ASC')
                ->execute();
        $date_now = date('Y').'-'.date('m');
        $schet = DB::select()
                ->from('schet')
                ->where('username', '=', $users[0]['username'])
                ->where('render', '=', '1')
                ->where('date', 'LIKE', $date_now.'%')
                ->execute();
        if($users[0]['username'] == $schet[0]['username'])
        {
            echo "Уже сгенерированно!";
            return;
        }
        foreach ($users as $user) {
            $many = 0;$serv =0;$one=0;$total=0;
            $query = DB::select()
                ->from('accounts')
                ->where('user', '=', $user['username'])
                ->order_by('date','ASC')
                ->execute();
            
            foreach ($query as $key => $value) {$many += $value['sum'];}
            
            $services = DB::select()
                ->from('services')
                ->where('username', '=', $user['username'])
                ->execute();
            foreach ($services as $key) {$serv += (int) $key['price'];}//сумма за услуги

            $one_time = DB::select()
                ->from('one_time')
                ->where('username', '=', $user['username'])
                ->where('flag', '=', '0')
                ->execute();
            
            foreach ($one_time as $key) {$one += (int) $key['price']*$key['count'];}
            $comment = 'Оплата за использование услуг сети Интернет ';
            if('Yes' == $type)
            {
                $total = $many - $serv - $one - $user['prise'];

                //if(0 > $total) {$comment .= $this->month_string(date('m'));}
                if($user['feecheck'] == 'no') {$total = $many;}
                if(0 <= $total - $user['prise'] - $serv) {continue;}
                if(0 >= $total || 0 < $user['prise'] - $total) 
                    {
                        $total = $total - $serv - $user['prise'];
                        $m = date('m')+1;
                        $y = date("Y");
                        if(13 == $m) {$m = 1; $y += 1;}
                        $comment .= ' - '.$this->month_string($m);
                    }
                $comment .= ' '.$y;
//                if($user['username'] == 'becko') {
//                    echo $many," ",$total," ",$user['prise']," ",$comment;die;
//                }
            }
            else 
            {
                $m = date("m")-1;
                $y = date("Y");
                if(10 > $m){$m ="0".$m;}
                if(0 >= $m){$m = 12; $y -= 1;}
                
                $old_total = DB::select()
                ->from('statistics')
                ->where('username', '=', $user['username'])
                ->where('date', '=', $m.$y)
                ->execute();

                foreach ($old_total as $key) {$total += $key['total']; }

                if(0 <= $many - $total) {continue;}
            }
            
            if(0 > $total) {$total *= -1;}
            
            if('No' == $type)
            {
                if(('ru'==$user['language'])||('Ru'==$user['language']))
                {
                    $month = $this->month_string($m);
                }
                else
                {
                    switch ($m) {
                        case 1:$month = 'january';break;
                        case 2:$month = 'february';break;
                        case 3:$month = 'march';break;
                        case 4:$month = 'april';break;
                        case 5:$month = 'may';break;
                        case 6:$month = 'june';break;
                        case 7:$month = 'july';break;
                        case 8:$month = 'august';break;
                        case 9:$month = 'september';break;
                        case 10:$month = 'october';break;
                        case 11:$month = 'november';break;
                        case 12:$month = 'december';break;
                    }
                }
                $comment .= ' '.$month.' '.$y;
            }
            
            $nomschet = $this->get_nomschet();
            //$nomschet =10000;
            $content = View::factory('schetforpay/v_print_render_schet')
                    ->bind('nomschet', $nomschet)
                    ->bind('user', $user)
                    ->bind('comment', $comment)
                    ->bind('many', $total);
            $this->save_schet($user['username'],$content,$total,$nomschet,null,'1');
            
            echo $content;
        }
        
        return ;
    }
    
            
    function shwo_render_chet($type,$month,$year)
    {
        $content = '';
        $users = DB::select('username')
                ->from('users')
                ->where('prepayment', '=', $type)
                ->where('paymentmethod', '=', 'Bank')
                ->where('s', '=', 'n')
                ->order_by('username','ASC')
                ->execute();
        foreach ($users as $key => $value) {
            $schet = DB::select()
                ->from('schet')
                ->where('username', '=', $value['username'])    
                ->where('date', 'LIKE', $year.'-'.$month.'%')
                ->where('render', '=', '1')
                ->execute();
            //echo $value['username'],' ',$schet[0]['username'],$year.'-'.$month.'<br>';
            if ('' == $content) {
                $content = $schet[0]['schet'];
            }
            else {
                $content .= str_replace('<link href="media/css/bootstrap.min.css" rel="stylesheet">
<link href="media/css/style.css" rel="stylesheet">'," ",$schet[0]['schet']);
            }
            
        }
        
        return $content;
    }
}