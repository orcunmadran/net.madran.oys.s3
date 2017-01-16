<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Duyuru Ayrinti (duyuru)
$duyuruno = $_GET['duyuruno'];
$duyuru_sql = sprintf(
	"SELECT D.*, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis, CONCAT(K.ad, ' ', K.soyad) AS yadsoyad
	 FROM duyuru D, kullanici K
	 WHERE  D.kimlik = K.kimlik AND D.no = '%s' AND D.kimlik = '%s'",
	 mysql_real_escape_string($duyuruno, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
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
            <td width="72%" class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; <a href="liste.php">Oluşturulmuş Duyurular</a> &gt; Duyuru Görüntüle</td>
            <td width="18%" nowrap class="icyazi"><table border="0" cellspacing="2" cellpadding="2">
              <tr class="icyazi">
                <td><a href="olustur.php"><img src="../resimler/mesaj/duyuru.gif" alt="DUYURU OLUŞTUR" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="olustur.php">Duyuru Oluştur </a></td>
                </tr>
            </table></td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" valign="top" class="anabaslik"><table width="100%" border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td width="13%" valign="top" class="arabaslik">Yayınlayan</td>
                <td width="2%" valign="top" class="arabaslik">:</td>
                <td colspan="3" valign="top" class="icyazi"><?php echo $duyuru_satir['yadsoyad'] ?></td>
                <td width="18%" rowspan="5" valign="top" class="icyazi"><span class="arabaslik"><img src="<?php echo $avatar_gonderen; ?>" name="avatar" width="100" height="100" class="avatar" style="background-color: #C8C8C8" title="<?php echo $mesaj_satir['gadsoyad']; ?>"></span></td>
              </tr>
              <tr valign="top">
                <td class="arabaslik">Alıcılar</td>
                <td class="arabaslik">:</td>
                <td colspan="3" class="icyazi"><span class="icyazi"><?php echo $duyuru_satir['alici'] ?></span></td>
                </tr>
              <tr valign="top">
                <td class="arabaslik">Konu</td>
                <td class="arabaslik">:</td>
                <td colspan="3" class="icyazi"><?php echo stripslashes($duyuru_satir['konu']) ?></td>
                </tr>
              <tr valign="top">
                <td nowrap class="arabaslik">Yayın Aralığı </td>
                <td class="arabaslik">:</td>
                <td width="59%" class="icyazi"><?php echo $duyuru_satir['tbaslangic'] ?> - <?php echo $duyuru_satir['tbitis'] ?></td>
                <td width="4%" class="icyazi"><div align="center"><a href="guncelle.php?duyuruno=<?php echo $duyuru_satir['no']; ?>"><img src="../resimler/simge/guncelle.gif" alt="DUYURU GÜNCELLE" width="16" height="16" border="0"></a></div></td>
                <td width="4%" class="icyazi"><a href="sil.php?duyuruno=<?php echo $duyuru_satir['no']; ?>" onClick="return confirm('Duyuru kalıcı olarak silinecektir.')"><img src="../resimler/simge/sil.gif" alt="Duyuruyu silmek için tıklayınız." width="16" height="16" border="0"></a></td>
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
                <td width="18%" valign="top" class="icyazi">&nbsp;</td>
              </tr>
            </table>
            </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>