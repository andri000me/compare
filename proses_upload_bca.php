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
    // $data = $spreadsheet->getActiveSheet()->getStyle('I2')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    // $ktr = $sheetData[6][1];
    // // echo substr($data, 31, 5); # FLAZZ
    // if(substr($ktr, 31, 5) == "FLAZZ")
    // {
    //     for($i=6; $i < count($sheetData); $i++)
    //     {
    //         $keterangan=$sheetData[$i][1];
    //         $un_keterangan = substr($keterangan, 31, 5);
            
    //         /* $arr1 = array("a" => "Apple", "b" => "Ball", "c" => "Cat");
    //         echo "<pre>";
    //         print_r($arr1);
    //         echo "</pre>";

    //         unset($arr1["b"]); 

    //         echo "<pre>";
    //         print_r($arr1);
    //         echo "</pre>"; */
    //         unset($keterangan);
    //         // echo $keterangan. "</br>";
    //         print_r($keterangan);
    //     }
    // }
    // else
    // {
    //     echo "no flass";
    // }
    /* echo "<pre>";
    print_r($sheetData);
    echo "</pre>";

    die(); */
    for($i=6; $i < count($sheetData); $i++)
    {      
        // /* $tglTrx = date('Y-m-d', strtotime($sheetData[$i]['0']));

        // echo $keterangan. "</br>";
        // $str = substr($keterangan, strpos($keterangan, 'CIKEDUNG '));
        // echo $str. "</br>";
        /* $keterangan = $sheetData[$i][1];
        $gerbang = substr($keterangan, 36, 13);
        echo $gerbang. "</br>"; */

        /* 
        tgl_pd
        tgl_hpt
        keterangan
        kode_gerbang
        debit
        credit
        */
        $tgl_pd=$sheetData[$i][0]; # 01/12 (tanggal pd)
        $dt_pd=date_create($tgl_pd);
        $dd_pd = date_format($dt_pd,"Y-m-d");

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





        mysqli_query($koneksi, "INSERT INTO bca(tanggal_pd,tanggal_hpt,keterangan,kode_gerbang,credit,debit, create_date) VALUES('$dd_pd','$dt','$keterangan','$kode_gerbang','$credit','$debit', '$create_date') ON DUPLICATE KEY UPDATE keterangan='$keterangan' ");
    }
    
    
    
    // header("Location:form_upload_mandiri.php");
    // tampilkan pesan sukse
    // dan redirect ke halaman form upload
    // echo "<script>alert('Upload File berhasil.');</script>";
    echo "<script>window.location.href='upload_bca.php';</script>";
}


?>
