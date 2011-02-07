	<form action="" method="post">
		<fieldset>
			<legend>Add New Article:</legend>
			<input type="hidden" id="redirect" name="redirect" value="author&amp;id=<?php echo $_SESSION['uid'];?>" />
			<input type="hidden" id="authorId" name="authorId" value="<?php echo $_SESSION['uid'];?>" />
			<p>
				<label for="title">Title:</label>
				<br/>
				<input id="title" name="title" type="text" size="40" />
			</p>
			<p>
				<label for="intro">Article Intro:</label>
				<br/>
				<textarea id="intro" name="intro" cols="70" rows="25"></textarea>
			</p>
			<p>
				<label for="content">Article Text:</label>
				<br/>
				<textarea id="content" name="content" cols="70" rows="25"></textarea>
			</p>
			<p>
				<button type="submit" id="submit" name="submit" class="button submit">Submit</button>
			</p>
		</fieldset>
	</form>