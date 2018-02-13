<?php
include 'blocks/conn.php';
@$meter_id=$_GET["id"];
print($meter_id);
?>
<!DOCTYPE html>
<html>
<head>
<script src="scripts/jquery-1.10.2.min.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/raphael-min.js"></script>
<script src="scripts/morris.min.js" ></script>
<script src="scripts/watch.js"></script>
<script src="scripts/datas.js"></script>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/jquery.ui.datepicker.css">
<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.min.css">
  <style>
   input:checked + span {
    background: #fc0;
   }
  </style>
<title>test page</title>
</head>
<body>
<?php
$que=pg_query("SELECT * FROM res30min min WHERE date BETWEEN '2013-10-03 00:00:00' and '2013-10-03 23:59:59' and meterid=27");
$i=0;
while(pg_fetch_array($que,NULL,PGSQL_ASSOC)){
echo $i." ";
$i++;
}
?>

 </head>
 <body>
  <p><strong>С какими операционными системамы вы знакомы?</strong></p>
  <p><input type="checkbox" name="a1"><span>Windows 7</span><br>
  <input type="checkbox" name="a2"><span>Windows Vista</span><br>
  <input type="checkbox" name="a3"><span>Windows XP</span><br>
  <input type="checkbox" name="a4"><span>System X</span><br> 
  <input type="checkbox" name="a5"><span>Linux</span><br> 
  <input type="checkbox" name="a6"><span>Mac OS</span></p>
  <p><input type="submit" value="Отправить"></p>


</body>
</html>
<?php 
pg_close($conn);
?>
