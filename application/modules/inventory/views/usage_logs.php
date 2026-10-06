<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-clipboard-list text-primary mr-3"></i>
                        <?php echo lang('usage_logs') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('usage_logs'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#addUsageModal" class="btn btn-success btn-sm px-4 py-3">
                        <i class="fa fa-plus-circle"></i> <?php echo lang('log_usage'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            
            <?php if ($this->session->flashdata('warning')) { ?>
                <div class="alert alert-warning alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('warning'); ?>
                </div>
            <?php } ?>
            
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all') . ' ' . lang('usage_logs'); ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="usageLogsTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('usage_date'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('item_name'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('quantity_used'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('used_by_type'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('purpose'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('total_cost'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Server-side DataTables will populate this -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Usage Modal -->
<div class="modal fade" id="addUsageModal" tabindex="-1" role="dialog" aria-labelledby="addUsageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <!-- Enhanced Modal Header -->
            <div class="modal-header bg-gradient-info text-white border-0">
                <div class="d-flex align-items-center">
                    <div class="modal-icon-wrapper mr-3">
                        <i class="fas fa-clipboard-list fa-2x text-white-50"></i>
                    </div>
                    <div>
                        <h4 class="modal-title font-weight-bold mb-1" id="addUsageModalLabel">
                            <i class="fas fa-plus-circle mr-2"></i><?php echo lang('log_usage'); ?>
                        </h4>
                        <p class="mb-0 text-white-50 small">Record inventory item usage</p>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>

            <!-- Enhanced Modal Body -->
            <div class="modal-body p-0">
                <!-- Progress Steps -->
                <div class="bg-light border-bottom">
                    <div class="container-fluid py-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <nav aria-label="Usage form progress">
                                    <ol class="breadcrumb bg-transparent mb-0">
                                        <li class="breadcrumb-item">
                                            <i class="fas fa-box text-primary mr-1"></i>
                                            <?php echo lang('item_selection'); ?>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <i class="fas fa-calculator text-secondary mr-1"></i>
                                            <?php echo lang('quantity_date'); ?>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <i class="fas fa-user text-secondary mr-1"></i>
                                            <?php echo lang('usage_details_section'); ?>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                        
                        <form role="form" action="<?php echo base_url('inventory/add_usage'); ?>" method="post" id="addUsageForm">
                        <!-- Item Selection Card -->
                        <div class="card border-left-primary mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-box mr-2"></i><?php echo lang('item_information'); ?>
                                </h6>
                            </div>
                            <div class="card-body">
                            <div class="row">
                                    <!-- Inventory Item Selection -->
                                    <div class="col-md-12">
                                    <div class="form-group">
                                            <label for="inventory_item_id" class="font-weight-bold text-dark">
                                                <i class="fas fa-cube text-primary mr-2"></i><?php echo lang('inventory_item'); ?> 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control border-left-0" name="inventory_item_id" id="inventory_item_id" required>
                                            <option value=""><?php echo lang('select') . ' ' . lang('item'); ?></option>
                                            <?php if (!empty($inventory_items)) { ?>
                                                <?php foreach ($inventory_items as $item) { ?>
                                                            <option value="<?php echo $item->id; ?>" data-stock="<?php echo $item->calculated_current_stock; ?>" data-cost="<?php echo $item->unit_cost; ?>" data-uom="<?php echo $item->unit_of_measure; ?>">
                                                                <?php echo $item->name; ?> (<?php echo $item->item_code; ?>) - Stock: <?php echo $item->calculated_current_stock; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                            </div>

                                        </div>
                                    </div>
                                    </div>
                                    
                                <!-- Stock Alert -->
                                <div class="alert alert-info d-none" id="stock-alert">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle fa-2x mr-3"></i>
                                        <div>
                                            <strong>Current Stock Information:</strong>
                                            <br>Available: <span id="available_stock_display" class="font-weight-bold">-</span> units
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                    
                        <!-- Usage Details Card -->
                        <div class="card border-left-info mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-calculator mr-2"></i><?php echo lang('usage_quantity_date'); ?>
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Quantity Used -->
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="quantity_used" class="font-weight-bold text-dark">
                                                <i class="fas fa-hashtag text-info mr-2"></i><?php echo lang('quantity_used'); ?> 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-minus-circle text-muted"></i>
                                                    </span>
                                                </div>
                                                <input type="number" 
                                                       class="form-control border-left-0 pl-0" 
                                                       name="quantity_used" 
                                                       id="quantity_used" 
                                                       min="1" 
                                                       placeholder="<?php echo lang('enter_quantity'); ?>"
                                                       required>
                                            </div>

                                        </div>
                                    </div>  
                                    
                                    <!-- Usage Date -->
                                    <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="usage_date" class="font-weight-bold text-dark">
                                                <i class="fas fa-calendar-alt text-info mr-2"></i><?php echo lang('usage_date'); ?> 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-clock text-muted"></i>
                                                    </span>
                                                </div>
                                                <input type="datetime-local" 
                                                       class="form-control border-left-0" 
                                                       name="usage_date" 
                                                       id="usage_date" 
                                                       value="<?php echo date('Y-m-d\TH:i'); ?>" 
                                                       required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Purpose -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="purpose" class="font-weight-bold text-dark">
                                                <i class="fas fa-bullseye text-warning mr-2"></i><?php echo lang('purpose'); ?> 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-comment-alt text-muted"></i>
                                                    </span>
                                                </div>
                                                <input type="text" 
                                                       class="form-control border-left-0 pl-0" 
                                                       name="purpose" 
                                                       id="purpose" 
                                                       placeholder="<?php echo lang('purpose_examples'); ?>"
                                                       required>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- User Assignment Card -->
                        <div class="card border-left-success">
                            <div class="card-header bg-success text-white">
                                <h6 class="card-title mb-0">
                                    <i class="fas fa-user-tag mr-2"></i>Usage Assignment
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Used By Type -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="used_by_type" class="font-weight-bold text-dark">
                                                <i class="fas fa-user-check text-success mr-2"></i><?php echo lang('used_by_type'); ?> 
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-users text-muted"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control border-left-0" name="used_by_type" id="used_by_type" required>
                                            <option value=""><?php echo lang('select') . ' ' . lang('type'); ?></option>
                                                    <option value="patient"><?php echo lang('patient'); ?></option>
                                                    <option value="doctor"><?php echo lang('doctor'); ?></option>
                                                    <option value="nurse"><?php echo lang('nurse'); ?></option>
                                                    <option value="department"><?php echo lang('department'); ?></option>
                                                    <option value="other"><?php echo lang('other'); ?></option>
                                        </select>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <!-- Notes -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="notes" class="font-weight-bold text-dark">
                                                <i class="fas fa-sticky-note text-warning mr-2"></i><?php echo lang('notes'); ?>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-pen text-muted"></i>
                                                    </span>
                                                </div>
                                                <textarea class="form-control border-left-0" 
                                                          name="notes" 
                                                          id="notes" 
                                                          rows="3"
                                                          placeholder="<?php echo lang('additional_notes_placeholder'); ?>"></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <!-- Dynamic User Selection Groups -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- Patient Selection -->
                                        <div class="form-group d-none" id="patient_group">
                                            <label for="patient_id" class="font-weight-bold text-primary">
                                                <i class="fas fa-user-injured text-primary mr-2"></i><?php echo lang('patient'); ?>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control border-left-0" name="patient_id" id="patient_id">
                                            <option value=""><?php echo lang('select') . ' ' . lang('patient'); ?></option>
                                            <?php if (!empty($patients)) { ?>
                                                <?php foreach ($patients as $patient) { ?>
                                                    <option value="<?php echo $patient->id; ?>">
                                                        <?php echo $patient->name; ?> (ID: <?php echo $patient->patient_id; ?>)
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                            </div>
                                    </div>
                                    
                                        <!-- Doctor Selection -->
                                        <div class="form-group d-none" id="doctor_group">
                                            <label for="doctor_id" class="font-weight-bold text-success">
                                                <i class="fas fa-user-md text-success mr-2"></i><?php echo lang('doctor'); ?>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control border-left-0" name="doctor_id" id="doctor_id">
                                            <option value=""><?php echo lang('select') . ' ' . lang('doctor'); ?></option>
                                            <?php if (!empty($doctors)) { ?>
                                                <?php foreach ($doctors as $doctor) { ?>
                                                    <option value="<?php echo $doctor->id; ?>">
                                                        <?php echo $doctor->name; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                            </div>
                                    </div>
                                    
                                        <!-- Department Selection -->
                                        <div class="form-group d-none" id="department_group">
                                            <label for="department_id" class="font-weight-bold text-info">
                                                <i class="fas fa-building text-info mr-2"></i><?php echo lang('department'); ?>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-light border-right-0">
                                                        <i class="fas fa-search text-muted"></i>
                                                    </span>
                                                </div>
                                                <select class="form-control border-left-0" name="department_id" id="department_id">
                                            <option value=""><?php echo lang('select') . ' ' . lang('department'); ?></option>
                                            <?php if (!empty($departments)) { ?>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option value="<?php echo $department->id; ?>">
                                                        <?php echo $department->name; ?>
                                                    </option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Hidden fields with default values -->
                            <input type="hidden" name="used_by_id" value="">
                            <input type="hidden" name="batch_number" value="">
                            <input type="hidden" name="expiry_date" value="">
                            <!-- Hidden submit field -->
                            <input type="hidden" name="submit" value="1">
                        </form>
                    </div>
                </div>

            <!-- Enhanced Modal Footer -->
            <div class="modal-footer bg-light border-0 px-4 py-3">
                <div class="d-flex w-100 justify-content-between align-items-center">
                    <div class="text-muted small">
                        <i class="fas fa-info-circle mr-1"></i>
                        This will decrease inventory stock levels
            </div>
                    <div>
                        <button type="button" class="btn btn-light border mr-2" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
                </button>
                        <button type="submit" form="addUsageForm" name="submit" class="btn btn-info shadow">
                            <i class="fas fa-save mr-2"></i><?php echo lang('save'); ?> Usage
                </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript -->
<script>
$(document).ready(function() {
    $('#usageLogsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('inventory/getUsageLogsAjax'); ?>",
            "type": "GET",
            "error": function(xhr, error, code) {
                console.error('DataTables AJAX Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Error loading usage logs. Please check the console for details and refresh the page.');
            }
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "order": [[ 0, "desc" ]],
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "language": {
            "processing": "<?php echo lang('loading_usage_logs'); ?>",
            "search": "<?php echo lang('search_usage_logs'); ?>",
            "lengthMenu": "<?php echo lang('show_usage_logs_per_page'); ?>",
            "info": "<?php echo lang('showing_usage_logs'); ?>",
            "infoEmpty": "<?php echo lang('no_usage_logs_found'); ?>",
            "infoFiltered": "<?php echo lang('filtered_usage_logs'); ?>",
            "emptyTable": "<?php echo lang('no_usage_logs_available'); ?>",
            "zeroRecords": "<?php echo lang('no_matching_usage_logs'); ?>"
        },
        "columnDefs": [
            {
                "targets": [6], // Actions column
                "orderable": false,
                "searchable": false
            }
        ]
    }).buttons().container().appendTo('#usageLogsTable_wrapper .col-md-6:eq(0)');
    
    // Initialize Select2 for dropdowns
    $('#inventory_item_id').select2({
        placeholder: "<?php echo lang('select_item'); ?>",
        allowClear: true
    });
    
    $('#used_by_type').select2({
        placeholder: "<?php echo lang('select_used_by_type'); ?>",
        allowClear: true,
        minimumResultsForSearch: Infinity
    });
    
    $('#patient_id').select2({
        placeholder: "<?php echo lang('select_patient'); ?>",
        allowClear: true
    });
    
    $('#doctor_id').select2({
        placeholder: "<?php echo lang('select_doctor'); ?>",
        allowClear: true
    });
    
    $('#department_id').select2({
        placeholder: "<?php echo lang('select_department'); ?>",
        allowClear: true
    });
    

    
    // Handle item selection
    $('#inventory_item_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var stock = selectedOption.data('stock');
        var cost = selectedOption.data('cost');
        var uom = selectedOption.data('uom');
        
        if (stock) {
            $('#available_stock').text(stock);
            $('#available_stock_display').text(stock + (uom ? ' ' + uom : ' units'));
            $('#stock-alert').removeClass('d-none');
        $('#quantity_used').attr('max', stock);
        } else {
            $('#available_stock').text('-');
            $('#available_stock_display').text('-');
            $('#stock-alert').addClass('d-none');
            $('#quantity_used').removeAttr('max');
        }
    });
    
    // Handle used by type change
    $('#used_by_type').change(function() {
        var type = $(this).val();
        
        // Hide all groups using Bootstrap's d-none class
        $('#patient_group, #doctor_group, #department_group').addClass('d-none');
        
        // Show relevant group
        if (type === 'patient') {
            $('#patient_group').removeClass('d-none');
        } else if (type === 'doctor') {
            $('#doctor_group').removeClass('d-none');
        } else if (type === 'department') {
            $('#department_group').removeClass('d-none');
        }
    });
    
    // Enhanced stock validation
    $('#quantity_used').on('input blur', function() {
        var quantity = parseFloat($(this).val());
        var availableStock = parseFloat($('#available_stock').text());
        
        if (quantity && availableStock && quantity > availableStock) {
            $(this).addClass('is-invalid');
            if (!$(this).next('.invalid-feedback').length) {
                $(this).after('<div class="invalid-feedback"><?php echo lang('quantity_exceed_stock'); ?> (' + availableStock + ')</div>');
            }
        } else {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        }
    });
    
    // Reset form when modal is closed
    $('#addUsageModal').on('hidden.bs.modal', function () {
        $('#addUsageForm')[0].reset();
        $('#usage_date').val(new Date().toISOString().slice(0, 16));
        $('#available_stock').text('-');
        $('#available_stock_display').text('-');
        $('#stock-alert').addClass('d-none');
        $('#patient_group, #doctor_group, #department_group').addClass('d-none');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
    });
});
</script>

<!-- View Usage Modal -->
<div class="modal fade" id="viewUsageModal" role="dialog" aria-labelledby="viewUsageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-gradient-info text-white border-0">
                <div class="d-flex align-items-center">
                    <i class="fas fa-eye fa-2x mr-3"></i>
                    <div>
                        <h4 class="modal-title font-weight-bold mb-0" id="viewUsageModalLabel">
                            <?php echo lang('usage_details'); ?>
                        </h4>
                        <small class="opacity-75"><?php echo lang('usage_details'); ?></small>
                    </div>
                </div>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <!-- Content will be loaded via AJAX -->
                <div id="usage-details-content">
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p class="mt-3"><?php echo lang('loading_usage_details'); ?></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light border-0">
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i>
                        <?php echo lang('view_only_mode'); ?>
                    </small>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-2"></i><?php echo lang('close'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Function to view usage in modal
function viewUsage(usageId) {
    // Show loading content
    $('#usage-details-content').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-3"><?php echo lang('loading_usage_details'); ?></p>
        </div>
    `);
    
    // Show modal
    $('#viewUsageModal').modal('show');
    
    // Load usage data via AJAX
    $.ajax({
        url: '<?php echo base_url('inventory/get_usage_view_data'); ?>',
        type: 'POST',
        data: {
            usage_id: usageId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#usage-details-content').html(response.html);
            } else {
                $('#usage-details-content').html(`
                    <div class="alert alert-danger m-4">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <?php echo lang('error_loading_usage_details'); ?>: ${response.message || 'Unknown error'}
                    </div>
                `);
            }
        },
        error: function(xhr, status, error) {
            $('#usage-details-content').html(`
                <div class="alert alert-danger m-4">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <?php echo lang('error_loading_usage_details_try_again'); ?>
                </div>
            `);
            console.error('AJAX Error:', error);
        }
    });
}
</script>