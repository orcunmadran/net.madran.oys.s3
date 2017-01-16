<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Profil Oluşturma
$profil_kimlik = $_GET['kimlik'];
$profil_sql = sprintf(
	"SELECT K.*, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
	 FROM kullanici K, yetki_seviyesi YS
	 WHERE K.yetki = YS.no AND K.kimlik = '%s'",
	 mysql_real_escape_string($profil_kimlik, $baglanti)
	);
$profil_sonuc = mysql_query($profil_sql, $baglanti);
$profil_toplam = mysql_num_rows($profil_sonuc);
$profil_satir = mysql_fetch_assoc($profil_sonuc);
//Avatar Kontrol
$profil_avatar= "../resimler/avatar/".$profil_satir['kimlik'].".jpg";
if (file_exists($profil_avatar)) {
    $profil_avatar = "../resimler/avatar/".$profil_satir['kimlik'].".jpg";
} else {
    $profil_avatar = "../resimler/avatar/avatar.jpg";
} 
//Kullanıcı İstatistikleri
$sql_ist = sprintf(
	"SELECT GC.*, DATE_FORMAT(GC.tarihsaat, '%%d.%%m.%%Y - %%H:%%i') AS ftarihsaat
	 FROM kullanici K, giris_cikis GC
	 WHERE K.kimlik = GC.kimlik AND GC.eylem = 1 AND K.kimlik = '%s'
	 ORDER BY GC.sirano DESC",
	 mysql_real_escape_string($profil_kimlik, $baglanti)
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
<script type="text/javascript">
function formkontrol(){
	if( document.form1.konu.value == "" |
		document.form1.icerik.value == "" |
		document.form1.konu.value == "Konu" |
		document.form1.icerik.value == "İçerik"){
		alert("Konu ve / veya içerik giriniz.");
		}
	else {document.form1.submit();}
}
</script>
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
            <td width="50%" class="anabaslik">Kullanıcı Profili</td>
            <td width="5%" class="anabaslik"><img src="../resimler/simge/fotograf2.gif" width="24" height="24"></td>
            <td width="20%" class="anabaslik">Fotoğraf (Avatar)</td>
            <td width="20%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td class="anabaslik"><table border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td nowrap class="arabaslik">Kullanıcı Adı</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $profil_satir['kimlik'] ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Ad</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $profil_satir['ad'] ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Soyad</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $profil_satir['soyad'] ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Yetki Seviyesi</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><?php echo $profil_satir['yetkiseviyesi'] ?></td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">E - Posta</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><a href="mailto:<?php echo $profil_satir['eposta'] ?>"><?php echo $profil_satir['eposta'] ?></a></td>
              </tr>
              <tr>
                <td height="19" nowrap class="arabaslik">Web Adresi</td>
                <td class="arabaslik"><div align="center">:</div></td>
                <td nowrap class="icyazi"><a href="<?php echo $profil_satir['web'] ?>" target="_blank"><?php echo $profil_satir['web'] ?></a></td>
              </tr>
            </table></td>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><span class="arabaslik"><img src="<?php echo $profil_avatar; ?>" name="avatar" width="125" height="125" class="avatar" style="background-color: #C8C8C8" title="<?php echo $profil_satir['adsoyad'] ?>"></span></td>
            <td valign="top">&nbsp;</td>
          </tr>
          <tr>
            <td class="anabaslik"><img src="../resimler/simge/mesajlar2.gif" width="24" height="24"></td>
            <td class="anabaslik">Sistem İçi Mesaj</td>
            <td class="anabaslik"><img src="../resimler/simge/kullanici_istatistikleri.gif" width="24" height="24"></td>
            <td colspan="2" class="anabaslik">Kullanıcı İstatistikleri</td>
            </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td><form name="form1" method="post" action="../mesajlar/gonder.php">
              <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                  <td><input name="konu" type="text" class="metinkutusu" id="konu" value="Konu" size="40" tabindex="1">                    <input type="button" class="buton_ince" tabindex="3" value="Gönder" onClick="formkontrol()">
                    <span class="icyazi">
                    <input name="gonderen" type="hidden" id="gonderen" value="<?php echo $kimlik ?>">
                    <input name="alici" type="hidden" id="alici" value="<?php echo "[".$profil_satir['kimlik']."]" ?>">
                    <input name="ROM_ekle" type="hidden" id="ROM_ekle" value="OK">
                    </span></td>
                  </tr>
                <tr>
                  <td><textarea name="icerik" cols="55" rows="5" class="metinkutusu" id="icerik" tabindex="2">İçerik</textarea></td>
                </tr>
              </table>
                        </form>            </td>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" valign="top" class="anabaslik"><table border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td nowrap class="arabaslik">Toplam Oturum</td>
                <td class="arabaslik">:</td>
                <td class="icyazi"><?php echo $sonuc_toplam_ist ?> kere giriş yaptı.</td>
              </tr>
              <tr>
                <td nowrap class="arabaslik">Son Oturum </td>
                <td class="arabaslik">:</td>
                <td class="icyazi"><?php echo $giris_ist[0]; ?></td>
              </tr>
            </table></td>
            </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>