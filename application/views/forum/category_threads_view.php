<div class="">
<?php


if( count($this->content_data) === 0 ) :
	echo "<h3>There are no discussions in this category</h3>";

else :
?>
<table style="width: 100%">
	<tr>
		<th>Title</th>
		<th>Replies</th>
	</tr>
<?php
foreach( $this->content_data as $key => $value ) :
	extract($value);
	$i = 0; $i++;
?>
	<tr style="background: #ddd; margin: 15px 0; padding: 15px;">
		<td>
			<a style="color: #222; text-decoration: none;" href="?page=thread&do=view_thread&thread_id=<?php echo $t_id; ?>"><?php echo $title; ?></a>
			<br/>
			<small style="color: #555;">by <?php echo $name . ' on ' . $started_on; ?></small>
		</td>
		<td style="line-height: 50px; text-align: center; width: 8%;"><?php echo $postNum - 1; ?></td>
	</tr>
<?php
	endforeach;
?>
</table>
<?php	
endif;
?>
	<p><a href='?page=thread&do=start_new_thread<?php if( isset($_GET['cat'] ) && is_numeric($_GET['cat']) ) echo '&in_cat=' . $_GET['cat']; ?>'>Start New Discussion</a></p>
</div>