<?php
//flashdata
$msg = $this->session->flashdata('message_flashdata');
if($msg):
?>
            <div class="col-md-12">
                <div class="box-body">
                  <?php                  
                  if($msg['type'] == "danger")
                  {
                  ?>
                    <div class="alert alert-danger alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-info"></i> Alert!</h4>
                      <?=$msg['message']?>
                    </div>
                  <?php
                  }
                  else if($msg['type'] == "info")
                  {
                  ?>
                    <div class="alert alert-info alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-info"></i> Alert!</h4>
                      <?=$msg['message']?>
                    </div>
                  <?php
                  }
                  else if($msg['type'] == "warning")
                  {
                  ?>
                    <div class="alert alert-warning alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                      <?=$msg['message']?>
                    </div>
                  <?php
                  }
                  else if($msg['type'] == "success")
                  {
                  ?>
                    <div class="alert alert-success alert-dismissable">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-info"></i> Alert!</h4>
                      <?=$msg['message']?>
                    </div>
                  <?php
                  }
                  ?>
                </div><!-- /.box-body -->
            </div><!-- /.col -->
<?php
endif;
?>