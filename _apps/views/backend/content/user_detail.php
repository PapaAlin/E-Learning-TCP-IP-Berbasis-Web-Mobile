      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$page_title?>
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/user">User</a></li>
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

                  <a href="<?=base_url()?>adm/users" class="btn btn-primary" title="Back">
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

                  <div class="col-md-8">
                    <div class="form-group">
                      <label>Nama User :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_user->user_name?>" />
                    </div>
                  </div>
                    
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>NIP :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_user->user_nip?>" />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Email :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_user->user_email?>" />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>jenis Kelamin :</label>
                      <input type="text" disabled class="form-control" value="<?php if($view_user->user_jk == "1") echo "Laki-laki"; else echo "Perempuan"; ?>" />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Tanggal Lahir :</label>
                      <input type="text" disabled class="form-control" value="<?=$this->tgl_indonesia->tgl_indo_date($view_user->tgl_lahir)?>" />
                    </div>
                  </div>

                  <div class="col-md-12">

                    <div class="form-group">
                      <label>Alamat User :</label>
                      <textarea class="form-control" disabled rows="4"><?=$view_user->user_alamat?></textarea>
                    </div>

                  </div>

                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->