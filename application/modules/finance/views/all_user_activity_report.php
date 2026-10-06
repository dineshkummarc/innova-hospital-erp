<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-money-bill-wave text-primary mr-3"></i>
                        <?php echo lang('activities_by'); ?> <strong class="activities_by"><?php echo lang('all_users'); ?></strong> (<?php echo lang('today'); ?>)
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('department'); ?></li>
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
                            <h3 class="card-title font-weight-bold"><?php echo lang('today'); ?> <?php echo lang('report'); ?></h3>
                        </div>
                        <div class="card-body bg-light p-4">
                            <table class="table table-hover datatables" id="editable-sample" width="100%">
                                <thead>
                                    <tr class="bg-light">
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('user'); ?> <?php echo lang('name'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('bill_amount'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('payment_received'); ?></th>
                                        <th class="font-weight-bold text-uppercase"><?php echo lang('due_amount'); ?></th>
                                        <th class="font-weight-bold text-uppercase no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($accountants as $accountant) { ?>
                                        <tr>
                                            <td><?php echo $accountant->name; ?></td>
                                            <td><?php echo $settings->currency; ?><?php
                                                                                    $total = array();
                                                                                    $ot_total = array();

                                                                                    $accountant_ion_user_id = $accountant->ion_user_id;
                                                                                    foreach ($payments as $payment) {
                                                                                        if ($payment->user == $accountant_ion_user_id) {
                                                                                            $total[] = $payment->gross_total;
                                                                                        }
                                                                                    }
                                                                                    foreach ($ot_payments as $ot_payment) {
                                                                                        if ($ot_payment->user == $accountant_ion_user_id) {
                                                                                            $ot_total[] = $ot_payment->gross_total;
                                                                                        }
                                                                                    }

                                                                                    $total = array_sum($total);
                                                                                    if (empty($total)) {
                                                                                        $total = 0;
                                                                                    }

                                                                                    $ot_total = array_sum($ot_total);
                                                                                    if (empty($ot_total)) {
                                                                                        $ot_total = 0;
                                                                                    }

                                                                                    echo $bill_total = $total + $ot_total;
                                                                                    ?></td>
                                            <td><?php echo $settings->currency; ?><?php
                                                                                    $deposit_total = array();
                                                                                    foreach ($deposits as $deposit) {
                                                                                        if ($deposit->user == $accountant_ion_user_id) {
                                                                                            $deposit_total[] = $deposit->deposited_amount;
                                                                                        }
                                                                                    }

                                                                                    $deposit_total = array_sum($deposit_total);
                                                                                    if (empty($deposit_total)) {
                                                                                        $deposit_total = 0;
                                                                                    }
                                                                                    echo $deposit_total;
                                                                                    ?></td>
                                            <td><?php echo $bill_total - $deposit_total; ?></td>
                                            <td class="no-print">
                                                <a class="btn btn-primary btn-sm px-4 py-2" href="finance/allUserActivityReport?user=<?php echo $accountant_ion_user_id; ?>">
                                                    <i class="fa fa-info mr-1"></i> <?php echo lang('details'); ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                    <?php foreach ($receptionists as $receptionist) { ?>
                                        <tr>
                                            <td><?php echo $receptionist->name; ?></td>
                                            <td><?php echo $settings->currency; ?><?php
                                                                                    $total_receptionist = array();
                                                                                    $ot_total_receptionist = array();

                                                                                    $receptionist_ion_user_id = $receptionist->ion_user_id;
                                                                                    foreach ($payments as $payment1) {
                                                                                        if ($payment1->user == $receptionist_ion_user_id) {
                                                                                            $total_receptionist[] = $payment1->gross_total;
                                                                                        }
                                                                                    }
                                                                                    foreach ($ot_payments as $ot_payment1) {
                                                                                        if ($ot_payment1->user == $receptionist_ion_user_id) {
                                                                                            $ot_total_receptionist[] = $ot_payment1->gross_total;
                                                                                        }
                                                                                    }

                                                                                    $total_receptionist = array_sum($total_receptionist);
                                                                                    if (empty($total_receptionist)) {
                                                                                        $total_receptionist = 0;
                                                                                    }

                                                                                    $ot_total_receptionist = array_sum($ot_total_receptionist);
                                                                                    if (empty($ot_total_receptionist)) {
                                                                                        $ot_total_receptionist = 0;
                                                                                    }

                                                                                    echo $bill_total_receptionist = $total_receptionist + $ot_total_receptionist;
                                                                                    ?></td>
                                            <td><?php echo $settings->currency; ?><?php
                                                                                    $deposit_total_receptionist = array();
                                                                                    foreach ($deposits as $deposit) {
                                                                                        if ($deposit->user == $receptionist_ion_user_id) {
                                                                                            $deposit_total_receptionist[] = $deposit->deposited_amount;
                                                                                        }
                                                                                    }

                                                                                    $deposit_total_receptionist = array_sum($deposit_total_receptionist);
                                                                                    if (empty($deposit_total_receptionist)) {
                                                                                        $deposit_total_receptionist = 0;
                                                                                    }
                                                                                    echo $deposit_total_receptionist;
                                                                                    ?></td>
                                            <td><?php echo $bill_total_receptionist - $deposit_total_receptionist; ?></td>
                                            <td class="no-print">
                                                <a class="btn btn-primary btn-sm px-4 py-2" href="finance/allUserActivityReport?user=<?php echo $receptionist_ion_user_id; ?>">
                                                    <i class="fa fa-info mr-1"></i> <?php echo lang('details'); ?>
                                                </a>
                                            </td>
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



<!--main content end-->
<!--footer start-->



<script src="common/js/codearistos.min.js"></script>

<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/finance/all_user_activity_report.js"></script>