<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-calendar-check text-primary mr-3"></i>
                        <?php echo lang('ambulance_bookings'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('bookings'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url(); ?>ambulance/newBooking" class="btn btn-primary btn-sm px-3 py-2 mr-2">
                        <i class="fas fa-plus"></i> <?php echo lang('new_booking'); ?>
                    </a>
                    <a href="<?php echo base_url(); ?>ambulance" class="btn btn-secondary btn-sm px-3 py-2">
                        <i class="fas fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-calendar-check mr-2"></i>
                                <?php echo lang('ambulance_bookings'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">Pending</span>
                                            <span class="info-box-number"><?php echo $pending_count; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="info-box bg-blue">
                                        <span class="info-box-icon"><i class="fa fa-ambulance"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-text">In Progress</span>
                                            <span class="info-box-number"><?php echo $in_progress_count; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="bookings_table" class="table table-hover datatables" width="100%">
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
                                                <?php foreach ($bookings as $booking) { ?>
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
                                                            <div class="btn-group" role="group">
                                                                <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>ambulance/viewBooking?id=<?php echo $booking->id; ?>" title="View Details">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                                <a class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>ambulance/editBooking?id=<?php echo $booking->id; ?>" title="Edit Booking">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a class="btn btn-danger btn-xs" href="<?php echo base_url(); ?>ambulance/deleteBooking?id=<?php echo $booking->id; ?>" 
                                                                   onclick="return confirm('Are you sure you want to delete this booking?')" title="Delete Booking">
                                                                    <i class="fa fa-trash"></i>
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
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        $('#bookings_table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
</script>
