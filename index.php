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
if ($_SESSION['level'] != 1 and $_SESSION['level'] != 2) {
    echo "
            <script>
                alert('Perhatian Anda Tidak Punya Hak Akses');
                document.location.href = 'crud-modal.php';
            </script>
            ";
    exit;
}

$title = "Daftar Barang";

include 'layout/header.php';
if (isset($_POST['filter'])) {
    $tgl_awal = strip_tags($_POST['tgl_awal'] . " 00:00:00");
    $tgl_akhir = strip_tags($_POST['tgl_akhir'] . " 23:59:59");

    $data_barang = select("SELECT * FROM barang WHERE tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_barang DESC");
} else {
    // query tampil data dengan pagination
    $jumlahDataPerhalaman   = 2;
    $jumlahData             = count(select("SELECT * FROM barang"));
    $jumlahHalaman          = ceil($jumlahData / $jumlahDataPerhalaman);
    $halamanAktif           = (isset($_GET['halaman']) ? $_GET['halaman'] : 1);
    $awalData               = ($jumlahDataPerhalaman * $halamanAktif) - $jumlahDataPerhalaman;

    $data_barang = select("SELECT * FROM barang ORDER BY id_barang DESC LIMIT $awalData, $jumlahDataPerhalaman");
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-list"></i><b> Data Barang</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Barang</li>
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
                                    <h3 class="card-title">Table Data Barang</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <a href="tambah-barang.php" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Tambah</a>
                                    <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#modalFilter">
                                        <i class="fas fa-search"></i> Filter Data
                                    </button>
                                    <table id="" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>jumblah</th>
                                                <th>Harga</th>
                                                <th>barcode</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach ($data_barang as $barang) : ?>
                                                <tr>
                                                    <td><?= $awalData += 1; ?></td>
                                                    <td><?= $barang['nama']; ?></td>
                                                    <td><?= $barang['jumlah']; ?></td>
                                                    <td>Rp. <?= number_format($barang['harga'], 2, ',', '.'); ?></td>
                                                    <td class="text-center">
                                                        <img alt="barcode" src="barcode.php?codetype=Code128&size=15&
                                                        text=<?= $barang['barcode']; ?>&print=true" />
                                                    </td>
                                                    <td><?= date('d/m/Y | H:i:s', strtotime($barang['tanggal'])); ?></td>
                                                    <td width="20%" class="text-center">
                                                        <a href="ubah-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-success"> <i class="fas fa-edit"></i> Ubah</a>

                                                        <a href="hapus-barang.php?id_barang=<?= $barang['id_barang']; ?>" class="btn btn-danger" onclick="return confirm('Yakin Data Barang Akan Dihapus...?')"> <i class="fas fa-trash-alt"></i> Hapus</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <div class="mt-2 justify-content-end d-flex">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <?php if ($halamanAktif > 1) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?halaman=<?= $halamanAktif - 1 ?>" aria-label="Previous">
                                                            <span aria-hidden="true">&laquo;</span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                                <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                                                    <?php if ($i == $halamanAktif) : ?>
                                                        <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php else : ?>
                                                        <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                                                    <li class="page-item">
                                                        <a class="page-link" href="?halaman=<?= $halamanAktif + 1 ?>" aria-label="Next">
                                                            <span aria-hidden="true">&raquo;</span>
                                                        </a>
                                                    </li>
                                                <?php endif; ?>

                                            </ul>
                                        </nav>
                                    </div>
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

<!-- ModalFilter -->
<div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fas fa-search"></i> Filter Search</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="tgl_awal">Tanggal Awal</label>
                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal">
                    </div>
                    <div class="form-group">
                        <label for="tgl_akhir">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" name="filter">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>