







<!-- services -->
  <div class="services" id="classes">
    <div class="container">
      <h3 class="w3_head w3_head1">HASIL UJI KEPRIBADIAN <span><?=$this->Mainmodel->GetOptions("web_title")->option_value?></span></h3>
    </div>
  </div>
<!-- //services -->
<br>

<!--skills -->
<div class="skills-agileinfo" id="skills">
  <div class="container">
        <div class="modal-spa">
          <div class="skills">

            <div class="col-md-7 bar-grids bargrids-left">

              <?php
              //hasil kepribadian 1
              //print_r($view_total_nilai);

              $view_nilai_1 = $view_total_nilai["0"];
              $view_nilai_2 = $view_total_nilai["1"];

              $kepribadian_1_persen = ($view_nilai_1->total_nilai/40)*100;
              $kepribadian_2_persen = ($view_nilai_2->total_nilai/40)*100;
              ?>

              <h4><span class="glyphicon glyphicon-cog"></span> Kepribadian Anda Adalah (<?= $view_kepribadian_1->kepribadian_nama ?>)</h4>
              <h6>Nilai <?=$view_nilai_1->jawaban_nilai?> ( <?=$view_nilai_1->total_nilai?> Jawaban dari 40 Soal ) <span> <?= $kepribadian_1_persen ?>% </span></h6>
              <div class="progress">
                <div class="progress-bar progress-bar-striped active" style="width: <?= $kepribadian_1_persen ?>%">
                </div>
              </div>
              <h6 style="text-align:justify;">
                <?= nl2br($view_kepribadian_1->kepribadian_ket) ?>
              </h6>
              <hr>

              <h3 style="color: #FFF; text-decoration: underline; font-weight: bold; margin-bottom: 10px;">
                KEKUATAN
              </h3>
              <h6>
                <?= nl2br($view_kepribadian_1->kepribadian_kekuatan) ?>
              </h6>
              <br>

              <h3 style="color: #FFF; text-decoration: underline; font-weight: bold; margin-bottom: 10px;">
                KELEMAHAN
              </h3>
              <h6>
                <?= nl2br($view_kepribadian_1->kepribadian_kelemahan) ?>
              </h6>

            </div>

            <div class="clearfix"> </div> 

            <div class="about" id="about">
              <div class="col-md-12 person-info-agileits-w3layouts">
                <ul>
                  <li>
                    <a href="<?=base_url()?>tes" class="botton-w3ls"><i class="fa fa-list-alt"></i> Uji Kepribadian Lagi</a>
                    <a href="<?=base_url()?>profile" class="botton-w3ls"><i class="fa fa-list-alt"></i> Profil</a>
                    <a href="<?=base_url()?>login/logout" class="botton-w3ls"><i class="fa fa-sign-out text-aqua"></i> Logout</a>
                  </li>
                </ul>
              </div>
            </div>

          </div>
        </div> 
    </div>
</div> 
<!-- //skills -->
<br>