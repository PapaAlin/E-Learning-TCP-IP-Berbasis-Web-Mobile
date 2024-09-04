      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?=$page_title?>
            <!--
            <small>Advanced form element</small>
            -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?=base_url()?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?=base_url()?>adm/penilaian">Penilaian</a></li>
            <li class="active">Detail</li>
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

                  <a onclick="history.go(-1);" class="btn btn-primary" title="Back">
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

                  <?php

                  //user
                  $view_user = $this->Penilaianmodel->select_db("tbl_users","user_id",$view_penilaian->user_id)->row();
                  ?>

                  <div class="col-md-12">
                    
                    <div class="form-group">
                      <label>Nama User :</label>
                      <input type="text" disabled class="form-control" value="<?=$view_user->user_name?>" />
                    </div>
                    
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Email :</label>
                        <input type="text" disabled class="form-control" value="<?=$view_user->user_email?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>jenis Kelamin :</label>
                        <input type="text" disabled class="form-control" value="<?php if($view_user->user_jk == "1") echo "Laki-laki"; else echo "Perempuan"; ?>" />
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Tanggal Lahir :</label>
                        <input type="text" disabled class="form-control" value="<?=$this->tgl_indonesia->tgl_indo_date($view_user->tgl_lahir)?>" />
                      </div>
                    </div>

                    <div class="form-group">
                      <label>Alamat User :</label>
                      <textarea class="form-control" disabled rows="4"><?=$view_user->user_alamat?></textarea>
                    </div>

                  </div>

                </div>

                <!--skills -->
                <div class="box-body pad">
                  <h3 style="text-align: center; font-weight: bold; color: #F20000; border: 2px solid; padding: 7px; background-color: #F4F4F4; ">HASIL TES</h3><br><br>
                  <div class="modal-spa">
                    <div class="skills">

                      <div class="col-md-10 bar-grids bargrids-left">

                        <?php

                        $view_nilai_1 = $view_total_nilai["0"];
                        $view_nilai_2 = $view_total_nilai["1"];

                        $kepribadian_1_persen = ($view_nilai_1->total_nilai/40)*100;
                        $kepribadian_2_persen = ($view_nilai_2->total_nilai/40)*100;
                        ?>

                        <h2 style="font-weight: bold;"><span class="glyphicon glyphicon-cog"></span> Kepribadian Pertama (<?= $view_kepribadian_1->kepribadian_nama ?>)</h2>
                        <h4>Nilai <?=$view_nilai_1->jawaban_nilai?> ( <?=$view_nilai_1->total_nilai?> Jawaban dari 40 Soal )</h4>
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped active" style="width: <?= $kepribadian_1_persen ?>%">
                          </div>
                        </div>

                        <h4 style="text-align:justify;">
                          <?= nl2br($view_kepribadian_1->kepribadian_ket) ?>
                        </h4>
                        <hr>
                        
                        <h3 style="text-decoration: underline; font-weight: bold; margin-bottom: 10px;">
                          KEKUATAN
                        </h3>
                        <h4>
                          <?= nl2br($view_kepribadian_1->kepribadian_kekuatan) ?>
                        </h4>
                        <br>

                        <h3 style="text-decoration: underline; font-weight: bold; margin-bottom: 10px;">
                          KELEMAHAN
                        </h3>
                        <h4>
                          <?= nl2br($view_kepribadian_1->kepribadian_kelemahan) ?>
                        </h4>

                      </div>

                      <div class="clearfix"> </div>

                    </div>
                  </div>
                </div> 
                <!-- //skills -->

              </div><!-- /.box -->

            </div><!-- /.col-->
          </div><!-- ./row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->