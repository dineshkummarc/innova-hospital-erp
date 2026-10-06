<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-dollar-sign text-success mr-3"></i>
                        <?php echo lang('inventory_valuation'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('inventory_valuation'); ?></li>
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
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Total Items</h5>
                                    <h3 class="font-weight-bold"><?php echo count($items); ?></h3>
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
                                    <h5 class="card-title mb-0">Total Value</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $total_value = 0;
                                        foreach ($items as $item) {
                                            $total_value += ($item->quantity_in_stock * $item->unit_cost);
                                        }
                                        echo $settings->currency . ' ' . number_format($total_value, 2);
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
                                    <h5 class="card-title mb-0">Low Stock Items</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $low_stock_count = 0;
                                        foreach ($items as $item) {
                                            if ($item->quantity_in_stock <= $item->reorder_level) {
                                                $low_stock_count++;
                                            }
                                        }
                                        echo $low_stock_count;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-exclamation-triangle fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title mb-0">Out of Stock</h5>
                                    <h3 class="font-weight-bold">
                                        <?php 
                                        $out_of_stock_count = 0;
                                        foreach ($items as $item) {
                                            if ($item->quantity_in_stock <= 0) {
                                                $out_of_stock_count++;
                                            }
                                        }
                                        echo $out_of_stock_count;
                                        ?>
                                    </h3>
                                </div>
                                <i class="fas fa-times-circle fa-2x opacity-75"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Valuation Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800">Inventory Valuation Details</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="valuationTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase">Item Code</th>
                                            <th class="font-weight-bold text-uppercase">Item Name</th>
                                            <th class="font-weight-bold text-uppercase">Category</th>
                                            <th class="font-weight-bold text-uppercase">Unit Cost</th>
                                            <th class="font-weight-bold text-uppercase">Quantity</th>
                                            <th class="font-weight-bold text-uppercase">Total Value</th>
                                            <th class="font-weight-bold text-uppercase">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($items)) { ?>
                                            <?php foreach ($items as $item) { ?>
                                                <?php 
                                                $item_value = $item->quantity_in_stock * $item->unit_cost;
                                                $status_class = 'success';
                                                $status_text = 'In Stock';
                                                
                                                if ($item->quantity_in_stock <= 0) {
                                                    $status_class = 'danger';
                                                    $status_text = 'Out of Stock';
                                                } elseif ($item->quantity_in_stock <= $item->reorder_level) {
                                                    $status_class = 'warning';
                                                    $status_text = 'Low Stock';
                                                }
                                                ?>
                                                <tr>
                                                    <td class="font-weight-bold"><?php echo $item->item_code; ?></td>
                                                    <td><?php echo $item->name; ?></td>
                                                    <td><?php echo $item->category_name ?: 'Uncategorized'; ?></td>
                                                    <td><?php echo $settings->currency . ' ' . number_format($item->unit_cost, 2); ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $status_class; ?>">
                                                            <?php echo $item->quantity_in_stock . ' ' . $item->unit; ?>
                                                        </span>
                                                    </td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency . ' ' . number_format($item_value, 2); ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $status_class; ?>">
                                                            <?php echo $status_text; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                                    <h5 class="text-muted">No inventory items found</h5>
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
    $('#valuationTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 5, "desc" ]], // Sort by total value descending
        "language": {
            "search": "_INPUT_",
            "searchPlaceholder": "Search items..."
        },
        "columnDefs": [
            {
                "targets": [3, 5], // Unit cost and total value columns
                "type": "currency"
            }
        ]
    }).buttons().container().appendTo('#valuationTable_wrapper .col-md-6:eq(0)');
});
</script>