    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url()?>_assets/dist/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url()?>_assets/dist/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="<?=base_url()?>_assets/dist/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>_assets/dist/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?=base_url()?>_assets/dist/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="<?=base_url()?>_assets/dist/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>_assets/dist/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>_assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=base_url()?>_assets/dist/js/demo.js" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });

        $('#datepicker').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });

        $('#datepicker2').datepicker({
          format: 'yyyy-mm-dd',
          autoclose: true
        });
      });
    </script>