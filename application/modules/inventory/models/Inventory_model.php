<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inventory_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // =================== INVENTORY ITEMS METHODS ===================

    function insertInventoryItem($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('inventory_items', $data2);
        return $this->db->insert_id();
    }

    function getInventoryItems()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc'); // Newest items first
        $query = $this->db->get('inventory_items');
        return $query->result();
    }

    function getActiveInventoryItems()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'active');
        $this->db->order_by('id', 'desc'); // Newest items first
        $query = $this->db->get('inventory_items');
        return $query->result();
    }

    function getInventoryItemById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('inventory_items');
        return $query->row();
    }

    function getInventoryItemByCode($item_code)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('item_code', $item_code);
        $query = $this->db->get('inventory_items');
        return $query->row();
    }

    function updateInventoryItem($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('inventory_items', $data);
    }

    function deleteInventoryItem($id)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('inventory_items');
    }

    function getLowStockItems()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('current_stock <=', 'reorder_level', FALSE);
        $this->db->where('status', 'active');
        $this->db->order_by('current_stock', 'asc');
        $query = $this->db->get('inventory_items');
        return $query->result();
    }

    function getInventoryItemsByCategory($category)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('category', $category);
        $this->db->where('status', 'active');
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('inventory_items');
        return $query->result();
    }

    function searchInventoryItems($search_term)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->group_start();
        $this->db->like('name', $search_term);
        $this->db->or_like('item_code', $search_term);
        $this->db->or_like('description', $search_term);
        $this->db->or_like('category', $search_term);
        $this->db->or_like('manufacturer', $search_term);
        $this->db->or_like('brand', $search_term);
        $this->db->group_end();
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('inventory_items');
        return $query->result();
    }

    // =================== INVENTORY CATEGORIES METHODS ===================

    function insertInventoryCategory($data)
    {
        try {
            // Ensure hospital_id is set
            if (!isset($data['hospital_id']) || empty($data['hospital_id'])) {
                $data['hospital_id'] = $this->session->userdata('hospital_id');
            }
            
            // Set default values if not provided
            if (!isset($data['status']) || empty($data['status'])) {
                $data['status'] = 'active';
            }
            
            if (!isset($data['created_at'])) {
                $data['created_at'] = date('Y-m-d H:i:s');
            }
            
            $this->db->insert('inventory_categories', $data);
            
            // Check if insert was successful
            if ($this->db->affected_rows() > 0) {
                return $this->db->insert_id();
            } else {
                log_message('error', 'No rows affected in insertInventoryCategory');
                return false;
            }
        } catch (Exception $e) {
            log_message('error', 'Exception in insertInventoryCategory: ' . $e->getMessage());
            return false;
        }
    }

    function getInventoryCategories()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'active');
        $this->db->order_by('id', 'desc'); // Newest categories first
        $query = $this->db->get('inventory_categories');
        return $query->result();
    }

    function getInventoryCategoryById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('inventory_categories');
        return $query->row();
    }

    function updateInventoryCategory($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('inventory_categories', $data);
    }

    function deleteInventoryCategory($id)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('inventory_categories');
    }

    function getSubcategories($parent_id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('parent_id', $parent_id);
        $this->db->where('status', 'active');
        $query = $this->db->get('inventory_categories');
        return $query->result();
    }

    // =================== SERVER-SIDE DATATABLE METHODS FOR CATEGORIES ===================

    function getCategoriesWithoutSearch($order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest categories first
        }
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'active');
        $query = $this->db->get('inventory_categories');
        return $query->result();
    }

    function getCategoriesBySearch($search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest categories first
        }
        $query = $this->db->select('*')
            ->from('inventory_categories')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where('status', 'active')
            ->where("(id LIKE '%" . $search . "%' 
                     OR name LIKE '%" . $search . "%' 
                     OR description LIKE '%" . $search . "%' 
                     OR status LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    function getCategoriesByLimit($limit, $start, $order, $dir)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'active');
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest categories first
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('inventory_categories');
        return $query->result();
    }

    function getCategoriesByLimitBySearch($limit, $start, $search, $order, $dir)
    {
        if ($order != null) {
            $this->db->order_by($order, $dir);
        } else {
            $this->db->order_by('id', 'desc'); // Newest categories first
        }
        $this->db->limit($limit, $start);
        $query = $this->db->select('*')
            ->from('inventory_categories')
            ->where('hospital_id', $this->session->userdata('hospital_id'))
            ->where('status', 'active')
            ->where("(id LIKE '%" . $search . "%' 
                     OR name LIKE '%" . $search . "%' 
                     OR description LIKE '%" . $search . "%' 
                     OR status LIKE '%" . $search . "%')", NULL, FALSE)
            ->get();
        return $query->result();
    }

    // =================== STOCK TRANSACTIONS METHODS ===================

    function insertStockTransaction($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('stock_transactions', $data2);
        return $this->db->insert_id();
    }

    function getStockTransactions($limit = null, $offset = null)
    {
        $this->db->select('st.*, ii.name as item_name, ii.item_code');
        $this->db->from('stock_transactions st');
        $this->db->join('inventory_items ii', 'st.inventory_item_id = ii.id');
        $this->db->where('st.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('st.transaction_date', 'desc');
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function getStockTransactionsByItem($inventory_item_id, $limit = null)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('inventory_item_id', $inventory_item_id);
        $this->db->order_by('transaction_date', 'desc');
        if ($limit) {
            $this->db->limit($limit);
        }
        $query = $this->db->get('stock_transactions');
        return $query->result();
    }

    function getStockTransactionsByDateRange($start_date, $end_date)
    {
        $this->db->select('st.*, ii.name as item_name, ii.item_code');
        $this->db->from('stock_transactions st');
        $this->db->join('inventory_items ii', 'st.inventory_item_id = ii.id');
        $this->db->where('st.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('DATE(st.transaction_date) >=', $start_date);
        $this->db->where('DATE(st.transaction_date) <=', $end_date);
        $this->db->order_by('st.transaction_date', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    // =================== REPORTING METHODS ===================

    function getInventoryValuation()
    {
        $this->db->select('ii.*, (ii.current_stock * ii.unit_cost) as total_value');
        $this->db->from('inventory_items ii');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ii.status', 'active');
        $this->db->order_by('total_value', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getInventoryMovementReport($start_date, $end_date)
    {
        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(CASE WHEN st.transaction_type = "purchase" THEN st.quantity ELSE 0 END) as purchased,
                          SUM(CASE WHEN st.transaction_type = "usage" THEN ABS(st.quantity) ELSE 0 END) as used,
                          SUM(CASE WHEN st.transaction_type = "adjustment" THEN st.quantity ELSE 0 END) as adjusted,
                          ii.current_stock');
        $this->db->from('inventory_items ii');
        $this->db->join('stock_transactions st', 'ii.id = st.inventory_item_id', 'left');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('DATE(st.transaction_date) >=', $start_date);
        $this->db->where('DATE(st.transaction_date) <=', $end_date);
        $this->db->group_by('ii.id');
        $this->db->order_by('ii.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function getTopUsedItems($limit = 10, $start_date = null, $end_date = null)
    {
        $this->db->select('ii.name as item_name, ii.item_code, ii.category,
                          SUM(ABS(st.quantity)) as total_used,
                          SUM(st.total_cost) as total_cost');
        $this->db->from('inventory_items ii');
        $this->db->join('stock_transactions st', 'ii.id = st.inventory_item_id');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('st.transaction_type', 'usage');
        if ($start_date && $end_date) {
            $this->db->where('DATE(st.transaction_date) >=', $start_date);
            $this->db->where('DATE(st.transaction_date) <=', $end_date);
        }
        $this->db->group_by('ii.id');
        $this->db->order_by('total_used', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // =================== UTILITY METHODS ===================

    function generateItemCode($category_prefix = 'ITM')
    {
        $this->db->select('item_code');
        $this->db->from('inventory_items');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->like('item_code', $category_prefix, 'after');
        $this->db->order_by('id', 'desc');
        $this->db->limit(1);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            $last_code = $query->row()->item_code;
            $number = (int)substr($last_code, strlen($category_prefix));
            $new_number = $number + 1;
        } else {
            $new_number = 1;
        }
        
        return $category_prefix . str_pad($new_number, 4, '0', STR_PAD_LEFT);
    }

    function adjustStock($inventory_item_id, $new_quantity, $reason, $notes = '')
    {
        $item = $this->getInventoryItemById($inventory_item_id);
        if (!$item) {
            return false;
        }

        $adjustment_quantity = $new_quantity - $item->current_stock;
        
        // Update the inventory item stock
        $this->updateInventoryItem($inventory_item_id, array(
            'current_stock' => $new_quantity,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->ion_auth->user()->row()->id
        ));

        // Record the stock transaction
        $transaction_data = array(
            'inventory_item_id' => $inventory_item_id,
            'transaction_type' => 'adjustment',
            'reference_type' => 'manual_adjustment',
            'quantity' => $adjustment_quantity,
            'unit_cost' => $item->unit_cost,
            'total_cost' => $adjustment_quantity * $item->unit_cost,
            'previous_stock' => $item->current_stock,
            'new_stock' => $new_quantity,
            'notes' => $reason . (!empty($notes) ? ': ' . $notes : ''),
            'created_by' => $this->ion_auth->user()->row()->id
        );

        return $this->insertStockTransaction($transaction_data);
    }

    function getItemsRequiringReorder()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('current_stock <=', 'reorder_level', FALSE);
        $this->db->where('status', 'active');
        $this->db->where('reorder_level >', 0);
        $this->db->order_by('(reorder_level - current_stock)', 'desc');
        $query = $this->db->get('inventory_items');
        return $query->result();
    }

    function getExpiredItems()
    {
        $this->db->select('st.*, ii.name as item_name, ii.item_code');
        $this->db->from('stock_transactions st');
        $this->db->join('inventory_items ii', 'st.inventory_item_id = ii.id');
        $this->db->where('st.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('st.expiry_date <', date('Y-m-d'));
        $this->db->where('st.quantity >', 0); // Only show positive stock (not already used)
        $this->db->order_by('st.expiry_date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function getExpiringItems($days = 30)
    {
        $expiry_date = date('Y-m-d', strtotime("+{$days} days"));
        
        $this->db->select('st.*, ii.name as item_name, ii.item_code');
        $this->db->from('stock_transactions st');
        $this->db->join('inventory_items ii', 'st.inventory_item_id = ii.id');
        $this->db->where('st.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('st.expiry_date <=', $expiry_date);
        $this->db->where('st.expiry_date >=', date('Y-m-d'));
        $this->db->where('st.quantity >', 0); // Only show positive stock
        $this->db->order_by('st.expiry_date', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    // =================== STOCK CALCULATION METHODS ===================

    /**
     * Calculate real-time current stock for an item
     * Formula: Total Purchases - Total Usage
     * @param int $item_id
     * @return float
     */
    function calculateCurrentStock($item_id)
    {
        // Calculate total purchases (received quantities)
        $this->db->select('COALESCE(SUM(poi.quantity_received), 0) as total_purchases');
        $this->db->from('purchase_order_items poi');
        $this->db->join('purchase_orders po', 'poi.purchase_order_id = po.id');
        $this->db->where('poi.inventory_item_id', $item_id);
        $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
        $purchases_query = $this->db->get();
        $total_purchases = $purchases_query->row()->total_purchases ?: 0;

        // Calculate total usage
        $this->db->select('COALESCE(SUM(quantity_used), 0) as total_usage');
        $this->db->from('usage_logs');
        $this->db->where('inventory_item_id', $item_id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $usage_query = $this->db->get();
        $total_usage = $usage_query->row()->total_usage ?: 0;

        // Calculate current stock
        $current_stock = $total_purchases - $total_usage;
        
        // Ensure stock is never negative
        return max(0, $current_stock);
    }

    /**
     * Get calculated current stock for multiple items
     * @param array $item_ids
     * @return array associative array with item_id => current_stock
     */
    function calculateCurrentStockBulk($item_ids = null)
    {
        if (empty($item_ids)) {
            // Get all active items if no specific items requested
            $this->db->select('id');
            $this->db->from('inventory_items');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->where('status', 'active');
            $query = $this->db->get();
            $item_ids = array_column($query->result_array(), 'id');
        }

        $stock_data = array();

        if (!empty($item_ids)) {
            // Calculate purchases for all items
            $this->db->select('poi.inventory_item_id, COALESCE(SUM(poi.quantity_received), 0) as total_purchases');
            $this->db->from('purchase_order_items poi');
            $this->db->join('purchase_orders po', 'poi.purchase_order_id = po.id');
            $this->db->where_in('poi.inventory_item_id', $item_ids);
            $this->db->where('po.hospital_id', $this->session->userdata('hospital_id'));
            $this->db->group_by('poi.inventory_item_id');
            $purchases_query = $this->db->get();
            $purchases_data = array();
            foreach ($purchases_query->result() as $row) {
                $purchases_data[$row->inventory_item_id] = $row->total_purchases;
            }

            // Calculate usage for all items
            $this->db->select('inventory_item_id, COALESCE(SUM(quantity_used), 0) as total_usage');
            $this->db->from('usage_logs');
            $this->db->where_in('inventory_item_id', $item_ids);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->group_by('inventory_item_id');
            $usage_query = $this->db->get();
            $usage_data = array();
            foreach ($usage_query->result() as $row) {
                $usage_data[$row->inventory_item_id] = $row->total_usage;
            }

            // Calculate current stock for each item
            foreach ($item_ids as $item_id) {
                $total_purchases = isset($purchases_data[$item_id]) ? $purchases_data[$item_id] : 0;
                $total_usage = isset($usage_data[$item_id]) ? $usage_data[$item_id] : 0;
                $stock_data[$item_id] = max(0, $total_purchases - $total_usage);
            }
        }

        return $stock_data;
    }

    /**
     * Get active inventory items with calculated current stock
     * @return array
     */
    function getActiveInventoryItemsWithCalculatedStock()
    {
        // Get all active items
        $items = $this->getActiveInventoryItems();
        
        if (!empty($items)) {
            // Get item IDs
            $item_ids = array_column($items, 'id');
            
            // Calculate current stock for all items
            $calculated_stocks = $this->calculateCurrentStockBulk($item_ids);
            
            // Add calculated stock to each item
            foreach ($items as $item) {
                $item->calculated_current_stock = isset($calculated_stocks[$item->id]) ? $calculated_stocks[$item->id] : 0;
            }
        }
        
        return $items;
    }

    /**
     * Get total inventory value (current stock * unit cost)
     * @return float
     */
    function getTotalInventoryValue()
    {
        $this->db->select('SUM(ii.current_stock * ii.unit_cost) as total_value');
        $this->db->from('inventory_items ii');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ii.status', 'active');
        $query = $this->db->get();
        
        $result = $query->row();
        return $result ? $result->total_value : 0;
    }

    // =================== STOCK UPDATE METHODS ===================

    /**
     * Update stock quantity for an inventory item
     * @param int $item_id
     * @param float $quantity_change (positive for increase, negative for decrease)
     * @param string $transaction_type
     * @param string $reference_type
     * @param int $reference_id
     * @param string $notes
     * @return bool
     */
    function updateItemStock($item_id, $quantity_change, $transaction_type = 'adjustment', $reference_type = 'manual', $reference_id = null, $notes = '')
    {
        // Get current item details
        $item = $this->getInventoryItemById($item_id);
        if (!$item) {
            return false;
        }

        $previous_stock = $item->current_stock;
        $new_stock = $previous_stock + $quantity_change;

        // Prevent negative stock
        if ($new_stock < 0) {
            return false;
        }

        try {
            $this->db->trans_start();

            // Update inventory item current stock
            $this->db->where('id', $item_id);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $this->db->update('inventory_items', array(
                'current_stock' => $new_stock,
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => $this->session->userdata('user_id') ?: 1
            ));

            // Create stock transaction record
            $transaction_data = array(
                'inventory_item_id' => $item_id,
                'transaction_type' => $transaction_type,
                'reference_type' => $reference_type,
                'reference_id' => $reference_id,
                'quantity' => abs($quantity_change),
                'unit_cost' => $item->unit_cost,
                'total_cost' => abs($quantity_change) * $item->unit_cost,
                'previous_stock' => $previous_stock,
                'new_stock' => $new_stock,
                'notes' => $notes,
                'hospital_id' => $this->session->userdata('hospital_id'),
                'created_by' => $this->session->userdata('user_id') ?: 1,
                'created_at' => date('Y-m-d H:i:s')
            );

            $this->insertStockTransaction($transaction_data);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return false;
            }

            return true;
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'Stock update failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Increase stock (e.g., when purchase is received)
     */
    function increaseStock($item_id, $quantity, $reference_type = 'purchase', $reference_id = null, $notes = '')
    {
        return $this->updateItemStock($item_id, $quantity, 'in', $reference_type, $reference_id, $notes);
    }

    /**
     * Decrease stock (e.g., when usage is logged)
     */
    function decreaseStock($item_id, $quantity, $reference_type = 'usage', $reference_id = null, $notes = '')
    {
        return $this->updateItemStock($item_id, -$quantity, 'out', $reference_type, $reference_id, $notes);
    }

    // =================== SERVER-SIDE DATATABLE METHODS ===================

    function getInventoryItemsWithPagination($limit = null, $start = null, $order_column = 'name', $order_dir = 'asc')
    {
        $this->db->select('ii.*, ii.category as category_name');
        $this->db->from('inventory_items ii');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by($order_column, $order_dir);
        
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getInventoryItemsBySearch($search, $order_column = 'name', $order_dir = 'asc', $limit = null, $start = null)
    {
        $this->db->select('ii.*, ii.category as category_name');
        $this->db->from('inventory_items ii');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        
        $this->db->group_start();
        $this->db->like('ii.name', $search);
        $this->db->or_like('ii.item_code', $search);
        $this->db->or_like('ii.description', $search);
        $this->db->or_like('ii.category', $search);
        $this->db->or_like('ii.manufacturer', $search);
        $this->db->or_like('ii.brand', $search);
        $this->db->group_end();
        
        $this->db->order_by($order_column, $order_dir);
        
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        return $query->result();
    }

    function getInventoryItemsCount()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        return $this->db->count_all_results('inventory_items');
    }

    function getInventoryItemsSearchCount($search)
    {
        $this->db->select('COUNT(*) as count');
        $this->db->from('inventory_items ii');
        $this->db->where('ii.hospital_id', $this->session->userdata('hospital_id'));
        
        $this->db->group_start();
        $this->db->like('ii.name', $search);
        $this->db->or_like('ii.item_code', $search);
        $this->db->or_like('ii.description', $search);
        $this->db->or_like('ii.category', $search);
        $this->db->or_like('ii.manufacturer', $search);
        $this->db->or_like('ii.brand', $search);
        $this->db->group_end();
        
        $query = $this->db->get();
        return $query->row()->count;
    }
}