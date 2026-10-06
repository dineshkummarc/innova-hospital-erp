<!--sidebar end-->
<!--main content start-->
<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-file-chart-pie text-primary mr-3"></i>
                        <?php echo lang('referral_reports'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="referral"><?php echo lang('referral_management'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('referral_reports'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-4">
        <div class="container-fluid">
            <!-- Filter Bar -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-3">
                    <form action="referral/reports" method="get" class="form-row align-items-end">
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted font-weight-bold text-uppercase">Referrer</label>
                            <select class="form-control form-control-sm" name="referrer_id">
                                <option value="">All Referrers</option>
                                <?php foreach ($referrers as $r) { ?>
                                    <option value="<?php echo $r->id; ?>" <?php if (!empty($selected_referrer) && $selected_referrer == $r->id) echo 'selected'; ?>>
                                        <?php echo html_escape($r->name); ?> (<?php echo $r->type; ?>)
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted font-weight-bold text-uppercase">Doctor</label>
                            <select class="form-control form-control-sm" name="doctor_id">
                                <option value="">All Doctors</option>
                                <?php foreach ($doctors as $d) { ?>
                                    <option value="<?php echo $d->id; ?>" <?php if (!empty($selected_doctor) && $selected_doctor == $d->id) echo 'selected'; ?>>
                                        <?php echo html_escape($d->name); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted font-weight-bold text-uppercase">From Date</label>
                            <input type="date" class="form-control form-control-sm" name="date_from" value="<?php echo !empty($date_from) ? $date_from : ''; ?>">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted font-weight-bold text-uppercase">To Date</label>
                            <input type="date" class="form-control form-control-sm" name="date_to" value="<?php echo !empty($date_to) ? $date_to : ''; ?>">
                        </div>
                        <div class="col-md-2 mb-2">
                            <button type="submit" class="btn btn-primary btn-sm px-3 mr-2">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                            <a href="referral/reports" class="btn btn-secondary btn-sm px-3">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Totals -->
            <?php 
            $tot_item_price = 0;
            $tot_comm = 0;
            $tot_earned = 0;
            if (!empty($report_data)) {
                foreach ($report_data as $row) {
                    $tot_item_price += floatval($row->item_price);
                    $tot_comm += floatval($row->commission_amount);
                    $tot_earned += floatval($row->earned_amount);
                }
            }
            ?>
            <div class="row mb-4">
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm border-0 bg-white p-3 text-center border-left-primary">
                        <div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Total Commission Base</div>
                        <div class="h4 mb-0 font-weight-bold text-dark">
                            <?php echo $settings->currency . ' ' . number_format($tot_item_price, 2); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm border-0 bg-white p-3 text-center border-left-warning">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Commission Generated</div>
                        <div class="h4 mb-0 font-weight-bold text-dark">
                            <?php echo $settings->currency . ' ' . number_format($tot_comm, 2); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card shadow-sm border-0 bg-white p-3 text-center border-left-success">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Commission Earned (Paid)</div>
                        <div class="h4 mb-0 font-weight-bold text-success">
                            <?php echo $settings->currency . ' ' . number_format($tot_earned, 2); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Table -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold mb-0 text-dark">
                        <i class="fas fa-table mr-2 text-primary"></i> Detailed Referral Commission Breakdown
                    </h3>
                </div>

                <div class="card-body bg-light p-4">
                    <div class="table-responsive">
                        <table class="table table-hover datatables" id="editable-sample" width="100%">
                            <thead>
                                <tr class="bg-light text-uppercase">
                                    <th>Invoice</th>
                                    <th>Patient</th>
                                    <th>Test / Service</th>
                                    <th>Referrer</th>
                                    <th>Doctor</th>
                                    <th>Commission Base</th>
                                    <th>Referral %</th>
                                    <th>Commission</th>
                                    <th>Earned</th>
                                    <th>Payment Status</th>
                                    <th>Commission Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($report_data)) {
                                    foreach ($report_data as $row) { 
                                        $c_rate = isset($row->referral_commission_rate) ? $row->referral_commission_rate : (isset($row->commission_rate) ? $row->commission_rate : 0);
                                        $c_amount = isset($row->referral_commission_amount) ? $row->referral_commission_amount : (isset($row->commission_amount) ? $row->commission_amount : 0);
                                        $earned = isset($row->earned_amount) ? $row->earned_amount : 0;
                                        $c_status = isset($row->commission_status) ? $row->commission_status : (isset($row->status) ? $row->status : 'Pending');
                                        $p_status = isset($row->payment_status) ? $row->payment_status : 'unpaid';
                                        $date_val = isset($row->invoice_date) ? $row->invoice_date : (isset($row->created_date) ? $row->created_date : time());
                                    ?>
                                        <tr>
                                            <td>
                                                <a href="finance/invoice?id=<?php echo $row->invoice_id; ?>" class="font-weight-bold text-primary">
                                                    #<?php echo $row->invoice_id; ?>
                                                </a>
                                            </td>
                                            <td><?php echo !empty($row->patient_name) ? html_escape($row->patient_name) : '-'; ?></td>
                                            <td class="font-weight-bold"><?php echo !empty($row->item_name) ? html_escape($row->item_name) : '-'; ?></td>
                                            <td class="font-weight-bold"><?php echo html_escape($row->referrer_name); ?></td>
                                            <td><?php echo !empty($row->doctor_name) ? html_escape($row->doctor_name) : '-'; ?></td>
                                            <td><?php echo $settings->currency . ' ' . number_format($row->item_price, 2); ?></td>
                                            <td><span class="badge badge-light border"><?php echo floatval($c_rate); ?>%</span></td>
                                            <td class="font-weight-bold text-dark">
                                                <?php echo $settings->currency . ' ' . number_format($c_amount, 2); ?>
                                            </td>
                                            <td class="font-weight-bold text-success">
                                                <?php echo $settings->currency . ' ' . number_format($earned, 2); ?>
                                            </td>
                                            <td>
                                                <span class="badge badge-<?php echo ($p_status == 'paid') ? 'success' : (($p_status == 'partially_paid') ? 'info' : 'warning'); ?> px-2 py-1">
                                                    <?php echo ucfirst(str_replace('_', ' ', $p_status)); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php if ($c_status == 'Earned') { ?>
                                                    <span class="badge badge-success px-2 py-1">Earned</span>
                                                <?php } elseif ($c_status == 'Pending') { ?>
                                                    <span class="badge badge-warning px-2 py-1">Pending</span>
                                                <?php } elseif ($c_status == 'Reversed') { ?>
                                                    <span class="badge badge-danger px-2 py-1">Reversed</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-secondary px-2 py-1"><?php echo html_escape($c_status); ?></span>
                                                <?php } ?>
                                            </td>
                                            <td><small class="text-muted"><?php echo date('d-M-Y H:i', is_numeric($date_val) ? $date_val : strtotime($date_val)); ?></small></td>
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#editable-sample').DataTable({
            responsive: true,
            order: [[0, "desc"]],
            dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'],
            pageLength: 50
        });
    });
</script>
