<?php
/* 
 * Login View
 */
 
$this->load_editor = false;
?>

<form method="post" action="">
	<fieldset>
		<legend>Please Log In</legend>
		<small>available logins:
			<br/>super admin: user mail = admin@site.com pwd = adminrules
			<br/>blog author: user email = clarkson@site.com pwd = clarkson
			<br/>blog author: user email = may@site.com pwd = may
			<br/>blog author: user email = hamilton@site.com pwd = hamilton
			<br/>member: user email = phil@site.com pwd = 123
		</small>
		<table>
			<tr class="tdlabel">
				<td><label for="email">User email:</label></td>
				<td><input type="text" id="email" name="email" /></td>
			</tr>
			<tr class="tdlabel">
				<td><label for="upwd">Password:</label></td>
				<td><input type="password" id="upwd" name="upwd" /></td>
			</tr>
		</table>
		<button type="submit" name="login_btn" id="login_btn" class="teacher">Log In</button>
	</fieldset>
</form>