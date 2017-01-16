<?php
//Veritabanı Bağlantısı
$sunucu = "localhost";
$veritabani = "sanalkampus";
$kullanici = "root_sanalkampus";
$sifre = "9360673";
$baglanti = mysql_pconnect($sunucu, $kullanici, $sifre) or trigger_error(mysql_error(),E_USER_ERROR);

//Türkçe Karakter UTF-8
setlocale(LC_ALL, "tr_TR");
mysql_select_db($veritabani, $baglanti);
$SQL1 = "SET CHARACTER SET utf8";
$SQL2 = "SET NAMES 'utf8'";
$isle = mysql_query($SQL1, $baglanti) or die(mysql_error());
$isle2 = mysql_query($SQL2, $baglanti) or die(mysql_error());
?>