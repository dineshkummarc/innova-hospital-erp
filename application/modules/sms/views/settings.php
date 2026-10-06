<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-sms mr-2"></i>
                        <?php echo $settings->name; ?> <?php echo lang('sms_settings'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('department') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the department names and related informations'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="sms/addNewSettings" method="post" enctype="multipart/form-data">

                                <?php if ($settings->name == 'Clickatell') { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo $settings->name; ?> <?php echo lang('username'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="username" value='<?php
                                                                                                                        if (!empty($settings->username)) {
                                                                                                                            echo $settings->username;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" <?php
                                                                                                                            if (!$this->ion_auth->in_group('admin')) {
                                                                                                                                echo 'disabled';
                                                                                                                            }
                                                                                                                            ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo $settings->name; ?> <?php echo lang('api'); ?> <?php echo lang('password'); ?></label>
                                        <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('api'); ?> <?php echo lang('id'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="api_id" value='<?php
                                                                                                                        if (!empty($settings->api_id)) {
                                                                                                                            echo $settings->api_id;
                                                                                                                        }
                                                                                                                        ?>' placeholder="" <?php
                                                                                                                            if (!empty($settings->username)) {
                                                                                                                                echo $settings->username;
                                                                                                                            }
                                                                                                                            ?> <?php
                                                                                                                                if (!$this->ion_auth->in_group('admin')) {
                                                                                                                                    echo 'disabled';
                                                                                                                                }
                                                                                                                                ?>>
                                    </div>
                                <?php } ?>


                                <?php if ($settings->name == 'MSG91') { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('authkey'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="authkey" value='<?php
                                                                                                                        if (!empty($settings->authkey)) {
                                                                                                                            echo $settings->authkey;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('sender'); ?> </label>
                                        <input type="text" class="form-control form-control-lg" name="sender" value='<?php
                                                                                                                        if (!empty($settings->sender)) {
                                                                                                                            echo $settings->sender;
                                                                                                                        }
                                                                                                                        ?>' placeholder="">
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == 'Twilio') { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo $settings->name; ?> <?php echo lang('sid'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="sid" value='<?php
                                                                                                                    if (!empty($settings->sid)) {
                                                                                                                        echo $settings->sid;
                                                                                                                    }
                                                                                                                    ?>' placeholder="" <?php
                                                                                                                        if (!$this->ion_auth->in_group('admin')) {
                                                                                                                            echo 'disabled';
                                                                                                                        }
                                                                                                                        ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo $settings->name; ?> <?php echo lang('token'); ?> <?php echo lang('password'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="token" value='<?php
                                                                                                                    if (!empty($settings->token)) {
                                                                                                                        echo $settings->token;
                                                                                                                    }
                                                                                                                    ?>' <?php
                                                                                                        if (!$this->ion_auth->in_group('admin')) {
                                                                                                            echo 'disabled';
                                                                                                        }
                                                                                                        ?>>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('sendernumber'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="sendernumber" value='<?php
                                                                                                                            if (!empty($settings->sendernumber)) {
                                                                                                                                echo $settings->sendernumber;
                                                                                                                            }
                                                                                                                            ?>' <?php
                                                                                                                if (!$this->ion_auth->in_group('admin')) {
                                                                                                                    echo 'disabled';
                                                                                                                }
                                                                                                                ?>>
                                    </div>
                                <?php } ?>
                                <?php if ($settings->name == '80Kobo') { ?>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('email'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="email" value='<?php
                                                                                                                    if (!empty($settings->email)) {
                                                                                                                        echo $settings->email;
                                                                                                                    }
                                                                                                                    ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('password'); ?> </label>
                                        <input type="password" class="form-control form-control-lg" name="password" value='<?php
                                                                                                                            if (!empty($settings->password)) {
                                                                                                                                echo $settings->password;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"> <?php echo lang('sender'); ?> <?php echo lang('name'); ?></label>
                                        <input type="text" class="form-control form-control-lg" name="sender_name" value='<?php
                                                                                                                            if (!empty($settings->sender_name)) {
                                                                                                                                echo $settings->sender_name;
                                                                                                                            }
                                                                                                                            ?>' placeholder="">
                                        <p> <?php echo lang('maximum_11_characters'); ?> </p>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id" value='<?php
                                                                        if (!empty($settings->id)) {
                                                                            echo $settings->id;
                                                                        }
                                                                        ?>'>
                                <button type="submit" name="submit" class="btn btn-info"><?php echo lang('submit'); ?></button>
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
<script src="common/extranal/js/sms/settings.js"></script>