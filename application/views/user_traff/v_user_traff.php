<div class="text-primary">
<table class="table table-bordered">
    <tr>
        <td class="table_info">ID</td>
        <td class="table_info">Абонент</td>
        <td class="table_info">Дата</td>
        <td class="table_info">Время</td>
        <td class="table_info">Исходящий</td>
        <td class="table_info">Входящий</td>
        <td class="table_info">Входящий TasIX</td>
        <td class="table_info">Исходящий TasIX</td>
    </tr>
<?php 
$sum_in = 0;
$sum_out =0;
$sum_in_priv =0;
$sum_out_priv =0;
foreach ($user as $key => $value): 
    ?>
    <tr>
        <td class="table_info"><?php echo $value['ID']; ?></td>
        <td class="table_info"><?php echo $value['Username']; ?></td>
        <td class="table_info"><?php echo $value['TDate']; ?></td>
        <td class="table_info"><?php echo $value['TTime']; ?></td>
        <td class="table_info"><?php echo $value['Bytes_in']; $sum_in+=$value['Bytes_in']; ?></td>
        <td class="table_info"><?php echo $value['Bytes_out']; $sum_out+=$value['Bytes_out'];?></td>
        <td class="table_info"><?php echo $value['Bytes_in_priv']; $sum_in_priv+=$value['Bytes_in_priv'];?></td>
        <td class="table_info"><?php echo $value['Bytes_out_priv']; $sum_out_priv+=$value['Bytes_out_priv'];?></td>
    </tr>
<?php endforeach;?>
    <tr>
        <td class="table_info"></td>
        <td class="table_info"></td>
        <td class="table_info"></td>
        <td class="table_info"></td>
        <td class="table_info"><?php echo $sum_in; ?></td>
        <td class="table_info"><?php echo $sum_out;?></td>
        <td class="table_info"><?php echo $sum_in_priv;?></td>
        <td class="table_info"><?php echo $sum_out_priv;?></td>
    </tr>
</table>
</div>