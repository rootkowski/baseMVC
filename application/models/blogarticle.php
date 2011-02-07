<?php
/**
 * Description of BlogArticle
 * - Model for Blog Articles
 *
 * @author przemek rutkowski
 */

class BlogArticle extends Page
{
    
	public $art_data = array(
		'id'          => '',
		'title'       => '',
		'intro'       => '',
		'content'     => '',
		'author_id'   => '',
		'author_name' => '',
		'date'        => '',
		'comm_num'    => ''
	);

	public $comments = array();


	function  __construct()
	{
		parent::__construct();

		if( isset($_GET['id']) && is_numeric($_GET['id']) )
		{
			$this->art_data['id'] = $_GET['id'];
			$this->fetchArticle();
			$this->fetchAuthor();
			$this->getComments();
		}
	}



	public function fetchArticle()
	{
		$article = $this->select("SELECT * FROM BlogContent WHERE id_Content = {$this->art_data['id']} LIMIT 1;");

		extract($article[0]);

		$this->art_data['title']   = $title;
		$this->art_data['intro']   = $intro;
		$this->art_data['content'] = $content;
		$this->art_data['author_id'] = $authorId;
		$this->art_data['date'] = $date;
		$this->art_data['comm_num'] = $numOfComments;
	}



	private function fetchAuthor()
	{
		$author = $this->select("SELECT name FROM SiteUsers WHERE id = {$this->art_data['author_id']};");

		extract($author[0]);

		$this->art_data['author_name'] = $name;
	}




	public function getComments()
	{
		$comments = $this->select("SELECT * FROM BlogComments WHERE contentId = {$this->art_data['id']} ORDER BY date_Comment ASC;");

		$this->comments = $comments;
	}



	public function submitComment()
	{
		$insert = $this->insert("INSERT INTO BlogComments(contentId, title_Comment, content_Comment, author_Comment, date_Comment)
		VALUES("  . DB::$_instance->real_escape_string($_GET['id']) . ",
			   '" . DB::$_instance->real_escape_string($_POST['title']) . "',
			   '" . DB::$_instance->real_escape_string($_POST['comment']) . "',
			   '" . DB::$_instance->real_escape_string($_POST['name']) . "',
			   NOW())");

		if( $insert === 1 )
		{
			$update = $this->insert("UPDATE BlogContent SET numOfComments = numOfComments + 1 WHERE id_Content = {$_GET['id']};");

			if( $update === 1 )
			{
				// Reload the page
				$redirect = $_POST['redirect'];
				$_POST = array();
				header('Location: ' . BASE_URL . "?page={$redirect}");
			}
		}
	}
}