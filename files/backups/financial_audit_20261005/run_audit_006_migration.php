<?php
$db = new mysqli('127.0.0.1', 'root', '', 'lifecare', 3306);
if ($db->connect_error) {
    die("Connect error: " . $db->connect_error);
}

echo "=== AUDIT-006: MONETARY SCHEMA NORMALIZATION ===\n\n";

$alters = [
    "ALTER TABLE `payment` MODIFY COLUMN `amount` DECIMAL(10,2) NULL DEFAULT 0.00",
    "ALTER TABLE `payment` MODIFY COLUMN `gross_total` DECIMAL(10,2) NULL DEFAULT 0.00",
    "ALTER TABLE `payment` MODIFY COLUMN `hospital_amount` DECIMAL(10,2) NULL DEFAULT 0.00",
    "ALTER TABLE `payment` MODIFY COLUMN `doctor_amount` DECIMAL(10,2) NULL DEFAULT 0.00",
    "ALTER TABLE `expense` MODIFY COLUMN `amount` DECIMAL(10,2) NULL DEFAULT 0.00",
    "ALTER TABLE `patient_deposit` MODIFY COLUMN `deposited_amount` DECIMAL(10,2) NULL DEFAULT 0.00"
];

foreach ($alters as $sql) {
    echo "Running: $sql\n";
    if ($db->query($sql)) {
        echo " -> OK\n";
    } else {
        echo " -> ERROR: " . $db->error . "\n";
        exit(1);
    }
}

echo "\n=== POST-MIGRATION SCHEMA CHECK ===\n";

$checks = [
    ['payment', 'amount'],
    ['payment', 'gross_total'],
    ['payment', 'hospital_amount'],
    ['payment', 'doctor_amount'],
    ['expense', 'amount'],
    ['patient_deposit', 'deposited_amount']
];

foreach ($checks as $c) {
    $tbl = $c[0];
    $col = $c[1];
    $res = $db->query("SHOW COLUMNS FROM `$tbl` LIKE '$col'")->fetch_assoc();
    echo sprintf("Table: %-15s Column: %-18s Type: %-15s Null: %-5s Default: %s\n",
        $tbl, $col, $res['Type'], $res['Null'], $res['Default'] ?? 'NULL'
    );
}

echo "\n=== POST-MIGRATION TOTALS VERIFICATION ===\n";

$p_res = $db->query("SELECT 
    SUM(amount) as sum_amount,
    SUM(gross_total) as sum_gross,
    SUM(hospital_amount) as sum_hosp,
    SUM(doctor_amount) as sum_doc
FROM payment")->fetch_assoc();
print_r($p_res);

$e_res = $db->query("SELECT 
    SUM(amount) as sum_expense
FROM expense")->fetch_assoc();
print_r($e_res);

$d_res = $db->query("SELECT 
    SUM(deposited_amount) as sum_deposit
FROM patient_deposit")->fetch_assoc();
print_r($d_res);

// Verify exact match
$expected = [
    'sum_amount' => '21000.00',
    'sum_gross' => '20950.00',
    'sum_hosp' => '18910.00',
    'sum_doc' => '540.00',
    'sum_expense' => '1050.00',
    'sum_deposit' => '9750.00'
];

$match = true;
foreach ($expected as $k => $val) {
    $actual = $p_res[$k] ?? ($e_res[$k] ?? ($d_res[$k] ?? null));
    if (number_format(floatval($actual), 2, '.', '') !== $val) {
        echo "MISMATCH on $k: expected $val, got $actual\n";
        $match = false;
    }
}

echo "\nAUDIT-006 RESULT: " . ($match ? "PASS" : "FAIL") . "\n";
