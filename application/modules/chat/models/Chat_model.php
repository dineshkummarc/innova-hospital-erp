<?php

Class Chat_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getName($id) {
        if (empty($id)) {
            return '';
        }
        $this->db->where('id', $id);
        $user = $this->db->get('users')->row();
        return !empty($user->username) ? $user->username : '';
    }
}

