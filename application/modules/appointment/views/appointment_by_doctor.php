<link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-check text-primary mr-3"></i>
                        <?php echo lang('all_appointments'); ?>: <?php echo lang('doctor'); ?>
                        (<?php if (!empty($mmrdoctor)) {
                                echo $mmrdoctor->name;
                            } ?>)
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('appointment'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-light p-4">
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#calendardetails">
                                        <?php echo lang('appointments'); ?> <?php echo lang('calendar'); ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#list">
                                        <?php echo lang('appointments'); ?>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div id="calendardetails" class="tab-pane active">
                                    <div id="calendarview" class="has-toolbar calendar_view"></div>
                                </div>

                                <div id="list" class="tab-pane">
                                    <table class="table table-hover datatables" id="editable-sample" width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <th class="font-weight-bold text-uppercase text-muted"><?php echo lang('id'); ?></th>
                                                <th class="font-weight-bold text-uppercase text-muted"><?php echo lang('patient'); ?></th>
                                                <th class="font-weight-bold text-uppercase text-muted"><?php echo lang('date-time'); ?></th>
                                                <th class="font-weight-bold text-uppercase text-muted"><?php echo lang('remarks'); ?></th>
                                                <th class="font-weight-bold text-uppercase text-muted"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($appointments as $appointment) {
                                                if ($appointment->doctor == $doctor_id) { ?>
                                                    <tr>
                                                        <td><?php echo $appointment->id; ?></td>
                                                        <td><?php echo $this->db->get_where('patient', array('id' => $appointment->patient))->row()->name; ?></td>
                                                        <td><?php echo date('d-m-Y', $appointment->date); ?> => <?php echo $appointment->time_slot; ?></td>
                                                        <td><?php echo $appointment->remarks; ?></td>
                                                        <td>
                                                            <a class="btn btn-danger btn-sm" href="appointment/delete?id=<?php echo $appointment->id; ?>&doctor_id=<?php echo $appointment->doctor; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0"><?php echo lang('doctor'); ?></h5>
                        </div>
                        <div class="card-body bg-light">
                            <div class="d-flex align-items-center mb-4">
                                <img src="<?php echo !empty($mmrdoctor->img_url) ? $mmrdoctor->img_url : 'uploads/favicon.png'; ?>" class="rounded-circle mr-3" style="width: 100px; height: 100px;">
                                <div>
                                    <h5 class="mb-1"><?php echo $mmrdoctor->name; ?></h5>
                                    <p class="mb-0"><?php echo $mmrdoctor->profile; ?></p>
                                </div>
                            </div>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item bg-transparent">
                                    <i class="fa fa-envelope mr-2"></i>
                                    <?php echo $mmrdoctor->email; ?>
                                </div>
                                <div class="list-group-item bg-transparent">
                                    <i class="fa fa-phone mr-2"></i>
                                    <?php echo $mmrdoctor->phone; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Edit Appointment Modal -->
<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><?php echo lang('edit_appointment'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold"><?php echo lang('patient'); ?></label>
                            <select class="form-control form-control-lg" id="patientchoose1" name="patient"></select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold"><?php echo lang('doctor'); ?></label>
                            <select class="form-control form-control-lg" id="doctorchoose1" name="doctor"></select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold"><?php echo lang('date-time'); ?></label>
                            <div class="input-group date form_datetime-meridian">
                                <input type="text" class="form-control form-control-lg" readonly name="date">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary date-set" type="button"><i class="fa fa-calendar"></i></button>
                                    <button class="btn btn-outline-secondary date-reset" type="button"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label font-weight-bold"><?php echo lang('remarks'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="remarks">
                        </div>
                    </div>
                    <input type="hidden" name="id">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-4"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Medical History Modal -->
<div class="modal fade" id="cmodal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
            <div class="modal-body" id="medical_history"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var doctor_id = "<?php echo $doctor_id; ?>";
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
    var select_patient = "<?php echo lang('select_patient'); ?>";
    var language = "<?php echo $this->language; ?>";
    var no_available_timeslots = "<?php echo lang('no_available_timeslots'); ?>";
</script>
<script src="common/extranal/js/appointment/appointment_by_doctor.js"></script>