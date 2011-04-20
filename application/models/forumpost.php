<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * ForumPost Class
 * 
 * TO BE ABLE TO START NEW THREAD ON NEW POST
 * WILL HAVE TO INHERIT FROM THREAD INSTEAD
 */
 


class ForumPost extends Page {
		
   
	function __construct() 
	{}
	
	
	/*
	 * Fetches post data from db
	 * @param: post id
	 * @return: array with post data
	 */
	protected function fetchPostData( $post_id )
	{
		$data = $this->select("");
		
		return $data[0];
	}
	
	
	/*
	 * Fetches all posts by the same user
	 * @param: user id
	 * @return: array with post by specified user
	 */
	protected function fetchPostByUser( $user_id )
	{}
	
	
	/*
	 * Fetches all saved drafts of an user
	 * @param: user id
	 * @return: array with drafts by specified user
	 */
	protected function fetchDraftByUser( $user_id )
	{}
	
	
	/*
	 * Fetches data of user's post/draft to edit
	 * @param: post id
	 * @return: array with post/draft data
	 */
	private function fetchPostToEdit( $post_id )
	{}
	
	
	
	private function publishPost()
	{}
	
	
	
	private function saveDraft()
	{}
	
	
	
	private function sanitiseFormData()
	{}
} 