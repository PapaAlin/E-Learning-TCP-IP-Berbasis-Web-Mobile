







  <!-- short -->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Edit Password</li>
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
          <span>P</span>assword
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

        <form method="post" enctype="multipart/form-data" action="<?=base_url()?>profile/profile_pass_edit_save?">

        <input type="hidden" name="password_old" value="<?=$view_user->password ?>">          
          
          <div class="form-group">
            <label>Password :</label>
            <input type="password" name="password" class="form-control"/>
          </div>

          <div class="form-group">
            <label>Ulangi Password :</label>
            <input type="password" name="password2" class="form-control"/>
          </div>

          <input type="submit" value="Edit Password">

        </form>
      </div>
      <div class="clearfix"> </div>

    </div>
  </div>
  <!-- //about -->