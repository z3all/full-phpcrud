<?php

use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//Server settings
$mail->SMTPDebug = 2;                              //Enable verbose debug output
$mail->isSMTP();                                   //Send using SMTP
$mail->Host       = 'smtp.gmail.com';              //Set the SMTP server to send through
$mail->SMTPAuth   = true;                          //Enable SMTP authentication
$mail->Username   = 'yfendi925@gmail.com';         //SMTP username
$mail->Password   = 'sheeeeeeeesh';                //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
$mail->Port       = 465;

// check apakah tombol kirim ditekan
//Recipients
$mail->setFrom('yfendi925@gmail.com', 'Yogfendi');
$mail->addAddress($_POST['email_penerima']);     //Add a recipient
$mail->addReplyTo('yfendi925@gmail.com', 'test');

$mail->Subject = $_POST['subject'];
$mail->Body    = $_POST['pesan'];

if ($mail->send()) {
    echo "<script>
        alert('Email Berhasil Dikirimkan');
        document.location.href = 'email.php';
    </script>";
} else {
    echo "<script>
        alert('Email Gagal Dikirimkan');
        document.location.href = 'email.php';
    </script>";
}