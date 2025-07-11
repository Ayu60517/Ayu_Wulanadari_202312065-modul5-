<?php
function hitung_diskon($harga, $persen_diskon) {
    $potongan = $harga * ($persen_diskon / 100);
    return $harga - $potongan;
}

$harga_baju = 150000;
$harga_setelah_diskon = hitung_diskon($harga_baju, 10); // Diskon 10%
echo "Harga akhir: Rp " . $harga_setelah_diskon . "<br><br>";


function sapa($nama, $waktu) {
    
    switch (strtolower($waktu)) {
        case "pagi":
            $salam = "Selamat Pagi";
            break;
        case "siang":
            $salam = "Selamat Siang";
            break;
        case "sore":
            $salam = "Selamat Sore";
            break;
        case "malam":
            $salam = "Selamat Malam";
            break;
        default:
            $salam = "Halo";
    }
    
    
    echo $salam . ", " . $nama . "!";
}


sapa("Ayu", "Pagi");
?>
