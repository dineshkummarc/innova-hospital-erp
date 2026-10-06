<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-sms mr-2"></i>
                        <?php echo lang('sms_gateways') ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('sms_gateways') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the Sms Gateway names and related informations'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($sgateways as $sgateway) {
                                        $i = $i + 1;
                                    ?>
                                        <tr class="">
                                            <td><?php echo $i; ?></td>
                                            <td><?php
                                                if (!empty($sgateway->name)) {
                                                    echo $sgateway->name;
                                                }
                                                ?></td>

                                            <td>
                                                <a class="btn btn-info btn-sm" href="sms/settings?id=<?php echo $sgateway->id; ?>"> <i class="fa fa-"> </i> <?php echo lang('manage'); ?></a>
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
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <?php echo lang('select'); ?> <?php echo lang('sms_gateway'); ?>
                        </div>
                        <div class="card-body">
                            <form role="form" id="editAppointmentForm" action="settings/selectSmsGateway" class="clearfix" method="post" enctype="multipart/form-data">
                                <?php foreach ($sgateways as $sgateway) { ?>
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" readonly="" name="sms_gateway" id="customRadio<?php echo $sgateway->id; ?>" value='<?php echo $sgateway->name; ?>' <?php
                                                                                                                                                                                                                if (!empty($sgateway->name)) {
                                                                                                                                                                                                                    if ($settings->sms_gateway == $sgateway->name) {
                                                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?>>
                                            <label class="custom-control-label" for="customRadio<?php echo $sgateway->id; ?>"><?php echo $sgateway->name; ?></label>
                                        </div>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id" value="<?php echo $settings->id; ?>">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>













<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/js/sms/settings.js"></script>