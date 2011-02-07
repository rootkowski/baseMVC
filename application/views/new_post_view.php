<?php
/* 
 * Form for submitting a new post to the forum or starting a whole new thread
 */
?>
<form action="" method="post" class="clr">
	<fieldset>
		<input type="hidden" id="user_id" name="user_id" value="<?php echo isset($_SESSION['uid']) ? $this->outputContent($_SESSION['uid']) : '' ; ?>" />
		<input type="hidden" id="thread_id" name="thread_id" value="<?php echo isset($_GET['thread_id']) ? $this->outputContent($_GET['thread_id']) : ''; ?>" />
		<p>
			<label for="title">Title</label>
			<input id="title" name="title" size="40" value="<?php echo isset( $_GET['thread_id'] ) && is_numeric( $_GET['thread_id'] ) ? 'Re: ' . $this->outputContent( $this->getThreadTitle( $_GET['thread_id'] ) ) : '';?>" />
		</p>
		<p>
			<label>Message</label>
			<textarea cols="40" rows="8" id="message" name="message"></textarea>
		</p>
<?php 	if( !isset($_GET['thread_id']) ) : ?>	
		<p>
			<label for="category">Category</label>		
			<select id="category" name="category">
<?php foreach( $this->content_data as $key => $value ) :
    extract($value); ?>
				<option value="<?php 
	echo $this->outputContent($id); ?>"<?php 
	if( ( $this->getThreadCategory() === $this->outputContent($name) ) 
	|| ( isset($_GET['in_cat']) && is_numeric($_GET['in_cat']) && $this->getCurrentCategory($_GET['in_cat']) === $this->outputContent($name) ) )
		echo ' selected="selected"'; ?>><?php 
	echo $this->outputContent($name); ?></option>
<?php
	endforeach;
?>
			</select>	
		</p>
<?php endif; ?>		
		<p>
			<button type="submit" class="wymupdate" id="submit_new_post" name="submit_new_post">Publish</button>
			<button type="button" class="wymupdate" id="save_draft" name="save_draft">Save Draft</button>
			<button type="button" class="wymupdate" id="discard_draft" name="discard_draft">Discard</button>
		</p>
	</fieldset>
	<?php require_once 'choose_editor_view.php'; ?>
</form>
