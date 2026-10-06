<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('radiology_model');
        $this->load->model('settings/settings_model');
        
        if (!$this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist', 'Nurse', 'Doctor', 'Radiologist', 'Technician'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $data['stats'] = $this->radiology_model->getRadiologyStats();
        $data['recent_orders'] = $this->radiology_model->getRadiologyOrders();
        $data['recent_reports'] = $this->radiology_model->getRadiologyReports();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboardv2', $data);
        $this->load->view('radiology/dashboard', $data);
    }

    public function getStats()
    {
        $stats = $this->radiology_model->getRadiologyStats();
        echo json_encode($stats);
    }

    public function getRecentOrders()
    {
        $orders = $this->radiology_model->getRadiologyOrders();
        echo json_encode($orders);
    }

    public function getRecentReports()
    {
        $reports = $this->radiology_model->getRadiologyReports();
        echo json_encode($reports);
    }
}
