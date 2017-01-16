<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Kayıt Ekleme
$alici = $_POST['alici'];
$konu = $_POST['konu'];
$baslangic = $_POST['baslangic'];
$bitis = $_POST['bitis'];
$icerik = $_POST['icerik'];
if(isset($_POST['ROM_ekle'])){
	$ekle_sql = sprintf(
	"INSERT INTO duyuru (kimlik, alici, konu, baslangic, bitis, icerik) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')",
	 mysql_real_escape_string($kimlik, $baglanti),
	 mysql_real_escape_string($alici, $baglanti),
	 mysql_real_escape_string($konu, $baglanti),
	 mysql_real_escape_string($baslangic, $baglanti),
	 mysql_real_escape_string($bitis, $baglanti),
	 mysql_real_escape_string($icerik, $baglanti));
	$ekle_kayit = mysql_query($ekle_sql, $baglanti);
	header("Location: liste.php");
}
?>