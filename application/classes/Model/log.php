<?php defined('SYSPATH') or die('No direct script access.');

class Model_Log extends Model{
    
    function savelog($message,$username)//Пишет логи
    {
        $dts = date("l d-m-Y H:i:s");
        $local_user = Cookie::get('user');
        $user_role = Cookie::get('role');
        $fts = "/var/www/billing/billing/log/".$local_user.".log";
        $mes = $dts." ".$local_user.$message.$username."\r\n";
        file_put_contents($fts, $mes, FILE_APPEND);
    }
    function scan_dir()
    {
        $dir = scandir("/var/www/billing/billing/log/");
        return $dir;
    }
    function log_pr($pr)
    {
        $data = file('/var/www/billing/billing/log/'.$pr);
        return $data;
    }
    function log_user($user_name)
    {
        $dir = scandir("/var/www/billing/billing/log/");
        foreach ($dir as $value) 
        {
            $data = file('/var/www/billing/billing/log/'.$value);
            foreach ($data as $str){
                if(stristr($str, $user_name) !== FALSE) 
                {
                    //$user_data[] = $str;
                    $mas = explode(" ", $str);
                    
                    $dd = explode("-", $mas[1]);
                               
                    
                    
                    $mas[1] = $dd[2].$dd[1].$dd[0];
                     
                    $sort_data[] = $mas[1];
                    $user_data[] = $mas;
                    
                }
            }
          
        }
        

            //array_multisort($user_data, SORT_DESC,SORT_NUMERIC);
        
            arsort($sort_data);
            foreach ($sort_data as $key => $val) {
                $end_data[] = $user_data[$key] ;
            }
            
//            echo "<pre>";
//            print_r($end_data);
//            echo "</pre>";
//            die;
        return $end_data;
    }
}