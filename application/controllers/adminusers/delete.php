<?php
if(!isset($visited)) die('No direct access allowed!');
/*
 * Delete Post Controller
 *
 * contains methods necessary to delete an unwanted post that belongs to the author
 */


class Delete extends Page
{

	private $author_id;
	private $title;


	function  __construct()
	{
		parent::__construct();

		$this->getData();
		parent::header('baseMVC - Delete "' . $this->title . '"');
	}



	private function getData()
	{
		$data = $this->select("SELECT authorId, title FROM BlogContent WHERE id_Content = {$_GET['id']}");

		$this->author_id = $data[0]['authorId'];
		$this->title     = $data[0]['title'];
	}


	public function confirmDelete()
	{
		$this->insert("DELETE FROM BlogContent WHERE id_Content = {$_GET['id']}");

		if( DB::$_instance->affected_rows === 1 )
			header('Location: ' . BASE_URL . "?page=manage");
	}



	public function cancelDelete()
	{
		header('Location: ' . BASE_URL . "?page=manage");
	}



	public function getAuthorId()
	{
		return $this->author_id;
	}



	public function getTitle()
	{
		return $this->title;
	}


}

$delete = new Delete();
$delete->view('delete_view', '');

if( isset( $_POST['confirm'] ) ) 
	$delete->confirmDelete();

if( isset( $_POST['cancel'] ) ) 
	$delete->cancelDelete();