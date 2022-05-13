<form method="get">
    <table class="table table-bordered">
        <?php foreach ($schet as $key => $value):?>
        <tr>
            <td>
                <a href="showbynomschet?nn=<?php echo $value['nomschet'];?>" 
                   target="blank"><?php echo $value['nomschet'];?></a>
            </td>
            <td>
                <?php echo $value['username'];?>
            </td>
            <td>
                <?php echo $value['date'];?>
            </td>
            <td>
                <?php echo $value['summa'];?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
</form>