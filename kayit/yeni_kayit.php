<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//Form Kontrol
function formkontrol(){
	if(document.form1.sifre.value == document.form1.sifre2.value){	
		if(document.form1.eposta.value == document.form1.eposta2.value){
			if( document.form1.kimlik.value == "" |
				document.form1.sifre.value == "" |
				document.form1.sifre2.value == "" |
				document.form1.ad.value == "" |
				document.form1.soyad.value == "" |
				document.form1.eposta.value == "" |
				document.form1.eposta2.value == "" |
				document.form1.dogrulama.value == ""){
				alert("Lütfen zorunlu alanları doldurunuz.");
			}
			else {document.form1.submit();}
		}
		else {alert("Girilen e-posta adresleri aynı olmalıdır.");}
	}
	else {alert("Girilen şifreler aynı olmalıdır.");}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">Yeni Kullanıcı Kaydı</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><form name="form1" method="post" action="yeni_kayit_sonuc.php">
          <table width="100%" border="0" cellpadding="3" cellspacing="2">
            <tr>
              <td colspan="4" class="arabaslik">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" class="arabaslik">Kayıt Formu</td>
              <td class="arabaslik">Kayıt İşlemleri İle İlgili Açıklamalar</td>
            </tr>
            <tr>
              <td width="88" nowrap class="icyazi">Kullanıcı Adı</td>
              <td width="3" class="icyazi">:</td>
              <td width="295"><input name="kimlik" type="text" class="metinkutusu" id="kimlik" tabindex="1" size="20" maxlength="20">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12">			</td>
              <td width="280" rowspan="11" valign="top" class="icyazi"><p>Kayıt işlemi 2 aşamadan oluşmaktadır:</p>
                <ol>
                  <li>Kayıt formunun doldurulması ve gönderilmesi.</li>
                  <li>Kayıt formunda belirtmiş olduğunuz e-posta adresine gelen onay mesajı yardımıyla başvurunun onaylanması.</li>
                </ol>
                <p>İşaretli alanları - <img src="../resimler/simge/form_uyari.gif" width="12" height="12"> - eksiksiz olarak doldurulması büyük önem taşımaktadır. Boş bırakılan ya da hatalı giriş yapılan alanlar ile ilgili uyarılar sistem tarafından otomatik olarak yapılmaktadır.</p>
                <p>Onay mesajının gönderileceği e-posta adresinin geçerli bir e-posta adresi olmasına özen gösteriniz. Onaylama işlemi tamamlanmadan sisteme giriş yapmanız mümkün olmayacaktır.</p>
                <p>Kayıt ve diğer işlemler ile ilgili sorularınız için <a href="../index/iletisim.php">iletişim formunu</a> kullanabilirsiniz.</p></td>
            </tr>
            <tr>
              <td nowrap class="icyazi">Şifre</td>
              <td class="icyazi">:</td>
              <td><input name="sifre" type="password" class="metinkutusu" id="sifre" tabindex="2" size="20" maxlength="20">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
              </tr>
            <tr>
              <td nowrap class="icyazi">Şifre Tekrar</td>
              <td class="icyazi">:</td>
              <td><input name="sifre2" type="password" class="metinkutusu" id="sifre2" tabindex="3" size="20" maxlength="20">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
              </tr>
            <tr>
              <td nowrap class="icyazi">Ad</td>
              <td class="icyazi">:</td>
              <td><input name="ad" type="text" class="metinkutusu" id="ad" tabindex="4" size="30" maxlength="40">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
              </tr>
            <tr>
              <td nowrap class="icyazi">Soyad</td>
              <td class="icyazi">:</td>
              <td><input name="soyad" type="text" class="metinkutusu" id="soyad" tabindex="5" size="30" maxlength="40">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
              </tr>
            <tr>
              <td nowrap class="icyazi">E - Posta</td>
              <td class="icyazi">:</td>
              <td><input name="eposta" type="text" class="metinkutusu" id="eposta" tabindex="6" size="40" maxlength="50">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
              </tr>
            <tr>
              <td nowrap class="icyazi">E - Posta Tekrar</td>
               <td class="icyazi">:</td>
              <td><input name="eposta2" type="text" class="metinkutusu" id="eposta2" tabindex="7" size="40" maxlength="50">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
            </tr>
            <tr>
              <td nowrap class="icyazi">Web</td>
              <td class="icyazi">:</td>
              <td><input name="web" type="text" class="metinkutusu" id="web" tabindex="8" value="http://" size="40" maxlength="50"></td>
              </tr>
            <tr>
              <td nowrap class="icyazi"><img src="../guvenlik/guvenlik_kodu.php" alt="Güvenlik Kodu" /></td>
              <td class="icyazi">:</td>
              <td><input name="dogrulama" type="text" class="metinkutusu" id="dogrulama" tabindex="9" size="5" maxlength="5">
                <img src="../resimler/simge/form_uyari.gif" width="12" height="12"></td>
            </tr>
            <tr>
              <td nowrap class="icyazi"><input name="ROM_Ekle" type="hidden" id="ROM_Ekle" value="OK" /></td>
              <td class="icyazi">&nbsp;</td>
              <td><input name="Button" type="button" onClick="formkontrol()" class="buton" value="Formu Gönder" tabindex="10"></td>
              </tr>
            <tr>
              <td colspan="2" nowrap class="yildiz"><div align="right"><img src="../resimler/simge/form_uyari.gif" width="12" height="12"></div></td>
              <td class="icyazi">Doldurulması zorunlu alanlar.</td>
              </tr>
          </table>
                </form>
          </td>
      </tr>
      <tr>
        <td colspan="2" valign="top"></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>