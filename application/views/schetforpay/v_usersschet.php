<form action="showbynomschet" method="get">
    <table class="table table-bordered">
        <tr class="text-primary text-center">
            <td>Номер счета</td>
            <td>Имя абонента</td>
            <td>Дата выписки счета</td>
            <td>Сумма</td>
        </tr>
        <?php foreach ($scheta as $key => $value):?>
        <tr>
            <td>
                <a href="showbynomschet?nn=<?php echo $value['nomschet'];?>" 
                   target="blank"><?php echo $value['nomschet'];?></a>
            </td>
            <td>
                <?php echo $value['username'];?>
            </td>
            <td>
                <?php 
                    $data = explode('-',$value['date']);
                    echo $data[2].'-'.$data[1].'-'.$data[0];
                ?>
            </td>
            <td>
                <?php echo $value['summa'];?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</form>