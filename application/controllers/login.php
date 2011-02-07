<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Login Controller
 *
 */

//require_once BASEPATH . DS . 'destroy_session.php';


class Login_controller extends Page
{
		

	function  __construct() 
	{
		parent::__construct();
	}
	
	
	
	public function viewLoginForm()
	{		
		$this->header('baseMVC - Login Page');
		$this->view('login_view', '');
		$this->footer();
	}

}

$login = new Login_controller();

if( isset( $_POST['login_btn'] ) )
	$login->checkLoginData();

$login->viewLoginForm();
?>