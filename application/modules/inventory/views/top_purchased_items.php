<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-star text-warning mr-3"></i>
                        Top Purchased Items
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active">Top Purchased Items</li>
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
                            <form method="GET" action="inventory/purchase/top_purchased_items">
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

            <!-- Top Purchased Items -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-warning text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-star mr-2"></i>
                                Top 20 Purchased Items (<?php echo date('Y-m-d', strtotime($start_date)); ?> to <?php echo date('Y-m-d', strtotime($end_date)); ?>)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="topItemsTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">Rank</th>
                                            <th class="font-weight-bold">Item Name</th>
                                            <th class="font-weight-bold">Item Code</th>
                                            <th class="font-weight-bold">Category</th>
                                            <th class="font-weight-bold">Total Quantity</th>
                                            <th class="font-weight-bold">Total Orders</th>
                                            <th class="font-weight-bold">Total Value</th>
                                            <th class="font-weight-bold">Avg. Unit Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($items)) { ?>
                                            <?php 
                                            $rank = 1;
                                            $grand_total_quantity = 0;
                                            $grand_total_value = 0;
                                            $grand_total_orders = 0;
                                            ?>
                                            <?php foreach ($items as $item) { ?>
                                                <?php 
                                                $grand_total_quantity += $item->total_quantity;
                                                $grand_total_value += $item->total_value;
                                                $grand_total_orders += $item->total_orders;
                                                
                                                // Rank styling
                                                $rank_class = '';
                                                if ($rank == 1) $rank_class = 'text-warning';
                                                elseif ($rank == 2) $rank_class = 'text-secondary';
                                                elseif ($rank == 3) $rank_class = 'text-dark';
                                                ?>
                                                <tr>
                                                    <td>
                                                        <h5 class="mb-0 <?php echo $rank_class; ?>">
                                                            <?php if ($rank <= 3) { ?>
                                                                <i class="fas fa-medal mr-1"></i>
                                                            <?php } ?>
                                                            #<?php echo $rank; ?>
                                                        </h5>
                                                    </td>
                                                    <td class="font-weight-bold"><?php echo htmlspecialchars($item->item_name); ?></td>
                                                    <td>
                                                        <code><?php echo htmlspecialchars($item->item_code); ?></code>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo htmlspecialchars($item->category_name); ?></span>
                                                    </td>
                                                    <td class="font-weight-bold text-primary">
                                                        <?php echo number_format($item->total_quantity); ?> <?php echo $item->unit; ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success"><?php echo number_format($item->total_orders); ?></span>
                                                    </td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency; ?> <?php echo number_format($item->total_value, 2); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $settings->currency; ?> <?php echo number_format($item->avg_unit_cost, 2); ?>
                                                    </td>
                                                </tr>
                                                <?php $rank++; ?>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="8" class="text-center text-muted py-4">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <br>No purchase data found for the selected date range.
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php if (!empty($items)) { ?>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th colspan="4" class="text-right">Summary:</th>
                                                <th><?php echo number_format($grand_total_quantity); ?></th>
                                                <th><?php echo number_format($grand_total_orders); ?></th>
                                                <th class="text-success"><?php echo $settings->currency; ?> <?php echo number_format($grand_total_value, 2); ?></th>
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

            <!-- Charts Section -->
            <?php if (!empty($items) && count($items) >= 5) { ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-pie mr-2"></i>Top 5 by Quantity
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="quantityChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-bar mr-2"></i>Top 5 by Value
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="valueChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#topItemsTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "paging": false,
        "searching": false,
        "ordering": false
    }).buttons().container().appendTo('#topItemsTable_wrapper .col-md-6:eq(0)');

    <?php if (!empty($items) && count($items) >= 5) { ?>
    // Prepare data for charts
    var top5Items = <?php echo json_encode(array_slice($items, 0, 5)); ?>;
    var itemNames = top5Items.map(function(item) { return item.item_name; });
    var quantities = top5Items.map(function(item) { return parseFloat(item.total_quantity); });
    var values = top5Items.map(function(item) { return parseFloat(item.total_value); });

    // Quantity Chart
    var ctx1 = document.getElementById('quantityChart').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: itemNames,
            datasets: [{
                data: quantities,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Value Chart
    var ctx2 = document.getElementById('valueChart').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: itemNames,
            datasets: [{
                label: 'Total Value (<?php echo $settings->currency; ?>)',
                data: values,
                backgroundColor: '#28a745'
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