<?php defined('SYSPATH') or die('No direct script access.');

class Model_Authuser extends Model{
    
    function auth($user,$passwd)
    {
        $query = DB::query(Database::SELECT,'SELECT * FROM user WHERE '
                . 'user=:user AND passwd=:passwd;');
        $query->parameters(array(
            ':user'=>$user,
            ':passwd'=>sha1($passwd),
            ));
        return $query->execute();
    }
    function new_user($user,$passwd,$role)
    {
        $query = DB::query(Database::SELECT, "SELECT * FROM user WHERE user=:user;");
        $query->parameters(array(':user' => $user,));
        $result = $query->execute();
        if (isset($result[0]["user"])) {return 1;};
        $query = DB::query(Database::INSERT,'INSERT INTO `user` '
                . '(`user`, `passwd`, `role`)'
                . 'VALUES( :user, :passwd, :role);');
        $query->parameters(array(
            ':user'=>$user,
            ':passwd'=> sha1($passwd),
            ':role'=>$role,
            ));
        return $query->execute();
    }
}