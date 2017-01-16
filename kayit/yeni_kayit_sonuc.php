<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");

//Güvenlik Kodu
session_start();

//Kontrol değişkenlerini ata
$kimlik_orj = $_POST['kimlik'];
$eposta = $_POST['eposta'];

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
	$kimlik = strtolower($kimlik_orj);

//Kullanıcı Adı Kontrol(KAK)					
$KAK_sql = sprintf
	(
	"SELECT kimlik FROM kullanici WHERE kimlik = '%s'",
	mysql_real_escape_string($kimlik, $baglanti)
	);
$KAK_sonuc = mysql_query($KAK_sql, $baglanti);
$KAK_sonuc_toplam = mysql_num_rows($KAK_sonuc);
//E-Posta Kontrol
$EPK_sql = sprintf
	(
	"SELECT kimlik FROM kullanici WHERE eposta = '%s'",
	mysql_real_escape_string($eposta, $baglanti)
	);
$EPK_sonuc = mysql_query($EPK_sql, $baglanti);
$EPK_sonuc_toplam = mysql_num_rows($EPK_sonuc);
//Doğrulama
if($_SESSION['gvnkodu'] == $_POST['dogrulama']){
	$gvnkodu_hata = 0;
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
					$sifre = $_POST['sifre'];
					$yetki = 10;
					$ad = $_POST['ad'];
					$soyad = $_POST['soyad'];
					$web = $_POST['web'];
					$ip_num = $_SERVER['REMOTE_ADDR'];
					$onay_kodu = $kimlik.substr(md5(uniqid(rand())),0,15);
					$ekle_sql = sprintf(
					"INSERT INTO kullanici (kimlik, sifre, yetki, ad, soyad, eposta, web, ip_num, onay_kodu)
					 VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
					mysql_real_escape_string($kimlik, $baglanti),
					mysql_real_escape_string($sifre, $baglanti),
	 				mysql_real_escape_string($yetki, $baglanti),
					mysql_real_escape_string($ad, $baglanti),
					mysql_real_escape_string($soyad, $baglanti),
	 				mysql_real_escape_string($eposta, $baglanti),
					mysql_real_escape_string($web, $baglanti),
					mysql_real_escape_string($ip_num, $baglanti),
	 				mysql_real_escape_string($onay_kodu, $baglanti));
					$giris_kayit = mysql_query($ekle_sql, $baglanti);
					//Onay Formu Gönderme				
					$konu=$sistem_adi." kayıt onayı";
					$icerik=
					"<font face=arial size=2>".
					" "."\n\r"."<br>".
					"<b>Sayın ".$ad." ".$soyad.",</b>"."\n\r"."<br>".
					" "."\n\r"."<br>".
					"Bu mesaj, sistemimize (".$sistem_adi.") yapmış olduğunuz başvuru sonucunda size gönderilmiştir. "."\n\r"."<br>".
					" "."\n\r"."<br>".
					"Başvuru size ait ise, başvurunuzu onaylamak için aşağıdaki bağlantıya tıklayınız ya da İnternet tarayıcınızın adresine yazarak ilgili sayfaya gidiniz."."\n\r"."<br>".
					"<a href=".$sistem_adres."/kayit/yeni_kayit_onay.php?onaykodu=".$onay_kodu.">".$sistem_adres."/kayit/yeni_kayit_onay.php?onaykodu=".$onay_kodu."</a>"."\n\r"."<br>".
					" "."\n\r"."<br>".
					"Başvuru size ait değilse, sizin adınıza yapılmış olan bu başvuruyu silmek için aşağıdaki bağlantıya tıklayınız ya da İnternet tarayıcınızın adresine yazarak ilgili sayfaya gidiniz."."\n\r"."<br>".
					"<a href=".$sistem_adres."/kayit/yeni_kayit_sil.php?onaykodu=".$onay_kodu.">".$sistem_adres."/kayit/yeni_kayit_sil.php?onaykodu=".$onay_kodu."</a>"."\n\r"."<br>".
					" "."\n\r"."<br>".
					"<b>".$sistem_adi." Yönetimi</b>"."\n\r"."<br>".
					"<a href=".$sistem_adres.">".$sistem_adres."</a>"."\n\r"."<br>".
					"</font>";
					mail($eposta, $konu, $icerik, "From: $sistem_eposta\n".'Content-type: text/html; charset=UTF-8');
			}
		}
	}
}
else{
$gvnkodu_hata = 1;
$EPK_hata = 0;
$KAK_hata = 0;	
}
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="400" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="350" height="16" valign="top"><p align="left" class="baglantilar">&nbsp;</p>          </td>
        <td width="349" valign="top"><div align="right"><span class="baglantilar"><?php echo $sistem_ust_menu_dis; ?></span></div></td>
      </tr>
      <tr>
        <td colspan="2" valign="top"><table width="310" border="0" cellpadding="3" cellspacing="2">
          <tr>
            <td><img src="../resimler/genel/logo.gif" width="300" height="75"></td>
          </tr>
          <tr>
            <td class="arabaslik"><hr size="1"></td>
          </tr>
          <?php if($gvnkodu_hata == 1){; ?>
          <tr>
            <td class="formuyari">Sistem Mesajı !</td>
          </tr>
          <tr>
            <td class="icyazi"><p>Girmiş olduğunuz güvenlik kodu hatalı.</p></td>
          </tr>
          <tr>
            <td class="icyazi">Kayıt formuna geri dönmek için <a href="javascript:history.back()">tıklayınız</a>.</td>
          </tr>
          <tr>
            <td class="icyazi"><span class="formuyari">NOT:</span> Kayıt formuna geri döndüğünüzde şifre bilgilerinizi ve güvenlik kodunuzu yeniden girmeniz gerekmektedir. Güvenlik kodu her defasında yeniden oluşturulmaktadır.</td>
          </tr>
          <?php };?>
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
            <td class="icyazi"><span class="arabaslik">Kullanıcı kayıt işleminin 1. aşaması tamamladınız.</span></td>
          </tr>
          <tr>
            <td class="icyazi">Kayıt formuna girdiğiniz e-posta adresinize bir onaylama mesajı gönderilmiştir. Bu onaylama mesajında yer alan bağlantıya tıklayarak kayıt işlemini tamamlamanız gerekmektedir.</td>
          </tr>
          <tr>
            <td class="icyazi"><p><span class="formuyari">ÖNEMLİ:</span> Onaylama işleminizi gerçekleştirmediğiniz sürece sisteme giriş yapmanız mümkün olmayacaktır.</p>
              <p>Kayıt ile ilgili her türlü sorunuz için <a href="../index/iletisim.php">iletişim formunu</a> kullanarak yardım isteyebilirsiniz.</p></td>
          </tr>
          <tr>
            <td class="icyazi">Kayıt formuna girmiş olduğunuz bilgiler aşağıda listelenmiştir:</td>
          </tr>
          <tr>
            <td class="icyazi"><table border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td nowrap class="icyazi">Kullanıcı Adı</td>
                <td class="icyazi">:</td>
                <td nowrap class="icyazi"><?php echo $kimlik; ?></td>
              </tr>
              <tr>
                <td nowrap class="icyazi">Ad</td>
                <td class="icyazi">:</td>
                <td nowrap class="icyazi"><?php echo $ad; ?></td>
              </tr>
              <tr>
                <td nowrap class="icyazi">Soyad</td>
                <td class="icyazi">:</td>
                <td nowrap class="icyazi"><?php echo $soyad; ?></td>
              </tr>
              <tr>
                <td nowrap class="icyazi">E - Posta</td>
                <td class="icyazi">:</td>
                <td nowrap class="icyazi"><?php echo $eposta; ?></td>
              </tr>
              <tr>
                <td nowrap class="icyazi">IP Numaranız</td>
                <td class="icyazi">:</td>
                <td nowrap class="icyazi"><?php echo $ip_num; ?></td>
              </tr>
            </table></td>
          </tr>
          <?php };?>
        </table>
          </td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>