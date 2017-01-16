<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Kullanıcı İstatistikleri
$sql_ist = sprintf(
	"SELECT GC.*, DATE_FORMAT(GC.tarihsaat, '%%d.%%m.%%Y - %%H:%%i') AS ftarihsaat
	 FROM kullanici K, giris_cikis GC
	 WHERE K.kimlik = GC.kimlik AND GC.eylem = 1 AND K.kimlik = '%s'
	 ORDER BY GC.sirano DESC",
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$sonuc_ist = mysql_query($sql_ist, $baglanti);
$sonuc_toplam_ist = mysql_num_rows($sonuc_ist);
$giris_ist = array();
$ip_ist = array();
for($i=0; $i<2; $i++){
$satir_ist = mysql_fetch_assoc($sonuc_ist);
$giris_ist[$i] = $satir_ist['ftarihsaat'];
$ip_ist[$i] = $satir_ist['ipnum'];
}
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="70" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td><?php echo $sistem_logo; ?></td>
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
        <td colspan="2" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td height="24" colspan="2" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td width="5%" class="anabaslik"><img src="../resimler/simge/kisisel_bilgiler.gif" width="24" height="24"></td>
            <td width="45%" class="anabaslik">Kişisel Bilgiler</td>
            <td width="5%" class="anabaslik"><img src="../resimler/simge/fotograf2.gif" width="24" height="24"></td>
            <td width="40%" class="anabaslik">Fotoğraf (Avatar)</td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td class="anabaslik"><table border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td nowrap class="arabaslik">Kullanıcı Adı</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $kimlik ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Ad</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $ad ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Soyad</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $soyad ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Yetki Seviyesi</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $yetki.' - '.$yetkiseviyesi ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">E - Posta</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><a href="mailto:<?php echo $eposta ?>"><?php echo $eposta ?></a></td>
              </tr>
              <tr>
                <td height="19" nowrap class="arabaslik">Web Adresi</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><a href="<?php echo $web ?>" target="_blank"><?php echo $web ?></a></td>
              </tr>
            </table></td>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><span class="arabaslik"><img src="<?php echo $avatar; ?>" name="avatar" width="125" height="125" class="avatar" style="background-color: #C8C8C8" title="<?php echo $adsoyad ?>"></span></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td class="anabaslik"><img src="../resimler/simge/kullanici_islemleri.gif" width="24" height="24"></td>
            <td class="anabaslik">Kullanıcı İşlemleri</td>
            <td class="anabaslik"><img src="../resimler/simge/kullanici_istatistikleri.gif" width="24" height="24"></td>
            <td class="anabaslik">Kullanıcı İstatistikleri</td>
            <td nowrap>&nbsp;</td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td class="anabaslik"><table border="0" align="left" cellpadding="3" cellspacing="2">
              <tr>
                <td><div align="center"><a href="guncelle.php"><img src="../resimler/simge/guncelle.gif" alt="BİLGİLERİ GÜNCELLE" width="16" height="16" border="0"></a></div></td>
                <td nowrap><span class="icyazi"><a href="guncelle.php">Bilgileri Güncelle</a></span>
                    <?php if($_GET['islem']==1){?>
                  <span class="formuyari"> - Tamamlandı</span>
                  <?php }?></td>
              </tr>
              <tr>
                <td><div align="center"><a href="sifre.php"><img src="../resimler/simge/sifre_degistir.gif" alt="ŞİFRE DEĞİŞTİR" width="16" height="16" border="0"></a></div></td>
                <td nowrap><span class="icyazi"><a href="sifre.php">Şifre Değiştir</a></span>
                    <?php if($_GET['islem']==2){?>
                  <span class="formuyari"> - Tamamlandı</span>
                  <?php }?></td>
              </tr>
              <tr>
                <td><div align="center"><a href="../kisisel_bilgiler_avatar.php"><img src="../resimler/simge/fotograf.gif" alt="GÖRÜNTÜ RESMİ YÜKLE / GÜNCELLE" width="16" height="16" border="0"></a></div></td>
                <td nowrap class="icyazi"><a href="resim.php">Fotoğraf  Yükle / Güncelle</a>
                    <?php if($_GET['islem']==3){?>
                  <span class="formuyari"> - Tamamlandı</span>
                  <?php }?></td>
              </tr>
            </table></td>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" class="anabaslik"><table border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td nowrap class="arabaslik">Toplam Oturum</td>
                <td class="arabaslik">:</td>
                <td class="icyazi"><?php echo $sonuc_toplam_ist ?> kere giriş yaptınız.</td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Güncel Oturum </td>
                <td class="arabaslik">:</td>
                <td class="icyazi"><?php echo $giris_ist[0]; ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Son Oturum</td>
                <td class="arabaslik">:</td>
                <td class="icyazi"><?php echo $giris_ist[1]; ?></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>