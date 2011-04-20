<?php


class UserProfile_controller extends UserProfile
{
	
	
	function __construct()
	{
		parent::__construct( $_SESSION['uid'] );
	}
	
	
	function viewUserInfo()
	{	
		$this->view('userprofile', $this->user_data);
	}
	
	
}

$profile = new UserProfile_controller();
$profile->header($_SESSION['fullname'] . '\'s Profile @ baseMVC');
$profile->viewUserInfo();
$profile->footer();