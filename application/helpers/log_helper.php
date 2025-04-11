<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('log_activity')) {

    function log_activity($activity, $detail = null)
    {
        $CI = &get_instance();
        $CI->load->database();

        $user_id = $CI->session->userdata('user_id') ?? null;

        $data = [
            'user_id'   => $user_id,
            'aktivitas'  => $activity,
            'created_at'=> date('Y-m-d H:i:s')
        ];

        $CI->db->insert('log_aktivitas', $data);
    }
}
