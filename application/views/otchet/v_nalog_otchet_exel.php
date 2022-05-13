<?php $header = "Реестр счёт-фактур за ".$month." месяц ".$god." года ";
    if("Юридическое" == $urfiz) {$header.= "(юр. лица)";}; 
    if("Физическое" == $urfiz) {$header.= "(физ. лица)";}; 
    if("Usd" == $type) {$header.= "(USD)";}; 
    if("Euro" == $type) {$header.= "(EURO)";};


    $nal_ot[0]['id']="№";
    $nal_ot[0]['name']="Наименование покупателя";
    $nal_ot[0]['iin']="ИНН покупателя";
    $nal_ot[0]['nam_sf']="Номер счет-фактуры";
    $nal_ot[0]['date_sf']="Дата счет-фактуры";
    $nal_ot[0]['spbn']="Стоимость поставки (без НДС)";
    $nal_ot[0]['sum_nds']="Сумма НДС";
    $nal_ot[0]['stoimost']="Стоимость с НДС";
  
    $i = 0; $nds = 0; $outnds = 0;$total = 0;$localnds = 0;$beznds = 0;
        $days = count(Date::days($month, $god));
foreach ($user as $key => $value) {
        //$beznds= number_format($value['prise']*100/($value['stavkands']+100),2,'.','');//$value['total'] - $value['total']*$value['stavkands']/100; 
        $beznds= $value['prise']*100/($value['stavkands']+100);
        $outnds += $beznds;
        //$localnds = number_format($value['prise'] - $value['prise']*100/($value['stavkands']+100),2,'.','');//$value['total']*$value['stavkands']/100; 
        $localnds = $value['prise'] - $value['prise']*100/($value['stavkands']+100);
        $nds += $localnds;
        $total += $value['prise'];
        
     ++$i; $nal_ot[$i]['id'] = $i;
        $nal_ot[$i]['name'] = $value['orgr'];
        $nal_ot[$i]['iin'] = $value['inn'];
         if (isset($value['nomsf'])){echo "IRS-",$value['nomsf']; $nal_ot[$i]['nam_sf']="IRS-".$value['nomsf'];}

                $nal_ot[$i]['date_sf']=$days."-".$month."-".$god;
 
         $nal_ot[$i]['spbn']= number_format($beznds,2,'.','');
 $nal_ot[$i]['sum_nds']=number_format($localnds,2,'.','');
         $nal_ot[$i]['stoimost']=number_format($value['prise'],2,'.',',');
        
}
     $footer[1] = "";
    $footer[2] = "ИТОГО";
    $footer[3] = "";
    $footer[4] = "";
    $footer[5] = "";
    $footer[6] =number_format($outnds,2,'.','');
    $footer[7] =number_format($nds,2,'.','');
    $footer[8] =$total;
    


//foreach ($nal_ot as $key => $value) {
//    echo $value['id'];
//    echo $value['name'];
//    echo $value['iin'];
//    echo $value['nam_sf'];
//    echo $value['date_sf'];
//    echo $value['spbn'];
//    echo $value['sum_nds'];
//    echo $value['stoimost'];
//    echo "<br>";
//};
//foreach ($footer as $value) {
//    echo $value;
//};



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

        include 'excel.php';
        
        $i=1;
        foreach ($nal_ot as $key => $value) {
            $as->setCellValueExplicit("A".$i, $value['id'],'s');
            $as->setCellValueExplicit("B".$i, $value['name'],'s');
            $as->setCellValueExplicit("C".$i, $value['iin'],'s');
            $as->setCellValueExplicit("D".$i, $value['nam_sf'],'s');
            $as->setCellValueExplicit("E".$i, $value['date_sf'],'s');
            $as->setCellValueExplicit("F".$i, $value['spbn'],'s');
            $as->setCellValueExplicit("G".$i, $value['sum_nds'],'s');
            $as->setCellValueExplicit("H".$i, $value['stoimost'],'s');
            ++$i;
        };
        
        
        $ws->send(array('name'=>$header, 'format'=>'Excel2007'));
        
?>