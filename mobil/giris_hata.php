<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
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
<script type="text/javascript">
//Metin Kutusu Temizleme
function kimliktemizle(){
document.form1.kimlik.value = "";
};
function sifretemizle(){
document.form1.sifre.value = "";
};
function adrestemizle(){
document.form2.eposta.value = "";
};
//Form 1 Kontrol
function formkontrol_1(){
	if(document.form1.kimlik.value == "" |
		document.form1.kimlik.value == "Kullanıcı Adı"){
		alert("Lütfen kullanıcı adınızı giriniz.");
		} else {
				document.form1.submit();
			}
}
//Form 2 Kontrol
function formkontrol_2(){
	if(document.form2.eposta.value == "" |
		document.form2.eposta.value == "e-posta adresiniz"){
		alert("Lütfen e-posta adresinizi giriniz.");
		} else {
				document.form2.submit();
			}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="310" height="16" valign="top"><form name="form1" method="post" action="../sistem/giris.php">
          <input name="kimlik" type="text" onFocus="kimliktemizle()" class="metinkutusu" id="kimlik" value="Kullanıcı Adı" size="15" maxlength="20"> 
          <input name="sifre" type="password" onFocus="sifretemizle()"class="metinkutusu" id="sifre" value="XXXXXXXX" size="15" maxlength="20">
          <input name="Button" type="button" class="buton" onClick="formkontrol_1()" value="Giriş Yap">
        </form>        </td>
        <td width="390" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td valign="top"><table width="310" height="142" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="300" height="77"><div align="left"><img src="../resimler/genel/logo.gif" width="300" height="75"></div></td>
          </tr>
          <tr>
            <td><div align="left">
              <hr width="292">
            </div></td>
          </tr>
          <tr>
            <td class="formuyari">Sistem Mesajı!</td>
          </tr>
          <tr>
            <td height="17" class="arabaslik">Hatalı kullanıcı adı ya da şifre</td>
          </tr>
          <tr>
            <td class="icyazi">Kullanıcı adı ya da şifreniz hatalı olduğu için sisteme giriş yapamıyorsunuz. Lütfen yeniden deneyiniz.</td>
          </tr>
          <tr>
            <td class="icyazi">&nbsp;</td>
          </tr>
          <tr>
            <td class="arabaslik">Kullanıcı adını ya da şifremi hatırlamıyorum</td>
          </tr>
          <tr>
            <td class="icyazi">Eğer kullanıcı adınızı ya da şifrenizi hatırlamıyorsanız aşağıdaki form aracılığıyla kullanıcı adı ve şifre talebince bulunabilirsiniz.</td>
          </tr>
          <tr>
            <td class="icyazi">Kullanıcı adı ve şifreniz sisteme kayıt olurken belirlemiş olduğunuz e-posta adresinize gelecektir.</td>
          </tr>
          <tr>
            <td class="icyazi">&nbsp;</td>
          </tr>
          <tr>
            <td class="icyazi"><form action="kimlik_sifre_talep.php" method="post" name="form2" id="form2">
              <input name="eposta" type="text" class="metinkutusu" id="eposta" onFocus="adrestemizle()" value="e-posta adresiniz" size="25" maxlength="50">
              <input name="button" type="button" class="buton" id="button" onClick="formkontrol_2()" value="Formu Gönder">
              <input name="ROM_eposta" type="hidden" id="ROM_eposta" value="OK" />
            </form></td>
          </tr>
        </table>          </td>
        <td valign="top">&nbsp;</td>
      </tr>
      
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>