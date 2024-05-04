<?php

// Koneksi ke database
$host="localhost:3307";
$user="root";
$pass="";
$database="php";

// Koneksi ke database
$conn = mysqli_connect($host,$user,$pass,$database);

if ($conn){
    $berhasil = mysqli_select_db($conn,$database);

    if (!$berhasil){
        echo "Database tidak dapat terhubung";
    }
}else {
    echo "Mysql tidak terhubung";
}


// FUNGSI UNTUK MELAKUKAN LOGIN
function Register ($data) {
    global $conn;

    // Ambil nilai dari form
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //untuk mengecek username sudah ada atau belum 
    $cek = mysqli_query($conn,"SELECT * FROM login where username= '$username'");

    if(mysqli_Fetch_assoc($cek)){
        echo "<script>
        alert('username sudah terdaftar!')
        </script>";

        return false;
    }

    // Cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>alert('Konfirmasi password tidak sesuai');</script>";
        return false;
    }

    //mengamankan password user 
    $password = password_hash($password,PASSWORD_DEFAULT);

    // menambahkan user baru ke database 
    $query = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah perintah INSERT berhasil
    if ($result) {
    // Mengembalikan jumlah baris yang terpengaruh oleh operasi INSERT
    return mysqli_affected_rows($conn);

    } else {
    // Jika terjadi kesalahan, menampilkan pesan error
    echo "Gagal menambahkan user baru: " . mysqli_error($conn);
    }
    // Menutup koneksi database
    mysqli_close($conn);

    return mysqli_affected_rows($conn);
}


function tambahTodo($data, $username){
    global $conn;
    $text = mysqli_real_escape_string($conn, $data['todo']);

    $user_query = "SELECT id FROM login WHERE username = '$username'";
    $user_result = mysqli_query($conn, $user_query);
    $user_row = mysqli_fetch_assoc($user_result);
    $user_id = $user_row['id'];

    $query = "INSERT INTO todo (todolist, status, user_id) 
              VALUES ('$text', 'onprocess', '$user_id')";
    mysqli_query($conn, $query);
}


function query($username){
    global $conn;
    $query = "SELECT t.id, t.kegiatan, t.status 
              FROM todolist t
              JOIN login l on t.user_id = l.id
              WHERE username = '$username'";
    $hasil = mysqli_query($conn, $query);
    $datas = [];
    while ($row = mysqli_fetch_assoc($hasil)){
        $datas[] = $row;
    }
    return $datas;
}

function hapus($data,$index){
    global $conn;
    $isi = $data['isi'.$index];
    $query = "SELECT status FROM todolist WHERE id = '$isi'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row['status'] == 'onprocess') {
            echo "<script>alert('Data tidak dapat dihapus karena status masih onprocess harap klik selesai dahulu');</script>";
        } else {
            $deleteQuery = "DELETE FROM todo WHERE todolist = '$isi'";
            mysqli_query($conn, $deleteQuery);
            echo "<script>alert('Data berhasil dihapus');</script>";
        }
    } else {
        echo "<script>alert('Terjadi kesalahan dalam mengambil status data');</script>";
    }
}

function selesai($data,$index){
    global $conn;
    $isi = $data['isi'.$index];
    $query = "UPDATE todo SET status = 'selesai' WHERE todolist = '$isi'";
    mysqli_query($conn,$query);
}

