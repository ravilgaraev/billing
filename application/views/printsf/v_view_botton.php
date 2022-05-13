<div class="panel panel-primary">
    <div class="panel-heading">Генерация счет-фактур</div>
    <div class="panel-body">
        <form action="/renderchetfakturi" method="get">
            <div class="row text-center">
                <h2 class="text-danger">Сгенерировать счет-фактуры
                </h2>
                <div class="col-lg-4 col-lg-offset-4 input-group">
                    <span class="input-group-addon"><span>Месяц</span></span>
                    <input type="text" class="form-control" name="month" 
                           value="<?php
                           $month = date("m")-1;
                            if(0 == date("m")-1){$month = 1;}
                            if(10 > $month){$month = "0".$month;}
                            echo $month;
                            ?>" />
                </div>
                <div class="col-lg-4 col-lg-offset-4 input-group">
                    <span class="input-group-addon"><span>Год</span></span>
                    <input type="text" class="form-control" name="year" 
                           value="<?php echo date("Y");?>" />
                </div>
            <br />
            <br />
                    <input type="submit" name="go" value="Создать" class="btn btn-primary">
            </div> 
        </form>
    </div>
</div>
