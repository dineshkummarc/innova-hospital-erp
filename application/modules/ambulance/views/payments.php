<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-credit-card text-primary mr-3"></i>
                        <?php echo lang('payment_management'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="ambulance"> <?php echo lang('ambulance'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('payments'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <button type="button" class="btn btn-primary btn-sm px-3 py-2 mr-2" data-toggle="modal" data-target="#addPaymentModal">
                        <i class="fas fa-plus"></i> <?php echo lang('add_payment'); ?>
                    </button>
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
                                <i class="fas fa-credit-card mr-2"></i>
                                <?php echo lang('payment_management'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="payments_table" class="table table-hover datatables" width="100%">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th class="font-weight-bold text-uppercase"><?php echo lang('payment_number'); ?></th>
                                                    <th class="font-weight-bold"><?php echo lang('booking_number'); ?></th>
                                                    <th class="font-weight-bold"><?php echo lang('amount'); ?></th>
                                                    <th class="font-weight-bold"><?php echo lang('payment_method'); ?></th>
                                                    <th class="font-weight-bold"><?php echo lang('payment_status'); ?></th>
                                                    <th class="font-weight-bold"><?php echo lang('payment_date'); ?></th>
                                                    <th class="font-weight-bold no-print"><?php echo lang('actions'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($payments as $payment) { ?>
                                                    <tr>
                                                        <td><?php echo $payment->payment_number; ?></td>
                                                        <td><?php echo $payment->booking_number; ?></td>
                                                        <td><?php echo '$' . number_format($payment->amount, 2); ?></td>
                                                        <td><?php echo $payment->payment_method; ?></td>
                                                        <td>
                                                            <?php if ($payment->payment_status == 'Completed') { ?>
                                                                <span class="badge badge-success"><?php echo $payment->payment_status; ?></span>
                                                            <?php } elseif ($payment->payment_status == 'Pending') { ?>
                                                                <span class="badge badge-warning"><?php echo $payment->payment_status; ?></span>
                                                            <?php } else { ?>
                                                                <span class="badge badge-danger"><?php echo $payment->payment_status; ?></span>
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo date('d/m/Y H:i', strtotime($payment->payment_date)); ?></td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <a class="btn btn-info btn-xs" onclick="viewPayment(<?php echo $payment->id; ?>)" title="View Payment Details">
                                                                    <i class="fa fa-eye"></i>
                                                            </a>
                                                                <a class="btn btn-warning btn-xs" onclick="editPayment(<?php echo $payment->id; ?>)" title="Edit Payment">
                                                                    <i class="fa fa-edit"></i>
                                                            </a>
                                                                <a class="btn btn-danger btn-xs" onclick="deletePayment(<?php echo $payment->id; ?>)" title="Delete Payment">
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

<!-- Include Global Modal Styles -->
<link rel="stylesheet" href="<?php echo base_url(); ?>application/assets/css/global-modal-styles.css">

<!-- Add Payment Modal -->
<div class="modal fade modal-enhanced" id="addPaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle mr-2"></i>
                    <?php echo lang('add_payment'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>ambulance/addPayment" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="booking_id">
                            <i class="fas fa-calendar-check mr-2"></i>
                            <?php echo lang('booking_number'); ?> <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select2 select-enhanced" name="booking_id" id="booking_id" required>
                            <option value=""><?php echo lang('select_booking'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="amount">
                            <i class="fas fa-dollar-sign mr-2"></i>
                            <?php echo lang('amount'); ?>
                        </label>
                        <input type="number" class="form-control" name="amount" id="amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="payment_method">
                            <i class="fas fa-credit-card mr-2"></i>
                            <?php echo lang('payment_method'); ?>
                        </label>
                        <select class="form-control select-enhanced" name="payment_method" id="payment_method" required>
                            <option value=""><?php echo lang('select_payment_method'); ?></option>
                            <option value="Cash"><?php echo lang('cash'); ?></option>
                            <option value="Credit Card"><?php echo lang('credit_card'); ?></option>
                            <option value="Debit Card"><?php echo lang('debit_card'); ?></option>
                            <option value="Bank Transfer"><?php echo lang('bank_transfer'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="notes">
                            <i class="fas fa-sticky-note mr-2"></i>
                            <?php echo lang('notes'); ?>
                        </label>
                        <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="Enter any additional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-enhanced" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        <?php echo lang('cancel'); ?>
                    </button>
                    <button type="submit" class="btn btn-primary-enhanced">
                        <i class="fas fa-save mr-1"></i>
                        <?php echo lang('add_payment'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Payment Modal -->
<div class="modal fade modal-enhanced" id="editPaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit mr-2"></i>
                    <?php echo lang('edit_payment'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form role="form" action="<?php echo base_url(); ?>ambulance/updatePayment" method="post">
                <input type="hidden" name="payment_id" id="edit_payment_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_booking_id">
                            <i class="fas fa-calendar-check mr-2"></i>
                            <?php echo lang('booking_number'); ?> <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select2 select-enhanced" name="booking_id" id="edit_booking_id" required>
                            <option value=""><?php echo lang('select_booking'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_amount">
                            <i class="fas fa-dollar-sign mr-2"></i>
                            <?php echo lang('amount'); ?> <span class="text-danger">*</span>
                        </label>
                        <input type="number" class="form-control" name="amount" id="edit_amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_payment_method">
                            <i class="fas fa-credit-card mr-2"></i>
                            <?php echo lang('payment_method'); ?> <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select-enhanced" name="payment_method" id="edit_payment_method" required>
                            <option value=""><?php echo lang('select_payment_method'); ?></option>
                            <option value="Cash"><?php echo lang('cash'); ?></option>
                            <option value="Credit Card"><?php echo lang('credit_card'); ?></option>
                            <option value="Debit Card"><?php echo lang('debit_card'); ?></option>
                            <option value="Bank Transfer"><?php echo lang('bank_transfer'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_payment_status">
                            <i class="fas fa-info-circle mr-2"></i>
                            <?php echo lang('payment_status'); ?> <span class="text-danger">*</span>
                        </label>
                        <select class="form-control select-enhanced" name="payment_status" id="edit_payment_status" required>
                            <option value="Pending"><?php echo lang('pending'); ?></option>
                            <option value="Completed"><?php echo lang('completed'); ?></option>
                            <option value="Failed"><?php echo lang('failed'); ?></option>
                            <option value="Refunded"><?php echo lang('refunded'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_notes">
                            <i class="fas fa-sticky-note mr-2"></i>
                            <?php echo lang('notes'); ?>
                        </label>
                        <textarea class="form-control" name="notes" id="edit_notes" rows="3" placeholder="Enter any additional notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary-enhanced" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>
                        <?php echo lang('cancel'); ?>
                    </button>
                    <button type="submit" class="btn btn-warning btn-enhanced">
                        <i class="fas fa-save mr-1"></i>
                        <?php echo lang('update_payment'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Payment Modal -->
<div class="modal fade modal-enhanced" id="viewPaymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-eye mr-2"></i>
                    <?php echo lang('payment_details'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="paymentDetails">
                <!-- Payment details will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary-enhanced" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i>
                    <?php echo lang('close'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#payments_table').DataTable({
            responsive: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
        
        // Initialize Select2 for booking search with AJAX
        $('#booking_id').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Search by booking number or patient name...',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: 'ambulance/getBookingInfo',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    console.log('Booking search term:', params.term);
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    console.log('Booking search results:', data);
                    return {
                        results: data
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return "No bookings found matching your search";
                },
                searching: function() {
                    return "Searching bookings...";
                }
            }
        });
        
        // Initialize Select2 for edit modal booking search
        $('#edit_booking_id').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: 'Search by booking number or patient name...',
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: 'ambulance/getBookingInfo',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return "No bookings found matching your search";
                },
                searching: function() {
                    return "Searching bookings...";
                }
            }
        });
        
        // Auto-fill amount when booking is selected
        $('#booking_id').on('select2:select', function (e) {
            var data = e.params.data;
            var bookingId = data.id;
            
            if (bookingId) {
                // Load booking details to auto-fill amount
                loadBookingDetails(bookingId);
            }
        });
        
        // Clear amount when booking is cleared
        $('#booking_id').on('select2:clear', function (e) {
            $('#amount').val('');
        });
        
        function loadBookingDetails(bookingId) {
            $.ajax({
                url: 'ambulance/getBookingById',
                type: 'GET',
                data: { id: bookingId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#amount').val(response.data.total_fare || '');
                    } else {
                        console.error('Error loading booking details:', response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    });
    
    function viewPayment(paymentId) {
        $.ajax({
            url: 'ambulance/getPaymentById',
            type: 'GET',
            data: { id: paymentId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var payment = response.data;
                    var html = '<div class="row">';
                    html += '<div class="col-md-6">';
                    html += '<div class="card bg-light mb-3">';
                    html += '<div class="card-header"><h5 class="mb-0"><i class="fas fa-credit-card mr-2"></i>Payment Information</h5></div>';
                    html += '<div class="card-body">';
                    html += '<table class="table table-borderless">';
                    html += '<tr><td><strong>Payment Number:</strong></td><td>' + payment.payment_number + '</td></tr>';
                    html += '<tr><td><strong>Amount:</strong></td><td>$' + parseFloat(payment.amount).toFixed(2) + '</td></tr>';
                    html += '<tr><td><strong>Payment Method:</strong></td><td>' + payment.payment_method + '</td></tr>';
                    html += '<tr><td><strong>Status:</strong></td><td><span class="badge badge-' + getStatusBadgeClass(payment.payment_status) + '">' + payment.payment_status + '</span></td></tr>';
                    html += '<tr><td><strong>Payment Date:</strong></td><td>' + formatDateTime(payment.payment_date) + '</td></tr>';
                    html += '</table></div></div></div>';
                    
                    html += '<div class="col-md-6">';
                    html += '<div class="card bg-light mb-3">';
                    html += '<div class="card-header"><h5 class="mb-0"><i class="fas fa-calendar-check mr-2"></i>Booking Information</h5></div>';
                    html += '<div class="card-body">';
                    html += '<table class="table table-borderless">';
                    html += '<tr><td><strong>Booking Number:</strong></td><td>' + payment.booking_number + '</td></tr>';
                    html += '<tr><td><strong>Patient Name:</strong></td><td>' + payment.patient_name + '</td></tr>';
                    html += '<tr><td><strong>Total Fare:</strong></td><td>$' + parseFloat(payment.total_fare).toFixed(2) + '</td></tr>';
                    html += '</table></div></div></div>';
                    
                    if (payment.notes) {
                        html += '<div class="col-md-12">';
                        html += '<div class="card bg-light mb-3">';
                        html += '<div class="card-header"><h5 class="mb-0"><i class="fas fa-sticky-note mr-2"></i>Notes</h5></div>';
                        html += '<div class="card-body">' + payment.notes + '</div></div></div>';
                    }
                    
                    html += '</div>';
                    $('#paymentDetails').html(html);
                    $('#viewPaymentModal').modal('show');
                } else {
                    alert('Error loading payment details: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error loading payment details: ' + error);
            }
        });
    }
    
    function editPayment(paymentId) {
        $.ajax({
            url: 'ambulance/getPaymentById',
            type: 'GET',
            data: { id: paymentId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var payment = response.data;
                    $('#edit_payment_id').val(payment.id);
                    $('#edit_amount').val(payment.amount);
                    $('#edit_payment_method').val(payment.payment_method);
                    $('#edit_payment_status').val(payment.payment_status);
                    $('#edit_notes').val(payment.notes);
                    
                    // Set booking selection
                    var bookingOption = new Option(
                        payment.booking_number + ' - ' + payment.patient_name + ' ($' + parseFloat(payment.total_fare).toFixed(2) + ')',
                        payment.booking_id,
                        true,
                        true
                    );
                    $('#edit_booking_id').append(bookingOption).trigger('change');
                    
                    $('#editPaymentModal').modal('show');
                } else {
                    alert('Error loading payment details: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error loading payment details: ' + error);
            }
        });
    }
    
    function deletePayment(paymentId) {
        if (confirm('Are you sure you want to delete this payment? This action cannot be undone.')) {
            $.ajax({
                url: 'ambulance/deletePayment',
                type: 'POST',
                data: { id: paymentId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Payment deleted successfully');
                        location.reload();
                    } else {
                        alert('Error deleting payment: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error deleting payment: ' + error);
                }
            });
        }
    }
    
    function getStatusBadgeClass(status) {
        switch(status) {
            case 'Completed': return 'success';
            case 'Pending': return 'warning';
            case 'Failed': return 'danger';
            case 'Refunded': return 'info';
            default: return 'secondary';
        }
    }
    
    function formatDateTime(dateString) {
        var date = new Date(dateString);
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }
</script>
