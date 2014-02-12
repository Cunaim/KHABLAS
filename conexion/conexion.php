<?php
# FileName="Connection_php_mysql.html"
# Type="MYSQL"
# HTTP="true"
$hostname = "127.0.0.1";
$database = "khablas";
$username = "root";
$password = "root1";
$khablasweb = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database, $khablasweb);
?>