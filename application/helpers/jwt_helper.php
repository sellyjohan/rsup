<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function validate_jwt($token) {
    $CI =& get_instance();
    $CI->load->config('jwt');
    $CI->load->library('JWT_Lib');

    $key = $CI->config->item('jwt_key');

    try {
        $decoded = $CI->jwt_lib->decode($token, $key, 'HS256');
        return $decoded;
    } catch (Exception $e) {
        return false;
    }
}
