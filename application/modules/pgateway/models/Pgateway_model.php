<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class pgateway_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getPaymentGatewaySettingsById($id) {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('paymentgateway');
        return $query->row();
    }
    
     function getPaymentGatewaySettingsByName($name) {
         $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('name', $name);
        $query = $this->db->get('paymentgateway');
        return $query->row();
    }

    function getPaymentGatewayByUser($user) {
        $this->db->order_by('id', 'desc');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('user', $user);
        $query = $this->db->get('paymentgateway');
        return $query->result();
    }

    function getPaymentGatewaySettings() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('paymentgateway');
        return $query->row();
    }

    function updatePaymentGatewaySettings($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('paymentgateway', $data);
    }

    function addPaymentGatewaySettings($data) {
        $this->db->insert('paymentgateway', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('paymentgateway');
    }

    function insertPaymentGateway($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('paymentgateway', $data2);
    }

    function getPaymentGateway() {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('paymentgateway');
        return $query->result();
    }

}
