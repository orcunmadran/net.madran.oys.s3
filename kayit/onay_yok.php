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
//Metin Kutusu Temizleme
function adrestemizle(){
document.form1.eposta.value = "";
};
//Form Kontrol
function formkontrol(){
	if(document.form1.eposta.value == ""){
		alert("Lütfen e-posta adresinizi giriniz.");
		} else {
				document.form1.submit();
			}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="baglantilar">&nbsp;</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="309" border="0" cellpadding="3" cellspacing="2">
          <tr>
            <td><img src="../resimler/genel/logo.gif" width="300" height="75"></td>
          </tr>
          <tr>
            <td class="arabaslik"><hr size="1"></td>
          </tr>
          <tr>
            <td class="formuyari">Sistem Mesajı: <span class="arabaslik">Kayıt İşlemi Tamamlanmadı</span></td>
          </tr>
          <tr>
            <td class="icyazi">Kayıt işleminin 2. aşamasını henüz tamamlamadınız.</td>
          </tr>
          <tr>
            <td class="icyazi">Sisteme giriş yapabilmeniz için kayıt formunda belirtmiş olduğunuz e-posta adresinize gönderilmiş olan onay mesajındaki bağlantıyı tıklamanız gerekmektedir.</td>
          </tr>
          <tr>
            <td class="arabaslik">Onay Mesajı Talebi</td>
          </tr>
          <tr>
            <td class="icyazi">Onay mesajı e-posta adresinize gelmediyse aşağıdaki form aracılığıyla onay mesajı talebinde bulunabilirsiniz.</td>
          </tr>
          <tr>
            <td class="icyazi"><form name="form1" method="post" action="onay_mesaji.php">
              <input name="eposta" type="text" class="metinkutusu" id="eposta" onFocus="adrestemizle()" value="e-posta adresiniz" size="25" maxlength="50">
              <input name="button" type="button" class="buton" id="button" onClick="formkontrol()" value="Formu Gönder">
              <input name="ROM_Ekle" type="hidden" id="ROM_Ekle" value="OK" />
            </form></td>
          </tr>
          <tr>
            <td class="icyazi"><span class="formuyari">ÖNEMLİ:</span> E-posta adresi olarak sisteme kayıt esnasında belirlediğiniz e-posta adresini giriniz.</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>