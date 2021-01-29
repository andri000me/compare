<?php 
date_default_timezone_set('Asia/Jakarta');
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

    // sheet bca
    // echo "<pre>";
    // print_r( $sheetData = $spreadsheet->getSheetByName('rekap keuangan-etoll bca')->toArray() );
    $sheetData = $spreadsheet->getSheetByName('rekap keuangan-etoll bca')->toArray();
    // echo "</pre>";

    #echo $sheetData[3][19]; # mengambil nilai kalijati
    #echo $sheetData[2][19]; # mengambil nama gerbang, example: KALIJATI
    // die();
    for($i=3; $i < count($sheetData); $i++)
    {      
        $tanggal = $sheetData[$i][0]. "</br>"; # 1/2/2021
        $nilai = str_replace(",","",$sheetData[$i][19]); # nilai gerbang
        $gerbang = $sheetData[2][19]; # nama gerbang ex: KALIJATI
        // die();
        /* // 1240022335500
        $account_no = $sheetData[$i][0];
        // 01/12/20 tanggal pd
        $date_pd =  $sheetData[$i][1];
        // $date_pd_dt = date("Y-d-m", strtotime($date_pd));

        // 7806 dan 4610
        $trx_code =  $sheetData[$i][3];
        // desription: MANDIRIA124002233550020201209231744495
        $description1 = $sheetData[$i][4];
        // description2: 000300021437386695301120201202
        $description2 = $sheetData[$i][5];
        // debit
        // $debit = $sheetData[$i][7];
        $debit = str_replace(",","",$sheetData[$i][7]);
        // credit
        // $credit = $sheetData[$i][8];
        $credit = str_replace(",","",$sheetData[$i][8]);
        
        // tanggal hpt get from description2: 30112020
        $tanggal_hpt = substr($sheetData[$i][5], 18,8);
        $tanggal_hpt_dt = date_create_from_format("dmY",$tanggal_hpt);
        $tanggal_hpt_dd = date_format($tanggal_hpt_dt,"Y-m-d");    


        // kode gerbang get from description2: 1437
        $kode_gerbang = substr($sheetData[$i][5],8,4);

        $create_date = date('Y-m-d H:i:s'); */
        // echo $create_date;


        // die();
        /* 
        $tgl_pd=$sheetData[$i][0]; # 01/12 (tanggal pd)
        $tgl_hpt=substr($sheetData[$i][1], -32, 8); # 20201206
        $dt=date('Y-m-d',strtotime($tgl_hpt));
        
        $keterangan=$sheetData[$i][1]; # KR OTOMATIS 01/12/2020 07:07/1 FLAZZ 885000500134  Cikampek 20201130EPJ0264400  0614060002  (keterangan)
        $kode_gerbang=substr($sheetData[$i][1], 36, 13 ); # 885000500134
        // $credit = trim($sheetData[$i][3], "CR");
        $credit = str_replace(",","",$sheetData[$i][3]);
        // $cr =  $credit + 0;
        
        $debit = $sheetData[$i][4];
        

        $create_date = date('Y-m-d H:i:s');

        // echo $create_date . "</br>";
        // echo $debit. "</br>";
        */




        // mysqli_query($koneksi, "INSERT IGNORE INTO mandiri(account_no,date_pd,trx_code,description1,description2,debit,credit,tanggal_hpt,kode_gerbang,create_date) VALUES('$account_no','$date_pd','$trx_code','$description1','$description2','$debit','$credit','$tanggal_hpt_dd','$kode_gerbang','$create_date' ) ");

        // INSERT IGNORE INTO subscribers(email)
        // VALUES('john.doe@gmail.com'), 
        // ('jane.smith@ibm.com');
    }
    
    
    
    // header("Location:form_upload_mandiri.php");
    // tampilkan pesan sukse
    // dan redirect ke halaman form upload
    // echo "<script>alert('Upload File berhasil.');</script>";
    // echo "<script>window.location.href='upload_mandiri.php';</script>";
}


?>
