<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Edit Blog Post Model & Controller
 */


class Edit extends Page
{

	public $article_data;
	
	public $load_editor = true;


	function  __construct()
	{
		parent::__construct();
		$this->extendClass('Authorise');
		$this->extendClass('LoadEditor');
	}



	/*
	 * Instatiate another class
	 * work-around to inherite from more than one class
	 */
   public function extendClass($class_name)
   {
      $this->$class_name = new $class_name;
   }




	function getAuthor()
	{
		if( isset($_GET['id']) )
		{
			$auth_id = $this->selectRow("select authorId from BlogContent where id_Content = {$_GET['id']} limit 1;");
			return $auth_id[0];
		}
		else
			return 'An error has occured. Missing necessary information to resolve ownership issues';
	}




	function fetchData()
	{
		$article_data = $this->select("SELECT * FROM BlogContent WHERE id_Content = {$_GET['id']} LIMIT 1;");

		$this->article_data = $article_data[0];
	}



	function getView()
	{
		$this->fetchData();
		Page::header('baseMVC - Edit "' . $this->article_data['title'] . '"');

		$this->view('edit_view', $this->article_data);

	}




	function submitEdited()
	{
		$edited = $this->insert("UPDATE BlogContent
				SET title = '"  .  DB::$_instance->real_escape_string($_POST['title'])."',
					intro = '"  .  DB::$_instance->real_escape_string($_POST['intro'])."',
					content = '" . DB::$_instance->real_escape_string($_POST['content'])."'
				WHERE id_Content = {$_GET['id']};");

		if( DB::$_instance->affected_rows === 1 )
			header('Location: ' . BASE_URL . "?page=article&id={$_GET['id']}");
		else
			echo 'Affected rows: ' . DB::$_instance->affected_rows . "<br/>UPDATE BlogContent
				SET title = '"  .  DB::$_instance->real_escape_string($_POST['title'])."',
					intro = '"  .  DB::$_instance->real_escape_string($_POST['intro'])."',
					content = '" . DB::$_instance->real_escape_string($_POST['content'])."'
				WHERE id_Content = {$_GET['id']}";
	}


}

$edit = new Edit();


if( isset($_GET['id']) && isset($_SESSION['uid']) && $edit->blogAuthorisation($_GET['id'], $_SESSION['uid']) && isset($_POST['submit']) ) :
	$edit->submitEdited();
endif;


if(!isset($_SESSION['uid'])) :
	$_SESSION['error_msg'] = "<p>Login required to access the page</p>";
	$edit->requireLogin( REFR_URL );

elseif( $edit->blogAuthorisation($_GET['id'], $_SESSION['uid']) ) : // == $author_id && $user_group == 'blogauthor' ) :
	$edit->getView();
	$edit->footer();
else :
	$_SESSION['error_msg'] = "<p>You don't have the permission to edit this article!<br/>It seems that you don't own this article.</p>";
	$edit->header('Page Access Error - baseMVC');
	$edit->footer();

endif;
