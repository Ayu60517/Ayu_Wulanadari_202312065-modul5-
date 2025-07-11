<?php
session_start();

// Inisialisasi
$nama = $email = $pesan = "";
$error = "";
$sukses = false;
$hapus_pesan = "";

// Buat session daftar tamu jika belum ada
if (!isset($_SESSION["daftar_tamu"])) {
    $_SESSION["daftar_tamu"] = [];
}

// Hapus tamu tertentu berdasarkan index
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['hapus_id'])) {
    $id = (int) $_POST['hapus_id'];
    if (isset($_SESSION["daftar_tamu"][$id])) {
        unset($_SESSION["daftar_tamu"][$id]);
        $_SESSION["daftar_tamu"] = array_values($_SESSION["daftar_tamu"]); // Reset index
        $hapus_pesan = "Tamu berhasil dihapus.";
    }
}

// Proses form kirim pesan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim'])) {
    $nama = trim($_POST["nama"]);
    $email = trim($_POST["email"]);
    $pesan = trim($_POST["pesan"]);

    if (empty($nama) || empty($email) || empty($pesan)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        $nama_bersih = htmlspecialchars($nama);
        $email_bersih = htmlspecialchars($email);
        $pesan_bersih = htmlspecialchars($pesan);

        $_SESSION["daftar_tamu"][] = [
            'nama' => $nama_bersih,
            'email' => $email_bersih,
            'pesan' => $pesan_bersih,
            'waktu' => date("d-m-Y H:i:s")
        ];

        $sukses = true;
        $nama = $email = $pesan = "";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buku Tamu Digital STITEK Bontang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }

        main {
            max-width: 700px;
            background: white;
            margin: 30px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .success {
            background-color: #e8f5e9;
            border-left: 5px solid #2e7d32;
            padding: 15px;
            margin-top: 20px;
        }

        .delete-msg {
            background-color: #ffebee;
            border-left: 5px solid #c62828;
            padding: 15px;
            margin-top: 20px;
        }

        button {
            margin-top: 15px;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .btn-hapus {
            background-color: #e74c3c;
            margin-top: 10px;
        }

        .btn-hapus:hover {
            background-color: #c0392b;
        }

        .tamu-list {
            margin-top: 40px;
        }

        .tamu-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .tamu-item:last-child {
            border-bottom: none;
        }

        .tamu-item h4 {
            margin: 0;
        }

        .tamu-item small {
            color: gray;
        }
    </style>
</head>
<body>

<header>
    <h1>Buku Tamu Digital STITEK Bontang</h1>
</header>

<main>
    <form method="post" action="">
        <label for="nama">Nama Lengkap:</label>
        <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($nama) ?>">

        <label for="email">Alamat Email:</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>">

        <label for="pesan">Pesan / Komentar:</label>
        <textarea name="pesan" id="pesan"><?= htmlspecialchars($pesan) ?></textarea>

        <button type="submit" name="kirim">Kirim Pesan</button>
    </form>

    <?php if (!empty($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($sukses): ?>
        <div class="success">
            <strong>Pesan berhasil dikirim!</strong>
        </div>
    <?php endif; ?>

    <?php if (!empty($hapus_pesan)): ?>
        <div class="delete-msg">
            <strong><?= $hapus_pesan ?></strong>
        </div>
    <?php endif; ?>

    <div class="tamu-list">
        <h2>Daftar Tamu:</h2>
        <?php if (empty($_SESSION["daftar_tamu"])): ?>
            <p>Belum ada tamu yang mengisi buku tamu.</p>
        <?php else: ?>
            <?php foreach (array_reverse($_SESSION["daftar_tamu"], true) as $index => $tamu): ?>
                <div class="tamu-item">
                    <h4><?= $tamu['nama'] ?> <small>(<?= $tamu['email'] ?>)</small></h4>
                    <p><?= nl2br($tamu['pesan']) ?></p>
                    <small>Dikirim pada: <?= $tamu['waktu'] ?></small>
                    <form method="post" style="margin-top:10px;">
                        <input type="hidden" name="hapus_id" value="<?= $index ?>">
                        <button class="btn-hapus" onclick="return confirm('Hapus data tamu ini?')">Hapus</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
