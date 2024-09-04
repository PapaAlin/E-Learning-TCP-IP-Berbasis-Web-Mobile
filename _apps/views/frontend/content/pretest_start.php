







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Pre Test</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- blog -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>P</span>re <span>T</span>est
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
        <div class="col-md-12 about_bottom_left" style="text-align:center;">

          <table class="table table-bordered table-hover">

            <thead>
              <tr style="background-color: #CBEEFE;">
                <th width="47%">Date</th>
                <th width="23%">Soal /5</th>
                <th width="30%">Nilai /100</th>
              </tr>
            </thead>

            <tbody>
            <?php
            foreach ($penilaian as $view_penilaian) {
            ?>
              <tr>
                <td>
                  <i class="fa fa-calendar"> <?=$this->tgl_indonesia->tgl_indo_full($view_penilaian->penilaian_created)?></i>                
                </td>
                <td>
                  <?=$view_penilaian->penilaian_benar?>
                </td>
                <td>
                  <?=$view_penilaian->penilaian_benar*20?>
                </td>
              </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
          
          <h4>
            <span>Time limit: 10 mins</span>
          </h4>
          <hr>
          
          <a href="<?=base_url()?>courses/pretest/<?=$view_courses->course_id?>" class="btn btn-success" title="Mulai Pretest">START</a> <a href="<?=base_url()?>courses/detail/<?=$view_courses->course_id?>" class="btn btn-primary" title="Kembali Pretest">BACK</a>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->