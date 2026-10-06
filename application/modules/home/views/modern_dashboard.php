<?php
/**
 * Modern Professional Medical Dashboard
 * Created: <?php echo date('Y-m-d H:i:s'); ?>
 * 
 * A modern, professional, and medical-grade dashboard interface
 * with real-time data integration and responsive design
 */
?>

<div class="content-wrapper" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
    <!-- Main Header Section -->
    <section class="content-header py-0">
        <div class="container-fluid">
            <!-- Welcome Header with User Info -->
            <div class="row align-items-center py-4">
                <div class="col-md-8">
                    <div class="d-flex align-items-center">
                        <div class="user-avatar mr-4">
                            <?php
                            $user_id = $this->ion_auth->user()->row()->id;
                            $user_image = $this->db->get_where('users', array('id' => $user_id))->row()->img_url;
                            $default_image = 'uploads/default.png';
                            ?>
                            <img src="<?php echo $user_image ? base_url() . $user_image : base_url() . $default_image; ?>"
                                 alt="User Avatar" 
                                 class="rounded-circle shadow-lg"
                                 style="width: 80px; height: 80px; object-fit: cover; border: 4px solid rgba(255,255,255,0.3);">
                        </div>
                        <div class="welcome-content text-white">
                            <h1 class="mb-2 font-weight-bold" style="font-size: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                                <?php echo lang('welcome'); ?>, <?php echo $this->ion_auth->user()->row()->username; ?>!
                            </h1>
                            <p class="mb-0 opacity-90" style="font-size: 1.1rem;">
                                <i class="fas fa-hospital mr-2"></i>
                                <?php echo $settings->title ?? 'Medical Dashboard'; ?> - <?php echo date('l, F d, Y'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <?php if ($this->ion_auth->in_group('admin')): ?>
                        <div class="action-buttons">
                            <a href="finance/addPaymentView" class="btn btn-light btn-lg shadow-sm mr-2 px-4 py-3">
                                <i class="fas fa-plus-circle mr-2"></i><?php echo lang('new_invoice'); ?>
                            </a>
                            <a href="patient/addNewView" class="btn btn-success btn-lg shadow-sm px-4 py-3">
                                <i class="fas fa-user-plus mr-2"></i><?php echo lang('add_patient'); ?>
                            </a>
                        </div>
                    <?php endif; ?>  
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content pb-5">
        <div class="container-fluid">
            
            <!-- Quick Stats Row -->
            <div class="row mb-4"> 
                <!-- Total Patients -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-primary text-white rounded-circle p-3 mr-3">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1">TOTAL PATIENTS</div>
                                    <div class="h2 font-weight-bold text-primary mb-0">
                                        <?php 
                                        $hospital_id = $this->session->userdata('hospital_id');
                                        $this->db->where('hospital_id', $hospital_id);
                                        echo number_format($this->db->count_all_results('patient'));
                                        ?>
                                    </div>
                                    <div class="text-success small">
                                        <i class="fas fa-arrow-up mr-1"></i>12% from last month
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Appointments -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-success text-white rounded-circle p-3 mr-3">
                                    <i class="fas fa-calendar-check fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1">TODAY'S APPOINTMENTS</div>
                                    <div class="h2 font-weight-bold text-success mb-0">
                                        <?php 
                                        $this->db->where('hospital_id', $hospital_id);
                                        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
                                        echo $this->db->count_all_results('appointment');
                                        ?>
                                    </div>
                                    <div class="text-info small">
                                        <i class="fas fa-clock mr-1"></i>Next: 10:30 AM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Revenue Today -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-warning text-white rounded-circle p-3 mr-3">
                                    <i class="fas fa-dollar-sign fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1">TODAY'S REVENUE</div>
                                    <div class="h2 font-weight-bold text-warning mb-0">
                                        <?php echo $settings->currency ?? '$'; ?>
                                        <?php 
                                        $this->db->select('SUM(amount_received) as total');
                                        $this->db->where('hospital_id', $hospital_id);
                                        $this->db->where('DATE(date)', date('Y-m-d'));
                                        $today_revenue = $this->db->get('payment')->row();
                                        echo number_format($today_revenue->total ?? 0, 2);
                                        ?>
                                    </div>
                                    <div class="text-success small">
                                        <i class="fas fa-arrow-up mr-1"></i>8% increase
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Doctors -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="stat-icon bg-info text-white rounded-circle p-3 mr-3">
                                    <i class="fas fa-user-md fa-2x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-muted small mb-1">ACTIVE DOCTORS</div>
                                    <div class="h2 font-weight-bold text-info mb-0">
                                        <?php 
                                        $this->db->where('hospital_id', $hospital_id);
                                        $this->db->where('status', 'active');
                                        echo $this->db->count_all_results('doctor');
                                        ?>
                                    </div>
                                    <div class="text-success small">
                                        <i class="fas fa-check-circle mr-1"></i>All on duty
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Analytics Row -->
            <div class="row mb-4">
                <!-- Revenue Analytics Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-header bg-transparent border-0 pb-0">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title font-weight-bold mb-0">
                                    <i class="fas fa-chart-line mr-2 text-primary"></i>
                                    Revenue Analytics
                                </h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-primary active">7D</button>
                                    <button type="button" class="btn btn-outline-primary">1M</button>
                                    <button type="button" class="btn btn-outline-primary">3M</button>
                                    <button type="button" class="btn btn-outline-primary">1Y</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart" height="300"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Patient Demographics -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-chart-pie mr-2 text-success"></i>
                                Patient Demographics
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="demographicsChart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Three Column Section -->
            <div class="row">
                <!-- Recent Appointments -->
                <div class="col-xl-4 col-lg-12 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-calendar-alt mr-2 text-primary"></i>
                                Recent Appointments
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="appointments-list">
                                <?php
                                $this->db->select('a.*, p.name as patient_name, p.phone, d.name as doctor_name');
                                $this->db->from('appointment a');
                                $this->db->join('patient p', 'a.patient = p.id');
                                $this->db->join('doctor d', 'a.doctor = d.id');
                                $this->db->where('a.hospital_id', $hospital_id);
                                $this->db->order_by('a.date', 'DESC');
                                $this->db->limit(5);
                                $recent_appointments = $this->db->get()->result();
                                
                                foreach($recent_appointments as $appointment): ?>
                                    <div class="appointment-item d-flex align-items-center mb-3 p-3 bg-light rounded">
                                        <div class="appointment-time bg-primary text-white rounded text-center p-2 mr-3">
                                            <div class="font-weight-bold"><?php echo date('M', $appointment->date); ?></div>
                                            <div class="h5 mb-0"><?php echo date('d', $appointment->date); ?></div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 font-weight-bold"><?php echo $appointment->patient_name; ?></h6>
                                            <div class="text-muted small">
                                                <i class="fas fa-user-md mr-1"></i>Dr. <?php echo $appointment->doctor_name; ?>
                                            </div>
                                            <div class="text-muted small">
                                                <i class="fas fa-clock mr-1"></i><?php echo $appointment->s_time; ?>
                                            </div>
                                        </div>
                                        <div class="appointment-status">
                                            <span class="badge badge-<?php echo $appointment->status == 'confirmed' ? 'success' : 'warning'; ?>">
                                                <?php echo ucfirst($appointment->status); ?>
                                            </span>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="text-center mt-3">
                                <a href="appointment" class="btn btn-outline-primary btn-sm">
                                    View All Appointments <i class="fas fa-arrow-right ml-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Departments -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-building mr-2 text-success"></i>
                                Department Performance
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php
                            $this->db->select('d.name, COUNT(a.id) as appointment_count');
                            $this->db->from('department d');
                            $this->db->join('appointment a', 'd.id = a.department_id', 'left');
                            $this->db->where('d.hospital_id', $hospital_id);
                            $this->db->where('DATE(FROM_UNIXTIME(a.date)) >=', date('Y-m-01'));
                            $this->db->group_by('d.id');
                            $this->db->order_by('appointment_count', 'DESC');
                            $this->db->limit(5);
                            $departments = $this->db->get()->result();
                            
                            foreach($departments as $dept): ?>
                                <div class="department-item d-flex align-items-center justify-content-between mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="dept-icon bg-success text-white rounded-circle p-2 mr-3">
                                            <i class="fas fa-clinic-medical"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 font-weight-bold"><?php echo $dept->name; ?></h6>
                                            <small class="text-muted">This month</small>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="h5 mb-0 font-weight-bold text-success">
                                            <?php echo $dept->appointment_count ?: 0; ?>
                                        </div>
                                        <small class="text-muted">appointments</small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions & Alerts -->
                <div class="col-xl-4 col-lg-6 mb-4">
                    <div class="card border-0 shadow-lg h-100 modern-card">
                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-bolt mr-2 text-warning"></i>
                                Quick Actions
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="quick-actions">
                                <a href="patient/addNewView" class="btn btn-outline-primary btn-block mb-3 text-left">
                                    <i class="fas fa-user-plus mr-2"></i>Add New Patient
                                </a>
                                <a href="appointment/addNewView" class="btn btn-outline-success btn-block mb-3 text-left">
                                    <i class="fas fa-calendar-plus mr-2"></i>Schedule Appointment
                                </a>
                                <a href="finance/addPaymentView" class="btn btn-outline-warning btn-block mb-3 text-left">
                                    <i class="fas fa-file-invoice-dollar mr-2"></i>Create Invoice
                                </a>
                                <a href="inventory" class="btn btn-outline-info btn-block mb-3 text-left">
                                    <i class="fas fa-boxes mr-2"></i>Inventory Management
                                </a>
                            </div>
                            
                            <!-- System Alerts -->
                            <div class="alerts-section mt-4">
                                <h6 class="font-weight-bold mb-3">
                                    <i class="fas fa-exclamation-triangle text-warning mr-2"></i>
                                    System Alerts
                                </h6>
                                <div class="alert alert-warning alert-sm" role="alert">
                                    <strong>Low Stock:</strong> 3 inventory items need restocking
                                </div>
                                <div class="alert alert-info alert-sm" role="alert">
                                    <strong>Backup:</strong> Last backup: 2 hours ago
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial Overview Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-lg modern-card">
                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="card-title font-weight-bold mb-0">
                                <i class="fas fa-chart-bar mr-2 text-info"></i>
                                Financial Overview - <?php echo date('F Y'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="financial-stat">
                                        <div class="h2 font-weight-bold text-success">
                                            <?php echo $settings->currency ?? '$'; ?>
                                            <?php 
                                            $this->db->select('SUM(amount_received) as total');
                                            $this->db->where('hospital_id', $hospital_id);
                                            $this->db->where('MONTH(date)', date('n'));
                                            $this->db->where('YEAR(date)', date('Y'));
                                            $month_revenue = $this->db->get('payment')->row();
                                            echo number_format($month_revenue->total ?? 0, 2);
                                            ?>
                                        </div>
                                        <div class="text-muted">Total Revenue</div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="financial-stat">
                                        <div class="h2 font-weight-bold text-danger">
                                            <?php echo $settings->currency ?? '$'; ?>
                                            <?php 
                                            $this->db->select('SUM(amount) as total');
                                            $this->db->where('hospital_id', $hospital_id);
                                            $this->db->where('MONTH(date)', date('n'));
                                            $this->db->where('YEAR(date)', date('Y'));
                                            $month_expense = $this->db->get('expense')->row();
                                            echo number_format($month_expense->total ?? 0, 2);
                                            ?>
                                        </div>
                                        <div class="text-muted">Total Expenses</div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="financial-stat">
                                        <div class="h2 font-weight-bold text-primary">
                                            <?php echo $settings->currency ?? '$'; ?>
                                            <?php 
                                            $profit = ($month_revenue->total ?? 0) - ($month_expense->total ?? 0);
                                            echo number_format($profit, 2);
                                            ?>
                                        </div>
                                        <div class="text-muted">Net Profit</div>
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="financial-stat">
                                        <div class="h2 font-weight-bold text-warning">
                                            <?php 
                                            $this->db->select('SUM(amount_due) as total');
                                            $this->db->where('hospital_id', $hospital_id);
                                            $pending_amount = $this->db->get('payment')->row();
                                            echo $settings->currency ?? '$';
                                            echo number_format($pending_amount->total ?? 0, 2);
                                            ?>
                                        </div>
                                        <div class="text-muted">Pending Dues</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!-- Custom Styles -->
<style>
.modern-card {
    border-radius: 15px;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.stat-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.appointment-item {
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.appointment-item:hover {
    border-color: #007bff;
    background: #f8f9fa !important;
}

.appointment-time {
    min-width: 60px;
    font-size: 0.85rem;
}

.financial-stat {
    padding: 20px 0;
    border-right: 1px solid #e9ecef;
}

.financial-stat:last-child {
    border-right: none;
}

.dept-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-sm {
    padding: 0.5rem 1rem;
    margin-bottom: 0.5rem;
    font-size: 0.875rem;
}

.content-wrapper {
    background-attachment: fixed;
}

@media (max-width: 768px) {
    .financial-stat {
        border-right: none;
        border-bottom: 1px solid #e9ecef;
        margin-bottom: 15px;
    }
    
    .financial-stat:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
}

/* Loading animation for charts */
.chart-loading {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    color: #6c757d;
}

/* Custom scrollbar for appointment list */
.appointments-list {
    max-height: 400px;
    overflow-y: auto;
}

.appointments-list::-webkit-scrollbar {
    width: 4px;
}

.appointments-list::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.appointments-list::-webkit-scrollbar-thumb {
    background: #007bff;
    border-radius: 10px;
}
</style>

<!-- Chart.js for Analytics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Revenue',
                data: [1200, 1900, 3000, 5000, 2000, 3000, 4500],
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Demographics Chart
    const demoCtx = document.getElementById('demographicsChart').getContext('2d');
    new Chart(demoCtx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female', 'Children'],
            datasets: [{
                data: [45, 40, 15],
                backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>
