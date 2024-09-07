<?php

session_start();

include 'config/app.php';
// check apakah tombol login ditekan
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $secret_key = "6LcR-zgqAAAAAKJSKp4-s2OR8Qg5LWfIMnhfaAuU";

    $verifikasi = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
    $response = json_decode($verifikasi);

    if ($response->success) {
        // check username
        $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username'");

        // jika ada usernya
        if (mysqli_num_rows($result) == 1) {
            // chek password nya
            $hasil = mysqli_fetch_array($result);

            if (password_verify($password, $hasil['password'])) {
                // set session
                $_SESSION['login'] = true;
                $_SESSION['id_akun'] = $hasil['id_akun'];
                $_SESSION['nama'] = $hasil['nama'];
                $_SESSION['username'] = $hasil['username'];
                $_SESSION['email'] = $hasil['email'];
                $_SESSION['level'] = $hasil['level'];

                header("Location: index.php");
                exit;
            } else {
                // jika username salah
                $error = true;
            }
        }
    } else {
        // jika gagal verifikasi recaptcha
        $errorRecaptcha = true;
    }
}

?>




<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Zeall Login</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="icon" href="assets/assets/66cc20c6a0f12.jpg">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <img class="mb-4" src="assets/img/zeall.jpg" alt="" width="72" height="57" style="border-radius: 50%;">
        <h1 class="h3 mb-3 fw-normal">Admin Login</h1>
        <form action="" method="POST">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger text-center">
                    <b>Username/Password salah !!</b>
                </div>
            <?php endif; ?>
            <?php if (isset($errorRecaptcha)) : ?>
                <div class="alert alert-danger text-center">
                    <b> Recaptcha Tidak Valid !!</b>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username..." required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password...">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="col-4">
                <div class="g-recaptcha" data-sitekey="6LcR-zgqAAAAAJdl-tOXhK5Becwpk8oOz2P5-vD1"></div>
            </div>
            <br>
            <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
            <p class="mt-5 mb-3 text-muted">Copyright &copy; zell <?= date('Y') ?></p>
        </form>
    </main>
    <script src="https://www.google.com/recaptcha/api.js"></script>


</body>

</html>