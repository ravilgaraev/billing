<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv = "cache-control" content = "no-cache">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Биллинг</title>

<!-- Bootstrap -->
<link href="media/css/bootstrap.min.css" rel="stylesheet">
<link href="media/css/style.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
        <div class="row">
            <div class="col-lg-3">
                <a href="/"><h1 class="text-center"><img src="media/images/bcc_logo.png" class="logo"></h1></a>
            </div>
            <div class="col-lg-6">
                
                <h1 class="text-center text-primary">Вы зашли как 
                    <?php echo Cookie::get('user'); ?>
                </h1>
            </div>
            <div class="col-lg-3">
                <a href="/"><h1 class="text-center"><img src="media/images/telecomX1.png" class="logo"></h1></a>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-12">
            <?php echo $content;?> 
        </div>
    </div>
    <div class="footer text-center">
        <div class="row">
            <a href="/userinfo">Абоненты | </a>
            <a href="/prepade">Предоплата | </a>
            <a href="/printschet">Выписать счет | </a>
            <a href="/usersschet">Выписанные счета Абонента | </a>
            <!--<a href="/newschet">Новый счет Абоненту | </a>-->
            <a href="/findschet">Поиск Абонента по счетам | </a>
            <a href="/edituser">Редактировать Данные Абонента | </a>
        </div>
        <div class="row">
            <a href="/enterpay">Внести оплату | </a>
            <a href="/changedatepay">Изменить дату оплаты | </a>
            <?php if('admin' == Cookie::get('role') || 'many' == Cookie::get('role'))
            {
                echo '<a href="/delpay">Удалить оплату | </a>';
            }; ?>
            <a href="/schetmany">Внесенные оплаты | </a>
            <!--<a href="/manydate">Отчет по оплатам | </a>-->
            <a href="/usersf">Счет-фактура абонента | </a>
            <a href="/dolshniki">Должники | </a>
            <a href="/sverka">Акт сверки</a>
        </div>
        <div class="row">
            <a href="/newuser">Новый абонент | </a>
            <?php if('admin' == Cookie::get('role'))
            {
                echo '<a href="/deluser">Удалить абонента | </a>';
            }; ?>
            
            <a href="/finduser">Поиск абонента | </a>
            <a href="/showtraff">Показать трафик | </a>
            <a href="/services">Дополнительные услуги | </a>
            <a href="/show">Пароль для статистики | </a>
            <a href="/didox">ЭСФ | </a>
            <a href="/renderall">Генерация счетов | </a>
        </div>
        <div class="row">
            <a href="/scan">Логи по сотрудникам | </a>
            <a href="/scanuser">Логи по абонентам | </a>
            <a href="/deluserinfo">Удаленные абоненты | </a>
            <a href="/userpre">Перерасчет по услугам абонента | </a>
            <a href="/allusers">Все абоненты | </a>
            <a href="/showmail">Почтовые ящики | </a>
            <a href="/regip">История IP</a>
        </div>
        <div class="row">
            <a href="/createotchet">Бухгалтерский отчет | </a>
            <a href="/nalotchet">Налоговый отчет | </a>
            <a href="/createschetfakturi">Генерация счет-фактур | </a>
            <a href="/printsavesf">Счет-фактуры за отчетный период | </a>
            <a href="/printschetall">Счета | </a>
            <a href="/cashschet">Счет на оплату в кассу | </a>
            <a href="http://ticket.bcc.uz?luser=<?php echo Cookie::get('user'); ?>" target="_blank" > Тикет |</a>
            <a href="/techinfo">Тех. Инфо</a>
        </div>
                
                
                <!--<a href="/checkusername">Новый абонент | </a>-->
                
                <!--<a href="/enterservices">Внесение дополнительной услуги | </a>-->
                <!--<a href="/onetime">Внесение разовой услуги | </a>-->
                <!--<a href="/delservices">Удаление дополнительной услуги | </a>-->
                <!--<a href="/delonetime">Удаление разовой услуги | </a>-->
                
                
        <div class="go-up" title="Вверх" id='ToTop' style="display: block;">
            <span class="glyphicon glyphicon-arrow-up"></span>
        </div>
        <div class="go-down" title="Вниз" id='OnBottom' style="display: block;">
            <span class="glyphicon glyphicon-arrow-down"> </span>
        </div>
    </div>
 

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/media/js/bootstrap.js"></script>

<!— Start: Кнопки вверх вниз —>
<script type="text/javascript">
jQuery(function(){
if ($(window).scrollTop()>="250") $("#ToTop").fadeIn("slow")
$(window).scroll(function(){
if ($(window).scrollTop()<="250") $("#ToTop").fadeOut("slow")
else $("#ToTop").fadeIn("slow")
});
if ($(window).scrollTop()<=$(document).height()-"999") $("#OnBottom").fadeIn("slow")
$(window).scroll(function(){
if ($(window).scrollTop()>=$(document).height()-"999") $("#OnBottom").fadeOut("slow")
else $("#OnBottom").fadeIn("slow")
});
$("#ToTop").click(function(){$("html,body").animate({scrollTop:0},"slow")})
$("#OnBottom").click(function(){$("html,body").animate({scrollTop:$(document).height()},"slow")})
});
</script>
<div class="go-up" title="Вверх" id='ToTop'>?</div>
<div class="go-down" title="Вниз" id='OnBottom'>?</div>
<!— End: Кнопки вверх вниз —>
<script src="/media/js/scroll-startstop.events.jquery.js" type="text/javascript"></script>


</body>
</html>