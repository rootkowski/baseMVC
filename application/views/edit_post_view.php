<?php
/*
 * Form for editing posts
 */

	extract($this->content_data[0]);

?>
<form action="" method="post">
	<fieldset>
		<input type="hidden" id="thread_id" name="thread_id" value="<?php echo $this->outputContent($thread_id); ?>" />
		<input type="hidden" id="post_id" name="post_id" value="<?php echo $this->outputContent($p_id); ?>" />
		<p>
			<label for="title">Title</label>
			<input id="title" name="title" value="<?php echo stripslashes($this->outputContent($title)); ?>" />
		</p>
		<p>
			<label>Message</label>
			<textarea cols="40" rows="8" id="message" name="message" class="wymeditor"><?php echo stripslashes($this->outputContent($message)); ?></textarea>
		</p>
		<p>
			<button type="submit" class="wymupdate" id="submit_edited_post" name="submit_edited_post">Publish</button>
			<button type="button" id="save_draft" name="save_draft">Save Draft</button>
			<button type="button" id="discard_draft" name="discard_draft">Discard</button>
		</p>
	</fieldset>
</form>
<?php require_once 'choose_editor_view.php'; ?>