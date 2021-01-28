<?php
include "koneksi.php";
require 'lib_excel/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// tangkap inputan user dengan metode get
$tgl_awal = $_GET['awal'];
$tgl_akhir = $_GET['akhir'];



// call class phpspreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet()->setTitle('BCA');

// mulai menulis di cell
// set header 1
$sheet->setCellValue('A1', 'cut off rekening koran '.$tgl_akhir);

// set header 2
$sheet
    ->setCellValue('A4', 'TANGGAL HPT')
    ->setCellValue('B4', 'CIKAMPEK')
    ->setCellValue('C4', 'CIKAMPEK UTAMA')
    ->setCellValue('D4', 'TOTAL');

// set header berdasarkan bulan: example: JANUARI 2021
$bln = $_GET['awal'];
$bln_dt = date('M Y', strtotime($bln));
$sheet->setCellValue('A5', $bln_dt);

$query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit_cikampek FROM bca WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang=' 885000500134'  GROUP BY tanggal_hpt");

$query_cikampek_utama = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit_cikampek_utama FROM bca WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang=' 885000803566'  GROUP BY tanggal_hpt");

// loop the data
$contentStartRow = 6;
$currentContentRow = 6;
while( ($item=mysqli_fetch_array($query)) && ($item2=mysqli_fetch_array($query_cikampek_utama)) ){

    $spreadsheet->getActiveSheet()->insertNewRowBefore($currentContentRow+1,1);

    $spreadsheet->getActiveSheet()
        ->setCellValue('A'.$currentContentRow, $item['tanggal_hpt'])
        ->setCellValue('B'.$currentContentRow, $item['credit_cikampek'])
        ->setCellValue('C'.$currentContentRow, $item2['credit_cikampek_utama'])
        ->setCellValue('D'.$currentContentRow, "=SUM(B$currentContentRow:C$currentContentRow)");
    $currentContentRow++;
}
$sheet->setCellValue("B{$currentContentRow}", "=SUM(B{$contentStartRow}:B{$currentContentRow})");
$sheet->setCellValue("C{$currentContentRow}", "=SUM(C{$contentStartRow}:C{$currentContentRow})");
$sheet->setCellValue("D{$currentContentRow}", "=SUM(D{$contentStartRow}:D{$currentContentRow})");


// call class writer untuk save
// $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
// $writer->save("report untuk jmto bulanan.xlsx");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="untuk jmto bulanan.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>