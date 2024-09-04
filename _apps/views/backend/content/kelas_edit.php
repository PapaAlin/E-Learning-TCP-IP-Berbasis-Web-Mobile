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
            <li><a href="<?=base_url()?>adm/kelas">Kelas</a></li>
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

                  <a href="<?=base_url()?>adm/kelas" class="btn btn-primary" title="Back">
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
                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/kelas/edit_save">

                    <input type="hidden" name="kelas_id" value="<?=$view_kelas->kelas_id ?>">

                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Nama Kelas :</label>
                        <input type="text" name="kelas_nama" class="form-control" value="<?=$view_kelas->kelas_nama ?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Wali Kelas</label>
                        <select class="form-control select2" name="wali_kelas" required="required">
                          <option value="">-- Pilih Wali Kelas --</option>
                          <?php
                          foreach ($wali_kelas as $view_walikelas):
                          ?>
                          <option value="<?=$view_walikelas->admin_id?>" <?php if($view_walikelas->admin_id == $view_kelas->wali_kelas) echo "selected" ?>><?=$view_walikelas->admin_name?></option>
                          <?php endforeach; ?>
                        </select>
                      </div><!-- /.form-group -->
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="kelas_ket" rows="5" cols="80"><?=$view_kelas->kelas_ket?></textarea>
                      </div>
                    </div>

                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Simpan</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                    </div>

                  </form>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->