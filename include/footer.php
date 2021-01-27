<footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <!-- <small>© Ujang Sopiyan 2021 | v.1.1.1</small> -->
          <style>.heart{color:#e25555;}</style>
          Made with 
          <span class="heart">❤</span> in Subang | V.1.1.1


        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Silahkan pilih "Logout" di bawah ini jika Anda ingin keluar.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script> -->
    <script src="vendor/jquery/jquery-2.1.4.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>

    <!-- link js date picker disini -->
    <script src="vendor/bootstrap/js/bootstrap-datepicker.min.js"></script>
    <script src="vendor/bootstrap/js/moment.min.js"></script>
    <script src="vendor/bootstrap/js/daterangepicker.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript">
			jQuery(function($) {
        // date rang picker
        // $('.input-daterange').datepicker({
        //   autoclose:true,
        //   /* untuk penanda tanggal hari ini (date now) */
        //   todayHighlight: true,
        //   dateFormat: "yy-mm-dd"
        // });

        // $('.date-picker').datepicker({
        //   // format: 'dd-mm-yyyy',
				// 	autoclose: true,
				// 	todayHighlight: true
        // });

        // datatable bca
        $('#dataTableBca').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTableMandiri').DataTable({
          "bPaginate": false,
          "ordering": false,
          // "info":     false
        });

        $('#dataTableBCAcutoff').DataTable({
          "bPaginate": false,
          "ordering": false,
          "info":     false
        });
        
        $('#dataTableBNI-cutoff').DataTable({
          "bPaginate": false,
          "ordering": false,
          // "info":     false
        });
        
        $('#dataTableMandiriBulanan').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTableBNIcutoff').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTableBNI').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTableBRIcutoff').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTableBRI').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTableGrandTotal').DataTable({
          "bPaginate": false,
          // "ordering": false,
          // "info":     false
        });
        
        $('#dataTable2').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SubangBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikedungBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KertajatiBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SumberjayaBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2PalimananBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekUtamaBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2TotalBCA').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KalijatiMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SubangMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikedungMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KertajatiMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SumberjayaMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2PalimananMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekUtamaMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2TotalMandiri').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KalijatiBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SubangBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikedungBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KertajatiBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SumberjayaBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2PalimananBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekUtamaBRI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2TotalTotal').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KalijatiBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SubangBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikedungBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2KertajatiBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2SumberjayaBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2PalimananBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2CikampekUtamaBNI').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });
        
        $('#dataTable2TotalTotalTotal').DataTable({
          "bPaginate": true,
          "ordering": false,
          "pageLength":5,
          "lengthMenu": [5,10,25,50],
          // "info":     false
        });



      });
      
      // var value = $(".input-daterange").datepicker("getDate");
    </script>
  </div>
</body>

</html>
