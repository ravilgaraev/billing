<div class="container">
    <div class="row text-center">
        <h3><strong>АКТ СВЕРКИ</strong></h3>
    </div>
    <div class="row text-justify">
        <strong>Мы нижеподписавшиеся главный бухгалтер ООО "Amaliy Aloqalar Biznesi" и <?php echo $user[0]['orgr'];?>
        составили настоящий акт сверки по состоянию на <?php echo $forday,'.',$formonth,'.',$foryear;?> 
        года по договору <?php echo $user[0]['contract'];?> от 
            <?php $date = explode("-", $user[0]['cdate']);
                echo $date[2].".".$date[1].".".$date[0]; ?>г.</strong>
    </div>
</div>
<br><br>
<?php $debit = 0; $kredit = 0; ?>
<div class="container">
    <div class="row">
        <table class="table-print text-center sf" style="width:100%">
            <tr>
                <td>Наименование записей</td>
                <td colspan="2">ООО "Amaliy Aloqalar Biznesi</td>
                <td colspan="2"><?php echo $user[0]['orgr'];?></td>
            </tr>
            <tr>
                <td>1</td>
                <td>Дебит</td>
                <td>Кредит</td>
                <td>Дебит</td>
                <td>Кредит</td>
            </tr>
            <tr>
                <td class="text-left">Сальдо на <?php echo $day,'.',$month,'.',$year;?></td>
                <td class="text-right"><?php if(0 > $saldo){echo number_format($saldo*-1,2,'.',',');$debit = $saldo*-1; } ?></td>
                <td class="text-right"><?php if(0 <= $saldo){echo number_format($saldo,2,'.',',');$kredit = $saldo; } ?></td>
                <td class="text-right"><?php if(0 <= $saldo){echo number_format($saldo,2,'.',',');$kredit = $saldo; } ?></td>
                <td class="text-right"><?php if(0 > $saldo){echo number_format($saldo*-1,2,'.',',');$debit = $saldo*-1; } ?></td>
            </tr>
            
            <?php foreach ($akt as $key => $value): ?>
                <tr>
                    <td class="text-left">
                        <?php
                            if(0 < $value['sum']) {echo "Перечислено ", 
                                    substr($value['date'],6,2).".".substr($value['date'],4,2).".".substr($value['date'],0,4);}
                                else {echo "Оказаны услуги связи " ,
                                    substr($value['date'],6,2).".".substr($value['date'],4,2).".".substr($value['date'],0,4);}
                        ?>
                    </td>
                    <td class="text-right">
                        <?php if(0 > $value['sum']) {echo number_format($value['sum']*(-1),2,'.',','),"</td><td>"; $debit +=$value['sum']*(-1);}
                            else {echo '</td><td class="text-right">',number_format($value['sum'],2,'.',','); $kredit += $value['sum'];}
                        ?>
                    </td>
                    <td class="text-right">
                        <?php if(0 < $value['sum']) {echo number_format($value['sum'],2,'.',','),"</td><td>"; }
                            else {echo '</td><td class="text-right">',number_format($value['sum']*-1,2,'.',','); }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td class="text-left">ИТОГО </td>
                <td class="text-right"><?php echo number_format($debit,2,'.',','); ?></td>
                <td class="text-right"><?php echo number_format($kredit,2,'.',','); ?></td>
                <td class="text-right"><?php echo number_format($kredit,2,'.',','); ?></td>
                <td class="text-right"><?php echo number_format($debit,2,'.',','); ?></td>
            </tr>
            <tr>
                <td class="text-left">Сальдо на <?php echo $forday,'.',$formonth,'.',$foryear;?></td>
                <td class="text-right"><?php if($debit > $kredit) echo number_format($debit - $kredit,2,'.',','); ?></td>
                <td class="text-right"><?php if($debit <= $kredit) echo number_format(($debit - $kredit)*-1,2,'.',','); ?></td>
                <td class="text-right"><?php if($debit <= $kredit) echo number_format(($debit - $kredit)*-1,2,'.',','); ?></td>
                <td class="text-right"><?php if($debit > $kredit) echo number_format($debit - $kredit,2,'.',','); ?></td>
            </tr>
        </table>
        <br>
        <?php 
            if(0 == $debit - $kredit) {echo 'Итого сальдо на ',$forday,'.',$formonth,'.',$foryear,' нет.';}
            if(0 > $debit - $kredit) {echo 'Итого сальдо на ',$forday,'.',$formonth,'.',$foryear,' года составляет ',
                Model::factory('sumpropis')->num2str($debit - $kredit,1),' в пользу ',$user[0]['orgr'];}
            if(0 < $debit - $kredit) {echo 'Итого сальдо на ',$forday,'.',$formonth,'.',$foryear,' года составляет ',
                    Model::factory('sumpropis')->num2str($debit - $kredit,1),' в пользу ООО "Amaliy Aloqalar Biznesi"';
                }
        ?>
        
    </div>
    <br><br>
    <div class="row">
        <div class="col-xs-6 text-center">
            ООО "Amaliy Aloqalar Biznesi"
            <br>
            ____________________________<br>
                    (подпись)<br>
                    
                       МП
        </div>
        <div class="col-xs-6 text-center">
            <?php echo $user[0]['orgr']; ?>
            <br>
            ____________________________<br>
                    (подпись)<br>
                    
                       МП
        </div>
    </div>
</div>