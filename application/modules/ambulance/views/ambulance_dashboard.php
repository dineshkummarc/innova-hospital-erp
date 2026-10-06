<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-tachometer-alt text-primary mr-3"></i>
                        <?php echo lang('ambulance_dashboard'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('dashboard'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url(); ?>ambulance" class="btn btn-secondary btn-sm px-3 py-2">
                        <i class="fas fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Summary Cards -->
            <div class="row">
                <div class="col-md-2">
                    <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo lang('total_ambulances'); ?></span>
                            <span class="info-box-number"><?php echo $total_ambulances; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo lang('available'); ?></span>
                            <span class="info-box-number"><?php echo $available_ambulances; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo lang('pending'); ?></span>
                            <span class="info-box-number"><?php echo $pending_bookings; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo lang('in_progress'); ?></span>
                            <span class="info-box-number"><?php echo $in_progress_bookings; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info-box bg-purple">
                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo lang('total_bookings'); ?></span>
                            <span class="info-box-number"><?php echo $total_bookings; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-dollar"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"><?php echo lang('today_revenue'); ?></span>
                            <span class="info-box-number">$<?php echo number_format($today_revenue, 2); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-bolt mr-2"></i>
                                <?php echo lang('quick_actions'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>ambulance/newBooking" class="btn btn-primary btn-block">
                                        <i class="fa fa-plus"></i><br><?php echo lang('new_booking'); ?>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>ambulance/bookings" class="btn btn-info btn-block">
                                        <i class="fa fa-list"></i><br><?php echo lang('view_bookings'); ?>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>ambulance/addNewView" class="btn btn-success btn-block">
                                        <i class="fa fa-ambulance"></i><br><?php echo lang('add_ambulance'); ?>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>ambulance/payments" class="btn btn-warning btn-block">
                                        <i class="fa fa-credit-card"></i><br><?php echo lang('payments'); ?>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>ambulance/reports" class="btn btn-danger btn-block">
                                        <i class="fa fa-bar-chart"></i><br><?php echo lang('reports'); ?>
                                    </a>
                                </div>
                                <div class="col-md-2">
                                    <a href="<?php echo base_url(); ?>ambulance/rates" class="btn btn-default btn-block">
                                        <i class="fa fa-cog"></i><br><?php echo lang('rates'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-chart-pie mr-2"></i>
                                <?php echo lang('ambulance_status'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="ambulanceStatusChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-warning text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-chart-bar mr-2"></i>
                                <?php echo lang('booking_status'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="bookingStatusChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Bookings -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-calendar-check mr-2"></i>
                                <?php echo lang('recent_bookings'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-hover datatables" width="100%">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('booking_number'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('patient_name'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('pickup_time'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('priority'); ?></th>
                                            <th class="font-weight-bold no-print"><?php echo lang('actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($recent_bookings)) { ?>
                                            <?php foreach ($recent_bookings as $booking) { ?>
                                                <tr>
                                                    <td><?php echo $booking->booking_number; ?></td>
                                                    <td><?php echo $booking->patient_name; ?></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($booking->pickup_time)); ?></td>
                                                    <td>
                                                        <?php if ($booking->status == 'Pending') { ?>
                                                            <span class="badge badge-warning"><?php echo $booking->status; ?></span>
                                                        <?php } elseif ($booking->status == 'In Progress') { ?>
                                                            <span class="badge badge-info"><?php echo $booking->status; ?></span>
                                                        <?php } elseif ($booking->status == 'Completed') { ?>
                                                            <span class="badge badge-success"><?php echo $booking->status; ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-secondary"><?php echo $booking->status; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($booking->priority == 'High') { ?>
                                                            <span class="badge badge-danger"><?php echo $booking->priority; ?></span>
                                                        <?php } elseif ($booking->priority == 'Medium') { ?>
                                                            <span class="badge badge-warning"><?php echo $booking->priority; ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-success"><?php echo $booking->priority; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>ambulance/viewBooking?id=<?php echo $booking->id; ?>">
                                                            <i class="fa fa-eye"></i> <?php echo lang('view'); ?>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="6" class="text-center"><?php echo lang('no_recent_bookings'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Emergency Contacts -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-danger text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-phone mr-2"></i>
                                <?php echo lang('emergency_contacts'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box bg-red">
                                        <span class="info-box-icon"><i class="fa fa-phone"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('emergency_hotline'); ?></span>
                                            <span class="info-box-number">911</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-orange">
                                        <span class="info-box-icon"><i class="fa fa-hospital-o"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('hospital_contact'); ?></span>
                                            <span class="info-box-number">+1-555-0123</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('ambulance_dispatch'); ?></span>
                                            <span class="info-box-number">+1-555-0456</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-green">
                                        <span class="info-box-icon"><i class="fa fa-shield"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text"><?php echo lang('security'); ?></span>
                                            <span class="info-box-number">+1-555-0789</span>
                                        </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        // Ambulance Status Chart
        var ctx1 = document.getElementById('ambulanceStatusChart').getContext('2d');
        var ambulanceStatusChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['<?php echo lang('available'); ?>', '<?php echo lang('on_call'); ?>', '<?php echo lang('maintenance'); ?>'],
                datasets: [{
                    data: [<?php echo $available_ambulances; ?>, <?php echo $in_progress_bookings; ?>, 0],
                    backgroundColor: ['#00a65a', '#f39c12', '#f56954']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        
        // Booking Status Chart
        var ctx2 = document.getElementById('bookingStatusChart').getContext('2d');
        var bookingStatusChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['<?php echo lang('pending'); ?>', '<?php echo lang('in_progress'); ?>', '<?php echo lang('completed'); ?>'],
                datasets: [{
                    label: '<?php echo lang('bookings'); ?>',
                    data: [<?php echo $pending_bookings; ?>, <?php echo $in_progress_bookings; ?>, <?php echo $total_bookings - $pending_bookings - $in_progress_bookings; ?>],
                    backgroundColor: ['#f39c12', '#3c8dbc', '#00a65a']
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
    });
</script>
