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

$title = 'Daftar Pegawai';
include 'layout/header.php';



?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><i class="nav-icon fas fa-users"></i> <b> Data Pegawai</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Data Pegawai</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Table Data Pegawai</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>

                                <tbody id="live_data">
                                    <tr>

                                    </tr>
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

<script>
    $('document').ready(function(){
        setInterval(function(){
            getPegawai()
        }, 200) //req per 2 detik
    });

    function getPegawai()
    {
        $.ajax({
            url: "realtime-pegawai.php",
            type: "GET",
            success: function(response){
                $('#live_data').html(response)
            }
        })
    }
</script>

<?php include 'layout/footer.php'; ?>