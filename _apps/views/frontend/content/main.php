  <!-- banner -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1" class=""></li>
      <li data-target="#myCarousel" data-slide-to="2" class=""></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <div class="container">
          <div class="carousel-caption">
          </div>
        </div>
      </div>
      <div class="item item2">
        <div class="container">
          <div class="carousel-caption">
          </div>
        </div>
      </div>
      <div class="item item3">
        <div class="container">
          <div class="carousel-caption">
          </div>
        </div>
      </div>
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="fa fa-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="fa fa-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
    <!-- The Modal -->
  </div>
  <!--//banner -->

  <!-- about -->
  <div class="banner-bottom-w3l" id="about">
    <div class="container">
      <div class="title-div">
        <h3 class="tittle">
          <span>W</span>elcome
        </h3>
        <div class="tittle-style">

        </div>
      </div>
      <div class="welcome-sub-wthree">
        <div class="col-md-6 banner_bottom_left">
          <h4>About<br>
            <span><?=$page_title?></span>
          </h4>
          <p style="text-align:justify;">
            <?=$description?>
          </p>
        </div>
        <!-- Stats-->
        <div class="col-md-6 stats-info-agile">
          <div class="col-xs-6 stats-grid stat-border">
            <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='<?= $this->Mainmodel->GetTotal("tbl_courses","","")->num_rows() ?>' data-delay='.5' data-increment="1"><?= $this->Mainmodel->GetTotal("tbl_courses","","")->num_rows() ?></div>
            <p>Courses</p>
          </div>
          <div class="col-xs-6 stats-grid">
            <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='<?= $this->Mainmodel->GetTotal("tbl_users","","")->num_rows() ?>' data-delay='.5' data-increment="1"><?= $this->Mainmodel->GetTotal("tbl_users","","")->num_rows() ?></div>
            <p>Karyawan</p>
          </div>
          <div class="clearfix"></div>
          <div class="child-stat">
            <div class="col-xs-6 stats-grid stat-border border-st2">
              <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='' data-delay='.5' data-increment="1"></div>
              <p></p>
            </div>
            <div class="col-xs-6 stats-grid">
              <div class='numscroller numscroller-big-bottom' data-slno='1' data-min='0' data-max='' data-delay='.5' data-increment="1"></div>
              <p></p>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <!-- //Stats -->
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //about -->

  <!-- blog -->
  <div class="blog-cource">
    <div class="container">
      <div class="title-div">
        <h3 class="tittle">
          <span>N</span>ew
          <span>C</span>ourses
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <?php
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


      
    </div>
  </div>
  <!-- //blog -->