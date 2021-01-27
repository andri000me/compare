<?php 
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
    $data = $spreadsheet->getActiveSheet()->getStyle('I2')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

    // $sheetData = $spreadsheet->getActiveSheet()->toArray();
    $sheetData = $data->getActiveSheet()->toArray();
    
    for($i=2; $i < count($sheetData); $i++)
    {      
       
        // tgl_pd
        $tgl_pd =  substr($sheetData[$i][0], 0, 8); # 01/01/21
        $branch = $sheetData[$i][2]; # 720
        $journal_no = $sheetData[$i][3]; # 720787
        $remark = $sheetData[$i][4]; # remarknya
        $debit = str_replace(",","",$sheetData[$i][5]);
        // $credit = $sheetData[$i][6];
        $credit = str_replace(",","",$sheetData[$i][6]);

        $tanggal_hpt = substr($sheetData[$i][4], 80,8); # 31122020
        $tanggal_hpt_dt = date_create_from_format("dmY",$tanggal_hpt);
        $tanggal_hpt_dd = date_format($tanggal_hpt_dt,"Y-m-d"); 
        $kode_gerbang =  substr($sheetData[$i][4], 91,6);
        // die();

        $create_date = date('Y-m-d H:i:s');
        
        mysqli_query($koneksi, "INSERT INTO bni(tanggal_pd,tanggal_hpt,branch,jurnal_no,description1,kode_gerbang,debit,credit, create_date) VALUES('$tgl_pd','$tanggal_hpt_dd','$branch','$journal_no','$remark','$kode_gerbang','$debit','$credit','$create_date') ON DUPLICATE KEY UPDATE jurnal_no='$journal_no' ");
    
    
    }
    // header("Location:form_upload_mandiri.php");
    // tampilkan pesan sukse
    // dan redirect ke halaman form upload
    // echo "<script>alert('Upload File berhasil.');</script>";
    echo "<script>window.location.href='upload_bni.php';</script>";
}


?>
