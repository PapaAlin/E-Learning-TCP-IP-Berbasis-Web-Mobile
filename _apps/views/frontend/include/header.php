







  <div class="header">
    <div class="content white">
      <nav class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">
              <h1>
                <span class="fa fa-leanpub" aria-hidden="true"></span>TelkomAkses
                <label>Education & Courses</label>
              </h1>
            </a>
          </div>
          <!--/.navbar-header-->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <nav class="link-effect-2" id="link-effect-2">
              <ul class="nav navbar-nav">

                <?php
                //cek cookie user
                $option_login_validation = $this->Mainmodel->GetOptions('web_user_validation')->option_value;
                $cookie = get_cookie($option_login_validation);
                if (!$cookie == '')
                {

                    //view user
                    $view_user = $this->Mainmodel->select_db("tbl_users","user_id",$this->session->userdata('user_id'))->row();
                ?>

                  <li>
                    <a href="<?=base_url()?>login/logout">
                      <span class="fa fa-sign-out" aria-hidden="true">Logout</span>
                    </a>
                  </li>

                  <li class="<?=$this->class_menu->active("profile")?>">
                    <a href="<?=base_url()?>profile" class="effect-3">
                      <span class="fa fa-user" aria-hidden="true"> <?= UCWORDS($view_user->user_name)?></span>
                    </a>
                  </li>

                <?php
                }
                else
                {
                ?>
      
                  <li>
                    <a href="<?=base_url()?>login">
                      <span class="fa fa-sign-in" aria-hidden="true">Login</span>
                    </a>
                  </li>
      
                <?php
                }
                ?>

                <li class="<?=$this->class_menu->active("courses")?>">
                  <a href="<?=base_url()?>courses" class="effect-3">Courses</a>
                </li>
                <li class="<?=$this->class_menu->active("home")?>">
                  <a href="<?=base_url()?>" class="effect-3">Home</a>
                </li>

              </ul>
            </nav>
          </div>
          <!--/.navbar-collapse-->
          <!--/.navbar-->
        </div>
      </nav>
    </div>
  </div>