<?php $itogo = 0;?>
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
<link href="media/css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style type="text/css">
   @media print{
   .newpage{page-break-before: always;}
   } 
  </style>

</head>
<body style="font-size: 12px; font-family: Consolas">
14px; font-family: Times New Roma
<!--конец заголовка HTML-->

<div class="logo_sf">
    <div class="row">
        <div class="col-xs-5 text-center"><br /><br />OOO "AMALIY ALOQALAR BIZNESI"</div>
        <div class="col-xs-2 text-center"><img src="/media/images/logo_bcc.png" class="img_sf"></div>
        <div class="col-xs-5 text-center"><br /><br />"BUSINESS COMMUNICATION CENTER" LTD</div>
    </div>
    <br />
    <div class="text-center">
        СЧЕТ-ФАКТУРА № <?php echo "IRS-",$nomsf; ?><br>
        от <?php echo $finish; ?><br>
        согласно договора № 
            <?php $date = explode("-", $user['cdate']);
            echo $user['contract']," от ",$date[2].".".$date[1].".".$date[0]; 
            ?><br>
    </div>
    <br>
    <table class="table_schet">
        <tr>
            <td class="odin text-right">Поставщик</td>
            <td class="dva">ООО "Amaliy Aloqalar Biznesi"</td>
            <td class="tri"></td>
            <td class="odin text-right">Получатель</td>
            <td class="dva"><?php echo $user['orgr'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Адрес</td>
            <td class="dva">г.Ташкент, Мирабадский р-н, ул.Шахрисабз, д.16а, 4 этаж</td>
            <td class="tri"></td>
            <td class="odin text-right">Адрес</td>
            <td class="dva"><?php echo $user['address_n'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Телефон</td>
            <td class="dva">252-66-79,252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Телефон</td>
            <td class="dva"><?php echo $user['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Факс</td>
            <td class="dva">252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Факс</td>
            <td class="dva"><?php echo $user['fax'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Р/сч</td>
            <td class="dva">20208000903906693001</td>
            <td class="tri"></td>
            <td class="odin text-right">Р/сч</td>
            <td class="dva"><?php echo $user['account_num'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Банк</td>
            <td class="dva">ГОО НБ ВЭД РУ</td>
            <td class="tri"></td>
            <td class="odin text-right">Банк</td>
            <td class="dva"><?php echo $user['bankdetails'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">МФО</td>
            <td class="dva">00407</td>
            <td class="tri"></td>
            <td class="odin text-right">МФО</td>
            <td class="dva"><?php echo $user['mfo'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">ИНН</td>
            <td class="dva">202606274</td>
            <td class="tri"></td>
            <td class="odin text-right">ИНН</td>
            <td class="dva"><?php echo $user['inn'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">ОКЭД</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">ОКОНХ</td>
            <td class="dva"><?php echo $user['okonx'];?></td>
        </tr>
        <tr>
            <td class="odin text-right"></td>
            <td class="dva"></td>
            <td class="tri"></td>
            <td class="odin text-right">ОКЭД</td>
            <td class="dva"><?php echo $user['oked'];?></td>
        </tr>
    </table>
    <br />
    <br /> 
    <div class="row">
        Регистрационное имя пользователя: <?php echo $user['username'];?>
        <br />
        Период: <?php echo $start," по ",$finish; ?>
    </div>
    <br>
<table class="table table-bordered table_info">
    <tr>
        <td style="width: 50%">Коментарии</td>
        <td>Единица</td>
        <td>Количество</td>
        <td>Цена</td>
        <td>Сумма</td>
    </tr>
<?php foreach ($services as $key => $value) :?>
    <tr>
        <td style="width: 50%"><?php echo $value['service'];?></td>
        <td class="text-right"><?php echo $value['unit'];?></td>
        <td class="text-right"><?php echo $value['amount'];?></td>
        <td class="text-right"><?php echo number_format($value['price'],2,'.',',');?></td>
        <td class="text-right"><?php echo number_format($value['total'],2,'.',',');?></td>
    </tr>
    <?php $itogo += $value['total'];?>
<?php endforeach;?>
    <tr>
        <td>Итого</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><?php echo number_format($itogo,2,'.',','); ?></td>
    </tr>    
</table>
    
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td>Наименование товаров (работ, услуг)</td>
                <td>Ед. изм.</td>
                <td>Кол-во</td>
                <td>Цена</td>
                <td>Сумма</td>
                <td>Ставка АН</td>
                <td>Сумма АН</td>
                <td>Ставка НДС</td>
                <td>Сумма НДС</td>
            </tr>
            <tr>
                <td>Оплата за услуги услуг сети Интернет</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo number_format($itogo,2,'.',','); ?></td>
                <td><?php echo number_format($itogo,2,'.',','); ?></td>
                <td colspan="2" class="text-center">Без АН</td>
                <td colspan="2" class="text-center">Без НДС</td>
            </tr>
            <tr>
                <td colspan="5">Всего оказано услуг (без НДС)</td>
                <td colspan="4"><?php echo number_format($itogo,2,'.',','); ?></td>
            </tr>
        </table>
    </div>
    
    <br />
    <span>Итого оказано услуг на сумму <?php echo number_format($itogo,2,'.',','); ?> Сум</span>
    <br />
    <?php $sum_prop = Model::factory('sumpropis')->num2str($itogo);?>
    <span>(<?php echo $sum_prop;?>) без НДС</span>
    <br />
    <br />
    <div class="row">
        <div class="col-xs-6">
            Директор ___________________<br /><br />
            Главный бухгалтер __________<br /><br />
            М.П.
        </div>
        <div class="col-xs-6">
            Получил ____________________<br />
            (подпись покупателя или уполномоченного представителя)<br />
            По доверенности № ___ от ____________<br />
            ______________________________________<br />
                   (ФИО получателя)
        </div>
    </div>
</div> <!--  конец главного дива-->
<br />
<br />

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="media/js/bootstrap.min.js"></script> 

<div class="newpage"></div>
</body>
</html>