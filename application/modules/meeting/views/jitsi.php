<?php
$appointment_details = $this->appointment_model->getAppointmentById($appointmentid);
$doctor_details = $this->doctor_model->getDoctorById($appointment_details->doctor);
$doctor_name = $doctor_details->name;
$patient_details = $this->patient_model->getPatientById($appointment_details->patient);
$patient_name = $patient_details->name;
$patient_phone = $patient_details->phone;
$patient_id = $appointment_details->patient;

$display_name = $this->ion_auth->user()->row()->username;
$email = $this->ion_auth->user()->row()->email;
?>



<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-video mr-2"></i><?php echo lang('live'); ?> <?php echo lang('appointment'); ?></h1>
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
                <div class="col-8">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h3 class="card-title">All the department names and related informations</h3>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="">
                            <div class="">
                                <div class="tab-content" id="meeting">
                                    <input type="hidden" name="appointmentid" id="appointmentid" value="<?php echo $appointmentid; ?>">
                                    <input type="hidden" name="username" id="username" value="<?php echo $display_name; ?>">
                                    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('appointment'); ?> <?php echo lang('details'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">



                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <?php echo lang('doctor'); ?> <?php echo lang('name'); ?>
                                        <span class="badge badge-secondary float-right"><?php echo $doctor_name; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <?php echo lang('patient'); ?> <?php echo lang('name'); ?>
                                        <span class="badge badge-secondary float-right"><?php echo $patient_name; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <?php echo lang('patient_id'); ?>
                                        <span class="badge badge-secondary float-right"><?php echo $patient_id; ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <?php echo lang('appointment'); ?> <?php echo lang('date'); ?>
                                        <span class="badge badge-secondary float-right"><?php echo date('jS F, Y', $appointment_details->date); ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <?php echo lang('appointment'); ?> <?php echo lang('slot'); ?>
                                        <span class="badge badge-secondary float-right"><?php echo $appointment_details->time_slot; ?></span>
                                    </a>
                                </li>
                            </ul>


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








<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>


<script src="https://meet.jit.si/external_api.js"></script>
<script type="text/javascript">
    var room_id = "<?php echo $appointment_details->room_id; ?>";
</script>
<script src="common/extranal/js/meeting/jitsi.js"></script>