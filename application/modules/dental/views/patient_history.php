<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/dental/dental_examination.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-history mr-3 text-primary"></i>
                        <?php echo lang('patient_dental_history'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="dental" class="text-primary"><?php echo lang('dental_examinations'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('patient_history'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Patient Information Card -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-user mr-2"></i><?php echo lang('patient_information'); ?>
                            </h3>
                            <div class="card-tools">
                                <a href="<?php echo base_url(); ?>dental/create_examination?patient_id=<?php echo $patient->id; ?>" 
                                   class="btn btn-sm btn-light">
                                    <i class="fas fa-plus mr-1"></i><?php echo lang('new_examination'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <div class="avatar-xl bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
                                        <i class="fas fa-user fa-4x text-white"></i>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <h4 class="font-weight-bold mb-3"><?php echo htmlspecialchars($patient->name); ?></h4>
                                    <div class="info-list">
                                        <div class="info-item mb-2">
                                            <i class="fas fa-id-card text-primary mr-2"></i>
                                            <strong><?php echo lang('patient_id'); ?>:</strong> <?php echo $patient->id; ?>
                                        </div>
                                        <div class="info-item mb-2">
                                            <i class="fas fa-envelope text-primary mr-2"></i>
                                            <strong><?php echo lang('email'); ?>:</strong> <?php echo htmlspecialchars($patient->email ?: lang('not_provided')); ?>
                                        </div>
                                        <div class="info-item mb-2">
                                            <i class="fas fa-phone text-primary mr-2"></i>
                                            <strong><?php echo lang('phone'); ?>:</strong> <?php echo htmlspecialchars($patient->phone ?: lang('not_provided')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="info-list">
                                        <div class="info-item mb-2">
                                            <i class="fas fa-birthday-cake text-primary mr-2"></i>
                                            <strong><?php echo lang('birth_date'); ?>:</strong>
                                            <?php 
                                            if ($patient->birthdate) {
                                                echo date('M d, Y', strtotime($patient->birthdate));
                                                $age = date_diff(date_create($patient->birthdate), date_create('today'))->y;
                                                echo " (Age: $age)";
                                            } else {
                                                echo lang('not_provided');
                                            }
                                            ?>
                                        </div>
                                        <div class="info-item mb-2">
                                            <i class="fas fa-venus-mars text-primary mr-2"></i>
                                            <strong><?php echo lang('gender'); ?>:</strong> <?php echo htmlspecialchars($patient->sex ?: lang('not_specified')); ?>
                                        </div>
                                        <div class="info-item mb-2">
                                            <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                            <strong><?php echo lang('address'); ?>:</strong> <?php echo htmlspecialchars($patient->address ?: lang('not_provided')); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo count($examinations); ?></h3>
                            <p><?php echo lang('total_examinations'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-tooth"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo count(array_filter($examinations, function($e) { return $e->status === 'completed'; })); ?></h3>
                            <p><?php echo lang('completed'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo count(array_filter($examinations, function($e) { return $e->status === 'follow_up_required'; })); ?></h3>
                            <p><?php echo lang('follow_up_required'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <h3><?php echo !empty($examinations) ? date('M Y', strtotime($examinations[0]->examination_date)) : 'N/A'; ?></h3>
                            <p><?php echo lang('last_visit'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Examination History Timeline -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-success py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-timeline mr-2"></i><?php echo lang('dental_examination_history'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <?php if (!empty($examinations)): ?>
                                <div class="timeline">
                                    <?php foreach ($examinations as $index => $examination): ?>
                                        <div class="timeline-item <?php echo ($index === 0) ? 'timeline-item-active' : ''; ?>">
                                            <div class="timeline-marker">
                                                <div class="timeline-marker-icon bg-<?php 
                                                    switch ($examination->status) {
                                                        case 'completed': echo 'success'; break;
                                                        case 'follow_up_required': echo 'warning'; break;
                                                        case 'draft': echo 'secondary'; break;
                                                        default: echo 'light';
                                                    } 
                                                ?>">
                                                    <i class="fas fa-tooth text-white"></i>
                                                </div>
                                            </div>
                                            <div class="timeline-content">
                                                <div class="card border-0 shadow-sm">
                                                    <div class="card-body p-3">
                                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                                            <div>
                                                                <h5 class="card-title mb-1">
                                                                    <?php echo lang('dental_examination'); ?> #<?php echo str_pad($examination->id, 4, '0', STR_PAD_LEFT); ?>
                                                                </h5>
                                                                <p class="text-muted mb-0">
                                                                    <i class="fas fa-calendar mr-1"></i>
                                                                    <?php echo date('F d, Y \a\t h:i A', strtotime($examination->examination_date)); ?>
                                                                </p>
                                                            </div>
                                                            <div class="text-right">
                                                                <span class="badge badge-<?php 
                                                                    switch ($examination->status) {
                                                                        case 'completed': echo 'success'; break;
                                                                        case 'follow_up_required': echo 'warning'; break;
                                                                        case 'draft': echo 'secondary'; break;
                                                                        default: echo 'light';
                                                                    } 
                                                                ?>">
                                                                    <?php echo ucfirst(str_replace('_', ' ', $examination->status)); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row mb-3">
                                                            <div class="col-md-6">
                                                                <p class="mb-1"><strong><?php echo lang('doctor'); ?>:</strong> <?php echo htmlspecialchars($examination->doctor_name); ?></p>
                                                            </div>
                                                            <?php if ($examination->next_appointment): ?>
                                                            <div class="col-md-6">
                                                                <p class="mb-1"><strong><?php echo lang('next_appointment'); ?>:</strong> <?php echo date('M d, Y h:i A', strtotime($examination->next_appointment)); ?></p>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        
                                                        <?php if ($examination->chief_complaint): ?>
                                                        <div class="mb-3">
                                                            <strong><?php echo lang('chief_complaint'); ?>:</strong>
                                                            <p class="text-muted mb-0"><?php echo nl2br(htmlspecialchars($examination->chief_complaint)); ?></p>
                                                        </div>
                                                        <?php endif; ?>
                                                        
                                                        <?php if ($examination->diagnosis): ?>
                                                        <div class="mb-3">
                                                            <strong><?php echo lang('diagnosis'); ?>:</strong>
                                                            <p class="text-muted mb-0"><?php echo nl2br(htmlspecialchars($examination->diagnosis)); ?></p>
                                                        </div>
                                                        <?php endif; ?>
                                                        
                                                        <?php if ($examination->treatment_plan): ?>
                                                        <div class="mb-3">
                                                            <strong><?php echo lang('treatment_plan'); ?>:</strong>
                                                            <p class="text-muted mb-0"><?php echo nl2br(htmlspecialchars($examination->treatment_plan)); ?></p>
                                                        </div>
                                                        <?php endif; ?>
                                                        
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="btn-group" role="group">
                                                                <a href="<?php echo base_url(); ?>dental/view_examination/<?php echo $examination->id; ?>" 
                                                                   class="btn btn-info btn-sm">
                                                                    <i class="fas fa-eye mr-1"></i><?php echo lang('view_details'); ?>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>dental/edit_examination/<?php echo $examination->id; ?>" 
                                                                   class="btn btn-primary btn-sm">
                                                                    <i class="fas fa-edit mr-1"></i><?php echo lang('edit'); ?>
                                                                </a>
                                                                <a href="<?php echo base_url(); ?>dental/print_examination/<?php echo $examination->id; ?>" 
                                                                   class="btn btn-secondary btn-sm" target="_blank">
                                                                    <i class="fas fa-print mr-1"></i><?php echo lang('print'); ?>
                                                                </a>
                                                            </div>
                                                            <small class="text-muted">
                                                                <?php echo lang('created'); ?>: <?php echo date('M d, Y', strtotime($examination->created_at)); ?>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-tooth fa-5x text-muted mb-4"></i>
                                    <h4 class="text-muted mb-3"><?php echo lang('no_dental_history_found'); ?></h4>
                                    <p class="text-muted mb-4"><?php echo lang('this_patient_hasnt_had_any_dental_examinations_yet'); ?></p>
                                    <a href="<?php echo base_url(); ?>dental/create_examination?patient_id=<?php echo $patient->id; ?>" 
                                       class="btn btn-primary btn-lg">
                                        <i class="fas fa-plus mr-2"></i><?php echo lang('schedule_first_examination'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
.avatar-xl {
    width: 100px;
    height: 100px;
}

.info-item {
    display: flex;
    align-items: center;
}

.info-item i {
    width: 20px;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: -22px;
    top: 10px;
    width: 30px;
    height: 30px;
    z-index: 1;
}

.timeline-marker-icon {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    border: 3px solid #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.timeline-content {
    margin-left: 20px;
}

.timeline-item-active .timeline-marker-icon {
    transform: scale(1.2);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.timeline-item-active .timeline-content .card {
    border-left: 4px solid #28a745;
}

.bg-purple {
    background: linear-gradient(45deg, #6f42c1, #5a32a3) !important;
    color: #fff !important;
}

.small-box .icon {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    font-size: 3rem;
    opacity: 0.3;
}
</style>
