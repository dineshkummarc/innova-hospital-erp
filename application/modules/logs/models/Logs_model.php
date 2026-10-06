<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insertLogs($data) {
       $this->db->insert('logs',$data);
    }
    function getLogsWithoutSearch($order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->where('hospital_id',$hospital_ion_user_id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsBySearch($search, $order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('logs')
                ->where('hospital_id', $hospital_ion_user_id)
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getLogsByLimit($limit, $start, $order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        $this->db->where('hospital_id', $hospital_ion_user_id);
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsByLimitBySearch($limit, $start, $search, $order, $dir) {
        $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('logs')
                ->where('hospital_id', $hospital_ion_user_id)
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
    function getLogsWithoutSearchForSuperadmin($order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
     
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsBySearchForSuperadmin($search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('logs')
              
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getLogsByLimitForSuperadmin($limit, $start, $order, $dir) {
      
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('logs');
        return $query->result();
    }

    function getLogsByLimitBySearchForSuperadmin($limit, $start, $search, $order, $dir) {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('logs')
                
                ->where("(id LIKE '%" . $search . "%' OR name LIKE '%" . $search . "%' OR email LIKE '%" . $search . "%' )", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
    public function insertTransactionLogs($data) {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('transaction_logs', $data2);
       
     }


     function getTransactionLogs() {
         $this->db->where('hospital_id',$this->session->userdata('hospital_id'));
         $this->db->order_by('id', 'desc');
         $query = $this->db->get('transaction_logs');
         return $query->result();
     }



     function getTransactionLogsWithoutSearch($order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->where('hospital_id',$this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('transaction_logs');
        return $query->result();
    }

    function getTransactionLogsBySearch($search, $order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $query = $this->db->select('*')
                ->from('transaction_logs')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%'  OR action LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }

    function getTransactionLogsByLimit($limit, $start, $order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('transaction_logs');
        return $query->result();
    }

    function getTransactionLogsByLimitBySearch($limit, $start, $search, $order, $dir) {
       // $hospital_ion_user_id=$this->db->where('id',$this->session->userdata('hospital_id'))->get('hospital')->row()->ion_user_id;

        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            //$this->db->order_by('id', 'desc');
            $this->db->order_by('name', 'asc');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
                ->from('transaction_logs')
                ->where('hospital_id', $this->session->userdata('hospital_id'))
                ->where("(id LIKE '%" . $search . "%' OR patientname LIKE '%" . $search . "%' OR date_time LIKE '%" . $search . "%' OR deposit_type LIKE '%" . $search . "%' OR invoice_id LIKE '%" . $search . "%'  OR action LIKE '%" . $search . "%')", NULL, FALSE)
                ->get();
        ;
        return $query->result();
    }
}