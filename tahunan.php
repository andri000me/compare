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
        <li class="breadcrumb-item active"> Rekening Koran Tahunan</li>
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
                        <select class="form-control" id="sel1" name="tahun">
                            <option value="">----</option>
                            <option value="2020" <?= @$_GET['tahun'] == '2020' ? 'selected="selected"' : ''?> >2020</option>
                            <option value="2021" <?= @$_GET['tahun'] == '2021' ? 'selected="selected"' : ''?> >2021</option>
                        </select>

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary">Ubah Tahun</button>
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
				if(isset($_GET['tahun'])) {
					$select_tahun = $_GET['tahun'];
					// $dt=date('Y',strtotime($select_tahun));
					
					$sql = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND YEAR(tanggal_hpt)='$select_tahun' ");
                    $result = mysqli_fetch_assoc($sql);
                    $cr_bca = $result['credit'];
                    // echo number_format($cr,0,',','.');
                    echo "
                    <h6 class='card-title mb-1'>
                    BANK BCA : ".number_format($cr_bca,0,',','.')."
                    </h6>
                    ";
					
                }
                elseif(!empty($_GET['tahun'])) {
                    echo "Silahkan pilih tahun!";
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
				if(isset($_GET['tahun'])) {
					$select_tahun = $_GET['tahun'];
					// $dt=date('mY',strtotime($tahun));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' ");
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
				if(isset($_GET['tahun'])) {
					$select_tahun = $_GET['tahun'];
					// $dt=date('my',strtotime($tahun));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$select_tahun' ");
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
				if(isset($_GET['tahun'])) {
					$select_tahun = $_GET['tahun'];
					// $dt=date('m',strtotime($tahun));
					
					$sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$select_tahun' ");
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
				if(isset($_GET['tahun'])) {
					$grand_total = $cr_bca + $cr_mandiri + $cr_bri + $cr_bni;
                    echo "
                    <h6 class='card-title mb-1'>
                    TOTAL : <strong>".number_format($grand_total,0,',','.')."</strong>
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
                if (form.tahun.value == ""){
                    alert("Tahun belum dipilih!");
                    form.tahun.focus();
                    return (false);
                }
                return (true);
                }
            </script>
            
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
                        
                        <tbody>
                            <!-- get data per gerbang dari database -->
                            <tr>
                                <td>Palimanan</td>
                                <td>
                                    <?php
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4904'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_palimanan_mandiri = $result['credit'];
                                        echo number_format($cr_palimanan_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4905'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_sumberjaya_mandiri = $result['credit'];
                                        echo number_format($cr_sumberjaya_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4907'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_cikedung_mandiri = $result['credit'];
                                        echo number_format($cr_cikedung_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4908'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_subang_mandiri = $result['credit'];
                                        echo number_format($cr_subang_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4909'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_kalijati_mandiri = $result['credit'];
                                        echo number_format($cr_kalijati_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '1437'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_cikampek_utama_mandiri = $result['credit'];
                                        echo number_format($cr_cikampek_utama_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '1420'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_cikampek_mandiri = $result['credit'];
                                        echo number_format($cr_cikampek_mandiri,0,',','.');
                                        
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
                                    if(isset($_GET['tahun'])) {
                                        $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4906'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_kertajati_mandiri = $result['credit'];
                                        echo number_format($cr_kertajati_mandiri,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </td>
                            </tr>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>
                                    <?php
                                    if(isset($_GET['tahun'])) {
                                        /* $select_tahun = $_GET['tahun'];
                                        
                                        $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM mandiri WHERE YEAR(tanggal_hpt)='$select_tahun' AND kode_gerbang = '4906'");

                                        $result = mysqli_fetch_assoc($sql);
                                        $cr_kertajati_mandiri = $result['credit']; */
                                        $total_mandiri = $cr_kalijati_mandiri+$cr_subang_mandiri+$cr_cikedung_mandiri+$cr_kertajati_mandiri+$cr_sumberjaya_mandiri+$cr_palimanan_mandiri+$cr_cikampek_mandiri+$cr_cikampek_utama_mandiri;
                                        echo number_format($total_mandiri,0,',','.');
                                        
                                    }
                                    // selain itu tampilkan nilai 0
                                    else {
                                        echo "0";
                                    }
                                    ?>
                                </th>
                            </tr>
                        </tfoot>
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
                            
                            <tbody>
                                <!-- get data per gerbang dari database -->
                                <tr>
                                    <td>Palimanan</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1984600005' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_palimanan_bri = $result['credit'];
                                            echo number_format($cr_palimanan_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1984600004' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_sumberjaya_bri = $result['credit'];
                                            echo number_format($cr_sumberjaya_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1984600002' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_cikedung_bri = $result['credit'];
                                            echo number_format($cr_cikedung_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1984600001' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_subang_bri = $result['credit'];
                                            echo number_format($cr_subang_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1984600000' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_kalijati_bri = $result['credit'];
                                            echo number_format($cr_kalijati_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1929570262' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_cikampek_utama_bri = $result['credit'];
                                            echo number_format($cr_cikampek_utama_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1929570116' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_cikampek_bri = $result['credit'];
                                            echo number_format($cr_cikampek_bri,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, "SELECT SUM(credit) as credit FROM bri WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '1984600003' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_kertajati_bri = $result['credit'];
                                            echo number_format($cr_kertajati_bri,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>
                                        <?php
                                        if(isset($_GET['tahun'])) {
                                            $total_bri = $cr_kalijati_bri + $cr_subang_bri + $cr_cikedung_bri + $cr_kertajati_bri + $cr_sumberjaya_bri + $cr_palimanan_bri + $cr_cikampek_bri + $cr_cikampek_utama_bri;
                                            echo number_format($total_bri,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
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
                            
                            <tbody>
                                <!-- get data per gerbang dari database -->
                                <tr>
                                    <td>Palimanan</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang IN ('500130', '500100') ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_palimanan_bni = $result['credit'];
                                            echo number_format($cr_palimanan_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '500125' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_sumberjaya_bni = $result['credit'];
                                            echo number_format($cr_sumberjaya_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '500115' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_cikedung_bni = $result['credit'];
                                            echo number_format($cr_cikedung_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '500110' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_subang_bni = $result['credit'];
                                            echo number_format($cr_subang_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '500105' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_kalijati_bni = $result['credit'];
                                            echo number_format($cr_kalijati_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '301426' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_cikampek_utama_bni = $result['credit'];
                                            echo number_format($cr_cikampek_utama_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '301420' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_cikampek_bni = $result['credit'];
                                            echo number_format($cr_cikampek_bni,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $tahun = $_GET['tahun'];
                                            $query = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bni WHERE YEAR(tanggal_hpt)='$tahun' AND kode_gerbang = '500120' ");

                                            $result = mysqli_fetch_assoc($query);
                                            $cr_kertajati_bni = $result['credit'];
                                            echo number_format($cr_kertajati_bni,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>
                                        <?php
                                        /* note: untuk bca palimanan kode gerbang nyebrang palimanan dan sumberjaya dan palimanan c2 */
                                        // jika filter pencarian dipilih
                                        if(isset($_GET['tahun'])) {
                                            $total_bni = $cr_kalijati_bni + $cr_subang_bni + $cr_cikedung_bni + $cr_kertajati_bni + $cr_sumberjaya_bni + $cr_palimanan_bni + $cr_cikampek_bni + $cr_cikampek_utama_bni;
                                            echo number_format($total_bni,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
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
                                
                                <tbody>
                                    <!-- get data per gerbang dari database -->
                                    <tr>
                                        <td>Palimanan</td>
                                        <td>
                                            <?php
                                                // jika filter pencarian dipilih
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885023100201' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_palimanan_bca = $result['credit'];
                                                    echo number_format($cr_palimanan_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885023100200' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_sumberjaya_bca = $result['credit'];
                                                    echo number_format($cr_sumberjaya_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885023100198' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_cikedung_bca = $result['credit'];
                                                    echo number_format($cr_cikedung_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885023100197' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_subang_bca = $result['credit'];
                                                    echo number_format($cr_subang_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885023100196' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_kalijati_bca = $result['credit'];
                                                    echo number_format($cr_kalijati_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885000803566' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_cikampek_utama_bca = $result['credit'];
                                                    echo number_format($cr_cikampek_utama_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885000500134' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_cikampek_bca = $result['credit'];
                                                    echo number_format($cr_cikampek_bca,0,',','.');
                                                    
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
                                                if(isset($_GET['tahun'])) {
                                                    // ambil inputan user 
                                                    $tahun = $_GET['tahun'];
                                                    // konversi inputan ke format tanggal
                                                    // $dt=date('Y',strtotime($tahun));
                                                    // query mysql untuk menampilkan tanggal yang dipilih dan kode gerbang kalijati
                                                    $sql = mysqli_query($koneksi, " SELECT SUM(credit) as credit FROM bca WHERE keterangan NOT LIKE '%RTGS%' AND keterangan NOT LIKE '%JEMPUTAN%' AND kode_gerbang = ' 885023100199' AND YEAR(tanggal_hpt)='$tahun' ");
                                                    // bungkus query mysql untuk ditampilkan
                                                    $result = mysqli_fetch_assoc($sql);
                                                    // tampilkan data ke browser
                                                    $cr_kertajati_bca = $result['credit'];
                                                    echo number_format($cr_kertajati_bca,0,',','.');
                                                    
                                                }
                                                // selain itu tampilkan nilai 0
                                                else {
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th>
                                            <?php
                                            if(isset($_GET['tahun'])) {
                                                $total_bca = $cr_kalijati_bca + $cr_subang_bca + $cr_cikedung_bca + $cr_kertajati_bca + $cr_sumberjaya_bca + $cr_palimanan_bca + $cr_cikampek_bca + $cr_cikampek_utama_bca;
                                                echo number_format($total_bca,0,',','.');
                                                
                                            }
                                            // selain itu tampilkan nilai 0
                                            else {
                                                echo "0";
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div>
                    <!-- show datatablenya disini -->
                </div>

                <!-- show datatable total -->
                <div class="tab-pane fade" id="TOTAL" role="tabpanel" aria-labelledby="nav-contact-tab">
                <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTableBNI" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Gerbang</th>
                                    <th>Rekening Koran (RC)</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <!-- get data per gerbang dari database -->
                                <tr>
                                    <td>Palimanan</td>
                                    <td>
                                        <?php
                                        if(isset($_GET['tahun'])) {
                                            $total_palimanan = $cr_palimanan_mandiri+$cr_palimanan_bri+$cr_palimanan_bni+$cr_palimanan_bca;
                                            echo number_format($total_palimanan,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_sumberjaya = $cr_sumberjaya_mandiri+$cr_sumberjaya_bri+$cr_sumberjaya_bni+$cr_sumberjaya_bca;
                                            echo number_format($total_sumberjaya,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_cikedung = $cr_cikedung_mandiri+$cr_cikedung_bri+$cr_cikedung_bni+$cr_cikedung_bca;
                                            echo number_format($total_cikedung,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_subang = $cr_subang_mandiri+$cr_subang_bri+$cr_subang_bni+$cr_subang_bca;
                                            echo number_format($total_subang,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_kalijati =  $cr_kalijati_mandiri+$cr_kalijati_bri+$cr_kalijati_bni+$cr_kalijati_bca;
                                            echo number_format($total_kalijati,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_cikampek_utama = $cr_cikampek_utama_mandiri+$cr_cikampek_utama_bri+$cr_cikampek_utama_bni+$cr_cikampek_utama_bca;
                                            echo number_format($total_cikampek_utama,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_cikampek = $cr_cikampek_mandiri+$cr_cikampek_bri+$cr_cikampek_bni+$cr_cikampek_bca;
                                            echo number_format($total_cikampek,0,',','.');
                                            
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
                                        if(isset($_GET['tahun'])) {
                                            $total_kertajati = $cr_kertajati_mandiri+$cr_kertajati_bri+$cr_kertajati_bni+$cr_kertajati_bca;
                                            echo number_format($total_kertajati,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total</th>
                                    <th>
                                        <?php
                                        if(isset($_GET['tahun'])) {
                                            $select_tahun = $_GET['tahun'];
                                            $grandTotal = $total_kalijati+$total_subang+$total_cikedung+$total_kertajati+$total_sumberjaya+$total_palimanan+$total_cikampek+$total_cikampek_utama;
                                            echo number_format($grandTotal,0,',','.');
                                            
                                        }
                                        // selain itu tampilkan nilai 0
                                        else {
                                            echo "0";
                                        }
                                        ?>
                                    </th>
                                </tr>
                            </tfoot>
                            </table>
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