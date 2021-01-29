<?php
require "include/header.php";
?>

  <div class="content-wrapper">
  <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <!-- <li class="breadcrumb-item">
          <a href="index.html">Dashboard</a>
        </li> -->
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>

      <div class="row">
        <div class="col-12">
          <!-- <h1>Blank</h1>
          <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
          <div class="card mb-3">

              <!-- form filter berdasarkan tahun -->
              <div class="card-body">
              
                  <form method="get" action="/compare/harian.php" onsubmit="return validasi_input(this)"> 
                      <div class="input-group" style="width: 30%">
                          <input type="date" name="tanggal" id="" class="form-control" value="">

                          <div class="input-group-btn">
                              <button type="submit" class="btn btn-primary">Ubah Tanggal</button>
                          </div>
                      </div>
                  </form>
              
              </div>
              
              
          </div>

          
        
        </div>
        <!-- matriks -->
        <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-header">
                <!-- <i class="fa fa-bell-o"></i>Matrik -->
                MATRIK
              </div>
              <div class="card-body">
                      <h6 class="card-title mb-1">BCA :</h6>
                      <h6 class="card-title mb-1">MANDIRI :</h6>
                      <h6 class="card-title mb-1">BRI :</h6>
                      <h6 class="card-title mb-1">BNI :</h6>
                      <h6 class="card-title mb-1">TOTAL :</h6>
              </div>
            </div>

        </div>

        <!-- rek koran -->
        <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-header">
                <!-- <i class="fa fa-bell-o"></i>Matrik -->
                REKENING KORAN
              </div>
              <div class="card-body">
                <h6 class="card-title mb-1">BCA :</h6>
                <h6 class="card-title mb-1">MANDIRI :</h6>
                <h6 class="card-title mb-1">BRI :</h6>
                <h6 class="card-title mb-1">BNI :</h6>
                <h6 class="card-title mb-1">TOTAL :</h6>
              </div>
            </div>

        </div>

        <!-- selisih=matrik-rek koran -->
        <div class="col-lg-4">
            <div class="card mb-3">
              <div class="card-header">
                <!-- <i class="fa fa-bell-o"></i>Matrik -->
                SELISIH (MATRIK - REKENING KORAN)
              </div>
              <div class="card-body">
                <h6 class="card-title mb-1">BCA :</h6>
                <h6 class="card-title mb-1">MANDIRI :</h6>
                <h6 class="card-title mb-1">BRI :</h6>
                <h6 class="card-title mb-1">BNI :</h6>
                <h6 class="card-title mb-1">TOTAL :</h6>
              </div>
            </div>

        </div>

        </div>
        
        </div>
  </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

<!-- footer -->
<?php
require "include/footer.php";
?>