<?php
// Initialize data objects safely
$patient_info = !empty($payment->patient) ? $this->db->get_where('patient', array('id' => $payment->patient))->row() : null;

// Official Currency configuration: BDT (৳)
$currency = '৳';

// Formatted Identifiers (10-digit zero padded for diagnostic center record standards)
$vn = sprintf('%010d', $payment->id);
$hn = !empty($patient_info->id) ? sprintf('%010d', $patient_info->id) : (!empty($payment->patient) ? sprintf('%010d', $payment->patient) : '0000000000');

// Dates with Asia/Dhaka timezone
date_default_timezone_set('Asia/Dhaka');
$invoice_date = !empty($payment->date) ? date('d/m/Y', $payment->date) : date('d/m/Y');
$visit_date = !empty($payment->date) ? date('d/m/Y', $payment->date) : date('d/m/Y');
$print_date = date('d/m/Y h:i A');

// Patient Information Details
$patient_name = !empty($patient_info->name) ? $patient_info->name : (!empty($payment->patient_name) ? $payment->patient_name : '');
$patient_phone = !empty($patient_info->phone) ? $patient_info->phone : (!empty($payment->patient_phone) ? $payment->patient_phone : '');

// Patient Age / Gender
$age_str = '';
if (!empty($patient_info) && !empty($patient_info->age)) {
    $age_parts = explode('-', $patient_info->age);
    if (count($age_parts) >= 2) {
        $age_str = trim($age_parts[0] . ' Years ' . $age_parts[1] . ' Months');
    } else {
        $age_str = trim($patient_info->age . ' Years');
    }
}
$gender_str = !empty($patient_info->sex) ? $patient_info->sex : '';

// -------------------------------------------------------------
// Doctor Information Resolution (FULL DETAILS STRICTLY IN ENGLISH)
// -------------------------------------------------------------
$doctor_obj = null;
$doc_id = !empty($payment->doctor) ? $payment->doctor : null;
if (!empty($doc_id)) {
    $doctor_obj = $this->doctor_model->getDoctorById($doc_id);
}

$doctor_details = [
    'name' => '',
    'department' => '',
    'qualifications' => '',
    'designation' => '',
    'institution' => ''
];

if (!empty($doctor_obj)) {
    // 1. Doctor Name (English strictly)
    if (!empty($doctor_obj->name_en) && preg_match('/[A-Za-z]/', $doctor_obj->name_en)) {
        $doctor_details['name'] = trim($doctor_obj->name_en);
    } elseif (!empty($doctor_obj->name) && preg_match('/^[A-Za-z0-9\s\.\(\)\,\-]+$/', trim($doctor_obj->name))) {
        $doctor_details['name'] = trim($doctor_obj->name);
    } elseif (!empty($payment->doctor_name) && preg_match('/^[A-Za-z0-9\s\.\(\)\,\-]+$/', trim($payment->doctor_name))) {
        $doctor_details['name'] = trim($payment->doctor_name);
    }
    
    // Ensure "Dr." prefix
    if (!empty($doctor_details['name']) && !preg_match('/^(Dr|Dr\.)/i', $doctor_details['name'])) {
        $doctor_details['name'] = 'Dr. ' . $doctor_details['name'];
    }

    // 2. Department / Specialization (English strictly)
    if (!empty($doctor_obj->department_name) && preg_match('/[A-Za-z]/', $doctor_obj->department_name)) {
        $doctor_details['department'] = trim($doctor_obj->department_name);
    }

    // 3. Qualifications / Profile in English (No Bengali characters)
    if (!empty($doctor_obj->profile)) {
        $rawProfile = trim(strip_tags($doctor_obj->profile));
        
        // If parenthetical English is present: e.g. (Medicine, Neuro Medicine, Heart Disease, Diabetes)
        if (preg_match('/\(([A-Za-z0-9\s,&\/\-\.\+]+)\)/', $rawProfile, $m)) {
            $doctor_details['qualifications'] = trim($m[1]);
        } elseif (preg_match('/[A-Za-z]{2,}/', $rawProfile)) {
            // Strip any Bengali characters and clean up punctuation
            $englishOnly = preg_replace('/[\x{0980}-\x{09FF}]+/u', '', $rawProfile);
            $englishOnly = trim(preg_replace('/[\s\|\-\:\,]+$/', '', preg_replace('/^[\s\|\-\:\,]+/', '', $englishOnly)));
            if (!empty($englishOnly) && strlen($englishOnly) > 3) {
                $doctor_details['qualifications'] = $englishOnly;
            }
        }
    }
} elseif (!empty($payment->doctor_name)) {
    if (preg_match('/^[A-Za-z0-9\s\.\(\)\,\-]+$/', trim($payment->doctor_name))) {
        $doctor_details['name'] = trim($payment->doctor_name);
        if (!preg_match('/^(Dr|Dr\.)/i', $doctor_details['name'])) {
            $doctor_details['name'] = 'Dr. ' . $doctor_details['name'];
        }
    }
}

// Referrer Information (if assigned)
$referrer_display = '';
if (!empty($payment->referrer_name)) {
    $referrer_display = trim($payment->referrer_name);
} elseif (!empty($payment->referrer)) {
    $ref_obj = $this->db->get_where('referrer', array('id' => $payment->referrer))->row();
    if (!empty($ref_obj->name)) {
        $referrer_display = trim($ref_obj->name);
    }
}

// Line Items Resolution (Historical Snapshot Compatibility)
$items = array();
$payment_items = $this->db->get_where('payment_items', array('payment_id' => $payment->id))->result();
if (!empty($payment_items)) {
    $idx = 0;
    foreach ($payment_items as $p_item) {
        $idx++;
        $cat_info = !empty($p_item->item_id) ? $this->finance_model->getPaymentcategoryById($p_item->item_id) : null;
        $room_no = !empty($cat_info) && !empty($cat_info->description) ? $cat_info->description : (!empty($cat_info->category) ? $cat_info->category : '-');
        $items[] = array(
            'index' => $idx,
            'name' => $p_item->item_name,
            'room_no' => $room_no,
            'unit_price' => floatval($p_item->item_price),
            'qty' => floatval($p_item->quantity),
            'amount' => floatval($p_item->subtotal)
        );
    }
} else {
    // Fallback parser for older legacy invoices without payment_items
    if ($payment->payment_from == 'appointment') {
        if (!empty($payment->category_name)) {
            $appointment_details = $this->db->get_where('appointment', array('id' => $payment->appointment_id))->row();
            $items[] = array(
                'index' => 1,
                'name' => $payment->category_name . (!empty($appointment_details->time_slot) ? ' (' . $appointment_details->time_slot . ')' : ''),
                'room_no' => !empty($appointment_details->doctorname) ? $appointment_details->doctorname : '-',
                'unit_price' => floatval($payment->gross_total),
                'qty' => 1,
                'amount' => floatval($payment->gross_total)
            );
        }
    } elseif ($payment->payment_from == 'admitted_patient_bed_medicine') {
        if (!empty($payment->category_name)) {
            $cats = explode('#', $payment->category_name);
            $idx = 0;
            foreach ($cats as $cat) {
                if (empty(trim($cat))) continue;
                $cat_new = explode('*', $cat);
                if (count($cat_new) >= 5) {
                    $idx++;
                    $items[] = array(
                        'index' => $idx,
                        'name' => $cat_new[1],
                        'room_no' => '-',
                        'unit_price' => floatval($cat_new[2]),
                        'qty' => floatval($cat_new[3]),
                        'amount' => floatval($cat_new[4])
                    );
                }
            }
        }
    } elseif ($payment->payment_from == 'admitted_patient_bed_service') {
        if (!empty($payment->category_name)) {
            $cats = explode('#', $payment->category_name);
            $idx = 0;
            foreach ($cats as $cat) {
                if (empty(trim($cat))) continue;
                $cat_new = explode('*', $cat);
                if (!empty($cat_new[0])) {
                    $idx++;
                    $pservice = $this->db->get_where('pservice', array('id' => $cat_new[0]))->row();
                    $s_name = !empty($pservice) ? $pservice->name : 'Service #' . $cat_new[0];
                    $price = floatval($cat_new[1] ?? 0);
                    $items[] = array(
                        'index' => $idx,
                        'name' => $s_name,
                        'room_no' => '-',
                        'unit_price' => $price,
                        'qty' => 1,
                        'amount' => $price
                    );
                }
            }
        }
    } else {
        if (!empty($payment->category_name)) {
            $cats = explode(',', $payment->category_name);
            $idx = 0;
            foreach ($cats as $cat) {
                if (empty(trim($cat))) continue;
                $parts = explode('*', $cat);
                if (!empty($parts[0])) {
                    $cat_info = $this->finance_model->getPaymentcategoryById($parts[0]);
                    $name = !empty($cat_info->category) ? $cat_info->category : (!empty($parts[2]) ? $parts[2] : 'Item #' . $parts[0]);
                    $room_no = !empty($cat_info->description) ? $cat_info->description : $name;
                    $price = isset($parts[1]) ? floatval($parts[1]) : 0;
                    $qty = isset($parts[3]) ? floatval($parts[3]) : 1;
                    $amount = $price * $qty;
                    if ($qty > 0) {
                        $idx++;
                        $items[] = array(
                            'index' => $idx,
                            'name' => $name,
                            'room_no' => $room_no,
                            'unit_price' => $price,
                            'qty' => $qty,
                            'amount' => $amount
                        );
                    }
                }
            }
        }
    }
}

// Financial Summary (Authoritative values from database)
$gross_amount = floatval($payment->amount);
$vat_percent = floatval(!empty($payment->vat_amount_percent) ? $payment->vat_amount_percent : 0);
$vat_amount = floatval(!empty($payment->vat) ? $payment->vat : 0);

$discount_percent = floatval(!empty($payment->percent_discount) ? $payment->percent_discount : 0);
$discount_amount = floatval(!empty($payment->flat_discount) ? $payment->flat_discount : (!empty($payment->discount) ? $payment->discount : 0));

$net_payable = floatval($payment->gross_total);
$amount_received = floatval($this->finance_model->getDepositAmountByPaymentId($payment->id));
$balance_due = max(0.00, $net_payable - $amount_received);

// Status Badge Determination
$is_cancelled = (strtolower($payment->status ?? '') === 'cancelled');
if ($is_cancelled) {
    $status_text = 'CANCELLED';
    $status_class = 'status-cancelled';
} elseif ($balance_due <= 0.009) {
    $status_text = 'PAID';
    $status_class = 'status-paid';
} elseif ($amount_received > 0.009) {
    $status_text = 'PARTIALLY PAID';
    $status_class = 'status-partial';
} else {
    $status_text = 'DUE';
    $status_class = 'status-due';
}

// Cashier Information
$cashier_name = '';
if (!empty($payment->user)) {
    $cashier_user = $this->db->get_where('users', array('id' => $payment->user))->row();
    if (!empty($cashier_user)) {
        $cashier_name = !empty($cashier_user->username) ? $cashier_user->username : trim(($cashier_user->first_name ?? '') . ' ' . ($cashier_user->last_name ?? ''));
    }
}

// Official Hospital Identity
if (!empty($settings->invoice_logo) && file_exists($settings->invoice_logo)) {
    $hospital_logo = $settings->invoice_logo;
} elseif (file_exists('uploads/logo-nonetext.png')) {
    $hospital_logo = 'uploads/logo-nonetext.png';
} elseif (file_exists('uploads/logo_1.png')) {
    $hospital_logo = 'uploads/logo_1.png';
} elseif (file_exists('uploads/logo.png')) {
    $hospital_logo = 'uploads/logo.png';
} else {
    $hospital_logo = !empty($settings->logo) ? $settings->logo : '';
}

$hospital_title = 'LIFECARE DIAGNOSTIC CENTER';
$hospital_bangla = 'লাইফ কেয়ার ডায়াগনস্টিক সেন্টার';
$hospital_address = 'Khaserhat Rastermatha, Charbata, Subarnachar, Noakhali';
$phone_1 = '01829 95 25 95';
$phone_2 = '01727 69 69 77';
?>

<!-- Modern Print & Screen CSS -->
<link rel="stylesheet" href="common/extranal/css/finance/modern_invoice.css?v=<?php echo time(); ?>">

<div class="content-wrapper bg-white" style="margin: 0; padding: 0;">
    <!-- Screen Action Toolbar (no-print) -->
    <div class="invoice-action-toolbar no-print" style="margin: 15px auto;">
        <div class="invoice-toolbar-left">
            <?php if ($payment->payment_from == 'payment' || empty($payment->payment_from)) { ?>
                <a href="finance/payment" class="invoice-btn-action invoice-btn-back">
                    <i class="fas fa-arrow-left"></i> <?php echo lang('back_to_payment_modules'); ?>
                </a>
            <?php } ?>

            <span class="invoice-status-badge <?php echo $status_class; ?>">
                <i class="fas fa-circle mr-1" style="font-size: 7px;"></i> <?php echo $status_text; ?>
            </span>
        </div>

        <div class="invoice-toolbar-right">
            <a href="javascript:void(0);" onclick="window.print();" class="invoice-btn-action invoice-btn-print">
                <i class="fas fa-print"></i> <?php echo lang('print'); ?>
            </a>
        </div>
    </div>

    <!-- A4 Invoice Paper Container -->
    <div class="invoice-container-wrapper">
        <div class="invoice-paper <?php echo $is_cancelled ? 'is-cancelled' : ''; ?>" id="printable-invoice">
            
            <!-- Cancelled Watermark Stamp -->
            <div class="invoice-cancelled-stamp">CANCELLED</div>

            <!-- 1. HEADER SECTION -->
            <header class="invoice-header">
                <!-- Left: Logo, Hospital Name, Bangla Name, Address, Phones -->
                <div class="invoice-header-brand-group">
                    <div class="invoice-brand-top">
                        <?php if (!empty($hospital_logo) && file_exists($hospital_logo)) { ?>
                            <img src="<?php echo $hospital_logo; ?>" alt="<?php echo html_escape($hospital_title); ?>" class="hospital-logo">
                        <?php } ?>
                        <div class="hospital-brand-titles">
                            <h1 class="hospital-brand-title"><?php echo html_escape($hospital_title); ?></h1>
                            <div class="hospital-brand-bangla"><?php echo html_escape($hospital_bangla); ?></div>
                        </div>
                    </div>

                    <div class="hospital-brand-address">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?php echo html_escape($hospital_address); ?></span>
                    </div>

                    <div class="hospital-brand-phones">
                        <span class="phone-item"><i class="fas fa-phone-alt"></i> <?php echo $phone_1; ?></span>
                        <span class="phone-separator">|</span>
                        <span class="phone-item"><i class="fas fa-phone-alt"></i> <?php echo $phone_2; ?></span>
                    </div>
                </div>

                <!-- Right: Large INVOICE Title & Metadata Table -->
                <div class="invoice-header-meta">
                    <div class="invoice-title-large">INVOICE</div>
                    <div class="invoice-type-pill">DIAGNOSTIC SERVICE</div>
                    
                    <table class="invoice-meta-table">
                        <tr>
                            <td class="meta-label">Invoice No</td>
                            <td class="meta-separator">:</td>
                            <td class="meta-value meta-value-number"><?php echo $vn; ?></td>
                        </tr>
                        <tr>
                            <td class="meta-label">Invoice Date</td>
                            <td class="meta-separator">:</td>
                            <td class="meta-value"><?php echo $invoice_date; ?></td>
                        </tr>
                        <tr>
                            <td class="meta-label">Print Date</td>
                            <td class="meta-separator">:</td>
                            <td class="meta-value"><?php echo $print_date; ?></td>
                        </tr>
                    </table>
                </div>
            </header>

            <!-- 2. PATIENT INFORMATION & BARCODES SECTION -->
            <div class="patient-visit-grid">
                <!-- Patient Info Card -->
                <div class="meta-card patient-card">
                    <div class="card-title">
                        <i class="fas fa-user-injured mr-1"></i> Patient Information
                    </div>
                    <div class="patient-grid">
                        <div class="grid-item">
                            <span class="label">Patient Name</span>
                            <span class="colon">:</span>
                            <span class="value font-weight-bold text-dark"><?php echo !empty($patient_name) ? html_escape($patient_name) : '-'; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">HN</span>
                            <span class="colon">:</span>
                            <span class="value font-monospace" style="font-family: monospace; font-size: 11px;"><?php echo $hn; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Phone</span>
                            <span class="colon">:</span>
                            <span class="value"><?php echo !empty($patient_phone) ? html_escape($patient_phone) : '-'; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">VN / Invoice</span>
                            <span class="colon">:</span>
                            <span class="value font-monospace" style="font-family: monospace; font-size: 11px;"><?php echo $vn; ?></span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Age / Gender</span>
                            <span class="colon">:</span>
                            <span class="value">
                                <?php 
                                $ag = [];
                                if (!empty($age_str)) $ag[] = $age_str;
                                if (!empty($gender_str)) $ag[] = $gender_str;
                                echo !empty($ag) ? html_escape(implode(' / ', $ag)) : '-';
                                ?>
                            </span>
                        </div>
                        <div class="grid-item">
                            <span class="label">Visit Date</span>
                            <span class="colon">:</span>
                            <span class="value"><?php echo $visit_date; ?></span>
                        </div>
                        <?php if (!empty($referrer_display)) { ?>
                            <div class="grid-item" style="grid-column: span 2;">
                                <span class="label">Referrer</span>
                                <span class="colon">:</span>
                                <span class="value"><?php echo html_escape($referrer_display); ?></span>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Barcodes Box -->
                <div class="meta-card barcode-card">
                    <div class="barcode-wrapper">
                        <div class="barcode-item">
                            <div class="barcode-title">VN Barcode</div>
                            <img src="<?php echo site_url('lab/barcode'); ?>?text=<?php echo $vn; ?>&print=false&size=30&sizefactor=1" alt="VN Barcode" class="barcode-img">
                            <div class="barcode-digits"><?php echo $vn; ?></div>
                        </div>
                        <div class="barcode-separator"></div>
                        <div class="barcode-item">
                            <div class="barcode-title">HN Barcode</div>
                            <img src="<?php echo site_url('lab/barcode'); ?>?text=<?php echo $hn; ?>&print=false&size=30&sizefactor=1" alt="HN Barcode" class="barcode-img">
                            <div class="barcode-digits"><?php echo $hn; ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. DOCTOR INFORMATION SECTION (DEDICATED FULL-WIDTH BAR) -->
            <!-- Prevents narrow column wrapping and displays full English professional details -->
            <div class="doctor-info-bar">
                <div class="doctor-header-line">
                    <span class="doctor-tag"><i class="fas fa-user-md"></i> Doctor :</span>
                    <?php if (!empty($doctor_details['name'])) { ?>
                        <span class="doc-name"><?php echo html_escape($doctor_details['name']); ?></span>
                        <?php if (!empty($doctor_details['department'])) { ?>
                            <span class="doc-dept-badge"><i class="fas fa-stethoscope"></i> <?php echo html_escape($doctor_details['department']); ?></span>
                        <?php } ?>
                    <?php } else { ?>
                        <span class="text-muted font-italic">Not Assigned / Self</span>
                    <?php } ?>
                </div>
                <?php if (!empty($doctor_details['qualifications']) || !empty($doctor_details['designation']) || !empty($doctor_details['institution'])) { ?>
                    <div class="doctor-sub-details">
                        <?php 
                        $doc_sub = [];
                        if (!empty($doctor_details['qualifications'])) $doc_sub[] = html_escape($doctor_details['qualifications']);
                        if (!empty($doctor_details['designation'])) $doc_sub[] = html_escape($doctor_details['designation']);
                        if (!empty($doctor_details['institution'])) $doc_sub[] = html_escape($doctor_details['institution']);
                        echo implode(' &bull; ', $doc_sub);
                        ?>
                    </div>
                <?php } ?>
            </div>

            <!-- 4. SERVICE / TEST TABLE -->
            <div class="invoice-items-table-wrapper">
                <table class="invoice-items-table">
                    <thead>
                        <tr>
                            <th class="col-num">#</th>
                            <th class="col-service"><?php echo lang('test'); ?> / <?php echo lang('service'); ?> <?php echo lang('name'); ?></th>
                            <th class="col-room">Service / Room</th>
                            <th class="col-price"><?php echo lang('unit_price'); ?></th>
                            <th class="col-qty"><?php echo lang('qty'); ?></th>
                            <th class="col-amount"><?php echo lang('amount'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($items)) {
                            foreach ($items as $row) { ?>
                                <tr>
                                    <td class="col-num"><?php echo $row['index']; ?></td>
                                    <td class="col-service"><?php echo html_escape($row['name']); ?></td>
                                    <td class="col-room"><?php echo html_escape($row['room_no']); ?></td>
                                    <td class="col-price"><?php echo $currency . ' ' . number_format($row['unit_price'], 2); ?></td>
                                    <td class="col-qty"><?php echo $row['qty']; ?></td>
                                    <td class="col-amount"><?php echo $currency . ' ' . number_format($row['amount'], 2); ?></td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="6" class="text-center py-3 text-muted">No diagnostic services or tests recorded on this invoice.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- 5. BOTTOM SECTION: NOTES & BILL SUMMARY -->
            <div class="invoice-bottom-grid">
                
                <!-- Left Column: Payment & Notes -->
                <div class="invoice-notes-card">
                    <div>
                        <div class="invoice-notes-header">
                            <i class="fas fa-file-invoice"></i> Payment &amp; Notes
                        </div>
                        
                        <div class="invoice-note-content">
                            <?php if (!empty(trim($payment->remarks ?? ''))) { ?>
                                <strong>Note:</strong> <?php echo nl2br(html_escape(trim($payment->remarks))); ?>
                            <?php } else { ?>
                                <span class="text-muted font-italic">No special clinical or billing instructions recorded.</span>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Bottom Area: Received With Thanks & Cashier Signature -->
                    <div class="invoice-notes-bottom">
                        <div class="received-thanks-badge">
                            Received With Thanks : <?php echo $currency . ' ' . number_format($amount_received, 2); ?>
                        </div>

                        <div class="cashier-signature-block">
                            <div class="signature-line"></div>
                            <div class="signature-label">Cashier Signature</div>
                            <?php if (!empty($cashier_name)) { ?>
                                <div class="cashier-name"><?php echo html_escape($cashier_name); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Bill Summary -->
                <div class="invoice-summary-card">
                    <div class="invoice-summary-header">
                        <span class="invoice-summary-title">Bill Summary</span>
                    </div>

                    <table class="invoice-summary-table">
                        <tr>
                            <td class="summary-label"><?php echo lang('gross_amount'); ?></td>
                            <td class="summary-colon">:</td>
                            <td class="summary-value"><?php echo $currency . ' ' . number_format($gross_amount, 2); ?></td>
                        </tr>
                        <?php if ($discount_amount > 0 || $discount_percent > 0) { ?>
                            <tr>
                                <td class="summary-label"><?php echo lang('discount'); ?> <?php if ($discount_percent > 0) { echo '(' . number_format($discount_percent, 2) . '%)'; } ?></td>
                                <td class="summary-colon">:</td>
                                <td class="summary-value">-<?php echo $currency . ' ' . number_format($discount_amount, 2); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($vat_amount > 0 || $vat_percent > 0) { ?>
                            <tr>
                                <td class="summary-label"><?php echo lang('vat'); ?> <?php if ($vat_percent > 0) { echo '(' . number_format($vat_percent, 2) . '%)'; } ?></td>
                                <td class="summary-colon">:</td>
                                <td class="summary-value"><?php echo $currency . ' ' . number_format($vat_amount, 2); ?></td>
                            </tr>
                        <?php } ?>
                        
                        <!-- Highlighted Net Payable Row -->
                        <tr class="summary-row-payable">
                            <td class="summary-label">Net Payable</td>
                            <td class="summary-colon">:</td>
                            <td class="summary-value"><?php echo $currency . ' ' . number_format($net_payable, 2); ?></td>
                        </tr>

                        <tr>
                            <td class="summary-label"><?php echo lang('amount_received'); ?></td>
                            <td class="summary-colon">:</td>
                            <td class="summary-value"><?php echo $currency . ' ' . number_format($amount_received, 2); ?></td>
                        </tr>

                        <!-- Highlighted Balance Due Row -->
                        <tr class="summary-row-due">
                            <td class="summary-label">Due Amount</td>
                            <td class="summary-colon">:</td>
                            <td class="summary-value <?php echo ($balance_due > 0.009) ? 'due-positive' : 'due-zero'; ?>">
                                <?php echo $currency . ' ' . number_format($balance_due, 2); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- 6. FOOTER SECTION -->
            <footer class="invoice-footer-container">
                <div class="footer-thankyou">Thank you for choosing LifeCare Diagnostic Center.</div>
                <div class="footer-address"><?php echo html_escape($hospital_address); ?></div>
                <div class="footer-contact">
                    <i class="fas fa-phone-alt"></i> <?php echo $phone_1; ?> &nbsp;|&nbsp; <i class="fas fa-phone-alt"></i> <?php echo $phone_2; ?>
                </div>
                <?php if (!empty($settings->footer_invoice_message)) { ?>
                    <div class="footer-note">
                        <?php echo html_escape($settings->footer_invoice_message); ?>
                    </div>
                <?php } ?>
            </footer>

        </div> <!-- /.invoice-paper -->
    </div> <!-- /.invoice-container-wrapper -->
</div> <!-- /.content-wrapper -->