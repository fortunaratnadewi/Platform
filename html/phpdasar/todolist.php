<?php 
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit(); 
    }

    require 'function.php';

    $error ='';
    $kls = 'b';
    $username = $_SESSION['login'];
    if (isset($_POST['tambah'])){
        if (!empty($_POST['todo'])){
            tambahTodo($_POST,$username);
            header("Location: todoList.php");
            exit();
        } else {
            echo "<script> 
                  alert('data harus diisi');
                  </script>";
        }
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'hapus') !== false) {
            $index = substr($key, strlen('hapus')); 
            hapus($_POST, $index);
        }
    }

    
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'selesai') !== false) {
            $index = substr($key, strlen('selesai')); 
            selesai($_POST, $index);
        }
    }

    $text = query($username);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <div class="tambah-todo">
                <input type="text" name="todo" placeholder="Teks todo">
                <button class="tambah" name="tambah">Tambah</button>
            </div>
            <?php foreach ($text as $index => $isi): ?>

                <div class="show-todo">
                    <?php if ($isi['status'] == 'selesai'): ?>
                        <s><?php echo $isi['todolist']; ?></s>
                    <?php else: ?>
                        <?php echo $isi['todolist']; ?>
                    <?php endif; ?>
                    
                    <button class="tambah" name="selesai<?php echo $index; ?>">Selesai</button>
                    <button class="tambah" name="hapus<?php echo $index; ?>">Hapus</button>
                    <input type="hidden" name="index" value="<?php echo $index; ?>">
                </div>
            <?php endforeach; ?>
        </div>

    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
