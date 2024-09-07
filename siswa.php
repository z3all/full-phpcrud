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
// membatasi halaman sesuai user login
if ($_SESSION['level'] != 1 and $_SESSION['level'] != 3) {
    echo "
        <script>
            alert('Perhatian Anda Tidak Punya Hak Akses');
            document.location.href = 'crud-modal.php';
        </script>
        ";
    exit;
}

$title = 'Daftar Siswa';
include 'layout/header.php';



$data_siswa = select("SELECT * FROM siswa ORDER BY id_siswa DESC");

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-users"></i> <b>Data Siswa</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Siswa</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>New Orders</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>53<sup style="font-size: 20px">%</sup></h3>

                            <p>Bounce Rate</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>44</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Table Data Siswa</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="tambah-siswa.php" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah</a>
                                    <a href="download-excel-siswa.php" class="btn btn-success mb-2"><i class="fas fa-file-excel"></i> Download Excel</a>
                                    <a href="download-pdf-siswa.php" class="btn btn-danger mb-2"><i class="fas fa-file-pdf"></i> Download PDF</a></table>
                                    <table id="serverside" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Prodi</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php include 'layout/footer.php'; ?>