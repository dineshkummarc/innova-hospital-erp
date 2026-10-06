<!-- Dashboard Styles -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/views/css/dashboard.css'); ?>">
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<style>
    .dashboard-container {
        padding: 20px;
        background-color: #f8f9fa;
        min-height: calc(100vh - 200px);
    }
        .metric-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .metric-card:hover {
            transform: translateY(-5px);
        }
        .metric-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
        .metric-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .metric-change {
            font-size: 0.8rem;
            margin-top: 5px;
        }
        .positive { color: #27ae60; }
        .negative { color: #e74c3c; }
        .warning { color: #f39c12; }
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .refresh-btn {
            background: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .refresh-btn:hover {
            background: #2ecc71;
        }
        .payment-status {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .payment-paid {
            background: #d4edda;
            border-left: 4px solid #27ae60;
        }
        .payment-pending {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
        }
        .payment-overdue {
            background: #f8d7da;
            border-left: 4px solid #e74c3c;
        }
        .expense-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }
        .status-good { background-color: #27ae60; }
        .status-warning { background-color: #f39c12; }
        .status-danger { background-color: #e74c3c; }
        .profit-margin {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .profit-positive { color: #27ae60; }
        .profit-negative { color: #e74c3c; }
    </style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="row">
                <div class="col-md-8">
                    <h1><i class="fas fa-chart-line"></i> Financial Dashboard</h1>
                    <p>Live financial performance and revenue analytics</p>
                </div>
                <div class="col-md-4 text-right">
                    <button class="refresh-btn" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Financial Metrics -->
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value">$<?php echo number_format($revenue_metrics['todays_revenue']); ?></div>
                    <div class="metric-label">Today's Revenue</div>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> Today's revenue
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value">$<?php echo number_format($revenue_metrics['monthly_revenue']); ?></div>
                    <div class="metric-label">Monthly Revenue</div>
                    <div class="metric-change <?php echo $percentage_changes['revenue_change'] >= 0 ? 'positive' : 'negative'; ?>">
                        <i class="fas fa-arrow-<?php echo $percentage_changes['revenue_change'] >= 0 ? 'up' : 'down'; ?>"></i> 
                        <?php echo $percentage_changes['revenue_change'] >= 0 ? '+' : ''; ?><?php echo $percentage_changes['revenue_change']; ?>% from last month
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value">$<?php echo number_format($revenue_metrics['outstanding_payments']); ?></div>
                    <div class="metric-label">Outstanding Payments</div>
                    <div class="metric-change <?php echo $revenue_metrics['outstanding_payments'] > 50000 ? 'warning' : 'positive'; ?>">
                        <i class="fas fa-<?php echo $revenue_metrics['outstanding_payments'] > 50000 ? 'exclamation-triangle' : 'check-circle'; ?>"></i>
                        <?php echo $revenue_metrics['outstanding_payments'] > 50000 ? 'High' : 'Normal'; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo $profitability['profit_margin'] ?? 0; ?>%</div>
                    <div class="metric-label">Profit Margin</div>
                    <div class="metric-change positive">
                        <i class="fas fa-chart-line"></i> Current margin
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-chart-line"></i> Revenue Trend (Last 12 Months)</h4>
                    <canvas id="revenueChart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Payment Status and Cash Flow -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-credit-card"></i> Payment Status Overview</h4>
                    <div id="paymentStatusList">
                        <div class="payment-status payment-paid">
                            <div class="status-indicator status-good"></div>
                            <div>
                                <strong>Paid Today:</strong> $<?php echo number_format($payment_status['paid_today'] ?? 0); ?>
                                <br><small><?php echo $payment_status['paid_count'] ?? 0; ?> transactions</small>
                            </div>
                        </div>
                        <div class="payment-status payment-pending">
                            <div class="status-indicator status-warning"></div>
                            <div>
                                <strong>Pending:</strong> $<?php echo number_format($payment_status['pending'] ?? 0); ?>
                                <br><small><?php echo $payment_status['pending_count'] ?? 0; ?> transactions</small>
                            </div>
                        </div>
                        <div class="payment-status payment-overdue">
                            <div class="status-indicator status-danger"></div>
                            <div>
                                <strong>Overdue:</strong> $<?php echo number_format($payment_status['overdue'] ?? 0); ?>
                                <br><small><?php echo $payment_status['overdue_count'] ?? 0; ?> transactions</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-coins"></i> Cash Flow Analysis</h4>
                    <canvas id="cashFlowChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Expense Breakdown -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-receipt"></i> Monthly Expense Breakdown</h4>
                    <div class="row">
                        <div class="col-md-8">
                            <div id="expenseBreakdownList">
                                <?php foreach($expense_breakdown as $expense): ?>
                                <div class="expense-item">
                                    <div>
                                        <strong><?php echo ucfirst($expense->category); ?></strong>
                                    </div>
                                    <div class="metric-value" style="font-size: 1.2rem;">
                                        $<?php echo number_format($expense->total_amount); ?>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="chart-container">
                                <h5><i class="fas fa-chart-pie"></i> Expense Distribution</h5>
                                <canvas id="expenseChart" width="300" height="200"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profitability Analysis -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-chart-bar"></i> Profitability Analysis</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value">$<?php echo number_format($profitability['gross_profit'] ?? 0); ?></div>
                                <div class="metric-label">Gross Profit</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-chart-line"></i> Current month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value">$<?php echo number_format($profitability['net_profit'] ?? 0); ?></div>
                                <div class="metric-label">Net Profit</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-chart-line"></i> Current month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value profit-margin <?php echo ($profitability['profit_margin'] ?? 0) > 0 ? 'profit-positive' : 'profit-negative'; ?>">
                                    <?php echo $profitability['profit_margin'] ?? 0; ?>%
                                </div>
                                <div class="metric-label">Profit Margin</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-chart-line"></i> Current margin
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value">$<?php echo number_format($profitability['roi'] ?? 0); ?></div>
                                <div class="metric-label">ROI</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-chart-line"></i> Current ROI
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Budget vs Actual -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-balance-scale"></i> Budget vs Actual Performance</h4>
                    <canvas id="budgetChart" width="800" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Financial Alerts -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-exclamation-triangle"></i> Financial Alerts & Recommendations</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>High Outstanding:</strong> $<?php echo number_format($revenue_metrics['outstanding_payments']); ?> in unpaid invoices
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Budget Alert:</strong> 85% of monthly budget utilized
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                <strong>Positive Trend:</strong> Revenue up 12.3% this month
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('application/modules/dashboard/views/js/dashboard.js'); ?>"></script>
    <script>
        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode(array_column($revenue_data, 'month')); ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?php echo json_encode(array_column($revenue_data, 'revenue')); ?>,
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39, 174, 96, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Expense Breakdown Chart
        const expenseCtx = document.getElementById('expenseChart').getContext('2d');
        const expenseChart = new Chart(expenseCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($expense_breakdown, 'category')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($expense_breakdown, 'total_amount')); ?>,
                    backgroundColor: ['#e74c3c', '#f39c12', '#3498db', '#9b59b6', '#1abc9c', '#f1c40f', '#e67e22']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Cash Flow Chart
        const cashFlowCtx = document.getElementById('cashFlowChart').getContext('2d');
        const cashFlowChart = new Chart(cashFlowCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($cash_flow, 'date')); ?>,
                datasets: [{
                    label: 'Inflow',
                    data: <?php echo json_encode(array_column($cash_flow, 'revenue')); ?>,
                    backgroundColor: '#27ae60'
                }, {
                    label: 'Outflow',
                    data: <?php echo json_encode(array_column($cash_flow, 'expenses')); ?>,
                    backgroundColor: '#e74c3c'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Budget vs Actual Chart
        const budgetCtx = document.getElementById('budgetChart').getContext('2d');
        const budgetChart = new Chart(budgetCtx, {
            type: 'bar',
            data: {
                labels: ['Revenue', 'Expenses'],
                datasets: [{
                    label: 'Budget',
                    data: [<?php echo $budget_vs_actual['budgeted_revenue']; ?>, <?php echo $budget_vs_actual['budgeted_expenses']; ?>],
                    backgroundColor: '#3498db'
                }, {
                    label: 'Actual',
                    data: [<?php echo $budget_vs_actual['actual_revenue']; ?>, <?php echo $budget_vs_actual['actual_expenses']; ?>],
                    backgroundColor: '#27ae60'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Auto-refresh function
        function refreshDashboard() {
            location.reload();
        }

        // Auto-refresh every 5 minutes for financial data
        setInterval(refreshDashboard, 300000);

        // Real-time updates for critical financial metrics
        setInterval(function() {
            fetch('dashboard/getRealTimeMetrics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'dashboard_type=financial'
            })
            .then(response => response.json())
            .then(data => {
                // Update financial metrics without full page refresh
                console.log('Financial metrics updated:', data);
            });
        }, 60000); // Update every minute
    </script>
        </div>
    </div>
</div>
