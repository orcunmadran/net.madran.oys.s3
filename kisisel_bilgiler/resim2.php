<?php
//Yetkilendirme
$yetkilendirme = array("1", "2", "3", "4", "5", "6", "7", "8", "9"); 
//Yüklenen Modüller
require("../moduller/sistem_baglanti.php");
require("../moduller/sistem_guvenlik.php");

//Resim Yükle / Güncelle
if(isset($_POST['ROM_Guncelle'])){
	$dosyauzantisi = $_FILES['dosya']['type'];
	$izinverilen = array("image/pjpeg", "image/jpeg", "image/jpg", "image/gif");
	$maksimumboyut = 100000;
	$dosyaboyutu = $_FILES['dosya']['size'];
	//Kontrol Islemi
	if(in_array($dosyauzantisi, $izinverilen)){
		if($dosyaboyutu <= $maksimumboyut){
			// Yükleme Islemi
			if(is_uploaded_file($_FILES['dosya']['tmp_name'])){
			move_uploaded_file($_FILES['dosya']['tmp_name'], "../resimler/avatar/".$kimlik.".jpg");
			header("Location: index.php?islem=3");
			}
			else{
			header("Location: resim.php?hatamesaj=1");
			}
		}
		else{
		header("Location: resim.php?hatamesaj=2");
		}
	}
	else{
	header("Location: resim.php?hatamesaj=3");
	}	
}
?>