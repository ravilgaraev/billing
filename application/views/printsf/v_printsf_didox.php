<?php $i = 1;?>
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


<style type="text/css">
   @media print{
   .newpage{page-break-before: always;}
   } 
  </style>

</head>
<body style="font-size: 12px; font-family: Consolas">

<!--конец заголовка HTML-->

        <table class="table-print text-center sf">
            <?php  foreach ($didox as $key => $value) :?>
                <tr>
                    <?php for($y=1; $y<47; $y++) :?>
                       <td>
                           <?php echo $value[$y]?>
                       </td>
                   <?php endfor; ?>
                </tr>
            <?php endforeach;?>
        </table>
    
</body>
</html>