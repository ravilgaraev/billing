<p class="text-primary">Почта абоннента <?php echo $user[0]['Username'];?></p>
<form action="/delmail" method="get">
    <input type="hidden" name="AccountID" value="<?php echo $user[0]['AccountID'];?>" />
    <h4 class="bg-danger text-danger" style="padding: 15px;">Удалить почтовый ящик <?php echo $user[0]['Mailbox'];?>?</h4>
    <div class="row text-center">
        <input type="submit" name="save" class="btn btn-primary" value="Удалить" />
    </div>
</form>