<?php
	mysql_connect ("localhost", "test","testmysql");//пишите свои настройки
	mysql_select_db("test") or die (mysql_error());//и свою бд
	//mysql_query('SET character_set_database = utf8'); 
	//mysql_query ("SET NAMES 'utf8'");
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	@session_start();//не забываем во всех файлах писать session_start
if (isset($_POST['login']) && isset($_POST['password'])){
    //немного профильтруем логин
	$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    //хешируем пароль т.к. в базе именно хеш
	$password = md5(trim($_POST['password']));
     // проверяем введенные данные
    $query = "SELECT user_id, user_login
            FROM users
            WHERE user_login= '$login' AND user_password = '$password'
            LIMIT 1";
    $sql = mysql_query($query) or die(mysql_error());
    // если такой пользователь есть
    if (mysql_num_rows($sql) == 1) {
        $row = mysql_fetch_assoc($sql);
		//ставим метку в сессии 
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_login'] = $row['user_login'];
		//ставим куки и время их хранения 10 дней
		setcookie("CookieMy", $row['user_login'], time()+60*60*24*1);
		header ("Location: index.php");
   }
    else {
        //если пользователя нет, то пусть пробует еще
		echo "<script>alert\"Такого пользователя не сушествует.\"</script>";
		header("Location: index.php"); 
    }
}
//проверяем сессию, если она есть, то значит уже авторизовались
if (isset($_SESSION['user_id'])){
	//echo htmlspecialchars($_SESSION['user_login']);
	$userlog = htmlspecialchars($_SESSION['user_login']);
	$log = 1;
} else {
	$login = '';
	//проверяем куку, может он уже заходил сюда
	if (isset($_COOKIE['CookieMy'])){
		$login = htmlspecialchars($_COOKIE['CookieMy']);
	}
	//простая формочка
	print <<< 	form
<form action="login.php" method="POST" id=login_form>
		Логин <input name="login" type="text" value = $login>
		Пароль <input name="password" type="password">
		<input class=sbm name="submit" type="submit" value="Войти">
	</form>
form;
}
?>