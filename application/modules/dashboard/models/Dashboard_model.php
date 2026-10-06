<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Executive Dashboard Methods
    public function getExecutiveMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Total Revenue (Current Month)
        $this->db->select('SUM(amount) as total_revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $revenue = $this->db->get()->row();
        $metrics['total_revenue'] = $revenue->total_revenue ?: 0;

        // Total Patients (Current Month)
        $this->db->select('COUNT(*) as total_patients');
        $this->db->from('patient');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(add_date)', date('m'));
        $this->db->where('YEAR(add_date)', date('Y'));
        $patients = $this->db->get()->row();
        $metrics['total_patients'] = $patients->total_patients ?: 0;

        // Total Appointments (Current Month)
        $this->db->select('COUNT(*) as total_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $appointments = $this->db->get()->row();
        $metrics['total_appointments'] = $appointments->total_appointments ?: 0;

        // Bed Occupancy Rate
        $this->db->select('COUNT(*) as total_beds');
        $this->db->from('bed');
        $this->db->where('hospital_id', $hospital_id);
        $total_beds = $this->db->get()->row();

        $this->db->select('COUNT(*) as occupied_beds');
        $this->db->from('alloted_bed');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('d_timestamp IS NULL');
        $occupied_beds = $this->db->get()->row();

        $metrics['bed_occupancy_rate'] = $total_beds->total_beds > 0 ? 
            round(($occupied_beds->occupied_beds / $total_beds->total_beds) * 100, 2) : 0;

        // Average Revenue per Patient
        $metrics['avg_revenue_per_patient'] = $metrics['total_patients'] > 0 ? 
            round($metrics['total_revenue'] / $metrics['total_patients'], 2) : 0;

        // Patient Satisfaction Score - removed (no rating system exists)

        return $metrics;
    }

    public function getRevenueData($months = 12, $hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $data = array();
        
        for ($i = $months - 1; $i >= 0; $i--) {
            $date = date('Y-m', strtotime("-$i months"));
            
            $this->db->select('SUM(amount) as revenue');
            $this->db->from('payment');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m', strtotime($date . '-01')));
            $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y', strtotime($date . '-01')));
            $result = $this->db->get()->row();
            
            $data[] = array(
                'month' => date('M Y', strtotime($date . '-01')),
                'revenue' => $result->revenue ?: 0
            );
        }
        
        return $data;
    }

    public function getPatientFlowData($days = 30, $hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $data = array();
        
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            // New patients
            $this->db->select('COUNT(*) as new_patients');
            $this->db->from('patient');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('DATE(add_date)', $date);
            $new_patients = $this->db->get()->row();
            
            // Discharged patients
            $this->db->select('COUNT(*) as discharged_patients');
            $this->db->from('alloted_bed');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('DATE(FROM_UNIXTIME(d_timestamp))', $date);
            $this->db->where('d_timestamp IS NOT NULL');
            $discharged = $this->db->get()->row();
            
            $data[] = array(
                'date' => $date,
                'new_patients' => $new_patients->new_patients ?: 0,
                'discharged_patients' => $discharged->discharged_patients ?: 0
            );
        }
        
        return $data;
    }

    public function getDepartmentPerformance($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('d.name as department_name, COUNT(a.id) as appointment_count, AVG(p.amount) as avg_revenue');
        $this->db->from('department d');
        $this->db->join('doctor doc', 'doc.department = d.id', 'left');
        $this->db->join('appointment a', 'a.doctor = doc.id', 'left');
        $this->db->join('payment p', 'p.patient = a.patient', 'left');
        $this->db->where('d.hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(a.date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(a.date))', date('Y'));
        $this->db->group_by('d.id, d.name');
        $this->db->order_by('appointment_count', 'DESC');
        
        return $this->db->get()->result();
    }

    public function getQualityMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Readmission Rate - removed (complex calculation not implemented)
        // Average Length of Stay - removed (complex calculation not implemented)
        
        return $metrics;
    }

    // Clinical Dashboard Methods
    public function getPatientMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Current Inpatients
        $this->db->select('COUNT(*) as current_inpatients');
        $this->db->from('alloted_bed');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('d_timestamp IS NULL');
        $inpatients = $this->db->get()->row();
        $metrics['current_inpatients'] = $inpatients->current_inpatients ?: 0;

        // Today's Appointments
        $this->db->select('COUNT(*) as todays_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $appointments = $this->db->get()->row();
        $metrics['todays_appointments'] = $appointments->todays_appointments ?: 0;

        // Pending Lab Results
        $this->db->select('COUNT(*) as pending_labs');
        $this->db->from('lab');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('test_status', 'done');
        $this->db->where('status', 'pending');
        $labs = $this->db->get()->row();
        $metrics['pending_labs'] = $labs->pending_labs ?: 0;

        // Emergency Cases (Today)
        $this->db->select('COUNT(*) as emergency_cases');
        $this->db->from('emergency');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(emergency_time))', date('Y-m-d'));
        $emergency = $this->db->get()->row();
        $metrics['emergency_cases'] = $emergency->emergency_cases ?: 0;

        return $metrics;
    }

    public function getBedOccupancyData($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('b.bed_id as bed_name, b.description as bed_type, ab.patientname as patient_name, ab.d_timestamp');
        $this->db->from('bed b');
        $this->db->join('alloted_bed ab', 'ab.bed_id = b.id', 'left');
        $this->db->where('b.hospital_id', $hospital_id);
        $this->db->order_by('b.bed_id');
        
        $results = $this->db->get()->result();
        
        // Process results to add status
        foreach ($results as $result) {
            $result->status = ($result->d_timestamp === null) ? 'occupied' : 'available';
        }
        
        return $results;
    }

    public function getLabResultsData($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('l.*, l.patient_name, pc.payment_category as category_name');
        $this->db->from('lab l');
        $this->db->join('payment_category pc', 'pc.id = l.category_id', 'left');
        $this->db->where('l.hospital_id', $hospital_id);
        $this->db->where('FROM_UNIXTIME(l.date) >= DATE_SUB(NOW(), INTERVAL 7 DAY)');
        $this->db->order_by('l.date', 'DESC');
        $this->db->limit(10);
        
        return $this->db->get()->result();
    }

    // Financial Dashboard Methods
    public function getRevenueMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Today's Revenue
        $this->db->select('SUM(amount) as todays_revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $today = $this->db->get()->row();
        $metrics['todays_revenue'] = $today->todays_revenue ?: 0;

        // This Month's Revenue
        $this->db->select('SUM(amount) as monthly_revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $monthly = $this->db->get()->row();
        $metrics['monthly_revenue'] = $monthly->monthly_revenue ?: 0;

        // Outstanding Payments
        $this->db->select('SUM(amount) as outstanding_payments');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('status', 'unpaid');
        $outstanding = $this->db->get()->row();
        $metrics['outstanding_payments'] = $outstanding->outstanding_payments ?: 0;

        return $metrics;
    }

    public function getExpenseBreakdown($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('category, SUM(amount) as total_amount');
        $this->db->from('expense');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $this->db->group_by('category');
        $this->db->order_by('total_amount', 'DESC');
        
        return $this->db->get()->result();
    }

    // Operational Dashboard Methods
    public function getAppointmentMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Today's Appointments
        $this->db->select('COUNT(*) as todays_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $today = $this->db->get()->row();
        $metrics['todays_appointments'] = $today->todays_appointments ?: 0;

        // Completed Appointments
        $this->db->select('COUNT(*) as completed_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $this->db->where('status', 'completed');
        $completed = $this->db->get()->row();
        $metrics['completed_appointments'] = $completed->completed_appointments ?: 0;

        // Cancelled Appointments
        $this->db->select('COUNT(*) as cancelled_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $this->db->where('status', 'cancelled');
        $cancelled = $this->db->get()->row();
        $metrics['cancelled_appointments'] = $cancelled->cancelled_appointments ?: 0;

        return $metrics;
    }

    public function getStaffMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Total Staff
        $this->db->select('COUNT(*) as total_staff');
        $this->db->from('users u');
        $this->db->join('users_groups ug', 'ug.user_id = u.id');
        $this->db->join('groups g', 'g.id = ug.group_id');
        $this->db->where('u.hospital_ion_id', $hospital_id);
        $this->db->where('g.name !=', 'Patient');
        $total = $this->db->get()->row();
        $metrics['total_staff'] = $total->total_staff ?: 0;

        // Staff on Duty - removed (no attendance tracking system)

        return $metrics;
    }

    public function getInventoryStatus($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('name, current_stock, minimum_stock, status');
        $this->db->from('inventory_items');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('current_stock <= minimum_stock');
        $this->db->order_by('current_stock', 'ASC');
        
        return $this->db->get()->result();
    }

    public function getSystemAlerts($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $alerts = array();
        
        // Low Stock Alerts
        $this->db->select('name, current_stock, minimum_stock');
        $this->db->from('inventory_items');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('current_stock <= minimum_stock');
        $low_stock = $this->db->get()->result();
        
        foreach ($low_stock as $item) {
            $alerts[] = array(
                'type' => 'warning',
                'message' => 'Low stock alert: ' . $item->name . ' (' . $item->current_stock . ' remaining)',
                'timestamp' => date('Y-m-d H:i:s')
            );
        }
        
        // Overdue Appointments
        $this->db->select('COUNT(*) as overdue_count');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('FROM_UNIXTIME(date) < NOW()');
        $this->db->where('status', 'pending');
        $overdue = $this->db->get()->row();
        
        if ($overdue->overdue_count > 0) {
            $alerts[] = array(
                'type' => 'danger',
                'message' => $overdue->overdue_count . ' overdue appointments',
                'timestamp' => date('Y-m-d H:i:s')
            );
        }
        
        return $alerts;
    }

    public function getRecentActivities($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $activities = array();
        
        // Recent Patient Registrations
        $this->db->select('p.name as patient_name, p.add_date');
        $this->db->from('patient p');
        $this->db->where('p.hospital_id', $hospital_id);
        $this->db->where('p.add_date >= DATE_SUB(NOW(), INTERVAL 24 HOUR)');
        $this->db->order_by('p.add_date', 'DESC');
        $this->db->limit(5);
        $patients = $this->db->get()->result();
        
        foreach ($patients as $patient) {
            $activities[] = array(
                'type' => 'patient_registration',
                'message' => 'New patient registered: ' . $patient->patient_name,
                'timestamp' => $patient->add_date
            );
        }
        
        // Recent Appointments
        $this->db->select('a.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('appointment a');
        $this->db->join('patient p', 'p.id = a.patient', 'left');
        $this->db->join('doctor d', 'd.id = a.doctor', 'left');
        $this->db->where('a.hospital_id', $hospital_id);
        $this->db->where('FROM_UNIXTIME(a.date) >= DATE_SUB(NOW(), INTERVAL 24 HOUR)');
        $this->db->order_by('a.date', 'DESC');
        $this->db->limit(5);
        $appointments = $this->db->get()->result();
        
        foreach ($appointments as $appointment) {
            $activities[] = array(
                'type' => 'appointment',
                'message' => 'Appointment: ' . $appointment->patient_name . ' with Dr. ' . $appointment->doctor_name,
                'timestamp' => $appointment->date
            );
        }
        
        // Sort by timestamp
        usort($activities, function($a, $b) {
            return strtotime($b['timestamp']) - strtotime($a['timestamp']);
        });
        
        return array_slice($activities, 0, 10);
    }

    // Helper method to calculate percentage change
    private function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 1);
    }

    // Get percentage changes for metrics
    public function getPercentageChanges($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $changes = array();
        
        // Current month revenue
        $this->db->select('SUM(amount) as current_revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $current_revenue = $this->db->get()->row();
        $current_revenue = $current_revenue->current_revenue ?: 0;

        // Previous month revenue
        $this->db->select('SUM(amount) as previous_revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m', strtotime('first day of last month')));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y', strtotime('first day of last month')));
        $previous_revenue = $this->db->get()->row();
        $previous_revenue = $previous_revenue->previous_revenue ?: 0;

        $changes['revenue_change'] = $this->calculatePercentageChange($current_revenue, $previous_revenue);

        // Current month patients
        $this->db->select('COUNT(*) as current_patients');
        $this->db->from('patient');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(add_date)', date('m'));
        $this->db->where('YEAR(add_date)', date('Y'));
        $current_patients = $this->db->get()->row();
        $current_patients = $current_patients->current_patients ?: 0;

        // Previous month patients
        $this->db->select('COUNT(*) as previous_patients');
        $this->db->from('patient');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(add_date)', date('m', strtotime('first day of last month')));
        $this->db->where('YEAR(add_date)', date('Y', strtotime('first day of last month')));
        $previous_patients = $this->db->get()->row();
        $previous_patients = $previous_patients->previous_patients ?: 0;

        $changes['patients_change'] = $this->calculatePercentageChange($current_patients, $previous_patients);

        // Current month appointments
        $this->db->select('COUNT(*) as current_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $current_appointments = $this->db->get()->row();
        $current_appointments = $current_appointments->current_appointments ?: 0;

        // Previous month appointments
        $this->db->select('COUNT(*) as previous_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m', strtotime('first day of last month')));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y', strtotime('first day of last month')));
        $previous_appointments = $this->db->get()->row();
        $previous_appointments = $previous_appointments->previous_appointments ?: 0;

        $changes['appointments_change'] = $this->calculatePercentageChange($current_appointments, $previous_appointments);

        return $changes;
    }

    // Additional methods for comprehensive dashboard functionality
    public function getFinancialSummary($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $summary = array();
        
        // Total Revenue (Current Month)
        $this->db->select('SUM(amount) as total_revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $revenue = $this->db->get()->row();
        $summary['total_revenue'] = $revenue->total_revenue ?: 0;

        // Total Expenses (Current Month)
        $this->db->select('SUM(amount) as total_expenses');
        $this->db->from('expense');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $expenses = $this->db->get()->row();
        $summary['total_expenses'] = $expenses->total_expenses ?: 0;

        // Net Profit
        $summary['net_profit'] = $summary['total_revenue'] - $summary['total_expenses'];

        // Profit Margin
        $summary['profit_margin'] = $summary['total_revenue'] > 0 ? 
            round(($summary['net_profit'] / $summary['total_revenue']) * 100, 2) : 0;

        return $summary;
    }

    public function getOperationalEfficiency($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $efficiency = array();
        
        // Bed Occupancy Rate
        $this->db->select('COUNT(*) as total_beds');
        $this->db->from('bed');
        $this->db->where('hospital_id', $hospital_id);
        $total_beds = $this->db->get()->row();

        $this->db->select('COUNT(*) as occupied_beds');
        $this->db->from('alloted_bed');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('d_timestamp IS NULL');
        $occupied_beds = $this->db->get()->row();

        $efficiency['bed_occupancy_rate'] = $total_beds->total_beds > 0 ? 
            round(($occupied_beds->occupied_beds / $total_beds->total_beds) * 100, 2) : 0;

        // Appointment Completion Rate
        $this->db->select('COUNT(*) as total_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $total_appointments = $this->db->get()->row();

        $this->db->select('COUNT(*) as completed_appointments');
        $this->db->from('appointment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $this->db->where('status', 'completed');
        $completed_appointments = $this->db->get()->row();

        $efficiency['appointment_completion_rate'] = $total_appointments->total_appointments > 0 ? 
            round(($completed_appointments->completed_appointments / $total_appointments->total_appointments) * 100, 2) : 0;

        return $efficiency;
    }

    public function getPrescriptionMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Total Prescriptions (Current Month)
        $this->db->select('COUNT(*) as total_prescriptions');
        $this->db->from('prescription');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $prescriptions = $this->db->get()->row();
        $metrics['total_prescriptions'] = $prescriptions->total_prescriptions ?: 0;

        // Total Prescriptions (Today)
        $this->db->select('COUNT(*) as todays_prescriptions');
        $this->db->from('prescription');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $today = $this->db->get()->row();
        $metrics['todays_prescriptions'] = $today->todays_prescriptions ?: 0;

        return $metrics;
    }

    public function getEmergencyCases($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(e.emergency_time))', date('Y-m-d'));
        $this->db->order_by('e.emergency_time', 'DESC');
        $this->db->limit(10);
        
        return $this->db->get()->result();
    }

    public function getClinicalQualityMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Readmission Rate - removed (complex calculation not implemented)
        // Average Length of Stay - removed (complex calculation not implemented)
        // Patient Satisfaction Score - removed (no rating system exists)
        
        return $metrics;
    }

    public function getPatientSatisfactionData($hospital_id = null)
    {
        // Patient satisfaction data removed - no rating system exists
        return array(
            'overall_satisfaction' => 0,
            'satisfaction_trend' => array()
        );
    }

    public function getPaymentStatusData($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $data = array();
        
        // Paid Today
        $this->db->select('COUNT(*) as count, SUM(amount) as total_amount');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(date))', date('Y-m-d'));
        $this->db->where('status', 'paid');
        $paid_today = $this->db->get()->row();
        $data['paid_today'] = $paid_today->total_amount ?: 0;
        $data['paid_count'] = $paid_today->count ?: 0;

        // Pending Payments
        $this->db->select('COUNT(*) as count, SUM(amount) as total_amount');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('status', 'unpaid');
        $pending = $this->db->get()->row();
        $data['pending'] = $pending->total_amount ?: 0;
        $data['pending_count'] = $pending->count ?: 0;

        // Overdue Payments (unpaid payments older than 30 days)
        $this->db->select('COUNT(*) as count, SUM(amount) as total_amount');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('status', 'unpaid');
        $this->db->where('FROM_UNIXTIME(date) < DATE_SUB(NOW(), INTERVAL 30 DAY)');
        $overdue = $this->db->get()->row();
        $data['overdue'] = $overdue->total_amount ?: 0;
        $data['overdue_count'] = $overdue->count ?: 0;

        return $data;
    }

    public function getInsuranceClaimsData($hospital_id = null)
    {
        // Insurance claims data removed - no insurance system exists
        return array(
            'total_claims' => 0,
            'pending_claims' => 0,
            'approved_claims' => 0,
            'rejected_claims' => 0
        );
    }

    public function getProfitabilityMetrics($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $metrics = array();
        
        // Current Month Revenue
        $this->db->select('SUM(amount) as revenue');
        $this->db->from('payment');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $revenue = $this->db->get()->row();
        $metrics['current_month_revenue'] = $revenue->revenue ?: 0;

        // Current Month Expenses
        $this->db->select('SUM(amount) as expenses');
        $this->db->from('expense');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(FROM_UNIXTIME(date))', date('m'));
        $this->db->where('YEAR(FROM_UNIXTIME(date))', date('Y'));
        $expenses = $this->db->get()->row();
        $metrics['current_month_expenses'] = $expenses->expenses ?: 0;

        // Gross Profit (same as revenue for this simple calculation)
        $metrics['gross_profit'] = $metrics['current_month_revenue'];

        // Net Profit
        $metrics['net_profit'] = $metrics['current_month_revenue'] - $metrics['current_month_expenses'];

        // Profit Margin
        $metrics['profit_margin'] = $metrics['current_month_revenue'] > 0 ? 
            round(($metrics['net_profit'] / $metrics['current_month_revenue']) * 100, 2) : 0;

        // ROI (simplified calculation)
        $metrics['roi'] = $metrics['current_month_expenses'] > 0 ? 
            round(($metrics['net_profit'] / $metrics['current_month_expenses']) * 100, 2) : 0;

        return $metrics;
    }

    public function getCashFlowData($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $data = array();
        
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            // Daily Revenue
            $this->db->select('SUM(amount) as revenue');
            $this->db->from('payment');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('DATE(FROM_UNIXTIME(date))', $date);
            $revenue = $this->db->get()->row();
            
            // Daily Expenses
            $this->db->select('SUM(amount) as expenses');
            $this->db->from('expense');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('DATE(FROM_UNIXTIME(date))', $date);
            $expenses = $this->db->get()->row();
            
            $data[] = array(
                'date' => $date,
                'revenue' => $revenue->revenue ?: 0,
                'expenses' => $expenses->expenses ?: 0,
                'net_cash_flow' => ($revenue->revenue ?: 0) - ($expenses->expenses ?: 0)
            );
        }
        
        return $data;
    }

    public function getBudgetVsActual($hospital_id = null)
    {
        // Budget vs Actual data removed - no budget tracking system exists
        return array(
            'budgeted_revenue' => 0,
            'actual_revenue' => 0,
            'budgeted_expenses' => 0,
            'actual_expenses' => 0,
            'variance' => 0
        );
    }

    public function getFacilityUtilization($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $utilization = array();
        
        // Bed Utilization
        $this->db->select('COUNT(*) as total_beds');
        $this->db->from('bed');
        $this->db->where('hospital_id', $hospital_id);
        $total_beds = $this->db->get()->row();

        $this->db->select('COUNT(*) as occupied_beds');
        $this->db->from('alloted_bed');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('d_timestamp IS NULL');
        $occupied_beds = $this->db->get()->row();

        $utilization['bed_utilization'] = $total_beds->total_beds > 0 ? 
            round(($occupied_beds->occupied_beds / $total_beds->total_beds) * 100, 2) : 0;

        // Operating Room Utilization - removed (no OR tracking system)

        return $utilization;
    }

    public function getPatientQueueData($hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $this->db->select('a.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('appointment a');
        $this->db->join('patient p', 'p.id = a.patient', 'left');
        $this->db->join('doctor d', 'd.id = a.doctor', 'left');
        $this->db->where('a.hospital_id', $hospital_id);
        $this->db->where('DATE(FROM_UNIXTIME(a.date))', date('Y-m-d'));
        $this->db->where('a.status', 'pending');
        $this->db->order_by('a.date', 'ASC');
        
        return $this->db->get()->result();
    }

    public function getRevenueTrendData($period = 30, $hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $data = array();
        
        for ($i = $period - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            $this->db->select('SUM(amount) as revenue');
            $this->db->from('payment');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('DATE(FROM_UNIXTIME(date))', $date);
            $result = $this->db->get()->row();
            
            $data[] = array(
                'date' => $date,
                'revenue' => $result->revenue ?: 0
            );
        }
        
        return $data;
    }

    public function getAppointmentTrendsData($period = 30, $hospital_id = null)
    {
        if (!$hospital_id) {
            $hospital_id = $this->session->userdata('hospital_id');
        }

        $data = array();
        
        for ($i = $period - 1; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            
            $this->db->select('COUNT(*) as appointments');
            $this->db->from('appointment');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('DATE(FROM_UNIXTIME(date))', $date);
            $result = $this->db->get()->row();
            
            $data[] = array(
                'date' => $date,
                'appointments' => $result->appointments ?: 0
            );
        }
        
        return $data;
    }
}
