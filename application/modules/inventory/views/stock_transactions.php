<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-list text-primary mr-3"></i>
                        <?php echo lang('stock_transactions'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('stock_transactions'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/reports" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Reports
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Total Transactions</h5>
                                    <h3 class="font-weight-bold"><?php echo count($transactions); ?></h3>
                                </div>
                                <i class="fas fa-list fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">This Week</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $this_week = 0;
                                        $week_start = date('Y-m-d', strtotime('monday this week'));
                                        foreach ($transactions as $transaction) {
                                            if ($transaction->transaction_date >= $week_start) {
                                                $this_week++;
                                            }
                                        }
                                        echo $this_week;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-calendar-week fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Today</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $today = 0;
                                        $today_date = date('Y-m-d');
                                        foreach ($transactions as $transaction) {
                                            if (date('Y-m-d', strtotime($transaction->transaction_date)) == $today_date) {
                                                $today++;
                                            }
                                        }
                                        echo $today;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-calendar-day fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Transactions Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">All Stock Transactions</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="transactionsTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase">Date & Time</th>
                                            <th class="font-weight-bold text-uppercase">Item</th>
                                            <th class="font-weight-bold text-uppercase">Type</th>
                                            <th class="font-weight-bold text-uppercase">Quantity</th>
                                            <th class="font-weight-bold text-uppercase">Unit Cost</th>
                                            <th class="font-weight-bold text-uppercase">Total Value</th>
                                            <th class="font-weight-bold text-uppercase">Performed By</th>
                                            <th class="font-weight-bold text-uppercase">Reference</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($transactions)) { ?>
                                            <?php foreach ($transactions as $transaction) { ?>
                                                <?php 
                                                $type_class = '';
                                                $type_icon = '';
                                                switch ($transaction->transaction_type) {
                                                    case 'in':
                                                    case 'purchase':
                                                        $type_class = 'success';
                                                        $type_icon = 'fa-plus';
                                                        break;
                                                    case 'out':
                                                    case 'usage':
                                                        $type_class = 'danger';
                                                        $type_icon = 'fa-minus';
                                                        break;
                                                    case 'adjustment':
                                                        $type_class = 'info';
                                                        $type_icon = 'fa-cog';
                                                        break;
                                                    case 'transfer':
                                                        $type_class = 'warning';
                                                        $type_icon = 'fa-exchange-alt';
                                                        break;
                                                    default:
                                                        $type_class = 'secondary';
                                                        $type_icon = 'fa-question';
                                                }
                                                $total_value = $transaction->quantity * $transaction->unit_cost;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="font-weight-bold"><?php echo date('M j, Y', strtotime($transaction->transaction_date)); ?></span>
                                                        <small class="text-muted d-block"><?php echo date('h:i A', strtotime($transaction->created_at)); ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="font-weight-bold"><?php echo $transaction->item_name; ?></span>
                                                        <small class="text-muted d-block"><?php echo $transaction->item_code; ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $type_class; ?>">
                                                            <i class="fas <?php echo $type_icon; ?> mr-1"></i>
                                                            <?php echo ucfirst(str_replace('_', ' ', $transaction->transaction_type)); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="font-weight-bold <?php echo ($transaction->transaction_type == 'out' || $transaction->transaction_type == 'usage') ? 'text-danger' : 'text-success'; ?>">
                                                            <?php echo ($transaction->transaction_type == 'out' || $transaction->transaction_type == 'usage') ? '-' : '+'; ?>
                                                            <?php echo $transaction->quantity; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $settings->currency . ' ' . number_format($transaction->unit_cost, 2); ?></td>
                                                    <td class="font-weight-bold">
                                                        <?php echo $settings->currency . ' ' . number_format($total_value, 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($transaction->performed_by_name)) { ?>
                                                            <span class="badge badge-light"><?php echo $transaction->performed_by_name; ?></span>
                                                        <?php } else { ?>
                                                            <span class="text-muted">System</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($transaction->reference_number)) { ?>
                                                            <span class="badge badge-outline-primary"><?php echo $transaction->reference_number; ?></span>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">No stock transactions found</h5>
                                                    <p class="text-muted">Start by adding inventory items or recording stock movements.</p>
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
        </div>
    </section>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    $('#transactionsTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 0, "desc" ]], // Sort by date descending
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search transactions..."
        },
        "columnDefs": [
            {
                "targets": [4, 5], // Unit cost and total value columns
                "type": "currency"
            }
        ]
    }).buttons().container().appendTo('#transactionsTable_wrapper .col-md-6:eq(0)');
});
</script>