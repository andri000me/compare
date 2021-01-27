<?php
$server = "localhost";
$user = "root";
$pass = "";
$dbname = "comparex";

$koneksi = mysqli_connect($server,$user,$pass,$dbname);

if(! $koneksi)
{
    die("Tidak dapat terhubung ke server mysql!");
}
?>