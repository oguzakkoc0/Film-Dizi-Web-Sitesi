<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root";
$password = "";
$database = "zehra";

// MySQL bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Silinecek öğenin ID'sini al
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    // Silme sorgusunu hazırla
    $sql = "DELETE FROM `film-dizi-img` WHERE id = $id";

    // Sorguyu çalıştır ve sonucu kontrol et
    if ($conn->query($sql) === TRUE) {
        echo "Veri başarıyla silindi";
        header("Location: adminn.php");
    } else {
        echo "Veri silinirken hata oluştu: " . $conn->error;
    }
}

// Bağlantıyı kapat
$conn->close();
?>
