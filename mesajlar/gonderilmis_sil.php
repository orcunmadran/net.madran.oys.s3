<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

//Mesal Sil
$sil_tnm = $_GET['mesajno'];
$sil_sql = sprintf
	(
	"SELECT * FROM mesaj WHERE no = '%s' AND gonderen = '%s'",
	mysql_real_escape_string($sil_tnm, $baglanti),
	mysql_real_escape_string($kimlik, $baglanti)
	);
$sil_sonuc = mysql_query($sil_sql, $baglanti);
$sil_toplam = mysql_num_rows($sil_sonuc);
$satir_sil = mysql_fetch_assoc($sil_sonuc);
//Guncelleme icin kullanilacak veri
$silindi = $satir_sil['silindi']."[".$kimlik."] ";
if($sil_toplam == 1){
	$sil2_sql = sprintf
		(
		"UPDATE mesaj SET silindi = '%s' WHERE no = '%s'",
		mysql_real_escape_string($silindi, $baglanti),
		mysql_real_escape_string($sil_tnm, $baglanti)
		);
	$kayit_sil = mysql_query($sil2_sql, $baglanti);
	header("Location: gonderilmisler.php");
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
                <li class="icyazi">Silmek istediğiniz mesaj size ait olmayabilir.</li>
                <li class="icyazi">Silmek istediğiniz mesaj daha önce sizin tarafınızdan silinmiş olabilir.</li>
                </ul>
              <p class="icyazi">Önceki işlem adımına geri dönmek için <a href="javascript:history.back()">tıklayınız</a>. </p></td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>