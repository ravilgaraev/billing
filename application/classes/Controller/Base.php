<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Base extends Controller_Template {
    
    public $user_role;
    //Пишет логи
    function savelog($message,$username)//Пишет логи
    {
        $dts = date("l d-m-Y H:i:s");
        $local_user = Cookie::get('user');
        $user_role = Cookie::get('role');
        $fts = "/var/www/billing/billing/log/".$local_user.".log";
        $mes = $dts." ".$local_user.$message.$username."\r\n";
        file_put_contents($fts, $mes, FILE_APPEND);
    }
    function fnu()//выдает имя файла лога
    {
        return "/var/www/billing/billing/log/".Cookie::get('user').".log";
    }
}