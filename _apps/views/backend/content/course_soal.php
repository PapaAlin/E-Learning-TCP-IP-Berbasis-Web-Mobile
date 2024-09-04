      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Soal - <?=$view_courses->course_title?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>adm"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Soal</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <?php
            //load view message
            $this->load->view('/backend/include/message', true);
            ?>

            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">

                  <a href="<?=base_url()?>adm/courses/soal_add/<?=$view_courses->course_id?>" class="btn btn-success" title="Add Soal">
                    <span><i class="fa fa-plus"></i> Tambah Soal</span>
                  </a>

                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    -->
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr style="background-color: #B9B7B7;">
                        <th width="4%">No</th>
                        <th width="40%">Soal</th>
                        <th width="55%">Jawaban</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = 1;
                    foreach ($soal as $view_soal) {
                    ?>
                      <tr>
                        <td><?=$no++?></td>
                        <td>
                          <?=nl2br($view_soal->soal_text)?><br>
                          <b>Jawaban : <?=ucwords($view_soal->soal_jawaban_benar)?></b><br>
                          <a href="<?=base_url()?>adm/courses/soal_edit/<?=$view_soal->soal_id?>"><i class="fa fa-edit"></i> Edit</a> - 
                          <a href="<?=base_url()?>adm/courses/soal_delete/<?=$view_soal->soal_id?>" onclick="return confirm('Apakah Anda yakin ingin Menghapus <?=$view_soal->soal_text ?>?')"><i class="fa fa-trash-o"></i> Del</a>
                        </td>
                        <td>
                          a. <?=strip_tags(stripslashes($view_soal->soal_jawaban_a))?><br>
                          b. <?=strip_tags(stripslashes($view_soal->soal_jawaban_b))?><br>
                          c. <?=strip_tags(stripslashes($view_soal->soal_jawaban_c))?><br>
                          d. <?=strip_tags(stripslashes($view_soal->soal_jawaban_d))?><br>
                          d. <?=strip_tags(stripslashes($view_soal->soal_jawaban_e))?>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->