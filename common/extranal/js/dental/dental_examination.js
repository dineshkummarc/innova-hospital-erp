/**
 * Dental Examination Form JavaScript
 * Handles dynamic treatment and prescription sections
 */

let treatmentCounter = 0;
let prescriptionCounter = 0;

function initializeTreatmentSection() {
    const addTreatmentBtn = document.getElementById('addTreatment');
    if (addTreatmentBtn) {
        addTreatmentBtn.addEventListener('click', addTreatmentRow);
    }
}

function initializePrescriptionSection() {
    const addPrescriptionBtn = document.getElementById('addPrescription');
    if (addPrescriptionBtn) {
        addPrescriptionBtn.addEventListener('click', addPrescriptionRow);
    }
}

function addTreatmentRow() {
    treatmentCounter++;
    const container = document.getElementById('treatmentsContainer');
    
    const treatmentRow = document.createElement('div');
    treatmentRow.className = 'treatment-row border rounded p-3 mb-3 bg-light';
    treatmentRow.id = `treatment-${treatmentCounter}`;
    
    treatmentRow.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Tooth Number</label>
                    <select class="form-control" name="treatments[${treatmentCounter}][tooth_number]">
                        <option value="">General Treatment</option>
                        ${generateToothOptions()}
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Treatment Type <span class="text-danger">*</span></label>
                    <select class="form-control treatment-type-select" name="treatments[${treatmentCounter}][treatment_type]" required>
                        <option value="">Select Treatment</option>
                        ${generateTreatmentOptions()}
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label class="font-weight-bold">Status</label>
                    <select class="form-control" name="treatments[${treatmentCounter}][status]">
                        <option value="planned">Planned</option>
                        <option value="in_progress">In Progress</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="font-weight-bold">&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-block" onclick="removeTreatmentRow(${treatmentCounter})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="font-weight-bold">Description</label>
                    <textarea class="form-control" name="treatments[${treatmentCounter}][treatment_description]" rows="2" 
                              placeholder="Treatment description..."></textarea>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="font-weight-bold">Date</label>
                    <input type="date" class="form-control" name="treatments[${treatmentCounter}][treatment_date]" 
                           value="${new Date().toISOString().split('T')[0]}">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="font-weight-bold">Duration (min)</label>
                    <input type="number" class="form-control" name="treatments[${treatmentCounter}][duration_minutes]" 
                           placeholder="30">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="font-weight-bold">Cost</label>
                    <input type="number" class="form-control" name="treatments[${treatmentCounter}][cost]" 
                           step="0.01" placeholder="0.00">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold">Notes</label>
                    <textarea class="form-control" name="treatments[${treatmentCounter}][notes]" rows="2" 
                              placeholder="Additional notes..."></textarea>
                </div>
            </div>
        </div>
    `;
    
    container.appendChild(treatmentRow);
    
    // Initialize treatment type change handler
    const treatmentTypeSelect = treatmentRow.querySelector('.treatment-type-select');
    treatmentTypeSelect.addEventListener('change', function() {
        populateTreatmentTemplate(this, treatmentCounter);
    });
    
    // Add animation
    treatmentRow.style.opacity = '0';
    treatmentRow.style.transform = 'translateY(-20px)';
    setTimeout(() => {
        treatmentRow.style.transition = 'all 0.3s ease';
        treatmentRow.style.opacity = '1';
        treatmentRow.style.transform = 'translateY(0)';
    }, 10);
}

function removeTreatmentRow(id) {
    const row = document.getElementById(`treatment-${id}`);
    if (row) {
        row.style.transition = 'all 0.3s ease';
        row.style.opacity = '0';
        row.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            row.remove();
        }, 300);
    }
}

function addPrescriptionRow() {
    prescriptionCounter++;
    const container = document.getElementById('prescriptionsContainer');
    
    const prescriptionRow = document.createElement('div');
    prescriptionRow.className = 'prescription-row border rounded p-3 mb-3 bg-light';
    prescriptionRow.id = `prescription-${prescriptionCounter}`;
    
    prescriptionRow.innerHTML = `
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Medication <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="prescriptions[${prescriptionCounter}][medication_name]" 
                           placeholder="Medication name..." required>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="font-weight-bold">Dosage</label>
                    <input type="text" class="form-control" name="prescriptions[${prescriptionCounter}][dosage]" 
                           placeholder="500mg">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="font-weight-bold">Frequency</label>
                    <select class="form-control" name="prescriptions[${prescriptionCounter}][frequency]">
                        <option value="">Select</option>
                        <option value="Once daily">Once daily</option>
                        <option value="Twice daily">Twice daily</option>
                        <option value="Three times daily">Three times daily</option>
                        <option value="Four times daily">Four times daily</option>
                        <option value="As needed">As needed</option>
                        <option value="Before meals">Before meals</option>
                        <option value="After meals">After meals</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="font-weight-bold">Duration</label>
                    <input type="text" class="form-control" name="prescriptions[${prescriptionCounter}][duration]" 
                           placeholder="7 days">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="font-weight-bold">Qty</label>
                    <input type="number" class="form-control" name="prescriptions[${prescriptionCounter}][quantity]" 
                           placeholder="30">
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <label class="font-weight-bold">&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-block" onclick="removePrescriptionRow(${prescriptionCounter})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-weight-bold">Instructions</label>
                    <textarea class="form-control" name="prescriptions[${prescriptionCounter}][instructions]" rows="2" 
                              placeholder="Special instructions for the patient..."></textarea>
                </div>
            </div>
        </div>
    `;
    
    container.appendChild(prescriptionRow);
    
    // Add animation
    prescriptionRow.style.opacity = '0';
    prescriptionRow.style.transform = 'translateY(-20px)';
    setTimeout(() => {
        prescriptionRow.style.transition = 'all 0.3s ease';
        prescriptionRow.style.opacity = '1';
        prescriptionRow.style.transform = 'translateY(0)';
    }, 10);
}

function removePrescriptionRow(id) {
    const row = document.getElementById(`prescription-${id}`);
    if (row) {
        row.style.transition = 'all 0.3s ease';
        row.style.opacity = '0';
        row.style.transform = 'translateY(-20px)';
        setTimeout(() => {
            row.remove();
        }, 300);
    }
}

function generateToothOptions() {
    const allTeeth = [
        ...toothNumbers.upperRight,
        ...toothNumbers.upperLeft,
        ...toothNumbers.lowerLeft,
        ...toothNumbers.lowerRight
    ];
    
    return allTeeth.map(tooth => `<option value="${tooth}">${tooth}</option>`).join('');
}

function generateTreatmentOptions() {
    const commonTreatments = [
        'Amalgam Filling',
        'Composite Filling',
        'Porcelain Crown',
        'Root Canal Therapy',
        'Simple Extraction',
        'Surgical Extraction',
        'Dental Implant',
        'Professional Cleaning',
        'Scaling and Root Planing',
        'Fluoride Treatment',
        'Dental Bridge',
        'Partial Denture',
        'Complete Denture',
        'Orthodontic Treatment',
        'Teeth Whitening',
        'Oral Surgery',
        'Periodontal Surgery',
        'Endodontic Treatment',
        'Prosthodontic Treatment',
        'Preventive Treatment'
    ];
    
    return commonTreatments.map(treatment => 
        `<option value="${treatment}">${treatment}</option>`
    ).join('');
}

function populateTreatmentTemplate(selectElement, counter) {
    const treatmentType = selectElement.value;
    
    // Treatment templates with estimated costs and durations
    const templates = {
        'Amalgam Filling': { cost: 150, duration: 45, description: 'Silver amalgam filling for posterior teeth' },
        'Composite Filling': { cost: 200, duration: 60, description: 'Tooth-colored composite filling' },
        'Porcelain Crown': { cost: 800, duration: 120, description: 'Full coverage porcelain crown' },
        'Root Canal Therapy': { cost: 600, duration: 90, description: 'Root canal treatment for infected tooth' },
        'Simple Extraction': { cost: 100, duration: 30, description: 'Simple tooth extraction' },
        'Surgical Extraction': { cost: 250, duration: 60, description: 'Surgical tooth extraction' },
        'Dental Implant': { cost: 1200, duration: 90, description: 'Single dental implant placement' },
        'Professional Cleaning': { cost: 80, duration: 45, description: 'Scaling and polishing' }
    };
    
    const template = templates[treatmentType];
    if (template) {
        const row = selectElement.closest('.treatment-row');
        if (row) {
            const costInput = row.querySelector('input[name*="[cost]"]');
            const durationInput = row.querySelector('input[name*="[duration_minutes]"]');
            const descriptionTextarea = row.querySelector('textarea[name*="[treatment_description]"]');
            
            if (costInput) costInput.value = template.cost;
            if (durationInput) durationInput.value = template.duration;
            if (descriptionTextarea) descriptionTextarea.value = template.description;
        }
    }
}

// Form validation and submission helpers
function validateForm() {
    const requiredFields = document.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    return isValid;
}

function collectFormData() {
    const formData = new FormData(document.getElementById('dentalExaminationForm'));
    
    // Add odontogram data
    const odontogramData = getOdontogramData();
    formData.append('odontogram', JSON.stringify(odontogramData));
    
    return formData;
}

// Auto-save functionality (optional)
let autoSaveInterval;

function startAutoSave() {
    autoSaveInterval = setInterval(() => {
        saveAsDraft(true); // Silent save
    }, 300000); // Save every 5 minutes
}

function stopAutoSave() {
    if (autoSaveInterval) {
        clearInterval(autoSaveInterval);
    }
}

function saveAsDraft(silent = false) {
    const formData = collectFormData();
    formData.append('status', 'draft');
    formData.append('auto_save', '1');
    
    // Send AJAX request to save draft
    fetch('dental/save_examination', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (!silent) {
            if (data.success) {
                showToast('Draft saved successfully', 'success');
            } else {
                showToast('Failed to save draft', 'error');
            }
        }
    })
    .catch(error => {
        if (!silent) {
            showToast('Error saving draft', 'error');
        }
    });
}

// Export functions for global use
window.initializeTreatmentSection = initializeTreatmentSection;
window.initializePrescriptionSection = initializePrescriptionSection;
window.addTreatmentRow = addTreatmentRow;
window.removeTreatmentRow = removeTreatmentRow;
window.addPrescriptionRow = addPrescriptionRow;
window.removePrescriptionRow = removePrescriptionRow;
