<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/doctor/details.css" rel="stylesheet">
<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-user-md mr-2"></i><?php echo lang('doctor') ?> <?php echo lang('profile') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('doctor') ?> <?php echo lang('profile') ?></li>
                    </ol>

                    <input type="checkbox" style="display:none;" name="my-checkbox" id="availability-checkbox-doctor" data-bootstrap-switch data-off-color="danger" data-on-color="success"
                        <?php echo ($doctor->available == 1) ? 'checked' : ''; ?> data-doctor-id="<?php echo $doctor->id; ?>"> <!-- Use a real doctor ID -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-9">
                    <div class="card">
                        <section class="">
                            <section class="">
                                <header class="tab-bg-dark-navy-blueee">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#todays"><?php echo lang('todays'); ?> <?php echo lang('appointments'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#patient"><?php echo lang('patient'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#prescription1"><?php echo lang('prescription'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#schedule"><?php echo lang('schedule'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#holiday"><?php echo lang('holidays'); ?></a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#calendar"><?php echo lang('calendar'); ?></a>
                                        </li>
                                    </ul>
                                </header>


                                <div class="card col-md-12">
                                    <div class="tab-content">
                                        <div id="todays" class="tab-pane">
                                            <div class="">
                                                <div class=" no-print">
                                                    <a class="btn btn-info btn_width btn-sm" data-toggle="modal" href="#addAppointmentModal">
                                                        <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?>
                                                    </a>
                                                </div>
                                                <div class="adv-table editable-table ">
                                                    <table class="table table-striped table-hover table-bordered appointment_edit" id="">
                                                        <thead>
                                                            <tr>
                                                                <th><?php echo lang('date'); ?></th>
                                                                <th><?php echo lang('patient_id'); ?></th>
                                                                <th><?php echo lang('patient'); ?></th>
                                                                <th><?php echo lang('status'); ?></th>
                                                                <th><?php echo lang('bill_status'); ?></th>
                                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php
                                                            foreach ($todays_appointments as $todays_appointment) {
                                                                $patient_details = $this->patient_model->getPatientById($todays_appointment->patient);


                                                                $payment_details = $this->finance_model->getPaymentByAppointmentId($todays_appointment->id);
                                                                $total_deposited_amount = $this->finance_model->getDepositAmountByPaymentId($payment_details->id);
                                                                $total_due = $payment_details->gross_total - $total_deposited_amount;
                                                                if ($payment_details->gross_total == $total_due) {
                                                                    if ($payment_details->gross_total != 0) {
                                                                        $bill_status = '<span class="badge badge-warning">' . lang('unpaid') . '</span>';
                                                                    } else {
                                                                        $bill_status = '<span class="badge badge-primary">' . lang('paid') . '</span>';
                                                                    }
                                                                } elseif ($total_due == 0) {
                                                                    $bill_status = '<span class="badge badge-primary">' . lang('paid') . '</span>';
                                                                } else {
                                                                    $bill_status = '<span class="badge badge-warning">' . lang('due') . '</span>';
                                                                }




                                                                if (!empty($patient_details)) {
                                                            ?>
                                                                    <tr class="">
                                                                        <td><?php echo date('d-m-Y', $todays_appointment->date); ?></td>
                                                                        <td><?php echo $todays_appointment->patient; ?></td>
                                                                        <td><?php echo $patient_details->name; ?></td>
                                                                        <td><?php echo $todays_appointment->status; ?></td>
                                                                        <td><?php echo $bill_status; ?></td>
                                                                        <td class="no-print d-flex gap-1">
                                                                            <button type="button" class="btn btn-info btn-sm btn_width editAppointmentButton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $todays_appointment->id; ?>"><i class="fa fa-edit"></i> </button>
                                                                            <a class="btn btn-danger btn-sm btn_width delete_button" title="<?php echo lang('delete'); ?>" href="appointment/delete?id=<?php echo $todays_appointment->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                                                            <a class="btn btn-warning btn-sm btn_width green button_his" title="<?php echo lang('history'); ?>" href="patient/medicalHistory?id=<?php echo $todays_appointment->patient; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('patient'); ?> <?php echo lang('history'); ?></a>
                                                                            <?php if ($todays_appointment->status == 'Confirmed') { ?>
                                                                                <a class="btn btn-info btn-sm btn_width detailsbutton button_his" title=" <?php echo lang('start_live'); ?>" href="meeting/instantLive?id=<?php echo $todays_appointment->id; ?> " target="_blank" onclick="return confirm('Are you sure you want to start a live meeting with this patient? SMS and Email notification will be sent to the Patient.');"><i class="fa fa-headphones"></i> <?php echo lang('live'); ?> </a>
                                                                            <?php } ?>
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
                                        </div>



                                        <div id="patient" class="tab-pane">
                                            <div class="">
                                                <div class="adv-table editable-table ">
                                                    <?php if (!empty($appointment_patients)) { ?>
                                                        <table class="table table-striped table-hover table-bordered patient_datatable" id="editable-sample">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo lang('patient_id'); ?></th>
                                                                    <th><?php echo lang('patient'); ?> <?php echo lang('name'); ?></th>
                                                                    <th class="no-print"><?php echo lang('options'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                foreach ($appointment_patients as $appointment_patient) {
                                                                    $appointed_patient = $this->patient_model->getPatientById($appointment_patient);
                                                                ?>
                                                                    <tr class="">

                                                                        <td><?php echo $appointed_patient->id; ?></td>
                                                                        <td><?php echo $appointed_patient->name; ?></td>
                                                                        <td class="no-print">
                                                                            <a class="btn btn-sm btn-warning" title="<?php echo lang('history'); ?>" href="patient/medicalHistory?id=<?php echo $appointed_patient->id; ?>"><i class="fa fa-stethoscope"></i> <?php echo lang('history'); ?></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="prescription1" class="tab-pane">
                                            <div class="">
                                                <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                                    <div class=" no-print">
                                                        <a class="btn btn-info btn_width btn-sm" href="prescription/addPrescriptionView">
                                                            <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                                <div class="adv-table editable-table ">
                                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                                        <thead>
                                                            <tr>

                                                                <th><?php echo lang('date'); ?></th>
                                                                <th><?php echo lang('patient'); ?></th>
                                                                <th><?php echo lang('medicine'); ?></th>
                                                                <th class="no-print"><?php echo lang('options'); ?></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($prescriptions as $prescription) { ?>
                                                                <tr class="">
                                                                    <td><?php echo date('m/d/Y', $prescription->date); ?></td>
                                                                    <td><?php echo $this->patient_model->getPatientById($prescription->patient)->name; ?></td>
                                                                    <td>

                                                                        <?php
                                                                        if (!empty($prescription->medicine)) {
                                                                            $medicine = explode('###', $prescription->medicine);
                                                                            foreach ($medicine as $key => $value) {
                                                                                $medicine_id = explode('***', $value);
                                                                                $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                                                                                $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . ' Days<br>';
                                                                                rtrim($medicine_name_with_dosage, ',');
                                                                                echo '<p>' . $medicine_name_with_dosage . '</p>';
                                                                            }
                                                                        }
                                                                        ?>


                                                                    </td>
                                                                    <td class="no-print d-flex gap-1">
                                                                        <a class="btn btn-secondary btn-sm btn_width" href="prescription/viewPrescription?id=<?php echo $prescription->id; ?>"><i class="fa fa-eye"> <?php echo lang('view'); ?> </i></a>
                                                                        <?php if ($this->ion_auth->in_group('Doctor')) { ?>
                                                                            <a class="btn btn-info btn-sm btn_width" href="prescription/editPrescription?id=<?php echo $prescription->id; ?>" "><i class=" fa fa-edit"></i> <?php echo lang('edit'); ?></a>
                                                                            <a class="btn btn-danger btn-sm btn_width delete_button" href="prescription/delete?id=<?php echo $prescription->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> <?php echo lang('delete'); ?></a>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="schedule" class="tab-pane">
                                            <div class="">
                                                <?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
                                                    <div class=" no-print">
                                                        <a class="btn btn-info btn_width btn-sm" data-toggle="modal" href="#addScheduleModal">
                                                            <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                                <div class="adv-table editable-table ">
                                                    <table class="table table-striped table-hover table-bordered" id="editable-samplee">
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
                                                                $i = $i + 1;
                                                            ?>
                                                                <tr class="">
                                                                    <td class="weekday"> <?php echo $i; ?></td>
                                                                    <td> <?php echo $schedule->weekday; ?></td>
                                                                    <td><?php echo $schedule->s_time; ?></td>
                                                                    <td><?php echo $schedule->e_time; ?></td>
                                                                    <td><?php echo $schedule->duration * 5 . ' ' . lang('minitues'); ?></td>
                                                                    <td>

                                                                        <a class="btn btn-danger btn-sm" href="schedule/deleteSchedule?id=<?php echo $schedule->id; ?>&doctor=<?php echo $schedule->doctor; ?>&weekday=<?php echo $schedule->weekday; ?>&all=all" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>



                                        <div id="holiday" class="tab-pane">
                                            <div class="">
                                                <div class=" no-print">
                                                    <a class="btn btn-info btn_width btn-sm" data-toggle="modal" href="#holidayModal">
                                                        <i class="fa fa-plus-circle"> </i> <?php echo lang('add_new'); ?>
                                                    </a>
                                                </div>
                                                <div class="adv-table editable-table ">
                                                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                                        <thead>
                                                            <tr>
                                                                <th> # </th>
                                                                <th> <?php echo lang('date'); ?></th>
                                                                <th> <?php echo lang('options'); ?></th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php
                                                            $i = 0;
                                                            foreach ($holidays as $holiday) {
                                                                $i = $i + 1;
                                                            ?>
                                                                <tr class="">
                                                                    <td> <?php echo $i; ?></td>
                                                                    <td> <?php echo date('d-m-Y', $holiday->date); ?></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-info btn-sm btn_width editHoliday" data-toggle="modal" data-id="<?php echo $holiday->id; ?>"><i class="fa fa-edit"></i> <?php echo lang('edit'); ?></button>
                                                                        <a class="btn btn-danger btn-sm btn_width delete_button" href="schedule/deleteHoliday?id=<?php echo $holiday->id; ?>&doctor=<?php echo $doctor->id; ?>&redirect=doctor/details" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"> </i> <?php echo lang('delete'); ?></a>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <div id="calendar" class="tab-pane active">
                                            <div class="">
                                                <div class="card-body">
                                                    <aside>
                                                        <section class="card">
                                                            <div class="card-body">
                                                                <div id="calendar" class="has-toolbar calendar_view"></div>
                                                            </div>
                                                        </section>
                                                    </aside>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </section>



                        </section>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-12 col-md-3">
                    <section class="">
                        <section class="card">
                            <div class="card-body profile-nav">
                                <div class="text-center">
                                    <?php if (!empty($doctor->img_url)) { ?>
                                        <a href="#">
                                            <img src="<?php echo $doctor->img_url; ?>" style="height: 50px;" alt="" class="rounded-circle">
                                        </a>
                                    <?php } ?>
                                    <h1 class="text-lg"> <?php echo $doctor->name; ?> </h1>
                                    <p> <?php echo $doctor->email; ?> </p>
                                    <button type="button" class="btn btn-sm btn-primary doctoreditbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $doctor->id; ?>"><i class="fa fa-edit"> </i> <?php echo lang('edit'); ?></button>
                                </div>

                                <ul class="list-group list-group-flush nav nav-pills nav-stacked">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('doctor'); ?> <?php echo lang('name'); ?>
                                        <span class="badge badge-primary float-right r-activity"><?php echo $doctor->name; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('doctor_id'); ?>
                                        <span class="badge badge-primary float-right r-activity"><?php echo $doctor->id; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('profile'); ?>
                                        <span class="badge badge-primary float-right r-activity"><?php echo $doctor->profile; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('phone'); ?>
                                        <span class="badge badge-primary float-right r-activity"><?php echo $doctor->phone; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo lang('email'); ?>
                                        <span class="badge badge-primary float-right r-activity"><?php echo $doctor->email; ?></span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center address_bar">
                                        <?php echo lang('address'); ?>
                                        <span class="address_bar float-right"><?php echo $doctor->address; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </section>


                    </section>
                </div>
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




<!-- Add Patient Material Modal-->
<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('add'); ?> <?php echo lang('files'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addPatientMaterial" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="form-group d-flex col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('title'); ?></label>
                        <input type="text" class="form-control form-control-lg" name="title" placeholder="">
                    </div>
                    <div class="form-group d-flex col-md-6">
                        <label for="exampleInputEmail1"> <?php echo lang('file'); ?></label>
                        <input type="file" name="img_url">
                    </div>

                    <input type="hidden" name="patient" value='<?php echo $patient->id; ?>'>

                    <div class="form-group d-flex col-md-6">
                        <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Patient Modal-->


<!-- Add Medical History Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><i class="fa fa-plus-circle"></i> <?php echo lang('add_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control col-sm-9 form-control col-sm-9-inline input-medium default-date-picker" name="date" value='' placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control col-sm-9" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Medical History Modal-->

<!-- Edit Medical History Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"><i class="fa fa-edit"></i> <?php echo lang('edit_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="medical_historyEditForm" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <input type="text" class="form-control col-sm-9 form-control col-sm-9-inline input-medium default-date-picker" name="date" value='' placeholder="">
                    </div>
                    <div class="form-group d-flex col-md-12">
                        <label class="control-label col-md-3"><?php echo lang('description'); ?></label>
                        <div class="col-md-9">
                            <textarea class="ckeditor form-control col-sm-9 editor" id="editor" name="description" value="" rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="patient_id" value='<?php echo $patient->id; ?>'>
                    <input type="hidden" name="id" value=''>
                    <section class="">
                        <button type="submit" name="submit" class="btn btn-info submit_button"><?php echo lang('submit'); ?></button>
                    </section>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade" role="dialog" id="cmodal">
    <div class="modal-dialog modal-xl med_his" role="document">
        <div class="modal-content">

            <div id='medical_history' class="row">

            </div>
            <div class="modal-footer">
                <div class="col-md-12">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>



<!-- Add Appointment Modal-->
<div class="modal fade" id="addAppointmentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add_appointment'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="appointment/addNew" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="col-md-12 row">
                        <div class=" col-sm-6 form-group d-flex">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?></label>
                            <select class="form-control col-sm-9 m-bot15  pos_select" id="pos_select" name="patient" value=''>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="pos_client clearfix">
                            <div class="form-group">
                                <div class="col-md-3 payment_label">
                                    <label for="exampleInputEmail1" class=""> <?php echo lang('patient'); ?> <?php echo lang('name'); ?></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control pay_in" name="p_name" value='' placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 payment_label">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('email'); ?></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control col-sm-9 pay_in" name="p_email" value='' placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 payment_label">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('phone'); ?></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control col-sm-9 pay_in" name="p_phone" value='' placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 payment_label">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('age'); ?></label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" class="form-control col-sm-9 pay_in" name="p_age" value='' placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3 payment_label">
                                    <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> <?php echo lang('gender'); ?></label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control col-sm-9 m-bot15" name="p_gender" value=''>

                                        <option value="Male" <?php
                                                                if (!empty($patient->sex)) {
                                                                    if ($patient->sex == 'Male') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>> <?php echo lang('male'); ?> </option>
                                        <option value="Female" <?php
                                                                if (!empty($patient->sex)) {
                                                                    if ($patient->sex == 'Female') {
                                                                        echo 'selected';
                                                                    }
                                                                }
                                                                ?>> <?php echo lang('female'); ?> </option>

                                    </select>
                                </div>
                            </div>
                        </div>






                        <div class="form-group doctor_div d-flex">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                            <select class="form-control col-sm-9 js-example-basic-single" id="adoctors" name="doctor" value=''>
                                <option value=""><?php echo lang('select'); ?></option>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                            <input type="text" class="form-control col-sm-9 default-date-picker" id="date" readonly="" name="date" value='' placeholder="">
                        </div>

                        <div class="form-group mt-3 d-flex">
                            <label class="col-sm-3"><?php echo lang('time_slot'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="time_slot" id="aslots" value=''>

                            </select>
                        </div>




                        <div class="form-group mt-3 d-flex">
                            <label for="exampleInputEmail1"> <?php echo lang(''); ?> <?php echo lang('status'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="status" value=''>
                                <option value="Pending Confirmation" <?php
                                                                        ?>> <?php echo lang('pending_confirmation'); ?> </option>
                                <option value="Confirmed" <?php
                                                            ?>> <?php echo lang('confirmed'); ?> </option>
                                <option value="Treated" <?php
                                                        ?>> <?php echo lang('treated'); ?> </option>
                                <option value="Cancelled" <?php
                                                            ?>> <?php echo lang('cancelled'); ?> </option>
                            </select>
                        </div>




                    </div>

                    <div class="col-md-6">


                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="remarks" value='' placeholder="">
                        </div>


                        <div class="form-group">

                            <label class="col-sm-3"><?php echo lang('visit'); ?> <?php echo lang('type'); ?> &#42;</label>

                            <select class="form-control col-sm-9 m-bot15" name="visit_description" id="visit_description" value='' required>

                            </select>

                        </div>





                        <input type="hidden" name="redirect" value='doctor/details'>


                        <div class="form-group d-flex form_data">
                            <label for="exampleInputEmail1"> <?php echo lang(''); ?> <?php echo lang('charges'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="visit_charges" id="visit_charges" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group d-flex form_data mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('discount'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="discount" id="discount" value='0' placeholder="">
                        </div>
                        <div class="form-group d-flex form_data mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('grand_total'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="grand_total" id="grand_total" value='0' placeholder="" readonly="">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('send_sms') ?></label>
                            <input type="checkbox" name="sms" value="sms">
                        </div>

                        <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                            <div class="col-md-12">
                                <input type="checkbox" id="pay_now_appointment" name="pay_now_appointment" value="pay_now_appointment">
                                <label for=""> <?php echo lang('pay_now'); ?></label><br>
                                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                                    <span class="info_message"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed') ?></span>
                                <?php } ?>
                            </div>

                            <div class="payment_label col-md-12 d-none deposit_type">
                                <label for="exampleInputEmail1"> <?php echo lang('deposit_type'); ?></label>

                                <div class="">
                                    <select class="form-control col-sm-9 m-bot15 js-example-basic-single selecttype" id="selecttype" name="deposit_type" value=''>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                            <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                            <option value="Card"> <?php echo lang('card'); ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <?php
                                $payment_gateway = $settings->payment_gateway;
                                ?>



                                <div class="cardPayment">

                                    <hr>
                                    <?php if ($payment_gateway != 'Paymob') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                            <div class="payment pad_bot">
                                                <img src="uploads/card.png" width="100%">
                                            </div>
                                        </div>
                                    <?php }
                                    ?>

                                    <?php
                                    if ($payment_gateway == 'PayPal') {
                                    ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                            <select class="form-control col-sm-9 m-bot15" name="card_type" value=''>

                                                <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                                <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                                    ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                            <input type="text" id="cardholder" class="form-control col-sm-9 pay_in" name="cardholder" value='' placeholder="">
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                            <input type="text" id="card" class="form-control col-sm-9 pay_in" name="card_number" value='' placeholder="">
                                        </div>



                                        <div class="col-md-8 payment pad_bot mt-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                            <input type="text" class="form-control col-sm-9 pay_in" id="expire" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="">
                                        </div>
                                        <div class="col-md-4 payment pad_bot mt-3">
                                            <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                            <input type="text" class="form-control col-sm-9 pay_in" id="cvv" maxlength="3" name="cvv" value='' placeholder="">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>


                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-3 payment_label">
                                </div>
                                <div class="col-md-9">
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group d-flex cashsubmit payment right-six col-md-12">
                                        <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right"> <?php echo lang('submit'); ?></button>
                                    </div>
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group d-flex cardsubmit  right-six col-md-12 d-none">
                                        <button type="submit" name="pay_now" id="submit-btn" class="btn btn-info row float-right" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                    ?>onClick="stripePay(event);" <?php }
                                                                                                                                                                    ?> <?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                                                                                                                                                                        ?>onClick="twoCheckoutPay(event);" <?php }
                                                                                                                                                                                                            ?>> <?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="form-group payment right-six col-md-12">
                                <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right mr-0"> <?php echo lang('submit'); ?></button>
                            </div>
                        <?php } ?>
                    </div>

            </div>
            </form>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
<!-- Add Appointment Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="editAppointmentModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_appointment'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editAppointmentForm" action="appointment/addNew" class="clearfix row" method="post" enctype="multipart/form-data">

                    <div class="col-md-6">
                        <div class="form-group patient_div d-flex">
                            <label for="exampleInputEmail1"> <?php echo lang('patient'); ?> &#42;</label>
                            <select class="form-control col-sm-9 m-bot15  pos_select1 patient" id="pos_select1" name="patient" value='' required>

                            </select>
                        </div>

                        <div class="form-group d-flex doctor_div1">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?></label>
                            <select class="form-control col-sm-9 m-bot15 js-example-basic-single doctor" id="adoctors1" name="doctor" value=''>
                                <option value="">Select .....</option>
                                <option value="<?php echo $doctor->id; ?>"><?php echo $doctor->name; ?> </option>
                            </select>
                        </div>

                        <div class="form-group d-flex mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                            <input type="text" class="form-control col-sm-9 default-date-picker" readonly="" id="date1" name="date" value='' placeholder="">
                        </div>

                        <div class="form-group d-flex mt-3">
                            <label class="col-sm-3"><?php echo lang('time_slot'); ?></label>
                            <select class="form-control form-control-lg" name="time_slot" id="aslots1" value=''>

                            </select>
                        </div>

                        <div class="form-group d-flex mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang(''); ?> <?php echo lang('status'); ?></label>
                            <select class="form-control col-sm-9 m-bot15" name="status" value=''>
                                <option value="Pending Confirmation" <?php
                                                                        ?>> <?php echo lang('pending_confirmation'); ?> </option>
                                <option value="Confirmed" <?php
                                                            ?>> <?php echo lang('confirmed'); ?> </option>
                                <option value="Treated" <?php
                                                        ?>> <?php echo lang('treated'); ?> </option>
                                <option value="Cancelled" <?php
                                                            ?>> <?php echo lang('cancelled'); ?> </option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('remarks'); ?></label>
                            <input type="text" class="form-control form-control-lg" name="remarks" value='' placeholder="">
                        </div>

                        <input type="hidden" name="redirect" value='doctor/details'>

                        <div class="form-group">

                            <label class="col-sm-3"><?php echo lang('visit'); ?> <?php echo lang('type'); ?> &#42;</label>

                            <select class="form-control col-sm-9 m-bot15" name="visit_description" id="visit_description1" value='' required>

                            </select>

                        </div>

                        <input type="hidden" name="id" id="appointment_id" value=''>
                        <div class="form-group d-flex d-none consultant_fee_div mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang(''); ?> <?php echo lang('charges'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="visit_charges" id="visit_charges1" value='' placeholder="" readonly="">
                        </div>
                        <div class="form-group d-flex d-none consultant_fee_div mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('discount'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="discount" id="discount1" value='0' placeholder="">
                        </div>
                        <div class="form-group d-flex d-none consultant_fee_div mt-3">
                            <label for="exampleInputEmail1"> <?php echo lang('grand_total'); ?></label>
                            <input type="number" class="form-control form-control-lg" name="grand_total" id="grand_total1" value='0' placeholder="" readonly="">
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3"> <?php echo lang('send_sms') ?> </label>
                            <input type="checkbox" name="sms" value="sms">
                        </div>


                        <?php if (!$this->ion_auth->in_group(array('Nurse', 'Doctor'))) { ?>
                            <div class="col-md-12 d-none pay_now">
                                <input type="checkbox" id="pay_now_appointment1" name="pay_now_appointment" value="pay_now_appointment">
                                <label for=""> <?php echo lang('pay_now'); ?></label><br>
                                <span class="info_message"><?php echo lang('if_pay_now_checked_please_select_status_to_confirmed') ?></span>
                            </div>
                            <div class="col-md-12 d-none payment_status form-group">
                                <label for=""> <?php echo lang('payment'); ?> <?php echo lang('status'); ?></label><br>
                                <input type="text" class="form-control form-control-lg" id="pay_now_appointment" name="payment_status_appointment" value="paid" readonly="">


                            </div>
                            <div class="payment_label col-md-12 d-none deposit_type1">
                                <label for="exampleInputEmail1"> <?php echo lang('deposit_type'); ?></label>

                                <div class="">
                                    <select class="form-control col-sm-9 m-bot15 js-example-basic-single selecttype1" id="selecttype1" name="deposit_type" value=''>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                            <option value="Cash"> <?php echo lang('cash'); ?> </option>
                                            <option value="Card"> <?php echo lang('card'); ?> </option>
                                        <?php } ?>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <?php
                                $payment_gateway = $settings->payment_gateway;
                                ?>



                                <div class="card1">

                                    <hr>
                                    <?php if ($payment_gateway != 'Paymob') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('accepted'); ?> <?php echo lang('cards'); ?></label>
                                            <div class="payment pad_bot">
                                                <img src="uploads/card.png" width="100%">
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if ($payment_gateway == 'PayPal') {
                                    ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('type'); ?></label>
                                            <select class="form-control col-sm-9 m-bot15" name="card_type" value=''>

                                                <option value="Mastercard"> <?php echo lang('mastercard'); ?> </option>
                                                <option value="Visa"> <?php echo lang('visa'); ?> </option>
                                                <option value="American Express"> <?php echo lang('american_express'); ?> </option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway == '2Checkout' || $payment_gateway == 'PayPal') {
                                    ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('cardholder'); ?> <?php echo lang('name'); ?></label>
                                            <input type="text" id="cardholder1" class="form-control col-sm-9 pay_in" name="cardholder" value='' placeholder="">
                                        </div>
                                    <?php } ?>
                                    <?php if ($payment_gateway != 'Pay U Money' && $payment_gateway != 'Paystack' && $payment_gateway != 'SSLCOMMERZ' && $payment_gateway != 'Paytm') { ?>
                                        <div class="col-md-12 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('card'); ?> <?php echo lang('number'); ?></label>
                                            <input type="text" id="card1" class="form-control col-sm-9 pay_in" name="card_number" value='' placeholder="">
                                        </div>



                                        <div class="col-md-8 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('expire'); ?> <?php echo lang('date'); ?></label>
                                            <input type="text" class="form-control col-sm-9 pay_in" id="expire1" data-date="" data-date-format="MM YY" placeholder="Expiry (MM/YY)" name="expire_date" maxlength="7" aria-describedby="basic-addon1" value='' placeholder="" readonly>
                                        </div>
                                        <div class="col-md-4 payment pad_bot">
                                            <label for="exampleInputEmail1"> <?php echo lang('cvv'); ?> </label>
                                            <input type="text" class="form-control col-sm-9 pay_in" id="cvv1" maxlength="3" name="cvv" value='' placeholder="">
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>


                            </div>
                            <div class="col-md-12 row">
                                <div class="col-md-3 payment_label">
                                </div>
                                <div class="col-md-9">
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group cashsubmit1 payment  right-six col-md-12">
                                        <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right"> <?php echo lang('submit'); ?></button>
                                    </div>
                                    <?php $twocheckout = $this->db->get_where('paymentGateway', array('name =' => '2Checkout'))->row(); ?>
                                    <div class="form-group cardsubmit1  right-six col-md-12 d-none">
                                        <button type="submit" name="pay_now" id="submit-btn1" class="btn btn-info row float-right" <?php if ($settings->payment_gateway == 'Stripe') {
                                                                                                                                    ?>onClick="stripePay1(event);" <?php }
                                                                                                                                                                    ?> <?php if ($settings->payment_gateway == '2Checkout' && $twocheckout->status == 'live') {
                                                                                                                                                                        ?>onClick="twoCheckoutPay1(event);" <?php }
                                                                                                                                                                                                            ?>> <?php echo lang('submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="form-group payment right-six col-md-12">
                                <button type="submit" name="submit2" id="submit1" class="btn btn-info row float-right mr-0"> <?php echo lang('submit'); ?></button>
                            </div>
                        <?php } ?>
                    </div>


                </form>
            </div>

        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- Edit Event Modal-->


<!-- Add Holiday Modal-->
<div class="modal fade" id="holidayModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('holiday'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addHoliday" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control col-sm-9 default-date-picker" name="date" id="validationCustom01" value='' autocomplete="off" required="required">
                        </div>

                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctor->id; ?>'>
                    <input type="hidden" name="redirect" value='doctor/details'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group d-flex col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>

                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Holiday Modal-->




<!-- Edit Holiday Modal-->
<div class="modal fade" id="editHolidayModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit'); ?> <?php echo lang('holiday'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editHolidayForm" action="schedule/addHoliday" class="clearfix row" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"> <?php echo lang('date'); ?></label>
                        <div class="input-group bootstrap-timepicker col-sm-9">
                            <input type="text" class="form-control col-sm-9 default-date-picker" name="date" value='' autocomplete="off" required="">
                        </div>
                    </div>
                    <input type="hidden" name="doctor" value='<?php echo $doctor->id; ?>'>
                    <input type="hidden" name="redirect" value='doctor/details'>
                    <input type="hidden" name="id" value=''>
                    <div class="form-group d-flex col-md-12">
                        <button type="submit" name="submit" class="btn btn-info float-right"> <?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Holiday Modal-->



<!-- Add Time Slot Modal-->
<div class="modal fade" id="addScheduleModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('add'); ?> <?php echo lang('schedule'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="schedule/addSchedule" class="clearfix row" method="post" enctype="multipart/form-data">

<div class="row">
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
                    
                    <input type="hidden" name="doctor" id="doctorchoose" value='<?php echo $doctor_id; ?>'>
                    <input type="hidden" name="redirect" value='doctor/details'>
                    <input type="hidden" name="id" value=''>

                    <div class="form-group d-flex col-md-12">
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
<div class="modal fade" id="editSceduleModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control col-sm-9 timepicker-default" name="s_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>

                    </div>
                    <div class="form-group d-flex bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('end_time'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <input type="text" class="form-control col-sm-9 timepicker-default" name="e_time" value=''>
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-clock-o"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group d-flex bootstrap-timepicker">
                        <label for="exampleInputEmail1"> <?php echo lang('weekday'); ?></label>
                        <div class="input-group bootstrap-timepicker">
                            <select class="form-control col-sm-9 m-bot15" id="weekday1" name="weekday" value=''>
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
                        <select class="form-control col-sm-9 m-bot15" name="duration" value=''>

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
                    <input type="hidden" name="redirect" value='doctor/details'>
                    <input type="hidden" name="id" value=''>
                    <button type="submit" name="submit" class="btn btn-info"> <?php echo lang('submit'); ?></button>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Time Slot Modal-->


<!-- Edit Doctor Modal-->
<div class="modal fade" id="myModalEdit" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold"> <?php echo lang('edit_doctor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="name" value='' placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('email'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="email" value='' placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('password'); ?></label>
                            <input type="password" class="form-control form-control-lg" name="password" placeholder="********">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('address'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="address" value='' placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('phone'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-lg" name="phone" value='' placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('department'); ?></label>
                            <select class="form-control col-sm-9 m-bot15 js-example-basic-single department" name="department" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>" <?php
                                                                                    if (!empty($doctor->department)) {
                                                                                        if ($department->id == $doctor->department) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group profile1 d-flex">
                            <label for="exampleInputEmail1"> <?php echo lang('doctor'); ?> <?php echo lang('description'); ?></label>
                            <textarea class="form-control form-control-lg" id="editor3" name="profile" value="" rows="5" cols="20"></textarea>
                            <!-- <input type="hidden" name="profile" id="profile1" value=""> -->
                        </div>
                        <input type="hidden" name="redirect" id="" value="doctor">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> <?php echo lang('signature'); ?> &ast; </label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" id="signature" height="100px" alt="" />
                                    </div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                            <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                            <input type="file" class="default" name="signature" />
                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-3"><?php echo lang(''); ?> <?php echo lang('image'); ?> </label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" id="img" height="100px" alt="" />
                                    </div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                            <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                            <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                            <input type="file" class="default" name="img_url" />
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>



                        <input type="hidden" name="id" id="id_value" value=''>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Doctor Modal-->



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


<script>

</script>


<script src="common/assets/tinymce/tinymce.min.js"></script>
<!-- <script src="common/extranal/js/doctor/doctor.js"></script> -->

<script src="common/extranal/js/doctor/details.js"></script>