<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('emergency_details'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="emergency"><?php echo lang('emergency'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('view_emergency'); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-2">
        <div class="container-fluid">
            <div class="document-wrapper">
            <!-- Document Header -->
            <div class="document-header mb-2">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="document-title mb-1"><?php echo lang('emergency_report'); ?> #<?php echo $emergency->id; ?></h3>
                        <p class="document-subtitle mb-0"><?php echo $emergency->emergency_type; ?> | <?php echo date('M d, Y H:i', strtotime($emergency->date_time)); ?></p>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="document-actions">
                            <button type="button" class="btn btn-outline-primary btn-sm print-btn" onclick="printDocument()">
                                <i class="fas fa-print mr-1"></i>
                                <?php echo lang('print_report'); ?>
                            </button>
                            <span class="status-badge badge-<?php echo strtolower($emergency->priority); ?>"><?php echo $emergency->priority; ?></span>
                            <span class="status-badge badge-<?php echo strtolower($emergency->status); ?>"><?php echo $emergency->status; ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Content -->
            <div class="document-content">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-8">
                        <!-- Patient Information Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title"><?php echo lang('patient_information'); ?></h5>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('name'); ?>:</span>
                                            <span class="info-value"><?php echo $emergency->patient_name; ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('id'); ?>:</span>
                                            <span class="info-value"><?php echo $emergency->patient_id; ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('age'); ?>:</span>
                                            <span class="info-value"><?php echo !empty($emergency->patient_age) ? $emergency->patient_age . ' ' . lang('years').': ' : 'Not specified'; ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('sex'); ?>:</span>
                                            <span class="info-value"><?php echo !empty($emergency->patient_sex) ? ucfirst($emergency->patient_sex) : lang('not_specified'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('phone'); ?>:</span>
                                            <span class="info-value"><?php echo !empty($emergency->patient_phone) ? $emergency->patient_phone : lang('not_provided'); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('email'); ?>:</span>
                                            <span class="info-value"><?php echo !empty($emergency->patient_email) ? $emergency->patient_email : lang('not_provided'); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('blood_group'); ?>:</span>
                                            <span class="info-value"><?php echo !empty($emergency->patient_bloodgroup) ? $emergency->patient_bloodgroup : lang('not_specified'); ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label"><?php echo lang('address'); ?>:</span>
                                            <span class="info-value"><?php echo !empty($emergency->patient_address) ? $emergency->patient_address : lang('not_provided'); ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Emergency Details Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title"><?php echo lang('emergency_details'); ?></h5>
                            <div class="section-content">
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('chief_complaint'); ?>:</span>
                                    <span class="info-value"><?php echo !empty($emergency->chief_complaint) ? $emergency->chief_complaint : lang('not_specified'); ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('description'); ?>:</span>
                                    <span class="info-value"><?php echo !empty($emergency->description) ? $emergency->description : lang('not_specified'); ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('emergency_time'); ?>:</span>
                                    <span class="info-value"><?php echo !empty($emergency->emergency_time) ? date('M d, Y H:i', strtotime($emergency->emergency_time)) : lang('not_specified'); ?></span>
                                </div>
                                <div class="info-row">
                                            <span class="info-label"><?php echo lang('arrival_time'); ?>:</span>
                                    <span class="info-value"><?php echo !empty($emergency->arrival_time) ? date('M d, Y H:i', strtotime($emergency->arrival_time)) : lang('not_specified'); ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('location'); ?>:</span>
                                    <span class="info-value"><?php echo !empty($emergency->location) ? $emergency->location : lang('not_specified'); ?></span>
                                </div>
                                <?php if (!empty($emergency->symptoms)): ?>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('symptoms'); ?>:</span>
                                    <span class="info-value"><?php echo $emergency->symptoms; ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->allergies)): ?>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('allergies'); ?>:</span>
                                    <span class="info-value"><?php echo $emergency->allergies; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Medical Information Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title"><?php echo lang('medical_information'); ?></h5>
                            <div class="section-content">
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('medical_history'); ?>:</span>
                                    <span class="info-value"><?php echo !empty($emergency->patient_medical_history) ? $emergency->patient_medical_history : (!empty($emergency->medical_history) ? $emergency->medical_history : lang('no_medical_history_recorded')); ?></span>
                                </div>
                                <?php if (!empty($emergency->treatment_given)): ?>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('treatment_given'); ?>:</span>
                                    <span class="info-value"><?php echo $emergency->treatment_given; ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->medications)): ?>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('medications'); ?>:</span>
                                    <span class="info-value"><?php echo $emergency->medications; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Vital Signs Section -->
                        <?php if (!empty($emergency->temperature) || !empty($emergency->blood_pressure) || !empty($emergency->heart_rate) || !empty($emergency->oxygen_saturation)): ?>
                        <div class="document-section mb-2">
                            <h5 class="section-title"><?php echo lang('vital_signs'); ?></h5>
                            <div class="section-content">
                                <div class="row">
                                    <?php if (!empty($emergency->temperature)): ?>
                                    <div class="col-md-3">
                                        <div class="vital-item">
                                            <span class="vital-label"><?php echo lang('temperature'); ?></span>
                                            <span class="vital-value"><?php echo $emergency->temperature; ?>°C</span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($emergency->blood_pressure)): ?>
                                    <div class="col-md-3">
                                        <div class="vital-item">
                                            <span class="vital-label"><?php echo lang('blood_pressure'); ?></span>
                                            <span class="vital-value"><?php echo $emergency->blood_pressure; ?> mmHg</span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($emergency->heart_rate)): ?>
                                    <div class="col-md-3">
                                        <div class="vital-item">
                                            <span class="vital-label"><?php echo lang('heart_rate'); ?></span>
                                            <span class="vital-value"><?php echo $emergency->heart_rate; ?> bpm</span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php if (!empty($emergency->oxygen_saturation)): ?>
                                    <div class="col-md-3">
                                        <div class="vital-item">
                                            <span class="vital-label"><?php echo lang('oxygen_saturation'); ?></span>
                                            <span class="vital-value"><?php echo $emergency->oxygen_saturation; ?>%</span>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Additional Information Section -->
                        <?php if (!empty($emergency->notes) || !empty($emergency->follow_up)): ?>
                        <div class="document-section mb-2">
                            <h5 class="section-title"><?php echo lang('additional_information'); ?></h5>
                            <div class="section-content">
                                <?php if (!empty($emergency->notes)): ?>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('notes'); ?>:</span>
                                    <span class="info-value"><?php echo $emergency->notes; ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->follow_up)): ?>
                                <div class="info-row">
                                    <span class="info-label"><?php echo lang('follow_up_required'); ?>:</span>
                                    <span class="info-value"><?php echo $emergency->follow_up; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Right Column - Quick Info -->
                    <div class="col-lg-4">
                        <div class="document-sidebar">
                            <div class="sidebar-section">
                                <h6 class="sidebar-title"><?php echo lang('emergency_summary'); ?></h6>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('type'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->emergency_type; ?></span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('priority'); ?>:</span>
                                    <span class="summary-value priority-<?php echo strtolower($emergency->priority); ?>"><?php echo $emergency->priority; ?></span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('status'); ?>:</span>
                                    <span class="summary-value status-<?php echo strtolower($emergency->status); ?>"><?php echo $emergency->status; ?></span>
                                </div>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('date_time'); ?>:</span>
                                    <span class="summary-value"><?php echo date('M d, Y H:i', strtotime($emergency->date_time)); ?></span>
                                </div>
                                <?php if (!empty($emergency->doctor_name)): ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('doctor'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->doctor_name; ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->location)): ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('location'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->location; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            
                            <!-- Quick Vital Signs Summary -->
                            <?php if (!empty($emergency->temperature) || !empty($emergency->blood_pressure) || !empty($emergency->heart_rate) || !empty($emergency->oxygen_saturation)): ?>
                            <div class="sidebar-section">
                                    <h6 class="sidebar-title"><?php echo lang('vital_signs_summary'); ?></h6>
                                <?php if (!empty($emergency->temperature)): ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('temperature'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->temperature; ?>°C</span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->blood_pressure)): ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('blood_pressure'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->blood_pressure; ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->heart_rate)): ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('heart_rate'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->heart_rate; ?> bpm</span>
                                </div>
                                <?php endif; ?>
                                <?php if (!empty($emergency->oxygen_saturation)): ?>
                                <div class="summary-item">
                                    <span class="summary-label"><?php echo lang('oxygen_saturation'); ?>:</span>
                                    <span class="summary-value"><?php echo $emergency->oxygen_saturation; ?>%</span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Document-Style Layout */
.document-wrapper {
    margin: 0 2rem;
    padding: 1.5rem;
    background: #fff;
    border: 1px solid #e1e5e9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.document-header {
    border-bottom: 2px solid #000;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}

.document-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #000;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.document-subtitle {
    font-size: 0.9rem;
    color: #666;
    margin: 0;
    font-weight: 500;
}

.document-content {
    background: #fff;
    padding: 0;
}

.document-section {
    border-bottom: 1px solid #ddd;
    padding-bottom: 0.75rem;
    margin-bottom: 0.75rem;
}

.document-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.section-title {
    font-size: 0.9rem;
    font-weight: 700;
    color: #000;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 0.25rem;
}

.section-content {
    padding: 0;
}

.info-row {
    display: flex;
    margin-bottom: 0.25rem;
    padding: 0.125rem 0;
    font-size: 0.85rem;
    line-height: 1.3;
}

.info-row:last-child {
    margin-bottom: 0;
}

.info-label {
    font-weight: 600;
    color: #333;
    min-width: 120px;
    margin-right: 0.5rem;
    flex-shrink: 0;
}

.info-value {
    color: #000;
    flex: 1;
    word-wrap: break-word;
}

.vital-item {
    text-align: center;
    padding: 0.25rem;
    border: 1px solid #ddd;
    border-radius: 3px;
    margin-bottom: 0.25rem;
    background: #f9f9f9;
}

.vital-label {
    display: block;
    font-size: 0.7rem;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    margin-bottom: 0.125rem;
}

.vital-value {
    display: block;
    font-size: 0.85rem;
    font-weight: 700;
    color: #000;
}

.document-sidebar {
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 0.75rem;
}

.sidebar-section {
    margin-bottom: 0;
}

.sidebar-title {
    font-size: 0.8rem;
    font-weight: 700;
    color: #000;
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 0.25rem;
}

.summary-item {
    display: flex;
    margin-bottom: 0.25rem;
    padding: 0.125rem 0;
    font-size: 0.8rem;
    line-height: 1.3;
}

.summary-item:last-child {
    margin-bottom: 0;
}

.summary-label {
    font-weight: 600;
    color: #333;
    min-width: 80px;
    margin-right: 0.5rem;
    flex-shrink: 0;
}

.summary-value {
    color: #000;
    flex: 1;
}

.status-badge {
    display: inline-block;
    padding: 0.2rem 0.4rem;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 2px;
    margin-left: 0.25rem;
    border: 1px solid;
}

.status-badge.badge-critical {
    background: #fff;
    color: #dc2626;
    border-color: #dc2626;
}

.status-badge.badge-high {
    background: #fff;
    color: #ea580c;
    border-color: #ea580c;
}

.status-badge.badge-medium {
    background: #fff;
    color: #d97706;
    border-color: #d97706;
}

.status-badge.badge-low {
    background: #fff;
    color: #16a34a;
    border-color: #16a34a;
}

.status-badge.badge-active {
    background: #fff;
    color: #2563eb;
    border-color: #2563eb;
}

.status-badge.badge-resolved {
    background: #fff;
    color: #16a34a;
    border-color: #16a34a;
}

.status-badge.badge-pending {
    background: #fff;
    color: #6b7280;
    border-color: #6b7280;
}

.priority-critical {
    color: #dc2626;
    font-weight: 700;
}

.priority-high {
    color: #ea580c;
    font-weight: 700;
}

.priority-medium {
    color: #d97706;
    font-weight: 700;
}

.priority-low {
    color: #16a34a;
    font-weight: 700;
}

.status-active {
    color: #2563eb;
    font-weight: 700;
}

.status-resolved {
    color: #16a34a;
    font-weight: 700;
}

.status-pending {
    color: #6b7280;
    font-weight: 700;
}

/* Print Styles */
@media print {
    .document-wrapper {
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        box-shadow: none !important;
        background: #fff !important;
    }
    
    .document-content {
        background: #fff !important;
        color: #000 !important;
    }
    
    .document-section {
        break-inside: avoid;
        page-break-inside: avoid;
    }
    
    .info-row {
        break-inside: avoid;
        page-break-inside: avoid;
    }
    
    .status-badge {
        background: #fff !important;
        color: #000 !important;
        border: 1px solid #000 !important;
    }
}

/* Print Button Styling */
.document-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.print-btn {
    font-size: 0.8rem;
    padding: 0.375rem 0.75rem;
    border-radius: 3px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.2s ease;
}

.print-btn:hover {
    background-color: #007bff;
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0, 123, 255, 0.3);
}

.print-btn:active {
    transform: translateY(0);
    box-shadow: 0 1px 2px rgba(0, 123, 255, 0.3);
}

/* Hide print button when printing */
@media print {
    .print-btn {
        display: none !important;
    }
    
    .document-actions {
        display: none !important;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .document-wrapper {
        margin: 0 1rem;
        padding: 1rem;
    }
    
    .document-title {
        font-size: 1.25rem;
    }
    
    .info-label {
        min-width: 100px;
    }
    
    .summary-label {
        min-width: 70px;
    }
    
    .vital-item {
        margin-bottom: 0.5rem;
    }
    
    .document-actions {
        flex-direction: column;
        align-items: flex-end;
        gap: 0.25rem;
    }
    
    .print-btn {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
}

@media (max-width: 576px) {
    .document-wrapper {
        margin: 0 0.5rem;
        padding: 0.75rem;
    }
}
</style>

<script>
function printDocument() {
    // Hide the print button and other non-printable elements
    const printBtn = document.querySelector('.print-btn');
    const documentActions = document.querySelector('.document-actions');
    
    if (printBtn) printBtn.style.display = 'none';
    if (documentActions) documentActions.style.display = 'none';
    
    // Print the document
    window.print();
    
    // Restore the print button after printing
    setTimeout(() => {
        if (printBtn) printBtn.style.display = 'inline-block';
        if (documentActions) documentActions.style.display = 'flex';
    }, 1000);
}

// Add keyboard shortcut for printing (Ctrl+P)
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        printDocument();
    }
});
</script>