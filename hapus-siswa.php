<?php

session_start();

// membatasi halaman selbelum login
if (!isset($_SESSION['login'])) {
    echo "
        <script>
            alert('Login Dulu Brok!');
            document.location.href = 'login.php';
        </script>
        ";
    exit;
    
}

include 'config/app.php';

$id_siswa = (int)$_GET['id_siswa'];

if (delete_siswa($id_siswa) > 0) {
    echo "
        <script>
            alert('Data Siswa Berhasil Dihapus');
            document.location.href = 'siswa.php';
        </script>
        ";
}else{ 
    echo "
        <script>
            alert('Data Siswa Gagal Dihapus');
            document.location.href = 'siswa.php';
        </script>
        ";
}
    