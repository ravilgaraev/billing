<p class="text-primary">Почта абоннента <?php echo $vmail[0]['Username'];?></p>
<form action="/delvirtualmail" method="get">
    <input type="hidden" name="VirtualID" value="<?php echo $vmail[0]['VirtualID'];?>" />
    <input type="hidden" name="Username" value="<?php echo $vmail[0]['Username'];?>" />
    <input type="hidden" name="VirtualAddress" value="<?php echo $vmail[0]['VirtualAddress'];?>" />
    <h4 class="bg-danger text-danger" style="padding: 15px;">Удалить виртуальный почтовый ящик 
        <?php echo $vmail[0]['VirtualAddress'];?>?</h4>
    <div class="row text-center">
        <input type="submit" name="save" class="btn btn-primary" value="Удалить" />
    </div>
</form>