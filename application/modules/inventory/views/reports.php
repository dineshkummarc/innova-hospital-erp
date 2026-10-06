<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-chart-bar text-primary mr-3"></i>
                        <?php echo lang('inventory_reports') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('reports'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <!-- Inventory Reports -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-boxes mr-2"></i>
                                <?php echo lang('inventory_reports'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a href="inventory/valuation_report" class="list-group-item list-group-item-action">
                                    <i class="fas fa-dollar-sign mr-2"></i>
                                    <?php echo lang('inventory_valuation'); ?>
                                </a>
                                <a href="inventory/movement_report" class="list-group-item list-group-item-action">
                                    <i class="fas fa-exchange-alt mr-2"></i>
                                    <?php echo lang('movement_report'); ?>
                                </a>
                                <a href="inventory/stock_transactions" class="list-group-item list-group-item-action">
                                    <i class="fas fa-list mr-2"></i>
                                    <?php echo lang('stock_transactions'); ?>
                                </a>
                                <a href="inventory/low_stock" class="list-group-item list-group-item-action">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <?php echo lang('low_stock_items'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Usage Reports -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                <?php echo lang('usage_report'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a href="inventory/usage/daily_report" class="list-group-item list-group-item-action">
                                    <i class="fas fa-calendar-day mr-2"></i>
                                    <?php echo lang('daily_usage_report'); ?>
                                </a>
                                <a href="inventory/usage/monthly_report" class="list-group-item list-group-item-action">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <?php echo lang('monthly_usage_report'); ?>
                                </a>
                                <a href="inventory/usage/cost_analysis" class="list-group-item list-group-item-action">
                                    <i class="fas fa-chart-pie mr-2"></i>
                                    <?php echo lang('usage_cost_analysis'); ?>
                                </a>
                                <a href="inventory/usage" class="list-group-item list-group-item-action">
                                    <i class="fas fa-history mr-2"></i>
                                    <?php echo lang('all') . ' ' . lang('usage_logs'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchase Reports -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                <?php echo lang('purchase_report'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a href="inventory/purchase/purchase_report" class="list-group-item list-group-item-action">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    <?php echo lang('purchase_report'); ?>
                                </a>
                                <a href="inventory/purchase/top_purchased_items" class="list-group-item list-group-item-action">
                                    <i class="fas fa-star mr-2"></i>
                                    <?php echo lang('top_purchased_items'); ?>
                                </a>
                                <a href="inventory/purchase/pending_deliveries" class="list-group-item list-group-item-action">
                                    <i class="fas fa-truck mr-2"></i>
                                    <?php echo lang('pending_deliveries'); ?>
                                </a>
                                <a href="inventory/purchase" class="list-group-item list-group-item-action">
                                    <i class="fas fa-list mr-2"></i>
                                    <?php echo lang('all') . ' ' . lang('purchase_orders'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Supplier Reports -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-warning text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-building mr-2"></i>
                                <?php echo lang('supplier_performance'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <a href="inventory/supplier/performance_report" class="list-group-item list-group-item-action">
                                    <i class="fas fa-chart-bar mr-2"></i>
                                    <?php echo lang('supplier_performance'); ?>
                                </a>
                                <a href="inventory/supplier/outstanding_balances" class="list-group-item list-group-item-action">
                                    <i class="fas fa-money-bill mr-2"></i>
                                    <?php echo lang('outstanding_balances'); ?>
                                </a>
                                <a href="inventory/supplier/contacts" class="list-group-item list-group-item-action">
                                    <i class="fas fa-address-book mr-2"></i>
                                    <?php echo lang('supplier_contacts'); ?>
                                </a>
                                <a href="inventory/supplier" class="list-group-item list-group-item-action">
                                    <i class="fas fa-list mr-2"></i>
                                    <?php echo lang('all') . ' ' . lang('suppliers'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Analytics -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Quick Analytics
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                <div class="list-group-item">
                                    <strong>Total Items:</strong>
                                    <span class="float-right badge badge-primary"><?php echo number_format($total_items); ?></span>
                                </div>
                                <div class="list-group-item">
                                    <strong>Low Stock Items:</strong>
                                    <span class="float-right badge badge-warning"><?php echo number_format($low_stock_items); ?></span>
                                </div>
                                <div class="list-group-item">
                                    <strong>Total Value:</strong>
                                    <span class="float-right badge badge-success"><?php echo $settings->currency; ?> <?php echo number_format($total_value, 2); ?></span>
                                </div>
                                <div class="list-group-item">
                                    <strong>Monthly Usage:</strong>
                                    <span class="float-right badge badge-info"><?php echo $settings->currency; ?> <?php echo number_format($monthly_usage_value, 2); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Export Options -->
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-download mr-2"></i>
                                Export Options
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button class="btn btn-outline-primary btn-block" onclick="exportData('inventory')">
                                    <i class="fas fa-file-excel mr-2"></i>
                                    Export Inventory Items
                                </button>
                                <button class="btn btn-outline-success btn-block" onclick="exportData('usage')">
                                    <i class="fas fa-file-csv mr-2"></i>
                                    Export Usage Data
                                </button>
                                <button class="btn btn-outline-info btn-block" onclick="exportData('purchases')">
                                    <i class="fas fa-file-pdf mr-2"></i>
                                    Export Purchase Orders
                                </button>
                                <button class="btn btn-outline-warning btn-block" onclick="exportData('suppliers')">
                                    <i class="fas fa-file-alt mr-2"></i>
                                    Export Supplier List
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Custom Report Generator -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cogs mr-2"></i>
                                Custom Report Generator
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Report Type</label>
                                        <select class="form-control" id="report_type">
                                            <option value="inventory">Inventory Items</option>
                                            <option value="usage">Usage Analysis</option>
                                            <option value="purchase">Purchase Analysis</option>
                                            <option value="supplier">Supplier Analysis</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="date" class="form-control" id="start_date" value="<?php echo date('Y-m-01'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="date" class="form-control" id="end_date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary btn-block" onclick="generateCustomReport()">
                                            <i class="fas fa-chart-line mr-2"></i>
                                            Generate Report
                                        </button>
                                    </div>
                                </div>
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
function exportData(type) {
    // Create export URLs for different data types
    var exportUrl = '<?php echo base_url(); ?>inventory/export/' + type;
    
    // Add current date range if available
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    
    if (startDate && endDate) {
        exportUrl += '?start_date=' + startDate + '&end_date=' + endDate;
    }
    
    // Debug: Log the URL being generated
    console.log('Export URL:', exportUrl);
    
    // Open export in new window/tab
    window.open(exportUrl, '_blank');
}

function generateCustomReport() {
    var reportType = $('#report_type').val();
    var startDate = $('#start_date').val();
    var endDate = $('#end_date').val();
    
    if (!startDate || !endDate) {
        alert('Please select both start and end dates.');
        return;
    }
    
    var url = '<?php echo base_url(); ?>inventory/';
    switch(reportType) {
        case 'inventory':
            url += 'movement_report?start_date=' + startDate + '&end_date=' + endDate;
            break;
        case 'usage':
            url += 'usage/cost_analysis?start_date=' + startDate + '&end_date=' + endDate;
            break;
        case 'purchase':
            url += 'purchase/purchase_report?start_date=' + startDate + '&end_date=' + endDate;
            break;
        case 'supplier':
            url += 'supplier/performance_report?start_date=' + startDate + '&end_date=' + endDate;
            break;
    }
    
    window.location.href = url;
}
</script>