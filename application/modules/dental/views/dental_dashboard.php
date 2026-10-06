<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/dental/dental_examination.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-tooth mr-3 text-primary"></i>
                        <?php echo lang('dental_dashboard'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="dental" class="text-primary"><?php echo lang('dental_examinations'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('dashboard'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Quick Actions -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-3">
                            <div class="d-flex flex-wrap">
                                <a href="<?php echo base_url(); ?>dental/create_examination" class="btn btn-primary btn-lg mr-3 mb-2">
                                    <i class="fas fa-plus mr-2"></i><?php echo lang('new_examination'); ?>
                                </a>
                                <a href="<?php echo base_url(); ?>dental" class="btn btn-info btn-lg mr-3 mb-2">
                                    <i class="fas fa-list mr-2"></i><?php echo lang('all_examinations'); ?>
                                </a>
                                <a href="<?php echo base_url(); ?>patient" class="btn btn-success btn-lg mr-3 mb-2">
                                    <i class="fas fa-users mr-2"></i><?php echo lang('patients'); ?>
                                </a>
                                <a href="<?php echo base_url(); ?>appointment" class="btn btn-warning btn-lg mr-3 mb-2">
                                    <i class="fas fa-calendar mr-2"></i><?php echo lang('appointments'); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $stats['total_examinations']; ?></h3>
                            <p><?php echo lang('total_examinations'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tooth"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>dental" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $stats['examinations_this_month']; ?></h3>
                            <p><?php echo lang('this_month'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>dental" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $stats['examinations_today']; ?></h3>
                            <p><?php echo lang('today'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>dental" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $stats['pending_treatments']; ?></h3>
                            <p><?php echo lang('pending_treatments'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>dental" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Stats -->
            <div class="row mb-4">
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo $stats['completed_treatments_this_month']; ?></h3>
                            <p><?php echo lang('completed_treatments_this_month'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>dental" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-teal">
                        <div class="inner">
                            <h3><?php echo count($upcoming_appointments); ?></h3>
                            <p><?php echo lang('upcoming_appointments'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="<?php echo base_url(); ?>appointment" class="small-box-footer">
                            <?php echo lang('more_info'); ?> <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Recent Examinations -->
                <div class="col-lg-8 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-history mr-2"></i><?php echo lang('recent_examinations'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <?php if (!empty($recent_examinations)): ?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th><?php echo lang('patient'); ?></th>
                                                <th><?php echo lang('doctor'); ?></th>
                                                <th><?php echo lang('date'); ?></th>
                                                <th><?php echo lang('status'); ?></th>
                                                <th><?php echo lang('actions'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($recent_examinations as $examination): ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center mr-2">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                            <div>
                                                                <strong><?php echo htmlspecialchars($examination->patient_name); ?></strong>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo htmlspecialchars($examination->doctor_name); ?></span>
                                                    </td>
                                                    <td>
                                                        <small><?php echo date('M d, Y', strtotime($examination->examination_date)); ?></small>
                                                        <br><small class="text-muted"><?php echo date('h:i A', strtotime($examination->examination_date)); ?></small>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $status_class = '';
                                                        switch ($examination->status) {
                                                            case 'completed':
                                                                $status_class = 'badge-success';
                                                                break;
                                                            case 'follow_up_required':
                                                                $status_class = 'badge-warning';
                                                                break;
                                                            case 'draft':
                                                                $status_class = 'badge-secondary';
                                                                break;
                                                            default:
                                                                $status_class = 'badge-light';
                                                        }
                                                        ?>
                                                        <span class="badge <?php echo $status_class; ?>">
                                                            <?php echo ucfirst(str_replace('_', ' ', $examination->status)); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="<?php echo base_url(); ?>dental/view_examination/<?php echo $examination->id; ?>" 
                                                               class="btn btn-info btn-sm" title="<?php echo lang('view'); ?>">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="<?php echo base_url(); ?>dental/edit_examination/<?php echo $examination->id; ?>" 
                                                               class="btn btn-primary btn-sm" title="<?php echo lang('edit'); ?>">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-tooth fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted"><?php echo lang('no_recent_examinations'); ?></h5>
                                    <p class="text-muted"><?php echo lang('start_by_creating_your_first_dental_examination'); ?></p>
                                    <a href="<?php echo base_url(); ?>dental/create_examination" class="btn btn-primary">
                                        <i class="fas fa-plus mr-2"></i><?php echo lang('create_examination'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="col-lg-4 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-success py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-calendar-alt mr-2"></i><?php echo lang('upcoming_appointments'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-3">
                            <?php if (!empty($upcoming_appointments)): ?>
                                <div class="timeline">
                                    <?php foreach ($upcoming_appointments as $appointment): ?>
                                        <div class="appointment-item border-left border-primary pl-3 pb-3 mb-3">
                                            <div class="appointment-time">
                                                <small class="text-primary font-weight-bold">
                                                    <?php echo date('M d, Y', strtotime($appointment->next_appointment)); ?>
                                                </small>
                                                <br>
                                                <small class="text-muted">
                                                    <?php echo date('h:i A', strtotime($appointment->next_appointment)); ?>
                                                </small>
                                            </div>
                                            <div class="appointment-details mt-2">
                                                <h6 class="mb-1"><?php echo htmlspecialchars($appointment->patient_name); ?></h6>
                                                <small class="text-muted">
                                                    Dr. <?php echo htmlspecialchars($appointment->doctor_name); ?>
                                                </small>
                                            </div>
                                            <div class="appointment-actions mt-2">
                                                <a href="<?php echo base_url(); ?>dental/view_examination/<?php echo $appointment->id; ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye mr-1"></i><?php echo lang('view'); ?>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-4">
                                    <i class="fas fa-calendar-times fa-2x text-muted mb-3"></i>
                                    <p class="text-muted"><?php echo lang('no_upcoming_appointments'); ?></p>
                                    <a href="<?php echo base_url(); ?>appointment" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus mr-1"></i><?php echo lang('schedule_appointment'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats Charts Row -->
            <div class="row">
                <!-- Monthly Examinations Chart -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-info py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-chart-line mr-2"></i><?php echo lang('monthly_examinations_trend'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <canvas id="monthlyExaminationsChart" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Treatment Status Distribution -->
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-warning py-3">
                            <h3 class="card-title text-dark mb-0">
                                <i class="fas fa-chart-pie mr-2"></i><?php echo lang('treatment_status_distribution'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <canvas id="treatmentStatusChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Common Procedures -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-secondary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-tools mr-2"></i><?php echo lang('common_dental_procedures'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-3 col-6 text-center mb-4">
                                    <div class="procedure-card p-3 border rounded hover-shadow">
                                        <i class="fas fa-tooth fa-3x text-primary mb-3"></i>
                                        <h6 class="font-weight-bold"><?php echo lang('cleaning'); ?></h6>
                                        <p class="text-muted small"><?php echo lang('professional_cleaning_and_scaling'); ?></p>
                                        <span class="badge badge-primary">$80</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 text-center mb-4">
                                    <div class="procedure-card p-3 border rounded hover-shadow">
                                        <i class="fas fa-fill-drip fa-3x text-info mb-3"></i>
                                        <h6 class="font-weight-bold"><?php echo lang('filling'); ?></h6>
                                        <p class="text-muted small"><?php echo lang('composite_or_amalgam_filling'); ?></p>
                                        <span class="badge badge-info">$150-200</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 text-center mb-4">
                                    <div class="procedure-card p-3 border rounded hover-shadow">
                                        <i class="fas fa-crown fa-3x text-warning mb-3"></i>
                                        <h6 class="font-weight-bold"><?php echo lang('crown'); ?></h6>
                                        <p class="text-muted small"><?php echo lang('porcelain_or_metal_crown'); ?></p>
                                        <span class="badge badge-warning">$800</span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6 text-center mb-4">
                                    <div class="procedure-card p-3 border rounded hover-shadow">
                                        <i class="fas fa-cut fa-3x text-danger mb-3"></i>
                                        <h6 class="font-weight-bold"><?php echo lang('extraction'); ?></h6>
                                        <p class="text-muted small"><?php echo lang('simple_or_surgical_extraction'); ?></p>
                                        <span class="badge badge-danger">$100-250</span>
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function() {
    // Monthly Examinations Chart
    const monthlyCtx = document.getElementById('monthlyExaminationsChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Examinations',
                data: [12, 19, 15, 25, 22, 30, 28, 35, 32, 40, 38, 45],
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
                    beginAtZero: true
                }
            }
        }
    });

    // Treatment Status Chart
    const statusCtx = document.getElementById('treatmentStatusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'In Progress', 'Planned', 'Cancelled'],
            datasets: [{
                data: [<?php echo $stats['completed_treatments_this_month']; ?>, 5, <?php echo $stats['pending_treatments']; ?>, 2],
                backgroundColor: ['#28a745', '#ffc107', '#17a2b8', '#dc3545'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // Add hover effects to procedure cards
    $('.procedure-card').hover(
        function() {
            $(this).addClass('shadow-lg').css('transform', 'translateY(-5px)');
        },
        function() {
            $(this).removeClass('shadow-lg').css('transform', 'translateY(0)');
        }
    );
});
</script>

<style>
.bg-purple {
    background: linear-gradient(45deg, #6f42c1, #5a32a3) !important;
    color: #fff !important;
}

.bg-teal {
    background: linear-gradient(45deg, #20c997, #17a085) !important;
    color: #fff !important;
}

.appointment-item {
    position: relative;
}

.appointment-item::before {
    content: '';
    position: absolute;
    left: -6px;
    top: 0;
    width: 12px;
    height: 12px;
    background: #007bff;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 2px #007bff;
}

.procedure-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.hover-shadow:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.small-box-footer {
    background: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
    transition: all 0.3s ease;
}

.small-box-footer:hover {
    color: #fff;
    background: rgba(0,0,0,.15);
    text-decoration: none;
}

.timeline {
    position: relative;
}

.avatar-sm {
    width: 32px;
    height: 32px;
}
</style>