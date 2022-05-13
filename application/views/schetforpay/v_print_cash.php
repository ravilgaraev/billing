<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Биллинг</title>

<!-- Bootstrap -->
<link href="media/css/bootstrap.min.css" rel="stylesheet">
<!--<link href="media/css/style.css" rel="stylesheet">-->

</head>
<body style="font-size: 14px; font-family: Times New Roman">

<!--конец заголовка HTML-->
<div>
    <br><br>
    <table class="table table-bordered">
        <tr>
            <td>
                <br><br>
                ИЗВЕЩЕНИЕ
                <br><br><br><br><br><br><br>
                Кассир
            </td>
            <td>
                Получатель: ООО "Amaliy Aloqalar Biznesi"  ИНН 202606274<br>
                Учреждение банка: ГОО НБ ВЭД РУз, МФО 00407<br>
                Счет получателя: 20208000903906693001<br>
                Плательщик: <?php echo $user[0]["orgr"]," (",$user[0]["username"],")"; ?><br>
                Адрес: <?php echo $user[0]["address_n"];?><br>
                <table class="table table-bordered text-center">
                    <tr>
                        <td>Вид платежа</td>
                        <td>Дата</td>
                        <td>Сумма</td>
                    </tr>
                    <tr>
                        <td>Услуги доступа к сети Интернет</td>
                        <td><?php echo $day,".",$month,".",$year; ?></td>
                        <td><?php echo $many; ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">ПЛАТЕЛЬЩИК</td>
                        <td class="text-rigth">ВСЕГО</td>
                        <td><?php echo $many; ?></td>
                    </tr>
                </table>
                <br><br><br>
            </td>
        </tr>
        <tr>
            <td>
                <br><br><br><br>
                КВИТАНЦИЯ
                <br><br><br><br><br><br><br>
                Кассир
            </td>
            <td>
                <br><br>
                Получатель: ООО "Amaliy Aloqalar Biznesi"  ИНН 202606274<br>
                Учреждение банка: ГОО НБ ВЭД РУз, МФО 00407<br>
                Счет получателя: 20208000903906693001<br>
                Плательщик: <?php echo $user[0]["orgr"]," ",$user[0]["username"]; ?><br>
                Адрес: <?php echo $user[0]["address_n"];?><br>
                <table class="table table-bordered text-center">
                    <tr>
                        <td>Вид платежа</td>
                        <td>Дата</td>
                        <td>Сумма</td>
                    </tr>
                    <tr>
                        <td>Услуги доступа к сети Интернет</td>
                        <td><?php echo $day,".",$month,".",$year; ?></td>
                        <td><?php echo $many; ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">ПЛАТЕЛЬЩИК</td>
                        <td class="text-rigth">ВСЕГО</td>
                        <td><?php echo $many; ?></td>
                    </tr>
                </table>
                <br><br>
            </td>
        </tr>
        <tr>
            <td>
                <br><br><br><br>
                КВИТАНЦИЯ
                <br><br><br><br><br><br><br>
                Кассир
            </td>
            <td>
                <br><br>
                Получатель: ООО "Amaliy Aloqalar Biznesi"  ИНН 202606274<br>
                Учреждение банка: ГОО НБ ВЭД РУз, МФО 00407<br>
                Счет получателя: 20208000903906693001<br>
                Плательщик: <?php echo $user[0]["orgr"]," ",$user[0]["username"]; ?><br>
                Адрес: <?php echo $user[0]["address_n"];?><br>
                <table class="table table-bordered text-center">
                    <tr>
                        <td>Вид платежа</td>
                        <td>Дата</td>
                        <td>Сумма</td>
                    </tr>
                    <tr>
                        <td>Услуги доступа к сети Интернет</td>
                        <td><?php echo $day,".",$month,".",$year; ?></td>
                        <td><?php echo $many; ?></td>
                    </tr>
                    <tr>
                        <td class="text-left">ПЛАТЕЛЬЩИК</td>
                        <td class="text-rigth">ВСЕГО</td>
                        <td><?php echo $many; ?></td>
                    </tr>
                </table>
                <br><br>
            </td>
        </tr>
    </table>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="media/js/bootstrap.min.js"></script> 

</body>
</html>