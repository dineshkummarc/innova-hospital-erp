<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Insurance extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('insurance_model');

        if (!$this->ion_auth->in_group('admin')) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $data['insurance_companys'] = $this->insurance_model->getInsurance();
        $this->load->view('home/dashboard');
        $this->load->view('insurance_company', $data);
        $this->load->view('home/footer');
    }

    public function addNewView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('add_insurance_company');
        $this->load->view('home/footer');
    }

    public function addNew()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[100]|xss_clean');
        // Validating Password Field    
        // Validating Email Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[2]|max_length[1000]|xss_clean');
        // Validating Address Field   
        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                $data = array();
                $data['insurance'] = $this->insurance_model->getInsuranceById($id);
                $this->load->view('home/dashboard');
                $this->load->view('add_insurance_company', $data);
                $this->load->view('home/footer');
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('add_insurance_company', $data);
                $this->load->view('home/footer');
            }
        } else {

            $data = array();
            $data = array(
                'name' => $name,
                'description' => $description
            );
            if (empty($id)) {     // Adding New insurance
                $this->insurance_model->insertInsurance($data);
                $this->session->set_flashdata('feedback', lang('added'));
            } else { // Updating insurance
                $this->insurance_model->updateInsurance($id, $data);
                $this->session->set_flashdata('feedback', lang('updated'));
            }
            // Loading View
            redirect('insurance');
        }
    }

    function getInsurance()
    {
        $data['insurances'] = $this->insurance_model->getInsurance();
        $this->load->view('insurance', $data);
    }

    function editInsurance()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['insurance'] = $this->insurance_model->getInsuranceById($id);
        $this->load->view('home/dashboard');
        $this->load->view('add_insurance_company', $data);
        $this->load->view('home/footer');
    }

    function editInsuranceByJason()
    {
        $id = $this->input->get('id');
        $data['insurance'] = $this->insurance_model->getInsuranceById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $id = $this->input->get('id');
        $this->insurance_model->delete($id);
        $this->session->set_flashdata('feedback', lang('deleted'));
        redirect('insurance');
    }




    function getInsuranceCompany()
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
                $data['insurance_companys'] = $this->insurance_model->getInsuranceCompanyBySearch($search, $order, $dir);
            } else {
                $data['insurance_companys'] = $this->insurance_model->getInsuranceCompanyWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['insurance_companys'] = $this->insurance_model->getInsuranceCompanyByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['insurance_companys'] = $this->insurance_model->getInsuranceCompanyByLimit($limit, $start, $order, $dir);
            }
        }


        $i = 0;
        foreach ($data['insurance_companys'] as $insurance_company) {
            $i = $i + 1;

            $options1 = '<a type="button" class="btn btn-primary btn-sm editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $insurance_company->id . '"><i class="fa fa-edit"> </i> ' . lang('') . '</a>';


            $options3 = '<a class="btn btn-danger btn-sm" title="' . lang('delete') . '" href="insurance/delete?id=' . $insurance_company->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"> </i> ' . lang('') . '</a>';


            $info[] = array(

                $insurance_company->name,
                $insurance_company->description,


                $options1 . ' ' . $options3,
            );
        }

        if (!empty($data['insurance_companys'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($this->insurance_model->getInsurance()),
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
}

/* End of file insurance.php */
/* Location: ./application/modules/insurance/controllers/insurance.php */
