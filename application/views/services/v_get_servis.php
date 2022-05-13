<div class="panel panel-primary">
    <div class="panel-heading">Информация абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form action="/onetime" method="get">
                    <input type="text" name="user_name_text" class="form-control" placeholder="Имя абонента">
                    <select name="user_name" class="form-control">
                        <option value="">Выберите абонента</option>
                        <?php foreach ($users as $key => $value):?>
                        <option value="<?php echo $value['username'];?>"><?php echo $value['username']; ?></option>
                        <?php endforeach;?>
                    </select>
                    <input type="text" name="service" class="form-control" placeholder="Услуга" />
                    <input type="text" name="price" class="form-control" placeholder="Цена"/>
                    <input type="text" name="data" class="form-control" value="<?php 
                            $data = getdate();
                            echo $data['mday']."-".$data['mon']."-".$data['year'];
                        ?>"
                    />
                    <br><br>
                    <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>