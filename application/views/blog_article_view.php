<?php
/* 
 * Blog Article View
 */
extract($this->content_data);
?>
		<div class="post">
			<h3 class="postHeader"><?php echo stripslashes($title); ?></h3>
			<p class="postData"><?php echo 'Added on '.$date . ' by ' . $author_name; ?></p>
			<div class="postContent">
				<?php echo stripslashes($intro); ?>
				<?php echo stripslashes($content); ?>

			</div>
		</div>

	<h5>There are <?php echo $comm_num; ?> comments about this article</h5>

<?php

	foreach( $this->comments as $key => $value ) {
		extract($value);
?>

		<div class="comment">
			<h4><?php echo stripslashes($this->outputContent($title_Comment)); ?></h4>
			<small>Submitted on: <?php echo $date_Comment; ?></small>
			<p><?php echo stripslashes($this->outputContent($content_Comment)); ?></p>
			<p><?php echo stripslashes($this->outputContent($author_Comment)); ?></p>
			<?php if( isset($_SESSION['uid']) && $_SESSION['uid'] == $author_id ) : ?>
			<p><a href="?page=delComment&amp;id=<?php echo $contentId; ?>&amp;commid=<?php echo $id_Comment; ?>">Delete this comment</a></p>
			<?php endif; ?>
		</div>

<?php
	}
?>

	<!-- Comment submission form -->
	<form action="" method="post">
		<fieldset>
			<legend>Comment this article:</legend>
			<input type="hidden" id="redirect" name="redirect" value="article&amp;id=<?php echo $_GET['id'];?>" />
			<p>
				<label for="title">Title:</label>
				<br/>
				<input id="title" name="title" type="text" value="<?php echo 'Re: ' . $this->outputContent($title); ?>" />
			</p>
			<p>
				<label for="comment">Your Comment:</label>
				<br/>
				<textarea id="comment" name="comment" cols="50" rows="6"></textarea>
			</p>
			<p>
				<label for="name">Your name:</label>
				<br/>
				<input id="name" name="name" type="text" <?php if( isset($_SESSION['uid']) ) echo ' value="' . $_SESSION['fullname'] . '"'; ?> />
			</p>
			<p>
				<button type="submit" id="submit" name="submit" class="button submit">Submit</button>
			</p>
		</fieldset>
	</form>
<?php
require_once 'markitup.php';