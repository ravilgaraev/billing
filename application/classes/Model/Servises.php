<?php defined('SYSPATH') or die('No direct script access.');

class Model_Users extends Model{
    
function insert_one_services($username,$service, $price,$data)
    {
        $query = DB::query(Database::INSERT, 'INSERT INTO one_time VALUE ('
                . ':id, :username, :servis, :price, :date, :flag);');
        $query->parameters(array(
            ':id' => '',
            ':username' => $username,
            ':servis' => $service,
            ':price' => $price,
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
    function select_one_services()
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM one_time WHERE flag = :flag;');
        $query->parameters(array(
            ':flag' => '0',
        ));
        return $query->execute();
    }
    function delete_one_services($id)
    {
        $query = DB::query(Database::DELETE, 'DELETE FROM one_time WHERE id=:id;');
        $query->parameters(array(':id' => $id,));
        return $query->execute();
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
        $query = DB::query(Database::SELECT, 'SELECT * FROM services_sp WHERE id=:id;');
        $query->parameters(array(':id'=>$id));
        $result = $query->execute();
        
        $query = DB::query(Database::INSERT, 'INSERT INTO services VALUE ('
                . ':id, :username, :service, :price);');
        $query->parameters(array(
            ':id' => '',
            ':username' => $username,
            ':service' => $result[0]['service'],
            ':price' => $result[0]['price'],
        ));
        return $query->execute();
    }
    function del_service($id)
    {
        $query = DB::query(Database::DELETE, 'DELETE FROM services_sp WHERE id=:id;');
        $query->parameters(array(':id'=>$id));
        return $query->execute();
    }
    function del_user_service($id)
    {
        $query = DB::query(Database::DELETE, 'DELETE FROM services WHERE id=:id;');
        $query->parameters(array(':id'=>$id));
        return $query->execute();
    }
    function get_user_services($username)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM services WHERE username = :username;');
        $query->parameters(array(':username' => $username,));
        return $query->execute();
    }
}