<?php
/* 
 * Manage View
 */


if( !isset($_SESSION['fullname']) ) :
	$_POST['redirect'] = 'manage';
	require_once CTRLS . 'login/login.php';
else :
?>
	<h3>Manage Your Content</h3>
	<table>

<?php
	foreach( $this->content_data as $key => $value ) :
		extract($value);
	?>

			<tr>
				<td><a href="?page=article&amp;id=<?php echo $id_Content; ?>"><?php echo $title; ?></a></td>
				<td><a href="?page=edit&amp;id=<?php echo $id_Content; ?>">Edit</a></td>
				<td><a href="?page=delete&amp;id=<?php echo $id_Content; ?>">Delete</a></td>
			</tr>

	<?php
	endforeach;
?>
	</table>
<?php
endif;