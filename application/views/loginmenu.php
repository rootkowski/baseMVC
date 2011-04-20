<?php
// if user is logged in
if(isset($_SESSION['fullname'])) : ?>

	<div id="login">
		<!--Hello <a href="?page=blog&amp;id=<?php echo $_SESSION['uid']; ?>" title="Click to view your profile"><?php echo $_SESSION['fullname']; ?></a>!-->
		Hello <a href="<?php echo BASE_URL . DS; ?>profile" title="Click to view your profile"><?php echo $_SESSION['fullname']; ?></a>!
		<?php if( $this->blogWriter($_SESSION['uid']) ) : ?>
		 &nbsp; | &nbsp;
		 <a href="<?php echo BASE_URL . DS; ?>addnew">Add New Blog Entry</a>
		 &nbsp; | &nbsp;
		 <a href="<?php echo BASE_URL . DS; ?>manage">Manage Your Blog Entries</a>
		 <?php endif; ?>
		 <?php
		 $drafts = $this->userDrafts($_SESSION['uid']);
		 if( $drafts > 0 ) : ?>
		 &nbsp; | &nbsp;
		 <a href="<?php echo BASE_URL . DS; ?>draft">Saved Drafts (<?php echo $drafts; ?>)</a>
		 <?php endif;  ?>
		 &nbsp; | &nbsp;
		<a href="<?php echo BASE_URL . DS; ?>logout">Log Out</a>
	</div>

<?php else : ?>

	<div id="login">
		<a href="<?php echo BASE_URL . DS; ?>login">Log In</a>
	</div>

<? endif;