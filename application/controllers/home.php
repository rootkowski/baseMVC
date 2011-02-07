<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$home = new Home();
$home->header('baseMVC - Home Page');
$home->view('home_view', '');
$home->footer();