<?php defined('BASEPATH') or exit('No direct script access allowed');

// Add custom values by settings them to the $config array.
// Example: $config['smtp_host'] = 'smtp.gmail.com';
// @link https://codeigniter.com/user_guide/libraries/email.html

$config['useragent'] = 'Easy!Appointments';
$config['protocol'] = Config::$PROTOCOL; // 'smtp' or 'mail'
$config['mailtype'] = 'html'; // or 'text'
$config['smtp_debug'] = '0'; // or '1'
$config['smtp_auth'] = Config::$SMTP_AUTH; // TRUE or FALSE for anonymous relay.
$config['smtp_host'] = Config::$SMTP_HOST;
$config['smtp_user'] = Config::$SMTP_USER;
$config['smtp_pass'] = Config::$SMTP_PASS;
$config['smtp_crypto'] = 'tls'; // or 'ssl'
$config['smtp_port'] = Config::$SMTP_PORT;
