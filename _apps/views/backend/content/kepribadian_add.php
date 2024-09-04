      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Form Tambah Kepribadian
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/kepribadians">Kepribadian</a></li>
            <li class="active">Add</li>
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

                  <a href="<?=base_url()?>adm/kepribadians" class="btn btn-primary" title="Back">
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
                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/kepribadian/add_save">

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Nama Kepribadian :</label>
                        <input type="text" name="kepribadian_nama" class="form-control" placeholder="Masukkan Nama Kepribadian" />
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kekuatan :</label>
                        <textarea class="form-control" name="kepribadian_kekuatan" rows="8" cols="80"></textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kelemahan :</label>
                        <textarea class="form-control" name="kepribadian_kelemahan" rows="8" cols="80"></textarea>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Keterangan :</label>
                        <textarea class="form-control" name="kepribadian_ket" rows="8" cols="80"></textarea>
                      </div>
                    </div>

                    <div class="box-footer col-md-12">
                      <button type="submit" class="btn btn-success">Save</button>
                      <button type="reset" class="btn btn-primary">Reset</button>
                    </div>

                  </form>
                </div>
              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->