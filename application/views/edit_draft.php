<?php

extract( $this->content_data );
?>

<div id="forum-drafts">
	<form action="" method="post">
		<fieldset>
			<input type="hidden" id="thread_id" name="thread_id" value="<?php echo $this->outputContent($thread_id); ?>" />
			<input type="hidden" id="draft_id" name="draft_id" value="<?php echo $this->outputContent($d_id); ?>" />
			<p>
				<label for="title">Title</label>
				<input id="title" name="title" value="<?php echo stripslashes($this->outputContent($draft_title)); ?>" />
			</p>
			<p>
				<label>Message</label>
				<textarea cols="40" rows="8" id="message" name="message" class="wymeditor"><?php echo stripslashes($this->outputContent($draft_text)); ?></textarea>
			</p>
			<p>
				<button type="submit" class="wymupdate" id="submit_edited_post" name="submit_edited_post">Publish</button>
				<button type="button" id="save_draft" name="save_draft">Save Draft</button>
				<button type="button" id="discard_draft" name="discard_draft">Discard</button>
			</p>
		</fieldset>
	</form>
<?php require_once 'choose_editor_view.php'; ?>
</div>
