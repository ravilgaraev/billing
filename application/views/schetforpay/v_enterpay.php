<div class="panel panel-primary">
    <div class="panel-heading">ВНЕСТИ ОПЛАТУ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/enterpay" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select><br>
                    <input type="text" name="many" class="form-control" placeholder="Сумма">
                    <input type="text" name="nomschet" class="form-control" placeholder="Номер счета">
                    <div class="input-group">
                        <span class="input-group-addon"><span>ГГГГММДД</span></span>
                        <input type="text" class="form-control" name="date" 
                               value="<?php echo date("Ymd");?>" />
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="v" value="1">Возврат средств</label>
                    </div>
                    <br>
                    <input type="submit" name="go" value="Внести" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>