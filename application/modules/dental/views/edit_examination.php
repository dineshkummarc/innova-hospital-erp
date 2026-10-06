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
                        <?php echo lang('edit_dental_examination'); ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right bg-transparent">
                            <li class="breadcrumb-item"><a href="home" class="text-primary"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="dental" class="text-primary"><?php echo lang('dental_examinations'); ?></a></li>
                            <li class="breadcrumb-item active font-weight-bold"><?php echo lang('edit_examination'); ?></li>
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
                            </div>
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('patient'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg select2" name="patient_id" required>
                                                <option value=""><?php echo lang('select_patient'); ?></option>
                                                <?php foreach ($patients as $patient): ?>
                                                    <option value="<?php echo $patient->id; ?>" <?php echo $examination->patient_id == $patient->id ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($patient->name . ' - ' . $patient->phone); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control form-control-lg select2" name="doctor_id" required>
                                                <option value="">Select Doctor</option>
                                                <?php foreach ($doctors as $doctor): ?>
                                                    <option value="<?php echo $doctor->id; ?>" <?php echo $examination->doctor_id == $doctor->id ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($doctor->name . ' - ' . $doctor->email); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('examination_date'); ?> <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control form-control-lg" name="examination_date" 
                                                   value="<?php echo date('Y-m-d\TH:i', strtotime($examination->examination_date)); ?>" required>
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
                                    <textarea class="form-control" name="chief_complaint" rows="3" 
                                              placeholder="Patient's main complaint or reason for visit..."><?php echo htmlspecialchars($examination->chief_complaint ?: ''); ?></textarea>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold"><?php echo lang('medical_history'); ?></label>
                                    <textarea class="form-control" name="medical_history" rows="3" 
                                              placeholder="Relevant medical history, medications, allergies..."><?php echo htmlspecialchars($examination->medical_history ?: ''); ?></textarea>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold"><?php echo lang('dental_history'); ?></label>
                                    <textarea class="form-control" name="dental_history" rows="3" 
                                              placeholder="Previous dental treatments, oral hygiene habits..."><?php echo htmlspecialchars($examination->dental_history ?: ''); ?></textarea>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold"><?php echo lang('extraoral_examination'); ?></label>
                                    <textarea class="form-control" name="extraoral_examination" rows="2" 
                                              placeholder="Facial symmetry, lymph nodes, TMJ..."><?php echo htmlspecialchars($examination->extraoral_examination ?: ''); ?></textarea>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold"><?php echo lang('intraoral_examination'); ?></label>
                                    <textarea class="form-control" name="intraoral_examination" rows="2" 
                                              placeholder="Soft tissues, gingiva, tongue, palate..."><?php echo htmlspecialchars($examination->intraoral_examination ?: ''); ?></textarea>
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
                                    <button type="button" class="btn btn-sm btn-info mr-2" id="toggleMultiSelect" title="Toggle multi-select mode (Ctrl+Click)">
                                        <i class="fas fa-mouse-pointer mr-1"></i><?php echo lang('multi_select'); ?>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-light" id="resetOdontogram">
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
                                            <textarea class="form-control" name="diagnosis" rows="4" 
                                                      placeholder="Primary and secondary diagnosis..."><?php echo htmlspecialchars($examination->diagnosis ?: ''); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('treatment_plan'); ?></label>
                                            <textarea class="form-control" name="treatment_plan" rows="4" 
                                                      placeholder="Recommended treatments and procedures..."><?php echo htmlspecialchars($examination->treatment_plan ?: ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('additional_notes'); ?></label>
                                            <textarea class="form-control" name="notes" rows="3" 
                                                      placeholder="Any additional observations or notes..."><?php echo htmlspecialchars($examination->notes ?: ''); ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('next_appointment'); ?></label>
                                            <input type="datetime-local" class="form-control" name="next_appointment" 
                                                   value="<?php echo $examination->next_appointment ? date('Y-m-d\TH:i', strtotime($examination->next_appointment)) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="font-weight-bold"><?php echo lang('status'); ?></label>
                                            <select class="form-control" name="status">
                                                <option value="draft" <?php echo $examination->status === 'draft' ? 'selected' : ''; ?>><?php echo lang('draft'); ?></option>
                                                <option value="completed" <?php echo $examination->status === 'completed' ? 'selected' : ''; ?>><?php echo lang('completed'); ?></option>
                                                <option value="follow_up_required" <?php echo $examination->status === 'follow_up_required' ? 'selected' : ''; ?>><?php echo lang('follow_up_required'); ?></option>
                                            </select>
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
                                    <i class="fas fa-tools mr-2"></i><?php echo lang('treatment_planning'); ?>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-light" id="addTreatment">
                                        <i class="fas fa-plus mr-1"></i><?php echo lang('add_treatment'); ?>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div id="treatmentsContainer">
                                    <!-- Treatments will be added here dynamically -->
                                    <?php if (!empty($treatments)): ?>
                                        <?php $treatmentCounter = 0; ?>
                                        <?php foreach ($treatments as $treatment): ?>
                                            <?php $treatmentCounter++; ?>
                                            <div class="treatment-row border rounded p-3 mb-3 bg-light" id="treatment-<?php echo $treatmentCounter; ?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Tooth Number</label>
                                                            <select class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][tooth_number]">
                                                                <option value="">General Treatment</option>
                                                                <?php
                                                                $toothNumbers = [
                                                                    ['18', '17', '16', '15', '14', '13', '12', '11'],
                                                                    ['21', '22', '23', '24', '25', '26', '27', '28'],
                                                                    ['31', '32', '33', '34', '35', '36', '37', '38'],
                                                                    ['48', '47', '46', '45', '44', '43', '42', '41']
                                                                ];
                                                                foreach ($toothNumbers as $quadrant) {
                                                                    foreach ($quadrant as $tooth) {
                                                                        $selected = ($treatment->tooth_number == $tooth) ? 'selected' : '';
                                                                        echo '<option value="'.$tooth.'" '.$selected.'>'.$tooth.'</option>';
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Treatment Type <span class="text-danger">*</span></label>
                                                            <select class="form-control treatment-type-select" name="treatments[<?php echo $treatmentCounter; ?>][treatment_type]" required>
                                                                <option value="">Select Treatment</option>
                                                                <?php
                                                                $commonTreatments = [
                                                                    'Amalgam Filling', 'Composite Filling', 'Porcelain Crown', 'Root Canal Therapy',
                                                                    'Simple Extraction', 'Surgical Extraction', 'Dental Implant', 'Professional Cleaning',
                                                                    'Scaling and Root Planing', 'Fluoride Treatment', 'Dental Bridge', 'Partial Denture',
                                                                    'Complete Denture', 'Orthodontic Treatment', 'Teeth Whitening', 'Oral Surgery',
                                                                    'Periodontal Surgery', 'Endodontic Treatment', 'Prosthodontic Treatment', 'Preventive Treatment'
                                                                ];
                                                                foreach ($commonTreatments as $treatmentType) {
                                                                    $selected = ($treatment->treatment_type == $treatmentType) ? 'selected' : '';
                                                                    echo '<option value="'.$treatmentType.'" '.$selected.'>'.$treatmentType.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Status</label>
                                                            <select class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][status]">
                                                                <option value="planned" <?php echo $treatment->status == 'planned' ? 'selected' : ''; ?>>Planned</option>
                                                                <option value="in_progress" <?php echo $treatment->status == 'in_progress' ? 'selected' : ''; ?>>In Progress</option>
                                                                <option value="completed" <?php echo $treatment->status == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                                                <option value="cancelled" <?php echo $treatment->status == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">&nbsp;</label>
                                                            <button type="button" class="btn btn-danger btn-block" onclick="removeTreatmentRow(<?php echo $treatmentCounter; ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Description</label>
                                                            <textarea class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][treatment_description]" rows="2" 
                                                                      placeholder="Treatment description..."><?php echo htmlspecialchars($treatment->treatment_description ?: ''); ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Date</label>
                                                            <input type="date" class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][treatment_date]" 
                                                                   value="<?php echo $treatment->treatment_date ? date('Y-m-d', strtotime($treatment->treatment_date)) : date('Y-m-d'); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Duration (min)</label>
                                                            <input type="number" class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][duration_minutes]" 
                                                                   placeholder="30" value="<?php echo $treatment->duration_minutes ?: ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Cost</label>
                                                            <input type="number" class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][cost]" 
                                                                   step="0.01" placeholder="0.00" value="<?php echo $treatment->cost ?: ''; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Notes</label>
                                                            <textarea class="form-control" name="treatments[<?php echo $treatmentCounter; ?>][notes]" rows="2" 
                                                                      placeholder="Additional notes..."><?php echo htmlspecialchars($treatment->notes ?: ''); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Prescription Section -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-gradient-dark py-3">
                                <h3 class="card-title text-white mb-0">
                                    <i class="fas fa-pills mr-2"></i><?php echo lang('prescription'); ?>
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-sm btn-light" id="addPrescription">
                                        <i class="fas fa-plus mr-1"></i><?php echo lang('add_prescription'); ?>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <div id="prescriptionsContainer">
                                    <!-- Prescriptions will be added here dynamically -->
                                    <?php if (!empty($prescriptions)): ?>
                                        <?php $prescriptionCounter = 0; ?>
                                        <?php foreach ($prescriptions as $prescription): ?>
                                            <?php $prescriptionCounter++; ?>
                                            <div class="prescription-row border rounded p-3 mb-3 bg-light" id="prescription-<?php echo $prescriptionCounter; ?>">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Medication <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" name="prescriptions[<?php echo $prescriptionCounter; ?>][medication_name]" 
                                                                   placeholder="Medication name..." value="<?php echo htmlspecialchars($prescription->medication_name ?: ''); ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Dosage</label>
                                                            <input type="text" class="form-control" name="prescriptions[<?php echo $prescriptionCounter; ?>][dosage]" 
                                                                   placeholder="500mg" value="<?php echo htmlspecialchars($prescription->dosage ?: ''); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Frequency</label>
                                                            <select class="form-control" name="prescriptions[<?php echo $prescriptionCounter; ?>][frequency]">
                                                                <option value="">Select</option>
                                                                <option value="Once daily" <?php echo $prescription->frequency == 'Once daily' ? 'selected' : ''; ?>>Once daily</option>
                                                                <option value="Twice daily" <?php echo $prescription->frequency == 'Twice daily' ? 'selected' : ''; ?>>Twice daily</option>
                                                                <option value="Three times daily" <?php echo $prescription->frequency == 'Three times daily' ? 'selected' : ''; ?>>Three times daily</option>
                                                                <option value="Four times daily" <?php echo $prescription->frequency == 'Four times daily' ? 'selected' : ''; ?>>Four times daily</option>
                                                                <option value="As needed" <?php echo $prescription->frequency == 'As needed' ? 'selected' : ''; ?>>As needed</option>
                                                                <option value="Before meals" <?php echo $prescription->frequency == 'Before meals' ? 'selected' : ''; ?>>Before meals</option>
                                                                <option value="After meals" <?php echo $prescription->frequency == 'After meals' ? 'selected' : ''; ?>>After meals</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Duration</label>
                                                            <input type="text" class="form-control" name="prescriptions[<?php echo $prescriptionCounter; ?>][duration]" 
                                                                   placeholder="7 days" value="<?php echo htmlspecialchars($prescription->duration ?: ''); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Qty</label>
                                                            <input type="number" class="form-control" name="prescriptions[<?php echo $prescriptionCounter; ?>][quantity]" 
                                                                   placeholder="30" value="<?php echo $prescription->quantity ?: ''; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">&nbsp;</label>
                                                            <button type="button" class="btn btn-danger btn-block" onclick="removePrescriptionRow(<?php echo $prescriptionCounter; ?>)">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="font-weight-bold">Instructions</label>
                                                            <textarea class="form-control" name="prescriptions[<?php echo $prescriptionCounter; ?>][instructions]" rows="2" 
                                                                      placeholder="Special instructions for the patient..."><?php echo htmlspecialchars($prescription->instructions ?: ''); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="col-md-12">
                        <div class="card shadow-lg border-0">
                            <div class="card-body p-4 text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5 mr-3">
                                    <i class="fas fa-save mr-2"></i><?php echo lang('update_examination'); ?>
                                </button>
                                <a href="<?php echo base_url(); ?>dental/view_examination/<?php echo $examination->id; ?>" class="btn btn-info btn-lg px-5 mr-3">
                                    <i class="fas fa-eye mr-2"></i><?php echo lang('view_examination'); ?>
                                </a>
                                <a href="<?php echo base_url(); ?>dental" class="btn btn-secondary btn-lg px-5">
                                    <i class="fas fa-times mr-2"></i><?php echo lang('cancel'); ?>
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
                <h5 class="modal-title" id="toothModalLabel"><?php echo lang('edit_tooth'); ?>: <span id="selectedToothNumber"></span></h5>
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
                                <select class="form-control" id="toothType" name="tooth_type">
                                    <option value="permanent"><?php echo lang('permanent'); ?></option>
                                    <option value="deciduous"><?php echo lang('deciduous'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold"><?php echo lang('condition'); ?></label>
                                <select class="form-control" id="toothCondition" name="condition" required>
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
                                       placeholder="e.g., Mesial, Distal, Occlusal">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="font-weight-bold"><?php echo lang('severity'); ?></label>
                                <select class="form-control" id="toothSeverity" name="severity">
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
                                  placeholder="Additional notes about this tooth..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                <button type="button" class="btn btn-primary" id="saveToothData"><?php echo lang('save_changes'); ?></button>
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