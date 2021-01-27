<?php
require "include/header.php";
require "koneksi.php";
?>
<div class="content-wrapper">

    <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Rekening Koran</a>
        </li>
        <li class="breadcrumb-item active"> Rekening Koran Bulanan</li>
    </ol>
    <div class="row">
        <div class="col-12">
        <!-- <h1>Blank</h1>
        <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
        <div class="card mb-3">

            <!-- form filter berdasarkan bulan -->
            <div class="card-body">
            
                <form method="get" action="bulanan.php"> 
                    <div class="input-group date" id="">
                        <input type="month" name="tanggal" autocomplete="off" value="<?php if (isset($_GET['tanggal'])) echo $_GET['tanggal'];?>">
                        <button class="btn btn-primary" type="submit">Ubah Tanggal</button>
                    </div>
                </form>
            
            </div>
            
            <!-- totalan rekening koran per bank per bulan -->
            <div class="card-footer small text-muted">
                <h6 class="card-title mb-1">
                DATA REKENING KORAN
                </h6>

                <!-- awal bank bca -->
                <?php
				if(isset($_GET['tanggal'])) {
					$bulan = $_GET['tanggal'];
					$dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bca WHERE keterangan LIKE '%$dt%'");
                    $result = mysqli_fetch_assoc($sql);
                    $cr = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BCA : ".number_format($cr,0,',','.')."
                    </h6>
                    ";
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                BANK BCA : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank bca -->

                <!-- awal bank mandiri -->
                <?php
				if(isset($_GET['tanggal'])) {
					$bulan = $_GET['tanggal'];
					$dt=date('mY',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM mandiri WHERE description2 LIKE '%$dt%'");
                    $result = mysqli_fetch_assoc($sql);
                    $cr = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK MANDIRI : ".number_format($cr,0,',','.')."
                    </h6>
                    ";
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                BANK MANDIRI : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank mandiri -->
                
                <!-- awal bank bri -->
                <?php
				if(isset($_GET['tanggal'])) {
					$bulan = $_GET['tanggal'];
					$dt=date('my',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bri WHERE description1 LIKE '%$dt%' ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BRI : ".number_format($cr,0,',','.')."
                    </h6>
                    ";
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                BANK BRI : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank bri -->
                
                <!-- awal bank bni -->
                <?php
				if(isset($_GET['tanggal'])) {
					$bulan = $_GET['tanggal'];
					$dt=date('m',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE MONTH(tanggal_hpt)='$dt' ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BNI : ".number_format($cr,0,',','.')."
                    </h6>
                    ";
					
                }
                else {
                ?>
                <h6 class="card-title mb-1">
                BANK BNI : 
                <?php 
                }
                ?>
                </h6>
                <!-- akhir bank bni -->
            </div>
            
        </div>

        <!-- ROW 3 -->
        <!-- DETAIL HARIAN BANK BCA -->
        <p>
            <a style="width: 100%" class="btn btn-primary collapsed" data-toggle="collapse" href="#bca" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL BULANAN PER BANK
            </a>
            <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-target
            </button> -->
        </p>
        <div class="collapse show" id="bca">
            <!-- <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div> -->
            <!-- tab content induk -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#MANDIRI" role="tab" aria-controls="nav-home" aria-selected="true">Bank MANDIRI</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#BRI" role="tab" aria-controls="nav-profile" aria-selected="false">Bank BRI</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#BNI" role="tab" aria-controls="nav-contact" aria-selected="false">BANK BNI</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#BCA" role="tab" aria-controls="nav-contact" aria-selected="false">BANK BCA</a>
                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#TOTAL" role="tab" aria-controls="nav-contact" aria-selected="false">TOTAL</a>
                    
                </div>
            </nav>
            <!-- tab content anak -->
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="MANDIRI" role="tabpanel" aria-labelledby="nav-home-tab">
                <!-- tab content bank mandiri disini -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTableMandiriBulanan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Gerbang</th>
                                <th>Rekening Koran (RC)</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>
                                <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!-- get data per gerbang dari database -->
                            <tr>
                                <td>Palimanan</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='4904' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Sumberjaya</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='4905' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Cikedung</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='4907' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Subang</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='4908' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Kalijati</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='4909' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Cikampek Utama</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='1437' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Cikampek</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='1420' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Kertajati</td>
                                <td>
                                    <?php
                                    /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                    // jika filter pencarian dipilih
                                    if(isset($_GET['tanggal'])) {
                                        $bulan = $_GET['tanggal'];
                                        $dt=date('m',strtotime($bulan));
                                        $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM mandiri WHERE kode_gerbang='4906' AND MONTH(tanggal_hpt)='$dt' ");

                                        $result = mysqli_fetch_assoc($query);
                                        $cr = $result['credit'];
                                        echo number_format($cr,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                        </tbody>
                        </table>
                    </div>
                </div>
                <!-- tab content bank mandiri disini -->
                </div>
                <div class="tab-pane fade" id="BRI" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <!-- ini bank bri -->
                    <!-- show datatablenya disini -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Gerbang</th>
                                    <th>Rekening Koran (RC)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- get data per gerbang dari database -->
                                <tr>
                                    <td>Palimanan</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1984600005' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sumberjaya</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1984600004' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Cikedung</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1984600002' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Subang</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1984600001' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Kalijati</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1984600000' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Cikampek Utama</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1929570262' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Cikampek</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1929570116' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Kertajati</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE kode_gerbang = '1984600003' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- show datatablenya disini -->
                </div>
                <div class="tab-pane fade" id="BNI" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <!-- ini bank bni -->
                    <!-- show datatablenya disini -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Gerbang</th>
                                    <th>Rekening Koran (RC)</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Gerbang</th>
                                    <th>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <!-- get data per gerbang dari database -->
                                <tr>
                                    <td>Palimanan</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang IN ('500130','500100') AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Sumberjaya</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang='500125' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Cikedung</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang='500115' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Subang</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang='500110' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Kalijati</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang='500105' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Cikampek Utama</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang = '301426' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Cikampek</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang='301420' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Kertajati</td>
                                    <td>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tanggal'])) {
                                            $bulan = $_GET['tanggal'];
                                            $dt=date('m',strtotime($bulan));
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE kode_gerbang='500120' AND MONTH(tanggal_hpt)='$dt' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr = $result['credit'];
                                            echo number_format($cr,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- show datatablenya disini -->
                </div>

                <!-- show datatable bank bca -->
                <div class="tab-pane fade" id="BCA" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <!-- show datatablenya disini -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableBca" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Gerbang</th>
                                        <th>Rekening Koran (RC)</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Gerbang</th>
                                        <th>
                                            <?php
                                            /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                            // jika filter pencarian dipilih
                                            if(isset($_GET['tanggal'])) {
                                                $bulan = $_GET['tanggal'];
                                                $dt=date('Ym',strtotime($bulan));
                                                $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bca WHERE keterangan like '%$dt%' ");

                                                $result = mysqli_fetch_assoc($query);
                                                $cr = $result['credit'];
                                                echo number_format($cr,0,',','.');
                                                
                                            }
                                            // selain itu tampilkan nilai 0
                                            else {
                                                echo "0";
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <!-- get data per gerbang dari database -->
                                    <tr>
                                        <td>Palimanan</td>
                                        <td>
                                            <?php
                                                /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('m',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang palimanan
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bca WHERE kode_gerbang = ' 885023100201' AND MONTH(tanggal_hpt)='$dt'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Sumberjaya</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang sumberjaya
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885023100200'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cikedung</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang cikedung
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885023100198'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subang</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang subang
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885023100197'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Kalijati</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885023100196'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cikampek Utama</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang cikampek utama
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885000803566'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cikampek</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang cikampek 
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885000500134'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                            </td>
                                    </tr>

                                    <tr>
                                        <td>Kertajati</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tanggal'])) {
                                                    // ambil inputan user 
                                                    $bulan = $_GET['tanggal'];
                                                    // konversi inputan ke format tanggal
                                                    $dt=date('Ym',strtotime($bulan));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kertajati 
                                                    $sql = mysqli_query($koneksi, "SELECT SUM(credit) AS credit FROM bca WHERE keterangan LIKE '%$dt%' AND kode_gerbang=' 885023100199'");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr = $result['credit'];
                                                    echo number_format($cr,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- show datatablenya disini -->
                </div>

                <!-- show datatable total -->
                <div class="tab-pane fade" id="TOTAL" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <!-- ini total -->
                    <!-- show datatablenya disini -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableBca" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Gerbang</th>
                                        <th>Rekening Koran (RC)</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Gerbang</th>
                                        <th>
                                            0
                                            
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <!-- get data per gerbang dari database -->
                                    <tr>
                                        <td>Palimanan</td>
                                        <td>
                                            1
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Sumberjaya</td>
                                        <td>
                                            2
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cikedung</td>
                                        <td>
                                            3
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subang</td>
                                        <td>
                                            4
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Kalijati</td>
                                        <td>
                                            5
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cikampek Utama</td>
                                        <td>
                                            6
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Cikampek</td>
                                        <td>
                                            7
                                            </td>
                                    </tr>

                                    <tr>
                                        <td>Kertajati</td>
                                        <td>
                                            8
                                        </td>
                                    </tr>

                                </tbody>
                                </table>
                            </div>
                        </div>
                    <!-- show datatablenya disini -->
                </div>
                
                <!-- <div class="tab-pane fade" id="bca-total" role="tabpanel" aria-labelledby="nav-contact-tab">ini total</div> -->
            </div>
            
        </div>

        <br>

        








        </div>
    </div>
    </div>
</div>
  <!-- wrapper sampai sini -->

<!-- footer -->
<?php
require "include/footer.php";
?>