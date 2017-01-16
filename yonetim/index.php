<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Yetki Listesi
$yetki_sql = sprintf(
	"SELECT Y.*, COUNT(K.yetki) AS ksayi
	 FROM yetki_seviyesi Y, kullanici K
	 WHERE K.yetki <> 'Boş' AND Y.no = K.yetki
	 GROUP BY K.yetki
	 ORDER BY Y.no"
	);
$yetki_sonuc = mysql_query($yetki_sql, $baglanti);
$yetki_toplam = mysql_num_rows($yetki_sonuc);
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/yonetim2.gif" width="24" height="24"></td>
            <td class="anabaslik">Yönetim</td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
				<?php if($yetki < 4){; ?>
                  <td valign="top"><table border="0" cellspacing="2" cellpadding="3">
                    <tr>
                      <td class="arabaslik"><img src="../resimler/simge/kullanici.gif" width="16" height="16"></td>
                      <td class="arabaslik">Kullanıcılar</td>
                      </tr>
                    <tr>
                      <td valign="top" class="icyazi">&nbsp;</td>
                      <td valign="top" class="icyazi"><table width="100%" border="0" cellspacing="2" cellpadding="3">
                          <tr>
                            <td class="icyazi"><a href="../kullanici_islemleri/yeni_kayit.php">Yeni Kayıt </a></td>
                          </tr>
                          <tr>
                            <td><form name="form1" method="get" action="../kullanici_islemleri/liste.php">
                              <span class="icyazi">Kullanıcı Listeleri:</span><br>
                              <select name="yetki_no" class="metinkutusu" id="yetki_no" onChange="submit()">
                                <option value="Liste Hata">Seçiniz</option>
                                <?php for($i=0; $i<$yetki_toplam; $i++){
							$yetki_satir = mysql_fetch_assoc($yetki_sonuc); ?>
                                <option value="<?php echo $yetki_satir['no'] ?>"><?php echo $yetki_satir['yetki']." (".$yetki_satir['ksayi'].")"; ?></option>
                                <?php } ;?>
                              </select>
                            </form></td>
                          </tr>
                          <tr>
                            <td><form name="form2" method="get" action="../kullanici_islemleri/liste.php">
                              <span class="icyazi">Kullanıcı Arama: </span><br>
                              <input name="anahtar" type="text" class="metinkutusu" id="anahtar">
                              <input type="submit" class="buton_ince" value="Ara">
                            </form></td>
                          </tr>
                      </table></td>
                      </tr>
                  </table></td>
				  <?php }; ?>
                  <td valign="top"><table border="0" cellspacing="2" cellpadding="3">
                    <tr>
                      <td class="arabaslik"><img src="../resimler/simge/duyurular2.gif" width="16" height="16"></td>
                      <td class="arabaslik">Duyurular</td>
                    </tr>
                    <tr>
                      <td valign="top" class="icyazi">&nbsp;</td>
                      <td valign="top" class="icyazi"><table width="100%" border="0" cellspacing="2" cellpadding="3">
                          <tr>
                            <td class="icyazi"><a href="../duyurular/olustur.php">Duyuru Oluştur </a></td>
                          </tr>
                          <tr>
                            <td class="icyazi"><a href="../duyurular/liste.php">Oluşturulmuş Duyurular </a></td>
                          </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
              </table>              <p>&nbsp;</p></td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>