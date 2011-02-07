<?php
if(!isset($visited)) die('No direct access allowed!');

$mysqli = new mysqli(DB_host, DB_user, DB_pwd, DB_name);

if(mysqli_connect_error()) {
	echo 'Connection failed: '.mysqli_connect_error()."<br/>";
	exit();
}

if( isset( $_POST['confirm'] ) ) {
	
	$delete_query = "DELETE FROM BlogComments WHERE id_Comment = {$_GET['commid']}";
	$mysqli->query($delete_query) or die("The post could not be deleted");	
	
	$update_query = "UPDATE BlogContent SET numOfComments = numOfComments - 1 WHERE id_Content = {$_GET['id']};";
	$mysqli->query($update_query);
	
	header('Location: ' . BASE_URL . "?page=article&id={$_GET['id']}");
}

if( isset( $_POST['cancel'] ) ) {
	header('Location: ' . BASE_URL . "?page=manage");
}

$authorName = $_SESSION['fullname'];
$header = 'Foogler - ' . $authorName . ' - Delete Comment';
echo $page->header($header);

$query = "SELECT * FROM BlogContent, BlogComments WHERE id_Content = contentId AND id_Comment = {$_GET['commid']};";
$result = $mysqli->query($query) or die("Could not query the database");


while( $row = $result->fetch_object() ) {
	$authorId = $row->authorId;
	if( isset($_SESSION['uid']) && $_SESSION['uid'] == $authorId ) {
		?>
		
		<div class="msg">
			<h2 class="error">Are you sure you want to delete comment</h2>
			<form method="post" action="">
				<fieldset>
				<button id="confirm" name="confirm">Yes, delete now</button>&nbsp; &nbsp;<button id="cancel" name="cancel">No, do not delete</button>
				</fieldset>
			</form>
		</div>
		
		<?
	}
	else {
		echo "<div class=\"error\">You don't have the permission to delete this comment!<br/>It seems that you don't own this content.</div>";
	}
}

?>