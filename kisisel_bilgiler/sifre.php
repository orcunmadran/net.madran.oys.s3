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
	if(document.form1.eskisifre.value == document.form1.eskisifre2.value){	
		if(document.form1.sifre.value == document.form1.sifre2.value){
			if( document.form1.eskisifre.value == "" |
				document.form1.sifre.value == "" |
				document.form1.sifre2.value == ""){
				alert("Lütfen zorunlu alanları doldurunuz.");
			}
			else {document.form1.submit();}
		}
		else {alert("Yeni girilen şifreler aynı olmalıdır.");}
	}
	else {alert("Eski şifrenizi yanlış girdiniz.");}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="346" align="center" cellpadding="0" cellspacing="0">
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
            <td width="93%" class="anabaslik">&nbsp;<a href="index.php">Kişisel Bilgiler</a> &gt; Şifre Değiştir</td>
            <td width="6%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td><form name="form1" method="post" action="sifre2.php">
              <table width="100%" border="0" cellpadding="3" cellspacing="2">
                <tr>
                  <td colspan="3" nowrap class="arabaslik">Şifre Değiştir</td>
                  <td width="5%" nowrap class="arabaslik">&nbsp;</td>
                  <td width="52%" nowrap class="arabaslik">Şifre Değiştirilmesi  ile ilgili açıklamalar</td>
                </tr>
                <tr>
                  <td width="16%" nowrap class="icyazi">Eski Şifre</td>
                  <td width="2%" nowrap class="icyazi"><div align="center">:</div></td>
                  <td width="29%" nowrap class="icyazi"><input name="eskisifre" type="password" class="metinkutusu" id="eskisifre" size="20" maxlength="20"></td>
                  <td rowspan="7" valign="top" class="icyazi">&nbsp;</td>
                  <td rowspan="7" valign="top" class="icyazi"><p>Şifreniz en fazla 20 karekter uzunluğunda olabilir.</p>
                      <p>Şifrenizi kolay tahmin edilebilecek karakter ya da rakam gruplarından ve doğum tarihi gibi kişisel bilgilerinizi içeren kombinasyonlardan oluşturmayınız.</p>
                    <p>Belirli zaman aralıklarında şifrenizi değiştirmek sistemi daha güvenli olarak kullanmanızı sağlayacaktır.</p></td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">Yeni Şifre</td>
                  <td class="icyazi"><div align="center">:</div></td>
                  <td nowrap class="icyazi"><input name="sifre" type="password" class="metinkutusu" id="sifre" size="20" maxlength="20">                  </td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">Yeni Şifre Tekrar</td>
                  <td class="icyazi"><div align="center">:</div></td>
                  <td nowrap class="icyazi"><input name="sifre2" type="password" class="metinkutusu" id="sifre2" size="20" maxlength="20"></td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi"><input name="ROM_Guncelle" type="hidden" id="ROM_Guncelle" value="OK" />
                      <input name="eskisifre2" type="hidden" id="eskisifre2" value="<?php echo $sifre ?>" /></td>
                  <td class="icyazi">&nbsp;</td>
                  <td nowrap class="icyazi"><input name="Button" type="button" onClick="formkontrol()" class="buton" value="Şifre Değiştir"></td>
                </tr>
                <tr>
                  <td height="19" colspan="2" nowrap class="icyazi"><div align="right"></div></td>
                  <td class="formuyari">Tüm alanların doldurulması zorunludur.</td>
                </tr>
                <tr>
                  <td valign="top" class="formuyari">&nbsp;</td>
                  <td valign="top" class="formuyari">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" class="formuyari">&nbsp;</td>
                  <td valign="top" class="formuyari">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                </tr>
              </table>
            </form></td>
            <td nowrap>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>