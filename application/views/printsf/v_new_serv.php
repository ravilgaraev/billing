<div class="panel panel-primary">
    <div class="panel-heading">Создать услугу</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 ">
                <form action="/savenewserv" method="post">
                    <table class="table table-bordered">
                        <tr>
                            <td>Абонент</td>
                            <td>
                                <span><?php echo $user; ?></span>
                                <input type="hidden" name="user" value="<?php echo $user; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>Дата</td>
                            <td>
                                <span><?php// echo $value['date'];?></span>
                                <input type="text" name="date" value="" class="form-control" placeholder="день-месяц-год" />
                            </td>
                        </tr>
                        <tr>
                            <td>Сумма</td>
                            <td>
                                <input type="text" name="sum" value="" class="form-control">
                        </tr>
                        <tr>
                            <td>Коментарии</td>
                            <td><input type="text" name="cmt" value="" class="form-control"></td>
                        </tr>
                    </table>
                    <br>
                    <input type="submit" name="save" value="Сохранить" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>