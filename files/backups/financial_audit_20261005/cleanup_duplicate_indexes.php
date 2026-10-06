<?php
$db = new mysqli('127.0.0.1', 'root', '', 'lifecare', 3306);

// Inspect payment indexes
$res = $db->query("SHOW INDEX FROM `payment`");
$indexes = [];
while ($r = $res->fetch_assoc()) {
    $indexes[$r['Key_name']][] = $r['Column_name'];
}
print_r($indexes);

// If hospital_id_2 exists and is identical to hospital_id, drop duplicate
if (isset($indexes['hospital_id_2']) && isset($indexes['hospital_id'])) {
    echo "Dropping duplicate index hospital_id_2...\n";
    $db->query("ALTER TABLE `payment` DROP INDEX `hospital_id_2`");
    echo "Result: " . ($db->error ? $db->error : "SUCCESS") . "\n";
}

// If secondary index 'id' exists alongside PRIMARY, drop redundant index
if (isset($indexes['id']) && isset($indexes['PRIMARY'])) {
    echo "Dropping redundant secondary index 'id' on payment...\n";
    $db->query("ALTER TABLE `payment` DROP INDEX `id`");
    echo "Result: " . ($db->error ? $db->error : "SUCCESS") . "\n";
}
