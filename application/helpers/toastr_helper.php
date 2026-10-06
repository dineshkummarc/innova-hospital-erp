<?php 

if (!function_exists('show_swal')) {
    function show_swal($message, $type = 'success', $title = 'Notification') {
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->session->set_flashdata('swal_message', $message);
        $CI->session->set_flashdata('swal_type', $type);
        $CI->session->set_flashdata('swal_title', $title);
    }
}
