<?php defined('SYSPATH') or die('No direct script access.');

class Model_Readfile extends Model {
    
    public function readuserfile($getfilename)
    {
        return $user_cf = file($getfilename);
    }
    
    public function get_all()
    {
        $sql = 'SELECT * FROM users;';
        $s = DB::query(Database::SELECT, $sql)->execute();
        var_dump($s);
        foreach ($s as $key => $value){
            echo $s,$key,"это ",$value,"<br>";
        }
    }
    
    public function convert()
    {
        $put = 'E:\\stat\\userbase\\';
        $scan_dir = scandir($put);
        $i = 0;
        foreach ($scan_dir as $dir_name){
            if ($dir_name == '.' || $dir_name == '..') {continue;}
        if (is_file($put.$dir_name)) {continue;}
            
            $f = file($put.$dir_name.'\\user.cf');
            
            $data[$i]["contract"] = '';
            $data[$i]["cdate"] = ''; 
            $data[$i]["username"] = ''; 
            $data[$i]["language"] = '';
            $data[$i]["postmaster"] = '';
            $data[$i]["address/n"] = '';
            $data[$i]["address/e"] = '';
            $data[$i]["orgr"] = '';
            $data[$i]["phones"] = '';
            $data[$i]["fax"] = '';
            $data[$i]["contactperson"] = '';
            $data[$i]["account_num"] = '';
            $data[$i]["bankdetails"] = '';
            $data[$i]["inn"] = '';
            $data[$i]["okonx"] = '';
            $data[$i]["mfo"] = '';
            $data[$i]["delivmethod"] = '';
            $data[$i]["delivaddress"] = '';
            $data[$i]["regdate"] = '';
            $data[$i]["registredby"] = '';
            $data[$i]["paymentmethod"] = '';
            $data[$i]["prepayment"] = '';
            $data[$i]["lockingmode"] = '';
            $data[$i]["lastmodified"] = '';
            $data[$i]["modifiedby"] = '';
            $data[$i]["webdomains"] = '';
            
            foreach ($f as $content){
                $pos = strpos($content,"\t");
                $s = substr($content, 0, $pos);
                
                switch ($s) {
                    case "contract" : $data[$i]["contract"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1)); break;
                    case "cdate" : $data[$i]["cdate"] = substr($content, $pos +1, -1);break; 
                    case "username" : $data[$i]["username"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break; 
                    case "language" : $data[$i]["language"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "postmaster" : $data[$i]["postmaster"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "address/n" : $data[$i]["address/n"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "address/e" : $data[$i]["address/e"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "orgr" : $data[$i]["orgr"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "phones" : $data[$i]["phones"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "fax" : $data[$i]["fax"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "contactperson" : $data[$i]["contactperson"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "account_num" : $data[$i]["account_num"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "bankdetails" : $data[$i]["bankdetails"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "inn" : $data[$i]["inn"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "okonx" : $data[$i]["okonx"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "mfo" : $data[$i]["mfo"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "delivmethod" : $data[$i]["delivmethod"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "delivaddress" : $data[$i]["delivaddress"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "regdate" : $data[$i]["regdate"] = substr($content, $pos +1, -1);break;
                    case "registredby" : $data[$i]["registredby"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "paymentmethod" : $data[$i]["paymentmethod"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "prepayment" : $data[$i]["prepayment"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "lockingmode" : $data[$i]["lockingmode"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "lastmodified" : $data[$i]["lastmodified"] = substr($content, $pos +1, -1);break;
                    case "modifiedby" : $data[$i]["modifiedby"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                    case "webdomains" : $data[$i]["webdomains"] = iconv('KOI8-R','UTF-8',substr($content, $pos +1, -1));break;
                }
                $data[$i]["status"] = 'Enable';
                
                print_r($data[$i]);die;

            }
            /*
            $query = DB::query(Database::INSERT, 'INSERT INTO users VALUES ('
                    . ':id, :contract, :cdate, :username, :language, :postmaster, :address_n, :address_e,'
                    . ':orgr, :phones, :fax, :contactperson, :account_num, :bankdetails, '
                    . ':inn, :okonx, :mfo, :delivmethod, :delivaddress, :status, '
                    . ':regdate, :registredby, :paymentmethod, :prepayment, '
                    . ':lockingmode, :lastmodified, :modifiedby, :webdomains);');
            $query->parameters(array(
                ':id' => '',
                 ':contract' => $data[$i]['contract'],
                 ':cdate' => $data[$i]['cdate'], 
                 ':username' => $data[$i]['username'], 
                 ':language' => $data[$i]['language'],
                 ':postmaster' => $data[$i]['postmaster'],
                 ':address_n' => $data[$i]['address/n'],
                 ':address_e' => $data[$i]['address/e'],
                 ':orgr' => $data[$i]['orgr'],
                 ':phones' => $data[$i]['phones'],
                 ':fax' => $data[$i]['fax'],
                 ':contactperson' => $data[$i]['contactperson'],
                 ':account_num' => $data[$i]['account_num'],
                 ':bankdetails' => $data[$i]['bankdetails'],
                 ':inn' => $data[$i]['inn'],
                 ':okonx' => $data[$i]['okonx'],
                 ':mfo' => $data[$i]['mfo'],
                 ':delivmethod' => $data[$i]['delivmethod'],
                 ':delivaddress' => $data[$i]['delivaddress'],
                 ':status' => $data[$i]['status'],
                 ':regdate' => $data[$i]['regdate'],
                 ':registredby' => $data[$i]['registredby'],
                 ':paymentmethod' => $data[$i]['paymentmethod'],
                 ':prepayment' => $data[$i]['prepayment'],
                 ':lockingmode' => $data[$i]['lockingmode'],
                 ':lastmodified' => $data[$i]['lastmodified'],
                 ':modifiedby' => $data[$i]['modifiedby'],
                 ':webdomains' => $data[$i]['webdomains'],
            ));
            $query->execute();
            
            */
            $i++;
        }
        return $data;
    }
    
    public function convert2()
    {
        $put = 'F:\\';
        $scan_dir = scandir('c:\\');
        print_r($scan_dir);die;
        $i = 0;
        foreach ($scan_dir as $dir_name){
            if ($dir_name == '.' || $dir_name == '..') {continue;}
        if (is_file($put.$dir_name)) {continue;}
            
            $f = file($put.$dir_name.'\\user.cf');
            print_r($f);
        }
        return ;
    }
    
}