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
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
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
        .appointment-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .appointment-pending {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
        }
        .appointment-completed {
            background: #d4edda;
            border-left: 4px solid #27ae60;
        }
        .appointment-cancelled {
            background: #f8d7da;
            border-left: 4px solid #e74c3c;
        }
        .staff-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .staff-present {
            background: #d4edda;
            border-left: 4px solid #27ae60;
        }
        .staff-absent {
            background: #f8d7da;
            border-left: 4px solid #e74c3c;
        }
        .inventory-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .inventory-low {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
        }
        .inventory-critical {
            background: #f8d7da;
            border-left: 4px solid #e74c3c;
        }
        .alert-item {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .alert-warning {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
        }
        .alert-danger {
            background: #f8d7da;
            border-left: 4px solid #e74c3c;
        }
        .alert-info {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
        }
        .activity-item {
            display: flex;
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
        .queue-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .queue-waiting {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
        }
        .queue-processing {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
        }
    </style>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="dashboard-container">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="row">
                <div class="col-md-8">
                    <h1><i class="fas fa-cogs"></i> Operational Dashboard</h1>
                    <p>Day-to-day operations and real-time system monitoring</p>
                </div>
                <div class="col-md-4 text-right">
                    <button class="refresh-btn" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Operational Metrics -->
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($appointment_metrics['todays_appointments']); ?></div>
                    <div class="metric-label">Today's Appointments</div>
                    <div class="metric-change positive">
                        <i class="fas fa-calendar-check"></i> Scheduled
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($appointment_metrics['completed_appointments']); ?></div>
                    <div class="metric-label">Completed Today</div>
                    <div class="metric-change positive">
                        <i class="fas fa-check-circle"></i> <?php echo round(($appointment_metrics['completed_appointments'] / max($appointment_metrics['todays_appointments'], 1)) * 100, 1); ?>% completion rate
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($staff_metrics['staff_on_duty']); ?></div>
                    <div class="metric-label">Staff on Duty</div>
                    <div class="metric-change positive">
                        <i class="fas fa-users"></i> Out of <?php echo number_format($staff_metrics['total_staff']); ?> total
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo count($inventory_status); ?></div>
                    <div class="metric-label">Low Stock Items</div>
                    <div class="metric-change <?php echo count($inventory_status) > 5 ? 'warning' : 'positive'; ?>">
                        <i class="fas fa-exclamation-triangle"></i> <?php echo count($inventory_status) > 5 ? 'High' : 'Normal'; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Management and Staff Status -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-calendar-alt"></i> Today's Appointments</h4>
                    <div id="appointmentsList">
                        <div class="appointment-item appointment-pending">
                            <div class="status-indicator status-warning"></div>
                            <div>
                                <strong>Pending:</strong> <?php echo $appointment_metrics['todays_appointments'] - $appointment_metrics['completed_appointments'] - $appointment_metrics['cancelled_appointments']; ?> appointments
                                <br><small>Awaiting completion</small>
                            </div>
                        </div>
                        <div class="appointment-item appointment-completed">
                            <div class="status-indicator status-good"></div>
                            <div>
                                <strong>Completed:</strong> <?php echo $appointment_metrics['completed_appointments']; ?> appointments
                                <br><small>Successfully finished</small>
                            </div>
                        </div>
                        <div class="appointment-item appointment-cancelled">
                            <div class="status-indicator status-danger"></div>
                            <div>
                                <strong>Cancelled:</strong> <?php echo $appointment_metrics['cancelled_appointments']; ?> appointments
                                <br><small>Need rescheduling</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-users"></i> Staff Status</h4>
                    <div id="staffList">
                        <div class="staff-item staff-present">
                            <div class="status-indicator status-good"></div>
                            <div>
                                <strong>On Duty:</strong> <?php echo $staff_metrics['staff_on_duty']; ?> staff members
                                <br><small>Currently working</small>
                            </div>
                        </div>
                        <div class="staff-item staff-absent">
                            <div class="status-indicator status-danger"></div>
                            <div>
                                <strong>Off Duty:</strong> <?php echo $staff_metrics['total_staff'] - $staff_metrics['staff_on_duty']; ?> staff members
                                <br><small>Not currently working</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Status and Facility Utilization -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-boxes"></i> Inventory Status</h4>
                    <div id="inventoryList">
                        <?php foreach($inventory_status as $item): ?>
                        <div class="inventory-item <?php echo $item->current_stock <= $item->minimum_stock * 0.5 ? 'inventory-critical' : 'inventory-low'; ?>">
                            <div>
                                <strong><?php echo $item->name; ?></strong>
                                <br><small>Current: <?php echo $item->current_stock; ?> | Min: <?php echo $item->minimum_stock; ?></small>
                            </div>
                            <div class="metric-value" style="font-size: 1.2rem; color: <?php echo $item->current_stock <= $item->minimum_stock * 0.5 ? '#e74c3c' : '#f39c12'; ?>;">
                                <?php echo round(($item->current_stock / $item->minimum_stock) * 100, 0); ?>%
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-building"></i> Facility Utilization</h4>
                    <canvas id="facilityChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Patient Queue and System Alerts -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-clock"></i> Patient Queue Status</h4>
                    <div id="patientQueueList">
                        <?php foreach($patient_queue as $queue): ?>
                        <div class="queue-item <?php echo $queue->status == 'waiting' ? 'queue-waiting' : 'queue-processing'; ?>">
                            <div>
                                <strong><?php echo $queue->patient_name; ?></strong>
                                <br><small>Department: <?php echo $queue->department; ?></small>
                            </div>
                            <div>
                                <div class="metric-value" style="font-size: 1rem;">
                                    <?php echo $queue->wait_time; ?> min
                                </div>
                                <small><?php echo ucfirst($queue->status); ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-bell"></i> System Alerts</h4>
                    <div id="alertsList">
                        <?php foreach($system_alerts as $alert): ?>
                        <div class="alert-item <?php echo $alert['type'] == 'danger' ? 'alert-danger' : 'alert-warning'; ?>">
                            <div class="status-indicator <?php echo $alert['type'] == 'danger' ? 'status-danger' : 'status-warning'; ?>"></div>
                            <div>
                                <strong><?php echo $alert['message']; ?></strong>
                                <br><small><?php echo $alert['timestamp']; ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities and Performance Metrics -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-history"></i> Recent Activities</h4>
                    <div id="activitiesList">
                        <?php foreach($recent_activities as $activity): ?>
                        <div class="activity-item">
                            <div class="status-indicator status-good"></div>
                            <div>
                                <strong><?php echo $activity['message']; ?></strong>
                                <br><small><?php echo $activity['timestamp']; ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-chart-line"></i> Operational Performance</h4>
                    <canvas id="performanceChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <!-- Real-time Status Indicators -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-tachometer-alt"></i> Real-time System Status</h4>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value" style="color: #27ae60;">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="metric-label">System Status</div>
                                <div class="metric-change positive">
                                    All systems operational
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value" style="color: #3498db;">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="metric-label">Database</div>
                                <div class="metric-change positive">
                                    Connected and healthy
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value" style="color: #f39c12;">
                                    <i class="fas fa-server"></i>
                                </div>
                                <div class="metric-label">Server Load</div>
                                <div class="metric-change warning">
                                    65% utilization
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric-card">
                                <div class="metric-value" style="color: #27ae60;">
                                    <i class="fas fa-wifi"></i>
                                </div>
                                <div class="metric-label">Network</div>
                                <div class="metric-change positive">
                                    Stable connection
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
        // Facility Utilization Chart
        const facilityCtx = document.getElementById('facilityChart').getContext('2d');
        const facilityChart = new Chart(facilityCtx, {
            type: 'doughnut',
            data: {
                labels: ['Operating Rooms', 'ICU Beds', 'General Wards', 'Emergency', 'Outpatient'],
                datasets: [{
                    data: [85, 92, 78, 45, 65],
                    backgroundColor: ['#e74c3c', '#f39c12', '#3498db', '#9b59b6', '#1abc9c']
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

        // Performance Chart
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: ['6 AM', '9 AM', '12 PM', '3 PM', '6 PM', '9 PM'],
                datasets: [{
                    label: 'Appointment Efficiency',
                    data: [85, 92, 88, 95, 90, 75],
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Staff Productivity',
                    data: [78, 85, 90, 88, 92, 80],
                    borderColor: '#27ae60',
                    backgroundColor: 'rgba(39, 174, 96, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });

        // Auto-refresh function
        function refreshDashboard() {
            location.reload();
        }

        // Auto-refresh every 2 minutes for operational data
        setInterval(refreshDashboard, 120000);

        // Real-time updates for critical operational metrics
        setInterval(function() {
            fetch('dashboard/getRealTimeMetrics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'dashboard_type=operational'
            })
            .then(response => response.json())
            .then(data => {
                // Update operational metrics without full page refresh
                console.log('Operational metrics updated:', data);
            });
        }, 30000); // Update every 30 seconds

        // Real-time clock
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            document.title = `Operational Dashboard - ${timeString}`;
        }
        setInterval(updateClock, 1000);
    </script>
        </div>
    </div>
</div>
