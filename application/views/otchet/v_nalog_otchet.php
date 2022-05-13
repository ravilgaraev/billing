<?php $header = "Реестр счёт-фактур за ".$month." месяц ".$god." года ";
    if("Юридическое" == $urfiz) {$header.= "(юр. лица)";}; 
    if("Физическое" == $urfiz) {$header.= "(физ. лица)";}; 
    if("Usd" == $type) {$header.= "(USD)";}; 
    if("Euro" == $type) {$header.= "(EURO)";};
?>
<h1 class="text-center">Реестр счёт-фактур за <?php echo $month ;?> месяц <?php echo $god;?> года
    <?php 
        if("Юридическое" == $urfiz) {echo "(юр. лица)";} ; 
        if("Физическое" == $urfiz) {echo "(физ. лица)";} ; 
        if("Usd" == $type) {echo "(USD)";} ; 
        if("Euro" == $type) {echo "(EURO)";} ; 
    ?>
</h1>
<table class="table table-bordered table-condensed">
    <tr class="text-center">
        <td>№</td>
        <td>Наименование покупателя</td>
        <td>ИНН покупателя</td>
        <td>Номер счет-фактуры</td>
        <td>Дата счет-фактуры</td>
        <td>Стоимость поставки (без НДС)</td>
        <td>Сумма НДС</td>
        <td>Стоимость с НДС</td>
    </tr>
    
<?php 
    $nal_ot[0]['id']="№";
    $nal_ot[0]['name']="Наименование покупателя";
    $nal_ot[0]['iin']="ИНН покупателя";
    $nal_ot[0]['nam_sf']="Номер счет-фактуры";
    $nal_ot[0]['date_sf']="Дата счет-фактуры";
    $nal_ot[0]['spbn']="Стоимость поставки (без НДС)";
    $nal_ot[0]['sum_nds']="Сумма НДС";
    $nal_ot[0]['stoimost']="Стоимость с НДС";
?>    
<?php $i = 0; $nds = 0; $outnds = 0;$total = 0;$localnds = 0;$beznds = 0;
        $days = count(Date::days($month, $god));?>
<?php foreach ($user as $key => $value):?>
    <?php 
        //$beznds= number_format($value['prise']*100/($value['stavkands']+100),2,'.','');//$value['total'] - $value['total']*$value['stavkands']/100; 
        $beznds= $value['prise']*100/($value['stavkands']+100);
        $outnds += $beznds;
        //$localnds = number_format($value['prise'] - $value['prise']*100/($value['stavkands']+100),2,'.','');//$value['total']*$value['stavkands']/100; 
        $localnds = $value['prise'] - $value['prise']*100/($value['stavkands']+100);
        $nds += $localnds;
        $total += $value['prise'];
        
    ?>
    <tr>
        <td><?php echo ++$i; $nal_ot[$i]['id'] = $i;?></td>
        <td><?php echo $value['orgr']; $nal_ot[$i]['name'] = $value['orgr'];?></td>
        <td><?php echo $value['inn']; $nal_ot[$i]['iin'] = $value['inn']; ?></td>
        <td class="text-right"><?php if (isset($value['nomsf'])){echo "IRS-",$value['nomsf']; $nal_ot[$i]['nam_sf']="IRS-".$value['nomsf'];}?></td>
        <td class="text-right">
            <?php 
//                $date = explode("-", $value['date']);
//                echo $date[2],".",$date[1],".",$date[0];
                echo $days."-".$month."-".$god; $nal_ot[$i]['date_sf']=$days."-".$month."-".$god;
            ?>
        </td>
        <td class="text-right">
            <?php echo  number_format($beznds,2,'.',''); $nal_ot[$i]['spbn']= number_format($beznds,2,'.','');?>
        </td>
        <td class="text-right">
            <?php echo number_format($localnds,2,'.',''); $nal_ot[$i]['sum_nds']=number_format($localnds,2,'.','');;?>
        </td>
        <td class="text-right">
            <?php echo number_format($value['prise'],2,'.',','); $nal_ot[$i]['stoimost']=number_format($value['prise'],2,'.',',');?>
        </td>
    </tr>
<?php endforeach;?>
    <tr>
        <td><?php $footer[1] = "";?></td>
        <td><?php echo 'ИТОГО'; $footer[2] = "ИТОГО";?></td>
        <td><?php $footer[3] = "";?></td>
        <td><?php $footer[4] = "";?></td>
        <td class="text-right"><?php $footer[5] = "";?></td>
        <td class="text-right"><?php echo number_format($outnds,2,'.','');$footer[6] =number_format($outnds,2,'.','');?></td>
        <td class="text-right"><?php echo number_format($nds,2,'.','');$footer[7] =number_format($nds,2,'.','');?></td>
        <td class="text-right"><?php echo $total;$footer[8] =$total;?></td>
    </tr>
</table>

<?php 
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


//
//        $ws = new Spreadsheet(array(
//            'author'    => 'Kohana-PHPExcel',
//            'title'    => 'Report',
//            'subject'    => 'Subject',
//            'description' => 'Description',
//        ));
//        
//        $ws->set_active_sheet(0);
//        $as = $ws->get_active_sheet();
//        $as->setTitle('Report');
//        
//        $as->getDefaultStyle()->getFont()->setSize(9);
//
//        include 'excel.php';
//        
//        $i=1;
//        foreach ($nal_ot as $key => $value) {
//            $as->setCellValueExplicit("A".$i, $value['id'],'s');
//            $as->setCellValueExplicit("B".$i, $value['name'],'s');
//            $as->setCellValueExplicit("C".$i, $value['iin'],'s');
//            $as->setCellValueExplicit("D".$i, $value['nam_sf'],'s');
//            $as->setCellValueExplicit("E".$i, $value['date_sf'],'s');
//            $as->setCellValueExplicit("F".$i, $value['spbn'],'s');
//            $as->setCellValueExplicit("G".$i, $value['sum_nds'],'s');
//            $as->setCellValueExplicit("H".$i, $value['stoimost'],'s');
//            ++$i;
//        };
//        
//        
//        $ws->send(array('name'=>$header, 'format'=>'Excel2007'));
//        
?>