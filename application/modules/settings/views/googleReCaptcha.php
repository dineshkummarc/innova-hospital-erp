<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1><i class="fas fa-shield-alt mr-2"></i><strong class="text-primary">Google ReCaptcha V3 Settings</strong></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active">Google ReCaptcha V3 Settings</li>
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
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="settings/updateGoogleRecaptcha" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Site Key </label>

                                    <input type="text" class="form-control form-control-lg" name="site_key" id="exampleInputEmail1" value='<?php
                                                                                                                                            if (!empty($captcha->site_key)) {
                                                                                                                                                echo $captcha->site_key;
                                                                                                                                            }
                                                                                                                                            ?>' placeholder="">

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> Secret Key </label>

                                    <input type="text" class="form-control form-control-lg" name="secret_key" id="exampleInputEmail1" value='<?php
                                                                                                                                                if (!empty($captcha->secret_key)) {
                                                                                                                                                    echo $captcha->secret_key;
                                                                                                                                                }
                                                                                                                                                ?>' placeholder="">

                                </div>

                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($captcha->id)) {
                                                                            echo $captcha->id;
                                                                        }
                                                                        ?>'>


                                <div class="form-group mb-5">
                                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                </div>
                                <code class="mt-5">
                                    Without Site Key and Secret Key Frontend contact form will not work.
                                    Create Google ReCaptcha Key Here By selecting reCAPTCHA v3
                                    : <a target="_blank" href="https://www.google.com/recaptcha/admin/create">https://www.google.com/recaptcha/admin/create</a>
                                </code>

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
<script src="common/extranal/js/email/settings.js"></script>