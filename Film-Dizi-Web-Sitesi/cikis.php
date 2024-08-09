<?php
// Oturumu başlat
session_start();

// Tüm oturum değişkenlerini boşalt
$_SESSION = array();

// Oturumu sonlandır
session_destroy();

// Kullanıcıyı giriş sayfasına yönlendir
header("location: login.php");
exit;
?>
