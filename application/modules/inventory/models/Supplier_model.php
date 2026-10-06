<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insertSupplier($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('suppliers', $data2);
        return $this->db->insert_id();
    }

    function getSuppliers()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc'); // Newest suppliers first
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    function getActiveSuppliers()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'active');
        $this->db->order_by('id', 'desc'); // Newest suppliers first
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    function getSupplierById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('suppliers');
        return $query->row();
    }

    function updateSupplier($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('suppliers', $data);
        
        // Return true if update was successful, false otherwise
        return $this->db->affected_rows() > 0;
    }

    function deleteSupplier($id)
    {
        // Check if supplier has any purchase orders
        $this->db->where('supplier_id', $id);
        $po_count = $this->db->count_all_results('purchase_orders');
        
        if ($po_count > 0) {
            return false; // Cannot delete supplier with existing purchase orders
        }

        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('suppliers');
        return true;
    }

    function searchSuppliers($search_term)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_start();
        $this->db->like('name', $search_term);
        $this->db->or_like('company_name', $search_term);
        $this->db->or_like('contact_person', $search_term);
        $this->db->or_like('email', $search_term);
        $this->db->or_like('phone', $search_term);
        $this->db->or_like('city', $search_term);
        $this->db->group_end();
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    function getSupplierPurchaseHistory($supplier_id, $limit = null)
    {
        $this->db->select('po.*, COUNT(poi.id) as total_items, SUM(poi.quantity_ordered) as total_quantity');
        $this->db->from('purchase_orders po');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id', 'left');
        $this->db->where('po.supplier_id', $supplier_id);
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_by('po.id');
        $this->db->order_by('po.order_date', 'desc');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getSupplierBalance($supplier_id)
    {
        $this->db->select('current_balance');
        $this->db->where('id', $supplier_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('suppliers');
        
        if ($query->num_rows() > 0) {
            return $query->row()->current_balance;
        }
        return 0;
    }

    function updateSupplierBalance($supplier_id, $amount, $operation = 'add')
    {
        $current_balance = $this->getSupplierBalance($supplier_id);
        
        if ($operation === 'add') {
            $new_balance = $current_balance + $amount;
        } else {
            $new_balance = $current_balance - $amount;
        }

        $data = array(
            'current_balance' => $new_balance,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->ion_auth->user()->row()->id
        );

        $this->updateSupplier($supplier_id, $data);
        return $new_balance;
    }

    function getSupplierPerformanceReport($supplier_id, $start_date = null, $end_date = null)
    {
        $this->db->select('
            COUNT(po.id) as total_orders,
            SUM(po.grand_total) as total_amount,
            AVG(po.grand_total) as average_order_value,
            AVG(DATEDIFF(po.delivery_date, po.order_date)) as average_delivery_days,
            SUM(CASE WHEN po.status = "completed" THEN 1 ELSE 0 END) as completed_orders,
            SUM(CASE WHEN po.delivery_date <= po.expected_delivery_date THEN 1 ELSE 0 END) as on_time_deliveries
        ');
        $this->db->from('purchase_orders po');
        $this->db->where('po.supplier_id', $supplier_id);
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($start_date) {
            $this->db->where('po.order_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('po.order_date <=', $end_date);
        }

        $query = $this->db->get();
        return $query->row();
    }

    function getSuppliersWithOutstandingBalance()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('current_balance >', 0);
        $this->db->where('status', 'active');
        $this->db->order_by('current_balance', 'desc');
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    function getSuppliersByCategory($category)
    {
        $this->db->select('DISTINCT s.*');
        $this->db->from('suppliers s');
        $this->db->join('purchase_orders po', 's.id = po.supplier_id');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id');
        $this->db->join('inventory_items ii', 'poi.inventory_item_id = ii.id');
        $this->db->where('s.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('s.status', 'active');
        $this->db->where('ii.category', $category);
        $this->db->order_by('s.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function getSupplierPaymentTerms()
    {
        $this->db->select('DISTINCT payment_terms');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('payment_terms IS NOT NULL');
        $this->db->where("payment_terms != ''");
        $query = $this->db->get('suppliers');
        
        $terms = array();
        foreach ($query->result() as $row) {
            $terms[] = $row->payment_terms;
        }
        return $terms;
    }

    // =================== SERVER-SIDE DATATABLE METHODS ===================

    function getSuppliersWithoutSearch($order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest suppliers first
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    function getSuppliersBySearch($search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest suppliers first
        }
        $query = $this->db->select('*')
            ->from('suppliers')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(id LIKE '%" . $search . "%' 
                     OR name LIKE '%" . $search . "%' 
                     OR company_name LIKE '%" . $search . "%' 
                     OR contact_person LIKE '%" . $search . "%' 
                     OR email LIKE '%" . $search . "%' 
                     OR phone LIKE '%" . $search . "%' 
                     OR city LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getSuppliersByLimit($limit, $start, $order, $dir)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest suppliers first
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('suppliers');
        return $query->result();
    }

    function getSuppliersByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest suppliers first
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('suppliers')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where("(id LIKE '%" . $search . "%' 
                     OR name LIKE '%" . $search . "%' 
                     OR company_name LIKE '%" . $search . "%' 
                     OR contact_person LIKE '%" . $search . "%' 
                     OR email LIKE '%" . $search . "%' 
                     OR phone LIKE '%" . $search . "%' 
                     OR city LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    /**
     * Get top suppliers by volume for performance report
     * @param int $limit
     * @param string $start_date
     * @param string $end_date
     * @return array
     */
    function getTopSuppliersByVolume($limit = 20, $start_date = null, $end_date = null)
    {
        $this->db->select('s.name as supplier_name, s.company_name,
                          COUNT(po.id) as total_orders,
                          COALESCE(SUM(po.grand_total), 0) as total_amount,
                          COALESCE(AVG(po.grand_total), 0) as average_order_value');
        $this->db->from('suppliers s');
        $this->db->join('purchase_orders po', 's.id = po.supplier_id', 'left');
        $this->db->where('s.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('s.status', 'active');
        
        if ($start_date) {
            $this->db->where('po.order_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('po.order_date <=', $end_date);
        }

        $this->db->group_by('s.id');
        $this->db->order_by('total_amount', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Get supplier contacts for contact list
     * @return array
     */
    function getSupplierContacts()
    {
        $this->db->select('s.name as supplier_name, s.company_name, s.contact_person, s.email, s.phone, s.address');
        $this->db->from('suppliers s');
        $this->db->where('s.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('s.status', 'active');
        $this->db->order_by('s.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
}