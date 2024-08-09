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

// Film veya dizi ID'sini al
$film_id = $_GET['film_id']; // Bu, URL'den alınacak

// Film veya dizi detaylarını veritabanından al
$sql = "SELECT * FROM `film-dizi-img` WHERE id = $film_id";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film Detay Sayfası</title>
    <link rel="stylesheet" href="film.css" type="text/css">
</head>
<body>
    <!-- Menü -->
    <nav>
        <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li><a href="film.php">Filmler</a></li>
            <li><a href="dizi.php">Diziler</a></li>
        </ul>
    </nav>

    <!-- Film Detayları -->
    <section id="film-detaylari">
        <div class="film-detay">
        <?php
        if ($result->num_rows > 0) {
            // Veritabanından gelen verileri kullanarak detayları göster
            while($row = $result->fetch_assoc()) {
                // Detayları göster
                echo "<h2>" . $row["ad"] . "</h2>";
                echo "<img src='" . $row["url"] . "' alt='" . $row["ad"] . "'><br>";
                echo "<p>" . $row["aciklama"] . "</p>"; // Açıklama kısmını ekledik
                // Diğer detayları göstermek için gerekli HTML veya PHP kodları buraya eklenebilir
            }
        } else {
            echo "Film veya dizi bulunamadı.";
        }

        // Bağlantıyı kapat
        $conn->close();
        ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>Telif Hakkı © 2024 Film ve Dizi Sitesi</p>
    </footer>
</body>
</html>
