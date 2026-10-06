<?php
$db = new mysqli('127.0.0.1', 'root', '', 'lifecare', 3306);
if ($db->connect_error) {
    die("Connect error: " . $db->connect_error);
}

echo "=== AUDIT-007: DATABASE INDEXING ===\n";

function indexExists($db, $table, $index_name) {
    $res = $db->query("SHOW INDEX FROM `$table` WHERE Key_name = '$index_name'");
    return ($res && $res->num_rows > 0);
}

// 1. payment(hospital_id, date)
if (!indexExists($db, 'payment', 'idx_payment_hosp_date')) {
    echo "Adding index idx_payment_hosp_date ON payment(hospital_id, date)...\n";
    $db->query("ALTER TABLE `payment` ADD INDEX `idx_payment_hosp_date` (`hospital_id`, `date`)");
    echo "Added: " . ($db->error ? $db->error : "SUCCESS") . "\n";
} else {
    echo "Index idx_payment_hosp_date already exists.\n";
}

// 2. patient_deposit(payment_id)
if (!indexExists($db, 'patient_deposit', 'idx_patient_deposit_payment_id')) {
    echo "Adding index idx_patient_deposit_payment_id ON patient_deposit(payment_id)...\n";
    $db->query("ALTER TABLE `patient_deposit` ADD INDEX `idx_patient_deposit_payment_id` (`payment_id`)");
    echo "Added: " . ($db->error ? $db->error : "SUCCESS") . "\n";
} else {
    echo "Index idx_patient_deposit_payment_id already exists.\n";
}

// 3. expense(hospital_id, date)
if (!indexExists($db, 'expense', 'idx_expense_hosp_date')) {
    echo "Adding index idx_expense_hosp_date ON expense(hospital_id, date)...\n";
    $db->query("ALTER TABLE `expense` ADD INDEX `idx_expense_hosp_date` (`hospital_id`, `date`)");
    echo "Added: " . ($db->error ? $db->error : "SUCCESS") . "\n";
} else {
    echo "Index idx_expense_hosp_date already exists.\n";
}

// EXPLAIN plan verifications
echo "\n=== EXPLAIN QUERY VERIFICATION ===\n";

$queries = [
    "Monthly Report Payments" => "EXPLAIN SELECT * FROM payment WHERE hospital_id = '98' AND date >= 1700000000 AND date <= 1705000000",
    "Monthly Report Expenses" => "EXPLAIN SELECT * FROM expense WHERE hospital_id = '98' AND date >= 1700000000 AND date <= 1705000000",
    "Deposit Aggregation"    => "EXPLAIN SELECT * FROM patient_deposit WHERE payment_id = 10"
];

$all_good = true;
foreach ($queries as $label => $q) {
    echo "\n--- $label ---\n";
    $res = $db->query($q);
    while ($row = $res->fetch_assoc()) {
        echo sprintf("Table: %-15s | Type: %-8s | Possible Keys: %-30s | Key Used: %-25s | Rows: %s\n",
            $row['table'], $row['type'], $row['possible_keys'] ?? 'none', $row['key'] ?? 'none', $row['rows']
        );
        if (empty($row['key'])) {
            $all_good = false;
        }
    }
}

echo "\nTEST AUDIT-007 RESULT: " . ($all_good ? "PASS" : "FAIL") . "\n";
