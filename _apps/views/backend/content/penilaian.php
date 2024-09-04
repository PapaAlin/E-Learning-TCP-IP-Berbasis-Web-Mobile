      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Penilaian
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>adm"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/penilaian">Penilaian</a></li>
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

                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <!--
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                    -->
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->
                <br>

                <div class="box-body">
                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr style="background-color: #B9B7B7;">
                        <th width="5%" style="text-align: center; vertical-align: middle;">No</th>
                        <th width="80%" style="vertical-align: middle;">Nama User<br>(Date)</th>
                        <th width="10%" style="vertical-align: middle;">Nilai</th>

                      </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $nopage + 1;
                    foreach ($penilaian as $view_penilaian) {

                      //user
                      $view_user = $this->Penilaianmodel->select_db("tbl_users","user_id",$view_penilaian->user_id)->row();

                      //course
                      $view_course = $this->Penilaianmodel->select_db("tbl_courses","course_id",$view_penilaian->course_id)->row();

                      if($view_penilaian->penilaian_type == "pretest")
                      {
                        $nilai = $view_penilaian->penilaian_benar*20;
                      }
                      else
                      {
                        $nilai = $view_penilaian->penilaian_benar*10;
                      }

                      if($view_penilaian->penilaian_benar*10 >= "70")
                      {
                        $status = "Lulus";
                      }
                      else
                      {
                        $status = "Tidak<br>Lulus";
                      }
                    ?>
                      <tr>
                        <td style="text-align: center;"><?=$no++?></td>
                        <td>
                          <a href="<?=base_url()?>adm/penilaian/detail/<?=$view_user->user_id?>"><b><?=$view_user->user_name?></b></a><br>
                            <?=$view_user->user_nip ?><br>
                          <i><?=ucwords($view_course->course_title)?></i><br>
                          <a href="#"><?=$this->tgl_indonesia->tgl_indo_full($view_penilaian->penilaian_created)?></a><br>
                          <!--
                          <a href="<?=base_url()?>adm/penilaian/detail/<?=$view_penilaian->penilaian_id?>"> <i class="fa fa-list-alt"></i> Detail</a>
                          -->
                        </td>
                        <td>
                          <?=$nilai?>/100<br>
                          <i><a href="#"><?=$status?></a></i>
                        </td>

                      </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->

                <div class="box-footer clearfix">
                  <div align="left" style="margin-bottom: 10px; font-weight: bolder;"><span style="color: #EF1515">Total Data : </span><?=$total_data?> Data</div>
                  <?php echo $paging; ?>
                </div>

              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->