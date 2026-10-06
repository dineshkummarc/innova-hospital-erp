<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper bg-gradient-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-cash-register text-primary mr-3"></i>
                        <?php
                        if (!empty($payment->id)) {
                            echo 'Edit Sale (' . 'Invoice ID: ' . $payment->id . ')';
                        } else {
                            echo 'Pharmacy Point of Sale';
                        }
                        ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item"><a href="finance/pharmacy/payment">Pharmacy</a></li>
                            <li class="breadcrumb-item active">New Sale</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-sm-4 text-right">
                    <div class="alert alert-info mb-0 py-2">
                        <i class="fas fa-info-circle mr-2"></i>
                        <small><strong>FIFO System:</strong> Older batches sold first</small>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <form role="form" id="pharmacySaleForm" action="finance/pharmacy/addPayment" method="post" enctype="multipart/form-data">
                <div class="row">
                    <!-- Left Column - Medicine Selection -->
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-header bg-primary text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">
                                        <i class="fas fa-pills mr-2"></i>Medicine Selection
                                    </h5>
                                    <div class="badge badge-light text-primary">
                                        <i class="fas fa-shopping-cart mr-1"></i>
                                        <span id="itemCount">0</span> items
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Search Section -->
                                <div class="row mb-4">
                                    <div class="col-lg-8">
                                        <label class="font-weight-bold text-dark mb-2">
                                            <i class="fas fa-search mr-1"></i>Search Medicine
                                        </label>
                                        <div class="select2-wrapper" style="position: relative;">
                                            <select id="medicineSearch" class="form-control form-control-lg select2" style="width: 100%;">
                                                <option value="">Type to search medicines...</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="font-weight-bold text-dark mb-2">
                                            <i class="fas fa-tools mr-1"></i>Quick Actions
                                        </label>
                                        <div class="btn-group-vertical w-100" role="group">
                                            <button type="button" class="btn btn-outline-info btn-sm mb-1" onclick="clearSelection()">
                                                <i class="fas fa-broom mr-1"></i>Clear All
                                            </button>
                                            <button type="button" class="btn btn-outline-warning btn-sm" onclick="showExpiringOnly()">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>Show Expiring
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected Items Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover" id="selectedItemsTable">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="font-weight-bold text-uppercase">Medicine</th>
                                                <th class="font-weight-bold text-uppercase">Batch Info</th>
                                                <th class="font-weight-bold text-uppercase text-center">Stock</th>
                                                <th class="font-weight-bold text-uppercase text-center">Qty</th>
                                                <th class="font-weight-bold text-uppercase text-right">Unit Price</th>
                                                <th class="font-weight-bold text-uppercase text-right">Total</th>
                                                <th class="font-weight-bold text-uppercase text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="selectedItemsBody">
                                            <tr id="noItemsRow">
                                                <td colspan="7" class="text-center py-5 text-muted">
                                                    <div class="empty-state">
                                                        <i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i>
                                                        <h5 class="text-muted">No medicines selected</h5>
                                                        <p class="text-muted mb-0">Use the search above to add medicines to your cart</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Sale Summary -->
                    <div class="col-lg-4">


                        <!-- Sale Summary -->
                        <div class="card shadow-lg border-0 mb-4">
                            <div class="card-header bg-success text-white">
                                <h6 class="mb-0">
                                    <i class="fas fa-calculator mr-2"></i>Sale Summary
                                </h6>
                            </div>
                            <div class="card-body">
                                <!-- Subtotal -->
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="font-weight-bold text-dark">Subtotal:</span>
                                    <span class="font-weight-bold text-primary h5 mb-0">
                                        <?php echo $settings->currency; ?><span id="subtotalAmount">0.00</span>
                                    </span>
                                </div>

                                <!-- Discount -->
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-percentage mr-1"></i>Discount
                                    </label>
                                    <input type="number" step="0.01" class="form-control" name="discount" 
                                           id="discountInput" value="<?php
                                           if (!empty($payment->discount)) {
                                               $discount = explode('*', $payment->discount);
                                               echo $discount[0];
                                           } else {
                                               echo '0';
                                           }
                                           ?>" min="0" onchange="calculateTotals()" placeholder="0.00">
                                </div>

                                <!-- Divider -->
                                <hr class="my-3">

                                <!-- Total -->
                                <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light rounded">
                                    <span class="font-weight-bold text-dark h5 mb-0">Total Amount:</span>
                                    <span class="font-weight-bold text-success h4 mb-0">
                                        <?php echo $settings->currency; ?><span id="grandTotal">0.00</span>
                                    </span>
                                </div>

                                <!-- Amount Received -->
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold text-dark mb-2">
                                        <i class="fas fa-money-bill-wave mr-1"></i>Amount Received
                                    </label>
                                    <input type="number" step="0.01" class="form-control" 
                                           name="amount_received" id="amountReceived" min="0" 
                                           value="<?php
                                           if (!empty($payment->amount_received)) {
                                               echo $payment->amount_received;
                                           } else {
                                               echo '';
                                           }
                                           ?>"
                                           onchange="calculateChange()" oninput="calculateChange()" placeholder="0.00">
                                </div>

                                <!-- Change -->
                                <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded change-display">
                                    <span class="font-weight-bold text-dark">Change:</span>
                                    <span class="font-weight-bold h5 mb-0 change-amount">
                                        <?php echo $settings->currency; ?><span id="changeAmount">0.00</span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Stock Alerts -->
                        <div class="card shadow-lg border-0 mb-4" id="stockAlerts" style="display: none;">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Stock Alerts
                                </h6>
                            </div>
                            <div class="card-body" id="stockAlertsBody">
                                <!-- Alerts will be populated here -->
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="card shadow-lg border-0">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success btn-lg btn-block mb-3" id="completeSaleBtn">
                                    <i class="fas fa-check mr-2"></i>Complete Sale
                                </button>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-primary btn-block mb-2" onclick="printEstimate()">
                                            <i class="fas fa-print mr-1"></i>Print
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <a href="finance/pharmacy/payment" class="btn btn-outline-danger btn-block mb-2">
                                            <i class="fas fa-times mr-1"></i>Cancel
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden inputs for form submission -->
                <input type="hidden" name="id" value='<?php
                    if (!empty($payment->id)) {
                        echo $payment->id;
                    }
                ?>'>
                <input type="hidden" name="category_name" id="categoryNameInput">
                <input type="hidden" name="medicine_id" id="medicineIdsInput">
                <input type="hidden" name="quantity" id="quantitiesInput">
            </form>
        </div>
    </section>
</div>

<!-- Medicine Details Modal -->
<div class="modal fade" id="medicineDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-info-circle mr-2"></i>Medicine Details
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="medicineDetailsBody">
                <!-- Details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced Pharmacy POS Styling */
:root {
    --primary-color: #007bff;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --light-bg: #f8f9fa;
    --border-color: #dee2e6;
    --text-primary: #212529;
    --text-secondary: #6c757d;
    --shadow-sm: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    --shadow-md: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    --shadow-lg: 0 1rem 3rem rgba(0, 0, 0, 0.175);
}

/* Select2 Styling */
.select2-container .select2-selection--single {
    height: 48px !important;
    border: 2px solid var(--border-color) !important;
    border-radius: 0.375rem !important;
    background: white !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 44px !important;
    padding-left: 12px !important;
    color: var(--text-primary) !important;
    font-weight: 500;
}

.select2-container--default .select2-selection--single .select2-selection__placeholder {
    color: var(--text-secondary) !important;
    line-height: 44px !important;
    padding-left: 12px !important;
}

/* Aggressive placeholder padding fix */
.select2-container--default .select2-selection--single .select2-selection__rendered,
.select2-container--default .select2-selection--single .select2-selection__placeholder {
    padding-left: 12px !important;
    margin-left: 0 !important;
    text-indent: 0 !important;
    left: 0 !important;
}

/* Target the specific medicine search field */
#medicineSearch + .select2-container .select2-selection--single .select2-selection__rendered,
#medicineSearch + .select2-container .select2-selection--single .select2-selection__placeholder {
    padding-left: 12px !important;
    margin-left: 0 !important;
    text-indent: 0 !important;
    left: 0 !important;
}

/* Force all Select2 elements in this form */
.form-control.select2 + .select2-container .select2-selection--single .select2-selection__rendered,
.form-control.select2 + .select2-container .select2-selection--single .select2-selection__placeholder {
    padding-left: 12px !important;
    margin-left: 0 !important;
    text-indent: 0 !important;
    left: 0 !important;
}

/* Wrapper approach for padding */
.select2-wrapper .select2-container .select2-selection--single .select2-selection__rendered,
.select2-wrapper .select2-container .select2-selection--single .select2-selection__placeholder {
    padding-left: 12px !important;
    margin-left: 0 !important;
    text-indent: 0 !important;
    left: 0 !important;
}

/* Nuclear option - target everything */
.select2-selection__rendered,
.select2-selection__placeholder {
    padding-left: 12px !important;
    margin-left: 0 !important;
    text-indent: 0 !important;
    left: 0 !important;
}

.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: var(--primary-color) !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
}

/* Medicine Result Styling */
.batch-info {
    background: var(--light-bg);
    border-radius: 0.375rem;
    padding: 4px 8px;
    font-size: 0.85em;
    color: var(--text-primary) !important;
    font-weight: 500;
    border: 1px solid var(--border-color);
}

.expiry-warning {
    background: #fff3cd;
    color: #856404 !important;
    font-weight: 600;
    border-color: #ffeaa7;
}

.expiry-critical {
    background: #f8d7da;
    color: #721c24 !important;
    font-weight: 600;
    border-color: #f5c6cb;
}

.stock-indicator {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 5px;
}

.stock-good { 
    background: var(--success-color); 
    color: #fff !important;
    font-weight: 600;
}
.stock-medium { 
    background: var(--warning-color); 
    color: var(--text-primary) !important;
    font-weight: 600;
}
.stock-low { 
    background: var(--danger-color); 
    color: #fff !important;
    font-weight: 600;
}

/* Select2 Results Styling */
.select2-results__option {
    padding: 0 !important;
    border-bottom: 1px solid var(--border-color);
}

.select2-results__option:last-child {
    border-bottom: none;
}

.select2-results__option .medicine-result {
    padding: 16px 20px;
    transition: all 0.2s ease;
}

.select2-results__option:hover .medicine-result {
    background-color: var(--light-bg);
}

.select2-results__option--highlighted .medicine-result {
    background-color: var(--primary-color) !important;
    color: white !important;
}

.select2-results__option .medicine-result .font-weight-bold {
    color: var(--text-primary) !important;
    font-size: 1.1rem;
    margin-bottom: 8px;
    font-weight: 600;
    line-height: 1.3;
}

.select2-results__option--highlighted .medicine-result .font-weight-bold {
    color: white !important;
}

.select2-results__option .medicine-result .batch-info {
    margin: 4px 8px 4px 0;
    display: inline-block;
    min-width: 90px;
    text-align: center;
    font-size: 0.85rem;
    padding: 6px 10px;
    border-radius: 0.25rem;
}

.select2-results__option--highlighted .medicine-result .batch-info {
    background-color: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.select2-dropdown {
    border: 1px solid var(--border-color) !important;
    border-radius: 0.5rem !important;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
    overflow: hidden;
    margin-top: 4px;
}

.select2-results {
    max-height: 300px;
    overflow-y: auto;
}

/* Custom scrollbar for dropdown */
.select2-results::-webkit-scrollbar {
    width: 6px;
}

.select2-results::-webkit-scrollbar-track {
    background: var(--light-bg);
}

.select2-results::-webkit-scrollbar-thumb {
    background: var(--border-color);
    border-radius: 3px;
}

.select2-results::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary);
}

/* Table Styling */
#selectedItemsTable {
    margin-bottom: 0;
}

#selectedItemsTable thead th {
    background: var(--light-bg);
    border: none;
    padding: 1rem 0.75rem;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#selectedItemsTable tbody td {
    padding: 1rem 0.75rem;
    border: none;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}

#selectedItemsTable tbody tr:hover {
    background: var(--light-bg);
}

/* Empty State Styling */
.empty-state {
    padding: 2rem 1rem;
}

.empty-state i {
    color: var(--text-secondary);
    margin-bottom: 1rem;
}

.empty-state h5 {
    color: var(--text-primary);
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: var(--text-secondary);
    margin: 0;
}

/* Card Enhancements */
.card {
    border: none;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.card-header {
    border-bottom: 1px solid var(--border-color);
    font-weight: 600;
}

/* Form Enhancements */
.form-control {
    border: 2px solid var(--border-color);
    border-radius: 0.375rem;
    padding: 0.75rem 1rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background: white;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    background: white;
}

/* Button Enhancements */
.btn {
    border-radius: 0.375rem;
    font-weight: 600;
    padding: 0.75rem 1.5rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.btn-lg {
    padding: 1rem 2rem;
    font-size: 1.1rem;
}

/* Badge Styling */
.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
}

/* Background Colors */
.bg-warning-light {
    background-color: #fff3cd !important;
    border: 1px solid #ffeaa7;
}

/* Change Display Styling */
.change-display {
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.change-display.positive {
    background-color: #d4edda !important;
    border-color: #c3e6cb;
}

.change-display.negative {
    background-color: #f8d7da !important;
    border-color: #f5c6cb;
}

.change-amount {
    transition: all 0.3s ease;
}

.change-amount.positive {
    color: #155724 !important;
}

.change-amount.negative {
    color: #721c24 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .btn-group-vertical {
        flex-direction: row;
    }
    
    .btn-group-vertical .btn {
        margin-right: 0.5rem;
        margin-bottom: 0;
    }
    
    .btn-group-vertical .btn:last-child {
        margin-right: 0;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeInUp 0.6s ease-out;
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid var(--primary-color);
    border-top: 2px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.select2-container--default .select2-selection--single{
    padding-top: 5px !important;
}
</style>

<script>
let selectedMedicines = [];
let settings = {
    currency: '<?php echo $settings->currency; ?>'
};

// Initialize edit mode with existing payment data
function initializeEditMode() {
    <?php if (!empty($payment->category_name)): ?>
    var categoryName = '<?php echo $payment->category_name; ?>';
    var categoryArray = categoryName.split(',');
    
    categoryArray.forEach(function(item) {
        if (item.trim() !== '') {
            var parts = item.split('*');
            if (parts.length >= 4) {
                var medicineId = parts[0];
                var price = parseFloat(parts[1]);
                var quantity = parseInt(parts[2]);
                var cost = parseFloat(parts[3]);
                
                // Find medicine details from the medicines array
                var medicine = null;
                <?php foreach ($medicines as $medicine): ?>
                if (medicineId == '<?php echo $medicine->id; ?>') {
                    medicine = {
                        id: '<?php echo $medicine->id; ?>',
                        name: '<?php echo addslashes($medicine->name); ?>',
                        company: '<?php echo addslashes($medicine->company); ?>',
                        price: price,
                        stock: <?php echo $medicine->quantity; ?>
                    };
                }
                <?php endforeach; ?>
                
                if (medicine) {
                    selectedMedicines.push({
                        ...medicine,
                        quantity: quantity,
                        total: price * quantity,
                        text: medicine.name + ' [' + medicine.company + ']',
                        medicine_id: medicine.id,
                        batch: 'N/A',
                        days_to_expiry: 365,
                        supplier: medicine.company
                    });
                }
            }
        }
    });
    
    // Update the display
    renderSelectedMedicines();
    calculateTotals();
    <?php endif; ?>
}

$(document).ready(function() {
    // Initialize edit mode if payment data exists
    <?php if (!empty($payment->id) && !empty($payment->category_name)): ?>
    initializeEditMode();
    <?php endif; ?>
    
    // Initialize Select2 for medicine search
    $('#medicineSearch').select2({
        placeholder: 'Type to search medicines...',
        allowClear: true,
        ajax: {
            url: 'finance/pharmacy/getMedicinesWithBatches',
            dataType: 'json',
            delay: 250,
            type: 'POST',
            data: function (params) {
                console.log('AJAX request with search term:', params.term);
                return {
                    searchTerm: params.term,
                    page: params.page
                };
            },
            processResults: function (data, params) {
                console.log('AJAX response data:', data);
                console.log('Data type:', typeof data);
                console.log('Data length:', data ? data.length : 'null');
                
                if (!data || !Array.isArray(data)) {
                    console.error('Invalid data received:', data);
                    return { results: [] };
                }
                
                return {
                    results: data.map(item => ({
                            id: item.id,
                            text: item.text,
                        data: item
                    }))
                };
            },
            cache: true
        },
        templateResult: formatMedicineResult,
        templateSelection: formatMedicineSelection,
        language: {
            noResults: function() {
                return "No medicines found";
            }
        }
    });

    // Aggressive placeholder padding fix
    function fixSelect2Padding() {
        $('#medicineSearch + .select2-container .select2-selection--single .select2-selection__placeholder').css({
            'padding-left': '12px !important',
            'text-indent': '0 !important',
            'margin-left': '0 !important',
            'left': '0 !important'
        });
        
        $('#medicineSearch + .select2-container .select2-selection--single .select2-selection__rendered').css({
            'padding-left': '12px !important',
            'margin-left': '0 !important',
            'text-indent': '0 !important',
            'left': '0 !important'
        });
    }
    
    // Run the fix multiple times to ensure it sticks
    setTimeout(fixSelect2Padding, 100);
    setTimeout(fixSelect2Padding, 300);
    setTimeout(fixSelect2Padding, 500);
    
    // Also run when Select2 opens/closes
    $('#medicineSearch').on('select2:open select2:close', function() {
        setTimeout(fixSelect2Padding, 50);
    });

    // Handle medicine selection
    $('#medicineSearch').on('select2:select', function (e) {
        let data = e.params.data.data;
        addMedicineToSale(data);
        $(this).val(null).trigger('change');
    });

    // Initialize form validation
    $('#pharmacySaleForm').on('submit', function(e) {
        if (selectedMedicines.length === 0) {
            e.preventDefault();
            Swal.fire('Error', 'Please select at least one medicine', 'error');
            return false;
        }
        
        updateHiddenInputs();
        return true;
    });

    // Ensure change calculation works on amount received input
    $('#amountReceived').on('input change keyup', function() {
        calculateChange();
    });
});

function formatMedicineResult(medicine) {
    if (medicine.loading) {
        return medicine.text;
    }

    if (!medicine.data) {
        return medicine.text;
    }

    let data = medicine.data;
    let expiryClass = data.days_to_expiry <= 30 ? 'expiry-warning' : '';
    let stockClass = data.stock > 50 ? 'stock-good' : (data.stock > 10 ? 'stock-medium' : 'stock-low');

    return $(`
        <div class="medicine-result">
            <div class="font-weight-bold">${data.text}</div>
            <div class="d-flex justify-content-between mt-1">
                <span class="batch-info ${expiryClass}">
                    <i class="fas fa-calendar mr-1"></i>Exp: ${data.expiry_date}
                </span>
                <span class="batch-info">
                    <span class="stock-indicator ${stockClass}"></span>Stock: ${data.stock}
                </span>
                <span class="batch-info">
                    Price: ${settings.currency}${parseFloat(data.price).toFixed(2)}
                </span>
            </div>
        </div>
    `);
}

function formatMedicineSelection(medicine) {
    return medicine.text;
}

function addMedicineToSale(medicineData) {
    // Check if already added
    let existing = selectedMedicines.find(m => m.id === medicineData.id);
    if (existing) {
        Swal.fire('Info', 'Medicine already added to sale', 'info');
        return;
    }

    // Add to selected medicines
    selectedMedicines.push({
        ...medicineData,
        quantity: 1,
        total: parseFloat(medicineData.price)
    });

    renderSelectedMedicines();
    calculateTotals();
    updateItemCount();
    checkStockAlerts();
}

function renderSelectedMedicines() {
    let tbody = $('#selectedItemsBody');
    tbody.empty();

    if (selectedMedicines.length === 0) {
        tbody.append(`
            <tr id="noItemsRow">
                <td colspan="7" class="text-center py-4 text-muted">
                    <i class="fas fa-pills fa-2x mb-2"></i><br>
                    No medicines selected. Use the search above to add medicines.
                </td>
            </tr>
        `);
        updateItemCount();
        return;
    }

    selectedMedicines.forEach((medicine, index) => {
        let expiryClass = medicine.days_to_expiry <= 30 ? 'text-warning' : '';
        let stockClass = medicine.stock <= 10 ? 'text-danger' : (medicine.stock <= 50 ? 'text-warning' : 'text-success');

        tbody.append(`
            <tr data-index="${index}">
                <td>
                    <div class="font-weight-bold">${medicine.text.split('[')[0].trim()}</div>
                    <small class="text-muted">${medicine.supplier || 'Unknown Supplier'}</small>
                </td>
                <td>
                    <div class="batch-info">
                        <strong>Batch:</strong> ${medicine.batch || 'N/A'}<br>
                        <small class="${expiryClass}">
                            <i class="fas fa-calendar mr-1"></i>
                            Exp: ${medicine.expiry_date}
                        </small>
                    </div>
                </td>
                <td class="${stockClass}">
                    <strong>${medicine.stock}</strong>
                </td>
                <td>
                    <input type="number" class="form-control" min="1" max="${medicine.stock}" 
                           value="${medicine.quantity}" onchange="updateQuantity(${index}, this.value)">
                </td>
                <td>
                    <strong>${settings.currency}${parseFloat(medicine.price).toFixed(2)}</strong>
                </td>
                <td>
                    <strong class="text-primary">${settings.currency}${medicine.total.toFixed(2)}</strong>
                </td>
                <td>
                    <a type="button" class="btn btn-danger btn-sm" onclick="removeMedicine(${index})">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        `);
    });
    
    updateItemCount();
}

function updateQuantity(index, newQuantity) {
    newQuantity = parseInt(newQuantity);
    
    if (newQuantity > selectedMedicines[index].stock) {
        Swal.fire('Error', 'Quantity cannot exceed available stock', 'error');
        $(`tr[data-index="${index}"] input`).val(selectedMedicines[index].quantity);
        return;
    }

    selectedMedicines[index].quantity = newQuantity;
    selectedMedicines[index].total = newQuantity * parseFloat(selectedMedicines[index].price);
    
    renderSelectedMedicines();
    calculateTotals();
}

function removeMedicine(index) {
    selectedMedicines.splice(index, 1);
    renderSelectedMedicines();
    calculateTotals();
    updateItemCount();
    checkStockAlerts();
}

function calculateTotals() {
    let subtotal = selectedMedicines.reduce((sum, medicine) => sum + medicine.total, 0);
    let discount = parseFloat($('#discountInput').val()) || 0;
    
    // Always use flat discount
    let discountAmount = discount;
    let grandTotal = subtotal - discountAmount;
    
    $('#subtotalAmount').text(subtotal.toFixed(2));
    $('#grandTotal').text(grandTotal.toFixed(2));
    
    calculateChange();
}

function calculateChange() {
    let grandTotal = parseFloat($('#grandTotal').text()) || 0;
    let amountReceived = parseFloat($('#amountReceived').val()) || 0;
    let change = amountReceived - grandTotal;
    
    $('#changeAmount').text(change.toFixed(2));
    
    // Remove existing classes
    $('.change-display').removeClass('positive negative');
    $('.change-amount').removeClass('positive negative');
    
    // Add appropriate classes based on change value
    if (change > 0) {
        $('.change-display').addClass('positive');
        $('.change-amount').addClass('positive');
    } else if (change < 0) {
        $('.change-display').addClass('negative');
        $('.change-amount').addClass('negative');
    }
}

function checkStockAlerts() {
    let alerts = [];
    
    selectedMedicines.forEach(medicine => {
        if (medicine.days_to_expiry <= 30) {
            alerts.push(`${medicine.text.split('[')[0].trim()} expires in ${medicine.days_to_expiry} days`);
        }
        if (medicine.stock <= 10) {
            alerts.push(`${medicine.text.split('[')[0].trim()} has low stock (${medicine.stock} remaining)`);
        }
    });
    
    if (alerts.length > 0) {
        $('#stockAlertsBody').html(alerts.map(alert => `<div class="alert alert-warning py-2 mb-2">${alert}</div>`).join(''));
        $('#stockAlerts').show();
    } else {
        $('#stockAlerts').hide();
    }
}

function updateHiddenInputs() {
    let categoryNames = [];
    let medicineIds = [];
    let quantities = [];
    
    selectedMedicines.forEach(medicine => {
        categoryNames.push(`${medicine.medicine_id}*${medicine.price}*${medicine.quantity}`);
        medicineIds.push(medicine.medicine_id);
        quantities.push(medicine.quantity);
    });
    
    $('#categoryNameInput').val(categoryNames.join(','));
    $('#medicineIdsInput').val(medicineIds.join(','));
    $('#quantitiesInput').val(quantities.join(','));
}

function clearSelection() {
    selectedMedicines = [];
    renderSelectedMedicines();
    calculateTotals();
    updateItemCount();
    $('#stockAlerts').hide();
}

// Update item count in header badge
function updateItemCount() {
    const count = selectedMedicines.length;
    $('#itemCount').text(count);
}

function showExpiringOnly() {
    $('#medicineSearch').select2('open');
    // You could implement a filter here to show only expiring medicines
}

function printEstimate() {
    // Implement print functionality
    window.print();
}
</script>

<!--main content end-->
<!--footer start-->
