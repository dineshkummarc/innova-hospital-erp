<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/email/email.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-envelope mr-2"></i> <?php echo lang('email'); ?> <?php echo lang('settings'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><?php echo lang('email') ?></li>
                        <li class="breadcrumb-item active"><?php echo lang('email'); ?> <?php echo lang('settings'); ?></li>
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
                            <section class="row">
                                <div class="panel-body">
                                    <div class="adv-table editable-table ">
                                        <div class="space15"></div>
                                        <table class="table table-bordered table-hover" id="">
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
                                                foreach ($email as $email_setting) {

                                                    $i = $i + 1;
                                                ?>
                                                    <tr class="">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php
                                                            if (!empty($email_setting->type)) {
                                                                echo $email_setting->type;
                                                            }
                                                            ?>
                                                            <br>

                                                        </td>

                                                        <td>
                                                            <a class="btn btn-info btn-sm btn_width" href="email/settings?id=<?php echo $email_setting->id; ?>"> <?php echo lang('manage'); ?></a>
                                                        </td>
                                                    </tr>

                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-5">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <section class="">
                                <header class="panel-heading">
                                    <?php echo lang('select'); ?> <?php echo lang('email'); ?> <?php echo lang('settings'); ?>
                                </header>
                                <div class="panel-body">
                                    <form role="form" id="editAppointmentForm" action="settings/selectEmailGateway" class="clearfix" method="post" enctype="multipart/form-data">


                                        <?php foreach ($email as $email_setting) {
                                        ?>
                                            <div class="form-group">
                                                <input type="radio" class="" readonly="" name="email_gateway" id="exampleInputEmail1" value='<?php echo $email_setting->type; ?>' placeholder="" <?php
                                                                                                                                                                                                    if (!empty($email_setting->type)) {
                                                                                                                                                                                                        if ($settings->emailtype == $email_setting->type) {
                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                        }
                                                                                                                                                                                                    }
                                                                                                                                                                                                    ?>> <?php echo $email_setting->type; ?>
                                            </div>
                                        <?php }
                                        ?>


                                        <input type="hidden" name="id" value="<?php echo $settings->id; ?>">

                                        <div class="col-md-12 panel">
                                            <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                                        </div>
                                    </form>
                                </div>
                            </section>
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


<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/email/email_setting_option.js"></script>