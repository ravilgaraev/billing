<div class="panel panel-primary">
    <div class="panel-heading">Пароль для личного кабинета:  <?php echo $user;?></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/edit" method="get">
                    <?php if(!isset($passwd)) {
                        echo "Нет пароля для этого абонента!";
                    }echo $passwd;?>
                    <input type="hidden" name="username" 
                           value="<?php echo $user; ?>" />
                    <br>
                    <br>
                    <input type="text" name="password" class="form-control" 
                           placeholder="Новый пароль"/>
                    <br>
                    <input type="submit" name="change" value="Изменить"
                           class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>