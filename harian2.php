<?php
require "include/header.php";
include "koneksi.php";
?>
<div class="content-wrapper">

    <div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
        <a href="#">Rekening Koran</a>
        </li>
        <li class="breadcrumb-item active"> Rekening Koran Harian</li>
    </ol>
    <div class="row">
        <div class="col-12">
        <!-- <h1>Blank</h1>
        <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
        <div class="card mb-3">

            <!-- form filter berdasarkan tahun -->
            <div class="card-body">
            
                <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>"> 
                    <div class="input-group" style="width: 30%">
                        <input type="date" name="harian" id="" class="form-control" value="<?php if (isset($_GET['harian'])) echo $_GET['harian'];?>">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Ubah Tanggal</button>
                        </div>
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
				if(isset($_GET['harian'])) {
					$harian = $_GET['harian'];
					// $dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND tanggal_hpt = '$harian' GROUP BY tanggal_hpt ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr_bca = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BCA : ".number_format($cr_bca,0,',','.')."
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
                <h6 class="card-title mb-1">
                BANK MANDIRI : 
                </h6>
                <!-- akhir bank mandiri -->
                
                <!-- awal bank bri -->
                <h6 class="card-title mb-1">
                BANK BRI : 
                </h6>
                <!-- akhir bank bri -->
                
                <!-- awal bank bni -->
                <h6 class="card-title mb-1">
                BANK BNI : 
                </h6>
                <!-- akhir bank bni -->

                <!-- awal total -->
                <h6 class="card-title mb-1">
                TOTAL : 
                </h6>
                <!-- akhir total -->

            </div>
            
        </div>

        <!-- ROW 3 -->
        <!-- DETAIL HARIAN BANK BCA -->
        <p>
            <a style="width: 100%" class="btn btn-primary collapsed" data-toggle="collapse" href="#bca" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK BCA
            </a>
            <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-target
            </button> -->
        </p>
        <div class="collapse" id="bca">
            <!-- <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div> -->
            <!-- tab content induk -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#bca-kalijati" role="tab" aria-controls="nav-home" aria-selected="true">Kalijati</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#bca-subang" role="tab" aria-controls="nav-profile" aria-selected="false">Subang</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-cikedung" role="tab" aria-controls="nav-contact" aria-selected="false">Cikedung</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-kertajati" role="tab" aria-controls="nav-contact" aria-selected="false">Kertajati</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-sumberjaya" role="tab" aria-controls="nav-contact" aria-selected="false">Sumberjaya</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-palimanan" role="tab" aria-controls="nav-contact" aria-selected="false">Palimanan</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-cikampek" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-cikampek-utama" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek Utama</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bca-total" role="tab" aria-controls="nav-contact" aria-selected="false">Total</a>
                </div>
            </nav>
            <!-- tab content anak -->
            <div class="tab-content" id="nav-tabContent">
                <!-- kalijati -->
                <div class="tab-pane fade show active" id="bca-kalijati" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885023100196'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr_kalijati_bca2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr_kalijati_bca = $result['credit'];
                                    $cr_kalijati_bca2 += $cr_kalijati_bca;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr_kalijati_bca,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr_kalijati_bca2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- subang -->
                <div class="tab-pane fade" id="bca-subang" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SubangBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885023100197'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- cikedung -->
                <div class="tab-pane fade" id="bca-cikedung" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikedungBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885023100198'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- kertajati -->
                <div class="tab-pane fade" id="bca-kertajati" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KertajatiBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885023100199'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- sumberjaya -->
                <div class="tab-pane fade" id="bca-sumberjaya" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SumberjayaBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885023100200'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div> 
                </div>
                <!-- palimanan -->
                <div class="tab-pane fade" id="bca-palimanan" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2PalimananBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885023100201'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div> 
                </div>
                <!-- cikampek -->
                <div class="tab-pane fade" id="bca-cikampek" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885000500134'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- cikampek utama -->
                <div class="tab-pane fade" id="bca-cikampek-utama" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekUtamaBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND kode_gerbang = ' 885000803566'
                                    GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- totalan -->
                <div class="tab-pane fade" id="bca-total" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2TotalBCA" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['harian'])) {
                                    $dt_input = $_GET['harian'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt,SUM(credit) as credit FROM bca WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' GROUP BY tanggal_hpt");
                                // // selain itu tampilkan nilai 0
                                // else {
                                //     echo "0";
                                // }
                                $cr2 = 0;
                                while ($result = mysqli_fetch_assoc($query)) {
                                    $cr = $result['credit'];
                                    $cr2 += $cr;
                                    // echo number_format($cr,0,',','.');
                                ?>
                                <tr>
                                    <td><?php echo $result['tanggal_hpt']; ?></td>
                                    <td><?php echo number_format($cr,0,',','.'); ?></td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>Total</th>
                                <th><?php echo number_format($cr2,0,',','.');?></th>
                                </tr>
                            </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <br>

        <!-- ROW 4 -->
        <!-- DETAIL HARIAN BANK MANDIRI -->
        <p>
            <a style="width: 100%" class="btn btn-primary" data-toggle="collapse" href="#mandiri" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK MANDIRI
            </a>
            <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-target
            </button> -->
        </p>
        <div class="collapse" id="mandiri">
            <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>

        <br>

        <!-- ROW 5 -->
        <!-- DETAIL HARIAN BANK BRI -->
        <p>
            <a style="width: 100%" class="btn btn-primary" data-toggle="collapse" href="#bri" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK BRI
            </a>
            <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-target
            </button> -->
        </p>
        <div class="collapse" id="bri">
            <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
            </div>
        </div>

        <br>

        <!-- ROW 6 -->
        <!-- DETAIL HARIAN BANK BNI -->
        <p>
            <a style="width: 100%" class="btn btn-primary" data-toggle="collapse" href="#bni" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK BNI
            </a>
            <!-- <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Button with data-target
            </button> -->
        </p>
        <div class="collapse" id="bni">
            <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
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