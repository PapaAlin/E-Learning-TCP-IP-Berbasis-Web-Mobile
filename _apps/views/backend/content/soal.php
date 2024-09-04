      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Soal
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>adm"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/soal">Soal</a></li>
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

                  <a href="<?=base_url()?>adm/soal/add" class="btn btn-success" title="Add Artikel">
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

                <div class="box-header">
                  <form action="" method="get" name="form1" style="border: solid 1px black; padding: 9px 0px;">
                    <div class="col-md-3" style="margin-bottom: 5px;">
                      <input type="text" name="text" value="<?=$text?>" class="form-control" placeholder="Masukkan Soal">
                    </div>
                      <button type="submit" class="btn btn-success" name="search" style="margin: 0 2px 0 7px;"><i class="fa fa-search"></i> Search</button>
                      <a href="<?=base_url()?>adm/soal" class="btn btn-primary"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
                </form>
                </div>

                <div class="box-body">
                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr style="background-color: #B9B7B7;">
                        <th width="5%">No</th>
                        <th width="16%">Soal</th>
                        <th width="68%">Jawaban (Nilai)</th>
                        <th width="11%">Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $nopage + 1;
                    foreach ($soal as $view_soal) {
                    ?>
                      <tr>
                        <td><?=$no++?></td>
                        <td>
                          <?=nl2br($view_soal->soal_text)?>
                        </td>
                        <td>
                          a. <?=strip_tags(stripslashes($view_soal->soal_jawaban_a))?> - <span style="color:red;">(<?=$view_soal->soal_a_nilai?>)</span><br>
                          b. <?=strip_tags(stripslashes($view_soal->soal_jawaban_b))?> - <span style="color:red;">(<?=$view_soal->soal_b_nilai?>)</span><br>
                          c. <?=strip_tags(stripslashes($view_soal->soal_jawaban_c))?> - <span style="color:red;">(<?=$view_soal->soal_c_nilai?>)</span><br>
                          d. <?=strip_tags(stripslashes($view_soal->soal_jawaban_d))?> - <span style="color:red;">(<?=$view_soal->soal_d_nilai?>)</span>
                        </td>
                        <td>
                          <a href="<?=base_url()?>adm/soal/edit/<?=$view_soal->soal_id?>"><i class="fa fa-edit"></i> Edit</a> - 
                          <a href="<?=base_url()?>adm/soal/delete/<?=$view_soal->soal_id?>" onclick="return confirm('Apakah Anda yakin ingin Menghapus <?=$view_soal->soal_text ?>?')"><i class="fa fa-trash-o"></i> Del</a>
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