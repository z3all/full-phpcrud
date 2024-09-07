<?php 

function select($query)
{
    global $db; 

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows; 
    
}

function create_barang($post)
{
    global $db;


    $nama       = strip_tags($post['nama']);
    $jumlah     = strip_tags($post['jumlah']);
    $harga      = strip_tags($post['harga']);
    $barcode    = rand(100000, 999999); 
    

    $query = "INSERT INTO barang VALUES (null, '$nama', '$jumlah', '$harga', '$barcode', CURRENT_TIMESTAMP())";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);

}

function update_barang($post)
{
    global $db;

    $id_barang  = $post['id_barang'];
    $nama       = $post['nama'];
    $jumlah     = $post['jumlah'];
    $harga      = $post['harga'];
     

    $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga'
    WHERE id_barang = $id_barang";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);

} 

function delete_barang($id_barang)
{
    global $db;

    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}

function create_siswa($post)
{
    global $db;


    $nama       = strip_tags($post['nama']);
    $prodi      = strip_tags($post['prodi']);
    $jk         = strip_tags($post['jk']);
    $telepon    = strip_tags($post['telepon']);
    $alamat     = $post['alamat'];
    $email      = strip_tags($post['email']);
    $foto       = upload_file();


    if (!$foto) {
        return false;
    }
    

    $query = "INSERT INTO siswa VALUES (null, '$nama', '$prodi', '$jk', '$telepon', '$alamat', '$email', '$foto')";
    
    mysqli_query($db, $query); 

    return mysqli_affected_rows($db);

}

function update_siswa($post)
{
    global $db;

    $id_siswa   = $post['id_siswa'];
    $nama       = strip_tags($post['nama']);
    $prodi      = strip_tags($post['prodi']);
    $jk         = strip_tags($post['jk']);
    $telepon    = strip_tags($post['telepon']);
    $alamat     = $post['alamat'];
    $email      = strip_tags($post['email']);
    $fotoLama   = strip_tags($post['fotoLama']);


    if ($_FILES['foto']['name'] == 4) {
        $foto = $fotoLama;
    } else {
        $foto = upload_file();
    }
    

    $query = "UPDATE siswa SET nama = '$nama', prodi = '$prodi', jk = '$jk', telepon = '$telepon', alamat = '$alamat', email = '$email', foto = '$foto' WHERE id_siswa = $id_siswa";
    
    mysqli_query($db, $query); 

    return mysqli_affected_rows($db);

}

function upload_file() {
    $namaFile       = $_FILES['foto']['name'];
    $ukuranFile     = $_FILES['foto']['size'];
    $error          = $_FILES['foto']['error'];
    $tmpName        = $_FILES['foto']['tmp_name'];

    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    if (!in_array($extensifile, $extensifileValid)) {
        echo "
            <script>
                alert('Format File Tidak Valid');
                ddocument.location.href = 'tambah-siswa.php';
            </script>";
        die();
        
    }  
    if ($ukuranFile > 2048000) {
        echo "
        <script>
            alert('Ukuran File Max 2MB');
            ddocument.location.href = 'tambah-siswa.php';
        </script>";
        die();
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru);
    return $namaFileBaru; 
    
}

function delete_siswa($id_siswa)
{
    global $db;

    $foto = select("SELECT * FROM siswa WHERE id_siswa = $id_siswa")[0];
    unlink('assets/img/'. $foto['foto']);

    $query = "DELETE FROM siswa WHERE id_siswa = $id_siswa";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}  

function create_akun($post) {
    global $db;

    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO akun VALUES (null, '$nama', '$username', '$email', '$password', '$level')";
    
    mysqli_query($db, $query); 

    return mysqli_affected_rows($db);
}

function update_akun($post) {
    global $db;

    $id_akun    = strip_tags($post['id_akun']);
    $nama       = strip_tags($post['nama']);
    $username   = strip_tags($post['username']);
    $email      = strip_tags($post['email']);
    $password   = strip_tags($post['password']);
    $level      = strip_tags($post['level']);

    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";
    
    mysqli_query($db, $query); 

    return mysqli_affected_rows($db);
}

function delete_akun($id_akun)
{
    global $db;


    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}