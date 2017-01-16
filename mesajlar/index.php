<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

//Mesaj Listeleme Varsayılanları
if(isset($_GET['goster'])){
	$kayit_goster = $_GET['goster'];
	$ileri = $_GET['goster'] + $mesaj_listeleme_sayisi;
	$geri = $_GET['goster'] - $mesaj_listeleme_sayisi;
}
else {
	$kayit_goster = 0;
	$ileri = $mesaj_listeleme_sayisi;
	$geri = 0;
}

//Toplam Mesaj Sayısı
$tms_sql = sprintf(
	"SELECT M.*
	 FROM kullanici K, mesaj M
	 WHERE K.kimlik = M.gonderen AND M.alici LIKE('%%[%s]%%') AND silindi NOT LIKE('%%[%s]%%')
	 ORDER BY zaman DESC",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$tms_toplam = mysql_num_rows(mysql_query($tms_sql, $baglanti));

//Gelen Mesajlar(Mesaj)
$mesaj_sql = sprintf(
	"SELECT M.*, CONCAT(K.ad, ' ', K.soyad) AS gadsoyad, DATE_FORMAT(zaman, '%%d.%%m.%%Y - %%H:%%i') AS tarihsaat
	 FROM kullanici K, mesaj M
	 WHERE K.kimlik = M.gonderen AND M.alici LIKE('%%[%s]%%') AND silindi NOT LIKE('%%[%s]%%')
	 ORDER BY zaman DESC
	 LIMIT $kayit_goster, $mesaj_listeleme_sayisi",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$mesaj_sonuc = mysql_query($mesaj_sql, $baglanti);
$mesaj_toplam = mysql_num_rows($mesaj_sonuc);

//Mesaj Okundu Kontrol (okundu)
$okundu_sql = sprintf(
	"SELECT M.*, CONCAT(K.ad, ' ', K.soyad) AS gadsoyad, DATE_FORMAT(zaman, '%%d.%%m.%%Y - %%H:%%i') AS tarihsaat
	 FROM kullanici K, mesaj M
	 WHERE K.kimlik = M.gonderen AND M.alici LIKE('%%[%s]%%') AND silindi NOT LIKE('%%[%s]%%') AND okundu NOT LIKE('%%[%s]%%')
	 ORDER BY zaman DESC",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$okundu_sonuc = mysql_query($okundu_sql, $baglanti);
$okundu_toplam = mysql_num_rows($okundu_sonuc);
$okundu_satir = mysql_fetch_assoc($okundu_sonuc);

//Mesaj Listeleme Kontrol
if($mesaj_toplam <= $mesaj_listeleme_sayisi){
	$mesaj_sayisi = $mesaj_toplam;
	}
	else {
	$mesaj_sayisi = $mesaj_listeleme_sayisi;
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/mesajlar2.gif" width="24" height="24"></td>
            <td width="49%" class="anabaslik"><a href="index.php">Mesajlar</a> &gt; Gelen Mesajlar (<?php echo $okundu_toplam ?> / <?php echo $tms_toplam ?>)</td>
            <td width="41%" nowrap class="icyazi"><table border="0" cellspacing="2" cellpadding="2">
              <tr class="icyazi">
                <td><a href="yaz.php"><img src="../resimler/mesaj/yeni.gif" alt="MESAJ YAZ" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="yaz.php">Mesaj Yaz</a></td>
                <td>&nbsp;</td>
                <td><a href="gonderilmisler.php"><img src="../resimler/mesaj/gonderilenler.gif" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="gonderilmisler.php">Gönderilmiş Mesajlar</a></td>
                <td>&nbsp;</td>
                <td><a href="javascript:window.location.reload(true)"><img src="../resimler/mesaj/yenile.gif" alt="YENİLE" width="16" height="16" border="0"></a></td>
                <td nowrap><a href="javascript:window.location.reload(true)">Yenile</a></td>
              </tr>
            </table></td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" valign="top" class="anabaslik"><table width="100%" border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td>&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
              </tr>
              <tr>
                <td width="5%" bgcolor="#EBEBEB"><div align="center"></div></td>
                <td width="18%" nowrap bgcolor="#EBEBEB" class="arabaslik">Gönderen</td>
                <td width="55%" nowrap bgcolor="#EBEBEB" class="arabaslik">Konu</td>
                <td width="18%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Tarih - Saat </div></td>
                <td width="4%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Sil</div></td>
              </tr>
              <?php for($i=0; $i<$mesaj_sayisi; $i++){
			  $mesaj_satir = mysql_fetch_assoc($mesaj_sonuc);?>
              <tr valign="top">
                <td><img src="../resimler/mesaj/<?php
				   $posta_alicisi = "[".$kimlik."]";
				   $posta_okuyanlar = $mesaj_satir['okundu'];
				   if(stristr($posta_okuyanlar, $posta_alicisi) === FALSE){
                   echo "mesaj0.gif";
				   } else {
				   echo "mesaj1.gif";
				   }
				   ?>" /></td>
                <td nowrap class="icyazi"><?php echo $mesaj_satir['gadsoyad'] ?></td>
                <td class="icyazi"><a href="gelen.php?mesajno=<?php echo $mesaj_satir['no']; ?>"><?php echo str_replace("\n","<br>", htmlspecialchars(stripslashes($mesaj_satir["konu"]), ENT_QUOTES)); ?></a></td>
                <td nowrap class="icyazi"><div align="center"><?php echo $mesaj_satir['tarihsaat'] ?></div></td>
                <td><div align="center"><a href="gelen_sil.php?mesajno=<?php echo $mesaj_satir['no']; ?>" onClick="return confirm('Mesaj kalıcı olarak silinecektir.')"><img src="../resimler/mesaj/sil.gif" alt="Mesajı silmek için tıklayınız." width="16" height="14" border="0"></a></div></td>
              </tr>
              <?php } ?>
              <tr>
                <td>&nbsp;</td>
                <td colspan="4" nowrap class="icyazi">
                <?php if($ileri > $mesaj_listeleme_sayisi){ ?>
                <a href="index.php?goster=<?php echo $geri ?>">Sonraki mesajlar</a>
                <?php } ?>
                <?php if($ileri > $mesaj_listeleme_sayisi && $ileri < $tms_toplam){ ?>
                 | 
                <?php } ?>
                <?php if($ileri < $tms_toplam){
                ?>
                <a href="index.php?goster=<?php echo $ileri ?>">Önceki mesajlar</a>
                <?php } ?>                </td>
                </tr>
            </table>              
            </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>