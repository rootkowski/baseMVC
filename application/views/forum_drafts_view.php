<div id="forum-drafts">
	<table>
		<tr>
			<th>Draft Title</th>
			<th>Delete</th>
			<th>Draft Saved Date</th>
		</tr>
	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
			
	foreach( $this->content_data as $row ) :
	?>
	<tr>
		<td><a href="?page=edit_draft&did=<?php echo $row['d_id']; ?>" title="Click to edit this draft"><?php echo $row['draft_title']; ?></td>
		<td><a href="?page=delete_draft&did=<?php echo $row['d_id']; ?>" title="Click to delete this draft">Delete</a></td>
		<td><?php echo $row['draft_saved']; ?></td>
	</tr>
	<?php
	endforeach;
	?>
	</table>
</div>

