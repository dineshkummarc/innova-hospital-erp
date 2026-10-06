<link href="common/extranal/css/import.css" rel="stylesheet">


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-file-import mr-2"></i><?php echo lang('bulk'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('bilk') ?> <?php echo lang('import'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 row">
                    <div class="row">
                        <div class="card col-md-6 mr-5">
                            <header class="card-header">
                                <?php echo lang('import'); ?> <?php echo lang('bulk'); ?> <?php echo lang('patient'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv)

                            </header>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <blockquote>
                                        <a href="files/downloads/patient_xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                                        <br> <?php echo lang('please_follow_the_exact_format'); ?>.
                                    </blockquote>
                                </div>
                                <!-- left column -->
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <!-- form start -->
                                        <form role="form" action="<?php echo site_url('import/importPatientInfo') ?>" class="clearfix" method="post" enctype="multipart/form-data">
                                            <div class="box-body">
                                                <div class="form-group has-feedback">
                                                    <label for="exampleInputEmail1"> <?php echo lang('choose_file'); ?></label>
                                                    <input type="file" class="form-control form-control-lg" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv" required>
                                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                                    <input type="hidden" name="tablename" value="patient">
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-md-5">
                            <header class="card-header">
                                <?php echo lang('bulk'); ?> <?php echo lang('doctor'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv)

                            </header>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <blockquote>
                                        <a href="files/downloads/doctor_xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                                        <br> <?php echo lang('please_follow_the_exact_format'); ?>.
                                    </blockquote>
                                </div>
                                <!-- left column -->
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <!-- form start -->
                                        <form role="form" action="<?php echo site_url('import/importDoctorInfo') ?>" class="clearfix" method="post" enctype="multipart/form-data">
                                            <div class="box-body">
                                                <div class="form-group has-feedback">
                                                    <label for="exampleInputEmail1"> <?php echo lang('choose_file'); ?></label>
                                                    <input type="file" class="form-control form-control-lg" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv">
                                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                                    <input type="hidden" name="tablename" value="doctor">
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <?php
                                    $message1 = $this->session->flashdata('message1');
                                    if (!empty($message1)) {
                                    ?>
                                        <code class="flash_message pull-right"> <?php echo $message1; ?></code>
                                    <?php } ?>
                                </div>

                            </div>

                        </div>
                        <div class="card col-md-6">
                            <header class="card-header">
                                <?php echo lang('bulk'); ?> <?php echo lang('medicine'); ?> <?php echo lang('import'); ?> (xl, xlsx, csv)

                            </header>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <blockquote>
                                        <a href="files/downloads/medicine_xl_format.xlsx"><?php echo lang('download'); ?></a> <?php echo lang('the_format_of_xl_file'); ?>.
                                        <br> <?php echo lang('please_follow_the_exact_format'); ?>.
                                    </blockquote>
                                </div>
                                <!-- left column -->
                                <div class="col-md-12">
                                    <!-- general form elements -->
                                    <div class="box box-primary">
                                        <!-- form start -->
                                        <form role="form" action="<?php echo site_url('import/importMedicineInfo') ?>" class="clearfix" method="post" enctype="multipart/form-data">
                                            <div class="box-body">
                                                <div class="form-group has-feedback">
                                                    <label for="exampleInputEmail1"> <?php echo lang('choose_file'); ?></label>
                                                    <input type="file" class="form-control form-control-lg" placeholder="" name="filename" required accept=".xls, .xlsx ,.csv" required="">
                                                    <span class="glyphicon glyphicon-file form-control-feedback"></span>
                                                    <input type="hidden" name="tablename" value="medicine">
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <?php
                                    $message2 = $this->session->flashdata('message2');
                                    if (!empty($message2)) {
                                    ?>
                                        <code class="flash_message pull-right"> <?php echo $message2; ?></code>
                                    <?php } ?>
                                </div>

                            </div>

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
    </div>

    <!-- /.content -->
</div>