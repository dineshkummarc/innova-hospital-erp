<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once APPPATH . '../vendor/autoload.php';

class Settings extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('sma');
        $this->load->model('hospital/package_model');
        $this->load->model('hospital/hospital_model');
        require APPPATH . 'third_party/stripe/stripe-php/init.php';
        if (!$this->ion_auth->in_group(array('admin', 'superadmin'))) {
            redirect('home/permission');
        }
    }

    public function index()
    {
        $data = array();
        $data['timezones'] = $this->gmtTime();
        $data['settings'] = $this->settings_model->getSettings();

        // try {
        //     $verify = $this->settings_model->verify();
        //     $data['verified'] = $verify['verified'];
        // } catch (Exception $e) {
        // }
        $this->load->view('home/dashboard');
        $this->load->view('settings', $data);
        $this->load->view('home/footer');
    }


    public function verifyYourPruchase776cbvcfytfytfvvn()
    {
        $data = array();
        $data['settings'] = $this->settings_model->getSettings();

        // try {
        //     $verify = $this->settings_model->verify();
        //     $data['verified'] = $verify['verified'];
        // } catch (Exception $e) {
        // }
        $this->load->view('home/dashboard');
        $this->load->view('all_hospitals', $data);
        $this->load->view('home/footer');
    }





    function subscription()
    {
        $data['settings'] = $this->settings_model->getSettings();
        $data['subscription'] = $this->settings_model->getSubscription();
        $user = $this->ion_auth->get_user_id();
        $ion_user_id = $this->db->get_where('users', array('id' => $user))->row();
        $data['hospital'] = $this->db->get_where('hospital', array('ion_user_id' => $ion_user_id->id))->row();
        $data['package'] = $this->package_model->getPackageById($data['subscription']->package);
        $data['hospital_payments'] = $this->settings_model->getHospitalPaymentsById($data['subscription']->id);
        $data['settings1'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();
        $data['deposits'] = $this->db->get_where('hospital_deposit', array('hospital_user_id' => $data['hospital_payments']->hospital_user_id))->result();
        $data['gateway'] = $this->db->get_where('paymentGateway', array('name' => $data['settings1']->payment_gateway, 'hospital_id' => 'superadmin'))->row();
        $this->load->view('home/dashboard', $data);
        $this->load->view('subscription', $data);
        $this->load->view('home/footer');
    }

    public function update()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $discount_percent = $this->input->post('discount_percent');
        $time_format = $this->input->post('time_format');
        $footer_invoice_message = $this->input->post('footer_invoice_message');
        $vat = $this->input->post('vat');
        $invoice_choose = $this->input->post('invoice_choose');
        $title = $this->input->post('title');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $currency = $this->input->post('currency');
        $logo = $this->input->post('logo');
        $footer_message = $this->input->post('footer_message');
        $codec_username = $this->input->post('codec_username');
        $codec_purchase_code = $this->input->post('codec_purchase_code');
        $show_odontogram_in_history = $this->input->post('show_odontogram_in_history');
        $show_tawkto_in_website = $this->input->post('show_tawkto_in_website');
        if ($this->ion_auth->in_group(array('superadmin'))) {
            $remainder_appointment = $this->input->post('remainder_appointment');
        } else {
            $remainder_appointment = '';
        }

        $timezone = $this->input->post('timezone');

        if (!empty($email)) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Validating Name Field
            $this->form_validation->set_rules('name', 'System Name', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Title Field
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Email Field
            $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[1]|max_length[100]|xss_clean');
            // Validating Address Field    
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[1]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[1]|max_length[50]|xss_clean');
            // Validating Currency Field   
            $this->form_validation->set_rules('currency', 'Currency', 'trim|required|min_length[1]|max_length[3]|xss_clean');
            // Validating Logo Field   
            $this->form_validation->set_rules('logo', 'Logo', 'trim|min_length[1]|max_length[1000]|xss_clean');
            // Validating Department Field   
            $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
            // Validating Phone Field           
            $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $data = array();
                $data['settings'] = $this->settings_model->getSettings();
                $this->load->view('home/dashboard');
                $this->load->view('settings', $data);
                $this->load->view('home/footer');
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
                    'max_height' => "1768",
                    'max_width' => "2024"
                );

                $this->load->library('Upload', $config);
                $this->upload->initialize($config);

                if ($this->upload->do_upload('img_url')) {
                    $path = $this->upload->data();
                    $img_url = "uploads/" . $path['file_name'];
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $codec_username,
                        'codec_purchase_code' => $codec_purchase_code,
                        'logo' => $img_url,
                        'remainder_appointment' => $remainder_appointment,
                        'footer_message' => $footer_message,
                        'show_odontogram_in_history' => $show_odontogram_in_history,
                        'invoice_choose' => 'invoice1',
                        'vat' => $vat,
                        'discount_percent' => $discount_percent,
                        'time_format' => $time_format,
                        'footer_invoice_message' => $footer_invoice_message,
                        'show_tawkto_in_website' => $show_tawkto_in_website,
                        'timezone' => $timezone,
                    );
                } else {
                    $data = array();
                    $data = array(
                        'system_vendor' => $name,
                        'title' => $title,
                        'address' => $address,
                        'phone' => $phone,
                        'email' => $email,
                        'currency' => $currency,
                        'codec_username' => $codec_username,
                        'codec_purchase_code' => $codec_purchase_code,
                        'remainder_appointment' => $remainder_appointment,
                        'footer_message' => $footer_message,
                        'show_odontogram_in_history' => $show_odontogram_in_history,
                        'invoice_choose' => 'invoice1',
                        'vat' => $vat,
                        'discount_percent' => $discount_percent,
                        'time_format' => $time_format,
                        'footer_invoice_message' => $footer_invoice_message,
                        'show_tawkto_in_website' => $show_tawkto_in_website,
                        'timezone' => $timezone,
                    );
                }




                $file_name_title = $_FILES['img_url_title']['name'];
                $file_name_pieces_title = explode('_', $file_name_title);
                $new_file_name_title = '';
                $count_title = 1;
                foreach ($file_name_pieces_title as $piece_title) {
                    if ($count_title !== 1) {
                        $piece_title = ucfirst($piece_title);
                    }

                    $new_file_name_title .= $piece_title;
                    $count_title++;
                }
                $config_title = array(
                    'file_name' => $new_file_name_title,
                    'upload_path' => "./uploads/",
                    'allowed_types' => "gif|jpg|png|jpeg|pdf",
                    'overwrite' => False,
                    'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                    'max_height' => "1768",
                    'max_width' => "2024"
                );

                $this->load->library('Upload', $config_title);
                $this->upload->initialize($config_title);

                if ($this->upload->do_upload('img_url_title')) {
                    $path_title = $this->upload->data();
                    $img_url_title = "uploads/" . $path_title['file_name'];
                    $data['logo_title'] = $img_url_title;
                }




                $this->settings_model->updateSettings($id, $data);
                show_swal(lang('settings_updated_successfully'), 'success', lang('updated'));

                redirect($_SERVER["HTTP_REFERER"]);
            }
        } else {
            show_swal(lang('email_required'), 'warning', lang('warning'));
            redirect('settings', 'refresh');
        }
    }



    public function updatePurchaseCode()
    {

        $id = $this->input->post('id');
        $codec_username = $this->input->post('codec_username');
        $codec_purchase_code = $this->input->post('codec_purchase_code');
        $this->form_validation->set_rules('buyer', 'Buyer', 'trim|min_length[5]|max_length[500]|xss_clean');
        $this->form_validation->set_rules('p_code', 'Purchase Code', 'trim|min_length[5]|max_length[50]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard');
            $this->load->view('all_hospitals', $data);
            $this->load->view('home/footer');
        } else {
            $data = array();
            $data = array(
                'codec_username' => $codec_username,
                'codec_purchase_code' => $codec_purchase_code,
            );
            $this->settings_model->updateSettings($id, $data);
            show_swal(lang('settings_updated_successfully'), 'success', lang('updated'));
            redirect($_SERVER["HTTP_REFERER"]);
        }
    }




    function backups()
    {
        if ($this->ion_auth->in_group(array())) {
            $data['files'] = glob('./files/backups/*.zip', GLOB_BRACE);
            $data['dbs'] = glob('./files/backups/*.txt', GLOB_BRACE);
            $data['settings'] = $this->settings_model->getSettings();

            $this->load->view('home/dashboard', $data);
            $this->load->view('backups', $data);
            $this->load->view('home/footer');
        } else {
            redirect('home');
        }
    }

    function language()
    {

        $data['settings'] = $this->settings_model->getSettings();
        $data['languages'] = $this->settings_model->getLanguages();

        $this->load->view('home/dashboard', $data);
        $this->load->view('language', $data);
        $this->load->view('home/footer');
    }

    function changeLanguage()
    {
        $id = $this->input->post('id');
        $language = $this->input->post('language');
        $language_settings = $this->input->post('language_settings');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('language', 'language', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data = array();
            $data['settings'] = $this->settings_model->getSettings();
            $this->load->view('home/dashboard', $data);
            $this->load->view('settings', $data);
            $this->load->view('home/footer');
        } else {


            $data = array();
            $data = array(
                'language' => $language,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            show_swal(lang('updated'), 'success', lang('updated'));
            if (!empty($language_settings)) {
                redirect('settings/language');
            } else {
                redirect('');
            }
        }
    }

    function changeLanguageFlag()
    {
        $selectedLanguage = $this->input->get('lang'); // Replace this with the selected language
        $this->session->set_userdata('language_site', $selectedLanguage);
        $cookie = array(
            'name'   => 'language_site',
            'value'  => $selectedLanguage,
            'expire' => '2595000', // Set to one day (in seconds)
            'secure' => FALSE,
        );
        $this->input->set_cookie($cookie);
        redirect($_SERVER['HTTP_REFERER']);
    }

    function selectPaymentGateway()
    {
        $id = $this->input->post('id');
        $payment_gateway = $this->input->post('payment_gateway');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('payment_gateway', 'Payment Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {


            $data = array();
            $data = array(
                'payment_gateway' => $payment_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            show_swal(lang('updated'), 'success', lang('updated'));
            if (!empty($payment_gateway)) {
                redirect('pgateway');
            } else {
                redirect('');
            }
        }
    }

    function selectSmsGateway()
    {
        $id = $this->input->post('id');
        $sms_gateway = $this->input->post('sms_gateway');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('sms_gateway', 'Sms Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('pgateway');
        } else {


            $data = array();
            $data = array(
                'sms_gateway' => $sms_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            // Loading View
            show_swal(lang('updated'), 'success', lang('updated'));
            if (!empty($sms_gateway)) {
                redirect('sms');
            } else {
                redirect('');
            }
        }
    }

    function backup_database()
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->dbutil();
        $prefs = array(
            'format' => 'sql',
            'filename' => 'hms_db_backup.sql'
        );
        $back = $this->dbutil->backup($prefs);
        $backup = &$back;
        $db_name = 'db-backup-on-' . date("Y-m-d-H-i-s") . '.txt';
        $save = './files/backups/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        show_swal('message', lang('database_backup_successfull'),);
        redirect("settings/backups");
    }

    function backup_files()
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $data = array_diff(scandir(FCPATH), array('..', '.', 'files')); // 'files' folder will be excluded here with '.' and '..'
        foreach ($data as $d) {
            $path = FCPATH . $d;
            if (is_dir($path))
                $this->zip->read_dir($path, false);
            if (is_file($path))
                $this->zip->read_file($path, false);
        }
        $filename = 'file-backup-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->archive(FCPATH . 'files/backups/' . $filename);
        show_swal('message', lang('application_backup_successfull'),);
        redirect("settings/backups");
        exit();
    }

    function restore_database($dbfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal('error', lang('access_denied'));
            redirect("home/permission");
        }
        $file = file_get_contents('./files/backups/' . $dbfile . '.txt');
        $this->db->conn_id->multi_query($file);
        $this->db->conn_id->close();
        show_swal('message', lang('restoring_of_backup_successfull'),);
        redirect('settings/backups');
    }

    function download_database($dbfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->library('zip');
        $this->zip->read_file('./files/backups/' . $dbfile . '.txt');
        $name = 'db_backup_' . date('Y_m_d_H_i_s') . '.zip';
        $this->zip->download($name);
        exit();
    }

    function download_backup($zipfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal('error', lang('access_denied'));
            redirect("home/permission");
        }
        $this->load->helper('download');
        force_download('./files/backups/' . $zipfile . '.zip', NULL);
        exit();
    }

    function restore_backup($zipfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal(lang('access_denied'), 'error', lang('error'));
            redirect("home/permission");
        }
        $file = './files/backups/' . $zipfile . '.zip';
        $this->sma->unzip($file, './');
        show_swal(lang('restoring_of_application_successfull'), 'warning', lang('succcess'));
        redirect("settings/backups");
        exit();
    }

    function delete_database($dbfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal(lang('access_denied'), 'error', lang('error'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $dbfile . '.txt');
        show_swal(lang('deleting_of_database_successfull'), 'warning', lang('deleted'));
        redirect("settings/backups");
    }

    function delete_backup($zipfile)
    {
        if (!$this->ion_auth->in_group('admin')) {
            show_swal(lang('access_denied'), 'error', lang('error'));
            redirect("home/permission");
        }
        unlink('./files/backups/' . $zipfile . '.zip');
        show_swal(lang('deleting_of_app_backup_successfull'), 'warning', lang('deleted'));
        redirect("settings/backups");
    }

    function substring($index, $value)
    {

        foreach ($value as $key => $value2) {

            $value3 = trim(substr($value2, 2));
            $value4[] = substr($value3, 0, -2);
        }

        foreach ($index as $key => $index2) {

            $index3 = substr($index2, 7);
            $index4[] = substr($index3, 0, -3);
        }

        return array_combine($index4, $value4);
    }

    function languageEdit()
    {


        if (!$this->ion_auth->in_group('superadmin')) {
            redirect('home/permission');
        }

        $id = $this->input->get('id');
        //load helper for language
        $this->load->helper('string');

        $languages = $this->settings_model->getLanguages();

        foreach ($languages as $language) {
            if ($id == $language->language) {
                $path = APPPATH . 'language/' . $language->language . '/system_syntax_lang.php';
            }
        }

        $file = fopen($path, "r");
        $i = 0;
        while (!feof($file)) {
            $line = fgets($file);

            $arr = explode("=", $line, 2);
            if (!empty($arr[1])) {
                $index[$i] = $arr[0];
                $value[$i] = $arr[1];
                $i = $i + 1;
            }
        }
        fclose($file);

        $data = array();
        $data['languages'] = $this->substring($index, $value);
        $data['languagename'] = $id;
        $data['settings'] = $this->settings_model->getSettings();
        $this->load->view('home/dashboard');
        $this->load->view('edit_language', $data);
        $this->load->view('home/footer');
    }

    function addLanguageTranslation()
    {
        $id = $this->input->post('language');
        $indexes = $this->input->post('indexupdate');
        $index = explode("#**##***", $indexes);
        $valueupdate = $this->input->post('valueupdate');
        $value = explode("*##**###", $valueupdate);

        foreach ($index as $key => $values) {
            if ($key !== 0) {

                $indexupdate[] = $values;
            }
        }
        foreach ($value as $key => $values) {
            if ($key !== 0) {
                $values = trim($values);

                $value2 = explode("'", $values);
                $length = count($value2);

                if (empty($value2[1])) {

                    $valueupdated[] = $value2[0];
                } else {
                    $valuefinal = array();
                    foreach ($value2 as $keys => $value3) {


                        $lastChar = substr($value3, -1);
                        if (preg_match('/\\\\/', $lastChar)) {
                            $valuefinal[] = $value3 . "'";
                        } else {

                            if ($keys != ($length - 1)) {
                                $valuefinal[] = $value3 . "\'";
                            } else {
                                $valuefinal[] = $value3;
                            }
                        }
                    }
                    $valueconcate = "";
                    foreach ($valuefinal as $valuefinal) {
                        $valueconcate .= $valuefinal;
                    }
                    $valueupdated[] = $valueconcate;
                }
            }
        }

        $data = array_combine($indexupdate, $valueupdated);


        $languages = $this->settings_model->getLanguages();

        foreach ($languages as $language) {
            if ($id == $language->language) {
                $path = APPPATH . 'language/' . $language->language . '/system_syntax_lang.php';
            }
        }


        unlink($path);
        $option = "<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Name:  Auth Lang -" . $id . "
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Author: Daniel Davis
 *         @ourmaninjapan
 *
 * Location: http://github.com/benedmunds/ion_auth/
 *
 * Created:  03.09.2013
 *
 * Description: " . $id . " language file for Ion Auth example views
 *
 */
// Errors";
        $file_handle = fopen($path, 'a+');
        fwrite($file_handle, $option);
        fwrite($file_handle, "\n");
        foreach ($data as $key => $value) {
            $valueupdate = trim($value);
            $option1 = '$lang' . "['" . $key . "'] = '$valueupdate';";
            fwrite($file_handle, $option1);
            fwrite($file_handle, "\n");
        }


        fclose($file_handle);
        show_swal(lang('language_translation_updated'), 'success', lang('updated'));
        redirect('settings/language');
    }

    public function packages()
    {
        $data['packages'] = $this->package_model->getPackage();
        $data['settings'] = $this->settings_model->getSettings();
        $user = $this->ion_auth->get_user_id();
        $ion_user_id = $this->db->get_where('users', array('id' => $user))->row();
        $data['hospital'] = $this->db->get_where('hospital', array('ion_user_id' => $ion_user_id->id))->row();

        $data['package_details'] = $this->package_model->getPackageById($data['hospital']->package);
        $data['settings1'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();
        $data['gateway'] = $this->db->get_where('paymentGateway', array('name' => $data['settings1']->payment_gateway, 'hospital_id' => 'superadmin'))->row();

        $this->load->view('home/dashboard');
        $this->load->view('change_plan', $data);
        $this->load->view('home/footer');
    }

    function getHospitalDetailsPayment()
    {
        $id = $this->input->get('id');
        $data['hospital_payment'] = $this->settings_model->getHospitalPaymentsById($id);
        echo json_encode($data);
    }

    function editPackageById()
    {
        $id = $this->input->get('id');

        $data['package'] = $this->package_model->getPackageById($id);

        //$data['settings'] = $this->settings_model->getSettingsByHId($id);
        echo json_encode($data);
    }

    function changePlanPayment()
    {
        $from = $this->input->post('from');
        $packageId = $this->input->post('id');
        $package_type = $this->input->post('package_type');
        $hospital_id = $this->input->post('hospital_id');
        $deposit_type = $this->input->post('deposit_type');
        $hospital_details = $this->hospital_model->getHospitalById($hospital_id);
        $package_list = $this->package_model->getPackageById($packageId);

        if ($package_type == 'monthly') {
            $price = $package_list->monthly_price;
        } else {
            $price = $package_list->yearly_price;
        }

        if (!empty($packageId)) {
            $module = $this->package_model->getPackageById($packageId)->module;
            $p_limit = $this->package_model->getPackageById($packageId)->p_limit;
            $d_limit = $this->package_model->getPackageById($packageId)->d_limit;
        }
        $data = array();
        $data = array(
            'name' => $hospital_details->name,
            'email' => $hospital_details->email,
            'address' => $hospital_details->address,
            'phone' => $hospital_details->phone,
            'package' => $packageId,
            'package_duration' => $package_type,
            'price' => $price,
            'hospital_id' => $hospital_id,
            'module' => $module,
            'p_limit' => $p_limit,
            'd_limit' => $d_limit
        );
        if ($deposit_type == 'Card') {
            $gateway = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row()->payment_gateway;
            if ($gateway == 'PayPal') {
                $data['cardholder'] = $this->input->post('cardholder');
                $data['card_type'] = $this->input->post('card_type');
                $data['card_number'] = $this->input->post('card_number');
                $data['expire_date'] = $this->input->post('expire_date');
                $data['cvv'] = $this->input->post('cvv_number');
                $this->load->module('paypal');
                $response = $this->paypal->paymentPaypalFromFrontend($data, 'backend');

                if ($response == 'yes') {
                    $data['gateway'] = 'PayPal';
                    $data['from'] = $from;
                    $this->changePlan($data);
                } else {
                    show_swal(lang('Please_check_card_details'), 'warning', lang('warning'));
                    if ($from == 'expire') {
                        redirect('hospital/lisenceExpired');
                    } else {
                        redirect('hospital');
                    }
                    redirect('settings/subscription');
                }
            } elseif ($gateway == 'Stripe') {

                $token = $this->input->post('token');

                $stripe = $this->db->get_where('paymentGateway', array('hospital_id' => 'superadmin', 'name' => 'Stripe'))->row();

                \Stripe\Stripe::setApiKey($stripe->secret);
                $charge = \Stripe\Charge::create(array(
                    "amount" => $price * 100,
                    "currency" => "usd",
                    "source" => $token
                ));
                $chargeJson = $charge->jsonSerialize();
                if ($chargeJson['status'] == 'succeeded') {
                    $data['gateway'] = 'Stripe';
                    $data['from'] = $from;
                    $this->changePlan($data);
                } else {
                    show_swal(lang('Please_check_card_details'), 'warning', lang('warning'));
                    if (empty($from)) {
                        redirect('settings/subscription');
                    } else {

                        if ($from == 'expire') {
                            redirect('hospital/lisenceExpired');
                        } else {
                            redirect('hospital');
                        }
                    }
                }
            } elseif ($gateway == 'Paystack') {
                $paystack = $this->db->get_where('paymentGateway', array('hospital_id' => 'superadmin', 'name' => 'Paystack'))->row();

                $ref = date('Y') . '-' . rand() . date('d') . '-' . date('m');
                $amount_in_kobo = $price;
                if (empty($from)) {
                    $callback_url = base_url() . 'settings/subscription';
                } else {
                    if ($from == 'expire') {
                        $callback_url = base_url() . 'hospital/lisenceExpired';
                    } else {
                        $callback_url = base_url() . 'hospital';
                    }
                }

                $postdata = array('first_name' => $hospital_details->name, 'email' => $hospital_details->email, 'amount' => $amount_in_kobo * 100, "reference" => $ref, 'callback_url' => $callback_url);

                $url = "https://api.paystack.co/transaction/initialize";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                //
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $headers = [
                    'Authorization: Bearer ' . $paystack->secret,
                    'Content-Type: application/json',
                ];
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                $request = curl_exec($ch);
                curl_close($ch);

                if ($request) {
                    $result = json_decode($request, true);
                }

                $redir = $result['data']['authorization_url'];

                header("Location: " . $redir);
                if ($result['status'] == 1) {
                    $data['gateway'] = 'Paystack';

                    $this->changePlan($data);
                }
                exit();
            } elseif ($gateway == 'Pay U Money') {

                $this->load->module('payu');
                $data['from'] = $from;
                if ($from == 'expire') {
                    $this->payu->check4($data, $price, $hospital_id, 'expire');
                } else {
                    $this->payu->check4($data, $price, $hospital_id, 'deposit_backend');
                }
            }
        } else {
            $data['gateway'] = 'Cash';
            $data['from'] = $from;
            $this->changePlan($data);
        }
    }

    function changePlan($data)
    {
        $packageId = $data['package'];
        $package_type = $data['package_duration'];
        $hospital_id = $data['hospital_id'];
        $package_list = $this->package_model->getPackageById($packageId);
        $gateway = $data['gateway'];
        if (!empty($this->input->post('renew'))) {
            if ($package_type == 'monthly') {
                $price = $package_list->monthly_price;
                $next_due_date_stamp = strtotime($this->input->post('next_due_date'));
                $package_lang = lang('monthly');
            } else {
                $price = $package_list->yearly_price;
                $next_due_date_stamp = strtotime($this->input->post('next_due_date'));
                $package_lang = lang('yearly');
            }
        } else {
            if ($package_type == 'monthly') {
                $price = $package_list->monthly_price;
                $next_due_date_stamp = time() + 2592000;
                $package_lang = lang('monthly');
            } else {
                $price = $package_list->yearly_price;
                $next_due_date_stamp = time() + 31536000;
                $package_lang = lang('yearly');
            }
        }
        $next_due_date = date('d-m-Y', $next_due_date_stamp);

        if (!empty($packageId)) {
            $module = $this->package_model->getPackageById($packageId)->module;
            $p_limit = $this->package_model->getPackageById($packageId)->p_limit;
            $d_limit = $this->package_model->getPackageById($packageId)->d_limit;
        }
        $data_up = array();
        $data_up = array(
            'package' => $packageId,
            'p_limit' => $p_limit,
            'd_limit' => $d_limit,
            'module' => $module
        );
        $this->hospital_model->updateHospital($hospital_id, $data_up);
        $data_payment = array();
        $data_payment = array(
            'price' => $price,
            'package_duration' => $package_type,
            'next_due_date_stamp' => $next_due_date_stamp,
            'next_due_date' => $next_due_date,
            'package' => $packageId,
            'status' => 'paid'
        );
        $this->hospital_model->updateHospitalPaymentByHospitalId($hospital_id, $data_payment);
        $hospital_details_payment = $this->hospital_model->getHospitalPaymentByHospitalId($hospital_id);
        $data_deposit = array();
        $data_deposit = array(
            'payment_id' => $hospital_details_payment->id,
            'date' => time(),
            'deposited_amount' => $price,
            'gateway' => $gateway,
            'package_id' => $packageId,
            'hospital_user_id' => $hospital_id,
            'next_due_date_stamp' => $next_due_date_stamp,
            'next_due_date' => $next_due_date,
            'add_date_stamp' => time(),
            'add_date' => date('d-m-Y', time()),
        );
        $deposit = $this->hospital_model->addHospitalDeposit($data_deposit);
        $base_url = str_replace(array('http://', 'https://', ' '), '', base_url()) . "auth/login";
        $set['settings'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();

        $package_name = $this->db->get_where('package', array('id' => $packageId))->row()->name;
        $hospital_details = $this->db->get_where('hospital', array('id' => $hospital_id))->row();
        $data1 = array(
            'name' => $hospital_details->name,
            'package_name' => $package_name,
            'subscription_duration' => $package_lang,
            'base_url' => $base_url,
            'amount' => $price,
            'username' => $hospital_details->name,
            'phone' => $set['settings']->phone,
            'next_payment_date' => $next_due_date
        );

        $emailSettings = $this->email_model->getAdminEmailSettingsById();
        if (!empty($data['from'])) {
            $message1 = '<strong>{name}</strong> ,<br>
Your hospital package has changed successfully . Please check the details Below.<br>
Migrated Package Name: {package_name}.<br>
Subscription Length: {subscription_duration}.<br>
Amount Paid: {amount}.<br>
Next Payment Date: {next_payment_date}.<br>


For Any Support Please Contact with Phone No: {phone}';
        } else {
            $message1 = '<strong>{name}</strong> ,<br>
Your hospital package has renewed successfully . Please check the details Below.<br>
Migrated Package Name: {package_name}.<br>
Subscription Length: {subscription_duration}.<br>
Amount Paid: {amount}.<br>
Next Payment Date: {next_payment_date}.<br>


For Any Support Please Contact with Phone No: {phone}';
        }

        $messageprint1 = $this->parser->parse_string($message1, $data1);
        $this->email->from($emailSettings->admin_email, $set['settings']->system_vendor);
        $this->email->to($hospital_details->email);
        $this->email->subject('Hospital Package Changed');
        $this->email->message($messageprint1);
        if (function_exists('mail')) {
            $this->email->send();
        }
        $hospital_details_ion = $this->db->get_where('hospital', array('id' => $hospital_id))->row()->ion_user_id;
        $data_activation = array();
        $data_activation = array("active" => 1);
        $this->db->where('id', $hospital_details_ion)->update('users', $data_activation);
        show_swal(lang('package_changed'), 'success', lang('updated'));
        if ($gateway != 'Paystack') {
            if (empty($data['from'])) {
                redirect('settings/subscription');
            } else {
                if ($data['from'] == 'expire') {
                    redirect('hospital/lisenceExpired');
                } else {
                    redirect('hospital');
                }
            }
        }
    }

    function getHospitalPayments()
    {
        $id = $this->input->get('id');
        $data['hospital'] = $this->hospital_model->getHospitalPaymentById($id);
        $data['package'] = $this->package_model->getPackageById($data['hospital']->package);
        echo json_encode($data);
    }

    function downloadInvoice()
    {
        $id = $this->input->get('id');
        $data['deposit'] = $this->hospital_model->getHospitalDepositById($id);
        $data['settings'] = $this->db->get_where('settings', array('hospital_id' => 'superadmin'))->row();

        error_reporting(0);
        $mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

        $html = $this->load->view('invoice', $data, true);

        $mpdf->WriteHTML($html);

        $filename = "invoice--00" . $id . ".pdf";
        $mpdf->Output($filename, 'D');
    }

    function selectEmailGateway()
    {
        $id = $this->input->post('id');
        $email_gateway = $this->input->post('email_gateway');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('email_gateway', 'Email Gateway', 'trim|required|min_length[1]|max_length[100]|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            redirect('email/emailSettings');
        } else {


            $data = array();
            $data = array(
                'emailtype' => $email_gateway,
            );

            $this->settings_model->updateSettings($id, $data);

            show_swal(lang('email_gateway_changed'), 'success', lang('updated'));
            if (!empty($email_gateway)) {
                redirect('email/emailSettings');
            } else {
                redirect('');
            }
        }
    }

    public function getStaffinfoWithAddNewOption()
    {
        // Search term
        $searchTerm = $this->input->post('searchTerm');

        // Get users
        $response = $this->settings_model->getStaffinfoWithAddNewOption($searchTerm);

        echo json_encode($response);
    }

    function googleReCaptcha()
    {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            redirect('home');
        }
        $data = array();
        $data['captcha'] = $this->settings_model->getGoogleReCaptchaSettings();
        $this->load->view('home/dashboard');
        $this->load->view('googleReCaptcha', $data);
        $this->load->view('home/footer');
    }

    function updateGoogleReCaptcha()
    {
        if (!$this->ion_auth->in_group(array('superadmin'))) {
            redirect('settings/googleReCaptcha');
        }
        $id = $this->input->post('id');
        $site_key = $this->input->post('site_key');
        $secret_key = $this->input->post('secret_key');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');


        $this->form_validation->set_rules('site_key', 'Site Key', 'trim|required|min_length[1]|max_length[100]|xss_clean');
        $this->form_validation->set_rules('secret_key', 'Secret_key', 'trim|min_length[1]|max_length[100]|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            redirect('settings/googleReCaptcha?id=' . $id);
        } else {
            $data = array();
            $data = array(
                'site_key' => $site_key,
                'secret_key' => $secret_key,
            );
            if (!empty($id)) {
                $this->settings_model->updateGoogleReCaptcha($id, $data);
            } else {
                $this->settings_model->addGoogleReCaptcha($data);
            }

            show_swal(lang('google_recaptcha_updated'), 'success', lang('updated'));
            redirect('settings/googleReCaptcha');
        }
    }




    function isVerify()
    {
        $verify = $this->settings_model->verify();
        if ($verify['verified'] == 1) {
            return true;
        }
    }


    function verifyPurchase()
    {
        $data['verified'] = $this->input->get('verify');
        $this->load->view('home/dashboard.php');
        $this->load->view('purchase_code_verification', $data);
        $this->load->view('home/footer.php');
    }


    function addPurchaseCode()
    {
        $purchase_code = $this->input->post("validation");
        $base_url = $this->input->get('base_url');
        $insertPurchase = file_get_contents("http://verify.codearistos.net/api/verify?validation=" . $purchase_code . "&base_url=" . $base_url);
        $insertPurchase = json_decode($insertPurchase);
        if ($insertPurchase->message == 3) {
            show_swal(lang('purcase_code_validated_successfully'), 'success',  lang('success'));
            $this->settings_model->updateHospitalSettings('superadmin', array('codec_purchase_code' => $purchase_code));
            redirect("settings/verifyPurchase");
        } elseif ($insertPurchase->message == 1) {
            show_swal(lang('already_validated'), 'warning', lang('warning'));
            redirect("settings/verifyPurchase?verify=yes");
        } elseif ($insertPurchase->message == 2) {
            show_swal(lang('this_purchase_code_is_validated_for_other_domain'), 'error',  lang('error'));
            redirect("settings/verifyPurchase");
        } elseif ($insertPurchase->message == 4) {
            show_swal(lang('this_domain_is_already_registerred_with_another_purchase_code'), 'error',  lang('error'));
            redirect("settings/verifyPurchase");
        } elseif ($insertPurchase->message == 0) {
            show_swal(lang('this_purchase_code_is_invalid'), 'error',  lang('error'));
            redirect("settings/verifyPurchase");
        }
    }









    function chatgpt()
    {

        $data['settings'] = $this->settings_model->getSettings();

        $this->load->view('home/dashboard', $data);
        $this->load->view('chatgpt', $data);
        $this->load->view('home/footer');
    }

    function chatgptSettings()
    {
        $id = $this->input->post('id');
        $api_key = $this->input->post('api_key');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('api_key', 'API Key', 'trim|required|min_length[1]|max_length[1000]|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            redirect('settings/chatgpt');
        } else {
            $data = array();
            $data = array(
                'chatgpt_api_key' => $api_key,
            );
            $this->settings_model->updateSettings($id, $data);
            show_swal(lang('updated'), 'success', lang('updated'));
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function getSettings()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }
        
        $settings = $this->settings_model->getSettings();
        
        if ($settings) {
            echo json_encode(array(
                'hospital_name' => $settings->name,
                'hospital_address' => $settings->address,
                'hospital_phone' => $settings->phone,
                'hospital_email' => $settings->email
            ));
        } else {
            echo json_encode(array(
                'hospital_name' => 'Hospital Name',
                'hospital_address' => 'Hospital Address',
                'hospital_phone' => 'Hospital Phone',
                'hospital_email' => 'Hospital Email'
            ));
        }
    }








    function addLanguage()
    {
        $id = $this->input->post('id');
        $language = $this->input->post('language');
        $flag_icon = $this->input->post('flag_icon');
        $description = $this->input->post('description');
        $status = $this->input->post('status');

        // folder name should be unique
        $language_name_check = $this->settings_model->getLanguageByName($language);
        if (!empty($language_name_check) && empty($id)) {
            show_swal('Language already exists', 'error', lang('error'));
            redirect('settings/language');
        }

        if ($language_name_check) {
            $language = $language_name_check->language;
        }

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // Validating Name Field
        $this->form_validation->set_rules('language', 'Language', 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('flag_icon', 'Flag Icon', 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[1]|max_length[100]');
        $this->form_validation->set_rules('status', 'Status', 'trim|required|min_length[1]|max_length[100]');

        if ($this->form_validation->run() == FALSE) {
            redirect('settings/language');
        } else {
            $data = array();
            $data = array(
                'language' => $language,
                'flag_icon' => $flag_icon,
                'description' => $description,
                'status' => $status,
            );
            if (!empty($id)) {
                $this->settings_model->updateLanguage($id, $data);
            } else {
                $this->settings_model->addLanguage($data);
            }


            $source_file = APPPATH . 'language/english/system_syntax_lang.php';
            $target_folder = APPPATH . 'language/' . $language;
            $target_file = $target_folder . '/system_syntax_lang.php';

            if (!is_dir($target_folder)) {
                mkdir($target_folder, 0755, true);
            }

            if (!file_exists($target_file)) {
                copy($source_file, $target_file);
            }


            show_swal(lang('added'), 'success', lang('added'));
            redirect('settings/language');
        }
    }

    function editLanguageJason()
    {
        $id = $this->input->get('id');
        $data['language'] = $this->settings_model->getLanguageById($id);
        echo json_encode($data);
    }
function timeZone($timezone) {

       


        $reading = fopen('index.php', 'r');
        $writing = fopen('index.tmp', 'w');

        $replaced = false;

        while (!feof($reading)) {
            $line = fgets($reading);
           
            if (stristr($line, 'ini_set("date.timezone"')) {
                
                $line = 'ini_set("date.timezone","' . $timezone . '");';
                
                $replaced = true;
            }
            fputs($writing, $line);
              if (stristr($line, 'ini_set("date.timezone"')) {
            fputs($writing, "\n");
              }
        }
      
        fclose($reading);
        fclose($writing);

       
        if ($replaced) {
            rename('index.tmp', 'index.php');
        } else {
            unlink('index.tmp');
        }
    }
     function gmtTime() {
        $timezones = array(
            'Pacific/Midway' => "(GMT-11:00) Midway Island",
            'US/Samoa' => "(GMT-11:00) Samoa",
            'US/Hawaii' => "(GMT-10:00) Hawaii",
            'US/Alaska' => "(GMT-09:00) Alaska",
            'US/Pacific' => "(GMT-08:00) Pacific Time (US &amp; Canada)",
            'America/Tijuana' => "(GMT-08:00) Tijuana",
            'US/Arizona' => "(GMT-07:00) Arizona",
            'US/Mountain' => "(GMT-07:00) Mountain Time (US &amp; Canada)",
            'America/Chihuahua' => "(GMT-07:00) Chihuahua",
            'America/Mazatlan' => "(GMT-07:00) Mazatlan",
            'America/Mexico_City' => "(GMT-06:00) Mexico City",
            'America/Monterrey' => "(GMT-06:00) Monterrey",
            'Canada/Saskatchewan' => "(GMT-06:00) Saskatchewan",
            'US/Central' => "(GMT-06:00) Central Time (US &amp; Canada)",
            'US/Eastern' => "(GMT-05:00) Eastern Time (US &amp; Canada)",
            'US/East-Indiana' => "(GMT-05:00) Indiana (East)",
            'America/Bogota' => "(GMT-05:00) Bogota",
            'America/Lima' => "(GMT-05:00) Lima",
            'America/Caracas' => "(GMT-04:30) Caracas",
            'Canada/Atlantic' => "(GMT-04:00) Atlantic Time (Canada)",
            'America/La_Paz' => "(GMT-04:00) La Paz",
            'America/Santiago' => "(GMT-04:00) Santiago",
            'Canada/Newfoundland' => "(GMT-03:30) Newfoundland",
            'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
            'Greenland' => "(GMT-03:00) Greenland",
            'Atlantic/Stanley' => "(GMT-02:00) Stanley",
            'Atlantic/Azores' => "(GMT-01:00) Azores",
            'Atlantic/Cape_Verde' => "(GMT-01:00) Cape Verde Is.",
            'Africa/Casablanca' => "(GMT) Casablanca",
            'Europe/Dublin' => "(GMT) Dublin",
            'Europe/Lisbon' => "(GMT) Lisbon",
            'Europe/London' => "(GMT) London",
            'Africa/Monrovia' => "(GMT) Monrovia",
            'Europe/Amsterdam' => "(GMT+01:00) Amsterdam",
            'Europe/Belgrade' => "(GMT+01:00) Belgrade",
            'Europe/Berlin' => "(GMT+01:00) Berlin",
            'Europe/Bratislava' => "(GMT+01:00) Bratislava",
            'Europe/Brussels' => "(GMT+01:00) Brussels",
            'Europe/Budapest' => "(GMT+01:00) Budapest",
            'Europe/Copenhagen' => "(GMT+01:00) Copenhagen",
            'Europe/Ljubljana' => "(GMT+01:00) Ljubljana",
            'Europe/Madrid' => "(GMT+01:00) Madrid",
            'Europe/Paris' => "(GMT+01:00) Paris",
            'Europe/Prague' => "(GMT+01:00) Prague",
            'Europe/Rome' => "(GMT+01:00) Rome",
            'Europe/Sarajevo' => "(GMT+01:00) Sarajevo",
            'Europe/Skopje' => "(GMT+01:00) Skopje",
            'Europe/Stockholm' => "(GMT+01:00) Stockholm",
            'Europe/Vienna' => "(GMT+01:00) Vienna",
            'Europe/Warsaw' => "(GMT+01:00) Warsaw",
            'Europe/Zagreb' => "(GMT+01:00) Zagreb",
            'Europe/Athens' => "(GMT+02:00) Athens",
            'Europe/Bucharest' => "(GMT+02:00) Bucharest",
            'Africa/Cairo' => "(GMT+02:00) Cairo",
            'Africa/Harare' => "(GMT+02:00) Harare",
            'Europe/Helsinki' => "(GMT+02:00) Helsinki",
            'Europe/Istanbul' => "(GMT+02:00) Istanbul",
            'Asia/Jerusalem' => "(GMT+02:00) Jerusalem",
            'Europe/Kiev' => "(GMT+02:00) Kyiv",
            'Europe/Minsk' => "(GMT+02:00) Minsk",
            'Europe/Riga' => "(GMT+02:00) Riga",
            'Europe/Sofia' => "(GMT+02:00) Sofia",
            'Europe/Tallinn' => "(GMT+02:00) Tallinn",
            'Europe/Vilnius' => "(GMT+02:00) Vilnius",
            'Asia/Baghdad' => "(GMT+03:00) Baghdad",
            'Asia/Kuwait' => "(GMT+03:00) Kuwait",
            'Africa/Nairobi' => "(GMT+03:00) Nairobi",
            'Asia/Riyadh' => "(GMT+03:00) Riyadh",
            'Europe/Moscow' => "(GMT+03:00) Moscow",
            'Asia/Tehran' => "(GMT+03:30) Tehran",
            'Asia/Baku' => "(GMT+04:00) Baku",
            'Europe/Volgograd' => "(GMT+04:00) Volgograd",
            'Asia/Muscat' => "(GMT+04:00) Muscat",
            'Asia/Tbilisi' => "(GMT+04:00) Tbilisi",
            'Asia/Yerevan' => "(GMT+04:00) Yerevan",
            'Asia/Kabul' => "(GMT+04:30) Kabul",
            'Asia/Karachi' => "(GMT+05:00) Karachi",
            'Asia/Tashkent' => "(GMT+05:00) Tashkent",
            'Asia/Kolkata' => "(GMT+05:30) Kolkata",
            'Asia/Kathmandu' => "(GMT+05:45) Kathmandu",
            'Asia/Yekaterinburg' => "(GMT+06:00) Ekaterinburg",
            'Asia/Almaty' => "(GMT+06:00) Almaty",
            'Asia/Dhaka' => "(GMT+06:00) Dhaka",
            'Asia/Novosibirsk' => "(GMT+07:00) Novosibirsk",
            'Asia/Bangkok' => "(GMT+07:00) Bangkok",
            'Asia/Jakarta' => "(GMT+07:00) Jakarta",
            'Asia/Krasnoyarsk' => "(GMT+08:00) Krasnoyarsk",
            'Asia/Chongqing' => "(GMT+08:00) Chongqing",
            'Asia/Hong_Kong' => "(GMT+08:00) Hong Kong",
            'Asia/Kuala_Lumpur' => "(GMT+08:00) Kuala Lumpur",
            'Australia/Perth' => "(GMT+08:00) Perth",
            'Asia/Singapore' => "(GMT+08:00) Singapore",
            'Asia/Taipei' => "(GMT+08:00) Taipei",
            'Asia/Ulaanbaatar' => "(GMT+08:00) Ulaan Bataar",
            'Asia/Urumqi' => "(GMT+08:00) Urumqi",
            'Asia/Irkutsk' => "(GMT+09:00) Irkutsk",
            'Asia/Seoul' => "(GMT+09:00) Seoul",
            'Asia/Tokyo' => "(GMT+09:00) Tokyo",
            'Australia/Adelaide' => "(GMT+09:30) Adelaide",
            'Australia/Darwin' => "(GMT+09:30) Darwin",
            'Asia/Yakutsk' => "(GMT+10:00) Yakutsk",
            'Australia/Brisbane' => "(GMT+10:00) Brisbane",
            'Australia/Canberra' => "(GMT+10:00) Canberra",
            'Pacific/Guam' => "(GMT+10:00) Guam",
            'Australia/Hobart' => "(GMT+10:00) Hobart",
            'Australia/Melbourne' => "(GMT+10:00) Melbourne",
            'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
            'Australia/Sydney' => "(GMT+10:00) Sydney",
            'Asia/Vladivostok' => "(GMT+11:00) Vladivostok",
            'Asia/Magadan' => "(GMT+12:00) Magadan",
            'Pacific/Auckland' => "(GMT+12:00) Auckland",
            'Pacific/Fiji' => "(GMT+12:00) Fiji",
        );
        return $timezones;
    }
}   
/* End of file settings.php */
/* Location: ./application/modules/settings/controllers/settings.php */
