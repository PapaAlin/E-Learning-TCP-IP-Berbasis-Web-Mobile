      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Form Edit Soal - <?=$view_soal->soal_text?>
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Soal</a></li>
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

                  <a href="<?=base_url()?>adm/courses/soal/<?=$view_soal->course_id?>" class="btn btn-primary" title="Back">
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
                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/courses/soal_edit_save">

                    <input type="hidden" name="course_id" value="<?=$view_soal->course_id?>">
                    <input type="hidden" name="soal_id" value="<?=$view_soal->soal_id?>">

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Soal :</label>
                        <input type="text" name="soal_text" class="form-control" value="<?=$view_soal->soal_text?>">
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">A</span>
                          <input type="text" name="soal_jawaban_a" class="form-control" value="<?=$view_soal->soal_jawaban_a?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">B</span>
                          <input type="text" name="soal_jawaban_b" class="form-control" value="<?=$view_soal->soal_jawaban_b?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">C</span>
                          <input type="text" name="soal_jawaban_c" class="form-control" value="<?=$view_soal->soal_jawaban_c?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">D</span>
                          <input type="text" name="soal_jawaban_d" class="form-control" value="<?=$view_soal->soal_jawaban_d?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon">E</span>
                          <input type="text" name="soal_jawaban_e" class="form-control" value="<?=$view_soal->soal_jawaban_e?>">
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Jawaban :</label>
                        <select class="form-control" name="soal_jawaban_benar">
                          <option value="a" <?php if($view_soal->soal_jawaban_benar == "a") echo "selected"; ?>>A</option>
                          <option value="b" <?php if($view_soal->soal_jawaban_benar == "b") echo "selected"; ?>>B</option>
                          <option value="c" <?php if($view_soal->soal_jawaban_benar == "c") echo "selected"; ?>>C</option>
                          <option value="d" <?php if($view_soal->soal_jawaban_benar == "d") echo "selected"; ?>>D</option>
                          <option value="e" <?php if($view_soal->soal_jawaban_benar == "e") echo "selected"; ?>>E</option>
                        </select>
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