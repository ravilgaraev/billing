<div class="panel panel-primary">
    <div class="panel-heading">Электронная счёт-фактура</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/didox" method="post">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control">
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>">
                            <?php echo $value['username']; ?>
                        </option>
                        <?php endforeach;?>
                    </select>
                    
                    <select name="type" class="form-control">
                        <option value="">Выберите тип абонента</option>
                        <option value="Bank">Bank</option>
                        <option value="Usd">Usd</option>
                    </select>
                    <select name="face" class="form-control">
                        <option value="Юридическое">Юридическое лицо</option>
                        <option value="Физическое">Физическое лицо</option>
                    </select>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" class="form-control" name="month" 
                               value="<?php $month = date("m") - 1;
                                    $year = date("Y");
                                    if(10 > $month) {$month = '0'.$month;}
                                    if(0 == $month) {$month = 12; $year--;}
                                    echo $month;
                                    ?>" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" class="form-control" name="year" 
                               value="<?php echo $year;?>" />
                    </div>
                    <br><br>
                    <input type="submit" name="go" value="Распечатать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>