<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-shopping-cart text-primary mr-3"></i>
                        <?php echo lang('create'); ?> <?php echo lang('purchase_order'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/purchases"><?php echo lang('purchases'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('create'); ?> <?php echo lang('purchase'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-5">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="medicine/addNewPurchase" method="post" id="purchaseForm">
                                <div class="row">
                                    <!-- Purchase Header Information -->
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('purchase'); ?> <?php echo lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('purchase_order'); ?> <?php echo lang('no'); ?>. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" name="purchase_order_no" 
                                                   value="PO-<?php echo date('Ymd'); ?>-<?php echo rand(1000, 9999); ?>" required="">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('supplier'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg select2" name="supplier_id" required="">
                                                <option value=""><?php echo lang('select'); ?> <?php echo lang('supplier'); ?></option>
                                                <?php foreach ($suppliers as $supplier) { ?>
                                                    <option value="<?php echo $supplier->id; ?>">
                                                        <?php echo $supplier->name . ' - ' . $supplier->company_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('purchase_date'); ?> <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="purchase_date" 
                                                   value="<?php echo date('Y-m-d'); ?>" required="">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('expected'); ?> <?php echo lang('delivery'); ?> <?php echo lang('date'); ?></label>
                                            <input type="date" class="form-control form-control-lg" name="expected_delivery_date">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-file-invoice mr-2"></i><?php echo lang('invoice'); ?> <?php echo lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('invoice'); ?> <?php echo lang('number'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="invoice_number">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('invoice'); ?> <?php echo lang('date'); ?></label>
                                            <input type="date" class="form-control form-control-lg" name="invoice_date">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('payment'); ?> <?php echo lang('terms'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="payment_terms" 
                                                   placeholder="<?php echo lang('eg'); ?>, Net 30 <?php echo lang('days'); ?>">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('notes'); ?></label>
                                            <textarea class="form-control form-control-lg" name="notes" rows="3" 
                                                      placeholder="<?php echo lang('additional'); ?> <?php echo lang('notes'); ?> <?php echo lang('or'); ?> <?php echo lang('instructions'); ?>"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchase Items Section -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h5 class="text-primary mb-3"><i class="fas fa-list mr-2"></i><?php echo lang('purchase'); ?> <?php echo lang('items'); ?></h5>
                                        
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="purchaseItemsTable">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th><?php echo lang('medicine'); ?></th>
                                                        <th><?php echo lang('quantity'); ?></th>
                                                        <th><?php echo lang('unit'); ?> <?php echo lang('cost'); ?></th>
                                                        <th><?php echo lang('total'); ?></th>
                                                        <th><?php echo lang('batch'); ?> <?php echo lang('number'); ?></th>
                                                        <th><?php echo lang('expiry'); ?> <?php echo lang('date'); ?></th>
                                                        <th><?php echo lang('action'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="purchaseItemsBody">
                                                    <tr>
                                                        <td>
                                                            <select class="form-control select2" name="medicine_id[]" required="">
                                                                <option value=""><?php echo lang('select'); ?> <?php echo lang('medicine'); ?></option>
                                                                <?php foreach ($medicines as $medicine) { ?>
                                                                    <option value="<?php echo $medicine->id; ?>">
                                                                        <?php echo $medicine->name . ' - ' . $medicine->generic; ?>
                                                                    </option>
                                                                <?php } ?>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control quantity" name="quantity[]" 
                                                                   min="1" required="" onchange="calculateRowTotal(this)">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" class="form-control unit-cost" name="unit_cost[]" 
                                                                   min="0" required="" onchange="calculateRowTotal(this)">
                                                        </td>
                                                        <td>
                                                            <input type="number" step="0.01" class="form-control row-total" 
                                                                   readonly="" value="0.00">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="batch_number[]" 
                                                                   placeholder="<?php echo lang('batch'); ?> <?php echo lang('number'); ?>">
                                                        </td>
                                                        <td>
                                                            <input type="date" class="form-control" name="expiry_date[]">
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-success" onclick="addRow()">
                                                <i class="fas fa-plus mr-2"></i><?php echo lang('add'); ?> <?php echo lang('item'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Purchase Summary -->
                                <div class="row mt-4">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h6 class="card-title"><?php echo lang('purchase'); ?> <?php echo lang('summary'); ?></h6>
                                                
                                                <div class="row mb-2">
                                                    <div class="col-6"><?php echo lang('subtotal'); ?>:</div>
                                                    <div class="col-6 text-right">
                                                        <?php echo $settings->currency; ?><span id="subtotal">0.00</span>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label><?php echo lang('transport'); ?> <?php echo lang('charges'); ?>:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" step="0.01" class="form-control form-control-sm text-right" 
                                                               name="transport_charges" value="0.00" onchange="calculateTotal()">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label><?php echo lang('other'); ?> <?php echo lang('charges'); ?>:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" step="0.01" class="form-control form-control-sm text-right" 
                                                               name="other_charges" value="0.00" onchange="calculateTotal()">
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row mb-2">
                                                    <div class="col-6"><strong><?php echo lang('total'); ?> <?php echo lang('amount'); ?>:</strong></div>
                                                    <div class="col-6 text-right">
                                                        <strong><?php echo $settings->currency; ?><span id="totalAmount">0.00</span></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save mr-2"></i><?php echo lang('create'); ?> <?php echo lang('purchase_order'); ?>
                                    </button>
                                    <a href="medicine/purchases" class="btn btn-secondary btn-lg px-5 ml-3">
                                        <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
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
function addRow() {
    const tbody = document.getElementById('purchaseItemsBody');
    const newRow = tbody.rows[0].cloneNode(true);
    
    // Clear the values in the new row
    const inputs = newRow.querySelectorAll('input, select');
    inputs.forEach(input => {
        if (input.type === 'number') {
            input.value = '';
        } else if (input.tagName === 'SELECT') {
            input.selectedIndex = 0;
        } else {
            input.value = '';
        }
    });
    
    // Clear readonly fields
    newRow.querySelector('.row-total').value = '0.00';
    
    tbody.appendChild(newRow);
}

function removeRow(button) {
    const tbody = document.getElementById('purchaseItemsBody');
    if (tbody.rows.length > 1) {
        button.closest('tr').remove();
        calculateTotal();
    }
}

function calculateRowTotal(input) {
    const row = input.closest('tr');
    const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
    const unitCost = parseFloat(row.querySelector('.unit-cost').value) || 0;
    const total = quantity * unitCost;
    
    row.querySelector('.row-total').value = total.toFixed(2);
    calculateTotal();
}

function calculateTotal() {
    let subtotal = 0;
    const rowTotals = document.querySelectorAll('.row-total');
    
    rowTotals.forEach(total => {
        subtotal += parseFloat(total.value) || 0;
    });
    
    const transportCharges = parseFloat(document.querySelector('input[name="transport_charges"]').value) || 0;
    const otherCharges = parseFloat(document.querySelector('input[name="other_charges"]').value) || 0;
    const totalAmount = subtotal + transportCharges + otherCharges;
    
    document.getElementById('subtotal').textContent = subtotal.toFixed(2);
    document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
}

// Initialize calculation on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateTotal();
});
</script>

<!--main content end-->
<!--footer start-->
