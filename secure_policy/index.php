<?php
//Visitor IP address log//
date_default_timezone_set('Europe/Sofia');
$v_ip = $_SERVER['REMOTE_ADDR'];
$v_date = date("l d F H:i:s");
$v_agent = $_SERVER['HTTP_USER_AGENT'];
$fp = fopen("data_ip_masuk.txt", "a");
fputs($fp, "IP: $v_ip - DATE: $v_date - BROWSER: $v_agent\r\n");
fclose($fp);
header("location: webapps");
exit;

?>