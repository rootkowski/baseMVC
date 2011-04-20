<div class="forum">
<?php


if( count($this->content_data) === 0 ) :
	echo "<h3>There are no discussions in this category</h3>";

else :
?>
<table>
	<tr>
		<th>Title</th>
		<th>Replies</th>
		<th>Last Post</th>
	</tr>
<?php
foreach( $this->content_data as $key => $value ) :
	extract($value);
	$i = 0; $i++;
?>
	<tr>
		<td class="thread-title">
			<a href="?page=view_thread&amp;thread_id=<?php echo $t_id; ?>"><?php echo $title; ?></a>
			<br/>
			<small>by <?php echo $name . ' on ' . $started_on; ?></small>
		</td>
		<td class="thread-replies"><?php echo $postNum - 1; ?></td>
		<td>Some date and name</td>
	</tr>
<?php
	endforeach;
?>
	<tr class="last-row">
		<td colspan="3"><p><a href='?page=start_new_thread<?php if( isset($_GET['cat'] ) && is_numeric($_GET['cat']) ) echo '&in_cat=' . $_GET['cat']; ?>'>Start New Discussion</a></p></td>
<!-- 		<td>&nbsp;</td> -->
	</tr>
</table>
<?php	
endif;
?>	
</div>