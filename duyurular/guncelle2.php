<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yuklenen Moduller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
//Form degiskenleri
$duyuruno = $_POST['no'];
$alici = $_POST['alici'];
$konu = $_POST['konu'];
$baslangic = $_POST['baslangic'];
$bitis = $_POST['bitis'];
$icerik = $_POST['icerik'];
if(isset($_POST['ROM_Guncelle'])){
	$guncelle_sql = sprintf
		(
		"UPDATE duyuru SET alici = '%s', konu = '%s', baslangic = '%s', bitis = '%s', icerik = '%s' WHERE kimlik = '%s' AND no = '%s'",
		mysql_real_escape_string($alici, $baglanti),
		mysql_real_escape_string($konu, $baglanti),
		mysql_real_escape_string($baslangic, $baglanti),
		mysql_real_escape_string($bitis, $baglanti),
		mysql_real_escape_string($icerik, $baglanti),
		mysql_real_escape_string($kullanici_kodu, $baglanti),
		mysql_real_escape_string($duyuruno, $baglanti)
		);
	$kayit_guncelle = mysql_query($guncelle_sql, $baglanti);
	$adres = "Location: duyuru.php?duyuruno=".$duyuruno;
	header($adres);
}
else{
echo "hata";
}
?>