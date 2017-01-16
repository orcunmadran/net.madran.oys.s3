<?php

/*
	Sistem ile ilgili
	varsayılan tüm değişkenler
	bu modülde tanımlanmaktadır.
*/

//Genel Sistem Bilgileri
$sistem_durum= 1;
$sistem_adi= "Sanal Kampüs";
$sistem_ust_bilgi= "::: SANAL KAMPÜS :::";
$sistem_alt_bilgi= "2008 - Orçun Madran";
$sistem_logo='<img src="../resimler/genel/logo.gif" width="300" height="75">';
$sistem_logo_dis='<img src="resimler/genel/logo.gif" width="300" height="75">';
$sistem_gorsel_01 ='<img src="../resimler/genel/sanalkampus01.jpg" width="292" height="155">';
$sistem_gorsel_02 ='<img src="../resimler/genel/sanalkampus02.jpg" width="350" height="75">';
$sistem_adres = "http://www.sanalkampus.web.tr";
$sistem_eposta = "yonetim@sanalkampus.web.tr";
$sistem_yonetici_kimlik = "admin";

//İletişim Araçları
$mesaj_listeleme_sayisi = 10;

/*
	Sistem ile ilgili menüler.
*/

//İç Tanımlama
$sistem_ic_tanimlama =
'
<table border="0" align="right" cellpadding="3" cellspacing="2">
<tr>
<td class="icyazi"><a href="../kisisel_bilgiler"><img src="../resimler/simge/kullanici.gif" title="KİŞİSEL BİLGİLER" width="16" height="16" border="0"></a></span></td>
<td class="icyazi"><a href="../kisisel_bilgiler">'.$ad." ".$soyad.'</a></td>
<td class="icyazi">&nbsp;</td>
<td class="icyazi"><a href="../yardim"><img src="../resimler/simge/yardim.gif" title="YARDIM" width="16" height="16" border="0"></a></td>
<td class="icyazi"><a href="../yardim">Yardım</a></td>
<td class="icyazi">&nbsp;</td>
<td class="icyazi"><a href="../sistem/cikis.php"><img src="../resimler/simge/oturumu_kapat.gif" title="OTURUMU KAPAT" width="16" height="16" border="0"></a></td>
<td class="icyazi"><a href="../sistem/cikis.php">Oturumu Kapat</a></td>
</tr>
</table>
'
;

//İç Menü Kontrol
if($yetki <= 5){
$menu_kontrol_a = '<td class="icyazi"><div align="center"><a href="../yonetim"><img src="../resimler/simge/yonetim.gif" title="YÖNETİM" width="16" height="16" border="0"></a></div></td>';
$menu_kontrol_b = '<td class="icyazi"><a href="../yonetim">Yönetim</a></td>';
}

//İç Menü
$sistem_ic_menu =
'<table border="0" align="right" cellpadding="3" cellspacing="2">
<tr>
<td class="icyazi"><div align="center"><a href="../sistem"><img src="../resimler/simge/ana_sayfa.gif" title="ANA SAYFA" width="16" height="16" border="0"></a></div></td>
<td class="icyazi"><div align="center"><a href="../dersler"><img src="../resimler/simge/dersler.gif" title="DERSLER" width="16" height="16" border="0"></a></div></td>
<td class="icyazi"><div align="center"><a href="../mesajlar"><img src="../resimler/simge/mesajlar.gif" title="MESAJLAR" width="16" height="16" border="0"></a></div></td>
<td class="icyazi"><div align="center"><a href="../forumlar"><img src="../resimler/simge/forumlar.gif" title="FORUMLAR" width="16" height="16" border="0"></a></div></td>
<td class="icyazi"><div align="center"><a href="../sohbet"><img src="../resimler/simge/sohbet.gif" title="SOHBET" width="16" height="16" border="0"></a></div></td>
<td class="icyazi"><div align="center"><a href="../arama"><img src="../resimler/simge/arama.gif" title="ARAMA" width="16" height="16" border="0"></a></div></td>
'.$menu_kontrol_a.'
</tr>
<tr>
<td class="icyazi"><div align="center"><a href="../sistem">Anasayfa</a></div></td>
<td class="icyazi"><a href="../dersler">Dersler</a></td>
<td class="icyazi"><a href="../mesajlar">Mesajlar</a></td>
<td class="icyazi"><a href="../forumlar">Forumlar</a></td>
<td class="icyazi"><a href="../sohbet">Sohbet</a></td>
<td class="icyazi"><a href="../arama">Arama</a></td>
'.$menu_kontrol_b.'
</tr>
</table>'
;

//Dış Menü
$sistem_ust_menu_dis =
'<a href="../index/index.php">anasayfa</a>
 | 
<a href="../kayit/yeni_kayit.php">kayıt ol</a>
 | 
<a href="../index/iletisim.php">iletişim</a>
 | 
<a href="../index/yardim.php">yardım</a>'
;
?>