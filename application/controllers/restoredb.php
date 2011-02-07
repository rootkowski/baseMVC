<?php
/*
 * @todo: STORED PROCEDURE COMMENTS
 *		  -- if a post is submitted with empty title check it against the thread table
 *		  -- and copy that thread's title prepending it with 're: '
 *		  -- to be called if $_POST['title'] is empty
 *
 *		  -- if the first post of a thread is being updated also update title in the thread table
 *		  -- needs an accompaning trigger
 */
$sql  = file_get_contents(BASEPATH . DS . 'sql/destroy_tables.sql');
$sql .= PHP_EOL;
$sql .= file_get_contents(BASEPATH . DS . 'sql/restore_users.sql');
$sql .= PHP_EOL;
$sql .= file_get_contents(BASEPATH . DS . 'sql/restore_blog.sql');
$sql .= PHP_EOL;
$sql .= file_get_contents(BASEPATH . DS . 'sql/restore_forum.sql');
$sql .= PHP_EOL;
$sql .= file_get_contents(BASEPATH . DS . 'sql/restore_stats.sql');
$sql .= PHP_EOL;
$sql .= file_get_contents(BASEPATH . DS . 'sql/stored_procedures.sql');
// @todo: add file with procedures
// somehow when run through php mysql doesn't understand engine=innodb!

// @todo: reqrite this part to go together with MVC
$mysqli = new mysqli(DB_host, DB_user, DB_pwd, DB_name);

if(mysqli_connect_error()) {
	echo 'Connection failed: ' . mysqli_connect_error() . "<br/>";
	exit();
}

$mysqli->multi_query($sql) or die("Could not query the database" . mysqli_error($mysqli));

header('Location: ' . BASE_URL);
?>
<pre><?php echo $sql; ?></pre>