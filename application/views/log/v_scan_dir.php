<form action="log" method="get">
    <table class="table table-boder">
    <?php foreach ($dir as $value):?>
        <?php if(('.'==$value)||('..'==$value)){continue;};?>
        <tr>
            <td>
                <a href="/logi?pr=<?php echo $value;?>"><?php echo $value;?></a>
            </td>
        </tr>
    <?php endforeach;?>
    </table>
</form>