<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-chart-line text-primary mr-3"></i>
                        Purchase Report
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active">Purchase Report</li>
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
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-filter mr-2"></i>Date Range Filter
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="inventory/purchase/purchase_report">
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
                                            <button type="submit" class="btn btn-primary btn-block">
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

            <!-- Purchase Report Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Purchase Orders Report (<?php echo date('Y-m-d', strtotime($start_date)); ?> to <?php echo date('Y-m-d', strtotime($end_date)); ?>)
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="purchaseReportTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">PO Number</th>
                                            <th class="font-weight-bold">Supplier</th>
                                            <th class="font-weight-bold">Order Date</th>
                                            <th class="font-weight-bold">Expected Delivery</th>
                                            <th class="font-weight-bold">Total Items</th>
                                            <th class="font-weight-bold">Grand Total</th>
                                            <th class="font-weight-bold">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($purchases)) { ?>
                                            <?php 
                                            $total_amount = 0;
                                            $total_orders = 0;
                                            ?>
                                            <?php foreach ($purchases as $purchase) { ?>
                                                <?php 
                                                $total_amount += $purchase->grand_total;
                                                $total_orders++;
                                                
                                                $status_colors = array(
                                                    'draft' => 'secondary',
                                                    'sent' => 'primary',
                                                    'confirmed' => 'info',
                                                    'partially_received' => 'warning',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger'
                                                );
                                                $color = isset($status_colors[$purchase->status]) ? $status_colors[$purchase->status] : 'secondary';
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="inventory/purchase/view/<?php echo $purchase->id; ?>" class="font-weight-bold">
                                                            <?php echo $purchase->po_number; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $purchase->supplier_name; ?></td>
                                                    <td><?php echo date('Y-m-d', strtotime($purchase->order_date)); ?></td>
                                                    <td>
                                                        <?php if ($purchase->expected_delivery_date) { ?>
                                                            <?php echo date('Y-m-d', strtotime($purchase->expected_delivery_date)); ?>
                                                        <?php } else { ?>
                                                            <span class="text-muted">Not set</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo $purchase->total_items; ?> items</span>
                                                    </td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency; ?> <?php echo number_format($purchase->grand_total, 2); ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $color; ?>">
                                                            <?php echo ucfirst(str_replace('_', ' ', $purchase->status)); ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                                    <br>No purchase orders found for the selected date range.
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <?php if (!empty($purchases)) { ?>
                                        <tfoot class="bg-light">
                                            <tr>
                                                <th colspan="4" class="text-right">Summary:</th>
                                                <th><?php echo $total_orders; ?> Orders</th>
                                                <th class="text-success"><?php echo $settings->currency; ?> <?php echo number_format($total_amount, 2); ?></th>
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
    $('#purchaseReportTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 2, "desc" ]]
    }).buttons().container().appendTo('#purchaseReportTable_wrapper .col-md-6:eq(0)');
});
</script>