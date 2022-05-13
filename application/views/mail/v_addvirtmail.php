<div class="well text-primary">Виртуальный ящик <?php echo $user_name;?></div>
<form action="/addvirtmail" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name;?>" />
    <input type="hidden" name="EmailAddress" value="<?php echo $EmailAddress;?>" />
    <input type="hidden" name="AccountID" value="<?php echo $AccountID;?>" />
    <table class="table table-bordered">
        <tr>
            <td class="text-right text-primary">Название ящика</td>
            <td>
                <input type="text" name="virtmailbox" class="form-control"/>
            </td>
        </tr>
    </table>
<div class="row text-center">
    <input type="submit" name="save" class="btn btn-primary" value="Сохранить" />
</div>
</form>