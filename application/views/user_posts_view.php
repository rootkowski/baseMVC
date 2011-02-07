<?php
/* 
 * User Posts View
 */
if( count($this->content_data) > 0 ) :
?>
<h4>Posts by <?php echo $this->user_name; ?> </h4>
<?php
	foreach( $this->content_data as $key => $value ) :
		extract( $value );
	?>
		<div class="post" id="<?php echo $this->outputContent($p_id); ?>">
			<h4>
				<a href="?page=thread&do=view_thread&thread_id=<?php echo $this->outputContent($thread_id) . '#' . $this->outputContent($p_id); ?>"><?php echo stripslashes($this->outputContent($title)); ?></a>
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
				<p class="postActions clr"><a href="?page=thread&do=edit&thread_id=<?php echo $this->outputContent($thread_id); ?>&post_id=<?php echo $this->outputContent($p_id); ?>">Edit</a></p>
				<?php endif; ?>
		</div>
	<?php
	endforeach;
else :
?>
	<h4><?php echo $this->user_name; ?> has not posted anything yet.</h4>
<?php
endif;