      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Form Edit Profile
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/profile">Profile</a></li>
            <li class="active">Edit</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">

            <?php
            //load view message
            $this->load->view('/backend/include/message', true);
            ?>
            
            <div class="col-md-12">

              <div class="box box-info">
                <div class="box-header">

                  <a href="<?=base_url()?>adm/profile" class="btn btn-primary" title="Back">
                    <span><i class="fa fa-chevron-left"></i> Back</span>
                  </a>

                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    -->
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <div class="box-body pad">
                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/profile/edit_save">
                    <input type="hidden" name="password_old" value="<?=$view_admin->password?>">
                    <input type="hidden" name="admin_email_old" value="<?=$view_admin->admin_email?>">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Nama admin :</label>
                        <input type="text" name="admin_name" class="form-control" value="<?=$view_admin->admin_name?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Username :</label>
                        <input type="text" name="username" class="form-control" onKeyPress="return alphanumericOnly(event)" value="<?=$view_admin->username?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email :</label>
                        <input type="email" name="admin_email" class="form-control" value="<?=$view_admin->admin_email?>" />
                      </div>
                    </div>

                    <?php
                    if($this->Adminsmodel->Detail($this->session->userdata('admin_id'))->row()->admin_status == "1")
                    {
                    ?>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Password :</label>
                          <input type="password" name="password1" class="form-control" placeholder="Masukkan Password" />
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Ulangi Password :</label>
                          <input type="password" name="password2" class="form-control" placeholder="Ulangi Password" />
                        </div>
                      </div>

                    <?php
                    }
                    ?>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About :</label>
                        <textarea class="form-control" name="admin_about" rows="10" cols="80"><?=$view_admin->admin_about?></textarea>
                      </div>
                    </div>

                    <div class="box-footer col-md-12">
                      <button type="submit" class="btn btn-success">Edit</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                    </div>

                  </form>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->