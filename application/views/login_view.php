<?php
/* 
 * Login View
 */
 
$this->load_editor = false;
?>

<form method="post" action="" id="login-form">
	<table>
		<tr class="tdlabel">
			<td><label for="email">User email:</label></td>
			<td><input type="text" id="email" name="email" /></td>
		</tr>
		<tr class="tdlabel">
			<td><label for="upwd">Password:</label></td>
			<td><input type="password" id="upwd" name="upwd" /></td>
		</tr>
		<tr class="tdlabel">
			<td colspan="2"><button type="submit" name="login_btn" id="login_btn" class="teacher">Log In</button></td>
		</tr>
	</table>
</form>

<h5>available logins:</h5>
<ul>
	<li>super admin: user mail = admin@site.com pwd = adminrules</li>
	<li>blog author: user email = clarkson@site.com pwd = clarkson</li>
	<li>blog author: user email = may@site.com pwd = may</li>
	<li>blog author: user email = hamilton@site.com pwd = hamilton</li>
	<li>member: user email = phil@site.com pwd = 123</li>
</ul>
