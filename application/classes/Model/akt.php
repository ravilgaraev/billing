<?php defined('SYSPATH') or die('No direct script access.');

class Model_Akt extends Model{
    
    function get_atk_sv($user_name,$from,$to)
    {
        
                
        $akt = DB::select()->from('accounts')
                ->where('user', '=', $user_name)
                ->where('date', 'BETWEEN', array($from,$to))
                ->order_by('date')
                ->execute();
        return $akt;
    }
    function get_saldo($user_name,$from)
    {
        
//        $user = Model::factory('users')->get_one_users($user_name);
//        $date = explode("-", $user[0]['cdate']);
//        print_r($date);die;
        $saldo = DB::select()->from('accounts')
                ->where('user', '=', $user_name)
                ->where('date', 'BETWEEN', array('00000000',$from))
                ->order_by('date')
                ->execute();
        $many = 0;
        foreach ($saldo as $value) {
            $many += $value['sum'];
        }
        return $many;
    }
    
}