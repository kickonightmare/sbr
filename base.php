<?php

header('Content-Type: text/html; charset=utf-8');

$host = "localhost";
$base = "sistema";
$user = "sistema";
$pass = "sistema123";
$con = mysql_pconnect($host, $user, $pass) or trigger_error(mysql_error(), E_USER_ERROR);

//mysql_select_db($base, $con);
//$s=mysql_query($sql, $con) or die(mysql_error());
//while($f=mysql_fetch_assoc($s)) {
//    
//}

function somenteNumeros($s) {
    if (!empty($s)) {
        return preg_replace("/[^0-9]/", "", $s);
    }
}