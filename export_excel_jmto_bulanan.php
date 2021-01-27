<?php
require 'lib_excel/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// call class phpspreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// mulai menulis di cell
// set header 1
$sheet->setCellValue('A1', 'cut off rekening koran 18.01.2021');

// set header 2
$sheet
    ->setCellValue('A4', 'TANGGAL HPT')
    ->setCellValue('B4', 'CIKAMPEK')
    ->setCellValue('C4', 'CIKAMPEK UTAMA')
    ->setCellValue('D4', 'TOTAL');

// set header berdasarkan bulan: example: JANUARI 2021
$bln = $_GET['bulan'];
$bln_dt = date('M Y', strtotime($bln));
$sheet->setCellValue('A5', $bln_dt);






















// call class writer untuk save
$writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
$writer->save("report untuk jmto bulanan.xlsx");
?>