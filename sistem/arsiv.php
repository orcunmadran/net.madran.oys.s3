<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Duyuru Sistemi
$duyuru_tnm = "Kampüs İçi";
$duyuru_sql = sprintf(
	"SELECT D.*, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis, CONCAT(K.ad, ' ', K.soyad) As yayinci
	 FROM duyuru D, kullanici K
	 WHERE D.kimlik = K. Kimlik AND (D.alici LIKE('%%[%s]%%') OR D.alici LIKE('%%[%s]%%') OR D.alici LIKE('%%[%s]%%')) AND bitis < DATE_FORMAT(now(), '%%Y-%%m-%%d')
	 ORDER BY D.baslangic DESC",
	 mysql_real_escape_string($duyuru_tnm),
	 mysql_real_escape_string($kimlik),
	 mysql_real_escape_string($yetki)
	);
$duyuru_sonuc = mysql_query($duyuru_sql, $baglanti);
$duyuru_toplam = mysql_num_rows($duyuru_sonuc);
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
        <td height="24" colspan="2" valign="top"><table width="100%" height="325" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/duyurular.gif" width="24" height="24"></td>
            <td class="anabaslik">Duyuru Arşivi (<?php echo $duyuru_toplam; ?>) </td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top" class="anabaslik"><table width="100%" border="0" align="right" cellpadding="3" cellspacing="2">

              <tr>
                <td width="3%"><img src="../resimler/mesaj/duyuru.gif" width="16" height="15"></td>
                <td width="59%" bgcolor="#EBEBEB" class="arabaslik">Konu<a href="arsiv.php"></a></td>
                <td width="12%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Yayın Sahibi </div></td>
                <td nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Yayın Tarihi </div></td>
                <td nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Yayın Bitiş Tarihi </div></td>
              </tr>
              <?php for($i=0; $i<$duyuru_toplam; $i++){
			  $duyuru_satir = mysql_fetch_assoc($duyuru_sonuc);?>
              <tr>
                <td valign="top">&nbsp;</td>
                <td valign="top" class="icyazi"><a href="duyuru.php?duyuruno=<?php echo $duyuru_satir['no']; ?>"><?php echo $duyuru_satir['konu'] ?></a></td>
                <td valign="top" nowrap class="icyazi"><div align="center"><?php echo $duyuru_satir['yayinci'] ?></div></td>
                <td width="11%" valign="top" nowrap class="icyazi"><div align="center"><?php echo $duyuru_satir['tbaslangic'] ?></div></td>
                <td width="15%" valign="top" nowrap class="icyazi"><div align="center"><?php echo $duyuru_satir['tbitis'] ?></div></td>
              </tr>
              <?php }?>
            </table>              
              <p>&nbsp;</p>
              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>