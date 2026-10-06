<!-- <link href="common/extranal/css/settings/settings.css" rel="stylesheet"> -->





<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-key mr-2"></i> <?php echo lang('purchase_code_verification'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('settings') ?></li>
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
                    <div class="">

                        <!-- /.card-header -->
                        <?php if ($this->ion_auth->in_group('superadmin')) { ?>
                            <div class="card-body p-4">
                                <?php echo validation_errors(); ?>
                                <form role="form" action="settings/updatePurchaseCode" method="post" enctype="multipart/form-data">
                                    <div class="" id="accordionExample">







                                        <?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>


                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">
                                                        <a class="collapsed" data-toggle="collapse" href="#collapseThree">
                                                            <?php echo lang('purchase_code_verification'); ?>
                                                            <span>
                                                                <?php if ($verified) {
                                                                    echo '<span class="badge badge-success">Verified</span>';
                                                                    $verify_data = $this->settings_model->verify();
                                                                } else {
                                                                    echo '<span class="badge badge-danger">Not Verified</span>';
                                                                } ?>
                                                            </span>
                                                            <span>
                                                                <?php
                                                                if ($verified) {
                                                                    $verify_data = $this->settings_model->verify();
                                                                    if ($verify_data->supported_until < time()) {
                                                                        echo '<span class="badge badge-primary">Supported </span>';
                                                                    } else {
                                                                        echo '<span class="badge badge-danger">Support Expired</span> <a class="text-xs" target="_blank" href="https://codecanyon.net/item/multi-hms-hospital-management-system-saas-app/13972431">Renew your support</a>';
                                                                    }
                                                                }
                                                                ?>
                                                            </span>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="collapse">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1"> Envato Username</label>
                                                                <input type="text" class="form-control form-control-lg" name="codec_username" value='<?php
                                                                                                                                                        if (!empty($settings->codec_username)) {
                                                                                                                                                            echo $settings->codec_username;
                                                                                                                                                        }
                                                                                                                                                        ?>' placeholder="Envato Username">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <label for="exampleInputEmail1"> Envato Purchase Code</label>
                                                                <input type="text" class="form-control form-control-lg" name="codec_purchase_code" value='<?php
                                                                                                                                                            if (!empty($settings->codec_purchase_code)) {
                                                                                                                                                                echo $settings->codec_purchase_code;
                                                                                                                                                            }
                                                                                                                                                            ?>' placeholder="Envato Purchase Code">
                                                                <span>
                                                                    <?php if ($verified) {
                                                                        echo '<span class="badge badge-success">Verified</span>';
                                                                    } else {
                                                                        echo '<span class="badge badge-danger">Not Verified</span>';
                                                                        echo '</br></br><span ><a class="text-info" href="https://codecanyon.net/item/multi-hms-hospital-management-system-saas-app/13972431">Purchase a licence from envato</a></span>';
                                                                    } ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        <?php } ?>











                                    </div>

                                    <input type="hidden" name="id" value='<?php
                                                                            if (!empty($settings->id)) {
                                                                                echo $settings->id;
                                                                            }
                                                                            ?>'>
                                    <div class="form-group col-md-12">
                                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                    </div>
                                </form>
                            </div>
                        <?php } else { ?>

                            <div class="card-body p-4">
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Purchase code is not verified</h4>
                                </div>
                                <a href="auth/logout">
                                    <div class="alert alert-success" role="alert">
                                        <p>Login as super admin and verify purchase code from system settings</p>
                                    </div>
                                </a>
                            </div>

                        <?php } ?>
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
<script src="common/extranal/js/settings/settings.js"></script>