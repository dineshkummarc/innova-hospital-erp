<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exclamation-triangle text-warning mr-3"></i>
                        <?php echo lang('low_stock_items') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('low_stock_items'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/purchase" class="btn btn-primary btn-sm px-4 py-3">
                        <i class="fa fa-list"></i> <?php echo lang('purchase_orders'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <?php if (!empty($items)) { ?>
                <!-- Alert -->
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                    You have <?php echo count($items); ?> items with low stock levels that require immediate attention.
                </div>
            <?php } ?>
            
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('low_stock_items'); ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="lowStockTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('item_code'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('name'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('category'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('current_stock'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('reorder_level'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('shortage'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('unit_cost'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('suggested_order'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($items)) { ?>
                                            <?php foreach ($items as $item) { ?>
                                                <?php 
                                                $shortage = $item->reorder_level - $item->current_stock;
                                                $suggested_order = $item->maximum_stock > 0 ? $item->maximum_stock - $item->current_stock : $shortage * 2;
                                                $urgency = $item->current_stock == 0 ? 'danger' : ($item->current_stock <= ($item->reorder_level * 0.5) ? 'warning' : 'info');
                                                ?>
                                                <tr class="table-<?php echo $urgency; ?>">
                                                    <td class="font-weight-bold"><?php echo $item->item_code; ?></td>
                                                    <td>
                                                        <?php echo $item->name; ?>
                                                        <?php if ($item->current_stock == 0) { ?>
                                                            <br><span class="badge badge-danger">OUT OF STOCK</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php echo $item->category; ?></td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $urgency; ?>">
                                                            <?php echo $item->current_stock; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $item->reorder_level; ?></td>
                                                    <td>
                                                        <span class="badge badge-danger">
                                                            <?php echo $shortage; ?>
                                                        </span>
                                                    </td>
                                                    <td><?php echo $settings->currency . ' ' . number_format($item->unit_cost, 2); ?></td>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            <?php echo $suggested_order; ?>
                                                        </span>
                                                        <br>
                                                        <small class="text-muted">
                                                            Est. Cost: <?php echo $settings->currency . ' ' . number_format($suggested_order * $item->unit_cost, 2); ?>
                                                        </small>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group-vertical">
                                                            <a href="inventory/purchase" 
                                                               class="btn btn-primary btn-sm">
                                                                <i class="fas fa-shopping-cart"></i> Create PO
                                                            </a>
                                                            <a href="inventory/adjust_stock/<?php echo $item->id; ?>" 
                                                               class="btn btn-warning btn-sm">
                                                                <i class="fas fa-calculator"></i> Adjust
                                                            </a>
                                                            <a href="inventory/edit_item/<?php echo $item->id; ?>" 
                                                               class="btn btn-info btn-sm">
                                                                <i class="fas fa-edit"></i> Edit
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="9" class="text-center py-4">
                                                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                                    <h5 class="text-success">Great! No Low Stock Items</h5>
                                                    <p class="text-muted">All inventory items are above their reorder levels.</p>
                                                    <a href="inventory/items" class="btn btn-primary">
                                                        <i class="fas fa-list mr-2"></i>
                                                        <?php echo lang('view_all_items'); ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <?php if (!empty($items)) { ?>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6>Legend:</h6>
                                        <span class="badge badge-danger mr-2">Critical (Out of Stock)</span>
                                        <span class="badge badge-warning mr-2">Low (Below 50% of reorder level)</span>
                                        <span class="badge badge-info">Reorder Required</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" class="btn btn-success" onclick="createBulkPurchaseOrder()">
                                            <i class="fas fa-shopping-cart mr-2"></i>
                                            Create Bulk Purchase Order
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    $('#lowStockTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 3, "asc" ]]  // Order by current stock (lowest first)
    }).buttons().container().appendTo('#lowStockTable_wrapper .col-md-6:eq(0)');
});

function createBulkPurchaseOrder() {
    var items = [];
    $('#lowStockTable tbody tr').each(function() {
        if ($(this).find('td').length > 1) {  // Skip the "no data" row
            var row = $(this);
            var itemCode = row.find('td:first').text().trim();
            var suggestedOrder = parseInt(row.find('.badge-success').text().trim());
            
            if (suggestedOrder > 0) {
                items.push({
                    code: itemCode,
                    quantity: suggestedOrder
                });
            }
        }
    });
    
    if (items.length > 0) {
        // Redirect to purchase order creation with items
        var itemsParam = encodeURIComponent(JSON.stringify(items));
        window.location.href = 'inventory/purchase/add?bulk_items=' + itemsParam;
    } else {
        alert('No items selected for bulk order.');
    }
}
</script>