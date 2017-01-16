<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

//Mesaj Okundu Kontrol (okundu)
$okundu_sql = sprintf(
	"SELECT M.no
	 FROM mesaj M
	 WHERE M.alici LIKE('%%[%s]%%') AND silindi NOT LIKE('%%[%s]%%') AND okundu NOT LIKE('%%[%s]%%')",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$okundu_sonuc = mysql_query($okundu_sql, $baglanti);
$okundu_toplam = mysql_num_rows($okundu_sonuc);
$okundu_satir = mysql_fetch_assoc($okundu_sonuc);
if($okundu_toplam > 0){
$okundu_mesaj=$okundu_toplam." yeni mesajınız var.";
}
else{
$okundu_mesaj="Yeni mesajınız yok.";
}
//Duyuru Sistemi
$duyuru_tnm = "Kampüs İçi";
$duyuru_sql = sprintf(
	"SELECT D.*, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis
	 FROM duyuru D
	 WHERE (D.alici LIKE('%%[%s]%%') OR D.alici LIKE('%%[%s]%%') OR D.alici LIKE('%%[%s]%%')) AND baslangic <= DATE_FORMAT(now(), '%%Y-%%m-%%d') AND bitis >= DATE_FORMAT(now(), '%%Y-%%m-%%d')
	 ORDER BY D.baslangic DESC",
	 mysql_real_escape_string($duyuru_tnm),
	 mysql_real_escape_string($kimlik),
	 mysql_real_escape_string($yetki)
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/ana_sayfa2.gif" width="24" height="24"></td>
            <td class="anabaslik">Ana Sayfa</td>
            <td class="anabaslik">Kısa Yollar </td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td width="60%" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
              <tr>
                <td width="6%"><img src="../resimler/mesaj/duyuru.gif" width="16" height="15"></td>
                <td nowrap><span class="arabaslik">Haberler - Duyurular - Etkinlikler</span></td>
                <td width="19%" nowrap><span class="icyazi"><a href="arsiv.php">Duyuru Arşivi</a></span></td>
                <td width="7%" class="icyazi"><a href="arsiv.php"><img src="../resimler/mesaj/arsiv.gif" title="DUYURU ARŞİVİ" width="16" height="15" border="0"></a></td>
                <td width="2%" nowrap class="icyazi">&nbsp;</td>
              </tr>
			<?php if($duyuru_toplam == 0){; ?>
			  <tr>
                <td valign="top">&nbsp;</td>
                <td colspan="3" valign="top" class="icyazi"><p>Yayında olan haber, duyuru ya da etkinlikler ile ilgili bilgi bulunmamaktadır.</p>
                  <p>Daha önce yayınlanmış olan  haber, duyuru ya da etkinlikler ile ilgili bilgilere ulaşmak için <a href="arsiv.php">tıklayınız</a>.</p></td>
              </tr>
			  <?php } else {?>
              <?php for($i=0; $i<$duyuru_toplam; $i++){
			  $duyuru_satir = mysql_fetch_assoc($duyuru_sonuc);?>
			  <tr>
                <td><div align="center" class="anabaslik">-</div></td>
                <td colspan="3" nowrap class="icyazi"><?php echo $duyuru_satir['tbaslangic'] ?><a href="duyuru.php?duyuruno=<?php echo $duyuru_satir['no']; ?>"> <?php echo stripslashes($duyuru_satir['konu']) ?></a></td>
                <td>&nbsp;</td>
              </tr>
			  <?php }}?>
            </table>
              <p class="arabaslik">&nbsp;</p>
              <p class="arabaslik">&nbsp;</p>
              <p class="arabaslik">&nbsp;</p></td>
            <td width="30%" valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="2" class="panel">
              <tr>
                <td width="50%" class="arabaslik">Mesajlar</td>
                <td width="1%"><a href="javascript:window.location.reload(true)"><img src="../resimler/mesaj/kontrolet.gif" title="YENİLE" width="16" height="16" border="0"></a></td>
                <td width="1%"><a href="../mesajlar/index.php"><img src="../resimler/mesaj/gelenler.gif" title="GELEN MESAJLAR" width="16" height="15" border="0"></a></td>
                <td width="1%"><a href="../mesajlar/gonderilmisler.php"><img src="../resimler/mesaj/gonderilenler.gif" title="GÖNDERİLMİŞ MESAJLAR" width="16" height="15" border="0"></a></td>
                <td width="1%"><a href="../mesajlar/yaz.php"><img src="../resimler/mesaj/yeni.gif" title="MESAJ YAZ" width="16" height="15" border="0"></a></td>
              </tr>
              <tr>
                <td colspan="5" class="icyazi"><a href="../mesajlar/index.php"><?php echo $okundu_mesaj; ?></a></td>
                </tr>

            </table>
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="2" class="panel">
                <tr>
                  <td colspan="2" class="arabaslik">Kişisel Bilgiler</td>
                  </tr>
                <tr>
                  <td width="8%" class="icyazi"><a href="../kisisel_bilgiler/guncelle.php"><img src="../resimler/simge/guncelle_t.gif" alt="BİLGİLERİ GÜNCELLE" width="16" height="16" border="0"></a></td>
                  <td width="92%" class="icyazi"><a href="../kisisel_bilgiler/guncelle.php">Bilgileri Güncelle</a></td>
                </tr>
                <tr>
                  <td class="icyazi"><a href="../kisisel_bilgiler/sifre.php"><img src="../resimler/simge/sifre_degistir_t.gif" alt="ŞİFRE DEĞİŞTİR" width="16" height="16" border="0"></a></td>
                  <td class="icyazi"><a href="../kisisel_bilgiler/sifre.php">Şifre Değiştir </a></td>
                </tr>
              </table>              
              <br>
              <table width="100%" border="0" cellpadding="3" cellspacing="2" class="panel">
                <tr>
                  <td class="arabaslik">Fotoğraf (Avatar) </td>
                  <td width="43%" rowspan="4" class="arabaslik"><div align="right"><span class="arabaslik"><img src="<?php echo $avatar; ?>" name="avatar" width="75" height="75" class="avatar" style="background-color: #C8C8C8" title="<?php echo $adsoyad ?>"></span></div></td>
                </tr>
                <tr>
                  <td width="57%" valign="top" class="icyazi"><a href="../kisisel_bilgiler/resim.php">Yükle /  Güncelle</a></td>
                  </tr>
                <tr>
                  <td valign="top" class="icyazi">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top" class="icyazi">&nbsp;</td>
                </tr>
              </table>              
              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>