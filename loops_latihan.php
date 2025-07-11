<?php
// Perulangan for
for ($i = 0; $i < 5; $i++) {
    echo "Perulangan ke-" . ($i + 1) . "<br>";
}

// Perulangan while
$angka = 5;
while ($angka > 0) {
    echo "Hitung mundur: $angka <br>";
    $angka--;
}

// Perulangan foreach
$nama_mahasiswa = ["Ayu", "Mira", "Nurita", "Zulfa", "Herna"];
echo "<br>Daftar Nama Mahasiswa:<br>";
foreach ($nama_mahasiswa as $nama) {
    echo "- $nama <br>";
}
?>
