<link href="common/extranal/css/facilitie.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-envelope mr-2"></i> <?php echo lang('facilities') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('facilities') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the facilitie names for frontend website'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_facilitie'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>

                                        <th><?php echo lang('title'); ?></th>
                                        <th><?php echo lang('Align'); ?></th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php foreach ($facilities as $facilitie) { ?>
                                        <tr class="">

                                            <td> <?php echo $facilitie->title; ?></td>
                                            <td><?php echo $facilitie->align; ?></td>
                                            <td class="no-print d-flex gap-1">
                                                <button type="button" class="btn btn-primary btn-sm btn_width editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $facilitie->id; ?>"><i class="fa fa-edit"> </i></button>
                                                <a class="btn btn-danger btn-sm btn_width delete_button" title="<?php echo lang('delete'); ?>" href="facilitie/delete?id=<?php echo $facilitie->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i></a>
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




<!-- Add Facilitie Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_facilitie'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="facilitie/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="title" value='' required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('Align'); ?> &ast;</label>
                            <select class="form-control form-control-lg m-bot15" name="align" value=''>
                                <option value="Right" <?php
                                                        if (!empty($setval)) {
                                                            if (set_value('align') == 'Right') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if (!empty($facilitie->align)) {
                                                            if ($facilitie->align == 'Right') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('Right'); ?> </option>
                                <option value="Left" <?php
                                                        if (!empty($setval)) {
                                                            if (set_value('align') == 'Left') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if (!empty($facilitie->align)) {
                                                            if ($facilitie->align == 'Left') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('Left'); ?> </option>
                            </select>
                        </div>


                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Facilitie Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_facilitie'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editFacilitieForm" class="clearfix" action="facilitie/addNew" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="title" value='' required="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('Align'); ?> &ast;</label>
                            <select class="form-control form-control-lg m-bot15" name="align" value=''>
                                <option value="Right" <?php
                                                        if (!empty($setval)) {
                                                            if (set_value('align') == 'Right') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if (!empty($facilitie->align)) {
                                                            if ($facilitie->align == 'Right') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('Right'); ?> </option>
                                <option value="Left" <?php
                                                        if (!empty($setval)) {
                                                            if (set_value('align') == 'Left') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        if (!empty($facilitie->align)) {
                                                            if ($facilitie->align == 'Left') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('Left'); ?> </option>
                            </select>
                        </div>

                        <input type="hidden" name="id" value=''>

                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
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
<script src="common/extranal/js/facilitie.js"></script>