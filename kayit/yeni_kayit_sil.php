<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");

//Onay Kodu Kontrol
$onay_kodu = $_GET['onaykodu'];
$KSsil_sql = sprintf
	(
	"SELECT * FROM kullanici WHERE onay_kodu = '%s' AND yetki = 0",
	mysql_real_escape_string($onay_kodu, $baglanti)
	);
$KSsil_sonuc = mysql_query($KSsil_sql, $baglanti);
$KSsil_sonuc_toplam = mysql_num_rows($KSsil_sonuc);
$satir_KSsil = mysql_fetch_assoc($KSsil_sonuc);
if($KSsil_sonuc_toplam == 1 && isset($_GET['onaykodu']) && $_GET['onaykodu'] != NULL){
	$onay_hata = 0;
	$delete_sql = sprintf
		(
		"DELETE FROM kullanici WHERE kimlik= '%s'",
		mysql_real_escape_string($satir_KSsil['kimlik'], $baglanti)
		);
	$kayit_sil = mysql_query($delete_sql, $baglanti);
}
else{
	$onay_hata = 1;
	}
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">&nbsp;</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
        <table width="310" border="0" cellpadding="3" cellspacing="2">
          <tr>
            <td width="300"><img src="../resimler/genel/logo.gif" width="300" height="75"></td>
          </tr>
          <tr>
            <td class="arabaslik"><hr size="1"></td>
          </tr>
          <?php if($onay_hata == 0){?>
          <tr>
            <td class="arabaslik">Başvuru Silindi</td>
          </tr>
          <tr>
            <td class="icyazi">Başvurunuz sistemden silinmiştir.</td>
          </tr>
          <?php };?>
          <?php if($onay_hata == 1){?>
          <tr>
            <td class="formuyari">Sistem Mesajı !</td>
          </tr>
          <tr>
            <td class="icyazi">"<span class="arabaslik"><?php echo $_GET['onaykodu']; ?></span>"  onay kodu ile onay bekleyen bir başvuru sistemimizde kayıtlı bulunmamaktadır.</td>
          </tr>
          <?php };?>
        </table>
        </td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>