<?php
/* 
 * Blog Viewer File
 */

?>
	<h2>BaseMVC - Blog</h2>

	<!-- main div with chronologically ordered posts -->
	<div id="main">

<?php
/*
 * It would be desirable to find a way of pushing the foreach loop
 * into the controller and keep this file simpler
 */
foreach( $this->content_data as $key => $value ) :
	extract($value);
?>
		<div class="post">
			<h3 class="postHeader"><a href="<?php echo "?page=article&amp;id={$id_Content}"; ?>"><?php echo $title; ?></a></h3>
			<p class="postData"><?php echo 'Added on '.$date.' by '.$name.'.'; ?></p>
			<div class="postContent">
				<?php echo stripslashes($intro); ?>
			</div>
			<p><small><?php if($numOfComments == 1) $com_str = 'Comment'; else $com_str = 'Comments'; echo $numOfComments . ' ' . $com_str; ?></small></p>
		</div>
<?php
endforeach;
?>

	</div>