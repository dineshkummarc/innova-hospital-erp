<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facilitie_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertFacilitie($data) {

        $this->db->insert('facilitie', $data);
    }

    function getFacilitie() {
        $query = $this->db->get('facilitie');
        return $query->result();
    }

    function getFacilitieById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('facilitie');
        return $query->row();
    }

    function updateFacilitie($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('facilitie', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('facilitie');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getFacilitieByIonUserId($id) {
        $this->db->where('ion_user_id', $id);
        $query = $this->db->get('facilitie');
        return $query->row();
    }

}
