<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");

//Onay Kodu Kontrol
$onay_kodu = $_GET['onaykodu'];
$KSonay_sql = sprintf
	(
	"SELECT * FROM kullanici WHERE onay_kodu = '%s'",
	mysql_real_escape_string($onay_kodu, $baglanti)
	);
$KSonay_sonuc = mysql_query($KSonay_sql, $baglanti);
$KSonay_sonuc_toplam = mysql_num_rows($KSonay_sonuc);
$satir_KSonay = mysql_fetch_assoc($KSonay_sonuc);
if($KSonay_sonuc_toplam == 1 && isset($_GET['onaykodu']) && $_GET['onaykodu'] != NULL){
	$onay_hata = 0;
	$update_sql = sprintf
		(
		"UPDATE kullanici SET yetki = 9 WHERE kimlik= '%s'",
		mysql_real_escape_string($satir_KSonay['kimlik'], $baglanti)
		);
	$kayit_onay = mysql_query($update_sql, $baglanti);
	//Onay Formu Gönderme				
	$konu=$sistem_adi." Kayıt İşleminiz Tamamlandı";
	$icerik=
	"<font face=arial size=2>".
	" "."\n\r"."<br>".
	"<b>Sayın ".$satir_KSonay['ad']." ".$satir_KSonay['soyad'].",</b>"."\n\r"."<br>".
	" "."\n\r"."<br>".
	$sistem_adi." kayıt işleminiz tamamlandı."."\n\r"."<br>".
	" "."\n\r"."<br>".
	"Kullanıcı Adı: ".$satir_KSonay['kimlik']."\n\r"."<br>".
	"Şifre: ".$satir_KSonay['sifre']."\n\r"."<br>".
	" "."\n\r"."<br>".
	"<b>".$sistem_adi." Yönetimi</b>"."\n\r"."<br>".
	"<a href=".$sistem_adres.">".$sistem_adres."</a>"."\n\r"."<br>".
	"</font>";
	mail($satir_KSonay['eposta'], $konu, $icerik, "From: $sistem_eposta\n".'Content-type: text/html; charset=UTF-8');
}
else{
	$onay_hata = 1;
	}
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
          <?php if($onay_hata == 0){?>
          <tr>
            <td class="arabaslik">Kayıt işleminiz tamamlandı</td>
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
          <?php if($onay_hata == 1){?>
          <tr>
            <td class="formuyari">Sistem Mesajı !</td>
          </tr>
          <tr>
            <td class="icyazi">&quot;<span class="arabaslik"><?php echo $_GET['onaykodu']; ?></span>"  onay kodu ile yapılmış bir başvuru sistemimizde kayıtlı bulunmamaktadır.</td>
          </tr>
          <?php };?>
        </table>
          </td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>