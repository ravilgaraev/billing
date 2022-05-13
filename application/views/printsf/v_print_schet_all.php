<div class="panel panel-primary">
    <div class="panel-heading">Выберите тип</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/printallschet" target="blank" method="get">
                    <select name="filter" class="form-control">
                        <option value="">Выберите тип</option>
                        <option value="Bank">Bank</option>
                        <option value="Office">Office</option>
                        <option value="Usd">Usd</option>
                    </select>
                    <select name="filter2" class="form-control">
                        <option value="">Выберите метод доставки</option>
                        <option value="Courier">Курьер</option>
                        <option value="Fax">Факс</option>
                        <option value="Leg">Ноги</option>
                    </select>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" class="form-control" name="month" 
                               value="<?php
                                    $month = date("m")-1;
                                    $year = date("Y");
                                    if(0 == date("m")-1){$month = 12; $year = $year-1;}
                                    if(10 > $month){$month = "0".$month;}
                                    echo $month;
                               ?>" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" class="form-control" name="year" 
                               value="<?php echo $year//date("Y");?>" />
                    </div>
                    <br><br>
                    <input type="submit" name="go" value="Показать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>