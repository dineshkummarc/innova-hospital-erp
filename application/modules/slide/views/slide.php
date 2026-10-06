<link href="common/extranal/css/slide.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-images mr-2"></i>
                        <?php echo lang('slide') ?>
                    </h1>
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('image'); ?></th>
                                        <th><?php echo lang('title'); ?></th>
                                        <th><?php echo lang('description'); ?></th>
                                        <th><?php echo lang('button_link'); ?> 1</th>
                                        <th><?php echo lang('button_link'); ?> 2</th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php foreach ($slides as $slide) { ?>
                                        <tr class="">
                                            <td class="img_class"><img class="img" src="<?php echo $slide->img_url; ?>"></td>
                                            <td><?php echo $slide->text1; ?></td>
                                            <td><?php echo $slide->text2; ?></td>
                                            <td><?php echo $slide->text3; ?></td>
                                            <td><?php echo $slide->status; ?></td>
                                            <td class="no-print d-flex gap-1">
                                                <a type="button" class="btn btn-primary btn-sm btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $slide->id; ?>"><i class="fa fa-edit"> </i></a>
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



<!--main content end-->
<!--footer start-->








<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_slide'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <form role="form" id="editSlideForm" class="clearfix" action="slide/addNew" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <input type="hidden" class="form-control form-control-lg" name="title" id="exampleInputEmail1" value=''>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="text1" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="text2" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('button_link'); ?> 1 &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="text3" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('button_link'); ?> 2 &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="status" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control form-control-lg" name="position" id="exampleInputEmail1" value='' placeholder="">
                        </div>
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('status'); ?> &ast;</label>
                            <select class="form-control form-control-lg m-bot15" type="hidden" name="status" value=''>
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
                        </div> -->
                        <div class="form-group last">
                            <label class="control-label">Image Upload</label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_url">
                                        <img src="" id="img" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                            <input type="file" class="default" name="img_url" />
                                        </span>
                                    </div>
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
<script src="common/extranal/js/slide.js"></script>