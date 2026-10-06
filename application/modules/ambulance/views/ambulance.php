<link href="common/extranal/css/patient/medical_history.css" rel="stylesheet">

<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-ambulance text-primary mr-3"></i>
                        <?php echo lang('ambulance'); ?> <?php echo lang('service'); ?> <?php echo lang('management'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('ambulance'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="ambulance/dashboard" class="btn btn-info btn-sm px-3 py-2 mr-2">
                        <i class="fas fa-tachometer-alt"></i> <?php echo lang('dashboard'); ?>
                    </a>
                    <a href="ambulance/newBooking" class="btn btn-success btn-sm px-3 py-2 mr-2">
                        <i class="fas fa-plus"></i> <?php echo lang('new_booking'); ?>
                    </a>
                    <a href="ambulance/addNewView" class="btn btn-primary btn-sm px-3 py-2">
                        <i class="fa fa-plus"></i> <?php echo lang('add_ambulance'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="content py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $available_count; ?></h3>
                            <p><?php echo lang('available_ambulances'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-ambulance"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $on_call_count; ?></h3>
                            <p><?php echo lang('on_call'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo count($ambulances); ?></h3>
                            <p><?php echo lang('total_ambulances'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-truck"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p><?php echo lang('maintenance'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wrench"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Navigation Tabs -->
    <section class="content py-3">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#fleet" role="tab">
                                <i class="fas fa-ambulance mr-1"></i> <?php echo lang('fleet_management'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bookings" role="tab">
                                <i class="fas fa-calendar-check mr-1"></i> <?php echo lang('bookings'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#payments" role="tab">
                                <i class="fas fa-credit-card mr-1"></i> <?php echo lang('payments'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#reports" role="tab">
                                <i class="fas fa-chart-bar mr-1"></i> <?php echo lang('reports'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#rates" role="tab">
                                <i class="fas fa-dollar-sign mr-1"></i> <?php echo lang('rates'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Fleet Management Tab -->
                        <div class="tab-pane active" id="fleet" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover datatables" id="ambulance-table" width="100%">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('id'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('vehicle_number'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('driver_name'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('driver_phone'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('ambulance_type'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('equipment'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('capacity'); ?></th>
                                            <th class="font-weight-bold"><?php echo lang('status'); ?></th>
                                            <th class="font-weight-bold no-print"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ambulances as $ambulance) { ?>
                                            <tr>
                                                <td><?php echo $ambulance->id; ?></td>
                                                <td><?php echo $ambulance->vehicle_number; ?></td>
                                                <td><?php echo $ambulance->driver_name; ?></td>
                                                <td><?php echo $ambulance->driver_phone; ?></td>
                                                <td><?php echo $ambulance->ambulance_type; ?></td>
                                                <td><?php echo $ambulance->equipment; ?></td>
                                                <td><?php echo $ambulance->capacity; ?></td>
                                                <td>
                                                    <?php if ($ambulance->status == 'Available') { ?>
                                                        <span class="badge badge-success"><?php echo $ambulance->status; ?></span>
                                                    <?php } elseif ($ambulance->status == 'On Call') { ?>
                                                        <span class="badge badge-warning"><?php echo $ambulance->status; ?></span>
                                                    <?php } elseif ($ambulance->status == 'Maintenance') { ?>
                                                        <span class="badge badge-info"><?php echo $ambulance->status; ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger"><?php echo $ambulance->status; ?></span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <a class="btn btn-info btn-xs" href="ambulance/editAmbulance?id=<?php echo $ambulance->id; ?>">
                                                        <i class="fa fa-edit"></i> <?php echo lang('edit'); ?>
                                                    </a>
                                                    <a class="btn btn-danger btn-xs" href="ambulance/deleteAmbulance?id=<?php echo $ambulance->id; ?>" onclick="return confirm('<?php echo lang('are_you_sure'); ?>?')">
                                                        <i class="fa fa-trash"></i> <?php echo lang('delete'); ?>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="tab-pane" id="bookings" role="tabpanel">
                            <div class="text-center py-5">
                                <h4><?php echo lang('ambulance_bookings'); ?></h4>
                                <p><?php echo lang('manage_ambulance_bookings_description'); ?></p>
                                <a href="ambulance/bookings" class="btn btn-primary btn-lg">
                                    <i class="fas fa-calendar-check mr-2"></i><?php echo lang('view_all_bookings'); ?>
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane" id="payments" role="tabpanel">
                            <div class="text-center py-5">
                                <h4><?php echo lang('payment_management'); ?></h4>
                                <p><?php echo lang('track_payments_description'); ?></p>
                                <a href="ambulance/payments" class="btn btn-success btn-lg">
                                    <i class="fas fa-credit-card mr-2"></i><?php echo lang('view_payments'); ?>
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane" id="reports" role="tabpanel">
                            <div class="text-center py-5">
                                <h4><?php echo lang('reports_analytics'); ?></h4>
                                <p><?php echo lang('generate_reports_description'); ?></p>
                                <a href="ambulance/reports" class="btn btn-info btn-lg">
                                    <i class="fas fa-chart-bar mr-2"></i><?php echo lang('view_reports'); ?>
                                </a>
                            </div>
                        </div>

                        <div class="tab-pane" id="rates" role="tabpanel">
                            <div class="text-center py-5">
                                <h4><?php echo lang('service_rates'); ?></h4>
                                <p><?php echo lang('configure_pricing_description'); ?></p>
                                <a href="ambulance/rates" class="btn btn-warning btn-lg">
                                    <i class="fas fa-dollar-sign mr-2"></i><?php echo lang('manage_rates'); ?>
                                </a>
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
        $('#ambulance-table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
