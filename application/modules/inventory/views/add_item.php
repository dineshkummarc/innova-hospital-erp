<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-plus-circle text-primary mr-3"></i>
                        <?php echo lang('add_inventory_item') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory/items"><?php echo lang('items'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('add_new'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="inventory/items" class="btn btn-secondary btn-sm px-4 py-3">
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
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('add_inventory_item'); ?></h3>
                        </div>
                        <div class="card-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            
                            <form action="inventory/add_item" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <!-- Basic Information -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="item_code"><?php echo lang('item_code'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="item_code" id="item_code" 
                                                   value="<?php echo $generated_code; ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="name"><?php echo lang('name'); ?> <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="description"><?php echo lang('description'); ?></label>
                                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="category"><?php echo lang('category'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="category" id="category" required>
                                                <option value=""><?php echo lang('select') . ' ' . lang('category'); ?></option>
                                                <?php foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category->name; ?>"><?php echo $category->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="subcategory"><?php echo lang('subcategory'); ?></label>
                                            <input type="text" class="form-control" name="subcategory" id="subcategory">
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
                                        <div class="form-group">
                                            <label for="current_stock"><?php echo lang('current_stock'); ?></label>
                                            <input type="number" class="form-control" name="current_stock" id="current_stock" value="0" min="0">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="minimum_stock"><?php echo lang('minimum_stock'); ?></label>
                                            <input type="number" class="form-control" name="minimum_stock" id="minimum_stock" value="0" min="0">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="maximum_stock"><?php echo lang('maximum_stock'); ?></label>
                                            <input type="number" class="form-control" name="maximum_stock" id="maximum_stock" value="0" min="0">
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
                                            <label for="selling_price"><?php echo lang('selling_price'); ?> (<?php echo $settings->currency; ?>)</label>
                                            <input type="number" class="form-control" name="selling_price" id="selling_price" step="0.01" min="0">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Additional Information -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="storage_location"><?php echo lang('storage_location'); ?></label>
                                            <input type="text" class="form-control" name="storage_location" id="storage_location">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="barcode"><?php echo lang('barcode'); ?></label>
                                            <input type="text" class="form-control" name="barcode" id="barcode">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="manufacturer"><?php echo lang('manufacturer'); ?></label>
                                            <input type="text" class="form-control" name="manufacturer" id="manufacturer">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="brand"><?php echo lang('brand'); ?></label>
                                            <input type="text" class="form-control" name="brand" id="brand">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="model_number"><?php echo lang('model_number'); ?></label>
                                            <input type="text" class="form-control" name="model_number" id="model_number">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="specifications"><?php echo lang('specifications'); ?></label>
                                            <textarea class="form-control" name="specifications" id="specifications" rows="3"></textarea>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="expiry_tracking"><?php echo lang('expiry_tracking'); ?></label>
                                            <select class="form-control" name="expiry_tracking" id="expiry_tracking">
                                                <option value="no">No</option>
                                                <option value="yes">Yes</option>
                                            </select>
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
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group text-center">
                                            <button type="submit" name="submit" class="btn btn-success btn-lg px-5">
                                                <i class="fas fa-save mr-2"></i>
                                                <?php echo lang('save'); ?>
                                            </button>
                                            <a href="inventory/items" class="btn btn-secondary btn-lg px-5 ml-3">
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
    
    // Auto-generate item code if needed
    $('#category').change(function() {
        var category = $(this).val();
        if (category) {
            var prefix = category.substring(0, 3).toUpperCase();
            // You could make an AJAX call to generate a unique code here
        }
    });
});
</script>