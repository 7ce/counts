<?php
	mysql_connect ("localhost", "test","testmysql");//������ ���� ���������
	mysql_select_db("test") or die (mysql_error());//� ���� ��
	//mysql_query('SET character_set_database = utf8'); 
	//mysql_query ("SET NAMES 'utf8'");
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	@session_start();//�� �������� �� ���� ������ ������ session_start
if (isset($_POST['login']) && isset($_POST['password'])){
    //������� ������������ �����
	$login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    //�������� ������ �.�. � ���� ������ ���
	$password = md5(trim($_POST['password']));
     // ��������� ��������� ������
    $query = "SELECT user_id, user_login
            FROM users
            WHERE user_login= '$login' AND user_password = '$password'
            LIMIT 1";
    $sql = mysql_query($query) or die(mysql_error());
    // ���� ����� ������������ ����
    if (mysql_num_rows($sql) == 1) {
        $row = mysql_fetch_assoc($sql);
		//������ ����� � ������ 
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['user_login'] = $row['user_login'];
		//������ ���� � ����� �� �������� 10 ����
		setcookie("CookieMy", $row['user_login'], time()+60*60*24*1);
		header ("Location: index.php");
   }
    else {
        //���� ������������ ���, �� ����� ������� ���
		echo "<script>alert\"������ ������������ �� ����������.\"</script>";
		header("Location: index.php"); 
    }
}
//��������� ������, ���� ��� ����, �� ������ ��� ��������������
if (isset($_SESSION['user_id'])){
	//echo htmlspecialchars($_SESSION['user_login']);
	$userlog = htmlspecialchars($_SESSION['user_login']);
	$log = 1;
} else {
	$login = '';
	//��������� ����, ����� �� ��� ������� ����
	if (isset($_COOKIE['CookieMy'])){
		$login = htmlspecialchars($_COOKIE['CookieMy']);
	}
	//������� ��������
	print <<< 	form
<form action="login.php" method="POST" id=login_form>
		����� <input name="login" type="text" value = $login>
		������ <input name="password" type="password">
		<input class=sbm name="submit" type="submit" value="�����">
	</form>
form;
}
?>