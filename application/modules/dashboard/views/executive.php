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
    .chart-container {
        background: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .dashboard-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 10px;
        margin-bottom: 30px;
    }
    .refresh-btn {
        background: #3498db;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s ease;
    }
    .refresh-btn:hover {
        background: #2980b9;
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
    </style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="row">
                <div class="col-md-8">
                    <h1><i class="fas fa-chart-line"></i> Executive Dashboard</h1>
                    <p>Comprehensive overview of hospital performance and key metrics</p>
                </div>
                <div class="col-md-4 text-right">
                    <button class="refresh-btn" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Metrics Row -->
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value">$<?php echo number_format($metrics['total_revenue']); ?></div>
                    <div class="metric-label">Total Revenue (This Month)</div>
                    <div class="metric-change <?php echo $percentage_changes['revenue_change'] >= 0 ? 'positive' : 'negative'; ?>">
                        <i class="fas fa-arrow-<?php echo $percentage_changes['revenue_change'] >= 0 ? 'up' : 'down'; ?>"></i> 
                        <?php echo $percentage_changes['revenue_change'] >= 0 ? '+' : ''; ?><?php echo $percentage_changes['revenue_change']; ?>% from last month
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($metrics['total_patients']); ?></div>
                    <div class="metric-label">New Patients (This Month)</div>
                    <div class="metric-change <?php echo $percentage_changes['patients_change'] >= 0 ? 'positive' : 'negative'; ?>">
                        <i class="fas fa-arrow-<?php echo $percentage_changes['patients_change'] >= 0 ? 'up' : 'down'; ?>"></i> 
                        <?php echo $percentage_changes['patients_change'] >= 0 ? '+' : ''; ?><?php echo $percentage_changes['patients_change']; ?>% from last month
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($metrics['total_appointments']); ?></div>
                    <div class="metric-label">Appointments (This Month)</div>
                    <div class="metric-change <?php echo $percentage_changes['appointments_change'] >= 0 ? 'positive' : 'negative'; ?>">
                        <i class="fas fa-arrow-<?php echo $percentage_changes['appointments_change'] >= 0 ? 'up' : 'down'; ?>"></i> 
                        <?php echo $percentage_changes['appointments_change'] >= 0 ? '+' : ''; ?><?php echo $percentage_changes['appointments_change']; ?>% from last month
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo $metrics['bed_occupancy_rate']; ?>%</div>
                    <div class="metric-label">Bed Occupancy Rate</div>
                    <div class="metric-change <?php echo $metrics['bed_occupancy_rate'] > 80 ? 'warning' : 'positive'; ?>">
                        <i class="fas fa-<?php echo $metrics['bed_occupancy_rate'] > 80 ? 'exclamation-triangle' : 'check-circle'; ?>"></i>
                        <?php echo $metrics['bed_occupancy_rate'] > 80 ? 'High occupancy' : 'Optimal'; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Secondary Metrics Row -->
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value">$<?php echo number_format($metrics['avg_revenue_per_patient']); ?></div>
                    <div class="metric-label">Avg Revenue per Patient</div>
                    <div class="metric-change positive">
                        <i class="fas fa-arrow-up"></i> +5.7% from last month
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row">
            <div class="col-md-8">
                <div class="chart-container">
                    <h4><i class="fas fa-chart-line"></i> Revenue Trend (Last 12 Months)</h4>
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-container">
                    <h4><i class="fas fa-chart-pie"></i> Department Performance</h4>
                    <canvas id="departmentChart" width="300" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Patient Flow and Financial Summary -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-users"></i> Patient Flow (Last 30 Days)</h4>
                    <canvas id="patientFlowChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-dollar-sign"></i> Financial Summary</h4>
                    <div class="row">
                        <div class="col-6">
                            <div class="metric-card">
                                <div class="metric-value">$<?php echo number_format($financial_summary['monthly_revenue'] ?? 0); ?></div>
                                <div class="metric-label">Monthly Revenue</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="metric-card">
                                <div class="metric-value">$<?php echo number_format($financial_summary['monthly_expenses'] ?? 0); ?></div>
                                <div class="metric-label">Monthly Expenses</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="metric-card">
                                <div class="metric-value">$<?php echo number_format($financial_summary['net_profit'] ?? 0); ?></div>
                                <div class="metric-label">Net Profit</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="metric-card">
                                <div class="metric-value"><?php echo $financial_summary['profit_margin'] ?? 0; ?>%</div>
                                <div class="metric-label">Profit Margin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Operational Efficiency -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-cogs"></i> Operational Efficiency Metrics</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value"><?php echo $operational_efficiency['avg_wait_time'] ?? 0; ?> min</div>
                                <div class="metric-label">Avg Wait Time</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-arrow-down"></i> -5 min from last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value"><?php echo $operational_efficiency['appointment_efficiency'] ?? 0; ?>%</div>
                                <div class="metric-label">Appointment Efficiency</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-arrow-up"></i> +3.2% from last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value"><?php echo $operational_efficiency['staff_utilization'] ?? 0; ?>%</div>
                                <div class="metric-label">Staff Utilization</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-arrow-up"></i> +2.1% from last month
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value"><?php echo $operational_efficiency['resource_optimization'] ?? 0; ?>%</div>
                                <div class="metric-label">Resource Optimization</div>
                                <div class="metric-change positive">
                                    <i class="fas fa-arrow-up"></i> +4.5% from last month
                                </div>
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
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
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

        // Department Performance Chart
        const departmentCtx = document.getElementById('departmentChart').getContext('2d');
        const departmentChart = new Chart(departmentCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode(array_column($department_performance, 'department_name')); ?>,
                datasets: [{
                    data: <?php echo json_encode(array_column($department_performance, 'appointment_count')); ?>,
                    backgroundColor: [
                        '#3498db',
                        '#e74c3c',
                        '#f39c12',
                        '#27ae60',
                        '#9b59b6',
                        '#1abc9c'
                    ]
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

        // Patient Flow Chart
        const patientFlowCtx = document.getElementById('patientFlowChart').getContext('2d');
        const patientFlowChart = new Chart(patientFlowCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($patient_flow, 'date')); ?>,
                datasets: [{
                    label: 'New Patients',
                    data: <?php echo json_encode(array_column($patient_flow, 'new_patients')); ?>,
                    backgroundColor: '#3498db'
                }, {
                    label: 'Discharged Patients',
                    data: <?php echo json_encode(array_column($patient_flow, 'discharged_patients')); ?>,
                    backgroundColor: '#27ae60'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Auto-refresh function
        function refreshDashboard() {
            location.reload();
        }

        // Auto-refresh every 5 minutes
        setInterval(refreshDashboard, 300000);
    </script>
        </div>
    </div>
</div>
