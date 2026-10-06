<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_image_analysis extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ai_image_analysis_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('settings/settings_model');
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('file');
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        try {
            // Debug: Check if models are loaded
           
            
            $data['patients'] = $this->patient_model->getPatient();
            $data['settings'] = $this->settings_model->getSettings();
            
            // Get doctors based on user role
            if ($this->ion_auth->in_group('Doctor')) {
                // For doctors, get only their information
                $current_user_id = $this->ion_auth->user()->row()->id;
                $current_doctor = $this->doctor_model->getDoctorByIonUserId($current_user_id);
                if ($current_doctor) {
                    $data['doctors'] = array($current_doctor);
                } else {
                    $data['doctors'] = array();
                }
            } else {
                // For admins, get all doctors
                $data['doctors'] = $this->doctor_model->getDoctor();
            }
            
            // Debug: Log data
            log_message('debug', 'AI Image Analysis - Patients count: ' . count($data['patients']));
            log_message('debug', 'AI Image Analysis - Doctors count: ' . count($data['doctors']));
            $this->load->view('home/dashboard');
            $this->load->view('index', $data);
            $this->load->view('home/footer');
        } catch (Exception $e) {
            log_message('error', 'AI Image Analysis - Error in index: ' . $e->getMessage());
            log_message('error', 'AI Image Analysis - Stack trace: ' . $e->getTraceAsString());
            show_error('An error occurred while loading the page: ' . $e->getMessage());
        }
    }

    public function uploadImage()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $patient_id = $this->input->post('patient_id');
        $doctor_id = $this->input->post('doctor_id');
        $description = $this->input->post('description');

        if (!$patient_id || !$doctor_id) {
            echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
            return;
        }

        // Check if file was uploaded
        if (empty($_FILES['image']['name'])) {
            echo json_encode(['success' => false, 'message' => 'Please select an image to analyze.']);
            return;
        }

        // Validate file type
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'webp');
        $file_extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_types)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Please upload a valid image file (JPG, PNG, GIF, BMP, TIFF, WebP).']);
            return;
        }

        // Check file size (10MB limit)
        if ($_FILES['image']['size'] > 10485760) {
            echo json_encode(['success' => false, 'message' => 'File size too large. Maximum size is 10MB.']);
            return;
        }

        // Get AI API key
        $api_key = $this->settings_model->getSettings()->chatgpt_api_key;
        if (empty($api_key)) {
            echo json_encode(['success' => false, 'message' => 'AI API key not configured.']);
            return;
        }

        // Get hospital ID
        $hospital_id = $this->session->userdata('hospital_id');

        // Save to database first (without image path since we're not storing the file)
        $data = array(
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'hospital_id' => $hospital_id,
            'image_type' => 'auto_detect', // AI will detect the type
            'description' => $description,
            'image_path' => '', // No file stored on server
            'created_by' => $this->ion_auth->user()->row()->id,
            'created_at' => date('Y-m-d H:i:s')
        );

        $analysis_id = $this->ai_image_analysis_model->createImageAnalysis($data);

        if (!$analysis_id) {
            echo json_encode(['success' => false, 'message' => 'Failed to create analysis record.']);
            return;
        }

        // Analyze image directly using OpenAI Vision API
        $analysis_result = $this->analyzeImageDirectly($api_key, $_FILES['image'], $description);

        if ($analysis_result) {
            // Update database with analysis result
            $update_data = array(
                'analysis_result' => $analysis_result,
                'updated_by' => $this->ion_auth->user()->row()->id,
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->ai_image_analysis_model->updateImageAnalysis($analysis_id, $update_data)) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Image analyzed successfully.',
                    'analysis_id' => $analysis_id,
                    'analysis_result' => $analysis_result
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save analysis result.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to analyze image.']);
        }
    }

    public function analyzeImage()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $analysis_id = $this->input->post('analysis_id');

        if (!$analysis_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid analysis ID.']);
            return;
        }

        // Get analysis record
        $analysis = $this->ai_image_analysis_model->getImageAnalysisById($analysis_id);
        if (!$analysis) {
            echo json_encode(['success' => false, 'message' => 'Analysis record not found.']);
            return;
        }

        // Get AI API key
        $api_key = $this->settings_model->getSettings()->chatgpt_api_key;
        if (empty($api_key)) {
            echo json_encode(['success' => false, 'message' => 'AI API key not configured.']);
            return;
        }

        // Analyze image using OpenAI Vision API
        $analysis_result = $this->callOpenAIVisionAPI($api_key, $analysis);

        if ($analysis_result) {
            // Update database with analysis result
            $update_data = array(
                'analysis_result' => $analysis_result,
                'updated_by' => $this->ion_auth->user()->row()->id,
                'updated_at' => date('Y-m-d H:i:s')
            );

            if ($this->ai_image_analysis_model->updateImageAnalysis($analysis_id, $update_data)) {
                echo json_encode([
                    'success' => true,
                    'analysis_result' => $analysis_result
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to save analysis result.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to analyze image.']);
        }
    }

    private function analyzeImageDirectly($api_key, $image_file, $description)
    {
        // Encode image to base64
        $image_data = file_get_contents($image_file['tmp_name']);
        $base64_image = base64_encode($image_data);

        // Get the correct MIME type
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $image_file['tmp_name']);
        finfo_close($finfo);

        // Prepare the prompt for auto-detection
        $prompt = $this->getAutoDetectionPrompt($description);

        $data = array(
            'model' => 'gpt-4.1',
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => array(
                        array(
                            'type' => 'text',
                            'text' => $prompt
                        ),
                        array(
                            'type' => 'image_url',
                            'image_url' => array(
                                'url' => 'data:' . $mime_type . ';base64,' . $base64_image
                            )
                        )
                    )
                )
            ),
            'max_tokens' => 2500,
            'temperature' => 0.0 
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ));

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            $result = json_decode($response, true);
            if (isset($result['choices'][0]['message']['content'])) {
                return $result['choices'][0]['message']['content'];
            }
        }

        log_message('error', 'OpenAI Vision API Error: ' . $response);
        return false;
    }

    private function callOpenAIVisionAPI($api_key, $analysis)
    {
        $image_path = FCPATH . 'uploads/ai_image_analysis/' . $analysis->image_path;
        
        if (!file_exists($image_path)) {
            log_message('error', 'AI Image Analysis - Image file not found: ' . $image_path);
            return false;
        }

        // Encode image to base64
        $image_data = file_get_contents($image_path);
        $base64_image = base64_encode($image_data);

        // Prepare the prompt based on image type
        $prompt = $this->getAnalysisPrompt($analysis->image_type, $analysis->description);

        $data = array(
            'model' => 'gpt-4.1',
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => array(
                        array(
                            'type' => 'text',
                            'text' => $prompt
                        ),
                        array(
                            'type' => 'image_url',
                            'image_url' => array(
                                'url' => 'data:image/jpeg;base64,' . $base64_image
                            )
                        )
                    )
                )
            ),
            'max_tokens' => 2500,
            'temperature' => 0.0
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        ));

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            $result = json_decode($response, true);
            if (isset($result['choices'][0]['message']['content'])) {
                return $result['choices'][0]['message']['content'];
            }
        }

        log_message('error', 'OpenAI Vision API Error: ' . $response);
        return false;
    }

    private function getAutoDetectionPrompt($description)
    {
        $base_prompt = "You are an expert medical radiologist and diagnostic imaging specialist with extensive experience in interpreting medical images. Analyze this medical image with the highest level of clinical accuracy and attention to detail. ";

        $detection_instruction = "First, identify what type of medical image this is (X-ray, CT scan, MRI, ultrasound, endoscopy, dermatology, ophthalmology, pathology, or other medical imaging). Then provide a comprehensive, detailed analysis based on the identified image type, looking for specific pathological findings, anatomical structures, and clinical abnormalities.";
        
        $additional_info = !empty($description) ? "Additional context: " . $description . " " : "";
        
        $format_instruction = "Please provide your analysis in the following format:

**CLINICAL FINDINGS:**
- [List specific findings observed in the image]

**ANALYSIS:**
- [Detailed analysis of the findings]

**RECOMMENDATIONS:**
- [Clinical recommendations based on the findings]


**NOTES:**
- [Any additional observations or concerns]

Keep the analysis professional, detailed, and clinically relevant. Do not include disclaimers about AI limitations or template text.";

        return $base_prompt . $detection_instruction . $additional_info . $format_instruction;
    }

    private function getAnalysisPrompt($image_type, $description)
    {
        $base_prompt = "You are a medical AI assistant. Analyze this medical image and provide a detailed, professional medical report. ";
        
        $type_prompts = array(
            'xray' => "This is an X-ray image. Focus on bone structure, joint alignment, fractures, dislocations, and any abnormalities in the skeletal system.",
            'ct_scan' => "This is a CT scan image. Analyze internal organs, soft tissues, blood vessels, and any pathological findings.",
            'mri' => "This is an MRI image. Focus on soft tissue structures, brain anatomy, spinal cord, and any neurological or musculoskeletal abnormalities.",
            'ultrasound' => "This is an ultrasound image. Analyze organ structures, blood flow, fetal development (if applicable), and any pathological findings.",
            'endoscopy' => "This is an endoscopic image. Examine the internal lining of organs, look for inflammation, ulcers, polyps, or other abnormalities.",
            'dermatology' => "This is a dermatological image. Analyze skin lesions, rashes, moles, or other skin conditions.",
            'ophthalmology' => "This is an ophthalmological image. Examine the eye structure, retina, optic nerve, and any visual abnormalities.",
            'pathology' => "This is a pathology slide image. Analyze cellular structures, tissue samples, and identify any pathological changes.",
            'other' => "This is a general medical image. Provide a comprehensive analysis of any visible medical findings."
        );

        $type_instruction = isset($type_prompts[$image_type]) ? $type_prompts[$image_type] : $type_prompts['other'];
        
        $additional_info = !empty($description) ? "Additional context: " . $description . " " : "";
        
        $format_instruction = "Please provide your analysis in the following format:

**CLINICAL FINDINGS:**
- [List specific findings observed in the image]

**ANALYSIS:**
- [Detailed analysis of the findings]

**RECOMMENDATIONS:**
- [Clinical recommendations based on the findings]


**NOTES:**
- [Any additional observations or concerns]

Keep the analysis professional, detailed, and clinically relevant. Do not include disclaimers about AI limitations or template text.";

        return $base_prompt . $type_instruction . $additional_info . $format_instruction;
    }

    public function getAnalysisHistory()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $patient_id = $this->input->post('patient_id');
        $hospital_id = $this->session->userdata('hospital_id');

        $analyses = $this->ai_image_analysis_model->getImageAnalysesByPatient($patient_id, $hospital_id);
        
        echo json_encode(['success' => true, 'analyses' => $analyses]);
    }

    public function getAnalyticsHistory()
    {
        // Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            echo json_encode(['error' => 'User not authenticated', 'redirect' => 'login']);
            return;
        }

        // Allow both AJAX and direct GET requests for testing
        // if (!$this->input->is_ajax_request()) {
        //     show_404();
        // }

        try {
            log_message('debug', 'AI Image Analysis - Getting analytics history');
            
           
            
            // Check hospital_id
            $hospital_id = $this->session->userdata('hospital_id');
            if (!$hospital_id) {
                log_message('error', 'AI Image Analysis - Hospital ID not found in session');
                echo json_encode(['error' => 'Hospital ID not found']);
                return;
            }
            
           
            
            $analyses = $this->ai_image_analysis_model->getAllImageAnalyses($hospital_id);
            log_message('debug', 'AI Image Analysis - Raw analyses count: ' . count($analyses));
            
            // Debug: Log the actual data
            if (count($analyses) > 0) {
                log_message('debug', 'AI Image Analysis - First analysis: ' . json_encode($analyses[0]));
            } else {
                log_message('debug', 'AI Image Analysis - No analyses found for hospital_id: ' . $hospital_id);
                
                // Try a simple count query to verify data exists
                $this->db->select('COUNT(*) as total');
                $this->db->from('ai_image_analyses');
                $query = $this->db->get();
                $total_all = $query->row()->total;
                log_message('debug', 'AI Image Analysis - Total records in table: ' . $total_all);
                
                $this->db->select('COUNT(*) as total');
                $this->db->from('ai_image_analyses');
                $this->db->where('hospital_id', $hospital_id);
                $query = $this->db->get();
                $total_hospital = $query->row()->total;
                log_message('debug', 'AI Image Analysis - Records for hospital ' . $hospital_id . ': ' . $total_hospital);
                
                // Try a direct query to see what's in the table
                $this->db->select('*');
                $this->db->from('ai_image_analyses');
                $this->db->limit(3);
                $query = $this->db->get();
                $sample_records = $query->result();
                log_message('debug', 'AI Image Analysis - Sample records: ' . json_encode($sample_records));
            }
            
            // Format the data for the analytics table
            $formatted_analyses = array();
            foreach ($analyses as $analysis) {
                // Get patient name if not available from join
                $patient_name = isset($analysis->patient_name) ? $analysis->patient_name : 'Unknown Patient';
                if ($patient_name === 'Unknown Patient' && isset($analysis->patient_id)) {
                    $patient = $this->patient_model->getPatientById($analysis->patient_id);
                    $patient_name = $patient ? $patient->name : 'Unknown Patient';
                }
                
                // Get doctor name if not available from join
                $doctor_name = isset($analysis->doctor_name) ? $analysis->doctor_name : 'Unknown Doctor';
                if ($doctor_name === 'Unknown Doctor' && isset($analysis->doctor_id)) {
                    $doctor = $this->doctor_model->getDoctorById($analysis->doctor_id);
                    $doctor_name = $doctor ? $doctor->name : 'Unknown Doctor';
                }
                
                $formatted_analyses[] = array(
                    'id' => $analysis->id,
                    'created_at' => date('Y-m-d H:i:s', strtotime($analysis->created_at)),
                    'patient_name' => $patient_name,
                    'doctor_name' => $doctor_name,
                    'image_type' => $analysis->image_type,
                    'status' => !empty($analysis->analysis_result) ? 'completed' : 'pending'
                );
            }
            
            log_message('debug', 'AI Image Analysis - Formatted analyses count: ' . count($formatted_analyses));
            echo json_encode($formatted_analyses);
            
        } catch (Exception $e) {
            log_message('error', 'AI Image Analysis - Controller Error: ' . $e->getMessage());
            log_message('error', 'AI Image Analysis - Stack trace: ' . $e->getTraceAsString());
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        } catch (Error $e) {
            log_message('error', 'AI Image Analysis - PHP Error: ' . $e->getMessage());
            log_message('error', 'AI Image Analysis - Stack trace: ' . $e->getTraceAsString());
            echo json_encode(['error' => 'A PHP error occurred: ' . $e->getMessage()]);
        }
    }

    public function testAnalytics()
    {
        // Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            echo "User not authenticated. Please log in first.<br>";
            return;
        }

        try {
            echo "Testing analytics...<br>";
            
            // Check user details
            $user = $this->ion_auth->user()->row();
            if ($user) {
                echo "User ID: " . $user->id . "<br>";
                echo "Username: " . $user->username . "<br>";
            } else {
                echo "No user data found<br>";
            }
            
            // Check database connection
            if (!$this->db->conn_id) {
                echo "Database connection failed<br>";
                return;
            }
            echo "Database connected<br>";
            
            // Check session data
            echo "Session data: " . print_r($this->session->all_userdata(), true) . "<br>";
            
            // Check hospital_id
            $hospital_id = $this->session->userdata('hospital_id');
            if (!$hospital_id) {
                echo "Hospital ID not found: " . var_export($hospital_id, true) . "<br>";
                return;
            }
            echo "Hospital ID: " . $hospital_id . "<br>";
            
            // Check if table exists
            if (!$this->db->table_exists('ai_image_analyses')) {
                echo "Table ai_image_analyses does not exist<br>";
                return;
            }
            echo "Table exists<br>";
            
            // Try simple query
            $query = $this->db->get('ai_image_analyses');
            echo "Total records: " . $query->num_rows() . "<br>";
            
            // Try with hospital filter
            $this->db->where('hospital_id', $hospital_id);
            $query = $this->db->get('ai_image_analyses');
            echo "Records for hospital: " . $query->num_rows() . "<br>";
            
            // Show sample data
            $this->db->select('*');
            $this->db->from('ai_image_analyses');
            $this->db->where('hospital_id', $hospital_id);
            $this->db->limit(3);
            $query = $this->db->get();
            $records = $query->result();
            
            echo "<br>Sample records:<br>";
            foreach ($records as $record) {
                echo "ID: " . $record->id . ", Patient ID: " . $record->patient_id . ", Doctor ID: " . $record->doctor_id . ", Image Type: " . $record->image_type . ", Created: " . $record->created_at . "<br>";
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    public function testAnalyticsNoAuth()
    {
        // This method doesn't require authentication for testing
        try {
            echo "Testing analytics without authentication...<br>";
            
            // Check database connection
            if (!$this->db->conn_id) {
                echo "Database connection failed<br>";
                return;
            }
            echo "Database connected<br>";
            
            // Check if table exists
            if (!$this->db->table_exists('ai_image_analyses')) {
                echo "Table ai_image_analyses does not exist<br>";
                return;
            }
            echo "Table exists<br>";
            
            // Try simple query
            $query = $this->db->get('ai_image_analyses');
            echo "Total records: " . $query->num_rows() . "<br>";
            
            // Show sample data
            $this->db->select('*');
            $this->db->from('ai_image_analyses');
            $this->db->limit(5);
            $query = $this->db->get();
            $records = $query->result();
            
            echo "<br>Sample records:<br>";
            foreach ($records as $record) {
                echo "ID: " . $record->id . ", Hospital ID: " . $record->hospital_id . ", Patient ID: " . $record->patient_id . ", Doctor ID: " . $record->doctor_id . ", Image Type: " . $record->image_type . ", Created: " . $record->created_at . "<br>";
            }
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }

    public function getAnalyticsHistorySimple()
    {
        // Simple version without authentication for testing
        try {
            $this->db->select('*');
            $this->db->from('ai_image_analyses');
            $this->db->order_by('created_at', 'DESC');
            $query = $this->db->get();
            $records = $query->result();
            
            echo json_encode($records);
            
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function debugSession()
    {
        // Debug session data
        echo "Session data:<br>";
        echo "User logged in: " . ($this->ion_auth->logged_in() ? 'Yes' : 'No') . "<br>";
        echo "Hospital ID: " . $this->session->userdata('hospital_id') . "<br>";
        echo "User ID: " . $this->ion_auth->get_user_id() . "<br>";
        echo "All session data: " . print_r($this->session->all_userdata(), true) . "<br>";
        
        // Test database query
        $this->db->select('COUNT(*) as total');
        $this->db->from('ai_image_analyses');
        $query = $this->db->get();
        $total = $query->row()->total;
        echo "Total records in ai_image_analyses: " . $total . "<br>";
        
        if ($this->session->userdata('hospital_id')) {
            $this->db->select('COUNT(*) as total');
            $this->db->from('ai_image_analyses');
            $this->db->where('hospital_id', $this->session->userdata('hospital_id'));
            $query = $this->db->get();
            $total_hospital = $query->row()->total;
            echo "Records for hospital " . $this->session->userdata('hospital_id') . ": " . $total_hospital . "<br>";
        }
    }

    public function getAnalyticsHistoryDataTables()
    {
        // Check if user is logged in
        if (!$this->ion_auth->logged_in()) {
            echo json_encode(['error' => 'User not authenticated']);
            return;
        }

        try {
            $hospital_id = $this->session->userdata('hospital_id');
            if (!$hospital_id) {
                echo json_encode(['error' => 'Hospital ID not found']);
                return;
            }

            // DataTables parameters
            $start = $this->input->post('start') ?: 0;
            $length = $this->input->post('length') ?: 10;
            $search_value = $this->input->post('search')['value'] ?: '';
            $order_column = $this->input->post('order')[0]['column'] ?: 0;
            $order_dir = $this->input->post('order')[0]['dir'] ?: 'desc';

            // Column mapping for ordering
            $columns = ['created_at', 'patient_name', 'doctor_name', 'image_type', 'status', 'actions'];
            $order_by = $columns[$order_column] ?: 'created_at';

            // Build query
            $this->db->select('aia.*, p.name as patient_name, d.name as doctor_name');
            $this->db->from('ai_image_analyses aia');
            $this->db->join('patient p', 'p.id = aia.patient_id', 'left');
            $this->db->join('doctor d', 'd.id = aia.doctor_id', 'left');
            $this->db->where('aia.hospital_id', $hospital_id);

            // Search functionality
            if (!empty($search_value)) {
                $this->db->group_start();
                $this->db->like('aia.created_at', $search_value);
                $this->db->or_like('p.name', $search_value);
                $this->db->or_like('d.name', $search_value);
                $this->db->or_like('aia.image_type', $search_value);
                $this->db->group_end();
            }

            // Get total records count
            $total_records = $this->db->count_all_results('', false);

            // Apply ordering
            $this->db->order_by($order_by, $order_dir);

            // Apply pagination
            $this->db->limit($length, $start);

            $query = $this->db->get();
            $records = $query->result();

            // Format data for DataTables
            $data = [];
            foreach ($records as $record) {
                $status = !empty($record->analysis_result) ? 'completed' : 'pending';
                $status_badge = $status === 'completed' ? 
                    '<span class="badge badge-success">Completed</span>' : 
                    '<span class="badge badge-warning">Pending</span>';

                $actions = '
                    <a class="btn btn-sm btn-outline-primary" onclick="viewAnalysis(' . $record->id . ')">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-sm btn-outline-danger" onclick="deleteAnalysis(' . $record->id . ')">
                        <i class="fas fa-trash"></i>
                    </a>
                ';

                $data[] = [
                    date('Y-m-d H:i:s', strtotime($record->created_at)),
                    $record->patient_name ?: 'Unknown Patient',
                    $record->doctor_name ?: 'Unknown Doctor',
                    ucfirst(str_replace('_', ' ', $record->image_type)),
                    $status_badge,
                    $actions
                ];
            }

            // Return DataTables format
            echo json_encode([
                'draw' => intval($this->input->post('draw')),
                'recordsTotal' => $total_records,
                'recordsFiltered' => $total_records,
                'data' => $data
            ]);

        } catch (Exception $e) {
            log_message('error', 'AI Image Analysis - DataTables Error: ' . $e->getMessage());
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function getImageAnalysisById()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $analysis_id = $this->input->post('analysis_id');
        $hospital_id = $this->session->userdata('hospital_id');

        if (!$analysis_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid analysis ID.']);
            return;
        }

        $analysis = $this->ai_image_analysis_model->getImageAnalysisById($analysis_id);
        
        if (!$analysis) {
            echo json_encode(['success' => false, 'message' => 'Analysis not found.']);
            return;
        }

        // Check if analysis belongs to the current hospital
        if ($analysis->hospital_id != $hospital_id) {
            echo json_encode(['success' => false, 'message' => 'Access denied.']);
            return;
        }

        // Get patient and doctor names
        $patient = $this->patient_model->getPatientById($analysis->patient_id);
        $doctor = $this->doctor_model->getDoctorById($analysis->doctor_id);
        
        $analysis->patient_name = $patient ? $patient->name : 'Unknown Patient';
        $analysis->doctor_name = $doctor ? $doctor->name : 'Unknown Doctor';

        echo json_encode(['success' => true, 'analysis' => $analysis]);
    }

    public function deleteImageAnalysis()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $analysis_id = $this->input->post('analysis_id');
        $hospital_id = $this->session->userdata('hospital_id');

        if (!$analysis_id) {
            echo json_encode(['success' => false, 'message' => 'Invalid analysis ID.']);
            return;
        }

        // Get analysis to check hospital ownership
        $analysis = $this->ai_image_analysis_model->getImageAnalysisById($analysis_id);
        
        if (!$analysis) {
            echo json_encode(['success' => false, 'message' => 'Analysis not found.']);
            return;
        }

        // Check if analysis belongs to the current hospital
        if ($analysis->hospital_id != $hospital_id) {
            echo json_encode(['success' => false, 'message' => 'Access denied.']);
            return;
        }

        if ($this->ai_image_analysis_model->deleteImageAnalysis($analysis_id)) {
            echo json_encode(['success' => true, 'message' => 'Analysis deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete analysis.']);
        }
    }
}
