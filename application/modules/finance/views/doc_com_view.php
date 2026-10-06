<!--sidebar end-->
<!--main content start-->


<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                        <?php echo lang('payments'); ?> | <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($doctor)->name; ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><?php echo lang('report'); ?></li>
                            <li class="breadcrumb-item"><a href="finance/doctorsCommission"><?php echo lang('doctors_commission'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('payments'); ?> | <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($doctor)->name; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary">
                            <h3 class="card-title text-white font-weight-800"><?php echo lang('Doctor commission details'); ?></h3>
                        </div>
                        <!-- /.card-header -->

                        <section>
                            <form role="form" class="card-body" action="finance/docComDetails" method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                            <input type="text" class="form-control form-control-lg shadow-sm dpd1 no-print" name="date_from" value="<?php
                                                                                                                                                    if (!empty($from)) {
                                                                                                                                                        echo $from;
                                                                                                                                                    }
                                                                                                                                                    ?>" placeholder="<?php echo lang('date_from'); ?>">
                                            <input type="text" class="form-control form-control-lg shadow-sm dpd2 no-print" name="date_to" value="<?php
                                                                                                                                                    if (!empty($to)) {
                                                                                                                                                        echo $to;
                                                                                                                                                    }
                                                                                                                                                    ?>" placeholder="<?php echo lang('date_to'); ?>">
                                            <input type="hidden" class="form-control dpd2 no-print" name="doctor" value="<?php
                                                                                                                            if (!empty($doctor)) {
                                                                                                                                echo $doctor;
                                                                                                                            }
                                                                                                                            ?>">
                                        </div>
                                        <div class="row"></div>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" name="submit" class="btn btn-primary btn-lg shadow-lg py-3 no-print">
                                            <i class="fas fa-search mr-3"></i><?php echo lang('submit'); ?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </section>

                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('invoice_id'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('patient'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('date'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('total'); ?></th>
                                        <th class="font-weight-bold"><?php echo lang('doctors_commission'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $payment) {
                                        $gross_total[] = $payment->gross_total;;
                                    ?>
                                        <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>
                                        <tr class="">
                                            <td><?php echo $payment->id; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($patient_info)) {
                                                    echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo date('d-m-Y', $payment->date); ?></td>
                                            <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                            <td><?php echo $settings->currency; ?> <?php
                                                                                    if (!empty($payment->doctor)) {
                                                                                        $doc_com[] = $payment->doctor_amount;
                                                                                        echo $payment->doctor_amount;
                                                                                    }
                                                                                    ?></td>
                                        </tr>
                                    <?php } ?>

                                    <?php
                                    if (!empty($gross_total)) {
                                        $gross_total = array_sum($gross_total);
                                    } else {
                                        $gross_total = 0;
                                    }

                                    if (is_array($doc_com) && !empty($doc_com)) {
                                        $doc_com = array_sum($doc_com);
                                    } else {
                                        $doc_com = 0;
                                    }
                                    ?>

                                <tfoot>
                                    <td colspan="3"></td>
                                    <td>
                                        <strong><?php echo lang('total'); ?>: <?php echo $settings->currency . ' ' . $gross_total; ?> </strong>
                                    </td>
                                    <td>
                                        <strong><?php echo lang('total'); ?>: <?php echo  $settings->currency . ' ' . $doc_com; ?> </strong>
                                    </td>
                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-body bg-gradient-primary text-white">
                            <div class="row align-items-center">
                                <div class="col-3">
                                    <i class="fas fa-money-bill-wave fa-3x"></i>
                                </div>
                                <div class="col-9 text-right">
                                    <h3 class="font-weight-bold mb-1"><?php echo lang('total_doctors_commission'); ?></h3>
                                    <h2 class="font-weight-black mb-0">
                                        <?php echo $settings->currency; ?>
                                        <?php
                                        if (!empty($doc_com)) {
                                            $total_doc_com = $doc_com;
                                        } else {
                                            $total_doc_com = 0;
                                        }
                                        echo $total_doc_com;
                                        ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>








<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <link href="common/extranal/css/finance/doc_com_view.css" rel="stylesheet">
        <section class="card">
            <header class="card-header col-md-7">
                <?php echo lang('payments'); ?> || <?php echo lang('doctor'); ?> : <?php echo $this->doctor_model->getDoctorById($doctor)->name; ?>
            </header>
            <!-- <div class="col-md-12"> -->
            <div class=" card-body col-md-7">
                <section>
                    <form role="form" class="card-body" action="finance/docComDetails" method="post" enctype="multipart/form-data">
                        <div class="form-group no-print">


                            <div class="col-md-6">
                                <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                    <input type="text" class="form-control dpd1 no-print" name="date_from" value="<?php
                                                                                                                    if (!empty($from)) {
                                                                                                                        echo $from;
                                                                                                                    }
                                                                                                                    ?>" placeholder="<?php echo lang('date_from'); ?>">
                                    <span class="input-group-addon">To</span>
                                    <input type="text" class="form-control dpd2 no-print" name="date_to" value="<?php
                                                                                                                if (!empty($to)) {
                                                                                                                    echo $to;
                                                                                                                }
                                                                                                                ?>" placeholder="<?php echo lang('date_to'); ?>">
                                    <input type="hidden" class="form-control dpd2 no-print" name="doctor" value="<?php
                                                                                                                    if (!empty($doctor)) {
                                                                                                                        echo $doctor;
                                                                                                                    }
                                                                                                                    ?>">
                                </div>
                                <div class="row"></div>
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" name="submit" class="btn btn-info range_submit no-print"><?php echo lang('submit'); ?></button>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
            <!-- <div class="col-md-5 card-body">
                    <button class="btn btn-info green no-print float-right" onclick="javascript:window.print();"><?php echo lang('print'); ?></button>
                </div> -->
            <!-- </div> -->

            <div class="card-body col-md-7">
                <div class="adv-table editable-table ">
                    <div class="space15"></div>
                    <table class="table table-striped table-hover table-bordered" id="editable-sample">
                        <thead>
                            <tr>
                                <th><?php echo lang('invoice_id'); ?></th>
                                <th><?php echo lang('patient'); ?></th>
                                <th><?php echo lang('date'); ?></th>
                                <th><?php echo lang('total'); ?></th>
                                <th><?php echo lang('doctors_commission'); ?></th>
                            </tr>
                        </thead>
                        <tbody>


                            <?php
                            $gross_total = array();
                            $doc_com1 = array();
                            foreach ($payments as $payment) {
                                $gross_total[] = $payment->gross_total;;
                            ?>
                                <?php $patient_info = $this->db->get_where('patient', array('id' => $payment->patient))->row(); ?>

                                <tr class="">

                                    <td>
                                        <?php
                                        echo $payment->id;
                                        ?>
                                    </td>

                                    <td>
                                        <?php
                                        if (!empty($patient_info)) {
                                            echo $patient_info->name . '</br>' . $patient_info->address . '</br>' . $patient_info->phone;
                                        }
                                        ?>
                                    </td>


                                    <td><?php echo date('d-m-Y', $payment->date); ?></td>
                                    <td><?php echo $settings->currency; ?> <?php echo $payment->gross_total; ?></td>
                                    <td><?php echo $settings->currency; ?> <?php
                                                                            if (!empty($payment->doctor)) {
                                                                                $doc_com1[] = $payment->doctor_amount;
                                                                                echo $payment->doctor_amount;
                                                                            }
                                                                            ?></td>
                                </tr>
                            <?php } ?>


                            <?php

                            if (!empty($gross_total)) {
                                $gross_total = array_sum($gross_total);
                            } else {
                                $gross_total = 0;
                            }

                            if (!empty($doc_com1)) {
                                $doc_com1 = array_sum($doc_com1);
                            } else {
                                $doc_com1 = 0;
                            }

                            ?>


                        <tfoot>
                            <td colspan="3"></td>
                            <td>
                                <strong><?php echo lang('total'); ?>: <?php echo $settings->currency . ' ' . $gross_total; ?> </strong>
                            </td>
                            <td>
                                <strong><?php echo lang('total'); ?>: <?php echo  $settings->currency . ' ' . $doc_com1; ?> </strong>
                            </td>
                        </tfoot>
                        </tbody>
                    </table>
                </div>
            </div>

            <section class="card-body col-md-4 float-right">
                <div class="weather-bg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <i class="fa fa-money"></i>
                                <?php echo lang('total_doctors_commission'); ?>
                            </div>
                            <div class="col-xs-8">
                                <div class="degree">
                                    <?php echo $settings->currency; ?>
                                    <?php
                                    if (!empty($doc_com1)) {
                                        $total_doc_com1 = $doc_com1;
                                    } else {
                                        $total_doc_com1 = 0;
                                    }

                                    echo $total_doc_com1;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var doctor_name = "<?php echo $this->doctor_model->getDoctorById($doctor)->name; ?>";
</script>
<script src="common/extranal/js/finance/doc_com_view.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.dpd1, .dpd2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayBtn: true,
            showMeridian: true
        });
    });
</script>