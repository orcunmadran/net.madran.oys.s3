<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Gönderilmiş Mesajlar(mesaj)
$mesaj_sql = sprintf(
	"SELECT *, CONCAT(SUBSTRING(alici, 1, 20), '...') AS alicilar, DATE_FORMAT(zaman, '%%d.%%m.%%Y - %%H:%%i') AS tarihsaat
	 FROM mesaj
	 WHERE gonderen = '%s' AND silindi NOT LIKE('%%[%s]%%')
	 ORDER BY zaman DESC",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$mesaj_sonuc = mysql_query($mesaj_sql, $baglanti);
$mesaj_toplam = mysql_num_rows($mesaj_sonuc);
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
            <td width="49%" class="anabaslik"><a href="index.php">Mesajlar</a> &gt; Gönderilmiş Mesajlar (<?php echo $mesaj_toplam ?>) </td>
            <td width="41%" nowrap class="icyazi"><table border="0" cellspacing="2" cellpadding="2">
              <tr class="icyazi">
                <td><a href="yaz.php"><img src="../resimler/mesaj/yeni.gif" alt="MESAJ YAZ" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="yaz.php">Mesaj Yaz</a></td>
                <td>&nbsp;</td>
                <td><a href="index.php"><img src="../resimler/mesaj/gelenler.gif" alt="GELEN MESAJLAR" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="index.php">Gelen Mesajlar</a></td>
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
                <td width="18%" nowrap bgcolor="#EBEBEB" class="arabaslik">Alıcı(lar)</td>
                <td width="55%" nowrap bgcolor="#EBEBEB" class="arabaslik">Konu</td>
                <td width="18%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Tarih - Saat </div></td>
                <td width="4%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Sil</div></td>
              </tr>
			  <?php for($i=0; $i<$mesaj_toplam; $i++){
			  $mesaj_satir = mysql_fetch_assoc($mesaj_sonuc);?>
              <tr valign="top">
                <td><div align="center"><img src="../resimler/mesaj/gonderilenler.gif" alt="Bu mesajı okuyan kişiler: <?php echo $mesaj_satir['okundu'] ?>" width="16" height="15"></div></td>
                <td nowrap class="icyazi"><?php echo $mesaj_satir['alicilar'] ?></td>
                <td class="icyazi"><a href="gonderilmis.php?mesajno=<?php echo $mesaj_satir['no']; ?>"><?php echo str_replace("\n","<br>", htmlspecialchars(stripslashes($mesaj_satir["konu"]), ENT_QUOTES)); ?></a></td>
                <td nowrap class="icyazi"><div align="center"><?php echo $mesaj_satir['tarihsaat'] ?></div></td>
                <td><div align="center"><a href="gonderilmis_sil.php?mesajno=<?php echo $mesaj_satir['no']; ?>" onClick="return confirm('Mesaj kalıcı olarak silinecektir.')"><img src="../resimler/mesaj/sil.gif" alt="Mesajı silmek için tıklayınız." width="16" height="14" border="0"></a></div></td>
              </tr>
            	<?php } ?>
			</table></td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>