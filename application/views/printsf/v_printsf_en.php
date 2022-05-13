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
<body style="font-size: 14px; font-family: Times New Roman">

<!--конец заголовка HTML-->

<div class="logo_sf">
    <div class="row">
        <div class="col-xs-5 text-center"><br /><br />OOO "AMALIY ALOQALAR BIZNESI"</div>
        <div class="col-xs-2 text-center"><img src="/media/images/logo_bcc.png" class="img_sf"></div>
        <div class="col-xs-5 text-center"><br /><br />"BUSINESS COMMUNICATION CENTER" LTD</div>
    </div>
    <br />
    <div class="text-center">
        INVOICE № <?php echo "IRS-",$nomsf; ?><br>
        for rendered services dated <?php echo $finish; ?><br>
        according to the contract № <?php echo $user['contract']," Dated ",$user['cdate'] ; ?><br>
    </div>
    <br>
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
            <td class="dva">252-66-79,252-22-52</td>
            <td class="tri"></td>
            <td class="odin text-right">Tel:</td>
            <td class="dva"><?php echo $user['phones'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Fax:</td>
            <td class="dva">252-70-88</td>
            <td class="tri"></td>
            <td class="odin text-right">Fax:</td>
            <td class="dva"><?php echo $user['fax'];?></td>
        </tr>
        <tr>
            <td class="odin text-right">Account №</td>
            <td class="dva">20208000903906693001</td>
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
            <td class="odin text-right">OKED:</td>
            <td class="dva">61100</td>
            <td class="tri"></td>
            <td class="odin text-right">OKONH:</td>
            <td class="dva"><?php echo $user['okonx'];?></td>
        </tr>
        <tr>
            <td class="odin text-right"></td>
            <td class="dva"></td>
            <td class="tri"></td>
            <td class="odin text-right">OKED:</td>
            <td class="dva"><?php echo $user['oked'];?></td>
        </tr>
    </table>
    <br />
    <br /> 
    <div class="row">
        Order ID: <?php echo $user['orderid'];?>
        <br />
        User registration name: <?php echo $user['username'];?>
        <br />
        Billing period: <?php echo $start," - ",$finish; ?>
    </div>
    <br>
<table class="table table-bordered table_info">
    <tr>
        <td style="width: 50%">Comment</td>
        <td>Unit</td>
        <td>Quantity</td>
        <td>Price</td>
        <td>Sum</td>
    </tr>
<?php foreach ($services as $key => $value) :?>
    <tr>
        <td style="width: 50%"><?php echo $value['service'];?></td>
        <td class="text-right"><?php echo $value['unit'];?></td>
        <td class="text-right"><?php echo $value['amount'];?></td>
        <td class="text-right"><?php echo $value['price'];?></td>
        <td class="text-right"><?php echo $value['total'];?></td>
    </tr>
    <?php $itogo += $value['total'];?>
<?php endforeach;?>
    <tr>
        <td>Total</td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right"><?php echo number_format($itogo,2,'.',','); ?></td>
    </tr>    
</table>
    
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td>Services provided </td>
                <td>Unit</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Sum</td>
                <td>Excise Tax rate</td>
                <td>ET Sum</td>
                <td>VAT rate</td>
                <td>VAT Sum</td>
            </tr>
            <tr>
                <td>Payment for services</td>
                <td>-</td>
                <td>-</td>
                <td><?php echo number_format($itogo,2,'.',','); ?></td>
                <td><?php echo number_format($itogo,2,'.',','); ?></td>
                <td colspan="2" class="text-center">NO ET</td>
                <td colspan="2" class="text-center">NO VAT</td>
            </tr>
            <tr>
                <td colspan="5">Total provided services (VAT Not included)</td>
                <td colspan="4"><?php echo number_format($itogo,2,'.',','); ?></td>
            </tr>
        </table>
    </div>
    
    <br />
    <span>Total amount of rendered services: <?php echo number_format($itogo,2,'.',','); ?> </span>
    <br />
    <?php $sum_prop = Model::factory('sumpropis')->num2stren($itogo);?>
    <span>(<?php echo $sum_prop;?>) VAT Not included</span>
    <br />
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