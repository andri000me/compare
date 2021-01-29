<?php
require "include/header.php";
include "koneksi.php";
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
              
                  <form method="get" action="<?php  echo $_SERVER['PHP_SELF'] ?>" > 
                      <div class="input-group" style="width: 30%">
                          <input type="date" name="tanggal" id="" class="form-control" value="<?php if (isset($_GET['tanggal'])) echo $_GET['tanggal'];?>">

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
                <!-- BCA -->
                <?php
                if(isset($_GET['tanggal'])) {
                    $tanggal = $_GET['tanggal'];

                    $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    $cr_bca = 0;
                    $hitung_data = mysqli_num_rows($query);
                    if($hitung_data > 0) {
                        $get_data = mysqli_fetch_assoc($query);
                        $cr_bca = $get_data['credit'];
                        if(count($get_data) > 0) {
                            echo "
                            <h6 class='card-title mb-1'>
                            BCA : ".number_format($cr_bca,0,',','.')."
                            </h6>
                            ";
                        }
                        
                    }
                    else {
                        echo "
                            <h6 class='card-title mb-1'>
                            BCA : 0
                            </h6>
                            ";
                    }

                }
                else {
                    ?>
                    <h6 class="card-title mb-1">
                    BCA : 
                    <?php 
                    }
                    ?>
                    </h6>
                <!-- MANDIRI -->
                
                <!-- awal bank mandiri -->
                <?php
				if(isset($_GET['tanggal'])) {
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
                    $sql = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM mandiri WHERE tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    $cr_mandiri  = 0;
                    $hitung_data = mysqli_num_rows($sql);
                    if($hitung_data > 0) {
                        $result = mysqli_fetch_assoc($sql);
                        $cr_mandiri = $result['credit'];
                        if(count($result) > 0) {
                            echo "
                            <h6 class='card-title mb-1'>
                            MANDIRI : ".number_format($result['credit'],0,',','.')."
                            </h6>
                            ";
                        }
                    }
                    else {
                        echo "
                        <h6 class='card-title mb-1'>
                        MANDIRI : 0
                        </h6>
                        ";
                    }
                    
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                MANDIRI : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank mandiri -->
                
                <!-- awal bank bri -->
                <?php
				if(isset($_GET['tanggal'])) {
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    
                    $cr_bri = 0;
                    $hitung_data = mysqli_num_rows($sql);
                    if($hitung_data > 0) {
                        $result = mysqli_fetch_assoc($sql);
                        $cr_bri = $result['credit'];
                        if(count($result) > 0) {
                            echo "
                            <h6 class='card-title mb-1'>
                            BRI : ".number_format($result['credit'],0,',','.')."
                            </h6>
                            ";
                        }
                    }
                    else {
                        echo "
                        <h6 class='card-title mb-1'>
                        BRI : 0
                        </h6>
                        ";
                    }
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                BRI : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank bri -->
                
                <!-- awal bank bni -->
                <?php
				if(isset($_GET['tanggal'])) {
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
                    $sql = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    
                    $cr_bni = 0;
                    $hitung_data = mysqli_num_rows($sql);
                    if($hitung_data > 0) {
                        $result = mysqli_fetch_assoc($sql);
                        $cr_bni = $result['credit'];
                        if(count($result) > 0) {
                            echo "
                            <h6 class='card-title mb-1'>
                            BNI : ".number_format($result['credit'],0,',','.')."
                            </h6>
                            ";
                        }
                    }
                    else {
                        echo "
                        <h6 class='card-title mb-1'>
                        BNI : 0
                        </h6>
                        ";
                    }
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                BNI : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank bni -->

                <!-- awal total -->
                <?php
				if(isset($_GET['tanggal'])) {
					$grand_total = $cr_bca + $cr_mandiri + $cr_bri + $cr_bni;
                    echo "
                    <h6 class='card-title mb-1'>
                    TOTAL : ".number_format($grand_total,0,',','.')."
                    </h6>
                    ";
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                TOTAL : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir total -->

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