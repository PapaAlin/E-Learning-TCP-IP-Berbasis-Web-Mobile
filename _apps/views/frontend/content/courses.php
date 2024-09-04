  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Courses</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- blog -->
  <div class="blog-cource">
    <div class="container">

      <?php
      //load view message
      $this->load->view('/backend/include/message', true);
      ?>
            
      <div class="title-div">
        <h3 class="tittle">
          <span>A</span>LL
          <span>C</span>ourses
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <?php
      $no = $nopage + 1;
      foreach ($courses as $view_courses) {

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

        <div class="blog-info">
          <div class="col-xs-12 blog-grid-text">
            <h4>
              <?=strip_tags(stripslashes($view_courses->course_title))?>
            </h4>
            <p style="text-align:justify;">
              <?=substr(strip_tags(stripslashes($view_courses->course_desc)),0,150)?>
            </p>
            <a class="button-style" href="<?=base_url()?>courses/detail/<?=$view_courses->course_id?>">View Courses</a>
          </div>
          <div class="clearfix"> </div>
        </div>
        <br><br>

      <?php
      }
      ?>

      <div class="box-footer clearfix">
        <div align="left" style="margin-bottom: 10px; font-weight: bolder;"><span style="color: #EF1515">Total Data : </span><?=$total_data?> Data</div>
        <?php echo $paging; ?>
      </div>

    </div>
  </div>
  <!-- //blog -->