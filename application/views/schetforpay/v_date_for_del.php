<div class="panel panel-primary">
    <div class="panel-heading">ВЫБЕРИТЕ ДАТУ ОПЛАТЫ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/delpay" method="get">
                    <input type="hidden" name="user_name" value="<?php echo $username;?>">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>Дата оплаты</td><td>Сумма</td><td>ID</td>
                            </tr>
                            <div class="input-group">
                                <span class="input-group-addon">Введите ID оплаты</span>
                                <input type="text" name="id" value="" class="form-control">
                            </div>
                            <br>
                            <input type="submit" name="go" value="Удалить" class="btn btn-primary">
                            <br><br>
                            <?php foreach ($pay as $value):?>
                            <?php if (0 > $value['sum'] and 0 == $value['flag']) {continue;};?>
                                <tr>
                                    <td>
                                    <?php 
                                        $data = substr($value['date'],6,2)."-".
                                                substr($value['date'],4,2)."-".
                                                substr($value['date'],0,4);
                                    echo $data;
                                    ?>
                                    </td>
                                    <td><?php echo number_format($value['sum'],2,'.',',');?></td>
                                    <td><?php echo $value['id']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    
                </form>
            </div>
        </div>
    </div>
</div>