<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_image_analysis_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function createImageAnalysis($data)
    {
        $this->db->insert('ai_image_analyses', $data);
        return $this->db->insert_id();
    }

    public function updateImageAnalysis($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('ai_image_analyses', $data);
    }

    public function getImageAnalysisById($id)
    {
        $this->db->select('*');
        $this->db->from('ai_image_analyses');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function getImageAnalysesByPatient($patient_id, $hospital_id = null)
    {
        $this->db->select('aia.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('ai_image_analyses aia');
        $this->db->join('patient p', 'p.id = aia.patient_id', 'left');
        $this->db->join('doctor d', 'd.id = aia.doctor_id', 'left');
        $this->db->where('aia.patient_id', $patient_id);
        
        if ($hospital_id) {
            $this->db->where('aia.hospital_id', $hospital_id);
        }
        
        $this->db->order_by('aia.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllImageAnalyses($hospital_id = null)
    {
        try {
            if (!$hospital_id) {
                $hospital_id = $this->session->userdata('hospital_id');
            }
            log_message('debug', 'AI Image Analysis - Hospital ID: ' . $hospital_id);
            
            if (!$hospital_id) {
                log_message('error', 'AI Image Analysis - No hospital_id provided');
                return array();
            }
            
            // Simple query without joins first to test
            $this->db->select('*');
            $this->db->from('ai_image_analyses');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->order_by('created_at', 'DESC');
            
            $query = $this->db->get();
            log_message('debug', 'AI Image Analysis - Simple Query: ' . $this->db->last_query());
            log_message('debug', 'AI Image Analysis - Simple Result count: ' . $query->num_rows());
            
            $db_error = $this->db->error();
            if ($db_error['code'] != 0) {
                log_message('error', 'AI Image Analysis - Database Error: ' . $db_error['message']);
                return array();
            }
            
            $results = $query->result();
            
            // Now try with joins
            $this->db->select('aia.*, p.name as patient_name, d.name as doctor_name');
            $this->db->from('ai_image_analyses aia');
            $this->db->join('patient p', 'p.id = aia.patient_id', 'left');
            $this->db->join('doctor d', 'd.id = aia.doctor_id', 'left');
            $this->db->where('aia.hospital_id', $hospital_id);
            $this->db->order_by('aia.created_at', 'DESC');
            
            $query = $this->db->get();
            log_message('debug', 'AI Image Analysis - Join Query: ' . $this->db->last_query());
            log_message('debug', 'AI Image Analysis - Join Result count: ' . $query->num_rows());
            
            $db_error = $this->db->error();
            if ($db_error['code'] != 0) {
                log_message('error', 'AI Image Analysis - Join Query Error: ' . $db_error['message']);
                return $results; // Return simple results if join fails
            }
            
            return $query->result();
            
        } catch (Exception $e) {
            log_message('error', 'AI Image Analysis - Model Error: ' . $e->getMessage());
            return array();
        }
    }

    public function getAllImageAnalysesSimple($hospital_id = null)
    {
        try {
            $this->db->select('*');
            $this->db->from('ai_image_analyses');
            
            if ($hospital_id) {
                $this->db->where('hospital_id', $hospital_id);
            }
            
            $this->db->order_by('created_at', 'DESC');
            
            $query = $this->db->get();
            log_message('debug', 'Simple Analytics Query: ' . $this->db->last_query());
            log_message('debug', 'Simple Analytics Query Result Count: ' . $query->num_rows());
            
            $db_error = $this->db->error();
            if ($db_error['code'] != 0) {
                log_message('error', 'Simple Analytics Query Error: ' . $db_error['message']);
                return array();
            }
            
            return $query->result();
            
        } catch (Exception $e) {
            log_message('error', 'Simple Analytics Model Error: ' . $e->getMessage());
            return array();
        }
    }

    public function getImageAnalysesByDoctor($doctor_id, $hospital_id = null)
    {
        $this->db->select('aia.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('ai_image_analyses aia');
        $this->db->join('patient p', 'p.id = aia.patient_id', 'left');
        $this->db->join('doctor d', 'd.id = aia.doctor_id', 'left');
        $this->db->where('aia.doctor_id', $doctor_id);
        
        if ($hospital_id) {
            $this->db->where('aia.hospital_id', $hospital_id);
        }
        
        $this->db->order_by('aia.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteImageAnalysis($id)
    {
        // Get the image path before deleting
        $analysis = $this->getImageAnalysisById($id);
        if ($analysis && !empty($analysis->image_path)) {
            $image_path = FCPATH . 'uploads/ai_image_analysis/' . $analysis->image_path;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        $this->db->where('id', $id);
        return $this->db->delete('ai_image_analyses');
    }

    public function getImageAnalysisStats($hospital_id = null)
    {
        $this->db->select('
            COUNT(*) as total_analyses,
            COUNT(CASE WHEN analysis_result IS NOT NULL THEN 1 END) as completed_analyses,
            COUNT(CASE WHEN analysis_result IS NULL THEN 1 END) as pending_analyses,
            COUNT(CASE WHEN image_type = "xray" THEN 1 END) as xray_count,
            COUNT(CASE WHEN image_type = "ct_scan" THEN 1 END) as ct_scan_count,
            COUNT(CASE WHEN image_type = "mri" THEN 1 END) as mri_count,
            COUNT(CASE WHEN image_type = "ultrasound" THEN 1 END) as ultrasound_count,
            COUNT(CASE WHEN image_type = "endoscopy" THEN 1 END) as endoscopy_count,
            COUNT(CASE WHEN image_type = "dermatology" THEN 1 END) as dermatology_count,
            COUNT(CASE WHEN image_type = "ophthalmology" THEN 1 END) as ophthalmology_count,
            COUNT(CASE WHEN image_type = "pathology" THEN 1 END) as pathology_count,
            COUNT(CASE WHEN image_type = "other" THEN 1 END) as other_count
        ');
        $this->db->from('ai_image_analyses');
        
        if ($hospital_id) {
            $this->db->where('hospital_id', $hospital_id);
        }
        
        $query = $this->db->get();
        return $query->row();
    }
}
