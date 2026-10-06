<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Ambulance Reports - PDF Export</title>
    <style>
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
            .page-break { page-break-before: always; }
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        
        .header h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 28px;
        }
        
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 14px;
        }
        
        .summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 25px;
            border-left: 4px solid #007bff;
        }
        
        .summary h3 {
            margin: 0 0 10px 0;
            color: #007bff;
            font-size: 18px;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .summary-item {
            background: white;
            padding: 10px;
            border-radius: 3px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .summary-item strong {
            color: #495057;
            display: block;
            margin-bottom: 5px;
        }
        
        .summary-item span {
            color: #007bff;
            font-size: 18px;
            font-weight: bold;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 12px;
        }
        
        th {
            background-color: #007bff;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #0056b3;
        }
        
        td {
            padding: 10px 8px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #e9ecef;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-active { background-color: #d4edda; color: #155724; }
        .status-completed { background-color: #cce5ff; color: #004085; }
        .status-cancelled { background-color: #f8d7da; color: #721c24; }
        .status-pending { background-color: #fff3cd; color: #856404; }
        
        .amount {
            text-align: right;
            font-weight: bold;
            color: #28a745;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #dee2e6;
            padding-top: 10px;
        }
        
        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .print-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <button class="print-button no-print" onclick="window.print()">
        <i class="fas fa-print"></i> Print PDF
    </button>
    
    <div class="header">
        <h1>Ambulance Service Reports</h1>
        <p>Generated on: <?php echo date('F j, Y \a\t g:i A'); ?></p>
    </div>
    
    <div class="summary">
        <h3>Report Summary</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <strong>Total Bookings</strong>
                <span><?php echo $summary['total_bookings']; ?></span>
            </div>
            <div class="summary-item">
                <strong>Average Response Time</strong>
                <span><?php echo $summary['average_response_time']; ?> minutes</span>
            </div>
            <div class="summary-item">
                <strong>Report Period</strong>
                <span><?php echo date('M j - M j, Y'); ?></span>
            </div>
        </div>
    </div>
    
    <div class="table-container">
        <h3>Booking Details</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 15%;">Booking Number</th>
                    <th style="width: 20%;">Patient Name</th>
                    <th style="width: 15%;">Ambulance Type</th>
                    <th style="width: 12%;">Status</th>
                    <th style="width: 15%;">Created Date</th>
                    <th style="width: 10%;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bookings)): ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo $booking->id; ?></td>
                            <td><?php echo $booking->booking_number; ?></td>
                            <td><?php echo $booking->patient_name; ?></td>
                            <td><?php echo $booking->ambulance_type; ?></td>
                            <td>
                                <span class="status-badge status-<?php echo strtolower(str_replace(' ', '-', $booking->status)); ?>">
                                    <?php echo $booking->status; ?>
                                </span>
                            </td>
                            <td><?php echo date('M j, Y g:i A', strtotime($booking->created_at)); ?></td>
                            <td class="amount">$<?php echo number_format($booking->total_amount, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 20px; color: #666;">
                            No booking data available for the selected period.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="footer">
        <p>This report was generated by the Hospital Management System</p>
        <p>For questions about this report, please contact the system administrator</p>
    </div>
    
    <script>
        // Auto-print when page loads
        window.onload = function() {
            // Small delay to ensure all content is loaded
            setTimeout(function() {
                window.print();
            }, 500);
        }
        
        // Close window after printing (optional)
        window.onafterprint = function() {
            // Uncomment the line below if you want to close the window after printing
            // window.close();
        }
    </script>
</body>
</html>
