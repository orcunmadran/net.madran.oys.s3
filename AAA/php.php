<?php 
//Kayıt Seti
$deger_sql = sprintf(
	"SELECT K.*, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
	 FROM kullanici K, yetki_seviyesi YS
	 WHERE K.yetki = YS.no AND K.kimlik = '%s' AND K.yetki = '%s'",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($yetki_kodu, $baglanti)
	);
$deger_sonuc = mysql_query($deger_sql, $baglanti);
$deger_toplam = mysql_num_rows($deger_sonuc);
$deger_satir = mysql_fetch_assoc($deger_sonuc);

//Kayıt Ekleme
$veri_bir = $_POST['veri_bir'];
$veri_iki= $_POST['veri_iki'];
if(isset($_POST['ROM_ekle'])){
	$ekle_sql = sprintf(
	"INSERT INTO mesaj (veri_bir, veri_iki) VALUES ('%s', '%s')",
	 mysql_real_escape_string($veri_bir, $baglanti),
	 mysql_real_escape_string($veri_iki, $baglanti));
	$ekle_kayit = mysql_query($ekle_sql, $baglanti);
	header("Location: gonderilmis.php");
}

//Kayıt Sil
$sil_tnm = $_GET['kayitno'];
$sil_sql = sprintf
	(
	"SELECT * FROM tablo WHERE deger = '%s' AND deger = '%s'",
	mysql_real_escape_string($sil_tnm, $baglanti),
	mysql_real_escape_string($kullanici_kodu, $baglanti)
	);
$sil_sonuc = mysql_query($sil_sql, $baglanti);
$sil_toplam = mysql_num_rows($sil_sonuc);
$sil_satir = mysql_fetch_assoc($sil_sonuc);
if($sil_toplam == 1 && isset($_GET['sil_tnm']) && $_GET['sil_tnm'] != NULL){
	$sil_hata = 0;
	$sil2_sql = sprintf
		(
		"DELETE FROM tablo WHERE deger = '%s'",
		mysql_real_escape_string($sil_satir['deger'], $baglanti)
		);
	$kayit_sil = mysql_query($sil2_sql, $baglanti);
}
else{
	$sil_hata = 1;
	}
	
//Kayıt Güncelle
$veri_bir = $_POST['veri_bir'];
$veri_iki = $_POST['veri_iki'];
if(isset($_POST['ROM_Guncelle'])){
	$guncelle_sql = sprintf
		(
		"UPDATE kullanici SET degerbir = '%s', degeriki = '%s' WHERE anahtaralan = '%s'",
		mysql_real_escape_string($degerbir, $baglanti),
		mysql_real_escape_string($degeriki, $baglanti),
		mysql_real_escape_string($anahtaralan, $baglanti)
		);
	$guncelle = mysql_query($guncelle_sql, $baglanti);
	header("Location: index.php?islem=1");
}

//Veritabanındaki alanları karşılaştırma
$posta_alicisi = $row_tanitim['kimlik'];
$posta_okuyanlar = $row_m['okundu'];
if(stristr($posta_okuyanlar, $posta_alicisi) === FALSE){
echo "mesaj0.gif";
} else {
echo "mesaj1.gif";
}

//Metin içinde enter davranışı
echo str_replace("\n","<br>", $mesaj_satir['icerik']);

//Metin içindeki HTML taglarini iptal etme
echo str_replace("\n","<br>", htmlspecialchars($mesaj_satir['icerik'], ENT_QUOTES));
echo str_replace("\n","<br>", htmlspecialchars($mesaj_satir['icerik'], ENT_QUOTES)); // Tırnak ile kombine

//Metin içindeki tırnak kontrolleri
addslashes($deger); // Tırnak Ekleme
stripslashes($deger); // Tırnak Kaldırma
?>