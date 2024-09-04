







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Edit Profile</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <!-- about -->
  <div class="about-sec" id="about">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>E</span>dit 
          <span>P</span>rofile
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <div class="login-form">

        <a href="<?=base_url()?>profile" class="btn btn-primary" title="Back">
          <span><i class="fa fa-chevron-left"></i> Back</span>
        </a>
        <hr>

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
            <?php echo $message." ".$msg['message'] ?>
          </div>

        <?php
        endif;
        ?>

        <form method="post" enctype="multipart/form-data" action="<?=base_url()?>profile/edit_save?">

          <input type="hidden" name="user_email_old" value="<?=$view_user->user_email ?>">
          <input type="hidden" name="password_old" value="<?=$view_user->password ?>">
          
          
          <div class="form-group">
            <label>Username :</label>
            <input type="t" name="user_name" placeholder="Username" class="form-control" value="<?=$view_user->user_name ?>"/>
          </div>

          <div class="form-group">
            <label>Email :</label>
            <input type="t" name="user_email" placeholder="Email" required="required" class="form-control" value="<?=$view_user->user_email ?>"/>
          </div>

          <div class="form-group">
            <label>No Telpon :</label>
            <input type="t" name="user_telp" placeholder="No Telpon" class="form-control" value="<?=$view_user->user_telp ?>"/>
          </div>

          <div class="form-group">
            <label>Tanggal Lahir :</label>
            <input type="t" name="tgl_lahir" id="datepicker" value="<?=$view_user->tgl_lahir ?>" class="form-control">
          </div>

          <div class="form-group">
            <label>Jenis Kelamin :</label>
            <select name="user_jk" class="form-control">
              <option value="1" <?php if($view_user->user_jk == "1") echo "selected" ?> >Laki-laki</option>
              <option value="0" <?php if($view_user->user_jk == "0") echo "selected" ?> >Perempuan</option>
            </select>
          </div>

          <div class="form-group">
            <label>Alamat :</label>
            <input type="t" name="user_alamat" placeholder="Alamat" value="<?=$view_user->user_alamat ?>" class="form-control">
          </div>

          <div class="form-group">
            <label>Tentang :</label>
            <textarea name="user_about" placeholder="Tentang Dirimu" class="form-control" rows="8" cols="80"><?= $view_user->user_about ?></textarea>
          </div>
          <br>

          <input type="submit" value="Edit">

        </form>
      </div>
      <div class="clearfix"> </div>

    </div>
  </div>
  <!-- //about -->