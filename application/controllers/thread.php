<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
/* 
 * Thread Controller
 *
 * @todo: a better control over URL's is necessary
 *		: find a way to get rid of edit=N if there's an ownership error
 *		: and still be able to view an error message
 */

 
class Thread_controller extends Thread
{
	
	
	private $thread_do = array(
		'view_thread',
		'start_new_thread',
		'edit',
		'submit_new_post',
		'submit_edited_post'
	);
	
	
	protected $url;
	
	public $load_editor = true;
	
	
	
	function __construct()
	{
		parent::__construct();
		
		if( isset( $_GET['thread_id'] ) && is_numeric( $_GET['thread_id'] ) )
			$this->initialiseThread( $_GET['thread_id'] );
			
		$this->url = BASE_URL . DS . '?' . $this->trimURLforEditor();
		
	}
	
	
	
	function verifyThreadAction( $do )
	{
		if( in_array( $do, $this->thread_do ) )
			return true;
		else
			return false;
	}
	
	
	function viewAddNewPost()
	{
		$this->view('new_post_view', $this->categories);
	}
	
	
	
	function viewThread( $thread_id )
	{
		$this->header( $this->getThreadTitle($thread_id) . ' - baseMVC - Forum Thread' );
	    $this->view( 'thread_view', $this->getThread($thread_id) );
		$this->footer();
	}
	
	
	
	function startNewThread()
	{
		$this->header( 'Start New Discussion - baseMVC - Forum Thread');		
		$this->viewAddNewPost();
		if( isset($_GET['editor']) )
			$this->footer($_GET['editor']);
		else
			$this->footer();			
	}
	
	
	
	function editPost()
	{
		if( isset($_GET['thread_id']) && is_numeric($_GET['thread_id']) )
		{
			$this->header( $this->getThreadTitle($_GET['thread_id']) . ' - baseMVC - Forum Thread');
	    
			if( isset($_GET['post_id']) && is_numeric($_GET['post_id']) )
			{
				if( !$this->forumAuthorisation($_GET['post_id'], $_SESSION['uid']) )
				{
					$_SESSION['error_msg'] = "<p>You do not own this post and cannot edit it</p>";
					header('Location: ' . BASE_URL . '?page=thread&do=view_thread&thread_id=' . $_GET['thread_id']);
				}
				if( $this->forumAuthorisation($_GET['post_id'], $_SESSION['uid']) )
				{
					$this->view( 'edit_post_view', $this->getPostToEdit() );
				}
			}
			
			if( isset($_GET['editor']) )
				$this->footer($_GET['editor']);
			else
				$this->footer();
		}
		else
			$this->returnToForum();
	}
	
	
	
	private function trimURLforEditor()
	{
		$url_bits = '';
		foreach( $_GET as $key => $value )
		{
		  if( $key == 'editor' )
		    $value = '';
		  if( !empty( $value ) )
		    $url_bits .= $key . '=' . $value . '&';
		}
		
		return $url_bits;
	}


  public function returnToForum()
  {
    header('Location: ' . BASE_URL . DS . '?page=forum');
  }
	
}


$thread = new Thread_controller();

if( isset($_POST['submit_new_post']) )
	$thread->submitPost();


if( isset($_POST['submit_edited_post']) )
	$thread->submitEditedPost();
  
/*
if( isset($_GET['editor']) && $_GET['editor'] === 'wymeditor' )
	$thread->LoadEditor->chooseEditor('wymeditor');
else
	$thread->LoadEditor->chooseEditor();
*/

if( isset($_GET['do'] ) )
{
	
	if( $thread->verifyThreadAction($_GET['do']) )
	{ 
	  
		if( $_GET['do'] === 'view_thread' )
		{
			if( isset( $_GET['thread_id'] ) && is_numeric( $_GET['thread_id'] ) && $_GET['thread_id'] <= $thread->getThreadRange() )
				$thread->viewThread($_GET['thread_id']);
      else
        $thread->returnToForum();
		}
	  
	  
		if( $_GET['do'] === 'start_new_thread' )
		{
			if( isset($_SESSION['uid'] ) )
				$thread->startNewThread();
			else
			{
				$_SESSION['error_msg'] = "Login required to access the page";
				$thread->requireLogin( REFR_URL );
			}
		}
	  
	  
		if( $_GET['do'] === 'edit' )
		{
			if( isset($_SESSION['uid'] ) )
				$thread->editPost();
			else
			{
				$_SESSION['error_msg'] = "Login required to access the page";
				$thread->requireLogin( REFR_URL );
			}
		}
		
		
	/*
	 * $_GET for ajax funcs to work
	 */	
		
		if( $_GET['do'] === 'submit_new_post' ) 
		{
			sleep(1);
			$thread->submitPost();			
		}
		
		
		if( $_GET['do'] === 'submit_edited_post' ) 
		{
			sleep(1);
			$thread->submitEditedPost();			
		}
    
	}
	else
		$thread->returnToForum();
  
}
else
	$thread->returnToForum();