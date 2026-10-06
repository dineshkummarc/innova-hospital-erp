<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo lang('dental_examination_report'); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>common/adminlte/plugins/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        
        .report-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            color: #333;
        }
        
        .info-section {
            margin-bottom: 25px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }
        
        .info-section h6 {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
            border-bottom: 1px solid #eee;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        
        .patient-info {
            background-color: #f8f9fa;
        }
        
        .examination-info {
            background-color: #fff;
        }
        
        .odontogram-section {
            page-break-inside: avoid;
            margin-bottom: 25px;
        }
        
        .tooth-legend {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
        }
        
        .legend-item {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #ccc;
        }
        
        .treatments-table, .prescriptions-table {
            font-size: 11px;
        }
        
        .treatments-table th, .prescriptions-table th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 50px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        
        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }
        
        .signature-box {
            width: 200px;
            text-align: center;
        }
        
        .signature-line {
            border-bottom: 1px solid #333;
            margin-bottom: 5px;
            height: 50px;
        }
        
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            
            .no-print {
                display: none !important;
            }
            
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Print Button -->
        <div class="no-print text-center mb-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> <?php echo lang('print_report'); ?>
            </button>
            <button onclick="window.close()" class="btn btn-secondary ml-2">
                <i class="fas fa-times"></i> <?php echo lang('close'); ?>
            </button>
        </div>

        <!-- Header -->
        <div class="header">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <?php echo htmlspecialchars($settings->title ?? 'Dental Clinic'); ?>
                    </div>
                    <small><?php echo htmlspecialchars($settings->address ?? ''); ?></small>
                </div>
                <div class="col-md-6">
                    <div class="report-title"><?php echo lang('dental_examination_report'); ?></div>
                </div>
                <div class="col-md-3 text-right">
                    <strong><?php echo lang('report_date'); ?>:</strong> <?php echo date('F d, Y'); ?><br>
                    <strong><?php echo lang('report_id'); ?>:</strong> DE-<?php echo str_pad($examination->id, 6, '0', STR_PAD_LEFT); ?>
                </div>
            </div>
        </div>

        <!-- Patient Information -->
        <div class="info-section patient-info">
            <h6><?php echo lang('patient_information'); ?></h6>
            <div class="row">
                <div class="col-md-6">
                    <strong><?php echo lang('name'); ?>:</strong> <?php echo htmlspecialchars($examination->patient_name); ?><br>
                    <strong><?php echo lang('patient_id'); ?>:</strong> <?php echo $examination->patient_id; ?><br>
                    <strong><?php echo lang('email'); ?>:</strong> <?php echo htmlspecialchars($examination->patient_email ?: lang('not_provided')); ?><br>
                    <strong><?php echo lang('phone'); ?>:</strong> <?php echo htmlspecialchars($examination->patient_phone ?: lang('not_provided')); ?>
                </div>
                <div class="col-md-6">
                    <strong><?php echo lang('address'); ?>:</strong> <?php echo htmlspecialchars($examination->patient_address ?: lang('not_provided')); ?><br>
                    <strong><?php echo lang('birth_date'); ?>:</strong> 
                    <?php 
                    if ($examination->patient_birth_date) {
                        echo date('F d, Y', strtotime($examination->patient_birth_date));
                        $age = date_diff(date_create($examination->patient_birth_date), date_create('today'))->y;
                        echo " (Age: $age)";
                    } else {
                        echo lang('not_provided');
                    }
                    ?><br>
                    <strong><?php echo lang('gender'); ?>:</strong> <?php echo htmlspecialchars($examination->patient_sex ?: lang('not_specified')); ?>
                </div>
            </div>
        </div>

        <!-- Examination Details -->
        <div class="info-section examination-info">
            <h6><?php echo lang('examination_details'); ?></h6>
            <div class="row">
                <div class="col-md-6">
                    <strong><?php echo lang('examining_doctor'); ?>:</strong> <?php echo htmlspecialchars($examination->doctor_name); ?><br>
                    <strong><?php echo lang('email'); ?>:</strong> <?php echo htmlspecialchars($examination->doctor_email ?: ''); ?><br>
                    <strong><?php echo lang('examination_date'); ?>:</strong> <?php echo date('F d, Y h:i A', strtotime($examination->examination_date)); ?>
                </div>
                <div class="col-md-6">
                    <strong><?php echo lang('status'); ?>:</strong> 
                    <span style="background-color: <?php 
                        switch ($examination->status) {
                            case 'completed': echo '#28a745'; break;
                            case 'follow_up_required': echo '#ffc107'; break;
                            case 'draft': echo '#6c757d'; break;
                            default: echo '#f8f9fa';
                        } 
                    ?>; color: <?php echo ($examination->status === 'follow_up_required') ? '#000' : '#fff'; ?>; padding: 3px 8px; border-radius: 3px;">
                        <?php echo ucfirst(str_replace('_', ' ', $examination->status)); ?>
                    </span><br>
                    <?php if ($examination->next_appointment): ?>
                        <strong><?php echo lang('next_appointment'); ?>:</strong> <?php echo date('F d, Y h:i A', strtotime($examination->next_appointment)); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Clinical History -->
        <div class="info-section">
            <h6><?php echo lang('clinical_history'); ?></h6>
            
            <div class="mb-3">
                <strong><?php echo lang('chief_complaint'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->chief_complaint ?: lang('not_specified'))); ?>
            </div>
            
            <div class="mb-3">
                <strong><?php echo lang('medical_history'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->medical_history ?: lang('no_significant_medical_history'))); ?>
            </div>
            
            <div class="mb-3">
                <strong><?php echo lang('dental_history'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->dental_history ?: lang('no_previous_dental_treatments_recorded'))); ?>
            </div>
        </div>

        <!-- Clinical Examination -->
        <div class="info-section">
            <h6><?php echo lang('clinical_examination'); ?></h6>
            
            <div class="mb-3">
                <strong><?php echo lang('extraoral_examination'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->extraoral_examination ?: lang('no_abnormalities_noted'))); ?>
            </div>
            
            <div class="mb-3">
                <strong><?php echo lang('intraoral_examination'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->intraoral_examination ?: lang('no_abnormalities_noted'))); ?>
            </div>
        </div>

        <!-- Odontogram -->
        <div class="odontogram-section">
            <div class="info-section">
                <h6><?php echo lang('dental_odontogram'); ?></h6>
                
                <!-- Simplified text-based odontogram for print -->
                <?php if (!empty($odontogram)): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr style="background-color: #007bff; color: white;">
                                    <th><?php echo lang('tooth_number'); ?></th>
                                    <th><?php echo lang('type'); ?></th>
                                    <th><?php echo lang('condition'); ?></th>
                                    <th><?php echo lang('surface_affected'); ?></th>
                                    <th><?php echo lang('severity'); ?></th>
                                    <th><?php echo lang('notes'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($odontogram as $tooth): ?>
                                    <tr>
                                        <td><strong><?php echo $tooth->tooth_number; ?></strong></td>
                                        <td><?php echo ucfirst($tooth->tooth_type); ?></td>
                                        <td>
                                            <span class="legend-item" style="background-color: <?php echo $tooth->color_code; ?>; color: <?php echo ($tooth->color_code === '#FFFFFF' || $tooth->color_code === '#FFD700' || $tooth->color_code === '#00FF00' || $tooth->color_code === '#00FFFF') ? '#000' : '#fff'; ?>;">
                                                <?php echo ucfirst(str_replace('_', ' ', $tooth->condition)); ?>
                                            </span>
                                        </td>
                                        <td><?php echo htmlspecialchars($tooth->surface_affected ?: '-'); ?></td>
                                        <td><?php echo $tooth->severity ? ucfirst($tooth->severity) : '-'; ?></td>
                                        <td><?php echo htmlspecialchars($tooth->notes ?: '-'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Legend -->
                    <div class="tooth-legend">
                        <span class="legend-item" style="background-color: #FFFFFF; color: #000; border: 1px solid #ccc;"><?php echo lang('healthy'); ?></span>
                        <span class="legend-item" style="background-color: #FF0000; color: #fff;"><?php echo lang('caries'); ?></span>
                        <span class="legend-item" style="background-color: #0000FF; color: #fff;"><?php echo lang('filled'); ?></span>
                        <span class="legend-item" style="background-color: #FFD700; color: #000;"><?php echo lang('crowned'); ?></span>
                        <span class="legend-item" style="background-color: #000000; color: #fff;"><?php echo lang('extracted'); ?></span>
                        <span class="legend-item" style="background-color: #800080; color: #fff;"><?php echo lang('impacted'); ?></span>
                        <span class="legend-item" style="background-color: #FF6600; color: #fff;"><?php echo lang('fractured'); ?></span>
                        <span class="legend-item" style="background-color: #FF69B4; color: #fff;"><?php echo lang('root_canal'); ?></span>
                        <span class="legend-item" style="background-color: #00FF00; color: #000;"><?php echo lang('implant'); ?></span>
                        <span class="legend-item" style="background-color: #00FFFF; color: #000;"><?php echo lang('bridge'); ?></span>
                    </div>
                <?php else: ?>
                    <p class="text-muted"><?php echo lang('no_specific_tooth_conditions_recorded'); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Diagnosis and Treatment Plan -->
        <div class="info-section">
            <h6><?php echo lang('diagnosis_and_treatment_plan'); ?></h6>
            
            <div class="mb-3">
                <strong><?php echo lang('diagnosis'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->diagnosis ?: lang('diagnosis_pending'))); ?>
            </div>
            
            <div class="mb-3">
                <strong><?php echo lang('treatment_plan'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->treatment_plan ?: lang('treatment_plan_to_be_determined'))); ?>
            </div>
            
            <?php if ($examination->notes): ?>
            <div class="mb-3">
                <strong><?php echo lang('additional_notes'); ?>:</strong><br>
                <?php echo nl2br(htmlspecialchars($examination->notes)); ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Treatments -->
        <?php if (!empty($treatments)): ?>
        <div class="info-section">
            <h6><?php echo lang('planned_treatments'); ?></h6>
            <table class="table table-bordered treatments-table">
                <thead>
                    <tr>
                        <th><?php echo lang('treatment'); ?></th>
                        <th><?php echo lang('tooth'); ?></th>
                        <th><?php echo lang('description'); ?></th>
                        <th><?php echo lang('date'); ?></th>
                        <th><?php echo lang('duration'); ?></th>
                        <th><?php echo lang('cost'); ?></th>
                        <th><?php echo lang('status'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($treatments as $treatment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($treatment->treatment_type); ?></td>
                            <td><?php echo $treatment->tooth_number ?: 'General'; ?></td>
                            <td><?php echo htmlspecialchars($treatment->treatment_description ?: '-'); ?></td>
                            <td><?php echo $treatment->treatment_date ? date('M d, Y', strtotime($treatment->treatment_date)) : 'TBD'; ?></td>
                            <td><?php echo $treatment->duration_minutes ? $treatment->duration_minutes . ' min' : '-'; ?></td>
                            <td><?php echo $treatment->cost ? '$' . number_format($treatment->cost, 2) : '-'; ?></td>
                            <td><?php echo ucfirst(str_replace('_', ' ', $treatment->status)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <!-- Prescriptions -->
        <?php if (!empty($prescriptions)): ?>
        <div class="info-section">
            <h6><?php echo lang('prescriptions'); ?></h6>
            <table class="table table-bordered prescriptions-table">
                <thead>
                    <tr>
                        <th><?php echo lang('medication'); ?></th>
                        <th><?php echo lang('dosage'); ?></th>
                        <th><?php echo lang('frequency'); ?></th>
                        <th><?php echo lang('duration'); ?></th>
                        <th><?php echo lang('quantity'); ?></th>
                        <th><?php echo lang('instructions'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prescriptions as $prescription): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($prescription->medication_name); ?></strong></td>
                            <td><?php echo htmlspecialchars($prescription->dosage ?: '-'); ?></td>
                            <td><?php echo htmlspecialchars($prescription->frequency ?: '-'); ?></td>
                            <td><?php echo htmlspecialchars($prescription->duration ?: '-'); ?></td>
                            <td><?php echo $prescription->quantity ?: '-'; ?></td>
                            <td><?php echo htmlspecialchars($prescription->instructions ?: '-'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <!-- Signature Section -->
        <div class="signature-section">
            <div class="signature-box">
                <div class="signature-line"></div>
                <strong><?php echo lang('patient_signature'); ?></strong><br>
                <small><?php echo lang('date'); ?>: _______________</small>
            </div>
            <div class="signature-box">
                <div class="signature-line"></div>
                <strong><?php echo lang('doctor_signature'); ?></strong><br>
                <small><?php echo htmlspecialchars($examination->doctor_name); ?></small><br>
                <small><?php echo lang('date'); ?>: <?php echo date('F d, Y'); ?></small>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><?php echo lang('report_generated_by'); ?> <?php echo htmlspecialchars($settings->title ?? 'Dental Management System'); ?> <?php echo lang('on'); ?> <?php echo date('F d, Y \a\t h:i A'); ?></p>
            <p><?php echo lang('for_questions_regarding_this_report'); ?>: <?php echo htmlspecialchars($settings->phone ?? ''); ?> | <?php echo htmlspecialchars($settings->email ?? ''); ?></p>
        </div>
    </div>

    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() { window.print(); }
    </script>
</body>
</html>
