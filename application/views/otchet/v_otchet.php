<h1 class="text-center">Отчет об оказанных услугах за <?php echo $month ;?> месяц <?php echo $god;?> года (<?php echo $type;?>)</h1>
<table class="table table-bordered table-condensed">
    <tr class="text-center">
        <td>№</td>
        <td>Контракт</td>
        <td>Абонент</td>
        <td>Наименование</td>
        <td>ИНН</td>
        <td>Полож. сальдо на начало месяца</td>
        <td>Отриц. сальдо на начало месяца</td>
        <!--<td>Сальдо на начало месяца</td>-->
        <td>Приход</td>
        <td>Приход в погашение задолжности</td>
        <td>Приход в предоплату</td>
        <td>Расход</td>
        <td>Расход в счет предоплаты</td>
        <td>Расход в долг</td>
        <!--<td>Сальдо на конец месяца</td>-->
        <td>Полож. сальдо на конец месяца</td>
        <td>Отриц. сальдо на конец месяца</td>
    </tr>
<?php $i = 0;
    $ci01 = 0;$ci02 = 0;$ci1 = 0;$ci2 = 0;$ci3 = 0;$ci4 = 0;
    $ci5 = 0;$ci6 = 0;$ci7 = 0;$ci8 = 0;$ci9 = 0;$ci10 = 0;
?>
<?php foreach ($user as $key => $value):?>
    <?php 
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
        
    ?>
    <tr>
        <td><?php echo ++$i;?></td>
        <td><?php echo $value['contract'];?></td>
        <td><?php echo $value['username'];?></td>
        <td><?php echo $value['orgr'];?></td>
        <td><?php echo $value['inn'];?></td>
        <td class="text-right"><?php echo number_format($c01,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c02,2,'.',',');?></td>
        <!--<td class="text-right"><?php //echo number_format($c1,2,'.',',');?></td>-->
        <td class="text-right"><?php echo number_format($c2,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c3,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c4,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c5,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c6,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c7,2,'.',',');?></td>
        <!--<td class="text-right"><?php //echo number_format($c8,2,'.',',');?></td>-->
        <td class="text-right"><?php echo number_format($c9,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($c10,2,'.',',');?></td>
    </tr>
<?php endforeach;?>
    <tr>
        <td><?php ?></td>
        <td><?php echo 'ИТОГО';?></td>
        <td><?php ;?></td>
        <td><?php ;?></td>
        <td><?php ;?></td>
        <td class="text-right"><?php echo number_format($ci01,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci02,2,'.',',');?></td>
        <!--<td class="text-right"><?php //echo number_format($ci1,2,'.',',');?></td>-->
        <td class="text-right"><?php echo number_format($ci2,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci3,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci4,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci5,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci6,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci7,2,'.',',');?></td>
        <!--<td class="text-right"><?php //echo number_format($ci8,2,'.',',');?></td>-->
        <td class="text-right"><?php echo number_format($ci9,2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($ci10,2,'.',',');?></td>
    </tr>
</table>