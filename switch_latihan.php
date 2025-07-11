<?php
$ukuran_baju = "L"; 

switch ($ukuran_baju) {
    case "S":
        echo "Ukuran Small - Cocok untuk anak-anak atau badan kecil.";
        break;
    case "M":
        echo "Ukuran Medium - Ukuran standar remaja dan dewasa.";
        break;
    case "L":
        echo "Ukuran Large - Untuk badan agak besar.";
        break;
    case "XL":
        echo "Ukuran Extra Large - Untuk badan besar.";
        break;
    default:
        echo "Ukuran tidak tersedia.";
}
?>
