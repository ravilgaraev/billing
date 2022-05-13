<div class="panel panel-primary">
    <div class="panel-heading">Информация о трафике</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/showtraff" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select><br>
                    С какого числа(YYYY-MM-DD):
                    <input type="text" name="start" value="<?php echo date("Y-m-d");?>" 
                           class="form-control">
                    По какое число(YYYY-MM-DD):
                    <input type="text" name="finish" value="<?php echo date("Y-m-d");?>" 
                           class="form-control">
                    <br><br>
                    <input type="submit" name="go" value="Показать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>