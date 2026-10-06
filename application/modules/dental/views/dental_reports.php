<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/dental/dental_examinations.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-file-medical-alt mr-3 text-primary"></i>
                        <?php echo lang('dental_reports'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="dental" class="text-primary"><?php echo lang('dental_examinations'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('reports'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Monthly Examinations Chart -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-info py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-chart-line mr-2"></i><?php echo lang('monthly_examinations_trend'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="monthlyChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-success py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-chart-pie mr-2"></i><?php echo lang('condition_distribution'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <canvas id="conditionChart" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Doctor Performance -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-user-md mr-2"></i><?php echo lang('doctor_performance_last_6_months'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('doctor'); ?></th>
                                            <th><?php echo lang('total_examinations'); ?></th>
                                            <th><?php echo lang('average_days_since_last_exam'); ?></th>
                                            <th><?php echo lang('performance'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($doctor_stats)) { ?>
                                            <?php foreach ($doctor_stats as $stat) { ?>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                                                <?php echo strtoupper(substr($stat->doctor_name, 0, 2)); ?>
                                                            </div>
                                                            <strong><?php echo htmlspecialchars($stat->doctor_name); ?></strong>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-info"><?php echo $stat->examination_count; ?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo round($stat->avg_days_since_last); ?> <?php echo lang('days'); ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        $performance = $stat->examination_count;
                                                        if ($performance >= 50) {
                                                            echo '<span class="badge badge-success">' . lang('excellent') . '</span>';
                                                        } elseif ($performance >= 30) {
                                                            echo '<span class="badge badge-info">' . lang('good') . '</span>';
                                                        } elseif ($performance >= 15) {
                                                            echo '<span class="badge badge-warning">' . lang('average') . '</span>';
                                                        } else {
                                                            echo '<span class="badge badge-secondary">' . lang('low') . '</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr>
                                                <td colspan="4" class="text-center text-muted"><?php echo lang('no_data_available'); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Condition Statistics -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-warning py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-chart-bar mr-2"></i><?php echo lang('dental_condition_statistics'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if (!empty($condition_stats)) { ?>
                                    <?php foreach ($condition_stats as $condition) { ?>
                                        <div class="col-md-3 col-sm-6 mb-3">
                                            <div class="info-box bg-light">
                                                <span class="info-box-icon">
                                                    <?php 
                                                    switch ($condition->condition) {
                                                        case 'caries': echo '<i class="fas fa-exclamation-triangle text-danger"></i>'; break;
                                                        case 'filled': echo '<i class="fas fa-check-circle text-primary"></i>'; break;
                                                        case 'crowned': echo '<i class="fas fa-crown text-warning"></i>'; break;
                                                        case 'extracted': echo '<i class="fas fa-times-circle text-dark"></i>'; break;
                                                        case 'implant': echo '<i class="fas fa-plus-circle text-success"></i>'; break;
                                                        default: echo '<i class="fas fa-tooth text-info"></i>';
                                                    }
                                                    ?>
                                                </span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text"><?php echo ucfirst(str_replace('_', ' ', $condition->condition)); ?></span>
                                                    <span class="info-box-number"><?php echo $condition->count; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="col-12">
                                        <div class="text-center text-muted">
                                            <i class="fas fa-chart-bar fa-3x mb-3"></i>
                                            <h5><?php echo lang('no_condition_data_available'); ?></h5>
                                            <p><?php echo lang('start_conducting_dental_examinations_to_see_condition_statistics'); ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
$(document).ready(function() {
    // Monthly Examinations Chart
    const monthlyData = <?php echo json_encode($monthly_stats); ?>;
    const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    
    const monthlyLabels = monthlyData.map(item => monthNames[item.month - 1] + ' ' + item.year);
    const monthlyCounts = monthlyData.map(item => item.count);
    
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: '<?php echo lang('examinations'); ?>',
                data: monthlyCounts,
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.1)',
                tension: 0.1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Condition Distribution Chart
    const conditionData = <?php echo json_encode($condition_stats); ?>;
    const conditionLabels = conditionData.map(item => item.condition.charAt(0).toUpperCase() + item.condition.slice(1).replace('_', ' '));
    const conditionCounts = conditionData.map(item => item.count);
    
    const conditionColors = [
        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', 
        '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384'
    ];
    
    if (conditionData.length > 0) {
        const conditionCtx = document.getElementById('conditionChart').getContext('2d');
        new Chart(conditionCtx, {
            type: 'doughnut',
            data: {
                labels: conditionLabels,
                datasets: [{
                    data: conditionCounts,
                    backgroundColor: conditionColors.slice(0, conditionData.length),
                    borderWidth: 2,
                    borderColor: '#fff'
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
    } else {
        document.getElementById('conditionChart').style.display = 'none';
        document.querySelector('#conditionChart').parentNode.innerHTML = '<div class="text-center text-muted p-4"><i class="fas fa-chart-pie fa-3x mb-3"></i><h5><?php echo lang('no_data_available'); ?></h5></div>';
    }
});
</script>