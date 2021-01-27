<?php 
date_default_timezone_set("Asia/Jakarta");
ini_set('MAX_EXECUTION_TIME', '-1');
//panggil file koneksi database
include 'koneksi.php';

//library PHPSpreadsheet
//call the autoload
require 'lib_excel/vendor/autoload.php';
//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

//logic
$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if(isset($_FILES['berkas_excel']) && in_array($_FILES['berkas_excel']['type'], $file_mimes))
{
    $arr_file = explode('.', $_FILES['berkas_excel']['name']);
    $extension = end($arr_file);

    if('csv' == $extension)
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    }
    else
    {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['berkas_excel']['tmp_name']);

    // change format number
    // $data = $spreadsheet->getActiveSheet()->getStyle('I2')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

    // echo "<pre>";
    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    // print_r($sheetData = $spreadsheet->getActiveSheet()->toArray());
    // echo "</pre>";
    // die();
    for($i=10; $i < count($sheetData); $i++)
    {    
        /* 
        tgl_pd
        tgl_hpt
        keterangan
        kode_gerbang
        debit
        credit
        */
        // ambil dari hasil data save as xlsx
        $tanggal_pd =  $sheetData[$i][0];
        
        $tanggal_hpt = substr($sheetData[$i][2], 25,6);
        $tanggal_hpt_dt = date_create_from_format("dmy",$tanggal_hpt);
        $tanggal_hpt_dd = date_format($tanggal_hpt_dt,"Y-m-d");  
        // echo $tanggal_hpt_dd. "</br>"; 
        
        // die();
        $remark = $sheetData[$i][2];

        $kode_gerbang = substr($sheetData[$i][2], 5,10);

        $debit = $sheetData[$i][6];

        $credit = str_replace(",","",$sheetData[$i][9]);
        $cr =  $credit + 0;

        $ledger = $sheetData[$i][11];
        
        $create_date = date('Y-m-d H:i:s');


        mysqli_query($koneksi, "INSERT INTO bri(tanggal_pd,tanggal_hpt,description1,debit,credit,kode_gerbang,ledger,create_date) VALUES('$tanggal_pd','$tanggal_hpt_dd','$remark','$debit','$cr','$kode_gerbang','$ledger','$create_date') ON DUPLICATE KEY UPDATE ledger='$ledger' ");
    }
    
    
    
    // header("Location:form_upload_mandiri.php");
    // tampilkan pesan sukse
    // dan redirect ke halaman form upload
    // echo "<script>alert('Upload File berhasil.');</script>";
    echo "<script>window.location.href='upload_bri.php';</script>";
}


?>
