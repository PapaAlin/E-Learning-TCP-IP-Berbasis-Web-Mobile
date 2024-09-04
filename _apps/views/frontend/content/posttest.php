







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Post Test</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- blog -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>P</span>ost <span>T</span>est
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
            <span><?php echo $view_soal->soal_no.". ".$view_soal->soal_text ?></span>
          </h4>
          <hr>
          
          <form method="post" enctype="multipart/form-data" action="<?=base_url()?>courses/posttest_save?">

            <input type="hidden" name="soal_id" value="<?=$view_soal->soal_id?>">
            <input type="hidden" name="soal_no" value="<?=$view_soal->soal_no?>">
            <input type="hidden" name="jawaban_sesi" value="<?=$jawaban_sesi?>">
            <input type="hidden" name="jawaban_type" value="posttest">
            <input type="hidden" name="course_id" value="<?=$view_courses->course_id?>">

            <p>
              <input type="radio" id="customRadioA" name="jawaban_nilai" value="a">
              <label for="customRadioA"><?=$view_soal->soal_jawaban_a ?></label>
            </p>

            <p>
              <input type="radio" id="customRadioB" name="jawaban_nilai" value="b">
              <label for="customRadioB"><?=$view_soal->soal_jawaban_b ?></label>
            </p>

            <p>
              <input type="radio" id="customRadioC" name="jawaban_nilai" value="c">
              <label for="customRadioC"><?=$view_soal->soal_jawaban_c ?></label>
            </p>

            <p>
              <input type="radio" id="customRadioD" name="jawaban_nilai" value="d">
              <label for="customRadioD"><?=$view_soal->soal_jawaban_d ?></label>
            </p>

            <p>
              <input type="radio" id="customRadioE" name="jawaban_nilai" value="e">
              <label for="customRadioE"><?=$view_soal->soal_jawaban_e ?></label>
            </p>
            <br>
            
            <?php
            if($view_soal->soal_no != "10")
            {
            ?>

              <input type="submit" value="Soal Selanjutnya" class="btn btn-primary">
            
            <?php
            }
            else
            {
            ?>

              <input type="submit" value="Selesai" class="btn btn-primary">

            <?php } ?>

          </form>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->