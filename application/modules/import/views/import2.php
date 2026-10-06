      <!--sidebar end-->
      <!--main content start-->

      <div class="content-wrapper bg-light">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <div class="container-fluid">
                  <div class="row my-2 pl-1">
                      <div class="col-sm-6">
                          <h1 class="font-weight-bold"><i class="fas fa-file-import mr-2"></i><?php echo lang('import'); ?> <?php echo lang('module'); ?></h1>
                      </div>
                      <div class="col-sm-6">
                          <ol class="breadcrumb float-sm-right">
                              <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                              <li class="breadcrumb-item active"><?php echo lang('department') ?></li>
                          </ol>
                      </div>
                  </div>
              </div><!-- /.container-fluid -->
          </section>

          <!-- Main content -->
          <section class="content">
              <div class="container-fluid">
                  <div class="row">
                      <div class="col-12">
                          <div class="card">
                              <div class="row">
                                  <div class="col-md-4">
                                  </div>
                                  <!-- left column -->
                                  <div class="col-md-4">

                                      <div class="box box-primary">
                                          <div class="box-header with-border">
                                              <h3 class="box-title">Import student data</h3>
                                          </div>

                                          <form role="form" action="<?php echo site_url('import/importfile') ?>" method="post" enctype="multipart/form-data">
                                              <div class="box-body">
                                                  <div class="form-group has-feedback">
                                                      <label for="exampleInputEmail1"> Choose Files</label>
                                                      <input type="file" class="form-control form-control-lg" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv">
                                                      <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                                  </div>
                                                  <div class="box-footer">
                                                      <button type="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                                                  </div>

                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>

                          </div>
                          <!-- /.card -->
                      </div>
                      <!-- /.col -->
                  </div>
                  <!-- /.row -->
              </div>
              <!-- /.container-fluid -->
          </section>

          <!-- /.content -->
      </div>