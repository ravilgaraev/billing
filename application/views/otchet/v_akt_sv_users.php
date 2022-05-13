<div class="panel panel-primary">
    <div class="panel-heading">Акт сверки</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/aktsverki" target="blank" method="post">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select>
                    <br>
                    С какого числа
                    <div class="input-group">
                        <span class="input-group-addon"><span>День</span></span>
                        <input type="text" name="day" value="" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" name="month" value="" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" name="year" value="" class="form-control">
                    </div>
                    По какое число
                    <div class="input-group">
                        <span class="input-group-addon"><span>День</span></span>
                        <input type="text" name="forday" value="<?php echo date('d') ?>" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" name="formonth" value="<?php echo date('m') ?>" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" name="foryear" value="<?php echo date('Y') ?>" class="form-control">
                    </div>
                    <br><br>
                    <input type="submit" name="go" value="Напечатать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
