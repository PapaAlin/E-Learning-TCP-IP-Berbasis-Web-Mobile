<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- meta-tags -->
  <title><?=$page_title?></title>
  <meta name="description" content="">
  <meta name="author" content="nizaraluk">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/icon" href="<?=base_url()?>_images/<?=$this->Mainmodel->GetOptions('web_favicon')->option_value;?>"/>
  <script>
    addEventListener("load", function () {
      setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
      window.scrollTo(0, 1);
    }
  </script>
  <!-- //meta-tags -->
  <link href="<?=base_url()?>_assets/_main/css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
  <link href="<?=base_url()?>_assets/_main/css/style.css" rel="stylesheet" type="text/css" media="all" />
  <!-- Datepicker -->
  <link href="<?=base_url()?>_assets/dist/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
  <!-- font-awesome -->
  <link href="<?=base_url()?>_assets/_main/css/font-awesome.css" rel="stylesheet">
  <!-- fonts -->
  <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">
  <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>

<body>

    <?=$_header?>
    
    <?=$_content?>

    <?=$_footer?>

  <!-- js files -->
  <!-- js -->
  <script src="<?=base_url()?>_assets/_main/js/jquery-2.1.4.min.js"></script>
  <!-- bootstrap -->
  <!-- datepicker -->
  <script src="<?=base_url()?>_assets/dist/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

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
  <script src="<?=base_url()?>_assets/_main/js/bootstrap.js"></script>
  <!-- stats numscroller-js-file -->
  <script src="<?=base_url()?>_assets/_main/js/numscroller-1.0.js"></script>
  <!-- //stats numscroller-js-file -->

  <!-- Flexslider-js for-testimonials -->
  <script>
    $(window).load(function () {
      $("#flexiselDemo1").flexisel({
        visibleItems: 1,
        animationSpeed: 1000,
        autoPlay: false,
        autoPlaySpeed: 3000,
        pauseOnHover: true,
        enableResponsiveBreakpoints: true,
        responsiveBreakpoints: {
          portrait: {
            changePoint: 480,
            visibleItems: 1
          },
          landscape: {
            changePoint: 640,
            visibleItems: 1
          },
          tablet: {
            changePoint: 768,
            visibleItems: 1
          }
        }
      });

    });
  </script>
  <script src="<?=base_url()?>_assets/_main/js/jquery.flexisel.js"></script>
  <!-- //Flexslider-js for-testimonials -->
  <!-- smooth scrolling -->
  <script src="<?=base_url()?>_assets/_main/js/SmoothScroll.min.js"></script>
  <script src="<?=base_url()?>_assets/_main/js/move-top.js"></script>
  <script src="<?=base_url()?>_assets/_main/js/easing.js"></script>
  <!-- here stars scrolling icon -->
  <script>
    $(document).ready(function () {
      /*
        var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear' 
        };
      */

      $().UItoTop({
        easingType: 'easeOutQuart'
      });

    });
  </script>
  <!-- //here ends scrolling icon -->
  <!-- smooth scrolling -->
  <!-- //js-files -->

</body>

</html>