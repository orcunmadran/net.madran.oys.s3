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
if( document.form1.eposta.value == "")
	{
	alert("Lütfen zorunlu alanları doldurunuz.");
	}
else {
	document.form1.submit();
	}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="335" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="0"><?php echo $sistem_logo; ?></td>
        <td width="400" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="1">
          <tr>
            <td><?php echo $sistem_ic_tanimlama; ?></td>
          </tr>
          <tr>
            <td><?php echo $sistem_ic_menu; ?></td>
          </tr>
        </table>
          </td>
      </tr>
      
      
      
      <tr>
        <td height="19" colspan="2" valign="top"><span class="icyazi"><a href="../sistem/cikis.php"></a></span></td>
      </tr>
      <tr>
        <td height="24" colspan="2" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td width="1%" class="anabaslik"><a href="index.php"><img src="../resimler/simge/kisisel_bilgiler.gif" alt="KİŞİSEL BİLGİLER" width="24" height="24" border="0"></a></td>
            <td width="93%" class="anabaslik"><a href="index.php">Kişisel Bilgiler</a> &gt; Güncelle</td>
            <td width="6%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td><form name="form1" method="post" action="guncelle2.php">
              <table width="100%" border="0" cellpadding="3" cellspacing="2">

                <tr>
                  <td colspan="4" nowrap class="arabaslik">Kullanıcı Bilgilerini Güncelle</td>
                  <td width="45%" nowrap class="arabaslik">Güncelleme ile ilgili açıklamalar</td>
                </tr>
                <tr>
                  <td width="11%" nowrap class="icyazi">E - Posta</td>
                  <td width="2%" nowrap class="icyazi"><div align="center">:</div></td>
                  <td width="30%" nowrap class="icyazi"><input name="eposta" type="text" class="metinkutusu" id="eposta" value="<?php echo $eposta; ?>" size="35" maxlength="50"></td>
                  <td width="12%" class="yildiz"><div align="left">*</div></td>
                  <td rowspan="7" valign="top" class="icyazi"><p>Kullanıcı tarafından güncellenebilecek kişisel bilgiler e-posta ve Web adresi ile sınırlı tutulmuştur.</p>
                      <p>E-posta ve Web haricinde (Ör: ad, soyad, vb.) değiştirilmesi gereken alanlar ile ilgili sistem yöneticisi ile iletişime geçmeniz gerekmektedir.</p>
                    <p>Sistem Yöneticisi ile iletişime geçmek için <a href="../mesajlar/yaz.php?alici=<?php echo $sistem_yonetici_kimlik; ?>">tıklayınız</a>.</p></td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">Web Adresi</td>
                  <td class="icyazi"><div align="center">:</div></td>
                  <td colspan="2" class="icyazi"><input name="web" type="text" class="metinkutusu" id="web" value="<?php echo $web; ?>" size="40" maxlength="50">                  </td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi"><input name="ROM_Guncelle" type="hidden" id="ROM_Guncelle" value="OK" /></td>
                  <td class="icyazi">&nbsp;</td>
                  <td colspan="2" class="icyazi"><input name="Button" type="button" onClick="formkontrol()" class="buton" value="Bilgileri Güncelle"></td>
                </tr>
                <tr>
                  <td height="19" colspan="2" nowrap class="icyazi"><div align="right"><span class="yildiz">*</span></div></td>
                  <td colspan="2" nowrap class="formuyari">Doldurulması zorunlu alanlar.</td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                  <td colspan="2" valign="top" nowrap class="formuyari">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                  <td colspan="2" valign="top"><p class="icyazi">&nbsp;</p></td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
              </table>
            </form></td>
            <td nowrap>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>