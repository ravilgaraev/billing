<div class="panel panel-primary">
    <div class="panel-heading">Генерация счетов на оплату</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/renderschet" method="post" target="blank">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="exampleRadios1" value="Yes" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Предоплата
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="exampleRadios2" value="No">
                        <label class="form-check-label" for="exampleRadios2">
                          По факту
                        </label>
                    </div>
                    <br>
                    <input type="submit" name="go" value="Распечатать" class="btn btn-primary">
                    <br><br><br>
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
                               value="<?php echo date("Y");?>" />
                    </div>
                    <br>
                    <input type="submit" name="show" value="Показать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>