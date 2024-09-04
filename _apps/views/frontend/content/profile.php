







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Profile</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- about -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>P</span>rofile
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <div class="about-sub">        
        
        <!-- img profile-->
        <div class="col-md-4 team-grids" style="text-align: center;">
          <div class="thumbnail team-agileits">
            <img src="<?=base_url()?>_images/_user/_medium/no-image.gif" class="img-responsive" alt="" style="border:1px solid black;" />
            <div class="effectd-caption">
              <p><?= $view_user->user_email ?></p>
              <div class="social-lsicon">
                <a href="#" class="social-button twitter">
                  <span class="fa fa-twitter"></span>
                </a>
                <a href="#" class="social-button facebook">
                  <span class="fa fa-facebook"></span>
                </a>
                <a href="#" class="social-button google">
                  <span class="fa fa-google-plus"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- //img profile -->
        <br>
        
        <!-- Profile -->
        <div class="col-md-8 about_bottom_left">

          <!-- error system -->
          <?php
          //flashdata
          $msg = $this->session->flashdata('message_flashdata');
          if($msg):

            if($msg['type'] == "success")
            {
              $class = "alert-success";
              $message = "<strong>Sukses!</strong>";
            }
            else
            {
              $class = "alert-danger";
              $message = "<strong>Gagal!</strong>";
            }
          ?>

            <div class="alert <?=$class?>" role="alert">
              <?php echo $message."<br>".$msg['message'] ?>
            </div>

          <?php
          endif;
          ?>

          <h4>
            <span><?= UCWORDS($view_user->user_name) ?></span>
          </h4>

          <p>
            <span>NIP : <?= $view_user->user_nip ?></span><br>
            <span>Email : <?= $view_user->user_email ?></span><br>
            <span>Telp : <?= $view_user->user_telp ?></span><br>
          </p>
          
          <p>
            <b>Alamat :</b><br>
            <?= nl2br(UCWORDS($view_user->user_alamat)) ?>
          </p>
          
          <p>
            <b>Tentang :</b><br>
            <?= nl2br(UCWORDS($view_user->user_about)) ?>
          </p>

          <a href="<?=base_url()?>profile/edit" class="button-style"><i class="fa fa-gear text-aqua"></i> Edit Profil</a>
          <a href="<?=base_url()?>profile/profile_pass_edit" class="button-style"><i class="fa fa-gear text-aqua"></i> Edit Password</a>
          <a href="<?=base_url()?>login/logout" class="button-style"><i class="fa fa-sign-out text-aqua"></i> Logout</a>

        </div>

        <div class="clearfix"> </div>
      </div>
    </div>
  </div>
  <!-- //about -->