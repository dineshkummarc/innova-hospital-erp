<!--sidebar end-->
<!--main content start-->
<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-chart-line text-primary mr-3"></i>
                        <?php echo lang('referral_dashboard'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('referral_dashboard'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="referral/addNewView" class="btn btn-primary btn-sm px-3 py-2 shadow-sm mr-2">
                        <i class="fa fa-plus-circle mr-1"></i> <?php echo lang('add_new_referrer'); ?>
                    </a>
                    <a href="referral/withdrawals" class="btn btn-success btn-sm px-3 py-2 shadow-sm">
                        <i class="fas fa-hand-holding-usd mr-1"></i> <?php echo lang('withdrawal_requests'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-4">
        <div class="container-fluid">
            <!-- 8 Key Metrics Cards -->
            <div class="row">
                <!-- Total Referrers -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow-sm h-100 py-2 border-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        <?php echo lang('total_referrers'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                                        <?php echo number_format($metrics['total_referrers']); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-primary opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Referrers -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow-sm h-100 py-2 border-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <?php echo lang('active_referrers'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                                        <?php echo number_format($metrics['active_referrers']); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user-check fa-2x text-success opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Commission -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow-sm h-100 py-2 border-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        <?php echo lang('today_commission'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $settings->currency . ' ' . number_format($metrics['today_commission'], 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-day fa-2x text-info opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- This Month's Commission -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow-sm h-100 py-2 border-0">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        <?php echo lang('month_commission'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $settings->currency . ' ' . number_format($metrics['month_commission'], 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-alt fa-2x text-warning opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Available Wallet Balance -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow-sm h-100 py-2 border-0 bg-white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        <?php echo lang('total_wallet_balance'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-success">
                                        <?php echo $settings->currency . ' ' . number_format($metrics['total_wallet_balance'], 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wallet fa-2x text-success opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Commission -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-secondary shadow-sm h-100 py-2 border-0 bg-white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                        <?php echo lang('pending_commission'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-muted">
                                        <?php echo $settings->currency . ' ' . number_format($metrics['pending_commission'], 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hourglass-half fa-2x text-secondary opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Withdrawn -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-dark shadow-sm h-100 py-2 border-0 bg-white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                        <?php echo lang('total_withdrawn'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-dark">
                                        <?php echo $settings->currency . ' ' . number_format($metrics['total_withdrawn'], 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-money-check-alt fa-2x text-dark opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Withdrawals -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow-sm h-100 py-2 border-0 bg-white">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        <?php echo lang('pending_withdrawals'); ?>
                                    </div>
                                    <div class="h4 mb-0 font-weight-bold text-danger">
                                        <?php echo $settings->currency . ' ' . number_format($metrics['pending_withdrawals'], 2); ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-danger opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Commission Activity & Withdrawals -->
            <div class="row">
                <div class="col-lg-7 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title font-weight-bold mb-0 text-dark">
                                <i class="fas fa-receipt mr-2 text-primary"></i> Recent Commission Transactions
                            </h5>
                            <a href="referral/transactions" class="btn btn-outline-primary btn-sm">View All</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Invoice</th>
                                            <th>Referrer</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recent_transactions)) {
                                            foreach (array_slice($recent_transactions, 0, 7) as $txn) { ?>
                                                <tr>
                                                    <td>
                                                        <a href="finance/invoice?id=<?php echo $txn->invoice_id; ?>" class="font-weight-bold text-primary">
                                                            #<?php echo $txn->invoice_id; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo html_escape($txn->referrer_name); ?></td>
                                                    <td class="font-weight-bold">
                                                        <?php echo $settings->currency . ' ' . number_format($txn->commission_amount, 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($txn->status == 'Earned') { ?>
                                                            <span class="badge badge-success">Earned</span>
                                                        <?php } elseif ($txn->status == 'Pending') { ?>
                                                            <span class="badge badge-warning">Pending</span>
                                                        <?php } elseif ($txn->status == 'Reversed') { ?>
                                                            <span class="badge badge-danger">Reversed</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-secondary"><?php echo $txn->status; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><small class="text-muted"><?php echo date('d-M-y H:i', $txn->created_date); ?></small></td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="5" class="text-center py-4 text-muted">No recent transactions recorded.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-4">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="card-title font-weight-bold mb-0 text-dark">
                                <i class="fas fa-hand-holding-usd mr-2 text-success"></i> Recent Withdrawals
                            </h5>
                            <a href="referral/withdrawals" class="btn btn-outline-success btn-sm">Manage</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Referrer</th>
                                            <th>Amount</th>
                                            <th>Method</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recent_withdrawals)) {
                                            foreach (array_slice($recent_withdrawals, 0, 7) as $w) { ?>
                                                <tr>
                                                    <td class="font-weight-bold"><?php echo html_escape($w->referrer_name); ?></td>
                                                    <td class="font-weight-bold text-dark">
                                                        <?php echo $settings->currency . ' ' . number_format($w->amount, 2); ?>
                                                    </td>
                                                    <td><small class="badge badge-info"><?php echo html_escape($w->payment_method); ?></small></td>
                                                    <td>
                                                        <?php if ($w->status == 'Paid') { ?>
                                                            <span class="badge badge-success">Paid</span>
                                                        <?php } elseif ($w->status == 'Pending') { ?>
                                                            <span class="badge badge-warning">Pending</span>
                                                        <?php } elseif ($w->status == 'Rejected') { ?>
                                                            <span class="badge badge-danger">Rejected</span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-primary"><?php echo $w->status; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center py-4 text-muted">No recent withdrawal requests.</td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
