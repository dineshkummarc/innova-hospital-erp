<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="text-primary fw-bold"><i class="fas fa-money-bill-wave mr-2"></i><strong>
                            <?php
                            if (!empty($settings->name)) {
                                echo $settings->name;
                            }
                            ?> <?php echo lang('settings'); ?>
                        </strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php
                                                            if (!empty($settings->name)) {
                                                                echo $settings->name;
                                                            }
                                                            ?> <?php echo lang('settings');
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
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Insert <?php
                                                            if (!empty($settings->name)) {
                                                                echo $settings->name;
                                                            }
                                                            ?> api credentials</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="pgateway/addNewSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('payment_gateway'); ?> <?php echo lang('name'); ?> &ast;</label>
                                    <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                                if (!empty($settings->name)) {
                                                                                                                    echo $settings->name;
                                                                                                                }
                                                                                                                ?>' placeholder="" readonly>
                                </div>
                                <?php if ($settings->name == "Pay U Money") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('merchant_key'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="merchant_key" value="<?php
                                                                                                                            if (!empty($settings->merchant_key)) {
                                                                                                                                echo $settings->merchant_key;
                                                                                                                            }
                                                                                                                            ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('salt'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="salt" value='<?php
                                                                                                                    if (!empty($settings->salt)) {
                                                                                                                        echo $settings->salt;
                                                                                                                    }
                                                                                                                    ?>' required="">
                                    </div> <?php } ?> <?php if ($settings->name == "Paystack") { ?> <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="secret" value="<?php
                                                                                                                        if (!empty($settings->secret)) {
                                                                                                                            echo $settings->secret;
                                                                                                                        }
                                                                                                                        ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('public_key'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="public_key" value='<?php
                                                                                                                            if (!empty($settings->public_key)) {
                                                                                                                                echo $settings->public_key;
                                                                                                                            }
                                                                                                                            ?>' required="">
                                    </div> <?php } ?> <?php if ($settings->name == "PayPal") { ?> <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('api_username'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="APIUsername" value="<?php
                                                                                                                            if (!empty($settings->APIUsername)) {
                                                                                                                                echo $settings->APIUsername;
                                                                                                                            }
                                                                                                                            ?>" placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_password'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="APIPassword" value='<?php
                                                                                                                            if (!empty($settings->APIPassword)) {
                                                                                                                                echo $settings->APIPassword;
                                                                                                                            }
                                                                                                                            ?>' required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo lang('api_signature'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="APISignature" value='<?php
                                                                                                                            if (!empty($settings->APISignature)) {
                                                                                                                                echo $settings->APISignature;
                                                                                                                            }
                                                                                                                            ?>' required="">
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == "Stripe") { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('secretkey'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="secret" value='<?php
                                                                                                                        if (!empty($settings->secret)) {
                                                                                                                            echo $settings->secret;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('publishkey'); ?> &ast;</label>
                                        <input type="text" class="form-control form-control-lg" name="publish" value='<?php
                                                                                                                        if (!empty($settings->publish)) {
                                                                                                                            echo $settings->publish;
                                                                                                                        }
                                                                                                                        ?>' required="">
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"><?php echo lang('status'); ?> &ast;</label>
                                    <select class="form-control col-sm-8 m-bot15" name="status" value='' required="">
                                        <option value="live" <?php
                                                                if (!empty($settings->status)) {
                                                                    if ($settings->status == 'live') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('live'); ?> </option>
                                        <option value="test" <?php
                                                                if (!empty($settings->status)) {
                                                                    if ($settings->status == 'test') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>><?php echo lang('test'); ?></option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>
                                <div class="form-group clearfix">
                                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                </div>
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






<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/pgateway.js"></script>