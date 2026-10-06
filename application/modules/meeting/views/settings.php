<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-cog mr-2"></i><?php echo lang('zoom'); ?> <?php echo lang('live_meeting_settings'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo lang('meeting') ?></li>
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
                <div class="col-12 col-md-6">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="meeting/settings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <div class="col-md-3 payment_label">
                                        <label for="exampleInputEmail1"> Account ID</label>
                                    </div>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control form-control-lg" name="api_key" value='<?php
                                                                                                                        if (!empty($settings->api_key)) {
                                                                                                                            echo $settings->api_key;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-3 payment_label">
                                        <label for="exampleInputEmail1"> Client ID </label>
                                    </div>
                                    <div class="col-md-12 payment_label">
                                        <input type="text" class="form-control form-control-lg" name="api_secret" value='<?php
                                                                                                                            if (!empty($settings->secret_key)) {
                                                                                                                                echo $settings->secret_key;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-md-6 payment_label">
                                        <label for="exampleInputEmail1"> Client Secret </label>
                                    </div>
                                    <div class="col-md-12 payment_label">
                                        <input type="text" class="form-control form-control-lg" name="url" value='<?php
                                                                                                                            if (!empty($settings->url)) {
                                                                                                                                echo $settings->url;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                    </div>
                                </div>
                                <code>
                                <label for="url" class="col-md-12 col-form-label">Step 1: Go to <a href="https://marketplace.zoom.us/" target="_blank"> https://marketplace.zoom.us/</a></label>
                                    <label for="url" class="col-md-12 col-form-label">Step 2: Click Develop->Build App</label>
                                    <label for="url" class="col-md-12 col-form-label">Step 3: Select Server to server OAuth App</label>
                                    <label for="url" class="col-md-12 col-form-label">Step 4: Complete The Process</label>
                                    </code>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>
                                <div class="col-md-12 payment_label">
                                    <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button>
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