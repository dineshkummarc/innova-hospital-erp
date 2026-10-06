<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facilitie extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('facilitie_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        $data['facilities'] = $this->facilitie_model->getFacilitie();
        $this->load->view('home/dashboard');
        $this->load->view('facilitie', $data);
        $this->load->view('home/footer');
    }

    public function addNewView()
    {
        $this->load->view('home/dashboard');
        $this->load->view('add_new');
        $this->load->view('home/footer');
    }

    public function addNew()
    {

        $id = $this->input->post('id');
        $title = $this->input->post('title');
        $align = $this->input->post('align');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[300]|xss_clean');
        // Validating Email Field
        // $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("facilitie/editFacilitie?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
            }
        } else {
          
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'title' => $title,
                    'align' => $align,
                );
            

            if (empty($id)) {     // Adding New Facilitie  
                $this->facilitie_model->insertFacilitie($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else { // Updating Facilitie
                $this->facilitie_model->updateFacilitie($id, $data);
                show_swal(lang('updated'), 'success', lang('updated'));
            }
            // Loading View
            redirect('facilitie');
        }
    }

    function getFacilitie()
    {
        $data['facilities'] = $this->facilitie_model->getFacilitie();
        $this->load->view('facilitie', $data);
    }

    function editFacilitie()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['facilitie'] = $this->facilitie_model->getFacilitieById($id);
        $this->load->view('home/dashboard');
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editFacilitieByJason()
    {
        $id = $this->input->get('id');
        $data['facilitie'] = $this->facilitie_model->getFacilitieById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $this->facilitie_model->delete($id);
        show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('facilitie');
    }
}

/* End of file facilitie.php */
/* Location: ./application/modules/facilitie/controllers/facilitie.php */
