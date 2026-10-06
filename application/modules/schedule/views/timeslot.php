<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php echo lang('time_slots'); ?> (<?php echo $this->db->get_where('doctor', array('id' => $doctorr))->row()->name; ?>)
                <div class="col-md-4 no-print float-right">
                    <a data-toggle="modal" href="#myModal">
                        <div class="btn-group float-right">
                            <button id="" class="btn green btn-xs">
                                <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                            </button>
                        </div>
                    </a>
                </div>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> <?php echo lang('start_time'); ?></th>
                                <th> <?php echo lang('end_time'); ?></th>
                                <th> <?php echo lang('weekday'); ?></th>
                                <th> <?php echo lang('options'); ?></th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 0;
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Monday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>
                                            <!-- <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a> -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-xs label-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-bars"></i> <?php echo  lang('actions'); ?><span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"> <i class="fa fa-edit"></i> <?php echo lang('edit') ?> </a></li>
                                                    <li><a href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"> <i class="fa fa-trash"></i> <?php echo lang('delete') ?> </a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Tuesday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#876543; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Wednesday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Thursday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#654321; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Friday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Saturday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#876543; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>


                            <?php
                            foreach ($slots as $slot) {
                                if ($slot->weekday == 'Sunday') {
                                    if ($this->settings->time_format == 24) {
                                        $slot->s_time = $this->settings_model->convert_to_24h($slot->s_time);
                                        $slot->e_time = $this->settings_model->convert_to_24h($slot->e_time);
                                    }
                                    $i = $i + 1; ?>
                                    <tr class="">
                                        <td style="background:#345678; color: #fff;"> <?php echo $i; ?></td>
                                        <td> <?php echo $slot->s_time; ?></td>
                                        <td><?php echo $slot->e_time; ?></td>
                                        <td><?php echo $slot->weekday; ?></td>
                                        <td>

                                            <button type="button" class="btn btn-info btn-xs btn_width editbutton" data-toggle="modal" data-id="<?php echo $slot->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                            <a class="btn btn-info btn-xs btn_width delete_button" href="schedule/deleteTimeSlot?id=<?php echo $slot->id; ?>&doctor=<?php echo $doctorr; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->




<!-- Add Time Slot Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php echo lang('time_slots'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" action="scedule/addTimeSlot" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control timepicker-default" name="s_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control timepicker-default" name="e_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <select class="form-control form-control-lg m-bot15" id="weekday" name="weekday" value=''>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('edit'); ?> <?php echo lang('time_slot'); ?></h4>
            </div>
            <div class="modal-body">
                <form role="form" id="editTimeSlotForm" action="scedule/addTimeSlot" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('start_time'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control timepicker-default" name="s_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control timepicker-default" name="e_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <select class="form-control form-control-lg m-bot15" id="weekday" name="weekday" value=''>
                                <option value="Monday">Monday</option>
                                <option value="Tuesday">Tuesday</option>
                                <option value="Wednesday">Wednesday</option>
                                <option value="Thursday">Thursday</option>
                                <option value="Friday">Friday</option>
                                <option value="Saturday">Saturday</option>
                                <option value="Sunday">Sunday</option>
                            </select>

                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctorr; ?>'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Time Slot Modal-->




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/schedule/timeslot.js"></script>