<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/dental/dental_examinations.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-clipboard-list mr-3 text-primary"></i>
                        <?php echo lang('dental_treatment_plans'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="dental" class="text-primary"><?php echo lang('dental'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('treatment_plans'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo count($treatment_plans); ?></h3>
                            <p><?php echo lang('planned_treatments'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo count(array_filter($treatment_plans, function($t) { return $t->priority === 'high'; })); ?></h3>
                            <p><?php echo lang('high_priority'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo count(array_filter($treatment_plans, function($t) { return date('Y-m-d', strtotime($t->treatment_date)) <= date('Y-m-d', strtotime('+7 days')); })); ?></h3>
                            <p><?php echo lang('due_this_week'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo count(array_filter($treatment_plans, function($t) { return date('Y-m-d', strtotime($t->treatment_date)) < date('Y-m-d'); })); ?></h3>
                            <p><?php echo lang('overdue'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Treatment Plans Table -->
            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient-primary py-3">
                    <h3 class="card-title text-white mb-0">
                        <i class="fas fa-list mr-2"></i><?php echo lang('all_treatment_plans'); ?>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#filterModal">
                            <i class="fas fa-filter mr-1"></i><?php echo lang('filter'); ?>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0" id="treatmentPlansTable">
                            <thead class="bg-light">
                                <tr>
                                    <th><?php echo lang('patient'); ?></th>
                                    <th><?php echo lang('treatment'); ?></th>
                                    <th><?php echo lang('doctor'); ?></th>
                                    <th><?php echo lang('scheduled_date'); ?></th>
                                    <th><?php echo lang('priority'); ?></th>
                                    <th><?php echo lang('status'); ?></th>
                                    <th><?php echo lang('actions'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($treatment_plans)) { ?>
                                    <?php foreach ($treatment_plans as $plan) { ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                                        <?php echo strtoupper(substr($plan->patient_name, 0, 2)); ?>
                                                    </div>
                                                    <div>
                                                        <strong><?php echo htmlspecialchars($plan->patient_name); ?></strong>
                                                        <?php if (!empty($plan->patient_phone)) { ?>
                                                            <br><small class="text-muted"><?php echo htmlspecialchars($plan->patient_phone); ?></small>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <strong><?php echo htmlspecialchars($plan->treatment_name); ?></strong>
                                                <?php if (!empty($plan->tooth_number)) { ?>
                                                    <br><small class="text-muted"><?php echo lang('tooth'); ?>: <?php echo htmlspecialchars($plan->tooth_number); ?></small>
                                                <?php } ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($plan->doctor_name); ?></td>
                                            <td>
                                                <?php 
                                                $date = new DateTime($plan->treatment_date);
                                                $now = new DateTime();
                                                $diff = $now->diff($date);
                                                
                                                if ($date < $now) {
                                                    echo '<span class="badge badge-danger">' . lang('overdue') . '</span><br>';
                                                } elseif ($diff->days <= 7) {
                                                    echo '<span class="badge badge-warning">' . lang('due_soon') . '</span><br>';
                                                }
                                                echo $date->format('M d, Y');
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $priority_class = '';
                                                switch ($plan->priority) {
                                                    case 'high': $priority_class = 'danger'; break;
                                                    case 'medium': $priority_class = 'warning'; break;
                                                    case 'low': $priority_class = 'info'; break;
                                                    default: $priority_class = 'secondary';
                                                }
                                                ?>
                                                <span class="badge badge-<?php echo $priority_class; ?>">
                                                    <?php echo ucfirst($plan->priority ?: lang('normal')); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary"><?php echo ucfirst($plan->status); ?></span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="dental/view_examination/<?php echo $plan->examination_id; ?>" 
                                                       class="btn btn-info btn-sm" title="<?php echo lang('view_examination'); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-success btn-sm" 
                                                            onclick="markTreatmentCompleted(<?php echo $plan->id; ?>)" title="<?php echo lang('mark_as_completed'); ?>">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm" 
                                                            onclick="rescheduleTreatment(<?php echo $plan->id; ?>)" title="<?php echo lang('reschedule'); ?>">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-clipboard-list fa-3x mb-3"></i>
                                                <h5><?php echo lang('no_treatment_plans_found'); ?></h5>
                                                <p><?php echo lang('there_are_no_planned_treatments_at_this_time'); ?></p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#treatmentPlansTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[3, 'asc']], // Sort by scheduled date
        columnDefs: [
            { orderable: false, targets: [6] } // Actions column
        ]
    });
});

function markTreatmentCompleted(treatmentId) {
    if (confirm('Mark this treatment as completed?')) {
        // AJAX call to update treatment status
        $.post('dental/update_treatment_status', {
            treatment_id: treatmentId,
            status: 'completed'
        }, function(response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Error updating treatment status');
            }
        }, 'json');
    }
}

function rescheduleTreatment(treatmentId) {
    // Implementation for rescheduling
    alert('Reschedule functionality to be implemented');
}
</script>
