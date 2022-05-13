<?php defined('SYSPATH') or die('No direct script access.');

class Model_Mail extends Model{
    
    function get_all_users()
    {
        //$query = DB::query(Database::SELECT, 'SELECT username FROM users WHERE s=:s ORDER BY username ASC;');
        $query = DB::query(Database::SELECT, 'SELECT username FROM users ORDER BY username ASC;');
        $query->parameters(array(':s'=>'n'));
        return $query->execute();
    }
    function get_all_info($username)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM account WHERE Username=:user ;');
        $query->parameters(array(':user'=>$username));
        return $query->execute();
    }
    function get_virtual_mail($email)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM virtual WHERE EmailAddress=:email ;');
        $query->parameters(array(':email'=>$email));
        return $query->execute();
    }
    function get_edit_info($id)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM account WHERE AccountID=:id ;');
        $query->parameters(array(':id'=>$id));
        return $query->execute();
    }
    function save_edit_data($value)
    {
        $sql = 'UPDATE account SET  '
            .'Password = :Password, '
            .'Quota = :Quota, '
            .'ForwardAddress = :ForwardAddress, '
            .'Active = :Active '
            .'WHERE AccountID = :AccountID;';
        $query = DB::query(Database::UPDATE, $sql);
        $query->parameters(array(
            ':Password' => $value['Password'],
            ':Quota' => $value['Quota'],
            ':ForwardAddress' => $value['ForwardAddress'],
            ':Active' => $value['Active'],
            ':AccountID' => $value['AccountID'],
        ));
        return $query->execute();
    }
    function editvirtualmail($virtualid)
    {
        $query = DB::query(Database::SELECT, 'SELECT * FROM virtual WHERE VirtualID=:VirtualID ;');
        $query->parameters(array(':VirtualID'=>$virtualid));
        return $query->execute();
    }
    
    function save_edit_virtual_data($value)
    {
        $sql = 'UPDATE virtual SET  '
            .'VirtualAddress = :VirtualAddress '
            .'WHERE VirtualID = :VirtualID;';
        $query = DB::query(Database::UPDATE, $sql);
        $query->parameters(array(
            ':VirtualAddress' => $value['VirtualAddress'],
            ':VirtualID' => $value['VirtualID'],
        ));
        return $query->execute();
    }
    function del_mailbox($AccountID)
    {
        $user = $this->get_edit_info($AccountID);
        $query = DB::query(Database::DELETE, 'DELETE FROM account WHERE AccountID=:AccountID;');
        $query->parameters(array(':AccountID'=>$AccountID));
        $query->execute();
        
        $query = DB::query(Database::DELETE, 'DELETE FROM virtual WHERE EmailAddress=:EmailAddress;');
        $query->parameters(array(':EmailAddress'=>$user[0]['EmailAddress'],));
        $query->execute();
        return $user;
        
    }
    function del_virtual_mailbox($VirtualID)
    {
        $query = DB::query(Database::DELETE, 'DELETE FROM virtual WHERE VirtualID=:VirtualID;');
        $query->parameters(array(':VirtualID'=>$VirtualID,));
        return $query->execute();
    }
    function addmailbox($value)
    {
        $sql = 'INSERT INTO account VALUE ( '
                .':AccountID, '
                .':Username, '
                .':Mailbox, '
                .':Password, '
                .':EmailAddress, '
                .':ischarged, '
                .':Quota, '
                .':ForwardAddress, '
                .':MailDirLocation, '
                .':Active );';
        $query = DB::query(Database::UPDATE, $sql);
        $query->parameters(array(
            ':AccountID' => '',
            ':Username' => $value['Username'],
            ':Mailbox' =>  $value['Mailbox'],
            ':Password' => $value['Password'],
            ':EmailAddress' => $value['Mailbox'].'@bcc.com.uz',
            ':ischarged' => 'No',
            ':Quota' => $value['Quota'],
            ':ForwardAddress' => '',
            ':MailDirLocation' => 'bcc.com.uz/'.$value['Mailbox'].'/',
            ':Active' => 1,
        ));
        return $query->execute();
    }
    function addvirtmailbox($value)
    {
        $sql = 'INSERT INTO virtual VALUE ( '
                .':VirtualID, '
                .':Username, '
                .':VirtualAddress, '
                .':EmailAddress, '
                .':Active );';
        $query = DB::query(Database::UPDATE, $sql);
        $query->parameters(array(
            ':VirtualID' => '',
            ':Username' => $value['Username'],
            ':VirtualAddress' => $value['VirtualAddress'],
            ':EmailAddress' => $value['EmailAddress'],
            ':Active' => 1,
        ));
        return $query->execute();
    }
}