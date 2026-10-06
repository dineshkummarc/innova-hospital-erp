<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-plus-circle text-primary mr-3"></i>
                        <?php echo lang('log_usage') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/usage"><?php echo lang('usage_logs'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('add_new'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/usage" class="btn btn-secondary btn-sm px-4 py-3">
                        <i class="fa fa-arrow-left"></i> <?php echo lang('back'); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('log_usage'); ?></h3>
                        </div>
                        <div class="card-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            
                            <form action="inventory/usage/add" method="post">
                                <div class="row">
                                    <!-- Item Information -->
                                    <div class="col-md-6">
                                        <h5 class="mb-3"><i class="fas fa-box mr-2"></i><?php echo lang('item_information'); ?></h5>
                                        
                                        <div class="form-group">
                                            <label for="inventory_item_id"><?php echo lang('inventory_item'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="inventory_item_id" id="inventory_item_id" required>
                                                <option value=""><?php echo lang('select') . ' ' . lang('item'); ?></option>
                                                <?php foreach ($inventory_items as $item) { ?>
                                                    <option value="<?php echo $item->id; ?>" data-stock="<?php echo $item->current_stock; ?>" data-cost="<?php echo $item->unit_cost; ?>" data-uom="<?php echo $item->unit_of_measure; ?>">
                                                        <?php echo $item->name; ?> (<?php echo $item->item_code; ?>) - Stock: <?php echo $item->current_stock; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="quantity_used"><?php echo lang('quantity_used'); ?> <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="quantity_used" id="quantity_used" min="1" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="unit_display">Units</span>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Available stock: <span id="available_stock">-</span></small>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="usage_date"><?php echo lang('usage_date'); ?> <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="usage_date" id="usage_date" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="purpose"><?php echo lang('purpose'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="purpose" id="purpose" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Usage Details -->
                                    <div class="col-md-6">
                                        <h5 class="mb-3"><i class="fas fa-user mr-2"></i><?php echo lang('usage_details'); ?></h5>
                                        
                                        <div class="form-group">
                                            <label for="used_by_type"><?php echo lang('used_by_type'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="used_by_type" id="used_by_type" required>
                                                <option value=""><?php echo lang('select') . ' ' . lang('type'); ?></option>
                                                <option value="patient">Patient</option>
                                                <option value="doctor">Doctor</option>
                                                <option value="nurse">Nurse</option>
                                                <option value="department">Department</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" id="patient_group" style="display: none;">
                                            <label for="patient_id"><?php echo lang('patient'); ?></label>
                                            <select class="form-control select2" name="patient_id" id="patient_id">
                                                <option value=""><?php echo lang('select') . ' ' . lang('patient'); ?></option>
                                                <?php foreach ($patients as $patient) { ?>
                                                    <option value="<?php echo $patient->id; ?>">
                                                        <?php echo $patient->name; ?> (ID: <?php echo $patient->patient_id; ?>)
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" id="doctor_group" style="display: none;">
                                            <label for="doctor_id"><?php echo lang('doctor'); ?></label>
                                            <select class="form-control select2" name="doctor_id" id="doctor_id">
                                                <option value=""><?php echo lang('select') . ' ' . lang('doctor'); ?></option>
                                                <?php foreach ($doctors as $doctor) { ?>
                                                    <option value="<?php echo $doctor->id; ?>">
                                                        <?php echo $doctor->name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group" id="department_group" style="display: none;">
                                            <label for="department_id"><?php echo lang('department'); ?></label>
                                            <select class="form-control select2" name="department_id" id="department_id">
                                                <option value=""><?php echo lang('select') . ' ' . lang('department'); ?></option>
                                                <?php foreach ($departments as $department) { ?>
                                                    <option value="<?php echo $department->id; ?>">
                                                        <?php echo $department->name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="batch_number"><?php echo lang('batch_number'); ?></label>
                                            <input type="text" class="form-control" name="batch_number" id="batch_number">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="expiry_date"><?php echo lang('expiry_date'); ?></label>
                                            <input type="date" class="form-control" name="expiry_date" id="expiry_date">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="notes"><?php echo lang('notes'); ?></label>
                                            <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cost Information -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            <h6><i class="fas fa-calculator mr-2"></i><?php echo lang('cost_information'); ?></h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong><?php echo lang('unit_cost'); ?>:</strong> 
                                                    <span id="unit_cost_display"><?php echo $settings->currency; ?> 0.00</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong><?php echo lang('quantity'); ?>:</strong> 
                                                    <span id="quantity_display">0</span>
                                                </div>
                                                <div class="col-md-4">
                                                    <strong><?php echo lang('total_cost'); ?>:</strong> 
                                                    <span id="total_cost_display"><?php echo $settings->currency; ?> 0.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" name="submit" class="btn btn-success btn-lg px-5">
                                                <i class="fas fa-save mr-2"></i>
                                                <?php echo lang('save'); ?>
                                            </button>
                                            <a href="inventory/usage" class="btn btn-secondary btn-lg px-5 ml-3">
                                                <i class="fas fa-times mr-2"></i>
                                                <?php echo lang('cancel'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    $('.select2').select2();
    
    // Handle item selection
    $('#inventory_item_id').change(function() {
        var selectedOption = $(this).find('option:selected');
        var stock = selectedOption.data('stock');
        var cost = selectedOption.data('cost');
        var uom = selectedOption.data('uom');
        
        $('#available_stock').text(stock || '-');
        $('#unit_cost_display').text('<?php echo $settings->currency; ?> ' + (cost || '0.00'));
        $('#unit_display').text(uom || 'Units');
        
        // Set max quantity
        $('#quantity_used').attr('max', stock);
        
        calculateTotal();
    });
    
    // Handle quantity change
    $('#quantity_used').on('input', function() {
        calculateTotal();
    });
    
    // Handle used by type change
    $('#used_by_type').change(function() {
        var type = $(this).val();
        
        // Hide all groups
        $('#patient_group, #doctor_group, #department_group').hide();
        
        // Show relevant group
        if (type === 'patient') {
            $('#patient_group').show();
        } else if (type === 'doctor') {
            $('#doctor_group').show();
        } else if (type === 'department') {
            $('#department_group').show();
        }
    });
    
    function calculateTotal() {
        var quantity = parseFloat($('#quantity_used').val()) || 0;
        var unitCost = parseFloat($('#inventory_item_id').find('option:selected').data('cost')) || 0;
        var total = quantity * unitCost;
        
        $('#quantity_display').text(quantity);
        $('#total_cost_display').text('<?php echo $settings->currency; ?> ' + total.toFixed(2));
    }
    
    // Validate stock
    $('#quantity_used').on('blur', function() {
        var quantity = parseFloat($(this).val());
        var availableStock = parseFloat($('#available_stock').text());
        
        if (quantity > availableStock) {
            alert('Quantity cannot exceed available stock (' + availableStock + ')');
            $(this).val(availableStock);
            calculateTotal();
        }
    });
});
</script>