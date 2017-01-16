<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");
require("../moduller/sistem_varsayilan.php");
require("../moduller/izin_listesi.php");
//Kisi Listesi
$kisi_sql = sprintf(
	"SELECT kimlik, CONCAT(ad, ' ',soyad) AS adsoyad
	 FROM kullanici
	 ORDER BY ad"
	);
$kisi_sonuc = mysql_query($kisi_sql, $baglanti);
$kisi_toplam = mysql_num_rows($kisi_sonuc);
//$kisi_satir = mysql_fetch_assoc($kisi_sonuc);
//Yetki Listesi
$yetki_sql = sprintf(
	"SELECT *
	 FROM yetki_seviyesi
	 WHERE yetki <> 'Boş' AND yetki <> 'Onaylanmadı' AND yetki <> 'Kayıt Donduruldu' AND no NOT IN($izin)
	 ORDER BY no"
	);
$yetki_sonuc = mysql_query($yetki_sql, $baglanti);
$yetki_toplam = mysql_num_rows($yetki_sonuc);
//$yetki_satir = mysql_fetch_assoc($yetki_sonuc);

//Duyuru Ayrinti (duyuru)
$duyuruno = $_GET['duyuruno'];
$duyuru_sql = sprintf(
	"SELECT *, CONCAT(SUBSTRING(D.alici, 1, 20), '...') AS alicilar, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis, CONCAT(K.ad, ' ', K.soyad) AS yadsoyad
	 FROM duyuru D, kullanici K
	 WHERE  D.kimlik = K.kimlik AND D.no = '%s' AND D.kimlik = '%s'",
	 mysql_real_escape_string($duyuruno, $baglanti),
	 mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$duyuru_sonuc = mysql_query($duyuru_sql, $baglanti);
$duyuru_toplam = mysql_num_rows($duyuru_sonuc);
$duyuru_satir = mysql_fetch_assoc($duyuru_sonuc);
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
		document.form1.baslangic.value == "" |
		document.form1.bitis.value == "" |
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
<script language="JavaScript" src="../jstakvim.js" type="text/javascript"></script>
<link href="../jstakvim.css" rel="stylesheet">
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
            <td width="5%" height="30" class="anabaslik"><img src="../resimler/simge/duyurular.gif" width="24" height="24"></td>
            <td width="65%" class="anabaslik"><a href="../yonetim/index.php">Yönetim</a> &gt; Duyuru Güncelle</td>
            <td width="25%" nowrap class="icyazi"><table border="0" align="right" cellpadding="2" cellspacing="2">
              <tr class="icyazi">
                <td><a href="liste.php"><img src="../resimler/mesaj/arsiv.gif" alt="OLUŞTURULMUŞ DUYURULAR" width="16" height="15" border="0"></a></td>
                <td nowrap><a href="liste.php">Oluşturulmuş Duyurular </a></td>
                </tr>
            </table></td>
            <td width="5%" nowrap><div align="right"><a href="javascript:history.back()"><img src="../resimler/simge/geri.gif" alt="GERİ DÖN" width="24" height="24" border="0"></a></div></td>
          </tr>
          <tr>
            <td class="anabaslik">&nbsp;</td>
            <td colspan="2" valign="top"><form name="form1" method="post" action="guncelle2.php">
              <table width="100%" border="0" cellspacing="2" cellpadding="3">
                <tr>
                  <td width="12%" class="arabaslik">Yayınlayan</td>
                  <td width="2%" class="arabaslik">:</td>
                  <td width="51%" class="icyazi"><?php echo $duyuru_satir['yadsoyad'] ?>
                    <input name="ROM_Guncelle" type="hidden" id="ROM_Guncelle" value="OK">
                    <input name="no" type="hidden" id="no" value="<?php echo $duyuru_satir['no']; ?>"></td>
                  <td width="20%" nowrap class="arabaslik">Alıcı Listesi </td>
                  <td width="15%" nowrap><div align="right" class="icyazi"><a href="#" onClick="adrestemizle()">Alıcıları Temizle </a></div></td>
                </tr>
                <tr>
                  <td valign="top" class="arabaslik">Alıcı(lar)</td>
                  <td valign="top" class="arabaslik">:</td>
                  <td><textarea name="alici" cols="45" rows="2" class="metinkutusu" id="alici"><?php echo $duyuru_satir['alici']; ?></textarea></td>
                  <td colspan="2" rowspan="4" valign="top"><select name="adresdefteri" size="12" class="adresdefteri" id="adresdefteri" onClick="adresekle()">
                    <option value="Kampüs Dışı">Kampüs Dışı</option>
					<option value="Kampüs İçi">Kampüs İçi</option>
					<option value="">-------------------</option>
					<?php for($i=0; $i<$yetki_toplam; $i++){
					$yetki_satir = mysql_fetch_assoc($yetki_sonuc); ?>
                    <option value="<?php echo $yetki_satir['no'] ?>"><?php echo $yetki_satir['yetki'] ?></option>
                  <?php } ;?>
					<option value="">-------------------</option>
					<?php for($i=0; $i<$kisi_toplam; $i++){
					$kisi_satir = mysql_fetch_assoc($kisi_sonuc); ?>
                    <option value="<?php echo $kisi_satir['kimlik'] ?>"><?php echo $kisi_satir['adsoyad'] ?></option>
                  <?php } ;?>
                  </select>                  </td>
                </tr>
                <tr>
                  <td class="arabaslik">Konu</td>
                  <td class="arabaslik">:</td>
                  <td><input name="konu" type="text" class="metinkutusu" id="konu" value="<?php echo $duyuru_satir['konu']; ?>" size="45" maxlength="100"></td>
                  </tr>
                <tr>
                  <td nowrap class="arabaslik">Yayın Tarihi </td>
                  <td class="arabaslik">:</td>
                  <td class="icyazi"><table border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="icyazi">Başlangıç</td>
                      <td class="icyazi">:&nbsp;</td>
                      <td><input name="baslangic" type="text" class="metinkutusu" id="baslangic" onClick="GetDate(this);" value="<?php echo $duyuru_satir['baslangic']; ?>" size="10" readonly="readonly" /></td>
                      <td>&nbsp;-&nbsp;</td>
                      <td class="icyazi">Bitiş</td>
                      <td class="icyazi">:&nbsp;</td>
                      <td><input name="bitis" type="text" class="metinkutusu" id="bitis" onClick="GetDate(this);" value="<?php echo $duyuru_satir['bitis']; ?>" size="10" readonly="readonly" />                      </td>
                    </tr>
                  </table></td>
                  </tr>
                <tr>
                  <td valign="top" class="arabaslik">İçerik</td>
                  <td valign="top" class="arabaslik">:</td>
                  <td><textarea name="icerik" cols="55" rows="7" class="metinkutusu" id="icerik"><?php echo $duyuru_satir['icerik']; ?></textarea></td>
                  </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td><input name="button" type="button" class="buton" id="button" onClick="formkontrol()" value="Duyuruyu Güncelle"></td>
                  <td colspan="2" rowspan="2" valign="top" class="icyazi"><div align="center">Duyuru yapmak  istediğiniz<br>
                    grup / kişi / kişileri seçiniz.</div></td>
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