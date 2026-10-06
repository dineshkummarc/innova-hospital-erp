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
                        <?php echo lang('view_dental_examination'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="dental" class="text-primary"><?php echo lang('dental_examinations'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('view_examination'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <form role="form" action="dental/update_examination/<?php echo $examination->id; ?>" method="post" id="dentalExaminationForm">
                <div class="row">
                    <!-- Patient & Doctor Information -->
                    <div class="col-md-12 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-primary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-user-md mr-2"></i><?php echo lang('patient_doctor_information'); ?>
                            </h3>
                            <div class="card-tools hidden">
                                <a href="dental/edit_examination/<?php echo $examination->id; ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit mr-1"></i><?php echo lang('edit'); ?>
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('patient'); ?></label>
                                        <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->patient_name); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('doctor'); ?></label>
                                        <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->doctor_name); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('examination_date'); ?></label>
                                        <p class="form-control-plaintext"><?php echo date('M d, Y g:i A', strtotime($examination->examination_date)); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Clinical Information -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-header bg-gradient-info py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-clipboard-list mr-2"></i><?php echo lang('clinical_information'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="form-group mb-3">
                                <label class="font-weight-bold"><?php echo lang('chief_complaint'); ?></label>
                                <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->chief_complaint ?: 'N/A'); ?></p>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold"><?php echo lang('medical_history'); ?></label>
                                <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->medical_history ?: 'N/A'); ?></p>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold"><?php echo lang('dental_history'); ?></label>
                                <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->dental_history ?: 'N/A'); ?></p>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold"><?php echo lang('extraoral_examination'); ?></label>
                                <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->extraoral_examination ?: 'N/A'); ?></p>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label class="font-weight-bold"><?php echo lang('intraoral_examination'); ?></label>
                                <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->intraoral_examination ?: 'N/A'); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Interactive Odontogram -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-lg border-0 h-100">
                            <div class="card-header bg-gradient-success py-3">
                                <h3 class="card-title text-white mb-0">
                                    <i class="fas fa-teeth mr-2"></i><?php echo lang('interactive_odontogram'); ?>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-info mr-2 hidden" id="toggleMultiSelect" title="Toggle multi-select mode (Ctrl+Click)">
                                        <i class="fas fa-mouse-pointer mr-1"></i><?php echo lang('multi_select'); ?>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light hidden" id="resetOdontogram">
                                        <i class="fas fa-undo mr-1"></i><?php echo lang('reset'); ?>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-2">
                                <div id="odontogramContainer" class="text-center">
                                    <!-- Odontogram will be loaded here -->
                                </div>
                                
                                <!-- Condition Legend -->
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="font-weight-bold mb-2"><?php echo lang('condition_legend'); ?>:</h6>
                                        <div class="d-flex flex-wrap">
                                            <span class="badge badge-light mr-2 mb-1" style="background-color: #FFFFFF; color: #000; border: 1px solid #ccc;"><?php echo lang('healthy'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #FF0000; color: #fff;"><?php echo lang('caries'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #0000FF; color: #fff;"><?php echo lang('filled'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #FFD700; color: #000;"><?php echo lang('crowned'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #000000; color: #fff;"><?php echo lang('extracted'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #800080; color: #fff;"><?php echo lang('impacted'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #FF6600; color: #fff;"><?php echo lang('fractured'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #FF69B4; color: #fff;"><?php echo lang('root_canal'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #00FF00; color: #000;"><?php echo lang('implant'); ?></span>
                                            <span class="badge mr-2 mb-1" style="background-color: #00FFFF; color: #000;"><?php echo lang('bridge'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Diagnosis & Treatment Plan -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-warning py-3">
                            <h3 class="card-title text-dark mb-0">
                                <i class="fas fa-stethoscope mr-2"></i><?php echo lang('diagnosis_treatment_plan'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('diagnosis'); ?></label>
                                        <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->diagnosis ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('treatment_plan'); ?></label>
                                        <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->treatment_plan ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('additional_notes'); ?></label>
                                        <p class="form-control-plaintext"><?php echo htmlspecialchars($examination->notes ?: 'N/A'); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('next_appointment'); ?></label>
                                        <p class="form-control-plaintext"><?php echo $examination->next_appointment ? date('M d, Y g:i A', strtotime($examination->next_appointment)) : 'N/A'; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold"><?php echo lang('status'); ?></label>
                                        <span class="badge badge-<?php echo $examination->status === 'completed' ? 'success' : ($examination->status === 'follow_up_required' ? 'warning' : 'info'); ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $examination->status)); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Treatment Planning Section -->
                                   <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-secondary py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-tools mr-2"></i><?php echo lang('treatments'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('tooth_number'); ?></th>
                                            <th><?php echo lang('treatment_type'); ?></th>
                                            <th><?php echo lang('status'); ?></th>
                                            <th><?php echo lang('date'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($treatments as $treatment): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($treatment->tooth_number ?: 'General'); ?></td>
                                            <td><?php echo htmlspecialchars($treatment->treatment_type); ?></td>
                                            <td>
                                                <span class="badge badge-<?php echo $treatment->status === 'completed' ? 'success' : ($treatment->status === 'in_progress' ? 'warning' : 'info'); ?>">
                                                    <?php echo ucfirst(str_replace('_', ' ', $treatment->status)); ?>
                                                </span>
                                            </td>
                                            <td><?php echo date('M d, Y', strtotime($treatment->treatment_date)); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                    <!-- Prescription Section -->
                                   <?php if (!empty($prescriptions)): ?>
                <div class="col-md-6 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-dark py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-pills mr-2"></i><?php echo lang('prescriptions'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('medication'); ?></th>
                                            <th><?php echo lang('dosage'); ?></th>
                                            <th><?php echo lang('frequency'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($prescriptions as $prescription): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($prescription->medication_name); ?></td>
                                            <td><?php echo htmlspecialchars($prescription->dosage); ?></td>
                                            <td><?php echo htmlspecialchars($prescription->frequency); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Images Section -->
                <?php if (!empty($images)): ?>
                <div class="col-md-12 mb-4">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-gradient-info py-3">
                            <h3 class="card-title text-white mb-0">
                                <i class="fas fa-images mr-2"></i><?php echo lang('dental_images'); ?>
                            </h3>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <?php foreach ($images as $image): ?>
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100">
                                        <img src="<?php echo base_url().$image->image_path; ?>" class="card-img-top img-thumbnail" alt="<?php echo htmlspecialchars($image->image_name); ?>" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <h6 class="card-title small"><?php echo htmlspecialchars($image->image_name); ?></h6>
                                            <p class="card-text small text-muted"><?php echo htmlspecialchars($image->description ?: 'No description'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Form Actions -->
                <div class="col-md-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-body p-4 text-center">
                            <a href="dental/print_examination/<?php echo $examination->id; ?>" target="_blank" class="btn btn-primary btn-lg px-5 mr-3">
                                <i class="fas fa-print mr-2"></i><?php echo lang('print'); ?>
                            </a>
                            <a href="dental" class="btn btn-secondary btn-lg px-5">
                                <i class="fas fa-arrow-left mr-2"></i><?php echo lang('back_to_list'); ?>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </section>
</div>

<!-- Tooth Selection Modal -->
<div class="modal fade" id="toothModal" tabindex="-1" role="dialog" aria-labelledby="toothModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="toothModalLabel"><?php echo lang('tooth'); ?>: <span id="selectedToothNumber"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info mb-3" id="multiSelectInfo" style="display: none;">
                    <i class="fas fa-info-circle mr-2"></i>
                    <strong><?php echo lang('multi_select_mode'); ?>:</strong> <?php echo lang('you_can_apply_the_same_condition_to_multiple_teeth_at_once'); ?>
                </div>
                <form id="toothForm">
                    <input type="hidden" id="toothNumber" name="tooth_number">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold"><?php echo lang('tooth_type'); ?></label>
                                <select class="form-control" id="toothType" name="tooth_type" disabled>
                                    <option value="deciduous"><?php echo lang('deciduous'); ?></option>
                                    <option value="permanent"><?php echo lang('permanent'); ?></option>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold"><?php echo lang('condition'); ?></label>
                                <select class="form-control" id="toothCondition" name="condition" disabled>
                                    <option value=""><?php echo lang('notapplicable'); ?></option>
                                    <option value="healthy"><?php echo lang('healthy'); ?></option>
                                    <option value="caries"><?php echo lang('caries'); ?></option>
                                    <option value="filled"><?php echo lang('filled'); ?></option>
                                    <option value="crowned"><?php echo lang('crowned'); ?></option>
                                    <option value="extracted"><?php echo lang('extracted'); ?></option>
                                    <option value="impacted"><?php echo lang('impacted'); ?></option>
                                    <option value="fractured"><?php echo lang('fractured'); ?></option>
                                    <option value="root_canal"><?php echo lang('root_canal'); ?></option>
                                    <option value="implant"><?php echo lang('implant'); ?></option>
                                    <option value="bridge"><?php echo lang('bridge'); ?></option>
                                    <option value="other"><?php echo lang('other'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold"><?php echo lang('surface_affected'); ?></label>
                                <input type="text" class="form-control" id="surfaceAffected" name="surface_affected" 
                                       placeholder="e.g., Mesial, Distal, Occlusal" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold"><?php echo lang('severity'); ?></label>
                                <select class="form-control" id="toothSeverity" name="severity" disabled>
                                    <option value=""></option>
                                    <option value=""><?php echo lang('not_applicable'); ?></option>
                                    <option value="mild"><?php echo lang('mild'); ?></option>
                                    <option value="moderate"><?php echo lang('moderate'); ?></option>
                                    <option value="severe"><?php echo lang('severe'); ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold"><?php echo lang('notes'); ?></label>
                        <textarea class="form-control" id="toothNotes" name="notes" rows="3" 
                                  placeholder="Additional notes about this tooth..." disabled></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary hidden" id="saveToothData"><?php echo lang('save_changes'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Load the interactive odontogram component -->
<script src="<?php echo base_url(); ?>common/extranal/js/dental/odontogram.js"></script>
<script src="<?php echo base_url(); ?>common/extranal/js/dental/dental_examination.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Initialize odontogram and load existing data
    initializeOdontogram();
    
    // Load existing odontogram data if available
    <?php if (!empty($odontogram)): ?>
    const existingOdontogramData = <?php echo json_encode($odontogram); ?>;
    
    // Convert the data format to match what the odontogram expects
    console.log('Existing odontogram data:', existingOdontogramData);
    const formattedData = {};
    Object.keys(existingOdontogramData).forEach(toothNumber => {
        const data = existingOdontogramData[toothNumber];
        formattedData[toothNumber] = {
            tooth_type: data.tooth_type || 'permanent',
            condition: data.condition || 'healthy',
            surface_affected: data.surface_affected || '',
            severity: data.severity || '',
            notes: data.notes || '',
            color_code: data.color_code || ''
        };
    });
    console.log('Formatted data for edit:', formattedData);
    
    // Load the formatted data into the odontogram with small delay to ensure SVG is rendered
    setTimeout(function() {
        loadOdontogramData(formattedData);
    }, 50);
    <?php endif; ?>
    
    // Initialize treatment and prescription sections
    initializeTreatmentSection();
    initializePrescriptionSection();
    
    // Form validation
    $('#dentalExaminationForm').on('submit', function(e) {
        // Add odontogram data to form
        const odontogramData = getOdontogramData();
        console.log('Submitting odontogram data:', odontogramData); // Debug log
        
        // Remove any existing odontogram input to prevent duplicates
        $(this).find('input[name="odontogram"]').remove();
        
        // Add fresh odontogram data to form
        $('<input>').attr({
            type: 'hidden',
            name: 'odontogram',
            value: JSON.stringify(odontogramData)
        }).appendTo(this);
    });
});
</script>