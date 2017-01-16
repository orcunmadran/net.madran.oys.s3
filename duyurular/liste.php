<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Gönderilmiş Mesajlar(mesaj)
$duyuru_sql = sprintf(
	"SELECT *, CONCAT(SUBSTRING(alici, 1, 20), '...') AS alicilar, DATE_FORMAT(baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(bitis, '%%d.%%m.%%Y') AS tbitis
	 FROM duyuru
	 WHERE kimlik = '%s'
	 ORDER BY baslangic DESC",
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$duyuru_sonuc = mysql_query($duyuru_sql, $baglanti);
$duyuru_toplam = mysql_num_rows($duyuru_sonuc);
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/duyurular.gif" width="24" height="24"></td>
            <td width="72%" class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; Oluşturulmuş Duyurular (<?php echo $duyuru_toplam ?>)</td>
            <td width="18%" nowrap class="icyazi"><table border="0" cellspacing="2" cellpadding="2">
              <tr class="icyazi">
                <td><a href="olustur.php"><img src="../resimler/mesaj/duyuru.gif" alt="DUYURU OLUŞTUR" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="olustur.php">Duyuru Oluştur </a></td>
                </tr>
            </table></td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" valign="top" class="anabaslik"><table width="100%" border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td nowrap class="arabaslik">&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
                <td colspan="2" nowrap class="arabaslik">&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
                <td nowrap class="arabaslik">&nbsp;</td>
              </tr>
              <tr>
                <td width="21%" nowrap bgcolor="#EBEBEB" class="arabaslik">Alıcı(lar)</td>
                <td width="48%" nowrap bgcolor="#EBEBEB" class="arabaslik">Konu</td>
                <td width="10%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Başlangıç</div></td>
                <td width="8%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Bitiş</div></td>
                <td width="9%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Güncelle</div></td>
                <td width="4%" nowrap bgcolor="#EBEBEB" class="arabaslik"><div align="center">Sil</div></td>
              </tr>
			  <?php for($i=0; $i<$duyuru_toplam; $i++){
			  $duyuru_satir = mysql_fetch_assoc($duyuru_sonuc);?>
              <tr valign="top">
                <td nowrap class="icyazi"><?php echo $duyuru_satir['alicilar'] ?></td>
                <td class="icyazi"><a href="duyuru.php?duyuruno=<?php echo $duyuru_satir['no']; ?>"><?php echo stripslashes($duyuru_satir['konu']) ?></a></td>
                <td nowrap class="icyazi"><div align="center"><?php echo $duyuru_satir['tbaslangic'] ?></div></td>
                <td nowrap class="icyazi"><div align="center"><?php echo $duyuru_satir['tbitis'] ?></div></td>
                <td><div align="center"><a href="guncelle.php?duyuruno=<?php echo $duyuru_satir['no']; ?>"><img src="../resimler/simge/guncelle.gif" alt="DUYURU GUNCELLE" width="16" height="16" border="0"></a></div></td>
                <td><div align="center"><a href="sil.php?duyuruno=<?php echo $duyuru_satir['no']; ?>" onClick="return confirm('Duyuru kalıcı olarak silinecektir.')"><img src="../resimler/simge/sil.gif" alt="Duyuruyu silmek için tıklayınız." width="16" height="16" border="0"></a></div></td>
              </tr>
            	<?php } ?>
			</table></td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>