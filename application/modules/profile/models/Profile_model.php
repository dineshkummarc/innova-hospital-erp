<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile_model extends CI_model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getProfileById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users');
        return $query->row();
    }

    function updateProfile($id, $data, $group_name)
    {
        $this->db->where('ion_user_id', $id);
        $this->db->update($group_name, $data);
    }

    function updateUser($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    function getUserDetails($ion_user_id, $group_name)
    {
        $this->db->where('ion_user_id', $ion_user_id);
        $query = $this->db->get($group_name);
        return $query->row();
    }

    function updateIonUser($username, $email, $password, $ion_user_id)
    {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

    function getUsersGroups($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('users_groups');
        return $query;
    }

    function getGroups($group_id)
    {
        $this->db->where('id', $group_id);
        $query = $this->db->get('groups');
        return $query;
    }

}
