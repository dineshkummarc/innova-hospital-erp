<div class="content-wrapper bg-gradient-light" style="min-height: 2726.9px;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-shopping-cart text-primary mr-3"></i>
                        <?php echo lang('purchase_orders') ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="inventory"><?php echo lang('inventory'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('purchase_orders'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-6 text-right">
                    <a data-toggle="modal" href="#addPurchaseOrderModal" class="btn btn-success btn-sm px-4 py-3">
                        <i class="fa fa-plus-circle"></i> <?php echo lang('create_purchase_order'); ?>
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
                        <div class="card-header">
                            <h3 class="card-title text-black font-weight-800"><?php echo lang('all') . ' ' . lang('purchase_orders'); ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body bg-light">
                            <div class="table-responsive">
                                <table class="table table-hover" id="purchaseOrdersTable">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('po_number'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('supplier_name'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('order_date'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('expected_delivery_date'); ?></th>
                                            <th class="font-weight-bold text-uppercase">Total Quantity</th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('grand_total'); ?></th>
                                            <th class="font-weight-bold text-uppercase"><?php echo lang('status'); ?></th>
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

<!-- Add Purchase Order Modal -->
<div class="modal fade" id="addPurchaseOrderModal" role="dialog" aria-labelledby="addPurchaseOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="addPurchaseOrderModalLabel"><?php echo lang('create_purchase_order'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        
                        <form role="form" action="<?php echo base_url('inventory/add_purchase_order'); ?>" method="post" id="addPurchaseOrderForm">
                            <div class="row">
                                <!-- Order Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('order_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="po_number"><?php echo lang('po_number'); ?></label>
                                        <input type="text" class="form-control" name="po_number" id="po_number" 
                                               value="<?php echo 'PO' . date('YmdHis'); ?>" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="supplier_id"><?php echo lang('supplier_name'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="supplier_id" id="supplier_id" required>
                                            <option value=""><?php echo lang('select') . ' ' . lang('supplier_name'); ?></option>
                                            <?php if (!empty($suppliers)) { ?>
                                                <?php foreach ($suppliers as $supplier) { ?>
                                                    <option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="order_date"><?php echo lang('order_date'); ?> <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="order_date" id="order_date" 
                                               value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                </div>
                                
                                <!-- Delivery Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-truck mr-2"></i><?php echo lang('delivery_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="expected_delivery_date"><?php echo lang('expected_delivery_date'); ?></label>
                                        <input type="date" class="form-control" name="expected_delivery_date" id="expected_delivery_date">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="payment_terms"><?php echo lang('payment_terms'); ?></label>
                                        <select class="form-control" name="payment_terms" id="payment_terms">
                                            <option value="">Select Payment Terms</option>
                                            <option value="Net 30">Net 30 Days</option>
                                            <option value="Net 15">Net 15 Days</option>
                                            <option value="COD">Cash on Delivery</option>
                                            <option value="Advance">Advance Payment</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="notes"><?php echo lang('notes'); ?></label>
                                        <textarea class="form-control" name="notes" id="notes" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Items Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="mb-3"><i class="fas fa-list mr-2"></i>Items to Order</h6>
                                    <div class="card border-secondary">
                                        <div class="card-body p-3">
                                            <div id="purchase-items">
                                                <div class="purchase-item-row mb-3">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Inventory Item <span class="text-danger">*</span></label>
                                                            <select class="form-control select2-inventory-item" name="items[0][inventory_item_id]" required>
                                                                <option value="">Select Item</option>
                                                                <?php if (!empty($inventory_items)) { ?>
                                                                    <?php foreach ($inventory_items as $item) { ?>
                                                                        <option value="<?php echo $item->id; ?>" data-cost="<?php echo $item->unit_cost; ?>">
                                                                            <?php echo $item->name; ?> (<?php echo $item->item_code; ?>)
                                                                        </option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Quantity <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control item-quantity" name="items[0][quantity]" 
                                                                   min="1" value="1" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Unit Price</label>
                                                            <input type="number" class="form-control item-price" name="items[0][unit_price]" 
                                                                   step="0.01" min="0">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>Total</label>
                                                            <input type="text" class="form-control item-total" readonly>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <label>&nbsp;</label>
                                                            <button type="button" class="btn btn-danger btn-sm btn-block remove-item-btn" 
                                                                    style="display: none;">
                                                                <i class="fas fa-trash"></i> Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-secondary btn-sm" id="add-item-btn">
                                                        <i class="fas fa-plus mr-2"></i>Add Another Item
                                                    </button>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <strong>Grand Total: <span id="grand-total">0.00</span></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Hidden fields with default values -->
                            <input type="hidden" name="delivery_address" value="">
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
                <button type="submit" form="addPurchaseOrderForm" name="submit" class="btn btn-success">
                    <i class="fas fa-save mr-2"></i><?php echo lang('create'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Purchase Order Modal -->
<div class="modal fade" id="editPurchaseOrderModal" role="dialog" aria-labelledby="editPurchaseOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="editPurchaseOrderModalLabel"><?php echo lang('edit') . ' ' . lang('purchase_order'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-4">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        
                        <form role="form" action="<?php echo base_url('inventory/edit_purchase_order'); ?>" method="post" id="editPurchaseOrderForm">
                            <input type="hidden" name="purchase_order_id" id="edit_purchase_order_id">
                            
                            <div class="row">
                                <!-- Basic Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-info-circle mr-2"></i><?php echo lang('order_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="edit_po_number"><?php echo lang('po_number'); ?> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="po_number" id="edit_po_number" readonly>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_supplier_id"><?php echo lang('supplier'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="supplier_id" id="edit_supplier_id" required>
                                            <option value="">Select Supplier</option>
                                            <?php if (!empty($suppliers)) { ?>
                                                <?php foreach ($suppliers as $supplier) { ?>
                                                    <option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_order_date"><?php echo lang('order_date'); ?> <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" name="order_date" id="edit_order_date" required>
                                    </div>
                                </div>
                                
                                <!-- Delivery Information -->
                                <div class="col-md-6">
                                    <h6 class="mb-3"><i class="fas fa-truck mr-2"></i><?php echo lang('delivery_information'); ?></h6>
                                    
                                    <div class="form-group">
                                        <label for="edit_expected_delivery_date"><?php echo lang('expected_delivery_date'); ?></label>
                                        <input type="date" class="form-control" name="expected_delivery_date" id="edit_expected_delivery_date">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_payment_terms"><?php echo lang('payment_terms'); ?></label>
                                        <select class="form-control" name="payment_terms" id="edit_payment_terms">
                                            <option value="">Select Payment Terms</option>
                                            <option value="Net 30">Net 30 Days</option>
                                            <option value="Net 15">Net 15 Days</option>
                                            <option value="COD">Cash on Delivery</option>
                                            <option value="Advance">Advance Payment</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_status"><?php echo lang('status'); ?> <span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" id="edit_status" required>
                                            <option value="draft">Draft</option>
                                            <option value="sent">Sent</option>
                                            <option value="confirmed">Confirmed</option>
                                            <option value="partially_received">Partially Received</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        <small class="form-text text-muted">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Update the purchase order status
                                        </small>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="edit_notes"><?php echo lang('notes'); ?></label>
                                        <textarea class="form-control" name="notes" id="edit_notes" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Items Section -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="mb-3"><i class="fas fa-list mr-2"></i>Items in Order</h6>
                                    <div class="card border-secondary">
                                        <div class="card-body p-3">
                                            <div id="edit-purchase-items">
                                                <!-- Items will be loaded here -->
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="button" class="btn btn-secondary btn-sm" id="edit-add-item-btn">
                                                        <i class="fas fa-plus mr-2"></i>Add Another Item
                                                    </button>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    <strong>Grand Total: <span id="edit-grand-total">0.00</span></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
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
                <button type="submit" form="editPurchaseOrderForm" name="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-2"></i><?php echo lang('update'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Purchase Order Modal -->
<div class="modal fade" id="viewPurchaseOrderModal" role="dialog" aria-labelledby="viewPurchaseOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title font-weight-bold" id="viewPurchaseOrderModalLabel">
                    <i class="fas fa-eye mr-2"></i><?php echo lang('purchase_order_details'); ?>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Purchase Order Information -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-info-circle mr-2"></i><?php echo lang('order_information'); ?></h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('po_number'); ?>:</td>
                                        <td id="view_po_number">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('status'); ?>:</td>
                                        <td><span id="view_status_badge">-</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('order_date'); ?>:</td>
                                        <td id="view_order_date">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('expected_delivery_date'); ?>:</td>
                                        <td id="view_expected_delivery_date">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('payment_terms'); ?>:</td>
                                        <td id="view_payment_terms">-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Supplier Information -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-building mr-2"></i><?php echo lang('supplier_information'); ?></h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('name'); ?>:</td>
                                        <td id="view_supplier_name">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('company'); ?>:</td>
                                        <td id="view_supplier_company">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('contact_person'); ?>:</td>
                                        <td id="view_supplier_contact">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('email'); ?>:</td>
                                        <td id="view_supplier_email">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('phone'); ?>:</td>
                                        <td id="view_supplier_phone">-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-list mr-2"></i><?php echo lang('ordered_items'); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="viewItemsTable">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('item_name'); ?></th>
                                                <th><?php echo lang('item_code'); ?></th>
                                                <th><?php echo lang('quantity_ordered'); ?></th>
                                                <th><?php echo lang('unit_price'); ?></th>
                                                <th><?php echo lang('total_price'); ?></th>
                                                <th><?php echo lang('quantity_received'); ?></th>
                                                <th><?php echo lang('status'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="view_items_tbody"> 
                                            <!-- Items will be populated via AJAX --> 
                                        </tbody>   
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Summary -->
                <div class="row mt-3">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-sticky-note mr-2"></i><?php echo lang('notes'); ?></h6>
                            </div>
                            <div class="card-body">
                                <div id="view_notes" class="text-muted">No notes available</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0"><i class="fas fa-calculator mr-2"></i><?php echo lang('financial_summary'); ?></h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('subtotal'); ?>:</td>
                                        <td id="view_subtotal" class="text-right">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('tax_amount'); ?>:</td>
                                        <td id="view_tax_amount" class="text-right">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('discount'); ?>:</td>
                                        <td id="view_discount_amount" class="text-right">-</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold"><?php echo lang('shipping'); ?>:</td>
                                        <td id="view_shipping_amount" class="text-right">-</td>
                                    </tr>
                                    <tr class="border-top">
                                        <td class="font-weight-bold h5"><?php echo lang('grand_total'); ?>:</td>
                                        <td id="view_grand_total" class="text-right font-weight-bold h5 text-primary">-</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i><?php echo lang('close'); ?>
                </button>
                <a id="view_print_link" href="#" target="_blank" class="btn btn-info">
                    <i class="fas fa-print mr-2"></i><?php echo lang('print'); ?>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
$(document).ready(function() {
    var table = $('#purchaseOrdersTable').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "searchable": true,
        "ajax": {
            "url": "inventory/getPurchaseOrders",
            "type": "POST"
        },
        "scroller": {
            "loadingIndicator": true
        },
        "dom": "<'row mb-3'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4 text-right'f>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "buttons": [
            { "extend": "copyHtml5", "exportOptions": { "columns": [0, 1, 2, 3, 4, 5, 6] } },
            { "extend": "excelHtml5", "exportOptions": { "columns": [0, 1, 2, 3, 4, 5, 6] } },
            { "extend": "csvHtml5", "exportOptions": { "columns": [0, 1, 2, 3, 4, 5, 6] } },
            { "extend": "pdfHtml5", "exportOptions": { "columns": [0, 1, 2, 3, 4, 5, 6] } },
            { "extend": "print", "exportOptions": { "columns": [0, 1, 2, 3, 4, 5, 6] } }
        ],
        "aLengthMenu": [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        "iDisplayLength": 25,
        "order": [[ 0, "desc" ]], // Most recent purchase orders first (by PO number which contains timestamp)
        "language": {
            "lengthMenu": "_MENU_",
            "search": "_INPUT_",
            "searchPlaceholder": "Search purchase orders..."
        }
    });
    table.buttons().container().appendTo('#purchaseOrdersTable_wrapper .col-md-6:eq(0)');
    
    // Initialize Select2 for supplier dropdown
    $('#supplier_id').select2({
        placeholder: "Select Supplier",
        allowClear: true,
        dropdownParent: $('#addPurchaseOrderModal')
    });

    // Initialize Select2 for payment terms
    $('#payment_terms').select2({
        placeholder: "Select Payment Terms",
        allowClear: true,
        dropdownParent: $('#addPurchaseOrderModal')
    });

    // Initialize Select2 for inventory items
    $('.select2-inventory-item').select2({
        placeholder: "Select Item",
        allowClear: true,
        dropdownParent: $('#addPurchaseOrderModal')
    });

    // Initialize Select2 for edit modal
    $('#edit_supplier_id').select2({
        placeholder: "Select Supplier",
        allowClear: true,
        dropdownParent: $('#editPurchaseOrderModal')
    });

    $('#edit_payment_terms').select2({
        placeholder: "Select Payment Terms",
        allowClear: true,
        dropdownParent: $('#editPurchaseOrderModal')
    });

    // Reset form when modal is closed
    $('#addPurchaseOrderModal').on('hidden.bs.modal', function () {
        $('#addPurchaseOrderForm')[0].reset();
        $('#supplier_id').val(null).trigger('change');
        $('#payment_terms').val(null).trigger('change');
        $('.select2-inventory-item').val(null).trigger('change');
        // Reset to one item row
        resetPurchaseItems();
        // Generate new PO number
        $('#po_number').val('PO' + new Date().getTime());
        $('#order_date').val(new Date().toISOString().split('T')[0]);
    });

    // Add item button
    $('#add-item-btn').click(function() {
        addPurchaseItem();
    });

    // Handle item selection change (auto-fill unit price)
    $(document).on('change', '.select2-inventory-item', function() {
        var selectedOption = $(this).find('option:selected');
        var unitCost = selectedOption.data('cost') || 0;
        var row = $(this).closest('.purchase-item-row');
        row.find('.item-price').val(unitCost);
        calculateItemTotal(row);
    });

    // Handle quantity or price changes
    $(document).on('input', '.item-quantity, .item-price', function() {
        var row = $(this).closest('.purchase-item-row');
        calculateItemTotal(row);
    });

    // Remove item button
    $(document).on('click', '.remove-item-btn', function() {
        $(this).closest('.purchase-item-row').remove();
        updateRemoveButtons();
        calculateGrandTotal();
    });

    // Reset edit form when modal is closed
    $('#editPurchaseOrderModal').on('hidden.bs.modal', function () {
        $('#editPurchaseOrderForm')[0].reset();
        $('#edit_supplier_id').val(null).trigger('change');
        $('#edit_payment_terms').val(null).trigger('change');
        $('#edit-purchase-items').html('');
        $('#edit-grand-total').text('0.00');
    });

    // Edit modal add item button
    $('#edit-add-item-btn').click(function() {
        addEditPurchaseItem();
    });

    // Handle edit modal item changes
    $(document).on('change', '.edit-select2-inventory-item', function() {
        var selectedOption = $(this).find('option:selected');
        var unitCost = selectedOption.data('cost') || 0;
        var row = $(this).closest('.edit-purchase-item-row');
        row.find('.edit-item-price').val(unitCost);
        calculateEditItemTotal(row);
    });

    $(document).on('input', '.edit-item-quantity, .edit-item-price', function() {
        var row = $(this).closest('.edit-purchase-item-row');
        calculateEditItemTotal(row);
    });

    $(document).on('click', '.edit-remove-item-btn', function() {
        $(this).closest('.edit-purchase-item-row').remove();
        updateEditRemoveButtons();
        calculateEditGrandTotal();
    });
});

// Purchase order item management functions
let itemIndex = 0;

function addPurchaseItem() {
    itemIndex++;
    const itemHtml = `
        <div class="purchase-item-row mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label>Inventory Item <span class="text-danger">*</span></label>
                    <select class="form-control select2-inventory-item" name="items[${itemIndex}][inventory_item_id]" required>
                        <option value="">Select Item</option>
                        <?php if (!empty($inventory_items)) { ?>
                            <?php foreach ($inventory_items as $item) { ?>
                                <option value="<?php echo $item->id; ?>" data-cost="<?php echo $item->unit_cost; ?>">
                                    <?php echo $item->name; ?> (<?php echo $item->item_code; ?>)
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control item-quantity" name="items[${itemIndex}][quantity]" 
                           min="1" value="1" required>
                </div>
                <div class="col-md-2">
                    <label>Unit Price</label>
                    <input type="number" class="form-control item-price" name="items[${itemIndex}][unit_price]" 
                           step="0.01" min="0">
                </div>
                <div class="col-md-2">
                    <label>Total</label>
                    <input type="text" class="form-control item-total" readonly>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-sm btn-block remove-item-btn">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        </div>
    `;
    
    $('#purchase-items').append(itemHtml);
    
    // Initialize Select2 for new item
    $('#purchase-items').find('.select2-inventory-item').last().select2({
        placeholder: "Select Item",
        allowClear: true,
        dropdownParent: $('#addPurchaseOrderModal')
    });
    
    updateRemoveButtons();
}

function resetPurchaseItems() {
    itemIndex = 0;
    $('#purchase-items').html(`
        <div class="purchase-item-row mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label>Inventory Item <span class="text-danger">*</span></label>
                    <select class="form-control select2-inventory-item" name="items[0][inventory_item_id]" required>
                        <option value="">Select Item</option>
                        <?php if (!empty($inventory_items)) { ?>
                            <?php foreach ($inventory_items as $item) { ?>
                                <option value="<?php echo $item->id; ?>" data-cost="<?php echo $item->unit_cost; ?>">
                                    <?php echo $item->name; ?> (<?php echo $item->item_code; ?>)
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control item-quantity" name="items[0][quantity]" 
                           min="1" value="1" required>
                </div>
                <div class="col-md-2">
                    <label>Unit Price</label>
                    <input type="number" class="form-control item-price" name="items[0][unit_price]" 
                           step="0.01" min="0">
                </div>
                <div class="col-md-2">
                    <label>Total</label>
                    <input type="text" class="form-control item-total" readonly>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-sm btn-block remove-item-btn" style="display: none;">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        </div>
    `);
    
    // Re-initialize Select2 for reset item
    $('.select2-inventory-item').select2({
        placeholder: "Select Item",
        allowClear: true,
        dropdownParent: $('#addPurchaseOrderModal')
    });
    
    calculateGrandTotal();
}

function updateRemoveButtons() {
    const itemRows = $('.purchase-item-row');
    if (itemRows.length > 1) {
        $('.remove-item-btn').show();
    } else {
        $('.remove-item-btn').hide();
    }
}

function calculateItemTotal(row) {
    const quantity = parseFloat(row.find('.item-quantity').val()) || 0;
    const price = parseFloat(row.find('.item-price').val()) || 0;
    const total = quantity * price;
    row.find('.item-total').val(total.toFixed(2));
    calculateGrandTotal();
}

function calculateGrandTotal() {
    let grandTotal = 0;
    $('.item-total').each(function() {
        const total = parseFloat($(this).val()) || 0;
        grandTotal += total;
    });
    $('#grand-total').text(grandTotal.toFixed(2));
}

// Edit modal functions
let editItemIndex = 0;

function loadPurchaseOrderData(poId) {
    // Use AJAX to fetch purchase order data
    $.ajax({
        url: 'inventory/getPurchaseOrderData/' + poId,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Populate basic fields
            $('#edit_purchase_order_id').val(data.po.id);
            $('#edit_po_number').val(data.po.po_number);
            $('#edit_supplier_id').val(data.po.supplier_id).trigger('change');
            $('#edit_order_date').val(data.po.order_date);
            $('#edit_expected_delivery_date').val(data.po.expected_delivery_date);
            $('#edit_payment_terms').val(data.po.payment_terms).trigger('change');
            $('#edit_status').val(data.po.status).trigger('change');
            $('#edit_notes').val(data.po.notes);
            
            // Load items
            loadEditPurchaseItems(data.items);
        },
        error: function() {
            alert('Error loading purchase order data');
        }
    });
}

function loadEditPurchaseItems(items) {
    $('#edit-purchase-items').html('');
    editItemIndex = 0;
    
    if (items && items.length > 0) {
        items.forEach(function(item, index) {
            addEditPurchaseItem(item);
        });
    } else {
        addEditPurchaseItem();
    }
    
    updateEditRemoveButtons();
    calculateEditGrandTotal();
}

// Function to view purchase order in modal
function viewPurchaseOrder(poId) {
    $.ajax({
        url: '<?php echo base_url('inventory/get_purchase_order_view_data'); ?>',
        type: 'POST',
        data: { purchase_order_id: poId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                var data = response.data;
                
                // Populate purchase order information
                $('#view_po_number').text(data.purchase_order.po_number);
                $('#view_status_badge').html(data.purchase_order.status_badge);
                $('#view_order_date').text(data.purchase_order.order_date);
                $('#view_expected_delivery_date').text(data.purchase_order.expected_delivery_date);
                $('#view_payment_terms').text(data.purchase_order.payment_terms);
                $('#view_notes').text(data.purchase_order.notes);
                
                // Populate supplier information
                $('#view_supplier_name').text(data.supplier.name);
                $('#view_supplier_company').text(data.supplier.company_name);
                $('#view_supplier_contact').text(data.supplier.contact_person);
                $('#view_supplier_email').text(data.supplier.email);
                $('#view_supplier_phone').text(data.supplier.phone);
                
                // Populate financial summary
                $('#view_subtotal').text(data.purchase_order.total_amount);
                $('#view_tax_amount').text(data.purchase_order.tax_amount);
                $('#view_discount_amount').text(data.purchase_order.discount_amount);
                $('#view_shipping_amount').text(data.purchase_order.shipping_amount);
                $('#view_grand_total').text(data.purchase_order.grand_total);
                
                // Populate items table
                var itemsHtml = '';
                if (data.items && data.items.length > 0) {
                    data.items.forEach(function(item) {
                        var itemStatus = 'Pending';
                        var statusClass = 'secondary';
                        
                        if (item.quantity_received > 0) {
                            if (item.quantity_received >= item.quantity_ordered) {
                                itemStatus = 'Completed';
                                statusClass = 'success';
                            } else {
                                itemStatus = 'Partially Received';
                                statusClass = 'warning';
                            }
                        }
                        
                        itemsHtml += '<tr>' +
                            '<td>' + (item.item_name || '-') + '</td>' +
                            '<td>' + (item.item_code || '-') + '</td>' +
                            '<td>' + item.quantity_ordered + '</td>' +
                            '<td>' + data.currency + ' ' + parseFloat(item.unit_price).toFixed(2) + '</td>' +
                            '<td>' + data.currency + ' ' + (item.quantity_ordered * item.unit_price).toFixed(2) + '</td>' +
                            '<td>' + (item.quantity_received || 0) + '</td>' +
                            '<td><span class="badge badge-' + statusClass + '">' + itemStatus + '</span></td>' +
                        '</tr>';
                    });
                } else {
                    itemsHtml = '<tr><td colspan="7" class="text-center">No items found</td></tr>';
                }
                
                $('#view_items_tbody').html(itemsHtml);
                
                // Set print link
                $('#view_print_link').attr('href', 'inventory/purchase/print_po/' + data.purchase_order.id);
                
            } else {
                alert('Error loading purchase order data: ' + (response.message || 'Unknown error'));
            }
        },
        error: function(xhr, status, error) {
            alert('Error loading purchase order data. Please try again.');
            console.error('AJAX Error:', error);
        }
    });
}

function addEditPurchaseItem(itemData = null) {
    const itemHtml = `
        <div class="edit-purchase-item-row mb-3">
            <div class="row">
                <div class="col-md-4">
                    <label>Inventory Item <span class="text-danger">*</span></label>
                    <select class="form-control edit-select2-inventory-item" name="items[${editItemIndex}][inventory_item_id]" required>
                        <option value="">Select Item</option>
                        <?php if (!empty($inventory_items)) { ?>
                            <?php foreach ($inventory_items as $item) { ?>
                                <option value="<?php echo $item->id; ?>" data-cost="<?php echo $item->unit_cost; ?>">
                                    <?php echo $item->name; ?> (<?php echo $item->item_code; ?>)
                                </option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Quantity <span class="text-danger">*</span></label>
                    <input type="number" class="form-control edit-item-quantity" name="items[${editItemIndex}][quantity]" 
                           min="1" value="1" required>
                </div>
                <div class="col-md-2">
                    <label>Unit Price</label>
                    <input type="number" class="form-control edit-item-price" name="items[${editItemIndex}][unit_price]" 
                           step="0.01" min="0">
                </div>
                <div class="col-md-2">
                    <label>Total</label>
                    <input type="text" class="form-control edit-item-total" readonly>
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-sm btn-block edit-remove-item-btn">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
            </div>
        </div>
    `;
    
    $('#edit-purchase-items').append(itemHtml);
    
    // Initialize Select2 for new item
    $('#edit-purchase-items').find('.edit-select2-inventory-item').last().select2({
        placeholder: "Select Item",
        allowClear: true,
        dropdownParent: $('#editPurchaseOrderModal')
    });
    
    // If we have item data, populate it
    if (itemData) {
        const row = $('#edit-purchase-items').find('.edit-purchase-item-row').last();
        row.find('.edit-select2-inventory-item').val(itemData.inventory_item_id).trigger('change');
        row.find('.edit-item-quantity').val(itemData.quantity_ordered);
        row.find('.edit-item-price').val(itemData.unit_price);
        calculateEditItemTotal(row);
    }
    
    editItemIndex++;
    updateEditRemoveButtons();
}

function updateEditRemoveButtons() {
    const itemRows = $('.edit-purchase-item-row');
    if (itemRows.length > 1) {
        $('.edit-remove-item-btn').show();
    } else {
        $('.edit-remove-item-btn').hide();
    }
}

function calculateEditItemTotal(row) {
    const quantity = parseFloat(row.find('.edit-item-quantity').val()) || 0;
    const price = parseFloat(row.find('.edit-item-price').val()) || 0;
    const total = quantity * price;
    row.find('.edit-item-total').val(total.toFixed(2));
    calculateEditGrandTotal();
}

function calculateEditGrandTotal() {
    let grandTotal = 0;
    $('.edit-item-total').each(function() {
        const total = parseFloat($(this).val()) || 0;
        grandTotal += total;
    });
    $('#edit-grand-total').text(grandTotal.toFixed(2));
}
</script>