<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faq extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('faq_model');
        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }
    }

    public function index()
    {

        $data['faqs'] = $this->faq_model->getFaq();
        $this->load->view('home/dashboard');
        $this->load->view('faq', $data);
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
        $description = $this->input->post('description');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Validating Name Field
        $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        // Validating Email Field
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[1000]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            if (!empty($id)) {
                redirect("faq/editFaq?id=$id");
            } else {
                $data['setval'] = 'setval';
                $this->load->view('home/dashboard');
                $this->load->view('add_new', $data);
                $this->load->view('home/footer');
            }
        } else {
            $file_name = $_FILES['img_url']['name'];
            $file_name_pieces = explode('_', $file_name);
            $new_file_name = '';
            $count = 1;
            foreach ($file_name_pieces as $piece) {
                if ($count !== 1) {
                    $piece = ucfirst($piece);
                }

                $new_file_name .= $piece;
                $count++;
            }
            $config = array(
                'file_name' => $new_file_name,
                'upload_path' => "./uploads/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite' => False,
                'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                'max_height' => "10000",
                'max_width' => "10000"
            );

            $this->load->library('Upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('img_url')) {
                $path = $this->upload->data();
                $img_url = "uploads/" . $path['file_name'];
                $data = array();
                $data = array(
                    'img_url' => $img_url,
                    'title' => $title,
                    'description' => $description,
                );
            } else {
                //$error = array('error' => $this->upload->display_errors());
                $data = array();
                $data = array(
                    'title' => $title,
                    'description' => $description,
                );
            }

            if (empty($id)) {     // Adding New Faq  
                $this->faq_model->insertFaq($data);
                show_swal(lang('added'), 'success', lang('added'));
            } else { // Updating Faq
                $this->faq_model->updateFaq($id, $data);
                show_swal(lang('updated'), 'success', lang('updated'));
            }
            // Loading View
            redirect('faq');
        }
    }

    function getFaq()
    {
        $data['faqs'] = $this->faq_model->getFaq();
        $this->load->view('faq', $data);
    }

    function editFaq()
    {
        $data = array();
        $id = $this->input->get('id');
        $data['faq'] = $this->faq_model->getFaqById($id);
        $this->load->view('home/dashboard');
        $this->load->view('add_new', $data);
        $this->load->view('home/footer');
    }

    function editFaqByJason()
    {
        $id = $this->input->get('id');
        $data['faq'] = $this->faq_model->getFaqById($id);
        echo json_encode($data);
    }

    function delete()
    {
        $data = array();
        $id = $this->input->get('id');
        $user_data = $this->db->get_where('faq', array('id' => $id))->row();
        $path = $user_data->img_url;

        if (!empty($path)) {
            unlink($path);
        }
        $ion_user_id = $user_data->ion_user_id;
        $this->db->where('id', $ion_user_id);
        $this->db->delete('users');
        $this->faq_model->delete($id);
        show_swal(lang('deleted'), 'warning', lang('deleted'));
        redirect('faq');
    }
}

/* End of file faq.php */
/* Location: ./application/modules/faq/controllers/faq.php */
