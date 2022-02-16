<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gulaliqu";
$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error){
	die("gagal koneksi db");
}
?>