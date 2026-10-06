<!--sidebar end-->
<!--main content start-->

<link href="common/extranal/css/bed/edit_alloted_bed.css" rel="stylesheet">

<style>
    .site-height {
        min-height: 1500px;
    }

    @media print {
        .site-height {
            min-height: 100px;
        }
    }
</style>

<div class="content-wrapper bg-light">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row my-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold">
                        <i class="fas fa-file-invoice mr-2"></i>
                        <?php echo lang('admission'); ?> <?php echo lang('bill'); ?> <?php echo lang('details'); ?> | <?php echo $patient->name; ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('admission'); ?> <?php echo lang('bill'); ?> <?php echo lang('details'); ?></li>
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
                            <h3 class="card-title"><?php echo lang('IPD bill detials'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <section class="col-md-9">


                                    <section class="panel-body">
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="custom-tabs-one-medicines-tab" data-toggle="pill" href="#medicines" role="tab" aria-controls="custom-tabs-one-medicines" aria-selected="true">
                                                            <?php echo lang('all_bills'); ?>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="custom-tabs-one-bill-tab" data-toggle="pill" href="#bill" role="tab" aria-controls="custom-tabs-one-bill" aria-selected="false">
                                                            <?php echo lang('invoice'); ?>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel">
                                            <div class="tab-content">


                                                <div id="medicines" class="tab-pane active">
                                                    <?php if (!empty($daily_medicine)) {
                                                    ?>
                                                        <div class="">
                                                            <div class="adv-table editable-table ">
                                                                <table class="table table-striped table-hover table-bordered medicine_table" id="editable-table1_disabled">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="twenty_class"><?php echo lang('medicine'); ?> <?php lang('name'); ?></th>
                                                                            <th class="twenty_class"><?php echo lang('date'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('invoice_no'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('sales'); ?> <?php lang('price'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('quantity'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('total'); ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="medicine_table">
                                                                        <?php foreach ($daily_medicine as $medicine) {
                                                                            if (!empty($medicine->payment_id)) { ?>
                                                                                <tr id="<?php echo $medicine->id; ?>">
                                                                                    <td class=""><?php echo $medicine->medicine_name; ?></td>
                                                                                    <td class=""><?php echo $medicine->date; ?></td>
                                                                                    <td class=""><?php echo $medicine->payment_id; ?></td>
                                                                                    <td class=""><?php echo $settings->currency . $medicine->s_price; ?></td>
                                                                                    <td class=""><?php echo $medicine->quantity; ?></td>
                                                                                    <td class=""><?php echo $settings->currency . $medicine->total; ?></td>
                                                                                </tr>

                                                                        <?php
                                                                                $medicine_total = $medicine->total;
                                                                                $medicine_total_sum[] = $medicine_total;
                                                                            }
                                                                        } ?>
                                                                        <tr>

                                                                            <td colspan="5" style="text-align:right ; font-weight: bold;">Total</td>
                                                                            <td><strong>
                                                                                    <?php echo $settings->currency; ?>
                                                                                    <?php if (!empty($medicine_total_sum)) {
                                                                                        echo array_sum($medicine_total_sum);
                                                                                    } ?>
                                                                                </strong></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                    <?php if (!empty($daily_service)) { ?>
                                                        <div class="">
                                                            <div class="adv-table editable-table ">
                                                                <table class="table table-striped table-hover table-bordered service_table" id="editable-table2_disabled">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="twenty_class"><?php echo lang('service'); ?></th>
                                                                            <th class="twenty_class"><?php echo lang('date'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('invoice_no'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('price'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('quantity'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('total'); ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="paservice_table">
                                                                        <?php
                                                                        if (!empty($daily_service)) {
                                                                            foreach ($daily_service as $service) {
                                                                                if (!empty($service->payment_id)) {
                                                                                    $service_name = $this->pservice_model->getPserviceById($service->service)->name;
                                                                        ?>
                                                                                    <tr id="<?php echo $service->date; ?>-<?php echo $service->service; ?>">
                                                                                        <td><?php echo $service_name; ?></td>
                                                                                        <td><?php echo $service->date; ?></td>
                                                                                        <td><?php echo $service->payment_id; ?></td>
                                                                                        <td><?php echo $settings->currency; ?><?php echo $service->price; ?></td>
                                                                                        <td><?php echo $service->quantity ?></td>
                                                                                        <td><?php echo $settings->currency; ?><?php echo $service->price * $service->quantity; ?></td>
                                                                                    </tr>
                                                                        <?php
                                                                                    $service_total = $service->price * $service->quantity;
                                                                                    $service_total_sum[] = $service_total;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <tr>

                                                                            <td colspan="5" style="text-align:right ; font-weight: bold;">Total</td>
                                                                            <td><strong>
                                                                                    <?php echo $settings->currency; ?>
                                                                                    <?php if (!empty($service_total_sum)) {
                                                                                        echo array_sum($service_total_sum);
                                                                                    } ?>
                                                                                </strong>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } ?>




                                                    <?php if (!empty($diagnostics_alloted)) {
                                                    ?>
                                                        <div class="">
                                                            <div class="adv-table editable-table ">
                                                                <table class="table table-striped table-hover table-bordered diagnostic_table" id="editable-table3_disabled">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="twenty_class"><?php echo lang('diagnostic_test'); ?></th>
                                                                            <th class="twenty_class"><?php echo lang('date'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('invoice_no'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('price'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('quantity'); ?></th>
                                                                            <th class="ten_class"><?php echo lang('total'); ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="diagnostic_table">
                                                                        <?php
                                                                        if (!empty($diagnostics_alloted)) {
                                                                            foreach ($diagnostics_alloted as $diagnostic_alloted) {
                                                                                if (!empty($diagnostic_alloted->payment_id)) {
                                                                                    $diagnostic_name = $this->finance_model->getPaymentCategoryById($diagnostic_alloted->payment_procedure)->category;
                                                                        ?>
                                                                                    <tr id="<?php echo $diagnostic_alloted->date; ?>-<?php echo $diagnostic_alloted->payment_procedure; ?>">
                                                                                        <td><?php echo $diagnostic_name; ?></td>
                                                                                        <td><?php echo $diagnostic_alloted->date; ?></td>
                                                                                        <td><?php echo $diagnostic_alloted->payment_id; ?></td>
                                                                                        <td><?php echo $settings->currency; ?><?php echo $diagnostic_alloted->price; ?></td>
                                                                                        <td><?php echo $diagnostic_alloted->quantity ?></td>
                                                                                        <td><?php echo $settings->currency; ?><?php echo $diagnostic_alloted->price * $diagnostic_alloted->quantity; ?></td>
                                                                                    </tr>
                                                                        <?php
                                                                                    $diagnostic_total = $diagnostic_alloted->price * $diagnostic_alloted->quantity;
                                                                                    $diagnostic_total_sum[] = $diagnostic_total;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        <tr>

                                                                            <td colspan="5" style="text-align:right ; font-weight: bold;">Total</td>
                                                                            <td><strong>
                                                                                    <?php echo $settings->currency; ?>
                                                                                    <?php if (!empty($diagnostic_total_sum)) {
                                                                                        echo array_sum($diagnostic_total_sum);
                                                                                    } ?>
                                                                                </strong></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } ?>

                                                </div>






                                                <div id="bill" class="tab-pane">
                                                    <div class="">
                                                        <div class="adv-table editable-table ">
                                                            <table class="table table-striped table-hover table-bordered diagnostic_table" id="editable-table3">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="twenty_class"><?php echo lang('invoice_id'); ?></th>
                                                                        <th class="twenty_class"><?php echo lang('type'); ?></th>
                                                                        <th class="twenty_class"><?php echo lang('date'); ?></th>
                                                                        <th class="twenty_class"><?php echo lang('total'); ?></th>
                                                                        <th class="ten_class"><?php echo lang('paid'); ?></th>
                                                                        <th class="ten_class"><?php echo lang('due'); ?></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="diagnostic_table">
                                                                    <?php
                                                                    if (!empty($all_payments)) {
                                                                        foreach ($all_payments as $key => $value) {
                                                                            $payment_details = $this->finance_model->getPaymentById($value);
                                                                    ?>
                                                                            <tr>
                                                                                <td><a href="finance/invoice?id=<?php echo $payment_details->id; ?>" target="_blank"><?php echo $payment_details->hospital_payment_id; ?></a></td>
                                                                                <td>
                                                                                    <?php
                                                                                    if ($payment_details->payment_from == 'admitted_patient_bed_medicine') {
                                                                                        echo lang('medicine');
                                                                                    } elseif ($payment_details->payment_from == 'admitted_patient_bed_service') {
                                                                                        echo lang('service');
                                                                                    } elseif ($payment_details->payment_from == 'admitted_patient_bed_diagnostic') {
                                                                                        echo lang('diagnostic');
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td><?php echo date('d-m-Y', $payment_details->date); ?></td>
                                                                                <td><?php echo $settings->currency; ?><?php echo $total = $payment_details->gross_total; ?></td>
                                                                                <td><?php echo $paid = $this->finance_model->getDepositAmountByPaymentId($payment_details->id); ?></td>
                                                                                <td><?php echo $settings->currency; ?><?php echo $total - $paid; ?></td>
                                                                            </tr>
                                                                    <?php
                                                                            $total_sum[] = $total;
                                                                            $paid_sum[] = $paid;
                                                                            $due_sum[] = $total - $paid;
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td><strong><?php echo lang('total'); ?></strong></td>
                                                                        <td><strong>
                                                                                <?php echo $settings->currency; ?>
                                                                                <?php if (!empty($total_sum)) {
                                                                                    echo array_sum($total_sum);
                                                                                } ?>
                                                                            </strong></td>
                                                                        <td><strong>
                                                                                <?php echo $settings->currency; ?>
                                                                                <?php if (!empty($paid_sum)) {
                                                                                    echo array_sum($paid_sum);
                                                                                } ?></strong></td>
                                                                        <td><strong>
                                                                                <?php echo $settings->currency; ?>
                                                                                <?php if (!empty($due_sum)) {
                                                                                    echo $due = array_sum($due_sum);
                                                                                } ?></strong></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </section>

                                </section>
                                <section class="col-md-3 no-print">
                                    <div class="card">
                                        <div class="card-header">
                                            <?php echo lang('admission'); ?> <?php echo lang('details'); ?>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('admission'); ?> <?php echo lang('id'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo !empty($allotment->id) ? $allotment->id : ''; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('admission'); ?> <?php echo lang('date'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo !empty($allotment->a_time) ? $allotment->a_time : ''; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('discharge'); ?> <?php echo lang('date'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo !empty($allotment->d_time) ? $allotment->d_time : ''; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('patient'); ?> <?php echo lang('name'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->name; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('patient_id'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->hospital_patient_id; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('gender'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->sex; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('birth_date'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->birthdate; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('phone'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->phone; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('email'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->email; ?>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?php echo lang('address'); ?>
                                                    <span class="badge badge-primary badge-pill">
                                                        <?php echo $patient->address; ?>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                            </div>
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



<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
if (!$this->ion_auth->in_group(array('admin'))) {
    $admin = 'other';
} else {
    $admin = 'admin';
}
?>



<script src="common/js/codearistos.min.js"></script>

<script src="common/extranal/toast.js"></script>
<link rel="stylesheet" type="text/css" href="common/extranal/toast.css">
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var medicine_gen_name = "<?php echo lang('medicine_gen_name'); ?>";
</script>
<script type="text/javascript">
    var select_nurse = "<?php echo lang('select_nurse'); ?>";
</script>
<script type="text/javascript">
    var delete_lang = "<?php echo lang('delete'); ?>";
</script>
<script type="text/javascript">
    var more = "<?php echo lang('more'); ?>";
</script>
<script type="text/javascript">
    var edit = "<?php echo lang('edit'); ?>";
</script>
<script type="text/javascript">
    var admin = "<?php echo $admin; ?>";
</script>
<script type="text/javascript">
    var patient_name = "<?php echo $patient->name; ?>";
</script>
<script type="text/javascript">
    var patient_id = "<?php echo $patient->id; ?>";
</script>
<script type="text/javascript">
    var doctor_name = "<?php echo $doctor->name; ?>";
</script>
<script type="text/javascript">
    var doctor_id = "<?php echo $doctor->id; ?>";
</script>
<script type="text/javascript">
    var accepting_doctor_name = "<?php echo $accepting_doctor->name; ?>";
</script>
<script type="text/javascript">
    var accepting_doctor_id = "<?php echo $accepting_doctor->id; ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/bed/edit_allotment_bed.js"></script>