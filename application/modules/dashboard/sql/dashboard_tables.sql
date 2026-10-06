-- ===================================================================
-- DASHBOARD MODULE DATABASE SCHEMA
-- Hospital Management System - Dashboard Module
-- ===================================================================

-- Create Dashboard Settings Table
CREATE TABLE IF NOT EXISTS `dashboard_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dashboard_type` enum('executive','clinical','financial','operational') NOT NULL,
  `widgets` text DEFAULT NULL,
  `layout` text DEFAULT NULL,
  `refresh_interval` int(11) DEFAULT 300,
  `hospital_id` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_hospital_id` (`hospital_id`),
  KEY `idx_dashboard_type` (`dashboard_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Dashboard Metrics Cache Table
CREATE TABLE IF NOT EXISTS `dashboard_metrics_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `metric_key` varchar(255) NOT NULL,
  `metric_value` text NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_metric_hospital` (`metric_key`, `hospital_id`),
  KEY `idx_hospital_id` (`hospital_id`),
  KEY `idx_expires_at` (`expires_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Dashboard Alerts Table
CREATE TABLE IF NOT EXISTS `dashboard_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alert_type` enum('info','warning','danger','success') NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `dashboard_type` enum('executive','clinical','financial','operational') NOT NULL,
  `priority` enum('low','medium','high','critical') DEFAULT 'medium',
  `is_active` tinyint(1) DEFAULT 1,
  `hospital_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_hospital_id` (`hospital_id`),
  KEY `idx_dashboard_type` (`dashboard_type`),
  KEY `idx_priority` (`priority`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Dashboard Widgets Table
CREATE TABLE IF NOT EXISTS `dashboard_widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_name` varchar(255) NOT NULL,
  `widget_type` varchar(100) NOT NULL,
  `widget_config` text DEFAULT NULL,
  `dashboard_type` enum('executive','clinical','financial','operational') NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `sort_order` int(11) DEFAULT 0,
  `hospital_id` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_hospital_id` (`hospital_id`),
  KEY `idx_dashboard_type` (`dashboard_type`),
  KEY `idx_is_active` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create Dashboard Analytics Table
CREATE TABLE IF NOT EXISTS `dashboard_analytics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dashboard_type` enum('executive','clinical','financial','operational') NOT NULL,
  `action` varchar(100) NOT NULL,
  `details` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `hospital_id` int(11) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_hospital_id` (`hospital_id`),
  KEY `idx_dashboard_type` (`dashboard_type`),
  KEY `idx_action` (`action`),
  KEY `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default dashboard widgets
INSERT INTO `dashboard_widgets` (`widget_name`, `widget_type`, `widget_config`, `dashboard_type`, `is_active`, `sort_order`, `hospital_id`) VALUES
('Revenue Overview', 'metric_card', '{"title":"Total Revenue","metric":"revenue","period":"monthly"}', 'executive', 1, 1, 1),
('Patient Count', 'metric_card', '{"title":"New Patients","metric":"patients","period":"monthly"}', 'executive', 1, 2, 1),
('Bed Occupancy', 'metric_card', '{"title":"Bed Occupancy Rate","metric":"bed_occupancy","period":"current"}', 'executive', 1, 3, 1),
('Revenue Trend', 'line_chart', '{"title":"Revenue Trend","metric":"revenue_trend","period":"12_months"}', 'executive', 1, 4, 1),
('Department Performance', 'doughnut_chart', '{"title":"Department Performance","metric":"department_performance","period":"monthly"}', 'executive', 1, 5, 1),

('Current Inpatients', 'metric_card', '{"title":"Current Inpatients","metric":"inpatients","period":"current"}', 'clinical', 1, 1, 1),
('Today Appointments', 'metric_card', '{"title":"Today Appointments","metric":"appointments","period":"daily"}', 'clinical', 1, 2, 1),
('Pending Labs', 'metric_card', '{"title":"Pending Lab Results","metric":"pending_labs","period":"current"}', 'clinical', 1, 3, 1),
('Emergency Cases', 'metric_card', '{"title":"Emergency Cases","metric":"emergency_cases","period":"daily"}', 'clinical', 1, 4, 1),
('Bed Status', 'list_widget', '{"title":"Bed Occupancy Status","metric":"bed_status","period":"current"}', 'clinical', 1, 5, 1),

('Daily Revenue', 'metric_card', '{"title":"Today Revenue","metric":"daily_revenue","period":"daily"}', 'financial', 1, 1, 1),
('Monthly Revenue', 'metric_card', '{"title":"Monthly Revenue","metric":"monthly_revenue","period":"monthly"}', 'financial', 1, 2, 1),
('Outstanding Payments', 'metric_card', '{"title":"Outstanding Payments","metric":"outstanding_payments","period":"current"}', 'financial', 1, 3, 1),
('Profit Margin', 'metric_card', '{"title":"Profit Margin","metric":"profit_margin","period":"monthly"}', 'financial', 1, 4, 1),
('Revenue Chart', 'line_chart', '{"title":"Revenue Trend","metric":"revenue_chart","period":"12_months"}', 'financial', 1, 5, 1),

('Appointments Today', 'metric_card', '{"title":"Today Appointments","metric":"appointments_today","period":"daily"}', 'operational', 1, 1, 1),
('Staff on Duty', 'metric_card', '{"title":"Staff on Duty","metric":"staff_duty","period":"current"}', 'operational', 1, 2, 1),
('Low Stock Items', 'metric_card', '{"title":"Low Stock Items","metric":"low_stock","period":"current"}', 'operational', 1, 3, 1),
('System Alerts', 'list_widget', '{"title":"System Alerts","metric":"system_alerts","period":"current"}', 'operational', 1, 4, 1),
('Recent Activities', 'list_widget', '{"title":"Recent Activities","metric":"recent_activities","period":"daily"}', 'operational', 1, 5, 1);

-- Insert sample dashboard alerts
INSERT INTO `dashboard_alerts` (`alert_type`, `title`, `message`, `dashboard_type`, `priority`, `is_active`, `hospital_id`, `created_at`) VALUES
('warning', 'High Bed Occupancy', 'Bed occupancy rate is above 85%. Consider opening additional beds.', 'executive', 'medium', 1, 1, NOW()),
('info', 'Revenue Target Met', 'Monthly revenue target has been achieved ahead of schedule.', 'financial', 'low', 1, 1, NOW()),
('danger', 'Critical Lab Results', '3 critical lab results are pending review by medical staff.', 'clinical', 'high', 1, 1, NOW()),
('warning', 'Low Inventory Alert', '5 items are running low on stock and need immediate attention.', 'operational', 'medium', 1, 1, NOW()),
('success', 'System Update Complete', 'All systems have been successfully updated to the latest version.', 'operational', 'low', 1, 1, NOW());
