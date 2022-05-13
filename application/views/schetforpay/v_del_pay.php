<div class="panel panel-primary">
    <div class="panel-heading">УДАЛИТЬ ОПЛАТУ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/delpay" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select><br>
<!--                    <div class="input-group">
                        <span class="input-group-addon"><span>ГГГГММДД</span></span>
                        <input type="text" name="date" class="form-control" placeholder="Дата оплаты">
                    </div>-->
                    <br><br>
                    <input type="submit" name="go" value="Далее" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>