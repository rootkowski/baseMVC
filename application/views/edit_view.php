<?php
/* 
 * Edit View
 */

extract($this->content_data);
?>
	<form action="" method="post">
		<fieldset>
			<legend>Add New Article:</legend>
			<input type="hidden" id="redirect" name="redirect" value="id=<?php echo $_SESSION['uid']; ?>" />
			<p>
				<label for="title">Title:</label>
				<br/>
				<input id="title" name="title" type="text" value="<?php echo stripslashes($title); ?>" size="40" />
			</p>
			<p>
				<label for="intro">Article Intro:</label>
				<br/>
				<textarea id="intro" name="intro" cols="70" rows="10"><?php echo stripslashes($intro); ?></textarea>
			</p>
			<p>
				<label for="content">Article Text:</label>
				<br/>
				<textarea id="content" name="content" cols="70" rows="25"><?php echo stripslashes($content); ?></textarea>
			</p>
			<p>
				<button type="submit" id="submit" name="submit" class="button submit">Submit</button>
			</p>
		</fieldset>
	</form>