<?php defined('SYSPATH') or die('No direct script access.');

class Model_Users extends Model{
    //выборка всех абоннентов
    function get_all_users()
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM users ORDER BY username ASC;');
        return $query->execute();
    }
    //Выворка абонентов по полям
    function get_all_users_by($type,$fields)
    {
        $sql = 'SELECT username,';
        foreach ($fields as $key => $value)
        {
            if('on'==$value){$sql .= $key.",";}
        }
        $sql = rtrim($sql,",");
        //$sql .= 'spd ';
        $sql .= ' FROM users ';
        $where = 0;
        $office='';
        $s='';
        $unlim='';
        $face='';
        //'nooffice','office','s','nos'
        if((''==$type['nooffice'])&&('on'==$type['office'])&&('on'==$type['usd'])){$office = "paymentmethod != 'Bank'";$where = 1;}
        if((''==$type['office'])&&('on'==$type['nooffice'])&&('on'==$type['usd'])){$office = "paymentmethod != 'Office'";$where = 1;}
        if((''==$type['usd'])&&('on'==$type['office'])&&('on'==$type['nooffice'])){$office = "paymentmethod != 'Usd'";$where = 1;}
        
        if(('on'==$type['nooffice'])&&(''==$type['office'])&&(''==$type['usd'])){$office = "paymentmethod = 'Bank'";$where = 1;}
        if(('on'==$type['office'])&&(''==$type['usd'])&&(''==$type['nooffice'])){$office = "paymentmethod = 'Office'";$where = 1;}
        if(('on'==$type['usd'])&&(''==$type['nooffice'])&&(''==$type['office'])){$office = "paymentmethod = 'Usd'";$where = 1;}
        
        if(('on'==$type['nooffice'])&&('on'==$type['office'])&&('on'==$type['usd']))
            {$office = '';}
        if((''==$type['nooffice'])&&(''==$type['office'])&&(''==$type['usd']))
            {return;}
            
        if('on'==$type['s']){$s = "s = 'n'";$where = 1;}
        if('on'==$type['nos']){$s = "s = 'y'";$where = 1;}
        if(('on'==$type['s'])&&('on'==$type['nos']))
            {$s = '';}
        if((''==$type['s'])&&(''==$type['nos']))
            {return;}
            
        if('on'==$type['unlim']){ $unlim = "unlim = 'Y'";$where = 1;}
        if('on'==$type['nounlim']){$unlim = "unlim = 'N'";$where = 1;}
        if(('on'==$type['unlim'])&&('on'==$type['nounlim']))
            {$unlim = '';}
        if((''==$type['unlim'])&&(''==$type['nounlim']))
            {return;}
            
        if('on'==$type['spd']){ $spd = "spd = 'n'";$where = 1;}
        if('on'==$type['nospd']){$spd = "spd = 'y'";$where = 1;}
        if(('on'==$type['spd'])&&('on'==$type['nospd']))
            {$spd = '';}
        if((''==$type['spd'])&&(''==$type['nospd']))
            {return;}
        
        if(''==$type['ur']){$face = "urfiz = 'Физическое'";}
        if(''==$type['fiz']){$face = "urfiz = 'Юридическое'";}
            
        if(1 == $where){$sql .= " WHERE";
            
            if(''!=$office){$sql .= " $office AND";}
            if(''!=$s){$sql .= " $s AND";}
            if(''!=$unlim){$sql .= " $unlim AND";}
            if(''!=$spd){$sql .= " $spd AND";}
            if(''!=$face){$sql .= " $face AND";}
        }
        //var_dump($face);die;
        if(1 == $where){$sql = substr_replace($sql,'',strlen($sql)-3);}
        $sql .= ' ORDER BY username ASC;';

        if('on'==$type['dopu'])
        {
            $sql = 'SELECT * FROM services ORDER BY username ASC;';
        }
        $query = DB::query(Database::SELECT, $sql);
        return $query->execute();
    }
    //выборка одного абоннента
    function get_one_users($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM users WHERE username =:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        return $query->execute();
    }
    //выборка всех удаленных абоннентов
    function get_del_users()
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_users ORDER BY username ASC;');
        return $query->execute();
    }
    function get_many($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM accounts WHERE user=:user_name ORDER BY date;');
        $query->parameters(array(':user_name'=>$user_name));
        return $query->execute();
    }
    function get_user_info($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM users WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $user = $query->execute();
        $many = $this->get_many($user_name);
//        $query = DB::query(Database::SELECT, 'SELECT * FROM accounts WHERE user=:user_name ORDER BY date;');
//        $query->parameters(array(':user_name'=>$user_name));
//        $many = $query->execute();
        //текущий месяц
        $date = Date::days(date("m,Y"));
        $day = $date[1];
        $month = date("m");
        $year = date("Y");
        $start = $year."-".$month."-".$day;
        $finish = $year."-".$month."-". count($date);
        $traffic = $this->user_traff($user_name, $start, $finish);
        
        if ("P" == $user[0]['unlim']) {$traffic = $this->totime($user_name, $start, $finish);}
        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username=:user_name;');
        $query->parameters(array(':user_name' => $user_name,));
        $services = $query->execute();
        
        $result = ['u' => $user, 'm' => $many, 't' => $traffic, 's' => $services];
        return $result;
    }
    function get_deluser_info($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_users WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $user = $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_accounts WHERE user=:user_name ORDER BY date;');
        $query->parameters(array(':user_name'=>$user_name));
        $many = $query->execute();
        //текущий месяц
//        $date = Date::days(date("m,Y"));
//        $day = $date[1];
//        $month = date("m");
//        $year = date("Y");
//        $start = $year."-".$month."-".$day;
//        $finish = $year."-".$month."-". count($date);
//        
//        $traffic = $this->user_traff($user_name, $start, $finish);
//        
//        
//        if ("P" == $user[0]['unlim']) {$traffic = $this->totime($user_name, $start, $finish);}
//        
//        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username=:user_name;');
//        $query->parameters(array(':user_name' => $user_name,));
//        $services = $query->execute();
        
        $result = ['u' => $user, 'm' => $many];
        return $result;
    }
    function check_user($user)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM users WHERE username=:user');
        $query->parameters(array(':user'=>$user));
        //$resalt = $query->execute();
        return $query->execute();
    }
    function find_user($field, $value)
    {
        switch ($field) {
            case 'nomsf':
                $sql = 'SELECT * FROM sf WHERE '.$field.' LIKE \'%'.$value.'%\'';
                $query = DB::query(Database::SELECT, $sql);
                break;
            case 'account_num':
                $sql = 'SELECT * FROM schet WHERE nomschet LIKE \'%'.$value.'%\'';
                $query = DB::query(Database::SELECT, $sql);
                break;
            case 'ip':
                $sql = 'SELECT * FROM users WHERE ip_addr LIKE \'%'.$value.'%\'';
                $query = DB::query(Database::SELECT, $sql);
                $users = $query->execute();
//                echo "<pre>",print_r($users[1]),"</pre>";die;
                if(0 == count($users)) {
                    $ip = $this->ipv4Breakout($value,'255.255.255.252');
                    $sql = 'SELECT * FROM users WHERE ip_addr LIKE \'%'.$ip.'%\'';
                    $query = DB::query(Database::SELECT, $sql);
                    $users = $query->execute();
                    if(0 == count($users)) {
                        $ip = $this->ipv4Breakout($value,'255.255.255.248');
                        $sql = 'SELECT * FROM users WHERE ip_addr LIKE \'%'.$ip.'%\'';
                        $query = DB::query(Database::SELECT, $sql);
                        $users = $query->execute();
                        if(0 == count($users)) {
                            $ip = $this->ipv4Breakout($value,'255.255.255.240');
                            $sql = 'SELECT * FROM users WHERE ip_addr LIKE \'%'.$ip.'%\'';
                            $query = DB::query(Database::SELECT, $sql);
                            $users = $query->execute();
                        }
                    }
                }
                $user[0] = $users[0];
                return $user;
                break;
            default:
                $sql = 'SELECT * FROM users WHERE '.$field.' LIKE \'%'.$value.'%\'';
                $query = DB::query(Database::SELECT, $sql);
                break;
        }
        return $query->execute();
    }

    //поиск по ip
    function ipv4Breakout ($ip_address, $ip_nmask) {
        //convert ip addresses to long form
        $ip_address_long = ip2long($ip_address);
        $ip_nmask_long = ip2long($ip_nmask);
        //caculate network address
        $ip_net = $ip_address_long & $ip_nmask_long;
        //caculate first usable address
        $ip_host_first = ((~$ip_nmask_long) & $ip_address_long);
        $ip_first = ($ip_address_long ^ $ip_host_first) + 1;
        //caculate last usable address
        $ip_broadcast_invert = ~$ip_nmask_long;
        $ip_last = ($ip_address_long | $ip_broadcast_invert) - 1;
        //caculate broadcast address
        $ip_broadcast = $ip_address_long | $ip_broadcast_invert;

        //Output
        $ip_net_short = long2ip($ip_net);
        $ip_first_short = long2ip($ip_first);
        $ip_last_short = long2ip($ip_last);
        $ip_broadcast_short = long2ip($ip_broadcast);
//            echo "Network - " . $ip_net_short . "<br>";
//////            echo "First usable - " . $ip_first_short . "<br>";
//////            echo "Last usable - " . $ip_last_short . "<br>";
//////            echo "Broadcast - " . $ip_broadcast_short . "<br>";
///
        return long2ip($ip_net);
    }




    function user_traff($user_name, $start, $finish)
    {
        $sql = 'SELECT * FROM traffic WHERE Username=:user_name AND (TDate BETWEEN :start AND :finish);';
        $query = DB::query(Database::SELECT, $sql);
//        'SELECT * FROM traffic WHERE Username=:user_name '
//                . 'AND (TDate BETWEEN \':start\' AND \':finish\');');
        $query->parameters(array(':user_name'=>$user_name,
                                 ':start' => $start,
                                 ':finish' => $finish,
                                ));
        return $query->execute();
    }
    function get_user($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM users WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        return $query->execute();
    }
    function update_user($value)
    {
        $query = DB::update('users')
            ->set(array(
                'contract' => $value['contract'],
                'cdate' => $value['cdate'],
                'username' => $value['username'],
                'language' => $value['language'], 
                'postmaster' => $value['postmaster'], 
                'address_n' => $value['address_n'],
                'address_e' => $value['address_e'], 
                'orgr' => $value['orgr'], 
                'urfiz' => $value['urfiz'], 
                'phones' => $value['phones'],
                'fax' => $value['fax'],
                'contactperson' => $value['contactperson'],
                'passport' => $value['passport'],
                'account_num' => $value['account_num'], 'bankdetails' => $value['bankdetails'],
                'inn' => $value['inn'], 'okonx' => $value['okonx'], 
                'mfo' => $value['mfo'],
                'oked' => $value['oked'],
                'rkpnds' => $value['rkpnds'],
                'swift' => $value['swift'],
                'orderid' => $value['orderid'],
                'delivmethod' => $value['delivmethod'],
                'delivaddress' => $value['delivaddress'], 'status' => $value['status'], 
                'regdate' => $value['regdate'],
                'registredby' => $value['registredby'], 'paymentmethod' => $value['paymentmethod'],
                'prepayment' => $value['prepayment'], 'lockingmode' => $value['lockingmode'],
                'lastmodified' => $value['lastmodified'], 'modifiedby' => $value['modifiedby'],
                'webdomains' => $value['webdomains'], 
                'unlim' => $value['unlim'], 
                'coment' => $value['coment'],
                'plan' => $value['plan'], 
                'prise' => $value['prise'],
                'nds' => $value['nds'],
                'stavkands' => $value['stavkands'],
                'skidka' => $value['skidka'],
                'speed' => $value['speed'], 
                'price_out' => $value['price_out'],
                'addr_podkl' => $value['addr_podkl'], 
                'ip_addr' => $value['ip_addr'],
                'spd' => $value['spd'],
                'ats' => $value['ats'],
                'port' => $value['port'],
                'oborudovanie' => $value['oborudovanie'],
                's' => $value['s'],
                'feecheck' => $value['feecheck'],
                ))
            ->where('username', '=', $value['username']);
        return $query->execute();
    }
    function new_user($value)
    {
        
        $query = DB::insert('users', array(
         //   'id',
            'contract',
            'cdate',
            'username',
            'language',
            'postmaster',
            'address_n',
            'address_e',
            'orgr',
            'urfiz',
            'phones',
            'fax',
            'contactperson',
            'passport',
            'account_num',
            'bankdetails',
            'inn',
            'okonx',
            'mfo',
            'oked',
            'rkpnds',
            'swift',
            'orderid',
            'delivmethod',
            'delivaddress',
            'status',
            'regdate',
            'registredby',
            'paymentmethod',
            'prepayment',
            'lockingmode',
            'lastmodified',
            'modifiedby',
            'webdomains',
            'unlim',
            'coment',
            'plan',
            'prise',
            'nds',
            'stavkands',
            'skidka',
            'speed',
            'price_out',
            'addr_podkl',
            'ip_addr',
            'spd',
            'ats',
            'port',
            'oborudovanie',
            's',
            'feecheck'
            ))
            ->values(array(
            //    ':id' => '',
                $value['contract'],
                $value['cdate'],
                $value['username'],
                $value['language'], 
                $value['postmaster'], 
                $value['address_n'],
                $value['address_e'], 
                $value['orgr'],
                $value['urfiz'],
                $value['phones'],
                $value['fax'], 
                $value['contactperson'],
                $value['passport'],
                $value['account_num'], 
                $value['bankdetails'],
                $value['inn'], 
                $value['okonx'], 
                $value['mfo'],
                $value['oked'],
                $value['rkpnds'],
                $value['swift'],
                $value['orderid'],
                $value['delivmethod'],
                $value['delivaddress'], 
                $value['status'], 
                $value['regdate'],
                $value['registredby'], 
                $value['paymentmethod'],
                $value['prepayment'], 
                $value['lockingmode'],
                $value['lastmodified'], 
                $value['modifiedby'],
                $value['webdomains'], 
                $value['unlim'], 
                $value['coment'],
                $value['plan'], 
                $value['prise'],
                $value['nds'],
                $value['stavkands'],
                $value['skidka'], 
                $value['speed'], 
                $value['price_out'],
                $value['addr_podkl'], 
                $value['ip_addr'],
                $value['spd'],
                $value['ats'],
                $value['port'],
                $value['oborudovanie'],
                $value['s'],
                $value['feecheck']
                ));
        return $query->execute();
    }
    function deluser($user_name)
    {
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM users WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $value = $query->execute()->as_array();
        $sql = 'INSERT INTO del_users VALUE ('
                . ':id, '
                . ':contract, '
                . ':cdate, '
                . ':username, '
                . ':language, '
                . ':postmaster, '
                . ':address_n, '
                . ':address_e, '
                . ':orgr, '
                . ':urfiz ,'
                . ':phones, '
                . ':fax, '
                . ':contactperson, '
                . ':passport, '
                . ':account_num, '
                . ':bankdetails, '
                . ':inn, '
                . ':okonx, '
                . ':mfo, '
                . ':oked, '
                . ':rkpnds, '
                . ':swift, '
                . ':orderid, '
                . ':delivmethod, '
                . ':delivaddress, '
                . ':status, '
                . ':regdate, '
                . ':registredby, '
                . ':paymentmethod, '
                . ':prepayment, '
                . ':lockingmode, '
                . ':lastmodified, '
                . ':modifiedby, '
                . ':webdomains, '
                . ':unlim, '
                . ':coment, '
                . ':plan, '
                . ':prise, '
                . ':nds, '
                . ':stavkands, '
                . ':skidka, '
                . ':speed, '
                . ':price_out, '
                . ':addr_podkl, '
                . ':ip_addr, '
                . ':spd, '
                . ':ats, '
                . ':port, '
                . ':oborudovanie, '
                . ':s, '
                . ':feecheck );';
        $query = DB::query(Database::INSERT, $sql);
        $query->parameters(array(
            ':id' => $value[0]['id'],
            ':contract' => $value[0]['contract'],
            ':cdate' => $value[0]['cdate'],
            ':username' => $value[0]['username'],
            ':language' => $value[0]['language'], 
            ':postmaster' => $value[0]['postmaster'], 
            ':address_n' => $value[0]['address_n'],
            ':address_e' => $value[0]['address_e'], 
            ':orgr' => $value[0]['orgr'],
            ':urfiz' => $value[0]['urfiz'],
            ':phones' => $value[0]['phones'],
            ':fax' => $value[0]['fax'], 
            ':contactperson' => $value[0]['contactperson'],
            ':passport' => $value[0]['passport'],
            ':account_num' => $value[0]['account_num'], 
            ':bankdetails' => $value[0]['bankdetails'],
            ':inn' => $value[0]['inn'], 
            ':okonx' => $value[0]['okonx'], 
            ':mfo' => $value[0]['mfo'],
            ':oked' => $value[0]['oked'],
            ':rkpnds' => $value[0]['rkpnds'],
            ':swift' => $value[0]['swift'],
            ':orderid' => $value[0]['orderid'],
            ':delivmethod' => $value[0]['delivmethod'],
            ':delivaddress' => $value[0]['delivaddress'], 
            ':status' => $value[0]['status'], 
            ':regdate' => $value[0]['regdate'],
            ':registredby' => $value[0]['registredby'], 
            ':paymentmethod' => $value[0]['paymentmethod'],
            ':prepayment' => $value[0]['prepayment'], 
            ':lockingmode' => $value[0]['lockingmode'],
            ':lastmodified' => $value[0]['lastmodified'], 
            ':modifiedby' => $value[0]['modifiedby'],
            ':webdomains' => $value[0]['webdomains'], 
            ':unlim' => $value[0]['unlim'], 
            ':coment' => $value[0]['coment'],
            ':plan' => $value[0]['plan'], 
            ':prise' => $value[0]['prise'],
            ':nds' => $value[0]['nds'],
            ':stavkands' => $value[0]['stavkands'],
            ':skidka' => $value[0]['skidka'], 
            ':speed' => $value[0]['speed'], 
            ':price_out' => $value[0]['price_out'],
            ':addr_podkl' => $value[0]['addr_podkl'], 
            ':ip_addr' => $value[0]['ip_addr'],
            ':ats' => $value[0]['ats'],
            ':spd' => $value[0]['spd'],
            ':port' => $value[0]['port'],
            ':oborudovanie' => $value[0]['oborudovanie'],
            ':s' => $value[0]['s'],
            ':feecheck' => $value[0]['feecheck'],
            ));
        $query->execute();
        
        $query = DB::query(Database::DELETE, 'DELETE FROM users WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM accounts WHERE user=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $result = $query->execute();
        
        foreach ($result as $value )
        {
            $query = DB::query(Database::INSERT, 'INSERT INTO del_accounts VALUE'
                    . '(:id, :user, :date, :sum, :cmt, :flag) ');
            $query->parameters(array(
                ':id' => $value['id'], 
                ':user' => $value['user'], 
                ':date' => $value['date'], 
                ':sum' => $value['sum'], 
                ':cmt' => $value['cmt'],
                ':flag' => $value['flag'],
            ));
            $result = $query->execute();
        }
        $query = DB::query(Database::DELETE, 'DELETE FROM accounts WHERE user=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM sf WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $result = $query->execute();
        
        foreach ($result as $value)
        {
            $query = DB::query(Database::INSERT, 'INSERT INTO del_sf VALUE'
                    . '(:id, :username, :date, :month, :year, :nomsf, :total, :textsf) ');
            $query->parameters(array(
                ':id'       => $value['id'], 
                ':username' => $value['username'], 
                ':date'     => $value['date'], 
                ':month'    => $value['month'], 
                ':year'     => $value['year'],
                ':nomsf'    => $value['nomsf'],
                ':total'    => $value['total'],
                ':textsf'   => $value['textsf'],
            ));
            $query->execute();
        }
        $query = DB::query(Database::DELETE, 'DELETE FROM sf WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM users_table WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $result = $query->execute();
        foreach ($result as $value )
        {
            $query = DB::query(Database::INSERT, 'INSERT INTO del_users_table VALUE'
                    . '(:id, :username, :date, :table) ');
            $query->parameters(array(
                ':id'       => $value['id'], 
                ':username' => $value['username'], 
                ':date'     => $value['date'], 
                ':table'    => $value['table'], 
            ));
            $query->execute();
        }
        $query = DB::query(Database::DELETE, 'DELETE FROM users_table WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
    }
    function getbackdeluser($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_users WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $value = $query->execute()->as_array();
        $sql = 'INSERT INTO users VALUE ('
                . ':id, '
                . ':contract, '
                . ':cdate, '
                . ':username, '
                . ':language, '
                . ':postmaster, '
                . ':address_n, '
                . ':address_e, '
                . ':orgr, '
                . ':urfiz ,'
                . ':phones, '
                . ':fax, '
                . ':contactperson, '
                . ':passport, '
                . ':account_num, '
                . ':bankdetails, '
                . ':inn, '
                . ':okonx, '
                . ':mfo, '
                . ':oked, '
                . ':rkpnds, '
                . ':swift, '
                . ':orderid, '
                . ':delivmethod, '
                . ':delivaddress, '
                . ':status, '
                . ':regdate, '
                . ':registredby, '
                . ':paymentmethod, '
                . ':prepayment, '
                . ':lockingmode, '
                . ':lastmodified, '
                . ':modifiedby, '
                . ':webdomains, '
                . ':unlim, '
                . ':coment, '
                . ':plan, '
                . ':prise, '
                . ':nds, '
                . ':stavkands, '
                . ':skidka, '
                . ':speed, '
                . ':price_out, '
                . ':addr_podkl, '
                . ':ip_addr, '
                . ':spd, '
                . ':ats, '
                . ':port, '
                . ':oborudovanie, '
                . ':s, '
                . ':feecheck );';
        $query = DB::query(Database::INSERT, $sql);
        $query->parameters(array(
            ':id' => $value[0]['id'],
            ':contract' => $value[0]['contract'],
            ':cdate' => $value[0]['cdate'],
            ':username' => $value[0]['username'],
            ':language' => $value[0]['language'], 
            ':postmaster' => $value[0]['postmaster'], 
            ':address_n' => $value[0]['address_n'],
            ':address_e' => $value[0]['address_e'], 
            ':orgr' => $value[0]['orgr'],
            ':urfiz' => $value[0]['urfiz'],
            ':phones' => $value[0]['phones'],
            ':fax' => $value[0]['fax'], 
            ':contactperson' => $value[0]['contactperson'],
            ':passport' => $value[0]['passport'],
            ':account_num' => $value[0]['account_num'], 
            ':bankdetails' => $value[0]['bankdetails'],
            ':inn' => $value[0]['inn'], 
            ':okonx' => $value[0]['okonx'], 
            ':mfo' => $value[0]['mfo'],
            ':oked' => $value[0]['oked'],
            ':rkpnds' => $value[0]['rkpnds'],
            ':swift' => $value[0]['swift'],
            ':orderid' => $value[0]['orderid'],
            ':delivmethod' => $value[0]['delivmethod'],
            ':delivaddress' => $value[0]['delivaddress'], 
            ':status' => $value[0]['status'], 
            ':regdate' => $value[0]['regdate'],
            ':registredby' => $value[0]['registredby'], 
            ':paymentmethod' => $value[0]['paymentmethod'],
            ':prepayment' => $value[0]['prepayment'], 
            ':lockingmode' => $value[0]['lockingmode'],
            ':lastmodified' => $value[0]['lastmodified'], 
            ':modifiedby' => $value[0]['modifiedby'],
            ':webdomains' => $value[0]['webdomains'], 
            ':unlim' => $value[0]['unlim'], 
            ':coment' => $value[0]['coment'],
            ':plan' => $value[0]['plan'], 
            ':prise' => $value[0]['prise'],
            ':nds' => $value[0]['nds'],
            ':stavkands' => $value[0]['stavkands'],
            ':skidka' => $value[0]['skidka'], 
            ':speed' => $value[0]['speed'], 
            ':price_out' => $value[0]['price_out'],
            ':addr_podkl' => $value[0]['addr_podkl'], 
            ':ip_addr' => $value[0]['ip_addr'],
            ':spd' => $value[0]['spd'],
            ':ats' => $value[0]['ats'],
            ':port' => $value[0]['port'],
            ':oborudovanie' => $value[0]['oborudovanie'],
            ':s' => $value[0]['s'],
            ':feecheck' => $value[0]['feecheck'],
            ));
        $query->execute();
        
        $query = DB::query(Database::DELETE, 'DELETE FROM del_users WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_accounts WHERE user=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $result = $query->execute();
        
        foreach ($result as $value )
        {
            $query = DB::query(Database::INSERT, 'INSERT INTO accounts VALUE'
                    . '(:id, :user, :date, :sum, :cmt, :flag) ');
            $query->parameters(array(
                ':id' => $value['id'], 
                ':user' => $value['user'], 
                ':date' => $value['date'], 
                ':sum' => $value['sum'], 
                ':cmt' => $value['cmt'],
                ':flag' => $value['flag'],
            ));
            $result = $query->execute();
        }
        $query = DB::query(Database::DELETE, 'DELETE FROM del_accounts WHERE user=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_sf WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $result = $query->execute();
        
        foreach ($result as $value )
        {
            $query = DB::query(Database::INSERT, 'INSERT INTO sf VALUE'
                    . '(:id, :username, :date, :month, :year, :nomsf, :total, :textsf) ');
            $query->parameters(array(
                ':id'       => $value['id'], 
                ':username' => $value['username'], 
                ':date'     => $value['date'], 
                ':month'    => $value['month'],
                ':year'     => $value['year'],
                ':nomsf'    => $value['nomsf'],
                ':total'    => $value['total'],
                ':textsf'   => $value['textsf'],
            ));
            $query->execute();
        }
        $query = DB::query(Database::DELETE, 'DELETE FROM del_sf WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
        
        $query = DB::query(Database::SELECT, 'SELECT * FROM del_users_table WHERE username=:user_name;');
        $query->parameters(array(':user_name'=>$user_name));
        $result = $query->execute();
        foreach ($result as $value )
        {
            $query = DB::query(Database::INSERT, 'INSERT INTO users_table VALUE'
                    . '(:id, :username, :date, :table) ');
            $query->parameters(array(
                ':id'       => $value['id'], 
                ':username' => $value['username'], 
                ':date'     => $value['date'], 
                ':table'    => $value['table'], 
            ));
            $query->execute();
        }
        $query = DB::query(Database::DELETE, 'DELETE FROM del_users_table WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
    }
    
    function delusernahren($user_name)
    {

        $query = DB::query(Database::DELETE, 'DELETE FROM del_users WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();

        $query = DB::query(Database::DELETE, 'DELETE FROM del_accounts WHERE user=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();

        $query = DB::query(Database::DELETE, 'DELETE FROM del_sf WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();

        $query = DB::query(Database::DELETE, 'DELETE FROM del_users_table WHERE username=:username;');
        $query->parameters(array(':username'=>$user_name));
        $query->execute();
    }
    
    function insert_one_services($username,$service, $price, $count, $unit, $data)
    {
        if("" == $service){return;}
        if(10 > $data){$data = '0'.$data;}
        $query = DB::query(Database::INSERT, 'INSERT INTO one_time VALUE ('
                . ':id, :username, :servis, :price, :count, :unit, :date, :flag);');
        $query->parameters(array(
            ':id' => '',
            ':username' => $username,
            ':servis' => $service,
            ':price' => $price,
            ':count' => $count,
            ':unit' => $unit,
            ':date' => $data,
            ':flag' => '0',
        ));
        return $query->execute();
    }
    function select_user_one_services($id)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM one_time WHERE id = :id;');
        $query->parameters(array(
            ':id' => $id,
        ));
        return $query->execute();
    }
    function select_one_services($user_name)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM one_time '
                . 'WHERE username = :username AND flag = :flag;');
        $query->parameters(array(
            ':username' => $user_name,
            ':flag' => '0',
        ));
        return $query->execute();
    }
    function delete_one_services($id)
    {
        if(0 == count($id)){return;}
        foreach ($id as $value) {
            $query = DB::query(Database::DELETE, 'DELETE FROM one_time WHERE id=:id;');
            $query->parameters(array(':id'=>$value));
            $query->execute();
        }
        return;
        
//        $query = DB::query(Database::DELETE, 'DELETE FROM one_time WHERE id=:id;');
//        $query->parameters(array(':id' => $id,));
//        return $query->execute();
    }
    function insert_services($service, $price)
    {
        $query = DB::query(Database::INSERT, 'INSERT INTO services_sp VALUE ('
                . ':id, :service, :price);');
        $query->parameters(array(
            ':id' => '',
            ':service' => $service,
            ':price' => $price,
        ));
        return $query->execute();
    }
    function get_services()
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM services_sp;');
        return $query->execute();
    }
    function enter_services($id, $username)
    {
        if("" == $id){return;}
        $query = DB::query(Database::SELECT, 'SELECT * FROM services_sp WHERE id=:id;');
        $query->parameters(array(':id'=>$id));
        $result = $query->execute();
        
        $query = DB::query(Database::INSERT, 'INSERT INTO services VALUE ('
                . ':id, :username, :date, :service, :amount, :unit, :price);');
        $query->parameters(array(
            ':id' => '',
            ':username' => $username,
            ':date' => '',
            ':service' => $result[0]['service'],
            ':amount' => '',
            ':unit' => '',
            ':price' => $result[0]['price'],
        ));
        return $query->execute();
    }
    function del_service($id)
    {
            $query = DB::query(Database::DELETE, 'DELETE FROM services_sp WHERE id=:id;');
            $query->parameters(array(':id' => $id));
            return $query->execute();
    }
    function del_user_service($id)
    {
        if(0 == count($id)){return;}
        foreach ($id as $value) {
            $query = DB::query(Database::DELETE, 'DELETE FROM services WHERE id=:id;');
            $query->parameters(array(':id'=>$value));
            $query->execute();
        }
        return;
    }
    function get_user_services($username)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username = :username;');
        $query->parameters(array(':username' => $username,));
        return $query->execute();
    }
    // Dialup
    function totime($user_name,$start, $finish)
    {
        $finish .= " 23:59:59";
        
        $sql = "SELECT * FROM calls WHERE user_name=:user_name "
                . "AND event_date_time BETWEEN str_to_date(:start,'%Y-%m-%d')"
                . " AND str_to_date(:finish ,'%Y-%m-%d %H:%i:%s');";
        $query = DB::query(Database::SELECT, $sql);
        $query->parameters(array(':user_name'=>$user_name,
                                ':start' => $start,
                                ':finish' => $finish,
                                ));
        $time = $query->execute();
        //32400 время до 9 утра
        //86400 сутки
        $tam = 0;
        $tpm = 0;
        $am = 0;
        $tr_in = 0;
        $tr_out = 0;
        foreach ($time as $key)
        {
            $d = explode(":",date("G:i:s", strtotime($key['event_date_time'])));
            $am = $d[0]*3600 + $d[1]*60 + $d[2];
            $tr_in += $key['acct_input_octets'];
            $tr_out += $key['acct_output_octets'];
            if (32400 > $am) 
                {
                    if ($am + (int) $key["acct_session_time"] < 32400)
                    {
                        $tam += (int) $key["acct_session_time"];
                    }
                    else 
                    {
                        $tam += 32400 - $am;
                        $tpm += (int) $key["acct_session_time"] - $tam;
                    }
                }
            if (32400 < $am) 
                {
                    if ($am + (int) $key["acct_session_time"] < 86400)
                    {
                        $tpm += (int) $key["acct_session_time"];
                    }
                    else 
                    {
                        $tpm += 86400 - $am;
                        $tam += (int) $key["acct_session_time"] - $tpm;
                    }
                }
        }
        $result[0]['hours'] = $tam / 3600;
        $result[0]['coment'] = "Доступ к сети Интернет в ночное время (с 00:00 до 9:00)";
        $result[0]['ed'] = 'час';
        $result[0]['price'] = 100;
        $result[0]['tr_in'] = '';
        $result[0]['tr_out'] = '';
        
        $result[1]['hours'] = $tpm / 3600;
        $result[1]['coment'] = "Доступ к сети Интернет в дневное время (с 9:00 до 00:00)";
        $result[1]['ed'] = 'час';
        $result[1]['price'] = 500;
        $result[1]['tr_in'] = '';
        $result[1]['tr_out'] = '';
        
        $result[3]['hours'] = '';
        $result[3]['coment'] = 'Входящий трафик';
        $result[3]['ed'] = 'Kb';
        $result[3]['price'] = '';
        $result[3]['tr_in'] = $tr_in;
        $result[3]['tr_out'] = '';
        
        $result[4]['hours'] = '';
        $result[4]['price'] = '';
        $result[4]['coment'] = 'Исходящий трафик';
        $result[4]['ed'] = 'Kb';
        $result[4]['tr_in'] = '';
        $result[4]['tr_out'] = $tr_out;
        
    return $result;
    }
    
    function checkusername($username)
    {
        $result = $this->get_one_users($username);
        //проверка среди удаленных
        if(isset($result[0]['username'])) {return 1;}
        $user = $this->get_del_users();
        foreach ($user as $key => $value)
        {
            $users[] = $value['username'];
        }
        if(in_array($username,$users))   {return 1;}
        return 0;
    }
    function manydate()
    {
        $month = date("m")-1;
        $year = date("Y");
        if(0 == $month){$month =12;$year -=1;}
        if(10>$month){$month ="0".$month;}
        $date = Date::days($month, $year);
        $start = $year.$month."01";
        $finish = $year.$month.count($date);
        //echo $start," ",$finish;die;
        $query = DB::select()
                ->from('accounts')
                ->where('date', 'BETWEEN', array($start,$finish))
                ->and_where('sum', '>', 0)
                ->order_by('date');
        return $query->execute();
    }
    function clear_database()
    {
//                $users = DB::select('user')
//                ->from('accounts')
//                ->execute()->as_array();
//        foreach ($users as $key => $value) 
//        {
//            echo $value['user'];
//        }

//        
//        $users = DB::select('username')
//                ->from('users')
//                ->execute()->as_array();
//        foreach ($users as $key => $value) 
//        {
//            $query = DB::delete('accounts_new')
//                    ->where('user', '=', $value['username'])
//                    ->execute();
//        }
        $users = DB::select('user')
                ->from('accounts_new')
                ->execute()->as_array();
        foreach ($users as $key => $value) 
        {
//            echo $value['user'];
            $query = DB::delete('accounts')
                    ->where('user', '=', $value['user'])
                    ->execute();
        }
    }
    //Вывод на предоплату
    function prepade($type)
    {
        $end_users = [];$i=0;
        $date = date("m");
        $all_users = DB::select()->from('users')
                ->where('s', '=', 'n')
                ->and_where('prise', '>', 0)
                ->and_where('paymentmethod', '=', $type)
                ->order_by('username', 'ASC')
                ->execute();
        
        foreach ($all_users as $key => $value) {
            $many = DB::select()->from('accounts')->where('user', '=', $value['username'])->execute();
            $sum = 0;
            $prise_one = 0;
            $prise = $value['prise']*$value['skidka'];
            foreach ($many as $key1 => $value1) {
                $sum += $value1['sum'];
            }
            
            $dop = DB::select()->from('services')->where('username', '=', $value['username'])->execute();
            foreach ($dop as $key2 => $value2) {
                $prise += $value2['price'];
            }
                
            $one = DB::select()->from('one_time')
                    ->where('username', '=', $value['username'])
                    ->and_where('date', '=', $date)
                    ->and_where('flag', '=', 0)
                    ->execute();
            foreach ($one as $key3 => $value3) {
                $prise_one += $value3['price']*$value3['count'];
            }
            
//            if('alba' == $value['username']){
//                    echo "<pre>";
//                    echo $sum;
//                    echo "<br>",$prise;
//                    echo "<br>",$prise_one;
//                    print_r($value);
//                    echo "</pre>";
//                    die;
//                }
            if ($sum - $prise - $prise_one <= 0) {
                $end_users[$i]['username'] = $value['username'];
                $end_users[$i]['prise'] = $prise;
                $end_users[$i]['prise_one'] = $prise_one;
                $end_users[$i]['sum'] = $sum;
                $i++;
                
                    
            }
            
        }
        //var_dump($end_users);die;
        return $end_users;
    }
}