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
        <li class="breadcrumb-item active">Filter Data Per Cut-Off Rekening Koran</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <!-- <h1>Blank</h1>
          <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
          <div class="card mb-3">
              
              <div class="card-body">
              <div class="row">
                <div class="col-xs-8 col-sm-6">
                <!-- form -->
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" onsubmit="return validasi_input(this)">
                    <label>Filter Berdasarkan Post Date Rekening Koran</label>
                    <div class="input-daterange input-group">
                    
                        <!-- input date awal -->
                        <input type="date" class="input-sm form-control" name="start" value="<?php if (isset($_GET['start'])) echo $_GET['start'];?>">
                        <span class="input-group-addon">
                            <i class="fa fa-exchange"></i>
                        </span>
                        <!-- input date akhir -->
                        <input type="date" class="input-sm form-control" name="end" value="<?php if (isset($_GET['end'])) echo $_GET['end'];?>">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    
                    </div>
                </form>
                </div>
                </div>
              </div>
              <!-- <hr class="my-0">
              <div class="card-body py-2 small">
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-thumbs-up"></i>Like</a>
                <a class="mr-3 d-inline-block" href="#">
                  <i class="fa fa-fw fa-comment"></i>Comment</a>
                <a class="d-inline-block" href="#">
                  <i class="fa fa-fw fa-share"></i>Share</a>
              </div>
              <div class="card-footer small text-muted">Posted 1 hr ago</div> -->
          </div>

          <!-- content 2 -->
          <!-- bank bca -->
          <p>
            <button style="width: 100%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#bca" aria-expanded="false" aria-controls="collapseExample">
              BANK BCA
            </button>
          </p>
          <div class="collapse" id="bca">
            <div class="card card-body">
              
              <!-- data -->
              <!-- <div class="card mb-3"> -->
                  <!-- <div class="card-header">
                      <i class="fa  fa-filter"></i> Data Table</div> -->
                  <!-- <div class="card-body"> -->
                      <div class="table-responsive">
                      <table class="table table-bordered" id="dataTableBCAcutoff" width="100%" cellspacing="0">
                          <thead>
                          <tr>
                              <th>Bulan</th>
                              <th>Nilai</th>
                          </tr>
                          </thead>
                          
                          <tbody>
                          <?php
                          include "koneksi.php";
                          if(isset($_GET['start'])) {
                              $start = $_GET['start'];
                              $end = $_GET['end'];
                              
                              $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_pd BETWEEN '$start' AND '$end' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' GROUP BY MONTH(tanggal_hpt)");
                              
                              while($get_data = mysqli_fetch_assoc($query)) {
                          
                          ?>
                          <tr>
                              <td>
                              <?php 
                              // $dt = date('M', strtotime($get_data['tanggal_hpt'])); 
                              $dt = date('M Y', strtotime($get_data['tanggal_hpt'])); 
                              echo $dt;
                              ?>
                              </td>
                              <td>
                              <?php 

                              echo number_format($get_data['credit'],0,',','.')
                              ?>
                              </td>
                              
                          </tr>
                          <?php
                              }
                          }
                          ?>
                          </tbody>

                          <tfoot>
                          <tr>
                          <th>Total</th>
                              <th>
                              <?php
                              if(isset($_GET['start'])) {
                              $query2 = mysqli_query($koneksi, "SELECT sum(credit) as credit FROM bca WHERE tanggal_pd BETWEEN '$start' AND '$end' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' GROUP BY MONTH(tanggal_hpt)");
                              $cr=0;
                              $cr2=0;
                              while ($num = mysqli_fetch_assoc($query2)) {
                                  $cr = $num['credit'];
                                  $hasil = floatval(preg_replace("/[^-0-9\.]/","",$cr));
                                  $cr2 += $hasil;
                                  
                              }
                              echo number_format($cr2,0,',','.');
                              // echo "Total : " .$formatAngka;
                              }
                              ?>
                              </th>
                          </tr>
                          </tfoot>
                      </table>
                      </div>
                  <!-- </div> -->
              <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
              <!-- </div> -->
              <!-- data -->

            </div>
          </div><br>

          <!-- bank mandiri -->
          <p>
            <button style="width: 100%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#mandiri" aria-expanded="false" aria-controls="collapseExample">
              BANK MANDIRI
            </button>
          </p>
          <div class="collapse" id="mandiri">
            <div class="card card-body">
              <!-- datatable nya bank mandiri disini -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTableMandiri" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    include "koneksi.php";
                    if(isset($_GET['start'])) {
                        $start = $_GET['start']; # 2021-01-18
                        $end = $_GET['end'];
                        $dt_start = date("d/m/y", strtotime($start));
                        $dt_end = date("d/m/y", strtotime($end));
                        
                        
                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) AS credit FROM mandiri WHERE date_pd BETWEEN '$dt_start' AND '$dt_end' AND description1 NOT LIKE '%Transfer%' AND description1 NOT LIKE '%Biaya%' GROUP BY MONTH(tanggal_hpt) ");
                        
                        while($get_data = mysqli_fetch_assoc($query)) {
                    
                    ?>
                    <tr>
                        <td>
                        <?php 
                        // $dt = date('M', strtotime($get_data['tanggal_hpt'])); 
                        $dt = date('M Y', strtotime($get_data['tanggal_hpt'])); 
                        echo $dt;
                        ?>
                        </td>
                        <td>
                        <?php 

                        echo number_format($get_data['credit'],0,',','.')
                        ?>
                        </td>
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>

                    <tfoot>
                    <tr>
                    <th>Total</th>
                        <th>
                        <?php
                        if(isset($_GET['start'])) {
                          $query2 = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) AS credit FROM mandiri WHERE date_pd BETWEEN '$dt_start' AND '$dt_end' AND description1 NOT LIKE '%Transfer%' AND description1 NOT LIKE '%Biaya%' GROUP BY MONTH(tanggal_hpt) ");
                        $cr=0;
                        $cr2=0;
                        while ($num = mysqli_fetch_assoc($query2)) {
                            $cr = $num['credit'];
                            $hasil = floatval(preg_replace("/[^-0-9\.]/","",$cr));
                            $cr2 += $hasil;
                            
                        }
                        echo number_format($cr2,0,',','.');
                        // echo "Total : " .$formatAngka;
                        }
                        ?>
                        </th>
                    </tr>
                    </tfoot>
                </table>
              </div>
              <!-- datatable nya bank mandiri disini -->
            </div>
          </div><br>

          <!-- bank bri -->
          <p>
            <button style="width: 100%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#bri" aria-expanded="false" aria-controls="collapseExample">
              BANK BRI
            </button>
          </p>
          <div class="collapse" id="bri">
            <div class="card card-body">
              <!-- datatable nya bank bri disini -->
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTableBRIcutoff" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    include "koneksi.php";
                    if(isset($_GET['start'])) {
                        $start = $_GET['start']; # 2021-01-18
                        $end = $_GET['end'];
                        $dt_start = date("d/m/y", strtotime($start));
                        $dt_end = date("d/m/y", strtotime($end));                        
                        
                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bri WHERE tanggal_pd BETWEEN '$dt_start' AND '$dt_end' AND description1 NOT LIKE '%NEWBRINETSWEB%' AND description1 NOT LIKE '%EMON%' AND description1 NOT LIKE '%Bunga%' AND description1 NOT LIKE '%pajak%' AND description1 NOT LIKE '%SETD%' GROUP BY MONTH(tanggal_hpt) ");
                        $n=0;
                        while($get_data = mysqli_fetch_assoc($query)) {
                    
                    ?>
                    <tr>
                        <td>
                        <?php 
                        // $dt = date('M', strtotime($get_data['tanggal_hpt'])); 
                        $dt = date('M Y', strtotime($get_data['tanggal_hpt'])); 
                        echo $dt;
                        ?>
                        </td>
                        <td>
                        <?php 
                        $total = $get_data['credit'];
                        echo $total1 = number_format($total,0,',','.')
                        ?>
                        </td>
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>

                    <tfoot>
                    <tr>
                    <th>Total</th>
                        <th>
                        <?php
                        if(isset($_GET['start'])) {
                            $query2 = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bri WHERE tanggal_pd BETWEEN '$dt_start' AND '$dt_end' AND description1 NOT LIKE '%NEWBRINETSWEB%' AND description1 NOT LIKE '%EMON%' AND description1 NOT LIKE '%Bunga%' AND description1 NOT LIKE '%pajak%' AND description1 NOT LIKE '%SETD%' GROUP BY MONTH(tanggal_hpt) ");
                            $cr=0;
                            $cr2=0;
                            while ($num = mysqli_fetch_assoc($query2)) {
                                $cr = $num['credit'];
                                $hasil = floatval(preg_replace("/[^-0-9\.]/","",$cr));
                                $cr2 += $hasil;
                                
                            }
                            echo number_format($cr2,0,',','.');
                            // echo "Total : " .$formatAngka;
                            }
                            ?>
                        </th>
                    </tr>
                    </tfoot>
                </table>
              </div>
              <!-- datatable nya bank bri disini -->
            </div>
          </div><br>

          <!-- bank bni -->
          <p>
            <button style="width: 100%;" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#bni" aria-expanded="false" aria-controls="collapseExample">
              BANK BNI
            </button>
          </p>
          <div class="collapse" id="bni">
            <div class="card card-body">
              <!-- datatable bank bni disini -->
              <div class="table-responsive">
              <table class="table table-bordered" id="dataTableBNI-cutoff" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Bulan</th>
                        <th>Nilai</th>
                    </tr>
                    </thead>
                    
                    <tbody>
                    <?php
                    include "koneksi.php";
                    if(isset($_GET['start'])) {
                        $start = $_GET['start']; # 2021-01-18
                        $end = $_GET['end'];
                        $dt_start = date("d/m/y", strtotime($start));
                        $dt_end = date("d/m/y", strtotime($end));
                        
                        
                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,sum(credit) as credit FROM bni WHERE tanggal_pd BETWEEN '$dt_start' AND '$dt_end' AND description1 NOT LIKE '%EDC%' AND description1 NOT LIKE '%PBY Manual%' AND description1 NOT LIKE '%RTGS%' GROUP BY MONTH(tanggal_hpt) ");
                        
                        while($get_data = mysqli_fetch_assoc($query)) {
                    
                    ?>
                    <tr>
                        <td>
                        <?php 
                        // $dt = date('M', strtotime($get_data['tanggal_hpt'])); 
                        $dt = date('M Y', strtotime($get_data['tanggal_hpt'])); 
                        echo $dt;
                        ?>
                        </td>
                        <td>
                        <?php 
                        // echo $get_data['credit'];
                        echo number_format($get_data['credit'],0,',','.')
                        ?>
                        </td>
                        
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    </tbody>

                    <tfoot>
                    <tr>
                    <th>Total</th>
                        <th>
                        <?php
                        if(isset($_GET['start'])) {
                        $query2 = mysqli_query($koneksi, "SELECT tanggal_hpt,sum(credit) as credit FROM bni WHERE tanggal_pd BETWEEN '$dt_start' AND '$dt_end' AND description1 NOT LIKE '%EDC%' AND description1 NOT LIKE '%PBY Manual%' AND description1 NOT LIKE '%RTGS%' GROUP BY MONTH(tanggal_hpt) ");
                        $cr=0;
                        $cr2=0;
                        while ($num = mysqli_fetch_assoc($query2)) {
                            $cr = $num['credit'];
                            $hasil = floatval(preg_replace("/[^-0-9\.]/","",$cr));
                            $cr2 += $hasil;
                            
                        }
                        echo number_format($cr2,0,',','.');
                        // echo "Total : " .$formatAngka;
                        }
                        ?>
                        </th>
                    </tr>
                    </tfoot>
                </table>
              </div>

              <!-- datatable bank bni disini -->
            </div>
          </div><br>
          <!-- akhir content 2 -->
          
          <!-- datatable disini -->
          
          <!-- datatable sampai sini -->

        </div>
      </div>

     <!-- 
          javascript validasi
          jika user tidak memilih bulan (langsung klik tombol Ubah Tangga),maka keluarkan peringatan
          referensi: https://dokumenary.wordpress.com/2011/11/01/java-script-untuk-validasi-form-input/
      -->
      <script type="text/javascript">
          function validasi_input(form){
            if (form.start.value == ""){
                alert("Tanggal awal dan tanggal akhir belum dipilih!");
                form.start.focus();
                return (false);
            }
            else if(form.start.value == "" || form.end.value == "") {
              alert("Pastikan tanggal akhir telah dipilih!");
                form.start.focus();
                form.end.focus();
                return (false);
            }
            return (true);
          }
      </script>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

<!-- footer -->
<?php
require "include/footer.php";
?>