<!--sidebar end-->
<!--main content start-->

<link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/global-modal-styles.css">





<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-file-alt text-primary mr-3"></i>
                        <?php echo lang('documents'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="patient"> <?php echo lang('patient'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('documents'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal1" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?>
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
                                        <th class="font-weight-bold"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('description'); ?></th>
                                        <th class="font-weight-bold document_table"><?php echo lang('document'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table data will go here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



















<div class="modal fade modal-enhanced" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-file-upload mr-2"></i>
                    <?php echo lang('add'); ?> <?php echo lang('files'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &ast; </label>
                        <select class="form-control col-sm-9 m-bot15" id="patientchoose" name="patient" value='' required="">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-lg" name="title" placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?> &ast;</label>
                        <input type="file" class="form-control form-control-lg" name="img_url" required="">
                    </div>
                    <span class="help-block"><?php echo lang('recommended_size'); ?> : 3000 x 2024</span>
                    <input type="hidden" name="redirect" value='patient/documents'>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/patient/documents.js"></script>