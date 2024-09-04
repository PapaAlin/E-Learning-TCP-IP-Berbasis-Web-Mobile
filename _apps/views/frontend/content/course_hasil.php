







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Courses (Hasil)</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- blog -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>P</span>enilaian
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
                <th width="29%">Nilai /100</th>
                <th width="24%">Status</th>
              </tr>
            </thead>

            <tbody>
            <?php
            if($penilaian)
            {
              foreach ($penilaian as $view_penilaian) {

                if($view_penilaian->penilaian_benar*10 >= "70")
                {
                  $status = "Lulus";
                }
                else
                {
                  $status = "Tidak<br>Lulus";
                }
            ?>
                <tr>
                  <td>
                    <i class="fa fa-calendar"> <?=$this->tgl_indonesia->tgl_indo_full($view_penilaian->penilaian_created)?></i>                
                  </td>
                  <td>
                    <?=$view_penilaian->penilaian_benar*10?>/100
                  </td>
                  <td>
                    <?=$status?>
                  </td>
                </tr>
            <?php
              }
            }
            else
            {
            ?>

              <tr>
                <td colspan="3">
                  No Data Available
                </td>
              </tr>

            <?php
            }
            ?>

            </tbody>
          </table>

          <hr>
          
          <a href="<?=base_url()?>courses/detail/<?=$view_courses->course_id?>" class="btn btn-primary" title="Kembali Pretest"><i class="fa fa-chevron-left"></i> Back To Course</a>

        </div>
        
        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //blog -->