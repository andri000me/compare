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
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
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

            <!-- disini data table -->

          <div class="card mb-3">
            <div class="card-header">
              <i class="fa  fa-filter"></i> Data Table</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Amount</th>
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
                      $dt = date('M', strtotime($get_data['tanggal_hpt'])); 
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
            </div>
            <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
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