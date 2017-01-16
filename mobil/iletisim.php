<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
//require("../moduller/sistem_guvenlik.php");
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
//Form Kontrol
function formkontrol(){
	if( document.form1.adsoyad.value == "" |
		document.form1.eposta.value == "" |
		document.form1.konu.value == "" |
		document.form1.mesaj.value == "" |
		document.form1.dogrulama.value == ""){
		alert("Lütfen zorunlu alanları doldurunuz.");
	}
	else {
		document.form1.submit();
	}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">İletişim</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><form name="form1" method="post" action="iletisim_sonuc.php">
          <table width="100%" border="0" cellpadding="3" cellspacing="2">
            <tr>
              <td colspan="4" class="arabaslik">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3" class="arabaslik">İletişim Formu</td>
              <td class="arabaslik">İletişim Formu  İle İlgili Açıklamalar</td>
            </tr>
            <tr>
              <td nowrap class="icyazi">Adınız Soyadınız</td>
              <td width="4" class="icyazi">:</td>
              <td width="295"><input name="adsoyad" type="text" class="metinkutusu" id="adsoyad" size="20" maxlength="20"></td>
              <td width="290" rowspan="7" valign="top" class="icyazi"><p>İşaretli alanları lütfen eksiksiz olarak doldurunuz.</p>
                  <p>E - Posta adresinizi doğru olarak girmeniz daha sonra size geri dönüş yapabilmemiz açısından çok önemlidir.</p>
                  <p>Yaşadığınız sorunu, iletmek istediğiniz görüş ya da önerilerinizi mümkün olduğunca açık bir dille ifade etmeye çalışınız.</p>
                  <p>Verdiğiniz bilgiler doğrultusunda size en kısa sürede geri dönülecektir.</p>                </td>
            </tr>
            <tr>
              <td nowrap class="icyazi">E - Posta Adresiniz</td>
              <td class="icyazi">:</td>
              <td><input name="eposta" type="text" class="metinkutusu" id="eposta" size="30"></td>
            </tr>
            <tr>
              <td nowrap class="icyazi">Konu</td>
              <td class="icyazi">:</td>
              <td><input name="konu" type="text" class="metinkutusu" id="konu" size="40"></td>
            </tr>
            <tr>
              <td valign="top" nowrap class="icyazi">Mesaj</td>
              <td valign="top" class="icyazi">:</td>
              <td><textarea name="mesaj" cols="50" rows="7" class="metinkutusu" id="mesaj"></textarea></td>
            </tr>
            
            <tr>
              <td nowrap class="icyazi"><img src="../guvenlik/guvenlik_kodu.php" alt="Güvenlik Kodu" /></td>
              <td class="icyazi">:</td>
              <td><input name="dogrulama" type="text" class="metinkutusu" id="dogrulama" size="5" maxlength="5"></td>
            </tr>
            <tr>
              <td nowrap class="icyazi">&nbsp;</td>
              <td class="icyazi">&nbsp;</td>
              <td><input type="button" onClick="formkontrol()" class="buton" value="Formu Gönder"></td>
            </tr>
            <tr>
              <td colspan="2" nowrap class="yildiz">&nbsp;</td>
              <td class="formuyari">Tüm alanların doldurulması zorunludur.</td>
            </tr>
          </table>
        </form></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>