<div class="panel panel-primary">
    <div class="panel-heading">История IP</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                
                    
                    <div class="row text-center">
                        Абонент: <strong><?php echo $user[0]['orgr']; ?></strong>
                    </div>
                    <br>
                    <table class="table table-bordered">
                        <?php foreach ($story as $key => $value) : ?>
                        <form action="/regip" name="<?php echo $key; ?>" method="post">
                            <input type="hidden" name="username" value="<?php echo $user[0]['username']; ?>">
                            <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                            <tr>
                                <td>IP адрес</td>
                                <td>
                                    <?php echo $value['ip']; ?>
                                </td>
                                <td>Дата выдачи</td>
                                <td><?php echo $value['cdate']; ?></td>
                                <td>Дата изъятия</td>
                                <td>
                                    <?php if('0000-00-00' == $value['ddate']): ?>
                                        <input type="text" name="ddate" value="<?php echo date('d-m-Y') ?>" class="form-control">
                                        </td>
                                        <td>
                                            <input type="submit" name="close" value="Закрыть" class="btn btn-danger">
                                        </td>
                                    <?php else :?>
                                        <?php $date = explode('-', $value['ddate']); echo $date[2].'-'.$date[1].'-'.$date[0]; ?>
                                        </td><td></td>
                                    <?php endif; ?>
                            </tr>
                        </form>
                        <?php endforeach; ?>
                    </table>
                <form action="/regip" name="save" method="post">
                    <input type="hidden" name="username" value="<?php echo $user[0]['username']; ?>">
                    <table class="table table-bordered">
                        <tr>
                            <td>IP адрес</td>
                            <td><input type="text" name="ip" value="" class="form-control"></td>
                            <td>Дата выдачи</td>
                            <td><input type="text" name="cdate" value="<?php echo date('d-m-Y') ?>" class="form-control"></td>
                            <td><input type="submit" name="save" value="Выдать" class="btn btn-primary"></td>
                        </tr>
                    </table>
                    <br><br>
                    
                </form>
            </div>
        </div>
    </div>
</div>
