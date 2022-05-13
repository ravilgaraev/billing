<div class="panel panel-primary">
    <div class="panel-heading">Печать счет-фактуры</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form target="/_blank" action="/printsf" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control">
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select>
<!--                <span class="text-primary">
                    С какого числа(YYYY-MM-DD):	
                    <input type="text" name="start" value="<?php // echo date("Y-m");?>" class="form-control">
                </span>-->
                    <br><br>
                    <input type="submit" name="go" value="Распечатать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>