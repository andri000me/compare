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
        <li class="breadcrumb-item active"> Rekening Koran tanggal</li>
    </ol>
    <div class="row">
        <div class="col-12">
        <!-- <h1>Blank</h1>
        <p>This is an example of a blank page that you can use as a starting point for creating new ones.</p> -->
        <div class="card mb-3">

            <!-- form filter berdasarkan tahun -->
            <div class="card-body">
            
                <form method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return validasi_input(this)"> 
                    <div class="input-group" style="width: 30%">
                        <input type="date" name="tanggal" id="" class="form-control" value="<?php if (isset($_GET['tanggal'])) echo $_GET['tanggal'];?>">

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
				if(isset($_GET['tanggal'])) {
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%JEMPUTAN%' AND keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%LAINNYA%' AND tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
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
                <?php
				if(isset($_GET['tanggal'])) {
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM mandiri WHERE tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr_mandiri = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK MANDIRI : ".number_format($cr_mandiri,0,',','.')."
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
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr_bri = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BRI : ".number_format($cr_bri,0,',','.')."
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
					$tanggal = $_GET['tanggal'];
					// $dt=date('Ym',strtotime($bulan));
					
					$sql = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt = '$tanggal' GROUP BY tanggal_hpt ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr_bni = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BNI : ".number_format($cr_bni,0,',','.')."
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
            <!-- 
                javascript validasi
                jika user tidak memilih bulan (langsung klik tombol Ubah Tangga),maka keluarkan peringatan
                referensi: https://dokumenary.wordpress.com/2011/11/01/java-script-untuk-validasi-form-input/
            -->
            <script type="text/javascript">
                function validasi_input(form){
                if (form.tanggal.value == ""){
                    alert("Tanggal belum dipilih!");
                    form.tanggal.focus();
                    return (false);
                }
                return (true);
                }
            </script>
            
        </div>

        <!-- ROW 3 -->
        <!-- DETAIL tanggal BANK BCA -->
        <p>
            <a style="width: 100%" class="btn btn-primary collapsed" data-toggle="collapse" href="#bca" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK BCA
            </a>
        </p>
        <div class="collapse" id="bca">
            <div class="card card-body">
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
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
        </div>

        <br>

        <!-- ROW 4 -->
        <!-- DETAIL tanggal BANK MANDIRI -->
        <p>
            <a style="width: 100%" class="btn btn-primary" data-toggle="collapse" href="#mandiri" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK MANDIRI
            </a>
        </p>
        <div class="collapse" id="mandiri">
            <div class="card card-body">
            <!-- tab content induk -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#mandiri-kalijati" role="tab" aria-controls="nav-home" aria-selected="true">Kalijati</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#mandiri-subang" role="tab" aria-controls="nav-profile" aria-selected="false">Subang</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-cikedung" role="tab" aria-controls="nav-contact" aria-selected="false">Cikedung</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-kertajati" role="tab" aria-controls="nav-contact" aria-selected="false">Kertajati</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-sumberjaya" role="tab" aria-controls="nav-contact" aria-selected="false">Sumberjaya</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-palimanan" role="tab" aria-controls="nav-contact" aria-selected="false">Palimanan</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-cikampek" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-cikampek-utama" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek Utama</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#mandiri-total" role="tab" aria-controls="nav-contact" aria-selected="false">Total</a>
                </div>
            </nav>
            <!-- tab content anak -->
            <div class="tab-content" id="nav-tabContent">
                <!-- kalijati -->
                <div class="tab-pane fade show active" id="mandiri-kalijati" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KalijatiMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '4909'  GROUP BY tanggal_hpt  ");
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
                <div class="tab-pane fade" id="mandiri-subang" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SubangMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '4908'  GROUP BY tanggal_hpt ");
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
                <div class="tab-pane fade" id="mandiri-cikedung" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikedungMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '4907'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="mandiri-kertajati" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KertajatiMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '4906'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="mandiri-sumberjaya" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SumberjayaMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '4905'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="mandiri-palimanan" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2PalimananMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '4904'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="mandiri-cikampek" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1420'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="mandiri-cikampek-utama" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekUtamaMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1437'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="mandiri-total" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2TotalMandiri" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM MANDIRI WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' GROUP BY tanggal_hpt");
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
        </div>

        <br>

        <!-- ROW 5 -->
        <!-- DETAIL tanggal BANK BRI -->
        <p>
            <a style="width: 100%" class="btn btn-primary" data-toggle="collapse" href="#bri" role="button" aria-expanded="false" aria-controls="collapseExample">
            DETAIL HARIAN BANK BRI
            </a>
        </p>
        <div class="collapse" id="bri">
        <div class="card card-body">
            <!-- tab content induk -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#bri-kalijati" role="tab" aria-controls="nav-home" aria-selected="true">Kalijati</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#bri-subang" role="tab" aria-controls="nav-profile" aria-selected="false">Subang</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-cikedung" role="tab" aria-controls="nav-contact" aria-selected="false">Cikedung</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-kertajati" role="tab" aria-controls="nav-contact" aria-selected="false">Kertajati</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-sumberjaya" role="tab" aria-controls="nav-contact" aria-selected="false">Sumberjaya</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-palimanan" role="tab" aria-controls="nav-contact" aria-selected="false">Palimanan</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-cikampek" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-cikampek-utama" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek Utama</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bri-total" role="tab" aria-controls="nav-contact" aria-selected="false">Total</a>
                </div>
            </nav>
            <!-- tab content anak -->
            <div class="tab-content" id="nav-tabContent">
                <!-- kalijati -->
                <div class="tab-pane fade show active" id="bri-kalijati" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KalijatiBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1984600000'  GROUP BY tanggal_hpt  ");
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
                <div class="tab-pane fade" id="bri-subang" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SubangBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1984600001'  GROUP BY tanggal_hpt ");
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
                <div class="tab-pane fade" id="bri-cikedung" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikedungBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1984600002'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bri-kertajati" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KertajatiBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1984600003'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bri-sumberjaya" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SumberjayaBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1984600004'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bri-palimanan" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2PalimananBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1984600005'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bri-cikampek" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1929570116'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bri-cikampek-utama" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekUtamaBRI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '1929570262'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bri-total" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2TotalTotal" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bri WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' GROUP BY tanggal_hpt");
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
        </div>

        <br>

        <!-- ROW 6 -->
        <!-- DETAIL tanggal BANK BNI -->
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
            <!-- tab content induk -->
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#bni-kalijati" role="tab" aria-controls="nav-home" aria-selected="true">Kalijati</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#bni-subang" role="tab" aria-controls="nav-profile" aria-selected="false">Subang</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-cikedung" role="tab" aria-controls="nav-contact" aria-selected="false">Cikedung</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-kertajati" role="tab" aria-controls="nav-contact" aria-selected="false">Kertajati</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-sumberjaya" role="tab" aria-controls="nav-contact" aria-selected="false">Sumberjaya</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-palimanan" role="tab" aria-controls="nav-contact" aria-selected="false">Palimanan</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-cikampek" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-cikampek-utama" role="tab" aria-controls="nav-contact" aria-selected="false">Cikampek Utama</a>
                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#bni-total" role="tab" aria-controls="nav-contact" aria-selected="false">Total</a>
                </div>
            </nav>
            <!-- tab content anak -->
            <div class="tab-content" id="nav-tabContent">
                <!-- kalijati -->
                <div class="tab-pane fade show active" id="bni-kalijati" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KalijatiBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '500105'  GROUP BY tanggal_hpt  ");
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
                <div class="tab-pane fade" id="bni-subang" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SubangBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, " SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '500110'  GROUP BY tanggal_hpt ");
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
                <div class="tab-pane fade" id="bni-cikedung" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikedungBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '500115'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bni-kertajati" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2KertajatiBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '500120'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bni-sumberjaya" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2SumberjayaBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '500125'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bni-palimanan" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2PalimananBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang IN('500130','500100')  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bni-cikampek" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '301420'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bni-cikampek-utama" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2CikampekUtamaBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' AND kode_gerbang = '301426'  GROUP BY tanggal_hpt");
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
                <div class="tab-pane fade" id="bni-total" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2TotalTotalTotal" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Tanggal HPT</th>
                                <th>Amount</th>
                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                if(isset($_GET['tanggal'])) {
                                    $dt_input = $_GET['tanggal'];
                                    $dt_input_2 = date('Y-m-d', strtotime($dt_input));
                                    // deklar date agar selalu tanggal 1 awal bulan
                                    $dt_awal = date('Y-m-01', strtotime($dt_input_2)). "</br>";

                                    $query = mysqli_query($koneksi, "SELECT tanggal_hpt, SUM(credit) as credit FROM bni WHERE tanggal_hpt BETWEEN '$dt_awal' AND '$dt_input_2' GROUP BY tanggal_hpt");
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