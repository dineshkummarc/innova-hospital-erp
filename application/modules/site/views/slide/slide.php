<link href="common/extranal/css/slide.css" rel="stylesheet">
<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-images mr-2"></i><?php echo lang('slide') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('slide') ?></li>
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
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the slide names and related informations'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('image'); ?></th>
                                        <th><?php echo lang('title'); ?></th>
                                        <th><?php echo lang('text1'); ?></th>
                                        <th><?php echo lang('text2'); ?></th>
                                        <th><?php echo lang('text3'); ?></th>
                                        <th><?php echo lang('position'); ?></th>
                                        <th><?php echo lang('status'); ?></th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($slides as $slide) { ?>
                                        <tr class="">
                                            <td class="align-middle"><img class="img-fluid rounded-circle" style="width: 50px; height: 50px;" src="<?php echo $slide->img_url; ?>"></td>
                                            <td> <?php echo $slide->title; ?></td>
                                            <td><?php echo $slide->text1; ?></td>
                                            <td><?php echo $slide->text2; ?></td>
                                            <td><?php echo $slide->text3; ?></td>
                                            <td><?php echo $slide->position; ?></td>
                                            <td>
                                                <?php
                                                if ($slide->status == 'Active') {
                                                    echo lang('active');
                                                } else {
                                                    echo lang('in_active');
                                                }
                                                ?>
                                            </td>
                                            <td class="no-print d-flex gap-1">
                                                <a type="button" class="btn btn-info btn-sm editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $slide->id; ?>"><i class="fa fa-edit"> </i></a>
                                                <a class="btn btn-danger btn-sm" title="<?php echo lang('delete'); ?>" href="site/slide/delete?id=<?php echo $slide->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
                                            </td>
                                        </tr>
                                    <?php } ?>




                                </tbody>
                            </table>
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









<!-- Add Slide Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_slide'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="site/slide/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="title" value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('text1'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="text1" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('text2'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="text2" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('text3'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="text3" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('position'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="position" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control form-control-lg m-bot15" name="status" value='' required="">
                            <option value="Active" <?php
                                                    if (!empty($setval)) {
                                                        if ($slide->status == set_value('status')) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    if (!empty($slide->status)) {
                                                        if ($slide->status == 'Active') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> <?php echo lang('active'); ?>
                            </option>
                            <option value="Inactive" <?php
                                                        if (!empty($setval)) {
                                                            if ($slide->status == set_value('status')) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if (!empty($slide->status)) {
                                                            if ($slide->status == 'Inactive') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('in_active'); ?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('image'); ?> </label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                    <img src="" width="150px" alt="" />
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

                    <input type="hidden" name="id" value=''>


                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Slide Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_slide'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="site/slide/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="title" value='' required="">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('text1'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="text1" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('text2'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="text2" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('text3'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="text3" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('position'); ?> &#42;</label>
                        <input type="text" class="form-control form-control-lg" name="position" value='' placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('status'); ?> &#42;</label>
                        <select class="form-control form-control-lg m-bot15" name="status" value='' required="">
                            <option value="Active" <?php
                                                    if (!empty($setval)) {
                                                        if ($slide->status == set_value('status')) {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    if (!empty($slide->status)) {
                                                        if ($slide->status == 'Active') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>> <?php echo lang('active'); ?>
                            </option>
                            <option value="Inactive" <?php
                                                        if (!empty($setval)) {
                                                            if ($slide->status == set_value('status')) {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if (!empty($slide->status)) {
                                                            if ($slide->status == 'Inactive') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('in_active'); ?>
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?php echo lang('image'); ?> </label>
                        <div class="">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                    <img src="" id="img" width="150px" alt="" />
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

                    <input type="hidden" name="id" value=''>

                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/site/slide.js"></script>