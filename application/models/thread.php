<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* 
 * Thread Model File
 *
 * @author Przemek Rutkowski
 */
class Thread extends Forum
{


	private $thread_title = '';
	private $thread_id = '';
	
	private $num_of_threads;
	
	private $thread_data = array(
		'id'	=> '',
		'title' => '',
		'cat'	=> ''
	);
	private $thread_content = array();



	public function  __construct() {
		parent::__construct();
		$this->LoadEditor = new LoadEditor();
		$this->setThreadRange();
	}
	
	
	private function setThreadRange()
	{
		//echo '<h3>setThreadRange() called</h3>';
		
		
		$thread_range = $this->select("SELECT t_id FROM ForumThreads");
		$this->num_of_threads = count($thread_range);
	}
	
	
	
	private function setThreadId( $id )
	{
		//echo '<h3>setThreadId(' . $id . ') called</h3>';
		
		if( !empty( $id ) )
		{			
			if( $id > 0 )
			{
				if( is_numeric( $id ) )
					$this->thread_data['id'] = $this->thread_id = $id;
				else
					header('Location: ' . BASE_URL . DS . '?page=forum');
			}
			else
				$this->thread_id = $this->newThread();
		}
		else
			$this->thread_id = $this->newThread();
	}




	private function setThreadTitle( $thread_id )
	{
		//echo '<h3>setThreadTitle(' . $thread_id . ') called</h3>';
		
		if( $thread_id > 0 && $thread_id <= $this->num_of_threads )
		{
			$title = $this->select("select title from ForumThreads where t_id = {$thread_id} limit 1;");
			$this->thread_data['title'] = $this->thread_title = $title[0]['title'];
			//echo 'set thread title: ' . $title[0]['title'];
		}
	}
	
	
	
	private function setThreadCategory( $thread_id )
	{
		//echo '<h3>setThreadCategory(' . $thread_id . ') called</h3>';
		
		if( $thread_id > 0 && $thread_id <= (int)$this->num_of_threads )
		{
			$res = $this->callSelectSP( "call GetThreadCategory({$thread_id})" );
			$this->thread_data['cat'] = $res[0]['name'];
		}
	}
	
	
	
	protected function initialiseThread( $thread_id )
	{
		//echo '<h3>initialiseThread(' . $thread_id . ') called</h3>';
		
		$this->setThreadId( $thread_id );
		$this->setThreadTitle( $thread_id );
		$this->setThreadCategory( $thread_id );
	}
  
  
  
  public function getThreadRange()
  {
    return $this->num_of_threads;
  }
	
	
	
	private function getThreadId()
	{
		return $this->thread_data['id'];
	}




	protected function getThreadTitle( $thread_id )
	{
		if( empty( $this->thread_data['title'] ) )
			$this->setThreadTitle($thread_id);
		
		return $this->thread_data['title'];
	}
	
	
	
	protected function getThreadCategory()
	{
		return $this->thread_data['cat'];
	}


  
	protected function getThread($thread_id)
	{
		return $this->callSelectSP("call ViewThread({$thread_id})");
	}





	private function newThread() 
	{
		//echo '<h3>newThread() called</h3>';
		
		$this->insert("insert into ForumThreads(title, started_by, started_on, category, write_status)
			values('" . $this->db->real_escape_string($_POST['title']) . "',
			        " . $this->db->real_escape_string($_POST['user_id']) . ",
				   NOW(),
					" . $this->db->real_escape_string($_POST['category']) . ",
					TRUE);");
  

		if( DB::$_instance->affected_rows === 1 )
		{
			$this->num_of_threads = $this->db->insert_id;
			//echo '<h5>insert id is ' . $this->db->insert_id . '</h5>';
			return $this->db->insert_id;
		}
		else 
			return 0;
	}




	public function submitPost()
	{
		
		//echo '<h3>submitPost() called</h3>';
    
		if( !empty($_POST['title']) && !empty($_POST['message']) )
		{
			if( isset($_POST['thread_id']) && !empty($_POST['thread_id']) && $_POST['thread_id'] > 0 )
			{
				$this->setThreadId( $this->db->real_escape_string($_POST['thread_id']) );
				//echo '<h4>got to post thread id set and not empty</h4>';
			}
			else
			{
				//echo '<h4>got to post thread id not set, or empty or greater than 0</h4>';
				$temp_tid = $this->newThread();
				$this->initialiseThread( $temp_tid );
			}
			
			//echo '<pre>';	
			//var_dump(debug_backtrace(self));
			//echo '</pre>';
			
			if( $this->getThreadId() > 0 )
			{
				$post_title = $this->db->real_escape_string($_POST['title']);
				$post_msg   = $this->db->real_escape_string($_POST['message']);
				$post_auth  = $this->db->real_escape_string($_POST['user_id']);
				
				//echo 't id: ' . $this->getThreadId() . ' auth id: ' . $post_auth . ' title: ' . $post_title . ' msg: ' . $post_msg;
					
				//foreach( $this->thread_data as $key => $value )
				//	echo '<h4>key: ' . $key . ' - ' . $value . '</h4>';
	
				$this->callInsertSP("call SubmitPost(
					{$this->getThreadId()},
				 '" . $post_title . "',
				 '" . $post_msg . "',
					{$post_auth}
					);");
	
				if( $this->db->affected_rows === 1) 
				{
					$return = array('retid' => $this->getThreadId());
					echo json_encode($return);
					if( !isset($_POST['ajax']) )
					 header('Location: ' . BASE_URL . "?page=view_thread&thread_id={$this->getThreadId()}");
				}
				else    
				{			
					$_SESSION['error_msg'] = "An error occured and the post could not be submitted";
					return false;
				}
			}
		}
		else    
		{			
			$_SESSION['error_msg'] = "Fill in all fields";
			return false;
		}
	}




	function getPostToEdit()
	{
		return $this->callSelectSP("call GetPostToEdit({$_GET['post_id']});");
	}




	function submitEditedPost()
	{
		//echo json_encode(array('lame' => 'is it lameditor?'));
		$in_title  = $this->db->real_escape_string($_POST['title']);
		$in_msg    = $this->db->real_escape_string($_POST['message']);
    	$post_id   = $this->db->real_escape_string($_POST['post_id']);
		$thread_id = $this->db->real_escape_string($_POST['thread_id']);

		$edited_forum_post = $this->callInsertSP("call SubmitEditedPost('" . $in_title . "', '" . $in_msg . "', {$post_id});");

		if( $edited_forum_post == 1 )
		{
			if( !isset($_POST['ajax']) )
				header('Location: ' . BASE_URL . "?page=view_thread&thread_id={$thread_id}#{$post_id}");
				
			echo json_encode(array('retid' => $thread_id, 'postid' => $post_id));
	    }
	    else    
	    {     
	    	$_SESSION['error_msg'] = "An error occured and the post could not be submitted";
	    	return false;
	    }
	}




	function getPostAuthor()
	{
		$posted_by = $this->select("select posted_by from ForumPosts where p_id = {$_GET['edit']} limit 1;");
		return $posted_by[0]['posted_by'];
	}

}