<?php
require_once(APPPATH . 'libraries/JWT/JWT.php');
require_once(APPPATH . 'libraries/JWT/Key.php');
require_once(APPPATH . 'libraries/JWT/ExpiredException.php');
require_once(APPPATH . 'libraries/JWT/BeforeValidException.php');
require_once(APPPATH . 'libraries/JWT/SignatureInvalidException.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWT_Lib {
    public function encode($payload, $key, $alg = 'HS256') {
        return JWT::encode($payload, $key, $alg);
    }

    public function decode($jwt, $key, $alg = 'HS256') {
        return JWT::decode($jwt, new Key($key, $alg));
    }
}