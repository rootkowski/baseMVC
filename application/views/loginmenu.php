<?php
// if user is logged in
if(isset($_SESSION['fullname'])) : ?>

	<div id="login">
		Hello <a href="?page=blog&id=<?php echo $_SESSION['uid']; ?>" title="Click to view your profile"><?php echo $_SESSION['fullname']; ?></a>!
		 &nbsp; | &nbsp;
		 <a href="?page=addnew">Add New Blog Entry</a>
		 &nbsp; | &nbsp;
		 <a href="?page=manage">Manage Your Blog Entries</a>
		 &nbsp; | &nbsp;
		<a href="?page=logout">Log Out</a>
	</div>

<?php else : ?>

	<div id="login">
		<a href="?page=login">Log In</a>
	</div>

<? endif;