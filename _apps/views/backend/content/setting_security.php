      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Security Setting
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/settings">Settings</a></li>
            <li class="active">Security</li>
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

                  <a href="<?=base_url()?>adm/settings/general" class="btn btn-primary" title="General Setting">
                    <span><i class="fa fa-gear"></i> General</span>
                  </a>

                  <a href="<?=base_url()?>adm/settings/security" class="btn btn-primary" title="Security Setting">
                    <span><i class="fa fa-lock"></i> Security</span>
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

                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/settings/security_save">

                    <div class="col-md-4">  
                      <div class="form-group">
                        <label>Email Administrator :</label>
                        <input type="text" name="web_email_administrator" class="form-control" value="<?=$web_email_administrator?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Admin Encription Security :</label>
                        <input type="text" name="web_admin_validation" class="form-control" value="<?=$web_admin_validation?>"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>User Encription Security :</label>
                        <input type="text" name="web_user_validation" class="form-control" value="<?=$web_user_validation?>"/>
                      </div>
                    </div>

                    <div class="box-footer">
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