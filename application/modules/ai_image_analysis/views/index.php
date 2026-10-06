<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('ai_image_analysis'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('ai_image_analysis'); ?></li>
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
                                <i class="fas fa-brain mr-2"></i>
                                <?php echo lang('ai_medical_image_analysis'); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs" id="analysisTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">
                                        <i class="fas fa-upload mr-1"></i> <?php echo lang('upload_analyze'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report" aria-selected="false">
                                        <i class="fas fa-file-medical mr-1"></i> <?php echo lang('analysis_report'); ?>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab" aria-controls="history" aria-selected="false">
                                        <i class="fas fa-history mr-1"></i> <?php echo lang('analytics_history'); ?>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content" id="analysisTabContent">
                                <!-- Upload & Analyze Tab -->
                                <div class="tab-pane fade show active" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <!-- Patient & Doctor Selection -->
                                            <div class="row mb-4">
                                        <div class="col-md-4">
                                        <div class="form-group">
                                                <label><?php echo lang('patient'); ?></label>
                                            <select class="form-control select2" id="patientSelect" name="patient_id" required>
                                                    <option value=""><?php echo lang('choose_patient_dots'); ?></option>
                                                <?php foreach ($patients as $patient): ?>
                                                    <option value="<?php echo $patient->id; ?>" data-patient-id="<?php echo $patient->id; ?>">
                                                            <?php echo 'ID: ' . $patient->id . ' - ' . $patient->name . ' (' . $patient->age . ' years, ' . $patient->sex . ')'; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                        
                                        <div class="col-md-4">
                                        <div class="form-group">
                                                <label><?php echo lang('doctor'); ?></label>
                                            <?php if (count($doctors) == 1): ?>
                                                <select class="form-control select2" id="doctorSelect" name="doctor_id" required readonly>
                                                    <option value="<?php echo $doctors[0]->id; ?>" selected>
                                                        <?php echo $doctors[0]->name; ?>
                                                    </option>
                                                </select>
                                            <?php else: ?>
                                                <select class="form-control select2" id="doctorSelect" name="doctor_id" required>
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
                                
                                        <div class="col-md-4">
                                        <div class="form-group">
                                                <label><?php echo lang('notes_optional'); ?></label>
                                                <textarea class="form-control" id="description" name="description" rows="2" 
                                                          placeholder="Additional context..."></textarea>
                                        </div>
                                    </div>
                                        </div>

                                    <!-- Image Upload Section -->
                                    <form id="imageUploadForm" enctype="multipart/form-data">
                                        <!-- Image Upload Area -->
                                        <div id="imageSelector" class="text-center border border-dashed rounded p-4 mb-3" style="border-color: #dee2e6;">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted"><?php echo lang('select_medical_image'); ?></h5>
                                            <p class="text-muted"><?php echo lang('ai_will_automatically_detect_image_type'); ?></p>
                                            <small class="text-muted">JPG, PNG, GIF, BMP, TIFF, WebP (Max: 10MB)</small>
                                            <br><br>
                                            <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('imageFile').click()">
                                                <i class="fas fa-plus mr-2"></i><?php echo lang('choose_image'); ?>
                                            </button>
                                            <input type="file" class="d-none" id="imageFile" name="image" accept="image/*" required>
                                </div>
                                
                                        <!-- Image Preview -->
                                        <div id="imagePreviewSection" class="text-center mb-3" style="display: none;">
                                            <img id="imagePreview" src="" alt="Selected Image" class="img-fluid rounded border mb-2" style="max-height: 300px;">
                                            <div>
                                                <small class="text-muted" id="imageInfo"></small>
                                                <button type="button" class="btn btn-sm btn-outline-secondary ml-2" onclick="clearImage()">
                                                    <i class="fas fa-times mr-1"></i>Change
                                                </button>
                                    </div>
                                </div>
                                
                                <div class="text-center">
                                            <button type="button" class="btn btn-success btn-lg" id="uploadBtn" disabled onclick="submitForm()">
                                                <i class="fas fa-brain mr-2"></i>Analyze with AI
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                        </div>
                                </div>

                                <!-- Analysis Report Tab -->
                                <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab">
                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                        <div class="card-body">
                            <div id="analysisResults">
                                                        <div class="text-center text-muted py-5">
                                                            <i class="fas fa-file-medical fa-3x mb-3"></i>
                                                            <h5><?php echo lang('no_analysis_available'); ?></h5>
                                                            <p>Upload an image and run AI analysis to see the report here.</p>
                                                            <button type="button" class="btn btn-primary btn-lg" id="goToUploadFromReportBtn">
                                                                <i class="fas fa-upload mr-2"></i>
                                                                Go to Upload & Analyze Tab
                                                            </button>
                                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                                <!-- Analytics History Tab -->
                                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
            <div class="row mt-4">
                                        <div class="col-md-12">
                                            <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="card-title mb-0">
                                                        <i class="fas fa-chart-line mr-2"></i>
                                                        Analytics History
                            </h5>
                        </div>
                        <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-hover" id="analyticsTable">
                                                            <thead class="thead-light">
                                                                <tr>
                                                                    <th><?php echo lang('date'); ?></th>
                                                                    <th><?php echo lang('patient'); ?></th>
                                                                    <th><?php echo lang('doctor'); ?></th>
                                                                    <th><?php echo lang('image_type'); ?></th>
                                                                    <th><?php echo lang('status'); ?></th>
                                                                    <th><?php echo lang('actions'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td colspan="6" class="text-center text-muted">
                                                                        <i class="fas fa-spinner fa-spin mr-2"></i>Loading analytics data...
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
                <h5>AI is analyzing...</h5>
                <p class="text-muted">Please wait while our AI analyzes the medical image.</p>
            </div>
        </div>
    </div>
</div>


<!-- Analysis Report Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="reportModalLabel">
                    <i class="fas fa-file-medical mr-2"></i>
                    Medical Image Analysis Report
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="reportContent">
                <!-- Report content will be loaded here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button type="button" class="btn btn-primary" id="printReportBtn">
                    <i class="fas fa-print mr-2"></i>
                    <?php echo lang('print_report'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentAnalysisId = null;

$(document).ready(function() {
    // Initialize Select2 with enhanced search
    $('.select2').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Search and select...',
        allowClear: true,
        minimumInputLength: 0,
        language: {
            noResults: function() {
                return "No results found";
            },
            searching: function() {
                return "Searching...";
            }
        }
    });
    
    // Enhanced configuration for patient select
    $('#patientSelect').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: 'Search by patient ID, name, age, or gender...',
        allowClear: true,
        minimumInputLength: 0,
        matcher: function(params, data) {
            // If there are no search terms, return all data
            if ($.trim(params.term) === '') {
                return data;
            }
            
            // Check if the search term matches any part of the text
            var searchTerm = params.term.toLowerCase();
            var text = data.text.toLowerCase();
            
            // Also check the data-patient-id attribute
            var patientId = $(data.element).attr('data-patient-id');
            if (patientId && patientId.toString().toLowerCase().indexOf(searchTerm) !== -1) {
                return data;
            }
            
            // Check if the text contains the search term
            if (text.indexOf(searchTerm) !== -1) {
                return data;
            }
            
            // Return null if no match
            return null;
        },
        language: {
            noResults: function() {
                return "No patients found matching your search";
            },
            searching: function() {
                return "Searching patients...";
            }
        }
    });

    // Enable/disable upload button based on form completion
    $('#patientSelect, #doctorSelect, #imageFile').on('change', function() {
        updateUploadButtonState();
    });
    
    // Handle image preview
    $('#imageFile').on('change', function(e) {
        console.log('File input changed');
        const file = e.target.files[0];
        if (file) {
            console.log('File selected:', file.name, file.type, file.size);
            
            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/bmp', 'image/tiff', 'image/webp'];
            if (!allowedTypes.includes(file.type)) {
                alert('Please select a valid image file (JPG, PNG, GIF, BMP, TIFF, WebP)');
                $(this).val('');
                return;
            }
            
            // Validate file size (10MB limit)
            if (file.size > 10485760) {
                alert('File size too large. Maximum size is 10MB.');
                $(this).val('');
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                console.log('Image loaded, setting preview...');
                console.log('Image selector visible:', $('#imageSelector').is(':visible'));
                console.log('Image preview section visible:', $('#imagePreviewSection').is(':visible'));
                
                $('#imagePreview').attr('src', e.target.result);
                $('#imageInfo').text(`${file.name} (${(file.size / 1024 / 1024).toFixed(2)} MB)`);
                
                // Force hide/show with important
                $('#imageSelector').hide();
                $('#imagePreviewSection').show();
                
                console.log('After toggle - Selector visible:', $('#imageSelector').is(':visible'));
                console.log('After toggle - Preview visible:', $('#imagePreviewSection').is(':visible'));
                
                updateUploadButtonState();
            };
            reader.readAsDataURL(file);
        } else {
            console.log('No file selected');
            $('#imagePreviewSection').hide();
            $('#imageSelector').show();
            updateUploadButtonState();
        }
    });
    
    // Check if doctor is pre-selected (for doctor login)
    if ($('#doctorSelect').val() !== '') {
        // Doctor is pre-selected, trigger validation
        $('#patientSelect, #imageFile').trigger('change');
    }
    
    // Initial button state check
    updateUploadButtonState();

    // Image upload form submission
    $('#imageUploadForm').on('submit', function(e) {
        e.preventDefault();
        submitForm();
    });

    // Patient selection change - load analysis history
    $('#patientSelect').on('change', function() {
        const patientId = $(this).val();
        if (patientId) {
            loadAnalysisHistory(patientId);
        } else {
            $('#analysisHistory').html(`
                <div class="text-center text-muted">
                    <i class="fas fa-clock fa-3x mb-3"></i>
                    <p>Select a patient to view their analysis history.</p>
                </div>
            `);
        }
    });
    
    // Handle tab clicks using Bootstrap's built-in functionality
    $('#analysisTabs a[data-toggle="tab"]').on('click', function (e) {
        e.preventDefault();
        var target = $(this).attr('href');
        console.log('Tab clicked:', target);
        console.log('Target element exists:', $(target).length > 0);
        
        // Remove active class from all tabs and panes
        $('#analysisTabs .nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active');
        console.log('Removed active classes from all tabs and panes');
        
        // Add active class to clicked tab
        $(this).addClass('active');
        console.log('Added active class to clicked tab');
        
        // Show the target pane
        $(target).addClass('show active');
        console.log('Added show active classes to target pane');
        console.log('Target pane classes:', $(target).attr('class'));
        
        // Load analytics history if history tab is clicked
        if (target === '#history') {
            console.log('Loading analytics history...');
            console.log('Current URL:', window.location.href);
            console.log('Session check - logged in:', <?php echo $this->ion_auth->logged_in() ? 'true' : 'false'; ?>);
            console.log('Hospital ID:', '<?php echo $this->session->userdata('hospital_id'); ?>');
            
            // Initialize DataTables if not already initialized
            if (!$.fn.DataTable.isDataTable('#analyticsTable')) {
                initializeAnalyticsDataTable();
            } else {
                // Refresh existing DataTable
                $('#analyticsTable').DataTable().ajax.reload();
            }
        }
    });
    
    // Event handler for go to upload from report button
    $('#goToUploadFromReportBtn').on('click', function() {
        console.log('Go to upload from report button clicked');
        goToUploadTab();
    });
    
    // Navigation function for going to upload tab
    window.goToUploadTab = function() {
        console.log('Navigating to upload tab');
        try {
            $('#analysisTabs .nav-link').removeClass('active');
            $('.tab-pane').removeClass('show active');
            $('#upload-tab').addClass('active');
            $('#upload').addClass('show active');
            console.log('Successfully navigated to upload tab');
        } catch (error) {
            console.error('Error navigating to upload tab:', error);
        }
    };
    
    // Function to reset analysis state and show the button
    window.resetAnalysisState = function() {
        $('#analysisResults').html(`
            <div class="text-center text-muted py-5">
                <i class="fas fa-file-medical fa-3x mb-3"></i>
                <h5>No Analysis Available</h5>
                <p>Upload an image and run AI analysis to see the report here.</p>
                <button type="button" class="btn btn-primary btn-lg" id="goToUploadFromReportBtn">
                    <i class="fas fa-upload mr-2"></i>
                    Go to Upload & Analyze Tab
                </button>
            </div>
        `);
        
        // Re-bind the event handler for the new button
        $('#goToUploadFromReportBtn').on('click', function() {
            console.log('Go to upload from report button clicked (reset)');
            goToUploadTab();
        });
    };
});

function loadAnalyticsHistory() {
    console.log('Loading analytics history...');
    console.log('AJAX URL:', '<?php echo base_url(); ?>ai_image_analysis/getAnalyticsHistory');
        
        $.ajax({
        url: '<?php echo base_url(); ?>ai_image_analysis/getAnalyticsHistory',
        type: 'GET',
            dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        beforeSend: function(xhr) {
            console.log('AJAX request starting...');
            console.log('Request headers:', xhr.getAllResponseHeaders);
        },
            success: function(response) {
            console.log('Analytics response:', response);
            console.log('Response type:', typeof response);
            console.log('Response length:', response ? response.length : 'undefined');
            
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
                            <td>${analysis.image_type || 'Auto-detected'}</td>
                            <td>${status}</td>
                            <td>${actions}</td>
                        </tr>
                    `;
                });
                
                $('#analyticsTable tbody').html(tableRows);
                } else {
                console.log('No analytics data found');
                $('#analyticsTable tbody').html(`
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            <i class="fas fa-inbox fa-2x mb-2"></i>
                            <p class="mb-0">No analytics data found</p>
                        </td>
                    </tr>
                `);
            }
        },
        error: function(xhr, status, error) {
            console.error('Analytics error:', xhr.responseText);
            console.error('Status:', status);
            console.error('Error:', error);
            
            let errorMessage = 'Unknown error occurred';
            try {
                const response = JSON.parse(xhr.responseText);
                if (response.error) {
                    errorMessage = response.error;
                }
            } catch (e) {
                errorMessage = xhr.responseText || error;
            }
            
            $('#analyticsTable tbody').html(`
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                        <p class="mb-0">Error loading analytics data: ${errorMessage}</p>
                        <small class="text-muted">Check browser console for more details</small>
                    </td>
                </tr>
            `);
        }
    });
}

function initializeAnalyticsDataTable() {
    console.log('Initializing DataTables for analytics history...');
    
    $('#analyticsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo base_url(); ?>ai_image_analysis/getAnalyticsHistoryDataTables',
            type: 'POST',
            data: function(d) {
                // Add CSRF token if available
                d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
            },
            error: function(xhr, error, thrown) {
                console.error('DataTables AJAX error:', xhr.responseText);
                showNotification('Error loading analytics data', 'error');
            }
        },
        columns: [
            { data: 0, title: 'Date' },
            { data: 1, title: 'Patient' },
            { data: 2, title: 'Doctor' },
            { data: 3, title: 'Image Type' },
            { data: 4, title: 'Status' },
            { data: 5, title: 'Actions', orderable: false, searchable: false }
        ],
        order: [[0, 'desc']], // Sort by date descending by default
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        responsive: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin mr-2"></i>Loading analytics data...',
            emptyTable: '<i class="fas fa-inbox fa-2x mb-2"></i><p class="mb-0">No analytics data found</p>',
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

function viewAnalysis(analysisId) {
    // Load and display the analysis result
    $.ajax({
        url: '<?php echo base_url(); ?>ai_image_analysis/getImageAnalysisById',
        type: 'POST',
        data: { analysis_id: analysisId },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.analysis) {
                // Display the analysis result in tab with full analysis data
                displayAnalysisResult(response.analysis.analysis_result, response.analysis);
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
            url: '<?php echo base_url(); ?>ai_image_analysis/deleteImageAnalysis',
            type: 'POST',
            data: { analysis_id: analysisId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    showNotification('Analysis deleted successfully', 'success');
                    // Reload analytics history only if history tab is active
                    if ($('#history-tab').hasClass('active')) {
                        if ($.fn.DataTable.isDataTable('#analyticsTable')) {
                            $('#analyticsTable').DataTable().ajax.reload();
                        } else {
                            loadAnalyticsHistory();
                        }
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

function analyzeImage(analysisId) {
    $('#loadingModal').modal('show');
    
    $.ajax({
        url: '<?php echo base_url(); ?>ai_image_analysis/analyzeImage',
        type: 'POST',
        data: {
            analysis_id: analysisId
        },
        dataType: 'json',
        success: function(response) {
            $('#loadingModal').modal('hide');
            
            if (response.success) {
                displayAnalysisResult(response.analysis_result);
                showNotification('AI analysis completed successfully!', 'success');
                
                // Reload analysis history
                const patientId = $('#patientSelect').val();
                if (patientId) {
                    loadAnalysisHistory(patientId);
                }
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

function displayAnalysisResult(analysisResult, analysisData = null) {
    // Parse the analysis result to extract structured sections
    const sections = parseAnalysisResult(analysisResult);
    
    // Get the actual generation time from database or use current time as fallback
    let generatedTime = new Date();
    let analysisId = Date.now().toString().slice(-6);
    let patientId = $('#patientSelect').val() || 'N/A';
    let patientName = $('#patientSelect option:selected').text().replace('ID: ' + patientId + ' - ', '') || 'N/A';
    let doctorName = $('#doctorSelect option:selected').text() || 'N/A';
    
    if (analysisData) {
        // Use actual data from database
        generatedTime = new Date(analysisData.created_at);
        analysisId = analysisData.id;
        patientId = analysisData.patient_id;
        doctorName = analysisData.doctor_name || 'Unknown Doctor';
        
        // Get patient name from analysis data if available
        if (analysisData.patient_name) {
            patientName = analysisData.patient_name;
        }
    }
    
    const resultHTML = `
        <div class="container-fluid" id="printableAnalysis">
            <!-- Report Header -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">
                                <i class="fas fa-brain mr-2"></i><?php echo $settings->title ?? 'Hospital'; ?> - AI Medical Image Analysis Report
                            </h4>
            </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Generated:</strong> ${generatedTime.toLocaleDateString()} at ${generatedTime.toLocaleTimeString()}</p>
                                    <p class="mb-0"><strong>Analysis ID:</strong> #${analysisId}</p>
            </div>
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Patient ID:</strong> ${patientId}</p>
                                    <p class="mb-1"><strong>Patient:</strong> ${patientName}</p>
                                    <p class="mb-0"><strong>Doctor:</strong> ${doctorName}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Confidence Level Indicator -->
            
            <!-- Analysis Results -->
            <div class="row">
                <div class="col-12">
                    ${sections.map(section => `
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <i class="fas ${getSectionIcon(section.title)} mr-2"></i>
                                    ${section.title}
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="text-justify">
                                    ${section.content.split('\n').map(line => 
                                        line.trim() ? `<p class="mb-2">${line.replace(/^-\s*/, '')}</p>` : ''
                                    ).join('')}
                                </div>
                            </div>
                        </div>
                    `).join('')}
                </div>
            </div>
            
            <!-- Disclaimer -->
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle mr-2"></i>AI Analysis Disclaimer</h6>
                        <p class="mb-0 small">
                            This analysis was generated by artificial intelligence and should be used as a supplementary tool for medical professionals. 
                            It is not a substitute for professional medical judgment, diagnosis, or treatment.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1"><strong>Doctor's Signature:</strong></p>
                                    <div class="border-bottom mb-2" style="height: 2px;"></div>
                                    <p class="mb-0">${$('#doctorSelect option:selected').text()}</p>
                                    <small class="text-muted">Date: ${new Date().toLocaleDateString()}</small>
                                </div>
                                <div class="col-md-6">
                                    <div id="hospitalDetails">
                                        <p class="mb-1"><strong>Hospital Information:</strong></p>
                                        <p class="mb-1"><strong>Name:</strong> <?php echo $settings->title ?? 'Hospital Name'; ?></p>
                                        <p class="mb-1"><strong>Address:</strong> <?php echo $settings->address ?? 'Hospital Address'; ?></p>
                                        <p class="mb-1"><strong>Phone:</strong> <?php echo $settings->phone ?? 'Hospital Phone'; ?></p>
                                        <p class="mb-0"><strong>Email:</strong> <?php echo $settings->email ?? 'Hospital Email'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Print Button -->
            <div class="row mt-4 no-print">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <button type="button" class="btn btn-success btn-lg" onclick="printAnalysisReport()">
                                <i class="fas fa-print mr-2"></i>
                                Print Report
                </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Hide loading modal and show report in tab
    $('#loadingModal').modal('hide');
    $('#analysisResults').html(resultHTML);
    
    // Switch to report tab
    $('#report-tab').tab('show');
    
    // Hospital details are already loaded from PHP settings
}


function parseAnalysisResult(analysisResult) {
    const sections = [];
    const lines = analysisResult.split('\n');
    let currentSection = null;
    let currentContent = [];
    
    for (let line of lines) {
        const trimmedLine = line.trim();
        
        // Check if this is a section header
        if (trimmedLine.startsWith('**') && trimmedLine.endsWith('**')) {
            // Save previous section if exists
            if (currentSection) {
                sections.push({
                    title: currentSection,
                    content: currentContent.join('\n').replace(/\*\*/g, '').trim()
                });
            }
            
            // Start new section
            currentSection = trimmedLine.replace(/\*\*/g, '').trim();
            currentContent = [];
        } else if (trimmedLine.startsWith('-') || trimmedLine.length > 0) {
            // Add content to current section
            currentContent.push(trimmedLine);
        }
    }
    
    // Add the last section
    if (currentSection) {
        sections.push({
            title: currentSection,
            content: currentContent.join('\n').replace(/\*\*/g, '').trim()
        });
    }
    
    return sections;
}

function getSectionIcon(sectionTitle) {
    const iconMap = {
        'CLINICAL FINDINGS': 'fa-stethoscope',
        'ANALYSIS': 'fa-microscope',
        'RECOMMENDATIONS': 'fa-prescription-bottle-alt',
        'NOTES': 'fa-clipboard-list'
    };
    
    return iconMap[sectionTitle] || 'fa-file-medical';
}

function loadAnalysisHistory(patientId) {
    $.ajax({
        url: '<?php echo base_url(); ?>ai_image_analysis/getAnalysisHistory',
        type: 'POST',
        data: {
            patient_id: patientId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success && response.analyses.length > 0) {
                let historyHTML = '<div class="table-responsive"><table class="table table-striped">';
                historyHTML += '<thead><tr><th>Date</th><th>Image Type</th><th>Doctor</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
                
                response.analyses.forEach(function(analysis) {
                    const status = analysis.analysis_result ? 
                        '<span class="badge badge-success">Completed</span>' : 
                        '<span class="badge badge-warning">Pending</span>';
                    
                    const actions = analysis.analysis_result ? 
                        `<button class="btn btn-sm btn-primary" onclick="viewFullReport('${analysis.id}')">View Report</button>` :
                        `<button class="btn btn-sm btn-warning" onclick="analyzeImage('${analysis.id}')">Analyze</button>`;
                    
                    const imageTypeDisplay = analysis.image_type === 'auto_detect' ? 'Auto-Detected' : analysis.image_type.replace('_', ' ').toUpperCase();
                    
                    historyHTML += `
                        <tr>
                            <td>${new Date(analysis.created_at).toLocaleDateString()}</td>
                            <td><span class="badge badge-info">${imageTypeDisplay}</span></td>
                            <td>${analysis.doctor_name}</td>
                            <td>${status}</td>
                            <td>${actions}</td>
                        </tr>
                    `;
                });
                
                historyHTML += '</tbody></table></div>';
                $('#analysisHistory').html(historyHTML);
            } else {
                $('#analysisHistory').html(`
                    <div class="text-center text-muted">
                        <i class="fas fa-inbox fa-3x mb-3"></i>
                        <p>No analysis history found for this patient.</p>
                    </div>
                `);
            }
        },
        error: function() {
            $('#analysisHistory').html(`
                <div class="text-center text-muted">
                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                    <p>Error loading analysis history.</p>
                </div>
            `);
        }
    });
}

function viewFullReport(analysisId) {
    // This would typically load the full report from the database
    // For now, we'll show a placeholder
    $('#reportContent').html(`
        <div class="text-center">
            <i class="fas fa-file-medical fa-3x mb-3 text-primary"></i>
            <h5>Full Medical Report</h5>
            <p class="text-muted">Loading detailed report...</p>
        </div>
    `);
    
    $('#reportModal').modal('show');
}

function updateUploadButtonState() {
    const patientSelected = $('#patientSelect').val() !== '';
    const doctorSelected = $('#doctorSelect').val() !== '';
    const imageSelected = $('#imageFile')[0].files.length > 0;
    
    $('#uploadBtn').prop('disabled', !(patientSelected && doctorSelected && imageSelected));
}

function printAnalysisReport() {
    const printContent = document.getElementById('printableAnalysis').innerHTML;
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
    // Remove location.reload() to keep the image and report visible
}

function downloadAnalysisReport() {
    const reportContent = document.getElementById('printableAnalysis').innerHTML;
    const patientName = $('#patientSelect option:selected').text().split(' (')[0];
    const timestamp = new Date().toISOString().split('T')[0];
    const filename = `Medical_Image_Analysis_${patientName}_${timestamp}.html`;
    
    const blob = new Blob([`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Medical Image Analysis Report</title>
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

function submitForm() {
    // Validate form
    const patientId = $('#patientSelect').val();
    const doctorId = $('#doctorSelect').val();
    const imageFile = $('#imageFile')[0].files[0];
    const description = $('#description').val();
    
    if (!patientId || !doctorId || !imageFile) {
        showNotification('Please fill in all required fields.', 'error');
        return;
    }

    // Create form data manually
    const formData = new FormData();
    formData.append('patient_id', patientId);
    formData.append('doctor_id', doctorId);
    formData.append('image', imageFile);
    formData.append('description', description);

    $('#loadingModal').modal('show');
    
    $.ajax({
        url: '<?php echo base_url(); ?>ai_image_analysis/uploadImage',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            $('#loadingModal').modal('hide');
            
            if (response.success) {
                currentAnalysisId = response.analysis_id;
                
                // Display analysis result directly
                displayAnalysisResult(response.analysis_result);
                
                // Scroll to the report section
                $('html, body').animate({
                    scrollTop: $('#analysisResults').offset().top - 100
                }, 800);
                
                // Reload analysis history
                const patientId = $('#patientSelect').val();
                if (patientId) {
                    loadAnalysisHistory(patientId);
                }
            } else {
                showNotification(response.message || 'Analysis failed', 'error');
            }
        },
        error: function() {
            $('#loadingModal').modal('hide');
            showNotification('An error occurred while uploading image', 'error');
        }
    });
}

function clearImage() {
    $('#imageFile').val('');
    $('#imagePreviewSection').hide();
    $('#imageSelector').show();
    updateUploadButtonState();
}

function showNotification(message, type) {
    // You can implement a toast notification here
    alert(message);
}

</script>

<style>
.analysis-result {
    white-space: pre-line;
    line-height: 1.6;
    font-size: 14px;
}

/* Print styles */
@media print {
    .no-print { 
        display: none !important; 
    }
    body { 
        font-size: 12px; 
    }
    .report-header h4 { 
        font-size: 18px; 
    }
    .section-title { 
        font-size: 14px; 
    }
    .row {
        display: flex !important;
        flex-wrap: wrap !important;
    }
    .col-md-6 {
        flex: 0 0 50% !important;
        max-width: 50% !important;
        width: 50% !important;
    }
    .card {
        border: 1px solid #000 !important;
        margin-bottom: 10px !important;
    }
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

.border-dashed {
    border-style: dashed !important;
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

/* DataTables styling */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_processing,
.dataTables_wrapper .dataTables_paginate {
    margin: 0.5rem 0;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.25rem 0.5rem;
    margin: 0 0.125rem;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #007bff;
    color: white;
    border-color: #007bff;
}

</style>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>

