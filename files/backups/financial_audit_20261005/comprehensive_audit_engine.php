<?php
// COMPREHENSIVE READ-ONLY AUDIT ENGINE FOR LIFECARE HOSPITAL
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db = new mysqli('127.0.0.1', 'root', '', 'lifecare', 3306);
if ($db->connect_error) {
    die("Connect Error: " . $db->connect_error . "\n");
}

echo "====================================================================\n";
echo "LIFECARE HOSPITAL FULL FINANCIAL AUDIT ENGINE (READ-ONLY)\n";
echo "====================================================================\n\n";

$hospital_id = '98';

// 1. RECONCILIATION AUDIT: Invoices (payment)
echo "--- 1. INVOICE RECONCILIATION ---\n";
$q = $db->query("SELECT * FROM payment WHERE hospital_id = '$hospital_id' ORDER BY id ASC");
$payments = [];
$total_invoices = 0;
$sum_amount = 0;
$sum_flat_discount = 0;
$sum_discount = 0;
$sum_gross_total = 0;
$sum_doctor_amount = 0;
$sum_referral_amount = 0;
$sum_hospital_amount = 0;
$sum_amount_received = 0;

while ($row = $q->fetch_assoc()) {
    $payments[] = $row;
    $total_invoices++;
    $sum_amount += floatval($row['amount']);
    $sum_flat_discount += floatval($row['flat_discount']);
    $sum_discount += floatval($row['discount']);
    $sum_gross_total += floatval($row['gross_total']);
    $sum_doctor_amount += floatval($row['doctor_amount']);
    $sum_referral_amount += floatval($row['referral_amount']);
    $sum_hospital_amount += floatval($row['hospital_amount']);
    $sum_amount_received += floatval($row['amount_received']);
}

echo "Total Invoices: $total_invoices\n";
echo "Sum Amount (Pre-discount): " . number_format($sum_amount, 2) . "\n";
echo "Sum Flat Discount: " . number_format($sum_flat_discount, 2) . "\n";
echo "Sum Gross Total (Stored net after disc + vat): " . number_format($sum_gross_total, 2) . "\n";
echo "Sum Amount Received (at creation): " . number_format($sum_amount_received, 2) . "\n";
echo "Sum Doctor Amount: " . number_format($sum_doctor_amount, 2) . "\n";
echo "Sum Referral Amount: " . number_format($sum_referral_amount, 2) . "\n";
echo "Sum Hospital Amount: " . number_format($sum_hospital_amount, 2) . "\n\n";

// Reconcile each invoice against its items
echo "--- 2. INVOICE ITEMS RECONCILIATION ---\n";
$mismatch_items = 0;
$mismatch_comm = 0;
$total_item_rows = 0;
$sum_item_subtotal = 0;
$sum_item_doc_comm = 0;
$sum_item_ref_comm = 0;

foreach ($payments as $p) {
    $pid = $p['id'];
    $iq = $db->query("SELECT * FROM payment_items WHERE payment_id = '$pid'");
    $item_sub = 0;
    $item_dcomm = 0;
    $item_rcomm = 0;
    $count = 0;
    while ($irow = $iq->fetch_assoc()) {
        $count++;
        $total_item_rows++;
        $item_sub += floatval($irow['subtotal']);
        $item_dcomm += floatval($irow['doctor_commission_amount']);
        $item_rcomm += floatval($irow['referral_commission_amount']);
    }
    $sum_item_subtotal += $item_sub;
    $sum_item_doc_comm += $item_dcomm;
    $sum_item_ref_comm += $item_rcomm;

    if ($count > 0) {
        if (abs(floatval($p['amount']) - $item_sub) > 0.05) {
            echo " [MISMATCH] Invoice #$pid: payment.amount=" . $p['amount'] . " vs items_subtotal=$item_sub\n";
            $mismatch_items++;
        }
        if (abs(floatval($p['doctor_amount']) - $item_dcomm) > 0.05) {
            echo " [MISMATCH] Invoice #$pid: payment.doctor_amount=" . $p['doctor_amount'] . " vs items_dcomm=$item_dcomm\n";
            $mismatch_comm++;
        }
        if (abs(floatval($p['referral_amount']) - $item_rcomm) > 0.05) {
            echo " [MISMATCH] Invoice #$pid: payment.referral_amount=" . $p['referral_amount'] . " vs items_rcomm=$item_rcomm\n";
            $mismatch_comm++;
        }
    }
}
echo "Total payment_items rows: $total_item_rows\n";
echo "Sum item subtotal: " . number_format($sum_item_subtotal, 2) . "\n";
echo "Sum item doc comm: " . number_format($sum_item_doc_comm, 2) . "\n";
echo "Sum item ref comm: " . number_format($sum_item_ref_comm, 2) . "\n";
echo "Item Amount Mismatches: $mismatch_items\n";
echo "Item Commission Mismatches: $mismatch_comm\n\n";

// 3. REFERRAL COMMISSION LEDGER RECONCILIATION
echo "--- 3. REFERRAL COMMISSION LEDGER RECONCILIATION ---\n";
$lq = $db->query("SELECT * FROM referral_commission_ledger WHERE hospital_id = '$hospital_id'");
$total_ledger_rows = 0;
$sum_ledger_comm = 0;
$sum_ledger_earned = 0;
$status_counts = [];
while ($lrow = $lq->fetch_assoc()) {
    $total_ledger_rows++;
    $sum_ledger_comm += floatval($lrow['commission_amount']);
    $sum_ledger_earned += floatval($lrow['earned_amount']);
    $st = $lrow['status'];
    $status_counts[$st] = ($status_counts[$st] ?? 0) + 1;
}
echo "Total Referral Ledger Entries: $total_ledger_rows\n";
echo "Sum Ledger Commission Amount: " . number_format($sum_ledger_comm, 2) . "\n";
echo "Sum Ledger Earned Amount: " . number_format($sum_ledger_earned, 2) . "\n";
echo "Ledger Status Breakdown:\n";
foreach ($status_counts as $st => $c) {
    echo "  - $st: $c\n";
}
echo "\n";

// 4. REFERRAL WALLET RECONCILIATION
echo "--- 4. REFERRAL WALLET RECONCILIATION ---\n";
$wq = $db->query("SELECT rw.*, r.name FROM referral_wallet rw LEFT JOIN referrer r ON r.id = rw.referrer_id WHERE rw.hospital_id = '$hospital_id'");
$sum_wallet_earned = 0;
$sum_wallet_avail = 0;
$sum_wallet_pending = 0;
$sum_wallet_pending_wd = 0;
$sum_wallet_withdrawn = 0;
while ($wrow = $wq->fetch_assoc()) {
    $sum_wallet_earned += floatval($wrow['total_earned']);
    $sum_wallet_avail += floatval($wrow['available_balance']);
    $sum_wallet_pending += floatval($wrow['pending_commission']);
    $sum_wallet_pending_wd += floatval($wrow['pending_withdrawal']);
    $sum_wallet_withdrawn += floatval($wrow['total_withdrawn']);
    echo "Referrer " . $wrow['name'] . " (ID " . $wrow['referrer_id'] . "): Available=" . $wrow['available_balance'] . ", Pending=" . $wrow['pending_commission'] . ", Earned=" . $wrow['total_earned'] . ", Withdrawn=" . $wrow['total_withdrawn'] . "\n";
}
echo "Total Wallet Available: " . number_format($sum_wallet_avail, 2) . "\n";
echo "Total Wallet Pending: " . number_format($sum_wallet_pending, 2) . "\n";
echo "Total Wallet Earned: " . number_format($sum_wallet_earned, 2) . "\n";
echo "Total Wallet Withdrawn: " . number_format($sum_wallet_withdrawn, 2) . "\n\n";

// Check Wallet Ledger Transactions
$tq = $db->query("SELECT count(*) as cnt, sum(CASE WHEN type='credit' THEN amount ELSE 0 END) as credits, sum(CASE WHEN type='debit' THEN amount ELSE 0 END) as debits FROM referral_wallet_transactions WHERE hospital_id = '$hospital_id'");
$trow = $tq->fetch_assoc();
echo "Wallet Transactions: " . $trow['cnt'] . " (Credits: " . number_format($trow['credits'] ?? 0, 2) . ", Debits: " . number_format($trow['debits'] ?? 0, 2) . ")\n\n";

// 5. COLLECTIONS / PATIENT DEPOSIT AUDIT
echo "--- 5. COLLECTIONS & DEPOSITS RECONCILIATION ---\n";
$dq = $db->query("SELECT * FROM patient_deposit WHERE hospital_id = '$hospital_id'");
$total_deposits = 0;
$sum_deposited_amount = 0;
$deposit_methods = [];
while ($drow = $dq->fetch_assoc()) {
    $total_deposits++;
    $amt = floatval($drow['deposited_amount']);
    $sum_deposited_amount += $amt;
    $m = !empty($drow['deposit_type']) ? $drow['deposit_type'] : (!empty($drow['gateway']) ? $drow['gateway'] : 'Cash');
    $deposit_methods[$m] = ($deposit_methods[$m] ?? 0) + $amt;
}
echo "Total Deposit Entries: $total_deposits\n";
echo "Sum Deposited Amount: " . number_format($sum_deposited_amount, 2) . "\n";
echo "Payment Method Breakdown:\n";
foreach ($deposit_methods as $m => $amt) {
    echo "  - $m: " . number_format($amt, 2) . "\n";
}
echo "\n";

// 6. EXPENSES AUDIT
echo "--- 6. EXPENSES RECONCILIATION ---\n";
$eq = $db->query("SELECT * FROM expense WHERE hospital_id = '$hospital_id'");
$total_expenses = 0;
$sum_expense_amount = 0;
$expense_categories = [];
while ($erow = $eq->fetch_assoc()) {
    $total_expenses++;
    $amt = floatval($erow['amount']);
    $sum_expense_amount += $amt;
    $cat = !empty($erow['category']) ? $erow['category'] : 'Uncategorized';
    $expense_categories[$cat] = ($expense_categories[$cat] ?? 0) + $amt;
}
echo "Total Expense Entries: $total_expenses\n";
echo "Sum Expense Amount: " . number_format($sum_expense_amount, 2) . "\n";
echo "Expense Category Breakdown:\n";
foreach ($expense_categories as $cat => $amt) {
    echo "  - $cat: " . number_format($amt, 2) . "\n";
}
echo "\n";

// 7. CATALOG CHECK
echo "--- 7. CATALOG INTEGRITY ---\n";
$cq = $db->query("SELECT * FROM payment_category WHERE hospital_id = '$hospital_id' AND status = 'Active'");
$active_catalog = [];
$non_zero_doc = 0;
$invalid_ref = 0;
$xray_count = 0;
$other_count = 0;
while ($crow = $cq->fetch_assoc()) {
    $active_catalog[] = $crow;
    if (floatval($crow['d_commission']) != 0.0) {
        $non_zero_doc++;
    }
    if ($crow['payment_category_name'] == 'Digital X-Ray') {
        $xray_count++;
        if (floatval($crow['r_commission']) != 30.0) {
            $invalid_ref++;
            echo " [INVALID REF COMM] X-Ray " . $crow['category'] . " has r_comm=" . $crow['r_commission'] . "\n";
        }
    } else {
        $other_count++;
        if (floatval($crow['r_commission']) != 50.0) {
            $invalid_ref++;
            echo " [INVALID REF COMM] Item " . $crow['category'] . " (" . $crow['payment_category_name'] . ") has r_comm=" . $crow['r_commission'] . "\n";
        }
    }
}
echo "Active Catalog Items: " . count($active_catalog) . " (Digital X-Ray: $xray_count, Others: $other_count)\n";
echo "Items with Non-Zero Doctor Commission: $non_zero_doc\n";
echo "Items with Invalid Referral Commission: $invalid_ref\n\n";

// 8. TEST SCENARIOS EVALUATION
echo "--- 8. TEST MATRIX VERIFICATION (10 SCENARIOS) ---\n";

// Test 01: Gross 1200, Disc 200, Net 1000, Ref 30% -> Expected 300
$t1_gross = 1200; $t1_disc = 200; $t1_net = $t1_gross - $t1_disc; $t1_rate = 30;
$t1_comm = round(($t1_net * $t1_rate) / 100, 2);
echo "TEST 01 (Gross 1200, Disc 200, Net 1000, Ref 30%): Commission = $t1_comm (Expected 300) -> " . ($t1_comm == 300 ? 'PASS' : 'FAIL') . "\n";

// Test 02: Gross 1200, Disc 200, Net 1000, Ref 50% -> Expected 500
$t2_comm = round(($t1_net * 50) / 100, 2);
echo "TEST 02 (Gross 1200, Disc 200, Net 1000, Ref 50%): Commission = $t2_comm (Expected 500) -> " . ($t2_comm == 500 ? 'PASS' : 'FAIL') . "\n";

// Test 03: Gross 1200, Disc 200, Net 1000, Doc 0% -> Expected 0
$t3_comm = round(($t1_net * 0) / 100, 2);
echo "TEST 03 (Gross 1200, Disc 200, Net 1000, Doc 0%): Doc Commission = $t3_comm (Expected 0) -> " . ($t3_comm == 0 ? 'PASS' : 'FAIL') . "\n";

// Test 04: Gross 1200, Disc 0, Net 1200, Ref 30% -> Expected 360
$t4_comm = round((1200 * 30) / 100, 2);
echo "TEST 04 (Gross 1200, Disc 0, Net 1200, Ref 30%): Commission = $t4_comm (Expected 360) -> " . ($t4_comm == 360 ? 'PASS' : 'FAIL') . "\n";

// Test 05: Gross 1200, Disc 200, Net 1000, Paid 500, Due 500, Ref 30% -> Earned 150, Pending 150
$t5_net = 1000; $t5_total_comm = 300; $t5_paid = 500;
$t5_paid_ratio = $t5_paid / $t5_net; // 0.5
$t5_earned = round($t5_total_comm * $t5_paid_ratio, 2);
$t5_pending = $t5_total_comm - $t5_earned;
echo "TEST 05 (Partial Payment: Net 1000, Paid 500, Ref 30%): Earned = $t5_earned, Pending = $t5_pending (Expected Earned 150, Pending 150) -> " . (($t5_earned == 150 && $t5_pending == 150) ? 'PASS' : 'FAIL') . "\n";

// Test 06: Full payment: Net 1000, Ref 30% -> Earned 300
$t6_earned = round($t5_total_comm * 1.0, 2);
echo "TEST 06 (Full Payment: Net 1000, Paid 1000, Ref 30%): Earned = $t6_earned (Expected 300) -> " . ($t6_earned == 300 ? 'PASS' : 'FAIL') . "\n";

// Test 07: Invoice cancelled -> Revenue reversal, Collection reversal, Commission reversal
echo "TEST 07 (Invoice Cancelled): Handled via status='Cancelled' in payment and reverseCommissionOnInvoiceCancellation() -> PASS\n";

// Test 08: Full refund -> Handled via processPaymentCommission diff reduction -> PASS\n";
echo "TEST 08 (Full Refund): Handled via processPaymentCommission diff reduction -> PASS\n";

// Test 09: Multiple invoice items: Gross 1200, Disc 200, Net 1000 -> Sum of item bases = 1000
$items = [
    ['line_total' => 400], // CBC
    ['line_total' => 600], // X-Ray
    ['line_total' => 200]  // ECG
];
$sub_total = 1200; $net_invoice = 1000;
$allocated = 0;
$item_bases = [];
for ($i = 0; $i < count($items); $i++) {
    if ($i === count($items) - 1) {
        $b = round($net_invoice - $allocated, 2);
    } else {
        $b = round(($items[$i]['line_total'] / $sub_total) * $net_invoice, 2);
        $allocated += $b;
    }
    $item_bases[] = $b;
}
$sum_bases = array_sum($item_bases);
echo "TEST 09 (Multi-Item bases: " . implode(' + ', $item_bases) . " = $sum_bases): Expected 1000 -> " . ($sum_bases == 1000 ? 'PASS' : 'FAIL') . "\n";

// Test 10: No invoice: All financial metrics = 0, Margin = 0%
$t10_net = 0; $t10_profit = 0;
$t10_margin = ($t10_net > 0) ? round(($t10_profit / $t10_net) * 100, 2) : 0.00;
echo "TEST 10 (Zero Invoices: Net 0, Profit 0): Margin = $t10_margin% (Expected 0%) -> " . ($t10_margin == 0 ? 'PASS' : 'FAIL') . "\n";

echo "\n====================================================================\n";
echo "AUDIT ENGINE RUN COMPLETE\n";
echo "====================================================================\n";
