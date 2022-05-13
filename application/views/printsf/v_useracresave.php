<div class="panel panel-primary">
    <div class="panel-heading">Перерасчет абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 ">
                <form action="/saveacrender" method="post">
                    <table class="table table-bordered">
                        <?php foreach ($user as $key => $value):?>
                        <tr>
                            <td>Айди</td>
                            <td>
                                <span><?php echo $value['id'];?></span>
                                <input type="hidden" name="id" value="<?php echo $value['id'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Абонент</td>
                            <td>
                                <span><?php echo $value['user'];?></span>
                                <input type="hidden" name="user" value="<?php echo $value['user'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Дата</td>
                            <td>
                                <span><?php echo $value['date'];?></span>
                                <input type="hidden" name="date" value="<?php echo $value['date'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Сумма</td>
                            <td>
                                <input type="text" name="sum" 
                                       value="<?php echo $value['sum'];?>" class="form-control">
                        </tr>
                        <tr>
                            <td>Коментарии</td>
                            <td><input type="text" name="cmt" 
                                       value="<?php echo $value['cmt'];?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Флаг</td>
                            <td><input type="text" name="flag" 
                                       value="<?php echo $value['flag'];?>" class="form-control"></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                    <br>
                    <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>