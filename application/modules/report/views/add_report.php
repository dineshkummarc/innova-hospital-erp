<!--sidebar end-->
<!--main content start-->




<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas <?php echo (!empty($report->id)) ? 'fa-edit' : 'fa-plus-circle'; ?> mr-2"></i>
                        <?php
                        if (!empty($report->id)) {
                            echo lang('edit_report');
                        } else {
                            echo lang('add_new_report');
                        }
                        ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php
                                                            if (!empty($report->id)) {
                                                                echo '<i class="fa fa-edit"></i> ' . lang('edit_report');
                                                            } else {
                                                                echo '<i class="fa fa-plus-circle"></i> ' . lang('add_new_report');
                                                            }
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
                <div class="col-md-7">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="mt-3 mb-3 badge badge-warning">
                                <?php echo validation_errors(); ?>
                            </div>
                            <form role="form" action="report/addReport" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('select_type'); ?> &ast;</label>
                                    <select class="form-control form-control-lg m-bot15 js-example-basic-single" name="type" value='' required="">
                                        <option value="birth" <?php
                                                                if (!empty($setval)) {
                                                                    if (set_value('type') == 'birth') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                if (!empty($report->report_type)) {
                                                                    if ($report->report_type == 'birth') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('birth'); ?></option>
                                        <option value="operation" <?php
                                                                    if (!empty($setval)) {
                                                                        if (set_value('type') == 'operation') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    if (!empty($report->report_type)) {
                                                                        if ($report->report_type == 'operation') {
                                                                            echo 'selected';
                                                                        }
                                                                    }
                                                                    ?>><?php echo lang('operation'); ?></option>
                                        <option value="expire" <?php
                                                                if (!empty($setval)) {
                                                                    if (set_value('type') == 'expire') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                if (!empty($report->report_type)) {
                                                                    if ($report->report_type == 'expire') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('expire'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &ast;</label>
                                    <select class="form-control form-control-lg m-bot15 js-example-basic-single" name="patient" value='' required="">
                                        <?php foreach ($patients as $patient) { ?>
                                            <option value="<?php echo $patient->name . '*' . $patient->ion_user_id; ?>" <?php
                                                                                                                        if (!empty($report->patient)) {
                                                                                                                            if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                                                                                                                echo 'selected';
                                                                                                                            }
                                                                                                                        }
                                                                                                                        ?>><?php echo $patient->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> &ast;</label>
                                    <select class="form-control form-control-lg m-bot15 js-example-basic-single" name="doctor" value='' required="">
                                        <?php foreach ($doctors as $doctor) { ?>
                                            <option value="<?php echo $doctor->name; ?>" <?php
                                                                                            if (!empty($setval)) {
                                                                                                if (set_value('doctor') == $doctor->name) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            if (!empty($report->doctor)) {
                                                                                                if ($report->doctor == $doctor->name) {
                                                                                                    echo 'selected';
                                                                                                }
                                                                                            }
                                                                                            ?>><?php echo $doctor->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('date'); ?> &ast;</label>
                                    <input class="form-control form-control-inline input-medium default-date-picker readonly" name="date" size="16" type="text" value="<?php
                                                                                                                                                                        if (!empty($setval)) {
                                                                                                                                                                            echo set_value('date');
                                                                                                                                                                        }
                                                                                                                                                                        if (!empty($report->date)) {
                                                                                                                                                                            echo $report->date;
                                                                                                                                                                        }
                                                                                                                                                                        ?>" required="" />

                                </div>
                                <div class="form-group">


                                    <label for="exampleInputEmail1"> <?php echo lang('description'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="description" id="editor" value='<?php
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('description');
                                                                                                                                    }
                                                                                                                                    if (!empty($report->description)) {
                                                                                                                                        echo $report->description;
                                                                                                                                    }
                                                                                                                                    ?>' placeholder="" required="">

                                </div>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($report->id)) {
                                                                            echo $report->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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



<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/report/birth_report.js"></script>




<!--main content end-->
<!--footer start-->