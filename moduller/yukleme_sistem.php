<?php

// Dosya Yükleme Sistemi V.1
// Rafet Orçun Madran

// İzin Verilen Dosya Türleri
$kontrol_tip = array(
	"text/plain", // txt
	"image/x-png", // png A
	"image/png", // png B
	"image/bmp", // bmp
	"image/pjpeg", // jpg
	"image/gif", // gif
	"application/msword", // doc
	"application/vnd.ms-excel", // xls
	"application/vnd.ms-powerpoint", // ppt, pps
	"application/pdf", // pdf
 	"application/x-shockwave-flash", //swf
	"application/x-zip-compressed", // zip
);
$dosya_tip_liste = "txt, png, bmp, jpg, gif, doc, xls, ppt, pps, pdf, swf, zip";

// İzin Verilen Dosya Boyutu (Bayt)
$kontrol_boyut = 2000000;

// Dosyanın Kaydedileceği Klasör
$dosya_klasör = "dosyalar/";

// Dosya Değişkenleri
$dosya_boyutu = $_FILES['dosya']['size'];
$dosya_tip = $_FILES['dosya']['type'];
$dosya_orj_ad= $_FILES['dosya']['name'];

// Türkçe Karakter Kontrol
$dosya_orj_ad = ereg_replace('ç', 'c', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('ğ', 'g', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('ı', 'i', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('ö', 'o', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('ş', 's', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('ü', 'u', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('Ç', 'C', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('Ğ', 'G', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('İ', 'I', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('Ö', 'O', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('Ş', 'S', $dosya_orj_ad);
$dosya_orj_ad = ereg_replace('Ü', 'U', $dosya_orj_ad);

// Boşluk Kontrol
$dosya_orj_ad = ereg_replace(' ', '_', $dosya_orj_ad);

// Noktalama İşaretleri Kontrolü
$dosya_orj_ad = strtr($dosya_orj_ad, "é!'^+%&/()=?£#$½{[]}\*@€~`;:|<>", "-------------------------------");

// Dosya Adının Küçük Harflere Çevirilmesi
$dosya_sistem_adi = strtolower($dosya_orj_ad);

// Dosya Uzantı Kontrol
if(in_array($dosya_tip, $kontrol_tip)){

	// Dosya Boyut Kontrol
	if($dosya_boyutu <= $kontrol_boyut){

		// Dosya Yükleme Kontrol
		if(is_uploaded_file($_FILES['dosya']['tmp_name'])){

			// Yüklenen Dosyanın İlgili Klasöre Taşınması
			move_uploaded_file($_FILES['dosya']['tmp_name'], $dosya_klasör.$dosya_sistem_adi);
			
			// Yüklendi / Güncellendi Mesajı
			$mesaj = "Dosya başarıyla yüklendi / güncellendi";
			
		}else{
		// Yükleme / Güncelleme Başarısız Mesajı
		$mesaj = "Dosya yükleme / güncelleme başarısız";
			}
	}else{
	// Dosya Boyutu Hata Mesajı
	$mesaj ="Dosya boyutu maksimum 100 KB olmalı";
	}
}else{
// Dosya Uzantısı Hata Mesajı
$mesaj ="Dosya uzantısı geçerli değil. Geçerli olan dosya uzantıları: ".$dosya_tip_liste.". Geçerli olan dosya uzantıları haricinde dosya yüklemek istediğinizde, dosya / dosyalarınızı sıkıştırılmış dosya formatında (zip) gönderebilirsiniz.";
}
?>