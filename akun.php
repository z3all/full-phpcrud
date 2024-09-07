<?php

session_start();

// membatasi halaman sebelum login
if (!isset($_SESSION['login'])) {
    echo "
        <script>
            alert('Login Dulu Brok!');
            document.location.href = 'login.php';
        </script>
        ";
    exit;
}

$title = "Daftar Barang";

include 'layout/header.php';

// tampilkan seluruh data akun
$data_akun = select("SELECT * FROM akun");

// tampilkan data bersama user login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = select("SELECT * FROM akun WHERE id_akun = $id_akun");

// jika tombol tambah di tekan jalankan script berikut
if (isset($_POST['tambah'])) {
    if (create_akun($_POST) > 0) {
        echo "
       <script>
           alert('Data Akun Berhasil Ditambahkan');
           document.location.href = 'akun.php';
       </script>
       ";
    } else {
        echo "
       <script>
           alert('Data Akun Gagal Ditambahkan');
           document.location.href = 'akun.php';
       </script>
       ";
    }
}

// jika tombol ubah di tekan jalankan script berikut
if (isset($_POST['ubah'])) {
    if (update_akun($_POST) > 0) {
        echo "
         <script>
             alert('Data Akun Berhasil Diubah');
             document.location.href = 'akun.php';
         </script>
         ";
    } else {
        echo "
         <script>
             alert('Data Akun Gagal Diubah');
             document.location.href = 'akun.php';
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
                    <h1 class="m-0"><i class="nav-icon fas fa-user-cog"></i> <b>Data Akun</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Akun</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Akun</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if ($_SESSION['level'] == 1) : ?>
                                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                            <?php endif; ?>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <!-- tampil seluruh data -->
                                    <?php if ($_SESSION['level'] == 1) : ?>
                                        <?php foreach ($data_akun as $akun) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td><?= $akun['nama'] ?></td>
                                                <td><?= $akun['username'] ?></td>
                                                <td><?= $akun['email'] ?></td>
                                                <td>Password Ter-nkripsi</td>
                                                <td width="20%" class="text-center">
                                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>"><i class="fas fa-edit"></i>  Ubah</button>
                                                    <button type="button" class="btn btn-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $akun['id_akun']; ?>"><i class="fas fa-trash-alt"></i> Hapus</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <!-- tampil data berdasarkan user login -->
                                        <?php foreach ($data_bylogin as $akun) : ?>
                                            <tr>
                                                <th><?= $no++; ?></th>
                                                <td><?= $akun['nama'] ?></td>
                                                <td><?= $akun['username'] ?></td>
                                                <td><?= $akun['email'] ?></td>
                                                <td>Password Ter-nkripsi</td>
                                                <td width="20%" class="text-center">
                                                    <button type="button" class="btn btn-success mb-1" data-bs-toggle="modal" data-bs-target="#modalUbah<?= $akun['id_akun']; ?>">Ubah</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label for="level">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="">-- Pilih Level --</option>
                            <option value="1">Admin</option>
                            <option value="2">Operator Barang</option>
                            <option value="3">Operator Siswa</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ubah -->
<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalUbah<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Akun</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id_akun" value="<?= $akun['id_akun']; ?>">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $akun['nama']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $akun['username']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $akun['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password <small>(Masukkan Password baru/lama)</small></label>
                            <input type="password" class="form-control" id="password" name="password" required minlength="8">
                        </div>
                        <?php if ($_SESSION['level'] == 1) : ?>
                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control">
                                    <?php $level = $akun['level']; ?>
                                    <option value="1" <?= $level == '1' ? 'selected' : null; ?>>Admin</option>
                                    <option value="2" <?= $level == '2' ? 'selected' : null; ?>>Operator Barang</option>
                                    <option value="3" <?= $level == '2' ? 'selected' : null; ?>>Operator Siswa</option>
                                </select>
                            </div>
                        <?php else : ?>
                            <input type="hidden" name="level" value="<?= $akun['level']; ?>">
                        <?php endif; ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" name="ubah" class="btn btn-success">Ubah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php foreach ($data_akun as $akun) : ?>
    <div class="modal fade" id="modalHapus<?= $akun['id_akun']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="titleModal">Hapus Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Yakin Ingin Menghapus Data Akun : <?= $akun['nama']; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secodary" data-bs-dismiss="modal">Kembali</button>
                    <a href="hapus-akun.php?id_akun=<?= $akun['id_akun']; ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php include 'layout/footer.php'; ?>