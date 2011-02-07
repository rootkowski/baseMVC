<?php
/**
 * Description of NewBlogArticle
 * - New Blog Article Model
 *
 * @author przemek rutkowski
 */
class NewBlogArticle extends Page
{


	function  __construct()
	{
		parent::__construct();
		$this->Authorise = new Authorise();
		$this->LoadEditor = new LoadEditor();
	}



	function submitArticle()
	{
		$new_article = $this->insert("INSERT INTO BlogContent(title, intro, content, authorId, date)
		VALUES('".DB::$_instance->real_escape_string($_POST['title'])."',
			   '".DB::$_instance->real_escape_string($_POST['intro'])."',
			   '".DB::$_instance->real_escape_string($_POST['content'])."',
				".DB::$_instance->real_escape_string($_POST['authorId']).",
				  NOW())");

		if( DB::$_instance->affected_rows === 1)
			// Reload the page
			header('Location: ' . BASE_URL . "?page={$_POST['redirect']}");
	}



	public function viewNewArticleForm()
	{
		$this->view('new_blog_article_view', '');
	}


}