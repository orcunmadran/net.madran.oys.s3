<?php
if(!isset($_SESSION)){
	 session_start();
	}
$kullanici_kodu = $_SESSION['KK'];
$yetki_kodu = $_SESSION['YK'];
$sql_sk = sprintf(
	"SELECT K.*, CONCAT(K.ad, ' ', K.soyad) AS adsoyad, YS.yetki AS yetkiseviyesi
	 FROM kullanici K, yetki_seviyesi YS
	 WHERE K.yetki = YS.no AND K.kimlik = '%s' AND K.yetki = '%s'",
	 mysql_real_escape_string($kullanici_kodu, $baglanti),
	 mysql_real_escape_string($yetki_kodu, $baglanti)
	);
$sonuc_sk = mysql_query($sql_sk, $baglanti);
$sonuc_toplam_sk = mysql_num_rows($sonuc_sk);
$satir_sk = mysql_fetch_assoc($sonuc_sk);
if($sonuc_toplam_sk == 1){
	if($satir_sk['yetki'] == 10){
		header("Location: ../kayit/onay_yok.php");
	}
	else if($satir_sk['yetki'] == 8){
		header("Location: ../index/kayit_donduruldu.php");
	}
	else{
		if(in_array($yetki_kodu, $yetkilendirme)){
			$kimlik = $satir_sk['kimlik'];
			$sifre = $satir_sk['sifre'];
			$yetki = $satir_sk['yetki'];
			$ad = $satir_sk['ad'];
			$soyad = $satir_sk['soyad'];
			$eposta = $satir_sk['eposta'];
			$web = $satir_sk['web'];
			$adsoyad = $satir_sk['adsoyad'];
			$yetkiseviyesi = $satir_sk['yetkiseviyesi'];
		}
		else {header("Location: ../index/yetki_yok.php");}
	}
}
else{header("Location: ../index/yetkisiz_giris.php");}

//Avatar Kontrol
$avatar = "../resimler/avatar/".$kimlik.".jpg";
if (file_exists($avatar)) {
    $avatar = "../resimler/avatar/".$kimlik.".jpg";
} else {
    $avatar = "../resimler/avatar/avatar.jpg";
} 
?>