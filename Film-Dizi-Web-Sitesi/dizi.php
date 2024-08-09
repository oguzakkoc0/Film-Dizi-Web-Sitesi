<?php
// Veritabanı bağlantısı
$servername = "localhost";
$username = "root"; // Varsayılan kullanıcı adı "root"
$password = ""; // Varsayılan şifre boş (empty)
$database = "zehra";

// MySQL bağlantısı oluşturma
$conn = new mysqli($servername, $username, $password, $database);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Dizi resimlerini veritabanından al
$sql = "SELECT id, url, ad FROM `dizi-img`"; // dizi-img tablosundan resimleri al
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film ve Dizi Sayfası</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
        .menu-button {
            margin: 10px;
            padding: 10px 20px; /* Buton içeriğine padding ekle */
            background-color: #00c4cc; /* Arkaplan rengi */
            color: white; /* Yazı rengi */
            border: none; /* Kenarlık yok */
            border-radius: 5px; /* Köşeleri yuvarla */
            text-decoration: none; /* Alt çizgi yok */
            font-size: 16px;
            cursor: pointer; /* İmleci el işareti yap */
            
        }

        .menu-button:hover {
            background-color: #00c4cc; /* Üzerine gelince farklı bir renk */
            opacity: 0.8;
        }
    </style>
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
    <nav>
    <a href="login.php" class="menu-button">Giriş Yap</a>
    </nav>

    <!-- Dizi Kategorisi -->
    <section id="dizi-kategorisi">
        <h2>Diziler</h2>
        <div class="dizi-listesi">
            <!-- Dizi resimleri buraya eklenecek -->
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="dizi">';
                    echo '<img src="' . $row["url"] . '" alt="' . $row["ad"] . '"><br><br>';
                    echo '<a href="dizi-detay.php?film_id=' . $row['id'] . '" class="incele-button">İncele</a>';
                    echo '</div>';
                }
            } else {
                echo "Veritabanında dizi resmi bulunamadı.";
            }
            ?>
            <!-- Daha fazla dizi resmi ve butonu eklenebilir -->
        </div>
    </section>

    <!-- Diğer kısımlar buraya eklenecek -->

    <!-- Footer -->
    <footer>
        <p>Telif Hakkı © 2024 Film ve Dizi Sitesi</p>
    </footer>
</body>
</html>