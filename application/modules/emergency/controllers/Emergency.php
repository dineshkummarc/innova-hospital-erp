<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emergency extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('emergency_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $this->load->view('home/dashboard');
        $this->load->view('emergency');
        $this->load->view('home/footer');
    }

    public function getEmergencyData()
    {
        try {
            // Get DataTables parameters
            $requestData = $_REQUEST;
            $draw = intval($requestData['draw']);
            $start = intval($requestData['start']);
            $length = intval($requestData['length']);
            $search_value = $this->input->post("search")["value"];
            
            // Get ordering parameters
            $order = $this->input->post("order");
            $columns_valid = array(
                "0" => "e.id",
                "1" => "p.name", 
                "2" => "d.name",
                "3" => "e.emergency_type",
                "4" => "e.description",
                "5" => "e.status",
                "6" => "e.priority"
            );
            
            $order_column_name = 'e.id';
            $order_dir = 'desc';
            
            if (!empty($order) && isset($order[0])) {
                $order_column = $order[0]["column"];
                $order_dir = $order[0]["dir"];
                $order_column_name = isset($columns_valid[$order_column]) ? $columns_valid[$order_column] : 'e.id';
            }
            
            // Get data based on search and pagination
            if ($length == -1) {
                // Show all records
                if (!empty($search_value)) {
                    $emergencies = $this->emergency_model->getEmergencyBySearch($search_value, $order_column_name, $order_dir);
                } else {
                    $emergencies = $this->emergency_model->getEmergencyByLimit($start, $length, $order_column_name, $order_dir);
                }
            } else {
                // Paginated results
                if (!empty($search_value)) {
                    $emergencies = $this->emergency_model->getEmergencyByLimitBySearch($length, $start, $search_value, $order_column_name, $order_dir);
                } else {
                    $emergencies = $this->emergency_model->getEmergencyByLimit($start, $length, $order_column_name, $order_dir);
                }
            }
            
            // Prepare data for DataTables
            $data = array();
            $i = 0;
            foreach ($emergencies as $emergency) {
                // Status badge
                $status_badge = '';
                switch ($emergency->status) {
                    case 'Active':
                        $status_badge = '<span class="badge badge-success">' . $emergency->status . '</span>';
                        break;
                    case 'Critical':
                        $status_badge = '<span class="badge badge-danger">' . $emergency->status . '</span>';
                        break;
                    case 'Resolved':
                        $status_badge = '<span class="badge badge-info">' . $emergency->status . '</span>';
                        break;
                    case 'Pending':
                        $status_badge = '<span class="badge badge-warning">' . $emergency->status . '</span>';
                        break;
                    default:
                        $status_badge = '<span class="badge badge-secondary">' . $emergency->status . '</span>';
                        break;
                }
                
                // Priority badge
                $priority_badge = '';
                switch ($emergency->priority) {
                    case 'Critical':
                        $priority_badge = '<span class="badge badge-danger">' . lang($emergency->priority) . '</span>';
                        break;
                    case 'High':
                        $priority_badge = '<span class="badge badge-warning">' . lang($emergency->priority) . '</span>';
                        break;
                    case 'Medium':
                        $priority_badge = '<span class="badge badge-info">' . lang($emergency->priority) . '</span>';
                        break;
                    case 'Low':
                        $priority_badge = '<span class="badge badge-success">' . lang($emergency->priority) . '</span>';
                        break;
                    default:
                        $priority_badge = '<span class="badge badge-secondary">' . $emergency->priority . '</span>';
                        break;
                }
                
                // Action buttons
                $actions = '
                    <div class="btn-group" role="group">
                        <a class="btn btn-info btn-xs" href="emergency/viewEmergency?id=' . $emergency->id . '" title="View Details">
                            <i class="fa fa-eye"></i> '. lang('view').
                        '</a>
                        <a class="btn btn-warning btn-xs" href="emergency/editEmergency?id=' . $emergency->id . '" title="Edit">
                            <i class="fa fa-edit"></i>  '. lang('edit').
                       ' </a>
                        <a class="btn btn-danger btn-xs" href="emergency/deleteEmergency?id=' . $emergency->id . '" onclick="return confirm(\'Are you sure?\')" title="Delete">
                            <i class="fa fa-trash"></i>'  . lang('delete').'
                        </a>
                    </div>
                ';
                
                // Format description
                $description = !empty($emergency->description) ? $emergency->description : 'No description';
                if (strlen($description) > 50) {
                    $description = substr($description, 0, 50) . '...';
                }
                
                $data[] = array(
                    $emergency->id,
                    !empty($emergency->patient_name) ? $emergency->patient_name : 'N/A',
                    !empty($emergency->doctor_name) ? $emergency->doctor_name : 'N/A',
                    $emergency->emergency_type,
                    $description,
                    $status_badge,
                    $priority_badge,
                    $actions
                );
                $i++;
            }
            
            // Get total counts
            $total_records = $this->emergency_model->getEmergencyCount();
            $filtered_records = !empty($search_value) ? $this->emergency_model->getEmergencyFilteredCount($search_value) : $total_records;
            
            $output = array(
                "draw" => $draw,
                "recordsTotal" => $total_records,
                "recordsFiltered" => $filtered_records,
                "data" => $data
            );
            
            echo json_encode($output);
            
        } catch (Exception $e) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => [],
                "error" => "An error occurred while loading emergency data"
            );
            echo json_encode($output);
        }
    }

    public function addNewView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('add_new');
        $this->load->view('home/footer');
    }

    public function createNewPatient()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $age = $this->input->post('age');
        $sex = $this->input->post('sex');
        $blood_group = $this->input->post('blood_group');
        $address = $this->input->post('address');
        $medical_history = $this->input->post('medical_history');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required|numeric');
        $this->form_validation->set_rules('sex', 'Gender', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'success' => false,
                'message' => 'Please fill in all required fields'
            ]);
            return;
        }

        // Generate patient ID and other required fields
        $patient_id = rand(10000, 1000000);
        $email = $name . '@' . $phone . '.com';
        $password = 12345;
        $add_date = date('m/d/y');
        $registration_time = time();
        $birthdate = date('Y-m-d', strtotime('-' . $age . ' years'));

        $data = array(
            'patient_id' => $patient_id,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'sex' => $sex,
            'age' => $age,
            'birthdate' => $birthdate,
            'bloodgroup' => $blood_group,
            'address' => $address,
            'medical_history' => $medical_history,
            'add_date' => $add_date,
            'registration_time' => $registration_time,
            'payment_confirmation' => 'Active',
            'appointment_confirmation' => 'Active',
            'appointment_creation' => 'Active',
            'meeting_schedule' => 'Active'
        );

        try {
            // Insert patient
            $this->patient_model->insertPatient($data);
            
            // Get the inserted patient ID
            $this->db->where('patient_id', $patient_id);
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $inserted_patient = $this->db->get('patient')->row();
            
            if ($inserted_patient) {
                echo json_encode([
                    'success' => true,
                    'patient_id' => $inserted_patient->id,
                    'patient' => $inserted_patient,
                    'message' => 'Patient created successfully'
                ]);
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Patient created but could not retrieve data'
                ]);
            }
        } catch (Exception $e) {
            log_message('error', 'Emergency createNewPatient error: ' . $e->getMessage());
            echo json_encode([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }
    }

    public function addNew()
    {
        $id = $this->input->post('id');
        $patient_id = $this->input->post('patient_id'); // This is actually the patient table's primary key (id)
        $doctor_id = $this->input->post('doctor_id');
        $emergency_type = $this->input->post('emergency_type');
        $priority = $this->input->post('priority');
        $status = $this->input->post('status');
        $emergency_time = $this->input->post('emergency_time');
        $arrival_time = $this->input->post('arrival_time');
        $location = $this->input->post('location');
        
        // Vital Signs
        $blood_pressure = $this->input->post('blood_pressure');
        $heart_rate = $this->input->post('heart_rate');
        $temperature = $this->input->post('temperature');
        $oxygen_saturation = $this->input->post('oxygen_saturation');
        
        // Symptoms and Presentation
        $chief_complaint = $this->input->post('chief_complaint');
        $symptoms = $this->input->post('symptoms');
        $medical_history = $this->input->post('medical_history');
        $allergies = $this->input->post('allergies');
        
        // Treatment and Medications
        $treatment_given = $this->input->post('treatment_given');
        $medications = $this->input->post('medications');
        
        // Additional Information
        $notes = $this->input->post('notes');
        $follow_up = $this->input->post('follow_up');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_rules('patient_id', 'Patient', 'required');
        $this->form_validation->set_rules('doctor_id', 'Doctor', 'required');
        $this->form_validation->set_rules('emergency_type', 'Emergency Type', 'required');
        $this->form_validation->set_rules('priority', 'Priority', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('emergency_time', 'Emergency Time', 'required');
        $this->form_validation->set_rules('chief_complaint', 'Chief Complaint', 'required');
        $this->form_validation->set_rules('description', 'Description', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['setval'] = 'setval';
            $data['patient_id'] = $patient_id;
            $data['doctor_id'] = $doctor_id;
            $data['emergency_type'] = $emergency_type;
            $data['priority'] = $priority;
            $data['status'] = $status;
            $data['emergency_time'] = $emergency_time;
            $data['arrival_time'] = $arrival_time;
            $data['location'] = $location;
            $data['blood_pressure'] = $blood_pressure;
            $data['heart_rate'] = $heart_rate;
            $data['temperature'] = $temperature;
            $data['oxygen_saturation'] = $oxygen_saturation;
            $data['chief_complaint'] = $chief_complaint;
            $data['symptoms'] = $symptoms;
            $data['medical_history'] = $medical_history;
            $data['allergies'] = $allergies;
            $data['treatment_given'] = $treatment_given;
            $data['medications'] = $medications;
            $data['notes'] = $notes;
            $data['follow_up'] = $follow_up;
            $data['description'] = $description;
            $this->load->view('home/dashboard');
            $this->load->view('add_new', $data);
            $this->load->view('home/footer');
        } else {
            $data = array(
                'patient_id' => $patient_id,
                'doctor_id' => $doctor_id,
                'emergency_type' => $emergency_type,
                'priority' => $priority,
                'status' => $status,
                'emergency_time' => $emergency_time,
                'arrival_time' => $arrival_time,
                'location' => $location,
                'blood_pressure' => $blood_pressure,
                'heart_rate' => $heart_rate,
                'temperature' => $temperature,
                'oxygen_saturation' => $oxygen_saturation,
                'chief_complaint' => $chief_complaint,
                'symptoms' => $symptoms,
                'medical_history' => $medical_history,
                'allergies' => $allergies,
                'treatment_given' => $treatment_given,
                'medications' => $medications,
                'notes' => $notes,
                'follow_up' => $follow_up,
                'description' => $description,
            );

            if (empty($id)) {
                $this->emergency_model->insertEmergency($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else {
                $this->emergency_model->updateEmergency($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }

            redirect('emergency');
        }
    }

    function getEmergency()
    {
        $data['emergencies'] = $this->emergency_model->getEmergency();
        $this->load->view('emergency', $data);
    }

    function editEmergency()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['emergency'] = $this->emergency_model->getEmergencyById($id);
        $this->load->view('home/dashboard');
        $this->load->view('edit_emergency', $data);
        $this->load->view('home/footer');
    }

    function viewEmergency()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['emergency'] = $this->emergency_model->getEmergencyById($id);
        $this->load->view('home/dashboard');
        $this->load->view('view_emergency', $data);
        $this->load->view('home/footer');
    }

    function editEmergencyByJason()
    {
        $id = $this->input->get('id');
        $data['emergency'] = $this->emergency_model->getEmergencyById($id);
        echo json_encode($data);
    }

    function deleteEmergency()
    {
        $id = $this->input->get('id');
        $this->emergency_model->deleteEmergency($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('emergency');
    }

    function getEmergencyList()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));

        $emergencies = $this->emergency_model->getEmergencyForDataTable($start, $length);
        $total_emergencies = $this->emergency_model->getEmergencyCount();

        $data = array();

        foreach ($emergencies as $emergency) {
            $data[] = array(
                $emergency->id,
                $emergency->patient_name,
                $emergency->doctor_name,
                $emergency->emergency_type,
                $emergency->description,
                $emergency->status,
                '<a class="btn btn-info btn-xs" href="emergency/viewEmergency?id=' . $emergency->id . '" title="View Details"><i class="fa fa-eye"></i> ' . lang('view') . '</a> <a class="btn btn-warning btn-xs" href="emergency/editEmergency?id=' . $emergency->id . '" title="Edit"><i class="fa fa-edit"></i> ' . lang('edit') . '</a> <a class="btn btn-danger btn-xs" href="emergency/deleteEmergency?id=' . $emergency->id . '" onclick="return confirm(\'Are you sure?\')" title="Delete"><i class="fa fa-trash"></i> ' . lang('delete') . '</a>'
            );
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_emergencies,
            "recordsFiltered" => $total_emergencies,
            "data" => $data
        );

        echo json_encode($output);
    }

    function getPatientInfo()
    {
        $searchTerm = $this->input->get('term');
        
        // Debug: Log the search term and session
        log_message('debug', 'Emergency getPatientInfo called with term: ' . $searchTerm);
        log_message('debug', 'Hospital ID: ' . $this->session->userdata('hospital_id'));
        
        // Check if hospital_id is set
        if (!$this->session->userdata('hospital_id')) {
            echo json_encode(array());
            return;
        }
        
        $data = $this->patient_model->getPatientInfo($searchTerm);
        
        // Debug: Log the data
        log_message('debug', 'Emergency getPatientInfo returning: ' . json_encode($data));
        
        echo json_encode($data);
    }

    function getDoctorInfo()
    {
        $searchTerm = $this->input->get('term');
        
        // Debug: Log the search term and session
        log_message('debug', 'Emergency getDoctorInfo called with term: ' . $searchTerm);
        log_message('debug', 'Hospital ID: ' . $this->session->userdata('hospital_id'));
        
        // Check if hospital_id is set
        if (!$this->session->userdata('hospital_id')) {
            echo json_encode(array());
            return;
        }
        
        $data = $this->doctor_model->getDoctorInfo($searchTerm);
        
        // Debug: Log the data
        log_message('debug', 'Emergency getDoctorInfo returning: ' . json_encode($data));
        
        echo json_encode($data);
    }

    function getPatientDetails()
    {
        $patient_id = $this->input->get('patient_id');
        
        if (empty($patient_id)) {
            echo json_encode(array('success' => false, 'message' => 'Patient ID is required'));
            return;
        }
        
        $this->load->model('patient_model');
        $patient = $this->patient_model->getPatientById($patient_id);
        
        if ($patient) {
            // Calculate age if birthdate is available
            $age = '';
            if (!empty($patient->age)) {
                $age = $patient->age;
            } elseif (!empty($patient->birthdate)) {
                $birthdate = new DateTime($patient->birthdate);
                $today = new DateTime();
                $age = $today->diff($birthdate)->y . ' years';
            }
            
            $data = array(
                'name' => $patient->name,
                'age' => $age,
                'gender' => $patient->sex,
                'phone' => $patient->phone,
                'medical_history' => $patient->medical_history
            );
            
            echo json_encode(array('success' => true, 'data' => $data));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Patient not found'));
        }
    }

    function testEndpoints()
    {
        echo "<h3>Emergency Module Test Endpoints</h3>";
        
        // Test patient endpoint
        echo "<h4>Testing Patient Endpoint:</h4>";
        $this->load->model('patient_model');
        $patients = $this->patient_model->getPatientInfo('');
        echo "<pre>Patient data: " . json_encode($patients, JSON_PRETTY_PRINT) . "</pre>";
        
        // Test doctor endpoint
        echo "<h4>Testing Doctor Endpoint:</h4>";
        $this->load->model('doctor_model');
        $doctors = $this->doctor_model->getDoctorInfo('');
        echo "<pre>Doctor data: " . json_encode($doctors, JSON_PRETTY_PRINT) . "</pre>";
        
        // Test session
        echo "<h4>Session Data:</h4>";
        echo "<pre>Hospital ID: " . $this->session->userdata('hospital_id') . "</pre>";
        echo "<pre>User ID: " . $this->session->userdata('user_id') . "</pre>";
    }
}
