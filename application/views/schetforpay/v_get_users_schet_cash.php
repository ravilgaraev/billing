<div class="panel panel-primary">
    <div class="panel-heading">СЧЕТ НА ОПЛАТУ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/showschetcash" target="blank" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select><br><br>
                    <input type="text" name="many" class="form-control" placeholder="Сумма">
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><span>День</span></span>
                        <input type="text" class="form-control" name="day" 
                               value="<?php echo date("d");?>" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" class="form-control" name="month" 
                               value="<?php echo date("m");?>" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" class="form-control" name="year" 
                               value="<?php echo date("Y");?>" />
                    </div>
                    
                    <br><br>
                    <input type="submit" name="go" value="Напечатать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>