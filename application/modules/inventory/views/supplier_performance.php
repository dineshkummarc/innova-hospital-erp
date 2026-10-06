<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-chart-bar text-warning mr-3"></i>
                        Supplier Performance Report
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active">Supplier Performance</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/reports" class="btn btn-secondary btn-sm px-4">
                        <i class="fa fa-arrow-left"></i> Back to Reports
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
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-warning text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter mr-2"></i>Date Range Filter
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="inventory/supplier/performance_report">
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
                                            <button type="submit" class="btn btn-warning btn-block">
                                                <i class="fas fa-search mr-2"></i>Filter Report
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Supplier Performance Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-warning text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-building mr-2"></i>
                                Supplier Performance (<?php echo date('Y-m-d', strtotime($start_date)); ?> to <?php echo date('Y-m-d', strtotime($end_date)); ?>)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="supplierPerformanceTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">Supplier Name</th>
                                            <th class="font-weight-bold">Company</th>
                                            <th class="font-weight-bold">Total Orders</th>
                                            <th class="font-weight-bold">Total Amount</th>
                                            <th class="font-weight-bold">Average Order Value</th>
                                            <th class="font-weight-bold">Performance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($suppliers)) { ?>
                                            <?php 
                                            $grand_total = 0;
                                            $total_orders_count = 0;
                                            ?>
                                            <?php foreach ($suppliers as $supplier) { ?>
                                                <?php 
                                                $grand_total += $supplier->total_amount;
                                                $total_orders_count += $supplier->total_orders;
                                                
                                                // Performance rating based on order volume
                                                $performance_class = 'secondary';
                                                $performance_text = 'Low';
                                                if ($supplier->total_amount > 10000) {
                                                    $performance_class = 'success';
                                                    $performance_text = 'Excellent';
                                                } elseif ($supplier->total_amount > 5000) {
                                                    $performance_class = 'info';
                                                    $performance_text = 'Good';
                                                } elseif ($supplier->total_amount > 1000) {
                                                    $performance_class = 'warning';
                                                    $performance_text = 'Average';
                                                }
                                                ?>
                                                <tr>
                                                    <td class="font-weight-bold"><?php echo htmlspecialchars($supplier->supplier_name); ?></td>
                                                    <td><?php echo htmlspecialchars($supplier->company_name ?: '-'); ?></td>
                                                    <td>
                                                        <span class="badge badge-primary"><?php echo number_format($supplier->total_orders); ?></span>
                                                    </td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency; ?> <?php echo number_format($supplier->total_amount, 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $settings->currency; ?> <?php echo number_format($supplier->average_order_value, 2); ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $performance_class; ?>">
                                                            <?php echo $performance_text; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <br>No supplier data found for the selected date range.
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php if (!empty($suppliers)) { ?>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th colspan="2" class="text-right">Summary:</th>
                                                <th><?php echo number_format($total_orders_count); ?> Orders</th>
                                                <th class="text-success"><?php echo $settings->currency; ?> <?php echo number_format($grand_total, 2); ?></th>
                                                <th><?php echo $settings->currency; ?> <?php echo number_format($grand_total / max($total_orders_count, 1), 2); ?></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#supplierPerformanceTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 3, "desc" ]] // Sort by total amount
    }).buttons().container().appendChild('#supplierPerformanceTable_wrapper .col-md-6:eq(0)');
});
</script>