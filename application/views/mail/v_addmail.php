<p class="text-primary">Почта абоннента <?php echo $user;?></p>
<form action="/addmail" method="get">
    <input type="hidden" name="Username" value="<?php echo $user;?>" />
    <table class="table table-bordered">
        <tr>
            <td class="text-right text-primary">Название ящика</td>
            <td>
                <input type="text" name="mailbox" class="form-control"/>
            </td>
        </tr>
        <tr>
            <td class="text-right text-primary">Пароль</td>
            <td>
                <input type="text" name="passwd" class="form-control"/>
            </td>
        </tr>
        <tr>
            <td class="text-right text-primary">Квота</td>
            <td>
                <input type="text" name="quota" class="form-control" value="10485760"/>
            </td>
        </tr>
    </table>
<div class="row text-center">
    <input type="submit" name="save" class="btn btn-primary" value="Сохранить" />
</div>
</form>