<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
//Mesaj
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
$mesaj_satir = mysql_fetch_assoc($mesaj_sonuc);

//Avatar Kontrol
$avatar_gonderen = "../resimler/avatar/".$mesaj_satir['gonderen'].".jpg";
if (file_exists($avatar)) {
    $avatar_gonderen = "../resimler/avatar/".$mesaj_satir['gonderen'].".jpg";
} else {
    $avatar_gonderen = "../resimler/avatar/avatar.jpg";
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
            <td width="49%" class="anabaslik"><a href="index.php">Mesajlar</a> &gt; Gönderilmiş Mesaj </td>
            <td width="41%" nowrap class="icyazi"><table border="0" cellspacing="2" cellpadding="2">
              <tr class="icyazi">
                <td><a href="yaz.php"><img src="../resimler/mesaj/yeni.gif" alt="MESAJ YAZ" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="yaz.php">Mesaj Yaz</a></td>
                <td>&nbsp;</td>
                <td><a href="index.php"><img src="../resimler/mesaj/gelenler.gif" alt="GELEN MESAJLAR" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="index.php">Gelen Mesajlar</a> </td>
                <td>&nbsp;</td>
                <td><a href="gonderilmisler.php"><img src="../resimler/mesaj/gonderilenler.gif" width="16" height="15" border="0"></a><a href="javascript:window.location.reload(true)"></a></td>
                <td nowrap><a href="gonderilmisler.php">Gönderilmiş Mesajlar</a></td>
              </tr>
            </table></td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" valign="top" class="anabaslik"><table width="100%" border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td width="12%" nowrap class="arabaslik">Gönderen</td>
                <td width="2%" class="arabaslik">:</td>
                <td colspan="3" class="icyazi"><?php echo $adsoyad ?></td>
                <td width="18%" rowspan="5" valign="top" class="icyazi"><span class="arabaslik"><img src="<?php echo $avatar_gonderen; ?>" name="avatar" width="100" height="100" class="avatar" style="background-color: #C8C8C8" title="<?php echo $mesaj_satir['gadsoyad']; ?>"></span></td>
              </tr>
              <tr>
                <td valign="top" nowrap class="arabaslik">Alıcı(lar)</td>
                <td class="arabaslik">:</td>
                <td colspan="3" class="icyazi"><?php echo $mesaj_satir['alici'] ?></td>
                </tr>
              <tr>
                <td nowrap class="arabaslik">Tarih / Saat </td>
                <td class="arabaslik">:</td>
                <td colspan="3" class="icyazi"><?php echo $mesaj_satir['tarihsaat'] ?></td>
                </tr>
              <tr>
                <td valign="top" nowrap class="arabaslik">Konu</td>
                <td valign="top" class="arabaslik">:</td>
                <td class="icyazi"><?php echo str_replace("\n","<br>", htmlspecialchars(stripslashes($mesaj_satir["konu"]), ENT_QUOTES)); ?><a href="cevap.php?mesajno=<?php echo $mesaj_satir['no']; ?>"></a></td>
                <td width="4%" class="icyazi"><a href="gonderilmis_ilet.php?mesajno=<?php echo $mesaj_satir['no']; ?>"><img src="../resimler/mesaj/yonlendir.gif" alt="MESAJI İLET" width="16" height="15" border="0"></a></td>
                <td width="4%" class="icyazi"><a href="gonderilmis_sil.php?mesajno=<?php echo $mesaj_satir['no']; ?>" onClick="return confirm('Mesaj kalıcı olarak silinecektir.')"><img src="../resimler/mesaj/sil.gif" alt="Mesajı silmek için tıklayınız." width="16" height="14" border="0"></a></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="3"><hr class="cizgi"></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="3"><span class="icyazi"><?php echo str_replace("\n","<br>", htmlspecialchars(stripslashes($mesaj_satir["icerik"]), ENT_QUOTES)); ?></span></td>
                <td valign="top" class="icyazi">&nbsp;</td>
              </tr>
            </table>
            <p>&nbsp;</p>              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>