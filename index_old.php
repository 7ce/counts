<?php
//@session_start();
include 'blocks/conn.php';
//@$meter_id=$_POST["id"];
//print($meter_id);
?>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
$cn1=@$_POST["chan1"];
$cn3=@$_POST["chan3"];
$cn4=@$_POST["chan4"];
$meter_id=@$_POST["count"];
$tab_name=@$_POST["tab_name"];
$date_start=@$_POST["date_start"];
$date_end=@$_POST["date_end"];
$graf_data_aplus="";
$graf_data_rplus="";
$graf_data_rminus="";
$hlp="<div id='hlp'><h2>���������� ������������</h2><div id='step'><h3>��� 1</h3><p>����� �������� � ������ ������</p><img src='http://rtpc.dn.ua/counts/img/1.png' alt='��� 1'><p>����� &quotA+&quot ������ �� ��������� � ����� ���� ������ . ��������� ������ ���������� �� �������������. ��� ������ ������� ��� ������ ������� ��� ������ ��������������� ������.</p></div><div id='step'><h3>��� 2</h3><p>��������� ������ � ��������� �������</p><img src='http://rtpc.dn.ua/counts/img/2.png' alt='��� 2'><p>�� ��������� ������� ������� ����. �� ������� ������ ��������� � 00:00 �� 23:59. ����� �������� ������� (����� ������) ������� ������� ������� �������� �� ������ � ��������������� ������. ����� ����������.</p></div><div id='step'><h3>��� 3</h3><p>����� ���� ������</p><img src='http://rtpc.dn.ua/counts/img/3.png' alt='��� 3'><p>��� ����� ������� ��� ��������� �� ����� �������.</p></div><div id='step'><h3>��� 4</h3><p>������ ������ ������ &quotGO&quot</p><img src='http://rtpc.dn.ua/counts/img/4.PNG' alt='��� 4'><div class='clear'></div></div></div>";
$main_text =$hlp."<div id='output_info'><hr style='width:60%; color:grey; margin:10px auto;'/><h3>��������� �������</h3><p><b>18.12.2013</b> �������� ������ ����������� � �������. �� ����� ����������� <a href='https://krt.doris.ua'>krt.doris.ua</a>  � ������� ����-������� ���������� ��������� ������ �� <a href='http://rtpc.dn.ua/counts/index.php'>������� Web ����� ��������������</a> ��� �������� ������� �������������� ���������</p><p><b>04.12.2013</b> ��������� ������ ��� �������� &quot������� �������� 30 �����&quot</p><p><b>03.12.2013</b> ��������� ����������� ���������� ��������� ������������� �������� ���������� ��������. ����� �������� �������� �� ������� &quotA+&quot &quotR+&quot &quotR-&quot ��������� ����� ��������������� ������� ���������. ������ ������ ��� ������������ ������ ������ ������ ������.</p>
		<p>�� <b>29 ������ 2013</b> ���� �������� ������� ������� ���������� �� ��������� &quot������� �������� 30 ���&quot � ������ �����������. ���� �������� ������ ������� �������� A+ � ���������� R+ ������� . ����������� �������� ����������� ������ ������� ��������� ����������.
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
		</div>";

		?>
<!DOCTYPE html>
<html>
<head>
<meta charset="windows-1251">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<script src="scripts/jquery-1.10.2.min.js"></script>
<script src="scripts/jquery-ui.js"></script>
<script src="scripts/raphael-min.js"></script>
<script src="scripts/morris.min.js" ></script>
<script src="scripts/watch.js"></script>
<script src="scripts/datas.js"></script>
 <script>
  $(function() {
    $( "#draggable1" ).draggable();
	$( "#draggable2" ).draggable();
	$( "#draggable3" ).draggable();
	
  });
  </script>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/morris.css">
<link rel="stylesheet" type="text/css" href="css/jquery.ui.datepicker.css">
<link rel="stylesheet" type="text/css" href="css/redmond/jquery-ui-1.10.3.custom.min.css">

<title>WEB ������� ����� �������������� ������</title>
</head>
<body onload="startTime()">
<?php
include_once 'login.php';
?>
<div id="header"><h1><a href='http://rtpc.dn.ua/counts/'>������� WEB ����� �������������� ������</a></h1></div>

<?php
if(isset($log) && ($log==1)){
	include 'blocks/qeryblock.php';
	}else{
	print "<h1 id=login>��� ������� � ������ ���������� ������ �����������</h1>";
	}
?>



<div id='meter_data'>
<div>

		<?php
//����� �������
if ($meter_id!='�������� �������'){
switch ($tab_name) {
	case "":
	
		echo $main_text;
				//������ �� ������� 
	break;
    case "public.res30min":
		echo "<div id='output_info'><p class='data_type'>������� �������� 30 ����� � ������ �����������</p><p> �� ������ �� ".$date_start." 00:00 �� ".$date_end." 23:59 �� �������� ".pg_fetch_result(pg_query($conn,"SELECT name FROM meter WHERE id=".$meter_id.""),'name')." </div>";
		
		$zapros ="SELECT tbl.date, tbl.a_plus, tbl.r_plus, rm.r_minus from (SELECT ap.date, ap.valuefactor as a_plus,rp.valuefactor as r_plus from ".$tab_name." as ap, ".$tab_name." as rp where ap.meterid=".$meter_id." and rp.meterid=ap.meterid and ap.chanid=1 and rp.chanid=3 and ap.date=rp.date and ap.date BETWEEN '".$date_start." 00:00:00' and '".$date_end." 23:59:59' ) as tbl,(SELECT rm.date, rm.valuefactor as r_minus from ".$tab_name." as rm WHERE rm.meterid=".$meter_id." and rm.chanid=4 and rm.date BETWEEN '".$date_start." 00:00:00' and '".$date_end." 23:59:59')as rm WHERE rm.date=tbl.date";
	//	$zapros="SELECT activ.date, activ.valuefactor as act, reactiv.valuefactor as rea from (select  date, valuefactor, chanid from ".$tab_name." activ where chanid=1 and meterid=".$meter_id.") as activ, (select date,valuefactor,chanid from ".$tab_name." reactiv where chanid=3 and meterid=".$meter_id.") as reactiv WHERE activ.date=reactiv.date and activ.date BETWEEN '".$date_start." 00:00:00'and '".$date_end." 23:59:59'";
		
		$res30min=pg_query($conn, $zapros);
		$summ_apl=0;
		$summ_rpl=0;
		$summ_rm=0;
		print("<div id='tb'>");
			print("<div id='tb_sel'><div class='date'><p>����</p><p>�����</p></div>");
			if(isset($cn1)) {
							print("<div class='val' style='font-size:10px;'>A+</div>");
							}
			if(isset($cn3)) {
							print("<div class='val' style='font-size:10px;'>R+</div>");
							}
			if(isset($cn4)) {
							print("<div class='val' style='font-size:10px;'>R-</div>");
							}
			print("</div>");
			
				while($activ30min=pg_fetch_array($res30min, NULL, PGSQL_ASSOC)) //������ �� ������
				{					
					$expl = explode(" ", $activ30min["date"]);
					$expl_t=explode(":",$expl[1]);
					printf("<div id='tb_sel'><div class='date'><p>%s</p><p>%s:%s</p></div>", $expl[0], $expl_t[0], $expl_t[1]);
					
					if(isset($cn1)) {
									print("<div class='val'>".$activ30min["a_plus"]."</div>");
									$graf_data_aplus.="{x: '".$activ30min["date"]."', y: ".$activ30min["a_plus"]."}, \n";
									}
					
					if(isset($cn3)) {
									print("<div class='val'>".$activ30min["r_plus"]."</div>");
									$graf_data_rplus.="{x: '".$activ30min["date"]."', y: ".$activ30min["r_plus"]."}, \n";
									}
					
					if(isset($cn4)) {
									print("<div class='val'>".$activ30min["r_minus"]."</div>");
									$graf_data_rminus.="{x: '".$activ30min["date"]."', y: ".$activ30min["r_minus"]."}, \n";
									}
					echo "</div>";
					@$summ_apl+=$activ30min["a_plus"];
					@$summ_rpl+=$activ30min["r_plus"];
					@$summ_rm+=$activ30min["r_minus"];
				}
				print("<div id='tb_sel'><div class='date'>�����</div>");
				if(isset($cn1)) {print("<div class='val' style='font-size:10px;'>".$summ_apl."���</div>");}
				if(isset($cn3)) {print("<div class='val' style='font-size:10px;'>".$summ_rpl."����</div>");}
				if(isset($cn4)) {print("<div class='val' style='font-size:10px;'>".$summ_rm."����</div>"); }
				echo("</div>");
			print("<div id='clear'></div></div>");
			print("<div id='graf'>");
			if(isset($cn1)) {print("<div id='draggable1'><h3>�������� ������������� �������</h3><div id='grafik_aplus'></div><div id='clear'></div></div>");}
			if(isset($cn3)) {print("<div id='draggable2'><h3>���������� ������������� �������</h3><div id='grafik_rplus'></div><div id='clear'></div></div>");}
			if(isset($cn4)) {print("<div id='draggable3'><h3>���������� ������������� �������</h3><div id='grafik_rminus'></div><div id='clear'></div></div>");}
			print("<div class='clear'></div></div>");
			
		
		
		break;
		case "4":
		echo "<h3>������ �� ������ ����������</h3>";
		break;
	case "public.res60min":	
        echo "<p>������� �������� 60 �����</p>";
		echo "<h3>������ �� ������ ����������</h3>";
	        break;
			
	case "public.energysum":
		echo "<p>������� ���������</p>";
		echo "<h3>������ �� ������ ����������</h3>";
			break; 
	case "public.dailyenergy":
		echo "<p>�������� �������</p>";
		echo "<h3>������ �� ������ ����������</h3>";
			break;
	case "public.monthenergy":
		echo "<p>�������� �������</p>";
		echo "<h3>������ �� ������ ����������</h3>";
			break;
}
}else{
print ("<h1 style='color:#FFF; padding:20px; text-align:center; margin:40px auto; width:200px; border-radius:5px; background:#f5af02; box-shadow:2px 2px 5px #000;'><p>�� �� ������� �������</p><p>�������� ���������� �����</p></h1>".$hlp);
//print $main_text;
}
?>
<div id='copyrights'><p>Created by <a href=http://7ce.com.ua>7ce</a></p></div>
<?php 
if (isset($conn)) pg_close($conn);
?>


</body>
</html>
<script>
Morris.Line({
  element: 'grafik_aplus',
  data: [
  <?php
  print $graf_data_aplus;
  ?>
    ],
  xkey: 'x',
  ykeys: ['y'],
  labels: ['A+'],
  smooth: false,//true,
  pointSize: 2,
  lineColors: ['#F00', '#00F',],
  lineWidth: 1,
  pointFillColors: [],
  pointStrokeColors: ['#000'],
});
</script>
<script>
Morris.Line({
  element: 'grafik_rplus',
  data: [
  <?php
  print $graf_data_rplus;
  ?>
    ],
  xkey: 'x',
  ykeys: ['y'],
  labels: ['R+'],
  smooth: false,//true,
  pointSize: 2,
  lineColors: ['#0F0'],
  lineWidth: 1,
  pointFillColors: [],
  pointStrokeColors: ['#000'],
});
</script>
<script>
Morris.Line({
  element: 'grafik_rminus',
  data: [
  <?php
  print $graf_data_rminus;
  ?>
    ],
  xkey: 'x',
  ykeys: ['y'],
  labels: ['R-'],
  smooth: false,//true,
  pointSize: 2,
  lineColors: ['#00F'],
  lineWidth: 1,
  pointFillColors: [],
  pointStrokeColors: ['#000'],
});
</script>



