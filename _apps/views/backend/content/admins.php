      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar Guru
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>adm"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/admins">Admin</a></li>
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

                  <a href="<?=base_url()?>adm/admins/add" class="btn btn-success" title="Add Admin">
                    <span><i class="fa fa-plus"></i> Tambah Guru</span>
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
                        <input type="text" name="name" value="<?=$get_name?>" class="form-control" placeholder="Masukkan Nama Admin">
                      </div>
                        <button type="submit" class="btn btn-success" name="search" style="margin: 0 2px 0 7px;"><i class="fa fa-search"></i> Search</button>
                        <a href="<?=base_url()?>adm/admins" class="btn btn-primary"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
                    </form>
                  </div>

                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr style="background-color: #B9B7B7;">
                        <th width="5%">No</th>
                        <th width="50%">Username (Email)</th>
                        <th width="10%">Status</th>
                        <th width="20%">Created</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $nopage + 1;
                    foreach ($admins as $view_admin) {

                      switch ($view_admin->admin_status) {
                        case '1':
                          $admin_status = "Admin";
                          $class_color = "";
                          break;
                          
                        case '2':
                          $admin_status = "Super Admin";
                          $class_color = "";
                          break;
                          
                        default:
                          $admin_status = "";
                          break;
                      }
                    ?>
                      <tr style="background-color: <?=$class_color?>;">
                        <td><?=$no++?></td>
                        <td>
                          <?=strip_tags(stripslashes($view_admin->admin_name))?><br>
                          <i class="fa fa-user"></i> <?php echo $view_admin->username." (".$view_admin->admin_email.")" ?>
                        </td>
                        <td>
                          (<?=$admin_status?>)
                        </td>
                        <td>
                          <i class="fa fa-calendar"></i> <?=$view_admin->admin_date?>
                        </td>
                        <td>
                          <a href="<?=base_url()?>adm/admins/edit/<?=$view_admin->admin_id?>"><i class="fa fa-edit"></i> Edit</a> - 
                          <a href="<?=base_url()?>adm/admins/delete/<?=$view_admin->admin_id?>" onclick="return confirm('Apakah Anda yakin ingin Menghapus <?=$view_admin->admin_name ?>?')"><i class="fa fa-trash-o"></i> Delete</a>
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