<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-user-tie mr-2"></i>
                        <?php
                        if (!empty($accountant->id))
                            echo lang('edit_accountant');
                        else
                            echo lang('add_accountant');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($accountant->id))
                                                                echo lang('edit_accountant');
                                                            else
                                                                echo lang('add_accountant');
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
                            <form role="form" action="accountant/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &#42;</label>
                                    <br>
                                    <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('name');
                                                                                                                                        }
                                                                                                                                        if (!empty($accountant->name)) {
                                                                                                                                            echo $accountant->name;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('email'); ?> &#42;</label>
                                    <br>
                                    <input type="email" class="form-control form-control-lg" name="email" id="exampleInputEmail1" value='<?php
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('email');
                                                                                                                                            }
                                                                                                                                            if (!empty($accountant->email)) {
                                                                                                                                                echo $accountant->email;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('password'); ?> <?php if (empty($accountant->id)) { ?> &#42; <?php } ?> </label>
                                    <br>
                                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputEmail1" placeholder="********" <?php if (empty($accountant->id)) { ?> required="" <?php } ?>>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('address'); ?> &#42;</label>
                                    <br>
                                    <input type="text" class="form-control form-control-lg" name="address" id="exampleInputEmail1" value='<?php
                                                                                                                                            if (!empty($setval)) {
                                                                                                                                                echo set_value('address');
                                                                                                                                            }
                                                                                                                                            if (!empty($accountant->address)) {
                                                                                                                                                echo $accountant->address;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('phone'); ?> &#42;</label>
                                    <br>
                                    <input type="text" class="form-control form-control-lg" name="phone" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('phone');
                                                                                                                                        }
                                                                                                                                        if (!empty($accountant->phone)) {
                                                                                                                                            echo $accountant->phone;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required="">
                                </div>

                                <div class="col-md-12 row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('signature'); ?> &ast; </label>
                                        <br>
                                        <div class="">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                    <img src="<?php

                                                                if (!empty($accountant->signature)) {
                                                                    echo $accountant->signature;
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
                                        <br>
                                        <div class="">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                    <img src="<?php

                                                                if (!empty($accountant->img_url)) {
                                                                    echo $accountant->img_url;
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
                                    <br>
                                    <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="10" cols="20"><?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('profile');
                                                                                                                                        }
                                                                                                                                        if (!empty($accountant->profile)) {
                                                                                                                                            echo $accountant->profile;
                                                                                                                                        }
                                                                                                                                        ?></textarea>

                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($accountant->id)) {
                                                                            echo $accountant->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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

<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/accountant.js"></script>