<div class="well text-primary">Редактировать ящик <?php echo $user[0]['Mailbox'];?></div>
<form action="/editmail" method="get">
<table class="table table-bordered text-primary">
    <tr>
        <td style="width: 10%">Название ящика</td>
        <td style="width: 14%">Пароль</td>
        <td style="width: 18%">Адрес</td>
        <td style="width: 15%">Квота</td>
        <td style="width: 20%">Пересылка</td>
        <td style="width: 20%">Виртуальные адрес</td>
        <td style="width: 3%">Активный</td>
    </tr>
    <?php foreach ($user as $value): ?>
        <input type="hidden" name="accountid" value="<?php echo $value['AccountID'];?>" />
        <input type="hidden" name="ischarged" value="<?php echo $value['ischarged'];?>" />
        <input type="hidden" name="MailDirLocation" value="<?php echo $value['MailDirLocation'];?>" />
        <input type="hidden" name="Username" value="<?php echo $value['Username'];?>" />
        <input type="hidden" name="Mailbox" value="<?php echo $value['Mailbox'];?>" />
        <input type="hidden" name="EmailAddress" value="<?php echo $value['EmailAddress'];?>" />
        <tr>
            <td style="width: 7%">
                       <?php echo $value['Mailbox'];?>
            </td>
            <td style="width: 14%">
                <input type="text" name="Password" class="form-control mail_edit_input" 
                       value="<?php echo $value['Password'];?>">
            </td>
            <td style="width: 16%">
                       <?php echo $value['EmailAddress'];?>
            </td>
            <td style="width: 15%">
                <input type="text" name="Quota" class="form-control mail_edit_input" 
                       value="<?php echo $value['Quota'];?>">
            </td>
            <td style="width: 20%">
                <input type="text" name="ForwardAddress" class="form-control mail_edit_input" 
                       value="<?php echo $value['ForwardAddress'];?>">
            </td>
            <td style="width: 25%">
                <?php $vmail = Model::factory('mail')->get_virtual_mail($value['EmailAddress']);
                    foreach ($vmail as $vemail)
                    {?>
                <a href="/editvirtualmail?VirtualID=<?php echo $vemail['VirtualID'];?>">
                            <span class="glyphicon glyphicon-edit text-success"></span>
                        </a>
                <a href="/delvirtualmail?VirtualID=<?php echo $vemail['VirtualID'];?>">
                            <span class="glyphicon glyphicon-remove-sign text-danger"></span>
                        </a>
                        <?php echo $vemail['VirtualAddress'],"<br />";?>
                    <?php }
                ?>
                <a href="/addvirtmail?user_name=<?php echo $value['Username'];?>
&EmailAddress=<?php echo $value['EmailAddress'];?>&AccountID=<?php echo $value['AccountID'];?>" 
                   class="btn btn-success btn-xs">Добавить</a>
                
            </td>
            <td style="width: 3%">
                <input type="text" name="Active" class="form-control mail_edit_input" 
                       value="<?php echo $value['Active'];?>">
            </td>
        </tr>
    <?php endforeach;?>
</table>
<div class="row text-center">
    <input type="submit" name="save" class="btn btn-primary" value="Сохранить" />
</div>
</form>