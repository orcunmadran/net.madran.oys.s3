<?php
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9");
require_once("../moduller/sistem_baglanti.php");
require_once("../moduller/sistem_guvenlik.php");
?>
<?php
$kimlik = $_SESSION['KK'];
$eylem = 0;
$ipnum = $_SERVER['REMOTE_ADDR'];
$insert_sql = sprintf(
	"INSERT INTO giris_cikis (kimlik, eylem, ipnum) VALUES ('%s', '%s', '%s')",
	 mysql_real_escape_string($kimlik, $baglanti),
	 mysql_real_escape_string($eylem, $baglanti),
	 mysql_real_escape_string($ipnum, $baglanti));
$giris_kayit = mysql_query($insert_sql, $baglanti);
unset($_SESSION['KK'], $_SESSION['KY']);
header("Location: ../index/index.php");
?>