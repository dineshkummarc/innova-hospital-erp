<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice <?php echo $payment->id; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }
        .invoice-header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding: 20px 0;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            color: #007bff;
            margin: 0 0 10px 0;
            font-size: 28px;
        }
        .invoice-header p {
            margin: 5px 0;
            color: #666;
        }
        .invoice-meta {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .invoice-meta-card {
            display: table-cell;
            width: 33.33%;
            padding: 15px;
            vertical-align: top;
            border-left: 3px solid #007bff;
            padding-left: 20px;
        }
        .invoice-meta-card:first-child {
            border-left: 3px solid #007bff;
        }
        .invoice-meta-card:nth-child(2) {
            border-left: 3px solid #28a745;
        }
        .invoice-meta-card:nth-child(3) {
            border-left: 3px solid #17a2b8;
        }
        .invoice-meta-card h4 {
            margin: 0 0 10px 0;
            font-size: 14px;
            text-transform: uppercase;
            color: #333;
        }
        .invoice-meta-card p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .invoice-table thead {
            background: #f8f9fa;
        }
        .invoice-table thead th {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #007bff;
            font-size: 12px;
            text-transform: uppercase;
            color: #333;
        }
        .invoice-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        .invoice-table tbody tr:hover {
            background: #f8f9fa;
        }
        .invoice-summary {
            float: right;
            width: 300px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }
        .summary-item:last-child {
            border-bottom: none;
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            background: #007bff;
            color: white;
            margin: 10px -20px -20px -20px;
            padding: 15px 20px;
            border-radius: 0 0 5px 5px;
        }
        .summary-label {
            font-weight: 500;
        }
        .summary-value {
            font-weight: 600;
        }
        .clearfix::after {
            content: "";
            display: table;
            clear: both;
        }
        @media print {
            body { margin: 0; padding: 10px; }
            .invoice-container { max-width: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Invoice Header -->
        <div class="invoice-header">
            <h1><?php echo $settings->title; ?></h1>
            <p><?php echo $settings->address; ?></p>
            <p><?php echo $settings->phone; ?> | <?php echo $settings->email; ?></p>
        </div>

        <!-- Invoice Meta Information -->
        <div class="invoice-meta">
            <div class="invoice-meta-card">
                <h4>Invoice Details</h4>
                <p><strong>Invoice ID:</strong> <?php echo $payment->id; ?></p>
                <p><strong>Date:</strong> <?php echo date('M d, Y', $payment->date); ?></p>
                <p><strong>Time:</strong> <?php echo date('h:i A', $payment->date); ?></p>
            </div>
            <div class="invoice-meta-card">
                <h4>Customer Information</h4>
                <p><strong>Name:</strong> <?php echo $payment->patient; ?></p>
                <p><strong>Phone:</strong> <?php echo $payment->phone; ?></p>
                <p><strong>Address:</strong> <?php echo $payment->address; ?></p>
            </div>
            <div class="invoice-meta-card">
                <h4>Payment Details</h4>
                <p><strong>Method:</strong> Cash</p>
                <p><strong>Status:</strong> Paid</p>
                <p><strong>Reference:</strong> Invoice ID: <?php echo $payment->id; ?></p>
            </div>
        </div>

        <!-- Invoice Items Table -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Medicine</th>
                    <th style="text-align: center;">Quantity</th>
                    <th style="text-align: right;">Unit Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payment_items as $item) { ?>
                <tr>
                    <td style="font-weight: bold; color: #007bff;"><?php echo $item->medicine_name; ?></td>
                    <td style="text-align: center;"><?php echo $item->quantity; ?></td>
                    <td style="text-align: right;">$<?php echo number_format($item->price, 2); ?></td>
                    <td style="text-align: right; font-weight: bold;">$<?php echo number_format($item->total, 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Invoice Summary -->
        <div class="clearfix">
            <div class="invoice-summary">
                <div class="summary-item">
                    <span class="summary-label">Subtotal:</span>
                    <span class="summary-value">$<?php echo number_format($payment->amount, 2); ?></span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Discount:</span>
                    <span class="summary-value">-$<?php echo number_format($payment->discount, 2); ?></span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Tax:</span>
                    <span class="summary-value">$0.00</span>
                </div>
                <div class="summary-item">
                    <span class="summary-label">Total Amount:</span>
                    <span class="summary-value">$<?php echo number_format($payment->gross_total, 2); ?></span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
