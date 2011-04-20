<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ForumPost_Controller Class
 */
 


class ForumPost_controller extends ForumPost {
		
   
	function __construct() 
	{}
	
	
	/* !THIS MIGHT NOT BE USEFUL AT ALL!
	 * Fetches post data from the model 
	 * and sends it on to the specified view
	 * @param: post id
	 */
	public function viewPost( $post_id )
	{
		$this->view('', $this->fetchPostData($post_id));
	}
	
	
	/*
	 * Fetches user's posts through the model
	 * and sends them on to the spec. view
	 * @param: user id
	 */
	public function viewPostByUser( $user_id )
	{
		$this->view('', $this->fetchPostByUser($user_id));
	}
	
	
	/*
	 * Fetches user's drafts through the model
	 * and sends them on to the spec. view
	 * @param: user id
	 */
	public function viewDraftByUser( $user_id )
	{
		$this->view('', $this->fetchDraftByUser($user_id));
	}
	
	
	/*
	 * Calls a view with new post/draft form.
	 * !Needs forum categories and ability to start a whole new thread!
	 */
	public function newPost()
	{}
	
	
	/*
	 * Fetches post data from the model and passes it on to the view.
	 * @param: post id
	 */
	public function editPost( $post_id )
	{}
	
	
	
	public function publishPost()
	{}
	
	
	
	public function saveDraft()
	{}
} 


$post = new ForumPost_controller();

if( isset($_GET['page']) && $_GET['page'] === 'post' )
{
	if( isset($_GET['user']) && is_string($_GET['user']) )
	{
		//view user's posts
		echo 'Post of user Phil';
	}
	
	if( isset($_GET['post_action']) && is_string($_GET['post_action']) )
	{
		if( $_GET['post_action'] === 'publish' )
		{
			echo 'Publish post';
		}
		
		if( $_GET['post_action'] === 'savedraft' )
		{
			echo 'Save post draft';
		}
	}
}

if( isset($_GET['page']) && $_GET['page'] === 'draft' )
{
	if( isset($_GET['user']) && is_string($_GET['user']) )
	{
		//view user's drafts
		echo 'draft of user Phil';
	}
	
	if( isset($_GET['id']) && is_numeric($_GET['id']) )
	{
		//view draft
		echo 'draft number ' . $_GET['id'];
	}
}





