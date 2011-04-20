<?php


class UserProfile extends Page
{
	
	
	function __construct( $id )
	{
		parent::__construct();
		$this->getUserData( $id );
	}
	
	
	protected function getUserInfo()
	{
	}
	
}