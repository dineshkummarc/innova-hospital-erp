<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-truck text-info mr-3"></i>
                        Pending Deliveries
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/reports"><?php echo lang('reports'); ?></a></li>
                            <li class="breadcrumb-item active">Pending Deliveries</li>
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
            <!-- Summary Cards -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-warning text-white shadow-lg">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0"><?php echo count($pending_orders); ?></h4>
                                    <p class="mb-0">Pending Orders</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-danger text-white shadow-lg">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <h4 class="mb-0"><?php echo count($overdue_orders); ?></h4>
                                    <p class="mb-0">Overdue Deliveries</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-exclamation-triangle fa-3x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-warning text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-clock mr-2"></i>
                                Pending Purchase Orders
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pendingOrdersTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">PO Number</th>
                                            <th class="font-weight-bold">Supplier</th>
                                            <th class="font-weight-bold">Order Date</th>
                                            <th class="font-weight-bold">Expected Delivery</th>
                                            <th class="font-weight-bold">Total Amount</th>
                                            <th class="font-weight-bold">Status</th>
                                            <th class="font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($pending_orders)) { ?>
                                            <?php foreach ($pending_orders as $order) { ?>
                                                <?php 
                                                $status_colors = array(
                                                    'sent' => 'primary',
                                                    'confirmed' => 'info',
                                                    'partially_received' => 'warning'
                                                );
                                                $color = isset($status_colors[$order->status]) ? $status_colors[$order->status] : 'secondary';
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="inventory/purchase/view/<?php echo $order->id; ?>" class="font-weight-bold">
                                                            <?php echo $order->po_number; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $order->supplier_name; ?></td>
                                                    <td><?php echo date('Y-m-d', strtotime($order->order_date)); ?></td>
                                                    <td>
                                                        <?php if ($order->expected_delivery_date) { ?>
                                                            <?php echo date('Y-m-d', strtotime($order->expected_delivery_date)); ?>
                                                        <?php } else { ?>
                                                            <span class="text-muted">Not set</span>
                                                        <?php } ?>
                                                    </td>
                                                    <td class="font-weight-bold text-success">
                                                        <?php echo $settings->currency; ?> <?php echo number_format($order->grand_total, 2); ?>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-<?php echo $color; ?>">
                                                            <?php echo ucfirst(str_replace('_', ' ', $order->status)); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="inventory/purchase/view/<?php echo $order->id; ?>" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="inventory/purchase/edit/<?php echo $order->id; ?>" class="btn btn-sm btn-warning">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    <i class="fas fa-check-circle fa-3x mb-3 text-success"></i>
                                                    <br>No pending deliveries found.
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

            <!-- Overdue Orders -->
            <?php if (!empty($overdue_orders)) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-exclamation-triangle mr-2"></i>
                                Overdue Deliveries
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="overdueOrdersTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold">PO Number</th>
                                            <th class="font-weight-bold">Supplier</th>
                                            <th class="font-weight-bold">Order Date</th>
                                            <th class="font-weight-bold">Expected Delivery</th>
                                            <th class="font-weight-bold">Days Overdue</th>
                                            <th class="font-weight-bold">Total Amount</th>
                                            <th class="font-weight-bold">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($overdue_orders as $order) { ?>
                                            <?php 
                                            $days_overdue = floor((time() - strtotime($order->expected_delivery_date)) / (60 * 60 * 24));
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="inventory/purchase/view/<?php echo $order->id; ?>" class="font-weight-bold">
                                                        <?php echo $order->po_number; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $order->supplier_name; ?></td>
                                                <td><?php echo date('Y-m-d', strtotime($order->order_date)); ?></td>
                                                <td class="text-danger font-weight-bold">
                                                    <?php echo date('Y-m-d', strtotime($order->expected_delivery_date)); ?>
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger"><?php echo $days_overdue; ?> days</span>
                                                </td>
                                                <td class="font-weight-bold text-success">
                                                    <?php echo $settings->currency; ?> <?php echo number_format($order->grand_total, 2); ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="inventory/purchase/view/<?php echo $order->id; ?>" class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="inventory/purchase/edit/<?php echo $order->id; ?>" class="btn btn-sm btn-warning">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                    </div>
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
            <?php } ?>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#pendingOrdersTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 2, "desc" ]]
    }).buttons().container().appendTo('#pendingOrdersTable_wrapper .col-md-6:eq(0)');

    <?php if (!empty($overdue_orders)) { ?>
    $('#overdueOrdersTable').DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"],
        "order": [[ 4, "desc" ]] // Sort by days overdue
    }).buttons().container().appendTo('#overdueOrdersTable_wrapper .col-md-6:eq(0)');
    <?php } ?>
});
</script>