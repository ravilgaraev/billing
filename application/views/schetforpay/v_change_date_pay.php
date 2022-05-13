<div class="panel panel-primary">
    <div class="panel-heading">ИЗМЕНИТЬ ДАТУ ОПЛАТЫ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/changedatepay" method="get">
                    <input type="hidden" name="user_name" value="<?php echo $username;?>">
                    <div class="input-group">
                        <span class="input-group-addon">Введите ID оплаты</span>
                        <input type="text" name="id" value="" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>ГГГГММДД</span></span>
                        <input type="text" name="newdate" class="form-control" placeholder="Новая дата">
                    </div>
                    <br>
                    <input type="submit" name="go" value="Внести" class="btn btn-primary">
                    <br><br>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <td>Дата оплаты</td><td>Сумма</td><td>ID</td>
                            </tr>
                            <?php foreach ($pay as $value):?>
                            <?php if (0 > $value['sum']) {continue;};?>
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
