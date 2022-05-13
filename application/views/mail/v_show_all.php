<div class="well text-primary">Почта абоннента <?php echo $user_name;?></div>
<form action="/usermail" method="get">
    <input type="hidden" name="user_name" value="<?php echo $user_name;?>" />
<table class="table table-bordered text-primary">
    <tr>
        <td style="width: 10%" colspan="3">Название ящика</td>
        <td style="width: 14%">Пароль</td>
        <td style="width: 14%">Адрес</td>
        <td style="width: 10%">Квота</td>
        <td style="width: 20%">Пересылка</td>
        <td style="width: 20%">Виртуальные адрес</td>
        <td style="width: 3%">Активный</td>
    </tr>
    <?php foreach ($user as $value): ?>
        <tr>
            <td style="width: 10%"><?php echo $value['Mailbox'];?></td>
            <td style="width:  4%">
                <a href="/editmail?AccountID=<?php echo $value['AccountID'];?>">
                    <span class="glyphicon glyphicon-edit text-success"></span>
                </a>
            </td>
            <td style="width:  4%">
                <a href="/delmail?AccountID=<?php echo $value['AccountID'];?>">
                    <span class="glyphicon glyphicon-remove-sign text-danger"></span>
                </a>
            </td>
            <td style="width: 14%"><?php echo $value['Password'];?></td>
            <td style="width: 14%"><?php echo $value['EmailAddress'];?></td>
            <td style="width: 10%"><?php echo $value['Quota'];?></td>
            <td style="width: 20%"><?php echo $value['ForwardAddress'];?><br /></td>
            <td style="width: 20%">
                <?php $vmail = Model::factory('mail')->get_virtual_mail($value['EmailAddress']);
                    foreach ($vmail as $vemail)
                    {
                        echo $vemail['VirtualAddress'],"<br />";
                    }
                ?>
            </td>
            <td style="width: 3%"><?php echo $value['Active'];?></td>
        </tr>
    <?php endforeach;?>
</table>
    <div class="row text-center">
        <a href="addmail?user_name=<?php echo $user_name;?>" class="btn btn-primary">Добавить почтовый ящик</a>
    </div>
</form>