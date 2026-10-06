  <link href="common/extranal/css/file/add_new.css" rel="stylesheet">

  <div class="content-wrapper bg-light">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row my-2 pl-1">
                  <div class="col-sm-6">
                      <h1 class="font-weight-bold"><i class="fas fa-envelope mr-2"></i> <?php
                                                                                        if (!empty($file->id))
                                                                                            echo lang('edit_file');
                                                                                        else
                                                                                            echo lang('add_file');
                                                                                        ?></h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                          <li class="breadcrumb-item active"><?php
                                                                if (!empty($file->id))
                                                                    echo lang('edit_file');
                                                                else
                                                                    echo lang('add_file');
                                                                ?></li>
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

                          <!-- /.card-header -->
                          <div class="card-body">
                              <div class="col-lg-12">
                                  <div class="col-lg-3"></div>
                                  <div class="col-lg-6">
                                      <?php echo validation_errors(); ?>
                                      <?php echo $this->session->flashdata('feedback'); ?>
                                  </div>
                                  <div class="col-lg-3"></div>
                              </div>
                              <form role="form" action="file/addNew" method="post" enctype="multipart/form-data">
                                  <div class="">
                                      <div class="col-md-6">
                                          <div class="form-group">
                                              <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast; </label>
                                              <input type="text" class="form-control form-control-lg" name="title" id="exampleInputEmail1" value='<?php
                                                                                                                                                    if (!empty($setval)) {
                                                                                                                                                        echo set_value('title');
                                                                                                                                                    }
                                                                                                                                                    if (!empty($file->title)) {
                                                                                                                                                        echo $file->title;
                                                                                                                                                    }
                                                                                                                                                    ?>' required="">
                                          </div>






                                          <div class="form-group">
                                              <label class="control-label col-sm-3"><?php echo lang('upload_file'); ?></label>
                                              <div class="col-sm-9">
                                                  <div class="fileupload fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                          <img src="<?php
                                                                    if (!empty($file->img_url)) {
                                                                        echo $file->img_url;
                                                                    }
                                                                    ?>" id="img" height="100px" alt="" />
                                                      </div>
                                                      <div>
                                                          <span class="btn btn-white btn-file">
                                                              <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select'); ?> <?php echo lang('file'); ?></span>
                                                              <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                              <input type="file" class="default" name="img_url" required />
                                                          </span>
                                                      </div>
                                                  </div>

                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-group pos_client d-flex">
                                              <label for="exampleInputEmail1"> <?php echo lang('permission_for'); ?> :</label>
                                              <div class="col-sm-9">
                                                  <input type='checkbox' value="doctor" name="module[]" <?php
                                                                                                        if (!empty($file->id)) {
                                                                                                            $modules = $this->file_model->getFileById($file->id)->module;
                                                                                                            $modules1 = explode(',', $modules);
                                                                                                            if (in_array('doctor', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('doctor'); ?>

                                                  <br>
                                                  <input type='checkbox' value="nurse" name="module[]" <?php
                                                                                                        if (!empty($file->id)) {
                                                                                                            if (in_array('nurse', $modules1)) {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                        } else {
                                                                                                            echo 'checked';
                                                                                                        }
                                                                                                        ?>> <?php echo lang('nurse'); ?>


                                                  <br>
                                                  <input type='checkbox' value="accountant" name="module[]" <?php
                                                                                                            if (!empty($file->id)) {
                                                                                                                if (in_array('accountant', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('accountant'); ?>
                                                  <br>
                                                  <input type='checkbox' value="pharmacist" name="module[]" <?php
                                                                                                            if (!empty($file->id)) {
                                                                                                                if (in_array('pharmacist', $modules1)) {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                            } else {
                                                                                                                echo 'checked';
                                                                                                            }
                                                                                                            ?>> <?php echo lang('pharmacist'); ?>

                                                  <br>
                                                  <input type='checkbox' value="laboratorist" name="module[]" <?php
                                                                                                                if (!empty($file->id)) {
                                                                                                                    if (in_array('laboratorist', $modules1)) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                                ?>> <?php echo lang('laboratorist'); ?>

                                                  <br>
                                                  <input type='checkbox' value="receptionist" name="module[]" <?php
                                                                                                                if (!empty($file->id)) {
                                                                                                                    if (in_array('receptionist', $modules1)) {
                                                                                                                        echo 'checked';
                                                                                                                    }
                                                                                                                } else {
                                                                                                                    echo 'checked';
                                                                                                                }
                                                                                                                ?>> <?php echo lang('receptionist'); ?>

                                                  <br>
                                              </div>

                                          </div>
                                      </div>
                                      <input type="hidden" name="id" value='<?php
                                                                            if (!empty($file->id)) {
                                                                                echo $file->id;
                                                                            }
                                                                            ?>'>
                                      <div class="col-md-12">
                                          <button type="submit" name="submit" class="btn btn-info btn-group float-right"><?php echo lang('submit'); ?></button>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <!-- /.card-body -->
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



  <!--main content end-->
  <!--footer start-->