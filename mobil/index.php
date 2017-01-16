<?php 
//Yüklenen Modüller
require("../moduller/sistem_varsayilan.php");
require("../moduller/sistem_baglanti.php");
//Duyuru Sistemi
$duyuru_tnm = "Kampüs Dışı";
$duyuru_sql = sprintf(
	"SELECT D.*, DATE_FORMAT(D.baslangic, '%%d.%%m.%%Y') AS tbaslangic, DATE_FORMAT(D.bitis, '%%d.%%m.%%Y') AS tbitis
	 FROM duyuru D
	 WHERE D.alici LIKE('%%[%s]%%') AND baslangic <= DATE_FORMAT(now(), '%%Y-%%m-%%d') AND bitis >= DATE_FORMAT(now(), '%%Y-%%m-%%d')
	 ORDER BY D.baslangic DESC",
	 mysql_real_escape_string($duyuru_tnm)
	);
$duyuru_sonuc = mysql_query($duyuru_sql, $baglanti);
$duyuru_toplam = mysql_num_rows($duyuru_sonuc);
?>
<html>
<head>
<title><?php echo $sistem_ust_bilgi; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Language" CONTENT="tr">
<META NAME="Copyright" CONTENT="Orçun Madran">
<META NAME="Author" CONTENT="Orçun Madran">
<META NAME="keywords" CONTENT="Orçun Madran, Orcun Madran, Orçun, Orcun, Madran, Uzaktan Eğitim, Uzaktan Öğretim, Web Tabanlı Eğitim, Web Tabanlı Öğretim,  e-Öğrenme, Distance Education, Web Based Education, e-Learning, LMS, LCMS">
<META NAME="description" CONTENT="<?php echo $sistem_adi ?>">
<META NAME="ROBOTS" CONTENT="ALL">
<link href="../stiller.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
//Metin Kutusu Temizleme
function kimliktemizle(){
document.form1.kimlik.value = "";
};
function sifretemizle(){
document.form1.sifre.value = "";
};
//Form Kontrol
function formkontrol(){
	if(document.form1.kimlik.value == "" |
		document.form1.kimlik.value == "Kullanıcı Adı"){
		alert("Lütfen kullanıcı adınızı giriniz.");
		} else {
				document.form1.submit();
			}
}
</script>
<script src="../Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<?php include("../sablonlar/sayfa_ust.php"); ?>
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="310" height="16" valign="top"><form name="form1" method="post" action="../sistem/giris.php">
          <input name="kimlik" type="text" onFocus="kimliktemizle()" class="metinkutusu" id="kimlik" value="Kullanıcı Adı" size="15" maxlength="20"> 
          <input name="sifre" type="password" onFocus="sifretemizle()"class="metinkutusu" id="sifre" value="XXXXXXXX" size="15" maxlength="20">
          <input name="Button" type="button" class="buton" onClick="formkontrol()" value="Giriş Yap">
        </form>        </td>
        </tr>
      <tr>
        <td valign="top"><table width="306" height="364" border="0" cellpadding="1" cellspacing="1">
          <tr>
            <td width="302"><div align="center"><img src="../resimler/genel/logo.gif" width="300" height="75"></div></td>
          </tr>
          <tr>
            <td><div align="left">
              <hr width="292">
            </div></td>
          </tr>
          <tr>
            <td><table width="90%" height="249" border="0" align="right" cellpadding="1" cellspacing="1">
              <tr>
                <td width="300" height="77"><div align="center"><img src="../resimler/genel/sanalkampus02.jpg" width="300" height="75" alt="" style="background-color: #C8C8C8"></div></td>
              </tr>

              <tr>
                <td valign="top"><table width="100%" border="0" align="right" cellpadding="3" cellspacing="2">
                    <tr>
                      <td width="7%"><img src="../resimler/mesaj/duyuru.gif" width="16" height="15"></td>
                      <td width="76%"><span class="anabaslik">Haberler - Duyurular</span></td>
                      <td width="10%" nowrap><span class="icyazi"><a href="arsiv.php">Arşiv</a></span></td>
                      <td width="7%" class="icyazi"><a href="arsiv.php"><img src="../resimler/mesaj/arsiv.gif" alt="DUYURU ARŞİVİ" width="16" height="15" border="0" title="DUYURU ARŞİVİ"></a></td>
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
                      <td valign="top"><div align="center" class="anabaslik">-</div></td>
                      <td colspan="3" valign="top" class="icyazi"><a href="duyuru.php?duyuruno=<?php echo $duyuru_satir['no']; ?>"><?php echo stripslashes($duyuru_satir['konu']) ?></a></td>
                    </tr>
                    <?php }}?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>          </td>
        </tr>
    </table>
<?php include("../sablonlar/sayfa_alt.php"); ?>