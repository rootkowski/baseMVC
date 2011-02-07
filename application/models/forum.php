<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Forum Model File
 *
 * @author Przemek Rutkowski
 */
class Forum extends Page
{

	private $post_data = array(
		'thread_id' => '',
		'posted_by' => ''
	);

	public $thread_list_header = '';

	protected $categories = array(); // can be private if forum and thread will be merged

	function  __construct()
	{
		parent::__construct();
		$this->setCategories();
	}


	protected function getCategories()
	{
		return $this->categories;
	}
  
  
	private function setCategories()
	{
		$this->categories = $this->select("SELECT * FROM ForumCategories;");
	}
  
	
	
	/*
	 * checkProvidedCategory
	 * 
	 * @param: int
	 * Checks if the provided category id is 
	 * within the limit of existing cat's.
	 * 
	 * Requires that $this->setCategories has been run
	 * and $this->categories has been set.
	 */
	private function checkProvidedCategory($cat)
	{
		if( isset($cat) && is_numeric($cat) )
		{
			$cat_ids = array();
      
			foreach( $this->categories as $key )
				$cat_ids[] = $key['id'];
        
			if( in_array($cat, $cat_ids) )
				return TRUE;
			else
				return FALSE;
		}
		else
			return FALSE;
	}


	function getCurrentCategory($cat)
	{
		if( $this->checkProvidedCategory($cat) )
			return $this->categories[$cat - 1]['name'];
	}


	protected function getLatestThreads()
	{
		return $this->select("SELECT * FROM ForumThreads ORDER BY started_on DESC LIMIT 5;");
	}


	protected function getLatestPosts()
	{
		return $this->select("SELECT * FROM ForumPosts ORDER BY posted_on DESC LIMIT 5;");
	}
  


	protected function getThreadsInCategory()
	{
		if( isset($_GET['cat']) && is_numeric($_GET['cat']) )
			return $this->select("SELECT * FROM ForumThreads, ThreadStats, SiteUsers WHERE SiteUsers.id = started_by AND t_id = tid AND category = {$_GET['cat']} ORDER BY started_on DESC");
		else
			return 'No proper category provided';
	}


	protected function getUserPosts( $uid )
	{
		return $this->callSelectSP("call getUserPosts({$uid})");
	}


}