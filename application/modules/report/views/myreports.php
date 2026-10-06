<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-file-medical-alt mr-2"></i><?php echo lang('my_reports'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('my_reports'); ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the reports (Birth, Expire or Operation)'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('patient'); ?></th>
                                        <th><?php echo lang('type'); ?></th>
                                        <th><?php echo lang('description'); ?></th>
                                        <th><?php echo lang('doctor'); ?></th>
                                        <th><?php echo lang('date'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($reports as $report) {
                                        if ($user_id == explode('*', $report->patient)[1]) {
                                    ?>
                                            <tr class="">
                                                <td><?php echo explode('*', $report->patient)[0]; ?></td>
                                                <td> <?php echo $report->report_type; ?></td>
                                                <td> <?php echo $report->description; ?></td>
                                                <td><?php echo $report->doctor; ?></td>
                                                <td class="center"><?php echo $report->date; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
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

<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/report/my_report.js"></script>