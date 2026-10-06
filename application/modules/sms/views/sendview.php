<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-sms mr-2"></i>
                        <?php echo lang('send_sms'); ?>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Send sms to the recipients'); ?></h3>
                            <div class="float-right">
                                <button class='btn btn-success float-right mr-1' onclick="location.href = 'sms/sent'" type="button">
                                    <?php echo lang('sent_messages'); ?></button>
                                <button class='btn btn-success float-right mr-1' onclick="location.href = 'sms/manualSMSTemplate'" type="button">
                                    <?php echo lang('template'); ?></button>
                                <button class='btn btn-success float-right mr-1' data-toggle="modal" data-target="#myModal1" type="button">
                                    <?php echo lang('add'); ?> <?php echo lang('template'); ?></button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form role="form" name="myform" id="myform" class="clearfix" action="sms/send" method="post">
                                <label class="control-label">
                                    <?php echo lang('send_sms_to'); ?>
                                </label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio" id="optionsRadios1" value="allpatient">
                                        <?php echo lang('all_patient'); ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio" id="optionsRadios2" value="alldoctor">
                                        <?php echo lang('all_doctor'); ?>
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio" id="optionsRadios2" value="bloodgroupwise">
                                        <?php echo lang('donor'); ?>
                                    </label>
                                </div>


                                <div class="radio pos_client" style="display:none;">
                                    <label>
                                        <?php echo lang('select_blood_group'); ?>
                                        <select class="form-control form-control-lg m-bot15" name="bloodgroup" value=''>
                                            <?php foreach ($groups as $group) { ?>
                                                <option value="<?php echo $group->group; ?>"> <?php echo $group->group; ?> </option>
                                            <?php } ?>
                                        </select>
                                    </label>

                                </div>




                                <div class="radio">
                                    <label>
                                        <input type="radio" name="radio" id="optionsRadios2" value="single_patient">
                                        <?php echo lang('single_patient'); ?>
                                    </label>
                                </div>

                                <div class="radio single_patient" style="display: none;">
                                    <label>
                                        <?php echo lang('select_patient'); ?>
                                        <select class="form-control form-control-lg m-bot15" id='patientchoose' name="patient" value=''>

                                        </select>
                                    </label>

                                </div>



                                <div class="">
                                    <label>
                                        <?php echo lang('select_template'); ?>
                                        <select class="form-control form-control-lg m-bot15" id='selUser5' name="templatess">

                                        </select>
                                    </label>

                                </div>



                                <div class="form-group">
                                    <label class="control-label"><?php echo lang('message'); ?> &ast;</label><br>
                                    <?php
                                    $count = 0;
                                    foreach ($shortcode as $shortcodes) {
                                    ?>
                                        <input type="button" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext(this);">
                                        <?php
                                        $count += 1;
                                        if ($count === 7) {
                                        ?>
                                            <br>
                                    <?php
                                        }
                                    }
                                    ?> <br><br>
                                    <textarea class="" id="editor1" name="message" value="" cols="70" rows="10"></textarea>
                                </div>
                                <input type="hidden" name="id" value=''>

                                <div class="form-group col-md-12">
                                    <button type="submit" name="submit" class="btn btn-info col-md-3 float-right"><i class="fa fa-location-arrow"></i> <?php echo lang('send_sms'); ?></button>
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







<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><?php echo lang('add_new'); ?> <?php echo lang('template'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <?php echo validation_errors(); ?>
                <form role="form" name="myform1" action="sms/addNewManualTemplate" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('templatename'); ?> &ast;</label>
                        <input type="text" class="form-control form-control-lg" name="name" value='<?php
                                                                                                    if (!empty($templatename->name)) {
                                                                                                        echo $templatename->name;
                                                                                                    }
                                                                                                    if (!empty($setval)) {
                                                                                                        echo set_value('name');
                                                                                                    }
                                                                                                    ?>' placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('message'); ?> <?php echo lang('template'); ?> &ast;</label><br>
                        <?php
                        $count1 = 0;
                        foreach ($shortcode as $shortcodes) {
                        ?>
                            <input type="button" name="myBtn" value="<?php echo $shortcodes->name; ?>" onClick="addtext1(this);">
                            <?php
                            $count1 += 1;
                            if ($count1 === 7) {
                            ?>
                                <br>
                        <?php
                            }
                        }
                        ?> <br><br>

                        <textarea class="" id="editor2" name="message" value='<?php
                                                                                if (!empty($templatename->message)) {
                                                                                    echo $templatename->message;
                                                                                }
                                                                                if (!empty($setval)) {
                                                                                    echo set_value('message');
                                                                                }
                                                                                ?>' cols="50" rows="10" placeholder="" required> <?php
                                                                                                                                    if (!empty($templatename->message)) {
                                                                                                                                        echo $templatename->message;
                                                                                                                                    }
                                                                                                                                    if (!empty($setval)) {
                                                                                                                                        echo set_value('message');
                                                                                                                                    }
                                                                                                                                    ?>
                        </textarea>
                    </div>
                    <input type="hidden" name="id" value='<?php
                                                            if (!empty($templatename->id)) {
                                                                echo $templatename->id;
                                                            }
                                                            ?>'>
                    <input type="hidden" name="type" value='sms'>
                    <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script src="common/js/codearistos.min.js"></script>


<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var select_template = "<?php echo lang('select_template'); ?>";
</script>
<script src="common/extranal/js/sms/sendview.js"></script>