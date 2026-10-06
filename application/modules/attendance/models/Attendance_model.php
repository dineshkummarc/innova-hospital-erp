<?php

class Attendance_model extends CI_Model {
    public function updateAttendance($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('attendance', $data);
    }
    function getAttendance() {
        // $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('attendance');
        return $query->result();
    }
    function getAttendanceByYear($staff, $r_year) {
        $this->db->where('staff', $staff);
        $this->db->where('year', $r_year);
        $query = $this->db->get('attendance');
        return $query->result();
    }
    function getAttendanceByMonth($staff, $r_month, $r_year) {
        $this->db->where('staff', $staff);
        $this->db->where('year', $r_year);
        $this->db->where('month', $r_month);
        $query = $this->db->get('attendance');
        return $query->result();
    }
}

