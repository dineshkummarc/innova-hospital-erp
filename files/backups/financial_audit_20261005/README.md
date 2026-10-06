# LifeCare Hospital - Financial Audit & Migration Archive
Date: 05 October 2026

This archive contains reusable migration scripts, index schemas, timezone synchronization, and the master 20-point test verification suite developed during the Financial System Audit.

## Preserved Artifacts:
- `run_audit_006_migration.php`: Safely migrates monetary varchar columns to DECIMAL(10,2).
- `apply_indexes.php`: Applies performance indexes (idx_payment_hosp_date, idx_patient_deposit_payment_id, idx_expense_hosp_date).
- `cleanup_duplicate_indexes.php`: Cleans redundant duplicate indexes.
- `sync_timezone.php`: Synchronizes hospital timezone to Asia/Dhaka.
- `run_full_master_suite.php`: Master verification suite verifying TEST 01 through TEST 20.
- `comprehensive_audit_engine.php`: Comprehensive audit inspection engine.
