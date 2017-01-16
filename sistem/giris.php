<?php require_once("../moduller/sistem_baglanti.php"); ?>
<?php
$kimlik = $_POST['kimlik'];
$sifre = $_POST['sifre'];
$eylem = 1;
$ipnum = $_SERVER['REMOTE_ADDR'];
$sql = sprintf(
"SELECT *
 FROM kullanici
 WHERE kimlik = '%s' AND sifre = '%s'",
 mysql_real_escape_string($kimlik, $baglanti),
 mysql_real_escape_string($sifre, $baglanti)
);
$sonuc = mysql_query($sql, $baglanti);
$sonuc_toplam = mysql_num_rows($sonuc);
if($sonuc_toplam == 1){
	$satir = mysql_fetch_assoc($sonuc);
	session_start();
	$_SESSION['KK'] = $satir['kimlik'];
	$_SESSION['YK'] = $satir['yetki'];
	$insert_sql = sprintf(
	"INSERT INTO giris_cikis (kimlik, eylem, ipnum) VALUES ('%s', '%s', '%s')",
	 mysql_real_escape_string($kimlik, $baglanti),
	 mysql_real_escape_string($eylem, $baglanti),
	 mysql_real_escape_string($ipnum, $baglanti));
	$giris_kayit = mysql_query($insert_sql, $baglanti);
	header("Location: index.php");
} else {
	header("Location: ../index/giris_hata.php");
	}
?>