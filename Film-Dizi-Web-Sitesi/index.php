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
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film ve Dizi Sayfası</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <style>
     .yorum {
    width: 100%; /* Yorum çerçevesi genişliği */
    margin: 0 auto; /* Ortala */
    margin-bottom: 20px;
    text-align: left; /* Yorum içeriğini sola hizala */
    border: 1px solid #ccc; /* Kenarlık ekleyerek yorumları ayırma */
    padding: 10px; /* İçeriğe daha fazla boşluk bırakmak için */
    overflow-y: auto; /* Uzun yorumları kaydırma çubuğuyla göster */
}

.yorumlar-container {
    width: 100%; /* Yorumlar konteynerinin genişliği */
    margin: 0 auto; /* Ortala */
    text-align: center; /* Yorumlar konteynerini ortala */
}
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
    <div class="background-image"></div>

    <!-- Film Kategorisi -->
    <section id="film-kategorisi">
        <h2>Filmler</h2>
        <div class="film-listesi">
            <!-- Film resimleri buraya eklenecek -->
            <?php
            $film_sql = "SELECT id, url, ad FROM `film-dizi-img` ORDER BY id DESC LIMIT 4";
            $film_result = $conn->query($film_sql);
            if ($film_result->num_rows > 0) {
                while($row = $film_result->fetch_assoc()) {
                    echo '<div class="film">';
                    echo '<img src="' . $row["url"] . '" alt="' . $row["ad"] . '">';
                    echo '</div>';
                }
            } else {
                echo "Veritabanında film resmi bulunamadı.";
            }
            ?>
            <!-- Daha fazla film resmi ve butonu eklenebilir -->
        </div>
    </section>

    <!-- Dizi Kategorisi -->
    <section id="dizi-kategorisi">
        <h2>Diziler</h2>
        <div class="dizi-listesi">
            <!-- Dizi resimleri buraya eklenecek -->
            <?php
            $dizi_sql = "SELECT id, url, ad FROM `dizi-img` ORDER BY id DESC LIMIT 4";
            $dizi_result = $conn->query($dizi_sql);
            if ($dizi_result->num_rows > 0) {
                while($row = $dizi_result->fetch_assoc()) {
                    echo '<div class="dizi">';
                    echo '<img src="' . $row["url"] . '" alt="' . $row["ad"] . '">';
                    echo '</div>';
                }
            } else {
                echo "Veritabanında dizi resmi bulunamadı.";
            }
            ?>
            <!-- Daha fazla dizi resmi ve butonu eklenebilir -->
        </div>
    </section>

    <section id="yorumlar">
        <h2>Yorumlar</h2>
        <div class="yorumlar-container">
            <div class="yorum-listesi">
                <?php
                // Yorumları veritabanından çekme
                $yorum_sql = "SELECT isim, soyisim, yorum FROM yorum";
                $yorum_result = $conn->query($yorum_sql);

                if ($yorum_result->num_rows > 0) {
                    // Her bir yorum için bir div oluşturma
                    while($row = $yorum_result->fetch_assoc()) {
                        echo '<div class="yorum">';
                        echo '<div class="yorum-bilgileri">';
                        echo '<span class="yorum-yapan">' . $row["isim"] . ' ' . $row["soyisim"] . '</span>';
                        echo '</div>';
                        echo '<div class="yorum-icerigi">';
                        echo '<p>' . $row["yorum"] . '</p>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "Henüz yorum yapılmamış.";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </section>




    <!-- Footer -->
    <footer>
        <p>Telif Hakkı © 2024 Film ve Dizi Sitesi</p>
    </footer>
</body>
</html>
