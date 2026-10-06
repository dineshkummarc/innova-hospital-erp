<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exclamation-triangle text-danger mr-3"></i>
                        <?php echo lang('add_new'); ?> <?php echo lang('emergency'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="emergency"> <?php echo lang('emergency'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('add_new'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="content py-5">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <form role="form" action="emergency/addNew" method="post" enctype="multipart/form-data">
                        
                        <!-- Basic Information Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <?php echo lang('basic_information'); ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <!-- Patient Selection Section -->
                                <div class="form-group">
                                    <label class="control-label font-weight-bold"><?php echo lang('patient_selection'); ?> <span class="text-danger">*</span></label>
                                    
                                    <!-- No Patient Selected - Quick Selection -->
                                    <div id="no-patient-selected" class="text-center mb-3 p-3 border border-warning rounded" style="background-color: #fff3cd;">
                                        <div class="alert alert-warning mb-3" role="alert">
                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                            <strong><?php echo lang('patient_selection_required'); ?></strong>
                                            <br>
                                            <small><?php echo lang('you_must_select_or_create_a_patient_before_submitting'); ?></small>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary btn-block mb-2" id="select-existing-patient">
                                                    <i class="fas fa-search mr-2"></i>
                                                    <?php echo lang('select_existing_patient'); ?>
                                                </button>
                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-success btn-block mb-2" id="create-new-patient">
                                                    <i class="fas fa-plus mr-2"></i>
                                                    <?php echo lang('create_new_patient'); ?>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="text-muted"><?php echo lang('choose_how_to_proceed_with_patient_selection'); ?></small>
                                    </div>
                                    
                                    <!-- Selected Patient - Compact Display -->
                                    <div id="selected-patient-info" class="row" style="display: none;">
                                        <div class="col-md-12">
                                            <div class="selected-patient-display">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-user-check mr-2 text-success"></i>
                                                        <div>
                                                            <strong id="selected-patient-name">-</strong>
                                                            <small class="d-block text-muted">
                                                                <?php echo lang('id'); ?>: <span id="selected-patient-id">-</span> | 
                                                                <?php echo lang('age'); ?>: <span id="selected-patient-age">-</span> | 
                                                                <?php echo lang('phone'); ?>: <span id="selected-patient-phone">-</span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button type="button" class="btn btn-sm btn-outline-success mr-1" id="view-ai-analysis">
                                                            <i class="fas fa-robot mr-1"></i>
                                                            <?php echo lang('ai_patient_history'); ?>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-outline-secondary" id="change-patient">
                                                            <i class="fas fa-edit mr-1"></i>
                                                            <?php echo lang('change'); ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Hidden input for patient ID -->
                                    <input type="hidden" name="patient_id" id="patient_id" value="">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="doctor_id" class="control-label font-weight-bold"><?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                                <option value=""><?php echo lang('select_doctor'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Patient Information Display -->
                                <div id="patient-info" class="row" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="alert alert-info">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong><?php echo lang('name'); ?>:</strong> <span id="patient-name">-</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong><?php echo lang('age'); ?>:</strong> <span id="patient-age">-</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong><?php echo lang('gender'); ?>:</strong> <span id="patient-gender">-</span>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong><?php echo lang('phone'); ?>:</strong> <span id="patient-phone">-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emergency_type" class="control-label font-weight-bold"><?php echo lang('emergency_type'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="emergency_type" id="emergency_type" required>
                                                <option value=""><?php echo lang('select_type'); ?></option>
                                                <?php
                                                $emergency_types = array(
                                                    'Cardiac' => lang('cardiac'),
                                                    'Trauma' => lang('trauma'),
                                                    'Respiratory' => lang('respiratory'),
                                                    'Neurological' => lang('neurological'),
                                                    'Pediatric' => lang('pediatric'),
                                                    'Obstetric' => lang('obstetric'),
                                                    'Psychiatric' => lang('psychiatric'),
                                                    'Toxicological' => lang('toxicological'),
                                                    'Other' => lang('other')
                                                );
                                                foreach ($emergency_types as $key => $label) {
                                                    $selected = (!empty($setval) && $emergency_type == $key) ? 'selected' : '';
                                                    echo "<option value=\"$key\" $selected>$label</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="priority" class="control-label font-weight-bold"><?php echo lang('priority_level'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="priority" id="priority" required>
                                                <option value=""><?php echo lang('select_priority'); ?></option>
                                                <?php
                                                $priority_levels = array(
                                                    'Critical' => lang('critical_immediate'),
                                                    'High' => lang('high_within_1_hour'),
                                                    'Medium' => lang('medium_within_4_hours'),
                                                    'Low' => lang('low_within_24_hours')
                                                );
                                                foreach ($priority_levels as $key => $label) {
                                                    $selected = (!empty($setval) && $priority == $key) ? 'selected' : '';
                                                    echo "<option value=\"$key\" $selected>$label</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="status" class="control-label font-weight-bold"><?php echo lang('status'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control" name="status" id="status" required>
                                                <option value=""><?php echo lang('select_status'); ?></option>
                                                <?php
                                                $status_options = array(
                                                    'Active' => lang('active'),
                                                    'In Progress' => lang('in_progress'),
                                                    'Stable' => lang('stable'),
                                                    'Critical' => lang('critical'),
                                                    'Resolved' => lang('resolved')
                                                );
                                                foreach ($status_options as $key => $label) {
                                                    $selected = (!empty($setval) && $status == $key) ? 'selected' : '';
                                                    echo "<option value=\"$key\" $selected>$label</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Emergency Details Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="mb-0">
                                    <i class="fas fa-clock mr-2"></i>
                                    <?php echo lang('emergency_details'); ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="emergency_time" class="control-label font-weight-bold"><?php echo lang('emergency_time'); ?> <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="emergency_time" id="emergency_time" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="arrival_time" class="control-label font-weight-bold"><?php echo lang('arrival_time'); ?></label>
                                            <input type="datetime-local" class="form-control" name="arrival_time" id="arrival_time">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location" class="control-label font-weight-bold"><?php echo lang('location'); ?></label>
                                            <input type="text" class="form-control" name="location" id="location" placeholder="<?php echo lang('eg_emergency_room_icu'); ?>" value="<?php if (!empty($setval)) echo $location; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chief_complaint" class="control-label font-weight-bold"><?php echo lang('chief_complaint'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="chief_complaint" id="chief_complaint" rows="2" placeholder="<?php echo lang('primary_reason_for_emergency_visit'); ?>" required><?php if (!empty($setval)) echo $chief_complaint; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label font-weight-bold"><?php echo lang('emergency_description'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="<?php echo lang('detailed_description_of_emergency'); ?>" required><?php if (!empty($setval)) echo $description; ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Vital Signs Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-heartbeat mr-2"></i>
                                    <?php echo lang('vital_signs'); ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="blood_pressure" class="control-label font-weight-bold"><?php echo lang('blood_pressure'); ?></label>
                                            <input type="text" class="form-control" name="blood_pressure" id="blood_pressure" placeholder="<?php echo lang('eg_120_80'); ?>" value="<?php if (!empty($setval)) echo $blood_pressure; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="heart_rate" class="control-label font-weight-bold"><?php echo lang('heart_rate_bpm'); ?></label>
                                            <input type="number" class="form-control" name="heart_rate" id="heart_rate" placeholder="<?php echo lang('eg_72'); ?>" value="<?php if (!empty($setval)) echo $heart_rate; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="temperature" class="control-label font-weight-bold"><?php echo lang('temperature_c'); ?></label>
                                            <input type="number" step="0.1" class="form-control" name="temperature" id="temperature" placeholder="<?php echo lang('eg_36_5'); ?>" value="<?php if (!empty($setval)) echo $temperature; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="oxygen_saturation" class="control-label font-weight-bold"><?php echo lang('oxygen_saturation_percent'); ?></label>
                                            <input type="number" class="form-control" name="oxygen_saturation" id="oxygen_saturation" placeholder="<?php echo lang('eg_98'); ?>" value="<?php if (!empty($setval)) echo $oxygen_saturation; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-info text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-stethoscope mr-2"></i>
                                    <?php echo lang('medical_information'); ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="symptoms" class="control-label font-weight-bold"><?php echo lang('presenting_symptoms'); ?></label>
                                            <textarea class="form-control" name="symptoms" id="symptoms" rows="3" placeholder="<?php echo lang('list_all_current_symptoms'); ?>"><?php if (!empty($setval)) echo $symptoms; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medical_history" class="control-label font-weight-bold"><?php echo lang('medical_history'); ?></label>
                                            <textarea class="form-control" name="medical_history" id="medical_history" rows="3" placeholder="<?php echo lang('previous_conditions_surgeries_medications'); ?>"><?php if (!empty($setval)) echo $medical_history; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="allergies" class="control-label font-weight-bold"><?php echo lang('known_allergies'); ?></label>
                                            <textarea class="form-control" name="allergies" id="allergies" rows="2" placeholder="<?php echo lang('drug_food_environmental_allergies'); ?>"><?php if (!empty($setval)) echo $allergies; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="follow_up" class="control-label font-weight-bold"><?php echo lang('follow_up_required'); ?></label>
                                            <select class="form-control" name="follow_up" id="follow_up">
                                                <option value=""><?php echo lang('select_follow_up'); ?></option>
                                                <?php
                                                $follow_ups = array(
                                                    'None' => lang('none'),
                                                    '24 hours' => lang('24_hours'),
                                                    '48 hours' => lang('48_hours'),
                                                    '1 week' => lang('1_week'),
                                                    '2 weeks' => lang('2_weeks'),
                                                    '1 month' => lang('1_month')
                                                );
                                                foreach ($follow_ups as $key => $label) {
                                                    $selected = (!empty($setval) && $follow_up == $key) ? 'selected' : '';
                                                    echo "<option value=\"$key\" $selected>$label</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>

                        <!-- Treatment Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-pills mr-2"></i>
                                    <?php echo lang('treatment_and_medications'); ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="treatment_given" class="control-label font-weight-bold"><?php echo lang('treatment_given'); ?></label>
                                            <textarea class="form-control" name="treatment_given" id="treatment_given" rows="3" placeholder="<?php echo lang('emergency_treatments_procedures_performed'); ?>"><?php if (!empty($setval)) echo $treatment_given; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medications" class="control-label font-weight-bold"><?php echo lang('medications_administered'); ?></label>
                                            <textarea class="form-control" name="medications" id="medications" rows="3" placeholder="<?php echo lang('drugs_given_dosages_routes'); ?>"><?php if (!empty($setval)) echo $medications; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="control-label font-weight-bold"><?php echo lang('additional_notes'); ?></label>
                                    <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="<?php echo lang('any_additional_information'); ?>"><?php if (!empty($setval)) echo $notes; ?></textarea>
                                </div>
                            </div>
                                </div>

                        <!-- Action Buttons -->
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <button type="submit" class="btn btn-danger btn-lg px-5 mr-3">
                                        <i class="fa fa-save mr-2"></i>
                                        <?php echo lang('save'); ?>
                                    </button>
                                <a href="emergency" class="btn btn-secondary btn-lg px-5">
                                        <i class="fa fa-times mr-2"></i>
                                        <?php echo lang('cancel'); ?>
                                    </a>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Patient Selection Modal -->
<div class="modal fade" id="patientSelectionModal" tabindex="-1" role="dialog" aria-labelledby="patientSelectionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="patientSelectionModalLabel">
                    <i class="fas fa-search mr-2"></i>
                    <?php echo lang('select_patient'); ?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="patient-search" class="control-label font-weight-bold"><?php echo lang('search_patient'); ?></label>
                    <select class="form-control select2" id="patient-search" style="width: 100%;">
                        <option value=""><?php echo lang('search_by_patient_id_name_phone_age'); ?></option>
                    </select>
                </div>
                <div id="patient-search-results"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- New Patient Modal -->
<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="newPatientModalLabel">
                    <i class="fas fa-user-plus mr-2"></i>
                    <?php echo lang('create_new_patient'); ?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="new-patient-form">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_patient_name" class="control-label font-weight-bold"><?php echo lang('full_name'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="new_patient_name" name="name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="new_patient_phone" class="control-label font-weight-bold"><?php echo lang('phone_number'); ?> <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="new_patient_phone" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_patient_age" class="control-label font-weight-bold"><?php echo lang('age'); ?> <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="new_patient_age" name="age" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_patient_sex" class="control-label font-weight-bold"><?php echo lang('gender'); ?> <span class="text-danger">*</span></label>
                                <select class="form-control" id="new_patient_sex" name="sex" required>
                                    <option value=""><?php echo lang('select_gender'); ?></option>
                                    <option value="Male"><?php echo lang('male'); ?></option>
                                    <option value="Female"><?php echo lang('female'); ?></option>
                                    <option value="Other"><?php echo lang('other'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="new_patient_blood_group" class="control-label font-weight-bold"><?php echo lang('blood_group'); ?></label>
                                <select class="form-control" id="new_patient_blood_group" name="blood_group">
                                    <option value=""><?php echo lang('select_blood_group'); ?></option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="new_patient_address" class="control-label font-weight-bold"><?php echo lang('address'); ?></label>
                        <textarea class="form-control" id="new_patient_address" name="address" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="new_patient_medical_history" class="control-label font-weight-bold"><?php echo lang('medical_history'); ?></label>
                        <textarea class="form-control" id="new_patient_medical_history" name="medical_history" rows="3" placeholder="<?php echo lang('any_known_medical_conditions'); ?>"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                <button type="button" class="btn btn-success" id="save-new-patient">
                    <i class="fas fa-save mr-2"></i>
                    <?php echo lang('create_patient'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- AI Patient Analysis Modal -->
<div class="modal fade" id="aiAnalysisModal" tabindex="-1" role="dialog" aria-labelledby="aiAnalysisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="aiAnalysisModalLabel">
                    <i class="fas fa-robot mr-2"></i>
                    <?php echo lang('ai_patient_analysis'); ?>
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="ai-analysis-loading" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only"><?php echo lang('loading'); ?></span>
                    </div>
                    <p class="mt-2"><?php echo lang('generating_ai_analysis'); ?></p>
                </div>
                <div id="ai-analysis-content" style="display: none;">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle mr-2"></i><?php echo lang('patient_information'); ?></h6>
                        <div class="row">
                            <div class="col-md-3"><strong><?php echo lang('name'); ?>:</strong> <span id="ai-patient-name">-</span></div>
                            <div class="col-md-3"><strong><?php echo lang('age'); ?>:</strong> <span id="ai-patient-age">-</span></div>
                            <div class="col-md-3"><strong><?php echo lang('gender'); ?>:</strong> <span id="ai-patient-gender">-</span></div>
                            <div class="col-md-3"><strong><?php echo lang('phone'); ?>:</strong> <span id="ai-patient-phone">-</span></div>
                        </div>
                    </div>
                    <div id="ai-analysis-text" class="border p-3 rounded" style="background-color: #f8f9fa; max-height: 400px; overflow-y: auto;">
                        <!-- AI analysis content will be loaded here -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close'); ?></button>
                <button type="button" class="btn btn-primary" id="use-this-patient">
                    <i class="fas fa-check mr-2"></i>
                    <?php echo lang('use_this_patient'); ?>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    var selectedPatient = null;
    
    // Patient selection buttons with visual feedback
    $('#select-existing-patient').on('click', function() {
        console.log('Opening patient selection modal');
        
        // Add visual feedback
        $('#existing-patient-card').addClass('selected');
        setTimeout(function() {
            $('#existing-patient-card').removeClass('selected');
        }, 1000);
        
        $('#patientSelectionModal').modal('show');
        initializePatientSearch();
    });
    
    $('#create-new-patient').on('click', function() {
        console.log('Opening new patient modal');
        
        // Add visual feedback
        $('#new-patient-card').addClass('selected');
        setTimeout(function() {
            $('#new-patient-card').removeClass('selected');
        }, 1000);
        
        $('#newPatientModal').modal('show');
    });
    
    // Make entire cards clickable
    $('#existing-patient-card').on('click', function(e) {
        if (!$(e.target).is('button, .btn')) {
            $('#select-existing-patient').click();
        }
    });
    
    $('#new-patient-card').on('click', function(e) {
        if (!$(e.target).is('button, .btn')) {
            $('#create-new-patient').click();
        }
    });
    
    $('#change-patient').on('click', function() {
        console.log('Changing patient - opening selection modal');
        // Hide selected patient info and show no patient message
        $('#selected-patient-info').hide();
        $('#no-patient-selected').show();
        selectedPatient = null;
        $('#patient_id').val('');
        
        $('#patientSelectionModal').modal('show');
        initializePatientSearch();
    });
    
    // Monitor and prevent hiding of selected patient info
    setInterval(function() {
        if (selectedPatient && $('#selected-patient-info').is(':hidden')) {
            console.log('Patient info section was hidden, restoring...');
            $('#selected-patient-info').show().addClass('show').css('display', 'block !important');
        }
    }, 500);
    
    // Initialize patient search in modal
    function initializePatientSearch() {
        $('#patient-search').select2({
            theme: 'bootstrap4',
            width: '100%',
            placeholder: "<?php echo lang('search_by_patient_id_name_phone_age'); ?>",
            allowClear: true,
            minimumInputLength: 0,
            ajax: {
                url: '<?php echo base_url(); ?>emergency/getPatientInfo',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        term: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                error: function(xhr, status, error) {
                    console.error('Patient search error:', error);
                },
                cache: true
            },
            language: {
                noResults: function() {
                    return "<?php echo lang('no_patients_found_matching_your_search'); ?>";
                },
                searching: function() {
                    return "<?php echo lang('searching_patients'); ?>";
                }
            }
        }).on('select2:select', function (e) {
            var data = e.params.data;
            selectPatient(data);
            $('#patientSelectionModal').modal('hide');
        });
    }
    
    // Select patient function
    function selectPatient(patientData) {
        console.log('Selecting patient:', patientData);
        
        selectedPatient = patientData;
        $('#patient_id').val(patientData.id);
        
        // Update basic patient display (for backward compatibility)
        $('#selected-patient-id').text(patientData.id || '-');
        $('#selected-patient-name').text(patientData.text || patientData.name || '-');
        $('#selected-patient-age').text(patientData.age || '-');
        $('#selected-patient-gender').text(patientData.gender || patientData.sex || '-');
        $('#selected-patient-phone').text(patientData.phone || '-');
        
        // Hide no patient selected message
        $('#no-patient-selected').hide();
        
        // Force show selected patient info
        var $selectedInfo = $('#selected-patient-info');
        $selectedInfo.removeClass('d-none').addClass('show');
        $selectedInfo.css({
            'display': 'block !important',
            'visibility': 'visible !important',
            'opacity': '1 !important'
        });
        
        console.log('Selected patient info should be visible now');
        
        // Load complete patient details
        loadPatientDetails(patientData.id);
        
        // Ensure it stays visible with multiple attempts
        setTimeout(function() {
            if (selectedPatient) {
                $selectedInfo.show().addClass('show').css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
                console.log('Re-enforcing visibility after timeout');
            }
        }, 100);
        
        // Additional visibility enforcement
        setTimeout(function() {
            if (selectedPatient) {
                $selectedInfo.show().addClass('show').css({
                    'display': 'block !important',
                    'visibility': 'visible !important',
                    'opacity': '1 !important'
                });
                console.log('Final visibility enforcement');
            }
        }, 500);
    }
    
    // View AI analysis
    $('#view-ai-analysis').on('click', function() {
        if (selectedPatient) {
            $('#aiAnalysisModal').modal('show');
            generateAIAnalysis(selectedPatient.id);
        }
    });
    
    // Use this patient from AI analysis
    $('#use-this-patient').on('click', function() {
        $('#aiAnalysisModal').modal('hide');
    });
    
    
    // Save new patient
    $('#save-new-patient').on('click', function() {
        var formData = $('#new-patient-form').serialize();
        
        console.log('Creating new patient with data:', formData);
        
        $.ajax({
            url: '<?php echo base_url(); ?>emergency/createNewPatient',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Patient creation response:', response);
                
                if (response.success) {
                    // Create patient data object for selection
                    var patientData = {
                        id: response.patient_id,
                        text: response.patient.name,
                        age: response.patient.age,
                        gender: response.patient.sex,
                        phone: response.patient.phone
                    };
                    
                    selectPatient(patientData);
                    $('#newPatientModal').modal('hide');
                    $('#new-patient-form')[0].reset();
                    
                    // Show success message
                    alert('<?php echo lang('patient_created_successfully'); ?>');
                } else {
                    console.error('Patient creation failed:', response.message);
                    alert('<?php echo lang('error_creating_patient'); ?>: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error creating patient:', error);
                console.error('Response text:', xhr.responseText);
                alert('<?php echo lang('error_creating_patient_please_try_again'); ?>');
            }
        });
    });
    
    // Generate AI analysis
    function generateAIAnalysis(patientId) {
        $('#ai-analysis-loading').show();
        $('#ai-analysis-content').hide();
        
        // No doctor selection required - use patient data directly
        $.ajax({
            url: '<?php echo base_url(); ?>ai_patient_overview/getPatientOverview',
            type: 'POST',
            data: {
                patient_id: patientId,
                doctor_id: null // No doctor required
            },
            dataType: 'json',
            success: function(response) {
                $('#ai-analysis-loading').hide();
                
                if (response.success) {
                    // Update patient info in modal
                    $('#ai-patient-name').text(response.patient_data.patient.name || '-');
                    $('#ai-patient-age').text(response.patient_data.patient.age || '-');
                    $('#ai-patient-gender').text(response.patient_data.patient.sex || '-');
                    $('#ai-patient-phone').text(response.patient_data.patient.phone || '-');
                    
                    // Display AI analysis
                    $('#ai-analysis-text').html('<pre style="white-space: pre-wrap; font-family: inherit;">' + response.ai_analysis + '</pre>');
                    $('#ai-analysis-content').show();
                } else {
                    alert('<?php echo lang('error_generating_ai_analysis'); ?>: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                $('#ai-analysis-loading').hide();
                console.error('Error generating AI analysis:', error);
                alert('<?php echo lang('error_generating_ai_analysis_please_try_again'); ?>');
            }
        });
    }

    // Initialize Select2 for doctor dropdown
    $('#doctor_id').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: "<?php echo lang('search_by_doctor_id_or_name'); ?>",
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>emergency/getDoctorInfo',
            dataType: 'json',
            delay: 250,
            data: function (params) {
                console.log('Doctor search term:', params.term);
                return {
                    term: params.term
                };
            },
            processResults: function (data) {
                console.log('Doctor search results:', data);
                return {
                    results: data
                };
            },
            error: function(xhr, status, error) {
                console.error('Doctor search error:', error);
                console.error('Response:', xhr.responseText);
            },
            cache: true
        },
        language: {
            noResults: function() {
                return "<?php echo lang('no_doctors_found_matching_your_search'); ?>";
            },
            searching: function() {
                return "<?php echo lang('searching_doctors'); ?>";
            }
        }
    });

    // Function to load patient details
    function loadPatientDetails(patientId) {
        $.ajax({
            url: '<?php echo base_url(); ?>patient/getPatientById',
            type: 'GET',
            data: { patient_id: patientId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    console.log('Patient details loaded:', response.data);
                    // Store patient data for AI analysis
                    selectedPatient.details = response.data;
                    
                    // Populate all patient information fields
                    populatePatientInfo(response.data);
                } else {
                    console.error('Failed to load patient details:', response.message);
                    // Try alternative method to get patient data
                    loadPatientDetailsAlternative(patientId);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading patient details:', error);
                // Try alternative method to get patient data
                loadPatientDetailsAlternative(patientId);
            }
        });
    }
    
    // Alternative method to load patient details
    function loadPatientDetailsAlternative(patientId) {
        $.ajax({
            url: '<?php echo base_url(); ?>patient/getPatientByJason',
            type: 'GET',
            data: { id: patientId },
            dataType: 'json',
            success: function(response) {
                if (response.patient) {
                    console.log('Patient details loaded via alternative method:', response.patient);
                    selectedPatient.details = response.patient;
                    populatePatientInfo(response.patient);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading patient details via alternative method:', error);
            }
        });
    }
    
    // Populate patient information in the UI
    function populatePatientInfo(patient) {
        // Basic Information - preserve the original patient ID from selectedPatient
        $('#selected-patient-id').text(selectedPatient ? selectedPatient.id : (patient.id || '-'));
        $('#selected-patient-name').text(patient.name || '-');
        $('#selected-patient-age').text(patient.age || '-');
        $('#selected-patient-gender').text(patient.sex || patient.gender || '-');
        
        // Contact Information
        $('#selected-patient-phone').text(patient.phone || '-');
        $('#selected-patient-email').text(patient.email || '-');
        $('#selected-patient-bloodgroup').text(patient.bloodgroup || patient.blood_group || '-');
        
        // Medical Information
        $('#selected-patient-birthdate').text(formatDate(patient.birthdate) || '-');
        $('#selected-patient-add-date').text(formatDate(patient.add_date) || '-');
        
        // Address Information
        $('#selected-patient-address').text(patient.address || '-');
        
        // Medical History and Allergies
        $('#selected-patient-medical-history').text(patient.medical_history || '-');
        $('#selected-patient-allergies').text(patient.known_allergies || '-');
        
        // Emergency Contact
        $('#selected-patient-emergency-contact').text(patient.emergency_contact_name || '-');
        $('#selected-patient-emergency-phone').text(patient.emergency_contact_number || '-');
        
        // Physical Information
        $('#selected-patient-height').text(patient.height ? patient.height + ' <?php echo lang('cm'); ?>' : '-');
        $('#selected-patient-weight').text(patient.weight ? patient.weight + ' <?php echo lang('kg'); ?>' : '-');
        $('#selected-patient-national-id').text(patient.national_id || '-');
    }
    
    // Format date helper function
    function formatDate(dateString) {
        if (!dateString || dateString === '-' || dateString === '0000-00-00') {
            return '-';
        }
        
        try {
            var date = new Date(dateString);
            if (isNaN(date.getTime())) {
                return dateString; // Return original if can't parse
            }
            return date.toLocaleDateString();
        } catch (e) {
            return dateString; // Return original if error
        }
    }

    // Auto-fill arrival time when emergency time changes
    $('#emergency_time').on('change', function() {
        if (!$('#arrival_time').val()) {
            var emergencyTime = new Date($(this).val());
            emergencyTime.setMinutes(emergencyTime.getMinutes() + 15); // Add 15 minutes
            $('#arrival_time').val(emergencyTime.toISOString().slice(0, 16));
        }
    });

    // Form validation
    $('form').on('submit', function(e) {
        var isValid = true;
        var missingFields = [];
        
        // Check patient selection first
        if (!$('#patient_id').val()) {
            isValid = false;
            missingFields.push('<?php echo lang('patient_selection'); ?>');
            $('#no-patient-selected').addClass('border border-danger').css('background-color', '#f8d7da');
            
            // Scroll to patient selection
            $('html, body').animate({
                scrollTop: $('#no-patient-selected').offset().top - 100
            }, 500);
        } else {
            $('#no-patient-selected').removeClass('border border-danger').css('background-color', '');
            // Add success indicator for patient selection
            $('#selected-patient-info').addClass('border border-success').css('background-color', '#d4edda');
        }
        
        // Check other required fields (only in the main form, not in modals)
        $('form[role="form"] input[required], form[role="form"] select[required], form[role="form"] textarea[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
                
                // Get field label for better error message
                var label = $(this).closest('.form-group').find('label').text().replace('*', '').trim();
                if (label && missingFields.indexOf(label) === -1) {
                    missingFields.push(label);
                }
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            
            // Create detailed error message
            var errorMessage = '<?php echo lang('please_fill_in_all_required_fields'); ?>\n\n';
            errorMessage += '<?php echo lang('missing_fields'); ?>:\n';
            missingFields.forEach(function(field) {
                errorMessage += '• ' + field + '\n';
            });
            
            if (!$('#patient_id').val()) {
                errorMessage += '\n<?php echo lang('please_select_or_create_a_patient_first'); ?>';
            }
            
            alert(errorMessage);
        }
    });

    // Remove validation styling on input (only for main form fields)
    $('form[role="form"] input, form[role="form"] select, form[role="form"] textarea').on('input change', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>

<style>
.card {
    border: none;
    border-radius: 10px;
}

.card-header {
    border-radius: 10px 10px 0 0 !important;
    border: none;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-lg {
    border-radius: 8px;
    font-weight: 600;
}

.alert-info {
    border: none;
    border-radius: 8px;
    background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
}

.font-weight-bold {
    font-weight: 600 !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
}

/* Patient selection validation styling */
#no-patient-selected.border-danger {
    border-color: #dc3545 !important;
    background-color: #f8d7da !important;
    animation: shake 0.5s ease-in-out;
}

#selected-patient-info.border-success {
    border-color: #28a745 !important;
    background-color: #d4edda !important;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

    #selected-patient-info {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    #selected-patient-info.show {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    /* Force visibility for selected patient section */
    #selected-patient-info[style*="display: none"] {
        display: block !important;
        visibility: visible !important;
        opacity: 1 !important;
    }

.card.border-success {
    border-width: 2px !important;
    box-shadow: 0 0.125rem 0.25rem rgba(40, 167, 69, 0.15) !important;
}

/* Selected Patient Display Styling */
.selected-patient-display {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-left: 4px solid #28a745;
    border-radius: 6px;
    padding: 12px 15px;
    margin-bottom: 0;
}

.selected-patient-display .btn {
    transition: all 0.2s ease;
}

.selected-patient-display .btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
}

/* Compact Patient Selection - Minimal styling */

/* Responsive adjustments for compact patient selection */
@media (max-width: 768px) {
    .selected-patient-display .d-flex {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .selected-patient-display .d-flex > div:last-child {
        margin-top: 10px;
        width: 100%;
    }
    
    .selected-patient-display .btn {
        width: 100%;
        margin-bottom: 5px;
    }
}


</style>