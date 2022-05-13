<div class="panel panel-primary">
    <div class="panel-heading">Внесение услуги абоненту</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form name="services" action="/enterservices" method="get">
                    <input type="text" name="user_name_text" class="form-control" >
                    <select name="user_name" class="form-control">
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select><br><br>
                    <select name="service" class="form-control">
                        <option value="">Выберите услугу</option>
                        <?php foreach ($services as $key => $value):?>
                        <option value="<?php echo $value['id'];?>">
                            <?php echo $value['service']," | ",$value['price']; ?></option>
                        <?php endforeach;?>
                    </select>
                    <br>
                    <br>
                    <div class="row text-center">
                        <input class="btn btn-primary" type="submit" name="save" value="Сохранить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>