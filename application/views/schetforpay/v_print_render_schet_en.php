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
<!--[if lt IE 9]
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
    <table>
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
            <td class="odin text-right">PRN VAT</td>
            <td class="dva">326010019003</td>
            <td class="tri"></td>
            <td class="odin text-right">PRN VAT</td>
            <td class="dva"><?php echo $user['rkpnds'];?></td>
        </tr>
        <?php if('Usd' == $user[0]['paymentmethod'] || 'Euro' == $user[0]['paymentmethod']) :?>
        <tr>
            <td class="odin text-right">SWIFT</td>
            <td class="dva">NBFAUZ2X</td>
            <td class="tri"></td>
            <td class="odin text-right">SWIFT</td>
            <td class="dva"><?php echo $user[0]['swift'];?></td>
        </tr>
        <?php endif; ?>        
        <tr>
            <td class="odin text-right">Tel:</td>
            <td class="dva">998 71 252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Tel:</td>
            <td class="dva"><?php echo $user[0]['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Fax:</td>
            <td class="dva">998 71 252-70-88</td>
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
    <?php $stavkands = ('n' == $user[0]['nds']) ? $stavkands = 0 : $stavkands = $user[0]['stavkands']; ?>
    <div class="row">
        <table style="width: 100%" class=" table table-print">
            <tr>
                <td rowspan="2">Description (goods, services)</td>
                <td rowspan="2">Ammount</td>
                <td rowspan="2">Quantity</td>
                <td rowspan="2">Price</td>
                <td rowspan="2">Sum</td>
                <!--<td class="text-center">Ставка АН</td>
                <td class="text-center">Сумма АН</td>-->
                <td  colspan="2" class="text-center">VAT</td>
                <?php echo ('n' == $user[0]["nds"])?"<td rowspan=\"2\" class=\"text-center\">Total price without VAT</td>":
                    "<td rowspan=\"2\" class=\"text-center\">Total price including VAT</td>"; ?>
            </tr>
            <tr class="text-center">
                <td>VAT rate</td>
                <td>Sum</td>
            </tr>
            <tr>
                <td>Payment for Internet Services <?php echo $comment; ?>  </td>
                <td>month</td>
                <td><?php echo $col; ?></td>
                <td><?php echo number_format($many*100/($stavkands+100),2,'.',','); ?></td>
                <td>
                    <?php $many*=$col; echo number_format($many*100/($stavkands+100),2,'.',','); ?>
                </td>
                <!--<td colspan="2" class="text-center">Без АН</td>-->
                <td class="text-right"><?php echo ('n' == $user[0]["nds"])?"Without VAT":$stavkands; ?></td>
                <td class="text-right">
                    <?php echo ('n' == $user[0]["nds"])?"Without VAT":number_format($many - $many*100/($stavkands+100),2,'.',','); ?>
                </td>
                <td class="text-right"><?php echo number_format($many,2,'.',','); ?></td>
            </tr>
            <tr>
                <td>Total to be paid<?php echo ('n' == $user[0]["nds"])?" Without VAT":" including VAT"; ?></td>
                <td class="text-right" colspan="9"><?php echo number_format($many,2,'.',','); ?></td>
            </tr>
            <tr> 
                <td class="text-center" colspan="10">
                    <?php 
                        if (("ru" == $user[0]['language'])||("Ru" == $user[0]['language']))
                        {
                            $sum = Model::factory('sumpropis')->num2str($many);
                        }
                        else
                        {
                            $sum = Model::factory('sumpropis')->num2stren($many);
                        }
                        list($sum[0], $sum[0]) = mb_strtoupper($sum[0].$sum[1], 'UTF8');
                        echo $sum,('n' == $user[0]["nds"])?" Without VAT ":", including VAT ".number_format($many - $many*100/($stavkands+100),2,'.',',');
                    ?>
                    
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