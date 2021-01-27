<?php
require "include/header.php";
?>
<div class="content-wrapper">

    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Upload Rekening Koran</a>
        </li>
        <li class="breadcrumb-item active">Bank BRI</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <!-- <h1>Blank</h1>
                <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
                
                <!-- alert perhatian disini -->
                <div class="alert alert-danger" role="alert">
                <i class="fa fa-info-circle"></i>
                    PERHATIAN!! <br>
                    File upload Rekening Koran ini untuk Bank BRI dengan format file CSV dari tarikan internet banking. <br>
                    Note: <br>
                    kondisi BRI sebelum di upload: <br>
                    0. save as rek koran bri .xls ke .csv file <br>
                    1. hapus baris yang kosong, dibukanya pake notepad++ (jangan langsung dibuka pake excel) <br>
                    2. jangan dibuka hasil csv nya, biarin aja klo mau di buka pake notepad atau notepad++
                    
                </div>

                <div class="card mb-3">
                <form action="proses_upload_bri.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                    <label for="id-date-range-picker-1">Silahkan Pilih File Rekening Koran BRI *.CSV</label>
                    <input type="file" name="berkas_excel" id="" class="form-control">
                    </div>
                    
                    <div class="card-footer small text-muted">
                    <button type="submit" class="btn btn-primary" name="btnUpload">Upload</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div><!-- script php -->
</div>
  <!-- wrapper sampai sini -->

<!-- footer -->
<?php
require "include/footer.php";
?>