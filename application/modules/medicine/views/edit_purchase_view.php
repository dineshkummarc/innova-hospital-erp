<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-edit text-primary mr-3"></i>
                        <?php echo lang('edit'); ?> <?php echo lang('purchase_order'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine"><?php echo lang('medicine'); ?></a></li>
                            <li class="breadcrumb-item"><a href="medicine/purchases"><?php echo lang('purchases'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('edit'); ?> <?php echo lang('purchase'); ?></li>
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
                                <input type="hidden" name="id" value="<?php echo $purchase->id; ?>">
                                
                                <div class="row">
                                    <!-- Purchase Header Information -->
                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('purchase'); ?> <?php echo lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('purchase_order'); ?> <?php echo lang('no'); ?>. <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-lg" name="purchase_order_no" 
                                                   value="<?php echo $purchase->purchase_order_no; ?>" required="">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('supplier'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg select2" name="supplier_id" required="">
                                                <option value=""><?php echo lang('select'); ?> <?php echo lang('supplier'); ?></option>
                                                <?php foreach ($suppliers as $supplier) { ?>
                                                    <option value="<?php echo $supplier->id; ?>" 
                                                            <?php echo ($supplier->id == $purchase->supplier_id) ? 'selected' : ''; ?>>
                                                        <?php echo $supplier->name . ' - ' . $supplier->company_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('purchase_date'); ?> <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control form-control-lg" name="purchase_date" 
                                                   value="<?php echo $purchase->purchase_date; ?>" required="">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('expected'); ?> <?php echo lang('delivery_date'); ?></label>
                                            <input type="date" class="form-control form-control-lg" name="expected_delivery_date"
                                                   value="<?php echo $purchase->expected_delivery_date; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <h5 class="text-primary mb-3"><i class="fas fa-file-invoice mr-2"></i><?php echo lang('invoice'); ?> <?php echo lang('information'); ?></h5>
                                        
                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('invoice_no'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="invoice_number"
                                                   value="<?php echo $purchase->invoice_number; ?>">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('invoice_date'); ?></label>
                                            <input type="date" class="form-control form-control-lg" name="invoice_date"
                                                   value="<?php echo $purchase->invoice_date; ?>">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('payment_terms'); ?></label>
                                            <input type="text" class="form-control form-control-lg" name="payment_terms" 
                                                   placeholder="<?php echo lang('eg'); ?> <?php echo lang('net'); ?> 30 <?php echo lang('days'); ?>" value="<?php echo $purchase->payment_terms; ?>">
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="text-uppercase text-sm"><?php echo lang('notes'); ?></label>
                                            <textarea class="form-control form-control-lg" name="notes" rows="3" 
                                                      placeholder="<?php echo lang('additional_notes_or_instructions'); ?>"><?php echo $purchase->notes; ?></textarea>
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
                                                        <th><?php echo lang('unit_cost'); ?></th>
                                                        <th><?php echo lang('total'); ?></th>
                                                        <th><?php echo lang('batch_number'); ?></th>
                                                        <th><?php echo lang('expiry_date'); ?></th>
                                                        <th><?php echo lang('action'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="purchaseItemsBody">
                                                    <?php if (!empty($purchase_items)) { ?>
                                                        <?php foreach ($purchase_items as $index => $item) { ?>
                                                            <tr>
                                                                <td>
                                                                    <select class="form-control select2" name="medicine_id[]" required="">
                                                                        <option value=""><?php echo lang('select'); ?> <?php echo lang('medicine'); ?></option>
                                                                        <?php foreach ($medicines as $medicine) { ?>
                                                                            <option value="<?php echo $medicine->id; ?>" 
                                                                                    <?php echo ($medicine->id == $item->medicine_id) ? 'selected' : ''; ?>>
                                                                                <?php echo $medicine->name . ' - ' . $medicine->generic; ?>
                                                                            </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="number" class="form-control quantity" name="quantity[]" 
                                                                           min="1" required="" value="<?php echo $item->quantity_ordered; ?>" 
                                                                           onchange="calculateRowTotal(this)">
                                                                </td>
                                                                <td>
                                                                    <input type="number" step="0.01" class="form-control unit-cost" name="unit_cost[]" 
                                                                           min="0" required="" value="<?php echo $item->unit_cost; ?>" 
                                                                           onchange="calculateRowTotal(this)">
                                                                </td>
                                                                <td>
                                                                    <input type="number" step="0.01" class="form-control row-total" 
                                                                           readonly="" value="<?php echo $item->total_cost; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="batch_number[]" 
                                                                           placeholder="<?php echo lang('batch_number'); ?>" value="<?php echo $item->batch_number; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="date" class="form-control" name="expiry_date[]"
                                                                           value="<?php echo $item->expiry_date; ?>">
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } else { ?>
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
                                                                       placeholder="<?php echo lang('batch_number'); ?>">
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
                                                    <?php } ?>
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
                                                        <?php echo $settings->currency; ?><span id="subtotal"><?php echo number_format($purchase->total_amount, 2); ?></span>
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label><?php echo lang('transport_charges'); ?>:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" step="0.01" class="form-control form-control-sm text-right" 
                                                               name="transport_charges" value="<?php echo $purchase->transport_charges; ?>" onchange="calculateTotal()">
                                                    </div>
                                                </div>

                                                <div class="row mb-2">
                                                    <div class="col-6">
                                                        <label><?php echo lang('other_charges'); ?>:</label>
                                                    </div>
                                                    <div class="col-6">
                                                        <input type="number" step="0.01" class="form-control form-control-sm text-right" 
                                                               name="other_charges" value="<?php echo $purchase->other_charges; ?>" onchange="calculateTotal()">
                                                    </div>
                                                </div>

                                                <hr>
                                                <div class="row mb-2">
                                                    <div class="col-6"><strong><?php echo lang('total_amount'); ?>:</strong></div>
                                                    <div class="col-6 text-right">
                                                        <strong><?php echo $settings->currency; ?><span id="totalAmount"><?php echo number_format($purchase->net_amount, 2); ?></span></strong>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" name="submit" class="btn btn-primary btn-lg px-5">
                                        <i class="fas fa-save mr-2"></i><?php echo lang('update'); ?> <?php echo lang('purchase_order'); ?>
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
