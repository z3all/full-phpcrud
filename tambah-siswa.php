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

$title = 'Tambah Siswa';

include 'layout/header.php';


if (isset($_POST['tambah'])) {
    if (create_siswa($_POST) > 0) {
        echo "
       <script>
           alert('Data Siswa Berhasil Ditambahkan');
           document.location.href = 'siswa.php';
       </script>
       ";
    } else {
        echo "
       <script>
           alert('Data Siswa Gagal Ditambahkan');
           document.location.href = 'siswa.php';
       </script>
       ";
    }
}


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-plus-circle"></i> Tambah Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="siswa.php">Data Siswa</a></li>
                        <li class="breadcrumb-item active"> Tambah Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama siswa...">
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="">--Pilih Prodi--</option>
                            <option value="Teknik Komputer">RPL</option>
                            <option value="Teknik Listrik">TITL</option>
                            <option value="Teknik Mesin">TPM</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="jk" class="form-label">Program Studi</label>
                        <select name="jk" id="jk" class="form-control">
                            <option value="">--Pilih Jenis Kelamin--</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon...">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat"></textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email " class="form-control" id="email" name="email" placeholder="Email...">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto..." onchange="previewImg()">

                    <img src="" alt="" class="img-thumbnail img-preview mt-2" width="100px">
                </div>

                <button type="submit" name="tambah" class="btn btn-primary" style="float:right;">Tambah</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<script>
    function previewImg() {
        const foto = document.querySelector('#foto');
        const imgPreview = document.querySelector('.img-preview');

        const fileFoto = new FileReader();
        fileFoto.readAsDataURL(foto.files[0]);

        fileFoto.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?php include 'layout/footer.php'; ?>