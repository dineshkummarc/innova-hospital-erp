<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-clipboard-list"></i> Radiology Orders
            <small>Manage radiology orders and requests</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li><a href="radiology">Radiology</a></li>
            <li class="active">Orders</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Radiology Orders</h3>
                        <div class="box-tools pull-right">
                            <a href="radiology/addOrder" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> New Order
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="ordersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Order Date</th>
                                        <th>Appointment</th>
                                        <th>Urgency</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?php echo $order->order_number; ?></td>
                                        <td><?php echo $order->patient_name; ?></td>
                                        <td><?php echo $order->doctor_name; ?></td>
                                        <td><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                        <td><?php echo $order->appointment_date ? date('M d, Y H:i', strtotime($order->appointment_date)) : 'Not scheduled'; ?></td>
                                        <td>
                                            <span class="label label-<?php echo $order->urgency == 'stat' ? 'danger' : ($order->urgency == 'urgent' ? 'warning' : 'info'); ?>">
                                                <?php echo strtoupper($order->urgency); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="label label-<?php echo $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info'); ?>">
                                                <?php echo ucfirst($order->status); ?>
                                            </span>
                                        </td>
                                        <td>$<?php echo number_format($order->total_amount, 2); ?></td>
                                        <td>
                                            <a href="radiology/viewOrder/<?php echo $order->id; ?>" class="btn btn-info btn-xs">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="radiology/editOrder/<?php echo $order->id; ?>" class="btn btn-warning btn-xs">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="radiology/deleteOrder/<?php echo $order->id; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this order?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#ordersTable').DataTable({
        "responsive": true,
        "autoWidth": false,
        "pageLength": 25,
        "order": [[3, "desc"]]
    });
});
</script>
