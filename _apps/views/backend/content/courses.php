      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Courses
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>adm"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/courses">Courses</a></li>
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

                  <a href="<?=base_url()?>adm/courses/add" class="btn btn-success" title="Add Admin">
                    <span><i class="fa fa-plus"></i> Tambah Courses</span>
                  </a>

                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" name="Collapse"><i class="fa fa-minus"></i></button>
                    <!--
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" name="Remove"><i class="fa fa-times"></i></button>
                    -->
                  </div><!-- /. tools -->
                </div><!-- /.box-header -->

                <div class="box-body">
                
                  <div class="box-header">
                    <form action="" method="get" name="form1" style="border: solid 1px black; padding: 9px 0px;">
                      <div class="col-md-3" style="margin-bottom: 5px;">
                        <input type="text" name="title" value="<?=$get_title?>" class="form-control" placeholder="Masukkan Judul Courses">
                      </div>
                        <button type="submit" class="btn btn-success" name="search" style="margin: 0 5px 0 10px;"><i class="fa fa-search"></i> Search</button>
                        <a href="<?=base_url()?>adm/courses" class="btn btn-primary"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
                    </form>
                  </div>

                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr style="background-color: #B9B7B7;">
                        <th width="5%">No</th>
                        <th width="90%">Judul</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $nopage + 1;
                    foreach ($course as $view_courses) {
                    ?>
                      <tr>
                        <td><?=$no++?></td>
                        <td>
                          
                          <a href="#"><?=strip_tags(stripslashes($view_courses->course_title))?></a><br>
                          <div style="text-align: justify;">
                            <?=substr(strip_tags(stripslashes($view_courses->course_desc)),0,100)?>
                          </div>
                          <i class="fa fa-calendar" style="color: #4F57FF;"> <?=$this->tgl_indonesia->tgl_indo_full($view_courses->course_created)?></i><br>
                          
                          <a href="<?=base_url()?>adm/courses/edit/<?=$view_courses->course_id?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a> - 
                          
                          <a href="<?=base_url()?>adm/courses/delete/<?=$view_courses->course_id?>" onclick="return confirm('Apakah Anda yakin ingin Menghapus <?=$view_courses->course_title ?>?')" class="btn btn-success"><i class="fa fa-trash-o"></i> Delete</a> - 

                          <a href="<?=base_url()?>adm/courses/soal/<?=$view_courses->course_id?>" class="btn btn-success"><i class="fa fa-edit"></i> Daftar Soal</a>
                        
                        </td>
                        <td>
                          
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