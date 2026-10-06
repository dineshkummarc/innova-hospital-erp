<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-chart-pie text-warning mr-3"></i>
                        <?php echo lang('usage_cost_analysis'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('usage_cost_analysis'); ?></li>
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
                            <form method="get" action="inventory/usage/cost_analysis">
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
                                                    Analyze
                                                </button>
                                                <a href="inventory/usage/cost_analysis" class="btn btn-secondary">
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
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Total Usage Cost</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $total_cost = 0;
                                        if (isset($usage_analysis) && !empty($usage_analysis)) {
                                            foreach ($usage_analysis as $analysis) {
                                                $total_cost += $analysis->total_cost;
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
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Items Used</h5>
                                    <h3 class="font-weight-bold">
                                        <?php echo isset($usage_analysis) ? count($usage_analysis) : 0; ?>
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
                                    <h5 class="card-title mb-0">Avg Daily Cost</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $days = (strtotime($end_date) - strtotime($start_date)) / (60*60*24) + 1;
                                        $avg_daily = $days > 0 ? $total_cost / $days : 0;
                                        echo $settings->currency . ' ' . number_format($avg_daily, 2);
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-calendar-day fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Top Item Cost</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $top_cost = 0;
                                        if (isset($usage_analysis) && !empty($usage_analysis)) {
                                            $costs = array_column($usage_analysis, 'total_cost');
                                            $top_cost = !empty($costs) ? max($costs) : 0;
                                        }
                                        echo $settings->currency . ' ' . number_format($top_cost, 2);
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-star fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Analysis Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">
                                Usage Cost Analysis
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
                                <table class="table table-hover" id="costAnalysisTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase">Item</th>
                                            <th class="font-weight-bold text-uppercase">Category</th>
                                            <th class="font-weight-bold text-uppercase">Total Quantity Used</th>
                                            <th class="font-weight-bold text-uppercase">Unit Cost</th>
                                            <th class="font-weight-bold text-uppercase">Total Cost</th>
                                            <th class="font-weight-bold text-uppercase">% of Total</th>
                                            <th class="font-weight-bold text-uppercase">Usage Frequency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($usage_analysis) && !empty($usage_analysis)) { ?>
                                            <?php foreach ($usage_analysis as $analysis) { ?>
                                                <?php 
                                                $percentage = $total_cost > 0 ? ($analysis->total_cost / $total_cost) * 100 : 0;
                                                $frequency_class = '';
                                                if ($analysis->usage_count >= 20) {
                                                    $frequency_class = 'success';
                                                } elseif ($analysis->usage_count >= 10) {
                                                    $frequency_class = 'warning';
                                                } else {
                                                    $frequency_class = 'secondary';
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="font-weight-bold"><?php echo $analysis->item_name; ?></span>
                                                        <small class="text-muted d-block"><?php echo $analysis->item_code; ?></small>
                                                    </td>
                                                    <td><?php echo $analysis->category_name ?: 'Uncategorized'; ?></td>
                                                    <td>
                                                        <span class="badge badge-info">
                                                            <?php echo $analysis->total_quantity_used; ?> <?php echo $analysis->unit; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $settings->currency . ' ' . number_format($analysis->unit_cost, 2); ?></td>
                                                    <td class="font-weight-bold text-primary">
                                                        <?php echo $settings->currency . ' ' . number_format($analysis->total_cost, 2); ?>
                                                    </td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar bg-primary" role="progressbar" 
                                                                 style="width: <?php echo number_format($percentage, 1); ?>%" 
                                                                 aria-valuenow="<?php echo $percentage; ?>" 
                                                                 aria-valuemin="0" 
                                                                 aria-valuemax="100">
                                                                <?php echo number_format($percentage, 1); ?>%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $frequency_class; ?>">
                                                            <?php echo $analysis->usage_count; ?> times
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">No usage data found for the selected period</h5>
                                                    <p class="text-muted">Try adjusting the date range or check if there are any usage records.</p>
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

            <!-- Cost Distribution Chart -->
            <?php if (isset($usage_analysis) && !empty($usage_analysis)) { ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Cost Distribution by Item</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="costDistributionChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Usage Frequency</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="usageFrequencyChart" style="height: 300px;"></canvas>
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
    $('#costAnalysisTable').DataTable({
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
    }).buttons().container().appendTo('#costAnalysisTable_wrapper .col-md-6:eq(0)');

    // Charts
    <?php if (isset($usage_analysis) && !empty($usage_analysis)) { ?>
    // Cost Distribution Pie Chart
    const costCtx = document.getElementById('costDistributionChart').getContext('2d');
    const costChart = new Chart(costCtx, {
        type: 'pie',
        data: {
            labels: [
                <?php foreach ($usage_analysis as $index => $analysis) { 
                    if ($index < 10) { // Show top 10 items
                        echo "'" . addslashes($analysis->item_name) . "',";
                    }
                } ?>
            ],
            datasets: [{
                data: [
                    <?php foreach ($usage_analysis as $index => $analysis) { 
                        if ($index < 10) {
                            echo $analysis->total_cost . ",";
                        }
                    } ?>
                ],
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
                }
            }
        }
    });

    // Usage Frequency Bar Chart
    const freqCtx = document.getElementById('usageFrequencyChart').getContext('2d');
    const freqChart = new Chart(freqCtx, {
        type: 'bar',
        data: {
            labels: [
                <?php foreach ($usage_analysis as $index => $analysis) { 
                    if ($index < 10) {
                        echo "'" . addslashes($analysis->item_name) . "',";
                    }
                } ?>
            ],
            datasets: [{
                label: 'Usage Count',
                data: [
                    <?php foreach ($usage_analysis as $index => $analysis) { 
                        if ($index < 10) {
                            echo $analysis->usage_count . ",";
                        }
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
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    <?php } ?>
});
</script>