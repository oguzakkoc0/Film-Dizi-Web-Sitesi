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

// Formdan gelen verileri işleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['film_ekle'])) {
        // Formdan gelen verileri güvenli hale getirme
        $film_ad = $conn->real_escape_string($_POST['film_ad']);
        $film_resim_url = $conn->real_escape_string($_POST['film_resim_url']);
        $film_aciklama = $conn->real_escape_string($_POST['film_aciklama']);

        // SQL sorgusunu hazırlama
        $sql = "INSERT INTO `film-dizi-img` (url, ad, aciklama) VALUES ('$film_resim_url', '$film_ad', '$film_aciklama')";

        // Sorguyu çalıştırma
        if ($conn->query($sql) === TRUE) {
            echo "<p>Film başarıyla eklendi!</p>";
        } else {
            echo "Film eklenirken hata oluştu: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <link rel="stylesheet" href="admin.css" type="text/css">
    <style>
        nav {
            background-color: #333;
            padding: 10px 0;
            text-align: center;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #ffffff;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="adminn.php">Admin Anasayfa</a></li>
        <li><a href="film-ekle.php">Film Ekle</a></li>
        <li><a href="dizi-ekle.php">Dizi Ekle</a></li>
    </ul>
</nav>
<h2>Film Ekle</h2>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
    <label for="film_ad">Film Adı:</label><br>
    <input type="text" id="film_ad" name="film_ad"><br><br>
    <label for="film_resim_url">Film Resim URL:</label><br>
    <input type="text" id="film_resim_url" name="film_resim_url"><br><br>
    <label for="film_aciklama">Film Açıklama:</label><br>
    <textarea id="film_aciklama" name="film_aciklama" rows="4" cols="50"></textarea><br><br>
    <input type="submit" value="Film Ekle" name="film_ekle">
</form>

</body>
</html>
