<div class="panel panel-primary">
    <div class="panel-heading">Удаление разовой услуги абоненту</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <form name="delowntime" action="/delonetime" method="get">
                    <select name="id" class="form-control">
                        <option value="">Выберите услугу</option>
                        <?php foreach ($servis as $key => $value):?>
                        <option value="<?php echo $value['id'];?>">
                            <?php echo $value['username']," | ",$value['service']; ?>
                        </option>
                        <?php endforeach;?>
                    </select><br><br>
                    <div class="row text-center">
                        <input class="btn btn-primary" type="submit" name="delet" value="Удалить">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>