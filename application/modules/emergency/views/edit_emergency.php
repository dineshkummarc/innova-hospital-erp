<div class="content-wrapper bg-gradient-light" style="min-height: 100vh;">
    <section class="content-header py-4 bg-white shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h1 class="display-4 font-weight-black mb-0">
                        <i class="fas fa-exclamation-triangle text-danger mr-3"></i>
                        <?php echo lang('edit'); ?> <?php echo lang('emergency'); ?>
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0">
                            <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item"><a href="emergency"> <?php echo lang('emergency'); ?></a></li>
                            <li class="breadcrumb-item active"> <?php echo lang('edit'); ?></li>
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
                        <input type="hidden" name="id" value="<?php echo $emergency->id; ?>">
                        
                        <!-- Basic Information Card -->
                        <div class="card shadow-sm mb-4">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    <?php echo lang('basic_information'); ?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="patient_id" class="control-label font-weight-bold"><?php echo lang('patient'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="patient_id" id="patient_id" required>
                                                <option value=""><?php echo lang('select_patient'); ?></option>
                                                <?php if (!empty($emergency->patient_id)): ?>
                                                    <option value="<?php echo $emergency->patient_id; ?>" selected><?php echo $emergency->patient_name; ?></option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="doctor_id" class="control-label font-weight-bold"><?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                                            <select class="form-control select2" name="doctor_id" id="doctor_id" required>
                                                <option value=""><?php echo lang('select_doctor'); ?></option>
                                                <?php if (!empty($emergency->doctor_id)): ?>
                                                    <option value="<?php echo $emergency->doctor_id; ?>" selected><?php echo $emergency->doctor_name; ?></option>
                                                <?php endif; ?>
                                            </select>
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
                                                    'Cardiac',
                                                    'Trauma',
                                                    'Respiratory',
                                                    'Neurological',
                                                    'Pediatric',
                                                    'Obstetric',
                                                    'Psychiatric',
                                                    'Toxicological',
                                                    'Other'
                                                );
                                                foreach ($emergency_types as $type) {
                                                    $selected = ($emergency->emergency_type == $type) ? 'selected' : '';
                                                    echo '<option value="' . $type . '" ' . $selected . '>' . lang(strtolower($type)) . '</option>';
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
                                                $priorities = array(
                                                    'Critical' => lang('critical_priority'),
                                                    'High' => lang('high_priority'),
                                                    'Medium' => lang('medium_priority'),
                                                    'Low' => lang('low_priority')
                                                );
                                                foreach ($priorities as $value => $label) {
                                                    $selected = ($emergency->priority == $value) ? 'selected' : '';
                                                    echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
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
                                                $statuses = array(
                                                    'Active',
                                                    'In Progress',
                                                    'Stable',
                                                    'Critical',
                                                    'Resolved'
                                                );
                                                foreach ($statuses as $status) {
                                                    $selected = ($emergency->status == $status) ? 'selected' : '';
                                                    echo '<option value="' . $status . '" ' . $selected . '>' . lang(strtolower(str_replace(' ', '_', $status))) . '</option>';
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
                                            <input type="datetime-local" class="form-control" name="emergency_time" id="emergency_time" value="<?php echo date('Y-m-d\TH:i', strtotime($emergency->emergency_time)); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="arrival_time" class="control-label font-weight-bold"><?php echo lang('arrival_time'); ?></label>
                                            <input type="datetime-local" class="form-control" name="arrival_time" id="arrival_time" value="<?php echo $emergency->arrival_time ? date('Y-m-d\TH:i', strtotime($emergency->arrival_time)) : ''; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="location" class="control-label font-weight-bold"><?php echo lang('location'); ?></label>
                                            <input type="text" class="form-control" name="location" id="location" placeholder="<?php echo lang('location_placeholder'); ?>" value="<?php echo $emergency->location; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="chief_complaint" class="control-label font-weight-bold"><?php echo lang('chief_complaint'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="chief_complaint" id="chief_complaint" rows="2" placeholder="<?php echo lang('chief_complaint_placeholder'); ?>" required><?php echo $emergency->chief_complaint; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="description" class="control-label font-weight-bold"><?php echo lang('emergency_description'); ?> <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="<?php echo lang('emergency_description_placeholder'); ?>" required><?php echo $emergency->description; ?></textarea>
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
                                            <input type="text" class="form-control" name="blood_pressure" id="blood_pressure" placeholder="<?php echo lang('blood_pressure_placeholder'); ?>" value="<?php echo $emergency->blood_pressure; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="heart_rate" class="control-label font-weight-bold"><?php echo lang('heart_rate'); ?> (<?php echo lang('bpm'); ?>)</label>
                                            <input type="number" class="form-control" name="heart_rate" id="heart_rate" placeholder="<?php echo lang('heart_rate_placeholder'); ?>" value="<?php echo $emergency->heart_rate; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="temperature" class="control-label font-weight-bold"><?php echo lang('temperature'); ?> (°C)</label>
                                            <input type="number" step="0.1" class="form-control" name="temperature" id="temperature" placeholder="<?php echo lang('temperature_placeholder'); ?>" value="<?php echo $emergency->temperature; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="oxygen_saturation" class="control-label font-weight-bold"><?php echo lang('oxygen_saturation'); ?> (%)</label>
                                            <input type="number" class="form-control" name="oxygen_saturation" id="oxygen_saturation" placeholder="<?php echo lang('oxygen_saturation_placeholder'); ?>" value="<?php echo $emergency->oxygen_saturation; ?>">
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
                                            <textarea class="form-control" name="symptoms" id="symptoms" rows="3" placeholder="<?php echo lang('presenting_symptoms_placeholder'); ?>"><?php echo $emergency->symptoms; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medical_history" class="control-label font-weight-bold"><?php echo lang('medical_history'); ?></label>
                                            <textarea class="form-control" name="medical_history" id="medical_history" rows="3" placeholder="<?php echo lang('medical_history_placeholder'); ?>"><?php echo $emergency->medical_history; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="allergies" class="control-label font-weight-bold"><?php echo lang('known_allergies'); ?></label>
                                            <textarea class="form-control" name="allergies" id="allergies" rows="2" placeholder="<?php echo lang('allergies_placeholder'); ?>"><?php echo $emergency->allergies; ?></textarea>
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
                                                foreach ($follow_ups as $value => $label) {
                                                    $selected = ($emergency->follow_up == $value) ? 'selected' : '';
                                                    echo '<option value="' . $value . '" ' . $selected . '>' . $label . '</option>';
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
                                            <textarea class="form-control" name="treatment_given" id="treatment_given" rows="3" placeholder="<?php echo lang('treatment_given_placeholder'); ?>"><?php echo $emergency->treatment_given; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="medications" class="control-label font-weight-bold"><?php echo lang('medications_administered'); ?></label>
                                            <textarea class="form-control" name="medications" id="medications" rows="3" placeholder="<?php echo lang('medications_administered_placeholder'); ?>"><?php echo $emergency->medications; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="notes" class="control-label font-weight-bold"><?php echo lang('additional_notes'); ?></label>
                                    <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="<?php echo lang('additional_notes_placeholder'); ?>"><?php echo $emergency->notes; ?></textarea>
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

<script>
$(document).ready(function() {
    // Initialize Select2 for patient dropdown
    $('#patient_id').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: '<?php echo lang('search_patient_placeholder'); ?>',
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
            cache: true
        },
        language: {
            noResults: function() {
                return "<?php echo lang('no_patients_found'); ?>";
            },
            searching: function() {
                return "<?php echo lang('searching_patients'); ?>";
            }
        }
    });

    // Initialize Select2 for doctor dropdown
    $('#doctor_id').select2({
        theme: 'bootstrap4',
        width: '100%',
        placeholder: '<?php echo lang('search_doctor_placeholder'); ?>',
        allowClear: true,
        minimumInputLength: 0,
        ajax: {
            url: '<?php echo base_url(); ?>emergency/getDoctorInfo',
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
            cache: true
        },
        language: {
            noResults: function() {
                return "<?php echo lang('no_doctors_found'); ?>";
            },
            searching: function() {
                return "<?php echo lang('searching_doctors'); ?>";
            }
        }
    });

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
        
        // Check required fields
        $('input[required], select[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('<?php echo lang('please_fill_required_fields'); ?>');
        }
    });

    // Remove validation styling on input
    $('input, select, textarea').on('input change', function() {
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

.font-weight-bold {
    font-weight: 600 !important;
}

.shadow-sm {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.is-invalid {
    border-color: #dc3545 !important;
}
</style>