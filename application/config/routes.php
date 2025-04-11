<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Halaman default saat aplikasi dibuka
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// ========================
// ROUTING HALAMAN UTAMA
// ========================

// Login
$route['login'] = 'login/index';
$route['logout'] = 'login/logout';
$route['auth'] = 'login/auth';

// Dashboard
$route['dashboard'] = 'dashboard/index';
$route['dashboard/admin'] = 'dashboard/admin';
$route['dashboard/editor'] = 'dashboard/editor';
$route['dashboard/user'] = 'dashboard/user';

// User Management
$route['user'] = 'user/index';

// Artikel
$route['artikel'] = 'artikel/index';
$route['artikel/create'] = 'artikel/create';

// ========================
// ROUTING REST API
// ========================


// User API
$route['api/users']['GET'] = 'api/users_api/index';
$route['api/users']['POST'] = 'api/users_api/create';
$route['api/users/(:num)']['GET'] = 'api/users_api/user/$1';
$route['api/users/(:num)']['PUT'] = 'api/users_api/update/$1';
$route['api/users/(:num)']['DELETE'] = 'api/users_api/delete/$1';

// Artikel API
$route['api/artikel']['GET'] = 'api/artikel_api/index_get';
$route['api/artikel/(:num)']['GET'] = 'api/artikel_api/detail/$1';
$route['api/artikel/create']['POST'] = 'api/artikel_api/create';
$route['api/artikel/update/(:num)']['POST'] = 'api/artikel_api/update/$1';
$route['api/artikel/delete/(:num)']['DELETE'] = 'api/artikel_api/delete/$1';
