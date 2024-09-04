`  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Course Detail</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- blog -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <?=strip_tags(stripslashes($view_courses->course_title))?>
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <?php
      //load view message
      $this->load->view('/backend/include/message', true);
      ?>

      <?php
        //view image
        if($view_courses->course_img != "")
        {
            $course_img = $view_courses->course_img;
        }
        else
        {
            $course_img = "no-image.gif";
        }
      ?>

      <div class="about-sub">

        <div class="col-md-12" align="center">

          <div>
            <img src="<?=base_url()?>_images/_courses/<?=$course_img?>" class="img-responsive" alt="" style="border:1px solid black;" />
          </div>
          <br>

        </div>

        <div class="col-md-12 about_bottom_left">

          <p style="text-align:justify;">
            <?=nl2br($view_courses->course_desc)?>
          </p>
          
          <a class="button-style" href="<?=base_url()?>courses/detail/<?=$view_courses->course_id?>"><i class="fa fa-chevron-left"></i> Back To Course</a>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->