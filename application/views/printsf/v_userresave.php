<div class="panel panel-primary">
    <div class="panel-heading">Перерасчет абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 ">
                <form action="" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td></td>
                            <td>Имя</td>
                            <td>Дата</td>
                            <td>Наименование услуги</td>
                            <td>Количество</td>
                            <td>Единица</td>
                            <td>Скидка</td>
                            <td>Цена</td>
                            <td>Сумма</td>
                            <td>Язык</td>
                        </tr>
                        <?php foreach ($user as $key => $value):?>
                        <tr>
                            <td>
                                <a href="userrerender?id=<?php echo $value['id'];?>">
                                    <span class="glyphicon glyphicon-edit text-success"></span>
                                </a>
                            </td>
                            <td><?php echo $value['username'];?></td>
                            <td><?php echo $value['date'];?></td>
                            <td><?php echo $value['service'];?></td>
                            <td><?php echo $value['amount'];?></td>
                            <td><?php echo $value['unit'];?></td>
                            <td><?php echo $value['skidka'];?></td>
                            <td><?php echo $value['price'];?></td>
                            <td><?php echo $value['total'];?></td>
                            <td><?php echo $value['lang'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td></td>
                            <td>Имя</td>
                            <td>Дата</td>
                            <td>Сумма</td>
                            <td>Коментарии</td>
                            <td>Флаг</td>
                        </tr>
                        <?php foreach ($account as $key => $acvalue):?>
                        <tr>
                            <td>
                                <a href="useracrender?id=<?php echo $acvalue['id'];?>">
                                    <span class="glyphicon glyphicon-edit text-success"></span>
                                </a>
                            </td>
                            <td><?php echo $acvalue['user'];?></td>
                            <td><?php echo $acvalue['date'];?></td>
                            <td><?php echo $acvalue['sum'];?></td>
                            <td><?php echo $acvalue['cmt'];?></td>
                            <td><?php echo $acvalue['flag'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                    <br>
                    <a href="redata?user=<?php echo $value['username'];?>&date=<?php echo $value['date'];?>" 
                       class="btn btn-primary">Переписать таблицу</a>
                    <br><br>
                    <a href="resf?user=<?php echo $value['username'];?>&date=<?php echo $value['date'];?>&rewrite=true" 
                       class="btn btn-primary">Переписать счет-фактуру</a>
                    <br><br>
<!--                    <a href="resf?user=<?php // echo $value['username'];?>&date=<?php //echo $value['date'];?>&rewrite=false" 
                       class="btn btn-primary">Переписать счет-фактуру, без периода</a>
                    <br><br>-->
                    <a href="newserv?user=<?php echo $value['username'];?>" 
                       class="btn btn-danger">Создать услугу</a>
                </form>
            </div>
        </div>
    </div>
</div>