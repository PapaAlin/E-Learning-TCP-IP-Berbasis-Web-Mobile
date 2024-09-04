







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Hasil Post Test</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- blog -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>H</span>asil <span>P</span>ost<span>T</span>est
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <?php
      //load view message
      $this->load->view('/backend/include/message', true);
      ?>

      <?php
      if($view_penilaian->penilaian_benar*10 >= "70")
      {
        $status = "Selamat Anda Lulus";
      }
      else
      {
        $status = "Nilai Anda Belum memenuhi batas minimum kelulusan";
      }
      ?>

      <div class="about-sub">        
        
        <!-- img profile-->
        <div class="col-md-12 about_bottom_left" style="text-align:center;">
          
          <h4>
            <span>
              Hasil dari Posttest,<br>
              Benar = <?=$view_penilaian->penilaian_benar?>,<br>
              Salah = <?=$view_penilaian->penilaian_salah?><br>
              <b><?=$status?></b>
            </span>
          </h4>
          <hr>
          
          <a href="<?=base_url()?>courses/detail/<?=$view_courses->course_id?>" class="btn btn-success" title="Kembali">KEMBALI</a>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->