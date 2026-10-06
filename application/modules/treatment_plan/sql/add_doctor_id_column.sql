-- Add doctor_id column to existing treatment_plans table
-- Run this SQL if the table already exists without doctor_id column

ALTER TABLE `treatment_plans` 
ADD COLUMN `doctor_id` int(11) NOT NULL AFTER `patient_id`,
ADD KEY `doctor_id` (`doctor_id`);
