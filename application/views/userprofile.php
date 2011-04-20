<?php

extract( $this->user_data );
?>

<table>
	<tr>
		<td>User ID:</td>
		<td><?php echo $id; ?></td>
	</tr>
	<tr>
		<td>Name:</td>
		<td><?php echo $name; ?></td>
	</tr>
	<tr>
		<td>E-mail:</td>
		<td><?php echo $email; ?></td>
	</tr>
	<tr>
		<td>Short Info:</td>
		<td><?php echo $info; ?></td>
	</tr>
	<tr>
		<td>Location:</td>
		<td><?php echo $location; ?></td>
	</tr>
	<tr>
		<td>Joined On:</td>
		<td><?php echo $joined_on; ?></td>
	</tr>
	<tr>
		<td>Last Visit:</td>
		<td><?php echo $last_visit; ?></td>
	</tr>
</table>
