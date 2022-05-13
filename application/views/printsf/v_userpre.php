<div class="panel panel-primary">
    <div class="panel-heading">Перерасчет абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/userpre" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control">
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>">
                            <?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" class="form-control" name="month" 
                               value="<?php
                               $month = date("m")-1;
                                if(0 == date("m")-1){$month = 1;}
                                if(10 > $month){$month = "0".$month;}
                                echo $month;
                                ?>" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" class="form-control" name="year" 
                               value="<?php
                                           if(0 == date("m")-1) {echo date("Y")-1;}
                                           else {echo date("Y");}

                                       ?>" />
                    </div>
<!--                <span class="text-primary">
                    С какого числа(YYYY-MM-DD):	
                    <input type="text" name="start" value="<?php // echo date("Y-m");?>" class="form-control">
                </span>-->
                    <br><br>
                    <input type="submit" name="go" value="Выбрать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>