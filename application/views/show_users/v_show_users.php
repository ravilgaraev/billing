<?php $i=0; ?>
<table class="table table-striped table-bordered">
    <tr>
        <td>№</td><td>username</td>
        <?php //print_r($fields); die();?>
    <?php foreach ($fields as $key => $field ):?>
            <?php if('on'==$field){ echo"<td>", $key,"</td>";}?>
    <?php endforeach;?>
    </tr>
    <?php foreach ($all_users as $key => $value):?>
    <tr>
        <td><?php echo ++$i; ?></td>
        <?php foreach ($value as $key2 => $data):?>
        <td>
            <?php 
                switch ($key2)
                {
                    case 'plan':echo $data/1024/1024; break;
                    case 'prise':echo number_format($data,2,'.',','); break;
                    default : echo $data;
                }
            ?>
        </td>
        <?php endforeach;?>
    </tr>
    <?php endforeach;?>
</table>



