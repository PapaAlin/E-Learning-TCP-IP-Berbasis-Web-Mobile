      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Website Description
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/settings">Settings</a></li>
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

                  <div class="col-md-3" align="center">
                    <img src="<?=base_url()?>_images/<?=$web_logo?>" style="border: 1px solid #DA1717;" class="img-responsive" alt="<?=$this->session->userdata('admin_name')?>" />
                  </div>

                  <div class="col-md-9">
                    
                    <div class="form-group">
                      <label>Title :</label>
                      <input type="text" disabled class="form-control" value="<?=$web_title?>" />
                    </div>

                    <div class="form-group">
                      <label>About Web :</label>
                      <textarea class="form-control" disabled rows="6"><?=$web_about?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label>Keywords :</label>
                      <textarea class="form-control" disabled rows="6"><?=$web_keywords?></textarea>
                    </div>
                    
                    <div class="form-group">
                      <label>Email Website :</label>
                      <input type="text" disabled class="form-control" value="<?=$web_contact_email?>" />
                    </div>
                    
                    <div class="form-group">
                      <label>Address :</label>
                      <input type="text" disabled class="form-control" value="<?=$web_contact_address?>" />
                    </div>
                    
                    <div class="form-group">
                      <label>Telp :</label>
                      <input type="text" disabled class="form-control" value="<?=$web_contact_telp?>" />
                    </div>

                    <div class="form-group">
                      <label>Website Created :</label>
                      <input type="text" disabled class="form-control" value="<?=$this->tgl_indonesia->tgl_indo_full($web_created); ?>" />
                    </div>

                    <div class="form-group">
                      <label>Last Update :</label>
                      <input type="text" disabled class="form-control" value="<?=$this->tgl_indonesia->tgl_indo_full($web_update); ?>" />
                    </div>

                  </div>

                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->