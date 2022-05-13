<?php $itogo = 0;
    $price = 0;
    $nds = 0;
    $i = 0;
?>
<!DOCTYPE html>
<html lang="en">
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

</head>
<body style="font-size: 12px; font-family: Consolas">

<!--конец заголовка HTML-->

<div class="logo_sf">
    <div class="row">
        <div class="text-center">
            <div class="col-xs-2">
                <img src="/media/images/bcc_logo.png" class="img_sf">
            </div>
            <div class="col-xs-8 header_sf">
                INVOICE № <?php echo "IRS-",$nomsf; ?>
                for rendered services Dated <?php $date = explode("-", $finish);
                echo $date[0].".".$date[1].".".$date[2]; ?><br>
                according to the Contract № 
                <?php $date = explode("-", $user['cdate']);
                echo $user['contract']," Dated ",$date[2].".".$date[1].".".$date[0]; 
                ?><br>
                <!--Billing period:--> 
                    <?php 
//                        $date = explode("-", $start);
//                        echo $date[0].".".$date[1].".".$date[2]; 
//                        echo " - ";
//                        $date = explode("-", $finish);
//                        echo $date[0].".".$date[1].".".$date[2]; 
                    ?>
            </div>
            <br />
        </div>
    </div>
    <table class="table_schet">
        <tr>
            <td class="odin text-right">Supplier:</td>
            <td class="dva">"Amaliy Aloqalar Biznesi" LLC</td>
            <td class="tri"></td>
            <td class="odin text-right">Subscriber:</td>
            <td class="dva"><?php echo $user['orgr'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Address:</td>
            <td class="dva">Tashkent, Mirabad District, Shakhrisabz Str, 16a, 4th floor</td>
            <td class="tri"></td>
            <td class="odin text-right">Address:</td>
            <td class="dva"><?php echo $user['address_n'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Tel:</td>
            <td class="dva">71 252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Tel:</td>
            <td class="dva"><?php echo $user['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Fax:</td>
            <td class="dva">71 252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Fax:</td>
            <td class="dva"><?php echo $user['fax'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Account №</td>
            <td class="dva">
                <?php
                    switch ($user['paymentmethod']) {
                        case 'Usd':echo '20208840103906693001';break;
                        case 'Euro':echo '20208978503906693001';break;
                        default:echo '20208000903906693001';break;
                    }
                ?>
            </td>
            <td class="tri"></td>
            <td class="odin text-right">Account №</td>
            <td class="dva"><?php echo $user['account_num'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Bank:</td>
            <td class="dva">MOB NB FEA RUz</td>
            <td class="tri"></td>
            <td class="odin text-right">Bank:</td>
            <td class="dva"><?php echo $user['bankdetails'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Bank Code:</td>
            <td class="dva">00407</td>
            <td class="tri"></td>
            <td class="odin text-right">Bank Code:</td>
            <td class="dva"><?php echo $user['mfo'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">TAX ID:</td>
            <td class="dva">202606274</td>
            <td class="tri"></td>
            <td class="odin text-right">TAX ID:</td>
            <td class="dva"><?php echo $user['inn'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">OKED</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">OKED</td>
            <td class="dva"><?php echo $user['oked'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">PRN VAT</td>
            <td class="dva">326010019003</td>
            <td class="tri"></td>
            <td class="odin text-right">PRN VAT</td>
            <td class="dva"><?php echo $user['rkpnds'];?></td>
        </tr>
    </table>
    <div class="row">
        Order ID: <?php echo $user['orderid'];?>
        <br />
        User registration name: <?php echo $user['username'];?>
    </div>
    
<table class="table-print text-center sf">
    <tr>
        <td rowspan="2">№</td>
        <td rowspan="2">Services provided</td>
        <td rowspan="2">Unit</td>
        <td rowspan="2">Quantity</td>
        <td rowspan="2">Price</td>
        <td rowspan="2">Sum</td>
        <!--<td colspan="2">Excise TAX</td>-->
        <td colspan="2">VAT</td>
        <td rowspan="2" colspan="2">Total including VAT</td>
    </tr>
    <tr class="text-center">
        <!--<td>ET<br />rate</td>
        <td>ET<br />Sum</td>-->
        <td>VAT<br />rate</td>
        <td>VAT<br />Sum</td>
    </tr>        
    <?php foreach ($services as $key => $value) :?>
    <?php $i++ ;?>
        <tr class="sf">
            <td class="text-center sf"><?php echo $i;?></td>
            <td class="text-left sf" style="width: 40%">
                <?php echo $value['service'];?>
            </td>
            <td class="text-right sf"><?php echo $value['unit'];?></td>
            <td class="text-right sf"><?php echo $value['amount'];?></td>
            <td class="text-right sf"><?php echo number_format($value['price']*100/($user['stavkands']+100),2,'.',','); ?></td>
            <td class="text-right sf">
                <?php 
                    $price += (0 == $user['stavkands']) ? $value['amount']*$value['price'] : 
                            $value['amount']*$value['price']*100/($user['stavkands']+100);
                        echo 0 == $user['stavkands'] ? $value['amount']*$value['price'] : 
                            number_format($value['amount']*$value['price']*100/($user['stavkands']+100),2,'.',',');
                ?>
            </td>
            <!--<td colspan="2" class="text-center sf">NO ET</td>-->
            <td class="text-center sf">
                <?php $show = 0 == $value['amount']*$value['price'] ? 0 : $user['stavkands']; echo $show;?>%
            </td>
            <td class="text-right sf">
                <?php 
                    $nds += $value['amount']*$value['price'] - $value['amount']*$value['price']*100/($user['stavkands']+100);
                    echo number_format($value['amount']*$value['price'] - $value['amount']*$value['price']*100/($user['stavkands']+100),2,'.',',');
                ?>
            </td>
            <td class="text-right sf"><?php echo number_format($value['total'],2,'.',',');?></td>
        </tr>
        <?php $itogo += $value['total'];?>
    <?php endforeach;?>
    <tr>
        <td class="text-center sf"><?php echo ++$i;?></td>
        <td class="text-left comment">Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right sf"><?php echo number_format($price,2,'.',',');?></td>
        <!--<td colspan="2"></td>-->
        <td></td>
        <td class="text-right sf"><?php echo number_format($nds,2,'.',',');?></td>
        <td class="text-right sf"><?php echo number_format($itogo,2,'.',','); ?></td>
    </tr>
    <tr> 
        <td colspan="9">
            <?php
                switch ($user['paymentmethod']) {
                    case 'Usd':echo Model::factory('sumpropis')->num2stren($itogo)." including VAT ".number_format($nds,2,'.',',');break;
                    case 'Euro':echo Model::factory('sumpropis')->num2strer($itogo)." including VAT ".number_format($nds,2,'.',',');break;
                    default:echo Model::factory('sumpropis')->num2str($itogo,1)." including VAT ".number_format($nds,2,'.',',');break;
                }
            ?>
            <?php
//                echo "Usd" == $user['paymentmethod'] ?
//                Model::factory('sumpropis')->num2stren($itogo)." including VAT ".number_format($nds,2,'.',','):
//                Model::factory('sumpropis')->num2strer($itogo)." including VAT ".number_format($nds,2,'.',',');
            ?>
        </td>
    </tr>
</table>    
    <br />
    <br />
    <div class="row">
        <div class="col-xs-6">
            Director ___________________<br /><br />
            Chief Accountant __________<br /><br />
            Stamp
        </div>
        <div class="col-xs-6">
            Subscriber ___________________________<br />
            <br />
            
            ______________________________________<br />
                       (Name/Title)
        </div>
    </div>
</div> <!--  конец главного дива-->
<br />
<br />
<br />
<br />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="media/js/bootstrap.min.js"></script> 

<div class="newpage"></div>
</body>
</html>