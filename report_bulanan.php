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
        <li class="breadcrumb-item active">Report Closingan</li>
      </ol>
      <div class="row">
        <div class="col-12">
          <!-- <h1>Blank</h1>
          <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
          <div class="card mb-3">
              
            <div class="card-body">
            <label>Filter Berdasarkan Range Tanggal Awal sampai Tanggal Akhir 1 Bulan</label>
                <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                    <!-- <div class="input-group" style="width: 25%">
                        <input type="month" name="bulan" id="" class="form-control" value="<?php if (isset($_GET['bulan'])) echo $_GET['bulan'];?>">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div> -->
                    <input type="date" name="awal" id="" value="<?php if (isset($_GET['awal'])) echo $_GET['awal'];?>"> |
                    <input type="date" name="akhir" id="" value="<?php if (isset($_GET['akhir'])) echo $_GET['akhir'];?>">
                    <input type="submit" value="Filter">
                </form>
            
                </div>
              
          </div>

          <!-- content 2 -->
          <div class="card-mb-3">
              <ul>
                  <li><a href="export_excel_jmto_bulanan.php?awal=<?php echo $_GET['awal']?>&akhir=<?php echo $_GET['akhir'] ?>" target="_blank"><u>Generate Excel Untuk JMTO</u></a></li>
                  <li><a href="export_excel_bank.php?bulan=<?php echo $_GET['bulan']?>" target="_blank"><u>Generate Excel Untuk Semua Bank</u></a></li>
              </ul>
          </div>
          <!-- content 2 -->

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