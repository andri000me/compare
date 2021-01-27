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
        <li class="breadcrumb-item active">Bank BCA</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <!-- <h1>Blank</h1>
                <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
                
                <!-- alert perhatian disini -->
                <div class="alert alert-danger" role="alert">
                <i class="fa fa-info-circle"></i>
                    PERHATIAN!! <br>
                    File upload Rekening Koran ini untuk Bank BCA dengan format file CSV dari tarikan internet banking. <br>
                    Note: <br>
                    kondisi BCA upload: <br>
                    0. pastikan tanggal post date format d-m-Y (25/01/2021) <br>
                    1. pastikan jangan ada space kosong di headernya <br>
                    2. hapus rows: saldo awal sampai saldo akhir <br>
                    3. dikolom jumlah replace CR dengan kosong <br>
                    4. buat kolom baru di samping kolom saldo <br>
                    5. dikolom jumlah, ctrl+f cari DB, dan pindahkan data berisi DB ke kolom baru atau poin 3 <br>
                    6. selesai
                </div>

                <div class="card mb-3">
                <form action="proses_upload_bca.php" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                    <label for="id-date-range-picker-1">Silahkan Pilih File Rekening Koran BCA *.CSV</label>
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