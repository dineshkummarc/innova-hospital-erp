<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-edit text-primary mr-3"></i>
                        <?php echo lang('edit_booking'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance/bookings"> <?php echo lang('bookings'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('edit_booking'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
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
                        <div class="card-header bg-warning text-white">
                            <h3 class="card-title mb-0">
                                <i class="fas fa-edit mr-2"></i>
                                <?php echo lang('edit_booking'); ?> - <?php echo isset($booking) && $booking ? $booking->booking_number : 'N/A'; ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <form role="form" action="<?php echo base_url(); ?>ambulance/updateBooking" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo isset($booking) && $booking ? $booking->id : $id; ?>">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="patient_id" class="control-label"><?php echo lang('patient'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="patient_id" id="patient_id">
                                                <option value=""><?php echo lang('select_patient'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pickup_address"><?php echo lang('pickup_address'); ?> <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="pickup_address" id="pickup_address" required placeholder="Enter pickup address..."><?php if (!empty($setval)) echo $pickup_address; else echo (isset($booking) && $booking && isset($booking->pickup_address)) ? $booking->pickup_address : ''; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="destination_address"><?php echo lang('destination_address'); ?> <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="destination_address" id="destination_address" required placeholder="Enter destination address..."><?php if (!empty($setval)) echo $destination_address; else echo (isset($booking) && $booking) ? $booking->destination_address : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ambulance_id"><?php echo lang('ambulance'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="ambulance_id" id="ambulance_id" required>
                                                <option value=""><?php echo lang('select_ambulance'); ?></option>
                                                <?php foreach ($ambulances as $ambulance) { ?>
                                                    <option value="<?php echo $ambulance->id; ?>" <?php if ((!empty($setval) && $ambulance_id == $ambulance->id) || (isset($booking) && $booking && $booking->ambulance_id == $ambulance->id)) echo 'selected'; ?>>
                                                        <?php echo $ambulance->vehicle_number; ?> - <?php echo $ambulance->driver_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="booking_type"><?php echo lang('booking_type'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="booking_type" id="booking_type" required>
                                                <option value=""><?php echo lang('select_booking_type'); ?></option>
                                                <option value="Emergency" <?php if ((!empty($setval) && $booking_type == 'Emergency') || (isset($booking) && $booking && $booking->booking_type == 'Emergency')) echo 'selected'; ?>><?php echo lang('emergency'); ?></option>
                                                <option value="Transfer" <?php if ((!empty($setval) && $booking_type == 'Transfer') || (isset($booking) && $booking && $booking->booking_type == 'Transfer')) echo 'selected'; ?>><?php echo lang('transfer'); ?></option>
                                                <option value="Discharge" <?php if ((!empty($setval) && $booking_type == 'Discharge') || (isset($booking) && $booking && $booking->booking_type == 'Discharge')) echo 'selected'; ?>><?php echo lang('discharge'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="priority"><?php echo lang('priority'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="priority" id="priority" required>
                                                <option value=""><?php echo lang('select_priority'); ?></option>
                                                <option value="Low" <?php if ((!empty($setval) && $priority == 'Low') || (isset($booking) && $booking && $booking->priority == 'Low')) echo 'selected'; ?>><?php echo lang('low'); ?></option>
                                                <option value="Medium" <?php if ((!empty($setval) && $priority == 'Medium') || (isset($booking) && $booking && $booking->priority == 'Medium')) echo 'selected'; ?>><?php echo lang('medium'); ?></option>
                                                <option value="High" <?php if ((!empty($setval) && $priority == 'High') || (isset($booking) && $booking && $booking->priority == 'High')) echo 'selected'; ?>><?php echo lang('high'); ?></option>
                                                <option value="Critical" <?php if ((!empty($setval) && $priority == 'Critical') || (isset($booking) && $booking && $booking->priority == 'Critical')) echo 'selected'; ?>><?php echo lang('critical'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pickup_time"><?php echo lang('pickup_time'); ?> <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="pickup_time" id="pickup_time" value="<?php if (!empty($setval)) echo $pickup_time; else echo (isset($booking) && $booking) ? date('Y-m-d\TH:i', strtotime($booking->pickup_time)) : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status"><?php echo lang('status'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value="Pending" <?php if ((!empty($setval) && $status == 'Pending') || (isset($booking) && $booking && $booking->status == 'Pending')) echo 'selected'; ?>><?php echo lang('pending'); ?></option>
                                                <option value="In Progress" <?php if ((!empty($setval) && $status == 'In Progress') || (isset($booking) && $booking && $booking->status == 'In Progress')) echo 'selected'; ?>><?php echo lang('in_progress'); ?></option>
                                                <option value="Completed" <?php if ((!empty($setval) && $status == 'Completed') || (isset($booking) && $booking && $booking->status == 'Completed')) echo 'selected'; ?>><?php echo lang('completed'); ?></option>
                                                <option value="Cancelled" <?php if ((!empty($setval) && $status == 'Cancelled') || (isset($booking) && $booking && $booking->status == 'Cancelled')) echo 'selected'; ?>><?php echo lang('cancelled'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="notes"><?php echo lang('notes'); ?></label>
                                            <textarea class="form-control" name="notes" id="notes" placeholder="Additional notes..."><?php if (!empty($setval)) echo $notes; else echo (isset($booking) && $booking) ? $booking->notes : ''; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-warning btn-lg px-5">
                                        <i class="fa fa-save mr-2"></i>
                                        <?php echo lang('update_booking'); ?>
                                    </button>
                                    <a href="<?php echo base_url(); ?>ambulance/bookings" class="btn btn-secondary btn-lg px-5 ml-3">
                                        <i class="fa fa-times mr-2"></i>
                                        <?php echo lang('cancel'); ?>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $(document).ready(function() {
        // Initialize Select2 for patient search with AJAX
        $('#patient_id').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Search by patient ID, name, phone, or age...',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: 'ambulance/getPatientInfo',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log('Patient search term:', params.term);
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    console.log('Patient search results:', data);
                    return {
                        results: data
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return "No patients found matching your search";
                },
                searching: function() {
                    return "Searching patients...";
                }
            }
        });
        
        // Initialize other Select2 dropdowns
        $('#ambulance_id').select2({
            theme: 'bootstrap4',
            width: '100%'
        });
        
        // Set the current patient as selected
        var currentPatientId = '<?php echo isset($booking) && $booking ? $booking->patient_id : ""; ?>';
        var currentPatientName = '<?php echo isset($booking) && $booking ? $booking->patient_name : ""; ?>';
        
        if (currentPatientId) {
            var option = new Option(currentPatientName, currentPatientId, true, true);
            $('#patient_id').append(option).trigger('change');
        }
        
        // Patient selection is handled by Select2 - no additional action needed
    });
</script>
