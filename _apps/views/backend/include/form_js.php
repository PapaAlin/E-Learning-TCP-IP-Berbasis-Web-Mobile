    <!-- jQuery 2.1.4 -->
    <script src="<?=base_url()?>_assets/dist/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <!-- jQuery UI 1.12.1 -->
    <script src="<?=base_url()?>_assets/dist/plugins/jQueryUI/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?=base_url()?>_assets/dist/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?=base_url()?>_assets/dist/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="<?=base_url()?>_assets/dist/plugins/select2/select2.full.min.js" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="<?=base_url()?>_assets/dist/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?=base_url()?>_assets/dist/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?=base_url()?>_assets/dist/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="<?=base_url()?>_assets/dist/plugins/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?=base_url()?>_assets/dist/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    <script src="<?=base_url()?>_assets/dist/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
    <!-- bootstrap time picker -->
    <script src="<?=base_url()?>_assets/dist/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?=base_url()?>_assets/dist/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="<?=base_url()?>_assets/dist/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?=base_url()?>_assets/dist/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?=base_url()?>_assets/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?=base_url()?>_assets/dist/js/demo.js" type="text/javascript"></script>


    <!-- Custom Format Rupiah -->
    <script src="<?=base_url()?>_assets/_adm/js/custom-format-rupiah.js" type="text/javascript"></script>
    
    <!-- CK Editor 
    <script src="<?=base_url()?>_assets/dist/plugins/ckeditor/4.6.2/ckeditor.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 
    <script src="<?=base_url()?>_assets/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
    <!-- -->

    <script type="text/javascript">
      $(function () {

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
    
    <!-- TINYMCE Editor -->
    <script src="<?=base_url()?>_assets/dist/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script>
    tinymce.init({
      forced_root_block : 'p',
      selector: '#editortinymce',
      height: 500,
      theme: 'modern',
      protect: [
        /\<\/?(if|endif)\>/g,  // Protect <if> & </endif>
        /\<xsl\:[^>]+\>/g,  // Protect <xsl:...>
        /<\?php.*?\?>/g  // Protect php code
      ],
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
      ],
      toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar1: 'print preview media image code | forecolor backcolor emoticons | codesample',
      image_advtab: true,
      templates: [
        { title: 'Test template 1', content: 'Test 1' },
        { title: 'Test template 2', content: 'Test 2' }
      ],
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'
      ],  
      // enable title field in the Image dialog
      image_title: true, 
      // enable automatic uploads of images represented by blob or data URIs
      automatic_uploads: true,
      // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
      images_upload_url: '<?=base_url()?>adm/multipleupload/upload_file',
      // here we add custom filepicker only to Image dialog
      file_picker_types: 'image', 
      // and here's our custom image picker
      file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        
        // Note: In modern browsers input[type="file"] is functional without 
        // even adding it to the DOM, but that might not be the case in some older
        // or quirky browsers like IE, so you might want to add it to the DOM
        // just in case, and visually hide it. And do not forget do remove it
        // once you do not need it anymore.

        input.onchange = function() {
          var file = this.files[0];
          
          // Note: Now we need to register the blob in TinyMCEs image blob
          // registry. In the next release this part hopefully won't be
          // necessary, as we are looking to handle it internally.
          var id = 'blobid' + (new Date()).getTime();
          var blobCache = tinymce.activeEditor.editorUpload.blobCache;
          var blobInfo = blobCache.create(id, file);
          blobCache.add(blobInfo);
          
          // call the callback and populate the Title field with the file name
          cb(blobInfo.blobUri(), { title: file.name });
        };
        
        input.click();
      }
    });
    </script>

    <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                  },
                  startDate: moment().subtract(29, 'days'),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
    <script>
        
        /*
        $(window).on("beforeunload", function() {
            return "kamu Yakin Ingin Meninggalkan From ?";
        });
        */
        
        $(document).ready(function() {
            $("#form1").on("submit", function(e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
    </script>