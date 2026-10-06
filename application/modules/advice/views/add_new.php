<!--sidebar end-->
<!--main content start-->





<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-comment-medical mr-2"></i>
                        <?php
                        if (!empty($advice->id))
                            echo lang('edit_advice');
                        else
                            echo lang('add_new_advice');
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($advice->id))
                                                                echo lang('edit_advice');
                                                            else
                                                                echo lang('add_new_advice');
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
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('add_advice') ?> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="advice/addNew" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('name'); ?> </label>
                                    <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($setval)) {
                                                                                                                                            echo set_value('name');
                                                                                                                                        }
                                                                                                                                        if (!empty($advice->name)) {
                                                                                                                                            echo $advice->name;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('description'); ?> </label>
                                    <textarea class="form-control col-sm-9 ckeditor" id="editor1" name="description" value="<?php
                                                                                                                            if (!empty($setval)) {
                                                                                                                                echo set_value('description');
                                                                                                                            }
                                                                                                                            if (!empty($advice->description)) {
                                                                                                                                echo $advice->description;
                                                                                                                            }
                                                                                                                            ?>" rows="10" cols="20"></textarea>


                                </div>

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









<!--main content end-->
<!--footer start-->

<!--footer start-->
<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/advice.js"></script>