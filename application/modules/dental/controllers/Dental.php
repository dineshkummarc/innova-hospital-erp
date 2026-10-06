<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dental extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dental/dental_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('settings/settings_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('ion_auth');
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $data = array();
        $data['page'] = 'dental_examination';
        $data['page_title'] = 'Dental Examinations';
        $data['examinations'] = $this->dental_model->getAllExaminations();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('dental_examinations', $data);
        $this->load->view('home/footer');
    }

    public function create_examination()
    {
        $data = array();
        $data['page'] = 'dental_examination';
        $data['page_title'] = 'New Dental Examination';
        $data['patients'] = $this->patient_model->getPatient();
        
        // Check if user is a doctor - if so, only show that doctor
        if ($this->ion_auth->in_group('Doctor')) {
            $current_user_id = $this->ion_auth->get_user_id();
            $current_doctor = $this->doctor_model->getDoctorByIonUserId($current_user_id);
            if ($current_doctor) {
                $data['doctors'] = array($current_doctor);
                $data['selected_doctor_id'] = $current_doctor->id;
            } else {
                $data['doctors'] = array();
                $data['selected_doctor_id'] = null;
            }
        } else {
            // For admin and other roles, show all doctors
            $data['doctors'] = $this->doctor_model->getDoctor();
            $data['selected_doctor_id'] = null;
        }
        
        $data['appointment_types'] = $this->dental_model->getAppointmentTypes();
        $data['treatment_templates'] = $this->dental_model->getTreatmentTemplates();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('create_examination', $data);
        $this->load->view('home/footer');
    }

    public function save_examination()
    {
        $this->form_validation->set_rules('patient_id', 'Patient', 'required|integer');
        $this->form_validation->set_rules('doctor_id', 'Doctor', 'required|integer');
        $this->form_validation->set_rules('examination_date', 'Examination Date', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dental/create_examination');
            return;
        }
        
        $examination_data = array(
            'patient_id' => $this->input->post('patient_id'),
            'doctor_id' => $this->input->post('doctor_id'),
            'hospital_id' => $this->session->userdata('hospital_id') ?: 1,
            'examination_date' => $this->input->post('examination_date'),
            'chief_complaint' => $this->input->post('chief_complaint'),
            'medical_history' => $this->input->post('medical_history'),
            'dental_history' => $this->input->post('dental_history'),
            'extraoral_examination' => $this->input->post('extraoral_examination'),
            'intraoral_examination' => $this->input->post('intraoral_examination'),
            'diagnosis' => $this->input->post('diagnosis'),
            'treatment_plan' => $this->input->post('treatment_plan'),
            'notes' => $this->input->post('notes'),
            'next_appointment' => $this->input->post('next_appointment') ?: null,
            'status' => $this->input->post('status') ?: 'draft',
            'created_by' => $this->ion_auth->get_user_id()
        );
        
        $examination_id = $this->dental_model->saveExamination($examination_data);
        
        if ($examination_id) {
            // Save odontogram data
            $odontogram_data = $this->input->post('odontogram');
            if ($odontogram_data) {
                // Decode JSON string to array
                $decoded_data = json_decode($odontogram_data, true);
                if ($decoded_data) {
                    error_log('Saving odontogram data: ' . print_r($decoded_data, true));
                    $this->dental_model->saveOdontogramData($examination_id, $decoded_data);
                } else {
                    error_log('Failed to decode odontogram JSON: ' . $odontogram_data);
                }
            }
            
            // Save treatments
            $treatments = $this->input->post('treatments');
            if ($treatments) {
                foreach ($treatments as $treatment) {
                    $treatment['examination_id'] = $examination_id;
                    $treatment['created_by'] = $this->ion_auth->get_user_id();
                    $this->dental_model->saveTreatment($treatment);
                }
            }
            
            // Save prescriptions
            $prescriptions = $this->input->post('prescriptions');
            if ($prescriptions) {
                foreach ($prescriptions as $prescription) {
                    $prescription['examination_id'] = $examination_id;
                    $prescription['created_by'] = $this->ion_auth->get_user_id();
                    $this->dental_model->savePrescription($prescription);
                }
            }
            
            $this->session->set_flashdata('success', 'Dental examination saved successfully!');
            redirect('dental/view_examination/' . $examination_id);
        } else {
            $this->session->set_flashdata('error', 'Failed to save dental examination.');
            redirect('dental/create_examination');
        }
    }

    public function view_examination($id = null)
    {
        if (!$id) {
            redirect('dental');
        }
        
        $data = array();
        $data['page'] = 'dental_examination';
        $data['page_title'] = 'View Dental Examination';
        $data['examination'] = $this->dental_model->getExaminationById($id);
        
        if (!$data['examination']) {
            $this->session->set_flashdata('error', 'Examination not found.');
            redirect('dental');
        }
        
        $data['odontogram'] = $this->dental_model->getOdontogramData($id);
        $data['treatments'] = $this->dental_model->getTreatmentsByExamination($id);
        $data['prescriptions'] = $this->dental_model->getPrescriptionsByExamination($id);
        $data['images'] = $this->dental_model->getImagesByExamination($id);
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('view_examination', $data);
        $this->load->view('home/footer');
    }

    public function edit_examination($id = null)
    {
        if (!$id) {
            redirect('dental');
        }
        
        $data = array();
        $data['page'] = 'dental_examination';
        $data['page_title'] = 'Edit Dental Examination';
        $data['examination'] = $this->dental_model->getExaminationById($id);
        
        if (!$data['examination']) {
            $this->session->set_flashdata('error', 'Examination not found.');
            redirect('dental');
        }
        
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['odontogram'] = $this->dental_model->getOdontogramData($id);
        $data['treatments'] = $this->dental_model->getTreatmentsByExamination($id);
        $data['prescriptions'] = $this->dental_model->getPrescriptionsByExamination($id);
        $data['appointment_types'] = $this->dental_model->getAppointmentTypes();
        $data['treatment_templates'] = $this->dental_model->getTreatmentTemplates();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('edit_examination', $data);
        $this->load->view('home/footer');
    }

    public function update_examination($id = null)
    {
        if (!$id) {
            redirect('dental');
        }
        
        $this->form_validation->set_rules('patient_id', 'Patient', 'required|integer');
        $this->form_validation->set_rules('doctor_id', 'Doctor', 'required|integer');
        $this->form_validation->set_rules('examination_date', 'Examination Date', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('dental/edit_examination/' . $id);
            return;
        }
        
        $examination_data = array(
            'patient_id' => $this->input->post('patient_id'),
            'doctor_id' => $this->input->post('doctor_id'),
            'examination_date' => $this->input->post('examination_date'),
            'chief_complaint' => $this->input->post('chief_complaint'),
            'medical_history' => $this->input->post('medical_history'),
            'dental_history' => $this->input->post('dental_history'),
            'extraoral_examination' => $this->input->post('extraoral_examination'),
            'intraoral_examination' => $this->input->post('intraoral_examination'),
            'diagnosis' => $this->input->post('diagnosis'),
            'treatment_plan' => $this->input->post('treatment_plan'),
            'notes' => $this->input->post('notes'),
            'next_appointment' => $this->input->post('next_appointment') ?: null,
            'status' => $this->input->post('status'),
            'updated_by' => $this->ion_auth->get_user_id()
        );
        
        if ($this->dental_model->updateExamination($id, $examination_data)) {
            // Update odontogram data
            $this->dental_model->deleteOdontogramData($id);
            $odontogram_data = $this->input->post('odontogram');
            if ($odontogram_data) {
                // Decode JSON string to array
                $decoded_data = json_decode($odontogram_data, true);
                if ($decoded_data) {
                    error_log('Updating odontogram data: ' . print_r($decoded_data, true));
                    $this->dental_model->saveOdontogramData($id, $decoded_data);
                } else {
                    error_log('Failed to decode odontogram JSON: ' . $odontogram_data);
                }
            }
            
            $this->session->set_flashdata('success', 'Dental examination updated successfully!');
            redirect('dental/view_examination/' . $id);
        } else {
            $this->session->set_flashdata('error', 'Failed to update dental examination.');
            redirect('dental/edit_examination/' . $id);
        }
    }

    public function delete_examination($id = null)
    {
        if (!$id) {
            redirect('dental');
        }
        
        if ($this->dental_model->deleteExamination($id)) {
            $this->session->set_flashdata('success', 'Dental examination deleted successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete dental examination.');
        }
        
        redirect('dental');
    }

    public function patient_history($patient_id = null)
    {
        if (!$patient_id) {
            redirect('dental');
        }
        
        $data = array();
        $data['page'] = 'dental_examination';
        $data['page_title'] = 'Patient Dental History';
        $data['patient'] = $this->patient_model->getPatientById($patient_id);
        
        if (!$data['patient']) {
            $this->session->set_flashdata('error', 'Patient not found.');
            redirect('dental');
        }
        
        $data['examinations'] = $this->dental_model->getExaminationsByPatient($patient_id);
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('patient_history', $data);
        $this->load->view('home/footer');
    }

    public function upload_image($examination_id = null)
    {
        if (!$examination_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid examination ID']);
            return;
        }
        
        $config['upload_path'] = './uploads/dental/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = 2048; // 2MB
        $config['file_name'] = 'dental_' . $examination_id . '_' . time();
        
        // Create directory if it doesn't exist
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }
        
        $this->load->library('upload', $config);
        
        if ($this->upload->do_upload('image')) {
            $upload_data = $this->upload->data();
            
            $image_data = array(
                'examination_id' => $examination_id,
                'image_type' => $this->input->post('image_type') ?: 'other',
                'image_path' => 'uploads/dental/' . $upload_data['file_name'],
                'image_name' => $upload_data['orig_name'],
                'description' => $this->input->post('description'),
                'tooth_number' => $this->input->post('tooth_number'),
                'uploaded_by' => $this->ion_auth->get_user_id()
            );
            
            if ($this->dental_model->saveImage($image_data)) {
                echo json_encode(['success' => true, 'message' => 'Image uploaded successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save image data']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => $this->upload->display_errors()]);
        }
    }

    public function dashboard()
    {
        $data = array();
        $data['page'] = 'dental_dashboard';
        $data['page_title'] = 'Dental Dashboard';
        $data['stats'] = $this->dental_model->getDashboardStats();
        $data['recent_examinations'] = $this->dental_model->getRecentExaminations(10);
        $data['upcoming_appointments'] = $this->dental_model->getUpcomingAppointments();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('dental_dashboard', $data);
        $this->load->view('home/footer');
    }

    public function print_examination($id = null)
    {
        if (!$id) {
            redirect('dental');
        }
        
        $data = array();
        $data['examination'] = $this->dental_model->getExaminationById($id);
        
        if (!$data['examination']) {
            $this->session->set_flashdata('error', 'Examination not found.');
            redirect('dental');
        }
        
        $data['odontogram'] = $this->dental_model->getOdontogramData($id);
        $data['treatments'] = $this->dental_model->getTreatmentsByExamination($id);
        $data['prescriptions'] = $this->dental_model->getPrescriptionsByExamination($id);
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('print_examination', $data);
    }

    public function treatment_plans()
    {
        $data = array();
        $data['page'] = 'dental_treatment_plans';
        $data['page_title'] = 'Dental Treatment Plans';
        $data['treatment_plans'] = $this->dental_model->getAllTreatmentPlans();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('treatment_plans', $data);
        $this->load->view('home/footer');
    }

    public function reports()
    {
        $data = array();
        $data['page'] = 'dental_reports';
        $data['page_title'] = 'Dental Reports';
        $data['monthly_stats'] = $this->dental_model->getMonthlyStats();
        $data['condition_stats'] = $this->dental_model->getConditionStats();
        $data['doctor_stats'] = $this->dental_model->getDoctorStats();
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('dental_reports', $data);
        $this->load->view('home/footer');
    }

    public function update_treatment_status()
    {
        $treatment_id = $this->input->post('treatment_id');
        $status = $this->input->post('status');
        
        if ($treatment_id && $status) {
            $data = array(
                'status' => $status,
                'updated_by' => $this->ion_auth->get_user_id(),
                'updated_at' => date('Y-m-d H:i:s')
            );
            
            if ($status === 'completed') {
                $data['completed_date'] = date('Y-m-d H:i:s');
            }
            
            $result = $this->dental_model->updateTreatment($treatment_id, $data);
            
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Treatment status updated successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to update treatment status']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid parameters']);
        }
    }
}
