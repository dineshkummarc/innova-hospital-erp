<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-edit text-primary mr-3"></i>
                        <?php echo lang('edit_usage') ?: 'Edit Usage Log'; ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/usage"><?php echo lang('usage_logs'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('edit_usage'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/usage" class="btn btn-secondary btn-sm px-4 py-3">
                        <i class="fa fa-arrow-left"></i> <?php echo lang('back_to_usage_logs') ?: 'Back to Usage Logs'; ?>
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

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title text-white font-weight-800">
                                <i class="fas fa-edit mr-2"></i><?php echo lang('edit_usage_log') ?: 'Edit Usage Log'; ?>
                            </h3>
                        </div>

                        <div class="card-body bg-light">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissible fade show"><button type="button" class="close" data-dismiss="alert">&times;</button>', '</div>'); ?>
                            
                            <form role="form" action="<?php echo base_url('inventory/usage/edit/' . $usage->id); ?>" method="post" id="editUsageForm">
                                <input type="hidden" name="submit" value="1">
                                
                                <div class="row">
                                    <!-- Item Information -->
                                    <div class="col-md-6">
                                        <div class="card border-left-primary mb-4">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-box mr-2"></i><?php echo lang('item_information'); ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="item_name" class="font-weight-bold text-dark">
                                                        <i class="fas fa-cube text-primary mr-2"></i><?php echo lang('item_name'); ?>
                                                    </label>
                                                    <input type="text" class="form-control" value="<?php echo $usage->item_name; ?>" readonly>
                                                    <small class="form-text text-muted">Item: <?php echo $usage->item_code; ?></small>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="quantity_used" class="font-weight-bold text-dark">
                                                        <i class="fas fa-hashtag text-info mr-2"></i><?php echo lang('quantity_used'); ?> 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="number" 
                                                           class="form-control" 
                                                           name="quantity_used" 
                                                           id="quantity_used" 
                                                           value="<?php echo $usage->quantity_used; ?>"
                                                           min="1" 
                                                           required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="usage_date" class="font-weight-bold text-dark">
                                                        <i class="fas fa-calendar-alt text-info mr-2"></i><?php echo lang('usage_date'); ?> 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="datetime-local" 
                                                           class="form-control" 
                                                           name="usage_date" 
                                                           id="usage_date" 
                                                           value="<?php echo date('Y-m-d\TH:i', strtotime($usage->usage_date)); ?>" 
                                                           required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Usage Details -->
                                    <div class="col-md-6">
                                        <div class="card border-left-info mb-4">
                                            <div class="card-header bg-info text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-user-tag mr-2"></i><?php echo lang('usage_details'); ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="used_by_type" class="font-weight-bold text-dark">
                                                        <i class="fas fa-user-check text-success mr-2"></i><?php echo lang('used_by_type'); ?> 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <select class="form-control" name="used_by_type" id="used_by_type" required>
                                                        <option value=""><?php echo lang('select') . ' ' . lang('type'); ?></option>
                                                        <option value="patient" <?php echo ($usage->used_by_type == 'patient') ? 'selected' : ''; ?>>Patient</option>
                                                        <option value="doctor" <?php echo ($usage->used_by_type == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
                                                        <option value="nurse" <?php echo ($usage->used_by_type == 'nurse') ? 'selected' : ''; ?>>Nurse</option>
                                                        <option value="department" <?php echo ($usage->used_by_type == 'department') ? 'selected' : ''; ?>>Department</option>
                                                        <option value="other" <?php echo ($usage->used_by_type == 'other') ? 'selected' : ''; ?>>Other</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="purpose" class="font-weight-bold text-dark">
                                                        <i class="fas fa-bullseye text-warning mr-2"></i><?php echo lang('purpose'); ?> 
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" 
                                                           class="form-control" 
                                                           name="purpose" 
                                                           id="purpose" 
                                                           value="<?php echo $usage->purpose; ?>"
                                                           placeholder="e.g., Patient treatment, Surgery, Emergency care"
                                                           required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="notes" class="font-weight-bold text-dark">
                                                        <i class="fas fa-sticky-note text-warning mr-2"></i><?php echo lang('notes'); ?>
                                                    </label>
                                                    <textarea class="form-control" 
                                                              name="notes" 
                                                              id="notes" 
                                                              rows="3"
                                                              placeholder="Additional notes or comments (optional)"><?php echo $usage->notes; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Cost Information -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card border-left-success">
                                            <div class="card-header bg-success text-white">
                                                <h6 class="card-title mb-0">
                                                    <i class="fas fa-dollar-sign mr-2"></i><?php echo lang('cost_information'); ?>
                                                </h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold text-dark"><?php echo lang('unit_cost'); ?></label>
                                                            <input type="text" class="form-control" value="<?php echo $usage->unit_cost; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold text-dark"><?php echo lang('total_cost'); ?></label>
                                                            <input type="text" class="form-control" value="<?php echo $usage->total_cost; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold text-dark"><?php echo lang('unit_of_measure'); ?></label>
                                                            <input type="text" class="form-control" value="<?php echo $usage->unit_of_measure; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Form Actions -->
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-save mr-2"></i><?php echo lang('update_usage'); ?>
                                        </button>
                                        <a href="inventory/usage" class="btn btn-secondary btn-lg px-5 ml-3">
                                            <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
                                        </a>
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

<script>
$(document).ready(function() {
    // Auto-calculate total cost when quantity changes
    $('#quantity_used').on('input', function() {
        var quantity = parseFloat($(this).val()) || 0;
        var unitCost = parseFloat('<?php echo $usage->unit_cost; ?>') || 0;
        var totalCost = quantity * unitCost;
        
        // Update total cost display (if there's a field for it)
        $('input[name="total_cost"]').val(totalCost.toFixed(2));
    });
});
</script>

