      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Daftar User
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>adm"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/users">User</a></li>
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

                <div class="box-header">
                  <form action="" method="get" name="form1" style="padding: 9px 0px;">
                    <div class="col-md-3" style="margin-bottom: 5px;">
                      <input type="text" name="nama" value="<?=$nama?>" class="form-control" placeholder="Masukkan Nama User">
                    </div>
                      <button type="submit" class="btn btn-success" name="search" style="margin: 0 2px 0 7px;"><i class="fa fa-search"></i> Search</button>
                      <a href="<?=base_url()?>adm/users" class="btn btn-primary"><i class="fa fa-refresh"></i> Tampilkan Semua</a>
                </form>
                </div>

                <div class="box-body">
                  <table class="table table-bordered table-hover">

                    <thead>
                      <tr style="background-color: #B9B7B7;">
                        <th width="5%">No</th>
                        <th width="55%">Nama User</th>
                        <th width="25%">ALamat</th>
                        <th width="10%">JK</th>
                      </tr>
                    </thead>

                    <tbody>
                    <?php
                    $no = $nopage + 1;
                    foreach ($user as $view_user) {
                      $user_name = preg_replace("/\s/","-",$view_user->user_name);
                    ?>
                      <tr>
                        <td><?=$no++?></td>
                        <td>
                          <a href="<?=base_url()?>adm/users/detail/<?=$view_user->user_id?>/<?=$user_name?>"><?=strip_tags(stripslashes($view_user->user_name))?></a><br>
                            <?=$view_user->user_nip ?><br>
                            <?=$view_user->user_email ?><br>
                          <a href="<?=base_url()?>adm/users/detail/<?=$view_user->user_id?>"><i class="fa fa-list-alt"> Lihat</i></a> - 
                          <a href="<?=base_url()?>adm/users/delete/<?=$view_user->user_id?>" onclick="return confirm('Apakah Anda yakin ingin Menghapus <?=$view_user->user_name ?>?')"><i class="fa fa-trash-o"> Delete</i></a>
                        </td>
                        <td>
                          <?=$view_user->user_alamat ?>
                        </td>
                        <td>
                          <?php if($view_user->user_jk == "1") echo "Laki-laki"; else echo "Perempuan"; ?>
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