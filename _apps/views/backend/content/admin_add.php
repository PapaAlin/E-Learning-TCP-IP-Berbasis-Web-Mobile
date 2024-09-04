      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Form Tambah Admin
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/admins">Admin</a></li>
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

                  <a href="<?=base_url()?>adm/admins" class="btn btn-primary" title="Back">
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
                  <form method="post" enctype="multipart/form-data" name="form1" id="form1" action="<?=base_url()?>adm/admins/add_save">

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Nama :</label>
                        <input type="text" name="admin_name" class="form-control" placeholder="Masukkan Nama" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Username :</label>
                        <input type="text" name="username" class="form-control" onKeyPress="return alphanumericOnly(event)" placeholder="Masukkan Username" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email :</label>
                        <input type="email" name="admin_email" class="form-control" placeholder="Masukkan Email Guru" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="admin_status">
                          <option value="1">Admin</option>
                          <option value="2">Super Admin</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Password :</label>
                        <input type="password" name="password1" class="form-control" placeholder="Masukkan Password" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Ulangi Password :</label>
                        <input type="password" name="password2" class="form-control" placeholder="Ulangi Password" />
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About :</label>
                        <textarea class="form-control" name="admin_about" rows="10" cols="80"></textarea>
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