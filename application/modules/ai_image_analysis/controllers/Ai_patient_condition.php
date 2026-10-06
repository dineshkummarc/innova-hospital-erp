<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_patient_condition extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ai_image_analysis_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
        $this->load->model('appointment/appointment_model');
        $this->load->model('prescription/prescription_model');
        $this->load->model('lab/lab_model');
        $this->load->model('settings/settings_model');
        $this->load->library('ion_auth');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
    }

    public function index()
    {
        try {
            $data['patients'] = $this->patient_model->getPatient();
            $data['settings'] = $this->settings_model->getSettings();
            
            // Get doctors based on user role
            if ($this->ion_auth->in_group('Doctor')) {
                $current_user_id = $this->ion_auth->user()->row()->id;
                $current_doctor = $this->doctor_model->getDoctorByIonUserId($current_user_id);
                if ($current_doctor) {
                    $data['doctors'] = array($current_doctor);
                } else {
                    $data['doctors'] = array();
                }
            } else {
                $data['doctors'] = $this->doctor_model->getDoctor();
            }
            
            $this->load->view('home/dashboard', $data);
            $this->load->view('ai_patient_condition', $data);
            $this->load->view('home/footer');
            
        } catch (Exception $e) {
            log_message('error', 'AI Patient Condition Error: ' . $e->getMessage());
            show_error('An error occurred while loading the page.');
        }
    }

    public function getPatientData()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $patient_id = $this->input->post('patient_id');
        $hospital_id = $this->session->userdata('hospital_id');

        if (!$patient_id) {
            echo json_encode(['success' => false, 'message' => 'Patient ID is required']);
            return;
        }

        try {
            // Get patient basic info
            $patient = $this->patient_model->getPatientById($patient_id);
            
            // Get recent appointments
            $appointments = $this->getRecentAppointments($patient_id, $hospital_id);
            
            // Get recent prescriptions
            $prescriptions = $this->getRecentPrescriptions($patient_id, $hospital_id);
            
            // Get recent lab reports
            $lab_reports = $this->getRecentLabReports($patient_id, $hospital_id);
            
            // Get recent image analyses
            $image_analyses = $this->getRecentImageAnalyses($patient_id, $hospital_id);
            
            // Get recent treatment plans
            $treatment_plans = $this->getRecentTreatmentPlans($patient_id, $hospital_id);

            $patient_data = [
                'patient' => $patient,
                'appointments' => $appointments,
                'prescriptions' => $prescriptions,
                'lab_reports' => $lab_reports,
                'image_analyses' => $image_analyses,
                'treatment_plans' => $treatment_plans
            ];

            echo json_encode(['success' => true, 'data' => $patient_data]);

        } catch (Exception $e) {
            log_message('error', 'Get Patient Data Error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Error retrieving patient data']);
        }
    }

    public function analyzePatientCondition()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $patient_id = $this->input->post('patient_id');
        $hospital_id = $this->session->userdata('hospital_id');

        if (!$patient_id) {
            echo json_encode(['success' => false, 'message' => 'Patient ID is required']);
            return;
        }

        try {
            // Get API key from settings
            $settings = $this->settings_model->getSettings();
            $api_key = $settings->chatgpt_api_key ?? '';

            if (empty($api_key)) {
                echo json_encode(['success' => false, 'message' => 'AI API key not configured']);
                return;
            }

            // Get comprehensive patient data
            $patient_data = $this->getComprehensivePatientData($patient_id, $hospital_id);
            
            // Generate AI analysis
            $analysis_result = $this->generatePatientConditionAnalysis($api_key, $patient_data);
            
            // Save analysis to database
            $analysis_id = $this->savePatientConditionAnalysis($patient_id, $analysis_result);

            echo json_encode([
                'success' => true, 
                'analysis_result' => $analysis_result,
                'analysis_id' => $analysis_id
            ]);

        } catch (Exception $e) {
            log_message('error', 'Analyze Patient Condition Error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Error analyzing patient condition']);
        }
    }

    private function getRecentAppointments($patient_id, $hospital_id, $limit = 10)
    {
        $this->db->select('a.*, d.name as doctor_name, d.specialist');
        $this->db->from('appointment a');
        $this->db->join('doctor d', 'd.id = a.doctor', 'left');
        $this->db->where('a.patient', $patient_id);
        $this->db->where('a.hospital_id', $hospital_id);
        $this->db->order_by('a.date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    private function getRecentPrescriptions($patient_id, $hospital_id, $limit = 10)
    {
        $this->db->select('p.*, d.name as doctor_name');
        $this->db->from('prescription p');
        $this->db->join('doctor d', 'd.id = p.doctor', 'left');
        $this->db->where('p.patient', $patient_id);
        $this->db->where('p.hospital_id', $hospital_id);
        $this->db->order_by('p.date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    private function getRecentLabReports($patient_id, $hospital_id, $limit = 10)
    {
        $this->db->select('l.*, d.name as doctor_name');
        $this->db->from('lab l');
        $this->db->join('doctor d', 'd.id = l.doctor', 'left');
        $this->db->where('l.patient', $patient_id);
        $this->db->where('l.hospital_id', $hospital_id);
        $this->db->order_by('l.date', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    private function getRecentImageAnalyses($patient_id, $hospital_id, $limit = 10)
    {
        $this->db->select('aia.*, d.name as doctor_name');
        $this->db->from('ai_image_analyses aia');
        $this->db->join('doctor d', 'd.id = aia.doctor_id', 'left');
        $this->db->where('aia.patient_id', $patient_id);
        $this->db->where('aia.hospital_id', $hospital_id);
        $this->db->order_by('aia.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    private function getRecentTreatmentPlans($patient_id, $hospital_id, $limit = 10)
    {
        $this->db->select('tp.*, d.name as doctor_name');
        $this->db->from('treatment_plans tp');
        $this->db->join('doctor d', 'd.id = tp.doctor_id', 'left');
        $this->db->where('tp.patient_id', $patient_id);
        $this->db->where('tp.hospital_id', $hospital_id);
        $this->db->order_by('tp.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    private function getComprehensivePatientData($patient_id, $hospital_id)
    {
        $patient = $this->patient_model->getPatientById($patient_id);
        $appointments = $this->getRecentAppointments($patient_id, $hospital_id, 20);
        $prescriptions = $this->getRecentPrescriptions($patient_id, $hospital_id, 20);
        $lab_reports = $this->getRecentLabReports($patient_id, $hospital_id, 20);
        $image_analyses = $this->getRecentImageAnalyses($patient_id, $hospital_id, 20);
        $treatment_plans = $this->getRecentTreatmentPlans($patient_id, $hospital_id, 20);

        return [
            'patient' => $patient,
            'appointments' => $appointments,
            'prescriptions' => $prescriptions,
            'lab_reports' => $lab_reports,
            'image_analyses' => $image_analyses,
            'treatment_plans' => $treatment_plans
        ];
    }

    private function generatePatientConditionAnalysis($api_key, $patient_data)
    {
        $prompt = $this->buildPatientConditionPrompt($patient_data);

        $data = array(
            'model' => 'gpt-4.1',
            'messages' => array(
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => 3000
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

        if ($http_code !== 200) {
            throw new Exception('OpenAI API error: ' . $response);
        }

        $result = json_decode($response, true);
        return $result['choices'][0]['message']['content'] ?? 'Analysis failed';
    }

    private function buildPatientConditionPrompt($patient_data)
    {
        $patient = $patient_data['patient'];
        $appointments = $patient_data['appointments'];
        $prescriptions = $patient_data['prescriptions'];
        $lab_reports = $patient_data['lab_reports'];
        $image_analyses = $patient_data['image_analyses'];
        $treatment_plans = $patient_data['treatment_plans'];

        $prompt = "As a medical AI assistant, analyze the following comprehensive patient data and provide a detailed assessment of the patient's current condition:\n\n";
        
        $prompt .= "PATIENT INFORMATION:\n";
        $prompt .= "Name: " . ($patient->name ?? 'N/A') . "\n";
        $prompt .= "Age: " . ($patient->age ?? 'N/A') . " years\n";
        $prompt .= "Gender: " . ($patient->sex ?? 'N/A') . "\n";
        $prompt .= "Phone: " . ($patient->phone ?? 'N/A') . "\n\n";

        if (!empty($appointments)) {
            $prompt .= "RECENT APPOINTMENTS (" . count($appointments) . " records):\n";
            foreach ($appointments as $apt) {
                $prompt .= "- Date: " . $apt->date . ", Doctor: " . ($apt->doctor_name ?? 'N/A') . ", Reason: " . ($apt->remarks ?? 'N/A') . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($prescriptions)) {
            $prompt .= "RECENT PRESCRIPTIONS (" . count($prescriptions) . " records):\n";
            foreach ($prescriptions as $pres) {
                $prompt .= "- Date: " . $pres->date . ", Doctor: " . ($pres->doctor_name ?? 'N/A') . ", Medicine: " . ($pres->medicine ?? 'N/A') . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($lab_reports)) {
            $prompt .= "RECENT LAB REPORTS (" . count($lab_reports) . " records):\n";
            foreach ($lab_reports as $lab) {
                $prompt .= "- Date: " . $lab->date . ", Doctor: " . ($lab->doctor_name ?? 'N/A') . ", Test: " . ($lab->test_name ?? 'N/A') . "\n";
            }
            $prompt .= "\n";
        }

        if (!empty($image_analyses)) {
            $prompt .= "RECENT IMAGE ANALYSES (" . count($image_analyses) . " records):\n";
            foreach ($image_analyses as $img) {
                $prompt .= "- Date: " . $img->created_at . ", Type: " . ($img->image_type ?? 'N/A') . ", Result: " . substr($img->analysis_result ?? 'N/A', 0, 200) . "...\n";
            }
            $prompt .= "\n";
        }

        if (!empty($treatment_plans)) {
            $prompt .= "RECENT TREATMENT PLANS (" . count($treatment_plans) . " records):\n";
            foreach ($treatment_plans as $plan) {
                $prompt .= "- Date: " . $plan->created_at . ", Doctor: " . ($plan->doctor_name ?? 'N/A') . ", Plan: " . substr($plan->treatment_plan ?? 'N/A', 0, 200) . "...\n";
            }
            $prompt .= "\n";
        }

        $prompt .= "Please provide a comprehensive analysis including:\n";
        $prompt .= "1. Current Health Status Assessment\n";
        $prompt .= "2. Key Medical Concerns\n";
        $prompt .= "3. Treatment Progress\n";
        $prompt .= "4. Recommendations for Continued Care\n";
        $prompt .= "5. Risk Factors and Monitoring Needs\n";
        $prompt .= "6. Overall Prognosis\n\n";
        $prompt .= "Format your response in a clear, structured manner suitable for medical professionals.";

        return $prompt;
    }

    private function savePatientConditionAnalysis($patient_id, $analysis_result)
    {
        $data = array(
            'patient_id' => $patient_id,
            'hospital_id' => $this->session->userdata('hospital_id'),
            'analysis_result' => $analysis_result,
            'created_by' => $this->ion_auth->user()->row()->id,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('ai_patient_condition_analyses', $data);
        return $this->db->insert_id();
    }
}
