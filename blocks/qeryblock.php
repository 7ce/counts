<?php 

print ("<div id='meter_prop'>");
	

 print("<div id='info_block'><p id='date_now'>".date("j.n.Y")."</p><p id='time'></p></div>");?>
	<form name='select_meter' id='count_select' method='POST' action=''> 
			
		<div id=chanels>
							<div style='text-align:center; margin:4px; line-height:20px;'>
							<input type='checkbox' name='chan1' value='1' checked title="Активная положительная энергия"  /><b>A+</b>
							<input type='checkbox' name='chan3' value='1' title="Реактивная положительная энергия" <?php if(isset($cn3)) echo "checked"; ?>/><b>R+</b>
							<input type='checkbox' name='chan4' value='1' title="Реактивная отрицательная энергия" <?php if(isset($cn4)) echo "checked"; ?>/><b>R-</b>
							</div>
		<select name='count' id='count'>
			<option>Выберите счётчик</option>
<?php
			$cnt=$_POST["count"];
			 $result_meter = pg_query($conn, "SELECT id, serialnumber, name FROM meter order by name");
			 while ($arr = pg_fetch_array($result_meter, NULL, PGSQL_ASSOC))
			 {
			 $sel=null;
			 if($arr["id"]==$cnt){
				$sel='selected';
			}
			printf("<option %s title='Заводской номер: %s id=%s' value='%s'>%s</option>",$sel,$arr["serialnumber"],$arr["id"],$arr["id"],$arr["name"]);
}
?>
		</select></div>
					<div id='date_block'>
					<div style="font-size:12px; text-align:center; line-height:24px;"><b>Начало/конец периода</b></div>
					<input type="text" id="date_start" name="date_start" 
					<?php
					$today=date("Y-m-d");
						if(isset($_POST["date_start"])) 
					{
					print("value='".$_POST["date_start"]."'/>");
					} else {
					print("value='".$today."'/>");
					} ?>
					<input type="text" id="date_end" name="date_end" 
					<?php if(isset($_POST["date_end"])) 
					{
					print("value='".$_POST["date_end"]."'/>");
					} else {
					print("value='".$today."'/>");
					} ?>
					</div>	
									
					<select name='tab_name' form='count_select' id='count_data'>	
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]=="public.res30min") echo "selected" ?> value='public.res30min'>Профиль нагрузки 30 минут с учётом коэфициента</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]=="public.res60min") echo "selected"?> value='public.res60min'>Профиль нагрузки 60 минут</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]=="public.dailyenergy") echo "selected" ?> value='public.dailyenergy'>Суточная энергия</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]=="public.monthenergy") echo "selected"?> value='public.monthenergy'>Месячная энергия</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]==4) echo "selected"?> value='4'>Профиль нагрузки (сумма за период)</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]==4) echo "selected"?> value='4'>Суточная энергия (сумма за период)</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]=="public.energysum") echo "selected"?> value='public.energysum'>Текущие показания</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]==4) echo "selected"?> value='4'>Показания на начало суток</option>
							<option <?php if(isset($_POST["tab_name"]) && $_POST["tab_name"]==4) echo "selected"?> value='4'>Показания 30 мин</option>
					</select>

			<input id='subm' type='submit' form='count_select' value='GO'/>
	</form>
	<div id='clear'></div>
</div>