<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
//Duyuru Sistemi
$duyuru_tnm = "Kampüs Dışı";
$duyuru_sql = sprintf(
	"SELECT D.*, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis, CONCAT(K.ad, ' ', K.soyad) As yayinci
	 FROM duyuru D, kullanici K
	 WHERE D.kimlik = K. Kimlik AND D.alici LIKE('%%[%s]%%') AND bitis < DATE_FORMAT(now(), '%%Y-%%m-%%d')
	 ORDER BY D.baslangic DESC",
	 mysql_real_escape_string($duyuru_tnm)
	);
$duyuru_sonuc = mysql_query($duyuru_sql, $baglanti);
$duyuru_toplam = mysql_num_rows($duyuru_sonuc);
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Language" CONTENT="tr">
<META NAME="Copyright" CONTENT="Orçun Madran">
<META NAME="Author" CONTENT="Orçun Madran">
<META NAME="keywords" CONTENT="Orçun Madran, Orcun Madran, Orçun, Orcun, Madran, Uzaktan Eğitim, Uzaktan Öğretim, Web Tabanlı Eğitim, Web Tabanlı Öğretim,  e-Öğrenme, Distance Education, Web Based Education, e-Learning, LMS, LCMS">
<META NAME="description" CONTENT="<?php echo $sistem_adi ?>">
<META NAME="ROBOTS" CONTENT="ALL">
<link href="../stiller.css" rel="stylesheet" type="text/css">
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">Duyuru Arşivi (<?php echo $duyuru_toplam; ?>) </p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="100%" border="0" align="right" cellpadding="3" cellspacing="2">
          <tr>
            <td>&nbsp;</td>
            <td colspan="4" class="arabaslik">&nbsp;</td>
          </tr>
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
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>