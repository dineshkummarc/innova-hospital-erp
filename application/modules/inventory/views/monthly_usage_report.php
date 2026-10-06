<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar text-success mr-3"></i>
                        <?php echo lang('monthly_usage_report'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('monthly_usage_report'); ?></li>
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
            
            <!-- Month/Year Filter -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter mr-2"></i>
                                Select Month & Year
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="get" action="inventory/usage/monthly_report">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Month</label>
                                            <select class="form-control" name="month">
                                                <?php for($m = 1; $m <= 12; $m++) { ?>
                                                    <option value="<?php echo $m; ?>" <?php echo ($m == $month) ? 'selected' : ''; ?>>
                                                        <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Year</label>
                                            <select class="form-control" name="year">
                                                <?php for($y = date('Y') - 2; $y <= date('Y') + 1; $y++) { ?>
                                                    <option value="<?php echo $y; ?>" <?php echo ($y == $year) ? 'selected' : ''; ?>>
                                                        <?php echo $y; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search mr-2"></i>
                                                    Generate Report
                                                </button>
                                                <a href="inventory/usage/monthly_report" class="btn btn-secondary">
                                                    <i class="fas fa-calendar mr-2"></i>
                                                    Current Month
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div>
                                                <a href="javascript:window.print()" class="btn btn-success">
                                                    <i class="fas fa-print mr-2"></i>
                                                    Print Report
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
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Items Used</h5>
                                    <h3 class="font-weight-bold">
                                        <?php echo isset($usage_data) ? count($usage_data) : 0; ?>
                                    </h3>
                                </div>
                                <i class="fas fa-boxes fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Total Usage Cost</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $total_cost = 0;
                                        if (isset($usage_data) && !empty($usage_data)) {
                                            foreach ($usage_data as $usage) {
                                                $total_cost += ($usage->quantity_used * $usage->unit_cost);
                                            }
                                        }
                                        echo $settings->currency . ' ' . number_format($total_cost, 2);
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-dollar-sign fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Avg Daily Cost</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
                                        $avg_daily_cost = $days_in_month > 0 ? $total_cost / $days_in_month : 0;
                                        echo $settings->currency . ' ' . number_format($avg_daily_cost, 2);
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-calendar-day fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Report Period</h5>
                                    <h3 class="font-weight-bold">
                                        <?php echo date('M', mktime(0, 0, 0, $month, 1)); ?>
                                    </h3>
                                    <small><?php echo $year; ?></small>
                                </div>
                                <i class="fas fa-calendar fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Usage Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">
                                Monthly Usage Report - <?php echo date('F Y', mktime(0, 0, 0, $month, 1, $year)); ?>
                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="monthlyUsageTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase">Item</th>
                                            <th class="font-weight-bold text-uppercase">Category</th>
                                            <th class="font-weight-bold text-uppercase">Total Quantity Used</th>
                                            <th class="font-weight-bold text-uppercase">Unit Cost</th>
                                            <th class="font-weight-bold text-uppercase">Total Cost</th>
                                            <th class="font-weight-bold text-uppercase">Usage Days</th>
                                            <th class="font-weight-bold text-uppercase">Avg Daily Usage</th>
                                            <th class="font-weight-bold text-uppercase">Primary Department</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($usage_data) && !empty($usage_data)) { ?>
                                            <?php foreach ($usage_data as $usage) { ?>
                                                <?php 
                                                $item_total_cost = $usage->quantity_used * $usage->unit_cost;
                                                $avg_daily_usage = $usage->usage_days > 0 ? $usage->quantity_used / $usage->usage_days : 0;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="font-weight-bold"><?php echo $usage->item_name; ?></span>
                                                        <small class="text-muted d-block"><?php echo $usage->item_code; ?></small>
                                                    </td>
                                                    <td><?php echo $usage->category_name ?: 'Uncategorized'; ?></td>
                                                    <td>
                                                        <span class="badge badge-primary">
                                                            <?php echo $usage->quantity_used; ?> <?php echo $usage->unit; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $settings->currency . ' ' . number_format($usage->unit_cost, 2); ?></td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency . ' ' . number_format($item_total_cost, 2); ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            <?php echo $usage->usage_days; ?> days
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">
                                                            <?php echo number_format($avg_daily_usage, 2); ?> <?php echo $usage->unit; ?>/day
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($usage->primary_department)) { ?>
                                                            <span class="badge badge-light"><?php echo $usage->primary_department; ?></span>
                                                        <?php } else { ?>
                                                            <span class="text-muted">-</span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            <!-- Total Row -->
                                            <tr class="bg-light font-weight-bold">
                                                <td colspan="4" class="text-right">TOTAL:</td>
                                                <td class="text-success font-weight-bold">
                                                    <?php echo $settings->currency . ' ' . number_format($total_cost, 2); ?>
                                                </td>
                                                <td colspan="3">
                                                    <span class="badge badge-dark">
                                                        Average Daily: <?php echo $settings->currency . ' ' . number_format($avg_daily_cost, 2); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">No usage data found for <?php echo date('F Y', mktime(0, 0, 0, $month, 1, $year)); ?></h5>
                                                    <p class="text-muted">Try selecting a different month/year or check if there were any usage records during this period.</p>
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

            <!-- Monthly Trends Chart -->
            <?php if (isset($usage_data) && !empty($usage_data)) { ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Usage Distribution by Department</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="departmentChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Top 10 Most Used Items</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="topItemsChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</div>

<!-- JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $('#monthlyUsageTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 4, "desc" ]], // Sort by total cost descending
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search items..."
        },
        "columnDefs": [
            {
                "targets": [3, 4], // Unit cost and total cost columns
                "type": "currency"
            }
        ]
    }).buttons().container().appendTo('#monthlyUsageTable_wrapper .col-md-6:eq(0)');

    // Charts (if data exists)
    <?php if (isset($usage_data) && !empty($usage_data)) { ?>
    // Group data by department
    var departmentData = {};
    <?php foreach ($usage_data as $usage) { 
        $dept = !empty($usage->primary_department) ? $usage->primary_department : 'Other';
        echo "if (!departmentData['$dept']) departmentData['$dept'] = 0;\n";
        echo "departmentData['$dept'] += " . ($usage->quantity_used * $usage->unit_cost) . ";\n";
    } ?>

    const deptCtx = document.getElementById('departmentChart').getContext('2d');
    const deptChart = new Chart(deptCtx, {
        type: 'pie',
        data: {
            labels: Object.keys(departmentData),
            datasets: [{
                data: Object.values(departmentData),
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6c757d',
                    '#17a2b8', '#fd7e14', '#e83e8c', '#6f42c1', '#20c997'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': <?php echo $settings->currency; ?>' + context.parsed.toFixed(2);
                        }
                    }
                }
            }
        }
    });

    // Top Items Chart
    const itemCtx = document.getElementById('topItemsChart').getContext('2d');
    const itemChart = new Chart(itemCtx, {
        type: 'horizontalBar',
        data: {
            labels: [
                <?php 
                $sorted_usage = $usage_data;
                usort($sorted_usage, function($a, $b) {
                    return ($b->quantity_used * $b->unit_cost) <=> ($a->quantity_used * $a->unit_cost);
                });
                foreach (array_slice($sorted_usage, 0, 10) as $usage) { 
                    echo "'" . addslashes($usage->item_name) . "',";
                } ?>
            ],
            datasets: [{
                label: 'Cost (<?php echo $settings->currency; ?>)',
                data: [
                    <?php foreach (array_slice($sorted_usage, 0, 10) as $usage) { 
                        echo ($usage->quantity_used * $usage->unit_cost) . ",";
                    } ?>
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.8)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
    <?php } ?>
});
</script>