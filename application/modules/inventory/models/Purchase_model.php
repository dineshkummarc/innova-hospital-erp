<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // =================== PURCHASE ORDERS METHODS ===================

    function insertPurchaseOrder($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('purchase_orders', $data2);
        return $this->db->insert_id();
    }

    function getPurchaseOrders()
    {
        $this->db->select('po.*, s.name as supplier_name, s.company_name');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('po.id', 'desc'); // Newest purchase orders first
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseOrderById($id)
    {
        $this->db->select('po.*, s.name as supplier_name, s.company_name, s.contact_person, s.email, s.phone, s.address');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('po.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function getPurchaseOrderByNumber($po_number)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('po_number', $po_number);
        $query = $this->db->get('purchase_orders');
        return $query->row();
    }

    function updatePurchaseOrder($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('purchase_orders', $data);
        return $this->db->affected_rows() > 0;
    }

    function deletePurchaseOrder($id)
    {
        // Delete purchase order items first
        $this->db->where('purchase_order_id', $id);
        $this->db->delete('purchase_order_items');

        // Delete purchase order
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('purchase_orders');
    }

    function getPurchaseOrdersByStatus($status)
    {
        $this->db->select('po.*, s.name as supplier_name');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('po.status', $status);
        $this->db->order_by('po.order_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseOrdersBySupplier($supplier_id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('supplier_id', $supplier_id);
        $this->db->order_by('order_date', 'desc');
        $query = $this->db->get('purchase_orders');
        return $query->result();
    }

    function getPurchaseOrdersByDateRange($start_date, $end_date)
    {
        $this->db->select('po.*, s.name as supplier_name');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('po.order_date >=', $start_date);
        $this->db->where('po.order_date <=', $end_date);
        $this->db->order_by('po.order_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // =================== PURCHASE ORDER ITEMS METHODS ===================

    function insertPurchaseOrderItem($data)
    {
        $this->db->insert('purchase_order_items', $data);
        return $this->db->insert_id();
    }

    function getPurchaseOrderItems($purchase_order_id)
    {
        $this->db->select('poi.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('purchase_order_items poi');
        $this->db->join('inventory_items ii', 'poi.inventory_item_id = ii.id');
        $this->db->where('poi.purchase_order_id', $purchase_order_id);
        $this->db->order_by('ii.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseOrderItemById($id)
    {
        $this->db->select('poi.*, ii.name as item_name, ii.item_code, ii.unit_of_measure');
        $this->db->from('purchase_order_items poi');
        $this->db->join('inventory_items ii', 'poi.inventory_item_id = ii.id');
        $this->db->where('poi.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updatePurchaseOrderItem($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('purchase_order_items', $data);
    }

    function deletePurchaseOrderItem($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('purchase_order_items');
    }

    function receivePurchaseOrderItem($item_id, $quantity_received, $received_by, $notes = '', $batch_number = '', $expiry_date = null)
    {
        $item = $this->getPurchaseOrderItemById($item_id);
        if (!$item) {
            return false;
        }

        $new_received_quantity = $item->quantity_received + $quantity_received;
        
        // Update the purchase order item
        $update_data = array(
            'quantity_received' => $new_received_quantity,
            'received_at' => date('Y-m-d H:i:s'),
            'received_by' => $received_by
        );

        if (!empty($notes)) {
            $update_data['notes'] = $notes;
        }
        if (!empty($batch_number)) {
            $update_data['batch_number'] = $batch_number;
        }
        if (!empty($expiry_date)) {
            $update_data['expiry_date'] = $expiry_date;
        }

        $this->updatePurchaseOrderItem($item_id, $update_data);

        // Update purchase order status if all items are received
        $this->updatePurchaseOrderStatus($item->purchase_order_id);

        return true;
    }

    function updatePurchaseOrderStatus($purchase_order_id)
    {
        // Get all items for this purchase order
        $this->db->select('SUM(quantity_ordered) as total_ordered, SUM(quantity_received) as total_received');
        $this->db->where('purchase_order_id', $purchase_order_id);
        $query = $this->db->get('purchase_order_items');
        $result = $query->row();

        $status = 'sent';
        if ($result->total_received > 0 && $result->total_received < $result->total_ordered) {
            $status = 'partially_received';
        } elseif ($result->total_received >= $result->total_ordered) {
            $status = 'completed';
        }

        $this->updatePurchaseOrder($purchase_order_id, array(
            'status' => $status,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->ion_auth->user()->row()->id
        ));

        // Update delivery date if completed
        if ($status === 'completed') {
            $this->updatePurchaseOrder($purchase_order_id, array(
                'delivery_date' => date('Y-m-d')
            ));
        }
    }

    // =================== VENDOR QUOTATIONS METHODS ===================

    function insertVendorQuotation($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('vendor_quotations', $data2);
        return $this->db->insert_id();
    }

    function getVendorQuotations()
    {
        $this->db->select('vq.*, s.name as supplier_name');
        $this->db->from('vendor_quotations vq');
        $this->db->join('suppliers s', 'vq.supplier_id = s.id');
        $this->db->where('vq.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('vq.quotation_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getVendorQuotationById($id)
    {
        $this->db->select('vq.*, s.name as supplier_name, s.company_name, s.contact_person');
        $this->db->from('vendor_quotations vq');
        $this->db->join('suppliers s', 'vq.supplier_id = s.id');
        $this->db->where('vq.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('vq.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updateVendorQuotation($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('vendor_quotations', $data);
    }

    function deleteVendorQuotation($id)
    {
        // Delete quotation items first
        $this->db->where('quotation_id', $id);
        $this->db->delete('vendor_quotation_items');

        // Delete quotation
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('vendor_quotations');
    }

    function insertVendorQuotationItem($data)
    {
        $this->db->insert('vendor_quotation_items', $data);
        return $this->db->insert_id();
    }

    function getVendorQuotationItems($quotation_id)
    {
        $this->db->select('vqi.*, ii.name as item_name, ii.item_code');
        $this->db->from('vendor_quotation_items vqi');
        $this->db->join('inventory_items ii', 'vqi.inventory_item_id = ii.id');
        $this->db->where('vqi.quotation_id', $quotation_id);
        $this->db->order_by('ii.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function convertQuotationToPurchaseOrder($quotation_id)
    {
        $quotation = $this->getVendorQuotationById($quotation_id);
        if (!$quotation || $quotation->status !== 'accepted') {
            return false;
        }

        $po_data = array(
            'po_number' => $this->generatePurchaseOrderNumber(),
            'supplier_id' => $quotation->supplier_id,
            'order_date' => date('Y-m-d'),
            'status' => 'draft',
            'total_amount' => $quotation->total_amount,
            'tax_amount' => $quotation->tax_amount,
            'discount_amount' => $quotation->discount_amount,
            'grand_total' => $quotation->grand_total,
            'notes' => 'Converted from Quotation #' . $quotation->quotation_number,
            'created_by' => $this->ion_auth->user()->row()->id
        );

        $po_id = $this->insertPurchaseOrder($po_data);

        // Copy quotation items to purchase order items
        $quotation_items = $this->getVendorQuotationItems($quotation_id);
        foreach ($quotation_items as $item) {
            $poi_data = array(
                'purchase_order_id' => $po_id,
                'inventory_item_id' => $item->inventory_item_id,
                'quantity_ordered' => $item->quantity,
                'unit_price' => $item->unit_price,
                'total_price' => $item->total_price,
                'notes' => $item->notes
            );
            $this->insertPurchaseOrderItem($poi_data);
        }

        return $po_id;
    }

    // =================== UTILITY METHODS ===================

    function generatePurchaseOrderNumber()
    {
        $prefix = 'PO' . date('Y');
        
        $this->db->select('po_number');
        $this->db->from('purchase_orders');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->like('po_number', $prefix, 'after');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $last_number = $query->row()->po_number;
            $number = (int)substr($last_number, strlen($prefix));
            $new_number = $number + 1;
        } else {
            $new_number = 1;
        }
        
        return $prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    function generateQuotationNumber()
    {
        $prefix = 'QT' . date('Y');
        
        $this->db->select('quotation_number');
        $this->db->from('vendor_quotations');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->like('quotation_number', $prefix, 'after');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $last_number = $query->row()->quotation_number;
            $number = (int)substr($last_number, strlen($prefix));
            $new_number = $number + 1;
        } else {
            $new_number = 1;
        }
        
        return $prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    function calculatePurchaseOrderTotal($purchase_order_id)
    {
        $this->db->select('SUM(total_price) as total_amount');
        $this->db->where('purchase_order_id', $purchase_order_id);
        $query = $this->db->get('purchase_order_items');
        
        if ($query->num_rows() > 0) {
            return $query->row()->total_amount;
        }
        return 0;
    }

    // =================== REPORTING METHODS ===================

    function getPurchaseReportByDateRange($start_date, $end_date)
    {
        $this->db->select('po.*, s.name as supplier_name, COUNT(poi.id) as total_items');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id', 'left');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('po.order_date >=', $start_date);
        $this->db->where('po.order_date <=', $end_date);
        $this->db->group_by('po.id');
        $this->db->order_by('po.order_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseSummaryBySupplier($start_date = null, $end_date = null)
    {
        $this->db->select('s.name as supplier_name, s.company_name,
                          COUNT(po.id) as total_orders,
                          SUM(po.grand_total) as total_amount,
                          AVG(po.grand_total) as average_order_value');
        $this->db->from('suppliers s');
        $this->db->join('purchase_orders po', 's.id = po.supplier_id');
        $this->db->where('s.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($start_date) {
            $this->db->where('po.order_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('po.order_date <=', $end_date);
        }

        $this->db->group_by('s.id');
        $this->db->order_by('total_amount', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getTopPurchasedItems($limit = 10, $start_date = null, $end_date = null)
    {
        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(poi.quantity_ordered) as total_ordered,
                          SUM(poi.total_price) as total_amount,
                          AVG(poi.unit_price) as average_price');
        $this->db->from('inventory_items ii');
        $this->db->join('purchase_order_items poi', 'ii.id = poi.inventory_item_id');
        $this->db->join('purchase_orders po', 'poi.purchase_order_id = po.id');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        
        if ($start_date) {
            $this->db->where('po.order_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('po.order_date <=', $end_date);
        }

        $this->db->group_by('ii.id');
        $this->db->order_by('total_amount', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    function getPendingDeliveries()
    {
        $this->db->select('po.*, s.name as supplier_name, s.phone, s.email');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where_in('po.status', array('sent', 'confirmed', 'partially_received'));
        $this->db->order_by('po.expected_delivery_date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function getOverdueDeliveries()
    {
        $this->db->select('po.*, s.name as supplier_name, s.phone, s.email');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where_in('po.status', array('sent', 'confirmed', 'partially_received'));
        $this->db->where('po.expected_delivery_date <', date('Y-m-d'));
        $this->db->order_by('po.expected_delivery_date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function deletePurchaseOrderItems($purchase_order_id)
    {
        $this->db->where('purchase_order_id', $purchase_order_id);
        $this->db->delete('purchase_order_items');
        return $this->db->affected_rows();
    }

    // =================== SERVER-SIDE DATATABLE METHODS ===================

    function getPurchaseOrdersWithoutSearch($order, $dir)
    {
        $this->db->select('po.*, s.name as supplier_name, s.company_name, 
                          COALESCE(SUM(poi.quantity_ordered), 0) as total_quantity,
                          COUNT(poi.id) as total_items');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id', 'left');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_by('po.id');
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('po.id', 'desc'); // Newest purchase orders first
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseOrdersBySearch($search, $order, $dir)
    {
        $this->db->select('po.*, s.name as supplier_name, s.company_name,
                          COALESCE(SUM(poi.quantity_ordered), 0) as total_quantity,
                          COUNT(poi.id) as total_items');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id', 'left');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("(po.po_number LIKE '%" . $search . "%' 
                         OR s.name LIKE '%" . $search . "%' 
                         OR s.company_name LIKE '%" . $search . "%' 
                         OR po.status LIKE '%" . $search . "%' 
                         OR po.grand_total LIKE '%" . $search . "%')", NULL, FALSE);
        $this->db->group_by('po.id');
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('po.id', 'desc'); // Newest purchase orders first
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseOrdersByLimit($limit, $start, $order, $dir)
    {
        $this->db->select('po.*, s.name as supplier_name, s.company_name,
                          COALESCE(SUM(poi.quantity_ordered), 0) as total_quantity,
                          COUNT(poi.id) as total_items');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id', 'left');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_by('po.id');
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('po.id', 'desc'); // Newest purchase orders first
        }
        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function getPurchaseOrdersByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        $this->db->select('po.*, s.name as supplier_name, s.company_name,
                          COALESCE(SUM(poi.quantity_ordered), 0) as total_quantity,
                          COUNT(poi.id) as total_items');
        $this->db->from('purchase_orders po');
        $this->db->join('suppliers s', 'po.supplier_id = s.id');
        $this->db->join('purchase_order_items poi', 'po.id = poi.purchase_order_id', 'left');
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where("(po.po_number LIKE '%" . $search . "%' 
                         OR s.name LIKE '%" . $search . "%' 
                         OR s.company_name LIKE '%" . $search . "%' 
                         OR po.status LIKE '%" . $search . "%' 
                         OR po.grand_total LIKE '%" . $search . "%')", NULL, FALSE);
        $this->db->group_by('po.id');
        
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('po.id', 'desc'); // Newest purchase orders first
        }
        
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
}