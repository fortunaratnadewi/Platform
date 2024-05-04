<?php

$host="localhost:3307";
$user="root";
$pass="";
$database="phpdasar";

// Koneksi ke database
$conn = mysqli_connect($host,$user,$pass,$database);

if ($conn){
    $berhasil = mysqli_select_db($conn,$database);
    echo "Database sudah terhubunug";

    if (!$berhasil){
        echo "Database tidak dapat terhubung";
    }
}else {
    echo "Mysql tidak terhubung";
}
?>