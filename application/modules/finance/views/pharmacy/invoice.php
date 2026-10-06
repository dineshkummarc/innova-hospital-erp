<!--main content start-->

<!-- Bootstrap-based Invoice Styling -->
<style>
/* Print styles - maintain same structure as main view */
@media print {
    .no-print {
        display: none !important;
    }
    
    /* Hide only the sidebar with buttons, keep main content structure */
    .col-lg-3 {
        display: none !important;
    }
    
    /* Make main content full width for print */
    .col-lg-9 {
        width: 100% !important;
        max-width: 100% !important;
        flex: 0 0 100% !important;
    }
    
    /* Remove shadows and borders for print */
    .card {
        box-shadow: none !important;
        border: none !important;
    }
    
    .card-header {
        background: white !important;
        border-bottom: none !important;
    }
    
    /* Remove the blue border line above hospital title */
    .border-top, .border-primary, .border-3 {
        border-top: none !important;
        border: none !important;
    }
    
    /* Ensure table items are visible and don't break */
    .table tbody tr {
        page-break-inside: avoid;
    }
    
    /* Keep the same layout structure */
    .row {
        display: flex !important;
        flex-wrap: wrap !important;
    }
    
    .col-md-4 {
        width: 33.333333% !important;
        flex: 0 0 33.333333% !important;
    }
    
    .col-md-6 {
        width: 50% !important;
        flex: 0 0 50% !important;
    }
    
    /* Maintain card structure */
    .card-body {
        padding: 1rem !important;
    }
    
    /* Keep text colors readable for print */
    .text-primary {
        color: #000 !important;
    }
    
    .text-muted {
        color: #666 !important;
    }
    
    .bg-primary, .bg-success, .bg-info, .bg-dark {
        background: white !important;
        color: #000 !important;
    }
    
    .border-left-primary, .border-left-success, .border-left-info {
        border-left: none !important;
    }
}

.thermal-print {
    width: 80mm !important;
    font-family: 'Courier New', monospace !important;
    font-size: 12px !important;
    line-height: 1.2 !important;
    margin: 0 !important;
    padding: 5mm !important;
    background: white !important;
    color: black !important;
}

.thermal-print .invoice-header {
    text-align: center !important;
    padding: 5mm 0 !important;
    border-bottom: 1px solid #000 !important;
}

.thermal-print .invoice-header h1 {
    font-size: 16px !important;
    margin: 0 0 2mm 0 !important;
}

.thermal-print .invoice-header .hospital-info {
    font-size: 10px !important;
    margin: 0 !important;
}

.thermal-print .invoice-details {
    padding: 3mm 0 !important;
}

.thermal-print .invoice-meta {
    display: block !important;
    margin: 0 !important;
}

.thermal-print .invoice-meta-card {
    margin: 2mm 0 !important;
    padding: 2mm !important;
    border: none !important;
    box-shadow: none !important;
    background: white !important;
}

.thermal-print .invoice-meta-card h4 {
    font-size: 10px !important;
    margin: 0 0 1mm 0 !important;
    text-transform: uppercase !important;
}

.thermal-print .invoice-meta-card p {
    font-size: 10px !important;
    margin: 0 !important;
}

.thermal-print .invoice-table-container {
    margin: 3mm 0 !important;
    border: none !important;
    box-shadow: none !important;
}

.thermal-print .invoice-table {
    font-size: 10px !important;
}

.thermal-print .table thead th {
    padding: 1mm !important;
    font-size: 8px !important;
    border-bottom: 1px solid #000 !important;
    background: #f8f9fa !important;
}

.thermal-print .table tbody td {
    padding: 1mm !important;
    font-size: 10px !important;
    border-bottom: 1px solid #ddd !important;
}

.thermal-print .table tbody tr {
    display: table-row !important;
}

.thermal-print .table tbody tr td {
    display: table-cell !important;
    width: auto !important;
}

.thermal-print .invoice-summary {
    margin: 3mm 0 !important;
    padding: 2mm !important;
    border: none !important;
    box-shadow: none !important;
}

.thermal-print .summary-item {
    padding: 1mm 0 !important;
    font-size: 10px !important;
}

.thermal-print .summary-item:last-child {
    font-size: 12px !important;
    font-weight: bold !important;
    border-top: 1px solid #000 !important;
    margin: 2mm -2mm -2mm -2mm !important;
    padding: 2mm !important;
}

.thermal-print .invoice-actions {
    display: none !important;
}

.thermal-print .invoice-navigation {
    display: none !important;
}
</style>

<div class="content-wrapper bg-light">
    <!-- Content Header -->
    <section class="content-header bg-white border-bottom">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-8">
                    <div class="d-flex align-items-center">
                        <div class="mr-3">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="fas fa-file-invoice text-white"></i>
                            </div>
                        </div>
                        <div>
                            <h1 class="h3 font-weight-bold text-dark mb-1">
                                <?php echo lang('pharmacy'); ?> <?php echo lang('invoice'); ?>
                            </h1>
                            <p class="text-muted mb-0 small">
                                Invoice ID: <?php echo $payment->id; ?> • <?php echo date('M d, Y', $payment->date); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent p-0 mb-0 justify-content-end">
                            <li class="breadcrumb-item">
                                <a href="home" class="text-muted text-decoration-none">
                                    <?php echo lang('home') ?>
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-dark">
                                <?php echo lang('pharmacy'); ?> <?php echo lang('invoice'); ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <!-- Invoice Container -->
                    <div class="card shadow-lg border-0">
                        <!-- Invoice Header -->
                        <div class="card-header bg-light border-bottom text-center py-4">
                            <div class="border-top border-primary border-3 mb-3"></div>
                            <h1 class="h2 font-weight-bold text-primary mb-2">
                                <?php echo $settings->title; ?>
                            </h1>
                            <p class="text-muted mb-0">
                                <?php echo $settings->address; ?><br>
                                <?php echo $settings->phone; ?> | <?php echo $settings->email; ?>
                            </p>
                        </div>

                        <!-- Invoice Details -->
                        <div class="card-body p-4">
                            <!-- Invoice Meta Information -->
                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                    <div class="card border-left-primary h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary font-weight-bold mb-2">
                                                <i class="fas fa-receipt mr-2"></i>Invoice Details
                                            </h6>
                                            <p class="card-text small mb-1"><strong>Invoice ID:</strong> <?php echo $payment->id; ?></p>
                                            <p class="card-text small mb-1"><strong>Date:</strong> <?php echo date('M d, Y', $payment->date); ?></p>
                                            <p class="card-text small mb-0"><strong>Time:</strong> <?php echo date('h:i A', $payment->date); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card border-left-success h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-success font-weight-bold mb-2">
                                                <i class="fas fa-user mr-2"></i>Customer Information
                                            </h6>
                                            <p class="card-text small mb-1"><strong>Name:</strong> <?php echo $payment->patient; ?></p>
                                            <p class="card-text small mb-1"><strong>Phone:</strong> <?php echo $payment->phone; ?></p>
                                            <p class="card-text small mb-0"><strong>Address:</strong> <?php echo $payment->address; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card border-left-info h-100">
                                        <div class="card-body">
                                            <h6 class="card-title text-info font-weight-bold mb-2">
                                                <i class="fas fa-credit-card mr-2"></i>Payment Details
                                            </h6>
                                            <p class="card-text small mb-1"><strong>Method:</strong> Cash</p>
                                            <p class="card-text small mb-1"><strong>Status:</strong> 
                                                <span class="badge badge-success">Paid</span>
                                            </p>
                                            <p class="card-text small mb-0"><strong>Reference:</strong> Invoice ID: <?php echo $payment->id; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Invoice Items Table -->
                            <div class="table-responsive mb-4">
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th class="text-uppercase small font-weight-bold">Medicine</th>
                                            <th class="text-uppercase small font-weight-bold text-center">Quantity</th>
                                            <th class="text-uppercase small font-weight-bold text-right">Unit Price</th>
                                            <th class="text-uppercase small font-weight-bold text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($payment_items as $item) { ?>
                                        <tr>
                                            <td class="font-weight-bold text-primary"><?php echo $item->medicine_name; ?></td>
                                            <td class="text-center"><?php echo $item->quantity; ?></td>
                                            <td class="text-right">$<?php echo number_format($item->price, 2); ?></td>
                                            <td class="text-right font-weight-bold">$<?php echo number_format($item->total, 2); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Invoice Summary -->
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="card border-0 bg-light">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <span class="text-muted">Subtotal:</span>
                                                <span class="font-weight-bold">$<?php echo number_format($payment->amount, 2); ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <span class="text-muted">Discount:</span>
                                                <span class="font-weight-bold text-danger">-$<?php echo number_format($payment->discount, 2); ?></span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                                <span class="text-muted">Tax:</span>
                                                <span class="font-weight-bold">$0.00</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center py-3 bg-primary text-white rounded mt-2">
                                                <span class="font-weight-bold h5 mb-0">Total Amount:</span>
                                                <span class="font-weight-bold h5 mb-0">$<?php echo number_format($payment->gross_total, 2); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 no-print">
                    <div class="card shadow border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-cogs mr-2"></i>Invoice Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button onclick="printInvoice()" class="btn btn-primary btn-lg">
                                    <i class="fas fa-print mr-2"></i>Print Invoice
                                </button>
                                <button onclick="printThermalInvoice()" class="btn btn-success btn-lg">
                                    <i class="fas fa-receipt mr-2"></i>Thermal Print
                                </button>
                                <a href="finance/pharmacy/editPayment?id=<?php echo $payment->id ?>" class="btn btn-info btn-lg">
                                    <i class="fas fa-edit mr-2"></i>Edit Invoice
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="card shadow border-0 mt-4">
                        <div class="card-header bg-dark text-white text-center">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-arrows-alt-h mr-2"></i>Navigate Invoices
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="finance/pharmacy/previousInvoice?id=<?php echo $payment->id ?>" class="btn btn-dark btn-lg">
                                    <i class="fas fa-arrow-left mr-2"></i>Previous Invoice
                                </a>
                                <a href="finance/pharmacy/nextInvoice?id=<?php echo $payment->id ?>" class="btn btn-dark btn-lg">
                                    <i class="fas fa-arrow-right mr-2"></i>Next Invoice
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function printInvoice() {
    window.print();
}

function printThermalInvoice() {
    const printWindow = window.open('', '_blank', 'width=400,height=600');
    const invoiceContent = document.querySelector('.card').cloneNode(true);
    invoiceContent.classList.add('thermal-print');
    
    // Remove all buttons and action elements
    const buttons = invoiceContent.querySelectorAll('.btn, .d-grid, .card-header:last-child');
    buttons.forEach(btn => btn.remove());
    
    // Ensure table structure is preserved
    const table = invoiceContent.querySelector('.table');
    if (table) {
        table.style.display = 'table';
        table.style.width = '100%';
        table.style.borderCollapse = 'collapse';
        
        // Ensure all table rows and cells are visible
        const rows = table.querySelectorAll('tr');
        rows.forEach(row => {
            row.style.display = 'table-row';
            const cells = row.querySelectorAll('td, th');
            cells.forEach(cell => {
                cell.style.display = 'table-cell';
                cell.style.padding = '1mm';
                cell.style.border = '1px solid #ddd';
            });
        });
    }
    
    const thermalHTML = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Thermal Invoice</title>
            <style>
                body { margin: 0; padding: 0; font-family: 'Courier New', monospace; }
                .thermal-print { width: 80mm; font-size: 12px; line-height: 1.2; padding: 5mm; }
                .thermal-print .card-header { text-align: center; padding: 5mm 0; border-bottom: 1px solid #000; }
                .thermal-print .card-header h1 { font-size: 16px; margin: 0 0 2mm 0; }
                .thermal-print .card-header p { font-size: 10px; margin: 0; }
                .thermal-print .card-body { padding: 3mm 0; }
                .thermal-print .row { display: block; margin: 0; }
                .thermal-print .col-md-4 { width: 100%; margin: 2mm 0; padding: 2mm; border: none; }
                .thermal-print .card { border: none; box-shadow: none; background: white; }
                .thermal-print .card-title { font-size: 10px; margin: 0 0 1mm 0; text-transform: uppercase; }
                .thermal-print .card-text { font-size: 10px; margin: 0; }
                .thermal-print .table { font-size: 10px; display: table !important; width: 100% !important; border-collapse: collapse !important; }
                .thermal-print .table thead { display: table-header-group !important; }
                .thermal-print .table tbody { display: table-row-group !important; }
                .thermal-print .table tr { display: table-row !important; }
                .thermal-print .table th, .thermal-print .table td { display: table-cell !important; padding: 1mm; border: 1px solid #ddd; }
                .thermal-print .table thead th { background: #f8f9fa; font-size: 8px; border-bottom: 1px solid #000; }
                .thermal-print .table tbody td { font-size: 10px; }
                .thermal-print .btn { display: none !important; }
                .thermal-print .no-print { display: none !important; }
                .thermal-print .d-grid { display: none !important; }
            </style>
        </head>
        <body>
            ${invoiceContent.outerHTML}
        </body>
        </html>
    `;
    
    printWindow.document.write(thermalHTML);
    printWindow.document.close();
    
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 500);
    
    Swal.fire({
        title: 'Success!',
        text: 'Thermal invoice sent to printer',
        icon: 'success',
        timer: 2000,
        showConfirmButton: false
    });
}

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey) {
        switch(e.key) {
            case 'p':
                e.preventDefault();
                printInvoice();
                break;
            case 't':
                e.preventDefault();
                printThermalInvoice();
                break;
        }
    }
});
</script>