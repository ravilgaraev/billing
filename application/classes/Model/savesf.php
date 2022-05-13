<?php defined('SYSPATH') or die('No direct script access.');

class Model_Savesf extends Model{
    //генерация номера счета фактуры
    function get_nomsf()
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM nomsf;' );
        $result = $query->execute();
        $res = (int)$result[0]['nom'];
        $res ++;
        $query = DB::query(Database::UPDATE, 'UPDATE nomsf SET nom = :nom;' );
        $query->parameters(array(
            ':nom' => $res,
        ));
        $query->execute();
        return $res;
    }    
    //Генерация счет фактур
    function savetobase()
    {
        $query = DB::query(Database::SELECT, "SELECT * FROM sf WHERE username='newmonth';");
        $result = $query->execute();
        
        $month = date("m")-1;
        $year = date("Y");
        if(0 == $month){$month = 12; $year -= 1;}
        if(10 > $month){$month = '0'.$month;}
        $date = Date::days(date($month,$year));
        $day = $date[1];
        $start = $day."-".$month."-".$year;
        $finish = count($date)."-".$month."-".$year ;
        $chekdate = $year."-".$month."-01";
        
        foreach ($result as $newm)
        {
            if ($chekdate == $newm['date']) { return 1; }
        }
        $query = DB::query(Database::INSERT, 'INSERT INTO sf VALUE ('
                    . ':id, :username, :date, :month, :year, :nomsf, :total, :content);');
            $query->parameters(array(
                ':id' => '',
                ':username' => 'newmonth',
                ':date' => $chekdate,
                ':month' => $month,
                ':year' => $year,
                ':nomsf' => '',
                ':total' => 0,
                ':content' => 'учет месяца',
            ));
            $query->execute();
            
        $all_users = Model::factory('users')->get_all_users();
        foreach ($all_users as $user)
        {
            if('y' == $user['s']) {continue;}
            //if('no' == $user['feecheck']) {continue;}
            $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                    . "WHERE username = :username AND date = :date;");
            $query->parameters(array(
                ':username' => $user['username'],
                ':date' => $month.$year,
            ));
            $services = $query->execute();
            $total = 0;
            foreach ($services as $key => $value) {
                $total += $value['total'];
            }
 
            if(0 == count($services)) {continue;}
//            if('y' == $user['nds'])
  //          {
                if(('ru' == $user['language'])||('Ru' == $user['language'])) 
                {
                    $nomsf = $this->get_nomsf();
                    //$nomsf = 1000;
                    $content = View::factory('printsf/v_printsf_nds',array(
                        'user' => $user,
                        'nomsf' => $nomsf,
                        'services' => $services,
                        'start' => $start,
                        'finish' => $finish,
                        ));
                }
                else
                {
                    $nomsf = $this->get_nomsf();
                    //$nomsf = 1000;
                    $content = View::factory('printsf/v_printsf_en_nds',array(
                        'user' => $user,
                        'nomsf' => $nomsf,
                        'services' => $services,
                        'start' => $start,
                        'finish' => $finish,
                        ));
                }
            $query = DB::query(Database::INSERT, 'INSERT INTO sf VALUE ('
                    . ':id, :username, :date, :month, :year, :nomsf, :total, :content);');
            $query->parameters(array(
                ':id' => '',
                ':username' => $user['username'],
                ':date' => date("Y-m-d"),
                ':month' => $month,
                ':year' => $year,
                ':nomsf' => $nomsf,
                ':total' => $total,
                ':content' => $content,
            ));
            $query->execute();
            //$schet = Model::factory('schet')->chet_sf($user['username']);
            //Model::factory('schet')->save_schet($schet['username'],$schet['textschet'],$schet['summa'],$schet['nomschet'],$nomsf);
        }
    }
    
    
    
    //Генерация счет фактур didox
    function didox($month, $year, $type, $user_name, $face)
    {
        $date = Date::days(date($month,$year));
        $day = $date[1];
        $start = $day."-".$month."-".$year;
        $finish = count($date)."-".$month."-".$year ;
        $chekdate = $year."-".$month."-01";
        
        $didox = [];
        $sh = [];
        $sh1 = [];
        $i=5;
        $nn=1;


        $ws = new Spreadsheet(array(
            'author'    => 'Kohana-PHPExcel',
            'title'    => 'Report',
            'subject'    => 'Subject',
            'description' => 'Description',
        ));
        
        $ws->set_active_sheet(0);
        $as = $ws->get_active_sheet();
        $as->setTitle('Report');
        
        $as->getDefaultStyle()->getFont()->setSize(9);

        if('' != $user_name)
            {$all_users =  Model::factory('users')->get_one_users($user_name);}
        else 
            {$all_users = Model::factory('users')->get_all_users();}

            
            
        include 'excel.php';
        
            
        
        foreach ($all_users as $user)
        {
            if('y' == $user['s']) {continue;}
            if($face != $user['urfiz']) {continue;}
            if('' == $user_name) {
                if($type != $user['paymentmethod']) {continue;}}
            
            $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                    . "WHERE username = :username AND price > '0' AND date = :date;");
            $query->parameters(array(
                ':username' => $user['username'],
                ':date' => $month.$year,
                ':face' => $face,
            ));
            $services = $query->execute();
            $total = 0;
            foreach ($services as $key => $value) {
                $total += $value['total'];
            }
 
            if(0 == count($services)) {continue;}

            $date = explode("-", $finish);
            $date1 = explode("-", $user['cdate']);

            foreach ($services as $key => $value) {
                //echo $key,$value['service'],"<br>";

                if(0 == $key) {
//                    $sh[0] = $i;
                    $query = DB::query(Database::SELECT, "SELECT * FROM sf "
                                . "WHERE username = :username AND month = :month AND year = :year;");
                    $query->parameters(array(
                        ':username' => $user['username'],
                        ':month' => $month,
                        ':year' => $year,
                    ));
                    $nomsf = $query->execute();
                    
                    $as->setCellValueExplicit("A".$i, $nn,'s');
                    $as->setCellValueExplicit("B".$i, '0','s');
                    if ('Физическое' == $user['urfiz']) { $as->setCellValueExplicit("C".$i, '1','s');}
                    $as->setCellValueExplicit("D".$i, 'IRS-'.$nomsf[0]['nomsf'],'s');
                    $as->setCellValueExplicit("E".$i, $date[0].".".$date[1].".".$date[2],'s');
                    $as->setCellValueExplicit("F".$i, $user['contract'],'s');
                    $as->setCellValueExplicit("G".$i, $date1[2].".".$date1[1].".".$date1[0],'s');
                    $as->setCellValueExplicit("N".$i, '202606274','s');
                    $as->setCellValueExplicit("Q".$i, '20208000903906693001','s');
                    $as->setCellValueExplicit("R".$i, '00407','s');
                    $as->setCellValueExplicit("X".$i, 'Axundjanov Sh.','s');
                    $as->setCellValueExplicit("Y".$i, 'Toxtaeva D.','s');
                    $as->setCellValueExplicit("AB".$i, strval($user['inn']),'s');
                    $as->setCellValueExplicit("AO".$i, strval($key+1));
                    $as->setCellValueExplicit("AS".$i, $value['service'],'s');
                    $as->setCellValueExplicit("AT".$i, '10304006001000000','s');
                    $as->setCellValueExplicit("AW".$i, '25','s');
                    $as->setCellValueExplicit("AZ".$i, '1','s');
                    $as->setCellValueExplicit("BA".$i, ('n' == $user['nds']) ? strval(number_format($value['amount']*$value['price']*100,2,'.','')) :
                                                    strval(number_format($value['amount']*$value['price']*100/($user['stavkands']+100),2,'.','')),'s');
                    $as->setCellValueExplicit("BD".$i, ('n' == $user['nds']) ? strval(number_format($value['amount']*$value['price']*100,2,'.','')) :
                                                    strval(number_format($value['amount']*$value['price']*100/($user['stavkands']+100),2,'.','')),'s');
                    $as->setCellValueExplicit("BE".$i, ('n' == $user['nds']) ? 'Без НДС' : $user['stavkands'],'s');
                    $as->setCellValueExplicit("BF".$i, ('n' == $user['nds']) ? '0' : 
                                strval(number_format($value['amount']*$value['price'] - $value['amount']*$value['price']*100/($user['stavkands']+100),2,'.','')),'s');
                    $as->setCellValueExplicit("BG".$i, strval(number_format($value['total'],2,'.','')),'s');
                    $as->setCellValueExplicit("BH".$i, (100 < $user['stavkands']) ? $user['stavkands'] : '','s');
                }
                else {
                    $as->setCellValueExplicit("A".$i, $nn,'s');
                    $as->setCellValueExplicit("B".$i, '0','s');
                    if ('Физическое' == $user['urfiz']) { $as->setCellValueExplicit("C".$i, '1','s');}
                    $as->setCellValueExplicit("D".$i, 'IRS-'.$nomsf[0]['nomsf'],'s');
                    $as->setCellValueExplicit("E".$i, $date[0].".".$date[1].".".$date[2],'s');
                    $as->setCellValueExplicit("F".$i, $user['contract'],'s');
                    $as->setCellValueExplicit("G".$i, $date1[2].".".$date1[1].".".$date1[0],'s');
                    $as->setCellValueExplicit("N".$i, '202606274','s');
                    $as->setCellValueExplicit("X".$i, 'Axundjanov Sh.','s');
                    $as->setCellValueExplicit("Y".$i, 'Toxtaeva D.','s');
                    $as->setCellValueExplicit("AB".$i, strval($user['inn']),'s');
//                    $as->setCellValueExplicit("AE".$i, strval($user['account_num']),'s');
//                    $as->setCellValueExplicit("AF".$i, strval($user['mfo']),'s');
                    $as->setCellValueExplicit("AO".$i, strval($key+1));
                    $as->setCellValueExplicit("AS".$i, $value['service'],'s');
                    $as->setCellValueExplicit("AT".$i, '10304006001000000','s');
                    $as->setCellValueExplicit("AW".$i, '25','s');
                    $as->setCellValueExplicit("AZ".$i, '1','s');
                    $as->setCellValueExplicit("BA".$i, strval(number_format($value['amount']*$value['price']*100/($user['stavkands']+100),2,'.','')),'s');
                    $as->setCellValueExplicit("BD".$i, strval(number_format($value['amount']*$value['price']*100/($user['stavkands']+100),2,'.','')),'s');
                    $as->setCellValueExplicit("BE".$i, ('0' == $user['stavkands']) ? 'Без НДС' : $user['stavkands'],'s');
                    $as->setCellValueExplicit("BF".$i, strval(number_format($value['amount']*$value['price'] - $value['amount']*$value['price']*100/($user['stavkands']+100),2,'.','')),'s');
                    $as->setCellValueExplicit("BG".$i, strval(number_format($value['total'],2,'.','')),'s');
                    $as->setCellValueExplicit("BH".$i, (100 < $user['stavkands']) ? $user['stavkands'] : '','s');
                }

            $sh1[$i] = $sh;
            $i++;
            $nn++;
            }
          
        }

//        $ws->set_data($sh1, false);
        if (isset($user_name)){$filename = 'report_'.$user_name.'_'.$month.'_'.$year;}
        else{$filename = 'report_'.$month.'_'.$year;}
        $filename .= '_'.$type.'_'.$face;
        $ws->send(array('name'=>$filename, 'format'=>'Excel2007')); 
        return $didox;
    }
    
    
    
    //генерация одной счет фактуры
    function saveonesf($username)
    {
              
        $month = date("m")-1;
        $year = date("Y");
        if(0 == $month){$month = 12; $year -= 1;}
        if(10 > $month){$month = '0'.$month;}
        $date = Date::days(date($month,$year));
        $day = $date[1];
        $start = $day."-".$month."-".$year;
        $finish = count($date)."-".$month."-".$year ;
        
        $all_users = Model::factory('users')->get_one_users($username);
        foreach ($all_users as $user)
        {
            if('y' == $user['s']) {continue;}
            $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                    . "WHERE username = :username AND date = :date;");
            $query->parameters(array(
                ':username' => $user['username'],
                ':date' => $month.$year,
            ));
            $services = $query->execute();
            $total = 0;
            foreach ($services as $key => $value) {
                $total += $value['total'];
            }
 
            if(0 == count($services)) {continue;}
//            if('y' == $user['nds'])
  //          {
                if(('ru' == $user['language'])||('Ru' == $user['language'])) 
                {
                    $nomsf = $this->get_nomsf();
                    $content = View::factory('printsf/v_printsf_nds',array(
                        'user' => $user,
                        'nomsf' => $nomsf,
                        'services' => $services,
                        'start' => $start,
                        'finish' => $finish,
                        ));
                }
                else
                {
                    $nomsf = $this->get_nomsf();
                    $content = View::factory('printsf/v_printsf_en_nds',array(
                        'user' => $user,
                        'nomsf' => $nomsf,
                        'services' => $services,
                        'start' => $start,
                        'finish' => $finish,
                        ));
                }
            $query = DB::query(Database::INSERT, 'INSERT INTO sf VALUE ('
                    . ':id, :username, :date, :month, :year, :nomsf, :total, :content);');
            $query->parameters(array(
                ':id' => '',
                ':username' => $user['username'],
                ':date' => date("Y-m-d"),
                ':month' => $month,
                ':year' => $year,
                ':nomsf' => $nomsf,
                ':total' => $total,
                ':content' => $content,
            ));
            $query->execute();
            $schet = Model::factory('schet')->chet_sf($user['username']);
            Model::factory('schet')->save_schet($schet['username'],$schet['textschet'],$schet['summa'],$schet['nomschet'],$nomsf);
        }
    }
    
    function sfupdate($username,$month,$year)
    {
        if(''==$username){return;}
        $date = Date::days(date($month,$year));
        $day = $date[1];
        $start = $day."-".$month."-".$year;
        $finish = count($date)."-".$month."-".$year ;
        
        $user1 = Model::factory('users')->get_one_users($username);
        foreach ($user1 as $key => $user) {
            
        }
        
        $query = DB::query(Database::SELECT, "SELECT * FROM sf "
                . "WHERE username = :username AND month =:month AND year = :year;");
        $query->parameters(array(
            ':username' => $username,
            ':month' => $month,
            ':year' => $year,
        ));
        $sf = $query->execute();
        
        $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                . "WHERE username = :username AND date = :date;");
        $query->parameters(array(
            ':username' => $username,
            ':date' => $month.$year,
        ));
        $services = $query->execute();

        
        if(('ru' == $user['language'])||('Ru' == $user['language'])) 
                {
                    $nomsf = $sf[0]['nomsf'];
                    $content = View::factory('printsf/v_printsf_nds',array(
                        'user' => $user,
                        'nomsf' => $nomsf,
                        'services' => $services,
                        'start' => $start,
                        'finish' => $finish,
                        ));
                }
                else
                {
                    $nomsf = $sf[0]['nomsf'];
                    $content = View::factory('printsf/v_printsf_en_nds',array(
                        'user' => $user,
                        'nomsf' => $nomsf,
                        'services' => $services,
                        'start' => $start,
                        'finish' => $finish,
                        ));
                }
                
        $query = DB::query(Database::UPDATE, 'UPDATE sf SET textsf=:content '
                . 'WHERE id=:id;');
        $query->parameters(array(
            ':id' => $sf[0]['id'],
            ':content' => $content,
        ));
        $query->execute();
    }




    //запись таблицы абонента
    function saveusertable()
    {
        $month = date("m");
        $year = date("Y");
        $all_users = Model::factory('users')->get_all_users();
        foreach ($all_users as $user)
        {
            $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                    . "WHERE username = :username AND date = :date;");
            $query->parameters(array(
                ':username' => $user['username'],
                ':date' => $month.$year,
            ));
            $services = $query->execute();
                $content = View::factory('user_info/v_user_table',array(
                    'services' => $services,
                    'user' => $user,
                    ));
            $query = DB::query(Database::INSERT, 'INSERT INTO users_table VALUE ('
                    . ':id, :username, :date, :table);');
            $query->parameters(array(
                ':id' => '',
                ':username' => $user['username'],
                ':date' => $month.$year,
                ':table' => $content,
            ));
            $query->execute();
        }
    }

    //запись одной таблицы для абонента
    function saveoneusertable($month,$year,$one_user)
    {
        $user1 = Model::factory('users')->get_one_users('it-neo');
//        print_r($one_user);die;
        foreach ($user1 as $user)
        {
            $query = DB::query(Database::SELECT, "SELECT * FROM statistics "
                . "WHERE username = :username AND date = :date;");
            $query->parameters(array(
                ':username' => $user['username'],
                ':date' => $month.$year,
            ));
            $services = $query->execute();
//            print_r($services);die;
            $content = View::factory('user_info/v_user_table',array(
                'services' => $services,
                'user' => $user,
            ));
            $query = DB::query(Database::INSERT, 'INSERT INTO users_table VALUE ('
                . ':id, :username, :date, :table);');
            $query->parameters(array(
                ':id' => '',
                ':username' => $user['username'],
                ':date' => $month.$year,
                ':table' => $content,
            ));
            $query->execute();
        }
    }

    //генерация - обновление одной счет фактуры
    function saveusersf($username)
    {
        $query = DB::query(Database::SELECT, "SELECT * FROM sf WHERE username='newmonth';");
        $result = $query->execute();
        
        $month = date("m")-1;
        $year = date("Y");
        if(0 == $month){$month = 12; $year -= 1;}
        if(10 > $month){$month = '0'.$month;}
        $date = Date::days(date($month,$year));
        $day = $date[1];
        $start = $year."-".$month."-".$day;
        $finish = $year."-".$month."-". count($date);
        $chekdate = $year."-".$month."-01";
        
        
        foreach ($result as $newm)
        {
            $checkmonth[] = $newm['date'];
        }
        if(!in_array($chekdate, $checkmonth)) {return "Счет фактуры еще не сгенерированы";}

        $all_users = Model::factory('users')->get_one_users($username);
        foreach ($all_users as $user)
        {
            if('y' == $user['s']) {continue;}
            $sum = 0;
            $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username=:user_name;');
            $query->parameters(array(':user_name' => $username,));
            $ser = $query->execute()->as_array();

            $query = DB::query(Database::SELECT, 'SELECT id, username, service, price FROM one_time '
                    . 'WHERE username=:user_name AND date = :month;');
            $query->parameters(array(
                ':user_name' => $username,
                ':month' => $month,
                ));
            $ser2 = $query->execute()->as_array();
            $services = array_merge($ser,$ser2);
            
            foreach ($services as $key) {$sum += (int) $key['price'];}//сумма за услуги
            if((0 == $sum)&&(0 == $user['prise'])) {continue;}
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
                $content = View::factory('printsf/v_printsf',array('user'=>$result,));
            }
            else
            {
                $content = View::factory('printsf/v_printsf_en',array('user'=>$result,));
            }
            $query = DB::query(Database::UPDATE, 'UPDATE sf SET '
                    . 'textsf = :content '
                    . 'WHERE username = :username AND month = :month AND year = :year;');
            $query->parameters(array(
                ':username' => $user['username'],
                ':month' => $month,
                ':year' => $year,
                ':content' => $content,
            ));
            $query->execute();
        }
    }
    //Вывод счет фактур по категории
    function get_sf($filtr,$filtr2,$month,$year)
    {
        $query = DB::query(Database::SELECT, 
                'SELECT username FROM users '
                . 'WHERE paymentmethod = :filter AND delivmethod = :filter2 '
                . 'ORDER BY username;');//AND urfiz =:urfiz
        $query->parameters(array(
            ':filter' => $filtr,
            ':filter2' => $filtr2,
            //':urfiz' => "Юридическое",
        ));
        $result = $query->execute();
        $all_sf = '';
        $key = 0;
        foreach ($result as $value)
        {
            $content = '';
            $query = DB::query(Database::SELECT, 
                    'SELECT textsf, nomsf FROM sf WHERE username = :username '
                    . 'AND month = :month AND year =:year;');
            $query->parameters(array(
                ':username' => $value['username'],
                ':month' => $month,
                ':year' => $year,
            ));
            $user_sf = $query->execute();
            //var_dump($user_sf);

            if(0 < $key)
            {
                $content = str_replace('<link href="media/css/bootstrap.min.css" rel="stylesheet">
                <link href="media/css/style.css" rel="stylesheet">'," ",$user_sf[0]['textsf']);
            }
            else
            {
                $content = $user_sf[0]['textsf'];
                $key = 1;
            }

            echo $content;

        }
        die;
        return $all_sf;
    }
    
    //Вывод счетов всех
    function get_schet_all($filtr,$filtr2,$month,$year)
    {
        $query = DB::query(Database::SELECT, 
                'SELECT username FROM users '
                . 'WHERE paymentmethod = :filter AND delivmethod = :filter2 '
                . 'ORDER BY username;');//AND urfiz =:urfiz
        $query->parameters(array(
            ':filter' => $filtr,
            ':filter2' => $filtr2,
            //':urfiz' => "Юридическое",
        ));
        $result = $query->execute();
        $all_sf = '';
        foreach ($result as $value)
        {
//            $query = DB::query(Database::SELECT, 
//                    'SELECT schet FROM schet WHERE username = :username '
//                    . 'AND id_sf = NULL;');
//            $query->parameters(array(
//                ':username' => $value['username'],
//                ':date' => $year.'-'.$month.'%',
//            ));
            
            $user_schet = DB::select()->from('schet')
                    ->where('username', '=', $value['username'])
                    ->and_where('date', 'LIKE' , $year.'-'.$month.'%')
                    ->and_where('id_sf', '!=', NULL)
                    ->execute();
            echo $user_schet[0]['schet'];
//            if(0 < strlen($user_sf[0]['textsf']))
//            {
//                $query = DB::query(Database::SELECT, 
//                        'SELECT schet FROM schet WHERE id_sf = :nomsf;');
//                $query->parameters(array(':nomsf' => $user_sf[0]['nomsf'],));
//                $schet = $query->execute();
//                $nn = strpos($user_sf[0]['textsf'], "<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->");
//
//                $startschet = strpos($user_sf[0]['textsf'],"<!--*-->");
//                $finishschet = strpos($user_sf[0]['textsf'],"<!--  конец главного дива-->");
//
//
//                    $schet = '';// '<div style="border-top:2px dotted black;width:900px;"></div><br>'.
//                            //substr($schet[0]['schet'],$startschet,$finishschet-$startschet);
//
//                //$all_sf .= substr_replace($user_sf[0]['textsf'], $schet, $nn);
//                $all_sf = substr_replace($user_sf[0]['textsf'], $schet, $nn);
//                echo $all_sf;
//            }
            //$all_sf .= $user_sf[0]['textsf'].$schet[0]['schet'];
        }
        die;
        return $all_sf;
    }
    
    
    
    
    //Вывод счет фактур по абонненту
    function get_sf_byuser($username,$month,$year)
    {
        $query = DB::query(Database::SELECT, 
                'SELECT textsf FROM sf '
                . 'WHERE username = :username AND month=:month AND year = :year;');
        $query->parameters(array(
            ':username' => $username,
            ':month' => $month,
            ':year' =>$year,
        ));
        $result = $query->execute()->as_array();
        return $result;
    }
    // снятие услуг
    function snyatie_uslug()
    {
        $all_users = Model::factory('users')->get_all_users();

        $main_date = date("m").date("Y");
        $month = date("m");
        $year = date("Y");
        $datetosave = date("Y").date("m").date("d");
        $date = Date::days(date("m,Y"));
        $day = $date[1];
        $start = $year."-".$month."-".$day;
        $finish = $year."-".$month."-". count($date);
        $start2 = $day.".".$month.".".$year;
        $finish2 = count($date).".".$month.".".$year;
        
        foreach ($all_users as $user)
        {
            $username = $user['username'];
            $lang = $user['language'];
            $itogo = 0;
            $tr_in = 0;//исходящий трафик
            $tr_out = 0;//входящий трафик
            $tr_in_priv = 0;//исходящий трафик тасикс
            $tr_out_priv = 0;//входящий трафик тасикс
            $period = '';
            if('Ru' == $lang || 'ru' == $lang)
            {
                $period = ' Период: '.$start2.' по '.$finish2;
            }
            else
            {
                $period = ' Billing period: '.$start2.' - '.$finish2;
            }
            
            //запись основной услуги
            
            if(0 != $user['prise'])
            {
                
                $traffic = Model::factory('users')->user_traff($username, $start, $finish);
                foreach ($traffic as $key => $value)
                {
                    $tr_in += $value['Bytes_in'];
                    $tr_in_priv += $value['Bytes_in_priv'];
                    $tr_out += $value['Bytes_out'];
                    $tr_out_priv += $value['Bytes_out_priv'];
                }
                $tr_in -= $tr_in_priv;
                $tr_out -= $tr_out_priv;
                if(0 > $tr_in){$tr_in *=-1;}
                if(0 > $tr_out){$tr_out *=-1;}
                
                if(('ru' == $lang)||('Ru' == $lang))
                {$service = 'Всего входящий трафик (для информации)';}
                else{$service = 'Total Incoming traffic (just for information)';}
                
                $query = DB::insert('statistics', array('username', 'date', 'service', 'amount',
                         'unit', 'skidka', 'price', 'total', 'lang'))
                        ->values(array($username,$main_date,$service,round($tr_out/1024/1024,2),'MByte',0,0,0,$lang,))
                        ->execute();
                
                if(('ru' == $lang)||('Ru' == $lang))
                {$service = 'Всего исходящий трафик (для информации)';}
                else{$service = 'Total Outgoing traffic (just for information)';}
                
                $query = DB::insert('statistics', array('username', 'date', 'service', 'amount',
                         'unit', 'skidka', 'price', 'total', 'lang'))
                        ->values(array($username,$main_date,$service,round($tr_in/1024/1024,2),'MByte',0,0,0,$lang,))
                        ->execute();
                
                if(('N'==$user['unlim'])&&(($tr_out-$user['plan'] > 0)||($tr_in-$user['plan'] > 0)))
                {                  
                    if($tr_out-$user['plan'] > 0)
                    {
                        if(($tr_out-$user['plan']) > ($tr_in-$user['plan']))
                        {
                            $tr = round(($tr_out-$user['plan'])/1024/1024,2);
                            if(('ru' == $lang)||('Ru' == $lang))
                            {$tr_comment = 'Превышение входящего трафика';}
                            else{$tr_comment = 'Incoming overlimit traffic ';}
                        }
                    }
                    if($tr_in-$user['plan'] > 0)
                    {
                        if(($tr_out-$user['plan']) < ($tr_in-$user['plan']))
                        {
                            $tr = round(($tr_in-$user['plan'])/1024/1024,2);
                            if(('ru' == $lang)||('Ru' == $lang))
                            {$tr_comment = 'Превышение исходящего трафика';}
                            else{$tr_comment = 'Outgoing overlimit traffic ';}
                        }
                    }
                    
                    $query = DB::insert('statistics', array('username', 'date', 'service', 'amount',
                         'unit', 'skidka', 'price', 'total', 'lang'))
                        ->values(array($username,$main_date,$tr_comment,$tr,'MByte',0,$user['price_out'],$tr*$user['price_out'],$lang,))
                        ->execute();
                    
                    $itogo +=$tr*$user['price_out'];
                }
                // формирование основной услуги

                
                $service = $user['coment'].$period;
                $amount = $user['skidka'];
                if(('ru' == $lang)||('Ru' == $lang))
                    {$unit = 'месяц';}
                else{$unit = 'month';}
                $skidka = $user['skidka'];
                
                $price = ('yes' == $user['feecheck'])?$user['prise']:0;
                
                //$price = $user['prise'];
                
                $itogo += $price*$skidka;
                //основный услуги (интренет)
                //if((0 == $itogo)&&(""==$user['coment'])){continue;}
                $query = DB::insert('statistics', array('username', 'date', 'service', 'amount',
                         'unit', 'skidka', 'price', 'total', 'lang'))
                        ->values(array($username,$main_date,$service,$amount,$unit,$skidka,$price,$price*$skidka,$lang,));
                $query->execute();
                    
                if($skidka != '1')
                {
                    $query = DB::query(Database::UPDATE, "UPDATE users SET skidka = '1' "
                            . "WHERE username=:username;");
                    $query->parameters(array(':username' => $username,));
                    $query->execute();
                }
            }
            //выборка дополнительных услуг
            $query = DB::query(Database::SELECT, 'SELECT * FROM services '
                    . 'WHERE username=:username;');
            $query->parameters(array(':username' => $username,));
            $result = $query->execute();
            if(0 < count($result))
            {
                foreach ($result as $key => $value) 
                {
                    $query = DB::insert('statistics', array('username', 'date', 'service', 'amount',
                         'unit', 'skidka', 'price', 'total', 'lang'))
                        ->values(array($username,$main_date,$value['service'].$period,
                            1,'месяц',0,$value['price'],$value['price'],$lang,));
                $query->execute();
                $itogo += $value['price'];
                }
            }
            //выборка разовых услуг
            $query = DB::query(Database::SELECT, "SELECT * FROM one_time "
                . "WHERE username=:username AND date = :month AND flag = '0';");
            $query->parameters(array(
                ':username' => $username,
                ':month' => date("m"),
                ));
            $result = $query->execute();
            if(0 < count($result))
            {
                foreach ($result as $key => $value) 
                {
                    $query = DB::insert('statistics', array('username', 'date', 'service', 'amount',
                         'unit', 'skidka', 'price', 'total', 'lang'))
                        ->values(array($username,$main_date,$value['service'].$period,
                            $value['count'],$value['unit'],0,$value['price'],$value['price']*$value['count'],$lang,));
                    $query->execute();

                $itogo += $value['price']*$value['count'];
                    //снятие разовой услуги
                    $sql = "UPDATE one_time SET flag = '1' WHERE username = :username AND flag = '0' ;";
                    $query = DB::query(Database::UPDATE, $sql);
                    $query->parameters(array(':username' => $username,));
                    $query->execute();
                }
            }
//            списание денег за услуги
            if(0 != $itogo)
            {
                $query = DB::insert('accounts', array('user', 'date', 'sum', 'cmt', 'flag'))
                        ->values(array($username,$datetosave,number_format(-$itogo,2,'.',''),
                            'Услуги за '.$month.'/'.$year,0))
                        ->execute();
            }
        }
        $this->saveusertable();
    }    
    
    //Распечатать счет фактуру абонента
    function printusersf($username,$month,$god)
    {
        if (10 > $month){$month = '0'.$month;}
        $query = DB::query(Database::SELECT, 
                    'SELECT * FROM sf WHERE username = :username AND month = :month;');
        $query->parameters(array(
            ':username' => $username,
            ':month' => $month,
        ));
        $user_sf = $query->execute();
        foreach ($user_sf as $key => $value)
        {
            $date = explode("-", $value['date']);
            if($date[0] == $god){return $value;}
        }
    }
    function printdelusersf($username)
    {
        $query = DB::query(Database::SELECT, 
                    'SELECT * FROM del_sf WHERE username = :username;');
        $query->parameters(array(
            ':username' => $username,
        ));
        return $query->execute();
    }
}