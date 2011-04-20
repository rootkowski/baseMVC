<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of Authorise
 *
 * @author przemek
 */
 
class Authorise extends DB
{

	public $user_data = array();
	private $group_name = '';

	private $login_data = array(
		'email' => '',
		'pwrd' => ''
	);
	
	protected $return_to_url = '';


	// declaring constructor to avoid attempts to initialize class DB
	public function  __construct() 
	{
		//parent::__construct();
		DB::getInstance();
		$this->connect();
	}




	public function getUserData( $id )
	{
		if( !empty($id) && is_numeric($id) && $id > 0 )
		{
			$data = $this->select("select id, group_id, name, nick, email, info, location, joined_on, last_visit from SiteUsers where id = $id limit 1;");
			if( !empty($data) )
				$this->user_data = $data[0];
		}
		else
			header('Location: ' . BASE_URL . '?page=login');
	}




	public function getUserGroup()
	{
		if( isset($this->user_data['group_id']) && is_numeric($this->user_data['group_id']) )
		{
			$group = $this->select("select name from SiteUserGroups where id = {$this->user_data['group_id']};");

			$this->group_name = $group[0]['name'];
			return $this->group_name;
		}
		else
			return 'An error has occured. Missing necessary information to resolve ownership issues';
	}




	function forumAuthorisation($cont_id, $u_id)
	{
		$res = DB::$_instance->query("SELECT AuthoriseForumUser({$cont_id}, {$u_id});");

		$row = $res->fetch_row();

		return $row[0];
	}




	function blogAuthorisation($cont_id, $u_id)
	{
		$res = DB::$_instance->query("SELECT AuthoriseBlogUser({$cont_id}, {$u_id});");

		$row = $res->fetch_row();

		return $row[0];
	}




	function blogWriter( $uid )
	{
		$result = DB::$_instance->query("SELECT AuthoriseBlogWriter({$uid});");

		$row = $result->fetch_row();

		return $row[0];
	}
	
	
	protected function setReturnURL( $url )
	{
		$this->return_to_url = $url;
	}
	
	
	
	protected function getReturnURL()
	{
		return $this->return_to_url;
	}
	
	
	
	public function requireLogin( $url = REFR_URL )
	{
		$this->setReturnURL( $url );
		
		if( !empty($this->return_to_url) )
			require CTRLS . DS . 'login.php';
	}



	function checkLoginData()
	{
		$this->login_data['email'] = isset($_POST['email']) ? DB::$_instance->real_escape_string($_POST['email']) : '';
		$this->login_data['pwrd'] = isset($_POST['upwd']) ? DB::$_instance->real_escape_string($_POST['upwd']) : '';

		$user = $this->select("SELECT * FROM SiteUsers WHERE email = '{$this->login_data['email']}' AND user_pass = md5('{$this->login_data['pwrd']}');");

		
		if( $this->count_rows === 1 )
		{
			require_once BASEPATH . DS . 'destroy_session.php';
			session_start();
			session_regenerate_id();
			extract($user[0]);
			$_SESSION['uid']      = $id;
			$_SESSION['fullname'] = $name;
			if( $this->return_to_url === BASE_URL . DS . '?page=login' )
				$this->setReturnURL( BASE_URL );
				
			$_SESSION['message'] = 'Welcome ' . $_SESSION['fullname'];
			
			header( 'Location: ' . $this->return_to_url );
		}
		else
			$_SESSION['error_msg'] = 'Wrong user name or password!';
	}
	
	
	
	function userDrafts( $uid )
	{
		$num_of_drafts = $this->select("SELECT count(d_id) as drafts FROM ForumDrafts WHERE author_id = {$uid} AND draft_state = 'draft';");
		return $num_of_drafts[0]['drafts'];
	}


	// @todo: extend the use of class Authorise into login and content management
}
?>
