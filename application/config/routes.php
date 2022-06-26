<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Authentication
$route['login'] = 'authentication';
$route['daftar'] = 'authentication/daftar';
$route['lupa'] = 'authentication/lupa';
$route['logout'] = 'authentication/proses_logout';

// Default
$route['default_controller'] = 'authentication';
$route['404_override'] = 'utility/not_found';
$route['translate_uri_dashes'] = false;
