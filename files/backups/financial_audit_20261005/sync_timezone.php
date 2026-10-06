<?php
$db = new mysqli('127.0.0.1', 'root', '', 'lifecare', 3306);

echo "=== AUDIT-009: TIMEZONE SYNCHRONIZATION ===\n";

// Update settings for hospital 98 to Asia/Dhaka
$db->query("UPDATE `settings` SET `timezone` = 'Asia/Dhaka' WHERE `hospital_id` = '98'");
echo "Hospital 98 updated to Asia/Dhaka: " . ($db->error ? $db->error : "OK") . "\n";

// Update superadmin to Asia/Dhaka if empty/UTC
$db->query("UPDATE `settings` SET `timezone` = 'Asia/Dhaka' WHERE (`hospital_id` = 'superadmin' OR `hospital_id` IS NULL) AND (`timezone` IS NULL OR `timezone` = '' OR `timezone` = 'UTC')");
echo "Superadmin updated to Asia/Dhaka: " . ($db->error ? $db->error : "OK") . "\n";

// Verify settings
$res = $db->query("SELECT id, hospital_id, timezone FROM settings WHERE hospital_id IN ('98', 'superadmin')");
while ($r = $res->fetch_assoc()) {
    echo sprintf("Hospital: %-15s Timezone: %s\n", $r['hospital_id'], $r['timezone']);
}
