<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Treatment_plan extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('settings/settings_model');
        $this->load->model('treatment_plan/treatment_plan_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('ion_auth');
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        if (!$this->ion_auth->in_group(array('admin', 'Doctor'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $data = array();
        $data['page'] = 'treatment_plan';
        $data['page_title'] = 'AI Treatment Plan';
        $data['patients'] = $this->patient_model->getPatient();
        
        // Check if user is a doctor - if so, only show that doctor
        if ($this->ion_auth->in_group('Doctor')) {
            $current_user_id = $this->ion_auth->get_user_id();
            $current_doctor = $this->doctor_model->getDoctorByIonUserId($current_user_id);
            if ($current_doctor) {
                $data['doctors'] = array($current_doctor);
            } else {
                $data['doctors'] = array();
            }
        } else {
            // For admin and other roles, show all doctors
            $data['doctors'] = $this->doctor_model->getDoctor();
        }
        
        $data['settings'] = $this->settings_model->getSettings();
        
        $this->load->view('home/dashboard');
        $this->load->view('treatment_plan/index', $data);
        $this->load->view('home/footer');
    }

    public function generateSymptomAnalysis()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $patient_id = $this->input->post('patient_id');
            $doctor_id = $this->input->post('doctor_id');
            $symptoms = $this->input->post('symptoms');
            
            if (empty($patient_id) || empty($doctor_id) || empty($symptoms)) {
                echo json_encode(['success' => false, 'message' => 'Patient, doctor, and symptoms are required']);
                return;
            }
            
            // Get patient information
            $patient = $this->patient_model->getPatientById($patient_id);
            if (!$patient) {
                echo json_encode(['success' => false, 'message' => 'Patient not found']);
                return;
            }
            
            // Get AI settings
            $settings = $this->settings_model->getSettings();
            $api_key = $settings->chatgpt_api_key ?? '';
            
            if (empty($api_key)) {
                echo json_encode(['success' => false, 'message' => 'AI API key not configured']);
                return;
            }
            
            // Prepare prompt for symptom analysis
            $prompt = "As a medical AI assistant, analyze the following patient symptoms and provide a detailed medical analysis:\n\n";
            $prompt .= "Patient Information:\n";
            $prompt .= "Name: " . $patient->name . "\n";
            $prompt .= "Age: " . $patient->age . "\n";
            $prompt .= "Gender: " . $patient->sex . "\n";
            $prompt .= "Medical History: " . ($patient->medical_history ?? 'Not provided') . "\n\n";
            $prompt .= "Current Symptoms:\n" . $symptoms . "\n\n";
            $prompt .= "Please provide:\n";
            $prompt .= "1. Potential differential diagnoses\n";
            $prompt .= "2. Recommended diagnostic tests\n";
            $prompt .= "3. Urgency level (Low/Medium/High)\n";
            $prompt .= "4. Key observations and clinical notes\n";
            $prompt .= "5. Red flags to watch for\n";
            $prompt .= "Format your response in a clear, structured manner suitable for medical professionals.";
            
            $analysis = $this->callAIAPI($api_key, $prompt);
            
            if ($analysis) {
                // Save to database
                $data = array(
                    'patient_id' => $patient_id,
                    'doctor_id' => $doctor_id,
                    'symptoms' => $symptoms,
                    'symptom_analysis' => $analysis,
                    'created_by' => $this->ion_auth->user()->row()->id,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                $treatment_id = $this->treatment_plan_model->createTreatmentPlan($data);
                
                echo json_encode([
                    'success' => true, 
                    'analysis' => $analysis,
                    'treatment_id' => $treatment_id
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to generate analysis']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function generateTreatmentRecommendation()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $treatment_id = $this->input->post('treatment_id');
            $doctor_input = $this->input->post('doctor_input');
            $test_results = $this->input->post('test_results');
            
            if (empty($treatment_id)) {
                echo json_encode(['success' => false, 'message' => 'Treatment plan ID is required']);
                return;
            }
            
            // Get treatment plan data
            $treatment = $this->treatment_plan_model->getTreatmentPlanById($treatment_id);
            if (!$treatment) {
                echo json_encode(['success' => false, 'message' => 'Treatment plan not found']);
                return;
            }
            
            // Get patient information
            $patient = $this->patient_model->getPatientById($treatment->patient_id);
            
            // Get AI settings
            $settings = $this->settings_model->getSettings();
            $api_key = $settings->chatgpt_api_key ?? '';
            
            if (empty($api_key)) {
                echo json_encode(['success' => false, 'message' => 'AI API key not configured']);
                return;
            }
            
            // Prepare prompt for treatment recommendation
            $prompt = "As a medical AI assistant, based on the following information, provide a comprehensive treatment plan:\n\n";
            $prompt .= "Patient Information:\n";
            $prompt .= "Name: " . $patient->name . "\n";
            $prompt .= "Age: " . $patient->age . "\n";
            $prompt .= "Gender: " . $patient->sex . "\n\n";
            $prompt .= "Initial Symptoms:\n" . $treatment->symptoms . "\n\n";
            $prompt .= "Symptom Analysis:\n" . $treatment->symptom_analysis . "\n\n";
            $prompt .= "Doctor's Clinical Input:\n" . ($doctor_input ?? 'Not provided') . "\n\n";
            $prompt .= "Test Results:\n" . ($test_results ?? 'Not provided') . "\n\n";
            $prompt .= "Please provide:\n";
            $prompt .= "1. Primary diagnosis\n";
            $prompt .= "2. Treatment goals\n";
            $prompt .= "3. Medication recommendations (with dosages and duration)\n";
            $prompt .= "4. Non-pharmacological interventions\n";
            $prompt .= "5. Follow-up schedule\n";
            $prompt .= "6. Monitoring parameters\n";
            $prompt .= "7. Patient education points\n";
            $prompt .= "8. Potential complications to watch for\n";
            $prompt .= "Format your response in a clear, structured manner suitable for medical professionals.";
            
            $treatment_plan = $this->callAIAPI($api_key, $prompt);
            
            if ($treatment_plan) {
                // Update treatment plan
                $update_data = array(
                    'doctor_input' => $doctor_input,
                    'test_results' => $test_results,
                    'treatment_plan' => $treatment_plan,
                    'updated_by' => $this->ion_auth->user()->row()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                $this->treatment_plan_model->updateTreatmentPlan($treatment_id, $update_data);
                
                echo json_encode([
                    'success' => true, 
                    'treatment_plan' => $treatment_plan
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to generate treatment plan']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    public function generatePrescription()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $treatment_id = $this->input->post('treatment_id');
            
            if (empty($treatment_id)) {
                echo json_encode(['success' => false, 'message' => 'Treatment plan ID is required']);
                return;
            }
            
            // Get treatment plan data
            $treatment = $this->treatment_plan_model->getTreatmentPlanById($treatment_id);
            if (!$treatment) {
                echo json_encode(['success' => false, 'message' => 'Treatment plan not found']);
                return;
            }
            
            // Get patient information
            $patient = $this->patient_model->getPatientById($treatment->patient_id);
            
            // Get AI settings
            $settings = $this->settings_model->getSettings();
            $api_key = $settings->chatgpt_api_key ?? '';
            
            if (empty($api_key)) {
                echo json_encode(['success' => false, 'message' => 'AI API key not configured']);
                return;
            }
            
            // Prepare prompt for prescription generation
            $prompt = "As a medical AI assistant, generate a clear and specific prescription based on the following treatment plan:\n\n";
            $prompt .= "Patient Information:\n";
            $prompt .= "Name: " . $patient->name . "\n";
            $prompt .= "Age: " . $patient->age . "\n";
            $prompt .= "Gender: " . $patient->sex . "\n";
            $prompt .= "Date: " . date('Y-m-d') . "\n\n";
            $prompt .= "Treatment Plan:\n" . $treatment->treatment_plan . "\n\n";
            $prompt .= "IMPORTANT PRESCRIPTION GUIDELINES:\n";
            $prompt .= "- Generate ONLY the medication and instruction content\n";
            $prompt .= "- Do NOT include patient details (name, age, gender) - these are already displayed by the system\n";
            $prompt .= "- Do NOT include doctor signature lines - these are already provided by the system\n";
            $prompt .= "- Do NOT include prescription numbers or dates - these are handled by the system\n";
            $prompt .= "- Do NOT include clinic/hospital information - this is already displayed by the system\n";
            $prompt .= "- Do NOT include phrases like 'sample prescription', 'template for educational purposes', or 'must be reviewed by licensed healthcare provider'\n";
            $prompt .= "- Do NOT include placeholder text like '[Clinic Name/Logo]', '[Clinic Address]', or '[Clinic Phone Number]'\n";
            $prompt .= "- Provide ONLY ONE specific medication for each condition\n";
            $prompt .= "- Do NOT use 'OR' between medications - this confuses patients\n";
            $prompt .= "- If multiple medications are needed, list them as separate numbered items\n";
            $prompt .= "- Use clear, simple language that patients can understand\n";
            $prompt .= "- Format each medication as: [Number]. Medication Name - Dosage - Frequency - Duration\n";
            $prompt .= "- Include specific instructions (take with food, before bed, etc.)\n";
            $prompt .= "- Add any lifestyle recommendations or precautions\n\n";
            $prompt .= "Generate ONLY the prescription content in this format:\n";
            $prompt .= "Medications:\n";
            $prompt .= "1. [Medication Name] - [Dosage] - [Frequency] - [Duration]\n";
            $prompt .= "2. [Medication Name] - [Dosage] - [Frequency] - [Duration]\n\n";
            $prompt .= "Instructions:\n";
            $prompt .= "- [Specific instruction 1]\n";
            $prompt .= "- [Specific instruction 2]\n\n";
            $prompt .= "Precautions:\n";
            $prompt .= "- [Precaution 1]\n";
            $prompt .= "- [Precaution 2]\n\n";
            $prompt .= "Generate ONLY the medication and instruction content - no patient details, signatures, or system-provided information.";
            
            $prescription = $this->callAIAPI($api_key, $prompt);
            
            if ($prescription) {
                // Update treatment plan with prescription
                $update_data = array(
                    'prescription' => $prescription,
                    'updated_by' => $this->ion_auth->user()->row()->id,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                $this->treatment_plan_model->updateTreatmentPlan($treatment_id, $update_data);
                
                echo json_encode([
                    'success' => true, 
                    'prescription' => $prescription
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to generate prescription']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid request method']);
        }
    }

    private function callAIAPI($api_key, $prompt)
    {
        $url = 'https://api.openai.com/v1/chat/completions';
         
        $data = array(
            'model' => 'gpt-4',
            'messages' => array(
                array(
                    'role' => 'system',
                    'content' => 'You are a medical AI assistant. Provide accurate, evidence-based medical information. Always recommend consulting with healthcare professionals for proper diagnosis and treatment.'
                ),
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => 3000,
            'temperature' => 0.0 
        );
        
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code == 200) {
            $result = json_decode($response, true);
            if (isset($result['choices'][0]['message']['content'])) {
                return $result['choices'][0]['message']['content'];
            }
        }
        
        log_message('error', 'AI API Error: ' . $response);
        return false;
    }

    public function getTreatmentPlan($id)
    {
        $treatment = $this->treatment_plan_model->getTreatmentPlanById($id);
        if ($treatment) {
            echo json_encode(['success' => true, 'treatment' => $treatment]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Treatment plan not found']);
        }
    }

}
