<?php 

session_start();

// membatasi halaman selbelum login
$_SESSION = [];

session_unset();
session_destroy();
header('Location: login.php');



