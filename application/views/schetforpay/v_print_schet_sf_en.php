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

<style type="text/css">
   @media print{
   .newpage{page-break-before: always;}
   } 
  </style>

<body style="font-size: 12px; font-family: Consolas"> 


<!--конец заголовка HTML-->
<!--*-->

<div class="logo_sf">
    <div class="row">
        <div class="text-center">
            <div class="col-xs-2">
                <img src="/media/images/bcc_logo.png" class="img_sf">
            </div>
            <div class="col-xs-8 header_sf">
            INVOICE № <?php echo "IP-",$nomschet; ?>
            dated <?php echo date("d.m.Y"); ?><br>
            according to the Contract № 
            <?php $date = explode("-", $user[0]['cdate']);
            echo $user[0]['contract']," dated ",$date[2].".".$date[1].".".$date[0]; 
            ?><br>
            </div>
        </div>
    </div>
    <br />
    <table class="table_schet">
        <tr>
            <td class="odin text-right">Supplier:</td>
            <td class="dva">"Amaliy Aloqalar Biznesi" LLC</td>
            <td class="tri"></td>
            <td class="odin text-right">Subscriber:</td>
            <td class="dva"><?php echo $user[0]['orgr'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Address:</td>
            <td class="dva">Tashkent, Mirabad District, Shakhrisabz Str, 16a, 4th floor</td>
            <td class="tri"></td>
            <td class="odin text-right">Address:</td>
            <td class="dva"><?php echo $user[0]['address_n'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Account №</td>
            <td class="dva">
                <?php
                    switch ($user[0]['paymentmethod']) {
                        case 'Usd':echo '20208840103906693001';break;
                        case 'Euro':echo '20208978503906693001';break;
                        default:echo '20208000903906693001';break;
                    }
                ?>
            </td>
            <td class="tri"></td>
            <td class="odin text-right">Account №</td>
            <td class="dva"><?php echo $user[0]['account_num'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Bank:</td>
            <td class="dva">MOB NB FEA RUz</td>
            <td class="tri"></td>
            <td class="odin text-right">Bank:</td>
            <td class="dva"><?php echo $user[0]['bankdetails'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Bank Code:</td>
            <td class="dva">00407</td>
            <td class="tri"></td>
            <td class="odin text-right">Bank Code:</td>
            <td class="dva"><?php echo $user[0]['mfo'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">TAX ID:</td>
            <td class="dva">202606274</td>
            <td class="tri"></td>
            <td class="odin text-right">TAX ID:</td>
            <td class="dva"><?php echo $user[0]['inn'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">OKED</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">OKED</td>
            <td class="dva"><?php echo $user[0]['oked'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Tel:</td>
            <td class="dva">71 252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Tel:</td>
            <td class="dva"><?php echo $user[0]['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Fax:</td>
            <td class="dva">71 252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Fax:</td>
            <td class="dva"><?php echo $user[0]['fax'];?></td>
        </tr>
    </table>
    
    <div class="row">
        Order ID: <?php echo $user[0]['orderid'];?>
        <br />
        User registration name: <?php echo $user[0]['username'];?>
    </div>
    <div class="row">
        <table style="width: 100%" class="table-print">
            <tr class="text-center">
                <td>№</td>
                <td>Services</td>
                <td>Debit</td>
                <td>Credit</td>
            </tr>
            <tr>
                <td class="text-center">1</td>
                <td class="comment">Balance <?php echo $datebefo; ?></td>
                <?php if(0 > $many) {$many *= -1;};?>
                <?php if(0 < $topay): ?>
                    <td class="text-right sf"><?php echo number_format($many,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($many,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="text-center">2</td>
                <td class="comment">Prepayment for <?php echo $month; ?></td>
                <?php if(0 < $topay): ?>
                    <td class="text-right sf"><?php echo number_format($price,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($price,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="text-center">3</td>
                <td class="comment">To be paid </td>
                <?php if(0 < $topay): ?>
                    <td class="text-right sf"><?php echo number_format($topay,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($topay,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td class="text-center">4</td>
                <td class="comment">Including VAT</td>
                <?php if(0 < $topay): ?>
                    <td class="text-right sf"><?php echo number_format($nds,2,'.',','); ?></td>
                    <td></td>
                <?php else : ?>
                    <td></td>
                    <td class="text-right sf"><?php echo number_format($nds,2,'.',','); ?></td>
                <?php endif; ?>
            </tr>
            <tr>
                <td colspan="4" class="text-center">
                    <?php echo $sum_prop = Model::factory('sumpropis')->num2stren($topay);?>
                </td>
            </tr>
        </table>
    </div>
    <br />
    <div class="row">
        <div class="col-xs-6">
            Director ___________________<br /><br />
            Chief Accountant __________<br /><br />
            Stamp
        </div>
        <div class="col-xs-6">
            Received ____________________________<br />
            (signature of Subscriber or representative)<br />
            
            ______________________________________<br />
                       (Name/Title)
        </div>
    </div>
</div> 

<!--  конец главного дива-->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="media/js/bootstrap.min.js"></script> 

<div class="newpage"></div>
</body>
</html>