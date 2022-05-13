<?php defined('SYSPATH') or die('No direct script access.');

class Model_Otchet extends Model{
    //бухгалтерский отчет
    function otchet($month,$god,$type)
    {
        $date = Date::days(date($month,$god));
        if(10 > $month) {$month = '0'.$month;}
        $day = $date[1];
        if(10 > $day) {$day = '0'.$day;}
        $start = $god."-".$month."-".$day;
        $start2  = $god.$month.$day;
        $finish = $god."-".$month."-". count($date);
        $finish2 = $god.$month.count($date);
        
        switch ($type) {
            case 'Usd':$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Usd' AND s = 'n' ORDER BY username ASC;";
                break;
            case 'Euro':$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Euro' AND s = 'n' ORDER BY username ASC;";
                break;
            case 'Office':$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Office' AND s = 'n' ORDER BY username ASC;";
                break;
            default:$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Bank' AND s = 'n' ORDER BY username ASC;";
                break;
        }
        
                
        $query = DB::query(Database::SELECT, $sql);
        $result = $query->execute();
        
        $i = 0;
        $otchet = array();
        $sort_otchet = array();
        foreach ($result as $users)
        {
            //if(('N' == $users['unlim'])&&((0==$users['plan'])||('NULL'==$users['plan']) )) {continue;}
            $sql = 'SELECT * FROM accounts WHERE user=:user AND date < :start;';
            $query = DB::query(Database::SELECT, $sql);
            $query->parameters(array(
                ':user' => $users['username'],
                ':start' => $start2,
                ));
            $many = $query->execute();
            $sum1 = 0;$sum2 = 0;$sum3 = 0;
            foreach ($many as $key => $value)
            {
                $sum1 += $value['sum'];
            }
            $otchet[$i]['inn'] = $users['inn'];
            $otchet[$i]['orgr'] = $users['orgr'];
            $otchet[$i]['contract'] = $users['contract'];
            $otchet[$i]['username'] = $users['username'];
            $otchet[$i]['urfiz'] = $users['urfiz'];
            $otchet[$i]['snm'] = $sum1;
            
            
            $sql = 'SELECT * FROM accounts WHERE user=:user AND '
                    . '(date BETWEEN :start AND :finish);';
            $query = DB::query(Database::SELECT, $sql);
            $query->parameters(array(
                ':user' => $users['username'],
                ':start' => (int)$start2,
                ':finish' => (int)$finish2." 23:59:59",
                ));
            $many = $query->execute();
            
            foreach ($many as $key => $value)
            {
                if((0 < $value['sum'])||(1 == $value['flag'])) { $sum2 += $value['sum'];}
                else { $sum3 += $value['sum'];}
            }
            $otchet[$i]['prihod'] = $sum2;
            $otchet[$i]['rashod'] = $sum3;
            $i++;
        }
        
        $count = count($otchet);
        $y = 0;
        for ($i=0; $i<$count; $i++) {
            if($otchet[$i]["urfiz"] == "Физическое") {
                $sort_otchet[$y]["inn"] = $otchet[$i]["inn"];
                $sort_otchet[$y]["orgr"] = $otchet[$i]["orgr"];
                $sort_otchet[$y]["contract"] = $otchet[$i]["contract"];
                $sort_otchet[$y]["username"] = $otchet[$i]["username"];
                $sort_otchet[$y]["urfiz"] = $otchet[$i]["urfiz"];
                $sort_otchet[$y]["snm"] = $otchet[$i]["snm"];
                $sort_otchet[$y]["prihod"] = $otchet[$i]["prihod"];
                $sort_otchet[$y]["rashod"] = $otchet[$i]["rashod"];
                $y++;
            }
        }
        $otstup = count($sort_otchet);

        for ($i=0; $i<$count; $i++) {
            if($otchet[$i]["urfiz"] == "Юридическое") {
                $sort_otchet[$otstup]["inn"] = $otchet[$i]["inn"];
                $sort_otchet[$otstup]["orgr"] = $otchet[$i]["orgr"];
                $sort_otchet[$otstup]["contract"] = $otchet[$i]["contract"];
                $sort_otchet[$otstup]["username"] = $otchet[$i]["username"];
                $sort_otchet[$otstup]["urfiz"] = $otchet[$i]["urfiz"];
                $sort_otchet[$otstup]["snm"] = $otchet[$i]["snm"];
                $sort_otchet[$otstup]["prihod"] = $otchet[$i]["prihod"];
                $sort_otchet[$otstup]["rashod"] = $otchet[$i]["rashod"];
                $otstup++;
            }
        }



        return $sort_otchet;
    }
    
    //бухгалтерский отчет Exel
    function otchet_exel($user,$month,$god,$type)
    {
        $date = Date::days(date($month,$god));
        if(10 > $month) {$month = '0'.$month;}
        $day = $date[1];
        if(10 > $day) {$day = '0'.$day;}
        $start = $god."-".$month."-".$day;
        $start2  = $god.$month.$day;
        $finish = $god."-".$month."-". count($date);
        $finish2 = $god.$month.count($date);
        
        switch ($type) {
            case 'Usd':$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Usd' AND s = 'n' ORDER BY username ASC;";
                break;
            case 'Euro':$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Euro' AND s = 'n' ORDER BY username ASC;";
                break;
            case 'Office':$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Office' AND s = 'n' ORDER BY username ASC;";
                break;
            default:$sql = "SELECT username,contract,orgr,inn,paymentmethod,unlim,plan,urfiz,s "
                . "FROM users WHERE paymentmethod='Bank' AND s = 'n' ORDER BY username ASC;";
                break;
        }
        
                
        $query = DB::query(Database::SELECT, $sql);
        $result = $query->execute();
        
        $i = 0;
        $otchet = array();
        $sort_otchet = array();
        foreach ($result as $users)
        {
            //if(('N' == $users['unlim'])&&((0==$users['plan'])||('NULL'==$users['plan']) )) {continue;}
            $sql = 'SELECT * FROM accounts WHERE user=:user AND date < :start;';
            $query = DB::query(Database::SELECT, $sql);
            $query->parameters(array(
                ':user' => $users['username'],
                ':start' => $start2,
                ));
            $many = $query->execute();
            $sum1 = 0;$sum2 = 0;$sum3 = 0;
            foreach ($many as $key => $value)
            {
                $sum1 += $value['sum'];
            }
            $otchet[$i]['inn'] = $users['inn'];
            $otchet[$i]['orgr'] = $users['orgr'];
            $otchet[$i]['contract'] = $users['contract'];
            $otchet[$i]['username'] = $users['username'];
            $otchet[$i]['urfiz'] = $users['urfiz'];
            $otchet[$i]['snm'] = $sum1;
            
            
            $sql = 'SELECT * FROM accounts WHERE user=:user AND '
                    . '(date BETWEEN :start AND :finish);';
            $query = DB::query(Database::SELECT, $sql);
            $query->parameters(array(
                ':user' => $users['username'],
                ':start' => (int)$start2,
                ':finish' => (int)$finish2." 23:59:59",
                ));
            $many = $query->execute();
            
            foreach ($many as $key => $value)
            {
                if((0 < $value['sum'])||(1 == $value['flag'])) { $sum2 += $value['sum'];}
                else { $sum3 += $value['sum'];}
            }
            $otchet[$i]['prihod'] = $sum2;
            $otchet[$i]['rashod'] = $sum3;
            $i++;
        }
        
//        return $otchet;

        $count = count($otchet);
        $y = 0;
        for ($i=0; $i<$count; $i++) {
            if($otchet[$i]["urfiz"] == "Физическое") {
                $sort_otchet[$y]["inn"] = $otchet[$i]["inn"];
                $sort_otchet[$y]["orgr"] = $otchet[$i]["orgr"];
                $sort_otchet[$y]["contract"] = $otchet[$i]["contract"];
                $sort_otchet[$y]["username"] = $otchet[$i]["username"];
                $sort_otchet[$y]["urfiz"] = $otchet[$i]["urfiz"];
                $sort_otchet[$y]["snm"] = $otchet[$i]["snm"];
                $sort_otchet[$y]["prihod"] = $otchet[$i]["prihod"];
                $sort_otchet[$y]["rashod"] = $otchet[$i]["rashod"];
                $y++;
            }
        }
        $otstup = count($sort_otchet);

        for ($i=0; $i<$count; $i++) {
            if($otchet[$i]["urfiz"] == "Юридическое") {
                $sort_otchet[$otstup]["inn"] = $otchet[$i]["inn"];
                $sort_otchet[$otstup]["orgr"] = $otchet[$i]["orgr"];
                $sort_otchet[$otstup]["contract"] = $otchet[$i]["contract"];
                $sort_otchet[$otstup]["username"] = $otchet[$i]["username"];
                $sort_otchet[$otstup]["urfiz"] = $otchet[$i]["urfiz"];
                $sort_otchet[$otstup]["snm"] = $otchet[$i]["snm"];
                $sort_otchet[$otstup]["prihod"] = $otchet[$i]["prihod"];
                $sort_otchet[$otstup]["rashod"] = $otchet[$i]["rashod"];
                $otstup++;
            }
        }
        
        $header = 'Отчет об оказанных услугах за '.$month.' месяц '.$god.' года '.$type;
        
        $ws = new Spreadsheet(array(
            'author'    => 'Kohana-PHPExcel',
            'title'    => 'Report',
            'subject'    => 'Subject',
            'description' => 'Description',
        ));

        $ws->set_active_sheet(0);
        $as = $ws->get_active_sheet();
        $as->setTitle('Report');

        $as->getDefaultStyle()->getFont()->setSize(9);
        
        $as->mergeCells("A1:O1");
        $as->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $as->getStyle("A1")->getFont()->setSize(18);
        $as->setCellValueExplicit("A1", $header,'s');
        
        
        $as->getColumnDimension("A")->setAutoSize(true);
        $as->setCellValueExplicit("A2", '№','s');
        $as->getColumnDimension("B")->setAutoSize(true);
        $as->setCellValueExplicit("B2", 'Контракт','s');
        $as->getColumnDimension("C")->setAutoSize(true);
        $as->setCellValueExplicit("C2", 'Абонент','s');
        $as->getColumnDimension("D")->setAutoSize(true);
        $as->setCellValueExplicit("D2", 'Наименование','s');
        $as->getColumnDimension("E")->setAutoSize(true);
        $as->setCellValueExplicit("E2", 'ИНН','s');
        
        
        $as->getColumnDimension("F")->setAutoSize(true);
        $as->getStyle("F2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("F2", "Полож. сальдо \r\nна начало месяца",'s');
        $as->getColumnDimension("G")->setAutoSize(true);
        $as->getStyle("G2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("G2", "Отриц. сальдо \r\nна начало месяца",'s');
        $as->getColumnDimension("H")->setAutoSize(true);
        $as->getStyle("H2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("H2", "Приход",'s');
        $as->getColumnDimension("I")->setAutoSize(true);
        $as->getStyle("I2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("I2", "Приход в погашение \r\nзадолжности",'s');
        $as->getColumnDimension("J")->setAutoSize(true);
        $as->getStyle("J2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("J2", "Приход в \r\nпредоплату",'s');
        $as->getColumnDimension("K")->setAutoSize(true);
        $as->getStyle("K2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("K2", "Расход",'s');
        $as->getColumnDimension("L")->setAutoSize(true);
        $as->getStyle("L2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("L2", "Расход в счет \r\nпредоплаты",'s');
        $as->getColumnDimension("M")->setAutoSize(true);
        $as->getStyle("M2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("M2", "Расход в долг",'s');
        $as->getColumnDimension("N")->setAutoSize(true);
        $as->getStyle("N2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("N2", "Полож. сальдо \r\nна конец месяца",'s');
        $as->getColumnDimension("O")->setAutoSize(true);
        $as->getStyle("O2")->getAlignment()->setWrapText(true);
        $as->setCellValueExplicit("O2", "Отриц. сальдо \r\nна конец месяца",'s');

        $i=3;
        
        
        $ci01 = 0;$ci02 = 0;$ci1 = 0;$ci2 = 0;$ci3 = 0;$ci4 = 0;
        $ci5 = 0;$ci6 = 0;$ci7 = 0;$ci8 = 0;$ci9 = 0;$ci10 = 0;
        
        foreach ($sort_otchet as $key => $value) {
            
            
            $c8 = 01;$c8 = 02;$c1 = 0;$c2 = 0;$c3 = 0;$c4 = 0;
            $c5 = 0;$c6 = 0;$c7 = 0;$c8 = 0;$c9 = 0;$c10 = 0;


            $snm = $value['snm']; $prihod = $value['prihod']; $rashod = $value['rashod']*-1;
            $po = $value['snm'] + $prihod = $value['prihod'];
            if($snm > 0){$c01 = $snm; $c02 = 0; $ci01 += $c01;}
                else {$c01 = 0; $c02 = $snm; $ci02 += $c02;}
            $c1 = $snm;     $ci1 += $c1; 
            $c2 = $prihod;  $ci2 +=$c2;

            if((0>$snm)&&(0 < $prihod)){$c3 = $snm*-1;}else {$c3 = 0;} 
            if(($snm + $prihod) < 0){$c3 = $prihod;}
            $ci3 +=$c3;

            if(0<=$snm){$c4 = $prihod;if(0>$prihod){$c4=0;}}
                else {$c4 = $prihod+$snm;
                    if(0==$prihod){$c4=0;}} 
            if(($snm + $prihod) < 0){$c4 = 0;}
            $ci4 +=$c4;

            $c5 = $rashod;  $ci5 +=$c5;


            if(($rashod > 0)&&($rashod >= $po)){$c6 = $po;}
                else{$c6 = $rashod;}
            if(($rashod > 0)&&(0 >= $po)) {$c6 = 0;}
            if($rashod == 0) {$c6 = 0;}
            $ci6 +=$c6;
    //        if(($rashod > 0)&&($rashod <= $c1+$c2)){$c7 = 0;}
    //        if(($rashod > 0)&&($rashod >= $c1+$c2)){$c7 = $c5+$c1+$c2;}
    //        if($rashod == 0) {$c7 = 0;}
            $c7 = $c5 - $c6;
            $ci7 +=$c7;
        
            
        if(0 == $rashod){$c8 = $snm+$prihod;}else{$c8 = $prihod+$snm-$rashod;} $ci8 +=$c8;
        if($c8 > 0){$c9 = $c8; $c10 = 0;$ci9 += $c9;}
            else {$c9 = 0; $c10 = $c8;$ci10 += $c10;}
        
            
            
            
            $as->getColumnDimension("A")->setAutoSize(true);
            $as->setCellValueExplicit("A".$i, $i-2,'s');
            $as->getColumnDimension("B")->setAutoSize(true);
            $as->setCellValueExplicit("B".$i, $value['contract'],'s');
            $as->getColumnDimension("C")->setAutoSize(true);
            $as->setCellValueExplicit("C".$i, $value['username'],'s');
            $as->getColumnDimension("D")->setAutoSize(true);
            $as->setCellValueExplicit("D".$i, $value['orgr'],'s');
            $as->getColumnDimension("E")->setAutoSize(true);
            $as->setCellValueExplicit("E".$i, $value['inn'],'s');
            
            $as->getColumnDimension("F")->setAutoSize(true);
            $as->setCellValueExplicit("F".$i, number_format($c01,2,'.',','),'s');
            $as->getStyle("F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("G")->setAutoSize(true);
            $as->setCellValueExplicit("G".$i, number_format($c02,2,'.',','),'s');
            $as->getStyle("G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("H")->setAutoSize(true);
            $as->setCellValueExplicit("H".$i, number_format($c2,2,'.',','),'s');
            $as->getStyle("H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("I")->setAutoSize(true);
            $as->setCellValueExplicit("I".$i, number_format($c3,2,'.',','),'s');
            $as->getStyle("I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("J")->setAutoSize(true);
            $as->setCellValueExplicit("J".$i, number_format($c4,2,'.',','),'s');
            $as->getStyle("J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("K")->setAutoSize(true);
            $as->setCellValueExplicit("K".$i, number_format($c5,2,'.',','),'s');
            $as->getStyle("K".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("L")->setAutoSize(true);
            $as->setCellValueExplicit("L".$i, number_format($c6,2,'.',','),'s');
            $as->getStyle("L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("M")->setAutoSize(true);
            $as->setCellValueExplicit("M".$i, number_format($c7,2,'.',','),'s');
            $as->getStyle("M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("N")->setAutoSize(true);
            $as->setCellValueExplicit("N".$i, number_format($c9,2,'.',','),'s');
            $as->getStyle("N".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("O")->setAutoSize(true);
            $as->setCellValueExplicit("O".$i, number_format($c10,2,'.',','),'s');
            $as->getStyle("O".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            ++$i;
        };

            $as->getColumnDimension("A")->setAutoSize(true);
            $as->setCellValueExplicit("A".$i, "",'s');
            $as->getColumnDimension("B")->setAutoSize(true);
            $as->setCellValueExplicit("B".$i, 'ИТОГО','s');
            $as->getColumnDimension("C")->setAutoSize(true);
            $as->setCellValueExplicit("C".$i, "",'s');
            $as->getColumnDimension("D")->setAutoSize(true);
            $as->setCellValueExplicit("D".$i, "",'s');
            $as->getColumnDimension("E")->setAutoSize(true);
            $as->setCellValueExplicit("E".$i, "",'s');
            
            $as->getColumnDimension("F")->setAutoSize(true);
            $as->setCellValueExplicit("F".$i, number_format($ci01,2,'.',','),'s');
            $as->getStyle("F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("G")->setAutoSize(true);
            $as->setCellValueExplicit("G".$i, number_format($ci02,2,'.',','),'s');
            $as->getStyle("G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("H")->setAutoSize(true);
            $as->setCellValueExplicit("H".$i, number_format($ci2,2,'.',','),'s');
            $as->getStyle("H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("I")->setAutoSize(true);
            $as->setCellValueExplicit("I".$i, number_format($ci3,2,'.',','),'s');
            $as->getStyle("I".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("J")->setAutoSize(true);
            $as->setCellValueExplicit("J".$i, number_format($ci4,2,'.',','),'s');
            $as->getStyle("J".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("K")->setAutoSize(true);
            $as->setCellValueExplicit("K".$i, number_format($ci5,2,'.',','),'s');
            $as->getStyle("K".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("L")->setAutoSize(true);
            $as->setCellValueExplicit("L".$i, number_format($ci6,2,'.',','),'s');
            $as->getStyle("L".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("M")->setAutoSize(true);
            $as->setCellValueExplicit("M".$i, number_format($ci7,2,'.',','),'s');
            $as->getStyle("M".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("N")->setAutoSize(true);
            $as->setCellValueExplicit("N".$i, number_format($ci9,2,'.',','),'s');
            $as->getStyle("N".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            $as->getColumnDimension("O")->setAutoSize(true);
            $as->setCellValueExplicit("O".$i, number_format($ci10,2,'.',','),'s');
            $as->getStyle("O".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        $ws->send(array('name'=>$header, 'format'=>'Excel2007'));
        
        
    }
    
    
    
    //отчет в налоговую
    function nalog_otchet($month,$year,$type,$urfiz)
    {
//        $query = DB::select()
//            ->from('users')
//            ->join('sf')
//            ->on('users.username', '=', 'sf.username')
//            ->where('users.paymentmethod','=',$type)
//            ->where('sf.month','=',$month)
//            ->where('sf.year','=',$year)
//            ->order_by('users.username','ASC');
//        return $query->execute();
        $i=1;$users = [];$date=$month.$year;
        $query = DB::select()
            ->from('users')
            ->join('sf')
            ->on('users.username', '=', 'sf.username')
            ->where('users.paymentmethod','=',$type)
            ->where('sf.month','=',$month)
            ->where('sf.year','=',$year)
            ->where('users.urfiz','=',$urfiz)
            //->where('users.stavkands','=',0)
            //->order_by('users.stavkands','ASC');
            ->order_by('users.username','ASC');
        $result = $query->execute();
        
        foreach ($result as $key => $value) {
            //$query = DB::query(Database::SELECT,'SELECT SUM("price") FROM statistics WHERE username = :username;')
            $query = DB::query(Database::SELECT,'SELECT sum(total) FROM statistics WHERE username=:username and date=:date')        
                    ->bind(':username', $value['username'])
                    ->bind(':date', $date);
            $sum = $query->execute();
            
            $i++;
            
            $users[$i]['username']=$value['username'];
            $users[$i]['orgr']=$value['orgr'];
            $users[$i]['inn']=$value['inn'];
            $users[$i]['nomsf']=$value['nomsf'];
            $users[$i]['date']=$value['date'];
            $users[$i]['nds']=$value['nds'];
            $users[$i]['stavkands']=$value['stavkands'];
            $users[$i]['prise']=$sum[0]['sum(total)'];
            $users[$i]['sumnds']=$sum[0]['sum(total)'];
            $users[$i]['sum']=$sum[0]['sum(total)'];
        }
        return $users;
    }
    
    //отчет в налоговую exel
    function nalog_otchet_exel($user,$month,$god,$type,$urfiz)
    {
        $header = "Реестр счёт-фактур за ".$month." месяц ".$god." года ";
        if("Юридическое" == $urfiz) {$header.= "(юр. лица)";}; 
        if("Физическое" == $urfiz) {$header.= "(физ. лица)";}; 
        if("Usd" == $type) {$header.= "(USD)";}; 
        if("Euro" == $type) {$header.= "(EURO)";};

        $nal_ot = [];

        $nal_ot[0]['id']="№";
        $nal_ot[0]['name']="Наименование покупателя";
        $nal_ot[0]['iin']="ИНН покупателя";
        $nal_ot[0]['nam_sf']="Номер счет-фактуры";
        $nal_ot[0]['date_sf']="Дата счет-фактуры";
        $nal_ot[0]['spbn']="Стоимость поставки (без НДС)";
        $nal_ot[0]['sum_nds']="Сумма НДС";
        $nal_ot[0]['stoimost']="Стоимость с НДС";

        $i = 1; $nds = 0; $outnds = 0;$total = 0;$localnds = 0;$beznds = 0;
            $days = count(Date::days($month, $god));
    foreach ($user as $key => $value) {
        $beznds= $value['prise']*100/(('n' == $value['nds']) ? 100 : $value['stavkands']+100);
        $outnds += $beznds;
        $localnds = ('n' == $value['nds']) ? 'Без НДС' : $value['prise'] - $value['prise']*100/($value['stavkands']+100);
        $nds += $localnds;
        $total += $value['prise'];

        ++$i;
        $nal_ot[$i]['id'] = $i-1;
        $nal_ot[$i]['name'] = $value['orgr'];
        $nal_ot[$i]['iin'] = $value['inn'];
        if (isset($value['nomsf'])){$nal_ot[$i]['nam_sf']="IRS-".$value['nomsf'];}
        $nal_ot[$i]['date_sf']=$days."-".$month."-".$god;
        $nal_ot[$i]['spbn']= number_format($beznds,2,'.',',');
        $nal_ot[$i]['sum_nds']=('n' == $value['nds']) ? 0 :number_format($localnds,2,'.',',');
        $nal_ot[$i]['stoimost']=number_format($value['prise'],2,'.',',');

    }
        $footer[1] = "";
        $footer[2] = "ИТОГО";
        $footer[3] = "";
        $footer[4] = "";
        $footer[5] = "";
        $footer[6] =number_format($outnds,2,'.',',');
        $footer[7] =number_format($nds,2,'.',',');
        $footer[8] =number_format($total,2,'.',',');

        
//        foreach ($nal_ot as $key => $value) {
//            echo $value['id'];
//            echo $value['name'];
//            echo $value['iin'];
//            echo $value['nam_sf'];
//            echo $value['date_sf'];
//            echo $value['spbn'];
//            echo $value['sum_nds'];
//            echo $value['stoimost'];
//            echo "<br>";
//            
//            
//        }
        $ws = new Spreadsheet(array(
            'author'    => 'Kohana-PHPExcel',
            'title'    => 'Report',
            'subject'    => 'Subject',
            'description' => 'Description',
        ));

        $ws->set_active_sheet(0);
        $as = $ws->get_active_sheet();
        $as->setTitle('Report');


        $as->getDefaultStyle()->getFont()->setSize(9);

        $as->mergeCells("A1:H1");
        $as->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $as->getStyle("A1")->getFont()->setSize(18);
        $as->setCellValueExplicit("A1", $header,'s');


        $i=2;
        foreach ($nal_ot as $key => $value) {
            $as->getColumnDimension("A")->setAutoSize(true);
            $as->setCellValueExplicit("A".$i, $value['id'],'s');
            $as->getColumnDimension("B")->setAutoSize(true);
            $as->setCellValueExplicit("B".$i, $value['name'],'s');
            $as->getColumnDimension("C")->setAutoSize(true);
            $as->setCellValueExplicit("C".$i, $value['iin'],'s');
            $as->getColumnDimension("D")->setAutoSize(true);
            $as->setCellValueExplicit("D".$i, $value['nam_sf'],'s');
            $as->getColumnDimension("E")->setAutoSize(true);
            $as->setCellValueExplicit("E".$i, $value['date_sf'],'s');
            
            
            $as->getColumnDimension("F")->setAutoSize(true);
            $as->setCellValueExplicit("F".$i, $value['spbn'],'s');
            $as->getStyle("F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("G")->setAutoSize(true);
            $as->setCellValueExplicit("G".$i, $value['sum_nds'],'s');
            $as->getStyle("G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("H")->setAutoSize(true);
            $as->setCellValueExplicit("H".$i, $value['stoimost'],'s');
            $as->getStyle("H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            ++$i;
        };

            $as->getColumnDimension("A")->setAutoSize(true);
            $as->setCellValueExplicit("A".$i, $footer[1],'s');
            $as->getColumnDimension("B")->setAutoSize(true);
            $as->setCellValueExplicit("B".$i, $footer[2],'s');
            $as->getColumnDimension("C")->setAutoSize(true);
            $as->setCellValueExplicit("C".$i, $footer[3],'s');
            $as->getColumnDimension("D")->setAutoSize(true);
            $as->setCellValueExplicit("D".$i, $footer[4],'s');
            $as->getColumnDimension("E")->setAutoSize(true);
            $as->setCellValueExplicit("E".$i, $footer[5],'s');
            
            
            $as->getColumnDimension("F")->setAutoSize(true);
            $as->setCellValueExplicit("F".$i, $footer[6],'s');
            $as->getStyle("F".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("G")->setAutoSize(true);
            $as->setCellValueExplicit("G".$i, $footer[7],'s');
            $as->getStyle("G".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
            
            $as->getColumnDimension("H")->setAutoSize(true);
            $as->setCellValueExplicit("H".$i, $footer[8],'s');
            $as->getStyle("H".$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            
        $ws->send(array('name'=>$header, 'format'=>'Excel2007'));


    }
            
    function nalog_otchet_users($users)
    {
//        $i=1;
//        foreach ($users as $key => $value) {
//            $price = 0;
//            $query = DB::select()
//                    ->from('statistics')
//                    ->where('username', '=', $value['username']);
//            $stat= $query->execute();
//            foreach ($stat as $key1 => $value1) {
//                $price += $value1['price'];
//            }
//            $usera['orgr']
//            $usera[$i++]['username'] = $value['username'];
//            $usera[$i++]['stavkands'] = $value['stavkands'];
////            $usera[$i++]['prise'] = $price;
//        }
//        return $usera;
    }
    function get_all_schet()
    {
        $date = Date::days(date("m,Y"));
        $day = $date[1];
        $month = date("m");
        $year = date("Y");
        $start = $year."-".$month."-".$day;
        $finish = $year."-".$month."-". count($date);
        $sql = 'SELECT username,date,summa,nomschet FROM schet '
                . 'WHERE date BETWEEN :start AND :finish;';
        $query = DB::query(Database::SELECT,$sql);
        $query->parameters(array(
            ':start' => $start,
            ':finish' => $finish,
        ));
        return $query->execute();
    }
    function get_all_many($type,$pay,$day,$month,$year)
    {
//        $date = Date::days(date("m,Y"));
//        $day = $date[1];
//        $month = date("m");
//        $year = date("Y");
//        if(10 > $day){$day = '0'.$day;}
//        $start = $year.$month.$day;
//        $finish = $year.$month.count($date);
//        $sql = 'SELECT user,date,sum,cmt FROM accounts '
//                . 'WHERE (date BETWEEN :start AND :finish) AND sum > 0;';
//        $query = DB::query(Database::SELECT,$sql);
//        $query->parameters(array(
//            ':start' => $start,
//            ':finish' => $finish,
//        ));
//        return $query->execute();
        $prepay = '=';
        if('All' == $pay) {$prepay = '!=';}
        $start = $year.$month.$day;
        $finish = $year.$month.$day;
        //за другой месяц
        if(date('m') != $month && '' == $day) {
            $date = Date::days(date("$month,Y"));
            $d = $date[1];
            //$year = date("Y");
            if(10 > $d){$d = '0'.$d;}
            $start = $year.$month.$d;
            $finish = $year.$month.count($date);
        }
        //за весь месяц
        if(date('m') == $month && '' == $day) {
            $start = $year.$month.'01';
            $finish = $year.$month.date('d');
        }
        
        $query = DB::select('users.username','accounts.*')
                ->from('users')
                ->join('accounts')
                ->on('users.username', '=', 'accounts.user')
                ->where('users.paymentmethod', '=', $type)
                ->where('users.prepayment', $prepay, $pay)
                ->where('accounts.date', 'BETWEEN', array($start, $finish))
                ->where('accounts.sum', '>', 0)
                ->order_by('accounts.date','DESC')
                ->execute();
        
//        if('' == $day){
//            $day = date('d');
//            $start = $year.$month.'01';
//            $finish = $year.$month.$day;
//            
//            $query = DB::select('users.username','accounts.*')
//                ->from('users')
//                ->join('accounts')
//                ->on('users.username', '=', 'accounts.user')
//                ->where('users.paymentmethod', '=', $type)
//                ->where('users.prepayment', $prepay, $pay)
//                ->where('accounts.date', 'BETWEEN', array($start, $finish))
//                ->where('accounts.sum', '>', 0)
//                ->order_by('accounts.date','DESC')
//                ->execute();
//            }else{
//                $query = DB::select('users.username','accounts.*')
//                    ->from('users')
//                    ->join('accounts')
//                    ->on('users.username', '=', 'accounts.user')
//                    ->where('users.paymentmethod', '=', $type)
//                    ->where('users.prepayment', $prepay, $pay)
//                    ->where('accounts.date', '=', $year.$month.$day)
//                    ->where('accounts.sum', '>', 0)
//                    ->order_by('accounts.date','DESC')
//                    ->execute();
//            }
//        
//        
        
        return $query;
        
        
        
    }
    //должники
    function dolshniki($type,$pay)
    {
        $date = Date::days(date("m,Y"));
        $day = $date[1];
        $month = date("m");
        $year = date("Y");
        $start = $year."-".$month."-".$day;
        $finish = $year."-".$month."-". count($date);
        
       
        
        switch ($type) {
            case 1 :
                    if('Yes' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Bank' AND unlim = 'Y' AND prepayment = 'Yes' ";
                    }
                    else
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Bank' AND unlim = 'Y' AND prepayment = 'No' ";
                    }
                    if('All' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Bank' AND unlim = 'Y' ";
                    }
                    break;
            case 2 : 
                    if('Yes' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Usd' AND prepayment = 'Yes' ";
                    }
                    else
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Usd' AND prepayment = 'No' ";
                    }
                    if('All' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Usd' ";
                    }
                    break;
            case 3 : 
                    if('Yes' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Bank' AND unlim = 'N' AND prepayment = 'Yes' ";
                    }
                    else
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Bank' AND unlim = 'N' AND prepayment = 'No' ";
                    }
                    if('All' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Bank' AND unlim = 'N' ";
                    }
                    break;
            case 4 : 
                    if('Yes' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Euro' AND prepayment = 'Yes' ";
                    }
                    else
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Euro' AND prepayment = 'No' ";
                    }
                    if('All' == $pay)
                    {
                        $sql = "SELECT id,username,orgr,unlim,plan,price_out,skidka,prise,feecheck FROM users "
                                . "WHERE s = 'n' AND paymentmethod = 'Euro' ";
                    }
                break;
        }
        
        $sql .= "ORDER BY username";
        $query = DB::query(Database::SELECT,$sql);
        $users = $query->execute();
        $i = 0;
        $dolshniki = array();
        
//        foreach ($users as $key => $value) {
//            echo "<pre>";
//            print_r($value);
//            echo "</pre>";
//            
//        }
//        die;
        foreach ($users as $key => $value)
        {
            $prise = 0;$now = 0;
            //подсчет услуг
            $query = DB::query(Database::SELECT,'SELECT price FROM services WHERE username = :user;');
            $query->parameters(array(':user' => $value['username'],));
            $result = $query->execute();
            foreach ($result as $key1 => $value1)
            {
                $now -= $value1['price'];
            }
            //подсчет разовой услуги
            $query = DB::query(Database::SELECT,"SELECT * FROM one_time WHERE username = :user AND flag='0';");
            $query->parameters(array(':user' => $value['username'],));
            $result = $query->execute();
            foreach ($result as $key1 => $value1)
            {
                $now -= $value1['price']*$value1['count'];
            }
            //состояние счета
            $query = DB::query(Database::SELECT,'SELECT * FROM accounts WHERE user = :user ORDER BY id;');
            $query->parameters(array(':user' => $value['username'],));
            $result_many = $query->execute();
            
            if('yes' == $value['feecheck']) {
                $prise -= $value['prise']*$value['skidka'];
            }
            
            //$prise -= $value['prise']*$value['skidka'];
            
            $many = 0.0;
            foreach ($result_many as $value_many)
            {
                //$many += $value_many['sum'];
                $many = number_format($many,2,'.','')+$value_many['sum'];
            }
            $prise += $many;
            $prise += $now;
            //$dolshniki[$i]['tr'] = '';
            $traffic_in = 0;
            $traffic_in_priv = 0;
            $traffic_out = 0;
            $traffic_out_priv = 0;
            $check = true;
            
            
            if(('3'==$type)&&(0 < $value['prise']))
            {
                
                $traffic = Model::factory('users')->user_traff($value['username'], $start, $finish);
                foreach ($traffic as $key)//подсчет трафика
                {
                    $traffic_in += $key['Bytes_out'];
                    $traffic_in_priv += $key['Bytes_out_priv'];
                    $traffic_out += $key['Bytes_in'];
                    $traffic_out_priv += $key['Bytes_in_priv'];
                }
                $tr_in = $traffic_out - $traffic_out_priv;
                $tr_out = $traffic_in - $traffic_in_priv;
                if(($value['plan'] < $tr_in)||($value['plan'] < $tr_out))
                {
                    if($tr_in > $tr_out){$tr_pr = $tr_in-$value['plan'];}
                    else {$tr_pr = $tr_out-$value['plan'];}
                    $prise -= $tr_pr/1024/1024 * $value['price_out'];
                    $dolshniki[$i]['tr'] = 'Превышение трафика';
                    $check = false;
                }
            }
            
            if(-0 == $prise) {$prise * -1;}
            
            if(0 > $prise) 
            {
                $month_befo = $month - 1;
                $year_befo = $year;
                if(10 > $month_befo) {$month_befo = '0'.$month_befo;}
                if(0 == $month_befo) {$month_befo = '12'; $year_befo = $year -1;}
                
                $befo = DB::select()
                        ->from('statistics')
                        ->where('username', '=', $value['username'])
                        ->where('date', '=', $month_befo.$year_befo)
                        ->execute();
                
                $total = 0;
                foreach ($befo as $value2) {
                    $total += $value2['total'];
                }
                if(-0 == $many){$many = 0;}
                $dolshniki[$i]['befo'] = ($many >= 0 || $total < 0)?0:$total ;
                $dolshniki[$i]['befo'] = ($many < 0 && $many < $total)?$many*-1:0 ;
                    
                $dolshniki[$i]['username'] = $value['username'];
                $dolshniki[$i]['orgr'] = $value['orgr'];
                $dolshniki[$i]['sum'] = $prise;
                
                $dolshniki[$i]['id'] = $value['id'];
                if($check){$dolshniki[$i]['tr'] = '';}
                $i++;
            }
        }
        return $dolshniki;
    }
}
