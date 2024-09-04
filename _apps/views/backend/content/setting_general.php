      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            General Setting
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/settings">Settings</a></li>
            <li class="active">General</li>
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

                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/settings/general_save">

                    <input type="hidden" name="web_logo_old" value="<?=$web_logo?>">

                    <div class="col-md-8">  
                      <div class="form-group">
                        <label>Title :</label>
                        <input type="text" name="web_title" class="form-control" value="<?=$web_title?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Logo Website :</label>
                        <input type="file" name="web_logo" accept="image/*" style="border:1px solid #C2C1C1; padding: 3px; width: 100%;"/>
                        <span style="color: #FF0000; font-size: 11px;">*Kosongkan Jika gambar logo tidak dirubah</span>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Web :</label>
                        <textarea class="form-control" name="web_about" rows="6"><?=$web_about?></textarea>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Keywords (Maksimal 2 kata) :</label>
                        <input type="text" name="web_keywords" class="form-control" value="<?=$web_keywords?>"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email Website :</label>
                        <input type="email" name="web_contact_email" class="form-control" value="<?=$web_contact_email?>"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Address :</label>
                        <input type="text" name="web_contact_address" class="form-control" value="<?=$web_contact_address?>"/>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Telp :</label>
                        <input type="text" name="web_contact_telp" class="form-control" value="<?=$web_contact_telp?>"/>
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