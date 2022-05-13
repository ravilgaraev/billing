<?php defined('SYSPATH') or die('No direct script access.');

class Model_Statserv extends Model{
    
    function get_password($user)
    {
        $query = DB::query(Database::SELECT,'SELECT * FROM statserv WHERE '
                . 'username=:user');
        $query->parameters(array(
            ':user'=>$user,
            ));
        return $query->execute();
    }
    function new_password($user,$passwd)
    {
        $check = $this->get_password($user);
        //echo $check[0]['username'];die;
        if(isset($check[0]['username'])) {
            $query = DB::query(Database::UPDATE, "UPDATE statserv SET "
                . "password=:password, password_text=:passtext "
                . "WHERE username=:user;");
            $query->parameters(array(
                ':user' => $user,
                ':password' => sha1($passwd),
                ':passtext' => $passwd
                ));
        }
        else 
        {
            //echo $user,$passwd;die;
            $query = DB::query(Database::INSERT, "INSERT INTO statserv VALUE "
                . "(:id, :user, :password, :passtext);");
            $query->parameters(array(
                ':id' => '',
                ':user' => $user,
                ':password' => sha1($passwd),
                ':passtext' => $passwd
                ));
        }
        return $query->execute();
    }
}