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
    if (isset($_POST['dizi_ekle'])) {
        $dizi_ad = $_POST['dizi_ad'];
        $dizi_resim_url = $_POST['dizi_resim_url'];
        $dizi_aciklama = $conn->real_escape_string($_POST['dizi_aciklama']);


        $sql = "INSERT INTO `dizi-img` (url, ad, aciklama) VALUES ('$dizi_resim_url', '$dizi_ad', '$dizi_aciklama')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Dizi başarıyla eklendi!</p>";
        } else {
            echo "Dizi eklenirken hata oluştu: " . $conn->error;
        }
    }
}

$conn->close();
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
    <h2>Dizi Ekle</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="dizi_ad">Dizi Adı:</label>
        <input type="text" id="dizi_ad" name="dizi_ad"><br><br>
        <label for="dizi_resim_url">Dizi Resim URL:</label>
        <input type="text" id="dizi_resim_url" name="dizi_resim_url"><br><br>
        <label for="dizi_aciklama">Dizi Açıklama:</label><br>
        <textarea id="dizi_aciklama" name="dizi_aciklama" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Dizi Ekle" name="dizi_ekle">
    </form>
</body>
</html>
