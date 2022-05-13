<div class="panel panel-primary">
    <div class="panel-heading">Перерасчет абонента</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 ">
                <form action="/savererender" method="post">
                    <table class="table table-bordered">
                        <?php foreach ($user as $key => $value):?>
                        <tr>
                            <td colspan="2"><span><?php echo $value['id'];?></span>
                                <input type="hidden" name="id" value="<?php echo $value['id'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><span><?php echo $value['username'];?></span>
                                <input type="hidden" name="username" value="<?php echo $value['username'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span><?php echo $value['date'];?></span>
                                <input type="hidden" name="date" value="<?php echo $value['date'];?>" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea rows="3" cols="45" name="coment" 
                                    class="form-control"><?php echo $value['service'];?></textarea>
                        </tr>
                        <tr>
                            <td>Кол-во</td>
                            <td><input type="text" name="amount" 
                                       value="<?php echo $value['amount'];?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Единицы </td>
                            <td><input type="text" name="unit" 
                                       value="<?php echo $value['unit'];?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Скидка</td>
                            <td><input type="text" name="skidka" 
                                       value="<?php echo $value['skidka'];?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Цена</td>
                            <td><input type="text" name="price" 
                                       value="<?php echo $value['price'];?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Сумма</td>
                            <td><input type="text" name="total" 
                                       value="<?php echo $value['total'];?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td>Язык</td>
                            <td><span><?php echo $value['lang'];?></span></td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                    <br>
                    <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
                    <br><br>
                    <input type="submit" name="del" value="Удалить" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>