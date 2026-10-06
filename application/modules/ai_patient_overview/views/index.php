<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('ai_patient_overview'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('ai_patient_overview'); ?></li>
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
                                <i class="fas fa-user-md mr-2"></i>
                                <?php echo lang('ai_patient_overview_generator'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="overviewTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="generate-tab" data-toggle="tab" href="#generate" role="tab" aria-controls="generate" aria-selected="true">
                                        <i class="fas fa-plus mr-1"></i> <?php echo lang('generate_overview'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">
                                        <i class="fas fa-file-medical mr-1"></i> <?php echo lang('patient_report'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">
                                        <i class="fas fa-history mr-1"></i> <?php echo lang('analysis_history'); ?>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="overviewTabContent">
                                <!-- Generate Overview Tab -->
                                <div class="tab-pane fade show active" id="generate" role="tabpanel" aria-labelledby="generate-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <!-- Patient & Doctor Selection -->
                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?php echo lang('select_patient'); ?> <span class="text-danger">*</span></label>
                                                        <select class="form-control select2" id="patientSelect" name="patient_id" required>
                                                            <option value=""><?php echo lang('choose_patient_dots'); ?></option>
                                                            <?php foreach ($patients as $patient): ?>
                                                                <option value="<?php echo $patient->id; ?>">
                                                                    <?php echo $patient->name . ' (' . $patient->age . ' years, ' . $patient->sex . ')'; ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label><?php echo lang('select_doctor'); ?> <span class="text-danger">*</span></label>
                                                        <?php if (count($doctors) == 1): ?>
                                                            <select class="form-control" id="doctorSelect" name="doctor_id" required readonly>
                                                                <option value="<?php echo $doctors[0]->id; ?>" selected>
                                                                    <?php echo $doctors[0]->name; ?>
                                                                </option>
                                                            </select>
                                                        <?php else: ?>
                                                            <select class="form-control" id="doctorSelect" name="doctor_id" required>
                                                                <option value=""><?php echo lang('choose_doctor_dots'); ?></option>
                                                                <?php foreach ($doctors as $doctor): ?>
                                                                    <option value="<?php echo $doctor->id; ?>">
                                                                        <?php echo $doctor->name; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Generate Button -->
                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary btn-lg" id="generateBtn" onclick="generateOverview()">
                                                    <i class="fas fa-brain mr-2"></i><?php echo lang('generate_ai_patient_overview'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Patient Report Tab -->
                                <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div id="overviewResults">
                                                        <div class="text-center text-muted py-5">
                                                            <i class="fas fa-user-md fa-3x mb-3"></i>
                                                            <h5><?php echo lang('no_overview_available'); ?></h5>
                                                            <p><?php echo lang('select_patient_generate_ai_overview'); ?></p>
                                                            <button type="button" class="btn btn-primary btn-lg" id="goToGenerateTabBtn">
                                                                <i class="fas fa-plus mr-2"></i>
                                                                <?php echo lang('go_to_generate_overview_tab'); ?>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Analysis History Tab -->
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-header bg-info text-white">
                                                    <h5 class="card-title mb-0">
                                                        <i class="fas fa-chart-line mr-2"></i>
                                                        <?php echo lang('analysis_history'); ?>
                                                    </h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="historyTable">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th><?php echo lang('date'); ?></th>
                                                                    <th><?php echo lang('patient'); ?></th>
                                                                    <th><?php echo lang('doctor'); ?></th>
                                                                    <th><?php echo lang('status'); ?></th>
                                                                    <th><?php echo lang('actions'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="5" class="text-center text-muted">
                                                                        <i class="fas fa-spinner fa-spin mr-2"></i><?php echo lang('loading_analysis_history'); ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
<div class="modal fade" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="loadingModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center py-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <h5><?php echo lang('ai_is_analyzing'); ?></h5>
                <p class="text-muted"><?php echo lang('please_wait_ai_analyzes_patient_data'); ?></p>
            </div>
        </div>
    </div>
</div>

<script>
let currentAnalysisId = null;

$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%'
    });

    // Handle tab clicks
    $('#generate-tab').on('click', function(e) {
        e.preventDefault();
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(this).addClass('active');
        $('#generate').addClass('show active');
    });
    
    $('#report-tab').on('click', function(e) {
        e.preventDefault();
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(this).addClass('active');
        $('#report').addClass('show active');
    });
    
    $('#history-tab').on('click', function(e) {
        e.preventDefault();
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        $(this).addClass('active');
        $('#history').addClass('show active');
        
        // Initialize DataTables if not already initialized
        if (!$.fn.DataTable.isDataTable('#historyTable')) {
            initializeHistoryDataTable();
        } else {
            // Refresh existing DataTable
            $('#historyTable').DataTable().ajax.reload();
        }
    });

    // Enable/disable generate button
    $('#patientSelect, #doctorSelect').on('change', function() {
        updateGenerateButtonState();
    });
    
    // Navigation function for going to generate tab
    window.goToGenerateTab = function() {
        console.log('Navigating to generate tab');
        try {
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('show active');
            $('#generate-tab').addClass('active');
            $('#generate').addClass('show active');
            console.log('Successfully navigated to generate tab');
        } catch (error) {
            console.error('Error navigating to generate tab:', error);
        }
    };
    
    // Event handler for the go to generate tab button
    $('#goToGenerateTabBtn').on('click', function() {
        console.log('Go to generate tab button clicked');
        goToGenerateTab();
    });
    
    // Event handler for generate new overview button (delegated event for dynamically created buttons)
    $(document).on('click', '#generateNewOverviewBtn', function() {
        console.log('Generate new overview button clicked');
        // Reset overview state and go to generate tab
        resetOverviewState();
        goToGenerateTab();
    });
    
    // Function to reset overview state and show the button
    window.resetOverviewState = function() {
        $('#overviewResults').html(`
            <div class="text-center text-muted py-5">
                <i class="fas fa-user-md fa-3x mb-3"></i>
                <h5><?php echo lang('no_overview_available'); ?></h5>
                <p>Select a patient and generate an AI overview to see the report here.</p>
                <button type="button" class="btn btn-primary btn-lg" id="goToGenerateTabBtn">
                    <i class="fas fa-plus mr-2"></i>
                    Go to Generate Overview Tab
                </button>
            </div>
        `);
        
        // Re-bind the event handler for the new button
        $('#goToGenerateTabBtn').on('click', function() {
            console.log('Go to generate tab button clicked (reset)');
            goToGenerateTab();
        });
    };
});

function updateGenerateButtonState() {
    const patientSelected = $('#patientSelect').val();
    const doctorSelected = $('#doctorSelect').val();
    
    $('#generateBtn').prop('disabled', !(patientSelected && doctorSelected));
}

function generateOverview() {
    const patientId = $('#patientSelect').val();
    const doctorId = $('#doctorSelect').val();
    
    if (!patientId || !doctorId) {
        showNotification('Please select both patient and doctor.', 'error');
        return;
    }

    $('#loadingModal').modal('show');
    
    $.ajax({
        url: '<?php echo base_url(); ?>ai_patient_overview/getPatientOverview',
        type: 'POST',
        data: {
            patient_id: patientId,
            doctor_id: doctorId
        },
        dataType: 'json',
        success: function(response) {
            $('#loadingModal').modal('hide');
            
            if (response.success) {
                currentAnalysisId = response.analysis_id;
                // Add doctor name to patient data
                response.patient_data.doctor_name = $('#doctorSelect option:selected').text();
                displayOverviewResult(response.patient_data, response.ai_analysis, null);
                
                // Switch to report tab
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('show active');
                $('#report-tab').addClass('active');
                $('#report').addClass('show active');
                
                loadAnalysisHistory();
            } else {
                showNotification(response.message || 'Analysis failed', 'error');
            }
        },
        error: function() {
            $('#loadingModal').modal('hide');
            showNotification('An error occurred during analysis', 'error');
        }
    });
}

function displayOverviewResult(patientData, analysisResult, analysisData = null) {
    // Get the actual generation time from database or use current time as fallback
    let generatedTime = new Date();
    let analysisId = 'N/A';
    
    if (analysisData) {
        // Use actual data from database
        generatedTime = new Date(analysisData.created_at);
        analysisId = analysisData.id;
    }
    
    const resultHTML = `
        <div class="container-fluid" id="printableOverview">
            <!-- Report Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="fas fa-user-md mr-2"></i><?php echo $settings->title ?? 'Hospital'; ?> - AI Patient Overview Report
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Generated:</strong> ${generatedTime.toLocaleDateString()} at ${generatedTime.toLocaleTimeString()}</p>
                                    <p class="mb-0"><strong>Analysis ID:</strong> #${analysisId}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Patient:</strong> ${patientData.patient ? patientData.patient.name : 'Unknown Patient'}</p>
                                    <p class="mb-0"><strong>Doctor:</strong> ${patientData.doctor_name || 'Unknown Doctor'}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- AI Analysis Result -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-brain mr-2"></i><?php echo lang('ai_analysis_overview'); ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="analysis-result">${analysisResult}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Summary -->
            <div class="row mb-4">
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-primary">${patientData.appointments ? patientData.appointments.length : 0}</h5>
                            <p class="card-text"><?php echo lang('appointments'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-warning">${patientData.prescriptions ? patientData.prescriptions.length : 0}</h5>
                            <p class="card-text"><?php echo lang('prescriptions'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-info">${patientData.lab_reports ? patientData.lab_reports.length : 0}</h5>
                            <p class="card-text"><?php echo lang('lab_tests'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-success">${patientData.vital_signs ? patientData.vital_signs.length : 0}</h5>
                            <p class="card-text"><?php echo lang('vital_signs'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-danger">${patientData.medical_history ? patientData.medical_history.length : 0}</h5>
                            <p class="card-text"><?php echo lang('case_history'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title text-secondary">${patientData.bed_allotments ? patientData.bed_allotments.length : 0}</h5>
                            <p class="card-text"><?php echo lang('hospitalizations'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="row">
                <div class="col-md-6">
                    <div class="text-center">
                        <p class="mb-1"><strong>Doctor's Signature:</strong></p>
                        <div class="border-bottom mb-2" style="height: 2px;"></div>
                        <p class="mb-0">${patientData.doctor_name || 'Dr. Name'}</p>
                        <small class="text-muted">Date: ${new Date().toLocaleDateString()}</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-center">
                        <p class="mb-1"><strong>Hospital Stamp:</strong></p>
                        <div class="border border-dark" style="height: 60px; width: 120px; margin: 0 auto;"></div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-success btn-lg mr-3" onclick="printOverviewReport()">
                                <i class="fas fa-print mr-2"></i>
                                Print Report
                            </button>
                            <button type="button" class="btn btn-primary btn-lg" id="generateNewOverviewBtn">
                                <i class="fas fa-sync-alt mr-2"></i>
                                Generate New Overview
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    $('#overviewResults').html(resultHTML);
}

function printOverviewReport() {
    const printContent = document.getElementById('printableOverview').innerHTML;
    const originalContent = document.body.innerHTML;
    
    document.body.innerHTML = `
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    ${printContent}
                </div>
            </div>
        </div>
    `;
    
    window.print();
    document.body.innerHTML = originalContent;
}

function initializeHistoryDataTable() {
    console.log('Initializing DataTables for analysis history...');
    
    $('#historyTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo base_url(); ?>ai_patient_overview/getAnalysisHistoryDataTables',
            type: 'POST',
            data: function(d) {
                // Add CSRF token if available
                d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
            },
            error: function(xhr, error, thrown) {
                console.error('DataTables AJAX error:', xhr.responseText);
                showNotification('Error loading analysis history', 'error');
            }
        },
        columns: [
            { data: 0, title: 'Date' },
            { data: 1, title: 'Patient' },
            { data: 2, title: 'Doctor' },
            { data: 3, title: 'Status' },
            { data: 4, title: 'Actions', orderable: false, searchable: false }
        ],
        order: [[0, 'desc']], // Sort by date descending by default
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        responsive: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin mr-2"></i>Loading analysis history...',
            emptyTable: '<i class="fas fa-inbox fa-2x mb-2"></i><p class="mb-0">No analysis history found</p>',
            zeroRecords: '<i class="fas fa-search fa-2x mb-2"></i><p class="mb-0">No matching records found</p>'
        },
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        drawCallback: function(settings) {
            console.log('DataTables draw completed');
        }
    });
}

function loadAnalysisHistory() {
    $.ajax({
        url: '<?php echo base_url(); ?>ai_patient_overview/getAnalysisHistory',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response && response.length > 0) {
                let tableRows = '';
                response.forEach(function(analysis) {
                    const status = analysis.status === 'completed' ? 
                        '<span class="badge badge-success">Completed</span>' : 
                        '<span class="badge badge-warning">Pending</span>';
                    
                    const actions = `
                        <a class="btn btn-sm btn-outline-primary" onclick="viewAnalysis(${analysis.id})">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-danger" onclick="deleteAnalysis(${analysis.id})">
                            <i class="fas fa-trash"></i>
                        </a>
                    `;
                    
                    tableRows += `
                        <tr>
                            <td>${analysis.created_at}</td>
                            <td>${analysis.patient_name}</td>
                            <td>${analysis.doctor_name}</td>
                            <td>${status}</td>
                            <td>${actions}</td>
                        </tr>
                    `;
                });
                
                $('#historyTable tbody').html(tableRows);
            } else {
                $('#historyTable tbody').html(`
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">No analysis history found</p>
                        </td>
                    </tr>
                `);
            }
        },
        error: function() {
            $('#historyTable tbody').html(`
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <p class="mb-0">Error loading analysis history</p>
                    </td>
                </tr>
            `);
        }
    });
}

function viewAnalysis(analysisId) {
    $.ajax({
        url: '<?php echo base_url(); ?>ai_patient_overview/getAnalysisById',
        type: 'POST',
        data: { analysis_id: analysisId },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Create a more complete patient data object for display
                const patientData = {
                    patient: {
                        name: response.analysis.patient_name || 'Unknown Patient',
                        age: 'N/A',
                        sex: 'N/A',
                        id: response.analysis.patient_id || 'N/A'
                    },
                    doctor_name: response.analysis.doctor_name || 'Dr. Name',
                    appointments: [],
                    prescriptions: [],
                    lab_reports: [],
                    medical_history: [],
                    vital_signs: [],
                    bed_allotments: [],
                    patient_materials: [],
                    payments: [],
                    diagnoses: []
                };
                
                displayOverviewResult(patientData, response.analysis.analysis_result, response.analysis);
                
                // Switch to report tab
                $('.nav-link').removeClass('active');
                $('.tab-pane').removeClass('show active');
                $('#report-tab').addClass('active');
                $('#report').addClass('show active');
            } else {
                showNotification('Analysis not found', 'error');
            }
        },
        error: function() {
            showNotification('Error loading analysis', 'error');
        }
    });
}

function deleteAnalysis(analysisId) {
    if (confirm('Are you sure you want to delete this analysis?')) {
        $.ajax({
            url: '<?php echo base_url(); ?>ai_patient_overview/deleteAnalysis',
            type: 'POST',
            data: { analysis_id: analysisId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification('Analysis deleted successfully', 'success');
                    
                    // Reload DataTable if it's initialized, otherwise use fallback
                    if ($.fn.DataTable.isDataTable('#historyTable')) {
                        $('#historyTable').DataTable().ajax.reload();
                    } else {
                        loadAnalysisHistory(); // Fallback if DataTable not initialized
                    }
                } else {
                    showNotification('Error deleting analysis', 'error');
                }
            },
            error: function() {
                showNotification('Error deleting analysis', 'error');
            }
        });
    }
}

function printOverviewReport() {
    const printContent = document.getElementById('printableOverview').innerHTML;
    const originalContent = document.body.innerHTML;
    
    document.body.innerHTML = `
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    ${printContent}
                </div>
            </div>
        </div>
    `;
    
    window.print();
    document.body.innerHTML = originalContent;
}

function downloadOverviewReport() {
    const reportContent = document.getElementById('printableOverview').innerHTML;
    const patientName = $('#patientSelect option:selected').text().split(' (')[0];
    const timestamp = new Date().toISOString().split('T')[0];
    const filename = `AI_Patient_Overview_${patientName}_${timestamp}.html`;
    
    const blob = new Blob([`
        <!DOCTYPE html>
        <html>
        <head>
            <title>AI Patient Overview Report</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
            <style>
                @media print {
                    .no-print { display: none !important; }
                    body { font-size: 12px; }
                    .report-header h4 { font-size: 18px; }
                    .section-title { font-size: 14px; }
                }
            </style>
        </head>
        <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        ${reportContent}
                    </div>
                </div>
            </div>
        </body>
        </html>
    `], { type: 'text/html' });
    
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = filename;
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    window.URL.revokeObjectURL(url);
}

function showNotification(message, type) {
    alert(message);
}

</script>

<style>
.analysis-result {
    white-space: pre-line;
    line-height: 1.6;
    font-size: 14px;
}

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
 
</style>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.bootstrap4.min.js"></script> 
