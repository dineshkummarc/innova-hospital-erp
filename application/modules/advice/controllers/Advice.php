<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advice extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('advice_model');
    }

    public function index()
    {

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('advice', $data);
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
        //$name = $this->input->post('name');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        // $code = $this->input->post('code');


        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[1]|max_length[200]|xss_clean');
        // Validating Password Field
        // $this->form_validation->set_rules('code', 'Code', 'trim|required|min_length[1]|max_length[200]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("advice/editAdvice?id=" . $id);
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

                'name' => $name,
                'description' => $description,
                // 'code' => $code,

            );


            ///   $username = $this->input->post('name');

            if (empty($id)) {     // Adding New Advice
                $this->advice_model->insertAdvice($data);
                show_swal(lang('advice_added_successfully'), 'success', lang('added'));
            } else { // Updating Advice
                $this->advice_model->updateAdvice($id, $data);
                show_swal(lang('advice_details_updated_successfully'), 'success', lang('updated'));
            }
            // Loading View
            redirect('advice');
        }
    }

    function getAdvice()
    {
        $data['advices'] = $this->advice_model->getAdvice();
        $this->load->view('advice', $data);
    }

    function editAdvice()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['advice'] = $this->advice_model->getAdviceById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editAdviceByJason()
    {
        $id = $this->input->get('id');
        $data['advice'] = $this->advice_model->getAdviceById($id);
        echo json_encode($data);
    }

    function delete()
    {

        $id = $this->input->get('id');

        $this->advice_model->delete($id);
        show_swal(lang('advice_deleted'), 'warning', lang('deleted'));
        redirect('advice');
    }

    function getAdviceList()
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
                $data['advices'] = $this->advice_model->getAdviceBysearch($search, $order, $dir);
            } else {
                $data['advices'] = $this->advice_model->getAdviceWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['advices'] = $this->advice_model->getAdviceByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['advices'] = $this->advice_model->getAdviceByLimit($limit, $start, $order, $dir);
            }
        }

        $options1 = '';

        $options5 = '';

        $i = 1;
        foreach ($data['advices'] as $advice) {

            if ($this->ion_auth->in_group(array('admin'))) {
                // The 'btn btn-primary' classes make the button blue, indicating a primary action.
                $options1 = '<a type="button" class="btn btn-primary btn-sm editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $advice->id . '"><i class="fa fa-edit"></i> ' . lang('') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                // The 'btn btn-danger' classes make the button red, indicating a potentially dangerous action.
                $options5 = '<a class="btn btn-danger btn-sm delete_button" title="' . lang('delete') . '" href="advice/delete?id=' . $advice->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('') . '</a>';
            }


            $settings = $this->settings_model->getSettings();

            $info[] = array(
                $i,
                $advice->name,
                // $advice->code,
                $advice->description,
                $options1 . ' ' . $options5,
                //  $options2
            );
            $i = $i + 1;
        }

        if (!empty($data['advices'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['advices']),
                "recordsFiltered" => count($this->advice_model->getAdvice()),
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

    public function getAdviceInfo()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response = $this->advice_model->getAdviceInfo($searchTerm);
        echo json_encode($response);
    }

    public function addNewAdvice()
    {
        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
        );

        if (empty($id)) {
            // Adding New Symptom
            $this->advice_model->insertAdvice($data);
            $new_advice_id = $this->db->insert_id();
            // Insert and return new ID

            // Return new symptom ID and name in JSON format
            echo json_encode([
                'id' => $new_advice_id,
                'name' => $name
            ]);
        } else {
            // Handle updates if needed
        }
    }
}

/* End of file advice.php */
/* Location: ./application/modules/advice/controllers/advice.php */
