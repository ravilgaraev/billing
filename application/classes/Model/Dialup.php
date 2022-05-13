<?php defined('SYSPATH') or die('No direct script access.');

class Model_Dialup extends Model{
    
    function totime($user_name)
    {
        $sql = 'SELECT * FROM calls WHERE Username=:user_name;';
        $query = DB::query(Database::SELECT, $sql);
        $query->parameters(array(':user_name'=>$user_name,
                                ));
        return $query->execute();
    }
}