<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yklenen Modller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
//Form degiskenleri
$gonderen = $_POST['gonderen'];
$alici = $_POST['alici'];
$konu = $_POST['konu'];
$icerik = $_POST['icerik'];
if(isset($_POST['ROM_ekle'])){
	$ekle_sql = sprintf(
	"INSERT INTO mesaj (gonderen, alici, konu, icerik) VALUES ('%s', '%s', '%s', '%s')",
	 mysql_real_escape_string($gonderen, $baglanti),
	 mysql_real_escape_string($alici, $baglanti),
	 mysql_real_escape_string($konu, $baglanti),
	 mysql_real_escape_string($icerik, $baglanti));
	$ekle_kayit = mysql_query($ekle_sql, $baglanti);
	header("Location: gonderilmisler.php");
}
?>