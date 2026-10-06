<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-history text-primary mr-3"></i>
                        <?php echo lang('treatment_history'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('treatment_history'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-light">
                            <h3 class="card-title font-weight-bold"><?php echo lang('Total number of appointments each doctor has handled, both overall and within a specified date range'); ?></h3>
                        </div>

                        <div class="card-body bg-light p-4">
                            <div class="row mb-4 no-print">
                                <div class="col-md-7">
                                    <form role="form" action="appointment/treatmentReport" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input type="text" class="form-control dpd1" name="date_from" autocomplete="off" placeholder="<?php echo lang('date_from'); ?>">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><?php echo lang('to'); ?></span>
                                                    </div>
                                                    <input type="text" class="form-control dpd2" name="date_to" autocomplete="off" placeholder="<?php echo lang('date_to'); ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" name="submit" class="btn btn-primary px-4"><?php echo lang('submit'); ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-5 text-right">
                                    <button class="btn btn-primary px-4" onclick="javascript:window.print();">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                                </div>
                            </div>

                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold"><?php echo lang('doctor_id'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('doctor'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('number_of_patient_treated'); ?></th>
                                        <th class="font-weight-bold no-print"><?php echo lang('actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($doctors as $doctor) { ?>
                                        <tr>
                                            <td><?php echo $doctor->id; ?></td>
                                            <td><?php echo $doctor->name; ?></td>
                                            <td>
                                                <?php
                                                foreach ($appointments as $appointment) {
                                                    if ($appointment->doctor == $doctor->id) {
                                                        $appointment_number[] = 1;
                                                    }
                                                }
                                                if (!empty($appointment_number)) {
                                                    $appointment_total = array_sum($appointment_number);
                                                    echo $appointment_total;
                                                } else {
                                                    $appointment_total = 0;
                                                    echo $appointment_total;
                                                }
                                                ?>
                                            </td>
                                            <td class="no-print">
                                                <a class="btn btn-primary btn-sm" href="appointment/getAppointmentByDoctorId?id=<?php echo $doctor->id; ?>">
                                                    <i class="fa fa-info-circle"></i> <?php echo lang('details'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $appointment_number = NULL; ?>
                                        <?php $appointment_total = NULL; ?>
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