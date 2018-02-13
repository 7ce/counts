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
$hlp="<div id='hlp'><h2>Инструкция пользователя</h2><div id='step'><h3>Шаг 1</h3><p>Выбор счетчика и канала данных</p><img src='http://rtpc.dn.ua/counts/img/1.png' alt='Шаг 1'><p>Канал &quotA+&quot выбран по умолчанию и может быть отменён . Остальные каналы выбираются по необходимости. Чем больше каналов для чтения выбрано тем дольше обрабатываеться запрос.</p></div><div id='step'><h3>Шаг 2</h3><p>Установка начала и окончания периода</p><img src='http://rtpc.dn.ua/counts/img/2.png' alt='Шаг 2'><p>По умолчанию выбрана текущая дата. По времени период выставлен с 00:00 до 23:59. Выбор большого периода (более месяца) времени создает большую нагрузку на сервер и обрабатываеться дольше. Будте терпеливее.</p></div><div id='step'><h3>Шаг 3</h3><p>Выбор типа данных</p><img src='http://rtpc.dn.ua/counts/img/3.png' alt='Шаг 3'><p>Тут можно выбрать что конкретно мы хотим увидеть.</p></div><div id='step'><h3>Шаг 4</h3><p>Просто нажать кнопку &quotGO&quot</p><img src='http://rtpc.dn.ua/counts/img/4.PNG' alt='Шаг 4'><div class='clear'></div></div></div>";
$main_text =$hlp."<div id='output_info'><hr style='width:60%; color:grey; margin:10px auto;'/><h3>Доступные функции</h3><p><b>18.12.2013</b> Добавлен модуль авторизации в системе. На сайте мониторинга <a href='https://krt.doris.ua'>krt.doris.ua</a>  в разделе сеть-сетевые устройства добавлена ссылка на <a href='http://rtpc.dn.ua/counts/index.php'>систему Web учета електроэнергии</a> для быстрого доступа обслуживающего персонала</p><p><b>04.12.2013</b> Закончена работа над разделом &quotПрофиль нагрузки 30 минут&quot</p><p><b>03.12.2013</b> добавлена возможность считывания показаний отрицательных значений реактивной мощности. Вывод графиков разделен по каналам &quotA+&quot &quotR+&quot &quotR-&quot показаний ввиду несоотносимости величин значнений. Ведётся работа над возможностью выбора канала вывода данных.</p>
		<p>На <b>29 ноября 2013</b> года доступны функции вычитки информации по параметру &quotПрофиль нагрузки 30 мин&quot с учетом коэфициента. Пока доступны данные каналов активной A+ и реактивной R+ энергии . Планируется добавить возможность выбора каналов выводимой информации.
		</p>
		<h3>Как это работает</h3>
		<p>Система WEB учета електроэнергии основана на работе с базой данных програмного обеспечения NOVASYS, была разработана ввиду того что высокая стоимость одного рабочего места системы NOVASYS не позволяла предоставить доступ к данным необходимому числу пользователей. </p>
		<p>Структура системы NOVASYS представляет собой локальную сеть с центральным сервером, клиентами которого являються счётчики електроэнергии, пользователи системы NOVASYS. Центральный сервер производит опрос показаний счетчиков и результаты собирает в базу данных. Пользователи NOVASYS, подключаясь к базе данных имеют возможность просматривать собранные данные c помощью клиентского приложения при наличии аппаратного ключа-сертификата. Так же пользователи имеют возможность производить настройку системы целиком, управлять счетчиками, их размещением, частотой опроса.</p><p>Основной функцией системы являеться считывание и анализ полученной информации. Именно эта функция и реализована в Система WEB учета електроэнергии. Для начала работы с ней необходимо
		<ol>
			<li>Выбрать счетчик данные которого необходимо просмотреть;</li>
			<li>Выбрать дату начала интересующего периода. Время даты начала периода автоматически подставлеться 00:00 т.е. начало суток, по умолчанию в полях ввода даты подставляеться текушая дата;</li>
			<li>Выбрать дату окончания интересующего периода. Время даты окончания периода автоматически подставлеться 23:59 т.е. конец суток;</li>
			<li>Выбрать интересующий параметр для считывания;</li>
			<li>Подтвердить свой выбор нажатием кнопки 'GO';</li>
		</ol>
		После этого на экран будут выведены запрошенные данные в табличном и графическом, если это возможно, виде. 
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

<title>WEB система учета электроэнергии ДФКРРТ</title>
</head>
<body onload="startTime()">
<?php
include_once 'login.php';
?>
<div id="header"><h1><a href='http://rtpc.dn.ua/counts/'>Система WEB учета электроэнергии ДФКРРТ</a></h1></div>

<?php
if(isset($log) && ($log==1)){
	include 'blocks/qeryblock.php';
	}else{
	print "<h1 id=login>Для доступа к данным необходимо пройти авторизацию</h1>";
	}
?>



<div id='meter_data'>
<div>

		<?php
//выбор запроса
if ($meter_id!='Выберите счётчик'){
switch ($tab_name) {
	case "":
	
		echo $main_text;
				//ничего не выбрано 
	break;
    case "public.res30min":
		echo "<div id='output_info'><p class='data_type'>Профиль нагрузки 30 минут с учетом коэфициента</p><p> за период от ".$date_start." 00:00 до ".$date_end." 23:59 по счетчику ".pg_fetch_result(pg_query($conn,"SELECT name FROM meter WHERE id=".$meter_id.""),'name')." </div>";
		
		$zapros ="SELECT tbl.date, tbl.a_plus, tbl.r_plus, rm.r_minus from (SELECT ap.date, ap.valuefactor as a_plus,rp.valuefactor as r_plus from ".$tab_name." as ap, ".$tab_name." as rp where ap.meterid=".$meter_id." and rp.meterid=ap.meterid and ap.chanid=1 and rp.chanid=3 and ap.date=rp.date and ap.date BETWEEN '".$date_start." 00:00:00' and '".$date_end." 23:59:59' ) as tbl,(SELECT rm.date, rm.valuefactor as r_minus from ".$tab_name." as rm WHERE rm.meterid=".$meter_id." and rm.chanid=4 and rm.date BETWEEN '".$date_start." 00:00:00' and '".$date_end." 23:59:59')as rm WHERE rm.date=tbl.date";
	//	$zapros="SELECT activ.date, activ.valuefactor as act, reactiv.valuefactor as rea from (select  date, valuefactor, chanid from ".$tab_name." activ where chanid=1 and meterid=".$meter_id.") as activ, (select date,valuefactor,chanid from ".$tab_name." reactiv where chanid=3 and meterid=".$meter_id.") as reactiv WHERE activ.date=reactiv.date and activ.date BETWEEN '".$date_start." 00:00:00'and '".$date_end." 23:59:59'";
		
		$res30min=pg_query($conn, $zapros);
		$summ_apl=0;
		$summ_rpl=0;
		$summ_rm=0;
		print("<div id='tb'>");
			print("<div id='tb_sel'><div class='date'><p>Дата</p><p>Время</p></div>");
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
			
				while($activ30min=pg_fetch_array($res30min, NULL, PGSQL_ASSOC)) //проход по данным
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
				print("<div id='tb_sel'><div class='date'>Сумма</div>");
				if(isset($cn1)) {print("<div class='val' style='font-size:10px;'>".$summ_apl."кВт</div>");}
				if(isset($cn3)) {print("<div class='val' style='font-size:10px;'>".$summ_rpl."кВАр</div>");}
				if(isset($cn4)) {print("<div class='val' style='font-size:10px;'>".$summ_rm."кВАр</div>"); }
				echo("</div>");
			print("<div id='clear'></div></div>");
			print("<div id='graf'>");
			if(isset($cn1)) {print("<div id='draggable1'><h3>Активная положительная энергия</h3><div id='grafik_aplus'></div><div id='clear'></div></div>");}
			if(isset($cn3)) {print("<div id='draggable2'><h3>Реактивная положительная энергия</h3><div id='grafik_rplus'></div><div id='clear'></div></div>");}
			if(isset($cn4)) {print("<div id='draggable3'><h3>Реактивная отрицательная энергия</h3><div id='grafik_rminus'></div><div id='clear'></div></div>");}
			print("<div class='clear'></div></div>");
			
		
		
		break;
		case "4":
		echo "<h3>Раздел на стадии разработки</h3>";
		break;
	case "public.res60min":	
        echo "<p>Профиль нагрузки 60 минут</p>";
		echo "<h3>Раздел на стадии разработки</h3>";
	        break;
			
	case "public.energysum":
		echo "<p>Текущие показания</p>";
		echo "<h3>Раздел на стадии разработки</h3>";
			break; 
	case "public.dailyenergy":
		echo "<p>Суточная энергия</p>";
		echo "<h3>Раздел на стадии разработки</h3>";
			break;
	case "public.monthenergy":
		echo "<p>Месячная энергия</p>";
		echo "<h3>Раздел на стадии разработки</h3>";
			break;
}
}else{
print ("<h1 style='color:#FFF; padding:20px; text-align:center; margin:40px auto; width:200px; border-radius:5px; background:#f5af02; box-shadow:2px 2px 5px #000;'><p>Вы не выбрали счётчик</p><p>Сделайте правильный выбор</p></h1>".$hlp);
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



