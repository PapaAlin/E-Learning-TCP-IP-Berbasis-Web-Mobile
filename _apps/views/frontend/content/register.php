  <!-- banner --
  <div class="" style="text-align: center;
    background: url(<?=base_url()?>_assets/_main/images/1.png) no-repeat center;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
    min-height: 200px;">

  </div>
  <!--//banner -->

  <!-- short-->
  <div class="services-breadcrumb">
    <div class="inner_breadcrumb">
      <ul class="short_ls">
        <li>
          <a href="<?=base_url()?>">Home</a>
          <span>| |</span>
        </li>
        <li>Register</li>
      </ul>
    </div>
  </div>
  <!-- //short-->

  <div class="register-form-main">
    <div class="container">
      
      <div class="title-div">
        <h3 class="tittle">
          <span>R</span>egister
          <span>F</span>orm
        </h3>
        <div class="tittle-style">

        </div>
      </div>

      <div class="login-form">

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

        <form method="post" enctype="multipart/form-data" action="<?=base_url()?>register/proses?">
          
          <div class="">
            <p>Username </p>
            <input type="text" name="username" placeholder="Username" required="required"/>
          </div>

          <div class="">
            <p>Email </p>
            <input type="email" name="email" placeholder="Email" required="required"/>
          </div>
          
          <div class="">
            <p>Password</p>
            <input type="password" name="password" placeholder="Password" required="required"/>
          </div>

          <div class="">
            <p>Ulangi Password</p>
            <input type="password" name="password2" placeholder="Ulangi Password" required="required"/>
          </div>

          <input type="submit" value="Login">
          
          <div class="register-forming">
            <p>Sudah Punya Akun, <a href="<?= base_url() ?>login">Login Disini</a>
            </p>
          </div>

        </form>
      </div>

    </div>
  </div>