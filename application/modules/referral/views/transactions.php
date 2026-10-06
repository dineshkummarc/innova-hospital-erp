<!--sidebar end-->
<!--main content start-->
<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-file-invoice text-primary mr-3"></i>
                        <?php echo lang('referral_transactions'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="referral"><?php echo lang('referral_management'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('referral_transactions'); ?></li>
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
                    <form action="referral/transactions" method="get" class="form-row align-items-end">
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
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted font-weight-bold text-uppercase">Status</label>
                            <select class="form-control form-control-sm" name="status">
                                <option value="">All Statuses</option>
                                <option value="Pending" <?php if (!empty($selected_status) && $selected_status == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Earned" <?php if (!empty($selected_status) && $selected_status == 'Earned') echo 'selected'; ?>>Earned</option>
                                <option value="Reversed" <?php if (!empty($selected_status) && $selected_status == 'Reversed') echo 'selected'; ?>>Reversed</option>
                                <option value="Cancelled" <?php if (!empty($selected_status) && $selected_status == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
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
                        <div class="col-md-3 mb-2">
                            <button type="submit" class="btn btn-primary btn-sm px-3 mr-2">
                                <i class="fas fa-filter mr-1"></i> Filter
                            </button>
                            <a href="referral/transactions" class="btn btn-secondary btn-sm px-3">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold mb-0 text-dark">
                        <i class="fas fa-list mr-2 text-primary"></i> Commission Ledger Records
                    </h3>
                </div>

                <div class="card-body bg-light p-4">
                    <div class="table-responsive">
                        <table class="table table-hover datatables" id="editable-sample" width="100%">
                            <thead>
                                <tr class="bg-light text-uppercase">
                                    <th>Txn ID</th>
                                    <th>Invoice</th>
                                    <th>Referrer</th>
                                    <th>Patient</th>
                                    <th>Test / Service</th>
                                    <th>Commission Base</th>
                                    <th>Rate</th>
                                    <th>Commission</th>
                                    <th>Earned</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transactions)) {
                                    foreach ($transactions as $txn) { ?>
                                        <tr>
                                            <td><small class="font-weight-bold"><?php echo html_escape($txn->transaction_id); ?></small></td>
                                            <td>
                                                <a href="finance/invoice?id=<?php echo $txn->invoice_id; ?>" class="font-weight-bold text-primary">
                                                    #<?php echo $txn->invoice_id; ?>
                                                </a>
                                            </td>
                                            <td class="font-weight-bold"><?php echo html_escape($txn->referrer_name); ?></td>
                                            <td><?php echo !empty($txn->patient_name) ? html_escape($txn->patient_name) : '-'; ?></td>
                                            <td><?php echo !empty($txn->item_name) ? html_escape($txn->item_name) : '-'; ?></td>
                                            <td><?php echo $settings->currency . ' ' . number_format($txn->item_price, 2); ?></td>
                                            <td><span class="badge badge-light border"><?php echo floatval($txn->commission_rate); ?>%</span></td>
                                            <td class="font-weight-bold text-dark">
                                                <?php echo $settings->currency . ' ' . number_format($txn->commission_amount, 2); ?>
                                            </td>
                                            <td class="font-weight-bold text-success">
                                                <?php echo $settings->currency . ' ' . number_format($txn->earned_amount, 2); ?>
                                            </td>
                                            <td>
                                                <?php if ($txn->status == 'Earned') { ?>
                                                    <span class="badge badge-success px-2 py-1">Earned</span>
                                                <?php } elseif ($txn->status == 'Pending') { ?>
                                                    <span class="badge badge-warning px-2 py-1">Pending</span>
                                                <?php } elseif ($txn->status == 'Reversed') { ?>
                                                    <span class="badge badge-danger px-2 py-1">Reversed</span>
                                                <?php } else { ?>
                                                    <span class="badge badge-secondary px-2 py-1"><?php echo $txn->status; ?></span>
                                                <?php } ?>
                                            </td>
                                            <td><small class="text-muted"><?php echo date('d-M-Y H:i', $txn->created_date); ?></small></td>
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
            pageLength: 25
        });
    });
</script>
