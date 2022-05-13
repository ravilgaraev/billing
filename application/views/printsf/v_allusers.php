<div class="panel panel-primary">
    <div class="panel-heading">Счет фактура абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/printusersf" target="blank" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control">
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>">
                            <?php echo $value['username']; ?>
                        </option>
                        <?php endforeach;?>
                    </select>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        
<!--                        <input type="text" class="form-control" name="month" 
                               value="<?php $month = date("m") - 1;
                                    $year = date("Y");
                                    if(10 > $month) {$month = '0'.$month;}
                                    if(0 == $month) {$month = 12; $year--;}
                                    //echo $month;
                                    ?>" />-->
                                    <select name="month" class="form-control">
                                        <?php for($i=1; $i<13; $i++):?>
                                        <option value="<?php echo 10>$i ? '0'.$i : $i; ?>"
                                                <?php echo $month == $i ? "selected" : ""; ?>
                                                >
                                            <?php echo 10>$i ? '0'.$i : $i; ?>
                                        </option>
                                        <?php endfor;?>
                                    </select>
                        
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                            <select name="year" class="form-control">
                                <?php for($i=2019; $i<=$year; $i++):?>
                                <option value="<?php echo $i; ?>"
                                        <?php echo $year == $i ? "selected" : ""; ?>
                                        >
                                    <?php echo $i; ?>
                                </option>
                                <?php endfor;?>
                            </select>
<!--                        <input type="text" class="form-control" name="year" 
                               value="<?php// echo $year;?>" />-->
                    </div>
                    <br><br>
                    <input type="submit" name="go" value="Распечатать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>