<div class="panel panel-primary">
    <div class="panel-heading">СЧЕТ НА ОПЛАТУ</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/showschet" target="blank" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="text" name="comment" class="form-control" placeholder="Комментарии">
                    <input type="text" name="com" class="form-control" placeholder="Другие комментарии">
                    <input type="text" name="many" class="form-control" placeholder="Сумма">
                    <input type="text" name="col" class="form-control" value="1">
                    <br><br>
                    <input type="submit" name="go" value="Напечатать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>