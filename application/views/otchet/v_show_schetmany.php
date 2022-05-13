<div class="panel panel-primary">
    <div class="panel-heading">Внесенные оплаты</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/schetmany" method="post">
                    <select class="form-control" name="type">
                        <option value="Bank">BANK</option>
                        <option value="Usd">USD</option>
                        <option value="Euro">EURO</option>
                        <option value="Office">Office</option>
                        <!--<option value="All">All</option>-->
                    </select>
                    <select class="form-control" name="pay">
                        <option value="Yes">По предоплате</option>
                        <option value="No">По факту</option>
                        <option value="All">Все</option>
                    </select>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon"><span>День</span></span>
                        <input type="text" name="day" value="<?php echo date('d') ?>" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Месяц</span></span>
                        <input type="text" name="month" value="<?php echo date('m') ?>" class="form-control">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><span>Год</span></span>
                        <input type="text" name="year" value="<?php echo date('Y') ?>" class="form-control">
                    </div>
                    <br><br>
                    <input type="submit" name="go" value="Показать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
