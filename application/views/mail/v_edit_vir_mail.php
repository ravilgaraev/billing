<p class="text-primary">Виртуальная почта абоннента <?php echo $vmail[0]['Username'];?></p>
<form action="/editvirtualmail" method="get">
<table class="table table-bordered text-primary">
    <tr>
        <td style="width: 10%">Абоннент</td>
        <td style="width: 14%">Виртуальный адрес</td>
        <td style="width: 18%">Реальный адрес</td>
        <td style="width: 15%">Активность</td>
    </tr>
    <?php foreach ($vmail as $value): ?>
        <input type="hidden" name="VirtualID" value="<?php echo $value['VirtualID'];?>" />
        <input type="hidden" name="Username" value="<?php echo $value['Username'];?>" />
        <input type="hidden" name="EmailAddress" value="<?php echo $value['EmailAddress'];?>" />
        <input type="hidden" name="Active" value="<?php echo $value['Active'];?>" />
        <tr>
            <td style="width: 7%">
                       <?php echo $value['Username'];?>
            </td>
            <td style="width: 14%">
                <input type="text" name="VirtualAddress" class="form-control mail_edit_input" 
                       value="<?php echo $value['VirtualAddress'];?>">
            </td>
            <td style="width: 16%">
                       <?php echo $value['EmailAddress'];?>
            </td>
            <td style="width: 3%">
                       <?php echo $value['Active'];?>
            </td>
        </tr>
    <?php endforeach;?>
</table>
<div class="row text-center">
    <input type="submit" name="save" class="btn btn-primary" value="Сохранить" />
</div>
</form>