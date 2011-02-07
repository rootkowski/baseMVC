<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Forum_controller extends Forum
{
  
	private $forum_title = '';
  
	function __construct()
	{
		parent::__construct();
		$this->forum_title = ' :: Forum :: ' . Page::$config['title'];
	}




	function viewForumHome()
	{
		$this->header('Welcome to our Forum :: ' . $this->forum_title);
    	$this->view('forum/home_view', '');
		$this->footer();
	}
  
  
  
  
	function viewUserPosts($userid)
	{
		$this->getUserData($userid);
		$this->user_name = isset($this->user_data['name']) ? $this->user_data['name'] : 'Unknown';
		$this->header('Posts by ' . $this->user_name . $this->forum_title);
		$this->view('user_posts_view', $this->getUserPosts($userid));
		$this->footer();
	}
  
  
  
  
	function viewForumCategory($cat)
	{
		$this->header($this->getCurrentCategory($cat) . ' Category ' . $this->forum_title);
		$this->view('forum/category_threads_view', $this->getThreadsInCategory());
		$this->footer();
	}
  
}


$forum = new Forum_controller();

if( isset($_GET['uid']) && is_numeric($_GET['uid']) )
  $forum->viewUserPosts($_GET['uid']);
elseif( isset($_GET['uid']) && !is_numeric($_GET['uid']) )
  header('Location: ' . BASE_URL . DS . '?page=forum');


if( isset($_GET['cat']) && is_numeric($_GET['cat']) )
	$forum->viewForumCategory($_GET['cat']);
elseif( isset($_GET['cat']) && !is_numeric($_GET['cat']) )
  header('Location: ' . BASE_URL . DS . '?page=forum');



if( $_GET['page'] == 'forum' && !isset($_GET['cat']) && !isset($_GET['uid']) )
	$forum->viewForumHome();