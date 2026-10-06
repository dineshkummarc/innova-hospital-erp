<?php
/**
 * Clean Demo Invoices & Patients Script
 * LifeCare Hospital ERP
 */

// Determine project root
$rootDir = __DIR__;
$envFile = $rootDir . '/.env';

$dbHost = '127.0.0.1';
$dbPort = 3306;
$dbName = 'lifecare';
$dbUser = 'root';
$dbPass = '';

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) continue;
        if (strpos($line, '=') !== false) {
            list($key, $val) = explode('=', $line, 2);
            $key = trim($key);
            $val = trim($val, " \t\n\r\0\x0B\"'");
            if ($key === 'DB_HOST') $dbHost = $val;
            if ($key === 'DB_PORT') $dbPort = (int)$val;
            if ($key === 'DB_NAME') $dbName = $val;
            if ($key === 'DB_USER') $dbUser = $val;
            if ($key === 'DB_PASS') $dbPass = $val;
        }
    }
}

// Connect to MySQL
$mysqli = @new mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);
if ($mysqli->connect_error) {
    echo "❌ Error connecting to database: " . $mysqli->connect_error . "\n";
    exit(1);
}

$mysqli->set_charset("utf8mb4");

echo "=====================================================\n";
echo "    🧹 LifeCare ERP - Demo Data Cleaner              \n";
echo "=====================================================\n";
echo "Database: $dbName ($dbHost:$dbPort)\n\n";

// Target hospital ID for the demo hospital (Lifecare Diagnostic, ID 98)
$hospitalId = '98';

// 1. Fetch patient IDs
$patientIds = [];
$ionUserIds = [];
$res = $mysqli->query("SELECT id, ion_user_id, name FROM patient WHERE hospital_id = '$hospitalId'");
if ($res) {
    while ($row = $res->fetch_assoc()) {
        $patientIds[] = $row['id'];
        if (!empty($row['ion_user_id'])) {
            $ionUserIds[] = (int)$row['ion_user_id'];
        }
    }
}

$patientCount = count($patientIds);
echo "🔍 Found $patientCount demo patients for hospital #$hospitalId\n";

// 2. Fetch payment (invoice) IDs
$paymentIds = [];
$resPay = $mysqli->query("SELECT id FROM payment WHERE hospital_id = '$hospitalId'");
if ($resPay) {
    while ($row = $resPay->fetch_assoc()) {
        $paymentIds[] = $row['id'];
    }
}
$invoiceCount = count($paymentIds);
echo "🔍 Found $invoiceCount demo invoices for hospital #$hospitalId\n\n";

// Disable foreign key checks temporarily for clean cascading removal
$mysqli->query("SET FOREIGN_KEY_CHECKS = 0;");

// -------------------------------------------------------------
// A. REMOVE INVOICES & FINANCIAL RECORDS
// -------------------------------------------------------------
if (!empty($paymentIds)) {
    $payIdList = implode("','", $paymentIds);
    $mysqli->query("DELETE FROM payment_items WHERE payment_id IN ('$payIdList')");
    $mysqli->query("DELETE FROM patient_deposit WHERE payment_id IN ('$payIdList') OR hospital_id = '$hospitalId'");
} else {
    $mysqli->query("DELETE FROM patient_deposit WHERE hospital_id = '$hospitalId'");
}

$delInvoices = $mysqli->query("DELETE FROM payment WHERE hospital_id = '$hospitalId'");
$delDraft = $mysqli->query("DELETE FROM draft_payment WHERE hospital_id = '$hospitalId'");
echo "✔ Removed $invoiceCount invoices from `payment` and related tables.\n";

// -------------------------------------------------------------
// B. REMOVE PATIENTS & ALL RELATED MEDICAL/BED/LAB RECORDS
// -------------------------------------------------------------
if (!empty($patientIds)) {
    $patIdList = implode("','", $patientIds);
    $mysqli->query("DELETE FROM medical_history WHERE hospital_id = '$hospitalId' OR patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM patient_material WHERE hospital_id = '$hospitalId' OR patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM vital_signs WHERE patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM prescription WHERE hospital_id = '$hospitalId' OR patient IN ('$patIdList')");
    $mysqli->query("DELETE FROM appointment WHERE hospital_id = '$hospitalId' OR patient IN ('$patIdList')");
    $mysqli->query("DELETE FROM alloted_bed WHERE hospital_id = '$hospitalId' OR patient IN ('$patIdList')");
    $mysqli->query("DELETE FROM bed_diagnostic WHERE hospital_id = '$hospitalId' OR patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM bed_medicine WHERE hospital_id = '$hospitalId' OR patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM bed_service WHERE hospital_id = '$hospitalId' OR patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM lab WHERE hospital_id = '$hospitalId' OR patient IN ('$patIdList')");
    $mysqli->query("DELETE FROM diagnostic_report WHERE hospital_id = '$hospitalId' OR patient IN ('$patIdList')");
    $mysqli->query("DELETE FROM treatment_plans WHERE patient_id IN ('$patIdList')");
    $mysqli->query("DELETE FROM ai_patient_overviews WHERE patient_id IN ('$patIdList')");
}

$delPatients = $mysqli->query("DELETE FROM patient WHERE hospital_id = '$hospitalId'");
echo "✔ Removed $patientCount patients from `patient` and related medical tables.\n";

// -------------------------------------------------------------
// C. REMOVE PATIENT USER LOGINS (if any)
// -------------------------------------------------------------
if (!empty($ionUserIds)) {
    $userList = implode(",", $ionUserIds);
    $mysqli->query("DELETE FROM users_groups WHERE user_id IN ($userList)");
    $mysqli->query("DELETE FROM users WHERE id IN ($userList)");
    echo "✔ Cleaned up associated patient user accounts in `users`.\n";
}

$mysqli->query("SET FOREIGN_KEY_CHECKS = 1;");

echo "\n=====================================================\n";
echo "🎉 DEMO DATA CLEANUP COMPLETED SUCCESSFULLY!\n";
echo "   Invoices Removed: $invoiceCount\n";
echo "   Patients Removed: $patientCount\n";
echo "=====================================================\n";
