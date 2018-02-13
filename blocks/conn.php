<?php
header("Content-Type: text/html; charset=windows-1251");
//This file content the connection info for PostgresDB
$db_host="192.168.5.101";
$db_name="novasys";
$db_user="postgres";
$db_user_p="postdb";
$conn = @pg_connect("host=$db_host user=$db_user dbname=$db_name password=$db_user_p");
  $stat = pg_connection_status($conn);
/*echo '<div id=con_stat';  
  if ($stat === PGSQL_CONNECTION_OK) {
      echo ' class= ok> Соединение установлено<br />';
	  echo @$userlog;
  } else {
      echo ' class= err>Нет соединения';
  }  
  echo '</div>';*/
@pg_set_client_encoding($conn, "WIN");
?>
