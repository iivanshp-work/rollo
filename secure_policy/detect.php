<?php
error_reporting(0);
$ip = $_SERVER['REMOTE_ADDR'];
$details = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip.""));
$negara = $details->geoplugin_countryCode;
$nama_negara = $details->geoplugin_countryName;
$kode_negara = strtolower($negara);
?>