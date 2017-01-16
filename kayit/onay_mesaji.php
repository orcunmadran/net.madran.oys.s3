<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
//E-Posta ile başvuru doğrulama (EBD)
if(isset($_POST['ROM_Ekle'])){
	$EBD_sql = sprintf(
		"SELECT *
		 FROM kullanici
		 WHERE eposta = '%s'",
		 mysql_real_escape_string($_POST['eposta'], $baglanti)
		);
	$EBD_sonuc = mysql_query($EBD_sql, $baglanti);
	$EBD_sonuc_toplam = mysql_num_rows($EBD_sonuc);
	$EBD_satir = mysql_fetch_assoc($EBD_sonuc);
	
	if($EBD_sonuc_toplam == 1){
		$EBD_hata = 0;
		//E-Posta Değişkenleri
		$ad = $EBD_satir['ad'];
		$soyad = $EBD_satir['soyad'];
		$eposta = $EBD_satir['eposta'];
		$onay_kodu = $EBD_satir['onay_kodu'];
		
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
	else{
		$EBD_hata = 1;
	}
}else{
	$EBD_hata = 1;
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
        <td colspan="2" valign="top"><table width="309" border="0" cellpadding="3" cellspacing="2">
          <tr>
            <td><img src="../resimler/genel/logo.gif" width="300" height="75"></td>
          </tr>
          <tr>
            <td class="arabaslik"><hr size="1"></td>
          </tr>
          <?php if($EBD_hata == 0){ ;?>
          <tr>
            <td class="arabaslik">Onay Mesajı Gönderildi</td>
          </tr>
          <tr>
            <td class="icyazi">E-posta adresinize onay formunuz gönderilmiştir. Bu onaylama mesajında yer alan bağlantıya tıklayarak kayıt işlemini tamamlamanız gerekmektedir.</td>
          </tr>
          <tr>
            <td class="icyazi"><p><span class="formuyari">ÖNEMLİ:</span> Onaylama işleminizi gerçekleştirmediğiniz sürece sisteme giriş yapmanız mümkün olmayacaktır.</p>              </td>
          </tr>
          <tr>
            <td class="icyazi">Kayıt ile ilgili her türlü sorunuz için <a href="../index/iletisim.php">iletişim formunu</a> kullanarak yardım isteyebilirsiniz.</td>
          </tr>
          <?php } ;?>
          <?php if($EBD_hata == 1){ ;?>
          <tr>
            <td class="formuyari">Sistem Mesajı!</td>
          </tr>
          <tr>
            <td class="icyazi">Belirttiğiniz e-posta adresi sistemimize kayıtlı değildir.</td>
          </tr>
          <tr>
            <td class="icyazi">Yeni bir kullanıcı kaydı oluşturmak için <a href="yeni_kayit.php">tıklayınız</a>.</td>
          </tr>
          <?php } ;?>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>