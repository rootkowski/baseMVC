<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * class ForumDrafts_controller
 */


class ForumDrafts_controller extends ForumDrafts
{
	
	protected $fetched_drafts = array();
	
	public $load_editor = true;
	
	
	function __construct()
	{
		parent::__construct();
		$this->LoadEditor = new LoadEditor();
	}
	
	
	
	function viewDrafts( $uid )
	{
		$this->fetched_drafts = $this->getUserDrafts($uid);
		
		$this->view('forum_drafts_view', $this->fetched_drafts);
	}
	
	
	
	function editDraft( $uid, $did )
	{
		$draft_to_edit = $this->getDraftToEdit($uid, $did);
		
		$this->view('edit_draft', $draft_to_edit);
	}
	
	
	
	
	
	
}


$drafts = new ForumDrafts_controller();
if( isset($_SESSION['uid']) && is_numeric($_SESSION['uid']) )
{
	$drafts->header($_SESSION['fullname'] . '\'s Saved Drafts');
	if( $_GET['page'] === 'draft' )
		$drafts->viewDrafts($_SESSION['uid']);

	elseif( $_GET['page'] === 'edit_draft' && isset($_GET['did']) && is_numeric($_GET['did']) )
		$drafts->editDraft($_SESSION['uid'], $_GET['did']);

	$drafts->footer();
}
else
	header("Location: " . BASE_URL);

