<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-user-plus mr-2"></i>
                        <?php
                        if (!empty($receptionist->id))
                            echo lang('edit_receptionist');
                        else
                            echo lang('add_receptionist');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($receptionist->id))
                                                                echo lang('edit_receptionist');
                                                            else
                                                                echo lang('add_receptionist');
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
                                </div>
                                <div class="col-lg-3"></div>
                            </div>
                            <form role="form" action="receptionist/addNew" method="post" enctype="multipart/form-data">
                                <div class="form-group">


                                    <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                if (!empty($setval)) {
                                                                                                                    echo set_value('name');
                                                                                                                }
                                                                                                                if (!empty($receptionist->name)) {
                                                                                                                    echo $receptionist->name;
                                                                                                                }
                                                                                                                ?>' placeholder="">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('email'); ?> &ast;</label>
                                    <input type="email" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('email');
                                                                                                                    }
                                                                                                                    if (!empty($receptionist->email)) {
                                                                                                                        echo $receptionist->email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('address'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="address" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('address');
                                                                                                                    }
                                                                                                                    if (!empty($receptionist->address)) {
                                                                                                                        echo $receptionist->address;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('phone'); ?> &ast;</label>
                                    <input type="number" class="form-control form-control-lg" name="phone" value='<?php
                                                                                                                    if (!empty($setval)) {
                                                                                                                        echo set_value('phone');
                                                                                                                    }
                                                                                                                    if (!empty($receptionist->phone)) {
                                                                                                                        echo $receptionist->phone;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" required="">
                                </div>


                                <div class="col-md-12 row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> <?php echo lang('signature'); ?> &ast; </label>
                                        <div class="">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                                    <img src="<?php

                                                                if (!empty($receptionist->signature)) {
                                                                    echo $receptionist->signature;
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

                                                                if (!empty($receptionist->img_url)) {
                                                                    echo $receptionist->img_url;
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



                                <div class="form-group profile">
                                    <label for="exampleInputEmail1"> <?php echo lang('profile'); ?> &ast; </label>
                                    <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="10" cols="20"><?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('profile');
                                                                                                                                        }
                                                                                                                                        if (!empty($receptionist->profile)) {
                                                                                                                                            echo $receptionist->profile;
                                                                                                                                        }
                                                                                                                                        ?></textarea>


                                </div>


                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($receptionist->id)) {
                                                                            echo $receptionist->id;
                                                                        }
                                                                        ?>'>


                                <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
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
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/receptionist.js"></script>