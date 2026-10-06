<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Symptom extends MX_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('symptom_model');
    }

    public function index()
    {

        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('symptom', $data);
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
                redirect("symptom/editSymptom?id=" . $id);
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

            if (empty($id)) {     // Adding New Symptom
                $this->symptom_model->insertSymptom($data);
                show_swal(lang('symptom_added_successfully'), 'success', lang('added'));
            } else { // Updating Symptom
                $this->symptom_model->updateSymptom($id, $data);
                show_swal(lang('symptom_details_updated_successfully'), 'success', lang('updated'));
            }


            // Loading View
            redirect('symptom');
        }
    }

    function getSymptom()
    {
        $data['symptoms'] = $this->symptom_model->getSymptom();
        $this->load->view('symptom', $data);
    }

    function editSymptom()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['symptom'] = $this->symptom_model->getSymptomById($id);
        $this->load->view('home/dashboard'); // just the header file
        $this->load->view('add_new', $data);
        $this->load->view('home/footer'); // just the footer file
    }

    function editSymptomByJason()
    {
        $id = $this->input->get('id');
        $data['symptom'] = $this->symptom_model->getSymptomById($id);
        echo json_encode($data);
    }

    function delete()
    {

        $id = $this->input->get('id');

        $this->symptom_model->delete($id);
        show_swal(lang('symptom_deleted'), 'warning', lang('deleted'));
        redirect('symptom');
    }

    function getSymptomList()
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
                $data['symptoms'] = $this->symptom_model->getSymptomBysearch($search, $order, $dir);
            } else {
                $data['symptoms'] = $this->symptom_model->getSymptomWithoutSearch($order, $dir);
            }
        } else {
            if (!empty($search)) {
                $data['symptoms'] = $this->symptom_model->getSymptomByLimitBySearch($limit, $start, $search, $order, $dir);
            } else {
                $data['symptoms'] = $this->symptom_model->getSymptomByLimit($limit, $start, $order, $dir);
            }
        }

        $options1 = '';

        $options5 = '';

        $i = 1;
        foreach ($data['symptoms'] as $symptom) {

            if ($this->ion_auth->in_group(array('admin'))) {
                // The 'btn btn-primary' classes make the button blue, indicating a primary action.
                $options1 = '<a type="button" class="btn btn-primary btn-sm editbutton" title="' . lang('edit') . '" data-toggle="modal" data-id="' . $symptom->id . '"><i class="fa fa-edit"></i> ' . lang('') . '</a>';
            }

            if ($this->ion_auth->in_group(array('admin'))) {
                // The 'btn btn-danger' classes make the button red, indicating a potentially dangerous action.
                $options5 = '<a class="btn btn-danger btn-sm delete_button" title="' . lang('delete') . '" href="symptom/delete?id=' . $symptom->id . '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' . lang('') . '</a>';
            }


            $settings = $this->settings_model->getSettings();

            $info[] = array(
                $i,
                $symptom->name,
                // $symptom->code,
                $symptom->description,
                $options1 . ' ' . $options5,
                //  $options2
            );
            $i = $i + 1;
        }

        if (!empty($data['symptoms'])) {
            $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($data['symptoms']),
                "recordsFiltered" => count($this->symptom_model->getSymptom()),
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

    public function getSymptomInfo()
    {
        $searchTerm = $this->input->post('searchTerm');
        $response = $this->symptom_model->getSymptomInfo($searchTerm);
        echo json_encode($response);
    }

    public function addNewSymptom()
    {
        $name = $this->input->post('name');
        $data = array(
            'name' => $name,
        );

        if (empty($id)) {
            // Adding New Symptom
            $this->symptom_model->insertSymptom($data);
            $new_symptom_id = $this->db->insert_id();
            // Insert and return new ID

            // Return new symptom ID and name in JSON format
            echo json_encode([
                'id' => $new_symptom_id,
                'name' => $name
            ]);
        } else {
            // Handle updates if needed
        }
    }
}

/* End of file symptom.php */
/* Location: ./application/modules/symptom/controllers/symptom.php */
