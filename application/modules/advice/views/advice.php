<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-comment-medical text-primary mr-3"></i>
                        <?php echo lang('advice_list'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('advice_list'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('advice'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase">#</th>
                                        <th class="font-weight-bold"><?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>






<!--main content end-->
<!--footer start-->




<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
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
                        <textarea class="form-control ckeditor" id="editor1" name="description" value="<?php
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_advice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editAdviceForm" class="clearfix" action="advice/addNew" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="id" value=''>

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
                        <textarea class="form-control form-control-lg" id="editor3" name="description" value="" rows="30" cols="20"></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/advice.js"></script>