      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Profile Information
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/profile">Profile</a></li>
            <li class="active">Detail</li>
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

                  <a href="<?=base_url()?>adm/profile/edit" class="btn btn-primary" title="Back">
                    <span><i class="fa fa-edit"></i> Edit Profile</span>
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

                  <div class="col-md-3" align="center">
                    <img src="<?=base_url()?>_images/3.png" style="border: 1px solid #DA1717;" class="img-circle" alt="<?=$this->session->userdata('admin_name')?>" />
                  </div>

                  <div class="col-md-9">
                    
                    <div class="form-group">
                      <label>Nama :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_admin->admin_name?>" />
                    </div>

                    <div class="form-group">
                      <label>Email :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_admin->admin_email?>" />
                    </div>

                    <div class="form-group">
                      <label>About :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_admin->admin_about?>" />
                    </div>

                    <div class="form-group">
                      <label>Last Login :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_admin->admin_login?>" />
                    </div>

                    <div class="form-group">
                      <label>Since :</label>
                      <input type="text" disabled class="form-control" value="<?=$this->tgl_indonesia->tgl_indo_datetime($this->Mainmodel->select_db("tbl_admins","admin_id",$this->session->userdata('admin_id'))->row()->admin_date); ?>" />
                    </div>

                  </div>

                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->