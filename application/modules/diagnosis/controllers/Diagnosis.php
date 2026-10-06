<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Diagnosis extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('diagnosis_model');
    }

    public function index()
    {

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('diagnosis', $data);
        $this->load->view('home/footer'); // just the header file
    }

    public function addNewView()
    {
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new');
        $this->load->view('home/footer'); // just the header file
    }

    public function addNew()
    {

        $id = $this->input->post('id');
        $disease_with_outbreak_potential = $this->input->post('disease_with_outbreak_potential');
        $maximum_expected_number_of_patient_in_a_week = $this->input->post('maximum_expected_number_of_patient_in_a_week');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $code = $this->input->post('code');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[200]|xss_clean');
        // Validating Password Field
        $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[1]|max_length[200]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("diagnosis/editDiagnosis?id=" . $id);
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard'); // just the header file
                $this->load->view('add_new', $data);
                $this->load->view('home/footer'); // just the header file
            }
        } else {


            //$error = array('error' => $this->upload->display_errors());
            $data = array();
            $data = array(
                'disease_with_outbreak_potential' => $disease_with_outbreak_potential,
                'maximum_expected_number_of_patient_in_a_week' => $maximum_expected_number_of_patient_in_a_week,
                'name' => $name,
                'description' => $description,
                'code' => $code,

            );


            ///   $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Diagnosis
                $this->diagnosis_model->insertDiagnosis($data);
                show_swal(lang('diagnosis_added_successfully'), 'success', lang('added'));
            } else { // Updating Diagnosis
                $this->diagnosis_model->updateDiagnosis($id, $data);
                show_swal(lang('diagnosis_details_updated_successfully'), 'success', lang('updated'));
            }
            // Loading View
            redirect('diagnosis');
        }
    }

    function getDiagnosis()
    {
        $data['diagnosiss'] = $this->diagnosis_model->getDiagnosis();
        $this->load->view('diagnosis', $data);
    }

    function editDiagnosis()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['diagnosis'] = $this->diagnosis_model->getDiagnosisById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editDiagnosisByJason()
    {
        $id = $this->input->get('id');
        $data['diagnosis'] = $this->diagnosis_model->getDiagnosisById($id);
        echo json_encode($data);
    }

    function delete()
    {

        $id = $this->input->get('id');

        $this->diagnosis_model->delete($id);
        show_swal(lang('diagnosis_deleted'), 'warning', lang('deleted'));
        redirect('diagnosis');
    }

    function getDiagnosisList()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "id",
            "1" => "name",
            "2" => "description",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['diagnosiss'] = $this->diagnosis_model->getDiagnosisBysearch($search, $order, $dir);
            } else {
                $data['diagnosiss'] = $this->diagnosis_model->getDiagnosisWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['diagnosiss'] = $this->diagnosis_model->getDiagnosisByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['diagnosiss'] = $this->diagnosis_model->getDiagnosisByLimit($limit, $start, $order, $dir);
            }
        }

        $options1 = '';

        $options5 = '';

        $i = 1;
        foreach ($data['diagnosiss'] as $diagnosis) {

            if ($this->ion_auth->in_group(array('admin'))) {
                // The 'btn btn-primary' classes make the button blue, indicating a primary action.
                $options1 = '<a type="button" class="btn btn-primary btn-sm editbutton my-2" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $diagnosis->id . '"><i class="fa fa-edit"></i> ' . lang('') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                // The 'btn btn-danger' classes make the button red, indicating a potentially dangerous action.
                $options5 = '<a class="btn btn-danger btn-sm delete_button" title="' . lang('delete') . '" href="diagnosis/delete?id=' . $diagnosis->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('') . '</a>';
            }


            $settings = $this->settings_model->getSettings();
            if ($diagnosis->disease_with_outbreak_potential == 1) {
                $disease_with_outbreak_potential = 'Yes';
            } else {
                $disease_with_outbreak_potential = 'No';
            }
            $info[] = array(
                $i,
                $diagnosis->name,
                $diagnosis->code,
                $diagnosis->description,
                $disease_with_outbreak_potential,
                $diagnosis->maximum_expected_number_of_patient_in_a_week,
                $options1 . ' ' . $options5,
                //  $options2
            );
            $i = $i + 1;
        }

        if (!empty($data['diagnosiss'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['diagnosiss']),
                "recordsFiltered" => count($this->diagnosis_model->getDiagnosis()),
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

    public function getDiagnosisInfo()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response = $this->diagnosis_model->getDiagnosisInfo($searchTerm);
        echo json_encode($response);
    }

    public function addNewDiagnosis()
    {
        $disease_with_outbreak_potential = $this->input->post('disease_with_outbreak_potential');
        $maximum_expected_number_of_patient_in_a_week = $this->input->post('maximum_expected_number_of_patient_in_a_week');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $code = $this->input->post('code');
        $data = array(
            'disease_with_outbreak_potential' => $disease_with_outbreak_potential,
            'maximum_expected_number_of_patient_in_a_week' => $maximum_expected_number_of_patient_in_a_week,
            'name' => $name,
            'description' => $description,
            'code' => $code,
        );

        if (empty($id)) {
            // Adding New Symptom
            $this->diagnosis_model->insertDiagnosis($data);
            $new_diagnosis_id = $this->db->insert_id();
            // Insert and return new ID

            // Return new symptom ID and name in JSON format
            echo json_encode([
                'id' => $new_diagnosis_id,
                'name' => $name
            ]);
        } else {
            // Handle updates if needed
        }
    }
}

/* End of file diagnosis.php */
/* Location: ./application/modules/diagnosis/controllers/diagnosis.php */
