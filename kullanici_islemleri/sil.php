<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

//Duyuru Sil
$sil_tnm = $_GET['kimlik'];
$sil_sql = sprintf
	(
	"SELECT * FROM kullanici WHERE kimlik != '$sistem_yonetici_kimlik' AND kimlik = '%s'",
	mysql_real_escape_string($sil_tnm, $baglanti)
	);
$sil_sonuc = mysql_query($sil_sql, $baglanti);
$sil_toplam = mysql_num_rows($sil_sonuc);
$sil_satir = mysql_fetch_assoc($sil_sonuc);
if($sil_toplam == 1 && isset($_GET['kimlik']) && $_GET['kimlik'] != NULL){
	$sil2_sql = sprintf
		(
		"DELETE FROM kullanici WHERE kimlik = '%s'",
		mysql_real_escape_string($sil_satir['kimlik'], $baglanti)
		);
	$kayit_sil = mysql_query($sil2_sql, $baglanti);
	header($_SESSION['sorgu_hatirla']);
}
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="46"><?php echo $sistem_logo; ?></td>
        <td><table width="100%" border="0" cellspacing="2" cellpadding="1">
            <tr>
              <td><?php echo $sistem_ic_tanimlama; ?></td>
            </tr>
            <tr>
              <td><?php echo $sistem_ic_menu; ?></td>
            </tr>
          </table></td>
      </tr>
      
      <tr>
        <td height="19" colspan="2" valign="top"></td>
      </tr>
      <tr>
        <td height="24" colspan="2" valign="top"><table width="100%" height="300" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/sistem_mesaji.gif" width="24" height="24"></td>
            <td class="anabaslik">Sistem Mesajı </td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><p class="formuyari">İşlem Tamamlanamadı</p>
              <p class="arabaslik">İşlemin başarısız olmasına neden olabilecek durumlar aşağıda listelenmiştir: </p>
              <ul>
                <li class="icyazi">Silmek istediğiniz kullanıcı ile  sisteme kayıtlı olmayabilir.</li>
                <li class="icyazi">Silmek istediğiniz kullanıcı daha önceden silinmiş olabilir.</li>
                <li class="icyazi">İlgili kullanıcı varsayılan sistem yöneticisi olabilir.</li>
              </ul>
              <p class="icyazi">Önceki işlem adımına geri dönmek için <a href="javascript:history.back()">tıklayınız</a>. </p></td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>