<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ai_patient_overview extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ai_patient_overview_model');
        $this->load->model('patient/patient_model');
        $this->load->model('doctor/doctor_model');
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
            $this->load->view('index', $data);
            $this->load->view('home/footer');
             
        } catch (Exception $e) {
            log_message('error', 'AI Patient Overview Error: ' . $e->getMessage());
            show_error('An error occurred while loading the page.');
        }
    } 

    public function getPatientOverview()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $patient_id = $this->input->post('patient_id');
        $doctor_id = $this->input->post('doctor_id');
        
        if (!$patient_id) {
            echo json_encode(['success' => false, 'message' => 'Patient ID is required']);
            return;
        }

        try {
            // Collect all patient data
            $patient_data = $this->ai_patient_overview_model->collectPatientData($patient_id);
            
            if (empty($patient_data)) {
                echo json_encode(['success' => false, 'message' => 'No data found for this patient']);
                return;
            }

            // Generate AI analysis (doctor_id is optional)
            $ai_analysis = $this->generateAIAnalysis($patient_data, $patient_id, $doctor_id);
            
            // Save the analysis (use null doctor_id if not provided)
            $analysis_id = $this->ai_patient_overview_model->saveAnalysis($patient_id, $doctor_id, $ai_analysis);
            
            echo json_encode([
                'success' => true,
                'analysis_id' => $analysis_id,
                'patient_data' => $patient_data,
                'ai_analysis' => $ai_analysis
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'AI Patient Overview Analysis Error: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Error generating analysis: ' . $e->getMessage()]);
        }
    }

    private function generateAIAnalysis($patient_data, $patient_id, $doctor_id)
    {
        // Get API key from settings
        $settings = $this->settings_model->getSettings();
        $api_key = $settings->chatgpt_api_key ?? '';
        
        if (empty($api_key)) {
            throw new Exception('OpenAI API key not configured');
        }

        // Prepare the comprehensive prompt
        $prompt = $this->prepareAnalysisPrompt($patient_data, $patient_id, $doctor_id);
        
        $data = array(
            'model' => 'gpt-4.1',
            'messages' => array( 
                array(
                    'role' => 'user',
                    'content' => $prompt
                )
            ),
            'max_tokens' => 4000,
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

        if ($http_code !== 200) {
            throw new Exception('OpenAI API error: ' . $response);
        }

        $result = json_decode($response, true);
        
        if (isset($result['error'])) {
            throw new Exception('OpenAI API error: ' . $result['error']['message']);
        }

        return $result['choices'][0]['message']['content'] ?? 'Analysis failed';
    }

    private function prepareAnalysisPrompt($patient_data, $patient_id, $doctor_id)
    {
        $patient = $patient_data['patient'];
        $appointments = $patient_data['appointments'];
        $prescriptions = $patient_data['prescriptions'];
        $lab_reports = $patient_data['lab_reports'];
        $medical_history = $patient_data['medical_history'];
        $vital_signs = $patient_data['vital_signs'];
        $bed_allotments = $patient_data['bed_allotments'];
        $patient_materials = $patient_data['patient_materials'];
        $payments = $patient_data['payments'];
        $diagnoses = $patient_data['diagnoses'];
        
        $prompt = "As a medical AI assistant, please analyze the following comprehensive patient data and provide a detailed overview of the patient's current condition, medical history, treatments, and recommendations.\n\n";
        
        $prompt .= "=== PATIENT DEMOGRAPHICS ===\n";
        $prompt .= "Name: " . $patient->name . "\n";
        $prompt .= "Age: " . $patient->age . " years\n";
        $prompt .= "Gender: " . $patient->sex . "\n";
        $prompt .= "Patient ID: " . $patient_id . "\n";
        $prompt .= "Address: " . (isset($patient->address) ? $patient->address : 'Not provided') . "\n";
        $prompt .= "Phone: " . (isset($patient->phone) ? $patient->phone : 'Not provided') . "\n\n";
        
        if (!empty($appointments)) {
            $prompt .= "=== APPOINTMENT HISTORY ===\n";
            foreach ($appointments as $appointment) {
                $date = isset($appointment->date) ? $appointment->date : 'Unknown Date';
                $doctor = isset($appointment->doctorname) ? $appointment->doctorname : 'Unknown Doctor';
                $patient = isset($appointment->patientname) ? $appointment->patientname : 'Unknown Patient';
                $status = isset($appointment->status) ? $appointment->status : 'Unknown';
                $time = isset($appointment->s_time) ? $appointment->s_time : 'Unknown Time';
                $prompt .= "- Date: " . $date . " | Time: " . $time . " | Doctor: " . $doctor . " | Patient: " . $patient . " | Status: " . $status . "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($prescriptions)) {
            $prompt .= "=== PRESCRIPTION HISTORY ===\n";
            foreach ($prescriptions as $prescription) {
                $medicine = isset($prescription->medicine) ? $prescription->medicine : 'Unknown Medicine';
                $dosage = isset($prescription->dosage) ? $prescription->dosage : (isset($prescription->dose) ? $prescription->dose : 'N/A');
                $frequency = isset($prescription->frequency) ? $prescription->frequency : (isset($prescription->times) ? $prescription->times : 'N/A');
                $date = isset($prescription->date) ? $prescription->date : 'Unknown Date';
                $prompt .= "- Medicine: " . $medicine . " | Dosage: " . $dosage . " | Frequency: " . $frequency . " | Date: " . $date . "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($lab_reports)) {
            $prompt .= "=== LABORATORY TEST RESULTS ===\n";
            foreach ($lab_reports as $lab) {
                $test_name = isset($lab->category_id) ? 'Test ID: ' . $lab->category_id : 'Unknown Test';
                $result = isset($lab->result) ? $lab->result : 'N/A';
                $date = isset($lab->date) ? $lab->date : 'Unknown Date';
                $status = isset($lab->status) ? $lab->status : 'Unknown';
                $prompt .= "- Test: " . $test_name . " | Result: " . $result . " | Date: " . $date . " | Status: " . $status . "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($medical_history)) {
            $prompt .= "=== MEDICAL HISTORY (CASE RECORDS) ===\n";
            foreach ($medical_history as $history) {
                $title = isset($history->title) ? $history->title : 'Medical Record';
                $description = isset($history->description) ? $history->description : 'No description';
                $date = isset($history->date) ? date('Y-m-d', $history->date) : 'Unknown Date';
                $prompt .= "- Title: " . $title . " | Description: " . $description . " | Date: " . $date . "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($vital_signs)) {
            $prompt .= "=== VITAL SIGNS RECORD ===\n";
            foreach ($vital_signs as $vital) {
                $date = isset($vital->add_date_time) ? $vital->add_date_time : 'Unknown Date';
                $heart_rate = isset($vital->heart_rate) ? $vital->heart_rate : 'N/A';
                $blood_pressure = isset($vital->systolic_blood_pressure) && isset($vital->diastolic_blood_pressure) ? 
                    $vital->systolic_blood_pressure . '/' . $vital->diastolic_blood_pressure : 'N/A';
                $temperature = isset($vital->temperature) ? $vital->temperature : 'N/A';
                $oxygen_saturation = isset($vital->oxygen_saturation) ? $vital->oxygen_saturation : 'N/A';
                $respiratory_rate = isset($vital->respiratory_rate) ? $vital->respiratory_rate : 'N/A';
                $weight = isset($vital->bmi_weight) ? $vital->bmi_weight : 'N/A';
                $height = isset($vital->bmi_height) ? $vital->bmi_height : 'N/A';
                
                $prompt .= "- Date: " . $date . " | Heart Rate: " . $heart_rate . " bpm | BP: " . $blood_pressure . " mmHg | ";
                $prompt .= "Temp: " . $temperature . "°C | O2 Sat: " . $oxygen_saturation . "% | ";
                $prompt .= "Resp Rate: " . $respiratory_rate . " bpm | Weight: " . $weight . " kg | Height: " . $height . " cm\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($bed_allotments)) {
            $prompt .= "=== HOSPITALIZATION RECORD ===\n";
            foreach ($bed_allotments as $bed) {
                $bed_id = isset($bed->bed) ? $bed->bed : 'Unknown';
                $allotment_time = isset($bed->a_time) ? $bed->a_time : 'Unknown';
                $discharge_time = isset($bed->d_time) ? $bed->d_time : 'Not discharged';
                $prompt .= "- Bed ID: " . $bed_id . " | Admitted: " . $allotment_time . " | Discharged: " . $discharge_time . "\n";
            }
            $prompt .= "\n";
        }
        
        // Diagnosis history not available - diagnosis table doesn't have patient column
        
        if (!empty($payments)) {
            $prompt .= "=== PAYMENT HISTORY ===\n";
            foreach ($payments as $payment) {
                $amount = isset($payment->amount) ? $payment->amount : 'N/A';
                $date = isset($payment->date) ? $payment->date : 'Unknown Date';
                $status = isset($payment->status) ? $payment->status : 'Unknown';
                $prompt .= "- Amount: $" . $amount . " | Date: " . $date . " | Status: " . $status . "\n";
            }
            $prompt .= "\n";
        }
        
        if (!empty($patient_materials)) {
            $prompt .= "=== PATIENT DOCUMENTS ===\n";
            foreach ($patient_materials as $material) {
                $title = isset($material->title) ? $material->title : 'Document';
                $type = isset($material->type) ? $material->type : 'Unknown Type';
                $date = isset($material->date) ? $material->date : 'Unknown Date';
                $prompt .= "- " . $title . " (" . $type . ") | Date: " . $date . "\n";
            }
            $prompt .= "\n";
        }
        
        $prompt .= "=== AI ANALYSIS REQUEST ===\n";
        $prompt .= "Please provide a comprehensive medical analysis including:\n\n";
        $prompt .= "1. **PATIENT OVERVIEW**: Current health status, age-related considerations, and demographic factors\n";
        $prompt .= "2. **MEDICAL HISTORY ANALYSIS**: Pattern recognition in symptoms, diagnoses, and treatments over time\n";
        $prompt .= "3. **MEDICATION ASSESSMENT**: Current prescriptions effectiveness, potential interactions, and compliance patterns\n";
        $prompt .= "4. **LABORATORY INTERPRETATION**: Test results analysis, trends, and clinical significance\n";
        $prompt .= "5. **VITAL SIGNS EVALUATION**: Health indicators trends and any concerning patterns\n";
        $prompt .= "6. **RISK FACTORS**: Identified health risks, chronic conditions, and preventive measures needed\n";
        $prompt .= "7. **TREATMENT RECOMMENDATIONS**: Specific medical advice, medication adjustments, and care plan suggestions\n";
        $prompt .= "8. **FOLLOW-UP PLAN**: Recommended next steps, monitoring requirements, and appointment scheduling\n";
        $prompt .= "9. **EMERGENCY CONSIDERATIONS**: Any urgent health concerns or immediate action items\n";
        $prompt .= "10. **LIFESTYLE RECOMMENDATIONS**: Diet, exercise, and lifestyle modifications based on medical history\n";
        $prompt .= "Format the response as a professional medical report with clear sections, bullet points, and actionable recommendations suitable for healthcare providers and patient care coordination.";
        
        return $prompt;
    }

    public function getAnalysisHistory()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $analyses = $this->ai_patient_overview_model->getAllAnalyses();
        
        $formatted_analyses = array();
        foreach ($analyses as $analysis) {
            $formatted_analyses[] = array(
                'id' => $analysis->id,
                'created_at' => date('Y-m-d H:i:s', strtotime($analysis->created_at)),
                'patient_name' => $analysis->patient_name ?? 'Unknown Patient',
                'doctor_name' => $analysis->doctor_name ?? 'Unknown Doctor',
                'status' => !empty($analysis->analysis_result) ? 'completed' : 'pending'
            );
        }
        
        echo json_encode($formatted_analyses);
    }

    public function getAnalysisHistoryDataTables()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        try {
            $hospital_id = $this->session->userdata('hospital_id');
            if (!$hospital_id) {
                echo json_encode(['error' => 'Hospital ID not found']);
                return;
            }

            $start = $this->input->post('start') ?: 0;
            $length = $this->input->post('length') ?: 10;
            $search_value = $this->input->post('search')['value'] ?: '';
            $order_column = $this->input->post('order')[0]['column'] ?: 0;
            $order_dir = $this->input->post('order')[0]['dir'] ?: 'desc';
            $columns = ['created_at', 'patient_name', 'doctor_name', 'status', 'actions'];
            $order_by = $columns[$order_column] ?: 'created_at';

            // Get analyses with patient and doctor names
            $this->db->select('apo.*, p.name as patient_name, d.name as doctor_name');
            $this->db->from('ai_patient_overviews apo');
            $this->db->join('patient p', 'p.id = apo.patient_id', 'left');
            $this->db->join('doctor d', 'd.id = apo.doctor_id', 'left');
            $this->db->where('apo.hospital_id', $hospital_id);

            if (!empty($search_value)) {
                $this->db->group_start();
                $this->db->like('apo.created_at', $search_value);
                $this->db->or_like('p.name', $search_value);
                $this->db->or_like('d.name', $search_value);
                $this->db->group_end();
            }

            $total_records = $this->db->count_all_results('', false);
            $this->db->order_by($order_by, $order_dir);
            $this->db->limit($length, $start);
            $query = $this->db->get();
            $records = $query->result();

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
                    $status_badge,
                    $actions
                ];
            }

            echo json_encode([
                'draw' => intval($this->input->post('draw')),
                'recordsTotal' => $total_records,
                'recordsFiltered' => $total_records,
                'data' => $data
            ]);

        } catch (Exception $e) {
            log_message('error', 'AI Patient Overview - DataTables Error: ' . $e->getMessage());
            echo json_encode(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function getAnalysisById()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $analysis_id = $this->input->post('analysis_id');
        
        if (!$analysis_id) {
            echo json_encode(['success' => false, 'message' => 'Analysis ID required']);
            return;
        }

        $analysis = $this->ai_patient_overview_model->getAnalysisById($analysis_id);
        
        if (!$analysis) {
            echo json_encode(['success' => false, 'message' => 'Analysis not found']);
            return;
        }

        // Get patient and doctor names
        $patient = $this->patient_model->getPatientById($analysis->patient_id);
        $doctor = $this->doctor_model->getDoctorById($analysis->doctor_id);
        
        $analysis->patient_name = $patient ? $patient->name : 'Unknown Patient';
        $analysis->doctor_name = $doctor ? $doctor->name : 'Unknown Doctor';

        echo json_encode(['success' => true, 'analysis' => $analysis]);
    }

    public function deleteAnalysis()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $analysis_id = $this->input->post('analysis_id');
        
        if (!$analysis_id) {
            echo json_encode(['success' => false, 'message' => 'Analysis ID required']);
            return;
        }

        $result = $this->ai_patient_overview_model->deleteAnalysis($analysis_id);
        
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Analysis deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete analysis']);
        }
    }
}
