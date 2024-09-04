







<!-- services -->
  <div class="services" id="classes">
    <div class="container">
      <h3 class="w3_head w3_head1">UJI KEPRIBADIAN <span><?=$page_title?></span></h3>
    </div>
  </div>
<!-- //services -->

<!-- about -->
<br>
<div class="about" id="about">
  
  <div class="col-md-1">
  </div>

  <div class="col-md-10 contact-agileits-w3layouts">
    <h3 class="w3_head w3_head1"><?php echo $view_soal->soal_id.". ".$view_soal->soal_text ?></h3>

    <form method="post" enctype="multipart/form-data" action="<?=base_url()?>tes/tes_save?">

      <input type="hidden" name="soal_id" value="<?=$view_soal->soal_id?>">
      <input type="hidden" name="jawaban_sesi" value="<?=$jawaban_sesi?>">

      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="customRadioA" name="jawaban_nilai" value="<?=$view_soal->soal_a_nilai ?>">
        <label class="custom-control-label" for="customRadioA"><?=$view_soal->soal_jawaban_a ?></label>
      </div>

      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="customRadioB" name="jawaban_nilai" value="<?=$view_soal->soal_b_nilai ?>">
        <label class="custom-control-label" for="customRadioB"><?=$view_soal->soal_jawaban_b ?></label>
      </div>

      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="customRadioC" name="jawaban_nilai" value="<?=$view_soal->soal_c_nilai ?>">
        <label class="custom-control-label" for="customRadioC"><?=$view_soal->soal_jawaban_c ?></label>
      </div>

      <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" id="customRadioD" name="jawaban_nilai" value="<?=$view_soal->soal_d_nilai ?>">
        <label class="custom-control-label" for="customRadioD"><?=$view_soal->soal_jawaban_d ?></label>
      </div>
      
      <?php
      if($view_soal->soal_id != "20")
      {
      ?>

        <input type="submit" value="Soal Selanjutnya">
      
      <?php
      }
      else
      {
      ?>

        <input type="submit" value="Selesai">

      <?php } ?>

    </form>

  </div>

  <div class="col-md-1">
  </div>

  <div class="clearfix"></div>

</div>
<!-- //about-bottom -->
<br>