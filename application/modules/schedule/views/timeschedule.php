<?php $doctor_details =  $this->db->get_where('doctor', array('id' => $doctorr))->row(); ?>
<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-calendar-alt mr-2"></i><?php echo lang('time_schedule'); ?> (<?php echo $doctor_details->name; ?>)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('time_schedule'); ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the time schedule details'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th> <?php echo lang('weekday'); ?></th>
                                        <th> <?php echo lang('start_time'); ?></th>
                                        <th> <?php echo lang('end_time'); ?></th>
                                        <th> <?php echo lang('duration'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($schedules as $schedule) {
                                        if ($this->settings->time_format == 24) {
                                            $schedule->s_time = $this->settings_model->convert_to_24h($schedule->s_time);
                                            $schedule->e_time = $this->settings_model->convert_to_24h($schedule->e_time);
                                        }
                                        $i = $i + 1; ?>
                                        <tr class="">
                                            <td> <?php echo $i; ?></td>
                                            <td> <?php echo $schedule->weekday; ?></td>
                                            <td><?php echo $schedule->s_time; ?></td>
                                            <td><?php echo $schedule->e_time; ?></td>
                                            <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm btn_width delete_button" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $doctorr; ?>&weekday=<?php echo $schedule->weekday; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang(''); ?></a>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
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




<!-- Add Time Slot Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('schedule'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addSchedule" method="post" enctype="multipart/form-data">
                    <div class="row">
                   <div class="col-md-6 mb-4">
                            <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> &ast;</label>
                        <select class="form-control col-sm-9 m-bot15 js-example-basic-single" name="doctor" id="doctorchoose" value='' required="">
                            <?php if (!empty($doctor_details)) { ?>
                                <option value="<?php echo $doctor_details->id; ?>" selected="selected"><?php echo $doctor_details->name; ?> - <?php echo $doctor_details->id; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                        </div>

                       <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('weekday'); ?>
                                    <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg shadow-sm" id="weekday" name="weekday"
                                    required="">
                                    <option value="Friday"><?php echo lang('friday') ?></option>
                                    <option value="Saturday"><?php echo lang('saturday') ?></option>
                                    <option value="Sunday"><?php echo lang('sunday') ?></option>
                                    <option value="Monday"><?php echo lang('monday') ?></option>
                                    <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                                    <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                                    <option value="Thursday"><?php echo lang('thursday') ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label
                                    class="text-uppercase font-weight-bold text-muted"><?php echo lang('start_time'); ?>
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control form-control-lg shadow-sm timepicker-default1" name="s_time"
                                        id="s_time" required="" autocomplete="off">
                                    <div class="input-group-append">
                                    <a type="button" class="btn btn-default" class="input-group-text"><i class="fa fa-clock" style="padding-top:6px;"></i></a>
                                        <!-- <span class="input-group-text"><i class="fa fa-clock"></i></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label
                                    class="text-uppercase font-weight-bold text-muted"><?php echo lang('end_time'); ?>
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input type="text"
                                        class="form-control form-control-lg shadow-sm timepicker-default1" name="e_time"
                                        id="e_time" required="" autocomplete="off">
                                    <div class="input-group-append">
                                        <!-- <span class="input-group-text"><i class="fa fa-clock"></i></span> -->
                                        <a type="button" class="btn btn-default" class="input-group-text"><i class="fa fa-clock" style="padding-top:6px;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label
                                    class="text-uppercase font-weight-bold text-muted"><?php echo lang('appointment') ?>
                                    <?php echo lang('duration') ?> <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg shadow-sm" name="duration" required="">
                                    <option value="1">5 Minutes</option>
                                    <option value="2">10 Minutes</option>
                                    <option value="3">15 Minutes</option>
                                    <option value="4">20 Minutes</option>
                                    <option value="6">30 Minutes</option>
                                    <option value="9">45 Minutes</option>
                                    <option value="12">60 Minutes</option>
                                </select>
                            </div>
                        </div>

                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="redirect" value='schedule/timeSchedule?doctor=<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Time Slot Modal-->





<!-- Edit Time Slot Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('edit'); ?> <?php echo lang('time_slot'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="schedule/addSchedule" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control timepicker-default" name="s_time">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control timepicker-default" name="e_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker d-flex">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <select class="form-control form-control-lg m-bot15" id="weekday" name="weekday" value=''>
                                <option value="Friday"><?php echo lang('friday') ?></option>
                                <option value="Saturday"><?php echo lang('saturday') ?></option>
                                <option value="Sunday"><?php echo lang('sunday') ?></option>
                                <option value="Monday"><?php echo lang('monday') ?></option>
                                <option value="Tuesday"><?php echo lang('tuesday') ?></option>
                                <option value="Wednesday"><?php echo lang('wednesday') ?></option>
                                <option value="Thursday"><?php echo lang('thursday') ?></option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('appointment') ?> <?php echo lang('duration') ?> </label>
                        <select class="form-control form-control-lg m-bot15" name="duration" value=''>

                            <option value="1" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '1') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 5 Minitues </option>

                            <option value="2" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '2') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 10 Minitues </option>


                            <option value="3" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '3') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 15 Minitues </option>

                            <option value="4" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '4') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 20 Minitues </option>

                            <option value="6" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '6') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 30 Minitues </option>

                            <option value="9" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '9') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 45 Minitues </option>

                            <option value="12" <?php
                                                if (!empty($settings->duration)) {
                                                    if ($settings->duration == '12') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>> 60 Minitues </option>

                        </select>
                    </div>

                    <input type="hidden" name="doctor" value="<?php echo $doctorr; ?>">
                    <input type="hidden" name="redirect" value='schedule/timeSchedule'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var time_format = "<?php echo $this->settings->time_format; ?>";
</script>
<script src="common/extranal/js/schedule/timeschedule.js"></script>