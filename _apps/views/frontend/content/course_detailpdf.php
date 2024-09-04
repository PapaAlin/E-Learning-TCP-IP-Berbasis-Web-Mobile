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

      <div class="about-sub">

        <div class="col-md-12 about_bottom_left">

          <!--
          <embed src="file_name.pdf" width="800px" height="2100px" />
          -->
          <?php
            //view pdf
            if($view_courses->course_pdf != "")
            {
                $course_pdf = $view_courses->course_pdf;
            }
            else
            {
                $course_pdf = "no-image.gif";
            }
          ?>

          <iframe
            src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?=base_url()?>_images/_pdf/<?=$course_pdf?>#toolbar=0&navpanes=0&scrollbar=0"
            type="application/pdf"
            frameBorder="0"
            scrolling="auto"
            height="500px"
            width="100%"
          ></iframe>

          
          <a class="button-style" href="<?=base_url()?>courses/detail/<?=$view_courses->course_id?>"><i class="fa fa-chevron-left"></i> Back To Course</a>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->