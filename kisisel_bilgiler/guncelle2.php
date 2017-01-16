<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yuklenen Moduller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
//Form degiskenleri
$eposta = $_POST['eposta'];
$web = $_POST['web'];
if(isset($_POST['ROM_Guncelle'])){
	$guncelle_sql = sprintf
		(
		"UPDATE kullanici SET eposta = '%s', web = '%s' WHERE kimlik= '%s'",
		mysql_real_escape_string($eposta, $baglanti),
		mysql_real_escape_string($web, $baglanti),
		mysql_real_escape_string($kimlik, $baglanti)
		);
	$kayit_onay = mysql_query($guncelle_sql, $baglanti);
	header("Location: index.php?islem=1");
}
?>