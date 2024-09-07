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

$title = 'Detail  Siswa';
include 'layout/header.php';


$id_siswa = $_GET['id_siswa'];

$siswa = select("SELECT * FROM siswa WHERE id_siswa = $id_siswa")[0];

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="fas fa-eye"></i> Detail Siswa</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="siswa.php">Data Siswa</a></li>
                        <li class="breadcrumb-item active">Detail Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <table class="table table-bordered table-striped mt-3">
                <tr>
                    <th>Nama</th>
                    <td><?= $siswa['nama']; ?></td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td><?= $siswa['prodi']; ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td><?= $siswa['jk']; ?></td>
                </tr>
                <tr>
                    <th>Telepon</th>
                    <td><?= $siswa['telepon']; ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= $siswa['alamat']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= $siswa['email']; ?></td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>
                        <a href="assets/img/<?= $siswa['foto']; ?>">
                            <img src="assets/img/<?= $siswa['foto']; ?>" alt="<?= $siswa['nama']; ?>" width="200">
                        </a>
                    </td>
                </tr>
            </table>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<?php include 'layout/footer.php'; ?>