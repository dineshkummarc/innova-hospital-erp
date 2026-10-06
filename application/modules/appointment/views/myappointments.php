<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/appointment/appointment.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-calendar-check mr-2"></i>
                        <?php echo lang('appointments') ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('appointments') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the appointments details'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" onclick="javascript:window.print();" class="btn btn-success btn-sm no-print">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('id'); ?></th>
                                        <th> <?php echo lang('patient'); ?></th>
                                        <th> <?php echo lang('doctor'); ?></th>
                                        <th> <?php echo lang('date-time'); ?></th>
                                        <th> <?php echo lang('remarks'); ?></th>
                                        <th> <?php echo lang('status'); ?></th>
                                        <th> <?php echo lang('description'); ?></th>
                                        <th> <?php echo lang('invoice_id'); ?></th>
                                        <th> <?php echo lang('amount'); ?></th>
                                        <th> <?php echo lang('bill'); ?> <?php echo lang('status'); ?></th>
                                        <th> <?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <?php
                                    foreach ($appointments as $appointment) {
                                        if ($user_id == $appointment->patient) {



                                            $payment_details = $this->finance_model->getPaymentByAppointmentId($appointment->id);
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
                                            $patientdetails = $this->patient_model->getPatientById($appointment->patient);
                                            if (!empty($patientdetails)) {
                                                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $patientdetails->name . '</a>';
                                            } else {
                                                $patientname = ' <a type="button" class="history" data-toggle = "modal" data-id="' . $appointment->patient . '"> ' . $appointment->patientname . '</a>';
                                            }
                                            $doctordetails = $this->doctor_model->getDoctorById($appointment->doctor);
                                            if (!empty($doctordetails)) {
                                                $doctorname = $doctordetails->name;
                                            } else {
                                                $doctorname = $appointment->doctorname;
                                            }


                                            if ($appointment->status == 'Confirmed') {
                                                if (empty($appointment->meeting_id)) {
                                                    $options7 = '';
                                                } else {
                                                    $options7 = '<a class="btn btn-info btn-sm btn_width detailsbutton buttoncolor" title="' . lang('start_live') . '"  href="' . $appointment->join_url . '" target="_blank" onclick="return confirm(\'Are you sure you want to start a live meeting with the doctor?\');"><i class="fa fa-headphones"></i> ' . lang('live') . '</a>';
                                                }
                                            } else {
                                                $options7 = '';
                                            }



                                            if (!empty($appointment->visit_description)) {
                                                $visit_type = $this->doctorvisit_model->GetDoctorVisitById($appointment->visit_description);
                                                if ($visit_type) {
                                                    $visit_type_name = $visit_type->visit_description;
                                                } else {
                                                    $visit_type_name = '';
                                                }
                                            } else {
                                                $visit_type_name = '';
                                            }

                                            if (!empty($payment_details->id)) {
                                                $invoice = '<a href="finance/invoice?id=' . $payment_details->id . '">' . $payment_details->id . '</a>';
                                            } else {
                                                $invoice = '';
                                            }


                                            if ($appointment->s_time == 'Not Selected') {
                                                $time_string = lang('not_selected');
                                            } else {
                                                $this->db->where('hospital_id', $this->hospital_id);
                                                $this->settings = $this->db->get('settings')->row();
                                                if ($this->settings->time_format == '24') {
                                                    $appointment->s_time = $this->settings_model->convert_to_24h($appointment->s_time);
                                                    $appointment->e_time = $this->settings_model->convert_to_24h($appointment->e_time);
                                                }
                                                $time_string = $appointment->s_time . ' - ' . $appointment->e_time;
                                            }









                                    ?>

                                            <tr class="">
                                                <td><?php echo $appointment->id; ?></td>
                                                <td><?php echo $this->patient_model->getPatientById($appointment->patient)->name; ?></td>
                                                <td><?php echo $this->doctor_model->getDoctorById($appointment->doctor)->name; ?></td>
                                                <td><?php echo date('d-m-Y', $appointment->date) . ' <br> ' . $time_string; ?></td>
                                                <td><?php echo $appointment->remarks; ?></td>
                                                <td><?php echo lang(strtolower($appointment->status)); ?></td>
                                                <td><?php echo $visit_type_name; ?></td>
                                                <td><?php echo $invoice; ?></td>
                                                <td><?php echo $this->settings->currency . '' . $appointment->visit_charges; ?></td>
                                                <td><?php echo $bill_status; ?></td>
                                                <td><?php echo $options7; ?></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>


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



<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = <?php echo $this->language; ?>;
</script>
<script type="text/javascript">
    var no_available_timeslots = "<?php echo lang('no_available_timeslots'); ?>";
</script>

<script>
    $(document).ready(function() {
        "use strict";
        var table = $("#editable-sample").DataTable({
            responsive: true,

            processing: true,
            searchable: true,
            scroller: {
                loadingIndicator: true,
            },
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",

            buttons: [{
                    extend: "copyHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                },
                {
                    extend: "excelHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                },
                {
                    extend: "csvHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                },
                {
                    extend: "pdfHtml5",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    },
                },
                {
                    extend: "print",
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
            ],
            aLengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            iDisplayLength: 100,
            order: [
                [0, "desc"]
            ],
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search...",
                url: "common/assets/DataTables/languages/" + language + ".json",
            },
        });
        table.buttons().container().appendTo(".custom_buttons");
    });
</script>