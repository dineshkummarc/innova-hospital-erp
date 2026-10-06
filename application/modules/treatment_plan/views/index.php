<style>
/* Clean AI Response Styling */
.ai-response-container {
    background: white;
    border-radius: 12px;
    padding: 40px;
    margin: 30px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e8e8e8;
    position: relative;
}

.ai-response-header {
    display: flex;
    align-items: center;
    margin-bottom: 35px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.ai-response-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 20px;
    font-size: 20px;
    color: white;
}

.ai-analysis-icon {
    background: #3b82f6;
}

.ai-treatment-icon {
    background: #10b981;
}

.ai-prescription-icon {
    background: #f59e0b;
}

.ai-response-title {
    color: #1f2937;
    font-size: 24px;
    font-weight: 600;
    margin: 0;
    letter-spacing: -0.025em;
}

.ai-response-content {
    margin-bottom: 30px;
}

.ai-response-text {
    font-size: 16px;
    line-height: 1.7;
    color: #374151;
    margin: 0;
    text-align: justify;
}

.ai-response-actions {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.ai-action-btn {
    background: #1f2937;
    border: none;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
    margin: 0 8px;
}

.ai-action-btn:hover {
    background: #374151;
    color: white;
    transform: translateY(-1px);
}

.ai-action-btn i {
    margin-right: 6px;
}

/* Prescription specific styling */
.prescription-modern {
    background: white;
    border-radius: 12px;
    padding: 40px;
    margin: 30px 0;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: 1px solid #e8e8e8;
}

.prescription-content-modern {
    margin-bottom: 30px;
}

.prescription-header {
    text-align: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}

.prescription-title h3 {
    font-size: 28px;
    font-weight: 700;
    color: #1f2937;
    margin: 0 0 10px 0;
}

.prescription-date, .prescription-doctor {
    font-size: 14px;
    color: #6b7280;
    margin: 5px 0;
}

.info-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 30px;
    gap: 30px;
}

.hospital-info, .patient-info {
    flex: 1;
}

.hospital-name {
    font-size: 20px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 10px 0;
}

.hospital-details p, .patient-info p {
    font-size: 14px;
    color: #6b7280;
    margin: 5px 0;
}

.prescription-content {
    margin: 30px 0;
    text-align: center;
}

.prescription-content h4 {
    font-size: 18px;
    font-weight: 600;
    color: #1f2937;
    margin: 0 0 20px 0;
}

.prescription-text-modern {
    font-size: 16px;
    line-height: 1.8;
    color: #374151;
    margin: 0;
    text-align: center;
    font-weight: 500;
}

.prescription-footer {
    margin-top: 40px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.doctor-signature {
    text-align: right;
    margin-bottom: 15px;
}

.doctor-signature p {
    font-size: 14px;
    color: #6b7280;
    margin: 5px 0;
}

.prescription-note {
    text-align: center;
}

.prescription-note p {
    font-size: 13px;
    color: #9ca3af;
    font-style: italic;
    margin: 0;
}

/* Animation effects */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.ai-response-container, .prescription-modern {
    animation: fadeInUp 0.4s ease-out;
}

/* Responsive design */
@media (max-width: 768px) {
    .ai-response-container, .prescription-modern {
        padding: 25px;
        margin: 20px 0;
    }
    
    .ai-response-icon {
        width: 40px;
        height: 40px;
        font-size: 16px;
        margin-right: 15px;
    }
    
    .ai-response-title {
        font-size: 20px;
    }
    
    .info-row {
        flex-direction: column;
        gap: 20px;
    }
    
    .ai-action-btn {
        padding: 10px 20px;
        font-size: 13px;
        margin: 4px;
    }
}
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('ai_treatment_plan'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('ai_treatment_plan'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <!-- Flash Messages -->
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?> 
            
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-lg border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-robot mr-2"></i>
                                <?php echo lang('ai_powered_treatment_plan_generator'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="treatmentTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="symptoms-tab" data-toggle="tab" href="#symptoms" role="tab" aria-controls="symptoms" aria-selected="true">
                                        <i class="fas fa-stethoscope mr-1"></i> <?php echo lang('symptoms_input'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="analysis-tab" data-toggle="tab" href="#analysis" role="tab" aria-controls="analysis" aria-selected="false">
                                        <i class="fas fa-brain mr-1"></i> <?php echo lang('ai_analysis'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="treatment-tab" data-toggle="tab" href="#treatment" role="tab" aria-controls="treatment" aria-selected="false">
                                        <i class="fas fa-pills mr-1"></i> <?php echo lang('treatment_plan'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="prescription-tab" data-toggle="tab" href="#prescription" role="tab" aria-controls="prescription" aria-selected="false">
                                        <i class="fas fa-file-prescription mr-1"></i> <?php echo lang('prescription'); ?>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="treatmentTabsContent">
                                <!-- Tab 1: Symptoms -->
                                <div class="tab-pane fade show active" id="symptoms" role="tabpanel" aria-labelledby="symptoms-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="patientSelect"><?php echo lang('select_patient'); ?> <span class="text-danger">*</span></label>
                                                <select class="form-control select2" id="patientSelect" name="patient_id" required>
                                                    <option value=""><?php echo lang('choose_patient'); ?>...</option>
                                                    <?php foreach ($patients as $patient): ?>
                                                        <option value="<?php echo $patient->id; ?>">
                                                            <?php echo $patient->name . ' (' . $patient->id . ') - ' . $patient->age . ' years, ' . $patient->sex; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="doctorSelect"><?php echo lang('select_doctor'); ?> <span class="text-danger">*</span></label>
                                                <?php if (count($doctors) == 1): ?>
                                                    <!-- If only one doctor (doctor login), show as read-only -->
                                                    <select class="form-control select2" id="doctorSelect" name="doctor_id" required readonly>
                                                        <option value="<?php echo $doctors[0]->id; ?>" selected>
                                                            <?php echo $doctors[0]->name . ' - ' . $doctors[0]->specialist; ?>
                                                        </option>
                                                    </select>
                                                <?php else: ?>
                                                    <!-- If multiple doctors (admin login), show dropdown -->
                                                    <select class="form-control select2" id="doctorSelect" name="doctor_id" required>
                                                        <option value=""><?php echo lang('choose_doctor'); ?>...</option>
                                                        <?php foreach ($doctors as $doctor): ?>
                                                            <option value="<?php echo $doctor->id; ?>">
                                                                <?php echo $doctor->name . ' - ' . $doctor->specialist; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="symptomsInput"><?php echo lang('patient_symptoms'); ?> <span class="text-danger">*</span></label>
                                                <textarea class="form-control" id="symptomsInput" name="symptoms" rows="6" 
                                                          placeholder="<?php echo lang('describe_symptoms_detail'); ?>..." required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="button" class="btn btn-primary btn-lg" id="generateAnalysisBtn" disabled>
                                                <i class="fas fa-robot mr-2"></i>
                                                <?php echo lang('generate_ai_symptom_analysis'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 2: AI Analysis -->
                                <div class="tab-pane fade" id="analysis" role="tabpanel" aria-labelledby="analysis-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="analysisContent">
                                                        <div class="text-center text-muted py-5">
                                                            <i class="fas fa-brain fa-3x mb-3"></i>
                                                            <h5><?php echo lang('no_analysis_available'); ?></h5>
                                                            <p><?php echo lang('complete_symptoms_input_generate_analysis'); ?></p>
                                                            <button type="button" class="btn btn-primary btn-lg" id="goToSymptomsFromAnalysisBtn">
                                                                <i class="fas fa-stethoscope mr-2"></i>
                                                                <?php echo lang('go_to_symptoms_input_tab'); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 3: Treatment Plan -->
                                <div class="tab-pane fade" id="treatment" role="tabpanel" aria-labelledby="treatment-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="treatmentContent">
                                                        <div class="text-center text-muted py-5">
                                                            <i class="fas fa-pills fa-3x mb-3"></i>
                                                            <h5><?php echo lang('no_treatment_plan_available'); ?></h5>
                                                            <p><?php echo lang('complete_ai_analysis_first'); ?></p>
                                                            <button type="button" class="btn btn-primary btn-lg" id="goToSymptomsFromTreatmentBtn">
                                                                <i class="fas fa-stethoscope mr-2"></i>
                                                                <?php echo lang('go_to_symptoms_input_tab'); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab 4: Prescription -->
                                <div class="tab-pane fade" id="prescription" role="tabpanel" aria-labelledby="prescription-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="prescriptionContent">
                                                        <div class="text-center text-muted py-5">
                                                            <i class="fas fa-file-prescription fa-3x mb-3"></i>
                                                            <h5><?php echo lang('no_prescription_available'); ?></h5>
                                                            <p><?php echo lang('complete_treatment_plan_first'); ?></p>
                                                            <button type="button" class="btn btn-primary btn-lg" id="goToTreatmentFromPrescriptionBtn">
                                                                <i class="fas fa-pills mr-2"></i>
                                                                <?php echo lang('go_to_treatment_plan_tab'); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

<!-- Loading Modal -->
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h5>AI is working...</h5>
                <p class="text-muted">Please wait while our AI analyzes the information.</p>
            </div>
        </div>
    </div>
</div>

<script>
let currentTreatmentId = null;

// Navigation functions (global scope)
window.goToSymptomsTab = function() {
    console.log('goToSymptomsTab called');
    try {
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $('#symptoms-tab').addClass('active');
        $('#symptoms').addClass('show active');
        console.log('Successfully navigated to symptoms tab');
    } catch (error) {
        console.error('Error navigating to symptoms tab:', error);
    }
};

window.goToAnalysisTab = function() {
    console.log('Navigating to analysis tab');
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass('show active');
    $('#analysis-tab').addClass('active');
    $('#analysis').addClass('show active');
};

window.goToTreatmentTab = function() {
    console.log('goToTreatmentTab called');
    try {
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $('#treatment-tab').addClass('active');
        $('#treatment').addClass('show active');
        console.log('Successfully navigated to treatment tab');
    } catch (error) {
        console.error('Error navigating to treatment tab:', error);
    }
};

window.goToPrescriptionTab = function() {
    console.log('Navigating to prescription tab');
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass('show active');
    $('#prescription-tab').addClass('active');
    $('#prescription').addClass('show active');
    updatePrescriptionVisibility();
};


// Helper functions (global scope)
function updateTreatmentPlanVisibility() {
    const hasAnalysis = $('#analysisContent').find('.ai-response-container').length > 0 && 
                       $('#analysisContent').find('.ai-response-text').text().trim() !== '';
    
    // Check if there's already a treatment result displayed
    const hasTreatmentResult = $('#treatmentContent').find('.ai-response-container').length > 0;
    
    if (hasAnalysis && !hasTreatmentResult) {
        // Show treatment plan generation form only if no result is already displayed
        $('#treatmentContent').html(`
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="doctorInput">Doctor's Clinical Input</label>
                        <textarea class="form-control" id="doctorInput" name="doctor_input" rows="4" 
                                  placeholder="Enter your clinical observations, physical examination findings, etc..."></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="testResults"><?php echo lang('test_results'); ?></label>
                        <textarea class="form-control" id="testResults" name="test_results" rows="4" 
                                  placeholder="Enter laboratory results, imaging findings, etc..."></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <button type="button" class="btn btn-success btn-lg" id="generateTreatmentBtn">
                        <i class="fas fa-pills mr-2"></i>
                        Generate AI Treatment Plan
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-clipboard-list mr-2"></i>
                                AI Treatment Plan
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-muted">
                                <i class="fas fa-pills fa-3x mb-3"></i>
                                <p>Click "Generate AI Treatment Plan" to create your treatment plan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `);
    }
    // If hasTreatmentResult is true, don't overwrite the existing result
}

function updatePrescriptionVisibility() {
    const hasTreatment = $('#treatmentContent').find('.ai-response-container').length > 0 && 
                        $('#treatmentContent').find('.ai-response-text').text().trim() !== '';
    
    // Check if there's already a prescription result displayed
    const hasPrescriptionResult = $('#prescriptionContent').find('.prescription-modern').length > 0;
    
    if (hasTreatment && !hasPrescriptionResult) {
        // Show prescription generation form only if no result is already displayed
        $('#prescriptionContent').html(`
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <button type="button" class="btn btn-warning btn-lg" id="generatePrescriptionBtn">
                        <i class="fas fa-file-prescription mr-2"></i>
                        Generate AI Prescription
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-warning text-dark">
                            <h6 class="card-title mb-0">
                                <i class="fas fa-file-prescription mr-2"></i>
                                AI Generated Prescription
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="text-center text-muted">
                                <i class="fas fa-file-prescription fa-3x mb-3"></i>
                                <p>Click "Generate AI Prescription" to create a printable prescription.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <button type="button" class="btn btn-info" id="printPrescriptionBtn" disabled>
                        <i class="fas fa-print mr-2"></i>
                        Print Prescription
                    </button>
                </div>
            </div>
        `);
    }
    // If hasPrescriptionResult is true, don't overwrite the existing result
}

// Reset analysis state function
function resetAnalysisState() {
    $('#analysisContent').html(`
        <div class="text-center text-muted py-5">
            <i class="fas fa-brain fa-3x mb-3"></i>
            <h5><?php echo lang('no_analysis_available'); ?></h5>
            <p>Complete the symptoms input and generate AI analysis to see the results here.</p>
            <button type="button" class="btn btn-primary btn-lg" id="goToSymptomsFromAnalysisBtn">
                <i class="fas fa-stethoscope mr-2"></i>
                <?php echo lang('go_to_symptoms_input_tab'); ?>
            </button>
        </div>
    `);
    
    $('#treatmentContent').html(`
        <div class="text-center text-muted py-5">
            <i class="fas fa-pills fa-3x mb-3"></i>
            <h5><?php echo lang('no_treatment_plan_available'); ?></h5>
            <p>Complete the AI analysis first to generate a treatment plan.</p>
            <button type="button" class="btn btn-primary btn-lg" id="goToSymptomsFromTreatmentBtn">
                <i class="fas fa-stethoscope mr-2"></i>
                <?php echo lang('go_to_symptoms_input_tab'); ?>
            </button>
        </div>
    `);
    
    $('#prescriptionContent').html(`
        <div class="text-center text-muted py-5">
            <i class="fas fa-file-prescription fa-3x mb-3"></i>
            <h5><?php echo lang('no_prescription_available'); ?></h5>
            <p>Complete the treatment plan first to generate a prescription.</p>
            <button type="button" class="btn btn-primary btn-lg" id="goToTreatmentFromPrescriptionBtn">
                <i class="fas fa-pills mr-2"></i>
                <?php echo lang('go_to_treatment_plan_tab'); ?>
            </button>
        </div>
    `);
}

$(document).ready(function() {
    
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Enable/disable buttons based on form completion
    $('#patientSelect, #doctorSelect, #symptomsInput').on('change input', function() {
        const patientSelected = $('#patientSelect').val() !== '';
        const doctorSelected = $('#doctorSelect').val() !== '';
        const symptomsEntered = $('#symptomsInput').val().trim() !== '';
        $('#generateAnalysisBtn').prop('disabled', !(patientSelected && doctorSelected && symptomsEntered));
        
        // Reset analysis state when patient, doctor, or symptoms change
        resetAnalysisState();
    });
    
    
    
    
    
    
    // Check if doctor is pre-selected (for doctor login)
    if ($('#doctorSelect').val() !== '') {
        // Doctor is pre-selected, trigger validation
        $('#patientSelect, #symptomsInput').trigger('change');
    }
    
    // Initialize visibility states
    updateTreatmentPlanVisibility();
    updatePrescriptionVisibility();
    
    // Initialize analysis tab buttons
    $('#goToSymptomsBtn').show();
    $('#generateNewAnalysisBtn').hide();
    
    
    // Tab shown event handlers
    $('#treatment-tab').on('shown.bs.tab', function(e) {
        updateTreatmentPlanVisibility();
    });
    
    $('#prescription-tab').on('shown.bs.tab', function(e) {
        updatePrescriptionVisibility();
    });
    
    
    // AI Analysis tab button handlers
    $('#generateNewAnalysisBtn').on('click', function() {
        // Reset analysis state and go to symptoms tab
        resetAnalysisState();
        goToSymptomsTab();
    });
    
    $('#goToSymptomsBtn').on('click', function() {
        goToSymptomsTab();
    });
    
    // AI Analysis tab navigation button (when empty) - using event delegation for dynamically added content
    $(document).on('click', '#goToSymptomsFromAnalysisBtn', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Go to Symptoms button clicked from Analysis tab');
        goToSymptomsTab();
    });
    
    // Treatment tab navigation button
    $('#goToSymptomsFromTreatmentBtn').on('click', function() {
        console.log('Treatment tab button clicked');
        goToSymptomsTab();
    });
    
    // Prescription tab navigation button
    $('#goToTreatmentFromPrescriptionBtn').on('click', function() {
        console.log('Prescription tab button clicked');
        goToTreatmentTab();
    });

    // Generate Symptom Analysis
    $('#generateAnalysisBtn').on('click', function() {
        const patientId = $('#patientSelect').val();
        const doctorId = $('#doctorSelect').val();
        const symptoms = $('#symptomsInput').val();
        
        if (!patientId || !doctorId || !symptoms) {
            alert('Please select a patient, doctor, and enter symptoms.');
            return;
        }

        // Hide the analysis header when starting new analysis
        $('#analysisHeader').hide();
        
        $('#loadingModal').modal('show');
        
        $.ajax({
            url: '<?php echo base_url(); ?>treatment_plan/generateSymptomAnalysis',
            type: 'POST',
            data: {
                patient_id: patientId,
                doctor_id: doctorId,
                symptoms: symptoms
            },
            dataType: 'json',
            success: function(response) {
                $('#loadingModal').modal('hide');
                
                if (response.success) {
                    currentTreatmentId = response.treatment_id;
                    
                    
                    // Display analysis with modern design
                    const analysisHtml = `
                        <div class="ai-response-container">
                            <div class="ai-response-header">
                                <div class="ai-response-icon ai-analysis-icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <h3 class="ai-response-title">AI Analysis</h3>
                            </div>
                            <div class="ai-response-content">
                                <div class="ai-response-text">${response.analysis.replace(/\n/g, '<br>')}</div>
                            </div>
                            <div class="ai-response-actions">
                                <button type="button" class="ai-action-btn" onclick="goToTreatmentTab()">
                                    <i class="fas fa-arrow-right"></i>Continue to Treatment Plan
                                </button>
                            </div>
                        </div>
                    `;
                    
                    $('#analysisContent').html(analysisHtml);
                    
                    // Show the analysis header
                    $('#analysisHeader').show();
                    
                    // Enable treatment plan generation
                    if ($('#generateTreatmentBtn').length) {
                        $('#generateTreatmentBtn').prop('disabled', false);
                    }
                    
                    // Update treatment plan visibility
                    updateTreatmentPlanVisibility();
                    
                    // Switch to analysis tab
                    goToAnalysisTab();
                } else {
                    showNotification(response.message || 'Failed to generate analysis', 'error');
                }
            },
            error: function() {
                $('#loadingModal').modal('hide');
                showNotification('An error occurred while generating analysis', 'error');
            }
        });
    });

    // Generate Treatment Plan - Using event delegation for dynamically created button
    $(document).on('click', '#generateTreatmentBtn', function() {
        if (!currentTreatmentId) {
            alert('Please complete the symptom analysis first.');
            return;
        }

        $('#loadingModal').modal('show');
        
        $.ajax({
            url: '<?php echo base_url(); ?>treatment_plan/generateTreatmentRecommendation',
            type: 'POST',
            data: {
                treatment_id: currentTreatmentId,
                doctor_input: $('#doctorInput').val(),
                test_results: $('#testResults').val()
            },
            dataType: 'json',
            success: function(response) {
                $('#loadingModal').modal('hide');
                console.log('Treatment Plan Response:', response);
                
                if (response.success) {
                    console.log('Treatment plan content:', response.treatment_plan);
                    // Display treatment plan with modern design
                    const treatmentHtml = `
                        <div class="ai-response-container">
                            <div class="ai-response-header">
                                <div class="ai-response-icon ai-treatment-icon">
                                    <i class="fas fa-clipboard-list"></i>
                                </div>
                                <h3 class="ai-response-title">AI Treatment Plan</h3>
                            </div>
                            <div class="ai-response-content">
                                <div class="ai-response-text">${response.treatment_plan.replace(/\n/g, '<br>')}</div>
                            </div>
                            <div class="ai-response-actions">
                                <button type="button" class="ai-action-btn" onclick="goToPrescriptionTab()">
                                    <i class="fas fa-file-prescription"></i>Generate Prescription
                                </button>
                            </div>
                        </div>
                    `;
                    
                    console.log('Generated HTML:', treatmentHtml);
                    $('#treatmentContent').html(treatmentHtml);
                    
                    // Enable prescription generation
                    if ($('#generatePrescriptionBtn').length) {
                        $('#generatePrescriptionBtn').prop('disabled', false);
                    }
                    
                    // Update prescription visibility
                    updatePrescriptionVisibility();
                    
                    // Switch to treatment tab
                    goToTreatmentTab();
                } else {
                    console.error('Treatment plan generation failed:', response.message);
                    showNotification(response.message || 'Failed to generate treatment plan', 'error');
                }
            },
            error: function(xhr, status, error) {
                $('#loadingModal').modal('hide');
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
                showNotification('An error occurred while generating treatment plan: ' + error, 'error');
            }
        });
    });

    // Generate Prescription - Using event delegation for dynamically created button
    $(document).on('click', '#generatePrescriptionBtn', function() {
        if (!currentTreatmentId) {
            alert('Please complete the treatment plan first.');
            return;
        }

        $('#loadingModal').modal('show');
        
        $.ajax({
            url: '<?php echo base_url(); ?>treatment_plan/generatePrescription',
            type: 'POST',
            data: {
                treatment_id: currentTreatmentId
            },
            dataType: 'json',
            success: function(response) {
                $('#loadingModal').modal('hide');
                console.log('Prescription Response:', response);
                
                if (response.success) {
                    console.log('Prescription content:', response.prescription);
                    // Get patient and doctor information
                    const selectedPatient = $('#patientSelect option:selected').text();
                    const patientId = $('#patientSelect').val();
                    const selectedDoctor = $('#doctorSelect option:selected').text();
                    
                    // Create modern prescription HTML
                    const prescriptionHTML = `
                        <div class="prescription-modern">
                            <div class="ai-response-header">
                                <div class="ai-response-icon ai-prescription-icon">
                                    <i class="fas fa-file-prescription"></i>
                                </div>
                                <h3 class="ai-response-title">AI Prescription</h3>
                            </div>
                            
                            <div class="prescription-content-modern">
                                <div class="prescription-header">
                                    <div class="prescription-title">
                                        <h3><?php echo lang('prescription'); ?></h3>
                                        <p class="prescription-date">Date: ${new Date().toLocaleDateString()}</p>
                                        <p class="prescription-doctor">Dr. ${selectedDoctor}</p>
                                    </div>
                                </div>
                                
                                <div class="info-row">
                                    <div class="hospital-info">
                                        <h2 class="hospital-name"><?php echo $settings->title ?? "Hospital"; ?></h2>
                                        <div class="hospital-details">
                                            <p><strong>Address:</strong> <?php echo $settings->address ?? ""; ?></p>
                                            <p><strong>Phone:</strong> <?php echo $settings->phone ?? ""; ?> | <strong>Email:</strong> <?php echo $settings->email ?? ""; ?></p>
                                        </div>
                                    </div>
                                    <div class="patient-info">
                                        <h4>Patient Information:</h4>
                                        <p><strong>Name:</strong> ${selectedPatient}</p>
                                        <p><strong>Patient ID:</strong> ${patientId}</p>
                                    </div>
                                </div>
                                
                                <div class="prescription-content">
                                    <h4>Prescription:</h4>
                                    <div class="prescription-text-modern">${response.prescription.replace(/\n/g, '<br>')}</div>
                                </div>
                                
                                <div class="prescription-footer">
                                    <div class="doctor-signature">
                                        <p>Doctor's Signature: _________________</p>
                                        <p>Date: _________________</p>
                                    </div>
                                    <div class="prescription-note">
                                        <p><em>Please follow the prescription as directed. Contact the hospital if you have any questions.</em></p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="ai-response-actions">
                                <button type="button" class="ai-action-btn" onclick="printPrescription()">
                                    <i class="fas fa-print"></i>Print Prescription
                                </button>
                            </div>
                        </div>
                    `;
                    
                    console.log('Generated prescription HTML:', prescriptionHTML);
                    $('#prescriptionContent').html(prescriptionHTML);
                    
                    // Switch to prescription tab
                    goToPrescriptionTab();
                } else {
                    console.error('Prescription generation failed:', response.message);
                    showNotification(response.message || 'Failed to generate prescription', 'error');
                }
            },
            error: function(xhr, status, error) {
                $('#loadingModal').modal('hide');
                console.error('AJAX Error:', status, error);
                console.error('Response:', xhr.responseText);
                showNotification('An error occurred while generating prescription: ' + error, 'error');
            }
        });
    });

    // Global print prescription function
window.printPrescription = function() {
    const prescriptionContent = $('#prescriptionContent').html();
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title><?php echo lang('medical_prescription'); ?></title>
                <style>
                    body { 
                        font-family: 'Times New Roman', serif; 
                        margin: 0; 
                        padding: 20px; 
                        background: white;
                        line-height: 1.6;
                    }
                    .prescription-print {
                        max-width: 800px;
                        margin: 0 auto;
                        background: white;
                        padding: 20px;
                        border: 1px solid #ddd;
                    }
                    .prescription-header {
                        text-align: center;
                        border-bottom: 2px solid #333;
                        padding-bottom: 15px;
                        margin-bottom: 20px;
                    }
                    .prescription-title h3 {
                        margin: 0;
                        font-size: 24px;
                        color: #333;
                    }
                    .info-row {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 20px;
                    }
                    .hospital-info, .patient-info {
                        flex: 1;
                    }
                    .prescription-content {
                        margin: 20px 0;
                    }
                    .prescription-text {
                        text-align: center;
                        font-size: 16px;
                        line-height: 1.8;
                        margin: 20px 0;
                    }
                    .prescription-footer {
                        margin-top: 30px;
                        border-top: 1px solid #ddd;
                        padding-top: 15px;
                    }
                    .doctor-signature {
                        text-align: right;
                        margin-bottom: 10px;
                    }
                    .prescription-note {
                        text-align: center;
                        font-style: italic;
                        color: #666;
                    }
                    @media print {
                        body { margin: 0; padding: 0; }
                        .prescription-actions { display: none !important; }
                    }
                </style>
            </head>
            <body>
                ${prescriptionContent}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
};

// Print Prescription
    $('#printPrescriptionBtn').on('click', function() {
        const prescriptionContent = $('#prescriptionContent').html();
        const printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title><?php echo lang('medical_prescription'); ?></title>
                    <style>
                        body { 
                            font-family: 'Times New Roman', serif; 
                            margin: 0; 
                            padding: 20px; 
                            background: white;
                            line-height: 1.6;
                        }
                        .prescription-print {
                            max-width: 800px;
                            margin: 0 auto;
                            border: 2px solid #333;
                            padding: 30px;
                            background: white;
                        }
                        .prescription-header {
                            border-bottom: 3px solid #333;
                            padding-bottom: 20px;
                            margin-bottom: 30px;
                        }
                        .info-row {
                            display: flex;
                            justify-content: space-between;
                            align-items: flex-start;
                            margin-bottom: 25px;
                            gap: 30px;
                        }
                        .hospital-info {
                            flex: 1;
                            text-align: left;
                        }
                        .hospital-name {
                            font-size: 24px;
                            font-weight: bold;
                            color: #2c3e50;
                            margin: 0 0 10px 0;
                        }
                        .hospital-details p {
                            margin: 5px 0;
                            font-size: 14px;
                            color: #555;
                        }
                        .prescription-title {
                            text-align: center;
                        }
                        .prescription-title h3 {
                            font-size: 24px;
                            font-weight: bold;
                            color: #2c3e50;
                            margin: 0;
                            letter-spacing: 2px;
                        }
                        .prescription-date {
                            font-size: 16px;
                            color: #666;
                            margin: 10px 0 0 0;
                        }
                        .prescription-doctor {
                            font-size: 18px;
                            color: #2c3e50;
                            margin: 8px 0 0 0;
                            font-weight: 600;
                        }
                        .patient-info {
                            background: #f8f9fa;
                            padding: 15px;
                            border-left: 4px solid #007bff;
                            margin-bottom: 25px;
                        }
                        .patient-info h4 {
                            color: #2c3e50;
                            margin: 0 0 10px 0;
                            font-size: 18px;
                        }
                        .patient-info p {
                            margin: 5px 0;
                            font-size: 16px;
                        }
                        .prescription-content {
                            margin-bottom: 30px;
                        }
                        .prescription-content h4 {
                            color: #2c3e50;
                            font-size: 18px;
                            margin: 0 0 15px 0;
                            border-bottom: 2px solid #007bff;
                            padding-bottom: 5px;
                        }
                        .prescription-text {
                            font-size: 16px;
                            line-height: 1.8;
                            white-space: pre-line;
                        }
                        .prescription-footer {
                            border-top: 2px solid #333;
                            padding-top: 20px;
                            margin-top: 30px;
                        }
                        .doctor-signature {
                            float: right;
                            text-align: right;
                            margin-bottom: 20px;
                        }
                        .doctor-signature p {
                            margin: 10px 0;
                            font-size: 16px;
                        }
                        .prescription-note {
                            clear: both;
                            text-align: center;
                            font-style: italic;
                            color: #666;
                            font-size: 14px;
                        }
                        @media print {
                            body { margin: 0; padding: 15px; }
                            .prescription-print { border: none; padding: 0; }
                        }
                    </style>
                </head>
                <body>
                    ${prescriptionContent}
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    });


    // Tab change handlers
    $('#treatmentTabs a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        const target = $(e.target).attr("href");
        
        // Enable/disable buttons based on current state
        if (target === '#treatment') {
            if ($('#generateTreatmentBtn').length) {
                $('#generateTreatmentBtn').prop('disabled', !currentTreatmentId);
            }
        } else if (target === '#prescription') {
            if ($('#generatePrescriptionBtn').length) {
                $('#generatePrescriptionBtn').prop('disabled', !currentTreatmentId);
            }
        }
    });
});

function showNotification(message, type) {
    // You can implement a toast notification here
    alert(message);
}
</script>

<style>
.nav-tabs .nav-link {
    border: none;
    border-bottom: 3px solid transparent;
    color: #6c757d;
    font-weight: 500;
}

.nav-tabs .nav-link.active {
    border-bottom-color: #007bff;
    color: #007bff;
    background: none;
}

.nav-tabs .nav-link:hover {
    border-bottom-color: #007bff;
    color: #007bff;
}

.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.btn-lg {
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
}

#loadingModal .modal-content {
    border: none;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

/* Ensure tab content is visible */
.tab-pane {
    display: none;
}

.tab-pane.show {
    display: block;
}

.tab-pane.show.active {
    display: block;
}

.analysis-result, .treatment-result, .prescription-result {
    white-space: pre-line;
    line-height: 1.6;
    font-size: 14px;
}
</style>
