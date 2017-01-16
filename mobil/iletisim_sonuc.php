<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
//
//Güvenlik Kodu
session_start();
if($_SESSION['gvnkodu'] == $_POST['dogrulama']){
$gvnkodu_hata = 0;
	//E-Posta
	$var_adsoyad = $_POST['adsoyad'];
	$var_eposta = $_POST['eposta'];
	$var_konu = $_POST['konu'];
	$var_mesaj = $_POST['mesaj'];
			
	$mailcontent=
	"<font face=arial size=2>".
	"<b>".$sistem_adi." Dış İletişim Formu</b>"."\n\r"."<br>".
	""."\n\r"."<br>".
	"Ad Soyad: ".$var_adsoyad."\n\r"."<br>".
	"E - Posta: ".$var_eposta."\n\r"."<br>".
	"Konu: ".$var_konu."\n\r"."<br>".
	"Mesaj: ".$var_mesaj.
	"</font>";
	
	mail($sistem_eposta, $var_konu, $mailcontent, "From: $var_eposta\n".'Content-type: text/html; charset=UTF-8');
}
else{
$gvnkodu_hata = 1;
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
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">&nbsp;</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="310" border="0" cellpadding="3" cellspacing="2">
          <tr>
            <td><img src="../resimler/genel/logo.gif" width="300" height="75"></td>
          </tr>
          <tr>
            <td><hr size="1"></td>
          </tr>
          <?php if($gvnkodu_hata == 1){;?>
          <tr>
            <td class="arabaslik">Sistem Mesajı <span class="formuyari">!</span></td>
          </tr>
          <tr>
            <td class="icyazi"><p>Girmiş olduğunuz güvenlik kodu hatalı.</p></td>
          </tr>
          <tr>
            <td class="icyazi">İletişim formuna geri dönmek için <a href="javascript:history.back()">tıklayınız</a>.</td>
          </tr>
          <tr>
            <td class="icyazi"><span class="formuyari">NOT:</span> İletişim formuna geri döndüğünüzde güvenlik kodunuzu doğru olarak girmeniz gerekmektedir. Güvenlik kodu her defasında yeniden oluşturulmaktadır.</td>
          </tr>
          <?php };?>
          <?php if($gvnkodu_hata == 0){;?>
          <tr>
            <td class="icyazi"><span class="arabaslik">İletişim Formu Gönderildi<span class="formuyari"></span></span></td>
          </tr>
          <tr>
            <td class="icyazi">Sayın <?php echo $_POST['adsoyad'] ?>,</td>
          </tr>
          <tr>
            <td class="icyazi">Verdiğiniz bilgiler doğrultusunda en kısa sürede belirttiğiniz e-posta adresi yoluyla size geri dönülecektir.</td>
          </tr>
          <tr>
            <td class="icyazi">E - Posta Adresiniz: <?php echo $_POST['eposta'] ?></td>
          </tr>
          <tr>
            <td class="icyazi">Konu: <?php echo $_POST['konu'] ?></td>
          </tr>
          <?php };?>
        </table>
        </td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>