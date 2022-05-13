<div class="panel panel-primary">
    <div class="panel-heading">Создание услуги</div>
    <div class="panel-body">
        <form name="services" action="/services" method="get">
            <div class="row">
                <div class="col-lg-3 text-right"> Наименование услуги </div>
                <div class="col-lg-9">
                    <input type="text" name="service" class="form-control">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 text-right"> Цена услуги</div>
                <div class="col-lg-9">
                    <input type="text" name="price" class="form-control">
                </div>
            </div>
            <br>
            <br>
            <div class="row text-center">
                <input class="btn btn-primary" type="submit" name="save" value="Сохранить">
            </div>
            <br><br>
            <table class="table table-bordered text-info">
                <?php foreach ($services as $key => $value):?>
                <tr>
                    <td><?php echo $value['service'];?></td>
                    <td><?php echo $value['price'];?></td>
                    <td>
                        <a href="/services?id=<?php echo $value['id'];?>" 
                           class="btn btn-danger btn-sm">Удалить</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </form>
    </div>
</div>
