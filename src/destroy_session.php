<?php
$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time()-42000, '/');
}
// Finally, destroy the session.
session_destroy();

//echo 'Session destroyed!!!';

?>
