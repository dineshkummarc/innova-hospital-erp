<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-eye text-primary mr-3"></i>
                        <?php echo lang('booking_details'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance/bookings"> <?php echo lang('bookings'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('booking_details'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="<?php echo base_url(); ?>ambulance/editBooking?id=<?php echo $booking->id; ?>" class="btn btn-warning btn-sm px-3 py-2 mr-2">
                        <i class="fas fa-edit"></i> <?php echo lang('edit'); ?>
                    </a>
                    <a href="<?php echo base_url(); ?>ambulance/bookings" class="btn btn-secondary btn-sm px-3 py-2">
                        <i class="fas fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-info text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-calendar-check mr-2"></i>
                                <?php echo lang('booking_details'); ?> - <?php echo $booking->booking_number; ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-user mr-2"></i><?php echo lang('patient_information'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong><?php echo lang('patient_name'); ?>:</strong></td>
                                                    <td><?php echo $booking->patient_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('patient_phone'); ?>:</strong></td>
                                                    <td><?php echo $booking->patient_phone; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('patient_address'); ?>:</strong></td>
                                                    <td><?php echo $booking->patient_address; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-ambulance mr-2"></i><?php echo lang('ambulance_information'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong><?php echo lang('vehicle_number'); ?>:</strong></td>
                                                    <td><?php echo $booking->vehicle_number; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('driver_name'); ?>:</strong></td>
                                                    <td><?php echo $booking->driver_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('ambulance_type'); ?>:</strong></td>
                                                    <td><?php echo $booking->ambulance_type; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i><?php echo lang('location_information'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong><?php echo lang('pickup_address'); ?>:</strong></td>
                                                    <td><?php echo isset($booking->pickup_address) ? $booking->pickup_address : 'Not specified'; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('destination_address'); ?>:</strong></td>
                                                    <td><?php echo $booking->destination_address; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-info-circle mr-2"></i><?php echo lang('booking_information'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong><?php echo lang('booking_type'); ?>:</strong></td>
                                                    <td><?php echo $booking->booking_type; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('priority'); ?>:</strong></td>
                                                    <td>
                                                        <?php if ($booking->priority == 'High') { ?>
                                                            <span class="badge badge-danger"><?php echo $booking->priority; ?></span>
                                                        <?php } elseif ($booking->priority == 'Medium') { ?>
                                                            <span class="badge badge-warning"><?php echo $booking->priority; ?></span>
                                                        <?php } elseif ($booking->priority == 'Critical') { ?>
                                                            <span class="badge badge-dark"><?php echo $booking->priority; ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-success"><?php echo $booking->priority; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('status'); ?>:</strong></td>
                                                    <td>
                                                        <?php if ($booking->status == 'Pending') { ?>
                                                            <span class="badge badge-warning"><?php echo $booking->status; ?></span>
                                                        <?php } elseif ($booking->status == 'In Progress') { ?>
                                                            <span class="badge badge-info"><?php echo $booking->status; ?></span>
                                                        <?php } elseif ($booking->status == 'Completed') { ?>
                                                            <span class="badge badge-success"><?php echo $booking->status; ?></span>
                                                        <?php } elseif ($booking->status == 'Cancelled') { ?>
                                                            <span class="badge badge-danger"><?php echo $booking->status; ?></span>
                                                        <?php } else { ?>
                                                            <span class="badge badge-secondary"><?php echo $booking->status; ?></span>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-clock mr-2"></i><?php echo lang('timing_information'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong><?php echo lang('pickup_time'); ?>:</strong></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($booking->pickup_time)); ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong><?php echo lang('created_at'); ?>:</strong></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($booking->created_at)); ?></td>
                                                </tr>
                                                <?php if (!empty($booking->updated_at)) { ?>
                                                <tr>
                                                    <td><strong><?php echo lang('updated_at'); ?>:</strong></td>
                                                    <td><?php echo date('d/m/Y H:i', strtotime($booking->updated_at)); ?></td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="card bg-light mb-3">
                                        <div class="card-header">
                                            <h5 class="mb-0"><i class="fas fa-sticky-note mr-2"></i><?php echo lang('additional_information'); ?></h5>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><strong><?php echo lang('notes'); ?>:</strong></td>
                                                    <td><?php echo !empty($booking->notes) ? $booking->notes : 'No notes available'; ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="<?php echo base_url(); ?>ambulance/editBooking?id=<?php echo $booking->id; ?>" class="btn btn-warning btn-lg px-5 mr-3">
                                        <i class="fas fa-edit mr-2"></i>
                                        <?php echo lang('edit_booking'); ?>
                                    </a>
                                    <a href="<?php echo base_url(); ?>ambulance/bookings" class="btn btn-secondary btn-lg px-5">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        <?php echo lang('back_to_bookings'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>