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
if ($_SESSION['level'] != 1 and $_SESSION['level'] != 3 ) {
    echo "
        <script>
            alert('Perhatian Anda Tidak Punya Hak Akses');
            document.location.href = 'crud-modal.php';
        </script>
        ";
    exit;
}

require 'config/app.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();
$activeWorksheet->setCellValue('A2', 'No');
$activeWorksheet->setCellValue('B2', 'Nama');
$activeWorksheet->setCellValue('C2', 'Program Studi');
$activeWorksheet->setCellValue('D2', 'Jenis Kelamin');
$activeWorksheet->setCellValue('E2', 'Telepon');
$activeWorksheet->setCellValue('F2', 'Email');
$activeWorksheet->setCellValue('G2', 'Foto');

$data_siswa = select("SELECT * FROM siswa");

$no = 1;
$start = 3;
foreach ($data_siswa as $siswa) {
    $activeWorksheet->setCellValue('A' . $start, $no++)->getColumnDimension('A')->setAutoSize(true);
    $activeWorksheet->setCellValue('B' . $start, $siswa['nama'])->getColumnDimension('B')->setAutoSize(true);
    $activeWorksheet->setCellValue('C' . $start, $siswa['prodi'])->getColumnDimension('C')->setAutoSize(true);
    $activeWorksheet->setCellValue('D' . $start, $siswa['jk'])->getColumnDimension('D')->setAutoSize(true);
    $activeWorksheet->setCellValue('E' . $start, $siswa['telepon'])->getColumnDimension('E')->setAutoSize(true);
    $activeWorksheet->setCellValue('F' . $start, $siswa['email'])->getColumnDimension('F')->setAutoSize(true);
    $activeWorksheet->setCellValue('G' . $start, 'http://localhost/php-crud/assets/img/' . $siswa['foto'])->getColumnDimension('G')->setAutoSize(true);
    
    $start++;
}

// table border
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            
        ],
    ],
];

$border = $start - 1;
$activeWorksheet->getStyle('A2:G' . $border)->applyFromArray($styleArray);


$writer = new Xlsx($spreadsheet);
$writer->save('Laporan Data Siswa.xlsx');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan Data Siswa.xlsx"');
readfile('Laporan Data Siswa.xlsx');
unlink('Laporan Data Siswa.xlsx');
exit; 