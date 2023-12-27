<?php

include 'phpqrcode/qrlib.php';
    $name = "Example | 1st-Year | 20-23232";

$path = 'qrs/';
$file = $path.uniqid().".png";

$ecc = 'L';
$pixel_Size = 10;

QRcode::png($name, $file, $ecc, $pixel_Size,15);
?>
 <?php echo "<center><img src='".$file."' width='500' height='500'></center>"; ?>