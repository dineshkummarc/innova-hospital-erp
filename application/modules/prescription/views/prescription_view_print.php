<!--main content start-->

<?php
$doctor = $this->doctor_model->getDoctorById($prescription->doctor);
$patient = $this->patient_model->getPatientById($prescription->patient);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 pl-1">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold"><i class="fas fa-prescription mr-2"></i><?php echo lang('prescription'); ?> : (<?php echo lang('id'); ?>: <?php echo $prescription->id; ?>)</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('prescription') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('print') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content py-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9">
                    <!-- Document Header -->
                    <div class="document-header mb-2">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h3 class="document-title mb-1">MEDICAL PRESCRIPTION #<?php echo $prescription->id; ?></h3>
                                <p class="document-subtitle mb-0"><?php echo date('M d, Y', $prescription->date); ?> | <?php echo !empty($doctor) ? $doctor->name : $settings->title; ?></p>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="document-actions">
                                    <button type="button" class="btn btn-outline-primary btn-sm print-btn" onclick="printDocument()">
                                        <i class="fas fa-print mr-1"></i>
                                        Print Prescription
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Document Content -->
                    <div class="document-content">
                        <!-- Doctor Information Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title">PRESCRIBING PHYSICIAN</h5>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="info-row">
                                            <span class="info-label">Name:</span>
                                            <span class="info-value"><?php echo !empty($doctor) ? $doctor->name : $settings->title; ?></span>
                                        </div>
                                        <?php if (!empty($doctor) && !empty($doctor->profile)): ?>
                                        <div class="info-row">
                                            <span class="info-label">Specialization:</span>
                                            <span class="info-value"><?php echo $doctor->profile; ?></span>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <?php if (!empty($settings->logo)): ?>
                                        <img src="<?php echo $settings->logo; ?>" class="hospital-logo" alt="Hospital Logo">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Hospital:</span>
                                    <span class="info-value"><?php echo $settings->title; ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Address:</span>
                                    <span class="info-value"><?php echo $settings->address; ?></span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Phone:</span>
                                    <span class="info-value"><?php echo $settings->phone; ?></span>
                                </div>
                            </div>
                        </div>

                        <!-- Patient Information Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title">PATIENT INFORMATION</h5>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-row">
                                            <span class="info-label">Name:</span>
                                            <span class="info-value"><?php echo !empty($patient) ? $patient->name : 'Not specified'; ?></span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Patient ID:</span>
                                            <span class="info-value"><?php echo !empty($patient) ? $patient->id : 'Not specified'; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-row">
                                            <span class="info-label">Age:</span>
                                            <span class="info-value">
                                                <?php
                                                if (!empty($patient)) {
                                                    if (!empty($patient->birthdate)) {
                                                        $birthDate = strtotime($patient->birthdate);
                                                        $birthDate = date('m/d/Y', $birthDate);
                                                        $birthDate = explode("/", $birthDate);
                                                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
                                                        echo $age . ' ' . lang('years');
                                                    } elseif (!empty($patient->age)) {
                                                        $age = explode('-', $patient->age);
                                                        echo $age[0] . 'Y ' . $age[1] . 'M ' . $age[2] . 'D';
                                                    }
                                                } else {
                                                    echo 'Not specified';
                                                }
                                                ?>
                                            </span>
                                        </div>
                                        <div class="info-row">
                                            <span class="info-label">Gender:</span>
                                            <span class="info-value"><?php echo !empty($patient) ? $patient->sex : 'Not specified'; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Medical Information Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title">MEDICAL INFORMATION</h5>
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="info-row">
                                            <span class="info-label">Symptoms/History:</span>
                                            <span class="info-value"><?php echo !empty($prescription->symptom) ? $prescription->symptom : 'Not specified'; ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-row">
                                            <span class="info-label">Notes:</span>
                                            <span class="info-value"><?php echo !empty($prescription->note) ? $prescription->note : 'None'; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php if (!empty($prescription->advice)): ?>
                                <div class="info-row">
                                    <span class="info-label">Advice:</span>
                                    <span class="info-value"><?php echo $prescription->advice; ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Prescription Section -->
                        <div class="document-section mb-2">
                            <h5 class="section-title">PRESCRIPTION</h5>
                            <div class="section-content">
                                <div class="prescription-header">
                                    <span class="rx-symbol">℞</span>
                                    <span class="rx-text">PRESCRIPTION</span>
                                </div>
                                
                                <?php if (!empty($prescription->medicine)): ?>
                                <div class="medicine-table">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="medicine-col"><?php echo lang('medicine'); ?></th>
                                                <th class="instruction-col"><?php echo lang('instruction'); ?></th>
                                                <th class="frequency-col"><?php echo lang('frequency'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $medicine = $prescription->medicine;
                                            $medicine = explode('###', $medicine);
                                            foreach ($medicine as $key => $value) {
                                                if (!empty(trim($value))) {
                                            ?>
                                                <tr>
                                                    <?php $single_medicine = explode('***', $value); ?>
                                                    <td class="medicine-cell"><?php echo $this->medicine_model->getMedicineById($single_medicine[0])->name . ' - ' . $single_medicine[1]; ?></td>
                                                    <td class="instruction-cell"><?php echo $single_medicine[3] . ' - ' . $single_medicine[4]; ?></td>
                                                    <td class="frequency-cell"><?php echo $single_medicine[2]; ?></td>
                                                </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php else: ?>
                                <div class="no-medicine">
                                    <p class="text-muted">No medications prescribed</p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Signature Section -->
                        <div class="document-section mb-2">
                            <div class="signature-section">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="signature-line">
                                            <span class="signature-label"><?php echo lang('signature'); ?>:</span>
                                            <div class="signature-space"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="hospital-info">
                                            <div class="info-row">
                                                <span class="info-label">Hospital:</span>
                                                <span class="info-value"><?php echo $settings->title; ?></span>
                                            </div>
                                            <div class="info-row">
                                                <span class="info-label">Date:</span>
                                                <span class="info-value"><?php echo date('M d, Y', $prescription->date); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Sidebar -->
                <div class="col-lg-3">
                    <div class="document-sidebar">
                        <div class="sidebar-section">
                            <h6 class="sidebar-title">PRESCRIPTION SUMMARY</h6>
                            <div class="summary-item">
                                <span class="summary-label">Prescription ID:</span>
                                <span class="summary-value">#<?php echo $prescription->id; ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Date:</span>
                                <span class="summary-value"><?php echo date('M d, Y', $prescription->date); ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Doctor:</span>
                                <span class="summary-value"><?php echo !empty($doctor) ? $doctor->name : $settings->title; ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="summary-label">Patient:</span>
                                <span class="summary-value"><?php echo !empty($patient) ? $patient->name : 'Not specified'; ?></span>
                            </div>
                            <?php if (!empty($prescription->medicine)): ?>
                            <div class="summary-item">
                                <span class="summary-label">Medications:</span>
                                <span class="summary-value"><?php echo count(explode('###', $prescription->medicine)); ?> items</span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="sidebar-section">
                            <h6 class="sidebar-title">ACTIONS</h6>
                            <div class="action-buttons">
                                <button class="btn btn-outline-primary btn-sm btn-block mb-1" onclick="printDocument()">
                                    <i class="fas fa-print mr-1"></i>
                                    Print Prescription
                                </button>
                                <button class="btn btn-outline-success btn-sm btn-block mb-1" id="download">
                                    <i class="fa fa-download mr-1"></i>
                                    Download PDF
                                </button>
                                <?php if ($this->ion_auth->in_group(array('admin'))): ?>
                                <a class="btn btn-outline-info btn-sm btn-block mb-1" href='prescription/all'>
                                    <i class="fa fa-medkit mr-1"></i>
                                    All Prescriptions
                                </a>
                                <?php endif; ?>
                                <?php if ($this->ion_auth->in_group(array('Doctor'))): ?>
                                <a class="btn btn-outline-info btn-sm btn-block mb-1" href='prescription'>
                                    <i class="fa fa-medkit mr-1"></i>
                                    My Prescriptions
                                </a>
                                <?php endif; ?>
                                <?php if ($this->ion_auth->in_group(array('admin', 'Doctor'))): ?>
                                <a class="btn btn-outline-success btn-sm btn-block mb-1" href="prescription/addPrescriptionView">
                                    <i class="fa fa-plus-circle mr-1"></i>
                                    Add Prescription
                                </a>
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

.hospital-logo {
    max-height: 60px;
    max-width: 120px;
    object-fit: contain;
}

/* Prescription Specific Styles */
.prescription-header {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
    padding: 0.5rem;
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 3px;
}

.rx-symbol {
    font-size: 2rem;
    font-weight: 700;
    color: #000;
    margin-right: 0.5rem;
}

.rx-text {
    font-size: 1.2rem;
    font-weight: 700;
    color: #000;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.medicine-table {
    margin-top: 0.5rem;
}

.medicine-table .table {
    margin-bottom: 0;
    font-size: 0.85rem;
}

.medicine-table th {
    background: #f8f9fa;
    font-weight: 700;
    color: #000;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    padding: 0.5rem 0.75rem;
    border: 1px solid #ddd;
}

.medicine-table td {
    padding: 0.5rem 0.75rem;
    border: 1px solid #ddd;
    vertical-align: top;
}

.medicine-col {
    width: 40%;
}

.instruction-col {
    width: 40%;
}

.frequency-col {
    width: 20%;
    text-align: center;
}

.medicine-cell {
    font-weight: 600;
}

.instruction-cell {
    font-style: italic;
}

.frequency-cell {
    text-align: center;
    font-weight: 600;
}

.no-medicine {
    text-align: center;
    padding: 2rem;
    color: #666;
    font-style: italic;
}

/* Signature Section */
.signature-section {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #ddd;
}

.signature-line {
    margin-bottom: 1rem;
}

.signature-label {
    font-weight: 600;
    color: #333;
    font-size: 0.85rem;
}

.signature-space {
    height: 40px;
    border-bottom: 1px solid #000;
    margin-top: 0.5rem;
}

.hospital-info {
    text-align: right;
}

/* Sidebar Styles */
.document-sidebar {
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 0.75rem;
}

.sidebar-section {
    margin-bottom: 1rem;
}

.sidebar-section:last-child {
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

.action-buttons .btn {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
    border-radius: 3px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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

/* Print Styles */
@media print {
    .print-btn {
        display: none !important;
    }
    
    .document-actions {
        display: none !important;
    }
    
    .document-sidebar {
        display: none !important;
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
    
    .medicine-table {
        break-inside: avoid;
        page-break-inside: avoid;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .document-title {
        font-size: 1.25rem;
    }
    
    .info-label {
        min-width: 100px;
    }
    
    .summary-label {
        min-width: 70px;
    }
    
    .medicine-table {
        font-size: 0.75rem;
    }
    
    .medicine-table th,
    .medicine-table td {
        padding: 0.375rem 0.5rem;
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
</style>

<script>
function printDocument() {
    // Hide the print button and sidebar during printing
    const printBtn = document.querySelector('.print-btn');
    const documentActions = document.querySelector('.document-actions');
    const sidebar = document.querySelector('.document-sidebar');
    
    if (printBtn) printBtn.style.display = 'none';
    if (documentActions) documentActions.style.display = 'none';
    if (sidebar) sidebar.style.display = 'none';
    
    // Print the document
    window.print();
    
    // Restore elements after printing
    setTimeout(() => {
        if (printBtn) printBtn.style.display = 'inline-block';
        if (documentActions) documentActions.style.display = 'flex';
        if (sidebar) sidebar.style.display = 'block';
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

<script src="common/js/codearistos.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
<script type="text/javascript">
    var id_pres = "<?php echo $prescription->id; ?>";
</script>
<script src="common/extranal/js/prescription/prescription_print.js"></script>

<!--main content end-->