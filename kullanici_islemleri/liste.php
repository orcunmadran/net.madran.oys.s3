<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Arama Kriteri Kontrol
if(isset($_GET['yetki_no'])){
$_SESSION['sorgu_hatirla'] = "Location: liste.php?yetki_no=".$_GET['yetki_no'];
$yetki_kodu = $_GET['yetki_no'];
	//Yetkiye Göre Arama Sonuçları
	$aramayetki_sql = sprintf(
		"SELECT K.kimlik, K.yetki, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
		 FROM kullanici K, yetki_seviyesi YS
		 WHERE K.yetki = YS.no AND K.yetki = '%s'",
		 mysql_real_escape_string($yetki_kodu, $baglanti)
		);
	$aramayetki_sonuc = mysql_query($aramayetki_sql, $baglanti);
	$aramayetki_toplam = mysql_num_rows($aramayetki_sonuc);
	$arama_sonuc = $aramayetki_sonuc;
	$arama_toplam = $aramayetki_toplam;
}
//Arama Kriteri Kontrol
if(isset($_GET['anahtar'])){
$_SESSION['sorgu_hatirla'] = "Location: liste.php?anahtar=".$_GET['anahtar'];
$anahtar = "%".$_GET['anahtar']."%";
	//Anahtar Kelimeye Göre Arama Sonuçları
	$aramaanahtar_sql = sprintf(
		"SELECT K.kimlik, K.yetki, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
		 FROM kullanici K, yetki_seviyesi YS
		 WHERE K.yetki = YS.no AND (K.kimlik LIKE '%s' OR K.ad LIKE '%s' OR K.soyad LIKE '%s' OR K.soyad LIKE '%s')",
		 mysql_real_escape_string($anahtar, $baglanti),
		 mysql_real_escape_string($anahtar, $baglanti),
		 mysql_real_escape_string($anahtar, $baglanti),
		 mysql_real_escape_string($anahtar, $baglanti)
		);
	$aramaanahtar_sonuc = mysql_query($aramaanahtar_sql, $baglanti);
	$aramaanahtar_toplam = mysql_num_rows($aramaanahtar_sonuc);
	$arama_sonuc = $aramaanahtar_sonuc;
	$arama_toplam = $aramaanahtar_toplam;
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
        <td height="24" colspan="2" valign="top"><table width="100%" height="325" border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/kisisel_bilgiler.gif" width="24" height="24"></td>
            <td class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; Kullanıcı Listesi (<?php echo $arama_toplam ?>) </td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td width="14%" nowrap bgcolor="#EBEBEB" class="arabaslik">Kullanıcı Adı </td>
                <td width="62%" bgcolor="#EBEBEB" class="arabaslik">Ad - Soyad </td>
                <td width="10%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Yetki Seviyesi</div></td>
                <td width="10%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Mesaj At </div></td>
                <td width="9%" bgcolor="#EBEBEB" class="arabaslik"><div align="center">Güncelle</div></td>
                <td width="5%" bgcolor="#EBEBEB" class="arabaslik"><div align="center">Sil</div></td>
              </tr>
              <?php for($i=0; $i<$arama_toplam; $i++){
			  $arama_satir = mysql_fetch_assoc($arama_sonuc);
			  ?>
              <tr>
                <td nowrap class="icyazi"><?php echo $arama_satir['kimlik'] ?></td>
                <td class="icyazi"><a href="../kisisel_bilgiler/profil.php?kimlik=<?php echo $arama_satir['kimlik'] ?>"><?php echo $arama_satir['adsoyad']?></a></td>
                <td nowrap class="icyazi"><div align="center"><?php echo $arama_satir['yetkiseviyesi']?></div></td>
                <td class="icyazi"><div align="center"><a href="../mesajlar/yaz.php?alici=<?php echo $arama_satir['kimlik'] ?>"><img src="../resimler/mesaj/yeni.gif" width="16" height="15" border="0" title="Mesaj Gönder"></a></div></td>
                <td class="icyazi"><div align="center">
                <?php if($yetki < $arama_satir['yetki']){?>
                <a href="guncelle.php?kimlik=<?php echo $arama_satir['kimlik'] ?>"><img src="../resimler/simge/guncelle.gif" alt="Kullanıcı bilgilerini güncellemek için tıklayınız." width="16" height="16" border="0"></a>
                <?php }else{
				echo"---";
				}?>
                </div></td>
                <td class="icyazi"><div align="center">
                <?php if($yetki < $arama_satir['yetki']){?>
                <a href="sil.php?kimlik=<?php echo $arama_satir['kimlik'] ?>" onClick="return confirm('Kullanıcı kalıcı olarak silinecektir.')"><img src="../resimler/simge/sil.gif" alt="Kullanıcıyı silmek için tıklayınız." width="16" height="16" border="0" ></a><a href="sil.php?kimlik=<?php echo $arama_satir['kimlik'] ?>" onClick="return confirm('Kullanıcı kalıcı olarak silinecektir.')"></a>
                <?php }else{
				echo"---";
				}?>
                </div></td>
              </tr>
          <?php }?>
            </table>              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>