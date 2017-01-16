<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

// Bilgilendirme
switch($_GET['hatamesaj']){
	case '1' : $resim_mesaj =  "Yükleme işlemi gerçekleştirilemedi.<br>";
	break;
	case '2' : $resim_mesaj = "Dosya büyüklüğü 100 Kb'ın üzerinde.";
	break;
	case '3' : $resim_mesaj = "Yüklemek istediğiniz dosya *.jpg ya da *.gif uzantılı olmalı.";
	break;
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
if( document.form1.dosya.value == "")
	{
	alert("Lütfen resim seçiniz.");
	}
else {
	document.form1.submit();
	}
}
</script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="700" height="329" align="center" cellpadding="0" cellspacing="0">
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
            <td width="93%" class="anabaslik">&nbsp;<a href="index.php">Kişisel Bilgiler</a> &gt; Resim Yükle / GÜncelle</td>
            <td width="6%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td><form action="resim2.php" method="post" enctype="multipart/form-data" name="form1">
              <table width="100%" border="0" cellpadding="3" cellspacing="2">

                <tr>
                  <td colspan="4" nowrap class="arabaslik">Resim Yükle /  Güncelle</td>
                  <td width="10%" nowrap class="arabaslik">&nbsp;</td>
                  <td width="55%" nowrap class="arabaslik">Resim yükleme  ile ilgili sınırlamalar</td>
                </tr>
                <tr>
                  <td width="11%" height="19" nowrap class="icyazi">Resim Seç</td>
                  <td width="2%" class="icyazi"><div align="center">:</div></td>
                  <td width="39" colspan="2" nowrap class="icyazi"><input name="dosya" type="file" class="metinkutusu" id="dosya"></td>
                  <td rowspan="7" valign="top" class="icyazi">&nbsp;</td>
                  <td rowspan="7" valign="top" class="icyazi"><p>Yükleyeceğiniz resim JPEG (*.jpg) ya da GIF (*.gif) formatında olmalıdır. </p>
                      <p>Resminizin dosya büyüklüğü 100 KB'ın üzerinde olmamalıdır. </p>
                    <p>Resminiz sistem içerisinde 125 * 125 piksel boyutlarında   gösterilecektir.</p>
                    <p>&nbsp;</p></td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi"><input name="ROM_Guncelle" type="hidden" id="ROM_Guncelle" value="OK" /></td>
                  <td class="icyazi">&nbsp;</td>
                  <td colspan="2" nowrap class="icyazi"><input type="button" onClick="formkontrol()" class="buton" value="Yükle / Güncelle"></td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td colspan="2" rowspan="5" valign="top"><?php if(isset($_GET['hatamesaj'])){ ;?>
                      <table width="100%" border="0" cellspacing="2" cellpadding="3">
                        <tr>
                          <td class="formuyari">Resim Yüklenemedi!</td>
                        </tr>
                        <tr>
                          <td class="arabaslik">Açıklama:</td>
                        </tr>
                        <tr>
                          <td><span class="icyazi"><?php echo $resim_mesaj; ?></span></td>
                        </tr>
                      </table>
                    <?php };?>                  </td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
                  <td class="icyazi">&nbsp;</td>
                </tr>
                <tr>
                  <td height="19" nowrap class="icyazi">&nbsp;</td>
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