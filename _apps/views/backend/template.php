<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title><?=$page_title?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="<?=base_url()?>_images/<?=$this->Mainmodel->GetOptions('web_favicon')->option_value;?>"/>

    <?=$_template_css?>

  </head>
  <body class="skin-blue sidebar-mini"">
    
    <div class="wrapper" >
    
    <?=$_header?>

    <?=$_sidebar?>
    
    <?=$_content?>

    <?=$_footer?>

    <?=$_template_js?>

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

            /*
            $("#getmenusearch").autocomplete({
                source: "<?php echo base_url().'adm/menu/getmenu';?>",
                minLength:1,
            });
            */
        });
    </script>

    <script>

        function getKey(e) {
            if(window.event)
                return window.event.keyCode;
            else if (e)
                return e.which;
            else
                return null;
        }

        function restrictChars(e, validList) {
            var key, keyChar;
            key = getKey(e);
            if (key == null) return true;
                // get character - remove toLowerCase for case sensitive checking  
                keyChar = String.fromCharCode(key).toLowerCase();
            // check valid characters - remove toLowerCase for case sensitive checking  
            if (validList.toLowerCase().indexOf(keyChar) != -1)
                return true;
                // control keys  
            // null, backspace, tab, carriage return, escape  
            if ( key==0 || key==8 || key==9 || key==13 || key==27 )
                return true;
            // else return false  
            return false;
        }
        
        function numericOnly(e) {
            return restrictChars( e, "0123456789");
        }
        
        function alphanumericOnly(e) {
            return restrictChars( e, "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ_");
        }
    </script>

  </body>
</html>