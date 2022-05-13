<div class="panel panel-primary">
    <div class="panel-heading">Создание месячного отчета</div>
    <div class="panel-body">
        <form action="nalogotchet" target="blank" method="get">
            <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" class="form-control" name="month" 
                               value="<?php 
                                $date = date("m")-1;
                                if(0 == $date){$date = 12;}
                                if(10 > $date){$date = "0".$date;}
                                echo $date;
                                    ?>" />
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" class="form-control" name="god" 
                               value="<?php
                                    if(0 == date("m")-1)
                                    {echo date("Y")-1;}
                                    else{echo date("Y");}
                                   ?>" />
                    </div>
                    <select class="form-control" name="type">
                        <option value="Bank">Bank</option>
                        <option value="Usd">Usd</option>
                        <option value="Euro">Euro</option>
                        <option value="Office">Office</option>
                    </select>
                    <select class="form-control" name="urfiz">
                        <option value="Юридическое">Юридические</option>
                        <option value="Физическое">Физические</option>
                    </select>
                    <br />
                    <br />
                </div>
            </div>
            <div class="row text-center">
                <input type="submit" name="go" value="Создать" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
