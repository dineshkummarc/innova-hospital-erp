<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-envelope mr-2"></i><?php echo lang('contact'); ?> <?php echo lang('email_settings'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('email'); ?></li>
                        <li class="breadcrumb-item active"><?php echo lang('contact'); ?> <?php echo lang('email_settings'); ?></li>
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
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Insert the email address where you want to recieve the contact us emails.'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="email/updateContactEmailSettings" class="clearfix" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="exampleInputEmail1"> <?php echo lang('contact'); ?> <?php echo lang('email'); ?></label>
                                    <input type="text" class="form-control form-control-lg" name="email" id="exampleInputEmail1" value='<?php
                                                                                                                                        if (!empty($settings->admin_email)) {
                                                                                                                                            echo $settings->admin_email;
                                                                                                                                        }
                                                                                                                                        ?>' placeholder="From which you want to send the email">
                                </div>

                                <code>
                                    <?php echo lang('email_settings_instruction_1') ?>
                                    <br>
                                    <?php echo lang('email_settings_instruction_2') ?>
                                </code>


                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>
                                <div class="form-group">
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