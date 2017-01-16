<?php
require("moduller/sistem_varsayilan.php");
if($sistem_durum == 1){
$mesaj = 'Giriş yapmak için <a href="index">tıklayınız</a>.';
header("Location: index");
}
else{
$mesaj =
"Sistem bakım çalışmaları nedeniyle geçici olarak servis dışıdır.<br><br>
Lütfen daha sonra tekrar deneyiniz.<br><br>
<a href=mailto:".$sistem_eposta.">".$sistem_eposta."</a>";
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<META NAME="Language" CONTENT="tr">
<META NAME="Copyright" CONTENT="Orçun Madran">
<META NAME="Author" CONTENT="Orçun Madran">
<META NAME="keywords" CONTENT="Orçun Madran, Orcun Madran, Orçun, Orcun, Madran, Uzaktan Eğitim, Uzaktan Öğretim, Web Tabanlı Eğitim, Web Tabanlı Öğretim,  e-Öğrenme, Distance Education, Web Based Education, e-Learning, LMS, LCMS">
<META NAME="description" CONTENT="<?php echo $sistem_adi ?>">
<META NAME="ROBOTS" CONTENT="ALL">
<title><?php echo $sistem_ust_bilgi ?></title>
<link href="stiller.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p align="center"><?php echo $sistem_logo_dis ?></p>
<hr width="315" size="1" class="cizgi" />
<p align="center" class="anabaslik"><?php echo $sistem_adi ?></p>
<p align="center" class="icyazi"><?php echo $mesaj ?></p>
<p align="center" class="arabaslik">&copy; <?php echo $sistem_alt_bilgi ?></p>
</body>
</html>
