<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4");
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
require("../moduller/izin_listesi.php");
//Profil Oluşturma
$profil_kimlik = $_GET['kimlik'];
$profil_sql = sprintf(
	"SELECT K.*, K.yetki, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
	 FROM kullanici K, yetki_seviyesi YS
	 WHERE K.yetki = YS.no AND K.kimlik = '%s'",
	 mysql_real_escape_string($profil_kimlik, $baglanti)
	);
$profil_sonuc = mysql_query($profil_sql, $baglanti);
$profil_toplam = mysql_num_rows($profil_sonuc);
$profil_satir = mysql_fetch_assoc($profil_sonuc);
//Güncelleme Yetki Kontrol
if($yetki >= $profil_satir['yetki']){
header("Location: ../index/yetki_yok.php");
}
//Yetki Listesi
$yetki_sql = sprintf(
	"SELECT *
	 FROM yetki_seviyesi
	 WHERE yetki <> 'Boş' AND yetki <> 'Onaylanmadı' AND no NOT IN($izin)
	 ORDER BY no"
	);
$yetki_sonuc = mysql_query($yetki_sql, $baglanti);
$yetki_toplam = mysql_num_rows($yetki_sonuc);
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//Form Kontrol
function formkontrol(){
	if( document.form1.sifre.value == "" |
		document.form1.ad.value == "" |
		document.form1.soyad.value == "" |
		document.form1.eposta.value == ""){
		alert("Lütfen zorunlu alanları doldurunuz.");
	}
	else {document.form1.submit();}
}
//Şifre Aktif
function sifreuret(){
  chars = "abcdefghiklmnopqrstuvyz1234567890";
  pass = "";
  for(x=0;x<8;x++)
  {
    i = Math.floor(Math.random() * 33);
    pass += chars.charAt(i);
  }
  document.form1.sifre.value = pass;
}
</script>
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
            <td class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; <a href="javascript:history.back()">Kullanıcı Listesi/Arama Sonuçları</a> &gt; Kullanıcı Bilgilerini Güncelle</td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><form name="form1" method="post" action="guncelle_sonuc.php">
              <table width="100%" border="0" cellpadding="3" cellspacing="2">
                <tr>
                  <td nowrap class="arabaslik">Kullanıcı Adı</td>
                  <td width="3" class="arabaslik">:</td>
                  <td colspan="2" class="icyazi"><?php echo $profil_satir['kimlik']?>
                    <input name="kimlik" type="hidden" id="kimlik" value="<?php echo $profil_satir['kimlik']?>"></td>
                </tr>
                <?php if($yetki == 1) {?>
                <tr>
                  <td nowrap class="arabaslik">Şifre</td>
                  <td class="arabaslik">:</td>
                  <td nowrap><input name="sifre" type="text" class="metinkutusu" id="sifre" tabindex="2" value="<?php echo $profil_satir['sifre']?>" size="20" maxlength="20">
                    <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
                  <td width="396" ><input name="Button" type="button" class="buton_ince" value="Şifre Üret" onClick="sifreuret()"></td>
                </tr>
				<?php }else{ ?>
                <tr>
                  <td nowrap class="arabaslik">Şifre</td>
                  <td width="3" class="arabaslik">:</td>
                  <td colspan="2" class="icyazi">********
                    <input name="sifre" type="hidden" id="sifre" value="<?php echo $profil_satir['sifre']?>"></td>
                </tr>
                <?php }?>
                <tr>
                  <td nowrap class="arabaslik">Ad</td>
                  <td class="arabaslik">:</td>
                  <td colspan="2"><input name="ad" type="text" class="metinkutusu" id="ad" tabindex="4" value="<?php echo $profil_satir['ad']?>" size="30" maxlength="40">
                      <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
                </tr>
                <tr>
                  <td nowrap class="arabaslik">Soyad</td>
                  <td class="arabaslik">:</td>
                  <td colspan="2"><input name="soyad" type="text" class="metinkutusu" id="soyad" tabindex="5" value="<?php echo $profil_satir['soyad']?>" size="30" maxlength="40">
                      <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
                </tr>
                <tr>
                  <td nowrap class="arabaslik">Yetki</td>
                  <td class="arabaslik">:</td>
                  <td colspan="2"><select name="yetki" class="metinkutusu" id="yetki">
                    <option value="<?php echo $profil_satir['yetki']?>"><?php echo $profil_satir['yetkiseviyesi']?></option>
					<?php for($i=0; $i<$yetki_toplam; $i++){
					$yetki_satir = mysql_fetch_assoc($yetki_sonuc); ?>
                    <option value="<?php echo $yetki_satir['no'] ?>"><?php echo $yetki_satir['yetki'] ?></option>
                  <?php } ;?>
                  </select>
                    <img src="../resimler/simge/form_uyari.gif" width="12" height="12">                  </td>
                </tr>
                <tr>
                  <td nowrap class="arabaslik">E - Posta</td>
                  <td class="arabaslik">:</td>
                  <td colspan="2"><input name="eposta" type="text" class="metinkutusu" id="eposta" tabindex="6" value="<?php echo $profil_satir['eposta']?>" size="40" maxlength="50">
                      <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
                </tr>

                <tr>
                  <td nowrap class="arabaslik">Web</td>
                  <td class="arabaslik">:</td>
                  <td colspan="2"><input name="web" type="text" class="metinkutusu" id="web" tabindex="8" value="<?php echo $profil_satir['web']?>" size="40" maxlength="50"></td>
                </tr>
                <tr>
                  <td nowrap class="icyazi"><input name="ROM_Guncelle" type="hidden" id="ROM_Guncelle" value="OK" /></td>
                  <td class="icyazi">&nbsp;</td>
                  <td colspan="2"><input name="Button" type="button" onClick="formkontrol()" class="buton" value="Formu Gönder" tabindex="10"></td>
                </tr>
                <tr>
                  <td colspan="2" nowrap class="yildiz"><div align="right"><img src="../resimler/simge/form_uyari.gif" width="12" height="12"></div></td>
                  <td colspan="2" class="icyazi">Doldurulması zorunlu alanlar.</td>
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