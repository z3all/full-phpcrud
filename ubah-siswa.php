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

$title = 'Ubah Siswa';

include 'layout/header.php';


if (isset($_POST['ubah'])) {
    if (update_siswa($_POST) > 0) {
        echo "
       <script>
           alert('Data Siswa Berhasil Diubah');
           document.location.href = 'siswa.php';
       </script>
       ";
    } else {
        echo "
       <script>
           alert('Data Siswa Gagal Diubah');
           document.location.href = 'siswa.php';
       </script>
       ";
    }
}

$id_siswa = (int)$_GET['id_siswa'];

$siswa = select("SELECT * FROM siswa WHERE id_siswa = $id_siswa")[0];


?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-edit"></i>Ubah Data Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Tambah Data Siswa</li>
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
                <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa']; ?>">
                <input type="text" name="fotoLama" value="<?= $siswa['foto']; ?>" hidden>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama siswa..." value="<?= $siswa['nama']; ?>">
                </div>

                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="prodi" class="form-label">Program Studi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <?php $prodi = $siswa['prodi']; ?>
                            <option value="Teknik Komputer" <?= $prodi == 'Teknik Komputer' ? 'selected' : null ?>>RPL</option>
                            <option value="Teknik Listrik" <?= $prodi == 'Teknik Listrik' ? 'selected' : null ?>>TITL</option>
                            <option value="Teknik Mesin" <?= $prodi == 'Teknik Mesin' ? 'selected' : null ?>>TPM</option>
                        </select>
                    </div>
                    <div class="mb-3 col-6">
                        <label for="jk" class="form-label">Program Studi</label>
                        <select name="jk" id="jk" class="form-control">
                            <?php $jk = $siswa['jk']; ?>
                            <option value="Laki-Laki" <?= $jk == 'Laki-Laki' ? 'selected' : null ?>>Laki-Laki</option>
                            <option value="Perempuan" <?= $jk == 'Perempuan' ? 'selected' : null ?>>Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Telepon..." value="<?= $siswa['telepon']; ?>">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat"><?= $siswa['alamat'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email " class="form-control" id="email" name="email" placeholder="Email..." value="<?= $siswa['email']; ?>">
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" placeholder="Foto..." onchange="previewImg()">

                    <img src="assets/img/<?= $siswa['foto'] ?>" alt="" class="img-thumbnail img-preview mt-2" width="100px">
                </div>

                <button type="submit" name="ubah" class="btn btn-primary" style="float:right;">ubah</button>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>