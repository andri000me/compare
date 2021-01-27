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
        <li class="breadcrumb-item active">Bank BNI</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <!-- <h1>Blank</h1>
                <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
                
                <!-- alert perhatian disini -->
                <div class="alert alert-danger" role="alert">
                <i class="fa fa-info-circle"></i>
                    PERHATIAN!! <br>
                    File upload Rekening Koran ini untuk Bank BNI dengan format file CSV dari tarikan internet banking. <br>
                    Note: <br>
                    kondisi BNI upload: <br>
                    0. pastikan file bni format csv <br>
                    1. buka file csv, klik kanan "move or copy"->ceklis "creata a copy"->dan pilih new book (supaya menghasilkan csv baru) <br>
                    2. save new book barusan hasil copyan dengan format csv <br>
                    3. selesai
                    
                </div>

                <div class="card mb-3">
                <form action="proses_upload_bni.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                    <label for="id-date-range-picker-1">Silahkan Pilih File Rekening Koran BNI *.CSV</label>
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