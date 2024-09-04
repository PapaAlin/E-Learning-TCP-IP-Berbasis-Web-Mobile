







  <!-- short -->
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
        
        <!-- img profile-->
        <div class="col-md-12 about_bottom_left">
          
          <h4>
            <span>MATERI</span>
          </h4>
          <a href="<?=base_url()?>courses/detailpdf/<?=$view_courses->course_id?>" style="padding: 10px 0px 10px 20px;">
            <span class="fa fa-file-text-o" aria-hidden="true"></span> <?=strip_tags(stripslashes($view_courses->course_title))?> (PDF)
          </a>
          <hr>

          <h4>
            <span>POST TEST</span>
          </h4>
          <p style="padding: 10px 0px 10px 20px; text-align:justify;">
            POST TEST : Tahap ini ditujukan untuk mengukur pemahaman peserta pelatihan. Peserta boleh mengulang post test hingga lulus. Apabila peserta tidak lulus dapat melakukan post test kembali.
          </p>
          <a href="<?=base_url()?>courses/posttest_start/<?=$view_courses->course_id?>" style="padding: 10px 0px 10px 20px;">
            <span class="fa fa-edit" aria-hidden="true"></span> Test
          </a>
          <hr>

          <h4>
            <span>HASIl</span>
          </h4>
          <a href="<?=base_url()?>courses/hasil/<?=$view_courses->course_id?>" style="padding: 10px 0px 10px 20px;">
            <span class="fa fa-list-ol" aria-hidden="true"></span> Grades
          </a>
          <hr>

          <a class="button-style" href="<?=base_url()?>courses"><i class="fa fa-chevron-left"></i> Back To All Course</a>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->