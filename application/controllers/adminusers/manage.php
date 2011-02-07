<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Manage Controller
 */


class Manage extends Page
{


	function  __construct()
	{
		parent::__construct();
		parent::header('baseMVC - ' . $_SESSION['fullname'] . ' - Manage Your Content');
	}



	public function getArticles()
	{
		$article_list = $this->select("SELECT * FROM BlogContent WHERE authorId = {$_SESSION['uid']} ORDER BY date DESC");

		$this->view('manage_view', $article_list);
	}


}

$manage = new Manage();
$manage->getArticles();