<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

//Kontrol değişkenlerini ata
$kimlik_orj = $_POST['kimlik'];
$yk_eposta = $_POST['eposta'];

// Türkçe Karakter Kontrol
	$kimlik_orj = ereg_replace('ç', 'c', $kimlik_orj);
	$kimlik_orj = ereg_replace('ğ', 'g', $kimlik_orj);
	$kimlik_orj = ereg_replace('ı', 'i', $kimlik_orj);
	$kimlik_orj = ereg_replace('ö', 'o', $kimlik_orj);
	$kimlik_orj = ereg_replace('ş', 's', $kimlik_orj);
	$kimlik_orj = ereg_replace('ü', 'u', $kimlik_orj);
	$kimlik_orj = ereg_replace('Ç', 'C', $kimlik_orj);
	$kimlik_orj = ereg_replace('Ğ', 'G', $kimlik_orj);
	$kimlik_orj = ereg_replace('İ', 'I', $kimlik_orj);
	$kimlik_orj = ereg_replace('Ö', 'O', $kimlik_orj);
	$kimlik_orj = ereg_replace('Ş', 'S', $kimlik_orj);
	$kimlik_orj = ereg_replace('Ü', 'U', $kimlik_orj);
				
// Boşluk Kontrol
	$kimlik_orj = ereg_replace(' ', '_', $kimlik_orj);

// Noktalama İşaretleri Kontrolü
	$kimlik_orj = strtr($kimlik_orj, "é!'^+%&/()=?£#$½{[]}\*@€~`;:|<>", "-------------------------------");

// Dosya Adının Küçük Harflere Çevirilmesi
	$yk_kimlik = strtolower($kimlik_orj);

//Kullanıcı Adı Kontrol(KAK)					
$KAK_sql = sprintf
	(
	"SELECT kimlik FROM kullanici WHERE kimlik = '%s'",
	mysql_real_escape_string($yk_kimlik, $baglanti)
	);
$KAK_sonuc = mysql_query($KAK_sql, $baglanti);
$KAK_sonuc_toplam = mysql_num_rows($KAK_sonuc);
//E-Posta Kontrol
$EPK_sql = sprintf
	(
	"SELECT kimlik FROM kullanici WHERE eposta = '%s'",
	mysql_real_escape_string($yk_eposta, $baglanti)
	);
$EPK_sonuc = mysql_query($EPK_sql, $baglanti);
$EPK_sonuc_toplam = mysql_num_rows($EPK_sonuc);
//Doğrulama
if($EPK_sonuc_toplam == 1){
	$EPK_hata = 1;
}
else{
	$EPK_hata = 0;
		if($KAK_sonuc_toplam == 1){
			$KAK_hata = 1;
		}
		else{
			$KAK_hata = 0;
			//Yeni Kullanıcı Kaydı
			if(isset($_POST['ROM_Ekle'])){
				//Değişkenkenlerin ataması
				$yk_sifre = $_POST['sifre'];
				$yk_yetki = $_POST['yetki'];
				$yk_ad = $_POST['ad'];
				$yk_soyad = $_POST['soyad'];
				$yk_web = $_POST['web'];
				$yk_ip_num = $_SERVER['REMOTE_ADDR'];
				$yk_onay_kodu = "Sistem Kayıt: ".$kimlik;
				$ekle_sql = sprintf(
				"INSERT INTO kullanici (kimlik, sifre, yetki, ad, soyad, eposta, web, ip_num, onay_kodu)
				 VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
				mysql_real_escape_string($yk_kimlik, $baglanti),
				mysql_real_escape_string($yk_sifre, $baglanti),
				mysql_real_escape_string($yk_yetki, $baglanti),
				mysql_real_escape_string($yk_ad, $baglanti),
				mysql_real_escape_string($yk_soyad, $baglanti),
				mysql_real_escape_string($yk_eposta, $baglanti),
				mysql_real_escape_string($yk_web, $baglanti),
				mysql_real_escape_string($yk_ip_num, $baglanti),
				mysql_real_escape_string($yk_onay_kodu, $baglanti));
				$giris_kayit = mysql_query($ekle_sql, $baglanti);
				//Onay Formu Gönderme				
				$konu=$sistem_adi." kaydınız sistem tarafından yapıldı";
				$icerik=
				"<font face=arial size=2>".
				" "."\n\r"."<br>".
				"<b>Sayın ".$yk_ad." ".$yk_soyad.",</b>"."\n\r"."<br>".
				" "."\n\r"."<br>".
				$sistem_adi." kullanıcı kayıt işlemleriniz başarıyla tamamlanmıştır."."\n\r"."<br>".
				" "."\n\r"."<br>".
				"Kullanıcı Adı: ".$yk_kimlik."\n\r"."<br>".
				"Şifre: ".$yk_sifre."\n\r"."<br>".
				"Sistem Adresi: <a href=".$sistem_adres.">".$sistem_adres."</a>"."\n\r"."<br>".
				" "."\n\r"."<br>".
				"<b>".$sistem_adi." Yönetimi</b>"."\n\r"."<br>".
				"<a href=".$sistem_adres.">".$sistem_adres."</a>"."\n\r"."<br>".
				"</font>";
				mail($yk_eposta, $konu, $icerik, "From: $sistem_eposta\n".'Content-type: text/html; charset=UTF-8');
		}
	}
}
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
        <td height="24" colspan="2" valign="top"><table width="100%" height="300" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/kisisel_bilgiler.gif" width="24" height="24"></td>
            <td class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; <a href="yeni_kayit.php">Yeni Kullanıcı Kaydı</a> &gt; Kayıt Sonuç</td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><table width="310" border="0" cellpadding="3" cellspacing="2">
              <?php if($KAK_hata == 1){; ?>
              <tr>
                <td class="formuyari">Sistem Mesajı !</td>
              </tr>
              <tr>
                <td class="icyazi">Yeni bir kullanıcı adı belirlemeniz gerekmekte. Girmiş olduğunuz kullanıcı adı <b>"<?php echo $_POST['kimlik']; ?>"</b> ile daha önceden oluşturulmuş bir kayıt var. </td>
              </tr>
              <tr>
                <td class="icyazi">Kayıt formuna geri dönerek başka bir kullanıcı adı seçmek için <a href="javascript:history.back()">tıklayınız</a>.</td>
              </tr>
              <?php };?>
              <?php if($EPK_hata == 1){; ?>
              <tr>
                <td class="formuyari">Sistem Mesajı !</td>
              </tr>
              <tr>
                <td class="icyazi">Girmiş olduğunuz e-posta <b>"<?php echo $_POST['eposta']; ?>"</b> ile daha önceden oluşturulmuş bir kayıt var.</td>
              </tr>
              <tr>
                <td class="icyazi">Kayıt formuna geri dönerek farklı bir e-posta adresi girmek için <a href="javascript:history.back()">tıklayınız</a>.</td>
              </tr>
              <?php };?>
              <?php if($gvnkodu_hata == 0 && $KAK_hata == 0 && $EPK_hata == 0){; ?>
              <tr>
                <td class="icyazi"><span class="arabaslik">Kullanıcı kayıt işlemi başarıyla tamamlandı.</span></td>
              </tr>
              <tr>
                <td class="icyazi">Yeni bir kullanıcı girişi yapmak için <a href="yeni_kayit.php">tıklayınız</a>. </td>
              </tr>
              <tr>
                <td class="icyazi">Kullanıcı bilgilendirme mesajı kayıt formunda yer alan e-posta adresine otomatik olarak gönderilmiştir. </td>
              </tr>

              <tr>
                <td class="icyazi">Sisteme eklenen kullanıcı ile ilgili ayrıntılı bilgiler aşağıda yer almaktadır: </td>
              </tr>
              <tr>
                <td class="icyazi"><table border="0" cellspacing="2" cellpadding="3">
                    <tr>
                      <td nowrap class="arabaslik">Kullanıcı Adı</td>
                      <td class="arabaslik">:</td>
                      <td nowrap class="icyazi"><?php echo $yk_kimlik; ?></td>
                    </tr>
                    <tr>
                      <td nowrap class="arabaslik">Ad</td>
                      <td class="arabaslik">:</td>
                      <td nowrap class="icyazi"><?php echo $yk_ad; ?></td>
                    </tr>
                    <tr>
                      <td nowrap class="arabaslik">Soyad</td>
                      <td class="arabaslik">:</td>
                      <td nowrap class="icyazi"><?php echo $yk_soyad; ?></td>
                    </tr>
                    <tr>
                      <td nowrap class="arabaslik">E - Posta</td>
                      <td class="arabaslik">:</td>
                      <td nowrap class="icyazi"><?php echo $yk_eposta; ?></td>
                    </tr>

                </table></td>
              </tr>
              <?php };?>
            </table>            
            </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>