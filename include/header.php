<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Compare System</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <!-- <link href="css/custom.css" rel="stylesheet"> -->

  <!-- datepicker disini -->
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-datepicker3.min.css" />
  <link rel="stylesheet" href="vendor/bootstrap/css/daterangepicker.min.css" />
  <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap-datetimepicker.min.css" />

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Compare System</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="dashboard.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <?php
        if($_SESSION['level'] == "admin")
        {
        ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa fa-cloud-upload"></i>
            <span class="nav-link-text">Upload Rekening Koran</span>
            
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="upload_bca.php">Bank BCA</a>
            </li>
            <li>
              <a href="upload_mandiri.php">Bank Mandiri</a>
            </li>
            <li>
              <a href="upload_bri.php">Bank BRI</a>
            </li>
            <li>
              <a href="upload_bni.php">Bank BNI</a>
            </li>
          </ul>
        </li>
        <?php 
        }
         ?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-folder-open"></i>
            <span class="nav-link-text">Rekening Koran</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="harian.php">Rekening Koran Harian</a>
            </li>
            <li>
              <a href="per_cut_off.php">Rekening Koran Per </br> Cut-Off</a>
            </li>
            <li>
              <a href="bulanan.php">Rekening Koran Bulanan</a>
            </li>
            <li>
              <a href="tahunan.php">Rekening Koran Tahunan</a>
            </li>
          </ul>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion" aria-expanded="false">
            <i class="fa fa-fw fa-file-text"></i>
            <span class="nav-link-text">Report Closingan</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="report_bulanan.php">Report Bulanan</a>
            </li>
            <li>
              <a href="#">Report Tahunan</a>
            </li>

          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="proses_backup_database.php">
            <i class="fa fa-fw fa-gears"></i>
            <span class="nav-link-text">Setup</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>