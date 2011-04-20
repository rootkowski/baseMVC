<?php
/* 
 * User Posts View
 */
if( count($this->content_data) > 0 ) :
?>
<h4>Posts by <?php echo $this->user_name; ?> </h4>
<div id="thread">
<?php
	foreach( $this->content_data as $key => $value ) :
		extract( $value );
	?>
		<div class="forum-post" id="<?php echo $this->outputContent($p_id); ?>">
			<h4>
				<a href="?page=view_thread&thread_id=<?php echo $this->outputContent($thread_id) . '#' . $this->outputContent($p_id); ?>"><?php echo stripslashes($this->outputContent($title)); ?></a>
			</h4>
			<div class="postUserInfo">
				<p>
					<small>Posted on <?php echo $this->outputContent($posted_on); ?></small>
				</p>
			</div>
			<div class="postContent">
				<p class="postText"><?php echo stripslashes($this->outputContent($message)); ?></p>
			</div>
				<?php if( isset($_SESSION['uid']) && $this->forumAuthorisation($p_id, $_SESSION['uid']) ) : ?>
				<p class="postActions clr"><a href="?page=edit_post&thread_id=<?php echo $this->outputContent($thread_id); ?>&post_id=<?php echo $this->outputContent($p_id); ?>">Edit</a></p>
				<?php endif; ?>
		</div>
	<?php
	endforeach;
?>
	<div class="post_ctrls">
	    <p><a href='?page=start_new_thread<?php if( isset($_GET['cat'] ) && is_numeric($_GET['cat']) ) echo '&in_cat=' . $_GET['cat']; ?>'>Start New Discussion</a></p>
	</div>
</div>
<?php
else :
?>
	<h4><?php echo $this->user_name; ?> has not posted anything yet.</h4>
<?php
endif;
?>