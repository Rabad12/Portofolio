<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user MySQL kamu
$pass = ""; // Kosongkan jika pakai XAMPP
$dbname = "mydatabase"; // Nama database yang dibuat tadi

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses penyimpanan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);

    $stmt = $conn->prepare("INSERT INTO subscribers (nama, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $email);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Berhasil berlangganan!</p>";
    } else {
        echo "<p style='color:red;'>Gagal menyimpan data!</p>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Subscribe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffeceb;
            text-align: center;
            margin: 50px;
        }
        form {
            background: white;
            padding: 20px;
            display: inline-block;
            border-radius: 10px;
        }
        input {
            width: 250px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            display: block;
        }
        button {
            background-color: #f47c26;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e3691f;
        }
    </style>
</head>
<body>

    <h2>Subscribe</h2>
    <form action="" method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Subscribe</button>
    </form>

</body>
</html>