<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");

//Onay Kodu Kontrol
$eposta = $_POST['eposta'];
$KStalep_sql = sprintf
	(
	"SELECT * FROM kullanici WHERE eposta = '%s'",
	mysql_real_escape_string($eposta, $baglanti)
	);
$KStalep_sonuc = mysql_query($KStalep_sql, $baglanti);
$KStalep_sonuc_toplam = mysql_num_rows($KStalep_sonuc);
$KStalep_satir = mysql_fetch_assoc($KStalep_sonuc);
if($KStalep_sonuc_toplam == 1 && isset($_POST['eposta']) && $_POST['eposta'] != NULL){
	$talep_hata = 0;
	//Talep Formu Gönderme				
	$konu=$sistem_adi." kullanıcı adı ve şifre talebiniz";
	$icerik=
	"<font face=arial size=2>".
	" "."\n\r"."<br>".
	"<b>Sayın ".$KStalep_satir['ad']." ".$KStalep_satir['soyad'].",</b>"."\n\r"."<br>".
	" "."\n\r"."<br>".
	$sistem_adi." kullanıcı adı ve şifre bilgileriniz aşağıda yer almaktadır."."\n\r"."<br>".
	" "."\n\r"."<br>".
	"Kullanıcı Adı: ".$KStalep_satir['kimlik']."\n\r"."<br>".
	"Şifre: ".$KStalep_satir['sifre']."\n\r"."<br>".
	" "."\n\r"."<br>".
	"<b>".$sistem_adi." Yönetimi</b>"."\n\r"."<br>".
	"<a href=".$sistem_adres.">".$sistem_adres."</a>"."\n\r"."<br>".
	"</font>";
	mail($KStalep_satir['eposta'], $konu, $icerik, "From: $sistem_eposta\n".'Content-type: text/html; charset=UTF-8');
}
else{
	$talep_hata = 1;
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
<script type="text/javascript">
//Form Kontrol
function formkontrol(){
			if( document.form1.kimlik.value == "" |
				document.form1.sifre.value == "")
				{
					alert("Lütfen zorunlu alanları doldurunuz.");
				}
			else{
					document.form1.submit();
				}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="anabaslik">&nbsp;</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top">
          <table width="310" border="0" cellpadding="3" cellspacing="2">
          <tr>
            <td width="300"><img src="../resimler/genel/logo.gif" width="300" height="75"></td>
          </tr>
          <tr>
            <td class="arabaslik"><hr size="1"></td>
          </tr>
          <?php if($talep_hata == 0){?>
          <tr>
            <td class="arabaslik">Kullanıcı adı ve şifreniz e-posta adresinize gönderildi</td>
          </tr>
          <tr>
            <td class="icyazi">&nbsp;</td>
          </tr>
          <tr>
            <td class="icyazi"><p>Aşağıdaki form aracılığı ile sisteme giriş yapabilirsiniz.</p></td>
          </tr>
          <tr>
            <td class="icyazi"><form name="form1" method="post" action="../sistem/giris.php">
              <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                  <td width="18%" nowrap class="icyazi">Kullanıcı Adı</td>
                  <td width="3%">:</td>
                  <td width="79%"><input name="kimlik" type="text" class="metinkutusu" id="kimlik" size="20" maxlength="20"></td>
                </tr>
                <tr>
                  <td nowrap class="icyazi">Şifre</td>
                  <td>:</td>
                  <td><input name="sifre" type="password" class="metinkutusu" id="sifre" size="20" maxlength="20"></td>
                </tr>
                <tr>
                  <td class="icyazi">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input name="Button" type="button" onClick="formkontrol()" class="buton" value="Giriş Yap"></td>
                </tr>
                <tr>
                  <td class="icyazi">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td class="formuyari">Tüm alanların doldurulması zorunludur.</td>
                </tr>
              </table>
                                    </form>            </td>
          </tr>
          <?php };?>
          <?php if($talep_hata == 1){?>
          <tr>
            <td class="formuyari">Sistem Mesajı !</td>
          </tr>
          <tr>
            <td class="icyazi">&quot;<span class="arabaslik"><?php echo $_POST['eposta']; ?></span>"  e-posta adresi sistemimizde kayıtlı bulunmamaktadır.</td>
          </tr>
          <tr>
            <td class="icyazi">E-posta adresinizi yanlış girmiş olabilirsiniz. Yeniden kullanıcı adı ve şifre talebinde bulunmak için <a href="javascript:history.back()">tıklayınız</a>.</td>
          </tr>
          <tr>
            <td class="icyazi">Sistemimize kayıtlı olmayabilirsiniz. Kayıt ile ilgili ayrıntılı bilgi almak için <a href="iletisim.php">iletişim formunu</a> kullanabilirsiniz.</td>
          </tr>
          <?php };?>
        </table>
          </td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>