<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emergency_model extends CI_model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertEmergency($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('emergency', $data2);
    }

    function getEmergency()
    {
        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('e.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getEmergencyById($id)
    {
        $this->db->select('e.*, p.name as patient_name, p.id as patient_id, p.phone as patient_phone, p.email as patient_email, p.age as patient_age, p.sex as patient_sex, p.bloodgroup as patient_bloodgroup, p.address as patient_address, p.birthdate as patient_birthdate, p.medical_history as patient_medical_history, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('e.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updateEmergency($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('emergency', $data);
    }

    function deleteEmergency($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('emergency');
    }

    function getEmergencyForDataTable($start, $length, $search_value = '', $order_column = '', $order_dir = '')
    {
        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        
        // Search functionality
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('e.id', $search_value);
            $this->db->or_like('p.name', $search_value);
            $this->db->or_like('d.name', $search_value);
            $this->db->or_like('e.emergency_type', $search_value);
            $this->db->or_like('e.description', $search_value);
            $this->db->or_like('e.status', $search_value);
            $this->db->or_like('e.priority', $search_value);
            $this->db->or_like('e.chief_complaint', $search_value);
            $this->db->group_end();
        }
        
        // Ordering
        if (!empty($order_column) && !empty($order_dir)) {
            $this->db->order_by($order_column, $order_dir);
        } else {
            $this->db->order_by('e.id', 'desc');
        }
        
        $this->db->limit($length, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getEmergencyCount()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('emergency');
        return $query->num_rows();
    }

    function getEmergencyFilteredCount($search_value = '')
    {
        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        
        // Search functionality
        if (!empty($search_value)) {
            $this->db->group_start();
            $this->db->like('e.id', $search_value);
            $this->db->or_like('p.name', $search_value);
            $this->db->or_like('d.name', $search_value);
            $this->db->or_like('e.emergency_type', $search_value);
            $this->db->or_like('e.description', $search_value);
            $this->db->or_like('e.status', $search_value);
            $this->db->or_like('e.priority', $search_value);
            $this->db->or_like('e.chief_complaint', $search_value);
            $this->db->group_end();
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getEmergencyByLimit($start, $length, $order, $dir)
    {
        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('e.id', 'desc');
        }
        
        if ($length != -1) {
            $this->db->limit($length, $start);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getEmergencyByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('e.id', 'desc');
        }
        
        $this->db->limit($limit, $start);
        
        $this->db->group_start();
        $this->db->like('e.id', $search);
        $this->db->or_like('p.name', $search);
        $this->db->or_like('d.name', $search);
        $this->db->or_like('e.emergency_type', $search);
        $this->db->or_like('e.description', $search);
        $this->db->or_like('e.status', $search);
        $this->db->or_like('e.priority', $search);
        $this->db->or_like('e.chief_complaint', $search);
        $this->db->group_end();
        
        $query = $this->db->get();
        return $query->result();
    }

    function getEmergencyBySearch($search, $order, $dir)
    {
        $this->db->select('e.*, p.name as patient_name, d.name as doctor_name');
        $this->db->from('emergency e');
        $this->db->join('patient p', 'e.patient_id = p.id', 'left');
        $this->db->join('doctor d', 'e.doctor_id = d.id', 'left');
        $this->db->where('e.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('e.id', 'desc');
        }
        
        $this->db->group_start();
        $this->db->like('e.id', $search);
        $this->db->or_like('p.name', $search);
        $this->db->or_like('d.name', $search);
        $this->db->or_like('e.emergency_type', $search);
        $this->db->or_like('e.description', $search);
        $this->db->or_like('e.status', $search);
        $this->db->or_like('e.priority', $search);
        $this->db->or_like('e.chief_complaint', $search);
        $this->db->group_end();
        
        $query = $this->db->get();
        return $query->result();
    }
}
