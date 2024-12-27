<footer class="main-footer">
  © 2024 <strong>Wejeatrans</strong> | All Rights Reserved
</footer>

  
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->
<!-- Sweetalert2 -->
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "buttons": [
        {
          extend: 'copy', 
          exportOptions: {
            columns: ':not(.no-print)'  // Mengecualikan kolom aksi
          }
        },
        {
          extend: 'csv', 
          exportOptions: {
            columns: ':not(.no-print)'  // Mengecualikan kolom aksi
          }
        },
        {
          extend: 'excel', 
          exportOptions: {
            columns: ':not(.no-print)'  // Mengecualikan kolom aksi
          }
        },
        {
          extend: 'pdf', 
          exportOptions: {
            columns: ':not(.no-print)'  // Mengecualikan kolom aksi
          }
        },
        {
          extend: 'print',
          exportOptions: {
            columns: ':not(.no-print)'  // Mengecualikan kolom aksi
          }
        },
        'colvis'  // Tombol untuk visibilitas kolom
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  $(document).ready(function(){
    setInterval(function(){
        $('#report').load("banner.php", function() {
            // Pasang ulang event handler setelah konten dimuat
            $('a').off('click').on('click', function(e) {
                // Misalnya, bisa menambahkan logika klik di sini
                // Misalnya, prevent default jika perlu
                console.log("Link clicked!");
            });
        });
    }, 2000);  // Anda bisa menyesuaikan interval waktu
  });

  $(document).ready(function(){
    setInterval(function(){
        $('#statistik_penyewaan').load("statistik_penyewaan.php", function() {
            // Pasang ulang event handler setelah konten dimuat
            $('a').off('click').on('click', function(e) {
                // Misalnya, bisa menambahkan logika klik di sini
                // Misalnya, prevent default jika perlu
                console.log("Link clicked!");
            });
        });
    }, 2000);  // Anda bisa menyesuaikan interval waktu
  });
</script>