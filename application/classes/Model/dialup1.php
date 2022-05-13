<?php defined('SYSPATH') or die('No direct script access.');

class Model_Dialup extends Model{
    
    function totime($user_name,$start, $finish)
    {
//        $start = "2017-01-01";
//        $finish = "2017-01-31 23:59:59";
        
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
        $t = 0;
        $am = 0;
        foreach ($time as $key)
        {
            $d = explode(":",date("G:i:s", strtotime($key['event_date_time'])));
            
            echo  $key['event_date_time']," ",(int) $key["acct_session_time"],"<br>";
            $am = $d[0]*3600 + $d[1]*60 + $d[2];
            if (32400 < $am) {$t += (int) $key["acct_session_time"];}
        }
    $result['hours'] = $t / 3600;
    return $result;
    }
}