<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yorum Ekle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top:10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Yorum Ekle</h2>
        <?php
        // Giriş kontrolü yapılması gerekiyor
        session_start();
        if(isset($_SESSION['username'])) {
            echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
            echo '<label for="name">İsim:</label>';
            echo '<input type="text" id="name" name="name" required>';
            echo '<label for="surname">Soyisim:</label>';
            echo '<input type="text" id="surname" name="surname" required>';
            echo '<label for="comment">Yorumunuz:</label>';
            echo '<textarea id="comment" name="comment" required></textarea>';
            echo '<input type="submit" value="Yorum Yap">';
            echo '</form>';
            echo '<form action="cikis.php" method="post">';
            echo '<input type="submit" value="Çıkış Yap">';
            echo '</form>';
        } else {
            echo '<p>Lütfen giriş yapın <a href="login.php">Giriş</a></p>';
        }

        // Veritabanı bağlantısı ve yorum ekleme işlemi
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

            // Form verilerini al
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $comment = $_POST['comment'];

            // Veritabanına yorumu ekle
            $sql = "INSERT INTO yorum (isim, soyisim, yorum) VALUES ('$name', '$surname', '$comment')";
            if ($conn->query($sql) === TRUE) {
                echo "<p style='text-align:center;'>Yorum başarıyla eklendi!</p>";
            } else {
                echo "<p style='text-align:center;'>Hata: " . $sql . "<br>" . $conn->error . "</p>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
