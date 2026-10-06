<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exchange-alt text-info mr-3"></i>
                        <?php echo lang('movement_report'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('movement_report'); ?></li>
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
            
            <!-- Date Range Filter -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter mr-2"></i>
                                Date Range Filter
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="get" action="inventory/movement_report">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search mr-2"></i>
                                                    Filter
                                                </button>
                                                <a href="inventory/movement_report" class="btn btn-secondary">
                                                    <i class="fas fa-refresh mr-2"></i>
                                                    Reset
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Total Movements</h5>
                                    <h3 class="font-weight-bold"><?php echo count($movements); ?></h3>
                                </div>
                                <i class="fas fa-arrows-alt fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Stock In</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $stock_in = 0;
                                        foreach ($movements as $movement) {
                                            if ($movement->transaction_type == 'in' || $movement->transaction_type == 'purchase') {
                                                $stock_in++;
                                            }
                                        }
                                        echo $stock_in;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-arrow-down fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Stock Out</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $stock_out = 0;
                                        foreach ($movements as $movement) {
                                            if ($movement->transaction_type == 'out' || $movement->transaction_type == 'usage') {
                                                $stock_out++;
                                            }
                                        }
                                        echo $stock_out;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-arrow-up fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Adjustments</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $adjustments = 0;
                                        foreach ($movements as $movement) {
                                            if ($movement->transaction_type == 'adjustment') {
                                                $adjustments++;
                                            }
                                        }
                                        echo $adjustments;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-cog fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Movement Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">
                                Inventory Movement Details
                                <small class="text-muted">(<?php echo date('M j, Y', strtotime($start_date)); ?> - <?php echo date('M j, Y', strtotime($end_date)); ?>)</small>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="movementTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase">Date</th>
                                            <th class="font-weight-bold text-uppercase">Item</th>
                                            <th class="font-weight-bold text-uppercase">Type</th>
                                            <th class="font-weight-bold text-uppercase">Quantity</th>
                                            <th class="font-weight-bold text-uppercase">Unit Cost</th>
                                            <th class="font-weight-bold text-uppercase">Total Value</th>
                                            <th class="font-weight-bold text-uppercase">Reference</th>
                                            <th class="font-weight-bold text-uppercase">Notes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($movements)) { ?>
                                            <?php foreach ($movements as $movement) { ?>
                                                <?php 
                                                $type_class = '';
                                                $type_icon = '';
                                                switch ($movement->transaction_type) {
                                                    case 'in':
                                                    case 'purchase':
                                                        $type_class = 'success';
                                                        $type_icon = 'fa-arrow-down';
                                                        break;
                                                    case 'out':
                                                    case 'usage':
                                                        $type_class = 'warning';
                                                        $type_icon = 'fa-arrow-up';
                                                        break;
                                                    case 'adjustment':
                                                        $type_class = 'info';
                                                        $type_icon = 'fa-cog';
                                                        break;
                                                    default:
                                                        $type_class = 'secondary';
                                                        $type_icon = 'fa-exchange-alt';
                                                }
                                                $total_value = $movement->quantity * $movement->unit_cost;
                                                ?>
                                                <tr>
                                                    <td><?php echo date('M j, Y', strtotime($movement->transaction_date)); ?></td>
                                                    <td class="font-weight-bold">
                                                        <?php echo $movement->item_name; ?>
                                                        <small class="text-muted d-block"><?php echo $movement->item_code; ?></small>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $type_class; ?>">
                                                            <i class="fas <?php echo $type_icon; ?> mr-1"></i>
                                                            <?php echo ucfirst(str_replace('_', ' ', $movement->transaction_type)); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="font-weight-bold <?php echo ($movement->transaction_type == 'out' || $movement->transaction_type == 'usage') ? 'text-danger' : 'text-success'; ?>">
                                                            <?php echo ($movement->transaction_type == 'out' || $movement->transaction_type == 'usage') ? '-' : '+'; ?>
                                                            <?php echo $movement->quantity; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $settings->currency . ' ' . number_format($movement->unit_cost, 2); ?></td>
                                                    <td class="font-weight-bold">
                                                        <?php echo $settings->currency . ' ' . number_format($total_value, 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($movement->reference_number)) { ?>
                                                            <span class="badge badge-light"><?php echo $movement->reference_number; ?></span>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($movement->notes)) { ?>
                                                            <span class="text-truncate" style="max-width: 150px;" title="<?php echo htmlspecialchars($movement->notes); ?>">
                                                                <?php echo $movement->notes; ?>
                                                            </span>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-exchange-alt fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">No movements found for the selected period</h5>
                                                    <p class="text-muted">Try adjusting the date range or check if there are any inventory transactions.</p>
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
    $('#movementTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 0, "desc" ]], // Sort by date descending
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search movements..."
        },
        "columnDefs": [
            {
                "targets": [4, 5], // Unit cost and total value columns
                "type": "currency"
            }
        ]
    }).buttons().container().appendTo('#movementTable_wrapper .col-md-6:eq(0)');
});
</script>