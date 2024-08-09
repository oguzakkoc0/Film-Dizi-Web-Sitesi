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

// ID kontrolü
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Veritabanından ilgili film veya dizi bilgilerini al
    $sql = "SELECT id, ad, aciklama, url FROM `film-dizi-img` WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
?>
<form action="duzenle_islem.php" method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <label for="ad">Adı:</label><br>
    <input type="text" id="ad" name="ad" value="<?php echo $row['ad']; ?>"><br>
    <label for="url">URL:</label><br>
    <input type="text" id="url" name="url" value="<?php echo $row['url']; ?>"><br><br>
    <label for="film_aciklama">Film Açıklama:</label><br>
    <textarea id="film_aciklama" name="film_aciklama" rows="4" cols="50"><?php echo $row['aciklama']; ?></textarea><br><br>
    <input type="submit" value="Güncelle">
</form>
<?php
    } else {
        echo "Film veya dizi bulunamadı.";
    }
} else {
    echo "ID parametresi belirtilmemiş.";
}

$conn->close();
?>
