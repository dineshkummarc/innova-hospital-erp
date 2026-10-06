<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Testpkz extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('testpkz_model');
        $this->load->model('finance/finance_model');
        if (!$this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Doctor', 'Laboratorist', 'im', 'Pharmacist', 'Receptionist', 'onlinecenter', 'casetaker'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('testpkz', $data);
        $this->load->view('home/footer');
    }

    public function addNewView()
    {
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard', $data);
        $this->load->view('add_new');
        $this->load->view('home/footer');
    }

    public function addNewTestpkz()
    {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $payment_category = $this->input->post('payment_category');
        $payment_category = implode(',', $payment_category);
        // $doctor_id = explode(',', $doctor);
// print_r($doctor_id[0]);
// die();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Title Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[200]|xss_clean');

        if ($this->form_validation->run() == false) {
            if (!empty($id)) {
                redirect("testpkz/editTestpkz?id=$id");
            } else {
                $data['payment_categories'] = $this->finance_model->getPaymentCategory();
                $this->load->view('home/dashboard');
                $this->load->view('add_new');
                $this->load->view('home/footer');
            }
        } else {

                $data = array();
                $data = array(
                   
                    'name' => $name,
                    'payment_category' => $payment_category,
                   
                );
         


            if (empty($id)) { // Adding New Testpkz
                $this->testpkz_model->insertTestpkz($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else { // Updating Testpkz
                $this->testpkz_model->updateTestpkz($id, $data);
               show_swal(lang('updated'), 'success', lang('updated'));
            }
            // Loading View
            redirect('testpkz');
        }
    }

    public function getTestpkz()
    {
        $data['testpkzs'] = $this->testpkz_model->getTestpkz();
        $this->load->view('testpkz', $data);
    }

    public function editTestpkz()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['payment_categories'] = $this->finance_model->getPaymentCategory();
        $data['testpkz'] = $this->testpkz_model->getTestpkzById($id);
        $this->load->view('home/dashboard');
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    public function editTestpkzByJason()
    {
        $id = $this->input->get('id');
        $data['testpkz'] = $this->testpkz_model->getTestpkzById($id);
        echo json_encode($data);
    }

    public function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $this->testpkz_model->delete($id);
       show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('testpkz');
    }

    public function getTestpkzs()
    {
        $requestData = $_REQUEST;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $this->input->post('search')['value'];

        $order = $this->input->post("order");
        $columns_valid = array(
            "0" => "name",
            "1" => "description",
        );
        $values = $this->settings_model->getColumnOrder($order, $columns_valid);
        $dir = $values[0];
        $order = $values[1];

        if ($limit == -1) {
            if (!empty($search)) {
                $data['testpkzs'] = $this->testpkz_model->getTestpkzBySearch($search, $order, $dir);
            } else {
                $data['testpkzs'] = $this->testpkz_model->getTestpkzWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['testpkzs'] = $this->testpkz_model->getTestpkzByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['testpkzs'] = $this->testpkz_model->getTestpkzByLimit($limit, $start, $order, $dir);
            }
        }

        $i = 0;
        foreach ($data['testpkzs'] as $testpkz) {

            if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Doctor'))) {
                $options2 = '<a class="btn btn-info btn-xs delete_button" href="testpkz/delete?id=' . $testpkz->id . '"onclick="return confirm(\'You want to delete the item??\');"> X </a>';
                $options3 = '<a class="btn btn-info btn-xs" href="testpkz/editTestpkz?id=' . $testpkz->id . '"> <i class="fa fa-edit">' . lang('edit') . '</i> </a>';
            }
          
            $payment_category = explode(',', $testpkz->payment_category);
            $payment_category_list = '';
            foreach ($payment_category as $key => $value) {
                $payment_category_name = $this->finance_model->getPaymentCategoryById($value)->category;
                $payment_category_list .= '<p>' . $payment_category_name . '</p>';
                // print_r($value);
                // die();
            }

            $i = $i + 1;
            $info[] = array(
                $testpkz->name,
                $payment_category_list,
                $options3 . ' ' . $options2,
            );
        }

        if (!empty($data['testpkzs'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => $i,
                "recordsFiltered" => $i,
                "data" => $info,
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

    public function getTestpkzNamelist()
    {
        $searchTerm = $this->input->post('searchTerm');
        $category = $this->input->post('catchange');
        $medid = $this->input->post('medid');
        if ($this->ion_auth->in_group(array('onlinecenter', 'casetaker'))) {
            $data = $this->testpkz_model->getTestpkzByAvailablityOnlicecenter($category, $searchTerm);
        } else {
            $data = $this->testpkz_model->getTestpkzByAvailablity($searchTerm);
        }


        echo json_encode($data);
    }
    // function getTestpkzDetails()
    // {
    //     $id = $this->input->get('id');
    //     $data['appointment'] = $this->testpkz_model->getTestpkzById($id);
    //     $doctors = explode(",", $data['appointment']->doctor);
    //     foreach ($doctors as $key => $value) {
    //         $doctor_name = $this->doctor_model->getDoctorById($value)->name;
    //         $doctor_implode[] =  $doctor_name;
    //     }
    //     $data['doctor_list'] = implode(",", $doctor_implode);
    //     echo json_encode($data);
    // }
    public function getTestpkzDetails()
    {
        $id = $this->input->get('id');
        $data['testpkz'] = $this->testpkz_model->getTestpkzById($id);
        $testpkz_item = explode(",", $data['testpkz']->payment_category);
        foreach ($testpkz_item as $key => $value) {
            // $med_explode = explode("***", $med);
            $testpkz_item_name = $this->finance_model->getPaymentCategoryById($value)->name;
            $testpkz_item_implode[] = $value . '****' . $testpkz_item_name;
        }
        $data['testpkz_item_list'] = implode(",", $testpkz_item_implode);
        echo json_encode($data);
    }
    public function getAppointmentDetails()
    {
        $id = $this->input->get('id');
        $data['testpkz'] = $this->testpkz_model->getTestpkzById($id);
        echo json_encode($data);
    }
}

/* End of testpkz testpkz.php */
/* Location: ./application/modules/testpkz/controllers/testpkz.php */
