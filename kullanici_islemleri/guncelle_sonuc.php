<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4");
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Form degiskenleri
$g_kimlik = $_POST['kimlik'];
$g_sifre = $_POST['sifre'];
$g_ad = $_POST['ad'];
$g_soyad = $_POST['soyad'];
$g_yetki = $_POST['yetki'];
$g_eposta = $_POST['eposta'];
$g_web = $_POST['web'];
if(isset($_POST['ROM_Guncelle'])){
	$guncelle_sql = sprintf
		(
		"UPDATE kullanici SET sifre = '%s', ad = '%s', soyad = '%s', yetki = '%s', eposta = '%s', web = '%s' WHERE kimlik= '%s'",
		mysql_real_escape_string($g_sifre, $baglanti),
		mysql_real_escape_string($g_ad, $baglanti),
		mysql_real_escape_string($g_soyad, $baglanti),
		mysql_real_escape_string($g_yetki, $baglanti),
		mysql_real_escape_string($g_eposta, $baglanti),
		mysql_real_escape_string($g_web, $baglanti),
		mysql_real_escape_string($g_kimlik, $baglanti)
		);
	$kullanici_guncelle = mysql_query($guncelle_sql, $baglanti);
}
//Profil Oluşturma
$profil_kimlik = $_POST['kimlik'];
$profil_sql = sprintf(
	"SELECT K.*, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
	 FROM kullanici K, yetki_seviyesi YS
	 WHERE K.yetki = YS.no AND K.kimlik = '%s'",
	 mysql_real_escape_string($profil_kimlik, $baglanti)
	);
$profil_sonuc = mysql_query($profil_sql, $baglanti);
$profil_toplam = mysql_num_rows($profil_sonuc);
$profil_satir = mysql_fetch_assoc($profil_sonuc);
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/kisisel_bilgiler.gif" width="24" height="24"></td>
            <td class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; <a href="javascript:history.go(-2)">Kullanıcı Listesi/Arama Sonuçları</a> &gt; <a href="javascript:history.back()">Kullanıcı Bilgilerini Güncelle</a> &gt; Sonuç</td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><form name="form1" method="post" action="guncelle_sonuc.php">
              <table width="100%" border="0" cellpadding="3" cellspacing="2">
                <tr>
                  <td colspan="3" nowrap><table border="0" cellspacing="2" cellpadding="3">
                    <tr>
                      <td><img src="../resimler/simge/sistem_mesaji.gif" width="24" height="24"></td>
                      <td class="arabaslik">Sistem Mesajı</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><span class="formuyari">Kullanıcı bilgileri başarı ile güncellendi.</span></td>
                    </tr>
                  </table></td>
                  </tr>
                <tr>
                  <td width="69" nowrap class="arabaslik">Kullanıcı Adı</td>
                  <td width="3" class="arabaslik">:</td>
                  <td width="522" class="icyazi"><?php echo $profil_satir['kimlik']?></td>
                </tr>
                <?php if($yetki == 1) {?>
                <tr>
                  <td nowrap class="arabaslik">Şifre</td>
                  <td class="arabaslik">:</td>
                  <td nowrap class="icyazi"><?php echo $profil_satir['sifre']?></td>
                  </tr>
				<?php }else{ ?>
                  <tr>
                  <td nowrap class="arabaslik">Şifre</td>
                  <td class="arabaslik">:</td>
                  <td nowrap class="icyazi">********</td>
                  </tr>
                <?php }?> 
                <tr>
                  <td nowrap class="arabaslik">Ad</td>
                  <td class="arabaslik">:</td>
                  <td class="icyazi"><?php echo $profil_satir['ad']?></td>
                </tr>
                <tr>
                  <td nowrap class="arabaslik">Soyad</td>
                  <td class="arabaslik">:</td>
                  <td class="icyazi"><?php echo $profil_satir['soyad']?></td>
                </tr>
                <tr>
                  <td nowrap class="arabaslik">Yetki</td>
                  <td class="arabaslik">:</td>
                  <td class="icyazi"><?php echo $profil_satir['yetkiseviyesi']?></td>
                </tr>
                <tr>
                  <td nowrap class="arabaslik">E - Posta</td>
                  <td class="arabaslik">:</td>
                  <td class="icyazi"><?php echo $profil_satir['eposta']?></td>
                </tr>

                <tr>
                  <td nowrap class="arabaslik">Web</td>
                  <td class="arabaslik">:</td>
                  <td class="icyazi"><?php echo $profil_satir['web']?></td>
                </tr>
              </table>
                        </form>
              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>