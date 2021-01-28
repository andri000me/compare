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
/* Awal sheet BCA */
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
        /* tambahkan format number di cell B,C,D */
        $sheet
            ->getStyle('B'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet
            ->getStyle('C'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet
            ->getStyle('D'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $currentContentRow++;
    /* menambahkan border tabel */
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];
    
    $sheet->getStyle('A1:D'.$currentContentRow)->applyFromArray($styleArray);
}



/* tambahkan fungsi sum */
$sheet
    ->setCellValue("B{$currentContentRow}", "=SUM(B{$contentStartRow}:B{$currentContentRow})")
    ->getStyle('B'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet
    ->setCellValue("C{$currentContentRow}", "=SUM(C{$contentStartRow}:C{$currentContentRow})")
    ->getStyle('C'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet
    ->setCellValue("D{$currentContentRow}", "=SUM(D{$contentStartRow}:D{$currentContentRow})")
    ->getStyle('D'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

/* tambah nama total di kolom A akhir */
$sheet->setCellValue("A{$currentContentRow}","Total");

/* set kolom auto size */
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

/* akhir sheet BCA */

/* Awal sheet Mandiri */

// membuat sheet baru, dengan nama MANDIRI
$sheet_mandiri = $spreadsheet->createSheet()->setTitle('MANDIRI');

// mulai menulis di cell
// set header 1
$sheet_mandiri->setCellValue('A1', 'cut off rekening koran '.$tgl_akhir);

// set header 2
$sheet_mandiri
    ->setCellValue('A4', 'TANGGAL HPT')
    ->setCellValue('B4', 'CIKAMPEK')
    ->setCellValue('C4', 'CIKAMPEK UTAMA')
    ->setCellValue('D4', 'TOTAL');

// set header berdasarkan bulan: example: JANUARI 2021
$bln = $_GET['awal'];
$bln_dt = date('M Y', strtotime($bln));
$sheet_mandiri->setCellValue('A5', $bln_dt);

$query_cikampek_mandiri = mysqli_query($koneksi, " SELECT tanggal_hpt,kode_gerbang,SUM(credit) as credit_cikampek_mandiri FROM mandiri WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang='1420'  GROUP BY tanggal_hpt ");

$query_cikampek_utama_mandiri = mysqli_query($koneksi, " SELECT tanggal_hpt,kode_gerbang,SUM(credit) as credit_cikampek_utama_mandiri FROM mandiri WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang='1437'  GROUP BY tanggal_hpt ");

// loop the data
$contentStartRow = 6;
$currentContentRow = 6;
while( ($item=mysqli_fetch_array($query_cikampek_mandiri)) && ($item2=mysqli_fetch_array($query_cikampek_utama_mandiri)) ){

    $sheet_mandiri->insertNewRowBefore($currentContentRow+1,1);

    $sheet_mandiri
        ->setCellValue('A'.$currentContentRow, $item['tanggal_hpt'])
        ->setCellValue('B'.$currentContentRow, $item['credit_cikampek_mandiri'])
        ->setCellValue('C'.$currentContentRow, $item2['credit_cikampek_utama_mandiri'])
        ->setCellValue('D'.$currentContentRow, "=SUM(B$currentContentRow:C$currentContentRow)");
        /* tambahkan format number di cell B,C,D */
        $sheet_mandiri
            ->getStyle('B'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet_mandiri
            ->getStyle('C'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet_mandiri
            ->getStyle('D'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $currentContentRow++;
    /* menambahkan border tabel */
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];
    $sheet_mandiri->getStyle('A1:D'.$currentContentRow)->applyFromArray($styleArray);
}
/* tambahkan fungsi sum */
$sheet_mandiri
    ->setCellValue("B{$currentContentRow}", "=SUM(B{$contentStartRow}:B{$currentContentRow})")
    ->getStyle('B'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet_mandiri
    ->setCellValue("C{$currentContentRow}", "=SUM(C{$contentStartRow}:C{$currentContentRow})")
    ->getStyle('C'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet_mandiri
    ->setCellValue("D{$currentContentRow}", "=SUM(D{$contentStartRow}:D{$currentContentRow})")
    ->getStyle('D'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

/* tambah nama total di kolom A akhir */
$sheet_mandiri->setCellValue("A{$currentContentRow}","Total");

/* set kolom auto size */
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
/* akhir bank MANDIRI */



/* ========================Awal sheet BRI=========================== */
// membuat sheet baru, dengan nama BRI
$sheet_bri = $spreadsheet->createSheet()->setTitle('BRI');

// mulai menulis di cell
// set header 1
$sheet_bri->setCellValue('A1', 'cut off rekening koran '.$tgl_akhir);

// set header 2
$sheet_bri
    ->setCellValue('A4', 'TANGGAL HPT')
    ->setCellValue('B4', 'CIKAMPEK')
    ->setCellValue('C4', 'CIKAMPEK UTAMA')
    ->setCellValue('D4', 'TOTAL');

// set header berdasarkan bulan: example: JANUARI 2021
$bln = $_GET['awal'];
$bln_dt = date('M Y', strtotime($bln));
$sheet_bri->setCellValue('A5', $bln_dt);

$query_cikampek_bri = mysqli_query($koneksi, " SELECT tanggal_hpt,kode_gerbang,SUM(credit) as credit_cikampek_bri FROM bri WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang='1929570116'  GROUP BY tanggal_hpt ASC ");

$query_cikampek_utama_bri = mysqli_query($koneksi, " SELECT tanggal_hpt,kode_gerbang,SUM(credit) as credit_cikampek_utama_bri FROM bri WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang='1929570262'  GROUP BY tanggal_hpt ");

// loop the data
$contentStartRow = 6;
$currentContentRow = 6;
while( ($item=mysqli_fetch_array($query_cikampek_bri)) && ($item2=mysqli_fetch_array($query_cikampek_utama_bri)) ){

    $sheet_bri->insertNewRowBefore($currentContentRow+1,1);

    $sheet_bri
        ->setCellValue('A'.$currentContentRow, $item['tanggal_hpt'])
        ->setCellValue('B'.$currentContentRow, $item['credit_cikampek_bri'])
        ->setCellValue('C'.$currentContentRow, $item2['credit_cikampek_utama_bri'])
        ->setCellValue('D'.$currentContentRow, "=SUM(B$currentContentRow:C$currentContentRow)");
        /* tambahkan format number di cell B,C,D */
        $sheet_bri
            ->getStyle('B'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet_bri
            ->getStyle('C'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet_bri
            ->getStyle('D'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $currentContentRow++;
    /* menambahkan border tabel */
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];
    $sheet_bri->getStyle('A1:D'.$currentContentRow)->applyFromArray($styleArray);
}
/* tambahkan fungsi sum */
$sheet_bri
    ->setCellValue("B{$currentContentRow}", "=SUM(B{$contentStartRow}:B{$currentContentRow})")
    ->getStyle('B'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet_bri
    ->setCellValue("C{$currentContentRow}", "=SUM(C{$contentStartRow}:C{$currentContentRow})")
    ->getStyle('C'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet_bri
    ->setCellValue("D{$currentContentRow}", "=SUM(D{$contentStartRow}:D{$currentContentRow})")
    ->getStyle('D'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

/* tambah nama total di kolom A akhir */
$sheet_bri->setCellValue("A{$currentContentRow}","Total");

/* set kolom auto size */
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
/* akhir bank BRI */

/* ========================Awal sheet BNI=========================== */
// membuat sheet baru, dengan nama BNI
$sheet_bni = $spreadsheet->createSheet()->setTitle('BNI');

// mulai menulis di cell
// set header 1
$sheet_bni->setCellValue('A1', 'cut off rekening koran '.$tgl_akhir);

// set header 2
$sheet_bni
    ->setCellValue('A4', 'TANGGAL HPT')
    ->setCellValue('B4', 'CIKAMPEK')
    ->setCellValue('C4', 'CIKAMPEK UTAMA')
    ->setCellValue('D4', 'TOTAL');

// set header berdasarkan bulan: example: JANUARI 2021
$bln = $_GET['awal'];
$bln_dt = date('M Y', strtotime($bln));
$sheet_bni->setCellValue('A5', $bln_dt);

$query_cikampek_bni = mysqli_query($koneksi, " SELECT tanggal_hpt,kode_gerbang,SUM(credit) as credit_cikampek_bni FROM bni WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang='301420'  GROUP BY tanggal_hpt ASC ");

$query_cikampek_utama_bni = mysqli_query($koneksi, " SELECT tanggal_hpt,kode_gerbang,SUM(credit) as credit_cikampek_utama_bni FROM bni WHERE tanggal_hpt BETWEEN '$tgl_awal' AND '$tgl_akhir' AND kode_gerbang='301426'  GROUP BY tanggal_hpt ");

// loop the data
$contentStartRow = 6;
$currentContentRow = 6;
while( ($item=mysqli_fetch_array($query_cikampek_bni)) && ($item2=mysqli_fetch_array($query_cikampek_utama_bni)) ){

    $sheet_bni->insertNewRowBefore($currentContentRow+1,1);

    $sheet_bni
        ->setCellValue('A'.$currentContentRow, $item['tanggal_hpt'])
        ->setCellValue('B'.$currentContentRow, $item['credit_cikampek_bni'])
        ->setCellValue('C'.$currentContentRow, $item2['credit_cikampek_utama_bni'])
        ->setCellValue('D'.$currentContentRow, "=SUM(B$currentContentRow:C$currentContentRow)");
        /* tambahkan format number di cell B,C,D */
        $sheet_bni
            ->getStyle('B'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet_bni
            ->getStyle('C'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet_bni
            ->getStyle('D'. $currentContentRow)->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    $currentContentRow++;
    /* menambahkan border tabel */
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000000'],
            ],
        ],
    ];
    $sheet_bni->getStyle('A1:D'.$currentContentRow)->applyFromArray($styleArray);
}
/* tambahkan fungsi sum */
$sheet_bni
    ->setCellValue("B{$currentContentRow}", "=SUM(B{$contentStartRow}:B{$currentContentRow})")
    ->getStyle('B'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet_bni
    ->setCellValue("C{$currentContentRow}", "=SUM(C{$contentStartRow}:C{$currentContentRow})")
    ->getStyle('C'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
$sheet_bni
    ->setCellValue("D{$currentContentRow}", "=SUM(D{$contentStartRow}:D{$currentContentRow})")
    ->getStyle('D'. $currentContentRow)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

/* tambah nama total di kolom A akhir */
$sheet_bni->setCellValue("A{$currentContentRow}","Total");

/* set kolom auto size */
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(12);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
/* akhir bank BRI */


























// call class writer untuk save
// $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
// $writer->save("report untuk jmto bulanan.xlsx");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="untuk jmto bulanan.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
?>