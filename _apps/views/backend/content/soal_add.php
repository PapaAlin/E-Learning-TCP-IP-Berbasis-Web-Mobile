      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Form Tambah Soal
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/soal">Soal</a></li>
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

                  <a href="<?=base_url()?>adm/soal" class="btn btn-primary" title="Back">
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
                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/soal/add_save">

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Soal :</label>
                        <input type="text" name="soal_text" class="form-control" placeholder="Soal">
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">A</span>
                          <input type="text" name="soal_jawaban_a" class="form-control" placeholder="Jawaban A">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="number" name="soal_a_nilai" class="form-control" placeholder="Nilai">
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">B</span>
                          <input type="text" name="soal_jawaban_b" class="form-control" placeholder="Jawaban B">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="number" name="soal_b_nilai" class="form-control" placeholder="Nilai">
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">C</span>
                          <input type="text" name="soal_jawaban_c" class="form-control" placeholder="Jawaban C">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="number" name="soal_c_nilai" class="form-control" placeholder="Nilai">
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">D</span>
                          <input type="text" name="soal_jawaban_d" class="form-control" placeholder="Jawaban D">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <input type="number" name="soal_d_nilai" class="form-control" placeholder="Nilai">
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