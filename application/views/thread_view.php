<div id="thread">
<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$n = 0;
foreach( $this->content_data as $key => $value ) :
	extract( $value );
	$n++;
?>
	<div class="forum-post" id="<?php echo $this->outputContent($p_id); ?>">
		<h4><?php echo stripslashes($this->outputContent($title)); ?>
			<br/>
			<small> on <?php echo $this->outputContent($posted_on); ?></small>
			<small style="float: right;">#<?php echo $n; ?></small>
		</h4>
		<div class="postUserInfo">
			<p>by 
				<a href="?page=forum&uid=<?php echo $this->outputContent($id); ?>" title="View all posts by <?php echo $this->outputContent($name); ?>"><b><?php echo $this->outputContent($name); ?></b></a>
				<br/>
				<small>Posts: <span><?php echo $this->outputContent($postNum); ?></span></small>
				<br/>
				<small>Joined: <span><?php echo $this->outputContent($joined_on); ?></span></small>
				<br/>
				<small>Location: <span><?php echo (!empty($location) ? $this->outputContent($location) : 'Unknown'); ?></span></small>
				<br/>
				<small><span><a href="mailto:<?php echo $this->outputContent($email); ?>" title="Send email to <?php echo $this->outputContent($name); ?>"><img src="css/img/mail.png" alt="email icon" /></a></span></small>
			</p>
		</div>
		<div class="postContent">			
			<p class="postText"><?php echo stripslashes($this->outputContent($message)); ?></p>
		</div>
		<?php if( isset($_SESSION['uid']) && $this->forumAuthorisation($p_id, $_SESSION['uid']) ) : ?>
			<p class="postActions clr"><a href="?page=edit_post&thread_id=<?php echo $this->outputContent($_GET['thread_id']); ?>&post_id=<?php echo $this->outputContent($p_id); ?>">Edit</a></p>
		<?php endif; ?>
	</div>
<?php
endforeach;
?>
	<div class="post_ctrls">
	    <p><a href="?page=start_new_thread&thread_id=<?php echo $_GET['thread_id']; ?>">Add Response</a></p>
	</div>
	
</div>
