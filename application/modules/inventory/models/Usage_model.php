<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usage_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertUsage($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('usage_logs', $data2);
        return $this->db->insert_id();
    }

    function getUsageLogs($limit = null, $offset = null)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('ul.id', 'desc'); // Newest usage logs first
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        return $query->result();
    } 

    function getUsageLogById($id)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updateUsageLog($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('usage_logs', $data);
    }

    function getUsageLogsByDateRange($start_date, $end_date)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.usage_date >=', $start_date);
        $this->db->where('ul.usage_date <=', $end_date . ' 23:59:59');
        $this->db->order_by('ul.usage_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function deleteUsageLog($id)
    {
        // Get the usage log first to reverse the stock transaction
        $usage = $this->getUsageLogById($id);
        if ($usage) {
            // Add the quantity back to inventory
            $this->db->set('current_stock', 'current_stock + ' . $usage->quantity_used, FALSE);
            $this->db->where('id', $usage->inventory_item_id);
            $this->db->update('inventory_items');

            // Create a reverse stock transaction
            $this->load->model('inventory/inventory_model');
            $transaction_data = array(
                'inventory_item_id' => $usage->inventory_item_id,
                'transaction_type' => 'adjustment',
                'reference_type' => 'usage_reversal',
                'reference_id' => $id,
                'quantity' => $usage->quantity_used,
                'unit_cost' => $usage->unit_cost,
                'total_cost' => $usage->total_cost,
                'previous_stock' => $usage->inventory_item_id, // Will be calculated in model
                'new_stock' => $usage->inventory_item_id, // Will be calculated in model
                'notes' => 'Usage log reversal: ' . $usage->purpose,
                'created_by' => $this->ion_auth->user()->row()->id
            );
            $this->inventory_model->insertStockTransaction($transaction_data);
        }

        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('usage_logs');
    }

    function getUsageByItem($inventory_item_id, $limit = null)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('inventory_item_id', $inventory_item_id);
        $this->db->order_by('usage_date', 'desc');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get('usage_logs');
        return $query->result();
    }

    function getUsageByPatient($patient_id, $limit = null)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.patient_id', $patient_id);
        $this->db->order_by('ul.usage_date', 'desc');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageByDoctor($doctor_id, $limit = null)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.doctor_id', $doctor_id);
        $this->db->order_by('ul.usage_date', 'desc');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageByDepartment($department_id, $limit = null)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.department_id', $department_id);
        $this->db->order_by('ul.usage_date', 'desc');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageByDateRange($start_date, $end_date)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('DATE(ul.usage_date) >=', $start_date);
        $this->db->where('DATE(ul.usage_date) <=', $end_date);
        $this->db->order_by('ul.usage_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageByCategory($category, $start_date = null, $end_date = null)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.category');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ii.category', $category);
        
        if ($start_date) {
            $this->db->where('DATE(ul.usage_date) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(ul.usage_date) <=', $end_date);
        }
        
        $this->db->order_by('ul.usage_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // =================== REPORTING METHODS ===================

    function getDailyUsageReport($date = null)
    {
        if (!$date) {
            $date = date('Y-m-d');
        }

        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(ul.quantity_used) as total_used,
                          SUM(ul.total_cost) as total_cost,
                          COUNT(ul.id) as usage_count');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('DATE(ul.usage_date)', $date);
        $this->db->group_by('ul.inventory_item_id');
        $this->db->order_by('total_used', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getMonthlyUsageReport($year = null, $month = null)
    {
        if (!$year) {
            $year = date('Y');
        }
        if (!$month) {
            $month = date('m');
        }

        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(ul.quantity_used) as total_used,
                          SUM(ul.total_cost) as total_cost,
                          COUNT(DISTINCT DATE(ul.usage_date)) as usage_days,
                          AVG(ul.quantity_used) as avg_daily_usage');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('YEAR(ul.usage_date)', $year);
        $this->db->where('MONTH(ul.usage_date)', $month);
        $this->db->group_by('ul.inventory_item_id');
        $this->db->order_by('total_used', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageTrendByItem($inventory_item_id, $months = 6)
    {
        $start_date = date('Y-m-d', strtotime("-{$months} months"));
        
        $this->db->select('YEAR(usage_date) as year, MONTH(usage_date) as month,
                          SUM(quantity_used) as total_used,
                          SUM(total_cost) as total_cost,
                          COUNT(id) as usage_count');
        $this->db->from('usage_logs');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('inventory_item_id', $inventory_item_id);
        $this->db->where('usage_date >=', $start_date);
        $this->db->group_by(array('YEAR(usage_date)', 'MONTH(usage_date)'));
        $this->db->order_by('year, month', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function getTopUsedItemsByDepartment($department_id, $limit = 10, $start_date = null, $end_date = null)
    {
        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(ul.quantity_used) as total_used,
                          SUM(ul.total_cost) as total_cost');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.department_id', $department_id);
        
        if ($start_date) {
            $this->db->where('DATE(ul.usage_date) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(ul.usage_date) <=', $end_date);
        }

        $this->db->group_by('ul.inventory_item_id');
        $this->db->order_by('total_used', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageByUserType($used_by_type, $start_date = null, $end_date = null)
    {
        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(ul.quantity_used) as total_used,
                          SUM(ul.total_cost) as total_cost,
                          COUNT(ul.id) as usage_count');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ul.used_by_type', $used_by_type);
        
        if ($start_date) {
            $this->db->where('DATE(ul.usage_date) >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('DATE(ul.usage_date) <=', $end_date);
        }

        $this->db->group_by('ul.inventory_item_id');
        $this->db->order_by('total_used', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageCostAnalysis($start_date, $end_date)
    {
        $this->db->select('ii.category,
                          SUM(ul.quantity_used) as total_quantity,
                          SUM(ul.total_cost) as total_cost,
                          AVG(ul.unit_cost) as avg_unit_cost,
                          COUNT(DISTINCT ul.inventory_item_id) as unique_items,
                          COUNT(ul.id) as usage_transactions');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('DATE(ul.usage_date) >=', $start_date);
        $this->db->where('DATE(ul.usage_date) <=', $end_date);
        $this->db->group_by('ii.category');
        $this->db->order_by('total_cost', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function bulkInsertUsage($usage_data_array)
    {
        if (empty($usage_data_array)) {
            return false;
        }

        // Add hospital_id to all records
        foreach ($usage_data_array as &$data) {
            $data['hospital_id'] = $this->session->userdata('hospital_id');
        }

        $this->db->insert_batch('usage_logs', $usage_data_array);
        return $this->db->affected_rows();
    }

    function getUsageStatistics($start_date = null, $end_date = null)
    {
        if (!$start_date) {
            $start_date = date('Y-m-01'); // First day of current month
        }
        if (!$end_date) {
            $end_date = date('Y-m-d'); // Today
        }

        $this->db->select('
            COUNT(ul.id) as total_transactions,
            SUM(ul.quantity_used) as total_quantity_used,
            SUM(ul.total_cost) as total_cost,
            COUNT(DISTINCT ul.inventory_item_id) as unique_items_used,
            COUNT(DISTINCT ul.patient_id) as patients_served,
            COUNT(DISTINCT ul.doctor_id) as doctors_involved,
            COUNT(DISTINCT ul.department_id) as departments_involved
        ');
        $this->db->from('usage_logs ul');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('DATE(ul.usage_date) >=', $start_date);
        $this->db->where('DATE(ul.usage_date) <=', $end_date);
        $query = $this->db->get();
        return $query->row();
    }

    function getPredictedUsage($inventory_item_id, $days = 30)
    {
        // Calculate average daily usage for the last 90 days
        $start_date = date('Y-m-d', strtotime('-90 days'));
        
        $this->db->select('AVG(daily_usage) as avg_daily_usage');
        $this->db->from('(SELECT DATE(usage_date) as usage_day, SUM(quantity_used) as daily_usage 
                          FROM usage_logs 
                          WHERE inventory_item_id = ' . $inventory_item_id . ' 
                          AND hospital_id = ' . $this->session->userdata('hospital_id') . '
                          AND usage_date >= "' . $start_date . '"
                          GROUP BY DATE(usage_date)) as daily_usage_data');
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $avg_daily = $query->row()->avg_daily_usage;
            return $avg_daily * $days;
        }
        return 0;
    }

    // =================== SERVER-SIDE DATATABLE METHODS ===================

    function getUsageLogsWithoutSearch($order, $dir)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($order && $dir) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('ul.id', 'desc'); // Newest usage logs first
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getUsageLogsBySearch($search, $order, $dir)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        
        $this->db->group_start();
        $this->db->like('ii.name', $search);
        $this->db->or_like('ii.item_code', $search);
        $this->db->or_like('ul.purpose', $search);
        $this->db->or_like('ul.used_by_type', $search);
        $this->db->or_like('ul.notes', $search);
        $this->db->group_end();
        
        if ($order && $dir) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('ul.id', 'desc'); // Newest usage logs first
        }
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    function getUsageLogsByLimit($limit, $start, $order, $dir)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($order && $dir) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('ul.id', 'desc'); // Newest usage logs first
        }
        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getUsageLogsByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        $this->db->select('ul.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('usage_logs ul');
        $this->db->join('inventory_items ii', 'ul.inventory_item_id = ii.id');
        $this->db->where('ul.hospital_id', $this->session->userdata('hospital_id'));
        
        $this->db->group_start();
        $this->db->like('ii.name', $search);
        $this->db->or_like('ii.item_code', $search);
        $this->db->or_like('ul.purpose', $search);
        $this->db->or_like('ul.used_by_type', $search);
        $this->db->or_like('ul.notes', $search);
        $this->db->group_end();
        
        if ($order && $dir) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('ul.id', 'desc'); // Newest usage logs first
        }
        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get monthly usage value (current month)
     * @return float
     */
    function getMonthlyUsageValue()
    {
        $start_date = date('Y-m-01');
        $end_date = date('Y-m-t');
        
        $this->db->select('COALESCE(SUM(total_cost), 0) as monthly_usage_value');
        $this->db->from('usage_logs');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('usage_date >=', $start_date);
        $this->db->where('usage_date <=', $end_date . ' 23:59:59');
        $query = $this->db->get();
        
        $result = $query->row();
        return $result ? $result->monthly_usage_value : 0;
    }
}