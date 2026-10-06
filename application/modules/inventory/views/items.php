<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-list text-primary mr-3"></i>
                        <?php echo lang('inventory_items') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('items'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#addItemModal" class="btn btn-success btn-sm px-4 py-3">
                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_inventory_item'); ?>
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
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all') . ' ' . lang('inventory_items'); ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="inventoryTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('item_code'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('name'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('category'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('current_stock'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('unit_cost'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('status'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Data will be loaded via AJAX -->
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

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="addItemModalLabel"><?php echo lang('add_inventory_item'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        
                        <form role="form" action="<?php echo base_url('inventory/add_item'); ?>" method="post" enctype="multipart/form-data" id="addItemForm">
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('basic_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="item_code"><?php echo lang('item_code'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="item_code" id="item_code" 
                                               value="<?php echo 'ITM' . date('YmdHis'); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="name"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="name" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="description"><?php echo lang('description'); ?></label>
                                        <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="category"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="category" id="category" required>
                                            <option value=""><?php echo lang('select') . ' ' . lang('category'); ?></option>
                                            <?php if (!empty($categories)) { ?>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="unit_of_measure"><?php echo lang('unit_of_measure'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="unit_of_measure" id="unit_of_measure" required>
                                            <option value="pieces">Pieces</option>
                                            <option value="boxes">Boxes</option>
                                            <option value="bottles">Bottles</option>
                                            <option value="vials">Vials</option>
                                            <option value="kg">Kilograms</option>
                                            <option value="liters">Liters</option>
                                            <option value="meters">Meters</option>
                                            <option value="sets">Sets</option>
                                            <option value="packs">Packs</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Stock & Pricing -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-warehouse mr-2"></i><?php echo lang('stock_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="current_stock"><?php echo lang('current_stock'); ?></label>
                                        <input type="number" class="form-control" name="current_stock" id="current_stock" value="0" readonly>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Stock will be managed through purchase orders only
                                        </small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="reorder_level"><?php echo lang('reorder_level'); ?></label>
                                        <input type="number" class="form-control" name="reorder_level" id="reorder_level" value="0" min="0">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="unit_cost"><?php echo lang('unit_cost'); ?> (<?php echo $settings->currency; ?>)</label>
                                        <input type="number" class="form-control" name="unit_cost" id="unit_cost" step="0.01" min="0">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="manufacturer"><?php echo lang('manufacturer'); ?></label>
                                        <input type="text" class="form-control" name="manufacturer" id="manufacturer">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="status"><?php echo lang('status'); ?></label>
                                        <select class="form-control" name="status" id="status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- Hidden fields with default values -->
                            <input type="hidden" name="subcategory" value="">
                            <input type="hidden" name="minimum_stock" value="0">
                            <input type="hidden" name="maximum_stock" value="0">
                            <input type="hidden" name="selling_price" value="0">
                            <input type="hidden" name="storage_location" value="">
                            <input type="hidden" name="expiry_tracking" value="no">
                            <input type="hidden" name="barcode" value="">
                            <input type="hidden" name="brand" value="">
                            <input type="hidden" name="model_number" value="">
                            <input type="hidden" name="specifications" value="">
                            <!-- Hidden submit field -->
                            <input type="hidden" name="submit" value="1">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
                </button>
                <button type="submit" form="addItemForm" name="submit" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i><?php echo lang('save'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="editItemModalLabel"><?php echo lang('edit') . ' ' . lang('inventory_item'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        
                        <form role="form" action="<?php echo base_url('inventory/edit_item'); ?>" method="post" enctype="multipart/form-data" id="editItemForm">
                            <input type="hidden" name="item_id" id="edit_item_id">
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('basic_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="edit_item_code"><?php echo lang('item_code'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="item_code" id="edit_item_code" required readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_name"><?php echo lang('item_name'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="name" id="edit_name" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_description"><?php echo lang('description'); ?></label>
                                        <textarea class="form-control" name="description" id="edit_description" rows="3"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_category"><?php echo lang('category'); ?></label>
                                        <select class="form-control" name="category" id="edit_category">
                                            <option value=""><?php echo lang('select') . ' ' . lang('category'); ?></option>
                                            <?php if (!empty($categories)) { ?>
                                                <?php foreach ($categories as $cat) { ?>
                                                    <option value="<?php echo $cat->name; ?>"><?php echo $cat->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_unit_of_measure"><?php echo lang('unit_of_measure'); ?></label>
                                        <input type="text" class="form-control" name="unit_of_measure" id="edit_unit_of_measure">
                                    </div>
                                </div>
                                
                                <!-- Stock Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-boxes mr-2"></i><?php echo lang('stock_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="edit_current_stock"><?php echo lang('current_stock'); ?></label>
                                        <input type="number" class="form-control" name="current_stock" id="edit_current_stock" value="0" readonly>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Stock managed through purchase orders and usage only
                                        </small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_minimum_stock"><?php echo lang('minimum_stock'); ?></label>
                                        <input type="number" class="form-control" name="minimum_stock" id="edit_minimum_stock" value="0">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_maximum_stock"><?php echo lang('maximum_stock'); ?></label>
                                        <input type="number" class="form-control" name="maximum_stock" id="edit_maximum_stock" value="0">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_reorder_level"><?php echo lang('reorder_level'); ?></label>
                                        <input type="number" class="form-control" name="reorder_level" id="edit_reorder_level" value="0">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_status"><?php echo lang('status'); ?></label>
                                        <select class="form-control" name="status" id="edit_status">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Cost Information -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-money-bill mr-2"></i><?php echo lang('cost_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="edit_unit_cost"><?php echo lang('unit_cost'); ?></label>
                                        <input type="number" class="form-control" name="unit_cost" id="edit_unit_cost" step="0.01" value="0">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_selling_price"><?php echo lang('selling_price'); ?></label>
                                        <input type="number" class="form-control" name="selling_price" id="edit_selling_price" step="0.01" value="0">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-info mr-2"></i>Additional Info</h6>
                                    
                                    <div class="form-group">
                                        <label for="edit_storage_location"><?php echo lang('storage_location'); ?></label>
                                        <input type="text" class="form-control" name="storage_location" id="edit_storage_location">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_manufacturer"><?php echo lang('manufacturer'); ?></label>
                                        <input type="text" class="form-control" name="manufacturer" id="edit_manufacturer">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hidden fields for optional data -->
                            <input type="hidden" name="subcategory" id="edit_subcategory" value="">
                            <input type="hidden" name="expiry_tracking" id="edit_expiry_tracking" value="no">
                            <input type="hidden" name="barcode" id="edit_barcode" value="">
                            <input type="hidden" name="brand" id="edit_brand" value="">
                            <input type="hidden" name="model_number" id="edit_model_number" value="">
                            <input type="hidden" name="specifications" id="edit_specifications" value="">
                            <!-- Hidden submit field -->
                            <input type="hidden" name="submit" value="1">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
                </button>
                <button type="submit" form="editItemForm" name="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i><?php echo lang('update'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- CSS for Select2 Modal Positioning -->
<style>
.select2-dropdown-modal {
    z-index: 9999 !important;
}

.select2-container--open .select2-dropdown--below {
    z-index: 9999 !important;
}

.select2-container--open .select2-dropdown--above {
    z-index: 9999 !important;
}

/* Ensure Select2 dropdown appears above modal backdrop */
.modal .select2-container {
    z-index: 9999 !important;
}

.modal .select2-dropdown {
    z-index: 9999 !important;
}

/* Fix for Select2 in Bootstrap modals */
.modal {
    z-index: 1050;
}

.modal-backdrop {
    z-index: 1040;
}

.select2-container {
    z-index: 9999 !important;
}


</style>

<script>
$(document).ready(function() {
    $('#inventoryTable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "<?php echo base_url('inventory/getInventoryItemsList'); ?>",
            "type": "POST",
            "error": function(xhr, error, code) {
                console.error('DataTables AJAX Error:', error);
                console.error('Response:', xhr.responseText);
                alert('Error loading inventory items. Please check the console for details and refresh the page.');
            }
        },
        "columns": [
            { "data": 0 }, // Item Code
            { "data": 1 }, // Name
            { "data": 2 }, // Category
            { "data": 3 }, // Current Stock
            { "data": 4 }, // Unit Cost
            { "data": 5 }, // Status
            { "data": 6, "orderable": false } // Actions
        ],
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        "order": [[ 0, "desc" ]] // Most recent items first
    }).buttons().container().appendTo('#inventoryTable_wrapper .col-md-6:eq(0)');
    
    // Initialize Select2 for dropdowns
    $('#category').select2({
        placeholder: "Select Category",
        allowClear: true
    });
    
    $('#edit_category').select2({
        placeholder: "Select Category",
        allowClear: true
    });
    
    $('#status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: "Select Status",
        allowClear: true
    });
    
    $('#edit_status').select2({
        minimumResultsForSearch: Infinity,
        placeholder: "Select Status",
        allowClear: true
    });
    
    // Reset form when modal is closed
    $('#addItemModal').on('hidden.bs.modal', function () {
        $('#addItemForm')[0].reset();
        $('#category').val(null).trigger('change');
        $('#status').val('active').trigger('change');
        // Generate new item code
        $('#item_code').val('ITM' + new Date().getTime());
    });
    
    // Reset edit form when modal is closed
    $('#editItemModal').on('hidden.bs.modal', function () {
        $('#editItemForm')[0].reset();
        $('#edit_category').val(null).trigger('change');
        $('#edit_status').val(null).trigger('change');
    });
    

});

// Function to load item data into edit modal
function loadItemData(id, item_code, name, description, category, subcategory, unit_of_measure, minimum_stock, maximum_stock, reorder_level, current_stock, unit_cost, selling_price, storage_location, expiry_tracking, barcode, manufacturer, brand, model_number, specifications, status) {
    $('#edit_item_id').val(id);
    $('#edit_item_code').val(item_code);
    $('#edit_name').val(name);
    $('#edit_description').val(description);
    $('#edit_category').val(category).trigger('change');
    $('#edit_subcategory').val(subcategory);
    $('#edit_unit_of_measure').val(unit_of_measure);
    $('#edit_minimum_stock').val(minimum_stock);
    $('#edit_maximum_stock').val(maximum_stock);
    $('#edit_reorder_level').val(reorder_level);
    $('#edit_current_stock').val(current_stock);
    $('#edit_unit_cost').val(unit_cost);
    $('#edit_selling_price').val(selling_price);
    $('#edit_storage_location').val(storage_location);
    $('#edit_expiry_tracking').val(expiry_tracking);
    $('#edit_barcode').val(barcode);
    $('#edit_manufacturer').val(manufacturer);
    $('#edit_brand').val(brand);
    $('#edit_model_number').val(model_number);
    $('#edit_specifications').val(specifications);
    $('#edit_status').val(status);
}
</script>