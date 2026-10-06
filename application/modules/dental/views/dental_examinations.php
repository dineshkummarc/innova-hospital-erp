<!--sidebar end-->
<!--main content start-->
<link href="common/extranal/css/dental/dental_examinations.css" rel="stylesheet">

<div class="content-wrapper bg-light">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-tooth mr-3 text-primary"></i>
                        <?php echo lang('dental_examinations'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('dental_examinations'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <!-- Action Buttons -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-3">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <a href="<?php echo base_url(); ?>dental/create_examination" class="btn btn-primary btn-lg shadow-sm">
                                        <i class="fas fa-plus mr-2"></i><?php echo lang('new_dental_examination'); ?>
                                    </a>
                                    <a href="<?php echo base_url(); ?>dental/dashboard" class="btn btn-info btn-lg shadow-sm ml-2">
                                        <i class="fas fa-chart-bar mr-2"></i><?php echo lang('dashboard'); ?>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" id="searchExaminations" placeholder="<?php echo lang('search_examinations'); ?>...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
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
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo count(array_filter($examinations, function($e) { return $e->status === 'draft'; })); ?></h3>
                            <p><?php echo lang('draft'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-edit"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Examinations Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-list mr-2"></i><?php echo lang('dental_examinations'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0" id="examinationsTable">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="5%">#</th>
                                            <th width="15%"><?php echo lang('patient'); ?></th>
                                            <th width="15%"><?php echo lang('doctor'); ?></th>
                                            <th width="12%"><?php echo lang('date'); ?></th>
                                            <th width="20%"><?php echo lang('chief_complaint'); ?></th>
                                            <th width="10%"><?php echo lang('status'); ?></th>
                                            <th width="12%"><?php echo lang('next_appointment'); ?></th>
                                            <th width="11%"><?php echo lang('actions'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($examinations)): ?>
                                            <?php foreach ($examinations as $index => $examination): ?>
                                                <tr>
                                                    <td><?php echo $index + 1; ?></td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-primary rounded-circle d-flex align-items-center justify-content-center mr-2">
                                                                <i class="fas fa-user text-white"></i>
                                                            </div>
                                                            <div>
                                                                <strong><?php echo htmlspecialchars($examination->patient_name); ?></strong>
                                                                <br><small class="text-muted"><?php echo htmlspecialchars($examination->patient_phone); ?></small>
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
                                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="<?php echo htmlspecialchars($examination->chief_complaint); ?>">
                                                            <?php echo htmlspecialchars($examination->chief_complaint ?: lang('not_specified')); ?>
                                                        </span>
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
                                                        <?php if ($examination->next_appointment): ?>
                                                            <small><?php echo date('M d, Y h:i A', strtotime($examination->next_appointment)); ?></small>
                                                        <?php else: ?>
                                                            <span class="text-muted"><?php echo lang('not_scheduled'); ?></span>
                                                        <?php endif; ?>
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
                                                            <a href="<?php echo base_url(); ?>dental/print_examination/<?php echo $examination->id; ?>" 
                                                               class="btn btn-secondary btn-sm" title="<?php echo lang('print'); ?>" target="_blank">
                                                                <i class="fas fa-print"></i>
                                                            </a>
                                                            <button class="btn btn-danger btn-sm" title="<?php echo lang('delete'); ?>" 
                                                                    onclick="confirmDelete(<?php echo $examination->id; ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-5">
                                                    <div class="text-muted">
                                                        <i class="fas fa-tooth fa-3x mb-3"></i>
                                                        <h5>No dental examinations found</h5>
                                                        <p>Start by creating your first dental examination</p>
                                                        <a href="<?php echo base_url(); ?>dental/create_examination" class="btn btn-primary">
                                                            <i class="fas fa-plus mr-2"></i>Create Examination
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this dental examination? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#examinationsTable').DataTable({
        responsive: true,
        pageLength: 25,
        order: [[3, 'desc']], // Sort by date column
        columnDefs: [
            { orderable: false, targets: [7] } // Disable ordering on Actions column
        ]
    });

    // Search functionality
    $('#searchExaminations').on('keyup', function() {
        $('#examinationsTable').DataTable().search(this.value).draw();
    });
});

function confirmDelete(id) {
    $('#deleteConfirmBtn').attr('href', '<?php echo base_url(); ?>dental/delete_examination/' + id);
    $('#deleteModal').modal('show');
}
</script>

<style>
.avatar-sm {
    width: 32px;
    height: 32px;
}

.small-box {
    border-radius: 0.25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
}

.small-box > .inner {
    padding: 10px;
}

.small-box > .small-box-footer {
    background: rgba(0,0,0,.1);
    color: rgba(255,255,255,.8);
    display: block;
    padding: 3px 0;
    position: relative;
    text-align: center;
    text-decoration: none;
    z-index: 10;
}

.small-box > .icon {
    border-radius: 0.25rem;
    color: rgba(255,255,255,.15);
    font-size: 90px;
    position: absolute;
    right: 15px;
    top: auto;
    z-index: 0;
}

.small-box h3 {
    font-size: 2.2rem;
    font-weight: bold;
    margin: 0 0 10px;
    white-space: nowrap;
}

.bg-info {
    background-color: #17a2b8!important;
    color: #fff!important;
}

.bg-success {
    background-color: #28a745!important;
    color: #fff!important;
}

.bg-warning {
    background-color: #ffc107!important;
    color: #212529!important;
}

.bg-danger {
    background-color: #dc3545!important;
    color: #fff!important;
}
</style>
