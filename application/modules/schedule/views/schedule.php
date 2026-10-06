<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-alt text-primary mr-3"></i>
                        <?php echo lang('schedule'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('schedule'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-plus"></i> <?php echo lang('add_new'); ?> <?php echo lang('schedule'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase">#</th>
                                        <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('weekday'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('start_time'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('end_time'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('duration'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                        <th class="font-weight-bold"><?php echo lang('options'); ?></th>
                                        <?php } ?>
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
                                        $i = $i + 1;
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $this->doctor_model->getDoctorById($schedule->doctor)->name; ?>
                                        </td>
                                        <td><?php echo $schedule->weekday; ?></td>
                                        <td><?php echo $schedule->s_time; ?></td>
                                        <td><?php echo $schedule->e_time; ?></td>
                                        <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))) { ?>
                                        <td>
                                            <a class="btn btn-danger btn-sm"
                                                href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $schedule->doctor; ?>&weekday=<?php echo $schedule->weekday; ?>&all=all"
                                                onclick="return confirm('Are you sure you want to delete this item?');">
                                                <i class="fa fa-trash"></i> <?php echo lang('delete'); ?>
                                            </a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Schedule Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><?php echo lang('add'); ?> <?php echo lang('schedule'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addSchedule" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="form-group">
                                <label class="text-uppercase font-weight-bold text-muted"><?php echo lang('doctor'); ?>
                                    <span class="text-danger">*</span></label>
                                <select class="form-control form-control-lg shadow-sm" id="doctorchoose" name="doctor"
                                    required="">
                                    <?php if (!empty($prescription->doctor)) { ?>
                                    <option value="<?php echo $doctors->id; ?>" selected="selected">
                                        <?php echo $doctors->name; ?> - <?php echo $doctors->id; ?></option>
                                    <?php } ?>
                                    <?php
                                    if (!empty($setval)) {
                                        $doctordetails1 = $this->db->get_where('doctor', array('id' => set_value('doctor')))->row();
                                    ?>
                                    <option value="<?php echo $doctordetails1->id; ?>" selected="selected">
                                        <?php echo $doctordetails1->name; ?> - <?php echo $doctordetails1->id; ?>
                                    </option>
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

                        <div class="col-md-12">
                            <input type="hidden" name="redirect" value="schedule">
                            <input type="hidden" name="id" value="">
                            <button type="submit"
                                class="btn btn-primary float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
var select_doctor = "<?php echo lang('select_doctor'); ?>";
var select_patient = "<?php echo lang('select_patient'); ?>";
var language = "<?php echo $this->language; ?>";
var time_format = "<?php echo $this->settings->time_format; ?>";
</script>
<script src="common/extranal/js/schedule/schedule.js"></script>