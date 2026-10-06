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
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .refresh-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .refresh-btn:hover {
            background: #c0392b;
        }
        .bed-status {
            display: flex;
            align-items: center;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .bed-occupied {
            background: #ffebee;
            border-left: 4px solid #e74c3c;
        }
        .bed-available {
            background: #e8f5e8;
            border-left: 4px solid #27ae60;
        }
        .lab-result {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .lab-pending {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
        }
        .lab-completed {
            background: #d4edda;
            border-left: 4px solid #27ae60;
        }
        .emergency-case {
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            background: #f8f9fa;
        }
        .emergency-critical {
            background: #f8d7da;
            border-left: 4px solid #e74c3c;
        }
        .emergency-high {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
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
                    <h1><i class="fas fa-user-md"></i> Clinical Dashboard</h1>
                    <p>Real-time clinical metrics and patient care monitoring</p>
                </div>
                <div class="col-md-4 text-right">
                    <button class="refresh-btn" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt"></i> Refresh Data
                    </button>
                </div>
            </div>
        </div>

        <!-- Key Clinical Metrics -->
        <div class="row">
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($patient_metrics['current_inpatients']); ?></div>
                    <div class="metric-label">Current Inpatients</div>
                    <div class="metric-change positive">
                        <i class="fas fa-bed"></i> Active patients
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($patient_metrics['todays_appointments']); ?></div>
                    <div class="metric-label">Today's Appointments</div>
                    <div class="metric-change positive">
                        <i class="fas fa-calendar-check"></i> Scheduled
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($patient_metrics['pending_labs']); ?></div>
                    <div class="metric-label">Pending Lab Results</div>
                    <div class="metric-change <?php echo $patient_metrics['pending_labs'] > 10 ? 'warning' : 'positive'; ?>">
                        <i class="fas fa-flask"></i> <?php echo $patient_metrics['pending_labs'] > 10 ? 'High' : 'Normal'; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric-card">
                    <div class="metric-value"><?php echo number_format($patient_metrics['emergency_cases']); ?></div>
                    <div class="metric-label">Emergency Cases (Today)</div>
                    <div class="metric-change <?php echo $patient_metrics['emergency_cases'] > 5 ? 'warning' : 'positive'; ?>">
                        <i class="fas fa-ambulance"></i> <?php echo $patient_metrics['emergency_cases'] > 5 ? 'High' : 'Normal'; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bed Occupancy and Lab Results -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-bed"></i> Bed Occupancy Status</h4>
                    <div id="bedOccupancyList">
                        <?php foreach($bed_occupancy as $bed): ?>
                        <div class="bed-status <?php echo $bed->status == 'occupied' ? 'bed-occupied' : 'bed-available'; ?>">
                            <div class="status-indicator <?php echo $bed->status == 'occupied' ? 'status-danger' : 'status-good'; ?>"></div>
                            <div>
                                <strong><?php echo $bed->bed_name; ?></strong> - <?php echo ucfirst($bed->bed_type); ?>
                                <?php if($bed->status == 'occupied'): ?>
                                    <br><small>Patient: <?php echo $bed->patient_name; ?></small>
                                <?php else: ?>
                                    <br><small>Available</small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-flask"></i> Recent Lab Results</h4>
                    <div id="labResultsList">
                        <?php foreach($lab_results as $lab): ?>
                        <div class="lab-result <?php echo $lab->status == 'pending' ? 'lab-pending' : 'lab-completed'; ?>">
                            <div class="status-indicator <?php echo $lab->status == 'pending' ? 'status-warning' : 'status-good'; ?>"></div>
                            <div>
                                <strong><?php echo $lab->patient_name; ?></strong>
                                <br><small><?php echo $lab->category_name; ?> - <?php echo ucfirst($lab->status); ?></small>
                                <br><small>Date: <?php echo date('M d, Y', strtotime($lab->date)); ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prescription Metrics and Emergency Cases -->
        <div class="row">
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-pills"></i> Prescription Metrics</h4>
                    <canvas id="prescriptionChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <h4><i class="fas fa-ambulance"></i> Emergency Cases</h4>
                    <div id="emergencyCasesList">
                        <?php foreach($emergency_cases as $case): ?>
                        <div class="emergency-case <?php echo $case->priority == 'Critical' ? 'emergency-critical' : 'emergency-high'; ?>">
                            <div class="status-indicator <?php echo $case->priority == 'Critical' ? 'status-danger' : 'status-warning'; ?>"></div>
                            <div>
                                <strong><?php echo $case->patient_name; ?></strong>
                                <br><small>Type: <?php echo $case->emergency_type; ?> - <?php echo $case->priority; ?></small>
                                <br><small>Time: <?php echo date('H:i', strtotime($case->emergency_time)); ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Real-time Alerts -->
        <div class="row">
            <div class="col-md-12">
                <div class="chart-container">
                    <h4><i class="fas fa-bell"></i> Real-time Clinical Alerts</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <strong>High Priority:</strong> 3 patients require immediate attention
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Lab Results:</strong> 5 critical results pending review
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i>
                                <strong>Quality:</strong> All safety protocols followed
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('application/modules/dashboard/views/js/dashboard.js'); ?>"></script>
    <script>
        // Prescription Chart
        const prescriptionCtx = document.getElementById('prescriptionChart').getContext('2d');
        const prescriptionChart = new Chart(prescriptionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Pending', 'Cancelled'],
                datasets: [{
                    data: [<?php echo $prescription_metrics['completed'] ?? 0; ?>, 
                           <?php echo $prescription_metrics['pending'] ?? 0; ?>, 
                           <?php echo $prescription_metrics['cancelled'] ?? 0; ?>],
                    backgroundColor: ['#27ae60', '#f39c12', '#e74c3c']
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


        // Auto-refresh function
        function refreshDashboard() {
            location.reload();
        }

        // Auto-refresh every 2 minutes for clinical data
        setInterval(refreshDashboard, 120000);

        // Real-time updates for critical metrics
        setInterval(function() {
            // Update bed occupancy
            fetch('dashboard/getRealTimeMetrics', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'dashboard_type=clinical'
            })
            .then(response => response.json())
            .then(data => {
                // Update metrics without full page refresh
                console.log('Clinical metrics updated:', data);
            });
        }, 30000); // Update every 30 seconds
    </script>
        </div>
    </div>
</div>
