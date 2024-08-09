<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 400px;
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
        input[type="email"],
        input[type="password"] {
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
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kayıt Ol</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="username">Kullanıcı Adı:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Şifre:</label>
            <input type="password" id="password" name="password" required">

            <input type="submit" value="Kayıt Ol">
        </form>
    </div>

    <?php
    // Veritabanı bağlantısı
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "zehra";

    // Form verilerini işleme
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // MySQL bağlantısı oluşturma
        $conn = new mysqli($servername, $username, $password, $database);

        // Bağlantıyı kontrol etme
        if ($conn->connect_error) {
            die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
        }

        // Form verilerini al
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Şifreyi güvenli bir şekilde sakla
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Veritabanına kullanıcıyı ekle
        $sql = "INSERT INTO giris (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            echo "<p style='text-align:center;'>Kayıt başarılı!</p>";
            header("Location: login.php");
        } else {
            echo "<p style='text-align:center;'>Hata: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
