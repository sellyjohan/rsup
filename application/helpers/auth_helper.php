<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function check_login()
{
    $CI =& get_instance();
    if (!$CI->session->userdata('logged_in')) {
        redirect('login');
    }
}

function check_role($allowed_roles = [])
{
    $CI =& get_instance();
    $role_id = $CI->session->userdata('role');
    if (!in_array($role_id, $allowed_roles)) {
        show_error("Access denied", 403);
    }
}
