<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-sms mr-2"></i>
                        <?php echo lang('autosmstemplate') ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('autosmstemplate') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the Auto Sms templates names and related informations'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('category'); ?></th>
                                        <th><?php echo lang('message'); ?></th>
                                        <th><?php echo lang('status'); ?></th>
                                        <th><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

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











<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('edit'); ?> <?php echo lang('auto'); ?> <?php echo lang('template'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <?php echo validation_errors(); ?>
                <form role="form" id="smstemp" name="myform" action="sms/addNewAutoSMSTemplate" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('category'); ?> &ast; </label>
                            <input type="text" class="form-control form-control-lg" name="category" value='' placeholder="" required="" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('message'); ?> <?php echo lang('template'); ?> &ast; </label><br>
                            <div id="divbuttontag"></div>

                            <br><br>
                            <textarea class="" name="message" id="editor1" value="" cols="50" rows="10" required=""></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"> <?php echo lang('status'); ?> </label>
                            <select class="form-control form-control-lg" id="status" name="status">
                            </select>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="type" value='sms'>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/sms/autosmstemplate.js"></script>