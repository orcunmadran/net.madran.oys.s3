<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//Form Kontrol
function formkontrol(){
if(document.form1.anahtar.value == ""){
	alert("Anahtar kelime giriniz.");
}
	else {
	document.form1.submit();
	}
}
</script>
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/arama2.gif" width="24" height="24"></td>
            <td class="anabaslik">Arama</td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><form name="form1" method="get" action="liste.php">
              <table width="100%" border="0" cellspacing="5" cellpadding="5">
                <tr>
                  <td colspan="3" class="arabaslik">Sistem İçinde Kullanıcı Ara</td>
                  </tr>
                <tr>
                  <td width="27%" valign="top"><input name="anahtar" type="text" class="metinkutusu" id="anahtar" size="30"></td>
                  <td width="9%" valign="top"><input type="button" onClick="formkontrol()" class="buton" value="Ara"></td>
                  <td width="64%" class="icyazi"><p class="icyaziblok">Sistem içerisindeki kullanıcıları adına, soyadına, kullanıcı adına ya da e-posta adresine göre arayabilirsiniz. Aramalarınızda kullanacağınız anahtar kelimeniz aranacak öğenin tamamından ya da bir bölümünden oluşabilir.</p>                    </td>
                </tr>
              </table>
                        </form>              
              <form action="http://www.google.com.tr/search" method="get" name="form2" target="_blank" id="form2">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tr>
                    <td colspan="3" class="arabaslik">İnternet'te Bilgi / Doküman Ara (Google)</td>
                  </tr>
                  <tr>
                    <td width="27%" valign="top"><input name="q" type="text" class="metinkutusu" id="q" size="30"></td>
                    <td width="9%" valign="top"><input type="submit" class="buton" value="Ara"></td>
                    <td width="64%" class="icyazi"><p class="icyaziblok">İnternet üzerinde yer alan dokümanları ve bilgileri   istediğiniz anahtar kelime / kelimeleri kullanarak arayabilirsiniz. Google'da arama ile ilgili ayrıntılı bilgi için <a href="http://www.google.com.tr/intl/tr/help.html" target="_blank">tıklayınız</a>.</p></td>
                  </tr>
                </table>
              </form>              
              <form action="http://scholar.google.com.tr/scholar" method="get" name="form3" target="_blank" id="form3">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tr>
                    <td colspan="3" class="arabaslik">Akademik Ağlarda Yayın Ara (Google Scholar)</td>
                  </tr>
                  <tr>
                    <td width="27%" valign="top"><input name="q" type="text" class="metinkutusu" id="q" size="30"></td>
                    <td width="9%" valign="top"><input type="submit" class="buton" value="Ara"></td>
                    <td width="64%" class="icyazi"><p class="icyaziblok">İnternet üzerinde yer alan akademik ağlardaki dokümanları   yazar adına, eser adına ya da istediğiniz anahtar kelime / kelimeleri kullarak   arayabilirsiniz. Google Scholar'da arama ile ilgili ayrıntılı bilgi için <a href="http://scholar.google.com.tr/intl/en/scholar/help.html" target="_blank">tıklayınız</a>.</p></td>
                  </tr>
                </table>
              </form>              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>