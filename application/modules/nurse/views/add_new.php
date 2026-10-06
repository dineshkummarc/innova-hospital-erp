<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-nurse mr-2"></i><?php
                                                                                        if (!empty($nurse->id))
                                                                                            echo lang('edit_nurse');
                                                                                        else
                                                                                            echo lang('add_nurse');
                                                                                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($nurse->id))
                                                                echo lang('edit_nurse');
                                                            else
                                                                echo lang('add_nurse');
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
                <div class="col-7">
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
                            <form role="form" action="nurse/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('name');
                                                                                                                                        }
                                                                                                                                        if (!empty($nurse->name)) {
                                                                                                                                            echo $nurse->name;
                                                                                                                                        }
                                                                                                                                        ?>'>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('email'); ?> &ast;</label>
                                    <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" value='<?php
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('email');
                                                                                                                                            }
                                                                                                                                            if (!empty($nurse->email)) {
                                                                                                                                                echo $nurse->email;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('password'); ?><?php if (empty($nurse->email)) { ?> &ast; <?php } ?></label>
                                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputEmail1" placeholder="********" <?php if (empty($nurse->email)) { ?> required="" <?php } ?>>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('address'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="address" id="exampleInputEmail1" value='<?php
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('address');
                                                                                                                                            }
                                                                                                                                            if (!empty($nurse->address)) {
                                                                                                                                                echo $nurse->address;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('phone'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="phone" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('phone');
                                                                                                                                        }
                                                                                                                                        if (!empty($nurse->phone)) {
                                                                                                                                            echo $nurse->phone;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="">
                                </div>





                                <div class="col-md-12 row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('signature'); ?> &ast; </label>
                                        <div class="">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                    <img src="<?php

                                                                if (!empty($nurse->signature)) {
                                                                    echo $nurse->signature;
                                                                }
                                                                ?>" height="100px" alt="" />
                                                </div>
                                                <div>
                                                    <span class="btn btn-white btn-file">
                                                        <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                        <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                        <input type="file" class="default" name="signature" />
                                                    </span>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="form-group last col-md-6">
                                        <label class="control-label"><?php echo lang('image'); ?> </label>
                                        <div class="">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                    <img src="<?php

                                                                if (!empty($nurse->img_url)) {
                                                                    echo $nurse->img_url;
                                                                }
                                                                ?>" height="100px" alt="" />
                                                </div>
                                                <div>
                                                    <span class="btn btn-white btn-file">
                                                        <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                        <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                        <input type="file" class="default" name="img_url" />
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('profile'); ?> &ast; </label>
                                    <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="10" cols="20"><?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('profile');
                                                                                                                                        }
                                                                                                                                        if (!empty($nurse->profile)) {
                                                                                                                                            echo $nurse->profile;
                                                                                                                                        }
                                                                                                                                        ?></textarea>

                                </div>


                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($nurse->id)) {
                                                                            echo $nurse->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/nurse.js"></script>