<?php
$severName="localhost, 1433";
$connectionInfo= array("Database"=> "belajarandroid", "UID"=> "sa", "PWD"=> "cne321");

$conn = sqlsrv_connect($severName,$connectionInfo);

if ($conn) {
    // echo "Koneksi berhasil! <br>";
}
else {
    echo "Koneksi gagal! <br>";
    die(print_r(sqlsrv_error(), true));
}

?>