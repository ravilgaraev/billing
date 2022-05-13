<div class="text-primary">
    <div class="text-center">
        <h4>STATUS OF SUBSCRIBER'S PERSONAL ACCOUNT</h4>
    </div>
<?php 

$user1 = $user['user'];
$many = $user['many'];
$table = $user['table'];
$befo1 = $user['befo'];
$itogo = $user['itogo'];
$sum = $user['sum'];

$bf = stripos($befo1,'</tr>');

$befo = '<table class="table table-bordered table_info">
    <tr class="text-right">
        <td class="text-left" style="width: 50%">Services</td>
        <td>Unit</td>
        <td>Amount</td>
        <td>Price</td>
        <td>Service price</td>
        <td>VAT rate</td>
        <td>VAT sum</td>
        <td>Total including VAT</td>
    </tr>'.substr($befo1,$bf+5, strlen($befo1));
$befo = str_replace('Итого','Total',$befo);


?>
<div class="row">
<?php foreach ($user1 as $key) :?>
    <?php $username = $key['username']; ?>
        <div class="col-md-7">
            <table class="table table-bordered table-striped">
                <tr> <td class="table_info_30"> Customer: </td><td  class="table_info"><?php echo $key['orgr']  ;?> </td> </tr>
                <tr> <td class="table_info_30"> Customer type: </td><td  class="table_info"><?php echo $key['urfiz']  ;?> </td> </tr>
                <tr> <td class="table_info_30"> Account name: </td><td  class="table_info"><?php echo $key['username'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Contract number: </td><td  class="table_info"><?php echo $key['contract'] ;?> </td> </tr>
                <!--<tr> <td class="table_info_30"> VAT Registration code: </td><td  class="table_info"><?php //echo $key['rkpnds'] ;?> </td> </tr>-->
                <tr> <td class="table_info_30"> Contract date: </td><td  class="table_info">
                        <?php $dd = explode('-',$key['cdate']); echo $dd[2].'/'.$dd[1].'/'.$dd[0]  ;?>
                    </td>
                </tr>
                <tr> <td class="table_info_30"> Address: </td><td  class="table_info"><?php echo $key['address_n'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Telephone: </td><td  class="table_info"><?php echo $key['phones'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Fax: </td><td  class="table_info"><?php echo $key['fax'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Contact person: </td><td  class="table_info"><?php echo $key['contactperson'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Passport data: </td><td  class="table_info"><?php echo $key['passport'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Contact e-mail: </td><td  class="table_info"><?php echo $key['postmaster'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Status: </td><td  class="table_info"><?php echo $key['status'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Connection address: </td><td  class="table_info"><?php echo $key['addr_podkl'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> IP address: </td><td  class="table_info"><?php echo $key['ip_addr'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> ATS: </td><td  class="table_info"><?php echo $key['ats'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Port (International VPN): </td><td  class="table_info"><?php echo $key['port'] ;?></td> </tr>
                <tr> <td class="table_info_30"> Connection speed: </td><td  class="table_info"><?php echo $key['speed'] ;?></td> </tr>
                <tr> <td class="table_info_30"> Equipment: </td><td  class="table_info"><?php echo $key['oborudovanie'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Domains and hosting: </td><td  class="table_info"><?php echo $key['webdomains'] ;?> </td> </tr>
                <tr> <td class="table_info_30"> Order ID: </td><td  class="table_info"><?php echo $key['orderid'] ;?> </td> </tr>
                <tr> 
                    <td class="table_info_30">
                        <?php 
                            if(0<$sum - $itogo){echo 'Balance on Customers account including services in current month';}
                            else {echo 'Debit on Customers account including services in current month';}
                        ?>
                    </td>
                    <td  class="table_info">
                        <?php 
                            if("Usd" == $key['paymentmethod']){$valuta=2;}else{$valuta=1;}
                            if("Euro" == $key['paymentmethod']){$valuta=3;}
                            $many_itogo = number_format($sum - $itogo,2,'.','');
                            
                            switch ($valuta) {
                                case '2':echo $many_itogo," (", Model::factory('sumpropis')->num2stren($many_itogo),")";break;
                                case '3':echo $many_itogo," (",Model::factory('sumpropis')->num2strer($many_itogo),")";break;
                                default:echo $many_itogo," (",Model::factory('sumpropis')->num2str($many_itogo,1),")";break;
                            }
                            
                            
                            
//                            echo number_format($sum - $itogo,2,'.',','), "<br />" ,Model::factory('sumpropis')->num2str($many_itogo,$valuta);
//                            echo number_format($sum - $itogo,2,'.',','), "<br />" ,Model::factory('sumpropis')->num2stren($many_itogo);
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered table-striped">
                <tr><td class="table_info_30">Account number:</td><td class="table_info_30"><?php echo $key['account_num'] ;?></td></tr>
                <tr><td class="table_info_30">Bank:</td><td class="table_info_30"><?php echo $key['bankdetails'] ;?></td></tr>
                <tr><td class="table_info_30">Tax ID:</td><td class="table_info_30"><?php echo $key['inn'] ;?></td></tr>
                <tr><td class="table_info_30">Bank Code:</td><td class="table_info_30"><?php echo $key['mfo'] ;?></td></tr>
                <tr><td class="table_info_30">Business Code:</td><td class="table_info_30"><?php echo $key['oked'] ;?></td></tr>
                <tr><td class="table_info_30">VAT Registration code:</td><td class="table_info_30"><?php echo $key['rkpnds'] ;?></td></tr>
                <tr><td class="table_info_30">SWIFT:</td><td class="table_info_30"><?php echo $key['swift'] ;?></td></tr>
            </table>
            <div>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="username" value="<?php echo $username; ?>" />
                    <p>Choose file:</p>
                    <p><input type="file" name="doc" /></p>
                    <p><input type="submit" name="submit" id="submit" value="Upload" class="btn btn-primary" /></p>
                </form>
                <table class="table table-bordered">
                    <?php foreach ($doc_file as $key => $value):?>
                        <tr>
                            <td><a href="<?php echo substr($value['file'],25);?>" ><?php echo $value['file_name'];?></a></td>
                            <?php if('admin' == Cookie::get('role')):?>
                                <td><a href="delupload?username=<?php echo $username; ?>&file=<?php echo $value['file']; ?>"
                                       onclick="return confirm('Удалить')">Delete</a></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach;?>

                </table>
            </div>
        </div>
    <?php 
        $u = $key['username'];
        $o = $key['orgr'];
        $ph = $key['phones'];
        $p = $key['port'];
        $user = Cookie::get('user');
    ?>
<?php endforeach;?>
    
</div>
    
    <a href="http://ticket.bcc.uz/add?username=<?php echo $u."&orgr=".$o."&phone=".$ph."&port=".$p."&luser=".$user;?>"
        target="_blank" class="btn btn-primary"> Ticket 
    </a>
<div class="row text-center">Services <?php echo date("m/Y");?></div>
<?php 
    $month = date("m")-1;
    $year = date("Y");
    if(0 == $month){$month =12;$year -=1;}
    if(10>$month){$month ="0".$month;}
    echo $table;
    echo '<div class="row text-center">Customer expenses ',$month,'/',$year,'</div>';
    echo $befo;
//    die;
?>
<br>

<br />
<div class="text-center">Operations with Customer account:</div>
<table class="table table-bordered table-striped">
    <tr class="text-center">
        <td class="table_info">Date</td>
        <td class="table_info">Income</td>
        <td class="table_info">Expense</td>
        <td class="table_info">Balance</td>
        <td class="table_info">Comments</td>
    </tr>
<?php $sum =0;?>
<?php foreach ($many as $key => $value):?>
    <tr>
        <td class="table_info">
            <?php echo Date::formatted_time($value['date'],"d.m.Y"); //date("B",$value['date']);?>
        </td>
        <?php if ($value['sum'] > 0) 
                {echo "<td class=\"table_info text-right\">",
                        number_format($value['sum'],2,'.',','),
                        "</td>", 
                        "<td class=\"table_info\"></td>";}
            else 
                {echo "<td class=\"table_info\"></td>",
                        "<td class=\"table_info text-left\">",
                        number_format($value['sum'],2,'.',','),
                        "</td>";};?>
        <td class="table_info"><?php echo number_format($sum+=$value['sum'],2,'.',',');?></td>
        <td class="table_info">
            <?php 
                $str = $value['cmt'];
                if('Услуги' == substr($str, 0, 12))
                {
                    echo 'Servises for'.substr($value['cmt'], 17, 50 );
                }
                else 
                {
                    echo 'Payment (Invoice '.substr($value['cmt'], 33, 60 );
                }
//                echo $str;
            ?>
        </td>
    
    </tr>
<?php endforeach;?>
</table>
</div>
<div class="col-md-4 text-right">
    <p>Director _____________</p>
    <p>Accountant _____________</p>
    <br />
    
</div>