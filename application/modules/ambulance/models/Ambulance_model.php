<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ambulance_model extends CI_model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database(); 
    }

    // Ambulance Fleet Management
    function insertAmbulance($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('ambulance', $data2);
        return $this->db->insert_id();
    }

    function getAmbulance()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('ambulance');
        return $query->result();
    }

    function getAmbulanceById($id)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('id', $id);
        $query = $this->db->get('ambulance');
        return $query->row();
    }

    function updateAmbulance($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('ambulance', $data);
    }

    function deleteAmbulance($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('ambulance');
    }

    function getAmbulanceCount()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('ambulance');
        return $query->num_rows();
    }

    function getAvailableAmbulanceCount()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'Available');
        $query = $this->db->get('ambulance');
        return $query->num_rows();
    }

    function getOnCallAmbulanceCount()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'On Call');
        $query = $this->db->get('ambulance');
        return $query->num_rows();
    }

    function getAvailableAmbulances()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'Available');
        $query = $this->db->get('ambulance');
        return $query->result();
    }

    function getAvailableAmbulancesByType($type)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'Available');
        $this->db->where('ambulance_type', $type);
        $query = $this->db->get('ambulance');
        return $query->result();
    }

    function updateAmbulanceStatus($id, $status)
    {
        $this->db->where('id', $id);
        $this->db->update('ambulance', array('status' => $status));
    }

    // Ambulance Service Bookings
    function insertBooking($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('ambulance_bookings', $data2);
        return $this->db->insert_id();
    }

    function getBookings()
    {
        $this->db->select('ab.*, a.vehicle_number, a.driver_name, a.ambulance_type');
        $this->db->from('ambulance_bookings ab');
        $this->db->join('ambulance a', 'a.id = ab.ambulance_id', 'left');
        $this->db->where('ab.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('ab.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getBookingById($id)
    {
        $this->db->select('ab.*, a.vehicle_number, a.driver_name, a.ambulance_type, a.driver_phone');
        $this->db->from('ambulance_bookings ab');
        $this->db->join('ambulance a', 'a.id = ab.ambulance_id', 'left');
        $this->db->where('ab.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ab.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updateBooking($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('ambulance_bookings', $data);
    }

    function deleteBooking($id)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('ambulance_bookings');
    }

    function getBookingCountByStatus($status)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', $status);
        $query = $this->db->get('ambulance_bookings');
        return $query->num_rows();
    }

    function getTotalBookings()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('ambulance_bookings');
        return $query->num_rows();
    }

    function getRecentBookings($limit = 5)
    {
        $this->db->select('ab.*, a.vehicle_number, a.driver_name');
        $this->db->from('ambulance_bookings ab');
        $this->db->join('ambulance a', 'a.id = ab.ambulance_id', 'left');
        $this->db->where('ab.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('ab.created_at', 'desc');
        $this->db->limit($limit);
        $query = $this->db->get();
        return $query->result();
    }

    // Payment Management
    function insertPayment($data)
    {
        $data1 = array('hospital_id' => $this->session->userdata('hospital_id'));
        $data2 = array_merge($data, $data1);
        $this->db->insert('ambulance_payments', $data2);
        return $this->db->insert_id();
    }

    function getPayments()
    {
        $this->db->select('ap.*, ab.booking_number, ab.patient_name, ab.total_fare');
        $this->db->from('ambulance_payments ap');
        $this->db->join('ambulance_bookings ab', 'ab.id = ap.booking_id', 'left');
        $this->db->where('ap.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->order_by('ap.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function updateBookingPaymentStatus($booking_id, $status)
    {
        $this->db->where('id', $booking_id);
        $this->db->update('ambulance_bookings', array('payment_status' => $status));
    }

    function getPaymentById($id)
    {
        $this->db->select('ap.*, ab.booking_number, ab.patient_name, ab.total_fare');
        $this->db->from('ambulance_payments ap');
        $this->db->join('ambulance_bookings ab', 'ab.id = ap.booking_id', 'left');
        $this->db->where('ap.hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ap.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function updatePayment($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->update('ambulance_payments', $data);
    }

    function deletePayment($id)
    {
        $this->db->where('id', $id);
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->delete('ambulance_payments');
        return $this->db->affected_rows() > 0;
    }

    function getTotalRevenue()
    {
        $this->db->select('SUM(amount) as total');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('payment_status', 'Completed');
        $query = $this->db->get('ambulance_payments');
        $result = $query->row();
        return $result->total ? $result->total : 0;
    }

    function getTodayRevenue()
    {
        $this->db->select('SUM(amount) as total');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('payment_status', 'Completed');
        $this->db->where('DATE(payment_date)', date('Y-m-d'));
        $query = $this->db->get('ambulance_payments');
        $result = $query->row();
        return $result->total ? $result->total : 0;
    }

    function getMonthlyBookings()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('MONTH(created_at)', date('n'));
        $this->db->where('YEAR(created_at)', date('Y'));
        $query = $this->db->get('ambulance_bookings');
        return $query->num_rows();
    }

    function getMonthlyBookingsData()
    {
        $this->db->select('MONTH(created_at) as month, COUNT(*) as count');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('YEAR(created_at)', date('Y'));
        $this->db->group_by('MONTH(created_at)');
        $query = $this->db->get('ambulance_bookings');
        
        
        return $query->result();
    }

    function getBookingsByType($date_from = null, $date_to = null, $status = null)
    {
        $this->db->select('booking_type, COUNT(*) as count');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        
        if (!empty($date_from)) {
            $this->db->where('DATE(created_at) >=', $date_from);
        }
        if (!empty($date_to)) {
            $this->db->where('DATE(created_at) <=', $date_to);
        }
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        
        $this->db->group_by('booking_type');
        $query = $this->db->get('ambulance_bookings');
        
        
        return $query->result();
    }

    function getDetailedReports($date_from = null, $date_to = null, $status = null)
    {
        $this->db->select('ab.*, a.vehicle_number, a.driver_name, p.name as patient_name');
        $this->db->from('ambulance_bookings ab');
        $this->db->join('ambulance a', 'a.id = ab.ambulance_id', 'left');
        $this->db->join('patient p', 'p.id = ab.patient_id', 'left');
        $this->db->where('ab.hospital_id', $this->session->userdata('hospital_id'));
        
        if (!empty($date_from)) {
            $this->db->where('DATE(ab.created_at) >=', $date_from);
        }
        if (!empty($date_to)) {
            $this->db->where('DATE(ab.created_at) <=', $date_to);
        }
        if (!empty($status)) {
            $this->db->where('ab.status', $status);
        }
        
        $this->db->order_by('ab.created_at', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getAverageResponseTime($date_from = null, $date_to = null, $status = null)
    {
        $this->db->select('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time');
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('status', 'Completed');
        
        if (!empty($date_from)) {
            $this->db->where('DATE(created_at) >=', $date_from);
        }
        if (!empty($date_to)) {
            $this->db->where('DATE(created_at) <=', $date_to);
        }
        if (!empty($status)) {
            $this->db->where('status', $status);
        }
        
        $query = $this->db->get('ambulance_bookings');
        $result = $query->row();
        return $result->avg_time ? round($result->avg_time) : 0;
    }

    // Rates Management
    function getRates()
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $query = $this->db->get('ambulance_rates');
        $rates = $query->result();
        
        // Map database types to form types
        $type_mapping = array(
            'Basic' => 'Emergency',
            'Advanced' => 'Transfer', 
            'Critical Care' => 'Discharge' 
        );
        
        // Convert to associative array with form type as key
        $formatted_rates = array();
        foreach ($rates as $rate) {
            if (isset($type_mapping[$rate->ambulance_type])) {
                $form_type = $type_mapping[$rate->ambulance_type];
                $formatted_rates[$form_type] = array(
                    'base_rate' => $rate->base_fare,
                    'per_km' => $rate->per_km_rate,
                    'waiting_rate' => $rate->waiting_rate_per_hour,
                    'night_charge' => $rate->night_charge_percentage,
                    'weekend_charge' => $rate->weekend_charge_percentage,
                    'holiday_charge' => $rate->holiday_charge_percentage,
                    'minimum_charge' => $rate->minimum_charge
                );
            }
        }
        
        return $formatted_rates;
    }

    function initializeRatesIfNeeded()
    {
        $hospital_id = $this->session->userdata('hospital_id');
        
        // Check if any rates exist for this hospital
        $this->db->where('hospital_id', $hospital_id);
        $count = $this->db->count_all_results('ambulance_rates');
        
        if ($count == 0) {
            // Initialize default rates for this hospital
            $default_rates = array(
                array(
                    'ambulance_type' => 'Basic',
                    'base_fare' => 50.00,
                    'per_km_rate' => 5.00,
                    'waiting_rate_per_hour' => 20.00,
                    'night_charge_percentage' => 25.00,
                    'weekend_charge_percentage' => 15.00,
                    'holiday_charge_percentage' => 50.00,
                    'minimum_charge' => 50.00,
                    'hospital_id' => $hospital_id,
                    'created_at' => date('Y-m-d H:i:s')
                ),
                array(
                    'ambulance_type' => 'Advanced',
                    'base_fare' => 75.00,
                    'per_km_rate' => 7.50,
                    'waiting_rate_per_hour' => 30.00,
                    'night_charge_percentage' => 25.00,
                    'weekend_charge_percentage' => 15.00,
                    'holiday_charge_percentage' => 50.00,
                    'minimum_charge' => 75.00,
                    'hospital_id' => $hospital_id,
                    'created_at' => date('Y-m-d H:i:s')
                ),
                array(
                    'ambulance_type' => 'Critical Care',
                    'base_fare' => 150.00,
                    'per_km_rate' => 15.00,
                    'waiting_rate_per_hour' => 50.00,
                    'night_charge_percentage' => 25.00,
                    'weekend_charge_percentage' => 15.00,
                    'holiday_charge_percentage' => 50.00,
                    'minimum_charge' => 150.00,
                    'hospital_id' => $hospital_id,
                    'created_at' => date('Y-m-d H:i:s')
                )
            );
            
            $this->db->insert_batch('ambulance_rates', $default_rates);
            log_message('info', 'Initialized default ambulance rates for hospital_id: ' . $hospital_id);
        }
    }

    function updateRate($type, $data)
    {
        $hospital_id = $this->session->userdata('hospital_id');
        
        // Debug logging
        log_message('debug', 'Updating rate for hospital_id: ' . $hospital_id . ', type: ' . $type);
        log_message('debug', 'Data to update: ' . print_r($data, true));
        
        // Check if record exists first
        $this->db->where('hospital_id', $hospital_id);
        $this->db->where('ambulance_type', $type);
        $existing = $this->db->get('ambulance_rates')->row();
        
        if ($existing) {
            // Update existing record
            $this->db->where('hospital_id', $hospital_id);
            $this->db->where('ambulance_type', $type);
            $result = $this->db->update('ambulance_rates', $data);
            log_message('debug', 'Update query: ' . $this->db->last_query());
            log_message('debug', 'Affected rows: ' . $this->db->affected_rows());
            return $result && $this->db->affected_rows() >= 0;
        } else {
            // Insert new record
            $data['hospital_id'] = $hospital_id;
            $data['ambulance_type'] = $type;
            $data['created_at'] = date('Y-m-d H:i:s');
            $result = $this->db->insert('ambulance_rates', $data);
            log_message('debug', 'Insert query: ' . $this->db->last_query());
            log_message('debug', 'Insert ID: ' . $this->db->insert_id());
            return $result;
        }
    }

    function calculateFare($ambulance_type, $distance, $waiting_hours = 0)
    {
        $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
        $this->db->where('ambulance_type', $ambulance_type);
        $query = $this->db->get('ambulance_rates');
        $rate = $query->row();

        if (!$rate) {
            return 0;
        }

        $base_fare = $rate->base_fare;
        $distance_fare = $distance * $rate->per_km_rate;
        $waiting_fare = $waiting_hours * $rate->waiting_rate_per_hour;

        $total_fare = $base_fare + $distance_fare + $waiting_fare;

        // Apply minimum charge
        if ($total_fare < $rate->minimum_charge) {
            $total_fare = $rate->minimum_charge;
        }

        return $total_fare;
    }
}
