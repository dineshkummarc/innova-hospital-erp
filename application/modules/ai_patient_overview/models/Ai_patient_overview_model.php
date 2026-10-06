<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_patient_overview_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function collectPatientData($patient_id)
    {
        $data = array();
        
        // Get patient basic information
        $data['patient'] = $this->getPatientInfo($patient_id);
        
        // Get all appointments
        $data['appointments'] = $this->getAllAppointments($patient_id);
        
        // Get all prescriptions
        $data['prescriptions'] = $this->getAllPrescriptions($patient_id);
        
        // Get all lab reports
        $data['lab_reports'] = $this->getAllLabReports($patient_id);
        
        // Get medical history (case history)
        $data['medical_history'] = $this->getAllMedicalHistory($patient_id);
        
        // Get all vital signs
        $data['vital_signs'] = $this->getAllVitalSigns($patient_id);
        
        // Get bed allotments (if any)
        $data['bed_allotments'] = $this->getBedAllotments($patient_id);
        
        // Get patient materials/documents
        $data['patient_materials'] = $this->getPatientMaterials($patient_id);
        
        // Get payment history
        $data['payments'] = $this->getPaymentHistory($patient_id);
        
        // Get diagnosis history (if available)
        $data['diagnoses'] = array(); // Diagnosis table doesn't have patient column
        
        return $data;
    }

    private function getPatientInfo($patient_id)
    {
        $this->db->where('id', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        return $this->db->get('patient')->row();
    }

    private function getAllAppointments($patient_id)
    {
        $this->db->where('patient', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'DESC');
        return $this->db->get('appointment')->result();
    }

    private function getAllPrescriptions($patient_id)
    {
        $this->db->where('patient', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'DESC');
        return $this->db->get('prescription')->result();
    }

    private function getAllLabReports($patient_id)
    {
        $this->db->where('patient', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'DESC');
        return $this->db->get('lab')->result();
    }

    private function getAllMedicalHistory($patient_id)
    {
        $this->db->select('mh.*');
        $this->db->from('medical_history mh');
        $this->db->where('mh.patient_id', $patient_id);
        $this->db->where('mh.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('mh.id', 'DESC');
        return $this->db->get()->result();
    }

    private function getAllVitalSigns($patient_id)
    {
        $this->db->where('patient_id', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'DESC');
        return $this->db->get('vital_signs')->result();
    }

    private function getBedAllotments($patient_id)
    {
        $this->db->where('patient', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'DESC');
        return $this->db->get('alloted_bed')->result();
    }

    private function getPatientMaterials($patient_id)
    { 
        $this->db->where('patient', $patient_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'DESC');
        return $this->db->get('patient_material')->result();
    }

    private function getPaymentHistory($patient_id)
    {
        $this->db->select('p.*');
        $this->db->from('payment p');
        $this->db->where('p.patient', $patient_id);
        $this->db->where('p.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('p.id', 'DESC');
        return $this->db->get()->result();
    }


    public function saveAnalysis($patient_id, $doctor_id, $analysis_result)
    {
        $data = array(
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'hospital_id' => $this->session->userdata('hospital_id'),
            'analysis_result' => $analysis_result,
            'created_by' => $this->ion_auth->user()->row()->id,
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('ai_patient_overviews', $data);
        return $this->db->insert_id();
    }

    public function getAllAnalyses()
    {
        $this->db->select('apo.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('ai_patient_overviews apo');
        $this->db->join('patient p', 'p.id = apo.patient_id', 'left');
        $this->db->join('doctor d', 'd.id = apo.doctor_id', 'left');
        $this->db->where('apo.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('apo.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAnalysisById($analysis_id)
    {
        $this->db->select('apo.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('ai_patient_overviews apo');
        $this->db->join('patient p', 'p.id = apo.patient_id', 'left');
        $this->db->join('doctor d', 'd.id = apo.doctor_id', 'left');
        $this->db->where('apo.id', $analysis_id);
        $this->db->where('apo.hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function deleteAnalysis($analysis_id)
    {
        $this->db->where('id', $analysis_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        return $this->db->delete('ai_patient_overviews');
    }
}
