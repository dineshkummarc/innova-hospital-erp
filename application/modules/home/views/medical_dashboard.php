<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Dashboard</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Medical UI Styles -->
    <style>
        :root {
            /* Medical Color Palette */
            --medical-primary: #2563eb;
            --medical-secondary: #0ea5e9;
            --medical-accent: #06b6d4;
            --medical-success: #10b981;
            --medical-warning: #f59e0b;
            --medical-danger: #ef4444;
            --medical-info: #3b82f6;
            
            /* Healthcare Specific Colors */
            --cardiology: #dc2626;
            --emergency: #b91c1c;
            --neurology: #7c3aed;
            --orthopedic: #059669;
            --pediatric: #f97316;
            --radiology: #0891b2;
            --laboratory: #8b5cf6;
            --pharmacy: #16a34a;
            
            /* Background Gradients */
            --bg-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --card-gradient: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            --medical-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            
            /* Typography */
            --font-primary: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            --font-medical: 'Roboto Mono', monospace;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            
            /* Border Radius */
            --rounded-sm: 0.125rem;
            --rounded-md: 0.375rem;
            --rounded-lg: 0.5rem;
            --rounded-xl: 0.75rem;
            --rounded-2xl: 1rem;
            
            /* Spacing */
            --spacing-xs: 0.25rem;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 1.5rem;
            --spacing-xl: 2rem;
            --spacing-2xl: 3rem;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-primary);
            background: var(--bg-gradient);
            min-height: 100vh;
            color: #1f2937;
            line-height: 1.6;
        }

        /* Medical Dashboard Container */
        .medical-dashboard {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--rounded-2xl);
            margin: var(--spacing-lg);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-2xl);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Dashboard Header */
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-2xl);
            padding-bottom: var(--spacing-lg);
            border-bottom: 2px solid #e5e7eb;
        }

        .welcome-section {
            display: flex;
            align-items: center;
            gap: var(--spacing-lg);
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--medical-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .user-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .user-avatar::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: var(--medical-gradient);
            border-radius: 50%;
            z-index: -1;
        }

        .welcome-text h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: var(--medical-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: var(--spacing-xs);
        }

        .welcome-text p {
            color: #6b7280;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .header-actions {
            display: flex;
            gap: var(--spacing-md);
            align-items: center;
        }

        .action-btn {
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: var(--rounded-xl);
            padding: var(--spacing-md) var(--spacing-lg);
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .action-btn:hover {
            background: var(--medical-primary);
            color: white;
            border-color: var(--medical-primary);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .emergency-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-color: #dc2626;
            animation: pulse 2s infinite;
        }

        .emergency-btn:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: scale(1.05);
        }

        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            50% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
        }

        /* Quick Stats Grid */
        .quick-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-2xl);
        }

        .stat-card {
            background: var(--card-gradient);
            border-radius: var(--rounded-xl);
            padding: var(--spacing-lg);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent-color, var(--medical-primary));
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .stat-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: var(--spacing-md);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--rounded-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: var(--spacing-md);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: var(--spacing-xs);
        }

        .stat-label {
            font-size: 1rem;
            color: #6b7280;
            font-weight: 600;
            margin-bottom: var(--spacing-sm);
        }

        .stat-trend {
            display: flex;
            align-items: center;
            gap: var(--spacing-xs);
            font-size: 0.875rem;
            font-weight: 600;
        }

        .trend-up { color: var(--medical-success); }
        .trend-down { color: var(--medical-danger); }
        .trend-neutral { color: var(--medical-warning); }

        /* Medical Specialties Colors */
        .cardiology { --accent-color: var(--cardiology); }
        .emergency { --accent-color: var(--emergency); }
        .neurology { --accent-color: var(--neurology); }
        .orthopedic { --accent-color: var(--orthopedic); }
        .pediatric { --accent-color: var(--pediatric); }
        .radiology { --accent-color: var(--radiology); }
        .laboratory { --accent-color: var(--laboratory); }
        .pharmacy { --accent-color: var(--pharmacy); }

        /* Dashboard Sections */
        .dashboard-sections {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: var(--spacing-xl);
            margin-bottom: var(--spacing-2xl);
        }

        .main-section {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        .sidebar-section {
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        }

        /* Medical Chart Card */
        .chart-card {
            background: var(--card-gradient);
            border-radius: var(--rounded-xl);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
            padding-bottom: var(--spacing-md);
            border-bottom: 2px solid #f3f4f6;
        }

        .chart-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }

        .time-filter {
            display: flex;
            background: #f3f4f6;
            border-radius: var(--rounded-lg);
            padding: var(--spacing-xs);
        }

        .time-filter button {
            background: none;
            border: none;
            padding: var(--spacing-sm) var(--spacing-md);
            border-radius: var(--rounded-md);
            font-weight: 600;
            color: #6b7280;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .time-filter button.active {
            background: white;
            color: var(--medical-primary);
            box-shadow: var(--shadow-sm);
        }

        /* Recent Activity Feed */
        .activity-feed {
            background: var(--card-gradient);
            border-radius: var(--rounded-xl);
            padding: var(--spacing-xl);
            box-shadow: var(--shadow-lg);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing-lg);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            padding: var(--spacing-md);
            border-radius: var(--rounded-lg);
            transition: background-color 0.2s ease;
            border-left: 4px solid transparent;
        }

        .activity-item:hover {
            background: rgba(243, 244, 246, 0.5);
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: white;
        }

        .activity-content {
            flex: 1;
        }

        .activity-title {
            font-weight: 600;
            color: #1f2937;
            margin-bottom: var(--spacing-xs);
        }

        .activity-subtitle {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .activity-time {
            font-size: 0.75rem;
            color: #9ca3af;
            font-weight: 500;
        }

        /* Critical Alerts */
        .critical-alerts {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border: 2px solid #fecaca;
            border-radius: var(--rounded-xl);
            padding: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }

        .alert-header {
            display: flex;
            align-items: center;
            gap: var(--spacing-sm);
            margin-bottom: var(--spacing-md);
        }

        .alert-icon {
            width: 24px;
            height: 24px;
            color: var(--medical-danger);
        }

        .alert-title {
            font-weight: 700;
            color: var(--medical-danger);
        }

        .alert-item {
            background: white;
            border-radius: var(--rounded-lg);
            padding: var(--spacing-md);
            margin-bottom: var(--spacing-sm);
            border-left: 4px solid var(--medical-danger);
            box-shadow: var(--shadow-sm);
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--spacing-md);
            margin-bottom: var(--spacing-xl);
        }

        .quick-action {
            background: var(--card-gradient);
            border-radius: var(--rounded-xl);
            padding: var(--spacing-lg);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: var(--spacing-md);
            box-shadow: var(--shadow-md);
        }

        .quick-action:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            border-color: var(--medical-primary);
            color: inherit;
            text-decoration: none;
        }

        .quick-action-icon {
            width: 60px;
            height: 60px;
            border-radius: var(--rounded-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            background: var(--medical-gradient);
        }

        .quick-action-title {
            font-weight: 700;
            color: #1f2937;
        }

        .quick-action-desc {
            font-size: 0.875rem;
            color: #6b7280;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .dashboard-sections {
                grid-template-columns: 1fr;
            }
            
            .welcome-text h1 {
                font-size: 2rem;
            }
            
            .medical-dashboard {
                margin: var(--spacing-md);
                padding: var(--spacing-lg);
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                gap: var(--spacing-lg);
                text-align: center;
            }
            
            .header-actions {
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .quick-stats {
                grid-template-columns: 1fr;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }

        /* Loading Animation */
        .loading-pulse {
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Medical Equipment Icons */
        .medical-icon {
            background: var(--medical-gradient);
        }

        /* Department Status Indicators */
        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: var(--spacing-xs);
        }

        .status-active { background: var(--medical-success); }
        .status-warning { background: var(--medical-warning); }
        .status-critical { background: var(--medical-danger); }
        .status-maintenance { background: #6b7280; }
    </style>
</head>
<body>
    <div class="medical-dashboard">
        <!-- Dashboard Header -->
        <div class="dashboard-header">
            <div class="welcome-section">
                <div class="user-avatar">
                    <img src="<?php echo $user_image ? base_url() . $user_image : base_url() . 'uploads/default.png'; ?>" alt="User Avatar">
                </div>
                <div class="welcome-text">
                    <h1>Welcome, Dr. <?php echo $this->ion_auth->user()->row()->username ?? 'Admin'; ?>!</h1>
                    <p>Medical Command Center - <?php echo $settings->title ?? 'Healthcare System'; ?></p>
                </div>
            </div>
            <div class="header-actions">
                <a href="#" class="action-btn">
                    <i class="fas fa-bell"></i>
                    Notifications
                </a>
                <a href="#" class="action-btn emergency-btn">
                    <i class="fas fa-exclamation-triangle"></i>
                    Emergency
                </a>
            </div>
        </div>

        <!-- Critical Alerts Section -->
        <div class="critical-alerts">
            <div class="alert-header">
                <i class="fas fa-exclamation-triangle alert-icon"></i>
                <h3 class="alert-title">Critical Alerts</h3>
            </div>
            <div class="alert-item">
                <strong>ICU Bed Capacity:</strong> Only 2 beds available - Consider patient transfer protocols
            </div>
            <div class="alert-item">
                <strong>Emergency Equipment:</strong> Ventilator #3 requires immediate maintenance
            </div>
        </div>

        <!-- Quick Stats Grid -->
        <div class="quick-stats">
            <div class="stat-card emergency">
                <div class="stat-icon" style="background: var(--emergency);">
                    <i class="fas fa-ambulance"></i>
                </div>
                <div class="stat-number"><?php echo $totalPatients ?? '247'; ?></div>
                <div class="stat-label">Total Patients</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    +12% from yesterday
                </div>
            </div>

            <div class="stat-card cardiology">
                <div class="stat-icon" style="background: var(--cardiology);">
                    <i class="fas fa-heartbeat"></i>
                </div>
                <div class="stat-number"><?php echo $admittedToday ?? '18'; ?></div>
                <div class="stat-label">Today's Admissions</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    +8 since morning
                </div>
            </div>

            <div class="stat-card neurology">
                <div class="stat-icon" style="background: var(--neurology);">
                    <i class="fas fa-brain"></i>
                </div>
                <div class="stat-number"><?php echo $surgeriesToday ?? '6'; ?></div>
                <div class="stat-label">Active Surgeries</div>
                <div class="stat-trend trend-neutral">
                    <i class="fas fa-clock"></i>
                    2 completed today
                </div>
            </div>

            <div class="stat-card orthopedic">
                <div class="stat-icon" style="background: var(--orthopedic);">
                    <i class="fas fa-user-md"></i>
                </div>
                <div class="stat-number"><?php echo $staffOnDuty ?? '89'; ?></div>
                <div class="stat-label">Staff on Duty</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-check-circle"></i>
                    Full capacity
                </div>
            </div>

            <div class="stat-card laboratory">
                <div class="stat-icon" style="background: var(--laboratory);">
                    <i class="fas fa-flask"></i>
                </div>
                <div class="stat-number"><?php echo $labTests ?? '342'; ?></div>
                <div class="stat-label">Lab Tests Pending</div>
                <div class="stat-trend trend-down">
                    <i class="fas fa-arrow-down"></i>
                    -15% processing time
                </div>
            </div>

            <div class="stat-card pharmacy">
                <div class="stat-icon" style="background: var(--pharmacy);">
                    <i class="fas fa-pills"></i>
                </div>
                <div class="stat-number"><?php echo $prescriptions ?? '156'; ?></div>
                <div class="stat-label">Prescriptions Filled</div>
                <div class="stat-trend trend-up">
                    <i class="fas fa-arrow-up"></i>
                    95% fulfillment rate
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="patients/add" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="quick-action-title">Add Patient</div>
                <div class="quick-action-desc">Register new patient</div>
            </a>

            <a href="appointments" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="quick-action-title">Appointments</div>
                <div class="quick-action-desc">Manage schedules</div>
            </a>

            <a href="inventory" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="quick-action-title">Inventory</div>
                <div class="quick-action-desc">Medical supplies</div>
            </a>

            <a href="laboratory" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-microscope"></i>
                </div>
                <div class="quick-action-title">Laboratory</div>
                <div class="quick-action-desc">Lab results & tests</div>
            </a>

            <a href="pharmacy" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-prescription-bottle"></i>
                </div>
                <div class="quick-action-title">Pharmacy</div>
                <div class="quick-action-desc">Medication management</div>
            </a>

            <a href="reports" class="quick-action">
                <div class="quick-action-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="quick-action-title">Reports</div>
                <div class="quick-action-desc">Analytics & insights</div>
            </a>
        </div>

        <!-- Dashboard Sections -->
        <div class="dashboard-sections">
            <!-- Main Section -->
            <div class="main-section">
                <!-- Patient Flow Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Patient Flow Analytics</h3>
                        <div class="time-filter">
                            <button class="active">Today</button>
                            <button>Week</button>
                            <button>Month</button>
                        </div>
                    </div>
                    <div id="patientFlowChart" style="height: 300px; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 1.1rem;">
                        <div style="text-align: center;">
                            <i class="fas fa-chart-area" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                            <div>Patient Flow Chart will be rendered here</div>
                            <div style="font-size: 0.9rem; margin-top: 0.5rem;">Integration with Chart.js or similar library</div>
                        </div>
                    </div>
                </div>

                <!-- Department Status -->
                <div class="chart-card">
                    <div class="chart-header">
                        <h3 class="chart-title">Department Status</h3>
                        <div style="display: flex; gap: 1rem; align-items: center;">
                            <span style="display: flex; align-items: center; gap: 0.5rem;">
                                <span class="status-indicator status-active"></span>
                                Active
                            </span>
                            <span style="display: flex; align-items: center; gap: 0.5rem;">
                                <span class="status-indicator status-warning"></span>
                                Warning
                            </span>
                            <span style="display: flex; align-items: center; gap: 0.5rem;">
                                <span class="status-indicator status-critical"></span>
                                Critical
                            </span>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; border-left: 4px solid var(--medical-success);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-weight: 600;">Emergency Department</span>
                                <span class="status-indicator status-active"></span>
                            </div>
                            <div style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">92% capacity • 8 patients waiting</div>
                        </div>
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; border-left: 4px solid var(--medical-warning);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-weight: 600;">Intensive Care Unit</span>
                                <span class="status-indicator status-warning"></span>
                            </div>
                            <div style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">97% capacity • 2 beds available</div>
                        </div>
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; border-left: 4px solid var(--medical-success);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-weight: 600;">Operating Theaters</span>
                                <span class="status-indicator status-active"></span>
                            </div>
                            <div style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">6 active surgeries • 2 available</div>
                        </div>
                        <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; border-left: 4px solid var(--medical-success);">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-weight: 600;">Laboratory</span>
                                <span class="status-indicator status-active"></span>
                            </div>
                            <div style="color: #64748b; font-size: 0.875rem; margin-top: 0.25rem;">Normal operations • 15 min avg wait</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <div class="sidebar-section">
                <!-- Recent Activity -->
                <div class="activity-feed">
                    <div class="activity-header">
                        <h3 style="color: #1f2937; font-weight: 700;">Recent Activity</h3>
                        <button style="background: none; border: none; color: var(--medical-primary); font-weight: 600; cursor: pointer;">View All</button>
                    </div>
                    <div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--medical-success);">
                                <i class="fas fa-user-check"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Patient Admitted</div>
                                <div class="activity-subtitle">John Doe - Room 302</div>
                            </div>
                            <div class="activity-time">2 min ago</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--laboratory);">
                                <i class="fas fa-flask"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Lab Results Ready</div>
                                <div class="activity-subtitle">Blood Test - Patient #12847</div>
                            </div>
                            <div class="activity-time">5 min ago</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--cardiology);">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Surgery Completed</div>
                                <div class="activity-subtitle">Cardiac Procedure - OR 3</div>
                            </div>
                            <div class="activity-time">12 min ago</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--pharmacy);">
                                <i class="fas fa-pills"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Medication Dispensed</div>
                                <div class="activity-subtitle">Prescription #PX-4829</div>
                            </div>
                            <div class="activity-time">18 min ago</div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon" style="background: var(--medical-info);">
                                <i class="fas fa-ambulance"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-title">Emergency Arrival</div>
                                <div class="activity-subtitle">Trauma Case - ETA 5 minutes</div>
                            </div>
                            <div class="activity-time">25 min ago</div>
                        </div>
                    </div>
                </div>

                <!-- Quick Stats Summary -->
                <div class="chart-card">
                    <h3 style="color: #1f2937; font-weight: 700; margin-bottom: 1rem;">Today's Summary</h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                            <span style="font-weight: 600; color: #374151;">Scheduled Appointments</span>
                            <span style="font-weight: 700; color: var(--medical-primary);"><?php echo $appointmentsToday ?? '47'; ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                            <span style="font-weight: 600; color: #374151;">Completed Consultations</span>
                            <span style="font-weight: 700; color: var(--medical-success);"><?php echo $consultationsCompleted ?? '34'; ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                            <span style="font-weight: 600; color: #374151;">Revenue Today</span>
                            <span style="font-weight: 700; color: var(--medical-success);">$<?php echo number_format($revenueToday ?? 25840, 0); ?></span>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: #f8fafc; border-radius: 8px;">
                            <span style="font-weight: 600; color: #374151;">Insurance Claims</span>
                            <span style="font-weight: 700; color: var(--medical-warning);"><?php echo $insuranceClaims ?? '12'; ?> pending</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Interactivity -->
    <script>
        // Add loading states and interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Simulate real-time updates
            setInterval(function() {
                updateActivityFeed();
            }, 30000); // Update every 30 seconds

            // Add click handlers for quick actions
            document.querySelectorAll('.quick-action').forEach(function(action) {
                action.addEventListener('click', function(e) {
                    // Add loading state
                    this.style.opacity = '0.7';
                    setTimeout(() => {
                        this.style.opacity = '1';
                    }, 200);
                });
            });

            // Time filter functionality
            document.querySelectorAll('.time-filter button').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('.time-filter button').forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    // Update chart data based on selection
                    updateChart(this.textContent.toLowerCase());
                });
            });
        });

        function updateActivityFeed() {
            // Simulate new activity
            const activities = document.querySelectorAll('.activity-item');
            if (activities.length > 0) {
                activities[0].style.backgroundColor = 'rgba(59, 130, 246, 0.1)';
                setTimeout(() => {
                    activities[0].style.backgroundColor = '';
                }, 2000);
            }
        }

        function updateChart(period) {
            const chart = document.getElementById('patientFlowChart');
            chart.innerHTML = '<div style="text-align: center; color: #64748b;"><i class="fas fa-spinner fa-spin" style="font-size: 2rem;"></i><br>Loading ' + period + ' data...</div>';
            
            setTimeout(() => {
                chart.innerHTML = '<div style="text-align: center;"><i class="fas fa-chart-area" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5; color: #64748b;"></i><div style="color: #64748b;">Patient Flow Chart - ' + period.charAt(0).toUpperCase() + period.slice(1) + ' View</div></div>';
            }, 1000);
        }

        // Emergency button alert
        document.querySelector('.emergency-btn').addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('This will activate emergency protocols. Are you sure?')) {
                alert('Emergency protocols activated! All relevant staff have been notified.');
            }
        });
    </script>
</body>
</html>
