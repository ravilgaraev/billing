<?php defined('SYSPATH') or die('No direct script access.');

class Model_Story extends Model{
    //сохраниние истории ip адресов
    function save_story($user,$ip,$cdate)
    {
            $d = explode('-', $cdate);
            $cdate = $d[2].'-'.$d[1].'-'.$d[0];
        
        $query = DB::insert('reg_story',array
                ('ip',
                'username',
                'cdate',
                'ddate',
                'contract',
                'passport',
                'address',
                'addr_podkl',
                'orgr',
                'phone',
                'fax',
                'contactperson',
                'account_num',
                'bankdetails',
                'inn',
                'mfo',
                'oked',
                'rkpnds'))
                ->values(array(
                    $ip,
                    $user[0]['username'],
                    $cdate,
                    '0000-00-00',
                    $user[0]['contract'],
                    $user[0]['passport'],
                    $user[0]['address_n'],
                    $user[0]['addr_podkl'],
                    $user[0]['orgr'],
                    $user[0]['phones'],
                    $user[0]['fax'],
                    $user[0]['contactperson'],
                    $user[0]['account_num'],
                    $user[0]['bankdetails'],
                    $user[0]['inn'],
                    $user[0]['mfo'],
                    $user[0]['oked'],
                    $user[0]['rkpnds'],
                ))->execute();
        return ;
    }
    //сохраниние истории ip адресов вариант 2
    function save_story2($user,$ip,$ddate)
    {
        if('' != $ddate) {
            $d = explode('-', $ddate);
            $ddate = $d[2].'-'.$d[1].'-'.$d[0];
        }
        
        $query = DB::insert('reg_story',array
                ('ip',
                'username',
                'cdate',
                'ddate',
                'contract',
                'passport',
                'address',
                'addr_podkl',
                'orgr',
                'phone',
                'fax',
                'contactperson',
                'account_num',
                'bankdetails',
                'inn',
                'mfo',
                'oked',
                'rkpnds'))
                ->values(array(
                    $ip,
                    $user['username'],
                    $user['cdate'],
                    $ddate,
                    $user['contract'],
                    $user['passport'],
                    $user['address_n'],
                    $user['addr_podkl'],
                    $user['orgr'],
                    $user['phones'],
                    $user['fax'],
                    $user['contactperson'],
                    $user['account_num'],
                    $user['bankdetails'],
                    $user['inn'],
                    $user['mfo'],
                    $user['oked'],
                    $user['rkpnds'],
                ))->execute();
        return ;
    }
    //получение истории пользователя
    function get_story($user_name)
    {
        $query = DB::select()
                ->from('reg_story')
                ->where('username', '=', $user_name)
                ->execute();
        return $query;
    }
    //Закрытие адреса
    function close_story($id,$ddate)
    {
        $d = explode('-', $ddate);
        $ddate = $d[2].'-'.$d[1].'-'.$d[0];
        
        $query = DB::update('reg_story')
                ->set(array('ddate' => $ddate))
                ->where('id', '=', $id)
                ->execute();
        return $query;
    }
}