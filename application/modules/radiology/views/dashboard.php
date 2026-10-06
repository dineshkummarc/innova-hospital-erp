<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-x-ray"></i> Radiology Dashboard
            <small>Overview of radiology services</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fas fa-tachometer-alt"></i> Home</a></li>
            <li class="active">Radiology Dashboard</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Statistics Row -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3><?php echo $stats['total_orders']; ?></h3>
                        <p>Total Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <a href="radiology/orders" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3><?php echo $stats['completed_orders']; ?></h3>
                        <p>Completed Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="radiology/orders" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo $stats['pending_orders']; ?></h3>
                        <p>Pending Orders</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <a href="radiology/orders" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3><?php echo $stats['total_reports']; ?></h3>
                        <p>Total Reports</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <a href="radiology/reports" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Quick Actions</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="radiology/addOrder" class="btn btn-primary btn-block">
                                    <i class="fas fa-plus"></i> New Order
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="radiology/addReport" class="btn btn-success btn-block">
                                    <i class="fas fa-file-medical"></i> New Report
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="radiology/addAppointment" class="btn btn-info btn-block">
                                    <i class="fas fa-calendar-plus"></i> Schedule Appointment
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="radiology/equipment" class="btn btn-warning btn-block">
                                    <i class="fas fa-cogs"></i> Manage Equipment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders and Reports Row -->
        <div class="row">
            <div class="col-md-6">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Orders</h3>
                        <div class="box-tools pull-right">
                            <a href="radiology/orders" class="btn btn-sm btn-info">View All</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order #</th>
                                        <th>Patient</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($recent_orders, 0, 5) as $order): ?>
                                    <tr>
                                        <td><?php echo $order->order_number; ?></td>
                                        <td><?php echo $order->patient_name; ?></td>
                                        <td>
                                            <span class="label label-<?php echo $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info'); ?>">
                                                <?php echo ucfirst($order->status); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Reports</h3>
                        <div class="box-tools pull-right">
                            <a href="radiology/reports" class="btn btn-sm btn-success">View All</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Report Title</th>
                                        <th>Patient</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach (array_slice($recent_reports, 0, 5) as $report): ?>
                                    <tr>
                                        <td><?php echo $report->report_title; ?></td>
                                        <td><?php echo $report->patient_name; ?></td>
                                        <td>
                                            <span class="label label-<?php echo $report->status == 'final' ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($report->status); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($report->report_date)); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Appointments -->
        <div class="row">
            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Today's Appointments</h3>
                        <div class="box-tools pull-right">
                            <a href="radiology/appointments" class="btn btn-sm btn-warning">View All</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Patient</th>
                                        <th>Test</th>
                                        <th>Equipment</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" class="text-center">No appointments for today</td>
                                    </tr>
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
    // Auto-refresh dashboard every 30 seconds
    setInterval(function() {
        location.reload();
    }, 30000);
});
</script>
