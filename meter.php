<?php
include 'blocks/conn.php';
//@$meter_id=$_GET["id"];
//print($meter_id);
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
<title>WEB ������� ����� �������������� ������</title>
</head>
<body onload="startTime()">

<div id="header"><h1><a href='http://rtpc.dn.ua/counts/meter.php'>������� WEB ����� �������������� ������</a></h1></div>
<div id='meter_prop'>
						
							

<?php print("<div id='info_block'><p id='date_now'>".date("j.n.Y")."</p><p id='time'></p></div>");?>
	<form name='select_meter' id='count_select' method='get' action=''> 
			
		<div id=chanels>
							<div style='text-align:center; margin:10px auto 0 auto; line-height:20px;'>
							<input type='checkbox' name='activ' value='a2'><b>A+</b>
							<input type='checkbox' name='activ_negative' value='a3'><b>A-</b>
							<input type='checkbox' name='reactiv' value='a4'><b>R+</b>
							<input type='checkbox' name='reactiv_negative' value='a5'><b>R-</b>
							</div>
		<select name='count' id='count'>
			<option>�������� �������</option>
<?php
			$cnt=$_GET["count"];
			 $result_meter = pg_query($conn, "SELECT * FROM meter order by name");
			 while ($arr = pg_fetch_array($result_meter, NULL, PGSQL_ASSOC))
			 {
			 $sel=null;
			 if($arr["id"]==$cnt){
				$sel='selected';
			}
			printf("<option %s title='��������� �����: %s id=%s' value='%s'>%s</option>",$sel,$arr["serialnumber"],$arr["id"],$arr["id"],$arr["name"]);
}
?>
		</select></div>
					<div id='date_block'>
					<input type="text" id="date_start" name="date_start" 
					<?php
					$today=date("Y-m-d");
						if(isset($_GET["date_start"])) 
					{
					print("value='".$_GET["date_start"]."'/>");
					} else {
					print("value='".$today."'/>");
					} ?>
					<input type="text" id="date_end" name="date_end" 
					<?php if(isset($_GET["date_end"])) 
					{
					print("value='".$_GET["date_end"]."'/>");
					} else {
					print("value='".$today."'/>");
					} ?>
					</div>	
					<select name='tab_name' form='count_select' id='count'>	
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]=="public.res30min") echo "selected" ?> value='public.res30min'>������� �������� 30 ����� � ������ �����������</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]=="public.res60min") echo "selected"?> value='public.res60min'>������� �������� 60 �����</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]=="public.dailyenergy") echo "selected" ?> value='public.dailyenergy'>�������� �������</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]=="public.monthenergy") echo "selected"?> value='public.monthenergy'>�������� �������</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]==4) echo "selected"?> value='4'>������� �������� (����� �� ������)</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]==4) echo "selected"?> value='4'>�������� ������� (����� �� ������)</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]=="public.energysum") echo "selected"?> value='public.energysum'>������� ���������</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]==4) echo "selected"?> value='4'>��������� �� ������ �����</option>
							<option <?php if(isset($_GET["tab_name"]) && $_GET["tab_name"]==4) echo "selected"?> value='4'>��������� 30 ���</option>
					</select>

			<input id='subm' type='submit' form='count_select' value='GO'/>
	</form>
	<div id='clear'></div>
</div>
<div id='meter_data'>
<div>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$meter_id=@$_GET["count"];
$tab_name=@$_GET["tab_name"];
$date_start=@$_GET["date_start"];
$date_end=@$_GET["date_end"];
$graf_data="";
//����� �������
switch ($tab_name) {
	case "":
		echo "<div id='output_info'><h2>����� ����������</h2><hr style='width:60%; color:grey; margin:10px auto;'/>
		<h3>��������� �������</h3>
		<p>�� 29 ������ 2013 ���� �������� ������� ������� ���������� �� ��������� &quot������� �������� 30 ���&quot � ������ �����������. ���� �������� ������ ������� �������� A+ � ���������� R+ ������� . ����������� �������� ����������� ������ ������� ��������� ����������.
		</p>
		<h3>��� ��� ��������</h3>
		<p>������� WEB ����� �������������� �������� �� ������ � ����� ������ ����������� ����������� NOVASYS, ���� ����������� ����� ���� ��� ������� ��������� ������ �������� ����� ������� NOVASYS �� ��������� ������������ ������ � ������ ������������ ����� �������������. </p>
		<p>��������� ������� NOVASYS ������������ ����� ��������� ���� � ����������� ��������, ��������� �������� ��������� �������� ��������������, ������������ ������� NOVASYS. ����������� ������ ���������� ����� ��������� ��������� � ���������� �������� � ���� ������. ������������ NOVASYS, ����������� � ���� ������ ����� ����������� ������������� ��������� ������ c ������� ����������� ���������� ��� ������� ����������� �����-�����������. ��� �� ������������ ����� ����������� ����������� ��������� ������� �������, ��������� ����������, �� �����������, �������� ������.</p><p>�������� �������� ������� ��������� ���������� � ������ ���������� ����������. ������ ��� ������� � ����������� � ������� WEB ����� ��������������. ��� ������ ������ � ��� ����������
		<ol>
			<li>������� ������� ������ �������� ���������� �����������;</li>
			<li>������� ���� ������ ������������� �������. ����� ���� ������ ������� ������������� ������������� 00:00 �.�. ������ �����, �� ��������� � ����� ����� ���� �������������� ������� ����;</li>
			<li>������� ���� ��������� ������������� �������. ����� ���� ��������� ������� ������������� ������������� 23:59 �.�. ����� �����;</li>
			<li>������� ������������ �������� ��� ����������;</li>
			<li>����������� ���� ����� �������� ������ 'GO';</li>
		</ol>
		����� ����� �� ����� ����� �������� ����������� ������ � ��������� � �����������, ���� ��� ��������, ����. 
		</p>
		<p>
		
		</p>
		</div>"; //������ �� ������� 
	break;
    case "public.res30min":
		echo "<div id='output_info'><p class='data_type'>������� �������� 30 ����� � ������ �����������</p><p> �� ������ ��".$date_start." 00:00 ��".$date_end." 23:59</p> �� �������� </div>";
		$res30min=pg_query($conn, "SELECT activ.date, activ.valuefactor as act, reactiv.valuefactor as rea from 
		(select  date, valuefactor, chanid from ".$tab_name." activ where chanid=1 and meterid=".$meter_id.") as activ, (select date,valuefactor,chanid from ".$tab_name." reactiv where chanid=3 and meterid=".$meter_id.") as reactiv WHERE activ.date=reactiv.date and activ.date BETWEEN '".$date_start." 00:00:00'and '".$date_end." 23:59:59'");
		
		print("<div id='tb'>");
			print("<div id='tb_sel'><div class='date'><p>����</p><p>�����</p></div><div class='val' style='font-size:10px;'>A+</div><div class='val' style='font-size:10px;'>R+</div><div class='val' style='font-size:10px;'>R-</div></div>");
				while($activ30min=pg_fetch_array($res30min, NULL, PGSQL_ASSOC)) //������ �� ������
				{					
					$expl = explode(" ", $activ30min["date"]);
					$expl_t=explode(":",$expl[1]);
					printf("<div id='tb_sel'><div class='date'><p>%s</p><p>%s:%s</p></div><div class='val'>%s</div><div class='val'>%s</div><div class='val'>%s</div></div>", $expl[0], $expl_t[0], $expl_t[1], $activ30min["act"],$activ30min["rea"], 'null');
					$graf_data.="{x: '".$activ30min["date"]."', y: ".$activ30min["act"].", z: ".$activ30min["rea"]."}, \n";
					
				}
		
		print("<div id='clear'></div></div><div id='grafik'></div>");
		
		break;
	case "public.res60min":	
        echo "<p>������� �������� 60 �����</p>";
	        break;
			
	case "public.energysum":
		echo "<p>������� ���������</p>";
			break;
	case "public.dailyenergy":
		echo "<p>�������� �������</p>";
			break;
	case "public.monthenergy":
		echo "<p>�������� �������</p>";
			break;
}
?>
<?php 
if (isset($conn)) pg_close($conn);
?>


</body>
</html>
<script>
Morris.Line({
  element: 'grafik',
  data: [
  <?php
  print $graf_data;
  ?>
    ],
  xkey: 'x',
  ykeys: ['y', 'z'],
  labels: ['A+', 'R+'],
  smooth: false,//true,
  pointSize: 2,
  lineColors: ['#F00', '#00F',],
  lineWidth: 1,
  pointFillColors: [],
  pointStrokeColors: ['#000'],
});
</script>
