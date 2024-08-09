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

// Formdan gelen verileri kontrol etme
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $film_ad = $_POST['ad'];
    $film_url = $_POST['url'];
    $film_aciklama = $_POST['film_aciklama']; // Yeni eklendi

    // Dosya seçildiyse
    if (isset($_FILES['film_resim']) && $_FILES['film_resim']['size'] > 0) {
        $film_resim_temp = $_FILES['film_resim']['tmp_name'];
        $film_resim = $_FILES['film_resim']['name'];
        
        move_uploaded_file($film_resim_temp, "film-dizi-img/" . $film_resim);

        // Resmi güncelleme sorgusu
        $sql = "UPDATE `film-dizi-img` SET ad='$film_ad', url='$film_url', resim='$film_resim', aciklama='$film_aciklama' WHERE id='$id'";
    } else {
        // Dosya seçilmediyse, sadece adı, URL'si ve açıklamayı güncelle
        $sql = "UPDATE `film-dizi-img` SET ad='$film_ad', url='$film_url', aciklama='$film_aciklama' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<p>Film başarıyla güncellendi!</p>";
        header("Location: adminn.php");
    } else {
        echo "Film güncellenirken hata oluştu: " . $conn->error;
    }

}

$conn->close();
?>
