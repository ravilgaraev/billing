<div class="panel panel-primary">
    <div class="panel-heading">История IP</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/regip" method="post">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control" >
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select>
                    
                    <br><br>
                    <input type="submit" name="go" value="Выбрать" class="btn btn-primary">
                    <br><br>
                    <input type="text" name="ip" class="form-control" placeholder="IP адрес">
                    <br>
                    <input type="submit" name="goip" value="Выбрать" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
