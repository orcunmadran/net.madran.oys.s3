<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
//Duyuru Ayrinti (duyuru)
$duyuruno = $_GET['duyuruno'];
$duyuru_tnm = "Kampüs Dışı";
$duyuru_sql = sprintf(
	"SELECT D.*, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis, CONCAT(K.ad, ' ', K.soyad) AS yadsoyad
	 FROM duyuru D, kullanici K
	 WHERE  D.kimlik = K.kimlik AND D.no = '%s' AND D.alici LIKE('%%[%s]%%')",
	 mysql_real_escape_string($duyuruno, $baglanti),
	 mysql_real_escape_string($duyuru_tnm, $baglanti)
	);
$duyuru_sonuc = mysql_query($duyuru_sql, $baglanti);
$duyuru_toplam = mysql_num_rows($duyuru_sonuc);
$duyuru_satir = mysql_fetch_assoc($duyuru_sonuc);
//Avatar Kontrol
$avatar_gonderen = "../resimler/avatar/".$duyuru_satir['kimlik'].".jpg";
if (file_exists($avatar_gonderen)) {
    $avatar_gonderen = "../resimler/avatar/".$duyuru_satir['kimlik'].".jpg";
} else {
    $avatar_gonderen = "../resimler/avatar/avatar.jpg";
}
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
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">Duyuru Ayrıntı</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td valign="top" class="arabaslik">&nbsp;</td>
            <td valign="top" class="arabaslik">&nbsp;</td>
            <td colspan="3" valign="top" class="icyazi">&nbsp;</td>
            <td width="16%" valign="top" class="icyazi">&nbsp;</td>
          </tr>
          <tr>
            <td width="12%" valign="top" class="arabaslik">Yayınlayan</td>
            <td width="2%" valign="top" class="arabaslik">:</td>
            <td colspan="3" valign="top" class="icyazi"><?php echo $duyuru_satir['yadsoyad'] ?></td>
            <td width="16%" rowspan="5" valign="top" class="icyazi"><span class="arabaslik"><img src="<?php echo $avatar_gonderen; ?>" name="avatar" width="100" height="100" class="avatar" style="background-color: #C8C8C8" title="<?php echo $mesaj_satir['gadsoyad']; ?>"></span></td>
          </tr>
          <tr valign="top">
            <td class="arabaslik">Alıcılar</td>
            <td class="arabaslik">:</td>
            <td colspan="3" class="icyazi"><?php echo $duyuru_satir['alici'] ?></td>
            </tr>
          <tr valign="top">
            <td class="arabaslik">Konu</td>
            <td class="arabaslik">:</td>
            <td colspan="3" class="icyazi"><?php echo stripslashes($duyuru_satir['konu']) ?></td>
            </tr>
          <tr valign="top">
            <td nowrap class="arabaslik">Yayın Aralığı </td>
            <td class="arabaslik">:</td>
            <td width="65%" class="icyazi"><?php echo $duyuru_satir['tbaslangic'] ?> - <?php echo $duyuru_satir['tbitis'] ?><a href="sil.php?duyuruno=<?php echo $duyuru_satir['no']; ?>" onClick="return confirm('Duyuru kalıcı olarak silinecektir.')"></a></td>
            <td width="2%" nowrap class="icyazi"><a href="arsiv.php">Duyuru Arşivi </a></td>
            <td width="3%" class="icyazi"><a href="arsiv.php"><img src="../resimler/mesaj/arsiv.gif" alt="DUYURU ARŞİVİ" width="16" height="15" border="0" title="DUYURU ARŞİVİ"></a></td>
          </tr>
          <tr>
            <td class="arabaslik">&nbsp;</td>
            <td class="arabaslik">&nbsp;</td>
            <td colspan="3" class="icyazi"><hr class="cizgi"></td>
            </tr>
          <tr>
            <td class="arabaslik">&nbsp;</td>
            <td class="arabaslik">&nbsp;</td>
            <td colspan="3" class="icyazi"><?php echo str_replace("\n","<br>", stripslashes($duyuru_satir['icerik'])); ?></td>
            <td width="16%" valign="top" class="icyazi">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>