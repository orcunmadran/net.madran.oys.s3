<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");

//Mesaj
$mesajno = $_GET['mesajno'];
$mesaj_sql = sprintf(
	"SELECT M.*, CONCAT(K.ad, ' ', K.soyad) AS gadsoyad, DATE_FORMAT(zaman, '%%d.%%m.%%Y - %%H:%%i') AS tarihsaat
	 FROM kullanici K, mesaj M
	 WHERE K.kimlik = M.gonderen AND M.alici LIKE('%%[%s]%%') AND M.silindi NOT LIKE('%%[%s]%%') AND M.no = '%s'
	 ORDER BY zaman DESC",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($mesajno, $baglanti)
	);
$mesaj_sonuc = mysql_query($mesaj_sql, $baglanti);
$mesaj_toplam = mysql_num_rows($mesaj_sonuc);
$mesaj_satir = mysql_fetch_assoc($mesaj_sonuc);

//Adres Defteri
$adres_sql = sprintf(
	"SELECT kimlik, CONCAT(ad, ' ',soyad) AS adsoyad
	 FROM kullanici
	 ORDER BY ad"
	);
$adres_sonuc = mysql_query($adres_sql, $baglanti);
$adres_toplam = mysql_num_rows($adres_sonuc);
//$adres_satir = mysql_fetch_assoc($adres_sonuc);
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../stiller.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function formkontrol(){
	if( document.form1.alici.value == "" |
		document.form1.konu.value == "" |
		document.form1.icerik.value == ""){
		alert("Lütfen zorunlu alanları doldurunuz.");
		}
	else {document.form1.submit();}
}
function adresekle(){
	document.form1.alici.value += "["+document.form1.adresdefteri.value+"] ";
}
function adrestemizle(){
	document.form1.alici.value = "";
}
</script>
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/mesajlar2.gif" width="24" height="24"></td>
            <td width="49%" class="anabaslik"><p><a href="index.php">Mesajlar</a> &gt; Mesajı Cevapla</p>
              </td>
            <td width="41%" nowrap class="icyazi"><table border="0" cellspacing="2" cellpadding="2">
              <tr class="icyazi">
                <td><a href="index.php"><img src="../resimler/mesaj/gelenler.gif" alt="GELEN MESAJLAR" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="index.php">Gelen Mesajlar</a></td>
                <td>&nbsp;</td>
                <td><a href="gonderilmisler.php"><img src="../resimler/mesaj/gonderilenler.gif" alt="GÖNDERİLMİŞ MESAJLAR" width="16" height="15" border="0"></a></td>
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
            <td colspan="2" valign="top"><form name="form1" method="post" action="gonder.php">
              <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                  <td width="10%" class="arabaslik">Gönderen</td>
                  <td width="2%" class="arabaslik">:</td>
                  <td width="52%" class="icyazi"><?php echo $adsoyad ?>
                    <input name="gonderen" type="hidden" id="gonderen" value="<?php echo $kimlik ?>">
                    <input name="ROM_ekle" type="hidden" id="ROM_ekle" value="OK"></td>
                  <td width="16%" nowrap class="arabaslik">Adres Defteri</td>
                  <td width="17%"><div align="right" class="icyazi"><a href="#" onClick="adrestemizle()">Alıcıları Temizle </a></div></td>
                </tr>
                <tr>
                  <td valign="top" class="arabaslik">Alıcı(lar)</td>
                  <td valign="top" class="arabaslik">:</td>
                  <td><textarea name="alici" cols="45" rows="2" class="metinkutusu" id="alici"><?php echo "[".$mesaj_satir['gonderen']."] "; ?></textarea></td>
                  <td colspan="2" rowspan="3" valign="top"><select name="adresdefteri" size="12" class="adresdefteri" id="adresdefteri" onClick="adresekle()">
                    <?php for($i=0; $i<$adres_toplam; $i++){
					$adres_satir = mysql_fetch_assoc($adres_sonuc); ?>
                    <option value="<?php echo $adres_satir['kimlik'] ?>"><?php echo $adres_satir['adsoyad'] ?></option>
                  <?php } ;?>
                  </select>                  </td>
                </tr>
                <tr>
                  <td class="arabaslik">Konu</td>
                  <td class="arabaslik">:</td>
                  <td><input name="konu" type="text" class="metinkutusu" id="konu" value="Cevap: <?php echo $mesaj_satir['konu']; ?>" size="50" maxlength="100"></td>
                  </tr>
                <tr>
                  <td valign="top" class="arabaslik">Mesaj</td>
                  <td valign="top" class="arabaslik">:</td>
                  <td><textarea name="icerik" cols="55" rows="7" class="metinkutusu" id="icerik">


Orjinal Mesaj
------------------
Gönderen: <?php echo $mesaj_satir['gadsoyad']; ?>

Alıcı: <?php echo $adsoyad; ?>

Tarih Saat: <?php echo $mesaj_satir['tarihsaat']; ?>

Konu: <?php echo $mesaj_satir['konu']; ?>


<?php echo $mesaj_satir['icerik']; ?>
</textarea></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input name="button" type="button" class="buton" id="button" onClick="formkontrol()" value="Mesajı Gönder"></td>
                  <td colspan="2" rowspan="2" valign="top" class="icyazi"><div align="center">Mesaj göndermek istediğiniz<br>
                    kişi / kişileri seçiniz.</div></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td class="formuyari">Tüm alanların doldurulması zorunludur.</td>
                  </tr>
              </table>
                        </form>
              </td>
            <td valign="top">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>