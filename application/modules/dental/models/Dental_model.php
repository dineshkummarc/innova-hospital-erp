<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dental_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // Examination methods
    public function saveExamination($data)
    {
        if ($this->db->insert('dental_examinations', $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function getAllExaminations()
    {
        $this->db->select('de.*, p.name as patient_name, p.email as patient_email, p.phone as patient_phone, d.name as doctor_name');
        $this->db->from('dental_examinations de');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->order_by('de.examination_date', 'desc');
        return $this->db->get()->result();
    }

    public function getExaminationById($id)
    {
        $this->db->select('de.*, p.name as patient_name, p.email as patient_email, p.phone as patient_phone, p.address as patient_address, p.sex as patient_sex, p.birthdate as patient_birth_date, d.name as doctor_name, d.email as doctor_email');
        $this->db->from('dental_examinations de');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.id', $id);
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        return $this->db->get()->row();
    }

    public function getExaminationsByPatient($patient_id)
    {
        $this->db->select('de.*, d.name as doctor_name');
        $this->db->from('dental_examinations de');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.patient_id', $patient_id);
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->order_by('de.examination_date', 'desc');
        return $this->db->get()->result();
    }

    public function updateExamination($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id') ?: 1);
        return $this->db->update('dental_examinations', $data);
    }

    public function deleteExamination($id)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id') ?: 1);
        return $this->db->delete('dental_examinations');
    }

    // Odontogram methods
    public function saveOdontogramData($examination_id, $odontogram_data)
    {
        // Delete existing odontogram data for this examination
        $this->deleteOdontogramData($examination_id);
        
        // Insert new odontogram data
        foreach ($odontogram_data as $tooth_number => $tooth_data) {
            if (!empty($tooth_data['condition']) && $tooth_data['condition'] !== 'healthy') {
                $data = array(
                    'examination_id' => $examination_id,
                    'tooth_number' => $tooth_number,
                    'tooth_type' => isset($tooth_data['tooth_type']) ? $tooth_data['tooth_type'] : 'permanent',
                    'condition' => $tooth_data['condition'],
                    'surface_affected' => isset($tooth_data['surface_affected']) ? $tooth_data['surface_affected'] : null,
                    'severity' => isset($tooth_data['severity']) ? $tooth_data['severity'] : null,
                    'notes' => isset($tooth_data['notes']) ? $tooth_data['notes'] : null,
                    'color_code' => isset($tooth_data['color_code']) ? $tooth_data['color_code'] : $this->getConditionColor($tooth_data['condition'])
                );
                $this->db->insert('dental_odontogram', $data);
            }
        }
        return true;
    }

    public function getOdontogramData($examination_id)
    {
        $this->db->where('examination_id', $examination_id);
        $query = $this->db->get('dental_odontogram');
        $result = array();
        
        foreach ($query->result() as $row) {
            $result[$row->tooth_number] = $row;
        }
        
        return $result;
    }

    public function deleteOdontogramData($examination_id)
    {
        $this->db->where('examination_id', $examination_id);
        return $this->db->delete('dental_odontogram');
    }

    private function getConditionColor($condition)
    {
        $colors = array(
            'healthy' => '#FFFFFF',
            'caries' => '#FF0000',
            'filled' => '#0000FF',
            'crowned' => '#FFD700',
            'extracted' => '#000000',
            'impacted' => '#800080',
            'fractured' => '#FF6600',
            'root_canal' => '#FF69B4',
            'implant' => '#00FF00',
            'bridge' => '#00FFFF',
            'other' => '#808080'
        );
        
        return isset($colors[$condition]) ? $colors[$condition] : '#FFFFFF';
    }

    // Treatment methods
    public function saveTreatment($data)
    {
        return $this->db->insert('dental_treatments', $data);
    }

    public function getTreatmentsByExamination($examination_id)
    {
        $this->db->where('examination_id', $examination_id);
        $this->db->order_by('treatment_date', 'asc');
        return $this->db->get('dental_treatments')->result();
    }

    public function updateTreatment($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('dental_treatments', $data);
    }

    public function deleteTreatment($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('dental_treatments');
    }

    // Prescription methods
    public function savePrescription($data)
    {
        return $this->db->insert('dental_prescriptions', $data);
    }

    public function getPrescriptionsByExamination($examination_id)
    {
        $this->db->where('examination_id', $examination_id);
        return $this->db->get('dental_prescriptions')->result();
    }

    public function updatePrescription($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('dental_prescriptions', $data);
    }

    public function deletePrescription($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('dental_prescriptions');
    }

    // Image methods
    public function saveImage($data)
    {
        return $this->db->insert('dental_images', $data);
    }

    public function getImagesByExamination($examination_id)
    {
        $this->db->where('examination_id', $examination_id);
        $this->db->order_by('upload_date', 'desc');
        return $this->db->get('dental_images')->result();
    }

    public function deleteImage($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('dental_images');
    }

    // Appointment types
    public function getAppointmentTypes()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->where('is_active', 1);
        $this->db->order_by('name', 'asc');
        return $this->db->get('dental_appointment_types')->result();
    }

    // Treatment templates
    public function getTreatmentTemplates()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->where('is_active', 1);
        $this->db->order_by('category', 'asc');
        $this->db->order_by('name', 'asc');
        return $this->db->get('dental_treatment_templates')->result();
    }

    // Dashboard statistics
    public function getDashboardStats()
    {
        $hospital_id = $this->session->userdata('hospital_id') ?: 1;
        
        $stats = array();
        
        // Total examinations
        $this->db->where('hospital_id', $hospital_id);
        $stats['total_examinations'] = $this->db->count_all_results('dental_examinations');
        
        // Examinations this month
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('MONTH(examination_date)', date('m'));
        $this->db->where('YEAR(examination_date)', date('Y'));
        $stats['examinations_this_month'] = $this->db->count_all_results('dental_examinations');
        
        // Examinations today
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('DATE(examination_date)', date('Y-m-d'));
        $stats['examinations_today'] = $this->db->count_all_results('dental_examinations');
        
        // Pending treatments
        $this->db->select('dt.*');
        $this->db->from('dental_treatments dt');
        $this->db->join('dental_examinations de', 'dt.examination_id = de.id');
        $this->db->where('de.hospital_id', $hospital_id);
        $this->db->where('dt.status', 'planned');
        $stats['pending_treatments'] = $this->db->count_all_results();
        
        // Completed treatments this month
        $this->db->select('dt.*');
        $this->db->from('dental_treatments dt');
        $this->db->join('dental_examinations de', 'dt.examination_id = de.id');
        $this->db->where('de.hospital_id', $hospital_id);
        $this->db->where('dt.status', 'completed');
        $this->db->where('MONTH(dt.treatment_date)', date('m'));
        $this->db->where('YEAR(dt.treatment_date)', date('Y'));
        $stats['completed_treatments_this_month'] = $this->db->count_all_results();
        
        return $stats;
    }

    public function getRecentExaminations($limit = 10)
    {
        $this->db->select('de.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('dental_examinations de');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->order_by('de.created_at', 'desc');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function getUpcomingAppointments($limit = 10)
    {
        $this->db->select('de.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('dental_examinations de');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->where('de.next_appointment >=', date('Y-m-d H:i:s'));
        $this->db->order_by('de.next_appointment', 'asc');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    // Search methods
    public function searchExaminations($search_term)
    {
        $this->db->select('de.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('dental_examinations de');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        
        $this->db->group_start();
        $this->db->like('p.name', $search_term);
        $this->db->or_like('de.chief_complaint', $search_term);
        $this->db->or_like('de.diagnosis', $search_term);
        $this->db->group_end();
        
        $this->db->order_by('de.examination_date', 'desc');
        return $this->db->get()->result();
    }

    // Reports
    public function getExaminationsByDateRange($start_date, $end_date)
    {
        $this->db->select('de.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('dental_examinations de');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->where('DATE(de.examination_date) >=', $start_date);
        $this->db->where('DATE(de.examination_date) <=', $end_date);
        $this->db->order_by('de.examination_date', 'desc');
        return $this->db->get()->result();
    }

    public function getTreatmentsByDateRange($start_date, $end_date)
    {
        $this->db->select('dt.*, de.patient_id, p.name as patient_name, d.name as doctor_name');
        $this->db->from('dental_treatments dt');
        $this->db->join('dental_examinations de', 'dt.examination_id = de.id');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->where('DATE(dt.treatment_date) >=', $start_date);
        $this->db->where('DATE(dt.treatment_date) <=', $end_date);
        $this->db->order_by('dt.treatment_date', 'desc');
        return $this->db->get()->result();
    }

    // Treatment Plans
    public function getAllTreatmentPlans()
    {
        $this->db->select('dt.*, de.patient_id, p.name as patient_name, p.phone as patient_phone, d.name as doctor_name, de.examination_date');
        $this->db->from('dental_treatments dt');
        $this->db->join('dental_examinations de', 'dt.examination_id = de.id');
        $this->db->join('patient p', 'de.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $this->session->userdata('hospital_id') ?: 1);
        $this->db->where('dt.status', 'planned');
        $this->db->order_by('dt.treatment_date', 'asc');
        return $this->db->get()->result();
    }

    // Reports - Monthly Statistics
    public function getMonthlyStats()
    {
        $hospital_id = $this->session->userdata('hospital_id') ?: 1;
        
        $this->db->select('MONTH(examination_date) as month, YEAR(examination_date) as year, COUNT(*) as count');
        $this->db->from('dental_examinations');
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('examination_date >=', date('Y-01-01', strtotime('-11 months')));
        $this->db->group_by('YEAR(examination_date), MONTH(examination_date)');
        $this->db->order_by('year, month');
        return $this->db->get()->result();
    }

    // Reports - Condition Statistics
    public function getConditionStats()
    {
        $hospital_id = $this->session->userdata('hospital_id') ?: 1;
        
        $this->db->select('do.condition, COUNT(*) as count');
        $this->db->from('dental_odontogram do');
        $this->db->join('dental_examinations de', 'do.examination_id = de.id');
        $this->db->where('de.hospital_id', $hospital_id);
        $this->db->where('do.condition !=', 'healthy');
        $this->db->group_by('do.condition');
        $this->db->order_by('count', 'desc');
        return $this->db->get()->result();
    }

    // Reports - Doctor Statistics
    public function getDoctorStats()
    {
        $hospital_id = $this->session->userdata('hospital_id') ?: 1;
        
        $this->db->select('d.name as doctor_name, COUNT(de.id) as examination_count, AVG(DATEDIFF(NOW(), de.examination_date)) as avg_days_since_last');
        $this->db->from('dental_examinations de');
        $this->db->join('doctor d', 'de.doctor_id = d.id', 'left');
        $this->db->where('de.hospital_id', $hospital_id);
        $this->db->where('de.examination_date >=', date('Y-m-d', strtotime('-6 months')));
        $this->db->group_by('de.doctor_id, d.name');
        $this->db->order_by('examination_count', 'desc');
        return $this->db->get()->result();
    }
}
