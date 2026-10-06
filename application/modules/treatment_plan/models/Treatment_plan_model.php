<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Treatment_plan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function createTreatmentPlan($data)
    {
        // Add hospital_id to the data
        $data['hospital_id'] = $this->session->userdata('hospital_id');
        $this->db->insert('treatment_plans', $data);
        return $this->db->insert_id();
    }

    public function updateTreatmentPlan($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('treatment_plans', $data);
    }

    public function getTreatmentPlanById($id) 
    {
        $this->db->select('tp.*, p.name as patient_name, p.age, p.sex, p.phone, p.email');
        $this->db->from('treatment_plans tp');
        $this->db->join('patient p', 'tp.patient_id = p.id', 'left');
        $this->db->where('tp.id', $id);
        $this->db->where('tp.hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get();
        return $query->row();
    }

    public function getTreatmentPlansByPatient($patient_id)
    {
        $this->db->select('tp.*, p.name as patient_name, p.age, p.sex');
        $this->db->from('treatment_plans tp');
        $this->db->join('patient p', 'tp.patient_id = p.id', 'left');
        $this->db->where('tp.patient_id', $patient_id);
        $this->db->where('tp.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('tp.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllTreatmentPlans()
    {
        $this->db->select('tp.*, p.name as patient_name, p.age, p.sex');
        $this->db->from('treatment_plans tp');
        $this->db->join('patient p', 'tp.patient_id = p.id', 'left');
        $this->db->where('tp.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('tp.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteTreatmentPlan($id)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        return $this->db->delete('treatment_plans');
    }

}
