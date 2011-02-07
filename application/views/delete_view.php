<?php
/* 
 * Delete Post View
 */
if( isset($_SESSION['uid']) && $_SESSION['uid'] == $this->getAuthorId() ) :
?>

		<div class="msg">
			<h2 class="error">Are you sure you want to delete article "<?php echo $this->getTitle(); ?>"</h2>
			<form method="post" action="">
				<button id="confirm" name="confirm">Yes, delete now</button>
				&nbsp; &nbsp;
				<button id="cancel" name="cancel">No, do not delete</button>
			</form>
		</div>

<?
// @todo: else - the author doesn't own the article
endif;
?>
