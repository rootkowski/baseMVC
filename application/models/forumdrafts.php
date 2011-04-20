<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * class ForumDrafts_controller
 */


class ForumDrafts extends Thread
{
	
	
	protected function getUserDrafts( $uid )
	{
		$user_drafts = $this->select("SELECT * FROM ForumDrafts WHERE author_id = {$uid} AND draft_state = 'draft' ORDER BY draft_saved DESC;");
		
		//var_dump($user_drafts);
		return $user_drafts;
	}
	
	
	
	protected function getDraftToEdit( $uid, $did )
	{
		$draft_to_edit = $this->select("SELECT * FROM ForumDrafts WHERE author_id = {$uid} AND d_id = {$did};");
		return $draft_to_edit[0];
	}
	
	
	
	
	protected function saveDraft()
	{}
	
	
	
	
	protected function publishDraft()
	{}
	
	
	
}