<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        h2 {
            margin-top: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        table td a {
            color: #007bff;
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

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
    <div class="container">
        <h2>Filmler</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>URL</th>
                <th>İşlemler</th>
            </tr>
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

            // Veritabanından filmleri al
            $sql = "SELECT id, ad, url FROM `film-dizi-img`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["ad"] . "</td>";
                    echo "<td>" . $row["url"] . "</td>";
                    echo "<td><a href='duzenle.php?id=" . $row["id"] . "'>Düzenle</a> | <a href='sil.php?id=" . $row["id"] . "' onclick='return confirm(\"Bu veriyi silmek istediğinizden emin misiniz?\")'>Sil</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Veritabanında film bulunamadı.</td></tr>";
            }

            $conn->close();
            ?>
        </table>

        <h2>Diziler</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>URL</th>
                <th>İşlemler</th>
            </tr>
            <?php
            // Veritabanı bağlantısı
            $conn = new mysqli($servername, $username, $password, $database);

            // Bağlantıyı kontrol etme
            if ($conn->connect_error) {
                die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
            }

            // Veritabanından dizileri al
            $sql = "SELECT id, ad, url FROM `dizi-img`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["ad"] . "</td>";
                    echo "<td>" . $row["url"] . "</td>";
                    echo "<td><a href='duzenle.php?id=" . $row["id"] . "'>Düzenle</a> | <a href='sil.php?id=" . $row["id"] . "' onclick='return confirm(\"Bu veriyi silmek istediğinizden emin misiniz?\")'>Sil</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Veritabanında dizi bulunamadı.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
        <h2>Yorumlar</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Yorumlar</th>
            </tr>
            <?php
            // Veritabanı bağlantısı
            $conn = new mysqli($servername, $username, $password, $database);

            // Bağlantıyı kontrol etme
            if ($conn->connect_error) {
                die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
            }

            // Veritabanından dizileri al
            $sql = "SELECT id, isim, soyisim, yorum FROM `yorum`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["isim"] . "</td>";
                    echo "<td>" . $row["soyisim"] . "</td>";
                    echo "<td><a href='duzenle.php?id=" . $row["id"] . "'>Düzenle</a> | <a href='sil.php?id=" . $row["id"] . "' onclick='return confirm(\"Bu veriyi silmek istediğinizden emin misiniz?\")'>Sil</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Veritabanında yorum bulunamadı.</td></tr>";
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
