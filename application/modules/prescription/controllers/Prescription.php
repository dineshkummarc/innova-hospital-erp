<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prescription extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('prescription_model');
        $this->load->model('medicine/medicine_model');
        $this->load->model('patient/patient_model');
        $this->load->model('pharmacist/pharmacist_model');
        $this->load->model('doctor/doctor_model');
        if (!$this->ion_auth->in_group(array('admin', 'Pharmacist', 'Doctor', 'Patient', 'Nurse', 'Receptionist'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        if ($this->ion_auth->in_group(array('Patient'))) {
            redirect('home/permission');
        }

        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        if ($this->ion_auth->in_group(array('Doctor'))) {
            $current_user = $this->ion_auth->get_user_id();
            $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
        }
        $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctorId($doctor_id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('prescription', $data);
        $this->load->view('home/footer');
    }

    function all()
    {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor', 'Pharmacist'))) {
            redirect('home/permission');
        }

        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['prescriptions'] = $this->prescription_model->getPrescription();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('all_prescription', $data);
        $this->load->view('home/footer');
    }

    public function addPrescriptionView()
    {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor'))) {
            redirect('home/permission');
        }

        $data = array();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_prescription_view', $data);
        $this->load->view('home/footer');
    }

    public function addNewPrescription()
    {

        if (!$this->ion_auth->in_group(array('admin', 'Doctor'))) {
            redirect('home/permission');
        }

        $id = $this->input->post('id');
        $tab = $this->input->post('tab');
        $date = $this->input->post('date');
        if (!empty($date)) {
            $date = strtotime($date);
        }

        $patient = $this->input->post('patient');
        $doctor = $this->input->post('doctor');
        $symptom = $this->input->post('symptom');
        $medicine = $this->input->post('medicine');
        $dosage = $this->input->post('dosage');
        $frequency = $this->input->post('frequency');
        $days = $this->input->post('days');
        $instruction = $this->input->post('instruction');
        $note = $this->input->post('note');
        $admin = $this->input->post('admin');


        $advice = $this->input->post('advice');

        $report = array();

        if (!empty($medicine)) {
            foreach ($medicine as $key => $value) {
                $report[$value] = array(
                    'dosage' => $dosage[$key],
                    'frequency' => $frequency[$key],
                    'days' => $days[$key],
                    'instruction' => $instruction[$key],
                );

                // }
            }

            foreach ($report as $key1 => $value1) {
                $final[] = $key1 . '***' . implode('***', $value1);
            }

            $final_report = implode('###', $final);
        } else {
            $final_report = '';
        }





        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Date Field
        $this->form_validation->set_rules('date', 'Date', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Patient Field
        $this->form_validation->set_rules('patient', 'Patient', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Doctor Field
        $this->form_validation->set_rules('doctor', 'Doctor', 'trim|min_length[1]|max_length[100]|xss_clean');
        // Validating Advice Field
        $this->form_validation->set_rules('symptom', 'History', 'trim|min_length[1]|max_length[1000]|xss_clean');
        // Validating Do And Dont Name Field
        $this->form_validation->set_rules('note', 'Note', 'trim|min_length[1]|max_length[1000]|xss_clean');

        // Validating Advice Field
        $this->form_validation->set_rules('advice', 'Advice', 'trim|min_length[1]|max_length[1000]|xss_clean');

        // Validating Validity Field
        $this->form_validation->set_rules('validity', 'Validity', 'trim|min_length[1]|max_length[100]|xss_clean');



        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect('prescription/editPrescription?id=' . $id);
            } else {
                $data = array();
                $data['setval'] = 'setval';
                $data['medicines'] = $this->medicine_model->getMedicine();
                $data['patients'] = $this->patient_model->getPatient();
                $data['doctors'] = $this->doctor_model->getDoctor();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer');
            }
        } else {
            $data = array();
            $patientname = $this->patient_model->getPatientById($patient)->name;
            $doctorname = $this->doctor_model->getDoctorById($doctor)->name;
            $data = array(
                'date' => $date,
                'patient' => $patient,
                'doctor' => $doctor,
                'symptom' => $symptom,
                'medicine' => $final_report,
                'note' => $note,
                'advice' => $advice,
                'patientname' => $patientname,
                'doctorname' => $doctorname
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescription($data);
                $insert_id = $this->db->insert_id();
                show_swal(lang('new_prescription_addedd'), 'success', lang('added'));
            } else {
                $this->prescription_model->updatePrescription($id, $data);
                show_swal(lang('prescription_updated_successfully'), 'success', lang('updated'));
            }

            if (!empty($id)) {
                redirect('prescription/editPrescription?id=' . $id);
            } else {
                redirect('prescription/editPrescription?id=' . $insert_id);
            }

            // if (!empty($admin)) {
            //     if ($this->ion_auth->in_group(array('Doctor'))) {
            //         redirect('prescription');
            //     } else {
            //         redirect('prescription/all');
            //     }
            // } else {
            //     redirect('prescription');
            // }
        }
    }

    public function addNewPrescriptionQuick()
    {
        $data = array();
        $data['setval'] = 'setval';
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['patients'] = $this->patient_model->getPatient();
        $data['doctors'] = $this->doctor_model->getDoctor();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_prescription_view', $data);
        $this->load->view('home/footer');
    }

    function viewPrescription()
    {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);

        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('prescription_view_1', $data);
                $this->load->view('home/footer');
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function viewPrescriptionPrint()
    {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);

        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('prescription_view_print', $data);
                $this->load->view('home/footer');
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function editPrescription()
    {
        $data = array();
        $id = $this->input->get('id');
        // $data['patients'] = $this->patient_model->getPatient();
        // $data['doctors'] = $this->doctor_model->getDoctor();
        $data['medicines'] = $this->medicine_model->getMedicine();
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $data['patients'] = $this->patient_model->getPatientById($data['prescription']->patient);
        $data['doctors'] = $this->doctor_model->getDoctorById($data['prescription']->doctor);
        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard', $data);
                $this->load->view('add_new_prescription_view', $data);
                $this->load->view('home/footer'); // just the footer file 
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    function editPrescriptionByJason()
    {
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        echo json_encode($data);
    }

    function getPrescriptionForQuickView()
    {
        $id = $this->input->get('id');
        
        if (empty($id)) {
            echo json_encode(['error' => 'No prescription ID provided']);
            return;
        }
        
        $prescription = $this->prescription_model->getPrescriptionById($id);
        
        if (empty($prescription)) {
            echo json_encode(['error' => 'Prescription not found']);
            return;
        }
        
        if (!empty($prescription->hospital_id)) {
            if ($prescription->hospital_id != $this->session->userdata('hospital_id')) {
                echo json_encode(['error' => 'Permission denied']);
                return;
            }
        } else {
            echo json_encode(['error' => 'Permission denied']);
            return;
        }

        // Get patient and doctor details
        $patient = $this->patient_model->getPatientById($prescription->patient);
        $doctor = $this->doctor_model->getDoctorById($prescription->doctor);
        
        // Process medicine data
        $medicineList = [];
        if (!empty($prescription->medicine)) {
            $medicines = explode('###', $prescription->medicine);
            foreach ($medicines as $medicine) {
                if (!empty(trim($medicine))) {
                    $medicineData = explode('***', $medicine);
                    if (count($medicineData) >= 4) {
                        $medicineDetails = $this->medicine_model->getMedicineById($medicineData[0]);
                        $medicineList[] = [
                            'name' => !empty($medicineDetails->name) ? $medicineDetails->name : 'Unknown',
                            'dosage' => !empty($medicineData[1]) ? $medicineData[1] : '',
                            'frequency' => !empty($medicineData[2]) ? $medicineData[2] : '',
                            'instruction' => !empty($medicineData[3]) ? $medicineData[3] : '',
                            'days' => isset($medicineData[4]) ? $medicineData[4] : ''
                        ];
                    }
                }
            }
        }

        $data = [
            'prescription' => $prescription,
            'patient' => $patient,
            'doctor' => $doctor,
            'medicines' => $medicineList,
            'formatted_date' => date('M d, Y', $prescription->date)
        ];

        echo json_encode($data);
    }

    function getPrescriptionByPatientIdByJason()
    {
        $id = $this->input->get('id');
        $prescriptions = $this->prescription_model->getPrescriptionByPatientId($id);
        foreach ($prescriptions as $prescription) {
            $lists[] = ' <div class="float-left prescription_box" style = "padding: 10px; background: #fff;"><div class="prescription_box_title">Prescription Date</div> <div>' . date('d-m-Y', $prescription->date) . '</div> <div class="prescription_box_title">Medicine</div> <div>' . $prescription->medicine . '</div> </div> ';
        }
        $data['prescription'] = $lists;
        $lists = NULL;
        echo json_encode($data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        $admin = $this->input->get('admin');
        $patient = $this->input->get('patient');
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        if (!empty($data['prescription']->hospital_id)) {
            if ($data['prescription']->hospital_id != $this->session->userdata('hospital_id')) {
                $this->load->view('home/permission');
            } else {
                $this->prescription_model->deletePrescription($id);
                if (!empty($patient)) {
                    show_swal(lang('prescription_deleted'), 'warning', lang('deleted'));
                    redirect('patient/caseHistory?patient_id=' . $patient);
                } elseif (!empty($admin)) {
                    show_swal(lang('prescription_deleted'), 'warning', lang('deleted'));
                    redirect('prescription/all');
                } else {
                    show_swal(lang('prescription_deleted'), 'warning', lang('deleted'));
                    redirect('prescription');
                }
            }
        } else {
            $this->load->view('home/permission');
        }
    }

    public function prescriptionCategory()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $data['categories'] = $this->prescription_model->getPrescriptionCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('prescription_category', $data);
        $this->load->view('home/footer');
    }

    public function addCategoryView()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_category_view');
        $this->load->view('home/footer');
    }

    public function addNewCategory()
    {
        $id = $this->input->post('id');
        $category = $this->input->post('category');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Category Name Field
        $this->form_validation->set_rules('category', 'Category', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Description Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data);
            $this->load->view('add_new_category_view');
            $this->load->view('home/footer');
        } else {
            $data = array();
            $data = array(
                'category' => $category,
                'description' => $description
            );
            if (empty($id)) {
                $this->prescription_model->insertPrescriptionCategory($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else {
                $this->prescription_model->updatePrescriptionCategory($id, $data);
                show_swal(lang('updated'), 'success', lang('updated'));
            }
            redirect('prescription/prescriptionCategory');
        }
    }

    function edit_category()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['prescription'] = $this->prescription_model->getPrescriptionCategoryById($id);
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new_category_view', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editPrescriptionCategoryByJason()
    {
        $id = $this->input->get('id');
        $data['prescriptioncategory'] = $this->prescription_model->getPrescriptionCategoryById($id);
        echo json_encode($data);
    }

    function deletePrescriptionCategory()
    {
        $id = $this->input->get('id');
        $this->prescription_model->deletePrescriptionCategory($id);
        show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('prescription/prescriptionCategory');
    }

    function getPrescriptionListByDoctor()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        $doctor_ion_id = $this->ion_auth->get_user_id();
        $doctor = $this->db->get_where('doctor', array('ion_user_id' => $doctor_ion_id))->row()->id;
        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearchByDoctor($doctor, $search, $order, $dir);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByDoctorWithoutSearch($doctor, $order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearchByDoctor($doctor, $limit, $start, $search, $order, $dir);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitByDoctor($doctor, $limit, $start, $order, $dir);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a class="btn btn-success btn-sm btn_width mt-1" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye">' . lang('view') . ' ' . lang('prescription') . ' </i></a>';
            $option3 = '<a class="btn btn-primary btn-sm btn_width mt-1" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a>';
            $option2 = '<a class="btn btn-danger btn-sm btn_width delete_button mt-1" href="prescription/delete?id=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-secondary btn-sm invoicebutton mt-1" title="' . lang('print') . '" style="color: #fff;" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '"target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            } else {
                $medicinelist = '';
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $patientname,
                $prescription->patient,
                $medicinelist,
                $option1 . ' ' . $option3 . ' ' . $option2 . ' ' . $options4
            );
            $i = $i + 1;
        }

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->prescription_model->getPrescriptionByDoctorId($doctor)),
                "recordsFiltered" => $i,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function getPrescriptionList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "date",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionBysearch($search, $order, $dir);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['prescriptions'] = $this->prescription_model->getPrescriptionByLimit($limit, $start, $order, $dir);
            }
        }


        //  $data['patients'] = $this->patient_model->getVisitor();
        $i = 0;
        $option1 = '';
        $option2 = '';
        $option3 = '';
        foreach ($data['prescriptions'] as $prescription) {
            //$i = $i + 1;
            $settings = $this->settings_model->getSettings();

            $option1 = '<a title="' . lang('view') . ' ' . lang('prescription') . '" class="btn btn-outline-success btn-sm btn_width mt-1" href="prescription/viewPrescription?id=' . $prescription->id . '"><i class="fa fa-eye"> ' . lang('view') . ' ' . lang('') . ' </i></a>';
            $option3 = '<a class="btn btn-outline-primary btn-sm btn_width mt-1" href="prescription/editPrescription?id=' . $prescription->id . '" data-id="' . $prescription->id . '"><i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('') . '</a>';
            $option2 = '<a class="btn btn-outline-danger btn-sm btn_width delete_button mt-1" href="prescription/delete?id=' . $prescription->id . '&admin=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i></a>';
            $options4 = '<a class="btn btn-outline-secondary btn-sm invoicebutton mt-1" title="' . lang('print') . '" href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '" target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . '</a>';
            $quickView = '<button class="btn btn-outline-info btn-sm btn_width mt-1 quick-view-btn" title="Quick View" data-id="' . $prescription->id . '" data-toggle="modal" data-target="#quickViewModal"><i class="fa fa-search-plus"></i> Quick View</button>';

            if (!empty($prescription->medicine)) {
                $medicine = explode('###', $prescription->medicine);
                $medicinelist = '';
                foreach ($medicine as $key => $value) {
                    $medicine_id = explode('***', $value);
                    $medicine_name_with_dosage = $this->medicine_model->getMedicineById($medicine_id[0])->name . ' -' . $medicine_id[1];
                    $medicine_name_with_dosage = $medicine_name_with_dosage . ' | ' . $medicine_id[3] . '<br>';
                    rtrim($medicine_name_with_dosage, ',');
                    $medicinelist .= '<p>' . $medicine_name_with_dosage . '</p>';
                }
            } else {
                $medicinelist = '';
            }
            $patientdetails = $this->patient_model->getPatientById($prescription->patient);
            if (!empty($patientdetails)) {
                $patientname = $patientdetails->name;
            } else {
                $patientname = $prescription->patientname;
            }
            $doctordetails = $this->doctor_model->getDoctorById($prescription->doctor);
            if (!empty($doctordetails)) {
                $doctorname = $doctordetails->name;
            } else {
                $doctorname = $prescription->doctorname;
            }

            if ($this->ion_auth->in_group(array('Pharmacist', 'Receptionist'))) {
                $option2 = '';
                $option3 = '';
            }



            $dropdownOptions = '';
            $dropdownOptions = '
            <div class="btn-group">
            <button type="button" class="btn btn-info btn-sm label-primary dropdown-toggle action_button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="">
            <i class="fas fa-bars"></i> ' . lang('actions') . ' <span class="caret"></span>
        </button>
                <ul class="dropdown-menu">
                    ' . ($option1 ? '<li><a href="prescription/viewPrescription?id=' . $prescription->id . '"  title="' . lang('view_prescription') . '" data-toggle = "modal" data-id="' . $doctor->id . '"> <i class="fa fa-file-invoice"></i> ' . lang('view') . ' ' . lang('prescription') . ' </a></li>' : '') . '
                    ' . ($option3 ? '<li><a href="prescription/editPrescription?id=' . $prescription->id . '" title="' . lang('edit') . '" data-toggle = "modal" data-id="' . $doctor->id . '">  <i class="fa fa-edit"></i> ' . lang('edit') . ' ' . lang('prescription') . '</a></li>' : '') . '
                    ' . ($options4 ? '<li><a  href="prescription/viewPrescriptionPrint?id=' . $prescription->id . '" target="_blank"> <i class="fa fa-print"></i> ' . lang('print') . ' </a></li>' : '') . '
                    ' . ($option2 ? '<li><a href="prescription/delete?id=' . $prescription->id . '&admin=' . $prescription->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');" > <i class="fa fa-trash"></i> ' . lang('delete') . ' </a></li>' : '') . '

                </ul>
            </div>';






            $info[] = array(
                $prescription->id,
                date('d-m-Y', $prescription->date),
                $doctorname,
                $patientname,
                $medicinelist,
                $quickView . ' ' . $option1 . ' ' . $option3 . ' ' . $options4 . ' ' . $option2
                // $dropdownOptions
            );
            $i = $i + 1;
        }

        if ($data['prescriptions']) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->prescription_model->getPrescription()),
                "recordsFiltered" => count($this->prescription_model->getPrescription()),
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }

        echo json_encode($output);
    }

    function sendPrescription()
    {
        $id = $this->input->post('id');
        $is_v_v = $this->input->post('radio');
        $data['settings'] = $this->settings_model->getSettings();
        $data['prescription'] = $this->prescription_model->getPrescriptionById($id);
        $settings1 = $this->settings_model->getSettings();


        error_reporting(0);
        $data['redirect'] = 'download';



        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
        $mpdf->setAutoTopMargin = 'stretch';
        // $mpdf->SetHTMLHeader($header);
        //$this->autoMarginPadding = 300;
        $mpdf->setAutoBottomMargin = 'stretch';
        //         $mpdf->SetHTMLFooter('
        //    <div style="text-align:center;font-weight: bold; font-size: 7pt; !important;">' .
        //             $settings1->footer_invoice_message . '</div>', 'O');
        $html = $this->load->view('prescription_view_1', $data, true);

        $mpdf->WriteHTML($html);

        $filename = "prescription--00" . $id . ".pdf";
        $mpdf->Output(APPPATH . '../invoicefile/' . $filename, 'F');
        // $patientemail = $this->patient_model->getPatientById($data['payment']->patient)->email;
        if ($is_v_v == 'patient') {
            $patientemail = $this->patient_model->getPatientById($data['prescription']->patient)->email;
        }
        if ($is_v_v == 'other') {
            $patientemail = $this->input->post('other_email');
        }
        if ($is_v_v == 'single_pharmacist') {
            $pharmacist = $this->input->post('pharmacist');

            $pharmacist_detail = $this->pharmacist_model->getPharmacistById($pharmacist);
            $message = $this->input->post('message');
            $name = explode(' ', $pharmacist_detail->name);
            if (!isset($name[1])) {
                $name[1] = null;
            }
            $data1 = array(
                'firstname' => $name[0],
                'lastname' => $name[1],
                'name' => $pharmacist_detail->name,
                'phone' => $pharmacist_detail->phone,
                'email' => $pharmacist_detail->email,
                'address' => $pharmacist_detail->address,
                // 'company' => $settngsname
            );
            $messageprint = $this->parser->parse_string($message, $data1);
            $data2[] = array($pharmacist_detail->email => $messageprint);
            $patientemail = $pharmacist_detail->email;
            // $recipient = 'Nurse Id: ' . $pharmacist_detail->id . '<br> Nurse Name: ' . $pharmacist_detail->name . '<br> Nurse Email: ' . $pharmacist_detail->email;
        }
        $subject = lang('prescription');
        $mail_provider = $this->settings_model->getSettings()->emailtype;
        $settngs_name = $this->settings_model->getSettings()->system_vendor;
        $email_Settings = $this->email_model->getEmailSettingsByType($mail_provider);

        $this->load->library('encryption');
        if ($mail_provider == 'Domain Email') {
            $this->email->from($email_Settings->admin_email);
        }
        if ($mail_provider == 'Smtp') {
            $this->email->from($email_Settings->user, $settngs_name);
        }

        $this->email->to($patientemail);
        $this->email->subject($subject);

        $this->email->attach('invoicefile/' . $filename);

        // print_r($subject);
        // die();
        if ($this->email->send()) {

            unlink(APPPATH . '../invoicefile/' . $filename);
            show_swal(lang('prescription_sent'), 'success', lang('success'));
            redirect("prescription/viewPrescription?id=" . $id);
        } else {
            unlink(APPPATH . '../invoicefile/' . $filename);
            show_swal(lang('prescription_not_sent'), 'error', lang('error'));
            redirect("prescription/viewPrescription?id=" . "$id");
        }
    }
}

/* End of file prescription.php */
/* Location: ./application/modules/prescription/controllers/prescription.php */
